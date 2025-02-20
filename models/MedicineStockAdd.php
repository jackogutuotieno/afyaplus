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
class MedicineStockAdd extends MedicineStock
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "MedicineStockAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "medicinestockadd";

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

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
        $this->id->Visible = false;
        $this->supplier_id->setVisibility();
        $this->brand_id->setVisibility();
        $this->batch_number->setVisibility();
        $this->quantity->setVisibility();
        $this->quantity_left->Visible = false;
        $this->measuring_unit->setVisibility();
        $this->buying_price_per_unit->setVisibility();
        $this->selling_price_per_unit->setVisibility();
        $this->expiry_date->setVisibility();
        $this->stock_status->Visible = false;
        $this->expiry_status->Visible = false;
        $this->invoice_attachment->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'medicine_stock';
        $this->TableName = 'medicine_stock';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (medicine_stock)
        if (!isset($GLOBALS["medicine_stock"]) || $GLOBALS["medicine_stock"]::class == PROJECT_NAMESPACE . "medicine_stock") {
            $GLOBALS["medicine_stock"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'medicine_stock');
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
                        $result["view"] = SameString($pageName, "medicinestockview"); // If View page, no primary button
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

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
        $this->setupLookupOptions($this->brand_id);
        $this->setupLookupOptions($this->measuring_unit);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("medicinestocklist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "medicinestocklist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "medicinestockview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "medicinestocklist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "medicinestocklist"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
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
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = RowType::ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'supplier_id' first before field var 'x_supplier_id'
        $val = $CurrentForm->hasValue("supplier_id") ? $CurrentForm->getValue("supplier_id") : $CurrentForm->getValue("x_supplier_id");
        if (!$this->supplier_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->supplier_id->Visible = false; // Disable update for API request
            } else {
                $this->supplier_id->setFormValue($val);
            }
        }

        // Check field name 'brand_id' first before field var 'x_brand_id'
        $val = $CurrentForm->hasValue("brand_id") ? $CurrentForm->getValue("brand_id") : $CurrentForm->getValue("x_brand_id");
        if (!$this->brand_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->brand_id->Visible = false; // Disable update for API request
            } else {
                $this->brand_id->setFormValue($val);
            }
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

        // Check field name 'buying_price_per_unit' first before field var 'x_buying_price_per_unit'
        $val = $CurrentForm->hasValue("buying_price_per_unit") ? $CurrentForm->getValue("buying_price_per_unit") : $CurrentForm->getValue("x_buying_price_per_unit");
        if (!$this->buying_price_per_unit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->buying_price_per_unit->Visible = false; // Disable update for API request
            } else {
                $this->buying_price_per_unit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'selling_price_per_unit' first before field var 'x_selling_price_per_unit'
        $val = $CurrentForm->hasValue("selling_price_per_unit") ? $CurrentForm->getValue("selling_price_per_unit") : $CurrentForm->getValue("x_selling_price_per_unit");
        if (!$this->selling_price_per_unit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->selling_price_per_unit->Visible = false; // Disable update for API request
            } else {
                $this->selling_price_per_unit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'expiry_date' first before field var 'x_expiry_date'
        $val = $CurrentForm->hasValue("expiry_date") ? $CurrentForm->getValue("expiry_date") : $CurrentForm->getValue("x_expiry_date");
        if (!$this->expiry_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->expiry_date->Visible = false; // Disable update for API request
            } else {
                $this->expiry_date->setFormValue($val, true, $validate);
            }
            $this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, $this->expiry_date->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->supplier_id->CurrentValue = $this->supplier_id->FormValue;
        $this->brand_id->CurrentValue = $this->brand_id->FormValue;
        $this->batch_number->CurrentValue = $this->batch_number->FormValue;
        $this->quantity->CurrentValue = $this->quantity->FormValue;
        $this->measuring_unit->CurrentValue = $this->measuring_unit->FormValue;
        $this->buying_price_per_unit->CurrentValue = $this->buying_price_per_unit->FormValue;
        $this->selling_price_per_unit->CurrentValue = $this->selling_price_per_unit->FormValue;
        $this->expiry_date->CurrentValue = $this->expiry_date->FormValue;
        $this->expiry_date->CurrentValue = UnFormatDateTime($this->expiry_date->CurrentValue, $this->expiry_date->formatPattern());
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
        $this->supplier_id->setDbValue($row['supplier_id']);
        $this->brand_id->setDbValue($row['brand_id']);
        $this->batch_number->setDbValue($row['batch_number']);
        $this->quantity->setDbValue($row['quantity']);
        $this->quantity_left->setDbValue($row['quantity_left']);
        $this->measuring_unit->setDbValue($row['measuring_unit']);
        $this->buying_price_per_unit->setDbValue($row['buying_price_per_unit']);
        $this->selling_price_per_unit->setDbValue($row['selling_price_per_unit']);
        $this->expiry_date->setDbValue($row['expiry_date']);
        $this->stock_status->setDbValue($row['stock_status']);
        $this->expiry_status->setDbValue($row['expiry_status']);
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
        $row['supplier_id'] = $this->supplier_id->DefaultValue;
        $row['brand_id'] = $this->brand_id->DefaultValue;
        $row['batch_number'] = $this->batch_number->DefaultValue;
        $row['quantity'] = $this->quantity->DefaultValue;
        $row['quantity_left'] = $this->quantity_left->DefaultValue;
        $row['measuring_unit'] = $this->measuring_unit->DefaultValue;
        $row['buying_price_per_unit'] = $this->buying_price_per_unit->DefaultValue;
        $row['selling_price_per_unit'] = $this->selling_price_per_unit->DefaultValue;
        $row['expiry_date'] = $this->expiry_date->DefaultValue;
        $row['stock_status'] = $this->stock_status->DefaultValue;
        $row['expiry_status'] = $this->expiry_status->DefaultValue;
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

        // supplier_id
        $this->supplier_id->RowCssClass = "row";

        // brand_id
        $this->brand_id->RowCssClass = "row";

        // batch_number
        $this->batch_number->RowCssClass = "row";

        // quantity
        $this->quantity->RowCssClass = "row";

        // quantity_left
        $this->quantity_left->RowCssClass = "row";

        // measuring_unit
        $this->measuring_unit->RowCssClass = "row";

        // buying_price_per_unit
        $this->buying_price_per_unit->RowCssClass = "row";

        // selling_price_per_unit
        $this->selling_price_per_unit->RowCssClass = "row";

        // expiry_date
        $this->expiry_date->RowCssClass = "row";

        // stock_status
        $this->stock_status->RowCssClass = "row";

        // expiry_status
        $this->expiry_status->RowCssClass = "row";

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

            // brand_id
            $curVal = strval($this->brand_id->CurrentValue);
            if ($curVal != "") {
                $this->brand_id->ViewValue = $this->brand_id->lookupCacheOption($curVal);
                if ($this->brand_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->brand_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->brand_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->brand_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->brand_id->Lookup->renderViewRow($rswrk[0]);
                        $this->brand_id->ViewValue = $this->brand_id->displayValue($arwrk);
                    } else {
                        $this->brand_id->ViewValue = FormatNumber($this->brand_id->CurrentValue, $this->brand_id->formatPattern());
                    }
                }
            } else {
                $this->brand_id->ViewValue = null;
            }

            // batch_number
            $this->batch_number->ViewValue = $this->batch_number->CurrentValue;

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());

            // quantity_left
            $this->quantity_left->ViewValue = $this->quantity_left->CurrentValue;
            $this->quantity_left->ViewValue = FormatNumber($this->quantity_left->ViewValue, $this->quantity_left->formatPattern());

            // measuring_unit
            $this->measuring_unit->ViewValue = $this->measuring_unit->CurrentValue;

            // buying_price_per_unit
            $this->buying_price_per_unit->ViewValue = $this->buying_price_per_unit->CurrentValue;
            $this->buying_price_per_unit->ViewValue = FormatNumber($this->buying_price_per_unit->ViewValue, $this->buying_price_per_unit->formatPattern());

            // selling_price_per_unit
            $this->selling_price_per_unit->ViewValue = $this->selling_price_per_unit->CurrentValue;
            $this->selling_price_per_unit->ViewValue = FormatNumber($this->selling_price_per_unit->ViewValue, $this->selling_price_per_unit->formatPattern());

            // expiry_date
            $this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
            $this->expiry_date->ViewValue = FormatDateTime($this->expiry_date->ViewValue, $this->expiry_date->formatPattern());

            // stock_status
            $this->stock_status->ViewValue = $this->stock_status->CurrentValue;

            // expiry_status
            $this->expiry_status->ViewValue = $this->expiry_status->CurrentValue;

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

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // brand_id
            $this->brand_id->HrefValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";

            // quantity
            $this->quantity->HrefValue = "";

            // measuring_unit
            $this->measuring_unit->HrefValue = "";

            // buying_price_per_unit
            $this->buying_price_per_unit->HrefValue = "";

            // selling_price_per_unit
            $this->selling_price_per_unit->HrefValue = "";

            // expiry_date
            $this->expiry_date->HrefValue = "";

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
        } elseif ($this->RowType == RowType::ADD) {
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

            // brand_id
            $this->brand_id->setupEditAttributes();
            $curVal = trim(strval($this->brand_id->CurrentValue));
            if ($curVal != "") {
                $this->brand_id->ViewValue = $this->brand_id->lookupCacheOption($curVal);
            } else {
                $this->brand_id->ViewValue = $this->brand_id->Lookup !== null && is_array($this->brand_id->lookupOptions()) && count($this->brand_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->brand_id->ViewValue !== null) { // Load from cache
                $this->brand_id->EditValue = array_values($this->brand_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->brand_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->brand_id->CurrentValue, $this->brand_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->brand_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->brand_id->EditValue = $arwrk;
            }
            $this->brand_id->PlaceHolder = RemoveHtml($this->brand_id->caption());

            // batch_number
            $this->batch_number->setupEditAttributes();
            if (!$this->batch_number->Raw) {
                $this->batch_number->CurrentValue = HtmlDecode($this->batch_number->CurrentValue);
            }
            $this->batch_number->EditValue = HtmlEncode($this->batch_number->CurrentValue);
            $this->batch_number->PlaceHolder = RemoveHtml($this->batch_number->caption());

            // quantity
            $this->quantity->setupEditAttributes();
            $this->quantity->EditValue = $this->quantity->CurrentValue;
            $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
            if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
                $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
            }

            // measuring_unit
            $this->measuring_unit->setupEditAttributes();
            if (!$this->measuring_unit->Raw) {
                $this->measuring_unit->CurrentValue = HtmlDecode($this->measuring_unit->CurrentValue);
            }
            $this->measuring_unit->EditValue = HtmlEncode($this->measuring_unit->CurrentValue);
            $this->measuring_unit->PlaceHolder = RemoveHtml($this->measuring_unit->caption());

            // buying_price_per_unit
            $this->buying_price_per_unit->setupEditAttributes();
            $this->buying_price_per_unit->EditValue = $this->buying_price_per_unit->CurrentValue;
            $this->buying_price_per_unit->PlaceHolder = RemoveHtml($this->buying_price_per_unit->caption());
            if (strval($this->buying_price_per_unit->EditValue) != "" && is_numeric($this->buying_price_per_unit->EditValue)) {
                $this->buying_price_per_unit->EditValue = FormatNumber($this->buying_price_per_unit->EditValue, null);
            }

            // selling_price_per_unit
            $this->selling_price_per_unit->setupEditAttributes();
            $this->selling_price_per_unit->EditValue = $this->selling_price_per_unit->CurrentValue;
            $this->selling_price_per_unit->PlaceHolder = RemoveHtml($this->selling_price_per_unit->caption());
            if (strval($this->selling_price_per_unit->EditValue) != "" && is_numeric($this->selling_price_per_unit->EditValue)) {
                $this->selling_price_per_unit->EditValue = FormatNumber($this->selling_price_per_unit->EditValue, null);
            }

            // expiry_date
            $this->expiry_date->setupEditAttributes();
            $this->expiry_date->EditValue = HtmlEncode(FormatDateTime($this->expiry_date->CurrentValue, $this->expiry_date->formatPattern()));
            $this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

            // invoice_attachment
            $this->invoice_attachment->setupEditAttributes();
            if (!EmptyValue($this->invoice_attachment->Upload->DbValue)) {
                $this->invoice_attachment->EditValue = $this->id->CurrentValue;
                $this->invoice_attachment->IsBlobImage = IsImageFile(ContentExtension($this->invoice_attachment->Upload->DbValue));
            } else {
                $this->invoice_attachment->EditValue = "";
            }
            if (!Config("CREATE_UPLOAD_FILE_ON_COPY")) {
                $this->invoice_attachment->Upload->DbValue = null;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->invoice_attachment);
            }

            // Add refer script

            // supplier_id
            $this->supplier_id->HrefValue = "";

            // brand_id
            $this->brand_id->HrefValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";

            // quantity
            $this->quantity->HrefValue = "";

            // measuring_unit
            $this->measuring_unit->HrefValue = "";

            // buying_price_per_unit
            $this->buying_price_per_unit->HrefValue = "";

            // selling_price_per_unit
            $this->selling_price_per_unit->HrefValue = "";

            // expiry_date
            $this->expiry_date->HrefValue = "";

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
            if ($this->supplier_id->Visible && $this->supplier_id->Required) {
                if (!$this->supplier_id->IsDetailKey && EmptyValue($this->supplier_id->FormValue)) {
                    $this->supplier_id->addErrorMessage(str_replace("%s", $this->supplier_id->caption(), $this->supplier_id->RequiredErrorMessage));
                }
            }
            if ($this->brand_id->Visible && $this->brand_id->Required) {
                if (!$this->brand_id->IsDetailKey && EmptyValue($this->brand_id->FormValue)) {
                    $this->brand_id->addErrorMessage(str_replace("%s", $this->brand_id->caption(), $this->brand_id->RequiredErrorMessage));
                }
            }
            if ($this->batch_number->Visible && $this->batch_number->Required) {
                if (!$this->batch_number->IsDetailKey && EmptyValue($this->batch_number->FormValue)) {
                    $this->batch_number->addErrorMessage(str_replace("%s", $this->batch_number->caption(), $this->batch_number->RequiredErrorMessage));
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
            if ($this->buying_price_per_unit->Visible && $this->buying_price_per_unit->Required) {
                if (!$this->buying_price_per_unit->IsDetailKey && EmptyValue($this->buying_price_per_unit->FormValue)) {
                    $this->buying_price_per_unit->addErrorMessage(str_replace("%s", $this->buying_price_per_unit->caption(), $this->buying_price_per_unit->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->buying_price_per_unit->FormValue)) {
                $this->buying_price_per_unit->addErrorMessage($this->buying_price_per_unit->getErrorMessage(false));
            }
            if ($this->selling_price_per_unit->Visible && $this->selling_price_per_unit->Required) {
                if (!$this->selling_price_per_unit->IsDetailKey && EmptyValue($this->selling_price_per_unit->FormValue)) {
                    $this->selling_price_per_unit->addErrorMessage(str_replace("%s", $this->selling_price_per_unit->caption(), $this->selling_price_per_unit->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->selling_price_per_unit->FormValue)) {
                $this->selling_price_per_unit->addErrorMessage($this->selling_price_per_unit->getErrorMessage(false));
            }
            if ($this->expiry_date->Visible && $this->expiry_date->Required) {
                if (!$this->expiry_date->IsDetailKey && EmptyValue($this->expiry_date->FormValue)) {
                    $this->expiry_date->addErrorMessage(str_replace("%s", $this->expiry_date->caption(), $this->expiry_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->expiry_date->FormValue, $this->expiry_date->formatPattern())) {
                $this->expiry_date->addErrorMessage($this->expiry_date->getErrorMessage(false));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Get new row
        $rsnew = $this->getAddRow();

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
            if ($this->SendEmail) {
                $this->sendEmailOnAdd($rsnew);
            }
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow()
    {
        global $Security;
        $rsnew = [];

        // supplier_id
        $this->supplier_id->setDbValueDef($rsnew, $this->supplier_id->CurrentValue, false);

        // brand_id
        $this->brand_id->setDbValueDef($rsnew, $this->brand_id->CurrentValue, false);

        // batch_number
        $this->batch_number->setDbValueDef($rsnew, $this->batch_number->CurrentValue, false);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, false);

        // measuring_unit
        $this->measuring_unit->setDbValueDef($rsnew, $this->measuring_unit->CurrentValue, false);

        // buying_price_per_unit
        $this->buying_price_per_unit->setDbValueDef($rsnew, $this->buying_price_per_unit->CurrentValue, false);

        // selling_price_per_unit
        $this->selling_price_per_unit->setDbValueDef($rsnew, $this->selling_price_per_unit->CurrentValue, false);

        // expiry_date
        $this->expiry_date->setDbValueDef($rsnew, UnFormatDateTime($this->expiry_date->CurrentValue, $this->expiry_date->formatPattern()), false);

        // invoice_attachment
        if ($this->invoice_attachment->Visible && !$this->invoice_attachment->Upload->KeepFile) {
            if ($this->invoice_attachment->Upload->Value === null) {
                $rsnew['invoice_attachment'] = null;
            } else {
                $rsnew['invoice_attachment'] = $this->invoice_attachment->Upload->Value;
            }
        }
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['supplier_id'])) { // supplier_id
            $this->supplier_id->setFormValue($row['supplier_id']);
        }
        if (isset($row['brand_id'])) { // brand_id
            $this->brand_id->setFormValue($row['brand_id']);
        }
        if (isset($row['batch_number'])) { // batch_number
            $this->batch_number->setFormValue($row['batch_number']);
        }
        if (isset($row['quantity'])) { // quantity
            $this->quantity->setFormValue($row['quantity']);
        }
        if (isset($row['measuring_unit'])) { // measuring_unit
            $this->measuring_unit->setFormValue($row['measuring_unit']);
        }
        if (isset($row['buying_price_per_unit'])) { // buying_price_per_unit
            $this->buying_price_per_unit->setFormValue($row['buying_price_per_unit']);
        }
        if (isset($row['selling_price_per_unit'])) { // selling_price_per_unit
            $this->selling_price_per_unit->setFormValue($row['selling_price_per_unit']);
        }
        if (isset($row['expiry_date'])) { // expiry_date
            $this->expiry_date->setFormValue($row['expiry_date']);
        }
        if (isset($row['invoice_attachment'])) { // invoice_attachment
            $this->invoice_attachment->setFormValue($row['invoice_attachment']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("medicinestocklist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_brand_id":
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
