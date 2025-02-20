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
 * Table class for medicine_stock_report
 */
class MedicineStockReport2 extends DbTable
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

    // Fields
    public $id;
    public $batch_number;
    public $brand_name;
    public $quantity;
    public $qty_left;
    public $measuring_unit;
    public $buying_price_per_unit;
    public $selling_price_per_unit;
    public $expiry_date;
    public $expiry_status;
    public $date_created;
    public $date_updated;
    public $supplier_name;
    public $phone;
    public $email_address;
    public $physical_address;
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
        $this->TableVar = "medicine_stock_report2";
        $this->TableName = 'medicine_stock_report';
        $this->TableType = "VIEW";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "medicine_stock_report";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

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
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // id
        $this->id = new DbField(
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
        $this->Fields['id'] = &$this->id;

        // batch_number
        $this->batch_number = new DbField(
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
        $this->Fields['batch_number'] = &$this->batch_number;

        // brand_name
        $this->brand_name = new DbField(
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
        $this->Fields['brand_name'] = &$this->brand_name;

        // quantity
        $this->quantity = new DbField(
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
        $this->Fields['quantity'] = &$this->quantity;

        // qty_left
        $this->qty_left = new DbField(
            $this, // Table
            'x_qty_left', // Variable name
            'qty_left', // Name
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
        $this->qty_left->InputTextType = "text";
        $this->qty_left->Raw = true;
        $this->qty_left->IsCustom = true; // Custom field
        $this->qty_left->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->qty_left->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['qty_left'] = &$this->qty_left;

        // measuring_unit
        $this->measuring_unit = new DbField(
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
        $this->Fields['measuring_unit'] = &$this->measuring_unit;

        // buying_price_per_unit
        $this->buying_price_per_unit = new DbField(
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
        $this->Fields['buying_price_per_unit'] = &$this->buying_price_per_unit;

        // selling_price_per_unit
        $this->selling_price_per_unit = new DbField(
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
        $this->Fields['selling_price_per_unit'] = &$this->selling_price_per_unit;

        // expiry_date
        $this->expiry_date = new DbField(
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
        $this->Fields['expiry_date'] = &$this->expiry_date;

        // expiry_status
        $this->expiry_status = new DbField(
            $this, // Table
            'x_expiry_status', // Variable name
            'expiry_status', // Name
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
        $this->expiry_status->InputTextType = "text";
        $this->expiry_status->IsCustom = true; // Custom field
        $this->expiry_status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['expiry_status'] = &$this->expiry_status;

        // date_created
        $this->date_created = new DbField(
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
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            $this, // Table
            'x_date_updated', // Variable name
            'date_updated', // Name
            '`date_updated`', // Expression
            CastDateFieldForLike("`date_updated`", 0, "DB"), // Basic search expression
            135, // Type
            76, // Size
            0, // Date/Time format
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
        $this->date_updated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_updated->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['date_updated'] = &$this->date_updated;

        // supplier_name
        $this->supplier_name = new DbField(
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
        $this->Fields['supplier_name'] = &$this->supplier_name;

        // phone
        $this->phone = new DbField(
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
        $this->Fields['phone'] = &$this->phone;

        // email_address
        $this->email_address = new DbField(
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
        $this->Fields['email_address'] = &$this->email_address;

        // physical_address
        $this->physical_address = new DbField(
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
        $this->Fields['physical_address'] = &$this->physical_address;

        // stockadd_month
        $this->stockadd_month = new DbField(
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
        $this->Fields['stockadd_month'] = &$this->stockadd_month;

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

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
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
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        return "*, quantity - (SELECT SUM(quantity) FROM medicine_dispensation_details WHERE medicine_stock_id=medicine_stock_report.id) AS `qty_left`, '' AS `expiry_status`";
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

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $queryBuilder->executeStatement();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $result;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['id']) && !EmptyValue($this->id->CurrentValue)) {
                $rs['id'] = $this->id->CurrentValue;
            }
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->batch_number->DbValue = $row['batch_number'];
        $this->brand_name->DbValue = $row['brand_name'];
        $this->quantity->DbValue = $row['quantity'];
        $this->qty_left->DbValue = $row['qty_left'];
        $this->measuring_unit->DbValue = $row['measuring_unit'];
        $this->buying_price_per_unit->DbValue = $row['buying_price_per_unit'];
        $this->selling_price_per_unit->DbValue = $row['selling_price_per_unit'];
        $this->expiry_date->DbValue = $row['expiry_date'];
        $this->expiry_status->DbValue = $row['expiry_status'];
        $this->date_created->DbValue = $row['date_created'];
        $this->date_updated->DbValue = $row['date_updated'];
        $this->supplier_name->DbValue = $row['supplier_name'];
        $this->phone->DbValue = $row['phone'];
        $this->email_address->DbValue = $row['email_address'];
        $this->physical_address->DbValue = $row['physical_address'];
        $this->stockadd_month->DbValue = $row['stockadd_month'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
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
        return $_SESSION[$name] ?? GetUrl("medicinestockreport2list");
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
            "medicinestockreport2view" => $Language->phrase("View"),
            "medicinestockreport2edit" => $Language->phrase("Edit"),
            "medicinestockreport2add" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "medicinestockreport2list";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "MedicineStockReport2View",
            Config("API_ADD_ACTION") => "MedicineStockReport2Add",
            Config("API_EDIT_ACTION") => "MedicineStockReport2Edit",
            Config("API_DELETE_ACTION") => "MedicineStockReport2Delete",
            Config("API_LIST_ACTION") => "MedicineStockReport2List",
            default => ""
        };
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
        return "medicinestockreport2list";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("medicinestockreport2view", $parm);
        } else {
            $url = $this->keyUrl("medicinestockreport2view", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "medicinestockreport2add?" . $parm;
        } else {
            $url = "medicinestockreport2add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("medicinestockreport2edit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("medicinestockreport2list", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("medicinestockreport2add", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("medicinestockreport2list", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("medicinestockreport2delete", $parm);
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

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id->setDbValue($row['id']);
        $this->batch_number->setDbValue($row['batch_number']);
        $this->brand_name->setDbValue($row['brand_name']);
        $this->quantity->setDbValue($row['quantity']);
        $this->qty_left->setDbValue($row['qty_left']);
        $this->measuring_unit->setDbValue($row['measuring_unit']);
        $this->buying_price_per_unit->setDbValue($row['buying_price_per_unit']);
        $this->selling_price_per_unit->setDbValue($row['selling_price_per_unit']);
        $this->expiry_date->setDbValue($row['expiry_date']);
        $this->expiry_status->setDbValue($row['expiry_status']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
        $this->supplier_name->setDbValue($row['supplier_name']);
        $this->phone->setDbValue($row['phone']);
        $this->email_address->setDbValue($row['email_address']);
        $this->physical_address->setDbValue($row['physical_address']);
        $this->stockadd_month->setDbValue($row['stockadd_month']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "MedicineStockReport2List";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // batch_number

        // brand_name

        // quantity

        // qty_left

        // measuring_unit

        // buying_price_per_unit

        // selling_price_per_unit

        // expiry_date

        // expiry_status

        // date_created

        // date_updated

        // supplier_name

        // phone

        // email_address

        // physical_address

        // stockadd_month

        // id
        $this->id->ViewValue = $this->id->CurrentValue;

        // batch_number
        $this->batch_number->ViewValue = $this->batch_number->CurrentValue;

        // brand_name
        $this->brand_name->ViewValue = $this->brand_name->CurrentValue;

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());

        // qty_left
        $this->qty_left->ViewValue = $this->qty_left->CurrentValue;
        $this->qty_left->ViewValue = FormatNumber($this->qty_left->ViewValue, $this->qty_left->formatPattern());

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

        // expiry_status
        $this->expiry_status->ViewValue = $this->expiry_status->CurrentValue;

        // date_created
        $this->date_created->ViewValue = $this->date_created->CurrentValue;
        $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

        // supplier_name
        $this->supplier_name->ViewValue = $this->supplier_name->CurrentValue;

        // phone
        $this->phone->ViewValue = $this->phone->CurrentValue;

        // email_address
        $this->email_address->ViewValue = $this->email_address->CurrentValue;

        // physical_address
        $this->physical_address->ViewValue = $this->physical_address->CurrentValue;

        // stockadd_month
        $this->stockadd_month->ViewValue = $this->stockadd_month->CurrentValue;

        // id
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // batch_number
        $this->batch_number->HrefValue = "";
        $this->batch_number->TooltipValue = "";

        // brand_name
        $this->brand_name->HrefValue = "";
        $this->brand_name->TooltipValue = "";

        // quantity
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // qty_left
        $this->qty_left->HrefValue = "";
        $this->qty_left->TooltipValue = "";

        // measuring_unit
        $this->measuring_unit->HrefValue = "";
        $this->measuring_unit->TooltipValue = "";

        // buying_price_per_unit
        $this->buying_price_per_unit->HrefValue = "";
        $this->buying_price_per_unit->TooltipValue = "";

        // selling_price_per_unit
        $this->selling_price_per_unit->HrefValue = "";
        $this->selling_price_per_unit->TooltipValue = "";

        // expiry_date
        $this->expiry_date->HrefValue = "";
        $this->expiry_date->TooltipValue = "";

        // expiry_status
        $this->expiry_status->HrefValue = "";
        $this->expiry_status->TooltipValue = "";

        // date_created
        $this->date_created->HrefValue = "";
        $this->date_created->TooltipValue = "";

        // date_updated
        $this->date_updated->HrefValue = "";
        $this->date_updated->TooltipValue = "";

        // supplier_name
        $this->supplier_name->HrefValue = "";
        $this->supplier_name->TooltipValue = "";

        // phone
        $this->phone->HrefValue = "";
        $this->phone->TooltipValue = "";

        // email_address
        $this->email_address->HrefValue = "";
        $this->email_address->TooltipValue = "";

        // physical_address
        $this->physical_address->HrefValue = "";
        $this->physical_address->TooltipValue = "";

        // stockadd_month
        $this->stockadd_month->HrefValue = "";
        $this->stockadd_month->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->setupEditAttributes();
        $this->id->EditValue = $this->id->CurrentValue;

        // batch_number
        $this->batch_number->setupEditAttributes();
        if (!$this->batch_number->Raw) {
            $this->batch_number->CurrentValue = HtmlDecode($this->batch_number->CurrentValue);
        }
        $this->batch_number->EditValue = $this->batch_number->CurrentValue;
        $this->batch_number->PlaceHolder = RemoveHtml($this->batch_number->caption());

        // brand_name
        $this->brand_name->setupEditAttributes();
        if (!$this->brand_name->Raw) {
            $this->brand_name->CurrentValue = HtmlDecode($this->brand_name->CurrentValue);
        }
        $this->brand_name->EditValue = $this->brand_name->CurrentValue;
        $this->brand_name->PlaceHolder = RemoveHtml($this->brand_name->caption());

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // qty_left
        $this->qty_left->setupEditAttributes();
        $this->qty_left->EditValue = $this->qty_left->CurrentValue;
        $this->qty_left->PlaceHolder = RemoveHtml($this->qty_left->caption());
        if (strval($this->qty_left->EditValue) != "" && is_numeric($this->qty_left->EditValue)) {
            $this->qty_left->EditValue = FormatNumber($this->qty_left->EditValue, null);
        }

        // measuring_unit
        $this->measuring_unit->setupEditAttributes();
        if (!$this->measuring_unit->Raw) {
            $this->measuring_unit->CurrentValue = HtmlDecode($this->measuring_unit->CurrentValue);
        }
        $this->measuring_unit->EditValue = $this->measuring_unit->CurrentValue;
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
        $this->expiry_date->EditValue = FormatDateTime($this->expiry_date->CurrentValue, $this->expiry_date->formatPattern());
        $this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

        // expiry_status
        $this->expiry_status->setupEditAttributes();
        if (!$this->expiry_status->Raw) {
            $this->expiry_status->CurrentValue = HtmlDecode($this->expiry_status->CurrentValue);
        }
        $this->expiry_status->EditValue = $this->expiry_status->CurrentValue;
        $this->expiry_status->PlaceHolder = RemoveHtml($this->expiry_status->caption());

        // date_created
        $this->date_created->setupEditAttributes();
        $this->date_created->EditValue = FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

        // date_updated
        $this->date_updated->setupEditAttributes();
        $this->date_updated->EditValue = FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

        // supplier_name
        $this->supplier_name->setupEditAttributes();
        if (!$this->supplier_name->Raw) {
            $this->supplier_name->CurrentValue = HtmlDecode($this->supplier_name->CurrentValue);
        }
        $this->supplier_name->EditValue = $this->supplier_name->CurrentValue;
        $this->supplier_name->PlaceHolder = RemoveHtml($this->supplier_name->caption());

        // phone
        $this->phone->setupEditAttributes();
        if (!$this->phone->Raw) {
            $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
        }
        $this->phone->EditValue = $this->phone->CurrentValue;
        $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

        // email_address
        $this->email_address->setupEditAttributes();
        if (!$this->email_address->Raw) {
            $this->email_address->CurrentValue = HtmlDecode($this->email_address->CurrentValue);
        }
        $this->email_address->EditValue = $this->email_address->CurrentValue;
        $this->email_address->PlaceHolder = RemoveHtml($this->email_address->caption());

        // physical_address
        $this->physical_address->setupEditAttributes();
        if (!$this->physical_address->Raw) {
            $this->physical_address->CurrentValue = HtmlDecode($this->physical_address->CurrentValue);
        }
        $this->physical_address->EditValue = $this->physical_address->CurrentValue;
        $this->physical_address->PlaceHolder = RemoveHtml($this->physical_address->caption());

        // stockadd_month
        $this->stockadd_month->setupEditAttributes();
        if (!$this->stockadd_month->Raw) {
            $this->stockadd_month->CurrentValue = HtmlDecode($this->stockadd_month->CurrentValue);
        }
        $this->stockadd_month->EditValue = $this->stockadd_month->CurrentValue;
        $this->stockadd_month->PlaceHolder = RemoveHtml($this->stockadd_month->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->batch_number);
                    $doc->exportCaption($this->brand_name);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->qty_left);
                    $doc->exportCaption($this->measuring_unit);
                    $doc->exportCaption($this->buying_price_per_unit);
                    $doc->exportCaption($this->selling_price_per_unit);
                    $doc->exportCaption($this->expiry_date);
                    $doc->exportCaption($this->expiry_status);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
                    $doc->exportCaption($this->supplier_name);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->email_address);
                    $doc->exportCaption($this->physical_address);
                    $doc->exportCaption($this->stockadd_month);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->batch_number);
                    $doc->exportCaption($this->brand_name);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->qty_left);
                    $doc->exportCaption($this->measuring_unit);
                    $doc->exportCaption($this->buying_price_per_unit);
                    $doc->exportCaption($this->selling_price_per_unit);
                    $doc->exportCaption($this->expiry_date);
                    $doc->exportCaption($this->expiry_status);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
                    $doc->exportCaption($this->supplier_name);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->email_address);
                    $doc->exportCaption($this->physical_address);
                    $doc->exportCaption($this->stockadd_month);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->batch_number);
                        $doc->exportField($this->brand_name);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->qty_left);
                        $doc->exportField($this->measuring_unit);
                        $doc->exportField($this->buying_price_per_unit);
                        $doc->exportField($this->selling_price_per_unit);
                        $doc->exportField($this->expiry_date);
                        $doc->exportField($this->expiry_status);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
                        $doc->exportField($this->supplier_name);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->email_address);
                        $doc->exportField($this->physical_address);
                        $doc->exportField($this->stockadd_month);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->batch_number);
                        $doc->exportField($this->brand_name);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->qty_left);
                        $doc->exportField($this->measuring_unit);
                        $doc->exportField($this->buying_price_per_unit);
                        $doc->exportField($this->selling_price_per_unit);
                        $doc->exportField($this->expiry_date);
                        $doc->exportField($this->expiry_status);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
                        $doc->exportField($this->supplier_name);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->email_address);
                        $doc->exportField($this->physical_address);
                        $doc->exportField($this->stockadd_month);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
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

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
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
            $this->expiry_status->CellAttrs["style"] = "background-color: #15b20b; color: white";
            $this->expiry_status->ViewValue = "Active"; 
        } else if ($this->expiry_date->CurrentValue < $current_date) {
            $this->expiry_status->CellAttrs["style"] = "background-color: #e5064b; color: white";
            $this->expiry_status->ViewValue = "Expired"; 
        } 
        $batch_quantity = $this->quantity->ViewValue;
        if ($this->quantity_left->CurrentValue == "") {
            $this->quantity_left->ViewValue = $batch_quantity; 
        }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
