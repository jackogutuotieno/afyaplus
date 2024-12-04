<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LabTestRequestsDetailsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var flab_test_requests_detailsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { lab_test_requests_details: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_requests_detailsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null], fields.service_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["service_id",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
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
            "service_id": <?= $Grid->service_id->toClientList($Grid) ?>,
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list">
<div id="ew-header-options">
<?php $Grid->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="flab_test_requests_detailsgrid" class="ew-form ew-list-form">
<div id="gmp_lab_test_requests_details" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_lab_test_requests_detailsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = RowType::HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->service_id->Visible) { // service_id ?>
        <th data-name="service_id" class="<?= $Grid->service_id->headerCellClass() ?>"><div id="elh_lab_test_requests_details_service_id" class="lab_test_requests_details_service_id"><?= $Grid->renderFieldHeader($Grid->service_id) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
$isInlineAddOrCopy = ($Grid->isCopy() || $Grid->isAdd());
while ($Grid->RecordCount < $Grid->StopRecord || $Grid->RowIndex === '$rowindex$' || $isInlineAddOrCopy && $Grid->RowIndex == 0) {
    if (
        $Grid->CurrentRow !== false &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        !($isInlineAddOrCopy && $Grid->RowIndex == 0)
    ) {
        $Grid->fetch();
    }
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->service_id->Visible) { // service_id ?>
        <td data-name="service_id"<?= $Grid->service_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_requests_details_service_id" class="el_lab_test_requests_details_service_id">
    <select
        id="x<?= $Grid->RowIndex ?>_service_id"
        name="x<?= $Grid->RowIndex ?>_service_id"
        class="form-select ew-select<?= $Grid->service_id->isInvalidClass() ?>"
        <?php if (!$Grid->service_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_requests_detailsgrid_x<?= $Grid->RowIndex ?>_service_id"
        <?php } ?>
        data-table="lab_test_requests_details"
        data-field="x_service_id"
        data-value-separator="<?= $Grid->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->service_id->getPlaceHolder()) ?>"
        <?= $Grid->service_id->editAttributes() ?>>
        <?= $Grid->service_id->selectOptionListHtml("x{$Grid->RowIndex}_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->service_id->getErrorMessage() ?></div>
<?= $Grid->service_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_service_id") ?>
<?php if (!$Grid->service_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_requests_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_service_id", selectId: "flab_test_requests_detailsgrid_x<?= $Grid->RowIndex ?>_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_requests_detailsgrid.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_service_id", form: "flab_test_requests_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_service_id", form: "flab_test_requests_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_requests_details.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="lab_test_requests_details" data-field="x_service_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_service_id" id="o<?= $Grid->RowIndex ?>_service_id" value="<?= HtmlEncode($Grid->service_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_requests_details_service_id" class="el_lab_test_requests_details_service_id">
    <select
        id="x<?= $Grid->RowIndex ?>_service_id"
        name="x<?= $Grid->RowIndex ?>_service_id"
        class="form-select ew-select<?= $Grid->service_id->isInvalidClass() ?>"
        <?php if (!$Grid->service_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_requests_detailsgrid_x<?= $Grid->RowIndex ?>_service_id"
        <?php } ?>
        data-table="lab_test_requests_details"
        data-field="x_service_id"
        data-value-separator="<?= $Grid->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->service_id->getPlaceHolder()) ?>"
        <?= $Grid->service_id->editAttributes() ?>>
        <?= $Grid->service_id->selectOptionListHtml("x{$Grid->RowIndex}_service_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->service_id->getErrorMessage() ?></div>
<?= $Grid->service_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_service_id") ?>
<?php if (!$Grid->service_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_requests_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_service_id", selectId: "flab_test_requests_detailsgrid_x<?= $Grid->RowIndex ?>_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_requests_detailsgrid.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_service_id", form: "flab_test_requests_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_service_id", form: "flab_test_requests_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_requests_details.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_requests_details_service_id" class="el_lab_test_requests_details_service_id">
<span<?= $Grid->service_id->viewAttributes() ?>>
<?= $Grid->service_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_requests_details" data-field="x_service_id" data-hidden="1" name="flab_test_requests_detailsgrid$x<?= $Grid->RowIndex ?>_service_id" id="flab_test_requests_detailsgrid$x<?= $Grid->RowIndex ?>_service_id" value="<?= HtmlEncode($Grid->service_id->FormValue) ?>">
<input type="hidden" data-table="lab_test_requests_details" data-field="x_service_id" data-hidden="1" data-old name="flab_test_requests_detailsgrid$o<?= $Grid->RowIndex ?>_service_id" id="flab_test_requests_detailsgrid$o<?= $Grid->RowIndex ?>_service_id" value="<?= HtmlEncode($Grid->service_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == RowType::ADD || $Grid->RowType == RowType::EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["flab_test_requests_detailsgrid","load"], () => flab_test_requests_detailsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking

    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="flab_test_requests_detailsgrid">
</div><!-- /.ew-list-form -->
<?php
// Close result set
$Grid->Recordset?->free();
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Grid->FooterOptions?->render("body") ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("lab_test_requests_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
