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
class BedsAdd extends Beds
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "BedsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "bedsadd";

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
        $this->floor_id->setVisibility();
        $this->ward_type_id->setVisibility();
        $this->ward_id->setVisibility();
        $this->bed_name->setVisibility();
        $this->bed_charges->setVisibility();
        $this->date_created->Visible = false;
        $this->date_updated->Visible = false;
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'beds';
        $this->TableName = 'beds';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (beds)
        if (!isset($GLOBALS["beds"]) || $GLOBALS["beds"]::class == PROJECT_NAMESPACE . "beds") {
            $GLOBALS["beds"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'beds');
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
                        $result["view"] = SameString($pageName, "bedsview"); // If View page, no primary button
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
        $this->setupLookupOptions($this->floor_id);
        $this->setupLookupOptions($this->ward_type_id);
        $this->setupLookupOptions($this->ward_id);

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
                    $this->terminate("bedslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "bedslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "bedsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions && !$this->getCurrentMasterTable()) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "bedslist") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "bedslist"; // Return list page content
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

        // Check field name 'floor_id' first before field var 'x_floor_id'
        $val = $CurrentForm->hasValue("floor_id") ? $CurrentForm->getValue("floor_id") : $CurrentForm->getValue("x_floor_id");
        if (!$this->floor_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->floor_id->Visible = false; // Disable update for API request
            } else {
                $this->floor_id->setFormValue($val);
            }
        }

        // Check field name 'ward_type_id' first before field var 'x_ward_type_id'
        $val = $CurrentForm->hasValue("ward_type_id") ? $CurrentForm->getValue("ward_type_id") : $CurrentForm->getValue("x_ward_type_id");
        if (!$this->ward_type_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ward_type_id->Visible = false; // Disable update for API request
            } else {
                $this->ward_type_id->setFormValue($val);
            }
        }

        // Check field name 'ward_id' first before field var 'x_ward_id'
        $val = $CurrentForm->hasValue("ward_id") ? $CurrentForm->getValue("ward_id") : $CurrentForm->getValue("x_ward_id");
        if (!$this->ward_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ward_id->Visible = false; // Disable update for API request
            } else {
                $this->ward_id->setFormValue($val);
            }
        }

        // Check field name 'bed_name' first before field var 'x_bed_name'
        $val = $CurrentForm->hasValue("bed_name") ? $CurrentForm->getValue("bed_name") : $CurrentForm->getValue("x_bed_name");
        if (!$this->bed_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bed_name->Visible = false; // Disable update for API request
            } else {
                $this->bed_name->setFormValue($val);
            }
        }

        // Check field name 'bed_charges' first before field var 'x_bed_charges'
        $val = $CurrentForm->hasValue("bed_charges") ? $CurrentForm->getValue("bed_charges") : $CurrentForm->getValue("x_bed_charges");
        if (!$this->bed_charges->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bed_charges->Visible = false; // Disable update for API request
            } else {
                $this->bed_charges->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->floor_id->CurrentValue = $this->floor_id->FormValue;
        $this->ward_type_id->CurrentValue = $this->ward_type_id->FormValue;
        $this->ward_id->CurrentValue = $this->ward_id->FormValue;
        $this->bed_name->CurrentValue = $this->bed_name->FormValue;
        $this->bed_charges->CurrentValue = $this->bed_charges->FormValue;
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
        $this->floor_id->setDbValue($row['floor_id']);
        $this->ward_type_id->setDbValue($row['ward_type_id']);
        $this->ward_id->setDbValue($row['ward_id']);
        $this->bed_name->setDbValue($row['bed_name']);
        $this->bed_charges->setDbValue($row['bed_charges']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['floor_id'] = $this->floor_id->DefaultValue;
        $row['ward_type_id'] = $this->ward_type_id->DefaultValue;
        $row['ward_id'] = $this->ward_id->DefaultValue;
        $row['bed_name'] = $this->bed_name->DefaultValue;
        $row['bed_charges'] = $this->bed_charges->DefaultValue;
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

        // floor_id
        $this->floor_id->RowCssClass = "row";

        // ward_type_id
        $this->ward_type_id->RowCssClass = "row";

        // ward_id
        $this->ward_id->RowCssClass = "row";

        // bed_name
        $this->bed_name->RowCssClass = "row";

        // bed_charges
        $this->bed_charges->RowCssClass = "row";

        // date_created
        $this->date_created->RowCssClass = "row";

        // date_updated
        $this->date_updated->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // floor_id
            $curVal = strval($this->floor_id->CurrentValue);
            if ($curVal != "") {
                $this->floor_id->ViewValue = $this->floor_id->lookupCacheOption($curVal);
                if ($this->floor_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->floor_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->floor_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->floor_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->floor_id->Lookup->renderViewRow($rswrk[0]);
                        $this->floor_id->ViewValue = $this->floor_id->displayValue($arwrk);
                    } else {
                        $this->floor_id->ViewValue = FormatNumber($this->floor_id->CurrentValue, $this->floor_id->formatPattern());
                    }
                }
            } else {
                $this->floor_id->ViewValue = null;
            }

            // ward_type_id
            $curVal = strval($this->ward_type_id->CurrentValue);
            if ($curVal != "") {
                $this->ward_type_id->ViewValue = $this->ward_type_id->lookupCacheOption($curVal);
                if ($this->ward_type_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->ward_type_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->ward_type_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->ward_type_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ward_type_id->Lookup->renderViewRow($rswrk[0]);
                        $this->ward_type_id->ViewValue = $this->ward_type_id->displayValue($arwrk);
                    } else {
                        $this->ward_type_id->ViewValue = FormatNumber($this->ward_type_id->CurrentValue, $this->ward_type_id->formatPattern());
                    }
                }
            } else {
                $this->ward_type_id->ViewValue = null;
            }

            // ward_id
            $curVal = strval($this->ward_id->CurrentValue);
            if ($curVal != "") {
                $this->ward_id->ViewValue = $this->ward_id->lookupCacheOption($curVal);
                if ($this->ward_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->ward_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->ward_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    $sqlWrk = $this->ward_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ward_id->Lookup->renderViewRow($rswrk[0]);
                        $this->ward_id->ViewValue = $this->ward_id->displayValue($arwrk);
                    } else {
                        $this->ward_id->ViewValue = FormatNumber($this->ward_id->CurrentValue, $this->ward_id->formatPattern());
                    }
                }
            } else {
                $this->ward_id->ViewValue = null;
            }

            // bed_name
            $this->bed_name->ViewValue = $this->bed_name->CurrentValue;

            // bed_charges
            $this->bed_charges->ViewValue = $this->bed_charges->CurrentValue;
            $this->bed_charges->ViewValue = FormatNumber($this->bed_charges->ViewValue, $this->bed_charges->formatPattern());

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

            // date_updated
            $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
            $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

            // floor_id
            $this->floor_id->HrefValue = "";

            // ward_type_id
            $this->ward_type_id->HrefValue = "";

            // ward_id
            $this->ward_id->HrefValue = "";

            // bed_name
            $this->bed_name->HrefValue = "";

            // bed_charges
            $this->bed_charges->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // floor_id
            $this->floor_id->setupEditAttributes();
            $curVal = trim(strval($this->floor_id->CurrentValue));
            if ($curVal != "") {
                $this->floor_id->ViewValue = $this->floor_id->lookupCacheOption($curVal);
            } else {
                $this->floor_id->ViewValue = $this->floor_id->Lookup !== null && is_array($this->floor_id->lookupOptions()) && count($this->floor_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->floor_id->ViewValue !== null) { // Load from cache
                $this->floor_id->EditValue = array_values($this->floor_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->floor_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->floor_id->CurrentValue, $this->floor_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->floor_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->floor_id->EditValue = $arwrk;
            }
            $this->floor_id->PlaceHolder = RemoveHtml($this->floor_id->caption());

            // ward_type_id
            $this->ward_type_id->setupEditAttributes();
            $curVal = trim(strval($this->ward_type_id->CurrentValue));
            if ($curVal != "") {
                $this->ward_type_id->ViewValue = $this->ward_type_id->lookupCacheOption($curVal);
            } else {
                $this->ward_type_id->ViewValue = $this->ward_type_id->Lookup !== null && is_array($this->ward_type_id->lookupOptions()) && count($this->ward_type_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->ward_type_id->ViewValue !== null) { // Load from cache
                $this->ward_type_id->EditValue = array_values($this->ward_type_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->ward_type_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->ward_type_id->CurrentValue, $this->ward_type_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                }
                $sqlWrk = $this->ward_type_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->ward_type_id->EditValue = $arwrk;
            }
            $this->ward_type_id->PlaceHolder = RemoveHtml($this->ward_type_id->caption());

            // ward_id
            $this->ward_id->setupEditAttributes();
            if ($this->ward_id->getSessionValue() != "") {
                $this->ward_id->CurrentValue = GetForeignKeyValue($this->ward_id->getSessionValue());
                $curVal = strval($this->ward_id->CurrentValue);
                if ($curVal != "") {
                    $this->ward_id->ViewValue = $this->ward_id->lookupCacheOption($curVal);
                    if ($this->ward_id->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter($this->ward_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->ward_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                        $sqlWrk = $this->ward_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCache($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->ward_id->Lookup->renderViewRow($rswrk[0]);
                            $this->ward_id->ViewValue = $this->ward_id->displayValue($arwrk);
                        } else {
                            $this->ward_id->ViewValue = FormatNumber($this->ward_id->CurrentValue, $this->ward_id->formatPattern());
                        }
                    }
                } else {
                    $this->ward_id->ViewValue = null;
                }
            } else {
                $curVal = trim(strval($this->ward_id->CurrentValue));
                if ($curVal != "") {
                    $this->ward_id->ViewValue = $this->ward_id->lookupCacheOption($curVal);
                } else {
                    $this->ward_id->ViewValue = $this->ward_id->Lookup !== null && is_array($this->ward_id->lookupOptions()) && count($this->ward_id->lookupOptions()) > 0 ? $curVal : null;
                }
                if ($this->ward_id->ViewValue !== null) { // Load from cache
                    $this->ward_id->EditValue = array_values($this->ward_id->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter($this->ward_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $this->ward_id->CurrentValue, $this->ward_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                    }
                    $sqlWrk = $this->ward_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->ward_id->EditValue = $arwrk;
                }
                $this->ward_id->PlaceHolder = RemoveHtml($this->ward_id->caption());
            }

            // bed_name
            $this->bed_name->setupEditAttributes();
            if (!$this->bed_name->Raw) {
                $this->bed_name->CurrentValue = HtmlDecode($this->bed_name->CurrentValue);
            }
            $this->bed_name->EditValue = HtmlEncode($this->bed_name->CurrentValue);
            $this->bed_name->PlaceHolder = RemoveHtml($this->bed_name->caption());

            // bed_charges
            $this->bed_charges->setupEditAttributes();
            $this->bed_charges->EditValue = $this->bed_charges->CurrentValue;
            $this->bed_charges->PlaceHolder = RemoveHtml($this->bed_charges->caption());
            if (strval($this->bed_charges->EditValue) != "" && is_numeric($this->bed_charges->EditValue)) {
                $this->bed_charges->EditValue = FormatNumber($this->bed_charges->EditValue, null);
            }

            // Add refer script

            // floor_id
            $this->floor_id->HrefValue = "";

            // ward_type_id
            $this->ward_type_id->HrefValue = "";

            // ward_id
            $this->ward_id->HrefValue = "";

            // bed_name
            $this->bed_name->HrefValue = "";

            // bed_charges
            $this->bed_charges->HrefValue = "";
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
            if ($this->floor_id->Visible && $this->floor_id->Required) {
                if (!$this->floor_id->IsDetailKey && EmptyValue($this->floor_id->FormValue)) {
                    $this->floor_id->addErrorMessage(str_replace("%s", $this->floor_id->caption(), $this->floor_id->RequiredErrorMessage));
                }
            }
            if ($this->ward_type_id->Visible && $this->ward_type_id->Required) {
                if (!$this->ward_type_id->IsDetailKey && EmptyValue($this->ward_type_id->FormValue)) {
                    $this->ward_type_id->addErrorMessage(str_replace("%s", $this->ward_type_id->caption(), $this->ward_type_id->RequiredErrorMessage));
                }
            }
            if ($this->ward_id->Visible && $this->ward_id->Required) {
                if (!$this->ward_id->IsDetailKey && EmptyValue($this->ward_id->FormValue)) {
                    $this->ward_id->addErrorMessage(str_replace("%s", $this->ward_id->caption(), $this->ward_id->RequiredErrorMessage));
                }
            }
            if ($this->bed_name->Visible && $this->bed_name->Required) {
                if (!$this->bed_name->IsDetailKey && EmptyValue($this->bed_name->FormValue)) {
                    $this->bed_name->addErrorMessage(str_replace("%s", $this->bed_name->caption(), $this->bed_name->RequiredErrorMessage));
                }
            }
            if ($this->bed_charges->Visible && $this->bed_charges->Required) {
                if (!$this->bed_charges->IsDetailKey && EmptyValue($this->bed_charges->FormValue)) {
                    $this->bed_charges->addErrorMessage(str_replace("%s", $this->bed_charges->caption(), $this->bed_charges->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->bed_charges->FormValue)) {
                $this->bed_charges->addErrorMessage($this->bed_charges->getErrorMessage(false));
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

        // floor_id
        $this->floor_id->setDbValueDef($rsnew, $this->floor_id->CurrentValue, false);

        // ward_type_id
        $this->ward_type_id->setDbValueDef($rsnew, $this->ward_type_id->CurrentValue, false);

        // ward_id
        $this->ward_id->setDbValueDef($rsnew, $this->ward_id->CurrentValue, false);

        // bed_name
        $this->bed_name->setDbValueDef($rsnew, $this->bed_name->CurrentValue, false);

        // bed_charges
        $this->bed_charges->setDbValueDef($rsnew, $this->bed_charges->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['floor_id'])) { // floor_id
            $this->floor_id->setFormValue($row['floor_id']);
        }
        if (isset($row['ward_type_id'])) { // ward_type_id
            $this->ward_type_id->setFormValue($row['ward_type_id']);
        }
        if (isset($row['ward_id'])) { // ward_id
            $this->ward_id->setFormValue($row['ward_id']);
        }
        if (isset($row['bed_name'])) { // bed_name
            $this->bed_name->setFormValue($row['bed_name']);
        }
        if (isset($row['bed_charges'])) { // bed_charges
            $this->bed_charges->setFormValue($row['bed_charges']);
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
            if ($masterTblVar == "wards") {
                $validMaster = true;
                $masterTbl = Container("wards");
                if (($parm = Get("fk_id", Get("ward_id"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->ward_id->QueryStringValue = $masterTbl->id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->ward_id->setSessionValue($this->ward_id->QueryStringValue);
                    $foreignKeys["ward_id"] = $this->ward_id->QueryStringValue;
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
            if ($masterTblVar == "wards") {
                $validMaster = true;
                $masterTbl = Container("wards");
                if (($parm = Post("fk_id", Post("ward_id"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->ward_id->FormValue = $masterTbl->id->FormValue;
                    $this->ward_id->setSessionValue($this->ward_id->FormValue);
                    $foreignKeys["ward_id"] = $this->ward_id->FormValue;
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
            if ($masterTblVar != "wards") {
                if (!array_key_exists("ward_id", $foreignKeys)) { // Not current foreign key
                    $this->ward_id->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bedslist"), "", $this->TableVar, true);
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
                case "x_floor_id":
                    break;
                case "x_ward_type_id":
                    break;
                case "x_ward_id":
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
