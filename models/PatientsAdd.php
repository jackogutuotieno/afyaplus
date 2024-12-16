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
class PatientsAdd extends Patients
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PatientsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "patientsadd";

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
        $this->photo->setVisibility();
        $this->patient_name->Visible = false;
        $this->first_name->setVisibility();
        $this->last_name->setVisibility();
        $this->national_id->setVisibility();
        $this->date_of_birth->setVisibility();
        $this->age->Visible = false;
        $this->gender->setVisibility();
        $this->phone->setVisibility();
        $this->email_address->setVisibility();
        $this->physical_address->setVisibility();
        $this->employment_status->setVisibility();
        $this->religion->setVisibility();
        $this->next_of_kin->setVisibility();
        $this->next_of_kin_phone->setVisibility();
        $this->marital_status->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'patients';
        $this->TableName = 'patients';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (patients)
        if (!isset($GLOBALS["patients"]) || $GLOBALS["patients"]::class == PROJECT_NAMESPACE . "patients") {
            $GLOBALS["patients"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'patients');
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
                        $result["view"] = SameString($pageName, "patientsview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->gender);
        $this->setupLookupOptions($this->employment_status);
        $this->setupLookupOptions($this->religion);
        $this->setupLookupOptions($this->marital_status);

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
                    $this->terminate("patientslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "patientslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "patientsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "patientslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "patientslist"; // Return list page content
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
        $this->photo->Upload->Index = $CurrentForm->Index;
        $this->photo->Upload->uploadFile();
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

        // Check field name 'first_name' first before field var 'x_first_name'
        $val = $CurrentForm->hasValue("first_name") ? $CurrentForm->getValue("first_name") : $CurrentForm->getValue("x_first_name");
        if (!$this->first_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->first_name->Visible = false; // Disable update for API request
            } else {
                $this->first_name->setFormValue($val);
            }
        }

        // Check field name 'last_name' first before field var 'x_last_name'
        $val = $CurrentForm->hasValue("last_name") ? $CurrentForm->getValue("last_name") : $CurrentForm->getValue("x_last_name");
        if (!$this->last_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->last_name->Visible = false; // Disable update for API request
            } else {
                $this->last_name->setFormValue($val);
            }
        }

        // Check field name 'national_id' first before field var 'x_national_id'
        $val = $CurrentForm->hasValue("national_id") ? $CurrentForm->getValue("national_id") : $CurrentForm->getValue("x_national_id");
        if (!$this->national_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->national_id->Visible = false; // Disable update for API request
            } else {
                $this->national_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'date_of_birth' first before field var 'x_date_of_birth'
        $val = $CurrentForm->hasValue("date_of_birth") ? $CurrentForm->getValue("date_of_birth") : $CurrentForm->getValue("x_date_of_birth");
        if (!$this->date_of_birth->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_of_birth->Visible = false; // Disable update for API request
            } else {
                $this->date_of_birth->setFormValue($val, true, $validate);
            }
            $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        }

        // Check field name 'gender' first before field var 'x_gender'
        $val = $CurrentForm->hasValue("gender") ? $CurrentForm->getValue("gender") : $CurrentForm->getValue("x_gender");
        if (!$this->gender->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gender->Visible = false; // Disable update for API request
            } else {
                $this->gender->setFormValue($val);
            }
        }

        // Check field name 'phone' first before field var 'x_phone'
        $val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
        if (!$this->phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->phone->Visible = false; // Disable update for API request
            } else {
                $this->phone->setFormValue($val);
            }
        }

        // Check field name 'email_address' first before field var 'x_email_address'
        $val = $CurrentForm->hasValue("email_address") ? $CurrentForm->getValue("email_address") : $CurrentForm->getValue("x_email_address");
        if (!$this->email_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email_address->Visible = false; // Disable update for API request
            } else {
                $this->email_address->setFormValue($val);
            }
        }

        // Check field name 'physical_address' first before field var 'x_physical_address'
        $val = $CurrentForm->hasValue("physical_address") ? $CurrentForm->getValue("physical_address") : $CurrentForm->getValue("x_physical_address");
        if (!$this->physical_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->physical_address->Visible = false; // Disable update for API request
            } else {
                $this->physical_address->setFormValue($val);
            }
        }

        // Check field name 'employment_status' first before field var 'x_employment_status'
        $val = $CurrentForm->hasValue("employment_status") ? $CurrentForm->getValue("employment_status") : $CurrentForm->getValue("x_employment_status");
        if (!$this->employment_status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employment_status->Visible = false; // Disable update for API request
            } else {
                $this->employment_status->setFormValue($val);
            }
        }

        // Check field name 'religion' first before field var 'x_religion'
        $val = $CurrentForm->hasValue("religion") ? $CurrentForm->getValue("religion") : $CurrentForm->getValue("x_religion");
        if (!$this->religion->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->religion->Visible = false; // Disable update for API request
            } else {
                $this->religion->setFormValue($val);
            }
        }

        // Check field name 'next_of_kin' first before field var 'x_next_of_kin'
        $val = $CurrentForm->hasValue("next_of_kin") ? $CurrentForm->getValue("next_of_kin") : $CurrentForm->getValue("x_next_of_kin");
        if (!$this->next_of_kin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->next_of_kin->Visible = false; // Disable update for API request
            } else {
                $this->next_of_kin->setFormValue($val);
            }
        }

        // Check field name 'next_of_kin_phone' first before field var 'x_next_of_kin_phone'
        $val = $CurrentForm->hasValue("next_of_kin_phone") ? $CurrentForm->getValue("next_of_kin_phone") : $CurrentForm->getValue("x_next_of_kin_phone");
        if (!$this->next_of_kin_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->next_of_kin_phone->Visible = false; // Disable update for API request
            } else {
                $this->next_of_kin_phone->setFormValue($val);
            }
        }

        // Check field name 'marital_status' first before field var 'x_marital_status'
        $val = $CurrentForm->hasValue("marital_status") ? $CurrentForm->getValue("marital_status") : $CurrentForm->getValue("x_marital_status");
        if (!$this->marital_status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->marital_status->Visible = false; // Disable update for API request
            } else {
                $this->marital_status->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->first_name->CurrentValue = $this->first_name->FormValue;
        $this->last_name->CurrentValue = $this->last_name->FormValue;
        $this->national_id->CurrentValue = $this->national_id->FormValue;
        $this->date_of_birth->CurrentValue = $this->date_of_birth->FormValue;
        $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        $this->gender->CurrentValue = $this->gender->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->email_address->CurrentValue = $this->email_address->FormValue;
        $this->physical_address->CurrentValue = $this->physical_address->FormValue;
        $this->employment_status->CurrentValue = $this->employment_status->FormValue;
        $this->religion->CurrentValue = $this->religion->FormValue;
        $this->next_of_kin->CurrentValue = $this->next_of_kin->FormValue;
        $this->next_of_kin_phone->CurrentValue = $this->next_of_kin_phone->FormValue;
        $this->marital_status->CurrentValue = $this->marital_status->FormValue;
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
        $this->photo->Upload->DbValue = $row['photo'];
        if (is_resource($this->photo->Upload->DbValue) && get_resource_type($this->photo->Upload->DbValue) == "stream") { // Byte array
            $this->photo->Upload->DbValue = stream_get_contents($this->photo->Upload->DbValue);
        }
        $this->patient_name->setDbValue($row['patient_name']);
        $this->first_name->setDbValue($row['first_name']);
        $this->last_name->setDbValue($row['last_name']);
        $this->national_id->setDbValue($row['national_id']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->age->setDbValue($row['age']);
        $this->gender->setDbValue($row['gender']);
        $this->phone->setDbValue($row['phone']);
        $this->email_address->setDbValue($row['email_address']);
        $this->physical_address->setDbValue($row['physical_address']);
        $this->employment_status->setDbValue($row['employment_status']);
        $this->religion->setDbValue($row['religion']);
        $this->next_of_kin->setDbValue($row['next_of_kin']);
        $this->next_of_kin_phone->setDbValue($row['next_of_kin_phone']);
        $this->marital_status->setDbValue($row['marital_status']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['photo'] = $this->photo->DefaultValue;
        $row['patient_name'] = $this->patient_name->DefaultValue;
        $row['first_name'] = $this->first_name->DefaultValue;
        $row['last_name'] = $this->last_name->DefaultValue;
        $row['national_id'] = $this->national_id->DefaultValue;
        $row['date_of_birth'] = $this->date_of_birth->DefaultValue;
        $row['age'] = $this->age->DefaultValue;
        $row['gender'] = $this->gender->DefaultValue;
        $row['phone'] = $this->phone->DefaultValue;
        $row['email_address'] = $this->email_address->DefaultValue;
        $row['physical_address'] = $this->physical_address->DefaultValue;
        $row['employment_status'] = $this->employment_status->DefaultValue;
        $row['religion'] = $this->religion->DefaultValue;
        $row['next_of_kin'] = $this->next_of_kin->DefaultValue;
        $row['next_of_kin_phone'] = $this->next_of_kin_phone->DefaultValue;
        $row['marital_status'] = $this->marital_status->DefaultValue;
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

        // photo
        $this->photo->RowCssClass = "row";

        // patient_name
        $this->patient_name->RowCssClass = "row";

        // first_name
        $this->first_name->RowCssClass = "row";

        // last_name
        $this->last_name->RowCssClass = "row";

        // national_id
        $this->national_id->RowCssClass = "row";

        // date_of_birth
        $this->date_of_birth->RowCssClass = "row";

        // age
        $this->age->RowCssClass = "row";

        // gender
        $this->gender->RowCssClass = "row";

        // phone
        $this->phone->RowCssClass = "row";

        // email_address
        $this->email_address->RowCssClass = "row";

        // physical_address
        $this->physical_address->RowCssClass = "row";

        // employment_status
        $this->employment_status->RowCssClass = "row";

        // religion
        $this->religion->RowCssClass = "row";

        // next_of_kin
        $this->next_of_kin->RowCssClass = "row";

        // next_of_kin_phone
        $this->next_of_kin_phone->RowCssClass = "row";

        // marital_status
        $this->marital_status->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // photo
            if (!EmptyValue($this->photo->Upload->DbValue)) {
                $this->photo->ViewValue = $this->id->CurrentValue;
                $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
            } else {
                $this->photo->ViewValue = "";
            }

            // patient_name
            $this->patient_name->ViewValue = $this->patient_name->CurrentValue;

            // first_name
            $this->first_name->ViewValue = $this->first_name->CurrentValue;

            // last_name
            $this->last_name->ViewValue = $this->last_name->CurrentValue;

            // national_id
            $this->national_id->ViewValue = $this->national_id->CurrentValue;

            // date_of_birth
            $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
            $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, $this->date_of_birth->formatPattern());

            // age
            $this->age->ViewValue = $this->age->CurrentValue;
            $this->age->ViewValue = FormatNumber($this->age->ViewValue, $this->age->formatPattern());

            // gender
            if (strval($this->gender->CurrentValue) != "") {
                $this->gender->ViewValue = $this->gender->optionCaption($this->gender->CurrentValue);
            } else {
                $this->gender->ViewValue = null;
            }

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;

            // email_address
            $this->email_address->ViewValue = $this->email_address->CurrentValue;

            // physical_address
            $this->physical_address->ViewValue = $this->physical_address->CurrentValue;

            // employment_status
            if (strval($this->employment_status->CurrentValue) != "") {
                $this->employment_status->ViewValue = $this->employment_status->optionCaption($this->employment_status->CurrentValue);
            } else {
                $this->employment_status->ViewValue = null;
            }

            // religion
            if (strval($this->religion->CurrentValue) != "") {
                $this->religion->ViewValue = $this->religion->optionCaption($this->religion->CurrentValue);
            } else {
                $this->religion->ViewValue = null;
            }

            // next_of_kin
            $this->next_of_kin->ViewValue = $this->next_of_kin->CurrentValue;

            // next_of_kin_phone
            $this->next_of_kin_phone->ViewValue = $this->next_of_kin_phone->CurrentValue;

            // marital_status
            if (strval($this->marital_status->CurrentValue) != "") {
                $this->marital_status->ViewValue = $this->marital_status->optionCaption($this->marital_status->CurrentValue);
            } else {
                $this->marital_status->ViewValue = null;
            }

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // photo
            if (!empty($this->photo->Upload->DbValue)) {
                $this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->id->CurrentValue);
                $this->photo->LinkAttrs["target"] = "";
                if ($this->photo->IsBlobImage && empty($this->photo->LinkAttrs["target"])) {
                    $this->photo->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
                }
            } else {
                $this->photo->HrefValue = "";
            }
            $this->photo->ExportHrefValue = GetFileUploadUrl($this->photo, $this->id->CurrentValue);

            // first_name
            $this->first_name->HrefValue = "";

            // last_name
            $this->last_name->HrefValue = "";

            // national_id
            $this->national_id->HrefValue = "";

            // date_of_birth
            $this->date_of_birth->HrefValue = "";

            // gender
            $this->gender->HrefValue = "";

            // phone
            if (!EmptyValue($this->phone->CurrentValue)) {
                $this->phone->HrefValue = $this->phone->getLinkPrefix() . $this->phone->CurrentValue; // Add prefix/suffix
                $this->phone->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->phone->HrefValue = FullUrl($this->phone->HrefValue, "href");
                }
            } else {
                $this->phone->HrefValue = "";
            }

            // email_address
            if (!EmptyValue($this->email_address->CurrentValue)) {
                $this->email_address->HrefValue = $this->email_address->getLinkPrefix() . $this->email_address->CurrentValue; // Add prefix/suffix
                $this->email_address->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->email_address->HrefValue = FullUrl($this->email_address->HrefValue, "href");
                }
            } else {
                $this->email_address->HrefValue = "";
            }

            // physical_address
            $this->physical_address->HrefValue = "";

            // employment_status
            $this->employment_status->HrefValue = "";

            // religion
            $this->religion->HrefValue = "";

            // next_of_kin
            $this->next_of_kin->HrefValue = "";

            // next_of_kin_phone
            $this->next_of_kin_phone->HrefValue = "";

            // marital_status
            $this->marital_status->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // photo
            $this->photo->setupEditAttributes();
            if (!EmptyValue($this->photo->Upload->DbValue)) {
                $this->photo->EditValue = $this->id->CurrentValue;
                $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
            } else {
                $this->photo->EditValue = "";
            }
            if (!Config("CREATE_UPLOAD_FILE_ON_COPY")) {
                $this->photo->Upload->DbValue = null;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->photo);
            }

            // first_name
            $this->first_name->setupEditAttributes();
            if (!$this->first_name->Raw) {
                $this->first_name->CurrentValue = HtmlDecode($this->first_name->CurrentValue);
            }
            $this->first_name->EditValue = HtmlEncode($this->first_name->CurrentValue);
            $this->first_name->PlaceHolder = RemoveHtml($this->first_name->caption());

            // last_name
            $this->last_name->setupEditAttributes();
            if (!$this->last_name->Raw) {
                $this->last_name->CurrentValue = HtmlDecode($this->last_name->CurrentValue);
            }
            $this->last_name->EditValue = HtmlEncode($this->last_name->CurrentValue);
            $this->last_name->PlaceHolder = RemoveHtml($this->last_name->caption());

            // national_id
            $this->national_id->setupEditAttributes();
            $this->national_id->EditValue = $this->national_id->CurrentValue;
            $this->national_id->PlaceHolder = RemoveHtml($this->national_id->caption());
            if (strval($this->national_id->EditValue) != "" && is_numeric($this->national_id->EditValue)) {
                $this->national_id->EditValue = $this->national_id->EditValue;
            }

            // date_of_birth
            $this->date_of_birth->setupEditAttributes();
            $this->date_of_birth->EditValue = HtmlEncode(FormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern()));
            $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

            // gender
            $this->gender->EditValue = $this->gender->options(false);
            $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

            // phone
            $this->phone->setupEditAttributes();
            if (!$this->phone->Raw) {
                $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
            }
            $this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

            // email_address
            $this->email_address->setupEditAttributes();
            if (!$this->email_address->Raw) {
                $this->email_address->CurrentValue = HtmlDecode($this->email_address->CurrentValue);
            }
            $this->email_address->EditValue = HtmlEncode($this->email_address->CurrentValue);
            $this->email_address->PlaceHolder = RemoveHtml($this->email_address->caption());

            // physical_address
            $this->physical_address->setupEditAttributes();
            $this->physical_address->EditValue = HtmlEncode($this->physical_address->CurrentValue);
            $this->physical_address->PlaceHolder = RemoveHtml($this->physical_address->caption());

            // employment_status
            $this->employment_status->setupEditAttributes();
            $this->employment_status->EditValue = $this->employment_status->options(true);
            $this->employment_status->PlaceHolder = RemoveHtml($this->employment_status->caption());

            // religion
            $this->religion->setupEditAttributes();
            $this->religion->EditValue = $this->religion->options(true);
            $this->religion->PlaceHolder = RemoveHtml($this->religion->caption());

            // next_of_kin
            $this->next_of_kin->setupEditAttributes();
            if (!$this->next_of_kin->Raw) {
                $this->next_of_kin->CurrentValue = HtmlDecode($this->next_of_kin->CurrentValue);
            }
            $this->next_of_kin->EditValue = HtmlEncode($this->next_of_kin->CurrentValue);
            $this->next_of_kin->PlaceHolder = RemoveHtml($this->next_of_kin->caption());

            // next_of_kin_phone
            $this->next_of_kin_phone->setupEditAttributes();
            if (!$this->next_of_kin_phone->Raw) {
                $this->next_of_kin_phone->CurrentValue = HtmlDecode($this->next_of_kin_phone->CurrentValue);
            }
            $this->next_of_kin_phone->EditValue = HtmlEncode($this->next_of_kin_phone->CurrentValue);
            $this->next_of_kin_phone->PlaceHolder = RemoveHtml($this->next_of_kin_phone->caption());

            // marital_status
            $this->marital_status->setupEditAttributes();
            $this->marital_status->EditValue = $this->marital_status->options(true);
            $this->marital_status->PlaceHolder = RemoveHtml($this->marital_status->caption());

            // Add refer script

            // photo
            if (!empty($this->photo->Upload->DbValue)) {
                $this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->id->CurrentValue);
                $this->photo->LinkAttrs["target"] = "";
                if ($this->photo->IsBlobImage && empty($this->photo->LinkAttrs["target"])) {
                    $this->photo->LinkAttrs["target"] = "_blank";
                }
                if ($this->isExport()) {
                    $this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
                }
            } else {
                $this->photo->HrefValue = "";
            }
            $this->photo->ExportHrefValue = GetFileUploadUrl($this->photo, $this->id->CurrentValue);

            // first_name
            $this->first_name->HrefValue = "";

            // last_name
            $this->last_name->HrefValue = "";

            // national_id
            $this->national_id->HrefValue = "";

            // date_of_birth
            $this->date_of_birth->HrefValue = "";

            // gender
            $this->gender->HrefValue = "";

            // phone
            if (!EmptyValue($this->phone->CurrentValue)) {
                $this->phone->HrefValue = $this->phone->getLinkPrefix() . $this->phone->CurrentValue; // Add prefix/suffix
                $this->phone->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->phone->HrefValue = FullUrl($this->phone->HrefValue, "href");
                }
            } else {
                $this->phone->HrefValue = "";
            }

            // email_address
            if (!EmptyValue($this->email_address->CurrentValue)) {
                $this->email_address->HrefValue = $this->email_address->getLinkPrefix() . $this->email_address->CurrentValue; // Add prefix/suffix
                $this->email_address->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->email_address->HrefValue = FullUrl($this->email_address->HrefValue, "href");
                }
            } else {
                $this->email_address->HrefValue = "";
            }

            // physical_address
            $this->physical_address->HrefValue = "";

            // employment_status
            $this->employment_status->HrefValue = "";

            // religion
            $this->religion->HrefValue = "";

            // next_of_kin
            $this->next_of_kin->HrefValue = "";

            // next_of_kin_phone
            $this->next_of_kin_phone->HrefValue = "";

            // marital_status
            $this->marital_status->HrefValue = "";
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
            if ($this->photo->Visible && $this->photo->Required) {
                if ($this->photo->Upload->FileName == "" && !$this->photo->Upload->KeepFile) {
                    $this->photo->addErrorMessage(str_replace("%s", $this->photo->caption(), $this->photo->RequiredErrorMessage));
                }
            }
            if ($this->first_name->Visible && $this->first_name->Required) {
                if (!$this->first_name->IsDetailKey && EmptyValue($this->first_name->FormValue)) {
                    $this->first_name->addErrorMessage(str_replace("%s", $this->first_name->caption(), $this->first_name->RequiredErrorMessage));
                }
            }
            if ($this->last_name->Visible && $this->last_name->Required) {
                if (!$this->last_name->IsDetailKey && EmptyValue($this->last_name->FormValue)) {
                    $this->last_name->addErrorMessage(str_replace("%s", $this->last_name->caption(), $this->last_name->RequiredErrorMessage));
                }
            }
            if ($this->national_id->Visible && $this->national_id->Required) {
                if (!$this->national_id->IsDetailKey && EmptyValue($this->national_id->FormValue)) {
                    $this->national_id->addErrorMessage(str_replace("%s", $this->national_id->caption(), $this->national_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->national_id->FormValue)) {
                $this->national_id->addErrorMessage($this->national_id->getErrorMessage(false));
            }
            if ($this->date_of_birth->Visible && $this->date_of_birth->Required) {
                if (!$this->date_of_birth->IsDetailKey && EmptyValue($this->date_of_birth->FormValue)) {
                    $this->date_of_birth->addErrorMessage(str_replace("%s", $this->date_of_birth->caption(), $this->date_of_birth->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->date_of_birth->FormValue, $this->date_of_birth->formatPattern())) {
                $this->date_of_birth->addErrorMessage($this->date_of_birth->getErrorMessage(false));
            }
            if ($this->gender->Visible && $this->gender->Required) {
                if ($this->gender->FormValue == "") {
                    $this->gender->addErrorMessage(str_replace("%s", $this->gender->caption(), $this->gender->RequiredErrorMessage));
                }
            }
            if ($this->phone->Visible && $this->phone->Required) {
                if (!$this->phone->IsDetailKey && EmptyValue($this->phone->FormValue)) {
                    $this->phone->addErrorMessage(str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
                }
            }
            if ($this->email_address->Visible && $this->email_address->Required) {
                if (!$this->email_address->IsDetailKey && EmptyValue($this->email_address->FormValue)) {
                    $this->email_address->addErrorMessage(str_replace("%s", $this->email_address->caption(), $this->email_address->RequiredErrorMessage));
                }
            }
            if ($this->physical_address->Visible && $this->physical_address->Required) {
                if (!$this->physical_address->IsDetailKey && EmptyValue($this->physical_address->FormValue)) {
                    $this->physical_address->addErrorMessage(str_replace("%s", $this->physical_address->caption(), $this->physical_address->RequiredErrorMessage));
                }
            }
            if ($this->employment_status->Visible && $this->employment_status->Required) {
                if (!$this->employment_status->IsDetailKey && EmptyValue($this->employment_status->FormValue)) {
                    $this->employment_status->addErrorMessage(str_replace("%s", $this->employment_status->caption(), $this->employment_status->RequiredErrorMessage));
                }
            }
            if ($this->religion->Visible && $this->religion->Required) {
                if (!$this->religion->IsDetailKey && EmptyValue($this->religion->FormValue)) {
                    $this->religion->addErrorMessage(str_replace("%s", $this->religion->caption(), $this->religion->RequiredErrorMessage));
                }
            }
            if ($this->next_of_kin->Visible && $this->next_of_kin->Required) {
                if (!$this->next_of_kin->IsDetailKey && EmptyValue($this->next_of_kin->FormValue)) {
                    $this->next_of_kin->addErrorMessage(str_replace("%s", $this->next_of_kin->caption(), $this->next_of_kin->RequiredErrorMessage));
                }
            }
            if ($this->next_of_kin_phone->Visible && $this->next_of_kin_phone->Required) {
                if (!$this->next_of_kin_phone->IsDetailKey && EmptyValue($this->next_of_kin_phone->FormValue)) {
                    $this->next_of_kin_phone->addErrorMessage(str_replace("%s", $this->next_of_kin_phone->caption(), $this->next_of_kin_phone->RequiredErrorMessage));
                }
            }
            if ($this->marital_status->Visible && $this->marital_status->Required) {
                if (!$this->marital_status->IsDetailKey && EmptyValue($this->marital_status->FormValue)) {
                    $this->marital_status->addErrorMessage(str_replace("%s", $this->marital_status->caption(), $this->marital_status->RequiredErrorMessage));
                }
            }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("PatientAppointmentsGrid");
        if (in_array("patient_appointments", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PatientVisitsGrid");
        if (in_array("patient_visits", $detailTblVar) && $detailPage->DetailAdd) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PatientsDependantsGrid");
        if (in_array("patients_dependants", $detailTblVar) && $detailPage->DetailAdd) {
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
        if ($this->national_id->CurrentValue != "") { // Check field with unique index
            $filter = "(`national_id` = " . AdjustSql($this->national_id->CurrentValue, $this->Dbid) . ")";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->national_id->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->national_id->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
        if ($this->phone->CurrentValue != "") { // Check field with unique index
            $filter = "(`phone` = '" . AdjustSql($this->phone->CurrentValue, $this->Dbid) . "')";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->phone->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->phone->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
        if ($this->email_address->CurrentValue != "") { // Check field with unique index
            $filter = "(`email_address` = '" . AdjustSql($this->email_address->CurrentValue, $this->Dbid) . "')";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->email_address->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->email_address->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
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
            $detailPage = Container("PatientAppointmentsGrid");
            if (in_array("patient_appointments", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->patient_id->setSessionValue($this->id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patient_appointments"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PatientVisitsGrid");
            if (in_array("patient_visits", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->patient_id->setSessionValue($this->id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patient_visits"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->patient_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
            $detailPage = Container("PatientsDependantsGrid");
            if (in_array("patients_dependants", $detailTblVar) && $detailPage->DetailAdd && $addRow) {
                $detailPage->patient_id->setSessionValue($this->id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "patients_dependants"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
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

        // photo
        if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
            if ($this->photo->Upload->Value === null) {
                $rsnew['photo'] = null;
            } else {
                $rsnew['photo'] = $this->photo->Upload->Value;
            }
        }

        // first_name
        $this->first_name->setDbValueDef($rsnew, $this->first_name->CurrentValue, false);

        // last_name
        $this->last_name->setDbValueDef($rsnew, $this->last_name->CurrentValue, false);

        // national_id
        $this->national_id->setDbValueDef($rsnew, $this->national_id->CurrentValue, false);

        // date_of_birth
        $this->date_of_birth->setDbValueDef($rsnew, UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern()), false);

        // gender
        $this->gender->setDbValueDef($rsnew, $this->gender->CurrentValue, false);

        // phone
        $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, false);

        // email_address
        $this->email_address->setDbValueDef($rsnew, $this->email_address->CurrentValue, false);

        // physical_address
        $this->physical_address->setDbValueDef($rsnew, $this->physical_address->CurrentValue, false);

        // employment_status
        $this->employment_status->setDbValueDef($rsnew, $this->employment_status->CurrentValue, false);

        // religion
        $this->religion->setDbValueDef($rsnew, $this->religion->CurrentValue, false);

        // next_of_kin
        $this->next_of_kin->setDbValueDef($rsnew, $this->next_of_kin->CurrentValue, false);

        // next_of_kin_phone
        $this->next_of_kin_phone->setDbValueDef($rsnew, $this->next_of_kin_phone->CurrentValue, false);

        // marital_status
        $this->marital_status->setDbValueDef($rsnew, $this->marital_status->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['photo'])) { // photo
            $this->photo->setFormValue($row['photo']);
        }
        if (isset($row['first_name'])) { // first_name
            $this->first_name->setFormValue($row['first_name']);
        }
        if (isset($row['last_name'])) { // last_name
            $this->last_name->setFormValue($row['last_name']);
        }
        if (isset($row['national_id'])) { // national_id
            $this->national_id->setFormValue($row['national_id']);
        }
        if (isset($row['date_of_birth'])) { // date_of_birth
            $this->date_of_birth->setFormValue($row['date_of_birth']);
        }
        if (isset($row['gender'])) { // gender
            $this->gender->setFormValue($row['gender']);
        }
        if (isset($row['phone'])) { // phone
            $this->phone->setFormValue($row['phone']);
        }
        if (isset($row['email_address'])) { // email_address
            $this->email_address->setFormValue($row['email_address']);
        }
        if (isset($row['physical_address'])) { // physical_address
            $this->physical_address->setFormValue($row['physical_address']);
        }
        if (isset($row['employment_status'])) { // employment_status
            $this->employment_status->setFormValue($row['employment_status']);
        }
        if (isset($row['religion'])) { // religion
            $this->religion->setFormValue($row['religion']);
        }
        if (isset($row['next_of_kin'])) { // next_of_kin
            $this->next_of_kin->setFormValue($row['next_of_kin']);
        }
        if (isset($row['next_of_kin_phone'])) { // next_of_kin_phone
            $this->next_of_kin_phone->setFormValue($row['next_of_kin_phone']);
        }
        if (isset($row['marital_status'])) { // marital_status
            $this->marital_status->setFormValue($row['marital_status']);
        }
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
            if (in_array("patient_appointments", $detailTblVar)) {
                $detailPageObj = Container("PatientAppointmentsGrid");
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
                    $detailPageObj->patient_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("patient_visits", $detailTblVar)) {
                $detailPageObj = Container("PatientVisitsGrid");
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
                    $detailPageObj->patient_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->patient_id->setSessionValue($detailPageObj->patient_id->CurrentValue);
                }
            }
            if (in_array("patients_dependants", $detailTblVar)) {
                $detailPageObj = Container("PatientsDependantsGrid");
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
                    $detailPageObj->patient_id->CurrentValue = $this->id->CurrentValue;
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("patientslist"), "", $this->TableVar, true);
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
                case "x_gender":
                    break;
                case "x_employment_status":
                    break;
                case "x_religion":
                    break;
                case "x_marital_status":
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
