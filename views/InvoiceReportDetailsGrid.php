<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("InvoiceReportDetailsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var finvoice_report_detailsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { invoice_report_details: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoice_report_detailsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["item", [fields.item.visible && fields.item.required ? ew.Validators.required(fields.item.caption) : null], fields.item.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid],
            ["total_amount", [fields.total_amount.visible && fields.total_amount.required ? ew.Validators.required(fields.total_amount.caption) : null, ew.Validators.float], fields.total_amount.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["item",false],["quantity",false],["cost",false],["total_amount",false]];
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
<div id="finvoice_report_detailsgrid" class="ew-form ew-list-form">
<div id="gmp_invoice_report_details" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_invoice_report_detailsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->item->Visible) { // item ?>
        <th data-name="item" class="<?= $Grid->item->headerCellClass() ?>"><div id="elh_invoice_report_details_item" class="invoice_report_details_item"><?= $Grid->renderFieldHeader($Grid->item) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_invoice_report_details_quantity" class="invoice_report_details_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->cost->Visible) { // cost ?>
        <th data-name="cost" class="<?= $Grid->cost->headerCellClass() ?>"><div id="elh_invoice_report_details_cost" class="invoice_report_details_cost"><?= $Grid->renderFieldHeader($Grid->cost) ?></div></th>
<?php } ?>
<?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <th data-name="total_amount" class="<?= $Grid->total_amount->headerCellClass() ?>"><div id="elh_invoice_report_details_total_amount" class="invoice_report_details_total_amount"><?= $Grid->renderFieldHeader($Grid->total_amount) ?></div></th>
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
    <?php if ($Grid->item->Visible) { // item ?>
        <td data-name="item"<?= $Grid->item->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_item" class="el_invoice_report_details_item">
<input type="<?= $Grid->item->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_item" id="x<?= $Grid->RowIndex ?>_item" data-table="invoice_report_details" data-field="x_item" value="<?= $Grid->item->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->item->formatPattern()) ?>"<?= $Grid->item->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->item->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="invoice_report_details" data-field="x_item" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_item" id="o<?= $Grid->RowIndex ?>_item" value="<?= HtmlEncode($Grid->item->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_item" class="el_invoice_report_details_item">
<input type="<?= $Grid->item->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_item" id="x<?= $Grid->RowIndex ?>_item" data-table="invoice_report_details" data-field="x_item" value="<?= $Grid->item->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Grid->item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->item->formatPattern()) ?>"<?= $Grid->item->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->item->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_item" class="el_invoice_report_details_item">
<span<?= $Grid->item->viewAttributes() ?>>
<?= $Grid->item->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoice_report_details" data-field="x_item" data-hidden="1" name="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_item" id="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_item" value="<?= HtmlEncode($Grid->item->FormValue) ?>">
<input type="hidden" data-table="invoice_report_details" data-field="x_item" data-hidden="1" data-old name="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_item" id="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_item" value="<?= HtmlEncode($Grid->item->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_quantity" class="el_invoice_report_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="invoice_report_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="invoice_report_details" data-field="x_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_quantity" class="el_invoice_report_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="invoice_report_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_quantity" class="el_invoice_report_details_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoice_report_details" data-field="x_quantity" data-hidden="1" name="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" id="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="invoice_report_details" data-field="x_quantity" data-hidden="1" data-old name="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" id="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cost->Visible) { // cost ?>
        <td data-name="cost"<?= $Grid->cost->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_cost" class="el_invoice_report_details_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="invoice_report_details" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="invoice_report_details" data-field="x_cost" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_cost" id="o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_cost" class="el_invoice_report_details_cost">
<input type="<?= $Grid->cost->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cost" id="x<?= $Grid->RowIndex ?>_cost" data-table="invoice_report_details" data-field="x_cost" value="<?= $Grid->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->cost->formatPattern()) ?>"<?= $Grid->cost->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cost->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_cost" class="el_invoice_report_details_cost">
<span<?= $Grid->cost->viewAttributes() ?>>
<?= $Grid->cost->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoice_report_details" data-field="x_cost" data-hidden="1" name="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_cost" id="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->FormValue) ?>">
<input type="hidden" data-table="invoice_report_details" data-field="x_cost" data-hidden="1" data-old name="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_cost" id="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_cost" value="<?= HtmlEncode($Grid->cost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <td data-name="total_amount"<?= $Grid->total_amount->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_total_amount" class="el_invoice_report_details_total_amount">
<input type="<?= $Grid->total_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_amount" id="x<?= $Grid->RowIndex ?>_total_amount" data-table="invoice_report_details" data-field="x_total_amount" value="<?= $Grid->total_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_amount->formatPattern()) ?>"<?= $Grid->total_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_amount->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="invoice_report_details" data-field="x_total_amount" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_total_amount" id="o<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_total_amount" class="el_invoice_report_details_total_amount">
<input type="<?= $Grid->total_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total_amount" id="x<?= $Grid->RowIndex ?>_total_amount" data-table="invoice_report_details" data-field="x_total_amount" value="<?= $Grid->total_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->total_amount->formatPattern()) ?>"<?= $Grid->total_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total_amount->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoice_report_details_total_amount" class="el_invoice_report_details_total_amount">
<span<?= $Grid->total_amount->viewAttributes() ?>>
<?= $Grid->total_amount->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoice_report_details" data-field="x_total_amount" data-hidden="1" name="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_total_amount" id="finvoice_report_detailsgrid$x<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->FormValue) ?>">
<input type="hidden" data-table="invoice_report_details" data-field="x_total_amount" data-hidden="1" data-old name="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_total_amount" id="finvoice_report_detailsgrid$o<?= $Grid->RowIndex ?>_total_amount" value="<?= HtmlEncode($Grid->total_amount->OldValue) ?>">
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
loadjs.ready(["finvoice_report_detailsgrid","load"], () => finvoice_report_detailsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
    <?php if ($Grid->item->Visible) { // item ?>
        <td data-name="item" class="<?= $Grid->item->footerCellClass() ?>"><span id="elf_invoice_report_details_item" class="invoice_report_details_item">
        </span></td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity" class="<?= $Grid->quantity->footerCellClass() ?>"><span id="elf_invoice_report_details_quantity" class="invoice_report_details_quantity">
        </span></td>
    <?php } ?>
    <?php if ($Grid->cost->Visible) { // cost ?>
        <td data-name="cost" class="<?= $Grid->cost->footerCellClass() ?>"><span id="elf_invoice_report_details_cost" class="invoice_report_details_cost">
        </span></td>
    <?php } ?>
    <?php if ($Grid->total_amount->Visible) { // total_amount ?>
        <td data-name="total_amount" class="<?= $Grid->total_amount->footerCellClass() ?>"><span id="elf_invoice_report_details_total_amount" class="invoice_report_details_total_amount">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->total_amount->ViewValue ?></span>
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
<input type="hidden" name="detailpage" value="finvoice_report_detailsgrid">
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
    ew.addEventHandlers("invoice_report_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
