<?php

namespace PHPMaker2024\afyaplus;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Closure;

/**
 * Page class
 */
class ItemPurchasesEdit extends ItemPurchases
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ItemPurchasesEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "itempurchasesedit";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->id->setVisibility();
        $this->batch_number->setVisibility();
        $this->supplier_id->setVisibility();
        $this->category_id->setVisibility();
        $this->subcategory_id->setVisibility();
        $this->item_title->setVisibility();
        $this->quantity->setVisibility();
        $this->measuring_unit->setVisibility();
        $this->unit_price->setVisibility();
        $this->selling_price->setVisibility();
        $this->amount_paid->setVisibility();
        $this->invoice_attachment->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'item_purchases';
        $this->TableName = 'item_purchases';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (item_purchases)
        if (!isset($GLOBALS["item_purchases"]) || $GLOBALS["item_purchases"]::class == PROJECT_NAMESPACE . "item_purchases") {
            $GLOBALS["item_purchases"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'item_purchases');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "itempurchasesview"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();

            // Force logout user
            if (!IsSysAdmin() && Profile()->isForceLogout(session_id())) {
                $this->terminate("logout");
                return;
            }

            // Check if valid user and update last accessed time
            if (!IsSysAdmin() && !IsPasswordExpired() && !Profile()->isValidUser(session_id(), false)) {
                $this->terminate("logout"); // Handle as session expired
                return;
            }
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->supplier_id);
        $this->setupLookupOptions($this->category_id);
        $this->setupLookupOptions($this->subcategory_id);
        $this->setupLookupOptions($this->measuring_unit);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load result set
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("itempurchaseslist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "itempurchaseslist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "itempurchaseslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "itempurchaseslist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = RowType::EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
        $this->invoice_attachment->Upload->Index = $CurrentForm->Index;
        $this->invoice_attachment->Upload->uploadFile();
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'batch_number' first before field var 'x_batch_number'
        $val = $CurrentForm->hasValue("batch_number") ? $CurrentForm->getValue("batch_number") : $CurrentForm->getValue("x_batch_number");
        if (!$this->batch_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->batch_number->Visible = false; // Disable update for API request
            } else {
                $this->batch_number->setFormValue($val);
            }
        }

        // Check field name 'supplier_id' first before field var 'x_supplier_id'
        $val = $CurrentForm->hasValue("supplier_id") ? $CurrentForm->getValue("supplier_id") : $CurrentForm->getValue("x_supplier_id");
        if (!$this->supplier_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supplier_id->Visible = false; // Disable update for API request
            } else {
                $this->supplier_id->setFormValue($val);
            }
        }

        // Check field name 'category_id' first before field var 'x_category_id'
        $val = $CurrentForm->hasValue("category_id") ? $CurrentForm->getValue("category_id") : $CurrentForm->getValue("x_category_id");
        if (!$this->category_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->category_id->Visible = false; // Disable update for API request
            } else {
                $this->category_id->setFormValue($val);
            }
        }

        // Check field name 'subcategory_id' first before field var 'x_subcategory_id'
        $val = $CurrentForm->hasValue("subcategory_id") ? $CurrentForm->getValue("subcategory_id") : $CurrentForm->getValue("x_subcategory_id");
        if (!$this->subcategory_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subcategory_id->Visible = false; // Disable update for API request
            } else {
                $this->subcategory_id->setFormValue($val);
            }
        }

        // Check field name 'item_title' first before field var 'x_item_title'
        $val = $CurrentForm->hasValue("item_title") ? $CurrentForm->getValue("item_title") : $CurrentForm->getValue("x_item_title");
        if (!$this->item_title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->item_title->Visible = false; // Disable update for API request
            } else {
                $this->item_title->setFormValue($val);
            }
        }

        // Check field name 'quantity' first before field var 'x_quantity'
        $val = $CurrentForm->hasValue("quantity") ? $CurrentForm->getValue("quantity") : $CurrentForm->getValue("x_quantity");
        if (!$this->quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->quantity->Visible = false; // Disable update for API request
            } else {
                $this->quantity->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'measuring_unit' first before field var 'x_measuring_unit'
        $val = $CurrentForm->hasValue("measuring_unit") ? $CurrentForm->getValue("measuring_unit") : $CurrentForm->getValue("x_measuring_unit");
        if (!$this->measuring_unit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->measuring_unit->Visible = false; // Disable update for API request
            } else {
                $this->measuring_unit->setFormValue($val);
            }
        }

        // Check field name 'unit_price' first before field var 'x_unit_price'
        $val = $CurrentForm->hasValue("unit_price") ? $CurrentForm->getValue("unit_price") : $CurrentForm->getValue("x_unit_price");
        if (!$this->unit_price->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->unit_price->Visible = false; // Disable update for API request
            } else {
                $this->unit_price->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'selling_price' first before field var 'x_selling_price'
        $val = $CurrentForm->hasValue("selling_price") ? $CurrentForm->getValue("selling_price") : $CurrentForm->getValue("x_selling_price");
        if (!$this->selling_price->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->selling_price->Visible = false; // Disable update for API request
            } else {
                $this->selling_price->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'amount_paid' first before field var 'x_amount_paid'
        $val = $CurrentForm->hasValue("amount_paid") ? $CurrentForm->getValue("amount_paid") : $CurrentForm->getValue("x_amount_paid");
        if (!$this->amount_paid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->amount_paid->Visible = false; // Disable update for API request
            } else {
                $this->amount_paid->setFormValue($val, true, $validate);
            }
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->batch_number->CurrentValue = $this->batch_number->FormValue;
        $this->supplier_id->CurrentValue = $this->supplier_id->FormValue;
        $this->category_id->CurrentValue = $this->category_id->FormValue;
        $this->subcategory_id->CurrentValue = $this->subcategory_id->FormValue;
        $this->item_title->CurrentValue = $this->item_title->FormValue;
        $this->quantity->CurrentValue = $this->quantity->FormValue;
        $this->measuring_unit->CurrentValue = $this->measuring_unit->FormValue;
        $this->unit_price->CurrentValue = $this->unit_price->FormValue;
        $this->selling_price->CurrentValue = $this->selling_price->FormValue;
        $this->amount_paid->CurrentValue = $this->amount_paid->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->batch_number->setDbValue($row['batch_number']);
        $this->supplier_id->setDbValue($row['supplier_id']);
        $this->category_id->setDbValue($row['category_id']);
        $this->subcategory_id->setDbValue($row['subcategory_id']);
        $this->item_title->setDbValue($row['item_title']);
        $this->quantity->setDbValue($row['quantity']);
        $this->measuring_unit->setDbValue($row['measuring_unit']);
        $this->unit_price->setDbValue($row['unit_price']);
        $this->selling_price->setDbValue($row['selling_price']);
        $this->amount_paid->setDbValue($row['amount_paid']);
        $this->invoice_attachment->Upload->DbValue = $row['invoice_attachment'];
        if (is_resource($this->invoice_attachment->Upload->DbValue) && get_resource_type($this->invoice_attachment->Upload->DbValue) == "stream") { // Byte array
            $this->invoice_attachment->Upload->DbValue = stream_get_contents($this->invoice_attachment->Upload->DbValue);
        }
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['batch_number'] = $this->batch_number->DefaultValue;
        $row['supplier_id'] = $this->supplier_id->DefaultValue;
        $row['category_id'] = $this->category_id->DefaultValue;
        $row['subcategory_id'] = $this->subcategory_id->DefaultValue;
        $row['item_title'] = $this->item_title->DefaultValue;
        $row['quantity'] = $this->quantity->DefaultValue;
        $row['measuring_unit'] = $this->measuring_unit->DefaultValue;
        $row['unit_price'] = $this->unit_price->DefaultValue;
        $row['selling_price'] = $this->selling_price->DefaultValue;
        $row['amount_paid'] = $this->amount_paid->DefaultValue;
        $row['invoice_attachment'] = $this->invoice_attachment->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // batch_number
        $this->batch_number->RowCssClass = "row";

        // supplier_id
        $this->supplier_id->RowCssClass = "row";

        // category_id
        $this->category_id->RowCssClass = "row";

        // subcategory_id
        $this->subcategory_id->RowCssClass = "row";

        // item_title
        $this->item_title->RowCssClass = "row";

        // quantity
        $this->quantity->RowCssClass = "row";

        // measuring_unit
        $this->measuring_unit->RowCssClass = "row";

        // unit_price
        $this->unit_price->RowCssClass = "row";

        // selling_price
        $this->selling_price->RowCssClass = "row";

        // amount_paid
        $this->amount_paid->RowCssClass = "row";

        // invoice_attachment
        $this->invoice_attachment->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // batch_number
            $this->batch_number->ViewValue = $this->batch_number->CurrentValue;

            // supplier_id
            $curVal = strval($this->supplier_id->CurrentValue);
            if ($curVal != "") {
                $this->supplier_id->ViewValue = $this->supplier_id->lookupCacheOption($curVal);
                if ($this->supplier_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->supplier_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->supplier_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->supplier_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->supplier_id->Lookup->renderViewRow($rswrk[0]);
                        $this->supplier_id->ViewValue = $this->supplier_id->displayValue($arwrk);
                    } else {
                        $this->supplier_id->ViewValue = FormatNumber($this->supplier_id->CurrentValue, $this->supplier_id->formatPattern());
                    }
                }
            } else {
                $this->supplier_id->ViewValue = null;
            }

            // category_id
            $curVal = strval($this->category_id->CurrentValue);
            if ($curVal != "") {
                $this->category_id->ViewValue = $this->category_id->lookupCacheOption($curVal);
                if ($this->category_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->category_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->category_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->category_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->category_id->Lookup->renderViewRow($rswrk[0]);
                        $this->category_id->ViewValue = $this->category_id->displayValue($arwrk);
                    } else {
                        $this->category_id->ViewValue = FormatNumber($this->category_id->CurrentValue, $this->category_id->formatPattern());
                    }
                }
            } else {
                $this->category_id->ViewValue = null;
            }

            // subcategory_id
            $curVal = strval($this->subcategory_id->CurrentValue);
            if ($curVal != "") {
                $this->subcategory_id->ViewValue = $this->subcategory_id->lookupCacheOption($curVal);
                if ($this->subcategory_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->subcategory_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->subcategory_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->subcategory_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->subcategory_id->Lookup->renderViewRow($rswrk[0]);
                        $this->subcategory_id->ViewValue = $this->subcategory_id->displayValue($arwrk);
                    } else {
                        $this->subcategory_id->ViewValue = FormatNumber($this->subcategory_id->CurrentValue, $this->subcategory_id->formatPattern());
                    }
                }
            } else {
                $this->subcategory_id->ViewValue = null;
            }

            // item_title
            $this->item_title->ViewValue = $this->item_title->CurrentValue;

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());

            // measuring_unit
            if (strval($this->measuring_unit->CurrentValue) != "") {
                $this->measuring_unit->ViewValue = $this->measuring_unit->optionCaption($this->measuring_unit->CurrentValue);
            } else {
                $this->measuring_unit->ViewValue = null;
            }

            // unit_price
            $this->unit_price->ViewValue = $this->unit_price->CurrentValue;
            $this->unit_price->ViewValue = FormatNumber($this->unit_price->ViewValue, $this->unit_price->formatPattern());

            // selling_price
            $this->selling_price->ViewValue = $this->selling_price->CurrentValue;
            $this->selling_price->ViewValue = FormatNumber($this->selling_price->ViewValue, $this->selling_price->formatPattern());

            // amount_paid
            $this->amount_paid->ViewValue = $this->amount_paid->CurrentValue;
            $this->amount_paid->ViewValue = FormatNumber($this->amount_paid->ViewValue, $this->amount_paid->formatPattern());

            // invoice_attachment
            if (!EmptyValue($this->invoice_attachment->Upload->DbValue)) {
                $this->invoice_attachment->ViewValue = $this->id->CurrentValue;
                $this->invoice_attachment->IsBlobImage = IsImageFile(ContentExtension($this->invoice_attachment->Upload->DbValue));
            } else {
                $this->invoice_attachment->ViewValue = "";
            }

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // id
            $this->id->HrefValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // category_id
            $this->category_id->HrefValue = "";

            // subcategory_id
            $this->subcategory_id->HrefValue = "";

            // item_title
            $this->item_title->HrefValue = "";

            // quantity
            $this->quantity->HrefValue = "";

            // measuring_unit
            $this->measuring_unit->HrefValue = "";

            // unit_price
            $this->unit_price->HrefValue = "";

            // selling_price
            $this->selling_price->HrefValue = "";

            // amount_paid
            $this->amount_paid->HrefValue = "";

            // invoice_attachment
            if (!empty($this->invoice_attachment->Upload->DbValue)) {
                $this->invoice_attachment->HrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
                $this->invoice_attachment->LinkAttrs["target"] = "";
                if ($this->invoice_attachment->IsBlobImage && empty($this->invoice_attachment->LinkAttrs["target"])) {
                    $this->invoice_attachment->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->invoice_attachment->HrefValue = FullUrl($this->invoice_attachment->HrefValue, "href");
                }
            } else {
                $this->invoice_attachment->HrefValue = "";
            }
            $this->invoice_attachment->ExportHrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
        } elseif ($this->RowType == RowType::EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditValue = $this->id->CurrentValue;

            // batch_number
            $this->batch_number->setupEditAttributes();
            if (!$this->batch_number->Raw) {
                $this->batch_number->CurrentValue = HtmlDecode($this->batch_number->CurrentValue);
            }
            $this->batch_number->EditValue = HtmlEncode($this->batch_number->CurrentValue);
            $this->batch_number->PlaceHolder = RemoveHtml($this->batch_number->caption());

            // supplier_id
            $this->supplier_id->setupEditAttributes();
            $curVal = trim(strval($this->supplier_id->CurrentValue));
            if ($curVal != "") {
                $this->supplier_id->ViewValue = $this->supplier_id->lookupCacheOption($curVal);
            } else {
                $this->supplier_id->ViewValue = $this->supplier_id->Lookup !== null && is_array($this->supplier_id->lookupOptions()) && count($this->supplier_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->supplier_id->ViewValue !== null) { // Load from cache
                $this->supplier_id->EditValue = array_values($this->supplier_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->supplier_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->supplier_id->CurrentValue, $this->supplier_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->supplier_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->supplier_id->EditValue = $arwrk;
            }
            $this->supplier_id->PlaceHolder = RemoveHtml($this->supplier_id->caption());

            // category_id
            $this->category_id->setupEditAttributes();
            $curVal = trim(strval($this->category_id->CurrentValue));
            if ($curVal != "") {
                $this->category_id->ViewValue = $this->category_id->lookupCacheOption($curVal);
            } else {
                $this->category_id->ViewValue = $this->category_id->Lookup !== null && is_array($this->category_id->lookupOptions()) && count($this->category_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->category_id->ViewValue !== null) { // Load from cache
                $this->category_id->EditValue = array_values($this->category_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->category_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->category_id->CurrentValue, $this->category_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->category_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->category_id->EditValue = $arwrk;
            }
            $this->category_id->PlaceHolder = RemoveHtml($this->category_id->caption());

            // subcategory_id
            $this->subcategory_id->setupEditAttributes();
            $curVal = trim(strval($this->subcategory_id->CurrentValue));
            if ($curVal != "") {
                $this->subcategory_id->ViewValue = $this->subcategory_id->lookupCacheOption($curVal);
            } else {
                $this->subcategory_id->ViewValue = $this->subcategory_id->Lookup !== null && is_array($this->subcategory_id->lookupOptions()) && count($this->subcategory_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->subcategory_id->ViewValue !== null) { // Load from cache
                $this->subcategory_id->EditValue = array_values($this->subcategory_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->subcategory_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->subcategory_id->CurrentValue, $this->subcategory_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->subcategory_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->subcategory_id->EditValue = $arwrk;
            }
            $this->subcategory_id->PlaceHolder = RemoveHtml($this->subcategory_id->caption());

            // item_title
            $this->item_title->setupEditAttributes();
            if (!$this->item_title->Raw) {
                $this->item_title->CurrentValue = HtmlDecode($this->item_title->CurrentValue);
            }
            $this->item_title->EditValue = HtmlEncode($this->item_title->CurrentValue);
            $this->item_title->PlaceHolder = RemoveHtml($this->item_title->caption());

            // quantity
            $this->quantity->setupEditAttributes();
            $this->quantity->EditValue = $this->quantity->CurrentValue;
            $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
            if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
                $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
            }

            // measuring_unit
            $this->measuring_unit->setupEditAttributes();
            $this->measuring_unit->EditValue = $this->measuring_unit->options(true);
            $this->measuring_unit->PlaceHolder = RemoveHtml($this->measuring_unit->caption());

            // unit_price
            $this->unit_price->setupEditAttributes();
            $this->unit_price->EditValue = $this->unit_price->CurrentValue;
            $this->unit_price->PlaceHolder = RemoveHtml($this->unit_price->caption());
            if (strval($this->unit_price->EditValue) != "" && is_numeric($this->unit_price->EditValue)) {
                $this->unit_price->EditValue = FormatNumber($this->unit_price->EditValue, null);
            }

            // selling_price
            $this->selling_price->setupEditAttributes();
            $this->selling_price->EditValue = $this->selling_price->CurrentValue;
            $this->selling_price->PlaceHolder = RemoveHtml($this->selling_price->caption());
            if (strval($this->selling_price->EditValue) != "" && is_numeric($this->selling_price->EditValue)) {
                $this->selling_price->EditValue = FormatNumber($this->selling_price->EditValue, null);
            }

            // amount_paid
            $this->amount_paid->setupEditAttributes();
            $this->amount_paid->EditValue = $this->amount_paid->CurrentValue;
            $this->amount_paid->PlaceHolder = RemoveHtml($this->amount_paid->caption());
            if (strval($this->amount_paid->EditValue) != "" && is_numeric($this->amount_paid->EditValue)) {
                $this->amount_paid->EditValue = FormatNumber($this->amount_paid->EditValue, null);
            }

            // invoice_attachment
            $this->invoice_attachment->setupEditAttributes();
            if (!EmptyValue($this->invoice_attachment->Upload->DbValue)) {
                $this->invoice_attachment->EditValue = $this->id->CurrentValue;
                $this->invoice_attachment->IsBlobImage = IsImageFile(ContentExtension($this->invoice_attachment->Upload->DbValue));
            } else {
                $this->invoice_attachment->EditValue = "";
            }
            if ($this->isShow()) {
                RenderUploadField($this->invoice_attachment);
            }

            // Edit refer script

            // id
            $this->id->HrefValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // category_id
            $this->category_id->HrefValue = "";

            // subcategory_id
            $this->subcategory_id->HrefValue = "";

            // item_title
            $this->item_title->HrefValue = "";

            // quantity
            $this->quantity->HrefValue = "";

            // measuring_unit
            $this->measuring_unit->HrefValue = "";

            // unit_price
            $this->unit_price->HrefValue = "";

            // selling_price
            $this->selling_price->HrefValue = "";

            // amount_paid
            $this->amount_paid->HrefValue = "";

            // invoice_attachment
            if (!empty($this->invoice_attachment->Upload->DbValue)) {
                $this->invoice_attachment->HrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
                $this->invoice_attachment->LinkAttrs["target"] = "";
                if ($this->invoice_attachment->IsBlobImage && empty($this->invoice_attachment->LinkAttrs["target"])) {
                    $this->invoice_attachment->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->invoice_attachment->HrefValue = FullUrl($this->invoice_attachment->HrefValue, "href");
                }
            } else {
                $this->invoice_attachment->HrefValue = "";
            }
            $this->invoice_attachment->ExportHrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->id->Visible && $this->id->Required) {
                if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                    $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
                }
            }
            if ($this->batch_number->Visible && $this->batch_number->Required) {
                if (!$this->batch_number->IsDetailKey && EmptyValue($this->batch_number->FormValue)) {
                    $this->batch_number->addErrorMessage(str_replace("%s", $this->batch_number->caption(), $this->batch_number->RequiredErrorMessage));
                }
            }
            if ($this->supplier_id->Visible && $this->supplier_id->Required) {
                if (!$this->supplier_id->IsDetailKey && EmptyValue($this->supplier_id->FormValue)) {
                    $this->supplier_id->addErrorMessage(str_replace("%s", $this->supplier_id->caption(), $this->supplier_id->RequiredErrorMessage));
                }
            }
            if ($this->category_id->Visible && $this->category_id->Required) {
                if (!$this->category_id->IsDetailKey && EmptyValue($this->category_id->FormValue)) {
                    $this->category_id->addErrorMessage(str_replace("%s", $this->category_id->caption(), $this->category_id->RequiredErrorMessage));
                }
            }
            if ($this->subcategory_id->Visible && $this->subcategory_id->Required) {
                if (!$this->subcategory_id->IsDetailKey && EmptyValue($this->subcategory_id->FormValue)) {
                    $this->subcategory_id->addErrorMessage(str_replace("%s", $this->subcategory_id->caption(), $this->subcategory_id->RequiredErrorMessage));
                }
            }
            if ($this->item_title->Visible && $this->item_title->Required) {
                if (!$this->item_title->IsDetailKey && EmptyValue($this->item_title->FormValue)) {
                    $this->item_title->addErrorMessage(str_replace("%s", $this->item_title->caption(), $this->item_title->RequiredErrorMessage));
                }
            }
            if ($this->quantity->Visible && $this->quantity->Required) {
                if (!$this->quantity->IsDetailKey && EmptyValue($this->quantity->FormValue)) {
                    $this->quantity->addErrorMessage(str_replace("%s", $this->quantity->caption(), $this->quantity->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->quantity->FormValue)) {
                $this->quantity->addErrorMessage($this->quantity->getErrorMessage(false));
            }
            if ($this->measuring_unit->Visible && $this->measuring_unit->Required) {
                if (!$this->measuring_unit->IsDetailKey && EmptyValue($this->measuring_unit->FormValue)) {
                    $this->measuring_unit->addErrorMessage(str_replace("%s", $this->measuring_unit->caption(), $this->measuring_unit->RequiredErrorMessage));
                }
            }
            if ($this->unit_price->Visible && $this->unit_price->Required) {
                if (!$this->unit_price->IsDetailKey && EmptyValue($this->unit_price->FormValue)) {
                    $this->unit_price->addErrorMessage(str_replace("%s", $this->unit_price->caption(), $this->unit_price->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->unit_price->FormValue)) {
                $this->unit_price->addErrorMessage($this->unit_price->getErrorMessage(false));
            }
            if ($this->selling_price->Visible && $this->selling_price->Required) {
                if (!$this->selling_price->IsDetailKey && EmptyValue($this->selling_price->FormValue)) {
                    $this->selling_price->addErrorMessage(str_replace("%s", $this->selling_price->caption(), $this->selling_price->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->selling_price->FormValue)) {
                $this->selling_price->addErrorMessage($this->selling_price->getErrorMessage(false));
            }
            if ($this->amount_paid->Visible && $this->amount_paid->Required) {
                if (!$this->amount_paid->IsDetailKey && EmptyValue($this->amount_paid->FormValue)) {
                    $this->amount_paid->addErrorMessage(str_replace("%s", $this->amount_paid->caption(), $this->amount_paid->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->amount_paid->FormValue)) {
                $this->amount_paid->addErrorMessage($this->amount_paid->getErrorMessage(false));
            }
            if ($this->invoice_attachment->Visible && $this->invoice_attachment->Required) {
                if ($this->invoice_attachment->Upload->FileName == "" && !$this->invoice_attachment->Upload->KeepFile) {
                    $this->invoice_attachment->addErrorMessage(str_replace("%s", $this->invoice_attachment->caption(), $this->invoice_attachment->RequiredErrorMessage));
                }
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Load old values
            $this->loadDbValues($rsold);
        }

        // Get new row
        $rsnew = $this->getEditRow($rsold);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    /**
     * Get edit row
     *
     * @return array
     */
    protected function getEditRow($rsold)
    {
        global $Security;
        $rsnew = [];

        // batch_number
        $this->batch_number->setDbValueDef($rsnew, $this->batch_number->CurrentValue, $this->batch_number->ReadOnly);

        // supplier_id
        $this->supplier_id->setDbValueDef($rsnew, $this->supplier_id->CurrentValue, $this->supplier_id->ReadOnly);

        // category_id
        $this->category_id->setDbValueDef($rsnew, $this->category_id->CurrentValue, $this->category_id->ReadOnly);

        // subcategory_id
        $this->subcategory_id->setDbValueDef($rsnew, $this->subcategory_id->CurrentValue, $this->subcategory_id->ReadOnly);

        // item_title
        $this->item_title->setDbValueDef($rsnew, $this->item_title->CurrentValue, $this->item_title->ReadOnly);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, $this->quantity->ReadOnly);

        // measuring_unit
        $this->measuring_unit->setDbValueDef($rsnew, $this->measuring_unit->CurrentValue, $this->measuring_unit->ReadOnly);

        // unit_price
        $this->unit_price->setDbValueDef($rsnew, $this->unit_price->CurrentValue, $this->unit_price->ReadOnly);

        // selling_price
        $this->selling_price->setDbValueDef($rsnew, $this->selling_price->CurrentValue, $this->selling_price->ReadOnly);

        // amount_paid
        $this->amount_paid->setDbValueDef($rsnew, $this->amount_paid->CurrentValue, $this->amount_paid->ReadOnly);

        // invoice_attachment
        if ($this->invoice_attachment->Visible && !$this->invoice_attachment->ReadOnly && !$this->invoice_attachment->Upload->KeepFile) {
            if ($this->invoice_attachment->Upload->Value === null) {
                $rsnew['invoice_attachment'] = null;
            } else {
                $rsnew['invoice_attachment'] = $this->invoice_attachment->Upload->Value;
            }
        }
        return $rsnew;
    }

    /**
     * Restore edit form from row
     * @param array $row Row
     */
    protected function restoreEditFormFromRow($row)
    {
        if (isset($row['batch_number'])) { // batch_number
            $this->batch_number->CurrentValue = $row['batch_number'];
        }
        if (isset($row['supplier_id'])) { // supplier_id
            $this->supplier_id->CurrentValue = $row['supplier_id'];
        }
        if (isset($row['category_id'])) { // category_id
            $this->category_id->CurrentValue = $row['category_id'];
        }
        if (isset($row['subcategory_id'])) { // subcategory_id
            $this->subcategory_id->CurrentValue = $row['subcategory_id'];
        }
        if (isset($row['item_title'])) { // item_title
            $this->item_title->CurrentValue = $row['item_title'];
        }
        if (isset($row['quantity'])) { // quantity
            $this->quantity->CurrentValue = $row['quantity'];
        }
        if (isset($row['measuring_unit'])) { // measuring_unit
            $this->measuring_unit->CurrentValue = $row['measuring_unit'];
        }
        if (isset($row['unit_price'])) { // unit_price
            $this->unit_price->CurrentValue = $row['unit_price'];
        }
        if (isset($row['selling_price'])) { // selling_price
            $this->selling_price->CurrentValue = $row['selling_price'];
        }
        if (isset($row['amount_paid'])) { // amount_paid
            $this->amount_paid->CurrentValue = $row['amount_paid'];
        }
        if (isset($row['invoice_attachment'])) { // invoice_attachment
            $this->invoice_attachment->CurrentValue = $row['invoice_attachment'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("itempurchaseslist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_supplier_id":
                    break;
                case "x_category_id":
                    break;
                case "x_subcategory_id":
                    break;
                case "x_measuring_unit":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}