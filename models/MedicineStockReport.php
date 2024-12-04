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
 * Table class for Medicine Stock Report
 */
class MedicineStockReport extends ReportTable
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
    public $StockUpdatebyMonth;
    public $StockbySupplier;
    public $StockbyExpiryStatus;
    public $StockbyMedicineBrand;

    // Fields
    public $id;
    public $batch_number;
    public $brand_name;
    public $quantity;
    public $qty_left_o;
    public $measuring_unit;
    public $buying_price_per_unit;
    public $selling_price_per_unit;
    public $expiry_date;
    public $expiry_status_o;
    public $date_created;
    public $date_updated;
    public $supplier_name;
    public $phone;
    public $email_address;
    public $physical_address;
    public $qty_left;
    public $expiry_status;
    public $stockadd_month;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "Medicine_Stock_Report";
        $this->TableName = 'Medicine Stock Report';
        $this->TableType = "REPORT";
        $this->TableReportType = "summary"; // Report Type
        $this->ReportSourceTable = 'medicine_stock_report2'; // Report source table
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
        $this->id->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['id'] = &$this->id;

        // batch_number
        $this->batch_number = new ReportField(
            $this, // Table
            'x_batch_number', // Variable name
            'batch_number', // Name
            '`batch_number`', // Expression
            '`batch_number`', // Basic search expression
            200, // Type
            20, // Size
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
        $this->batch_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->batch_number->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['batch_number'] = &$this->batch_number;

        // brand_name
        $this->brand_name = new ReportField(
            $this, // Table
            'x_brand_name', // Variable name
            'brand_name', // Name
            '`brand_name`', // Expression
            '`brand_name`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`brand_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->brand_name->InputTextType = "text";
        $this->brand_name->Nullable = false; // NOT NULL field
        $this->brand_name->Required = true; // Required field
        $this->brand_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->brand_name->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['brand_name'] = &$this->brand_name;

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
        $this->quantity->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['quantity'] = &$this->quantity;

        // qty_left_o
        $this->qty_left_o = new ReportField(
            $this, // Table
            'x_qty_left_o', // Variable name
            'qty_left_o', // Name
            'quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id)', // Expression
            'quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id)', // Basic search expression
            131, // Type
            34, // Size
            -1, // Date/Time format
            false, // Is upload field
            'quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id)', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->qty_left_o->InputTextType = "text";
        $this->qty_left_o->Raw = true;
        $this->qty_left_o->IsCustom = true; // Custom field
        $this->qty_left_o->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->qty_left_o->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->qty_left_o->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['qty_left_o'] = &$this->qty_left_o;

        // measuring_unit
        $this->measuring_unit = new ReportField(
            $this, // Table
            'x_measuring_unit', // Variable name
            'measuring_unit', // Name
            '`measuring_unit`', // Expression
            '`measuring_unit`', // Basic search expression
            200, // Type
            20, // Size
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
        $this->measuring_unit->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['measuring_unit'] = &$this->measuring_unit;

        // buying_price_per_unit
        $this->buying_price_per_unit = new ReportField(
            $this, // Table
            'x_buying_price_per_unit', // Variable name
            'buying_price_per_unit', // Name
            '`buying_price_per_unit`', // Expression
            '`buying_price_per_unit`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`buying_price_per_unit`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->buying_price_per_unit->InputTextType = "text";
        $this->buying_price_per_unit->Raw = true;
        $this->buying_price_per_unit->Nullable = false; // NOT NULL field
        $this->buying_price_per_unit->Required = true; // Required field
        $this->buying_price_per_unit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->buying_price_per_unit->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->buying_price_per_unit->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['buying_price_per_unit'] = &$this->buying_price_per_unit;

        // selling_price_per_unit
        $this->selling_price_per_unit = new ReportField(
            $this, // Table
            'x_selling_price_per_unit', // Variable name
            'selling_price_per_unit', // Name
            '`selling_price_per_unit`', // Expression
            '`selling_price_per_unit`', // Basic search expression
            5, // Type
            22, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`selling_price_per_unit`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->selling_price_per_unit->InputTextType = "text";
        $this->selling_price_per_unit->Raw = true;
        $this->selling_price_per_unit->Nullable = false; // NOT NULL field
        $this->selling_price_per_unit->Required = true; // Required field
        $this->selling_price_per_unit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->selling_price_per_unit->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->selling_price_per_unit->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['selling_price_per_unit'] = &$this->selling_price_per_unit;

        // expiry_date
        $this->expiry_date = new ReportField(
            $this, // Table
            'x_expiry_date', // Variable name
            'expiry_date', // Name
            '`expiry_date`', // Expression
            CastDateFieldForLike("`expiry_date`", 7, "DB"), // Basic search expression
            133, // Type
            40, // Size
            7, // Date/Time format
            false, // Is upload field
            '`expiry_date`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->expiry_date->InputTextType = "text";
        $this->expiry_date->Raw = true;
        $this->expiry_date->Nullable = false; // NOT NULL field
        $this->expiry_date->Required = true; // Required field
        $this->expiry_date->DefaultErrorMessage = str_replace("%s", DateFormat(7), $Language->phrase("IncorrectDate"));
        $this->expiry_date->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->expiry_date->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['expiry_date'] = &$this->expiry_date;

        // expiry_status_o
        $this->expiry_status_o = new ReportField(
            $this, // Table
            'x_expiry_status_o', // Variable name
            'expiry_status_o', // Name
            '\'\'', // Expression
            '\'\'', // Basic search expression
            200, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '\'\'', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->expiry_status_o->InputTextType = "text";
        $this->expiry_status_o->IsCustom = true; // Custom field
        $this->expiry_status_o->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->expiry_status_o->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['expiry_status_o'] = &$this->expiry_status_o;

        // date_created
        $this->date_created = new ReportField(
            $this, // Table
            'x_date_created', // Variable name
            'date_created', // Name
            '`date_created`', // Expression
            CastDateFieldForLike("`date_created`", 7, "DB"), // Basic search expression
            135, // Type
            76, // Size
            7, // Date/Time format
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
        $this->date_created->DefaultErrorMessage = str_replace("%s", DateFormat(7), $Language->phrase("IncorrectDate"));
        $this->date_created->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->date_created->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new ReportField(
            $this, // Table
            'x_date_updated', // Variable name
            'date_updated', // Name
            '`date_updated`', // Expression
            CastDateFieldForLike("`date_updated`", 7, "DB"), // Basic search expression
            135, // Type
            76, // Size
            7, // Date/Time format
            false, // Is upload field
            '`date_updated`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->date_updated->InputTextType = "text";
        $this->date_updated->Raw = true;
        $this->date_updated->Nullable = false; // NOT NULL field
        $this->date_updated->Required = true; // Required field
        $this->date_updated->DefaultErrorMessage = str_replace("%s", DateFormat(7), $Language->phrase("IncorrectDate"));
        $this->date_updated->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->date_updated->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['date_updated'] = &$this->date_updated;

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
        $this->supplier_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->supplier_name->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['supplier_name'] = &$this->supplier_name;

        // phone
        $this->phone = new ReportField(
            $this, // Table
            'x_phone', // Variable name
            'phone', // Name
            '`phone`', // Expression
            '`phone`', // Basic search expression
            129, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->phone->InputTextType = "text";
        $this->phone->Nullable = false; // NOT NULL field
        $this->phone->Required = true; // Required field
        $this->phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->phone->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['phone'] = &$this->phone;

        // email_address
        $this->email_address = new ReportField(
            $this, // Table
            'x_email_address', // Variable name
            'email_address', // Name
            '`email_address`', // Expression
            '`email_address`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`email_address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->email_address->InputTextType = "text";
        $this->email_address->Nullable = false; // NOT NULL field
        $this->email_address->Required = true; // Required field
        $this->email_address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->email_address->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['email_address'] = &$this->email_address;

        // physical_address
        $this->physical_address = new ReportField(
            $this, // Table
            'x_physical_address', // Variable name
            'physical_address', // Name
            '`physical_address`', // Expression
            '`physical_address`', // Basic search expression
            200, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`physical_address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->physical_address->InputTextType = "text";
        $this->physical_address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->physical_address->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['physical_address'] = &$this->physical_address;

        // qty_left
        $this->qty_left = new ReportField(
            $this, // Table
            'x_qty_left', // Variable name
            'qty_left', // Name
            '`qty_left`', // Expression
            '`qty_left`', // Basic search expression
            131, // Type
            34, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`qty_left`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->qty_left->InputTextType = "text";
        $this->qty_left->Raw = true;
        $this->qty_left->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->qty_left->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->qty_left->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['qty_left'] = &$this->qty_left;

        // expiry_status
        $this->expiry_status = new ReportField(
            $this, // Table
            'x_expiry_status', // Variable name
            'expiry_status', // Name
            '`expiry_status`', // Expression
            '`expiry_status`', // Basic search expression
            200, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`expiry_status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->expiry_status->InputTextType = "text";
        $this->expiry_status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->expiry_status->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['expiry_status'] = &$this->expiry_status;

        // stockadd_month
        $this->stockadd_month = new ReportField(
            $this, // Table
            'x_stockadd_month', // Variable name
            'stockadd_month', // Name
            '`stockadd_month`', // Expression
            '`stockadd_month`', // Basic search expression
            200, // Type
            9, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`stockadd_month`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->stockadd_month->InputTextType = "text";
        $this->stockadd_month->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->stockadd_month->SourceTableVar = 'medicine_stock_report2';
        $this->Fields['stockadd_month'] = &$this->stockadd_month;

        // Stock Update by Month
        $this->StockUpdatebyMonth = new DbChart($this, 'StockUpdatebyMonth', 'Stock Update by Month', 'stockadd_month', 'stockadd_month', 1001, '', 0, 'COUNT', 600, 500);
        $this->StockUpdatebyMonth->Position = 4;
        $this->StockUpdatebyMonth->PageBreakType = "before";
        $this->StockUpdatebyMonth->YAxisFormat = [""];
        $this->StockUpdatebyMonth->YFieldFormat = [""];
        $this->StockUpdatebyMonth->SortType = 0;
        $this->StockUpdatebyMonth->SortSequence = "";
        $this->StockUpdatebyMonth->SqlSelect = $this->getQueryBuilder()->select("`stockadd_month`", "''", "COUNT(`stockadd_month`)");
        $this->StockUpdatebyMonth->SqlGroupBy = "`stockadd_month`";
        $this->StockUpdatebyMonth->SqlOrderBy = "";
        $this->StockUpdatebyMonth->SeriesDateType = "";
        $this->StockUpdatebyMonth->ID = "Medicine_Stock_Report_StockUpdatebyMonth"; // Chart ID
        $this->StockUpdatebyMonth->setParameters([
            ["type", "1001"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->StockUpdatebyMonth->setParameters([
            ["caption", $this->StockUpdatebyMonth->caption()],
            ["xaxisname", $this->StockUpdatebyMonth->xAxisName()]
        ]); // Chart caption / X axis name
        $this->StockUpdatebyMonth->setParameter("yaxisname", $this->StockUpdatebyMonth->yAxisName()); // Y axis name
        $this->StockUpdatebyMonth->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->StockUpdatebyMonth->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->StockUpdatebyMonth->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->StockUpdatebyMonth->ID] = &$this->StockUpdatebyMonth;

        // Stock by Supplier
        $this->StockbySupplier = new DbChart($this, 'StockbySupplier', 'Stock by Supplier', 'supplier_name', 'supplier_name', 1004, '', 0, 'COUNT', 600, 500);
        $this->StockbySupplier->Position = 4;
        $this->StockbySupplier->PageBreakType = "before";
        $this->StockbySupplier->YAxisFormat = [""];
        $this->StockbySupplier->YFieldFormat = [""];
        $this->StockbySupplier->SortType = 0;
        $this->StockbySupplier->SortSequence = "";
        $this->StockbySupplier->SqlSelect = $this->getQueryBuilder()->select("`supplier_name`", "''", "COUNT(`supplier_name`)");
        $this->StockbySupplier->SqlGroupBy = "`supplier_name`";
        $this->StockbySupplier->SqlOrderBy = "";
        $this->StockbySupplier->SeriesDateType = "";
        $this->StockbySupplier->ID = "Medicine_Stock_Report_StockbySupplier"; // Chart ID
        $this->StockbySupplier->setParameters([
            ["type", "1004"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->StockbySupplier->setParameters([
            ["caption", $this->StockbySupplier->caption()],
            ["xaxisname", $this->StockbySupplier->xAxisName()]
        ]); // Chart caption / X axis name
        $this->StockbySupplier->setParameter("yaxisname", $this->StockbySupplier->yAxisName()); // Y axis name
        $this->StockbySupplier->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->StockbySupplier->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->StockbySupplier->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->StockbySupplier->ID] = &$this->StockbySupplier;

        // Stock by Expiry Status
        $this->StockbyExpiryStatus = new DbChart($this, 'StockbyExpiryStatus', 'Stock by Expiry Status', 'expiry_status_o', 'expiry_status_o', 1006, '', 0, 'COUNT', 600, 500);
        $this->StockbyExpiryStatus->Position = 4;
        $this->StockbyExpiryStatus->PageBreakType = "before";
        $this->StockbyExpiryStatus->YAxisFormat = [""];
        $this->StockbyExpiryStatus->YFieldFormat = [""];
        $this->StockbyExpiryStatus->SortType = 0;
        $this->StockbyExpiryStatus->SortSequence = "";
        $this->StockbyExpiryStatus->SqlSelect = $this->getQueryBuilder()->select("''", "''", "COUNT('')");
        $this->StockbyExpiryStatus->SqlGroupBy = "''";
        $this->StockbyExpiryStatus->SqlOrderBy = "";
        $this->StockbyExpiryStatus->SeriesDateType = "";
        $this->StockbyExpiryStatus->ID = "Medicine_Stock_Report_StockbyExpiryStatus"; // Chart ID
        $this->StockbyExpiryStatus->setParameters([
            ["type", "1006"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->StockbyExpiryStatus->setParameters([
            ["caption", $this->StockbyExpiryStatus->caption()],
            ["xaxisname", $this->StockbyExpiryStatus->xAxisName()]
        ]); // Chart caption / X axis name
        $this->StockbyExpiryStatus->setParameter("yaxisname", $this->StockbyExpiryStatus->yAxisName()); // Y axis name
        $this->StockbyExpiryStatus->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->StockbyExpiryStatus->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->StockbyExpiryStatus->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->StockbyExpiryStatus->ID] = &$this->StockbyExpiryStatus;

        // Stock by Medicine Brand
        $this->StockbyMedicineBrand = new DbChart($this, 'StockbyMedicineBrand', 'Stock by Medicine Brand', 'brand_name', 'brand_name', 1002, '', 0, 'COUNT', 600, 500);
        $this->StockbyMedicineBrand->Position = 4;
        $this->StockbyMedicineBrand->PageBreakType = "before";
        $this->StockbyMedicineBrand->YAxisFormat = [""];
        $this->StockbyMedicineBrand->YFieldFormat = [""];
        $this->StockbyMedicineBrand->SortType = 0;
        $this->StockbyMedicineBrand->SortSequence = "";
        $this->StockbyMedicineBrand->SqlSelect = $this->getQueryBuilder()->select("`brand_name`", "''", "COUNT(`brand_name`)");
        $this->StockbyMedicineBrand->SqlGroupBy = "`brand_name`";
        $this->StockbyMedicineBrand->SqlOrderBy = "";
        $this->StockbyMedicineBrand->SeriesDateType = "";
        $this->StockbyMedicineBrand->ID = "Medicine_Stock_Report_StockbyMedicineBrand"; // Chart ID
        $this->StockbyMedicineBrand->setParameters([
            ["type", "1002"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->StockbyMedicineBrand->setParameters([
            ["caption", $this->StockbyMedicineBrand->caption()],
            ["xaxisname", $this->StockbyMedicineBrand->xAxisName()]
        ]); // Chart caption / X axis name
        $this->StockbyMedicineBrand->setParameter("yaxisname", $this->StockbyMedicineBrand->yAxisName()); // Y axis name
        $this->StockbyMedicineBrand->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->StockbyMedicineBrand->setParameter("alpha", DbChart::getDefaultAlpha()); // Chart alpha (datasets background color)
        $this->StockbyMedicineBrand->setParameters([["options.plugins.legend.display",false],["options.plugins.legend.fullWidth",false],["options.plugins.legend.reverse",false],["options.plugins.legend.rtl",false],["options.plugins.legend.labels.usePointStyle",false],["options.plugins.title.display",false],["options.plugins.tooltip.enabled",false],["options.plugins.tooltip.intersect",false],["options.plugins.tooltip.displayColors",false],["options.plugins.tooltip.rtl",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["options.scales.r.angleLines.display",false],["options.plugins.stacked100.enable",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["dataset.circular",false],["scale.offset",false],["scale.gridLines.offsetGridLines",false],["options.plugins.datalabels.clamp",false],["options.plugins.datalabels.clip",false],["options.plugins.datalabels.display",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
        $this->Charts[$this->StockbyMedicineBrand->ID] = &$this->StockbyMedicineBrand;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "medicine_stock_report";
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
        return "*, quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id) AS qty_left, '' AS expiry_status, quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id) AS `qty_left_o`, '' AS `expiry_status_o`";
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
        return "medicinestockreport";
    }

    // API page name
    public function getApiPageName($action)
    {
        return "MedicineStockReportSummary";
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
        $current_date = CurrentDate();
        if ($this->expiry_date->CurrentValue > $current_date) {
            $this->expiry_status_o->CellAttrs["style"] = "background-color: #15b20b; color: white";
            $this->expiry_status_o->ViewValue = "Active"; 
        } else if ($this->expiry_date->CurrentValue < $current_date) {
            $this->expiry_status_o->CellAttrs["style"] = "background-color: #e5064b; color: white";
            $this->expiry_status_o->ViewValue = "Expired"; 
        } 
        $batch_quantity = $this->quantity->ViewValue;
        if ($this->qty_left->CurrentValue == 0) {
            $this->qty_left->ViewValue = $batch_quantity; 
        } else if ($this->qty_left_o->CurrentValue == 0) {
            $this->qty_left_o->ViewValue = $batch_quantity; 
        }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
