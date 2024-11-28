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
use Closure;

/**
 * Page class
 */
class PrescriptionDetailsAdd extends PrescriptionDetails
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PrescriptionDetailsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "prescriptiondetailsadd";

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
        $this->prescription_id->setVisibility();
        $this->medicine_stock_id->setVisibility();
        $this->dose_quantity->setVisibility();
        $this->dose_type->setVisibility();
        $this->dose_interval->setVisibility();
        $this->number_of_days->setVisibility();
        $this->method->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'prescription_details';
        $this->TableName = 'prescription_details';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (prescription_details)
        if (!isset($GLOBALS["prescription_details"]) || $GLOBALS["prescription_details"]::class == PROJECT_NAMESPACE . "prescription_details") {
            $GLOBALS["prescription_details"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'prescription_details');
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
                        $result["view"] = SameString($pageName, "prescriptiondetailsview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->medicine_stock_id);
        $this->setupLookupOptions($this->dose_type);
        $this->setupLookupOptions($this->dose_interval);
        $this->setupLookupOptions($this->number_of_days);
        $this->setupLookupOptions($this->method);

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

        // Set up master/detail parameters
        // NOTE: Must be after loadOldRecord to prevent master key values being overwritten
        $this->setupMasterParms();

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
                    $this->terminate("prescriptiondetailslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "prescriptiondetailslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "prescriptiondetailsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions && !$this->getCurrentMasterTable()) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "prescriptiondetailslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "prescriptiondetailslist"; // Return list page content
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

        // Check field name 'prescription_id' first before field var 'x_prescription_id'
        $val = $CurrentForm->hasValue("prescription_id") ? $CurrentForm->getValue("prescription_id") : $CurrentForm->getValue("x_prescription_id");
        if (!$this->prescription_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->prescription_id->Visible = false; // Disable update for API request
            } else {
                $this->prescription_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'medicine_stock_id' first before field var 'x_medicine_stock_id'
        $val = $CurrentForm->hasValue("medicine_stock_id") ? $CurrentForm->getValue("medicine_stock_id") : $CurrentForm->getValue("x_medicine_stock_id");
        if (!$this->medicine_stock_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->medicine_stock_id->Visible = false; // Disable update for API request
            } else {
                $this->medicine_stock_id->setFormValue($val);
            }
        }

        // Check field name 'dose_quantity' first before field var 'x_dose_quantity'
        $val = $CurrentForm->hasValue("dose_quantity") ? $CurrentForm->getValue("dose_quantity") : $CurrentForm->getValue("x_dose_quantity");
        if (!$this->dose_quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dose_quantity->Visible = false; // Disable update for API request
            } else {
                $this->dose_quantity->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'dose_type' first before field var 'x_dose_type'
        $val = $CurrentForm->hasValue("dose_type") ? $CurrentForm->getValue("dose_type") : $CurrentForm->getValue("x_dose_type");
        if (!$this->dose_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dose_type->Visible = false; // Disable update for API request
            } else {
                $this->dose_type->setFormValue($val);
            }
        }

        // Check field name 'dose_interval' first before field var 'x_dose_interval'
        $val = $CurrentForm->hasValue("dose_interval") ? $CurrentForm->getValue("dose_interval") : $CurrentForm->getValue("x_dose_interval");
        if (!$this->dose_interval->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dose_interval->Visible = false; // Disable update for API request
            } else {
                $this->dose_interval->setFormValue($val);
            }
        }

        // Check field name 'number_of_days' first before field var 'x_number_of_days'
        $val = $CurrentForm->hasValue("number_of_days") ? $CurrentForm->getValue("number_of_days") : $CurrentForm->getValue("x_number_of_days");
        if (!$this->number_of_days->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->number_of_days->Visible = false; // Disable update for API request
            } else {
                $this->number_of_days->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'method' first before field var 'x_method'
        $val = $CurrentForm->hasValue("method") ? $CurrentForm->getValue("method") : $CurrentForm->getValue("x_method");
        if (!$this->method->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->method->Visible = false; // Disable update for API request
            } else {
                $this->method->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->prescription_id->CurrentValue = $this->prescription_id->FormValue;
        $this->medicine_stock_id->CurrentValue = $this->medicine_stock_id->FormValue;
        $this->dose_quantity->CurrentValue = $this->dose_quantity->FormValue;
        $this->dose_type->CurrentValue = $this->dose_type->FormValue;
        $this->dose_interval->CurrentValue = $this->dose_interval->FormValue;
        $this->number_of_days->CurrentValue = $this->number_of_days->FormValue;
        $this->method->CurrentValue = $this->method->FormValue;
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
        $this->prescription_id->setDbValue($row['prescription_id']);
        $this->medicine_stock_id->setDbValue($row['medicine_stock_id']);
        $this->dose_quantity->setDbValue($row['dose_quantity']);
        $this->dose_type->setDbValue($row['dose_type']);
        $this->dose_interval->setDbValue($row['dose_interval']);
        $this->number_of_days->setDbValue($row['number_of_days']);
        $this->method->setDbValue($row['method']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['prescription_id'] = $this->prescription_id->DefaultValue;
        $row['medicine_stock_id'] = $this->medicine_stock_id->DefaultValue;
        $row['dose_quantity'] = $this->dose_quantity->DefaultValue;
        $row['dose_type'] = $this->dose_type->DefaultValue;
        $row['dose_interval'] = $this->dose_interval->DefaultValue;
        $row['number_of_days'] = $this->number_of_days->DefaultValue;
        $row['method'] = $this->method->DefaultValue;
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

        // prescription_id
        $this->prescription_id->RowCssClass = "row";

        // medicine_stock_id
        $this->medicine_stock_id->RowCssClass = "row";

        // dose_quantity
        $this->dose_quantity->RowCssClass = "row";

        // dose_type
        $this->dose_type->RowCssClass = "row";

        // dose_interval
        $this->dose_interval->RowCssClass = "row";

        // number_of_days
        $this->number_of_days->RowCssClass = "row";

        // method
        $this->method->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // prescription_id
            $this->prescription_id->ViewValue = $this->prescription_id->CurrentValue;
            $this->prescription_id->ViewValue = FormatNumber($this->prescription_id->ViewValue, $this->prescription_id->formatPattern());

            // medicine_stock_id
            $curVal = strval($this->medicine_stock_id->CurrentValue);
            if ($curVal != "") {
                $this->medicine_stock_id->ViewValue = $this->medicine_stock_id->lookupCacheOption($curVal);
                if ($this->medicine_stock_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->medicine_stock_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->medicine_stock_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->medicine_stock_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->medicine_stock_id->Lookup->renderViewRow($rswrk[0]);
                        $this->medicine_stock_id->ViewValue = $this->medicine_stock_id->displayValue($arwrk);
                    } else {
                        $this->medicine_stock_id->ViewValue = FormatNumber($this->medicine_stock_id->CurrentValue, $this->medicine_stock_id->formatPattern());
                    }
                }
            } else {
                $this->medicine_stock_id->ViewValue = null;
            }

            // dose_quantity
            $this->dose_quantity->ViewValue = $this->dose_quantity->CurrentValue;
            $this->dose_quantity->ViewValue = FormatNumber($this->dose_quantity->ViewValue, $this->dose_quantity->formatPattern());

            // dose_type
            if (strval($this->dose_type->CurrentValue) != "") {
                $this->dose_type->ViewValue = $this->dose_type->optionCaption($this->dose_type->CurrentValue);
            } else {
                $this->dose_type->ViewValue = null;
            }

            // dose_interval
            if (strval($this->dose_interval->CurrentValue) != "") {
                $this->dose_interval->ViewValue = $this->dose_interval->optionCaption($this->dose_interval->CurrentValue);
            } else {
                $this->dose_interval->ViewValue = null;
            }

            // number_of_days
            $this->number_of_days->ViewValue = $this->number_of_days->CurrentValue;

            // method
            if (strval($this->method->CurrentValue) != "") {
                $this->method->ViewValue = $this->method->optionCaption($this->method->CurrentValue);
            } else {
                $this->method->ViewValue = null;
            }

            // prescription_id
            $this->prescription_id->HrefValue = "";

            // medicine_stock_id
            $this->medicine_stock_id->HrefValue = "";

            // dose_quantity
            $this->dose_quantity->HrefValue = "";

            // dose_type
            $this->dose_type->HrefValue = "";

            // dose_interval
            $this->dose_interval->HrefValue = "";

            // number_of_days
            $this->number_of_days->HrefValue = "";

            // method
            $this->method->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // prescription_id
            $this->prescription_id->setupEditAttributes();
            if ($this->prescription_id->getSessionValue() != "") {
                $this->prescription_id->CurrentValue = GetForeignKeyValue($this->prescription_id->getSessionValue());
                $this->prescription_id->ViewValue = $this->prescription_id->CurrentValue;
                $this->prescription_id->ViewValue = FormatNumber($this->prescription_id->ViewValue, $this->prescription_id->formatPattern());
            } else {
                $this->prescription_id->EditValue = $this->prescription_id->CurrentValue;
                $this->prescription_id->PlaceHolder = RemoveHtml($this->prescription_id->caption());
                if (strval($this->prescription_id->EditValue) != "" && is_numeric($this->prescription_id->EditValue)) {
                    $this->prescription_id->EditValue = FormatNumber($this->prescription_id->EditValue, null);
                }
            }

            // medicine_stock_id
            $this->medicine_stock_id->setupEditAttributes();
            $curVal = trim(strval($this->medicine_stock_id->CurrentValue));
            if ($curVal != "") {
                $this->medicine_stock_id->ViewValue = $this->medicine_stock_id->lookupCacheOption($curVal);
            } else {
                $this->medicine_stock_id->ViewValue = $this->medicine_stock_id->Lookup !== null && is_array($this->medicine_stock_id->lookupOptions()) && count($this->medicine_stock_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->medicine_stock_id->ViewValue !== null) { // Load from cache
                $this->medicine_stock_id->EditValue = array_values($this->medicine_stock_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->medicine_stock_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->medicine_stock_id->CurrentValue, $this->medicine_stock_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->medicine_stock_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->medicine_stock_id->EditValue = $arwrk;
            }
            $this->medicine_stock_id->PlaceHolder = RemoveHtml($this->medicine_stock_id->caption());

            // dose_quantity
            $this->dose_quantity->setupEditAttributes();
            $this->dose_quantity->EditValue = $this->dose_quantity->CurrentValue;
            $this->dose_quantity->PlaceHolder = RemoveHtml($this->dose_quantity->caption());
            if (strval($this->dose_quantity->EditValue) != "" && is_numeric($this->dose_quantity->EditValue)) {
                $this->dose_quantity->EditValue = FormatNumber($this->dose_quantity->EditValue, null);
            }

            // dose_type
            $this->dose_type->setupEditAttributes();
            $this->dose_type->EditValue = $this->dose_type->options(true);
            $this->dose_type->PlaceHolder = RemoveHtml($this->dose_type->caption());

            // dose_interval
            $this->dose_interval->setupEditAttributes();
            $this->dose_interval->EditValue = $this->dose_interval->options(true);
            $this->dose_interval->PlaceHolder = RemoveHtml($this->dose_interval->caption());

            // number_of_days
            $this->number_of_days->setupEditAttributes();
            $this->number_of_days->EditValue = $this->number_of_days->CurrentValue;
            $this->number_of_days->PlaceHolder = RemoveHtml($this->number_of_days->caption());

            // method
            $this->method->setupEditAttributes();
            $this->method->EditValue = $this->method->options(true);
            $this->method->PlaceHolder = RemoveHtml($this->method->caption());

            // Add refer script

            // prescription_id
            $this->prescription_id->HrefValue = "";

            // medicine_stock_id
            $this->medicine_stock_id->HrefValue = "";

            // dose_quantity
            $this->dose_quantity->HrefValue = "";

            // dose_type
            $this->dose_type->HrefValue = "";

            // dose_interval
            $this->dose_interval->HrefValue = "";

            // number_of_days
            $this->number_of_days->HrefValue = "";

            // method
            $this->method->HrefValue = "";
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
            if ($this->prescription_id->Visible && $this->prescription_id->Required) {
                if (!$this->prescription_id->IsDetailKey && EmptyValue($this->prescription_id->FormValue)) {
                    $this->prescription_id->addErrorMessage(str_replace("%s", $this->prescription_id->caption(), $this->prescription_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->prescription_id->FormValue)) {
                $this->prescription_id->addErrorMessage($this->prescription_id->getErrorMessage(false));
            }
            if ($this->medicine_stock_id->Visible && $this->medicine_stock_id->Required) {
                if (!$this->medicine_stock_id->IsDetailKey && EmptyValue($this->medicine_stock_id->FormValue)) {
                    $this->medicine_stock_id->addErrorMessage(str_replace("%s", $this->medicine_stock_id->caption(), $this->medicine_stock_id->RequiredErrorMessage));
                }
            }
            if ($this->dose_quantity->Visible && $this->dose_quantity->Required) {
                if (!$this->dose_quantity->IsDetailKey && EmptyValue($this->dose_quantity->FormValue)) {
                    $this->dose_quantity->addErrorMessage(str_replace("%s", $this->dose_quantity->caption(), $this->dose_quantity->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->dose_quantity->FormValue)) {
                $this->dose_quantity->addErrorMessage($this->dose_quantity->getErrorMessage(false));
            }
            if ($this->dose_type->Visible && $this->dose_type->Required) {
                if (!$this->dose_type->IsDetailKey && EmptyValue($this->dose_type->FormValue)) {
                    $this->dose_type->addErrorMessage(str_replace("%s", $this->dose_type->caption(), $this->dose_type->RequiredErrorMessage));
                }
            }
            if ($this->dose_interval->Visible && $this->dose_interval->Required) {
                if (!$this->dose_interval->IsDetailKey && EmptyValue($this->dose_interval->FormValue)) {
                    $this->dose_interval->addErrorMessage(str_replace("%s", $this->dose_interval->caption(), $this->dose_interval->RequiredErrorMessage));
                }
            }
            if ($this->number_of_days->Visible && $this->number_of_days->Required) {
                if (!$this->number_of_days->IsDetailKey && EmptyValue($this->number_of_days->FormValue)) {
                    $this->number_of_days->addErrorMessage(str_replace("%s", $this->number_of_days->caption(), $this->number_of_days->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->number_of_days->FormValue)) {
                $this->number_of_days->addErrorMessage($this->number_of_days->getErrorMessage(false));
            }
            if ($this->method->Visible && $this->method->Required) {
                if (!$this->method->IsDetailKey && EmptyValue($this->method->FormValue)) {
                    $this->method->addErrorMessage(str_replace("%s", $this->method->caption(), $this->method->RequiredErrorMessage));
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

        // Check if valid key values for master user
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $detailKeys = [];
            $detailKeys["prescription_id"] = $this->prescription_id->CurrentValue;
            $masterTable = Container("prescriptions");
            $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
            if (!EmptyValue($masterFilter)) {
                $validMasterKey = true;
                if ($rsmaster = $masterTable->loadRs($masterFilter)->fetchAssociative()) {
                    $validMasterKey = $Security->isValidUserID($rsmaster['created_by_user_id']);
                } elseif ($this->getCurrentMasterTable() == "prescriptions") {
                    $validMasterKey = false;
                }
                if (!$validMasterKey) {
                    $masterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedMasterUserID"));
                    $masterUserIdMsg = str_replace("%f", $masterFilter, $masterUserIdMsg);
                    $this->setFailureMessage($masterUserIdMsg);
                    return false;
                }
            }
        }
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

        // prescription_id
        $this->prescription_id->setDbValueDef($rsnew, $this->prescription_id->CurrentValue, false);

        // medicine_stock_id
        $this->medicine_stock_id->setDbValueDef($rsnew, $this->medicine_stock_id->CurrentValue, false);

        // dose_quantity
        $this->dose_quantity->setDbValueDef($rsnew, $this->dose_quantity->CurrentValue, false);

        // dose_type
        $this->dose_type->setDbValueDef($rsnew, $this->dose_type->CurrentValue, false);

        // dose_interval
        $this->dose_interval->setDbValueDef($rsnew, $this->dose_interval->CurrentValue, false);

        // number_of_days
        $this->number_of_days->setDbValueDef($rsnew, $this->number_of_days->CurrentValue, false);

        // method
        $this->method->setDbValueDef($rsnew, $this->method->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['prescription_id'])) { // prescription_id
            $this->prescription_id->setFormValue($row['prescription_id']);
        }
        if (isset($row['medicine_stock_id'])) { // medicine_stock_id
            $this->medicine_stock_id->setFormValue($row['medicine_stock_id']);
        }
        if (isset($row['dose_quantity'])) { // dose_quantity
            $this->dose_quantity->setFormValue($row['dose_quantity']);
        }
        if (isset($row['dose_type'])) { // dose_type
            $this->dose_type->setFormValue($row['dose_type']);
        }
        if (isset($row['dose_interval'])) { // dose_interval
            $this->dose_interval->setFormValue($row['dose_interval']);
        }
        if (isset($row['number_of_days'])) { // number_of_days
            $this->number_of_days->setFormValue($row['number_of_days']);
        }
        if (isset($row['method'])) { // method
            $this->method->setFormValue($row['method']);
        }
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        $foreignKeys = [];
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "prescriptions") {
                $validMaster = true;
                $masterTbl = Container("prescriptions");
                if (($parm = Get("fk_id", Get("prescription_id"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->prescription_id->QueryStringValue = $masterTbl->id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->prescription_id->setSessionValue($this->prescription_id->QueryStringValue);
                    $foreignKeys["prescription_id"] = $this->prescription_id->QueryStringValue;
                    if (!is_numeric($masterTbl->id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "prescriptions") {
                $validMaster = true;
                $masterTbl = Container("prescriptions");
                if (($parm = Post("fk_id", Post("prescription_id"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->prescription_id->FormValue = $masterTbl->id->FormValue;
                    $this->prescription_id->setSessionValue($this->prescription_id->FormValue);
                    $foreignKeys["prescription_id"] = $this->prescription_id->FormValue;
                    if (!is_numeric($masterTbl->id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit() && !$this->isGridUpdate()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "prescriptions") {
                if (!array_key_exists("prescription_id", $foreignKeys)) { // Not current foreign key
                    $this->prescription_id->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("prescriptiondetailslist"), "", $this->TableVar, true);
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
                case "x_medicine_stock_id":
                    break;
                case "x_dose_type":
                    break;
                case "x_dose_interval":
                    break;
                case "x_number_of_days":
                    break;
                case "x_method":
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
