<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("IpdBedChargesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fipd_bed_chargesgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { ipd_bed_charges: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fipd_bed_chargesgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["bed_charges", [fields.bed_charges.visible && fields.bed_charges.required ? ew.Validators.required(fields.bed_charges.caption) : null, ew.Validators.float], fields.bed_charges.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["admission_id",false],["bed_charges",false]];
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
<div id="fipd_bed_chargesgrid" class="ew-form ew-list-form">
<div id="gmp_ipd_bed_charges" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_ipd_bed_chargesgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->admission_id->Visible) { // admission_id ?>
        <th data-name="admission_id" class="<?= $Grid->admission_id->headerCellClass() ?>"><div id="elh_ipd_bed_charges_admission_id" class="ipd_bed_charges_admission_id"><?= $Grid->renderFieldHeader($Grid->admission_id) ?></div></th>
<?php } ?>
<?php if ($Grid->bed_charges->Visible) { // bed_charges ?>
        <th data-name="bed_charges" class="<?= $Grid->bed_charges->headerCellClass() ?>"><div id="elh_ipd_bed_charges_bed_charges" class="ipd_bed_charges_bed_charges"><?= $Grid->renderFieldHeader($Grid->bed_charges) ?></div></th>
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
    <?php if ($Grid->admission_id->Visible) { // admission_id ?>
        <td data-name="admission_id"<?= $Grid->admission_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_admission_id" class="el_ipd_bed_charges_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_admission_id" class="el_ipd_bed_charges_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="ipd_bed_charges" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="ipd_bed_charges" data-field="x_admission_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_id" id="o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_admission_id" class="el_ipd_bed_charges_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_admission_id" class="el_ipd_bed_charges_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="ipd_bed_charges" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_admission_id" class="el_ipd_bed_charges_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<?= $Grid->admission_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bed_charges" data-field="x_admission_id" data-hidden="1" name="fipd_bed_chargesgrid$x<?= $Grid->RowIndex ?>_admission_id" id="fipd_bed_chargesgrid$x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->FormValue) ?>">
<input type="hidden" data-table="ipd_bed_charges" data-field="x_admission_id" data-hidden="1" data-old name="fipd_bed_chargesgrid$o<?= $Grid->RowIndex ?>_admission_id" id="fipd_bed_chargesgrid$o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bed_charges->Visible) { // bed_charges ?>
        <td data-name="bed_charges"<?= $Grid->bed_charges->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_bed_charges" class="el_ipd_bed_charges_bed_charges">
<input type="<?= $Grid->bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_charges" id="x<?= $Grid->RowIndex ?>_bed_charges" data-table="ipd_bed_charges" data-field="x_bed_charges" value="<?= $Grid->bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_charges->formatPattern()) ?>"<?= $Grid->bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_charges->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_bed_charges" data-field="x_bed_charges" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_bed_charges" id="o<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_bed_charges" class="el_ipd_bed_charges_bed_charges">
<input type="<?= $Grid->bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_charges" id="x<?= $Grid->RowIndex ?>_bed_charges" data-table="ipd_bed_charges" data-field="x_bed_charges" value="<?= $Grid->bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_charges->formatPattern()) ?>"<?= $Grid->bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_charges->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bed_charges_bed_charges" class="el_ipd_bed_charges_bed_charges">
<span<?= $Grid->bed_charges->viewAttributes() ?>>
<?= $Grid->bed_charges->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bed_charges" data-field="x_bed_charges" data-hidden="1" name="fipd_bed_chargesgrid$x<?= $Grid->RowIndex ?>_bed_charges" id="fipd_bed_chargesgrid$x<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->FormValue) ?>">
<input type="hidden" data-table="ipd_bed_charges" data-field="x_bed_charges" data-hidden="1" data-old name="fipd_bed_chargesgrid$o<?= $Grid->RowIndex ?>_bed_charges" id="fipd_bed_chargesgrid$o<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->OldValue) ?>">
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
loadjs.ready(["fipd_bed_chargesgrid","load"], () => fipd_bed_chargesgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<?php
// Render aggregate row
$Grid->RowType = RowType::AGGREGATE;
$Grid->resetAttributes();
$Grid->renderRow();
?>
<?php if ($Grid->TotalRecords > 0 && $Grid->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Grid->renderListOptions();

// Render list options (footer, left)
$Grid->ListOptions->render("footer", "left");
?>
    <?php if ($Grid->admission_id->Visible) { // admission_id ?>
        <td data-name="admission_id" class="<?= $Grid->admission_id->footerCellClass() ?>"><span id="elf_ipd_bed_charges_admission_id" class="ipd_bed_charges_admission_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->bed_charges->Visible) { // bed_charges ?>
        <td data-name="bed_charges" class="<?= $Grid->bed_charges->footerCellClass() ?>"><span id="elf_ipd_bed_charges_bed_charges" class="ipd_bed_charges_bed_charges">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->bed_charges->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Grid->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
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
<input type="hidden" name="detailpage" value="fipd_bed_chargesgrid">
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
    ew.addEventHandlers("ipd_bed_charges");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
