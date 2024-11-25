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
class PatientVitalsAdd extends PatientVitals
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PatientVitalsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "patientvitalsadd";

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
        $this->visit_id->setVisibility();
        $this->height->setVisibility();
        $this->weight->setVisibility();
        $this->bmi->Visible = false;
        $this->temperature->setVisibility();
        $this->pulse->setVisibility();
        $this->blood_pressure->setVisibility();
        $this->created_by_user_id->Visible = false;
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'patient_vitals';
        $this->TableName = 'patient_vitals';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (patient_vitals)
        if (!isset($GLOBALS["patient_vitals"]) || $GLOBALS["patient_vitals"]::class == PROJECT_NAMESPACE . "patient_vitals") {
            $GLOBALS["patient_vitals"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'patient_vitals');
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
                        $result["view"] = SameString($pageName, "patientvitalsview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->visit_id);
        $this->setupLookupOptions($this->created_by_user_id);

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
                    $this->terminate("patientvitalslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "patientvitalslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "patientvitalsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions && !$this->getCurrentMasterTable()) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "patientvitalslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "patientvitalslist"; // Return list page content
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

        // Check field name 'patient_id' first before field var 'x_patient_id'
        $val = $CurrentForm->hasValue("patient_id") ? $CurrentForm->getValue("patient_id") : $CurrentForm->getValue("x_patient_id");
        if (!$this->patient_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->patient_id->Visible = false; // Disable update for API request
            } else {
                $this->patient_id->setFormValue($val);
            }
        }

        // Check field name 'visit_id' first before field var 'x_visit_id'
        $val = $CurrentForm->hasValue("visit_id") ? $CurrentForm->getValue("visit_id") : $CurrentForm->getValue("x_visit_id");
        if (!$this->visit_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->visit_id->Visible = false; // Disable update for API request
            } else {
                $this->visit_id->setFormValue($val);
            }
        }

        // Check field name 'height' first before field var 'x_height'
        $val = $CurrentForm->hasValue("height") ? $CurrentForm->getValue("height") : $CurrentForm->getValue("x_height");
        if (!$this->height->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->height->Visible = false; // Disable update for API request
            } else {
                $this->height->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'weight' first before field var 'x_weight'
        $val = $CurrentForm->hasValue("weight") ? $CurrentForm->getValue("weight") : $CurrentForm->getValue("x_weight");
        if (!$this->weight->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->weight->Visible = false; // Disable update for API request
            } else {
                $this->weight->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'temperature' first before field var 'x_temperature'
        $val = $CurrentForm->hasValue("temperature") ? $CurrentForm->getValue("temperature") : $CurrentForm->getValue("x_temperature");
        if (!$this->temperature->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->temperature->Visible = false; // Disable update for API request
            } else {
                $this->temperature->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pulse' first before field var 'x_pulse'
        $val = $CurrentForm->hasValue("pulse") ? $CurrentForm->getValue("pulse") : $CurrentForm->getValue("x_pulse");
        if (!$this->pulse->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pulse->Visible = false; // Disable update for API request
            } else {
                $this->pulse->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'blood_pressure' first before field var 'x_blood_pressure'
        $val = $CurrentForm->hasValue("blood_pressure") ? $CurrentForm->getValue("blood_pressure") : $CurrentForm->getValue("x_blood_pressure");
        if (!$this->blood_pressure->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->blood_pressure->Visible = false; // Disable update for API request
            } else {
                $this->blood_pressure->setFormValue($val);
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
        $this->visit_id->CurrentValue = $this->visit_id->FormValue;
        $this->height->CurrentValue = $this->height->FormValue;
        $this->weight->CurrentValue = $this->weight->FormValue;
        $this->temperature->CurrentValue = $this->temperature->FormValue;
        $this->pulse->CurrentValue = $this->pulse->FormValue;
        $this->blood_pressure->CurrentValue = $this->blood_pressure->FormValue;
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

        // Check if valid User ID
        if ($res) {
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
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
        $this->visit_id->setDbValue($row['visit_id']);
        $this->height->setDbValue($row['height']);
        $this->weight->setDbValue($row['weight']);
        $this->bmi->setDbValue($row['bmi']);
        $this->temperature->setDbValue($row['temperature']);
        $this->pulse->setDbValue($row['pulse']);
        $this->blood_pressure->setDbValue($row['blood_pressure']);
        $this->created_by_user_id->setDbValue($row['created_by_user_id']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['patient_id'] = $this->patient_id->DefaultValue;
        $row['visit_id'] = $this->visit_id->DefaultValue;
        $row['height'] = $this->height->DefaultValue;
        $row['weight'] = $this->weight->DefaultValue;
        $row['bmi'] = $this->bmi->DefaultValue;
        $row['temperature'] = $this->temperature->DefaultValue;
        $row['pulse'] = $this->pulse->DefaultValue;
        $row['blood_pressure'] = $this->blood_pressure->DefaultValue;
        $row['created_by_user_id'] = $this->created_by_user_id->DefaultValue;
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

        // patient_id
        $this->patient_id->RowCssClass = "row";

        // visit_id
        $this->visit_id->RowCssClass = "row";

        // height
        $this->height->RowCssClass = "row";

        // weight
        $this->weight->RowCssClass = "row";

        // bmi
        $this->bmi->RowCssClass = "row";

        // temperature
        $this->temperature->RowCssClass = "row";

        // pulse
        $this->pulse->RowCssClass = "row";

        // blood_pressure
        $this->blood_pressure->RowCssClass = "row";

        // created_by_user_id
        $this->created_by_user_id->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

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

            // visit_id
            $curVal = strval($this->visit_id->CurrentValue);
            if ($curVal != "") {
                $this->visit_id->ViewValue = $this->visit_id->lookupCacheOption($curVal);
                if ($this->visit_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->visit_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->visit_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->visit_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->visit_id->Lookup->renderViewRow($rswrk[0]);
                        $this->visit_id->ViewValue = $this->visit_id->displayValue($arwrk);
                    } else {
                        $this->visit_id->ViewValue = FormatNumber($this->visit_id->CurrentValue, $this->visit_id->formatPattern());
                    }
                }
            } else {
                $this->visit_id->ViewValue = null;
            }

            // height
            $this->height->ViewValue = $this->height->CurrentValue;
            $this->height->ViewValue = FormatNumber($this->height->ViewValue, $this->height->formatPattern());

            // weight
            $this->weight->ViewValue = $this->weight->CurrentValue;
            $this->weight->ViewValue = FormatNumber($this->weight->ViewValue, $this->weight->formatPattern());

            // bmi
            $this->bmi->ViewValue = $this->bmi->CurrentValue;
            $this->bmi->ViewValue = FormatNumber($this->bmi->ViewValue, $this->bmi->formatPattern());

            // temperature
            $this->temperature->ViewValue = $this->temperature->CurrentValue;
            $this->temperature->ViewValue = FormatNumber($this->temperature->ViewValue, $this->temperature->formatPattern());

            // pulse
            $this->pulse->ViewValue = $this->pulse->CurrentValue;
            $this->pulse->ViewValue = FormatNumber($this->pulse->ViewValue, $this->pulse->formatPattern());

            // blood_pressure
            $this->blood_pressure->ViewValue = $this->blood_pressure->CurrentValue;

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

            // patient_id
            $this->patient_id->HrefValue = "";

            // visit_id
            $this->visit_id->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // weight
            $this->weight->HrefValue = "";

            // temperature
            $this->temperature->HrefValue = "";

            // pulse
            $this->pulse->HrefValue = "";

            // blood_pressure
            $this->blood_pressure->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // patient_id
            $this->patient_id->setupEditAttributes();
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

            // visit_id
            $this->visit_id->setupEditAttributes();
            if ($this->visit_id->getSessionValue() != "") {
                $this->visit_id->CurrentValue = GetForeignKeyValue($this->visit_id->getSessionValue());
                $curVal = strval($this->visit_id->CurrentValue);
                if ($curVal != "") {
                    $this->visit_id->ViewValue = $this->visit_id->lookupCacheOption($curVal);
                    if ($this->visit_id->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter($this->visit_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->visit_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                        $sqlWrk = $this->visit_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCache($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->visit_id->Lookup->renderViewRow($rswrk[0]);
                            $this->visit_id->ViewValue = $this->visit_id->displayValue($arwrk);
                        } else {
                            $this->visit_id->ViewValue = FormatNumber($this->visit_id->CurrentValue, $this->visit_id->formatPattern());
                        }
                    }
                } else {
                    $this->visit_id->ViewValue = null;
                }
            } else {
                $curVal = trim(strval($this->visit_id->CurrentValue));
                if ($curVal != "") {
                    $this->visit_id->ViewValue = $this->visit_id->lookupCacheOption($curVal);
                } else {
                    $this->visit_id->ViewValue = $this->visit_id->Lookup !== null && is_array($this->visit_id->lookupOptions()) && count($this->visit_id->lookupOptions()) > 0 ? $curVal : null;
                }
                if ($this->visit_id->ViewValue !== null) { // Load from cache
                    $this->visit_id->EditValue = array_values($this->visit_id->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter($this->visit_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->visit_id->CurrentValue, $this->visit_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    }
                    $sqlWrk = $this->visit_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->visit_id->EditValue = $arwrk;
                }
                $this->visit_id->PlaceHolder = RemoveHtml($this->visit_id->caption());
            }

            // height
            $this->height->setupEditAttributes();
            $this->height->EditValue = $this->height->CurrentValue;
            $this->height->PlaceHolder = RemoveHtml($this->height->caption());
            if (strval($this->height->EditValue) != "" && is_numeric($this->height->EditValue)) {
                $this->height->EditValue = FormatNumber($this->height->EditValue, null);
            }

            // weight
            $this->weight->setupEditAttributes();
            $this->weight->EditValue = $this->weight->CurrentValue;
            $this->weight->PlaceHolder = RemoveHtml($this->weight->caption());
            if (strval($this->weight->EditValue) != "" && is_numeric($this->weight->EditValue)) {
                $this->weight->EditValue = FormatNumber($this->weight->EditValue, null);
            }

            // temperature
            $this->temperature->setupEditAttributes();
            $this->temperature->EditValue = $this->temperature->CurrentValue;
            $this->temperature->PlaceHolder = RemoveHtml($this->temperature->caption());
            if (strval($this->temperature->EditValue) != "" && is_numeric($this->temperature->EditValue)) {
                $this->temperature->EditValue = FormatNumber($this->temperature->EditValue, null);
            }

            // pulse
            $this->pulse->setupEditAttributes();
            $this->pulse->EditValue = $this->pulse->CurrentValue;
            $this->pulse->PlaceHolder = RemoveHtml($this->pulse->caption());
            if (strval($this->pulse->EditValue) != "" && is_numeric($this->pulse->EditValue)) {
                $this->pulse->EditValue = FormatNumber($this->pulse->EditValue, null);
            }

            // blood_pressure
            $this->blood_pressure->setupEditAttributes();
            if (!$this->blood_pressure->Raw) {
                $this->blood_pressure->CurrentValue = HtmlDecode($this->blood_pressure->CurrentValue);
            }
            $this->blood_pressure->EditValue = HtmlEncode($this->blood_pressure->CurrentValue);
            $this->blood_pressure->PlaceHolder = RemoveHtml($this->blood_pressure->caption());

            // Add refer script

            // patient_id
            $this->patient_id->HrefValue = "";

            // visit_id
            $this->visit_id->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // weight
            $this->weight->HrefValue = "";

            // temperature
            $this->temperature->HrefValue = "";

            // pulse
            $this->pulse->HrefValue = "";

            // blood_pressure
            $this->blood_pressure->HrefValue = "";
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
            if ($this->visit_id->Visible && $this->visit_id->Required) {
                if (!$this->visit_id->IsDetailKey && EmptyValue($this->visit_id->FormValue)) {
                    $this->visit_id->addErrorMessage(str_replace("%s", $this->visit_id->caption(), $this->visit_id->RequiredErrorMessage));
                }
            }
            if ($this->height->Visible && $this->height->Required) {
                if (!$this->height->IsDetailKey && EmptyValue($this->height->FormValue)) {
                    $this->height->addErrorMessage(str_replace("%s", $this->height->caption(), $this->height->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->height->FormValue)) {
                $this->height->addErrorMessage($this->height->getErrorMessage(false));
            }
            if ($this->weight->Visible && $this->weight->Required) {
                if (!$this->weight->IsDetailKey && EmptyValue($this->weight->FormValue)) {
                    $this->weight->addErrorMessage(str_replace("%s", $this->weight->caption(), $this->weight->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->weight->FormValue)) {
                $this->weight->addErrorMessage($this->weight->getErrorMessage(false));
            }
            if ($this->temperature->Visible && $this->temperature->Required) {
                if (!$this->temperature->IsDetailKey && EmptyValue($this->temperature->FormValue)) {
                    $this->temperature->addErrorMessage(str_replace("%s", $this->temperature->caption(), $this->temperature->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->temperature->FormValue)) {
                $this->temperature->addErrorMessage($this->temperature->getErrorMessage(false));
            }
            if ($this->pulse->Visible && $this->pulse->Required) {
                if (!$this->pulse->IsDetailKey && EmptyValue($this->pulse->FormValue)) {
                    $this->pulse->addErrorMessage(str_replace("%s", $this->pulse->caption(), $this->pulse->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->pulse->FormValue)) {
                $this->pulse->addErrorMessage($this->pulse->getErrorMessage(false));
            }
            if ($this->blood_pressure->Visible && $this->blood_pressure->Required) {
                if (!$this->blood_pressure->IsDetailKey && EmptyValue($this->blood_pressure->FormValue)) {
                    $this->blood_pressure->addErrorMessage(str_replace("%s", $this->blood_pressure->caption(), $this->blood_pressure->RequiredErrorMessage));
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

        // visit_id
        $this->visit_id->setDbValueDef($rsnew, $this->visit_id->CurrentValue, false);

        // height
        $this->height->setDbValueDef($rsnew, $this->height->CurrentValue, false);

        // weight
        $this->weight->setDbValueDef($rsnew, $this->weight->CurrentValue, false);

        // temperature
        $this->temperature->setDbValueDef($rsnew, $this->temperature->CurrentValue, false);

        // pulse
        $this->pulse->setDbValueDef($rsnew, $this->pulse->CurrentValue, false);

        // blood_pressure
        $this->blood_pressure->setDbValueDef($rsnew, $this->blood_pressure->CurrentValue, false);

        // created_by_user_id
        if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
            $rsnew['created_by_user_id'] = CurrentUserID();
        }
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
        if (isset($row['visit_id'])) { // visit_id
            $this->visit_id->setFormValue($row['visit_id']);
        }
        if (isset($row['height'])) { // height
            $this->height->setFormValue($row['height']);
        }
        if (isset($row['weight'])) { // weight
            $this->weight->setFormValue($row['weight']);
        }
        if (isset($row['temperature'])) { // temperature
            $this->temperature->setFormValue($row['temperature']);
        }
        if (isset($row['pulse'])) { // pulse
            $this->pulse->setFormValue($row['pulse']);
        }
        if (isset($row['blood_pressure'])) { // blood_pressure
            $this->blood_pressure->setFormValue($row['blood_pressure']);
        }
        if (isset($row['created_by_user_id'])) { // created_by_user_id
            $this->created_by_user_id->setFormValue($row['created_by_user_id']);
        }
    }

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->created_by_user_id->CurrentValue);
        }
        return true;
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
            if ($masterTblVar == "patient_visits") {
                $validMaster = true;
                $masterTbl = Container("patient_visits");
                if (($parm = Get("fk_id", Get("visit_id"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->visit_id->QueryStringValue = $masterTbl->id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->visit_id->setSessionValue($this->visit_id->QueryStringValue);
                    $foreignKeys["visit_id"] = $this->visit_id->QueryStringValue;
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
            if ($masterTblVar == "patient_visits") {
                $validMaster = true;
                $masterTbl = Container("patient_visits");
                if (($parm = Post("fk_id", Post("visit_id"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->visit_id->FormValue = $masterTbl->id->FormValue;
                    $this->visit_id->setSessionValue($this->visit_id->FormValue);
                    $foreignKeys["visit_id"] = $this->visit_id->FormValue;
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
            if ($masterTblVar != "patient_visits") {
                if (!array_key_exists("visit_id", $foreignKeys)) { // Not current foreign key
                    $this->visit_id->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("patientvitalslist"), "", $this->TableVar, true);
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
                case "x_visit_id":
                    break;
                case "x_created_by_user_id":
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
