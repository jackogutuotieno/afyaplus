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
 * Table class for patients
 */
class Patients extends DbTable
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
    public $photo;
    public $patient_name;
    public $first_name;
    public $last_name;
    public $national_id;
    public $date_of_birth;
    public $age;
    public $gender;
    public $phone;
    public $email_address;
    public $physical_address;
    public $employment_status;
    public $religion;
    public $next_of_kin;
    public $next_of_kin_phone;
    public $marital_status;
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
        $this->TableVar = "patients";
        $this->TableName = 'patients';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "patients";
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
        $this->id->IsForeignKey = true; // Foreign key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['id'] = &$this->id;

        // photo
        $this->photo = new DbField(
            $this, // Table
            'x_photo', // Variable name
            'photo', // Name
            '`photo`', // Expression
            '`photo`', // Basic search expression
            204, // Type
            65535, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`photo`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'FILE' // Edit Tag
        );
        $this->photo->InputTextType = "text";
        $this->photo->Raw = true;
        $this->photo->Sortable = false; // Allow sort
        $this->photo->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['photo'] = &$this->photo;

        // patient_name
        $this->patient_name = new DbField(
            $this, // Table
            'x_patient_name', // Variable name
            'patient_name', // Name
            'CONCAT(first_name,\' \',last_name)', // Expression
            'CONCAT(first_name,\' \',last_name)', // Basic search expression
            200, // Type
            101, // Size
            -1, // Date/Time format
            false, // Is upload field
            'CONCAT(first_name,\' \',last_name)', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_name->InputTextType = "text";
        $this->patient_name->IsCustom = true; // Custom field
        $this->patient_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_name'] = &$this->patient_name;

        // first_name
        $this->first_name = new DbField(
            $this, // Table
            'x_first_name', // Variable name
            'first_name', // Name
            '`first_name`', // Expression
            '`first_name`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`first_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->first_name->InputTextType = "text";
        $this->first_name->Nullable = false; // NOT NULL field
        $this->first_name->Required = true; // Required field
        $this->first_name->Sortable = false; // Allow sort
        $this->first_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['first_name'] = &$this->first_name;

        // last_name
        $this->last_name = new DbField(
            $this, // Table
            'x_last_name', // Variable name
            'last_name', // Name
            '`last_name`', // Expression
            '`last_name`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`last_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->last_name->InputTextType = "text";
        $this->last_name->Nullable = false; // NOT NULL field
        $this->last_name->Required = true; // Required field
        $this->last_name->Sortable = false; // Allow sort
        $this->last_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['last_name'] = &$this->last_name;

        // national_id
        $this->national_id = new DbField(
            $this, // Table
            'x_national_id', // Variable name
            'national_id', // Name
            '`national_id`', // Expression
            '`national_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`national_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->national_id->InputTextType = "text";
        $this->national_id->Raw = true;
        $this->national_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->national_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->national_id->CustomMsg = $Language->fieldPhrase($this->TableVar, $this->national_id->Param, "CustomMsg");
        $this->Fields['national_id'] = &$this->national_id;

        // date_of_birth
        $this->date_of_birth = new DbField(
            $this, // Table
            'x_date_of_birth', // Variable name
            'date_of_birth', // Name
            '`date_of_birth`', // Expression
            CastDateFieldForLike("`date_of_birth`", 0, "DB"), // Basic search expression
            133, // Type
            10, // Size
            0, // Date/Time format
            false, // Is upload field
            '`date_of_birth`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->date_of_birth->InputTextType = "text";
        $this->date_of_birth->Raw = true;
        $this->date_of_birth->Nullable = false; // NOT NULL field
        $this->date_of_birth->Required = true; // Required field
        $this->date_of_birth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_of_birth->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['date_of_birth'] = &$this->date_of_birth;

        // age
        $this->age = new DbField(
            $this, // Table
            'x_age', // Variable name
            'age', // Name
            '(SELECT TIMESTAMPDIFF(YEAR,date_of_birth, CURDATE()))', // Expression
            '(SELECT TIMESTAMPDIFF(YEAR,date_of_birth, CURDATE()))', // Basic search expression
            20, // Type
            21, // Size
            -1, // Date/Time format
            false, // Is upload field
            '(SELECT TIMESTAMPDIFF(YEAR,date_of_birth, CURDATE()))', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->age->InputTextType = "text";
        $this->age->Raw = true;
        $this->age->IsCustom = true; // Custom field
        $this->age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->age->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['age'] = &$this->age;

        // gender
        $this->gender = new DbField(
            $this, // Table
            'x_gender', // Variable name
            'gender', // Name
            '`gender`', // Expression
            '`gender`', // Basic search expression
            200, // Type
            15, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`gender`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'RADIO' // Edit Tag
        );
        $this->gender->InputTextType = "text";
        $this->gender->Nullable = false; // NOT NULL field
        $this->gender->Required = true; // Required field
        $this->gender->Lookup = new Lookup($this->gender, 'patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->gender->OptionCount = 2;
        $this->gender->SearchOperators = ["=", "<>"];
        $this->Fields['gender'] = &$this->gender;

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
        $this->phone->addMethod("getLinkPrefix", fn() => "tel:");
        $this->phone->InputTextType = "text";
        $this->phone->Nullable = false; // NOT NULL field
        $this->phone->Required = true; // Required field
        $this->phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->phone->CustomMsg = $Language->fieldPhrase($this->TableVar, $this->phone->Param, "CustomMsg");
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
        $this->email_address->addMethod("getLinkPrefix", fn() => "mailto:");
        $this->email_address->InputTextType = "text";
        $this->email_address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->email_address->CustomMsg = $Language->fieldPhrase($this->TableVar, $this->email_address->Param, "CustomMsg");
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
            'TEXTAREA' // Edit Tag
        );
        $this->physical_address->InputTextType = "text";
        $this->physical_address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['physical_address'] = &$this->physical_address;

        // employment_status
        $this->employment_status = new DbField(
            $this, // Table
            'x_employment_status', // Variable name
            'employment_status', // Name
            '`employment_status`', // Expression
            '`employment_status`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`employment_status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->employment_status->InputTextType = "text";
        $this->employment_status->setSelectMultiple(false); // Select one
        $this->employment_status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->employment_status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->employment_status->Lookup = new Lookup($this->employment_status, 'patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->employment_status->OptionCount = 2;
        $this->employment_status->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['employment_status'] = &$this->employment_status;

        // religion
        $this->religion = new DbField(
            $this, // Table
            'x_religion', // Variable name
            'religion', // Name
            '`religion`', // Expression
            '`religion`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`religion`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->religion->InputTextType = "text";
        $this->religion->setSelectMultiple(false); // Select one
        $this->religion->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->religion->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->religion->Lookup = new Lookup($this->religion, 'patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->religion->OptionCount = 5;
        $this->religion->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['religion'] = &$this->religion;

        // next_of_kin
        $this->next_of_kin = new DbField(
            $this, // Table
            'x_next_of_kin', // Variable name
            'next_of_kin', // Name
            '`next_of_kin`', // Expression
            '`next_of_kin`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`next_of_kin`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->next_of_kin->InputTextType = "text";
        $this->next_of_kin->Nullable = false; // NOT NULL field
        $this->next_of_kin->Required = true; // Required field
        $this->next_of_kin->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['next_of_kin'] = &$this->next_of_kin;

        // next_of_kin_phone
        $this->next_of_kin_phone = new DbField(
            $this, // Table
            'x_next_of_kin_phone', // Variable name
            'next_of_kin_phone', // Name
            '`next_of_kin_phone`', // Expression
            '`next_of_kin_phone`', // Basic search expression
            129, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`next_of_kin_phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->next_of_kin_phone->InputTextType = "text";
        $this->next_of_kin_phone->Nullable = false; // NOT NULL field
        $this->next_of_kin_phone->Required = true; // Required field
        $this->next_of_kin_phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['next_of_kin_phone'] = &$this->next_of_kin_phone;

        // marital_status
        $this->marital_status = new DbField(
            $this, // Table
            'x_marital_status', // Variable name
            'marital_status', // Name
            '`marital_status`', // Expression
            '`marital_status`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`marital_status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->marital_status->InputTextType = "text";
        $this->marital_status->Nullable = false; // NOT NULL field
        $this->marital_status->Required = true; // Required field
        $this->marital_status->setSelectMultiple(false); // Select one
        $this->marital_status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->marital_status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->marital_status->Lookup = new Lookup($this->marital_status, 'patients', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->marital_status->OptionCount = 4;
        $this->marital_status->SearchOperators = ["=", "<>"];
        $this->Fields['marital_status'] = &$this->marital_status;

        // date_created
        $this->date_created = new DbField(
            $this, // Table
            'x_date_created', // Variable name
            'date_created', // Name
            '`date_created`', // Expression
            CastDateFieldForLike("`date_created`", 7, "DB"), // Basic search expression
            135, // Type
            19, // Size
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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")) ?? "";
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "patient_appointments") {
            $detailUrl = Container("patient_appointments")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "patient_visits") {
            $detailUrl = Container("patient_visits")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "patientslist";
        }
        return $detailUrl;
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "patients";
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
        return "*, CONCAT(first_name,' ',last_name) AS `patient_name`, (SELECT TIMESTAMPDIFF(YEAR,date_of_birth, CURDATE())) AS `age`";
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
        $this->photo->Upload->DbValue = $row['photo'];
        $this->patient_name->DbValue = $row['patient_name'];
        $this->first_name->DbValue = $row['first_name'];
        $this->last_name->DbValue = $row['last_name'];
        $this->national_id->DbValue = $row['national_id'];
        $this->date_of_birth->DbValue = $row['date_of_birth'];
        $this->age->DbValue = $row['age'];
        $this->gender->DbValue = $row['gender'];
        $this->phone->DbValue = $row['phone'];
        $this->email_address->DbValue = $row['email_address'];
        $this->physical_address->DbValue = $row['physical_address'];
        $this->employment_status->DbValue = $row['employment_status'];
        $this->religion->DbValue = $row['religion'];
        $this->next_of_kin->DbValue = $row['next_of_kin'];
        $this->next_of_kin_phone->DbValue = $row['next_of_kin_phone'];
        $this->marital_status->DbValue = $row['marital_status'];
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
        return $_SESSION[$name] ?? GetUrl("patientslist");
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
            "patientsview" => $Language->phrase("View"),
            "patientsedit" => $Language->phrase("Edit"),
            "patientsadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "patientslist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "PatientsView",
            Config("API_ADD_ACTION") => "PatientsAdd",
            Config("API_EDIT_ACTION") => "PatientsEdit",
            Config("API_DELETE_ACTION") => "PatientsDelete",
            Config("API_LIST_ACTION") => "PatientsList",
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
        return "patientslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("patientsview", $parm);
        } else {
            $url = $this->keyUrl("patientsview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "patientsadd?" . $parm;
        } else {
            $url = "patientsadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("patientsedit", $parm);
        } else {
            $url = $this->keyUrl("patientsedit", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("patientslist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("patientsadd", $parm);
        } else {
            $url = $this->keyUrl("patientsadd", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("patientslist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("patientsdelete", $parm);
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
        $this->photo->Upload->DbValue = $row['photo'];
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

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "PatientsList";
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

        // photo

        // patient_name

        // first_name

        // last_name

        // national_id

        // date_of_birth

        // age

        // gender

        // phone

        // email_address

        // physical_address

        // employment_status

        // religion

        // next_of_kin

        // next_of_kin_phone

        // marital_status

        // date_created

        // date_updated

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

        // id
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

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
        $this->photo->TooltipValue = "";

        // patient_name
        $this->patient_name->HrefValue = "";
        $this->patient_name->TooltipValue = "";

        // first_name
        $this->first_name->HrefValue = "";
        $this->first_name->TooltipValue = "";

        // last_name
        $this->last_name->HrefValue = "";
        $this->last_name->TooltipValue = "";

        // national_id
        $this->national_id->HrefValue = "";
        $this->national_id->TooltipValue = "";

        // date_of_birth
        $this->date_of_birth->HrefValue = "";
        $this->date_of_birth->TooltipValue = "";

        // age
        $this->age->HrefValue = "";
        $this->age->TooltipValue = "";

        // gender
        $this->gender->HrefValue = "";
        $this->gender->TooltipValue = "";

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
        $this->phone->TooltipValue = "";

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
        $this->email_address->TooltipValue = "";

        // physical_address
        $this->physical_address->HrefValue = "";
        $this->physical_address->TooltipValue = "";

        // employment_status
        $this->employment_status->HrefValue = "";
        $this->employment_status->TooltipValue = "";

        // religion
        $this->religion->HrefValue = "";
        $this->religion->TooltipValue = "";

        // next_of_kin
        $this->next_of_kin->HrefValue = "";
        $this->next_of_kin->TooltipValue = "";

        // next_of_kin_phone
        $this->next_of_kin_phone->HrefValue = "";
        $this->next_of_kin_phone->TooltipValue = "";

        // marital_status
        $this->marital_status->HrefValue = "";
        $this->marital_status->TooltipValue = "";

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

        // photo
        $this->photo->setupEditAttributes();
        if (!EmptyValue($this->photo->Upload->DbValue)) {
            $this->photo->EditValue = $this->id->CurrentValue;
            $this->photo->IsBlobImage = IsImageFile(ContentExtension($this->photo->Upload->DbValue));
        } else {
            $this->photo->EditValue = "";
        }

        // patient_name
        $this->patient_name->setupEditAttributes();
        if (!$this->patient_name->Raw) {
            $this->patient_name->CurrentValue = HtmlDecode($this->patient_name->CurrentValue);
        }
        $this->patient_name->EditValue = $this->patient_name->CurrentValue;
        $this->patient_name->PlaceHolder = RemoveHtml($this->patient_name->caption());

        // first_name
        $this->first_name->setupEditAttributes();
        if (!$this->first_name->Raw) {
            $this->first_name->CurrentValue = HtmlDecode($this->first_name->CurrentValue);
        }
        $this->first_name->EditValue = $this->first_name->CurrentValue;
        $this->first_name->PlaceHolder = RemoveHtml($this->first_name->caption());

        // last_name
        $this->last_name->setupEditAttributes();
        if (!$this->last_name->Raw) {
            $this->last_name->CurrentValue = HtmlDecode($this->last_name->CurrentValue);
        }
        $this->last_name->EditValue = $this->last_name->CurrentValue;
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
        $this->date_of_birth->EditValue = FormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

        // age
        $this->age->setupEditAttributes();
        $this->age->EditValue = $this->age->CurrentValue;
        $this->age->PlaceHolder = RemoveHtml($this->age->caption());
        if (strval($this->age->EditValue) != "" && is_numeric($this->age->EditValue)) {
            $this->age->EditValue = FormatNumber($this->age->EditValue, null);
        }

        // gender
        $this->gender->EditValue = $this->gender->options(false);
        $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

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
        $this->physical_address->EditValue = $this->physical_address->CurrentValue;
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
        $this->next_of_kin->EditValue = $this->next_of_kin->CurrentValue;
        $this->next_of_kin->PlaceHolder = RemoveHtml($this->next_of_kin->caption());

        // next_of_kin_phone
        $this->next_of_kin_phone->setupEditAttributes();
        if (!$this->next_of_kin_phone->Raw) {
            $this->next_of_kin_phone->CurrentValue = HtmlDecode($this->next_of_kin_phone->CurrentValue);
        }
        $this->next_of_kin_phone->EditValue = $this->next_of_kin_phone->CurrentValue;
        $this->next_of_kin_phone->PlaceHolder = RemoveHtml($this->next_of_kin_phone->caption());

        // marital_status
        $this->marital_status->setupEditAttributes();
        $this->marital_status->EditValue = $this->marital_status->options(true);
        $this->marital_status->PlaceHolder = RemoveHtml($this->marital_status->caption());

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
                    $doc->exportCaption($this->patient_name);
                    $doc->exportCaption($this->age);
                    $doc->exportCaption($this->gender);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->photo);
                    $doc->exportCaption($this->patient_name);
                    $doc->exportCaption($this->national_id);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->age);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->email_address);
                    $doc->exportCaption($this->physical_address);
                    $doc->exportCaption($this->employment_status);
                    $doc->exportCaption($this->religion);
                    $doc->exportCaption($this->next_of_kin);
                    $doc->exportCaption($this->next_of_kin_phone);
                    $doc->exportCaption($this->marital_status);
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
                        $doc->exportField($this->patient_name);
                        $doc->exportField($this->age);
                        $doc->exportField($this->gender);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->photo);
                        $doc->exportField($this->patient_name);
                        $doc->exportField($this->national_id);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->age);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->email_address);
                        $doc->exportField($this->physical_address);
                        $doc->exportField($this->employment_status);
                        $doc->exportField($this->religion);
                        $doc->exportField($this->next_of_kin);
                        $doc->exportField($this->next_of_kin_phone);
                        $doc->exportField($this->marital_status);
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
        if ($fldparm == 'photo') {
            $fldName = "photo";
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
