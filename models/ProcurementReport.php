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
 * Table class for Procurement Report
 */
class ProcurementReport extends ReportTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";
    public $ShowGroupHeaderAsRow = false;
    public $ShowCompactSummaryFooter = true;

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;
    public $ProcurementbyMonth;
    public $ProcurementbyYear;
    public $ProcurementbySupplier;
    public $ProcurementbyCategory;
    public $ProcurementbySubcategory;

    // Fields
    public $id;
    public $batch_number;
    public $supplier_name;
    public $category_name;
    public $subcategory_name;
    public $item_title;
    public $quantity;
    public $measuring_unit;
    public $unit_price;
    public $selling_price;
    public $amount_paid;
    public $purchase_month;
    public $purchase_year;
    public $date_created;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "Procurement_Report";
        $this->TableName = 'Procurement Report';
        $this->TableType = "REPORT";
        $this->TableReportType = "summary"; // Report Type
        $this->ReportSourceTable = 'procurement_report2'; // Report source table
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (report only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

        // id
        $this->id = new ReportField(
            $this, // Table
            'x_id', // Variable name
            'id', // Name
            '`id`', // Expression
            '`id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->id->InputTextType = "text";
        $this->id->Raw = true;
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->id->SourceTableVar = 'procurement_report2';
        $this->Fields['id'] = &$this->id;

        // batch_number
        $this->batch_number = new ReportField(
            $this, // Table
            'x_batch_number', // Variable name
            'batch_number', // Name
            '`batch_number`', // Expression
            '`batch_number`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`batch_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->batch_number->InputTextType = "text";
        $this->batch_number->Nullable = false; // NOT NULL field
        $this->batch_number->Required = true; // Required field
        $this->batch_number->UseFilter = true; // Table header filter
        $this->batch_number->Lookup = new Lookup($this->batch_number, 'Procurement_Report', true, 'batch_number', ["batch_number","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->batch_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->batch_number->SourceTableVar = 'procurement_report2';
        $this->batch_number->SearchType = "dropdown";
        $this->Fields['batch_number'] = &$this->batch_number;

        // supplier_name
        $this->supplier_name = new ReportField(
            $this, // Table
            'x_supplier_name', // Variable name
            'supplier_name', // Name
            '`supplier_name`', // Expression
            '`supplier_name`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`supplier_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->supplier_name->InputTextType = "text";
        $this->supplier_name->Nullable = false; // NOT NULL field
        $this->supplier_name->Required = true; // Required field
        $this->supplier_name->UseFilter = true; // Table header filter
        $this->supplier_name->Lookup = new Lookup($this->supplier_name, 'Procurement_Report', true, 'supplier_name', ["supplier_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->supplier_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->supplier_name->SourceTableVar = 'procurement_report2';
        $this->supplier_name->SearchType = "dropdown";
        $this->Fields['supplier_name'] = &$this->supplier_name;

        // category_name
        $this->category_name = new ReportField(
            $this, // Table
            'x_category_name', // Variable name
            'category_name', // Name
            '`category_name`', // Expression
            '`category_name`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`category_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->category_name->InputTextType = "text";
        $this->category_name->Nullable = false; // NOT NULL field
        $this->category_name->Required = true; // Required field
        $this->category_name->UseFilter = true; // Table header filter
        $this->category_name->Lookup = new Lookup($this->category_name, 'Procurement_Report', true, 'category_name', ["category_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->category_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->category_name->SourceTableVar = 'procurement_report2';
        $this->category_name->SearchType = "dropdown";
        $this->Fields['category_name'] = &$this->category_name;

        // subcategory_name
        $this->subcategory_name = new ReportField(
            $this, // Table
            'x_subcategory_name', // Variable name
            'subcategory_name', // Name
            '`subcategory_name`', // Expression
            '`subcategory_name`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`subcategory_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->subcategory_name->InputTextType = "text";
        $this->subcategory_name->Nullable = false; // NOT NULL field
        $this->subcategory_name->Required = true; // Required field
        $this->subcategory_name->UseFilter = true; // Table header filter
        $this->subcategory_name->Lookup = new Lookup($this->subcategory_name, 'Procurement_Report', true, 'subcategory_name', ["subcategory_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->subcategory_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->subcategory_name->SourceTableVar = 'procurement_report2';
        $this->subcategory_name->SearchType = "dropdown";
        $this->Fields['subcategory_name'] = &$this->subcategory_name;

        // item_title
        $this->item_title = new ReportField(
            $this, // Table
            'x_item_title', // Variable name
            'item_title', // Name
            '`item_title`', // Expression
            '`item_title`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`item_title`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->item_title->InputTextType = "text";
        $this->item_title->Nullable = false; // NOT NULL field
        $this->item_title->Required = true; // Required field
        $this->item_title->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->item_title->SourceTableVar = 'procurement_report2';
        $this->Fields['item_title'] = &$this->item_title;

        // quantity
        $this->quantity = new ReportField(
            $this, // Table
            'x_quantity', // Variable name
            'quantity', // Name
            '`quantity`', // Expression
            '`quantity`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`quantity`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->quantity->InputTextType = "text";
        $this->quantity->Raw = true;
        $this->quantity->Nullable = false; // NOT NULL field
        $this->quantity->Required = true; // Required field
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->quantity->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->quantity->SourceTableVar = 'procurement_report2';
        $this->Fields['quantity'] = &$this->quantity;

        // measuring_unit
        $this->measuring_unit = new ReportField(
            $this, // Table
            'x_measuring_unit', // Variable name
            'measuring_unit', // Name
            '`measuring_unit`', // Expression
            '`measuring_unit`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`measuring_unit`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->measuring_unit->InputTextType = "text";
        $this->measuring_unit->Nullable = false; // NOT NULL field
        $this->measuring_unit->Required = true; // Required field
        $this->measuring_unit->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->measuring_unit->SourceTableVar = 'procurement_report2';
        $this->Fields['measuring_unit'] = &$this->measuring_unit;

        // unit_price
        $this->unit_price = new ReportField(
            $this, // Table
            'x_unit_price', // Variable name
            'unit_price', // Name
            '`unit_price`', // Expression
            '`unit_price`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`unit_price`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->unit_price->InputTextType = "text";
        $this->unit_price->Raw = true;
        $this->unit_price->Nullable = false; // NOT NULL field
        $this->unit_price->Required = true; // Required field
        $this->unit_price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->unit_price->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->unit_price->SourceTableVar = 'procurement_report2';
        $this->Fields['unit_price'] = &$this->unit_price;

        // selling_price
        $this->selling_price = new ReportField(
            $this, // Table
            'x_selling_price', // Variable name
            'selling_price', // Name
            '`selling_price`', // Expression
            '`selling_price`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`selling_price`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->selling_price->InputTextType = "text";
        $this->selling_price->Raw = true;
        $this->selling_price->Nullable = false; // NOT NULL field
        $this->selling_price->Required = true; // Required field
        $this->selling_price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->selling_price->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->selling_price->SourceTableVar = 'procurement_report2';
        $this->Fields['selling_price'] = &$this->selling_price;

        // amount_paid
        $this->amount_paid = new ReportField(
            $this, // Table
            'x_amount_paid', // Variable name
            'amount_paid', // Name
            '`amount_paid`', // Expression
            '`amount_paid`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`amount_paid`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->amount_paid->InputTextType = "text";
        $this->amount_paid->Raw = true;
        $this->amount_paid->Nullable = false; // NOT NULL field
        $this->amount_paid->Required = true; // Required field
        $this->amount_paid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->amount_paid->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->amount_paid->SourceTableVar = 'procurement_report2';
        $this->Fields['amount_paid'] = &$this->amount_paid;

        // purchase_month
        $this->purchase_month = new ReportField(
            $this, // Table
            'x_purchase_month', // Variable name
            'purchase_month', // Name
            '`purchase_month`', // Expression
            '`purchase_month`', // Basic search expression
            200, // Type
            9, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`purchase_month`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->purchase_month->InputTextType = "text";
        $this->purchase_month->UseFilter = true; // Table header filter
        $this->purchase_month->Lookup = new Lookup($this->purchase_month, 'Procurement_Report', true, 'purchase_month', ["purchase_month","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->purchase_month->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->purchase_month->SourceTableVar = 'procurement_report2';
        $this->purchase_month->SearchType = "dropdown";
        $this->Fields['purchase_month'] = &$this->purchase_month;

        // purchase_year
        $this->purchase_year = new ReportField(
            $this, // Table
            'x_purchase_year', // Variable name
            'purchase_year', // Name
            '`purchase_year`', // Expression
            '`purchase_year`', // Basic search expression
            3, // Type
            5, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`purchase_year`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->purchase_year->InputTextType = "text";
        $this->purchase_year->Raw = true;
        $this->purchase_year->UseFilter = true; // Table header filter
        $this->purchase_year->Lookup = new Lookup($this->purchase_year, 'Procurement_Report', true, 'purchase_year', ["purchase_year","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->purchase_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->purchase_year->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->purchase_year->SourceTableVar = 'procurement_report2';
        $this->purchase_year->SearchType = "dropdown";
        $this->Fields['purchase_year'] = &$this->purchase_year;

        // date_created
        $this->date_created = new ReportField(
            $this, // Table
            'x_date_created', // Variable name
            'date_created', // Name
            '`date_created`', // Expression
            CastDateFieldForLike("`date_created`", 0, "DB"), // Basic search expression
            135, // Type
            76, // Size
            0, // Date/Time format
            false, // Is upload field
            '`date_created`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->date_created->InputTextType = "text";
        $this->date_created->Raw = true;
        $this->date_created->Nullable = false; // NOT NULL field
        $this->date_created->Required = true; // Required field
        $this->date_created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_created->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->date_created->SourceTableVar = 'procurement_report2';
        $this->Fields['date_created'] = &$this->date_created;

        // Procurement by Month
        $this->ProcurementbyMonth = new DbChart($this, 'ProcurementbyMonth', 'Procurement by Month', 'purchase_month', 'purchase_month', 1001, '', 0, 'COUNT', 600, 500);
        $this->ProcurementbyMonth->Position = 4;
        $this->ProcurementbyMonth->PageBreakType = "before";
        $this->ProcurementbyMonth->YAxisFormat = [""];
        $this->ProcurementbyMonth->YFieldFormat = [""];
        $this->ProcurementbyMonth->SortType = 0;
        $this->ProcurementbyMonth->SortSequence = "";
        $this->ProcurementbyMonth->SqlSelect = $this->getQueryBuilder()->select("`purchase_month`", "''", "COUNT(`purchase_month`)");
        $this->ProcurementbyMonth->SqlGroupBy = "`purchase_month`";
        $this->ProcurementbyMonth->SqlOrderBy = "";
        $this->ProcurementbyMonth->SeriesDateType = "";
        $this->ProcurementbyMonth->ID = "Procurement_Report_ProcurementbyMonth"; // Chart ID
        $this->ProcurementbyMonth->setParameters([
            ["type", "1001"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->ProcurementbyMonth->setParameters([
            ["caption", $this->ProcurementbyMonth->caption()],
            ["xaxisname", $this->ProcurementbyMonth->xAxisName()]
        ]); // Chart caption / X axis name
        $this->ProcurementbyMonth->setParameter("yaxisname", $this->ProcurementbyMonth->yAxisName()); // Y axis name
        $this->ProcurementbyMonth->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->ProcurementbyMonth->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->ProcurementbyMonth->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->ProcurementbyMonth->ID] = &$this->ProcurementbyMonth;

        // Procurement by Year
        $this->ProcurementbyYear = new DbChart($this, 'ProcurementbyYear', 'Procurement by Year', 'purchase_year', 'purchase_year', 1004, '', 0, 'COUNT', 600, 500);
        $this->ProcurementbyYear->Position = 4;
        $this->ProcurementbyYear->PageBreakType = "before";
        $this->ProcurementbyYear->YAxisFormat = ["Number"];
        $this->ProcurementbyYear->YFieldFormat = ["Number"];
        $this->ProcurementbyYear->SortType = 0;
        $this->ProcurementbyYear->SortSequence = "";
        $this->ProcurementbyYear->SqlSelect = $this->getQueryBuilder()->select("`purchase_year`", "''", "COUNT(`purchase_year`)");
        $this->ProcurementbyYear->SqlGroupBy = "`purchase_year`";
        $this->ProcurementbyYear->SqlOrderBy = "";
        $this->ProcurementbyYear->SeriesDateType = "";
        $this->ProcurementbyYear->ID = "Procurement_Report_ProcurementbyYear"; // Chart ID
        $this->ProcurementbyYear->setParameters([
            ["type", "1004"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->ProcurementbyYear->setParameters([
            ["caption", $this->ProcurementbyYear->caption()],
            ["xaxisname", $this->ProcurementbyYear->xAxisName()]
        ]); // Chart caption / X axis name
        $this->ProcurementbyYear->setParameter("yaxisname", $this->ProcurementbyYear->yAxisName()); // Y axis name
        $this->ProcurementbyYear->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->ProcurementbyYear->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->ProcurementbyYear->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->ProcurementbyYear->ID] = &$this->ProcurementbyYear;

        // Procurement by Supplier
        $this->ProcurementbySupplier = new DbChart($this, 'ProcurementbySupplier', 'Procurement by Supplier', 'supplier_name', 'supplier_name', 1005, '', 0, 'COUNT', 600, 500);
        $this->ProcurementbySupplier->Position = 4;
        $this->ProcurementbySupplier->PageBreakType = "before";
        $this->ProcurementbySupplier->YAxisFormat = [""];
        $this->ProcurementbySupplier->YFieldFormat = [""];
        $this->ProcurementbySupplier->SortType = 0;
        $this->ProcurementbySupplier->SortSequence = "";
        $this->ProcurementbySupplier->SqlSelect = $this->getQueryBuilder()->select("`supplier_name`", "''", "COUNT(`supplier_name`)");
        $this->ProcurementbySupplier->SqlGroupBy = "`supplier_name`";
        $this->ProcurementbySupplier->SqlOrderBy = "";
        $this->ProcurementbySupplier->SeriesDateType = "";
        $this->ProcurementbySupplier->ID = "Procurement_Report_ProcurementbySupplier"; // Chart ID
        $this->ProcurementbySupplier->setParameters([
            ["type", "1005"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->ProcurementbySupplier->setParameters([
            ["caption", $this->ProcurementbySupplier->caption()],
            ["xaxisname", $this->ProcurementbySupplier->xAxisName()]
        ]); // Chart caption / X axis name
        $this->ProcurementbySupplier->setParameter("yaxisname", $this->ProcurementbySupplier->yAxisName()); // Y axis name
        $this->ProcurementbySupplier->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->ProcurementbySupplier->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->ProcurementbySupplier->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->ProcurementbySupplier->ID] = &$this->ProcurementbySupplier;

        // Procurement by Category
        $this->ProcurementbyCategory = new DbChart($this, 'ProcurementbyCategory', 'Procurement by Category', 'category_name', 'category_name', 1002, '', 0, 'COUNT', 600, 500);
        $this->ProcurementbyCategory->Position = 4;
        $this->ProcurementbyCategory->PageBreakType = "before";
        $this->ProcurementbyCategory->YAxisFormat = [""];
        $this->ProcurementbyCategory->YFieldFormat = [""];
        $this->ProcurementbyCategory->SortType = 0;
        $this->ProcurementbyCategory->SortSequence = "";
        $this->ProcurementbyCategory->SqlSelect = $this->getQueryBuilder()->select("`category_name`", "''", "COUNT(`category_name`)");
        $this->ProcurementbyCategory->SqlGroupBy = "`category_name`";
        $this->ProcurementbyCategory->SqlOrderBy = "";
        $this->ProcurementbyCategory->SeriesDateType = "";
        $this->ProcurementbyCategory->ID = "Procurement_Report_ProcurementbyCategory"; // Chart ID
        $this->ProcurementbyCategory->setParameters([
            ["type", "1002"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->ProcurementbyCategory->setParameters([
            ["caption", $this->ProcurementbyCategory->caption()],
            ["xaxisname", $this->ProcurementbyCategory->xAxisName()]
        ]); // Chart caption / X axis name
        $this->ProcurementbyCategory->setParameter("yaxisname", $this->ProcurementbyCategory->yAxisName()); // Y axis name
        $this->ProcurementbyCategory->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->ProcurementbyCategory->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->ProcurementbyCategory->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->ProcurementbyCategory->ID] = &$this->ProcurementbyCategory;

        // Procurement by Subcategory
        $this->ProcurementbySubcategory = new DbChart($this, 'ProcurementbySubcategory', 'Procurement by Subcategory', 'subcategory_name', 'subcategory_name', 1003, '', 0, 'COUNT', 600, 500);
        $this->ProcurementbySubcategory->Position = 4;
        $this->ProcurementbySubcategory->PageBreakType = "before";
        $this->ProcurementbySubcategory->YAxisFormat = [""];
        $this->ProcurementbySubcategory->YFieldFormat = [""];
        $this->ProcurementbySubcategory->SortType = 0;
        $this->ProcurementbySubcategory->SortSequence = "";
        $this->ProcurementbySubcategory->SqlSelect = $this->getQueryBuilder()->select("`subcategory_name`", "''", "COUNT(`subcategory_name`)");
        $this->ProcurementbySubcategory->SqlGroupBy = "`subcategory_name`";
        $this->ProcurementbySubcategory->SqlOrderBy = "";
        $this->ProcurementbySubcategory->SeriesDateType = "";
        $this->ProcurementbySubcategory->ID = "Procurement_Report_ProcurementbySubcategory"; // Chart ID
        $this->ProcurementbySubcategory->setParameters([
            ["type", "1003"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->ProcurementbySubcategory->setParameters([
            ["caption", $this->ProcurementbySubcategory->caption()],
            ["xaxisname", $this->ProcurementbySubcategory->xAxisName()]
        ]); // Chart caption / X axis name
        $this->ProcurementbySubcategory->setParameter("yaxisname", $this->ProcurementbySubcategory->yAxisName()); // Y axis name
        $this->ProcurementbySubcategory->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->ProcurementbySubcategory->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->ProcurementbySubcategory->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->ProcurementbySubcategory->ID] = &$this->ProcurementbySubcategory;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Single column sort
    protected function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($fld->GroupingFieldId == 0) {
                $this->setDetailOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if ($fld->GroupingFieldId == 0) {
                $fld->setSort("");
            }
        }
    }

    // Get Sort SQL
    protected function sortSql()
    {
        $dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
        $grps = [];
        foreach ($this->Fields as $fld) {
            if (in_array($fld->getSort(), ["ASC", "DESC"])) {
                $fldsql = $fld->Expression;
                if ($fld->GroupingFieldId > 0) {
                    if ($fld->GroupSql != "") {
                        $grps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
                    } else {
                        $grps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
                    }
                }
            }
        }
        $sortSql = implode(", ", array_values($grps));
        if ($dtlSortSql != "") {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $dtlSortSql;
        }
        return $sortSql;
    }

    // Summary properties
    private $sqlSelectAggregate = null;
    private $sqlAggregatePrefix = "";
    private $sqlAggregateSuffix = "";
    private $sqlSelectCount = null;

    // Select Aggregate
    public function getSqlSelectAggregate()
    {
        return $this->sqlSelectAggregate ?? $this->getQueryBuilder()->select("*");
    }

    public function setSqlSelectAggregate($v)
    {
        $this->sqlSelectAggregate = $v;
    }

    // Aggregate Prefix
    public function getSqlAggregatePrefix()
    {
        return ($this->sqlAggregatePrefix != "") ? $this->sqlAggregatePrefix : "";
    }

    public function setSqlAggregatePrefix($v)
    {
        $this->sqlAggregatePrefix = $v;
    }

    // Aggregate Suffix
    public function getSqlAggregateSuffix()
    {
        return ($this->sqlAggregateSuffix != "") ? $this->sqlAggregateSuffix : "";
    }

    public function setSqlAggregateSuffix($v)
    {
        $this->sqlAggregateSuffix = $v;
    }

    // Select Count
    public function getSqlSelectCount()
    {
        return $this->sqlSelectCount ?? $this->getQueryBuilder()->select("COUNT(*)");
    }

    public function setSqlSelectCount($v)
    {
        $this->sqlSelectCount = $v;
    }

    // Render for lookup
    public function renderLookup()
    {
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "procurement_report";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect()
    {
        if ($this->SqlSelect) {
            return $this->SqlSelect;
        }
        $select = $this->getQueryBuilder()->select($this->sqlSelectFields());
        return $select;
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        $useFieldNames = false;
        $fieldNames = [];
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($this->Fields as $field) {
            $expr = $field->Expression;
            $customExpr = $field->CustomDataType?->convertToPHPValueSQL($expr, $platform) ?? $expr;
            if ($customExpr != $expr) {
                $fieldNames[] = $customExpr . " AS " . QuotedName($field->Name, $this->Dbid);
                $useFieldNames = true;
            } else {
                $fieldNames[] = $expr;
            }
        }
        return $useFieldNames ? implode(", ", $fieldNames) : "*";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = !EmptyValue($this->id->OldValue) && !$current ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "" => $Language->phrase("View"),
            "" => $Language->phrase("Edit"),
            "" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "procurementreport";
    }

    // API page name
    public function getApiPageName($action)
    {
        return "ProcurementReportSummary";
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("", $parm);
        } else {
            $url = $this->keyUrl("", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "?" . $parm;
        } else {
            $url = "";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . VarToJson($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            $this->DrillDown ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, 0))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, 0))) // Other API
                : []; // Non-API
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif ($isApi && (($keyValue = Key(0) ?? $keyValues[0] ?? null) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        return implode(" OR ", array_map(fn($row) => "(" . $this->getRecordFilter($row) . ")", $rows));
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
