<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LaboratoryBillingReportGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var flaboratory_billing_reportgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { laboratory_billing_report: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flaboratory_billing_reportgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid],
            ["id1", [fields.id1.visible && fields.id1.required ? ew.Validators.required(fields.id1.caption) : null], fields.id1.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["service_name",false],["cost",false]];
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
<div id="flaboratory_billing_reportgrid" class="ew-form ew-list-form">
<div id="gmp_laboratory_billing_report" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_laboratory_billing_reportgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_laboratory_billing_report_id" class="laboratory_billing_report_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->service_name->Visible) { // service_name ?>
        <th data-name="service_name" class="<?= $Grid->service_name->headerCellClass() ?>"><div id="elh_laboratory_billing_report_service_name" class="laboratory_billing_report_service_name"><?= $Grid->renderFieldHeader($Grid->service_name) ?></div></th>
<?php } ?>
<?php if ($Grid->cost->Visible) { // cost ?>
        <th data-name="cost" class="<?= $Grid->cost->headerCellClass() ?>"><div id="elh_laboratory_billing_report_cost" class="laboratory_billing_report_cost"><?= $Grid->renderFieldHeader($Grid->cost) ?></div></th>
<?php } ?>
<?php if ($Grid->id1->Visible) { // id1 ?>
        <th data-name="id1" class="<?= $Grid->id1->headerCellClass() ?>"><div id="elh_laboratory_billing_report_id1" class="laboratory_billing_report_id1"><?= $Grid->renderFieldHeader($Grid->id1) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id" class="el_laboratory_billing_report_id"></span>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id" class="el_laboratory_billing_report_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id" class="el_laboratory_billing_report_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id" data-hidden="1" name="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_id" id="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id" data-hidden="1" data-old name="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_id" id="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="laboratory_billing_report" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->service_name->Visible) { // service_name ?>
        <td data-name="service_name"<?= $Grid->service_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_service_name" class="el_laboratory_billing_report_service_name">
<input type="<?= $Grid->service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_service_name" id="x<?= $Grid->RowIndex ?>_service_name" data-table="laboratory_billing_report" data-field="x_service_name" value="<?= $Grid->service_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->service_name->formatPattern()) ?>"<?= $Grid->service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->service_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_service_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_service_name" id="o<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_service_name" class="el_laboratory_billing_report_service_name">
<input type="<?= $Grid->service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_service_name" id="x<?= $Grid->RowIndex ?>_service_name" data-table="laboratory_billing_report" data-field="x_service_name" value="<?= $Grid->service_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->service_name->formatPattern()) ?>"<?= $Grid->service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->service_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_service_name" class="el_laboratory_billing_report_service_name">
<span<?= $Grid->service_name->viewAttributes() ?>>
<?= $Grid->service_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_service_name" data-hidden="1" name="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_service_name" id="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->FormValue) ?>">
<input type="hidden" data-table="laboratory_billing_report" data-field="x_service_name" data-hidden="1" data-old name="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_service_name" id="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cost->Visible) { // cost ?>
        <td data-name="cost"<?= $Grid->cost->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_cost" class="el_laboratory_billing_report_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="laboratory_billing_report" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_cost" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_cost" id="o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_cost" class="el_laboratory_billing_report_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="laboratory_billing_report" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_cost" class="el_laboratory_billing_report_cost">
<span<?= $Grid->cost->viewAttributes() ?>>
<?= $Grid->cost->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_cost" data-hidden="1" name="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_cost" id="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->FormValue) ?>">
<input type="hidden" data-table="laboratory_billing_report" data-field="x_cost" data-hidden="1" data-old name="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_cost" id="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->id1->Visible) { // id1 ?>
        <td data-name="id1"<?= $Grid->id1->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id1" class="el_laboratory_billing_report_id1"></span>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id1" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id1" id="o<?= $Grid->RowIndex ?>_id1" value="<?= HtmlEncode($Grid->id1->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id1" class="el_laboratory_billing_report_id1">
<input type="<?= $Grid->id1->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id1" id="x<?= $Grid->RowIndex ?>_id1" data-table="laboratory_billing_report" data-field="x_id1" value="<?= $Grid->id1->EditValue ?>" placeholder="<?= HtmlEncode($Grid->id1->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->id1->formatPattern()) ?>"<?= $Grid->id1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id1->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_laboratory_billing_report_id1" class="el_laboratory_billing_report_id1">
<span<?= $Grid->id1->viewAttributes() ?>>
<?= $Grid->id1->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id1" data-hidden="1" name="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_id1" id="flaboratory_billing_reportgrid$x<?= $Grid->RowIndex ?>_id1" value="<?= HtmlEncode($Grid->id1->FormValue) ?>">
<input type="hidden" data-table="laboratory_billing_report" data-field="x_id1" data-hidden="1" data-old name="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_id1" id="flaboratory_billing_reportgrid$o<?= $Grid->RowIndex ?>_id1" value="<?= HtmlEncode($Grid->id1->OldValue) ?>">
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
loadjs.ready(["flaboratory_billing_reportgrid","load"], () => flaboratory_billing_reportgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="flaboratory_billing_reportgrid">
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
    ew.addEventHandlers("laboratory_billing_report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>