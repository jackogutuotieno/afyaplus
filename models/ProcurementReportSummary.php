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
class ProcurementReportSummary extends ProcurementReport
{
    use MessagesTrait;

    // Page ID
    public $PageID = "summary";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ProcurementReportSummary";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $ReportContainerClass = "ew-grid";
    public $CurrentPageName = "procurementreport";

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

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'Procurement_Report';
        $this->TableName = 'Procurement Report';

        // CSS class name as context
        $this->ContextClass = CheckClassName($this->TableVar);
        AppendClass($this->ReportContainerClass, $this->ContextClass);

        // Fixed header table
        if (!$this->UseCustomTemplate) {
            $this->setFixedHeaderTable(Config("USE_FIXED_HEADER_TABLE"), Config("FIXED_HEADER_TABLE_HEIGHT"));
        }

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (Procurement_Report)
        if (!isset($GLOBALS["Procurement_Report"]) || $GLOBALS["Procurement_Report"]::class == PROJECT_NAMESPACE . "Procurement_Report") {
            $GLOBALS["Procurement_Report"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Procurement Report');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions(TagClassName: "ew-export-option");

        // Filter options
        $this->FilterOptions = new ListOptions(TagClassName: "ew-filter-option");
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

        // Close connection if not in dashboard
        if (!$DashboardReport) {
            CloseConnections();
        }

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
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
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
        if ($fld instanceof ReportField) {
            $lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
        }
        $lookup->RenderEditFunc = ""; // Set up edit renderer

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

    // Options
    public $HideOptions = false;
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $FilterOptions; // Filter options

    // Records
    public $GroupRecords = [];
    public $DetailRecords = [];
    public $DetailRecordCount = 0;

    // Paging variables
    public $RecordIndex = 0; // Record index
    public $RecordCount = 0; // Record count (start from 1 for each group)
    public $StartGroup = 0; // Start group
    public $StopGroup = 0; // Stop group
    public $TotalGroups = 0; // Total groups
    public $GroupCount = 0; // Group count
    public $GroupCounter = []; // Group counter
    public $DisplayGroups = 3; // Groups per page
    public $GroupRange = 10;
    public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
    public $PageFirstGroupFilter = "";
    public $UserIDFilter = "";
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = "";
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $DrillDownList = "";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $SearchCommand = false;
    public $ShowHeader = true;
    public $GroupColumnCount = 0;
    public $SubGroupColumnCount = 0;
    public $DetailColumnCount = 0;
    public $TotalCount;
    public $PageTotalCount;
    public $TopContentClass = "ew-top";
    public $MiddleContentClass = "ew-middle";
    public $BottomContentClass = "ew-bottom";

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $DrillDownInPanel, $Breadcrumb, $DashboardReport;

        // Set up dashboard report
        $DashboardReport ??= Param(Config("PAGE_DASHBOARD"));
        if ($DashboardReport) {
            $this->UseAjaxActions = true;
            AddFilter($this->Filter, $this->getDashboardFilter($DashboardReport, $this->TableVar)); // Set up Dashboard Filter
        }

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        }
        $ExportType = $this->Export; // Get export parameter, used in header
        if ($ExportType != "") {
            global $SkipHeaderFooter;
            $SkipHeaderFooter = true;
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Setup export options
        $this->setupExportOptions();

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up table class
        if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf")) {
            $this->TableClass = "ew-table table-bordered table-sm";
        } else {
            PrependClass($this->TableClass, "table ew-table table-bordered table-sm");
        }

        // Set up report container class
        if (!$this->isExport("word") && !$this->isExport("excel")) {
            $this->ReportContainerClass .= " card ew-card";
        }

        // Set field visibility for detail fields
        $this->id->setVisibility();
        $this->batch_number->setVisibility();
        $this->supplier_name->setVisibility();
        $this->category_name->setVisibility();
        $this->subcategory_name->setVisibility();
        $this->item_title->setVisibility();
        $this->quantity->setVisibility();
        $this->measuring_unit->setVisibility();
        $this->unit_price->setVisibility();
        $this->selling_price->setVisibility();
        $this->amount_paid->setVisibility();
        $this->purchase_month->setVisibility();
        $this->purchase_year->setVisibility();
        $this->date_created->setVisibility();

        // Set up groups per page dynamically
        $this->setupDisplayGroups();

        // Set up Breadcrumb
        if (!$this->isExport() && !$DashboardReport) {
            $this->setupBreadcrumb();
        }

        // Check if search command
        $this->SearchCommand = (Get("cmd", "") == "search");

        // Load custom filters
        $this->pageFilterLoad();

        // Process filter list
        if ($this->processFilterList()) {
            $this->terminate();
            return;
        }

        // Extended filter
        $extendedFilter = "";

        // Restore filter list
        $this->restoreFilterList();

        // Build extended filter
        $extendedFilter = $this->getExtendedFilter();
        AddFilter($this->SearchWhere, $extendedFilter);

        // Call Page Selecting event
        $this->pageSelecting($this->SearchWhere);

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Get sort
        $this->Sort = $this->getSort();

        // Search options
        $this->setupSearchOptions();

        // Update filter
        AddFilter($this->Filter, $this->SearchWhere);

        // Get total count
        $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
        $this->TotalGroups = $this->getRecordCount($sql);
        if ($this->DisplayGroups <= 0 || $this->DrillDown) { // Display all groups
            $this->DisplayGroups = $this->TotalGroups;
        }
        $this->StartGroup = 1;

        // Set up start position if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->DisplayGroups = $this->TotalGroups;
        } else {
            $this->setupStartGroup();
        }

