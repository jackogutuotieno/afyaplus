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
class UsersAdd extends Users
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "UsersAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "usersadd";

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
        $this->full_name->Visible = false;
        $this->first_name->setVisibility();
        $this->last_name->setVisibility();
        $this->national_id->setVisibility();
        $this->gender->setVisibility();
        $this->phone->setVisibility();
        $this->_email->setVisibility();
        $this->department_id->setVisibility();
        $this->designation_id->setVisibility();
        $this->physical_address->setVisibility();
        $this->_password->setVisibility();
        $this->user_role_id->setVisibility();
        $this->is_verified->setVisibility();
        $this->user_profile->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'users';
        $this->TableName = 'users';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (users)
        if (!isset($GLOBALS["users"]) || $GLOBALS["users"]::class == PROJECT_NAMESPACE . "users") {
            $GLOBALS["users"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'users');
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
                        $result["view"] = SameString($pageName, "usersview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->department_id);
        $this->setupLookupOptions($this->designation_id);
        $this->setupLookupOptions($this->user_role_id);
        $this->setupLookupOptions($this->is_verified);

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
                    $this->terminate("userslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "userslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "usersview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "userslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "userslist"; // Return list page content
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
        $this->photo->Upload->Index = $CurrentForm->Index;
        $this->photo->Upload->uploadFile();
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->user_role_id->DefaultValue = $this->user_role_id->getDefault(); // PHP
        $this->user_role_id->OldValue = $this->user_role_id->DefaultValue;
        $this->is_verified->DefaultValue = $this->is_verified->getDefault(); // PHP
        $this->is_verified->OldValue = $this->is_verified->DefaultValue;
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

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
            }
        }

        // Check field name 'department_id' first before field var 'x_department_id'
        $val = $CurrentForm->hasValue("department_id") ? $CurrentForm->getValue("department_id") : $CurrentForm->getValue("x_department_id");
        if (!$this->department_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->department_id->Visible = false; // Disable update for API request
            } else {
                $this->department_id->setFormValue($val);
            }
        }

        // Check field name 'designation_id' first before field var 'x_designation_id'
        $val = $CurrentForm->hasValue("designation_id") ? $CurrentForm->getValue("designation_id") : $CurrentForm->getValue("x_designation_id");
        if (!$this->designation_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->designation_id->Visible = false; // Disable update for API request
            } else {
                $this->designation_id->setFormValue($val);
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

        // Check field name 'password' first before field var 'x__password'
        $val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x__password");
        if (!$this->_password->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_password->Visible = false; // Disable update for API request
            } else {
                $this->_password->setFormValue($val);
            }
        }

        // Check field name 'user_role_id' first before field var 'x_user_role_id'
        $val = $CurrentForm->hasValue("user_role_id") ? $CurrentForm->getValue("user_role_id") : $CurrentForm->getValue("x_user_role_id");
        if (!$this->user_role_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_role_id->Visible = false; // Disable update for API request
            } else {
                $this->user_role_id->setFormValue($val);
            }
        }

        // Check field name 'is_verified' first before field var 'x_is_verified'
        $val = $CurrentForm->hasValue("is_verified") ? $CurrentForm->getValue("is_verified") : $CurrentForm->getValue("x_is_verified");
        if (!$this->is_verified->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->is_verified->Visible = false; // Disable update for API request
            } else {
                $this->is_verified->setFormValue($val);
            }
        }

        // Check field name 'user_profile' first before field var 'x_user_profile'
        $val = $CurrentForm->hasValue("user_profile") ? $CurrentForm->getValue("user_profile") : $CurrentForm->getValue("x_user_profile");
        if (!$this->user_profile->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_profile->Visible = false; // Disable update for API request
            } else {
                $this->user_profile->setFormValue($val);
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
        $this->gender->CurrentValue = $this->gender->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->department_id->CurrentValue = $this->department_id->FormValue;
        $this->designation_id->CurrentValue = $this->designation_id->FormValue;
        $this->physical_address->CurrentValue = $this->physical_address->FormValue;
        $this->_password->CurrentValue = $this->_password->FormValue;
        $this->user_role_id->CurrentValue = $this->user_role_id->FormValue;
        $this->is_verified->CurrentValue = $this->is_verified->FormValue;
        $this->user_profile->CurrentValue = $this->user_profile->FormValue;
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
        $this->photo->Upload->DbValue = $row['photo'];
        if (is_resource($this->photo->Upload->DbValue) && get_resource_type($this->photo->Upload->DbValue) == "stream") { // Byte array
            $this->photo->Upload->DbValue = stream_get_contents($this->photo->Upload->DbValue);
        }
        $this->full_name->setDbValue($row['full_name']);
        $this->first_name->setDbValue($row['first_name']);
        $this->last_name->setDbValue($row['last_name']);
        $this->national_id->setDbValue($row['national_id']);
        $this->gender->setDbValue($row['gender']);
        $this->phone->setDbValue($row['phone']);
        $this->_email->setDbValue($row['email']);
        $this->department_id->setDbValue($row['department_id']);
        $this->designation_id->setDbValue($row['designation_id']);
        $this->physical_address->setDbValue($row['physical_address']);
        $this->_password->setDbValue($row['password']);
        $this->user_role_id->setDbValue($row['user_role_id']);
        $this->is_verified->setDbValue($row['is_verified']);
        $this->user_profile->setDbValue($row['user_profile']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['photo'] = $this->photo->DefaultValue;
        $row['full_name'] = $this->full_name->DefaultValue;
        $row['first_name'] = $this->first_name->DefaultValue;
        $row['last_name'] = $this->last_name->DefaultValue;
        $row['national_id'] = $this->national_id->DefaultValue;
        $row['gender'] = $this->gender->DefaultValue;
        $row['phone'] = $this->phone->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['department_id'] = $this->department_id->DefaultValue;
        $row['designation_id'] = $this->designation_id->DefaultValue;
        $row['physical_address'] = $this->physical_address->DefaultValue;
        $row['password'] = $this->_password->DefaultValue;
        $row['user_role_id'] = $this->user_role_id->DefaultValue;
        $row['is_verified'] = $this->is_verified->DefaultValue;
        $row['user_profile'] = $this->user_profile->DefaultValue;
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

        // full_name
        $this->full_name->RowCssClass = "row";

        // first_name
        $this->first_name->RowCssClass = "row";

        // last_name
        $this->last_name->RowCssClass = "row";

        // national_id
        $this->national_id->RowCssClass = "row";

        // gender
        $this->gender->RowCssClass = "row";

        // phone
        $this->phone->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // department_id
        $this->department_id->RowCssClass = "row";

        // designation_id
        $this->designation_id->RowCssClass = "row";

        // physical_address
        $this->physical_address->RowCssClass = "row";

        // password
        $this->_password->RowCssClass = "row";

        // user_role_id
        $this->user_role_id->RowCssClass = "row";

        // is_verified
        $this->is_verified->RowCssClass = "row";

        // user_profile
        $this->user_profile->RowCssClass = "row";

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
                $this->photo->ImageWidth = 50;
                $this->photo->ImageHeight = 50;
                $this->photo->ImageAlt = $this->photo->alt();
                $this->photo->ImageCssClass = "ew-image";
                $this->photo->ViewValue = $this->id->CurrentValue;
                $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
            } else {
                $this->photo->ViewValue = "";
            }

            // full_name
            $this->full_name->ViewValue = $this->full_name->CurrentValue;

            // first_name
            $this->first_name->ViewValue = $this->first_name->CurrentValue;

            // last_name
            $this->last_name->ViewValue = $this->last_name->CurrentValue;

            // national_id
            $this->national_id->ViewValue = $this->national_id->CurrentValue;

            // gender
            if (strval($this->gender->CurrentValue) != "") {
                $this->gender->ViewValue = $this->gender->optionCaption($this->gender->CurrentValue);
            } else {
                $this->gender->ViewValue = null;
            }

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;

            // department_id
            $curVal = strval($this->department_id->CurrentValue);
            if ($curVal != "") {
                $this->department_id->ViewValue = $this->department_id->lookupCacheOption($curVal);
                if ($this->department_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->department_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->department_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->department_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->department_id->Lookup->renderViewRow($rswrk[0]);
                        $this->department_id->ViewValue = $this->department_id->displayValue($arwrk);
                    } else {
                        $this->department_id->ViewValue = FormatNumber($this->department_id->CurrentValue, $this->department_id->formatPattern());
                    }
                }
            } else {
                $this->department_id->ViewValue = null;
            }

            // designation_id
            $curVal = strval($this->designation_id->CurrentValue);
            if ($curVal != "") {
                $this->designation_id->ViewValue = $this->designation_id->lookupCacheOption($curVal);
                if ($this->designation_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->designation_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->designation_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->designation_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->designation_id->Lookup->renderViewRow($rswrk[0]);
                        $this->designation_id->ViewValue = $this->designation_id->displayValue($arwrk);
                    } else {
                        $this->designation_id->ViewValue = FormatNumber($this->designation_id->CurrentValue, $this->designation_id->formatPattern());
                    }
                }
            } else {
                $this->designation_id->ViewValue = null;
            }

            // physical_address
            $this->physical_address->ViewValue = $this->physical_address->CurrentValue;

            // password
            $this->_password->ViewValue = $Language->phrase("PasswordMask");

            // user_role_id
            if ($Security->canAdmin()) { // System admin
                if (strval($this->user_role_id->CurrentValue) != "") {
                    $this->user_role_id->ViewValue = $this->user_role_id->optionCaption($this->user_role_id->CurrentValue);
                } else {
                    $this->user_role_id->ViewValue = null;
                }
            } else {
                $this->user_role_id->ViewValue = $Language->phrase("PasswordMask");
            }

            // is_verified
            if (ConvertToBool($this->is_verified->CurrentValue)) {
                $this->is_verified->ViewValue = $this->is_verified->tagCaption(1) != "" ? $this->is_verified->tagCaption(1) : "Yes";
            } else {
                $this->is_verified->ViewValue = $this->is_verified->tagCaption(2) != "" ? $this->is_verified->tagCaption(2) : "No";
            }

            // user_profile
            $this->user_profile->ViewValue = $this->user_profile->CurrentValue;

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

            // email
            if (!EmptyValue($this->_email->CurrentValue)) {
                $this->_email->HrefValue = $this->_email->getLinkPrefix() . $this->_email->CurrentValue; // Add prefix/suffix
                $this->_email->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->_email->HrefValue = FullUrl($this->_email->HrefValue, "href");
                }
            } else {
                $this->_email->HrefValue = "";
            }

            // department_id
            $this->department_id->HrefValue = "";

            // designation_id
            $this->designation_id->HrefValue = "";

            // physical_address
            $this->physical_address->HrefValue = "";

            // password
            $this->_password->HrefValue = "";

            // user_role_id
            $this->user_role_id->HrefValue = "";

            // is_verified
            $this->is_verified->HrefValue = "";

            // user_profile
            $this->user_profile->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // photo
            $this->photo->setupEditAttributes();
            if (!EmptyValue($this->photo->Upload->DbValue)) {
                $this->photo->ImageWidth = 50;
                $this->photo->ImageHeight = 50;
                $this->photo->ImageAlt = $this->photo->alt();
                $this->photo->ImageCssClass = "ew-image";
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

            // email
            $this->_email->setupEditAttributes();
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // department_id
            $this->department_id->setupEditAttributes();
            $curVal = trim(strval($this->department_id->CurrentValue));
            if ($curVal != "") {
                $this->department_id->ViewValue = $this->department_id->lookupCacheOption($curVal);
            } else {
                $this->department_id->ViewValue = $this->department_id->Lookup !== null && is_array($this->department_id->lookupOptions()) && count($this->department_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->department_id->ViewValue !== null) { // Load from cache
                $this->department_id->EditValue = array_values($this->department_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->department_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->department_id->CurrentValue, $this->department_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->department_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->department_id->EditValue = $arwrk;
            }
            $this->department_id->PlaceHolder = RemoveHtml($this->department_id->caption());

            // designation_id
            $this->designation_id->setupEditAttributes();
            $curVal = trim(strval($this->designation_id->CurrentValue));
            if ($curVal != "") {
                $this->designation_id->ViewValue = $this->designation_id->lookupCacheOption($curVal);
            } else {
                $this->designation_id->ViewValue = $this->designation_id->Lookup !== null && is_array($this->designation_id->lookupOptions()) && count($this->designation_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->designation_id->ViewValue !== null) { // Load from cache
                $this->designation_id->EditValue = array_values($this->designation_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->designation_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->designation_id->CurrentValue, $this->designation_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->designation_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->designation_id->EditValue = $arwrk;
            }
            $this->designation_id->PlaceHolder = RemoveHtml($this->designation_id->caption());

            // physical_address
            $this->physical_address->setupEditAttributes();
            $this->physical_address->EditValue = HtmlEncode($this->physical_address->CurrentValue);
            $this->physical_address->PlaceHolder = RemoveHtml($this->physical_address->caption());

            // password
            $this->_password->setupEditAttributes();
            $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

            // user_role_id
            $this->user_role_id->setupEditAttributes();
            if (!$Security->canAdmin()) { // System admin
                $this->user_role_id->EditValue = $Language->phrase("PasswordMask");
            } else {
                $this->user_role_id->EditValue = $this->user_role_id->options(true);
                $this->user_role_id->PlaceHolder = RemoveHtml($this->user_role_id->caption());
            }

            // is_verified
            $this->is_verified->EditValue = $this->is_verified->options(false);
            $this->is_verified->PlaceHolder = RemoveHtml($this->is_verified->caption());

            // user_profile
            $this->user_profile->setupEditAttributes();
            if (!$this->user_profile->Raw) {
                $this->user_profile->CurrentValue = HtmlDecode($this->user_profile->CurrentValue);
            }
            $this->user_profile->EditValue = HtmlEncode($this->user_profile->CurrentValue);
            $this->user_profile->PlaceHolder = RemoveHtml($this->user_profile->caption());

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

            // email
            if (!EmptyValue($this->_email->CurrentValue)) {
                $this->_email->HrefValue = $this->_email->getLinkPrefix() . $this->_email->CurrentValue; // Add prefix/suffix
                $this->_email->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->_email->HrefValue = FullUrl($this->_email->HrefValue, "href");
                }
            } else {
                $this->_email->HrefValue = "";
            }

            // department_id
            $this->department_id->HrefValue = "";

            // designation_id
            $this->designation_id->HrefValue = "";

            // physical_address
            $this->physical_address->HrefValue = "";

            // password
            $this->_password->HrefValue = "";

            // user_role_id
            $this->user_role_id->HrefValue = "";

            // is_verified
            $this->is_verified->HrefValue = "";

            // user_profile
            $this->user_profile->HrefValue = "";
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
            if ($this->_email->Visible && $this->_email->Required) {
                if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                    $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
                }
            }
            if (!$this->_email->Raw && Config("REMOVE_XSS") && CheckUsername($this->_email->FormValue)) {
                $this->_email->addErrorMessage($Language->phrase("InvalidUsernameChars"));
            }
            if ($this->department_id->Visible && $this->department_id->Required) {
                if (!$this->department_id->IsDetailKey && EmptyValue($this->department_id->FormValue)) {
                    $this->department_id->addErrorMessage(str_replace("%s", $this->department_id->caption(), $this->department_id->RequiredErrorMessage));
                }
            }
            if ($this->designation_id->Visible && $this->designation_id->Required) {
                if (!$this->designation_id->IsDetailKey && EmptyValue($this->designation_id->FormValue)) {
                    $this->designation_id->addErrorMessage(str_replace("%s", $this->designation_id->caption(), $this->designation_id->RequiredErrorMessage));
                }
            }
            if ($this->physical_address->Visible && $this->physical_address->Required) {
                if (!$this->physical_address->IsDetailKey && EmptyValue($this->physical_address->FormValue)) {
                    $this->physical_address->addErrorMessage(str_replace("%s", $this->physical_address->caption(), $this->physical_address->RequiredErrorMessage));
                }
            }
            if ($this->_password->Visible && $this->_password->Required) {
                if (!$this->_password->IsDetailKey && EmptyValue($this->_password->FormValue)) {
                    $this->_password->addErrorMessage(str_replace("%s", $this->_password->caption(), $this->_password->RequiredErrorMessage));
                }
            }
            if (!$this->_password->Raw && Config("REMOVE_XSS") && CheckPassword($this->_password->FormValue)) {
                $this->_password->addErrorMessage($Language->phrase("InvalidPasswordChars"));
            }
            if ($this->user_role_id->Visible && $this->user_role_id->Required) {
                if ($Security->canAdmin() && !$this->user_role_id->IsDetailKey && EmptyValue($this->user_role_id->FormValue)) {
                    $this->user_role_id->addErrorMessage(str_replace("%s", $this->user_role_id->caption(), $this->user_role_id->RequiredErrorMessage));
                }
            }
            if ($this->is_verified->Visible && $this->is_verified->Required) {
                if ($this->is_verified->FormValue == "") {
                    $this->is_verified->addErrorMessage(str_replace("%s", $this->is_verified->caption(), $this->is_verified->RequiredErrorMessage));
                }
            }
            if ($this->user_profile->Visible && $this->user_profile->Required) {
                if (!$this->user_profile->IsDetailKey && EmptyValue($this->user_profile->FormValue)) {
                    $this->user_profile->addErrorMessage(str_replace("%s", $this->user_profile->caption(), $this->user_profile->RequiredErrorMessage));
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

        // Check if valid User ID
        if (
            !EmptyValue($Security->currentUserID()) &&
            !$Security->isAdmin() && // Non system admin
            !$Security->isValidUserID($this->id->CurrentValue)
        ) {
            $userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
            $userIdMsg = str_replace("%u", strval($this->id->CurrentValue), $userIdMsg);
            $this->setFailureMessage($userIdMsg);
            return false;
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

        // gender
        $this->gender->setDbValueDef($rsnew, $this->gender->CurrentValue, false);

        // phone
        $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, false);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, false);

        // department_id
        $this->department_id->setDbValueDef($rsnew, $this->department_id->CurrentValue, false);

        // designation_id
        $this->designation_id->setDbValueDef($rsnew, $this->designation_id->CurrentValue, false);

        // physical_address
        $this->physical_address->setDbValueDef($rsnew, $this->physical_address->CurrentValue, false);

        // password
        if (!IsMaskedPassword($this->_password->CurrentValue)) {
            $this->_password->setDbValueDef($rsnew, $this->_password->CurrentValue, false);
        }

        // user_role_id
        if ($Security->canAdmin()) { // System admin
            $this->user_role_id->setDbValueDef($rsnew, $this->user_role_id->CurrentValue, strval($this->user_role_id->CurrentValue) == "");
        }

        // is_verified
        $tmpBool = $this->is_verified->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->is_verified->setDbValueDef($rsnew, $tmpBool, strval($this->is_verified->CurrentValue) == "");

        // user_profile
        $this->user_profile->setDbValueDef($rsnew, $this->user_profile->CurrentValue, false);

        // id
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
        if (isset($row['gender'])) { // gender
            $this->gender->setFormValue($row['gender']);
        }
        if (isset($row['phone'])) { // phone
            $this->phone->setFormValue($row['phone']);
        }
        if (isset($row['email'])) { // email
            $this->_email->setFormValue($row['email']);
        }
        if (isset($row['department_id'])) { // department_id
            $this->department_id->setFormValue($row['department_id']);
        }
        if (isset($row['designation_id'])) { // designation_id
            $this->designation_id->setFormValue($row['designation_id']);
        }
        if (isset($row['physical_address'])) { // physical_address
            $this->physical_address->setFormValue($row['physical_address']);
        }
        if (isset($row['password'])) { // password
            $this->_password->setFormValue($row['password']);
        }
        if (isset($row['user_role_id'])) { // user_role_id
            $this->user_role_id->setFormValue($row['user_role_id']);
        }
        if (isset($row['is_verified'])) { // is_verified
            $this->is_verified->setFormValue($row['is_verified']);
        }
        if (isset($row['user_profile'])) { // user_profile
            $this->user_profile->setFormValue($row['user_profile']);
        }
        if (isset($row['id'])) { // id
            $this->id->setFormValue($row['id']);
        }
    }

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->id->CurrentValue);
        }
        return true;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("userslist"), "", $this->TableVar, true);
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
                case "x_department_id":
                    break;
                case "x_designation_id":
                    break;
                case "x_user_role_id":
                    break;
                case "x_is_verified":
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
