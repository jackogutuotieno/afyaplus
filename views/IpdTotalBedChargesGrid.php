<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("IpdTotalBedChargesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fipd_total_bed_chargesgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { ipd_total_bed_charges: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fipd_total_bed_chargesgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["total_bed_charges", [fields.total_bed_charges.visible && fields.total_bed_charges.required ? ew.Validators.required(fields.total_bed_charges.caption) : null, ew.Validators.float], fields.total_bed_charges.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["total_bed_charges",false]];
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
<div id="fipd_total_bed_chargesgrid" class="ew-form ew-list-form">
<div id="gmp_ipd_total_bed_charges" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_ipd_total_bed_chargesgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->total_bed_charges->Visible) { // total_bed_charges ?>
        <th data-name="total_bed_charges" class="<?= $Grid->total_bed_charges->headerCellClass() ?>"><div id="elh_ipd_total_bed_charges_total_bed_charges" class="ipd_total_bed_charges_total_bed_charges"><?= $Grid->renderFieldHeader($Grid->total_bed_charges) ?></div></th>
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
    <?php if ($Grid->total_bed_charges->Visible) { // total_bed_charges ?>
        <td data-name="total_bed_charges"<?= $Grid->total_bed_charges->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_total_bed_charges_total_bed_charges" class="el_ipd_total_bed_charges_total_bed_charges">
<input type="<?= $Grid->total_bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_bed_charges" id="x<?= $Grid->RowIndex ?>_total_bed_charges" data-table="ipd_total_bed_charges" data-field="x_total_bed_charges" value="<?= $Grid->total_bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_bed_charges->formatPattern()) ?>"<?= $Grid->total_bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_bed_charges->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_total_bed_charges" data-field="x_total_bed_charges" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_total_bed_charges" id="o<?= $Grid->RowIndex ?>_total_bed_charges" value="<?= HtmlEncode($Grid->total_bed_charges->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_total_bed_charges_total_bed_charges" class="el_ipd_total_bed_charges_total_bed_charges">
<input type="<?= $Grid->total_bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_bed_charges" id="x<?= $Grid->RowIndex ?>_total_bed_charges" data-table="ipd_total_bed_charges" data-field="x_total_bed_charges" value="<?= $Grid->total_bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_bed_charges->formatPattern()) ?>"<?= $Grid->total_bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_bed_charges->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_total_bed_charges_total_bed_charges" class="el_ipd_total_bed_charges_total_bed_charges">
<span<?= $Grid->total_bed_charges->viewAttributes() ?>>
<?= $Grid->total_bed_charges->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_total_bed_charges" data-field="x_total_bed_charges" data-hidden="1" name="fipd_total_bed_chargesgrid$x<?= $Grid->RowIndex ?>_total_bed_charges" id="fipd_total_bed_chargesgrid$x<?= $Grid->RowIndex ?>_total_bed_charges" value="<?= HtmlEncode($Grid->total_bed_charges->FormValue) ?>">
<input type="hidden" data-table="ipd_total_bed_charges" data-field="x_total_bed_charges" data-hidden="1" data-old name="fipd_total_bed_chargesgrid$o<?= $Grid->RowIndex ?>_total_bed_charges" id="fipd_total_bed_chargesgrid$o<?= $Grid->RowIndex ?>_total_bed_charges" value="<?= HtmlEncode($Grid->total_bed_charges->OldValue) ?>">
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
loadjs.ready(["fipd_total_bed_chargesgrid","load"], () => fipd_total_bed_chargesgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fipd_total_bed_chargesgrid">
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
    ew.addEventHandlers("ipd_total_bed_charges");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
