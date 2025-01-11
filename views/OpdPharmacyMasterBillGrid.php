<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("OpdPharmacyMasterBillGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fopd_pharmacy_master_billgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { opd_pharmacy_master_bill: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fopd_pharmacy_master_billgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["brand_name", [fields.brand_name.visible && fields.brand_name.required ? ew.Validators.required(fields.brand_name.caption) : null], fields.brand_name.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["selling_price_per_unit", [fields.selling_price_per_unit.visible && fields.selling_price_per_unit.required ? ew.Validators.required(fields.selling_price_per_unit.caption) : null, ew.Validators.float], fields.selling_price_per_unit.isInvalid],
            ["line_total", [fields.line_total.visible && fields.line_total.required ? ew.Validators.required(fields.line_total.caption) : null, ew.Validators.float], fields.line_total.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["brand_name",false],["quantity",false],["selling_price_per_unit",false],["line_total",false]];
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
<div id="fopd_pharmacy_master_billgrid" class="ew-form ew-list-form">
<div id="gmp_opd_pharmacy_master_bill" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_opd_pharmacy_master_billgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <th data-name="brand_name" class="<?= $Grid->brand_name->headerCellClass() ?>"><div id="elh_opd_pharmacy_master_bill_brand_name" class="opd_pharmacy_master_bill_brand_name"><?= $Grid->renderFieldHeader($Grid->brand_name) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_opd_pharmacy_master_bill_quantity" class="opd_pharmacy_master_bill_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <th data-name="selling_price_per_unit" class="<?= $Grid->selling_price_per_unit->headerCellClass() ?>"><div id="elh_opd_pharmacy_master_bill_selling_price_per_unit" class="opd_pharmacy_master_bill_selling_price_per_unit"><?= $Grid->renderFieldHeader($Grid->selling_price_per_unit) ?></div></th>
<?php } ?>
<?php if ($Grid->line_total->Visible) { // line_total ?>
        <th data-name="line_total" class="<?= $Grid->line_total->headerCellClass() ?>"><div id="elh_opd_pharmacy_master_bill_line_total" class="opd_pharmacy_master_bill_line_total"><?= $Grid->renderFieldHeader($Grid->line_total) ?></div></th>
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
    <?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <td data-name="brand_name"<?= $Grid->brand_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_brand_name" class="el_opd_pharmacy_master_bill_brand_name">
<input type="<?= $Grid->brand_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_brand_name" id="x<?= $Grid->RowIndex ?>_brand_name" data-table="opd_pharmacy_master_bill" data-field="x_brand_name" value="<?= $Grid->brand_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->brand_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->brand_name->formatPattern()) ?>"<?= $Grid->brand_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->brand_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_brand_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_brand_name" id="o<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_brand_name" class="el_opd_pharmacy_master_bill_brand_name">
<input type="<?= $Grid->brand_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_brand_name" id="x<?= $Grid->RowIndex ?>_brand_name" data-table="opd_pharmacy_master_bill" data-field="x_brand_name" value="<?= $Grid->brand_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->brand_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->brand_name->formatPattern()) ?>"<?= $Grid->brand_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->brand_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_brand_name" class="el_opd_pharmacy_master_bill_brand_name">
<span<?= $Grid->brand_name->viewAttributes() ?>>
<?= $Grid->brand_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_brand_name" data-hidden="1" name="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_brand_name" id="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->FormValue) ?>">
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_brand_name" data-hidden="1" data-old name="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_brand_name" id="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_quantity" class="el_opd_pharmacy_master_bill_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="opd_pharmacy_master_bill" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_quantity" class="el_opd_pharmacy_master_bill_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="opd_pharmacy_master_bill" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_quantity" class="el_opd_pharmacy_master_bill_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_quantity" data-hidden="1" name="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_quantity" id="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_quantity" data-hidden="1" data-old name="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_quantity" id="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <td data-name="selling_price_per_unit"<?= $Grid->selling_price_per_unit->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_selling_price_per_unit" class="el_opd_pharmacy_master_bill_selling_price_per_unit">
<input type="<?= $Grid->selling_price_per_unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="x<?= $Grid->RowIndex ?>_selling_price_per_unit" data-table="opd_pharmacy_master_bill" data-field="x_selling_price_per_unit" value="<?= $Grid->selling_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price_per_unit->formatPattern()) ?>"<?= $Grid->selling_price_per_unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price_per_unit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_selling_price_per_unit" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_selling_price_per_unit" id="o<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_selling_price_per_unit" class="el_opd_pharmacy_master_bill_selling_price_per_unit">
<input type="<?= $Grid->selling_price_per_unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="x<?= $Grid->RowIndex ?>_selling_price_per_unit" data-table="opd_pharmacy_master_bill" data-field="x_selling_price_per_unit" value="<?= $Grid->selling_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price_per_unit->formatPattern()) ?>"<?= $Grid->selling_price_per_unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price_per_unit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_selling_price_per_unit" class="el_opd_pharmacy_master_bill_selling_price_per_unit">
<span<?= $Grid->selling_price_per_unit->viewAttributes() ?>>
<?= $Grid->selling_price_per_unit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_selling_price_per_unit" data-hidden="1" name="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->FormValue) ?>">
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_selling_price_per_unit" data-hidden="1" data-old name="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_selling_price_per_unit" id="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total"<?= $Grid->line_total->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_line_total" class="el_opd_pharmacy_master_bill_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="opd_pharmacy_master_bill" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_line_total" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_line_total" id="o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_line_total" class="el_opd_pharmacy_master_bill_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="opd_pharmacy_master_bill" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_opd_pharmacy_master_bill_line_total" class="el_opd_pharmacy_master_bill_line_total">
<span<?= $Grid->line_total->viewAttributes() ?>>
<?= $Grid->line_total->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_line_total" data-hidden="1" name="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_line_total" id="fopd_pharmacy_master_billgrid$x<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->FormValue) ?>">
<input type="hidden" data-table="opd_pharmacy_master_bill" data-field="x_line_total" data-hidden="1" data-old name="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_line_total" id="fopd_pharmacy_master_billgrid$o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
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
loadjs.ready(["fopd_pharmacy_master_billgrid","load"], () => fopd_pharmacy_master_billgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
    <?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <td data-name="brand_name" class="<?= $Grid->brand_name->footerCellClass() ?>"><span id="elf_opd_pharmacy_master_bill_brand_name" class="opd_pharmacy_master_bill_brand_name">
        </span></td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity" class="<?= $Grid->quantity->footerCellClass() ?>"><span id="elf_opd_pharmacy_master_bill_quantity" class="opd_pharmacy_master_bill_quantity">
        </span></td>
    <?php } ?>
    <?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <td data-name="selling_price_per_unit" class="<?= $Grid->selling_price_per_unit->footerCellClass() ?>"><span id="elf_opd_pharmacy_master_bill_selling_price_per_unit" class="opd_pharmacy_master_bill_selling_price_per_unit">
        </span></td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total" class="<?= $Grid->line_total->footerCellClass() ?>"><span id="elf_opd_pharmacy_master_bill_line_total" class="opd_pharmacy_master_bill_line_total">
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
<input type="hidden" name="detailpage" value="fopd_pharmacy_master_billgrid">
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
    ew.addEventHandlers("opd_pharmacy_master_bill");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
