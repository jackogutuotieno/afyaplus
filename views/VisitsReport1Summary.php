<?php

namespace PHPMaker2024\afyaplus;

// Page object
$VisitsReport1Summary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Visits_Report1: currentTable } });
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
<form name="fVisits_Report1srch" id="fVisits_Report1srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fVisits_Report1srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Visits_Report1: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fVisits_Report1srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fVisits_Report1srch")
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
            "visit_type": <?= $Page->visit_type->toClientList($Page) ?>,
            "payment_method": <?= $Page->payment_method->toClientList($Page) ?>,
            "company": <?= $Page->company->toClientList($Page) ?>,
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
<?php if ($Page->visit_type->Visible) { // visit_type ?>
<?php
if (!$Page->visit_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_visit_type" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->visit_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_visit_type"
            name="x_visit_type[]"
            class="form-control ew-select<?= $Page->visit_type->isInvalidClass() ?>"
            data-select2-id="fVisits_Report1srch_x_visit_type"
            data-table="Visits_Report1"
            data-field="x_visit_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->visit_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->visit_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->visit_type->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->visit_type->editAttributes() ?>>
            <?= $Page->visit_type->selectOptionListHtml("x_visit_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->visit_type->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fVisits_Report1srch", function() {
            var options = {
                name: "x_visit_type",
                selectId: "fVisits_Report1srch_x_visit_type",
                ajax: { id: "x_visit_type", form: "fVisits_Report1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Visits_Report1.fields.visit_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
<?php
if (!$Page->payment_method->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_payment_method" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->payment_method->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_payment_method"
            name="x_payment_method[]"
            class="form-control ew-select<?= $Page->payment_method->isInvalidClass() ?>"
            data-select2-id="fVisits_Report1srch_x_payment_method"
            data-table="Visits_Report1"
            data-field="x_payment_method"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->payment_method->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->payment_method->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->payment_method->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->payment_method->editAttributes() ?>>
            <?= $Page->payment_method->selectOptionListHtml("x_payment_method", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->payment_method->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fVisits_Report1srch", function() {
            var options = {
                name: "x_payment_method",
                selectId: "fVisits_Report1srch_x_payment_method",
                ajax: { id: "x_payment_method", form: "fVisits_Report1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Visits_Report1.fields.payment_method.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->company->Visible) { // company ?>
<?php
if (!$Page->company->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_company" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->company->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_company"
            name="x_company[]"
            class="form-control ew-select<?= $Page->company->isInvalidClass() ?>"
            data-select2-id="fVisits_Report1srch_x_company"
            data-table="Visits_Report1"
            data-field="x_company"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->company->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->company->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->company->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->company->editAttributes() ?>>
            <?= $Page->company->selectOptionListHtml("x_company", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->company->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fVisits_Report1srch", function() {
            var options = {
                name: "x_company",
                selectId: "fVisits_Report1srch_x_company",
                ajax: { id: "x_company", form: "fVisits_Report1srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Visits_Report1.fields.company.filterOptions);
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
<div id="gmp_Visits_Report1" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->patient_name_visits->Visible) { ?>
    <th data-name="patient_name_visits" class="<?= $Page->patient_name_visits->headerCellClass() ?>"><div class="Visits_Report1_patient_name_visits"><?= $Page->renderFieldHeader($Page->patient_name_visits) ?></div></th>
<?php } ?>
<?php if ($Page->visit_type->Visible) { ?>
    <th data-name="visit_type" class="<?= $Page->visit_type->headerCellClass() ?>"><div class="Visits_Report1_visit_type"><?= $Page->renderFieldHeader($Page->visit_type) ?></div></th>
<?php } ?>
<?php if ($Page->payment_method->Visible) { ?>
    <th data-name="payment_method" class="<?= $Page->payment_method->headerCellClass() ?>"><div class="Visits_Report1_payment_method"><?= $Page->renderFieldHeader($Page->payment_method) ?></div></th>
<?php } ?>
<?php if ($Page->company->Visible) { ?>
    <th data-name="company" class="<?= $Page->company->headerCellClass() ?>"><div class="Visits_Report1_company"><?= $Page->renderFieldHeader($Page->company) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Visits_Report1_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
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
<?php if ($Page->patient_name_visits->Visible) { ?>
        <td data-field="patient_name_visits"<?= $Page->patient_name_visits->cellAttributes() ?>>
<span<?= $Page->patient_name_visits->viewAttributes() ?>>
<?= $Page->patient_name_visits->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->visit_type->Visible) { ?>
        <td data-field="visit_type"<?= $Page->visit_type->cellAttributes() ?>>
<span<?= $Page->visit_type->viewAttributes() ?>>
<?= $Page->visit_type->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->payment_method->Visible) { ?>
        <td data-field="payment_method"<?= $Page->payment_method->cellAttributes() ?>>
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->company->Visible) { ?>
        <td data-field="company"<?= $Page->company->cellAttributes() ?>>
<span<?= $Page->company->viewAttributes() ?>>
<?= $Page->company->getViewValue() ?></span>
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
    $Page->VisitsbyMonth->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->VisitsbyMonth->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->VisitsbyMedicalScheme->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->VisitsbyMedicalScheme->render("ew-chart-bottom");
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
