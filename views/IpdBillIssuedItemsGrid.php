<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("IpdBillIssuedItemsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fipd_bill_issued_itemsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { ipd_bill_issued_items: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fipd_bill_issued_itemsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null], fields.admission_id.isInvalid],
            ["item_title", [fields.item_title.visible && fields.item_title.required ? ew.Validators.required(fields.item_title.caption) : null], fields.item_title.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["selling_price", [fields.selling_price.visible && fields.selling_price.required ? ew.Validators.required(fields.selling_price.caption) : null, ew.Validators.float], fields.selling_price.isInvalid],
            ["line_total", [fields.line_total.visible && fields.line_total.required ? ew.Validators.required(fields.line_total.caption) : null, ew.Validators.float], fields.line_total.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["item_title",false],["quantity",false],["selling_price",false],["line_total",false]];
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
<div id="fipd_bill_issued_itemsgrid" class="ew-form ew-list-form">
<div id="gmp_ipd_bill_issued_items" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_ipd_bill_issued_itemsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="admission_id" class="<?= $Grid->admission_id->headerCellClass() ?>"><div id="elh_ipd_bill_issued_items_admission_id" class="ipd_bill_issued_items_admission_id"><?= $Grid->renderFieldHeader($Grid->admission_id) ?></div></th>
<?php } ?>
<?php if ($Grid->item_title->Visible) { // item_title ?>
        <th data-name="item_title" class="<?= $Grid->item_title->headerCellClass() ?>"><div id="elh_ipd_bill_issued_items_item_title" class="ipd_bill_issued_items_item_title"><?= $Grid->renderFieldHeader($Grid->item_title) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_ipd_bill_issued_items_quantity" class="ipd_bill_issued_items_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->selling_price->Visible) { // selling_price ?>
        <th data-name="selling_price" class="<?= $Grid->selling_price->headerCellClass() ?>"><div id="elh_ipd_bill_issued_items_selling_price" class="ipd_bill_issued_items_selling_price"><?= $Grid->renderFieldHeader($Grid->selling_price) ?></div></th>
<?php } ?>
<?php if ($Grid->line_total->Visible) { // line_total ?>
        <th data-name="line_total" class="<?= $Grid->line_total->headerCellClass() ?>"><div id="elh_ipd_bill_issued_items_line_total" class="ipd_bill_issued_items_line_total"><?= $Grid->renderFieldHeader($Grid->line_total) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_admission_id" class="el_ipd_bill_issued_items_admission_id"></span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_admission_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_id" id="o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_admission_id" class="el_ipd_bill_issued_items_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->EditValue))) ?>"></span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_admission_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_admission_id" class="el_ipd_bill_issued_items_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<?= $Grid->admission_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_admission_id" data-hidden="1" name="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_admission_id" id="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->FormValue) ?>">
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_admission_id" data-hidden="1" data-old name="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_admission_id" id="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="ipd_bill_issued_items" data-field="x_admission_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->item_title->Visible) { // item_title ?>
        <td data-name="item_title"<?= $Grid->item_title->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_item_title" class="el_ipd_bill_issued_items_item_title">
<input type="<?= $Grid->item_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_item_title" id="x<?= $Grid->RowIndex ?>_item_title" data-table="ipd_bill_issued_items" data-field="x_item_title" value="<?= $Grid->item_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->item_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->item_title->formatPattern()) ?>"<?= $Grid->item_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->item_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_item_title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_item_title" id="o<?= $Grid->RowIndex ?>_item_title" value="<?= HtmlEncode($Grid->item_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_item_title" class="el_ipd_bill_issued_items_item_title">
<input type="<?= $Grid->item_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_item_title" id="x<?= $Grid->RowIndex ?>_item_title" data-table="ipd_bill_issued_items" data-field="x_item_title" value="<?= $Grid->item_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->item_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->item_title->formatPattern()) ?>"<?= $Grid->item_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->item_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_item_title" class="el_ipd_bill_issued_items_item_title">
<span<?= $Grid->item_title->viewAttributes() ?>>
<?= $Grid->item_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_item_title" data-hidden="1" name="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_item_title" id="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_item_title" value="<?= HtmlEncode($Grid->item_title->FormValue) ?>">
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_item_title" data-hidden="1" data-old name="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_item_title" id="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_item_title" value="<?= HtmlEncode($Grid->item_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_quantity" class="el_ipd_bill_issued_items_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="ipd_bill_issued_items" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_quantity" class="el_ipd_bill_issued_items_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="ipd_bill_issued_items" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_quantity" class="el_ipd_bill_issued_items_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_quantity" data-hidden="1" name="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_quantity" id="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_quantity" data-hidden="1" data-old name="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_quantity" id="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->selling_price->Visible) { // selling_price ?>
        <td data-name="selling_price"<?= $Grid->selling_price->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_selling_price" class="el_ipd_bill_issued_items_selling_price">
<input type="<?= $Grid->selling_price->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price" id="x<?= $Grid->RowIndex ?>_selling_price" data-table="ipd_bill_issued_items" data-field="x_selling_price" value="<?= $Grid->selling_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price->formatPattern()) ?>"<?= $Grid->selling_price->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_selling_price" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_selling_price" id="o<?= $Grid->RowIndex ?>_selling_price" value="<?= HtmlEncode($Grid->selling_price->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_selling_price" class="el_ipd_bill_issued_items_selling_price">
<input type="<?= $Grid->selling_price->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price" id="x<?= $Grid->RowIndex ?>_selling_price" data-table="ipd_bill_issued_items" data-field="x_selling_price" value="<?= $Grid->selling_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price->formatPattern()) ?>"<?= $Grid->selling_price->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_selling_price" class="el_ipd_bill_issued_items_selling_price">
<span<?= $Grid->selling_price->viewAttributes() ?>>
<?= $Grid->selling_price->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_selling_price" data-hidden="1" name="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_selling_price" id="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_selling_price" value="<?= HtmlEncode($Grid->selling_price->FormValue) ?>">
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_selling_price" data-hidden="1" data-old name="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_selling_price" id="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_selling_price" value="<?= HtmlEncode($Grid->selling_price->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total"<?= $Grid->line_total->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_line_total" class="el_ipd_bill_issued_items_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="ipd_bill_issued_items" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_line_total" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_line_total" id="o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_line_total" class="el_ipd_bill_issued_items_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="ipd_bill_issued_items" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_ipd_bill_issued_items_line_total" class="el_ipd_bill_issued_items_line_total">
<span<?= $Grid->line_total->viewAttributes() ?>>
<?= $Grid->line_total->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_line_total" data-hidden="1" name="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_line_total" id="fipd_bill_issued_itemsgrid$x<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->FormValue) ?>">
<input type="hidden" data-table="ipd_bill_issued_items" data-field="x_line_total" data-hidden="1" data-old name="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_line_total" id="fipd_bill_issued_itemsgrid$o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
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
loadjs.ready(["fipd_bill_issued_itemsgrid","load"], () => fipd_bill_issued_itemsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
        <td data-name="admission_id" class="<?= $Grid->admission_id->footerCellClass() ?>"><span id="elf_ipd_bill_issued_items_admission_id" class="ipd_bill_issued_items_admission_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->item_title->Visible) { // item_title ?>
        <td data-name="item_title" class="<?= $Grid->item_title->footerCellClass() ?>"><span id="elf_ipd_bill_issued_items_item_title" class="ipd_bill_issued_items_item_title">
        </span></td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity" class="<?= $Grid->quantity->footerCellClass() ?>"><span id="elf_ipd_bill_issued_items_quantity" class="ipd_bill_issued_items_quantity">
        </span></td>
    <?php } ?>
    <?php if ($Grid->selling_price->Visible) { // selling_price ?>
        <td data-name="selling_price" class="<?= $Grid->selling_price->footerCellClass() ?>"><span id="elf_ipd_bill_issued_items_selling_price" class="ipd_bill_issued_items_selling_price">
        </span></td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total" class="<?= $Grid->line_total->footerCellClass() ?>"><span id="elf_ipd_bill_issued_items_line_total" class="ipd_bill_issued_items_line_total">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->line_total->ViewValue ?></span>
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
<input type="hidden" name="detailpage" value="fipd_bill_issued_itemsgrid">
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
    ew.addEventHandlers("ipd_bill_issued_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
