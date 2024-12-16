<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("FullHaemogramParametersGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var ffull_haemogram_parametersgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { full_haemogram_parameters: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffull_haemogram_parametersgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_report_id", [fields.lab_test_report_id.visible && fields.lab_test_report_id.required ? ew.Validators.required(fields.lab_test_report_id.caption) : null, ew.Validators.integer], fields.lab_test_report_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["lab_test_report_id",false]];
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
<div id="ffull_haemogram_parametersgrid" class="ew-form ew-list-form">
<div id="gmp_full_haemogram_parameters" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_full_haemogram_parametersgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_id" class="full_haemogram_parameters_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->lab_test_report_id->Visible) { // lab_test_report_id ?>
        <th data-name="lab_test_report_id" class="<?= $Grid->lab_test_report_id->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_lab_test_report_id" class="full_haemogram_parameters_lab_test_report_id"><?= $Grid->renderFieldHeader($Grid->lab_test_report_id) ?></div></th>
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
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id"></span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_id" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_id" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->lab_test_report_id->Visible) { // lab_test_report_id ?>
        <td data-name="lab_test_report_id"<?= $Grid->lab_test_report_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->lab_test_report_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_report_id->getDisplayValue($Grid->lab_test_report_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<input type="<?= $Grid->lab_test_report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" value="<?= $Grid->lab_test_report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_report_id->formatPattern()) ?>"<?= $Grid->lab_test_report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_lab_test_report_id" id="o<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->lab_test_report_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_report_id->getDisplayValue($Grid->lab_test_report_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<input type="<?= $Grid->lab_test_report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" value="<?= $Grid->lab_test_report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_report_id->formatPattern()) ?>"<?= $Grid->lab_test_report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<?= $Grid->lab_test_report_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_lab_test_report_id" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_lab_test_report_id" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->OldValue) ?>">
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
loadjs.ready(["ffull_haemogram_parametersgrid","load"], () => ffull_haemogram_parametersgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="ffull_haemogram_parametersgrid">
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
    ew.addEventHandlers("full_haemogram_parameters");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
