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
 * Table class for item_purchases
 */
class ItemPurchases extends DbTable
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
    public $supplier_id;
    public $category_id;
    public $subcategory_id;
    public $item_title;
    public $quantity;
    public $measuring_unit;
    public $unit_price;
    public $selling_price;
    public $amount_paid;
    public $invoice_attachment;
    public $date_created;
    public $date_updated;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "item_purchases";
        $this->TableName = 'item_purchases';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "item_purchases";
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
        $this->batch_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['batch_number'] = &$this->batch_number;

        // supplier_id
        $this->supplier_id = new DbField(
            $this, // Table
            'x_supplier_id', // Variable name
            'supplier_id', // Name
            '`supplier_id`', // Expression
            '`supplier_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`supplier_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->supplier_id->InputTextType = "text";
        $this->supplier_id->Raw = true;
        $this->supplier_id->Nullable = false; // NOT NULL field
        $this->supplier_id->Required = true; // Required field
        $this->supplier_id->setSelectMultiple(false); // Select one
        $this->supplier_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->supplier_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->supplier_id->Lookup = new Lookup($this->supplier_id, 'suppliers', false, 'id', ["supplier_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "`supplier_name`");
        $this->supplier_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->supplier_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['supplier_id'] = &$this->supplier_id;

        // category_id
        $this->category_id = new DbField(
            $this, // Table
            'x_category_id', // Variable name
            'category_id', // Name
            '`category_id`', // Expression
            '`category_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`category_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->category_id->InputTextType = "text";
        $this->category_id->Raw = true;
        $this->category_id->Nullable = false; // NOT NULL field
        $this->category_id->Required = true; // Required field
        $this->category_id->setSelectMultiple(false); // Select one
        $this->category_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->category_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->category_id->Lookup = new Lookup($this->category_id, 'item_categories', false, 'id', ["category_name","","",""], '', '', [], ["x_subcategory_id"], [], [], [], [], false, '', '', "`category_name`");
        $this->category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->category_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['category_id'] = &$this->category_id;

        // subcategory_id
        $this->subcategory_id = new DbField(
            $this, // Table
            'x_subcategory_id', // Variable name
            'subcategory_id', // Name
            '`subcategory_id`', // Expression
            '`subcategory_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`subcategory_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->subcategory_id->InputTextType = "text";
        $this->subcategory_id->Raw = true;
        $this->subcategory_id->Nullable = false; // NOT NULL field
        $this->subcategory_id->Required = true; // Required field
        $this->subcategory_id->setSelectMultiple(false); // Select one
        $this->subcategory_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->subcategory_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->subcategory_id->Lookup = new Lookup($this->subcategory_id, 'item_subcategories', false, 'id', ["subcategory_name","","",""], '', '', ["x_category_id"], [], ["category_id"], ["x_category_id"], [], [], false, '', '', "`subcategory_name`");
        $this->subcategory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->subcategory_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['subcategory_id'] = &$this->subcategory_id;

        // item_title
        $this->item_title = new DbField(
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
        $this->Fields['item_title'] = &$this->item_title;

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

        // measuring_unit
        $this->measuring_unit = new DbField(
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
            'SELECT' // Edit Tag
        );
        $this->measuring_unit->InputTextType = "text";
        $this->measuring_unit->Nullable = false; // NOT NULL field
        $this->measuring_unit->Required = true; // Required field
        $this->measuring_unit->setSelectMultiple(false); // Select one
        $this->measuring_unit->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->measuring_unit->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->measuring_unit->Lookup = new Lookup($this->measuring_unit, 'item_purchases', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->measuring_unit->OptionCount = 7;
        $this->measuring_unit->SearchOperators = ["=", "<>"];
        $this->Fields['measuring_unit'] = &$this->measuring_unit;

        // unit_price
        $this->unit_price = new DbField(
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
        $this->Fields['unit_price'] = &$this->unit_price;

        // selling_price
        $this->selling_price = new DbField(
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
        $this->Fields['selling_price'] = &$this->selling_price;

        // amount_paid
        $this->amount_paid = new DbField(
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
        $this->Fields['amount_paid'] = &$this->amount_paid;

        // invoice_attachment
        $this->invoice_attachment = new DbField(
            $this, // Table
            'x_invoice_attachment', // Variable name
            'invoice_attachment', // Name
            '`invoice_attachment`', // Expression
            '`invoice_attachment`', // Basic search expression
            205, // Type
            2147483647, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`invoice_attachment`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'FILE' // Edit Tag
        );
        $this->invoice_attachment->InputTextType = "text";
        $this->invoice_attachment->Raw = true;
        $this->invoice_attachment->Nullable = false; // NOT NULL field
        $this->invoice_attachment->Required = true; // Required field
        $this->invoice_attachment->Sortable = false; // Allow sort
        $this->invoice_attachment->UploadAllowedFileExt = "pdf,jpg";
        $this->invoice_attachment->SearchOperators = ["=", "<>"];
        $this->invoice_attachment->CustomMsg = $Language->fieldPhrase($this->TableVar, $this->invoice_attachment->Param, "CustomMsg");
        $this->Fields['invoice_attachment'] = &$this->invoice_attachment;

        // date_created
        $this->date_created = new DbField(
            $this, // Table
            'x_date_created', // Variable name
            'date_created', // Name
            '`date_created`', // Expression
            CastDateFieldForLike("`date_created`", 11, "DB"), // Basic search expression
            135, // Type
            19, // Size
            11, // Date/Time format
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
        $this->date_created->DefaultErrorMessage = str_replace("%s", DateFormat(11), $Language->phrase("IncorrectDate"));
        $this->date_created->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['date_created'] = &$this->date_created;

        // date_updated
        $this->date_updated = new DbField(
            $this, // Table
            'x_date_updated', // Variable name
            'date_updated', // Name
            '`date_updated`', // Expression
            CastDateFieldForLike("`date_updated`", 11, "DB"), // Basic search expression
            135, // Type
            19, // Size
            11, // Date/Time format
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
        $this->date_updated->DefaultErrorMessage = str_replace("%s", DateFormat(11), $Language->phrase("IncorrectDate"));
        $this->date_updated->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['date_updated'] = &$this->date_updated;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "item_purchases";
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
        $this->supplier_id->DbValue = $row['supplier_id'];
        $this->category_id->DbValue = $row['category_id'];
        $this->subcategory_id->DbValue = $row['subcategory_id'];
        $this->item_title->DbValue = $row['item_title'];
        $this->quantity->DbValue = $row['quantity'];
        $this->measuring_unit->DbValue = $row['measuring_unit'];
        $this->unit_price->DbValue = $row['unit_price'];
        $this->selling_price->DbValue = $row['selling_price'];
        $this->amount_paid->DbValue = $row['amount_paid'];
        $this->invoice_attachment->Upload->DbValue = $row['invoice_attachment'];
        $this->date_created->DbValue = $row['date_created'];
        $this->date_updated->DbValue = $row['date_updated'];
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
        return $_SESSION[$name] ?? GetUrl("itempurchaseslist");
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
            "itempurchasesview" => $Language->phrase("View"),
            "itempurchasesedit" => $Language->phrase("Edit"),
            "itempurchasesadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "itempurchaseslist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "ItemPurchasesView",
            Config("API_ADD_ACTION") => "ItemPurchasesAdd",
            Config("API_EDIT_ACTION") => "ItemPurchasesEdit",
            Config("API_DELETE_ACTION") => "ItemPurchasesDelete",
            Config("API_LIST_ACTION") => "ItemPurchasesList",
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
        return "itempurchaseslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("itempurchasesview", $parm);
        } else {
            $url = $this->keyUrl("itempurchasesview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "itempurchasesadd?" . $parm;
        } else {
            $url = "itempurchasesadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("itempurchasesedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("itempurchaseslist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("itempurchasesadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("itempurchaseslist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("itempurchasesdelete", $parm);
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
        $this->supplier_id->setDbValue($row['supplier_id']);
        $this->category_id->setDbValue($row['category_id']);
        $this->subcategory_id->setDbValue($row['subcategory_id']);
        $this->item_title->setDbValue($row['item_title']);
        $this->quantity->setDbValue($row['quantity']);
        $this->measuring_unit->setDbValue($row['measuring_unit']);
        $this->unit_price->setDbValue($row['unit_price']);
        $this->selling_price->setDbValue($row['selling_price']);
        $this->amount_paid->setDbValue($row['amount_paid']);
        $this->invoice_attachment->Upload->DbValue = $row['invoice_attachment'];
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "ItemPurchasesList";
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

        // supplier_id

        // category_id

        // subcategory_id

        // item_title

        // quantity

        // measuring_unit

        // unit_price

        // selling_price

        // amount_paid

        // invoice_attachment

        // date_created

        // date_updated

        // id
        $this->id->ViewValue = $this->id->CurrentValue;

        // batch_number
        $this->batch_number->ViewValue = $this->batch_number->CurrentValue;

        // supplier_id
        $curVal = strval($this->supplier_id->CurrentValue);
        if ($curVal != "") {
            $this->supplier_id->ViewValue = $this->supplier_id->lookupCacheOption($curVal);
            if ($this->supplier_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->supplier_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->supplier_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                $sqlWrk = $this->supplier_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->supplier_id->Lookup->renderViewRow($rswrk[0]);
                    $this->supplier_id->ViewValue = $this->supplier_id->displayValue($arwrk);
                } else {
                    $this->supplier_id->ViewValue = FormatNumber($this->supplier_id->CurrentValue, $this->supplier_id->formatPattern());
                }
            }
        } else {
            $this->supplier_id->ViewValue = null;
        }

        // category_id
        $curVal = strval($this->category_id->CurrentValue);
        if ($curVal != "") {
            $this->category_id->ViewValue = $this->category_id->lookupCacheOption($curVal);
            if ($this->category_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->category_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->category_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                $sqlWrk = $this->category_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->category_id->Lookup->renderViewRow($rswrk[0]);
                    $this->category_id->ViewValue = $this->category_id->displayValue($arwrk);
                } else {
                    $this->category_id->ViewValue = FormatNumber($this->category_id->CurrentValue, $this->category_id->formatPattern());
                }
            }
        } else {
            $this->category_id->ViewValue = null;
        }

        // subcategory_id
        $curVal = strval($this->subcategory_id->CurrentValue);
        if ($curVal != "") {
            $this->subcategory_id->ViewValue = $this->subcategory_id->lookupCacheOption($curVal);
            if ($this->subcategory_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter($this->subcategory_id->Lookup->getTable()->Fields["id"]->searchExpression(), "=", $curVal, $this->subcategory_id->Lookup->getTable()->Fields["id"]->searchDataType(), "");
                $sqlWrk = $this->subcategory_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->subcategory_id->Lookup->renderViewRow($rswrk[0]);
                    $this->subcategory_id->ViewValue = $this->subcategory_id->displayValue($arwrk);
                } else {
                    $this->subcategory_id->ViewValue = FormatNumber($this->subcategory_id->CurrentValue, $this->subcategory_id->formatPattern());
                }
            }
        } else {
            $this->subcategory_id->ViewValue = null;
        }

        // item_title
        $this->item_title->ViewValue = $this->item_title->CurrentValue;

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());

        // measuring_unit
        if (strval($this->measuring_unit->CurrentValue) != "") {
            $this->measuring_unit->ViewValue = $this->measuring_unit->optionCaption($this->measuring_unit->CurrentValue);
        } else {
            $this->measuring_unit->ViewValue = null;
        }

        // unit_price
        $this->unit_price->ViewValue = $this->unit_price->CurrentValue;
        $this->unit_price->ViewValue = FormatNumber($this->unit_price->ViewValue, $this->unit_price->formatPattern());

        // selling_price
        $this->selling_price->ViewValue = $this->selling_price->CurrentValue;
        $this->selling_price->ViewValue = FormatNumber($this->selling_price->ViewValue, $this->selling_price->formatPattern());

        // amount_paid
        $this->amount_paid->ViewValue = $this->amount_paid->CurrentValue;
        $this->amount_paid->ViewValue = FormatNumber($this->amount_paid->ViewValue, $this->amount_paid->formatPattern());

        // invoice_attachment
        if (!EmptyValue($this->invoice_attachment->Upload->DbValue)) {
            $this->invoice_attachment->ViewValue = $this->id->CurrentValue;
            $this->invoice_attachment->IsBlobImage = IsImageFile(ContentExtension($this->invoice_attachment->Upload->DbValue));
        } else {
            $this->invoice_attachment->ViewValue = "";
        }

        // date_created
        $this->date_created->ViewValue = $this->date_created->CurrentValue;
        $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

        // id
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // batch_number
        $this->batch_number->HrefValue = "";
        $this->batch_number->TooltipValue = "";

        // supplier_id
        $this->supplier_id->HrefValue = "";
        $this->supplier_id->TooltipValue = "";

        // category_id
        $this->category_id->HrefValue = "";
        $this->category_id->TooltipValue = "";

        // subcategory_id
        $this->subcategory_id->HrefValue = "";
        $this->subcategory_id->TooltipValue = "";

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

        // invoice_attachment
        if (!empty($this->invoice_attachment->Upload->DbValue)) {
            $this->invoice_attachment->HrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
            $this->invoice_attachment->LinkAttrs["target"] = "";
            if ($this->invoice_attachment->IsBlobImage && empty($this->invoice_attachment->LinkAttrs["target"])) {
                $this->invoice_attachment->LinkAttrs["target"] = "_blank";
            }
            if ($this->isExport()) {
                $this->invoice_attachment->HrefValue = FullUrl($this->invoice_attachment->HrefValue, "href");
            }
        } else {
            $this->invoice_attachment->HrefValue = "";
        }
        $this->invoice_attachment->ExportHrefValue = GetFileUploadUrl($this->invoice_attachment, $this->id->CurrentValue);
        $this->invoice_attachment->TooltipValue = "";

        // date_created
        $this->date_created->HrefValue = "";
        $this->date_created->TooltipValue = "";

        // date_updated
        $this->date_updated->HrefValue = "";
        $this->date_updated->TooltipValue = "";

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

        // supplier_id
        $this->supplier_id->setupEditAttributes();
        $this->supplier_id->PlaceHolder = RemoveHtml($this->supplier_id->caption());

        // category_id
        $this->category_id->setupEditAttributes();
        $this->category_id->PlaceHolder = RemoveHtml($this->category_id->caption());

        // subcategory_id
        $this->subcategory_id->setupEditAttributes();
        $this->subcategory_id->PlaceHolder = RemoveHtml($this->subcategory_id->caption());

        // item_title
        $this->item_title->setupEditAttributes();
        if (!$this->item_title->Raw) {
            $this->item_title->CurrentValue = HtmlDecode($this->item_title->CurrentValue);
        }
        $this->item_title->EditValue = $this->item_title->CurrentValue;
        $this->item_title->PlaceHolder = RemoveHtml($this->item_title->caption());

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // measuring_unit
        $this->measuring_unit->setupEditAttributes();
        $this->measuring_unit->EditValue = $this->measuring_unit->options(true);
        $this->measuring_unit->PlaceHolder = RemoveHtml($this->measuring_unit->caption());

        // unit_price
        $this->unit_price->setupEditAttributes();
        $this->unit_price->EditValue = $this->unit_price->CurrentValue;
        $this->unit_price->PlaceHolder = RemoveHtml($this->unit_price->caption());
        if (strval($this->unit_price->EditValue) != "" && is_numeric($this->unit_price->EditValue)) {
            $this->unit_price->EditValue = FormatNumber($this->unit_price->EditValue, null);
        }

        // selling_price
        $this->selling_price->setupEditAttributes();
        $this->selling_price->EditValue = $this->selling_price->CurrentValue;
        $this->selling_price->PlaceHolder = RemoveHtml($this->selling_price->caption());
        if (strval($this->selling_price->EditValue) != "" && is_numeric($this->selling_price->EditValue)) {
            $this->selling_price->EditValue = FormatNumber($this->selling_price->EditValue, null);
        }

        // amount_paid
        $this->amount_paid->setupEditAttributes();
        $this->amount_paid->EditValue = $this->amount_paid->CurrentValue;
        $this->amount_paid->PlaceHolder = RemoveHtml($this->amount_paid->caption());
        if (strval($this->amount_paid->EditValue) != "" && is_numeric($this->amount_paid->EditValue)) {
            $this->amount_paid->EditValue = FormatNumber($this->amount_paid->EditValue, null);
        }

        // invoice_attachment
        $this->invoice_attachment->setupEditAttributes();
        if (!EmptyValue($this->invoice_attachment->Upload->DbValue)) {
            $this->invoice_attachment->EditValue = $this->id->CurrentValue;
            $this->invoice_attachment->IsBlobImage = IsImageFile(ContentExtension($this->invoice_attachment->Upload->DbValue));
        } else {
            $this->invoice_attachment->EditValue = "";
        }

        // date_created
        $this->date_created->setupEditAttributes();
        $this->date_created->EditValue = FormatDateTime($this->date_created->CurrentValue, $this->date_created->formatPattern());
        $this->date_created->PlaceHolder = RemoveHtml($this->date_created->caption());

        // date_updated
        $this->date_updated->setupEditAttributes();
        $this->date_updated->EditValue = FormatDateTime($this->date_updated->CurrentValue, $this->date_updated->formatPattern());
        $this->date_updated->PlaceHolder = RemoveHtml($this->date_updated->caption());

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
                    $doc->exportCaption($this->supplier_id);
                    $doc->exportCaption($this->category_id);
                    $doc->exportCaption($this->subcategory_id);
                    $doc->exportCaption($this->item_title);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->measuring_unit);
                    $doc->exportCaption($this->unit_price);
                    $doc->exportCaption($this->selling_price);
                    $doc->exportCaption($this->amount_paid);
                    $doc->exportCaption($this->invoice_attachment);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->batch_number);
                    $doc->exportCaption($this->supplier_id);
                    $doc->exportCaption($this->category_id);
                    $doc->exportCaption($this->subcategory_id);
                    $doc->exportCaption($this->item_title);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->measuring_unit);
                    $doc->exportCaption($this->unit_price);
                    $doc->exportCaption($this->selling_price);
                    $doc->exportCaption($this->amount_paid);
                    $doc->exportCaption($this->date_created);
                    $doc->exportCaption($this->date_updated);
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
                        $doc->exportField($this->supplier_id);
                        $doc->exportField($this->category_id);
                        $doc->exportField($this->subcategory_id);
                        $doc->exportField($this->item_title);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->measuring_unit);
                        $doc->exportField($this->unit_price);
                        $doc->exportField($this->selling_price);
                        $doc->exportField($this->amount_paid);
                        $doc->exportField($this->invoice_attachment);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->batch_number);
                        $doc->exportField($this->supplier_id);
                        $doc->exportField($this->category_id);
                        $doc->exportField($this->subcategory_id);
                        $doc->exportField($this->item_title);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->measuring_unit);
                        $doc->exportField($this->unit_price);
                        $doc->exportField($this->selling_price);
                        $doc->exportField($this->amount_paid);
                        $doc->exportField($this->date_created);
                        $doc->exportField($this->date_updated);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'invoice_attachment') {
            $fldName = "invoice_attachment";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DataType::BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower($pathinfo["extension"] ?? "");
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    if ($fld->hasMethod("getUploadPath")) { // Check field level upload path
                        $fld->UploadPath = $fld->getUploadPath();
                    }
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
