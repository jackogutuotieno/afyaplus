<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LeaveBalanceGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fleave_balancegrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { leave_balance: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_balancegrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["leave_category", [fields.leave_category.visible && fields.leave_category.required ? ew.Validators.required(fields.leave_category.caption) : null], fields.leave_category.isInvalid],
            ["maximum_days", [fields.maximum_days.visible && fields.maximum_days.required ? ew.Validators.required(fields.maximum_days.caption) : null, ew.Validators.integer], fields.maximum_days.isInvalid],
            ["days_balance", [fields.days_balance.visible && fields.days_balance.required ? ew.Validators.required(fields.days_balance.caption) : null, ew.Validators.float], fields.days_balance.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["leave_category",false],["maximum_days",false],["days_balance",false]];
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
<div id="fleave_balancegrid" class="ew-form ew-list-form">
<div id="gmp_leave_balance" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_leave_balancegrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->leave_category->Visible) { // leave_category ?>
        <th data-name="leave_category" class="<?= $Grid->leave_category->headerCellClass() ?>"><div id="elh_leave_balance_leave_category" class="leave_balance_leave_category"><?= $Grid->renderFieldHeader($Grid->leave_category) ?></div></th>
<?php } ?>
<?php if ($Grid->maximum_days->Visible) { // maximum_days ?>
        <th data-name="maximum_days" class="<?= $Grid->maximum_days->headerCellClass() ?>"><div id="elh_leave_balance_maximum_days" class="leave_balance_maximum_days"><?= $Grid->renderFieldHeader($Grid->maximum_days) ?></div></th>
<?php } ?>
<?php if ($Grid->days_balance->Visible) { // days_balance ?>
        <th data-name="days_balance" class="<?= $Grid->days_balance->headerCellClass() ?>"><div id="elh_leave_balance_days_balance" class="leave_balance_days_balance"><?= $Grid->renderFieldHeader($Grid->days_balance) ?></div></th>
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
    <?php if ($Grid->leave_category->Visible) { // leave_category ?>
        <td data-name="leave_category"<?= $Grid->leave_category->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_leave_category" class="el_leave_balance_leave_category">
<input type="<?= $Grid->leave_category->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_leave_category" id="x<?= $Grid->RowIndex ?>_leave_category" data-table="leave_balance" data-field="x_leave_category" value="<?= $Grid->leave_category->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->leave_category->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->leave_category->formatPattern()) ?>"<?= $Grid->leave_category->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->leave_category->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_balance" data-field="x_leave_category" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_leave_category" id="o<?= $Grid->RowIndex ?>_leave_category" value="<?= HtmlEncode($Grid->leave_category->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_leave_category" class="el_leave_balance_leave_category">
<input type="<?= $Grid->leave_category->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_leave_category" id="x<?= $Grid->RowIndex ?>_leave_category" data-table="leave_balance" data-field="x_leave_category" value="<?= $Grid->leave_category->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->leave_category->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->leave_category->formatPattern()) ?>"<?= $Grid->leave_category->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->leave_category->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_leave_category" class="el_leave_balance_leave_category">
<span<?= $Grid->leave_category->viewAttributes() ?>>
<?= $Grid->leave_category->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_balance" data-field="x_leave_category" data-hidden="1" name="fleave_balancegrid$x<?= $Grid->RowIndex ?>_leave_category" id="fleave_balancegrid$x<?= $Grid->RowIndex ?>_leave_category" value="<?= HtmlEncode($Grid->leave_category->FormValue) ?>">
<input type="hidden" data-table="leave_balance" data-field="x_leave_category" data-hidden="1" data-old name="fleave_balancegrid$o<?= $Grid->RowIndex ?>_leave_category" id="fleave_balancegrid$o<?= $Grid->RowIndex ?>_leave_category" value="<?= HtmlEncode($Grid->leave_category->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->maximum_days->Visible) { // maximum_days ?>
        <td data-name="maximum_days"<?= $Grid->maximum_days->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_maximum_days" class="el_leave_balance_maximum_days">
<input type="<?= $Grid->maximum_days->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_maximum_days" id="x<?= $Grid->RowIndex ?>_maximum_days" data-table="leave_balance" data-field="x_maximum_days" value="<?= $Grid->maximum_days->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->maximum_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->maximum_days->formatPattern()) ?>"<?= $Grid->maximum_days->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->maximum_days->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_balance" data-field="x_maximum_days" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_maximum_days" id="o<?= $Grid->RowIndex ?>_maximum_days" value="<?= HtmlEncode($Grid->maximum_days->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_maximum_days" class="el_leave_balance_maximum_days">
<input type="<?= $Grid->maximum_days->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_maximum_days" id="x<?= $Grid->RowIndex ?>_maximum_days" data-table="leave_balance" data-field="x_maximum_days" value="<?= $Grid->maximum_days->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->maximum_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->maximum_days->formatPattern()) ?>"<?= $Grid->maximum_days->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->maximum_days->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_maximum_days" class="el_leave_balance_maximum_days">
<span<?= $Grid->maximum_days->viewAttributes() ?>>
<?= $Grid->maximum_days->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_balance" data-field="x_maximum_days" data-hidden="1" name="fleave_balancegrid$x<?= $Grid->RowIndex ?>_maximum_days" id="fleave_balancegrid$x<?= $Grid->RowIndex ?>_maximum_days" value="<?= HtmlEncode($Grid->maximum_days->FormValue) ?>">
<input type="hidden" data-table="leave_balance" data-field="x_maximum_days" data-hidden="1" data-old name="fleave_balancegrid$o<?= $Grid->RowIndex ?>_maximum_days" id="fleave_balancegrid$o<?= $Grid->RowIndex ?>_maximum_days" value="<?= HtmlEncode($Grid->maximum_days->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->days_balance->Visible) { // days_balance ?>
        <td data-name="days_balance"<?= $Grid->days_balance->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_days_balance" class="el_leave_balance_days_balance">
<input type="<?= $Grid->days_balance->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_balance" id="x<?= $Grid->RowIndex ?>_days_balance" data-table="leave_balance" data-field="x_days_balance" value="<?= $Grid->days_balance->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_balance->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_balance->formatPattern()) ?>"<?= $Grid->days_balance->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_balance->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_balance" data-field="x_days_balance" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_days_balance" id="o<?= $Grid->RowIndex ?>_days_balance" value="<?= HtmlEncode($Grid->days_balance->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_days_balance" class="el_leave_balance_days_balance">
<input type="<?= $Grid->days_balance->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_balance" id="x<?= $Grid->RowIndex ?>_days_balance" data-table="leave_balance" data-field="x_days_balance" value="<?= $Grid->days_balance->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_balance->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_balance->formatPattern()) ?>"<?= $Grid->days_balance->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_balance->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_balance_days_balance" class="el_leave_balance_days_balance">
<span<?= $Grid->days_balance->viewAttributes() ?>>
<?= $Grid->days_balance->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_balance" data-field="x_days_balance" data-hidden="1" name="fleave_balancegrid$x<?= $Grid->RowIndex ?>_days_balance" id="fleave_balancegrid$x<?= $Grid->RowIndex ?>_days_balance" value="<?= HtmlEncode($Grid->days_balance->FormValue) ?>">
<input type="hidden" data-table="leave_balance" data-field="x_days_balance" data-hidden="1" data-old name="fleave_balancegrid$o<?= $Grid->RowIndex ?>_days_balance" id="fleave_balancegrid$o<?= $Grid->RowIndex ?>_days_balance" value="<?= HtmlEncode($Grid->days_balance->OldValue) ?>">
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
loadjs.ready(["fleave_balancegrid","load"], () => fleave_balancegrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fleave_balancegrid">
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
    ew.addEventHandlers("leave_balance");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
