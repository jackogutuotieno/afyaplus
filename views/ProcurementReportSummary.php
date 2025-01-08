<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ProcurementReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Procurement_Report: currentTable } });
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
<form name="fProcurement_Reportsrch" id="fProcurement_Reportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fProcurement_Reportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Procurement_Report: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fProcurement_Reportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fProcurement_Reportsrch")
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
            "batch_number": <?= $Page->batch_number->toClientList($Page) ?>,
            "supplier_name": <?= $Page->supplier_name->toClientList($Page) ?>,
            "category_name": <?= $Page->category_name->toClientList($Page) ?>,
            "subcategory_name": <?= $Page->subcategory_name->toClientList($Page) ?>,
            "purchase_month": <?= $Page->purchase_month->toClientList($Page) ?>,
            "purchase_year": <?= $Page->purchase_year->toClientList($Page) ?>,
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
<?php if ($Page->batch_number->Visible) { // batch_number ?>
<?php
if (!$Page->batch_number->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_batch_number" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->batch_number->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_batch_number"
            name="x_batch_number[]"
            class="form-control ew-select<?= $Page->batch_number->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_batch_number"
            data-table="Procurement_Report"
            data-field="x_batch_number"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->batch_number->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->batch_number->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->batch_number->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->batch_number->editAttributes() ?>>
            <?= $Page->batch_number->selectOptionListHtml("x_batch_number", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->batch_number->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_batch_number",
                selectId: "fProcurement_Reportsrch_x_batch_number",
                ajax: { id: "x_batch_number", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.batch_number.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->supplier_name->Visible) { // supplier_name ?>
<?php
if (!$Page->supplier_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_supplier_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->supplier_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_supplier_name"
            name="x_supplier_name[]"
            class="form-control ew-select<?= $Page->supplier_name->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_supplier_name"
            data-table="Procurement_Report"
            data-field="x_supplier_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->supplier_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->supplier_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->supplier_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->supplier_name->editAttributes() ?>>
            <?= $Page->supplier_name->selectOptionListHtml("x_supplier_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->supplier_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_supplier_name",
                selectId: "fProcurement_Reportsrch_x_supplier_name",
                ajax: { id: "x_supplier_name", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.supplier_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->category_name->Visible) { // category_name ?>
<?php
if (!$Page->category_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_category_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->category_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_category_name"
            name="x_category_name[]"
            class="form-control ew-select<?= $Page->category_name->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_category_name"
            data-table="Procurement_Report"
            data-field="x_category_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->category_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->category_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->category_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->category_name->editAttributes() ?>>
            <?= $Page->category_name->selectOptionListHtml("x_category_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->category_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_category_name",
                selectId: "fProcurement_Reportsrch_x_category_name",
                ajax: { id: "x_category_name", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.category_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->subcategory_name->Visible) { // subcategory_name ?>
<?php
if (!$Page->subcategory_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_subcategory_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->subcategory_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_subcategory_name"
            name="x_subcategory_name[]"
            class="form-control ew-select<?= $Page->subcategory_name->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_subcategory_name"
            data-table="Procurement_Report"
            data-field="x_subcategory_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->subcategory_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->subcategory_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->subcategory_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->subcategory_name->editAttributes() ?>>
            <?= $Page->subcategory_name->selectOptionListHtml("x_subcategory_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->subcategory_name->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_subcategory_name",
                selectId: "fProcurement_Reportsrch_x_subcategory_name",
                ajax: { id: "x_subcategory_name", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.subcategory_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->purchase_month->Visible) { // purchase_month ?>
<?php
if (!$Page->purchase_month->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_purchase_month" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->purchase_month->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_purchase_month"
            name="x_purchase_month[]"
            class="form-control ew-select<?= $Page->purchase_month->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_purchase_month"
            data-table="Procurement_Report"
            data-field="x_purchase_month"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->purchase_month->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->purchase_month->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->purchase_month->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->purchase_month->editAttributes() ?>>
            <?= $Page->purchase_month->selectOptionListHtml("x_purchase_month", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->purchase_month->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_purchase_month",
                selectId: "fProcurement_Reportsrch_x_purchase_month",
                ajax: { id: "x_purchase_month", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.purchase_month.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->purchase_year->Visible) { // purchase_year ?>
<?php
if (!$Page->purchase_year->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_purchase_year" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->purchase_year->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_purchase_year"
            name="x_purchase_year[]"
            class="form-control ew-select<?= $Page->purchase_year->isInvalidClass() ?>"
            data-select2-id="fProcurement_Reportsrch_x_purchase_year"
            data-table="Procurement_Report"
            data-field="x_purchase_year"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->purchase_year->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->purchase_year->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->purchase_year->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->purchase_year->editAttributes() ?>>
            <?= $Page->purchase_year->selectOptionListHtml("x_purchase_year", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->purchase_year->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fProcurement_Reportsrch", function() {
            var options = {
                name: "x_purchase_year",
                selectId: "fProcurement_Reportsrch_x_purchase_year",
                ajax: { id: "x_purchase_year", form: "fProcurement_Reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Procurement_Report.fields.purchase_year.filterOptions);
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
<div id="gmp_Procurement_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Procurement_Report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->batch_number->Visible) { ?>
    <th data-name="batch_number" class="<?= $Page->batch_number->headerCellClass() ?>"><div class="Procurement_Report_batch_number"><?= $Page->renderFieldHeader($Page->batch_number) ?></div></th>
<?php } ?>
<?php if ($Page->supplier_name->Visible) { ?>
    <th data-name="supplier_name" class="<?= $Page->supplier_name->headerCellClass() ?>"><div class="Procurement_Report_supplier_name"><?= $Page->renderFieldHeader($Page->supplier_name) ?></div></th>
<?php } ?>
<?php if ($Page->category_name->Visible) { ?>
    <th data-name="category_name" class="<?= $Page->category_name->headerCellClass() ?>"><div class="Procurement_Report_category_name"><?= $Page->renderFieldHeader($Page->category_name) ?></div></th>
<?php } ?>
<?php if ($Page->subcategory_name->Visible) { ?>
    <th data-name="subcategory_name" class="<?= $Page->subcategory_name->headerCellClass() ?>"><div class="Procurement_Report_subcategory_name"><?= $Page->renderFieldHeader($Page->subcategory_name) ?></div></th>
<?php } ?>
<?php if ($Page->item_title->Visible) { ?>
    <th data-name="item_title" class="<?= $Page->item_title->headerCellClass() ?>"><div class="Procurement_Report_item_title"><?= $Page->renderFieldHeader($Page->item_title) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
    <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>"><div class="Procurement_Report_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { ?>
    <th data-name="measuring_unit" class="<?= $Page->measuring_unit->headerCellClass() ?>"><div class="Procurement_Report_measuring_unit"><?= $Page->renderFieldHeader($Page->measuring_unit) ?></div></th>
<?php } ?>
<?php if ($Page->unit_price->Visible) { ?>
    <th data-name="unit_price" class="<?= $Page->unit_price->headerCellClass() ?>"><div class="Procurement_Report_unit_price"><?= $Page->renderFieldHeader($Page->unit_price) ?></div></th>
<?php } ?>
<?php if ($Page->selling_price->Visible) { ?>
    <th data-name="selling_price" class="<?= $Page->selling_price->headerCellClass() ?>"><div class="Procurement_Report_selling_price"><?= $Page->renderFieldHeader($Page->selling_price) ?></div></th>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { ?>
    <th data-name="amount_paid" class="<?= $Page->amount_paid->headerCellClass() ?>"><div class="Procurement_Report_amount_paid"><?= $Page->renderFieldHeader($Page->amount_paid) ?></div></th>
<?php } ?>
<?php if ($Page->purchase_month->Visible) { ?>
    <th data-name="purchase_month" class="<?= $Page->purchase_month->headerCellClass() ?>"><div class="Procurement_Report_purchase_month"><?= $Page->renderFieldHeader($Page->purchase_month) ?></div></th>
<?php } ?>
<?php if ($Page->purchase_year->Visible) { ?>
    <th data-name="purchase_year" class="<?= $Page->purchase_year->headerCellClass() ?>"><div class="Procurement_Report_purchase_year"><?= $Page->renderFieldHeader($Page->purchase_year) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Procurement_Report_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
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
<?php if ($Page->batch_number->Visible) { ?>
        <td data-field="batch_number"<?= $Page->batch_number->cellAttributes() ?>>
<span<?= $Page->batch_number->viewAttributes() ?>>
<?= $Page->batch_number->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->supplier_name->Visible) { ?>
        <td data-field="supplier_name"<?= $Page->supplier_name->cellAttributes() ?>>
<span<?= $Page->supplier_name->viewAttributes() ?>>
<?= $Page->supplier_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->category_name->Visible) { ?>
        <td data-field="category_name"<?= $Page->category_name->cellAttributes() ?>>
<span<?= $Page->category_name->viewAttributes() ?>>
<?= $Page->category_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->subcategory_name->Visible) { ?>
        <td data-field="subcategory_name"<?= $Page->subcategory_name->cellAttributes() ?>>
<span<?= $Page->subcategory_name->viewAttributes() ?>>
<?= $Page->subcategory_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->item_title->Visible) { ?>
        <td data-field="item_title"<?= $Page->item_title->cellAttributes() ?>>
<span<?= $Page->item_title->viewAttributes() ?>>
<?= $Page->item_title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
        <td data-field="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { ?>
        <td data-field="measuring_unit"<?= $Page->measuring_unit->cellAttributes() ?>>
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->unit_price->Visible) { ?>
        <td data-field="unit_price"<?= $Page->unit_price->cellAttributes() ?>>
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->selling_price->Visible) { ?>
        <td data-field="selling_price"<?= $Page->selling_price->cellAttributes() ?>>
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { ?>
        <td data-field="amount_paid"<?= $Page->amount_paid->cellAttributes() ?>>
<span<?= $Page->amount_paid->viewAttributes() ?>>
<?= $Page->amount_paid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->purchase_month->Visible) { ?>
        <td data-field="purchase_month"<?= $Page->purchase_month->cellAttributes() ?>>
<span<?= $Page->purchase_month->viewAttributes() ?>>
<?= $Page->purchase_month->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->purchase_year->Visible) { ?>
        <td data-field="purchase_year"<?= $Page->purchase_year->cellAttributes() ?>>
<span<?= $Page->purchase_year->viewAttributes() ?>>
<?= $Page->purchase_year->getViewValue() ?></span>
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
    $Page->ProcurementbyMonth->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->ProcurementbyMonth->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->ProcurementbyYear->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->ProcurementbyYear->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->ProcurementbySupplier->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->ProcurementbySupplier->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->ProcurementbyCategory->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->ProcurementbyCategory->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->ProcurementbySubcategory->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->ProcurementbySubcategory->render("ew-chart-bottom");
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
