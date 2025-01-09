<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientIpdPrescriptionDetailsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_ipd_prescription_details: currentTable } });
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
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "patient_ipd_prescriptions") {
    if ($Page->MasterRecordExists) {
        include_once "views/PatientIpdPrescriptionsMaster.php";
    }
}
?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fpatient_ipd_prescription_detailssrch" id="fpatient_ipd_prescription_detailssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fpatient_ipd_prescription_detailssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_ipd_prescription_details: currentTable } });
var currentForm;
var fpatient_ipd_prescription_detailssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fpatient_ipd_prescription_detailssrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
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
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpatient_ipd_prescription_detailssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpatient_ipd_prescription_detailssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpatient_ipd_prescription_detailssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpatient_ipd_prescription_detailssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="patient_ipd_prescription_details">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "patient_ipd_prescriptions" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_ipd_prescriptions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->prescription_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_patient_ipd_prescription_details" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_patient_ipd_prescription_detailslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <th data-name="prescription_id" class="<?= $Page->prescription_id->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_prescription_id" class="patient_ipd_prescription_details_prescription_id"><?= $Page->renderFieldHeader($Page->prescription_id) ?></div></th>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <th data-name="medicine_stock_id" class="<?= $Page->medicine_stock_id->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_medicine_stock_id" class="patient_ipd_prescription_details_medicine_stock_id"><?= $Page->renderFieldHeader($Page->medicine_stock_id) ?></div></th>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <th data-name="method" class="<?= $Page->method->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_method" class="patient_ipd_prescription_details_method"><?= $Page->renderFieldHeader($Page->method) ?></div></th>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
        <th data-name="dose_quantity" class="<?= $Page->dose_quantity->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_dose_quantity" class="patient_ipd_prescription_details_dose_quantity"><?= $Page->renderFieldHeader($Page->dose_quantity) ?></div></th>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
        <th data-name="dose_type" class="<?= $Page->dose_type->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_dose_type" class="patient_ipd_prescription_details_dose_type"><?= $Page->renderFieldHeader($Page->dose_type) ?></div></th>
<?php } ?>
<?php if ($Page->formulation->Visible) { // formulation ?>
        <th data-name="formulation" class="<?= $Page->formulation->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_formulation" class="patient_ipd_prescription_details_formulation"><?= $Page->renderFieldHeader($Page->formulation) ?></div></th>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
        <th data-name="dose_interval" class="<?= $Page->dose_interval->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_dose_interval" class="patient_ipd_prescription_details_dose_interval"><?= $Page->renderFieldHeader($Page->dose_interval) ?></div></th>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
        <th data-name="number_of_days" class="<?= $Page->number_of_days->headerCellClass() ?>"><div id="elh_patient_ipd_prescription_details_number_of_days" class="patient_ipd_prescription_details_number_of_days"><?= $Page->renderFieldHeader($Page->number_of_days) ?></div></th>
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
    <?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <td data-name="prescription_id"<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_prescription_id" class="el_patient_ipd_prescription_details_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <td data-name="medicine_stock_id"<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_medicine_stock_id" class="el_patient_ipd_prescription_details_medicine_stock_id">
<span<?= $Page->medicine_stock_id->viewAttributes() ?>>
<?= $Page->medicine_stock_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->method->Visible) { // method ?>
        <td data-name="method"<?= $Page->method->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_method" class="el_patient_ipd_prescription_details_method">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
        <td data-name="dose_quantity"<?= $Page->dose_quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_dose_quantity" class="el_patient_ipd_prescription_details_dose_quantity">
<span<?= $Page->dose_quantity->viewAttributes() ?>>
<?= $Page->dose_quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dose_type->Visible) { // dose_type ?>
        <td data-name="dose_type"<?= $Page->dose_type->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_dose_type" class="el_patient_ipd_prescription_details_dose_type">
<span<?= $Page->dose_type->viewAttributes() ?>>
<?= $Page->dose_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->formulation->Visible) { // formulation ?>
        <td data-name="formulation"<?= $Page->formulation->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_formulation" class="el_patient_ipd_prescription_details_formulation">
<span<?= $Page->formulation->viewAttributes() ?>>
<?= $Page->formulation->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dose_interval->Visible) { // dose_interval ?>
        <td data-name="dose_interval"<?= $Page->dose_interval->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_dose_interval" class="el_patient_ipd_prescription_details_dose_interval">
<span<?= $Page->dose_interval->viewAttributes() ?>>
<?= $Page->dose_interval->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->number_of_days->Visible) { // number_of_days ?>
        <td data-name="number_of_days"<?= $Page->number_of_days->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_patient_ipd_prescription_details_number_of_days" class="el_patient_ipd_prescription_details_number_of_days">
<span<?= $Page->number_of_days->viewAttributes() ?>>
<?= $Page->number_of_days->getViewValue() ?></span>
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
    ew.addEventHandlers("patient_ipd_prescription_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
