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
class PatientVisitsAdd extends PatientVisits
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PatientVisitsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "patientvisitsadd";

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
        $this->patient_id->setVisibility();
        $this->visit_type_id->setVisibility();
        $this->payment_method_id->setVisibility();
        $this->medical_scheme_id->setVisibility();
        $this->user_role->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
        $this->status->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'patient_visits';
        $this->TableName = 'patient_visits';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (patient_visits)
        if (!isset($GLOBALS["patient_visits"]) || $GLOBALS["patient_visits"]::class == PROJECT_NAMESPACE . "patient_visits") {
            $GLOBALS["patient_visits"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'patient_visits');
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
                        $result["view"] = SameString($pageName, "patientvisitsview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->patient_id);
        $this->setupLookupOptions($this->visit_type_id);
        $this->setupLookupOptions($this->payment_method_id);
        $this->setupLookupOptions($this->medical_scheme_id);

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

        // Set up detail parameters
        $this->setupDetailParms();

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
                    $this->terminate("patientvisitslist"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    if ($this->getCurrentDetailTable() != "") { // Master/detail add
                        $returnUrl = $this->getDetailUrl();
                    } else {
                        $returnUrl = $this->getReturnUrl();
                    }
                    if (GetPageName($returnUrl) == "patientvisitslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "patientvisitsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions && !$this->getCurrentMasterTable()) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "patientvisitslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "patientvisitslist"; // Return list page content
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

                    // Set up detail parameters
                    $this->setupDetailParms();
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

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        if (!$this->patient_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_id->setFormValue($val);
            }
        }

        // Check field name 'visit_type_id' first before field var 'x_visit_type_id'
        $val = $CurrentForm->hasValue("visit_type_id") ? $CurrentForm->getValue("visit_type_id") : $CurrentForm->getValue("x_visit_type_id");
        if (!$this->visit_type_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->visit_type_id->Visible = false; // Disable update for API request
            } else {
                $this->visit_type_id->setFormValue($val);
            }
        }

        // Check field name 'payment_method_id' first before field var 'x_payment_method_id'
        $val = $CurrentForm->hasValue("payment_method_id") ? $CurrentForm->getValue("payment_method_id") : $CurrentForm->getValue("x_payment_method_id");
        if (!$this->payment_method_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->payment_method_id->Visible = false; // Disable update for API request
            } else {
                $this->payment_method_id->setFormValue($val);
            }
        }

        // Check field name 'medical_scheme_id' first before field var 'x_medical_scheme_id'
        $val = $CurrentForm->hasValue("medical_scheme_id") ? $CurrentForm->getValue("medical_scheme_id") : $CurrentForm->getValue("x_medical_scheme_id");
        if (!$this->medical_scheme_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->medical_scheme_id->Visible = false; // Disable update for API request
            } else {
                $this->medical_scheme_id->setFormValue($val);
            }
        }

        // Check field name 'user_role' first before field var 'x_user_role'
        $val = $CurrentForm->hasValue("user_role") ? $CurrentForm->getValue("user_role") : $CurrentForm->getValue("x_user_role");
        if (!$this->user_role->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_role->Visible = false; // Disable update for API request
            } else {
                $this->user_role->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->patient_id->CurrentValue = $this->patient_id->FormValue;
        $this->visit_type_id->CurrentValue = $this->visit_type_id->FormValue;
        $this->payment_method_id->CurrentValue = $this->payment_method_id->FormValue;
        $this->medical_scheme_id->CurrentValue = $this->medical_scheme_id->FormValue;
        $this->user_role->CurrentValue = $this->user_role->FormValue;
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
        $this->patient_id->setDbValue($row['patient_id']);
        $this->visit_type_id->setDbValue($row['visit_type_id']);
        $this->payment_method_id->setDbValue($row['payment_method_id']);
        $this->medical_scheme_id->setDbValue($row['medical_scheme_id']);
        $this->user_role->setDbValue($row['user_role']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->status->setDbValue($row['status']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['visit_type_id'] = $this->visit_type_id->DefaultValue;
        $row['payment_method_id'] = $this->payment_method_id->DefaultValue;
        $row['medical_scheme_id'] = $this->medical_scheme_id->DefaultValue;
        $row['user_role'] = $this->user_role->DefaultValue;
        $row['date_created'] = $this->date_created->DefaultValue;
        $row['date_updated'] = $this->date_updated->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
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

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // visit_type_id
        $this->visit_type_id->RowCssClass = "row";

        // payment_method_id
        $this->payment_method_id->RowCssClass = "row";

        // medical_scheme_id
        $this->medical_scheme_id->RowCssClass = "row";

        // user_role
        $this->user_role->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // patient_id
            $curVal = strval($this->patient_id->CurrentValue);
            if ($curVal != "") {
                $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                if ($this->patient_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->patient_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->patient_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->patient_id->Lookup->renderViewRow($rswrk[0]);
                        $this->patient_id->ViewValue = $this->patient_id->displayValue($arwrk);
                    } else {
                        $this->patient_id->ViewValue = FormatNumber($this->patient_id->CurrentValue, $this->patient_id->formatPattern());
                    }
                }
            } else {
                $this->patient_id->ViewValue = null;
            }

            // visit_type_id
            $curVal = strval($this->visit_type_id->CurrentValue);
            if ($curVal != "") {
                $this->visit_type_id->ViewValue = $this->visit_type_id->lookupCacheOption($curVal);
                if ($this->visit_type_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->visit_type_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->visit_type_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->visit_type_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->visit_type_id->Lookup->renderViewRow($rswrk[0]);
                        $this->visit_type_id->ViewValue = $this->visit_type_id->displayValue($arwrk);
                    } else {
                        $this->visit_type_id->ViewValue = FormatNumber($this->visit_type_id->CurrentValue, $this->visit_type_id->formatPattern());
                    }
                }
            } else {
                $this->visit_type_id->ViewValue = null;
            }

            // payment_method_id
            $curVal = strval($this->payment_method_id->CurrentValue);
            if ($curVal != "") {
                $this->payment_method_id->ViewValue = $this->payment_method_id->lookupCacheOption($curVal);
                if ($this->payment_method_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->payment_method_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->payment_method_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->payment_method_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->payment_method_id->Lookup->renderViewRow($rswrk[0]);
                        $this->payment_method_id->ViewValue = $this->payment_method_id->displayValue($arwrk);
                    } else {
                        $this->payment_method_id->ViewValue = FormatNumber($this->payment_method_id->CurrentValue, $this->payment_method_id->formatPattern());
                    }
                }
            } else {
                $this->payment_method_id->ViewValue = null;
            }

            // medical_scheme_id
            $curVal = strval($this->medical_scheme_id->CurrentValue);
            if ($curVal != "") {
                $this->medical_scheme_id->ViewValue = $this->medical_scheme_id->lookupCacheOption($curVal);
                if ($this->medical_scheme_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->medical_scheme_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->medical_scheme_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->medical_scheme_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->medical_scheme_id->Lookup->renderViewRow($rswrk[0]);
                        $this->medical_scheme_id->ViewValue = $this->medical_scheme_id->displayValue($arwrk);
                    } else {
                        $this->medical_scheme_id->ViewValue = FormatNumber($this->medical_scheme_id->CurrentValue, $this->medical_scheme_id->formatPattern());
                    }
                }
            } else {
                $this->medical_scheme_id->ViewValue = null;
            }

            // user_role
            $this->user_role->ViewValue = $this->user_role->CurrentValue;

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // patient_id
            $this->patient_id->HrefValue = "";

            // visit_type_id
            $this->visit_type_id->HrefValue = "";

            // payment_method_id
            $this->payment_method_id->HrefValue = "";

            // medical_scheme_id
            $this->medical_scheme_id->HrefValue = "";

            // user_role
            $this->user_role->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // patient_id
            $this->patient_id->setupEditAttributes();
            if ($this->patient_id->getSessionValue() != "") {
                $this->patient_id->CurrentValue = GetForeignKeyValue($this->patient_id->getSessionValue());
                $curVal = strval($this->patient_id->CurrentValue);
                if ($curVal != "") {
                    $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                    if ($this->patient_id->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter($this->patient_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->patient_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                        $sqlWrk = $this->patient_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCache($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->patient_id->Lookup->renderViewRow($rswrk[0]);
                            $this->patient_id->ViewValue = $this->patient_id->displayValue($arwrk);
                        } else {
                            $this->patient_id->ViewValue = FormatNumber($this->patient_id->CurrentValue, $this->patient_id->formatPattern());
                        }
                    }
                } else {
                    $this->patient_id->ViewValue = null;
                }
            } else {
                $curVal = trim(strval($this->patient_id->CurrentValue));
                if ($curVal != "") {
                    $this->patient_id->ViewValue = $this->patient_id->lookupCacheOption($curVal);
                } else {
                    $this->patient_id->ViewValue = $this->patient_id->Lookup !== null && is_array($this->patient_id->lookupOptions()) && count($this->patient_id->lookupOptions()) > 0 ? $curVal : null;
                }
                if ($this->patient_id->ViewValue !== null) { // Load from cache
                    $this->patient_id->EditValue = array_values($this->patient_id->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter($this->patient_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->patient_id->CurrentValue, $this->patient_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    }
                    $sqlWrk = $this->patient_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->patient_id->EditValue = $arwrk;
                }
                $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
            }

            // visit_type_id
            $this->visit_type_id->setupEditAttributes();
            $curVal = trim(strval($this->visit_type_id->CurrentValue));
            if ($curVal != "") {
                $this->visit_type_id->ViewValue = $this->visit_type_id->lookupCacheOption($curVal);
            } else {
                $this->visit_type_id->ViewValue = $this->visit_type_id->Lookup !== null && is_array($this->visit_type_id->lookupOptions()) && count($this->visit_type_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->visit_type_id->ViewValue !== null) { // Load from cache
                $this->visit_type_id->EditValue = array_values($this->visit_type_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->visit_type_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->visit_type_id->CurrentValue, $this->visit_type_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->visit_type_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->visit_type_id->EditValue = $arwrk;
            }
            $this->visit_type_id->PlaceHolder = RemoveHtml($this->visit_type_id->caption());

            // payment_method_id
            $this->payment_method_id->setupEditAttributes();
            $curVal = trim(strval($this->payment_method_id->CurrentValue));
            if ($curVal != "") {
                $this->payment_method_id->ViewValue = $this->payment_method_id->lookupCacheOption($curVal);
            } else {
                $this->payment_method_id->ViewValue = $this->payment_method_id->Lookup !== null && is_array($this->payment_method_id->lookupOptions()) && count($this->payment_method_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->payment_method_id->ViewValue !== null) { // Load from cache
                $this->payment_method_id->EditValue = array_values($this->payment_method_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->payment_method_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->payment_method_id->CurrentValue, $this->payment_method_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->payment_method_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->payment_method_id->EditValue = $arwrk;
            }
            $this->payment_method_id->PlaceHolder = RemoveHtml($this->payment_method_id->caption());

            // medical_scheme_id
            $this->medical_scheme_id->setupEditAttributes();
            $curVal = trim(strval($this->medical_scheme_id->CurrentValue));
            if ($curVal != "") {
                $this->medical_scheme_id->ViewValue = $this->medical_scheme_id->lookupCacheOption($curVal);
            } else {
                $this->medical_scheme_id->ViewValue = $this->medical_scheme_id->Lookup !== null && is_array($this->medical_scheme_id->lookupOptions()) && count($this->medical_scheme_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->medical_scheme_id->ViewValue !== null) { // Load from cache
                $this->medical_scheme_id->EditValue = array_values($this->medical_scheme_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->medical_scheme_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->medical_scheme_id->CurrentValue, $this->medical_scheme_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->medical_scheme_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->medical_scheme_id->EditValue = $arwrk;
            }
            $this->medical_scheme_id->PlaceHolder = RemoveHtml($this->medical_scheme_id->caption());

            // user_role

            // Add refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // visit_type_id
            $this->visit_type_id->HrefValue = "";

            // payment_method_id
            $this->payment_method_id->HrefValue = "";

            // medical_scheme_id
            $this->medical_scheme_id->HrefValue = "";

            // user_role
            $this->user_role->HrefValue = "";
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
            if ($this->patient_id->Visible && $this->patient_id->Required) {
                if (!$this->patient_id->IsDetailKey && EmptyValue($this->patient_id->FormValue)) {
                    $this->patient_id->addErrorMessage(str_replace("%s", $this->patient_id->caption(), $this->patient_id->RequiredErrorMessage));
                }
            }
            if ($this->visit_type_id->Visible && $this->visit_type_id->Required) {
                if (!$this->visit_type_id->IsDetailKey && EmptyValue($this->visit_type_id->FormValue)) {
                    $this->visit_type_id->addErrorMessage(str_replace("%s", $this->visit_type_id->caption(), $this->visit_type_id->RequiredErrorMessage));
                }
            }
            if ($this->payment_method_id->Visible && $this->payment_method_id->Required) {
                if (!$this->payment_method_id->IsDetailKey && EmptyValue($this->payment_method_id->FormValue)) {
                    $this->payment_method_id->addErrorMessage(str_replace("%s", $this->payment_method_id->caption(), $this->payment_method_id->RequiredErrorMessage));
                }
            }
            if ($this->medical_scheme_id->Visible && $this->medical_scheme_id->Required) {
                if (!$this->medical_scheme_id->IsDetailKey && EmptyValue($this->medical_scheme_id->FormValue)) {
                    $this->medical_scheme_id->addErrorMessage(str_replace("%s", $this->medical_scheme_id->caption(), $this->medical_scheme_id->RequiredErrorMessage));
                }
            }
            if ($this->user_role->Visible && $this->user_role->Required) {
                if (!$this->user_role->IsDetailKey && EmptyValue($this->user_role->FormValue)) {
                    $this->user_role->addErrorMessage(str_replace("%s", $this->user_role->caption(), $this->user_role->RequiredErrorMessage));
                }
            }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("PatientQueueGrid");
        if (in_array("patient_queue", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PatientVitalsGrid");
        if (in_array("patient_vitals", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("DoctorNotesGrid");
        if (in_array("doctor_notes", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PrescriptionsGrid");
        if (in_array("prescriptions", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("RadiologyRequestsGrid");
        if (in_array("radiology_requests", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("InvoicesGrid");
        if (in_array("invoices", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PatientVaccinationsGrid");
        if (in_array("patient_vaccinations", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("CashPaymentsGrid");
        if (in_array("cash_payments", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("LabTestRequestsGrid");
        if (in_array("lab_test_requests", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("LaboratoryBillingReportGrid");
        if (in_array("laboratory_billing_report", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("RadiologyBillingReportGrid");
        if (in_array("radiology_billing_report", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PharmacyBillingReportGrid");
        if (in_array("pharmacy_billing_report", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PatientsLabReportGrid");
        if (in_array("patients_lab_report", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
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

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

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

        // Add detail records
        if ($addRow) {
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            $detailPage = Container("PatientQueueGrid");
            if (in_array("patient_queue", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patient_queue"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PatientVitalsGrid");
            if (in_array("patient_vitals", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patient_vitals"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("DoctorNotesGrid");
            if (in_array("doctor_notes", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "doctor_notes"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PrescriptionsGrid");
            if (in_array("prescriptions", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "prescriptions"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("RadiologyRequestsGrid");
            if (in_array("radiology_requests", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "radiology_requests"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("InvoicesGrid");
            if (in_array("invoices", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "invoices"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PatientVaccinationsGrid");
            if (in_array("patient_vaccinations", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patient_vaccinations"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("CashPaymentsGrid");
            if (in_array("cash_payments", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "cash_payments"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("LabTestRequestsGrid");
            if (in_array("lab_test_requests", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "lab_test_requests"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("LaboratoryBillingReportGrid");
            if (in_array("laboratory_billing_report", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "laboratory_billing_report"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("RadiologyBillingReportGrid");
            if (in_array("radiology_billing_report", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "radiology_billing_report"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PharmacyBillingReportGrid");
            if (in_array("pharmacy_billing_report", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "pharmacy_billing_report"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PatientsLabReportGrid");
            if (in_array("patients_lab_report", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->visit_id->setSessionValue($this->id->CurrentValue); // Set master key
                $detailPage->patient_id->setSessionValue($this->patient_id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patients_lab_report"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->visit_id->setSessionValue(""); // Clear master key if insert failed
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
        }

        // Commit/Rollback transaction
        if ($this->getCurrentDetailTable() != "") {
            if ($addRow) {
                if ($this->UseTransaction) { // Commit transaction
                    if ($conn->isTransactionActive()) {
                        $conn->commit();
                    }
                }
            } else {
                if ($this->UseTransaction) { // Rollback transaction
                    if ($conn->isTransactionActive()) {
                        $conn->rollback();
                    }
                }
            }
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

        // patient_id
        $this->patient_id->setDbValueDef($rsnew, $this->patient_id->CurrentValue, false);

        // visit_type_id
        $this->visit_type_id->setDbValueDef($rsnew, $this->visit_type_id->CurrentValue, false);

        // payment_method_id
        $this->payment_method_id->setDbValueDef($rsnew, $this->payment_method_id->CurrentValue, false);

        // medical_scheme_id
        $this->medical_scheme_id->setDbValueDef($rsnew, $this->medical_scheme_id->CurrentValue, false);

        // user_role
        $this->user_role->CurrentValue = $this->user_role->getAutoUpdateValue(); // PHP
        $this->user_role->setDbValueDef($rsnew, $this->user_role->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['patient_id'])) { // patient_id
            $this->patient_id->setFormValue($row['patient_id']);
        }
        if (isset($row['visit_type_id'])) { // visit_type_id
            $this->visit_type_id->setFormValue($row['visit_type_id']);
        }
        if (isset($row['payment_method_id'])) { // payment_method_id
            $this->payment_method_id->setFormValue($row['payment_method_id']);
        }
        if (isset($row['medical_scheme_id'])) { // medical_scheme_id
            $this->medical_scheme_id->setFormValue($row['medical_scheme_id']);
        }
        if (isset($row['user_role'])) { // user_role
            $this->user_role->setFormValue($row['user_role']);
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
            if ($masterTblVar == "patients") {
                $validMaster = true;
                $masterTbl = Container("patients");
                if (($parm = Get("fk_id", Get("patient_id"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->patient_id->QueryStringValue = $masterTbl->id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->patient_id->setSessionValue($this->patient_id->QueryStringValue);
                    $foreignKeys["patient_id"] = $this->patient_id->QueryStringValue;
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
            if ($masterTblVar == "patients") {
                $validMaster = true;
                $masterTbl = Container("patients");
                if (($parm = Post("fk_id", Post("patient_id"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->patient_id->FormValue = $masterTbl->id->FormValue;
                    $this->patient_id->setSessionValue($this->patient_id->FormValue);
                    $foreignKeys["patient_id"] = $this->patient_id->FormValue;
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
            if ($masterTblVar != "patients") {
                if (!array_key_exists("patient_id", $foreignKeys)) { // Not current foreign key
                    $this->patient_id->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("patient_queue", $detailTblVar)) {
                $detailPageObj = Container("PatientQueueGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("patient_vitals", $detailTblVar)) {
                $detailPageObj = Container("PatientVitalsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("doctor_notes", $detailTblVar)) {
                $detailPageObj = Container("DoctorNotesGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("prescriptions", $detailTblVar)) {
                $detailPageObj = Container("PrescriptionsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("radiology_requests", $detailTblVar)) {
                $detailPageObj = Container("RadiologyRequestsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("invoices", $detailTblVar)) {
                $detailPageObj = Container("InvoicesGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("patient_vaccinations", $detailTblVar)) {
                $detailPageObj = Container("PatientVaccinationsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("cash_payments", $detailTblVar)) {
                $detailPageObj = Container("CashPaymentsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("lab_test_requests", $detailTblVar)) {
                $detailPageObj = Container("LabTestRequestsGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("laboratory_billing_report", $detailTblVar)) {
                $detailPageObj = Container("LaboratoryBillingReportGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("radiology_billing_report", $detailTblVar)) {
                $detailPageObj = Container("RadiologyBillingReportGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("pharmacy_billing_report", $detailTblVar)) {
                $detailPageObj = Container("PharmacyBillingReportGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("patients_lab_report", $detailTblVar)) {
                $detailPageObj = Container("PatientsLabReportGrid");
                if ($detailPageObj->DetailAdd) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->visit_id->IsDetailKey = true;
                    $detailPageObj->visit_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->visit_id->setSessionValue($detailPageObj->visit_id->CurrentValue);
                    $detailPageObj->patient_id->IsDetailKey = true;
                    $detailPageObj->patient_id->CurrentValue = $this->patient_id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("patientvisitslist"), "", $this->TableVar, true);
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
                case "x_patient_id":
                    break;
                case "x_visit_type_id":
                    break;
                case "x_payment_method_id":
                    break;
                case "x_medical_scheme_id":
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
