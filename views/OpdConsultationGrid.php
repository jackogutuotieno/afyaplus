<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("OpdConsultationGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fopd_consultationgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { opd_consultation: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fopd_consultationgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null, ew.Validators.integer], fields.visit_id.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["visit_id",false],["cost",false]];
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
<div id="fopd_consultationgrid" class="ew-form ew-list-form">
<div id="gmp_opd_consultation" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_opd_consultationgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <th data-name="visit_id" class="<?= $Grid->visit_id->headerCellClass() ?>"><div id="elh_opd_consultation_visit_id" class="opd_consultation_visit_id"><?= $Grid->renderFieldHeader($Grid->visit_id) ?></div></th>
<?php } ?>
<?php if ($Grid->cost->Visible) { // cost ?>
        <th data-name="cost" class="<?= $Grid->cost->headerCellClass() ?>"><div id="elh_opd_consultation_cost" class="opd_consultation_cost"><?= $Grid->renderFieldHeader($Grid->cost) ?></div></th>
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
    <?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <td data-name="visit_id"<?= $Grid->visit_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->visit_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_visit_id" class="el_opd_consultation_visit_id">
<span<?= $Grid->visit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->visit_id->getDisplayValue($Grid->visit_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_visit_id" name="x<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_visit_id" class="el_opd_consultation_visit_id">
<input type="<?= $Grid->visit_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_id" id="x<?= $Grid->RowIndex ?>_visit_id" data-table="opd_consultation" data-field="x_visit_id" value="<?= $Grid->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_id->formatPattern()) ?>"<?= $Grid->visit_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="opd_consultation" data-field="x_visit_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_id" id="o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->visit_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_visit_id" class="el_opd_consultation_visit_id">
<span<?= $Grid->visit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->visit_id->getDisplayValue($Grid->visit_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_visit_id" name="x<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_visit_id" class="el_opd_consultation_visit_id">
<input type="<?= $Grid->visit_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_id" id="x<?= $Grid->RowIndex ?>_visit_id" data-table="opd_consultation" data-field="x_visit_id" value="<?= $Grid->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_id->formatPattern()) ?>"<?= $Grid->visit_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_visit_id" class="el_opd_consultation_visit_id">
<span<?= $Grid->visit_id->viewAttributes() ?>>
<?= $Grid->visit_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_consultation" data-field="x_visit_id" data-hidden="1" name="fopd_consultationgrid$x<?= $Grid->RowIndex ?>_visit_id" id="fopd_consultationgrid$x<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->FormValue) ?>">
<input type="hidden" data-table="opd_consultation" data-field="x_visit_id" data-hidden="1" data-old name="fopd_consultationgrid$o<?= $Grid->RowIndex ?>_visit_id" id="fopd_consultationgrid$o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cost->Visible) { // cost ?>
        <td data-name="cost"<?= $Grid->cost->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_cost" class="el_opd_consultation_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="opd_consultation" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_consultation" data-field="x_cost" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_cost" id="o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_cost" class="el_opd_consultation_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="opd_consultation" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_consultation_cost" class="el_opd_consultation_cost">
<span<?= $Grid->cost->viewAttributes() ?>>
<?= $Grid->cost->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_consultation" data-field="x_cost" data-hidden="1" name="fopd_consultationgrid$x<?= $Grid->RowIndex ?>_cost" id="fopd_consultationgrid$x<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->FormValue) ?>">
<input type="hidden" data-table="opd_consultation" data-field="x_cost" data-hidden="1" data-old name="fopd_consultationgrid$o<?= $Grid->RowIndex ?>_cost" id="fopd_consultationgrid$o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
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
loadjs.ready(["fopd_consultationgrid","load"], () => fopd_consultationgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
    <?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <td data-name="visit_id" class="<?= $Grid->visit_id->footerCellClass() ?>"><span id="elf_opd_consultation_visit_id" class="opd_consultation_visit_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->cost->Visible) { // cost ?>
        <td data-name="cost" class="<?= $Grid->cost->footerCellClass() ?>"><span id="elf_opd_consultation_cost" class="opd_consultation_cost">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->cost->ViewValue ?></span>
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
<input type="hidden" name="detailpage" value="fopd_consultationgrid">
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
    ew.addEventHandlers("opd_consultation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
