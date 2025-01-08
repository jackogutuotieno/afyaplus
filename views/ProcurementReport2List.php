<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ProcurementReport2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { procurement_report2: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Dynamic selection lists
        .setLists({
            "batch_number": <?= $Page->batch_number->toClientList($Page) ?>,
            "supplier_name": <?= $Page->supplier_name->toClientList($Page) ?>,
            "category_name": <?= $Page->category_name->toClientList($Page) ?>,
            "subcategory_name": <?= $Page->subcategory_name->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=24.16.6",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css", false) ?>?v=24.16.6"
], "import");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fprocurement_report2srch" id="fprocurement_report2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fprocurement_report2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { procurement_report2: currentTable } });
var currentForm;
var fprocurement_report2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fprocurement_report2srch")
        .setPageId("list")
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
    currentSearchForm = form;
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
            data-select2-id="fprocurement_report2srch_x_batch_number"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->batch_number->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_batch_number",
                selectId: "fprocurement_report2srch_x_batch_number",
                ajax: { id: "x_batch_number", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.batch_number.filterOptions);
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
            data-select2-id="fprocurement_report2srch_x_supplier_name"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->supplier_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_supplier_name",
                selectId: "fprocurement_report2srch_x_supplier_name",
                ajax: { id: "x_supplier_name", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.supplier_name.filterOptions);
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
            data-select2-id="fprocurement_report2srch_x_category_name"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->category_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_category_name",
                selectId: "fprocurement_report2srch_x_category_name",
                ajax: { id: "x_category_name", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.category_name.filterOptions);
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
            data-select2-id="fprocurement_report2srch_x_subcategory_name"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->subcategory_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_subcategory_name",
                selectId: "fprocurement_report2srch_x_subcategory_name",
                ajax: { id: "x_subcategory_name", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.subcategory_name.filterOptions);
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
            data-select2-id="fprocurement_report2srch_x_purchase_month"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->purchase_month->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_purchase_month",
                selectId: "fprocurement_report2srch_x_purchase_month",
                ajax: { id: "x_purchase_month", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.purchase_month.filterOptions);
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
            data-select2-id="fprocurement_report2srch_x_purchase_year"
            data-table="procurement_report2"
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
        <div class="invalid-feedback"><?= $Page->purchase_year->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fprocurement_report2srch", function() {
            var options = {
                name: "x_purchase_year",
                selectId: "fprocurement_report2srch_x_purchase_year",
                ajax: { id: "x_purchase_year", form: "fprocurement_report2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.procurement_report2.fields.purchase_year.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fprocurement_report2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fprocurement_report2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fprocurement_report2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fprocurement_report2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
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
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="procurement_report2">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_procurement_report2" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_procurement_report2list" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_procurement_report2_id" class="procurement_report2_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->batch_number->Visible) { // batch_number ?>
        <th data-name="batch_number" class="<?= $Page->batch_number->headerCellClass() ?>"><div id="elh_procurement_report2_batch_number" class="procurement_report2_batch_number"><?= $Page->renderFieldHeader($Page->batch_number) ?></div></th>
<?php } ?>
<?php if ($Page->supplier_name->Visible) { // supplier_name ?>
        <th data-name="supplier_name" class="<?= $Page->supplier_name->headerCellClass() ?>"><div id="elh_procurement_report2_supplier_name" class="procurement_report2_supplier_name"><?= $Page->renderFieldHeader($Page->supplier_name) ?></div></th>
<?php } ?>
<?php if ($Page->category_name->Visible) { // category_name ?>
        <th data-name="category_name" class="<?= $Page->category_name->headerCellClass() ?>"><div id="elh_procurement_report2_category_name" class="procurement_report2_category_name"><?= $Page->renderFieldHeader($Page->category_name) ?></div></th>
<?php } ?>
<?php if ($Page->subcategory_name->Visible) { // subcategory_name ?>
        <th data-name="subcategory_name" class="<?= $Page->subcategory_name->headerCellClass() ?>"><div id="elh_procurement_report2_subcategory_name" class="procurement_report2_subcategory_name"><?= $Page->renderFieldHeader($Page->subcategory_name) ?></div></th>
<?php } ?>
<?php if ($Page->item_title->Visible) { // item_title ?>
        <th data-name="item_title" class="<?= $Page->item_title->headerCellClass() ?>"><div id="elh_procurement_report2_item_title" class="procurement_report2_item_title"><?= $Page->renderFieldHeader($Page->item_title) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>"><div id="elh_procurement_report2_quantity" class="procurement_report2_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <th data-name="measuring_unit" class="<?= $Page->measuring_unit->headerCellClass() ?>"><div id="elh_procurement_report2_measuring_unit" class="procurement_report2_measuring_unit"><?= $Page->renderFieldHeader($Page->measuring_unit) ?></div></th>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <th data-name="unit_price" class="<?= $Page->unit_price->headerCellClass() ?>"><div id="elh_procurement_report2_unit_price" class="procurement_report2_unit_price"><?= $Page->renderFieldHeader($Page->unit_price) ?></div></th>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
        <th data-name="selling_price" class="<?= $Page->selling_price->headerCellClass() ?>"><div id="elh_procurement_report2_selling_price" class="procurement_report2_selling_price"><?= $Page->renderFieldHeader($Page->selling_price) ?></div></th>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <th data-name="amount_paid" class="<?= $Page->amount_paid->headerCellClass() ?>"><div id="elh_procurement_report2_amount_paid" class="procurement_report2_amount_paid"><?= $Page->renderFieldHeader($Page->amount_paid) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_procurement_report2_date_created" class="procurement_report2_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
$isInlineAddOrCopy = ($Page->isCopy() || $Page->isAdd());
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$' || $isInlineAddOrCopy && $Page->RowIndex == 0) {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        !($isInlineAddOrCopy && $Page->RowIndex == 0)
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_id" class="el_procurement_report2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->batch_number->Visible) { // batch_number ?>
        <td data-name="batch_number"<?= $Page->batch_number->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_batch_number" class="el_procurement_report2_batch_number">
<span<?= $Page->batch_number->viewAttributes() ?>>
<?= $Page->batch_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supplier_name->Visible) { // supplier_name ?>
        <td data-name="supplier_name"<?= $Page->supplier_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_supplier_name" class="el_procurement_report2_supplier_name">
<span<?= $Page->supplier_name->viewAttributes() ?>>
<?= $Page->supplier_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->category_name->Visible) { // category_name ?>
        <td data-name="category_name"<?= $Page->category_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_category_name" class="el_procurement_report2_category_name">
<span<?= $Page->category_name->viewAttributes() ?>>
<?= $Page->category_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subcategory_name->Visible) { // subcategory_name ?>
        <td data-name="subcategory_name"<?= $Page->subcategory_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_subcategory_name" class="el_procurement_report2_subcategory_name">
<span<?= $Page->subcategory_name->viewAttributes() ?>>
<?= $Page->subcategory_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->item_title->Visible) { // item_title ?>
        <td data-name="item_title"<?= $Page->item_title->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_item_title" class="el_procurement_report2_item_title">
<span<?= $Page->item_title->viewAttributes() ?>>
<?= $Page->item_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_quantity" class="el_procurement_report2_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <td data-name="measuring_unit"<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_measuring_unit" class="el_procurement_report2_measuring_unit">
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->unit_price->Visible) { // unit_price ?>
        <td data-name="unit_price"<?= $Page->unit_price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_unit_price" class="el_procurement_report2_unit_price">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->selling_price->Visible) { // selling_price ?>
        <td data-name="selling_price"<?= $Page->selling_price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_selling_price" class="el_procurement_report2_selling_price">
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <td data-name="amount_paid"<?= $Page->amount_paid->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_amount_paid" class="el_procurement_report2_amount_paid">
<span<?= $Page->amount_paid->viewAttributes() ?>>
<?= $Page->amount_paid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_procurement_report2_date_created" class="el_procurement_report2_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("procurement_report2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
