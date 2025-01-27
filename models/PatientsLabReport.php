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
 * Table class for patients_lab_report
 */
class PatientsLabReport extends DbTable
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
    public $visit_id;
    public $patient_id;
    public $patient_name;
    public $Group_Concat_service_name;
    public $date_of_birth;
    public $gender;
    public $patient_age;
    public $details;
    public $report_template;
    public $status;
    public $laboratorist;
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
        $this->TableVar = "patients_lab_report";
        $this->TableName = 'patients_lab_report';
        $this->TableType = "VIEW";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "patients_lab_report";
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
        $this->DetailView = true; // Allow detail view
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
            'TEXT' // Edit Tag
        );
        $this->id->InputTextType = "text";
        $this->id->Raw = true;
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->Required = true; // Required field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['id'] = &$this->id;

        // visit_id
        $this->visit_id = new DbField(
            $this, // Table
            'x_visit_id', // Variable name
            'visit_id', // Name
            '`visit_id`', // Expression
            '`visit_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`visit_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->visit_id->InputTextType = "text";
        $this->visit_id->Raw = true;
        $this->visit_id->IsForeignKey = true; // Foreign key field
        $this->visit_id->Nullable = false; // NOT NULL field
        $this->visit_id->Required = true; // Required field
        $this->visit_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->visit_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['visit_id'] = &$this->visit_id;

        // patient_id
        $this->patient_id = new DbField(
            $this, // Table
            'x_patient_id', // Variable name
            'patient_id', // Name
            '`patient_id`', // Expression
            '`patient_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_id->InputTextType = "text";
        $this->patient_id->Raw = true;
        $this->patient_id->IsForeignKey = true; // Foreign key field
        $this->patient_id->Nullable = false; // NOT NULL field
        $this->patient_id->Required = true; // Required field
        $this->patient_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['patient_id'] = &$this->patient_id;

        // patient_name
        $this->patient_name = new DbField(
            $this, // Table
            'x_patient_name', // Variable name
            'patient_name', // Name
            '`patient_name`', // Expression
            '`patient_name`', // Basic search expression
            200, // Type
            101, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_name->InputTextType = "text";
        $this->patient_name->UseFilter = true; // Table header filter
        $this->patient_name->Lookup = new Lookup($this->patient_name, 'patients_lab_report', true, 'patient_name', ["patient_name","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->patient_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_name'] = &$this->patient_name;

        // Group_Concat_service_name
        $this->Group_Concat_service_name = new DbField(
            $this, // Table
            'x_Group_Concat_service_name', // Variable name
            'Group_Concat_service_name', // Name
            '`Group_Concat_service_name`', // Expression
            '`Group_Concat_service_name`', // Basic search expression
            200, // Type
            4096, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Group_Concat_service_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Group_Concat_service_name->InputTextType = "text";
        $this->Group_Concat_service_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['Group_Concat_service_name'] = &$this->Group_Concat_service_name;

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
            'TEXT' // Edit Tag
        );
        $this->gender->InputTextType = "text";
        $this->gender->Nullable = false; // NOT NULL field
        $this->gender->Required = true; // Required field
        $this->gender->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['gender'] = &$this->gender;

        // patient_age
        $this->patient_age = new DbField(
            $this, // Table
            'x_patient_age', // Variable name
            'patient_age', // Name
            '`patient_age`', // Expression
            '`patient_age`', // Basic search expression
            20, // Type
            21, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`patient_age`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->patient_age->InputTextType = "text";
        $this->patient_age->Raw = true;
        $this->patient_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_age->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['patient_age'] = &$this->patient_age;

        // details
        $this->details = new DbField(
            $this, // Table
            'x_details', // Variable name
            'details', // Name
            '`details`', // Expression
            '`details`', // Basic search expression
            200, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`details`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->details->InputTextType = "text";
        $this->details->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['details'] = &$this->details;

        // report_template
        $this->report_template = new DbField(
            $this, // Table
            'x_report_template', // Variable name
            'report_template', // Name
            '`report_template`', // Expression
            '`report_template`', // Basic search expression
            205, // Type
            2147483647, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`report_template`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'IMAGE', // View Tag
            'FILE' // Edit Tag
        );
        $this->report_template->InputTextType = "text";
        $this->report_template->Raw = true;
        $this->report_template->Sortable = false; // Allow sort
        $this->report_template->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['report_template'] = &$this->report_template;

        // status
        $this->status = new DbField(
            $this, // Table
            'x_status', // Variable name
            'status', // Name
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
        $this->status->InputTextType = "text";
        $this->status->IsCustom = true; // Custom field
        $this->status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['status'] = &$this->status;

        // laboratorist
        $this->laboratorist = new DbField(
            $this, // Table
            'x_laboratorist', // Variable name
            'laboratorist', // Name
            '`laboratorist`', // Expression
            '`laboratorist`', // Basic search expression
            200, // Type
            101, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`laboratorist`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->laboratorist->InputTextType = "text";
        $this->laboratorist->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['laboratorist'] = &$this->laboratorist;

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
        $this->date_updated->Sortable = false; // Allow sort
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

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Get master WHERE clause from session values
    public function getMasterFilterFromSession()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "patient_visits") {
            $masterTable = Container("patient_visits");
            if ($this->visit_id->getSessionValue() != "") {
                $masterFilter .= "" . GetKeyFilter($masterTable->id, $this->visit_id->getSessionValue(), $masterTable->id->DataType, $masterTable->Dbid);
            } else {
                return "";
            }
            if ($this->patient_id->getSessionValue() != "") {
                $masterFilter .= " AND " . GetKeyFilter($masterTable->patient_id, $this->patient_id->getSessionValue(), $masterTable->patient_id->DataType, $masterTable->Dbid);
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Get detail WHERE clause from session values
    public function getDetailFilterFromSession()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "patient_visits") {
            $masterTable = Container("patient_visits");
            if ($this->visit_id->getSessionValue() != "") {
                $detailFilter .= "" . GetKeyFilter($this->visit_id, $this->visit_id->getSessionValue(), $masterTable->id->DataType, $this->Dbid);
            } else {
                return "";
            }
            if ($this->patient_id->getSessionValue() != "") {
                $detailFilter .= " AND " . GetKeyFilter($this->patient_id, $this->patient_id->getSessionValue(), $masterTable->patient_id->DataType, $this->Dbid);
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    /**
     * Get master filter
     *
     * @param object $masterTable Master Table
     * @param array $keys Detail Keys
     * @return mixed NULL is returned if all keys are empty, Empty string is returned if some keys are empty and is required
     */
    public function getMasterFilter($masterTable, $keys)
    {
        $validKeys = true;
        switch ($masterTable->TableVar) {
            case "patient_visits":
                $key = $keys["visit_id"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                $key = $keys["patient_id"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->patient_id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return GetKeyFilter($masterTable->id, $keys["visit_id"], $this->visit_id->DataType, $this->Dbid) . " AND " . GetKeyFilter($masterTable->patient_id, $keys["patient_id"], $this->patient_id->DataType, $this->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "patient_visits":
                return GetKeyFilter($this->visit_id, $masterTable->id->DbValue, $masterTable->id->DataType, $masterTable->Dbid) . " AND " . GetKeyFilter($this->patient_id, $masterTable->patient_id->DbValue, $masterTable->patient_id->DataType, $masterTable->Dbid);
        }
        return "";
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "patients_lab_report";
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
        return "*, '' AS `status`";
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
        $this->visit_id->DbValue = $row['visit_id'];
        $this->patient_id->DbValue = $row['patient_id'];
        $this->patient_name->DbValue = $row['patient_name'];
        $this->Group_Concat_service_name->DbValue = $row['Group_Concat_service_name'];
        $this->date_of_birth->DbValue = $row['date_of_birth'];
        $this->gender->DbValue = $row['gender'];
        $this->patient_age->DbValue = $row['patient_age'];
        $this->details->DbValue = $row['details'];
        $this->report_template->Upload->DbValue = $row['report_template'];
        $this->status->DbValue = $row['status'];
        $this->laboratorist->DbValue = $row['laboratorist'];
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
        return $_SESSION[$name] ?? GetUrl("patientslabreportlist");
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
            "patientslabreportview" => $Language->phrase("View"),
            "patientslabreportedit" => $Language->phrase("Edit"),
            "patientslabreportadd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "patientslabreportlist";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "PatientsLabReportView",
            Config("API_ADD_ACTION") => "PatientsLabReportAdd",
            Config("API_EDIT_ACTION") => "PatientsLabReportEdit",
            Config("API_DELETE_ACTION") => "PatientsLabReportDelete",
            Config("API_LIST_ACTION") => "PatientsLabReportList",
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
        return "patientslabreportlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("patientslabreportview", $parm);
        } else {
            $url = $this->keyUrl("patientslabreportview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "patientslabreportadd?" . $parm;
        } else {
            $url = "patientslabreportadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("patientslabreportedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("patientslabreportlist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("patientslabreportadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("patientslabreportlist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("patientslabreportdelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "patient_visits" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id", $this->visit_id->getSessionValue()); // Use Session Value
            $url .= "&" . GetForeignKeyUrl("fk_patient_id", $this->patient_id->getSessionValue()); // Use Session Value
        }
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
        $this->visit_id->setDbValue($row['visit_id']);
        $this->patient_id->setDbValue($row['patient_id']);
        $this->patient_name->setDbValue($row['patient_name']);
        $this->Group_Concat_service_name->setDbValue($row['Group_Concat_service_name']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->gender->setDbValue($row['gender']);
        $this->patient_age->setDbValue($row['patient_age']);
        $this->details->setDbValue($row['details']);
        $this->report_template->Upload->DbValue = $row['report_template'];
        $this->status->setDbValue($row['status']);
        $this->laboratorist->setDbValue($row['laboratorist']);
        $this->date_created->setDbValue($row['date_created']);
        $this->date_updated->setDbValue($row['date_updated']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "PatientsLabReportList";
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

        // visit_id

        // patient_id

        // patient_name

        // Group_Concat_service_name

        // date_of_birth

        // gender

        // patient_age

        // details

        // report_template

        // status

        // laboratorist

        // date_created

        // date_updated
        $this->date_updated->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;

        // visit_id
        $this->visit_id->ViewValue = $this->visit_id->CurrentValue;

        // patient_id
        $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
        $this->patient_id->ViewValue = FormatNumber($this->patient_id->ViewValue, $this->patient_id->formatPattern());

        // patient_name
        $this->patient_name->ViewValue = $this->patient_name->CurrentValue;

        // Group_Concat_service_name
        $this->Group_Concat_service_name->ViewValue = $this->Group_Concat_service_name->CurrentValue;

        // date_of_birth
        $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
        $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, $this->date_of_birth->formatPattern());

        // gender
        $this->gender->ViewValue = $this->gender->CurrentValue;

        // patient_age
        $this->patient_age->ViewValue = $this->patient_age->CurrentValue;
        $this->patient_age->ViewValue = FormatNumber($this->patient_age->ViewValue, $this->patient_age->formatPattern());

        // details
        $this->details->ViewValue = $this->details->CurrentValue;

        // report_template
        if (!EmptyValue($this->report_template->Upload->DbValue)) {
            $this->report_template->ImageWidth = 800;
            $this->report_template->ImageHeight = 800;
            $this->report_template->ImageAlt = $this->report_template->alt();
            $this->report_template->ImageCssClass = "ew-image";
            $this->report_template->ViewValue = $this->id->CurrentValue;
            $this->report_template->IsBlobImage = IsImageFile(ContentExtension($this->report_template->Upload->DbValue));
        } else {
            $this->report_template->ViewValue = "";
        }

        // status
        $this->status->ViewValue = $this->status->CurrentValue;

        // laboratorist
        $this->laboratorist->ViewValue = $this->laboratorist->CurrentValue;

        // date_created
        $this->date_created->ViewValue = $this->date_created->CurrentValue;
        $this->date_created->ViewValue = FormatDateTime($this->date_created->ViewValue, $this->date_created->formatPattern());

        // date_updated
        $this->date_updated->ViewValue = $this->date_updated->CurrentValue;
        $this->date_updated->ViewValue = FormatDateTime($this->date_updated->ViewValue, $this->date_updated->formatPattern());

        // id
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // visit_id
        $this->visit_id->HrefValue = "";
        $this->visit_id->TooltipValue = "";

        // patient_id
        $this->patient_id->HrefValue = "";
        $this->patient_id->TooltipValue = "";

        // patient_name
        $this->patient_name->HrefValue = "";
        $this->patient_name->TooltipValue = "";

        // Group_Concat_service_name
        $this->Group_Concat_service_name->HrefValue = "";
        $this->Group_Concat_service_name->TooltipValue = "";

        // date_of_birth
        $this->date_of_birth->HrefValue = "";
        $this->date_of_birth->TooltipValue = "";

        // gender
        $this->gender->HrefValue = "";
        $this->gender->TooltipValue = "";

        // patient_age
        $this->patient_age->HrefValue = "";
        $this->patient_age->TooltipValue = "";

        // details
        $this->details->HrefValue = "";
        $this->details->TooltipValue = "";

        // report_template
        if (!empty($this->report_template->Upload->DbValue)) {
            $this->report_template->HrefValue = GetFileUploadUrl($this->report_template, $this->id->CurrentValue);
            $this->report_template->LinkAttrs["target"] = "";
            if ($this->report_template->IsBlobImage && empty($this->report_template->LinkAttrs["target"])) {
                $this->report_template->LinkAttrs["target"] = "_blank";
            }
            if ($this->isExport()) {
                $this->report_template->HrefValue = FullUrl($this->report_template->HrefValue, "href");
            }
        } else {
            $this->report_template->HrefValue = "";
        }
        $this->report_template->ExportHrefValue = GetFileUploadUrl($this->report_template, $this->id->CurrentValue);
        $this->report_template->TooltipValue = "";
        if ($this->report_template->UseColorbox) {
            if (EmptyValue($this->report_template->TooltipValue)) {
                $this->report_template->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->report_template->LinkAttrs["data-rel"] = "patients_lab_report_x_report_template";
            $this->report_template->LinkAttrs->appendClass("ew-lightbox");
        }

        // status
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // laboratorist
        $this->laboratorist->HrefValue = "";
        $this->laboratorist->TooltipValue = "";

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
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());

        // visit_id
        $this->visit_id->setupEditAttributes();
        if ($this->visit_id->getSessionValue() != "") {
            $this->visit_id->CurrentValue = GetForeignKeyValue($this->visit_id->getSessionValue());
            $this->visit_id->ViewValue = $this->visit_id->CurrentValue;
        } else {
            $this->visit_id->EditValue = $this->visit_id->CurrentValue;
            $this->visit_id->PlaceHolder = RemoveHtml($this->visit_id->caption());
            if (strval($this->visit_id->EditValue) != "" && is_numeric($this->visit_id->EditValue)) {
                $this->visit_id->EditValue = $this->visit_id->EditValue;
            }
        }

        // patient_id
        $this->patient_id->setupEditAttributes();
        if ($this->patient_id->getSessionValue() != "") {
            $this->patient_id->CurrentValue = GetForeignKeyValue($this->patient_id->getSessionValue());
            $this->patient_id->ViewValue = $this->patient_id->CurrentValue;
            $this->patient_id->ViewValue = FormatNumber($this->patient_id->ViewValue, $this->patient_id->formatPattern());
        } else {
            $this->patient_id->EditValue = $this->patient_id->CurrentValue;
            $this->patient_id->PlaceHolder = RemoveHtml($this->patient_id->caption());
            if (strval($this->patient_id->EditValue) != "" && is_numeric($this->patient_id->EditValue)) {
                $this->patient_id->EditValue = FormatNumber($this->patient_id->EditValue, null);
            }
        }

        // patient_name
        $this->patient_name->setupEditAttributes();
        if (!$this->patient_name->Raw) {
            $this->patient_name->CurrentValue = HtmlDecode($this->patient_name->CurrentValue);
        }
        $this->patient_name->EditValue = $this->patient_name->CurrentValue;
        $this->patient_name->PlaceHolder = RemoveHtml($this->patient_name->caption());

        // Group_Concat_service_name
        $this->Group_Concat_service_name->setupEditAttributes();
        if (!$this->Group_Concat_service_name->Raw) {
            $this->Group_Concat_service_name->CurrentValue = HtmlDecode($this->Group_Concat_service_name->CurrentValue);
        }
        $this->Group_Concat_service_name->EditValue = $this->Group_Concat_service_name->CurrentValue;
        $this->Group_Concat_service_name->PlaceHolder = RemoveHtml($this->Group_Concat_service_name->caption());

        // date_of_birth
        $this->date_of_birth->setupEditAttributes();
        $this->date_of_birth->EditValue = FormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

        // gender
        $this->gender->setupEditAttributes();
        if (!$this->gender->Raw) {
            $this->gender->CurrentValue = HtmlDecode($this->gender->CurrentValue);
        }
        $this->gender->EditValue = $this->gender->CurrentValue;
        $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

        // patient_age
        $this->patient_age->setupEditAttributes();
        $this->patient_age->EditValue = $this->patient_age->CurrentValue;
        $this->patient_age->PlaceHolder = RemoveHtml($this->patient_age->caption());
        if (strval($this->patient_age->EditValue) != "" && is_numeric($this->patient_age->EditValue)) {
            $this->patient_age->EditValue = FormatNumber($this->patient_age->EditValue, null);
        }

        // details
        $this->details->setupEditAttributes();
        if (!$this->details->Raw) {
            $this->details->CurrentValue = HtmlDecode($this->details->CurrentValue);
        }
        $this->details->EditValue = $this->details->CurrentValue;
        $this->details->PlaceHolder = RemoveHtml($this->details->caption());

        // report_template
        $this->report_template->setupEditAttributes();
        if (!EmptyValue($this->report_template->Upload->DbValue)) {
            $this->report_template->ImageWidth = 800;
            $this->report_template->ImageHeight = 800;
            $this->report_template->ImageAlt = $this->report_template->alt();
            $this->report_template->ImageCssClass = "ew-image";
            $this->report_template->EditValue = $this->id->CurrentValue;
            $this->report_template->IsBlobImage = IsImageFile(ContentExtension($this->report_template->Upload->DbValue));
        } else {
            $this->report_template->EditValue = "";
        }

        // status
        $this->status->setupEditAttributes();
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // laboratorist
        $this->laboratorist->setupEditAttributes();
        if (!$this->laboratorist->Raw) {
            $this->laboratorist->CurrentValue = HtmlDecode($this->laboratorist->CurrentValue);
        }
        $this->laboratorist->EditValue = $this->laboratorist->CurrentValue;
        $this->laboratorist->PlaceHolder = RemoveHtml($this->laboratorist->caption());

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
                    $doc->exportCaption($this->Group_Concat_service_name);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->patient_age);
                    $doc->exportCaption($this->details);
                    $doc->exportCaption($this->report_template);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->laboratorist);
                    $doc->exportCaption($this->date_created);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->visit_id);
                    $doc->exportCaption($this->patient_id);
                    $doc->exportCaption($this->patient_name);
                    $doc->exportCaption($this->Group_Concat_service_name);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->patient_age);
                    $doc->exportCaption($this->details);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->laboratorist);
                    $doc->exportCaption($this->date_created);
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
                        $doc->exportField($this->Group_Concat_service_name);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->patient_age);
                        $doc->exportField($this->details);
                        $doc->exportField($this->report_template);
                        $doc->exportField($this->status);
                        $doc->exportField($this->laboratorist);
                        $doc->exportField($this->date_created);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->visit_id);
                        $doc->exportField($this->patient_id);
                        $doc->exportField($this->patient_name);
                        $doc->exportField($this->Group_Concat_service_name);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->patient_age);
                        $doc->exportField($this->details);
                        $doc->exportField($this->status);
                        $doc->exportField($this->laboratorist);
                        $doc->exportField($this->date_created);
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
        if ($fldparm == 'report_template') {
            $fldName = "report_template";
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
        $current_date = CurrentDate();
        if ($this->date_created->CurrentValue > $current_date) {
            $this->status->CellAttrs["style"] = "background-color: #15b20b; color: white";
            $this->status->ViewValue = "New Report"; 
        } else if ($this->date_created->CurrentValue < $current_date) {
            $this->status->CellAttrs["style"] = "background-color: #ee881e; color: white";
            $this->status->ViewValue = "Past Report"; 
        } 
        $this->patient_name->ViewValue = '<a href="patientslabreportview/' . $this->id->ViewValue . '?showdetail=urinalysis_results,full_haemo_results" target="_blank"> ' . $this->patient_name->ViewValue . ' </a>';
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
