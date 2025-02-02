<?php

namespace PHPMaker2024\afyaplus;

// Page object
$BedsStatusList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds_status: currentTable } });
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
            "floor_name": <?= $Page->floor_name->toClientList($Page) ?>,
            "ward_type": <?= $Page->ward_type->toClientList($Page) ?>,
            "ward_name": <?= $Page->ward_name->toClientList($Page) ?>,
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
<form name="fbeds_statussrch" id="fbeds_statussrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fbeds_statussrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds_status: currentTable } });
var currentForm;
var fbeds_statussrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fbeds_statussrch")
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
            "floor_name": <?= $Page->floor_name->toClientList($Page) ?>,
            "ward_type": <?= $Page->ward_type->toClientList($Page) ?>,
            "ward_name": <?= $Page->ward_name->toClientList($Page) ?>,
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
<?php if ($Page->floor_name->Visible) { // floor_name ?>
<?php
if (!$Page->floor_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_floor_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->floor_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_floor_name"
            name="x_floor_name[]"
            class="form-control ew-select<?= $Page->floor_name->isInvalidClass() ?>"
            data-select2-id="fbeds_statussrch_x_floor_name"
            data-table="beds_status"
            data-field="x_floor_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->floor_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->floor_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->floor_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->floor_name->editAttributes() ?>>
            <?= $Page->floor_name->selectOptionListHtml("x_floor_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->floor_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbeds_statussrch", function() {
            var options = {
                name: "x_floor_name",
                selectId: "fbeds_statussrch_x_floor_name",
                ajax: { id: "x_floor_name", form: "fbeds_statussrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds_status.fields.floor_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ward_type->Visible) { // ward_type ?>
<?php
if (!$Page->ward_type->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ward_type" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->ward_type->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ward_type"
            name="x_ward_type[]"
            class="form-control ew-select<?= $Page->ward_type->isInvalidClass() ?>"
            data-select2-id="fbeds_statussrch_x_ward_type"
            data-table="beds_status"
            data-field="x_ward_type"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ward_type->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ward_type->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ward_type->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->ward_type->editAttributes() ?>>
            <?= $Page->ward_type->selectOptionListHtml("x_ward_type", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ward_type->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbeds_statussrch", function() {
            var options = {
                name: "x_ward_type",
                selectId: "fbeds_statussrch_x_ward_type",
                ajax: { id: "x_ward_type", form: "fbeds_statussrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds_status.fields.ward_type.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ward_name->Visible) { // ward_name ?>
<?php
if (!$Page->ward_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ward_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->ward_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ward_name"
            name="x_ward_name[]"
            class="form-control ew-select<?= $Page->ward_name->isInvalidClass() ?>"
            data-select2-id="fbeds_statussrch_x_ward_name"
            data-table="beds_status"
            data-field="x_ward_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ward_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ward_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ward_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->ward_name->editAttributes() ?>>
            <?= $Page->ward_name->selectOptionListHtml("x_ward_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ward_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbeds_statussrch", function() {
            var options = {
                name: "x_ward_name",
                selectId: "fbeds_statussrch_x_ward_name",
                ajax: { id: "x_ward_name", form: "fbeds_statussrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds_status.fields.ward_name.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbeds_statussrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbeds_statussrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbeds_statussrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbeds_statussrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="beds_status">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_beds_status" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_beds_statuslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->floor_name->Visible) { // floor_name ?>
        <th data-name="floor_name" class="<?= $Page->floor_name->headerCellClass() ?>"><div id="elh_beds_status_floor_name" class="beds_status_floor_name"><?= $Page->renderFieldHeader($Page->floor_name) ?></div></th>
<?php } ?>
<?php if ($Page->ward_type->Visible) { // ward_type ?>
        <th data-name="ward_type" class="<?= $Page->ward_type->headerCellClass() ?>"><div id="elh_beds_status_ward_type" class="beds_status_ward_type"><?= $Page->renderFieldHeader($Page->ward_type) ?></div></th>
<?php } ?>
<?php if ($Page->ward_name->Visible) { // ward_name ?>
        <th data-name="ward_name" class="<?= $Page->ward_name->headerCellClass() ?>"><div id="elh_beds_status_ward_name" class="beds_status_ward_name"><?= $Page->renderFieldHeader($Page->ward_name) ?></div></th>
<?php } ?>
<?php if ($Page->bed_name->Visible) { // bed_name ?>
        <th data-name="bed_name" class="<?= $Page->bed_name->headerCellClass() ?>"><div id="elh_beds_status_bed_name" class="beds_status_bed_name"><?= $Page->renderFieldHeader($Page->bed_name) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_beds_status_status" class="beds_status_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_beds_status_date_created" class="beds_status_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
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
    <?php if ($Page->floor_name->Visible) { // floor_name ?>
        <td data-name="floor_name"<?= $Page->floor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_floor_name" class="el_beds_status_floor_name">
<span<?= $Page->floor_name->viewAttributes() ?>>
<?= $Page->floor_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ward_type->Visible) { // ward_type ?>
        <td data-name="ward_type"<?= $Page->ward_type->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_ward_type" class="el_beds_status_ward_type">
<span<?= $Page->ward_type->viewAttributes() ?>>
<?= $Page->ward_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ward_name->Visible) { // ward_name ?>
        <td data-name="ward_name"<?= $Page->ward_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_ward_name" class="el_beds_status_ward_name">
<span<?= $Page->ward_name->viewAttributes() ?>>
<?= $Page->ward_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bed_name->Visible) { // bed_name ?>
        <td data-name="bed_name"<?= $Page->bed_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_bed_name" class="el_beds_status_bed_name">
<span<?= $Page->bed_name->viewAttributes() ?>>
<?= $Page->bed_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_status" class="el_beds_status_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_status_date_created" class="el_beds_status_date_created">
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
    ew.addEventHandlers("beds_status");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
