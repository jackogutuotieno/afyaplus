<?php

namespace PHPMaker2024\afyaplus;

// Page object
$BedsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds: currentTable } });
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
            "floor_id": <?= $Page->floor_id->toClientList($Page) ?>,
            "ward_type_id": <?= $Page->ward_type_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "wards") {
    if ($Page->MasterRecordExists) {
        include_once "views/WardsMaster.php";
    }
}
?>
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fbedssrch" id="fbedssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fbedssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds: currentTable } });
var currentForm;
var fbedssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fbedssrch")
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
            "floor_id": <?= $Page->floor_id->toClientList($Page) ?>,
            "ward_type_id": <?= $Page->ward_type_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
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
<?php if ($Page->floor_id->Visible) { // floor_id ?>
<?php
if (!$Page->floor_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_floor_id" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->floor_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_floor_id"
            name="x_floor_id[]"
            class="form-control ew-select<?= $Page->floor_id->isInvalidClass() ?>"
            data-select2-id="fbedssrch_x_floor_id"
            data-table="beds"
            data-field="x_floor_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->floor_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->floor_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->floor_id->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->floor_id->editAttributes() ?>>
            <?= $Page->floor_id->selectOptionListHtml("x_floor_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->floor_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbedssrch", function() {
            var options = {
                name: "x_floor_id",
                selectId: "fbedssrch_x_floor_id",
                ajax: { id: "x_floor_id", form: "fbedssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds.fields.floor_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
<?php
if (!$Page->ward_type_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ward_type_id" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->ward_type_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ward_type_id"
            name="x_ward_type_id[]"
            class="form-control ew-select<?= $Page->ward_type_id->isInvalidClass() ?>"
            data-select2-id="fbedssrch_x_ward_type_id"
            data-table="beds"
            data-field="x_ward_type_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ward_type_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ward_type_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ward_type_id->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->ward_type_id->editAttributes() ?>>
            <?= $Page->ward_type_id->selectOptionListHtml("x_ward_type_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ward_type_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbedssrch", function() {
            var options = {
                name: "x_ward_type_id",
                selectId: "fbedssrch_x_ward_type_id",
                ajax: { id: "x_ward_type_id", form: "fbedssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds.fields.ward_type_id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
<?php
if (!$Page->ward_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_ward_id" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->ward_id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_ward_id"
            name="x_ward_id[]"
            class="form-control ew-select<?= $Page->ward_id->isInvalidClass() ?>"
            data-select2-id="fbedssrch_x_ward_id"
            data-table="beds"
            data-field="x_ward_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->ward_id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->ward_id->editAttributes() ?>>
            <?= $Page->ward_id->selectOptionListHtml("x_ward_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fbedssrch", function() {
            var options = {
                name: "x_ward_id",
                selectId: "fbedssrch_x_ward_id",
                ajax: { id: "x_ward_id", form: "fbedssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.beds.fields.ward_id.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbedssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbedssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbedssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbedssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="beds">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "wards" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="wards">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->ward_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_beds" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_bedslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->floor_id->Visible) { // floor_id ?>
        <th data-name="floor_id" class="<?= $Page->floor_id->headerCellClass() ?>"><div id="elh_beds_floor_id" class="beds_floor_id"><?= $Page->renderFieldHeader($Page->floor_id) ?></div></th>
<?php } ?>
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
        <th data-name="ward_type_id" class="<?= $Page->ward_type_id->headerCellClass() ?>"><div id="elh_beds_ward_type_id" class="beds_ward_type_id"><?= $Page->renderFieldHeader($Page->ward_type_id) ?></div></th>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
        <th data-name="ward_id" class="<?= $Page->ward_id->headerCellClass() ?>"><div id="elh_beds_ward_id" class="beds_ward_id"><?= $Page->renderFieldHeader($Page->ward_id) ?></div></th>
<?php } ?>
<?php if ($Page->bed_name->Visible) { // bed_name ?>
        <th data-name="bed_name" class="<?= $Page->bed_name->headerCellClass() ?>"><div id="elh_beds_bed_name" class="beds_bed_name"><?= $Page->renderFieldHeader($Page->bed_name) ?></div></th>
<?php } ?>
<?php if ($Page->bed_charges->Visible) { // bed_charges ?>
        <th data-name="bed_charges" class="<?= $Page->bed_charges->headerCellClass() ?>"><div id="elh_beds_bed_charges" class="beds_bed_charges"><?= $Page->renderFieldHeader($Page->bed_charges) ?></div></th>
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
    <?php if ($Page->floor_id->Visible) { // floor_id ?>
        <td data-name="floor_id"<?= $Page->floor_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_floor_id" class="el_beds_floor_id">
<span<?= $Page->floor_id->viewAttributes() ?>>
<?= $Page->floor_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
        <td data-name="ward_type_id"<?= $Page->ward_type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_ward_type_id" class="el_beds_ward_type_id">
<span<?= $Page->ward_type_id->viewAttributes() ?>>
<?= $Page->ward_type_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ward_id->Visible) { // ward_id ?>
        <td data-name="ward_id"<?= $Page->ward_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
<span<?= $Page->ward_id->viewAttributes() ?>>
<?= $Page->ward_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bed_name->Visible) { // bed_name ?>
        <td data-name="bed_name"<?= $Page->bed_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_bed_name" class="el_beds_bed_name">
<span<?= $Page->bed_name->viewAttributes() ?>>
<?= $Page->bed_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bed_charges->Visible) { // bed_charges ?>
        <td data-name="bed_charges"<?= $Page->bed_charges->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_beds_bed_charges" class="el_beds_bed_charges">
<span<?= $Page->bed_charges->viewAttributes() ?>>
<?= $Page->bed_charges->getViewValue() ?></span>
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
    ew.addEventHandlers("beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
