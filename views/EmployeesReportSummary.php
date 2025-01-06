<?php

namespace PHPMaker2024\afyaplus;

// Page object
$EmployeesReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Employees_Report: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<form name="fEmployees_Reportsrch" id="fEmployees_Reportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fEmployees_Reportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Employees_Report: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fEmployees_Reportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fEmployees_Reportsrch")
        .setPageId("summary")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code in JAVASCRIPT here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "employee_name": <?= $Page->employee_name->toClientList($Page) ?>,
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "department_name": <?= $Page->department_name->toClientList($Page) ?>,
            "designation": <?= $Page->designation->toClientList($Page) ?>,
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = RowType::SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->employee_name->Visible) { // employee_name ?>
<?php
if (!$Page->employee_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_employee_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->employee_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_employee_name"
            name="x_employee_name[]"
            class="form-control ew-select<?= $Page->employee_name->isInvalidClass() ?>"
            data-select2-id="fEmployees_Reportsrch_x_employee_name"
            data-table="Employees_Report"
            data-field="x_employee_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->employee_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->employee_name->editAttributes() ?>>
            <?= $Page->employee_name->selectOptionListHtml("x_employee_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fEmployees_Reportsrch", function() {
            var options = {
                name: "x_employee_name",
                selectId: "fEmployees_Reportsrch_x_employee_name",
                ajax: { id: "x_employee_name", form: "fEmployees_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Employees_Report.fields.employee_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
<?php
if (!$Page->gender->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_gender" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->gender->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_gender"
            name="x_gender[]"
            class="form-control ew-select<?= $Page->gender->isInvalidClass() ?>"
            data-select2-id="fEmployees_Reportsrch_x_gender"
            data-table="Employees_Report"
            data-field="x_gender"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->gender->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->gender->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->gender->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->gender->editAttributes() ?>>
            <?= $Page->gender->selectOptionListHtml("x_gender", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->gender->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fEmployees_Reportsrch", function() {
            var options = {
                name: "x_gender",
                selectId: "fEmployees_Reportsrch_x_gender",
                ajax: { id: "x_gender", form: "fEmployees_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Employees_Report.fields.gender.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->department_name->Visible) { // department_name ?>
<?php
if (!$Page->department_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_department_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->department_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_department_name"
            name="x_department_name[]"
            class="form-control ew-select<?= $Page->department_name->isInvalidClass() ?>"
            data-select2-id="fEmployees_Reportsrch_x_department_name"
            data-table="Employees_Report"
            data-field="x_department_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->department_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->department_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->department_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->department_name->editAttributes() ?>>
            <?= $Page->department_name->selectOptionListHtml("x_department_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->department_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fEmployees_Reportsrch", function() {
            var options = {
                name: "x_department_name",
                selectId: "fEmployees_Reportsrch_x_department_name",
                ajax: { id: "x_department_name", form: "fEmployees_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Employees_Report.fields.department_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->designation->Visible) { // designation ?>
<?php
if (!$Page->designation->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_designation" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->designation->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_designation"
            name="x_designation[]"
            class="form-control ew-select<?= $Page->designation->isInvalidClass() ?>"
            data-select2-id="fEmployees_Reportsrch_x_designation"
            data-table="Employees_Report"
            data-field="x_designation"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->designation->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->designation->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->designation->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->designation->editAttributes() ?>>
            <?= $Page->designation->selectOptionListHtml("x_designation", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->designation->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fEmployees_Reportsrch", function() {
            var options = {
                name: "x_designation",
                selectId: "fEmployees_Reportsrch_x_designation",
                ajax: { id: "x_designation", form: "fEmployees_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Employees_Report.fields.designation.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Middle Container -->
<div id="ew-middle" class="<?= $Page->MiddleContentClass ?>">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-content" class="<?= $Page->ContainerClass ?>">
<?php } ?>
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?= $Page->ReportContainerClass ?>">
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Employees_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Employees_Report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->employee_name->Visible) { ?>
    <th data-name="employee_name" class="<?= $Page->employee_name->headerCellClass() ?>"><div class="Employees_Report_employee_name"><?= $Page->renderFieldHeader($Page->employee_name) ?></div></th>
<?php } ?>
<?php if ($Page->national_id->Visible) { ?>
    <th data-name="national_id" class="<?= $Page->national_id->headerCellClass() ?>"><div class="Employees_Report_national_id"><?= $Page->renderFieldHeader($Page->national_id) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
    <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div class="Employees_Report_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { ?>
    <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div class="Employees_Report_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
    <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div class="Employees_Report__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->department_name->Visible) { ?>
    <th data-name="department_name" class="<?= $Page->department_name->headerCellClass() ?>"><div class="Employees_Report_department_name"><?= $Page->renderFieldHeader($Page->department_name) ?></div></th>
<?php } ?>
<?php if ($Page->designation->Visible) { ?>
    <th data-name="designation" class="<?= $Page->designation->headerCellClass() ?>"><div class="Employees_Report_designation"><?= $Page->renderFieldHeader($Page->designation) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Employees_Report_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = RowType::DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id->Visible) { ?>
        <td data-field="id"<?= $Page->id->cellAttributes() ?>>
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->employee_name->Visible) { ?>
        <td data-field="employee_name"<?= $Page->employee_name->cellAttributes() ?>>
<span<?= $Page->employee_name->viewAttributes() ?>>
<?= $Page->employee_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->national_id->Visible) { ?>
        <td data-field="national_id"<?= $Page->national_id->cellAttributes() ?>>
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
        <td data-field="gender"<?= $Page->gender->cellAttributes() ?>>
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { ?>
        <td data-field="phone"<?= $Page->phone->cellAttributes() ?>>
<span<?= $Page->phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->phone->getViewValue()) && $Page->phone->linkAttributes() != "") { ?>
<a<?= $Page->phone->linkAttributes() ?>><?= $Page->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->phone->getViewValue() ?>
<?php } ?>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
        <td data-field="_email"<?= $Page->_email->cellAttributes() ?>>
<span<?= $Page->_email->viewAttributes() ?>>
<?php if (!EmptyString($Page->_email->getViewValue()) && $Page->_email->linkAttributes() != "") { ?>
<a<?= $Page->_email->linkAttributes() ?>><?= $Page->_email->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->_email->getViewValue() ?>
<?php } ?>
</span>
</td>
<?php } ?>
<?php if ($Page->department_name->Visible) { ?>
        <td data-field="department_name"<?= $Page->department_name->cellAttributes() ?>>
<span<?= $Page->department_name->viewAttributes() ?>>
<?= $Page->department_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->designation->Visible) { ?>
        <td data-field="designation"<?= $Page->designation->cellAttributes() ?>>
<span<?= $Page->designation->viewAttributes() ?>>
<?= $Page->designation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
        <td data-field="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = RowType::TOTAL;
    $Page->RowTotalType = RowSummary::GRAND;
    $Page->RowTotalSubType = RowTotal::FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Page->TotalGroups > 0) { ?>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</main>
<!-- /.report-summary -->
<!-- Summary report (end) -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-content -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-middle -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->EmployeesByGender->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->EmployeesByGender->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->EmployeesbyDepartment->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->EmployeesbyDepartment->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->EmployeesbyDesignation->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->EmployeesbyDesignation->render("ew-chart-bottom");
}
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if (!$DashboardReport && !$Page->isExport() && !$Page->DrillDown) { ?>
<div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