        // Set no record found message
        if ($this->TotalGroups == 0) {
            $this->ShowHeader = false;
            if ($Security->canList()) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            } else {
                $this->setWarningMessage(DeniedMessage());
            }
        }

        // Hide export options if export/dashboard report/hide options
        if ($this->isExport() || $DashboardReport || $this->HideOptions) {
            $this->ExportOptions->hideAllOptions();
        }

        // Hide search/filter options if export/drilldown/dashboard report/hide options
        if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }

        // Get current page records
        if ($this->TotalGroups > 0) {
            $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, $this->Sort);
            $rs = $sql->setFirstResult(max($this->StartGroup - 1, 0))->setMaxResults($this->DisplayGroups)->executeQuery();
            $this->DetailRecords = $rs->fetchAll(); // Get records
            $this->GroupCount = 1;
        }
        $this->setupFieldCount();

        // Set the last group to display if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->StopGroup = $this->TotalGroups;
        } else {
            $this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
        }

        // Stop group <= total number of groups
        if (intval($this->StopGroup) > intval($this->TotalGroups)) {
            $this->StopGroup = $this->TotalGroups;
        }
        $this->RecordCount = 0;
        $this->RecordIndex = 0;
        $this->setGroupCount($this->StopGroup - $this->StartGroup + 1, 1);

        // Set up pager
        $this->Pager = new PrevNextPager($this, $this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Check if no records
        if ($this->TotalGroups == 0) {
            $this->ReportContainerClass .= " ew-no-record";
        }

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

    // Load row values
    public function loadRowValues($record)
    {
        $data = [];
        $data["id"] = $record['id'];
        $data["batch_number"] = $record['batch_number'];
        $data["supplier_name"] = $record['supplier_name'];
        $data["category_name"] = $record['category_name'];
        $data["subcategory_name"] = $record['subcategory_name'];
        $data["item_title"] = $record['item_title'];
        $data["quantity"] = $record['quantity'];
        $data["measuring_unit"] = $record['measuring_unit'];
        $data["unit_price"] = $record['unit_price'];
        $data["selling_price"] = $record['selling_price'];
        $data["amount_paid"] = $record['amount_paid'];
        $data["purchase_month"] = $record['purchase_month'];
        $data["purchase_year"] = $record['purchase_year'];
        $data["date_created"] = $record['date_created'];
        $this->Rows[] = $data;
        $this->id->setDbValue($record['id']);
        $this->batch_number->setDbValue($record['batch_number']);
        $this->supplier_name->setDbValue($record['supplier_name']);
        $this->category_name->setDbValue($record['category_name']);
        $this->subcategory_name->setDbValue($record['subcategory_name']);
        $this->item_title->setDbValue($record['item_title']);
        $this->quantity->setDbValue($record['quantity']);
        $this->measuring_unit->setDbValue($record['measuring_unit']);
        $this->unit_price->setDbValue($record['unit_price']);
        $this->selling_price->setDbValue($record['selling_price']);
        $this->amount_paid->setDbValue($record['amount_paid']);
        $this->purchase_month->setDbValue($record['purchase_month']);
        $this->purchase_year->setDbValue($record['purchase_year']);
        $this->date_created->setDbValue($record['date_created']);
    }

    // Render row
    public function renderRow()
    {
        global $Security, $Language, $Language;
        $conn = $this->getConnection();
        if ($this->RowType == RowType::TOTAL && $this->RowTotalSubType == RowTotal::FOOTER && $this->RowTotalType == RowSummary::PAGE) { // Get Page total
            $records = &$this->DetailRecords;
            $this->PageTotalCount = count($records);
        } elseif ($this->RowType == RowType::TOTAL && $this->RowTotalSubType == RowTotal::FOOTER && $this->RowTotalType == RowSummary::GRAND) { // Get Grand total
            $hasCount = false;
            $hasSummary = false;

            // Get total count from SQL directly
            $sql = $this->buildReportSql($this->getSqlSelectCount(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
            $rstot = $conn->executeQuery($sql);
            if ($rstot && $cnt = $rstot->fetchOne()) {
                $hasCount = true;
            } else {
                $cnt = 0;
            }
            $this->TotalCount = $cnt;
            $hasSummary = true;

            // Accumulate grand summary from detail records
            if (!$hasCount || !$hasSummary) {
                $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
                $rs = $sql->executeQuery();
                $this->DetailRecords = $rs?->fetchAll() ?? [];
            }
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // id

        // batch_number

        // supplier_name

        // category_name

        // subcategory_name

        // item_title

        // quantity

        // measuring_unit

        // unit_price

        // selling_price

        // amount_paid

        // purchase_month

        // purchase_year

        // date_created
        if ($this->RowType == RowType::SEARCH) {
            // batch_number
            if ($this->batch_number->UseFilter && !EmptyValue($this->batch_number->AdvancedSearch->SearchValue)) {
                if (is_array($this->batch_number->AdvancedSearch->SearchValue)) {
                    $this->batch_number->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->batch_number->AdvancedSearch->SearchValue);
                }
                $this->batch_number->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->batch_number->AdvancedSearch->SearchValue);
            }

            // supplier_name
            if ($this->supplier_name->UseFilter && !EmptyValue($this->supplier_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->supplier_name->AdvancedSearch->SearchValue)) {
                    $this->supplier_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->supplier_name->AdvancedSearch->SearchValue);
                }
                $this->supplier_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->supplier_name->AdvancedSearch->SearchValue);
            }

            // category_name
            if ($this->category_name->UseFilter && !EmptyValue($this->category_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->category_name->AdvancedSearch->SearchValue)) {
                    $this->category_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->category_name->AdvancedSearch->SearchValue);
                }
                $this->category_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->category_name->AdvancedSearch->SearchValue);
            }

            // subcategory_name
            if ($this->subcategory_name->UseFilter && !EmptyValue($this->subcategory_name->AdvancedSearch->SearchValue)) {
                if (is_array($this->subcategory_name->AdvancedSearch->SearchValue)) {
                    $this->subcategory_name->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->subcategory_name->AdvancedSearch->SearchValue);
                }
                $this->subcategory_name->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->subcategory_name->AdvancedSearch->SearchValue);
            }

            // purchase_month
            if ($this->purchase_month->UseFilter && !EmptyValue($this->purchase_month->AdvancedSearch->SearchValue)) {
                if (is_array($this->purchase_month->AdvancedSearch->SearchValue)) {
                    $this->purchase_month->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->purchase_month->AdvancedSearch->SearchValue);
                }
                $this->purchase_month->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->purchase_month->AdvancedSearch->SearchValue);
            }

            // purchase_year
            if ($this->purchase_year->UseFilter && !EmptyValue($this->purchase_year->AdvancedSearch->SearchValue)) {
                if (is_array($this->purchase_year->AdvancedSearch->SearchValue)) {
                    $this->purchase_year->AdvancedSearch->SearchValue = implode(Config("FILTER_OPTION_SEPARATOR"), $this->purchase_year->AdvancedSearch->SearchValue);
                }
                $this->purchase_year->EditValue = explode(Config("FILTER_OPTION_SEPARATOR"), $this->purchase_year->AdvancedSearch->SearchValue);
            }
        } elseif ($this->RowType == RowType::TOTAL && !($this->RowTotalType == RowSummary::GROUP && $this->RowTotalSubType == RowTotal::HEADER)) { // Summary row
            $this->RowAttrs->prependClass(($this->RowTotalType == RowSummary::PAGE || $this->RowTotalType == RowSummary::GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

            // id
            $this->id->HrefValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";

            // supplier_name
            $this->supplier_name->HrefValue = "";

            // category_name
            $this->category_name->HrefValue = "";

            // subcategory_name
            $this->subcategory_name->HrefValue = "";

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

            // purchase_month
            $this->purchase_month->HrefValue = "";

            // purchase_year
            $this->purchase_year->HrefValue = "";

            // date_created
            $this->date_created->HrefValue = "";
        } else {
            if ($this->RowTotalType == RowSummary::GROUP && $this->RowTotalSubType == RowTotal::HEADER) {
            } else {
            }

            // Increment RowCount
            if ($this->RowType == RowType::DETAIL) {
                $this->RowCount++;
            }

            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // batch_number
            $this->batch_number->ViewValue = $this->batch_number->CurrentValue;
            $this->batch_number->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // supplier_name
            $this->supplier_name->ViewValue = $this->supplier_name->CurrentValue;
            $this->supplier_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // category_name
            $this->category_name->ViewValue = $this->category_name->CurrentValue;
            $this->category_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // subcategory_name
            $this->subcategory_name->ViewValue = $this->subcategory_name->CurrentValue;
            $this->subcategory_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // item_title
            $this->item_title->ViewValue = $this->item_title->CurrentValue;
            $this->item_title->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // quantity
            $this->quantity->ViewValue = $this->quantity->CurrentValue;
            $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());
            $this->quantity->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // measuring_unit
            $this->measuring_unit->ViewValue = $this->measuring_unit->CurrentValue;
            $this->measuring_unit->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // unit_price
            $this->unit_price->ViewValue = $this->unit_price->CurrentValue;
            $this->unit_price->ViewValue = FormatNumber($this->unit_price->ViewValue, $this->unit_price->formatPattern());
            $this->unit_price->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // selling_price
            $this->selling_price->ViewValue = $this->selling_price->CurrentValue;
            $this->selling_price->ViewValue = FormatNumber($this->selling_price->ViewValue, $this->selling_price->formatPattern());
            $this->selling_price->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // amount_paid
            $this->amount_paid->ViewValue = $this->amount_paid->CurrentValue;
            $this->amount_paid->ViewValue = FormatNumber($this->amount_paid->ViewValue, $this->amount_paid->formatPattern());
            $this->amount_paid->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // purchase_month
            $this->purchase_month->ViewValue = $this->purchase_month->CurrentValue;
            $this->purchase_month->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // purchase_year
            $this->purchase_year->ViewValue = $this->purchase_year->CurrentValue;
            $this->purchase_year->ViewValue = FormatNumber($this->purchase_year->ViewValue, $this->purchase_year->formatPattern());
            $this->purchase_year->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // date_created
            $this->date_created->ViewValue = $this->date_created->CurrentValue;
            $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());
            $this->date_created->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "");

            // id
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // batch_number
            $this->batch_number->HrefValue = "";
            $this->batch_number->TooltipValue = "";

            // supplier_name
            $this->supplier_name->HrefValue = "";
            $this->supplier_name->TooltipValue = "";

            // category_name
            $this->category_name->HrefValue = "";
            $this->category_name->TooltipValue = "";

            // subcategory_name
            $this->subcategory_name->HrefValue = "";
            $this->subcategory_name->TooltipValue = "";

            // item_title
            $this->item_title->HrefValue = "";
            $this->item_title->TooltipValue = "";

            // quantity
            $this->quantity->HrefValue = "";
            $this->quantity->TooltipValue = "";

            // measuring_unit
            $this->measuring_unit->HrefValue = "";
            $this->measuring_unit->TooltipValue = "";

            // unit_price
            $this->unit_price->HrefValue = "";
            $this->unit_price->TooltipValue = "";

            // selling_price
            $this->selling_price->HrefValue = "";
            $this->selling_price->TooltipValue = "";

            // amount_paid
            $this->amount_paid->HrefValue = "";
            $this->amount_paid->TooltipValue = "";

            // purchase_month
            $this->purchase_month->HrefValue = "";
            $this->purchase_month->TooltipValue = "";

            // purchase_year
            $this->purchase_year->HrefValue = "";
            $this->purchase_year->TooltipValue = "";

            // date_created
            $this->date_created->HrefValue = "";
            $this->date_created->TooltipValue = "";
        }

        // Call Cell_Rendered event
        if ($this->RowType == RowType::TOTAL) { // Summary row
        } else {
            // id
            $currentValue = $this->id->CurrentValue;
            $viewValue = &$this->id->ViewValue;
            $viewAttrs = &$this->id->ViewAttrs;
            $cellAttrs = &$this->id->CellAttrs;
            $hrefValue = &$this->id->HrefValue;
            $linkAttrs = &$this->id->LinkAttrs;
            $this->cellRendered($this->id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // batch_number
            $currentValue = $this->batch_number->CurrentValue;
            $viewValue = &$this->batch_number->ViewValue;
            $viewAttrs = &$this->batch_number->ViewAttrs;
            $cellAttrs = &$this->batch_number->CellAttrs;
            $hrefValue = &$this->batch_number->HrefValue;
            $linkAttrs = &$this->batch_number->LinkAttrs;
            $this->cellRendered($this->batch_number, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // supplier_name
            $currentValue = $this->supplier_name->CurrentValue;
            $viewValue = &$this->supplier_name->ViewValue;
            $viewAttrs = &$this->supplier_name->ViewAttrs;
            $cellAttrs = &$this->supplier_name->CellAttrs;
            $hrefValue = &$this->supplier_name->HrefValue;
            $linkAttrs = &$this->supplier_name->LinkAttrs;
            $this->cellRendered($this->supplier_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // category_name
            $currentValue = $this->category_name->CurrentValue;
            $viewValue = &$this->category_name->ViewValue;
            $viewAttrs = &$this->category_name->ViewAttrs;
            $cellAttrs = &$this->category_name->CellAttrs;
            $hrefValue = &$this->category_name->HrefValue;
            $linkAttrs = &$this->category_name->LinkAttrs;
            $this->cellRendered($this->category_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // subcategory_name
            $currentValue = $this->subcategory_name->CurrentValue;
            $viewValue = &$this->subcategory_name->ViewValue;
            $viewAttrs = &$this->subcategory_name->ViewAttrs;
            $cellAttrs = &$this->subcategory_name->CellAttrs;
            $hrefValue = &$this->subcategory_name->HrefValue;
            $linkAttrs = &$this->subcategory_name->LinkAttrs;
            $this->cellRendered($this->subcategory_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // item_title
            $currentValue = $this->item_title->CurrentValue;
            $viewValue = &$this->item_title->ViewValue;
            $viewAttrs = &$this->item_title->ViewAttrs;
            $cellAttrs = &$this->item_title->CellAttrs;
            $hrefValue = &$this->item_title->HrefValue;
            $linkAttrs = &$this->item_title->LinkAttrs;
            $this->cellRendered($this->item_title, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // quantity
            $currentValue = $this->quantity->CurrentValue;
            $viewValue = &$this->quantity->ViewValue;
            $viewAttrs = &$this->quantity->ViewAttrs;
            $cellAttrs = &$this->quantity->CellAttrs;
            $hrefValue = &$this->quantity->HrefValue;
            $linkAttrs = &$this->quantity->LinkAttrs;
            $this->cellRendered($this->quantity, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // measuring_unit
            $currentValue = $this->measuring_unit->CurrentValue;
            $viewValue = &$this->measuring_unit->ViewValue;
            $viewAttrs = &$this->measuring_unit->ViewAttrs;
            $cellAttrs = &$this->measuring_unit->CellAttrs;
            $hrefValue = &$this->measuring_unit->HrefValue;
            $linkAttrs = &$this->measuring_unit->LinkAttrs;
            $this->cellRendered($this->measuring_unit, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // unit_price
            $currentValue = $this->unit_price->CurrentValue;
            $viewValue = &$this->unit_price->ViewValue;
            $viewAttrs = &$this->unit_price->ViewAttrs;
            $cellAttrs = &$this->unit_price->CellAttrs;
            $hrefValue = &$this->unit_price->HrefValue;
            $linkAttrs = &$this->unit_price->LinkAttrs;
            $this->cellRendered($this->unit_price, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // selling_price
            $currentValue = $this->selling_price->CurrentValue;
            $viewValue = &$this->selling_price->ViewValue;
            $viewAttrs = &$this->selling_price->ViewAttrs;
            $cellAttrs = &$this->selling_price->CellAttrs;
            $hrefValue = &$this->selling_price->HrefValue;
            $linkAttrs = &$this->selling_price->LinkAttrs;
            $this->cellRendered($this->selling_price, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // amount_paid
            $currentValue = $this->amount_paid->CurrentValue;
            $viewValue = &$this->amount_paid->ViewValue;
            $viewAttrs = &$this->amount_paid->ViewAttrs;
            $cellAttrs = &$this->amount_paid->CellAttrs;
            $hrefValue = &$this->amount_paid->HrefValue;
            $linkAttrs = &$this->amount_paid->LinkAttrs;
            $this->cellRendered($this->amount_paid, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // purchase_month
            $currentValue = $this->purchase_month->CurrentValue;
            $viewValue = &$this->purchase_month->ViewValue;
            $viewAttrs = &$this->purchase_month->ViewAttrs;
            $cellAttrs = &$this->purchase_month->CellAttrs;
            $hrefValue = &$this->purchase_month->HrefValue;
            $linkAttrs = &$this->purchase_month->LinkAttrs;
            $this->cellRendered($this->purchase_month, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // purchase_year
            $currentValue = $this->purchase_year->CurrentValue;
            $viewValue = &$this->purchase_year->ViewValue;
            $viewAttrs = &$this->purchase_year->ViewAttrs;
            $cellAttrs = &$this->purchase_year->CellAttrs;
            $hrefValue = &$this->purchase_year->HrefValue;
            $linkAttrs = &$this->purchase_year->LinkAttrs;
            $this->cellRendered($this->purchase_year, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // date_created
            $currentValue = $this->date_created->CurrentValue;
            $viewValue = &$this->date_created->ViewValue;
            $viewAttrs = &$this->date_created->ViewAttrs;
            $cellAttrs = &$this->date_created->CellAttrs;
            $hrefValue = &$this->date_created->HrefValue;
            $linkAttrs = &$this->date_created->LinkAttrs;
            $this->cellRendered($this->date_created, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
        }

        // Call Row_Rendered event
        $this->rowRendered();
        $this->setupFieldCount();
    }
    private $groupCounts = [];

    // Get group count
    public function getGroupCount(...$args)
    {
        $key = implode("_", array_map(fn($arg) => strval($arg), $args));
        if ($key == "") {
            return -1;
        } elseif ($key == "0") { // Number of first level groups
            $i = 1;
            while (isset($this->groupCounts[strval($i)])) {
                $i++;
            }
            return $i - 1;
        }
        return isset($this->groupCounts[$key]) ? $this->groupCounts[$key] : -1;
    }

    // Set group count
    public function setGroupCount($value, ...$args)
    {
        $key = implode("_", array_map(fn($arg) => strval($arg), $args));
        if ($key == "") {
            return;
        }
        $this->groupCounts[$key] = $value;
    }

    // Setup field count
    protected function setupFieldCount()
    {
        $this->GroupColumnCount = 0;
        $this->SubGroupColumnCount = 0;
        $this->DetailColumnCount = 0;
        if ($this->id->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->batch_number->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->supplier_name->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->category_name->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->subcategory_name->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->item_title->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->quantity->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->measuring_unit->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->unit_price->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->selling_price->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->amount_paid->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->purchase_month->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->purchase_year->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->date_created->Visible) {
            $this->DetailColumnCount += 1;
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        if ($type == "print" || $custom) { // Printer friendly / custom export
            $pageUrl = $this->pageUrl(false);
            $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        } else { // Export API URL
            $exportUrl = GetApiUrl(Config("API_EXPORT_ACTION") . "/" . $type . "/" . $this->TableVar);
        }
        if (SameText($type, "excel")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" data-ew-action="export" data-export="excel" data-custom="false" data-export-selected="false" data-url="' . $exportUrl . '">' . $Language->phrase("ExportToExcel") . '</button>';
        } elseif (SameText($type, "word")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" data-ew-action="export" data-export="word" data-custom="false" data-export-selected="false" data-url="' . $exportUrl . '">' . $Language->phrase("ExportToWord") . '</button>';
        } elseif (SameText($type, "pdf")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPdf", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPdf", true)) . '" data-ew-action="export" data-export="pdf" data-custom="false" data-export-selected="false" data-url="' . $exportUrl . '">' . $Language->phrase("ExportToPdf") . '</button>';
        } elseif (SameText($type, "html")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-html" title="' . HtmlEncode($Language->phrase("ExportToHtml", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToHtml", true)) . '" data-ew-action="export" data-export="html" data-custom="false" data-export-selected="false" data-url="' . $exportUrl . '">' . $Language->phrase("ExportToHtml") . '</button>';
        } elseif (SameText($type, "email")) {
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-ew-action="email" data-custom="false" data-export-selected="false" data-hdr="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-url="' . $exportUrl . '">' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendly", true)) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language, $Security;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = true;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = true;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
        }
        if (!$Security->canExport()) { // Export not allowed
            $this->ExportOptions->hideAllOptions();
        }
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(TagClassName: "ew-search-option");

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        if ($this->UseCustomTemplate || !$this->UseAjaxActions) {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        } else {
            $item->Body = "<a class=\"btn btn-default ew-show-all\" role=\"button\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" data-ew-action=\"refresh\" data-url=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        }
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction && $this->CurrentAction != "search") {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return $this->batch_number->Visible || $this->supplier_name->Visible || $this->category_name->Visible || $this->subcategory_name->Visible || $this->purchase_month->Visible || $this->purchase_year->Visible;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset(all)
        $Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, true);
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fProcurement_Reportsrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fProcurement_Reportsrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up starting group
    protected function setupStartGroup()
    {
        // Exit if no groups
        if ($this->DisplayGroups == 0) {
            return;
        }
        $startGrp = Param(Config("TABLE_START_GROUP"));
        $pageNo = Param(Config("TABLE_PAGE_NUMBER"));

        // Check for a 'start' parameter
        if ($startGrp !== null) {
            $this->StartGroup = $startGrp;
            $this->setStartGroup($this->StartGroup);
        } elseif ($pageNo !== null) {
            $pageNo = ParseInteger($pageNo);
            if (is_numeric($pageNo)) {
                $this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
                if ($this->StartGroup <= 0) {
                    $this->StartGroup = 1;
                } elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
                    $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
                }
                $this->setStartGroup($this->StartGroup);
            } else {
                $this->StartGroup = $this->getStartGroup();
            }
        } else {
            $this->StartGroup = $this->getStartGroup();
        }

        // Check if correct start group counter
        if (!is_numeric($this->StartGroup) || intval($this->StartGroup) <= 0) { // Avoid invalid start group counter
            $this->StartGroup = 1; // Reset start group counter
            $this->setStartGroup($this->StartGroup);
        } elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
            $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
            $this->setStartGroup($this->StartGroup);
        } elseif (($this->StartGroup - 1) % $this->DisplayGroups != 0) {
            $this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
            $this->setStartGroup($this->StartGroup);
        }
    }

    // Reset pager
    protected function resetPager()
    {
        // Reset start position (reset command)
        $this->StartGroup = 1;
        $this->setStartGroup($this->StartGroup);
    }

    // Set up number of groups displayed per page
    protected function setupDisplayGroups()
    {
        if (Param(Config("TABLE_GROUP_PER_PAGE")) !== null) {
            $wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
            if (is_numeric($wrk)) {
                $this->DisplayGroups = intval($wrk);
            } else {
                if (SameText($wrk, "ALL")) { // Display all groups
                    $this->DisplayGroups = -1;
                } else {
                    $this->DisplayGroups = 3; // Non-numeric, load default
                }
            }
            $this->setGroupPerPage($this->DisplayGroups); // Save to session

            // Reset start position (reset command)
            $this->StartGroup = 1;
            $this->setStartGroup($this->StartGroup);
        } else {
            if ($this->getGroupPerPage() != "") {
                $this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
            } else {
                $this->DisplayGroups = 3; // Load default
            }
        }
    }

    // Get sort parameters based on sort links clicked
    protected function getSort()
    {
        if ($this->DrillDown) {
            return "";
        }
        $resetSort = Param("cmd") === "resetsort";
        $orderBy = Param("order", "");
        $orderType = Param("ordertype", "");

        // Check for a resetsort command
        if ($resetSort) {
            $this->setOrderBy("");
            $this->setStartGroup(1);
            $this->id->setSort("");
            $this->batch_number->setSort("");
            $this->supplier_name->setSort("");
            $this->category_name->setSort("");
            $this->subcategory_name->setSort("");
            $this->item_title->setSort("");
            $this->quantity->setSort("");
            $this->measuring_unit->setSort("");
            $this->unit_price->setSort("");
            $this->selling_price->setSort("");
            $this->amount_paid->setSort("");
            $this->purchase_month->setSort("");
            $this->purchase_year->setSort("");
            $this->date_created->setSort("");

        // Check for an Order parameter
        } elseif ($orderBy != "") {
            $this->CurrentOrder = $orderBy;
            $this->CurrentOrderType = $orderType;
            $this->updateSort($this->id); // id
            $this->updateSort($this->batch_number); // batch_number
            $this->updateSort($this->supplier_name); // supplier_name
            $this->updateSort($this->category_name); // category_name
            $this->updateSort($this->subcategory_name); // subcategory_name
            $this->updateSort($this->item_title); // item_title
            $this->updateSort($this->quantity); // quantity
            $this->updateSort($this->measuring_unit); // measuring_unit
            $this->updateSort($this->unit_price); // unit_price
            $this->updateSort($this->selling_price); // selling_price
            $this->updateSort($this->amount_paid); // amount_paid
            $this->updateSort($this->purchase_month); // purchase_month
            $this->updateSort($this->purchase_year); // purchase_year
            $this->updateSort($this->date_created); // date_created
            $sortSql = $this->sortSql();
            $this->setOrderBy($sortSql);
            $this->setStartGroup(1);
        }
        return $this->getOrderBy();
    }

    // Return extended filter
    protected function getExtendedFilter()
    {
        $filter = "";
        if ($this->DrillDown) {
            return "";
        }
        $restoreSession = false;
        $restoreDefault = false;
        // Reset search command
        if (Get("cmd") == "reset") {
            // Set default values
            $this->batch_number->AdvancedSearch->unsetSession();
            $this->supplier_name->AdvancedSearch->unsetSession();
            $this->category_name->AdvancedSearch->unsetSession();
            $this->subcategory_name->AdvancedSearch->unsetSession();
            $this->purchase_month->AdvancedSearch->unsetSession();
            $this->purchase_year->AdvancedSearch->unsetSession();
            $restoreDefault = true;
        } else {
            $restoreSession = !$this->SearchCommand;

            // Field batch_number
            $this->getDropDownValue($this->batch_number);

            // Field supplier_name
            $this->getDropDownValue($this->supplier_name);

            // Field category_name
            $this->getDropDownValue($this->category_name);

            // Field subcategory_name
            $this->getDropDownValue($this->subcategory_name);

            // Field purchase_month
            $this->getDropDownValue($this->purchase_month);

            // Field purchase_year
            $this->getDropDownValue($this->purchase_year);
            if (!$this->validateForm()) {
                return $filter;
            }
        }

        // Restore session
        if ($restoreSession) {
            $restoreDefault = true;
            if ($this->batch_number->AdvancedSearch->issetSession()) { // Field batch_number
                $this->batch_number->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->supplier_name->AdvancedSearch->issetSession()) { // Field supplier_name
                $this->supplier_name->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->category_name->AdvancedSearch->issetSession()) { // Field category_name
                $this->category_name->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->subcategory_name->AdvancedSearch->issetSession()) { // Field subcategory_name
                $this->subcategory_name->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->purchase_month->AdvancedSearch->issetSession()) { // Field purchase_month
                $this->purchase_month->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->purchase_year->AdvancedSearch->issetSession()) { // Field purchase_year
                $this->purchase_year->AdvancedSearch->load();
                $restoreDefault = false;
            }
        }

        // Restore default
        if ($restoreDefault) {
            $this->loadDefaultFilters();
        }

        // Call page filter validated event
        $this->pageFilterValidated();

        // Build SQL and save to session
        $this->buildDropDownFilter($this->batch_number, $filter, false, true); // Field batch_number
        $this->batch_number->AdvancedSearch->save();
        $this->buildDropDownFilter($this->supplier_name, $filter, false, true); // Field supplier_name
        $this->supplier_name->AdvancedSearch->save();
        $this->buildDropDownFilter($this->category_name, $filter, false, true); // Field category_name
        $this->category_name->AdvancedSearch->save();
        $this->buildDropDownFilter($this->subcategory_name, $filter, false, true); // Field subcategory_name
        $this->subcategory_name->AdvancedSearch->save();
        $this->buildDropDownFilter($this->purchase_month, $filter, false, true); // Field purchase_month
        $this->purchase_month->AdvancedSearch->save();
        $this->buildDropDownFilter($this->purchase_year, $filter, false, true); // Field purchase_year
        $this->purchase_year->AdvancedSearch->save();
        return $filter;
    }

    // Build dropdown filter
    protected function buildDropDownFilter(&$fld, &$filterClause, $default = false, $saveFilter = false)
    {
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        if (!EmptyValue($fld->DateFilter)) {
            $fldVal2 = "";
        } elseif ($fld->UseFilter) {
            $fldOpr = "";
            $fldVal2 = "";
        }
        $sql = "";
        if (is_array($fldVal)) {
            foreach ($fldVal as $val) {
                $wrk = DropDownFilter($fld, $val, $fldOpr, $this->Dbid);

                // Call Page Filtering event
                if (StartsString("@@", $val)) {
                    $this->pageFiltering($fld, $wrk, "custom", substr($val, 2));
                } else {
                    $this->pageFiltering($fld, $wrk, "dropdown", $fldOpr, $val);
                }
                AddFilter($sql, $wrk, "OR");
            }
        } else {
            $sql = DropDownFilter($fld, $fldVal, $fldOpr, $this->Dbid, $fldVal2);

            // Call Page Filtering event
            if (StartsString("@@", $fldVal)) {
                $this->pageFiltering($fld, $sql, "custom", substr($fldVal, 2));
            } else {
                $this->pageFiltering($fld, $sql, "dropdown", $fldOpr, $fldVal, "", "", $fldVal2);
            }
        }
        if ($sql != "") {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
            AddFilter($filterClause, $sql, $cond);
            if ($saveFilter) {
                $fld->CurrentFilter = $sql;
            }
        }
    }

    // Build extended filter
    protected function buildExtendedFilter(&$fld, &$filterClause, $default = false, $saveFilter = false)
    {
        $wrk = GetReportFilter($fld, $default, $this->Dbid);
        if (!$default) {
            $this->pageFiltering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
        }
        if ($wrk != "") {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
            AddFilter($filterClause, $wrk, $cond);
            if ($saveFilter) {
                $fld->CurrentFilter = $wrk;
            }
        }
    }

    // Get drop down value from querystring
    protected function getDropDownValue(&$fld)
    {
        if (IsPost()) {
            return false; // Skip post back
        }
        $res = false;
        $parm = $fld->Param;
        $sep = $fld->UseFilter ? Config("FILTER_OPTION_SEPARATOR") : Config("MULTIPLE_OPTION_SEPARATOR");
        $opr = Get("z_$parm");
        if ($opr !== null) {
            $fld->AdvancedSearch->SearchOperator = $opr;
        }
        $val = Get("x_$parm");
        if ($val !== null) {
            if (is_array($val)) {
                $val = implode($sep, $val);
            }
            $fld->AdvancedSearch->setSearchValue($val);
            $res = true;
        }
        $val2 = Get("y_$parm");
        if ($val2 !== null) {
            if (is_array($val2)) {
                $val2 = implode($sep, $val2);
            }
            $fld->AdvancedSearch->setSearchValue2($val2);
            $res = true;
        }
        return $res;
    }

    // Dropdown filter exist
    protected function dropDownFilterExist(&$fld)
    {
        $wrk = "";
        $this->buildDropDownFilter($fld, $wrk);
        return ($wrk != "");
    }

    // Extended filter exist
    protected function extendedFilterExist(&$fld)
    {
        $extWrk = "";
        $this->buildExtendedFilter($fld, $extWrk);
        return ($extWrk != "");
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Load default value for filters
    protected function loadDefaultFilters()
    {
        // Field batch_number
        $this->batch_number->AdvancedSearch->loadDefault();

        // Field supplier_name
        $this->supplier_name->AdvancedSearch->loadDefault();

        // Field category_name
        $this->category_name->AdvancedSearch->loadDefault();

        // Field subcategory_name
        $this->subcategory_name->AdvancedSearch->loadDefault();

        // Field purchase_month
        $this->purchase_month->AdvancedSearch->loadDefault();

        // Field purchase_year
        $this->purchase_year->AdvancedSearch->loadDefault();
    }

    // Show list of filters
    public function showFilterList()
    {
        global $Language;

        // Initialize
        $filterList = "";
        $captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
        $captionSuffix = $this->isExport("email") ? ": " : "";

        // Show Filters
        if ($filterList != "") {
            $message = "<div id=\"ew-filter-list\" class=\"callout callout-info d-table\"><div id=\"ew-current-filters\">" .
                $Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
            $this->messageShowing($message, "");
            Write($message);
        } else { // Output empty tag
            Write("<div id=\"ew-filter-list\"></div>");
        }
    }

    // Get list of filters
    public function getFilterList()
    {
        // Initialize
        $filterList = "";
        $savedFilterList = "";

        // Load server side filters
        if (Config("SEARCH_FILTER_OPTION") == "Server") {
            $savedFilterList = Profile()->getSearchFilters("fProcurement_Reportsrch");
        }

        // Return filter list in json
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            Profile()->setSearchFilters("fProcurement_Reportsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd", "") != "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter", ""), true);
        return $this->setupFilterList($filter);
    }

    // Setup list of filters
    protected function setupFilterList($filter)
    {
        if (!is_array($filter)) {
            return false;
        }
        return true;
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

    // Page Selecting event
    public function pageSelecting(&$filter)
    {
        // Enter your code here
    }

    // Load Filters event
    public function pageFilterLoad()
    {
        // Enter your code here
        // Example: Register/Unregister Custom Extended Filter
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
        //UnregisterFilter($this-><Field>, 'StartsWithA');
    }

    // Page Filter Validated event
    public function pageFilterValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Page Filtering event
    public function pageFiltering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "")
    {
        // Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
        //if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
        //    $filter = "..."; // Modify the filter
    }

    // Cell Rendered event
    public function cellRendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs)
    {
        //$ViewValue = "xxx";
        //$ViewAttrs["class"] = "xxx";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
