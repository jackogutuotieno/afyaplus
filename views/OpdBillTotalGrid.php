<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("OpdBillTotalGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fopd_bill_totalgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { opd_bill_total: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fopd_bill_totalgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["opd_total_bill", [fields.opd_total_bill.visible && fields.opd_total_bill.required ? ew.Validators.required(fields.opd_total_bill.caption) : null, ew.Validators.float], fields.opd_total_bill.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["opd_total_bill",false]];
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
<div id="fopd_bill_totalgrid" class="ew-form ew-list-form">
<div id="gmp_opd_bill_total" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_opd_bill_totalgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->opd_total_bill->Visible) { // opd_total_bill ?>
        <th data-name="opd_total_bill" class="<?= $Grid->opd_total_bill->headerCellClass() ?>"><div id="elh_opd_bill_total_opd_total_bill" class="opd_bill_total_opd_total_bill"><?= $Grid->renderFieldHeader($Grid->opd_total_bill) ?></div></th>
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
    <?php if ($Grid->opd_total_bill->Visible) { // opd_total_bill ?>
        <td data-name="opd_total_bill"<?= $Grid->opd_total_bill->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_bill_total_opd_total_bill" class="el_opd_bill_total_opd_total_bill">
<input type="<?= $Grid->opd_total_bill->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_opd_total_bill" id="x<?= $Grid->RowIndex ?>_opd_total_bill" data-table="opd_bill_total" data-field="x_opd_total_bill" value="<?= $Grid->opd_total_bill->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->opd_total_bill->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->opd_total_bill->formatPattern()) ?>"<?= $Grid->opd_total_bill->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->opd_total_bill->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_bill_total" data-field="x_opd_total_bill" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_opd_total_bill" id="o<?= $Grid->RowIndex ?>_opd_total_bill" value="<?= HtmlEncode($Grid->opd_total_bill->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_bill_total_opd_total_bill" class="el_opd_bill_total_opd_total_bill">
<input type="<?= $Grid->opd_total_bill->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_opd_total_bill" id="x<?= $Grid->RowIndex ?>_opd_total_bill" data-table="opd_bill_total" data-field="x_opd_total_bill" value="<?= $Grid->opd_total_bill->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->opd_total_bill->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->opd_total_bill->formatPattern()) ?>"<?= $Grid->opd_total_bill->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->opd_total_bill->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_bill_total_opd_total_bill" class="el_opd_bill_total_opd_total_bill">
<span<?= $Grid->opd_total_bill->viewAttributes() ?>>
<?= $Grid->opd_total_bill->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_bill_total" data-field="x_opd_total_bill" data-hidden="1" name="fopd_bill_totalgrid$x<?= $Grid->RowIndex ?>_opd_total_bill" id="fopd_bill_totalgrid$x<?= $Grid->RowIndex ?>_opd_total_bill" value="<?= HtmlEncode($Grid->opd_total_bill->FormValue) ?>">
<input type="hidden" data-table="opd_bill_total" data-field="x_opd_total_bill" data-hidden="1" data-old name="fopd_bill_totalgrid$o<?= $Grid->RowIndex ?>_opd_total_bill" id="fopd_bill_totalgrid$o<?= $Grid->RowIndex ?>_opd_total_bill" value="<?= HtmlEncode($Grid->opd_total_bill->OldValue) ?>">
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
loadjs.ready(["fopd_bill_totalgrid","load"], () => fopd_bill_totalgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fopd_bill_totalgrid">
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
    ew.addEventHandlers("opd_bill_total");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>