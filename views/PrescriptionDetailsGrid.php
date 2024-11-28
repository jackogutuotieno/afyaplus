<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PrescriptionDetailsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fprescription_detailsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { prescription_details: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprescription_detailsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null, ew.Validators.integer], fields.prescription_id.isInvalid],
            ["medicine_stock_id", [fields.medicine_stock_id.visible && fields.medicine_stock_id.required ? ew.Validators.required(fields.medicine_stock_id.caption) : null], fields.medicine_stock_id.isInvalid],
            ["dose_quantity", [fields.dose_quantity.visible && fields.dose_quantity.required ? ew.Validators.required(fields.dose_quantity.caption) : null, ew.Validators.integer], fields.dose_quantity.isInvalid],
            ["dose_type", [fields.dose_type.visible && fields.dose_type.required ? ew.Validators.required(fields.dose_type.caption) : null], fields.dose_type.isInvalid],
            ["dose_interval", [fields.dose_interval.visible && fields.dose_interval.required ? ew.Validators.required(fields.dose_interval.caption) : null], fields.dose_interval.isInvalid],
            ["number_of_days", [fields.number_of_days.visible && fields.number_of_days.required ? ew.Validators.required(fields.number_of_days.caption) : null, ew.Validators.integer], fields.number_of_days.isInvalid],
            ["method", [fields.method.visible && fields.method.required ? ew.Validators.required(fields.method.caption) : null], fields.method.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["prescription_id",false],["medicine_stock_id",false],["dose_quantity",false],["dose_type",false],["dose_interval",false],["number_of_days",false],["method",false]];
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
            "medicine_stock_id": <?= $Grid->medicine_stock_id->toClientList($Grid) ?>,
            "dose_type": <?= $Grid->dose_type->toClientList($Grid) ?>,
            "dose_interval": <?= $Grid->dose_interval->toClientList($Grid) ?>,
            "number_of_days": <?= $Grid->number_of_days->toClientList($Grid) ?>,
            "method": <?= $Grid->method->toClientList($Grid) ?>,
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
<div id="fprescription_detailsgrid" class="ew-form ew-list-form">
<div id="gmp_prescription_details" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_prescription_detailsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_prescription_details_id" class="prescription_details_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <th data-name="prescription_id" class="<?= $Grid->prescription_id->headerCellClass() ?>"><div id="elh_prescription_details_prescription_id" class="prescription_details_prescription_id"><?= $Grid->renderFieldHeader($Grid->prescription_id) ?></div></th>
<?php } ?>
<?php if ($Grid->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <th data-name="medicine_stock_id" class="<?= $Grid->medicine_stock_id->headerCellClass() ?>"><div id="elh_prescription_details_medicine_stock_id" class="prescription_details_medicine_stock_id"><?= $Grid->renderFieldHeader($Grid->medicine_stock_id) ?></div></th>
<?php } ?>
<?php if ($Grid->dose_quantity->Visible) { // dose_quantity ?>
        <th data-name="dose_quantity" class="<?= $Grid->dose_quantity->headerCellClass() ?>"><div id="elh_prescription_details_dose_quantity" class="prescription_details_dose_quantity"><?= $Grid->renderFieldHeader($Grid->dose_quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->dose_type->Visible) { // dose_type ?>
        <th data-name="dose_type" class="<?= $Grid->dose_type->headerCellClass() ?>"><div id="elh_prescription_details_dose_type" class="prescription_details_dose_type"><?= $Grid->renderFieldHeader($Grid->dose_type) ?></div></th>
<?php } ?>
<?php if ($Grid->dose_interval->Visible) { // dose_interval ?>
        <th data-name="dose_interval" class="<?= $Grid->dose_interval->headerCellClass() ?>"><div id="elh_prescription_details_dose_interval" class="prescription_details_dose_interval"><?= $Grid->renderFieldHeader($Grid->dose_interval) ?></div></th>
<?php } ?>
<?php if ($Grid->number_of_days->Visible) { // number_of_days ?>
        <th data-name="number_of_days" class="<?= $Grid->number_of_days->headerCellClass() ?>"><div id="elh_prescription_details_number_of_days" class="prescription_details_number_of_days"><?= $Grid->renderFieldHeader($Grid->number_of_days) ?></div></th>
<?php } ?>
<?php if ($Grid->method->Visible) { // method ?>
        <th data-name="method" class="<?= $Grid->method->headerCellClass() ?>"><div id="elh_prescription_details_method" class="prescription_details_method"><?= $Grid->renderFieldHeader($Grid->method) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_id" class="el_prescription_details_id"></span>
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_id" class="el_prescription_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_id" class="el_prescription_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_id" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_id" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <td data-name="prescription_id"<?= $Grid->prescription_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->prescription_id->getSessionValue() != "") { ?>
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->prescription_id->getDisplayValue($Grid->prescription_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_prescription_id" name="x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_prescription_id" class="el_prescription_details_prescription_id">
<input type="<?= $Grid->prescription_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" data-table="prescription_details" data-field="x_prescription_id" value="<?= $Grid->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_id->formatPattern()) ?>"<?= $Grid->prescription_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="prescription_details" data-field="x_prescription_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_id" id="o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->prescription_id->getSessionValue() != "") { ?>
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->prescription_id->getDisplayValue($Grid->prescription_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_prescription_id" name="x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_prescription_id" class="el_prescription_details_prescription_id">
<input type="<?= $Grid->prescription_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" data-table="prescription_details" data-field="x_prescription_id" value="<?= $Grid->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_id->formatPattern()) ?>"<?= $Grid->prescription_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_prescription_id" class="el_prescription_details_prescription_id">
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<?= $Grid->prescription_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_prescription_id" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_prescription_id" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_prescription_id" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_prescription_id" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <td data-name="medicine_stock_id"<?= $Grid->medicine_stock_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_medicine_stock_id" class="el_prescription_details_medicine_stock_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        name="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        class="form-select ew-select<?= $Grid->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Grid->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_stock_id->editAttributes() ?>>
        <?= $Grid->medicine_stock_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_stock_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_stock_id->getErrorMessage() ?></div>
<?= $Grid->medicine_stock_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_stock_id") ?>
<?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_stock_id", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_medicine_stock_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_stock_id" id="o<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_medicine_stock_id" class="el_prescription_details_medicine_stock_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        name="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        class="form-select ew-select<?= $Grid->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Grid->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_stock_id->editAttributes() ?>>
        <?= $Grid->medicine_stock_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_stock_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_stock_id->getErrorMessage() ?></div>
<?= $Grid->medicine_stock_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_stock_id") ?>
<?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_stock_id", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_medicine_stock_id" class="el_prescription_details_medicine_stock_id">
<span<?= $Grid->medicine_stock_id->viewAttributes() ?>>
<?= $Grid->medicine_stock_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_medicine_stock_id" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_stock_id" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_medicine_stock_id" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_stock_id" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dose_quantity->Visible) { // dose_quantity ?>
        <td data-name="dose_quantity"<?= $Grid->dose_quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_quantity" class="el_prescription_details_dose_quantity">
<input type="<?= $Grid->dose_quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_dose_quantity" id="x<?= $Grid->RowIndex ?>_dose_quantity" data-table="prescription_details" data-field="x_dose_quantity" value="<?= $Grid->dose_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->dose_quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->dose_quantity->formatPattern()) ?>"<?= $Grid->dose_quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dose_quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_dose_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_dose_quantity" id="o<?= $Grid->RowIndex ?>_dose_quantity" value="<?= HtmlEncode($Grid->dose_quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_quantity" class="el_prescription_details_dose_quantity">
<input type="<?= $Grid->dose_quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_dose_quantity" id="x<?= $Grid->RowIndex ?>_dose_quantity" data-table="prescription_details" data-field="x_dose_quantity" value="<?= $Grid->dose_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->dose_quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->dose_quantity->formatPattern()) ?>"<?= $Grid->dose_quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dose_quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_quantity" class="el_prescription_details_dose_quantity">
<span<?= $Grid->dose_quantity->viewAttributes() ?>>
<?= $Grid->dose_quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_dose_quantity" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_quantity" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_quantity" value="<?= HtmlEncode($Grid->dose_quantity->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_dose_quantity" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_quantity" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_quantity" value="<?= HtmlEncode($Grid->dose_quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dose_type->Visible) { // dose_type ?>
        <td data-name="dose_type"<?= $Grid->dose_type->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_type" class="el_prescription_details_dose_type">
    <select
        id="x<?= $Grid->RowIndex ?>_dose_type"
        name="x<?= $Grid->RowIndex ?>_dose_type"
        class="form-select ew-select<?= $Grid->dose_type->isInvalidClass() ?>"
        <?php if (!$Grid->dose_type->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_type"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_type"
        data-value-separator="<?= $Grid->dose_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dose_type->getPlaceHolder()) ?>"
        <?= $Grid->dose_type->editAttributes() ?>>
        <?= $Grid->dose_type->selectOptionListHtml("x{$Grid->RowIndex}_dose_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dose_type->getErrorMessage() ?></div>
<?php if (!$Grid->dose_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dose_type", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.dose_type?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dose_type", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dose_type", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_dose_type" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_dose_type" id="o<?= $Grid->RowIndex ?>_dose_type" value="<?= HtmlEncode($Grid->dose_type->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_type" class="el_prescription_details_dose_type">
    <select
        id="x<?= $Grid->RowIndex ?>_dose_type"
        name="x<?= $Grid->RowIndex ?>_dose_type"
        class="form-select ew-select<?= $Grid->dose_type->isInvalidClass() ?>"
        <?php if (!$Grid->dose_type->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_type"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_type"
        data-value-separator="<?= $Grid->dose_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dose_type->getPlaceHolder()) ?>"
        <?= $Grid->dose_type->editAttributes() ?>>
        <?= $Grid->dose_type->selectOptionListHtml("x{$Grid->RowIndex}_dose_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dose_type->getErrorMessage() ?></div>
<?php if (!$Grid->dose_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dose_type", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.dose_type?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dose_type", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dose_type", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_type" class="el_prescription_details_dose_type">
<span<?= $Grid->dose_type->viewAttributes() ?>>
<?= $Grid->dose_type->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_dose_type" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_type" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_type" value="<?= HtmlEncode($Grid->dose_type->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_dose_type" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_type" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_type" value="<?= HtmlEncode($Grid->dose_type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dose_interval->Visible) { // dose_interval ?>
        <td data-name="dose_interval"<?= $Grid->dose_interval->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_interval" class="el_prescription_details_dose_interval">
    <select
        id="x<?= $Grid->RowIndex ?>_dose_interval"
        name="x<?= $Grid->RowIndex ?>_dose_interval"
        class="form-select ew-select<?= $Grid->dose_interval->isInvalidClass() ?>"
        <?php if (!$Grid->dose_interval->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_interval"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_interval"
        data-value-separator="<?= $Grid->dose_interval->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dose_interval->getPlaceHolder()) ?>"
        <?= $Grid->dose_interval->editAttributes() ?>>
        <?= $Grid->dose_interval->selectOptionListHtml("x{$Grid->RowIndex}_dose_interval") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dose_interval->getErrorMessage() ?></div>
<?php if (!$Grid->dose_interval->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dose_interval", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_interval" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.dose_interval?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dose_interval", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dose_interval", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_interval.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_dose_interval" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_dose_interval" id="o<?= $Grid->RowIndex ?>_dose_interval" value="<?= HtmlEncode($Grid->dose_interval->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_interval" class="el_prescription_details_dose_interval">
    <select
        id="x<?= $Grid->RowIndex ?>_dose_interval"
        name="x<?= $Grid->RowIndex ?>_dose_interval"
        class="form-select ew-select<?= $Grid->dose_interval->isInvalidClass() ?>"
        <?php if (!$Grid->dose_interval->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_interval"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_interval"
        data-value-separator="<?= $Grid->dose_interval->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dose_interval->getPlaceHolder()) ?>"
        <?= $Grid->dose_interval->editAttributes() ?>>
        <?= $Grid->dose_interval->selectOptionListHtml("x{$Grid->RowIndex}_dose_interval") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dose_interval->getErrorMessage() ?></div>
<?php if (!$Grid->dose_interval->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dose_interval", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_dose_interval" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.dose_interval?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dose_interval", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dose_interval", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_interval.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_dose_interval" class="el_prescription_details_dose_interval">
<span<?= $Grid->dose_interval->viewAttributes() ?>>
<?= $Grid->dose_interval->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_dose_interval" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_interval" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_dose_interval" value="<?= HtmlEncode($Grid->dose_interval->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_dose_interval" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_interval" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_dose_interval" value="<?= HtmlEncode($Grid->dose_interval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->number_of_days->Visible) { // number_of_days ?>
        <td data-name="number_of_days"<?= $Grid->number_of_days->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_number_of_days" class="el_prescription_details_number_of_days">
<?php
if (IsRTL()) {
    $Grid->number_of_days->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_number_of_days" class="ew-auto-suggest">
    <input type="<?= $Grid->number_of_days->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_number_of_days" id="sv_x<?= $Grid->RowIndex ?>_number_of_days" value="<?= RemoveHtml($Grid->number_of_days->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->number_of_days->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->number_of_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->number_of_days->formatPattern()) ?>"<?= $Grid->number_of_days->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="prescription_details" data-field="x_number_of_days" data-input="sv_x<?= $Grid->RowIndex ?>_number_of_days" data-value-separator="<?= $Grid->number_of_days->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_number_of_days" id="x<?= $Grid->RowIndex ?>_number_of_days" value="<?= HtmlEncode($Grid->number_of_days->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->number_of_days->getErrorMessage() ?></div>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    fprescription_detailsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_number_of_days","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->number_of_days->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.prescription_details.fields.number_of_days.autoSuggestOptions));
});
</script>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_number_of_days" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_number_of_days" id="o<?= $Grid->RowIndex ?>_number_of_days" value="<?= HtmlEncode($Grid->number_of_days->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_number_of_days" class="el_prescription_details_number_of_days">
<?php
if (IsRTL()) {
    $Grid->number_of_days->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_number_of_days" class="ew-auto-suggest">
    <input type="<?= $Grid->number_of_days->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_number_of_days" id="sv_x<?= $Grid->RowIndex ?>_number_of_days" value="<?= RemoveHtml($Grid->number_of_days->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->number_of_days->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->number_of_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->number_of_days->formatPattern()) ?>"<?= $Grid->number_of_days->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="prescription_details" data-field="x_number_of_days" data-input="sv_x<?= $Grid->RowIndex ?>_number_of_days" data-value-separator="<?= $Grid->number_of_days->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_number_of_days" id="x<?= $Grid->RowIndex ?>_number_of_days" value="<?= HtmlEncode($Grid->number_of_days->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->number_of_days->getErrorMessage() ?></div>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    fprescription_detailsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_number_of_days","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->number_of_days->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.prescription_details.fields.number_of_days.autoSuggestOptions));
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_number_of_days" class="el_prescription_details_number_of_days">
<span<?= $Grid->number_of_days->viewAttributes() ?>>
<?= $Grid->number_of_days->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_number_of_days" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_number_of_days" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_number_of_days" value="<?= HtmlEncode($Grid->number_of_days->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_number_of_days" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_number_of_days" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_number_of_days" value="<?= HtmlEncode($Grid->number_of_days->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->method->Visible) { // method ?>
        <td data-name="method"<?= $Grid->method->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_method" class="el_prescription_details_method">
    <select
        id="x<?= $Grid->RowIndex ?>_method"
        name="x<?= $Grid->RowIndex ?>_method"
        class="form-select ew-select<?= $Grid->method->isInvalidClass() ?>"
        <?php if (!$Grid->method->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_method"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_method"
        data-value-separator="<?= $Grid->method->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->method->getPlaceHolder()) ?>"
        <?= $Grid->method->editAttributes() ?>>
        <?= $Grid->method->selectOptionListHtml("x{$Grid->RowIndex}_method") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->method->getErrorMessage() ?></div>
<?php if (!$Grid->method->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_method", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_method" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.method?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_method", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_method", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.method.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="prescription_details" data-field="x_method" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_method" id="o<?= $Grid->RowIndex ?>_method" value="<?= HtmlEncode($Grid->method->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_method" class="el_prescription_details_method">
    <select
        id="x<?= $Grid->RowIndex ?>_method"
        name="x<?= $Grid->RowIndex ?>_method"
        class="form-select ew-select<?= $Grid->method->isInvalidClass() ?>"
        <?php if (!$Grid->method->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_method"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_method"
        data-value-separator="<?= $Grid->method->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->method->getPlaceHolder()) ?>"
        <?= $Grid->method->editAttributes() ?>>
        <?= $Grid->method->selectOptionListHtml("x{$Grid->RowIndex}_method") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->method->getErrorMessage() ?></div>
<?php if (!$Grid->method->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_method", selectId: "fprescription_detailsgrid_x<?= $Grid->RowIndex ?>_method" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsgrid.lists.method?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_method", form: "fprescription_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_method", form: "fprescription_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.method.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_prescription_details_method" class="el_prescription_details_method">
<span<?= $Grid->method->viewAttributes() ?>>
<?= $Grid->method->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="prescription_details" data-field="x_method" data-hidden="1" name="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_method" id="fprescription_detailsgrid$x<?= $Grid->RowIndex ?>_method" value="<?= HtmlEncode($Grid->method->FormValue) ?>">
<input type="hidden" data-table="prescription_details" data-field="x_method" data-hidden="1" data-old name="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_method" id="fprescription_detailsgrid$o<?= $Grid->RowIndex ?>_method" value="<?= HtmlEncode($Grid->method->OldValue) ?>">
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
loadjs.ready(["fprescription_detailsgrid","load"], () => fprescription_detailsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fprescription_detailsgrid">
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
    ew.addEventHandlers("prescription_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
