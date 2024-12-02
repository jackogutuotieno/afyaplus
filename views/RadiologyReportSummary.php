<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Radiology_Report: currentTable } });
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
<form name="fRadiology_Reportsrch" id="fRadiology_Reportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fRadiology_Reportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Radiology_Report: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fRadiology_Reportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fRadiology_Reportsrch")
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
            "gender": <?= $Page->gender->toClientList($Page) ?>,
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
            data-select2-id="fRadiology_Reportsrch_x_gender"
            data-table="Radiology_Report"
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
        loadjs.ready("fRadiology_Reportsrch", function() {
            var options = {
                name: "x_gender",
                selectId: "fRadiology_Reportsrch_x_gender",
                ajax: { id: "x_gender", form: "fRadiology_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Radiology_Report.fields.gender.filterOptions);
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
<div id="gmp_Radiology_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Radiology_Report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name_radiology->Visible) { ?>
    <th data-name="patient_name_radiology" class="<?= $Page->patient_name_radiology->headerCellClass() ?>"><div class="Radiology_Report_patient_name_radiology"><?= $Page->renderFieldHeader($Page->patient_name_radiology) ?></div></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
    <th data-name="date_of_birth" class="<?= $Page->date_of_birth->headerCellClass() ?>"><div class="Radiology_Report_date_of_birth"><?= $Page->renderFieldHeader($Page->date_of_birth) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
    <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div class="Radiology_Report_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->subcategory->Visible) { ?>
    <th data-name="subcategory" class="<?= $Page->subcategory->headerCellClass() ?>"><div class="Radiology_Report_subcategory"><?= $Page->renderFieldHeader($Page->subcategory) ?></div></th>
<?php } ?>
<?php if ($Page->service_name->Visible) { ?>
    <th data-name="service_name" class="<?= $Page->service_name->headerCellClass() ?>"><div class="Radiology_Report_service_name"><?= $Page->renderFieldHeader($Page->service_name) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Radiology_Report_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
    <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div class="Radiology_Report_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->radiology_month->Visible) { ?>
    <th data-name="radiology_month" class="<?= $Page->radiology_month->headerCellClass() ?>"><div class="Radiology_Report_radiology_month"><?= $Page->renderFieldHeader($Page->radiology_month) ?></div></th>
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
<?php if ($Page->patient_name_radiology->Visible) { ?>
        <td data-field="patient_name_radiology"<?= $Page->patient_name_radiology->cellAttributes() ?>>
<span<?= $Page->patient_name_radiology->viewAttributes() ?>>
<?= $Page->patient_name_radiology->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
        <td data-field="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
        <td data-field="gender"<?= $Page->gender->cellAttributes() ?>>
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->subcategory->Visible) { ?>
        <td data-field="subcategory"<?= $Page->subcategory->cellAttributes() ?>>
<span<?= $Page->subcategory->viewAttributes() ?>>
<?= $Page->subcategory->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->service_name->Visible) { ?>
        <td data-field="service_name"<?= $Page->service_name->cellAttributes() ?>>
<span<?= $Page->service_name->viewAttributes() ?>>
<?= $Page->service_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
        <td data-field="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
        <td data-field="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->radiology_month->Visible) { ?>
        <td data-field="radiology_month"<?= $Page->radiology_month->cellAttributes() ?>>
<span<?= $Page->radiology_month->viewAttributes() ?>>
<?= $Page->radiology_month->getViewValue() ?></span>
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
    $Page->SubmissionsbyMonth->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->SubmissionsbyMonth->render("ew-chart-bottom");
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
