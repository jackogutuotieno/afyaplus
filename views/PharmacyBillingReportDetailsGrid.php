<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PharmacyBillingReportDetailsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpharmacy_billing_report_detailsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { pharmacy_billing_report_details: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpharmacy_billing_report_detailsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["medicine_dispensation_id", [fields.medicine_dispensation_id.visible && fields.medicine_dispensation_id.required ? ew.Validators.required(fields.medicine_dispensation_id.caption) : null, ew.Validators.integer], fields.medicine_dispensation_id.isInvalid],
            ["brand_name", [fields.brand_name.visible && fields.brand_name.required ? ew.Validators.required(fields.brand_name.caption) : null], fields.brand_name.isInvalid],
            ["selling_price_per_unit", [fields.selling_price_per_unit.visible && fields.selling_price_per_unit.required ? ew.Validators.required(fields.selling_price_per_unit.caption) : null, ew.Validators.float], fields.selling_price_per_unit.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["line_total", [fields.line_total.visible && fields.line_total.required ? ew.Validators.required(fields.line_total.caption) : null, ew.Validators.float], fields.line_total.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["medicine_dispensation_id",false],["brand_name",false],["selling_price_per_unit",false],["quantity",false],["line_total",false]];
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
<div id="fpharmacy_billing_report_detailsgrid" class="ew-form ew-list-form">
<div id="gmp_pharmacy_billing_report_details" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_pharmacy_billing_report_detailsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_id" class="pharmacy_billing_report_details_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
        <th data-name="medicine_dispensation_id" class="<?= $Grid->medicine_dispensation_id->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_medicine_dispensation_id" class="pharmacy_billing_report_details_medicine_dispensation_id"><?= $Grid->renderFieldHeader($Grid->medicine_dispensation_id) ?></div></th>
<?php } ?>
<?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <th data-name="brand_name" class="<?= $Grid->brand_name->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_brand_name" class="pharmacy_billing_report_details_brand_name"><?= $Grid->renderFieldHeader($Grid->brand_name) ?></div></th>
<?php } ?>
<?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <th data-name="selling_price_per_unit" class="<?= $Grid->selling_price_per_unit->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_selling_price_per_unit" class="pharmacy_billing_report_details_selling_price_per_unit"><?= $Grid->renderFieldHeader($Grid->selling_price_per_unit) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_quantity" class="pharmacy_billing_report_details_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->line_total->Visible) { // line_total ?>
        <th data-name="line_total" class="<?= $Grid->line_total->headerCellClass() ?>"><div id="elh_pharmacy_billing_report_details_line_total" class="pharmacy_billing_report_details_line_total"><?= $Grid->renderFieldHeader($Grid->line_total) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_id" class="el_pharmacy_billing_report_details_id"></span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_id" class="el_pharmacy_billing_report_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_id" class="el_pharmacy_billing_report_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_id" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_id" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_id" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_id" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
        <td data-name="medicine_dispensation_id"<?= $Grid->medicine_dispensation_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->medicine_dispensation_id->getSessionValue() != "") { ?>
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->medicine_dispensation_id->getDisplayValue($Grid->medicine_dispensation_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_medicine_dispensation_id" class="el_pharmacy_billing_report_details_medicine_dispensation_id">
<input type="<?= $Grid->medicine_dispensation_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" data-table="pharmacy_billing_report_details" data-field="x_medicine_dispensation_id" value="<?= $Grid->medicine_dispensation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->medicine_dispensation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->medicine_dispensation_id->formatPattern()) ?>"<?= $Grid->medicine_dispensation_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->medicine_dispensation_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_medicine_dispensation_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="o<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->medicine_dispensation_id->getSessionValue() != "") { ?>
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->medicine_dispensation_id->getDisplayValue($Grid->medicine_dispensation_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_medicine_dispensation_id" class="el_pharmacy_billing_report_details_medicine_dispensation_id">
<input type="<?= $Grid->medicine_dispensation_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" data-table="pharmacy_billing_report_details" data-field="x_medicine_dispensation_id" value="<?= $Grid->medicine_dispensation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->medicine_dispensation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->medicine_dispensation_id->formatPattern()) ?>"<?= $Grid->medicine_dispensation_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->medicine_dispensation_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_medicine_dispensation_id" class="el_pharmacy_billing_report_details_medicine_dispensation_id">
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<?= $Grid->medicine_dispensation_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_medicine_dispensation_id" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_medicine_dispensation_id" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <td data-name="brand_name"<?= $Grid->brand_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_brand_name" class="el_pharmacy_billing_report_details_brand_name">
<input type="<?= $Grid->brand_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_brand_name" id="x<?= $Grid->RowIndex ?>_brand_name" data-table="pharmacy_billing_report_details" data-field="x_brand_name" value="<?= $Grid->brand_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->brand_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->brand_name->formatPattern()) ?>"<?= $Grid->brand_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->brand_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_brand_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_brand_name" id="o<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_brand_name" class="el_pharmacy_billing_report_details_brand_name">
<input type="<?= $Grid->brand_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_brand_name" id="x<?= $Grid->RowIndex ?>_brand_name" data-table="pharmacy_billing_report_details" data-field="x_brand_name" value="<?= $Grid->brand_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->brand_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->brand_name->formatPattern()) ?>"<?= $Grid->brand_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->brand_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_brand_name" class="el_pharmacy_billing_report_details_brand_name">
<span<?= $Grid->brand_name->viewAttributes() ?>>
<?= $Grid->brand_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_brand_name" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_brand_name" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_brand_name" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_brand_name" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_brand_name" value="<?= HtmlEncode($Grid->brand_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <td data-name="selling_price_per_unit"<?= $Grid->selling_price_per_unit->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_selling_price_per_unit" class="el_pharmacy_billing_report_details_selling_price_per_unit">
<input type="<?= $Grid->selling_price_per_unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="x<?= $Grid->RowIndex ?>_selling_price_per_unit" data-table="pharmacy_billing_report_details" data-field="x_selling_price_per_unit" value="<?= $Grid->selling_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price_per_unit->formatPattern()) ?>"<?= $Grid->selling_price_per_unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price_per_unit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_selling_price_per_unit" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_selling_price_per_unit" id="o<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_selling_price_per_unit" class="el_pharmacy_billing_report_details_selling_price_per_unit">
<input type="<?= $Grid->selling_price_per_unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="x<?= $Grid->RowIndex ?>_selling_price_per_unit" data-table="pharmacy_billing_report_details" data-field="x_selling_price_per_unit" value="<?= $Grid->selling_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->selling_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->selling_price_per_unit->formatPattern()) ?>"<?= $Grid->selling_price_per_unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->selling_price_per_unit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_selling_price_per_unit" class="el_pharmacy_billing_report_details_selling_price_per_unit">
<span<?= $Grid->selling_price_per_unit->viewAttributes() ?>>
<?= $Grid->selling_price_per_unit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_selling_price_per_unit" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_selling_price_per_unit" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_selling_price_per_unit" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_selling_price_per_unit" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_selling_price_per_unit" value="<?= HtmlEncode($Grid->selling_price_per_unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_quantity" class="el_pharmacy_billing_report_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="pharmacy_billing_report_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_quantity" class="el_pharmacy_billing_report_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="pharmacy_billing_report_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_quantity" class="el_pharmacy_billing_report_details_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_quantity" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_quantity" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total"<?= $Grid->line_total->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_line_total" class="el_pharmacy_billing_report_details_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="pharmacy_billing_report_details" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_line_total" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_line_total" id="o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_line_total" class="el_pharmacy_billing_report_details_line_total">
<input type="<?= $Grid->line_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_line_total" id="x<?= $Grid->RowIndex ?>_line_total" data-table="pharmacy_billing_report_details" data-field="x_line_total" value="<?= $Grid->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->line_total->formatPattern()) ?>"<?= $Grid->line_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->line_total->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_pharmacy_billing_report_details_line_total" class="el_pharmacy_billing_report_details_line_total">
<span<?= $Grid->line_total->viewAttributes() ?>>
<?= $Grid->line_total->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_line_total" data-hidden="1" name="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_line_total" id="fpharmacy_billing_report_detailsgrid$x<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->FormValue) ?>">
<input type="hidden" data-table="pharmacy_billing_report_details" data-field="x_line_total" data-hidden="1" data-old name="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_line_total" id="fpharmacy_billing_report_detailsgrid$o<?= $Grid->RowIndex ?>_line_total" value="<?= HtmlEncode($Grid->line_total->OldValue) ?>">
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
loadjs.ready(["fpharmacy_billing_report_detailsgrid","load"], () => fpharmacy_billing_report_detailsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id" class="<?= $Grid->id->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_id" class="pharmacy_billing_report_details_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
        <td data-name="medicine_dispensation_id" class="<?= $Grid->medicine_dispensation_id->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_medicine_dispensation_id" class="pharmacy_billing_report_details_medicine_dispensation_id">
        </span></td>
    <?php } ?>
    <?php if ($Grid->brand_name->Visible) { // brand_name ?>
        <td data-name="brand_name" class="<?= $Grid->brand_name->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_brand_name" class="pharmacy_billing_report_details_brand_name">
        </span></td>
    <?php } ?>
    <?php if ($Grid->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <td data-name="selling_price_per_unit" class="<?= $Grid->selling_price_per_unit->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_selling_price_per_unit" class="pharmacy_billing_report_details_selling_price_per_unit">
        </span></td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity" class="<?= $Grid->quantity->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_quantity" class="pharmacy_billing_report_details_quantity">
        </span></td>
    <?php } ?>
    <?php if ($Grid->line_total->Visible) { // line_total ?>
        <td data-name="line_total" class="<?= $Grid->line_total->footerCellClass() ?>"><span id="elf_pharmacy_billing_report_details_line_total" class="pharmacy_billing_report_details_line_total">
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
<input type="hidden" name="detailpage" value="fpharmacy_billing_report_detailsgrid">
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
    ew.addEventHandlers("pharmacy_billing_report_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
