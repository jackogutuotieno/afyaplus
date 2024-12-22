<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("MedicineDispensationGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fmedicine_dispensationgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { medicine_dispensation: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_dispensationgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null, ew.Validators.integer], fields.prescription_id.isInvalid],
            ["dispensation_type", [fields.dispensation_type.visible && fields.dispensation_type.required ? ew.Validators.required(fields.dispensation_type.caption) : null], fields.dispensation_type.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["prescription_id",false],["dispensation_type",false],["status",false],["date_created",false]];
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
            "patient_id": <?= $Grid->patient_id->toClientList($Grid) ?>,
            "dispensation_type": <?= $Grid->dispensation_type->toClientList($Grid) ?>,
            "status": <?= $Grid->status->toClientList($Grid) ?>,
            "created_by_user_id": <?= $Grid->created_by_user_id->toClientList($Grid) ?>,
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
<div id="fmedicine_dispensationgrid" class="ew-form ew-list-form">
<div id="gmp_medicine_dispensation" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_medicine_dispensationgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_medicine_dispensation_id" class="medicine_dispensation_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_medicine_dispensation_patient_id" class="medicine_dispensation_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <th data-name="prescription_id" class="<?= $Grid->prescription_id->headerCellClass() ?>"><div id="elh_medicine_dispensation_prescription_id" class="medicine_dispensation_prescription_id"><?= $Grid->renderFieldHeader($Grid->prescription_id) ?></div></th>
<?php } ?>
<?php if ($Grid->dispensation_type->Visible) { // dispensation_type ?>
        <th data-name="dispensation_type" class="<?= $Grid->dispensation_type->headerCellClass() ?>"><div id="elh_medicine_dispensation_dispensation_type" class="medicine_dispensation_dispensation_type"><?= $Grid->renderFieldHeader($Grid->dispensation_type) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_medicine_dispensation_status" class="medicine_dispensation_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_medicine_dispensation_created_by_user_id" class="medicine_dispensation_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_medicine_dispensation_date_created" class="medicine_dispensation_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_id" class="el_medicine_dispensation_id"></span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_id" class="el_medicine_dispensation_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_id" class="el_medicine_dispensation_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_id" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_id" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_id" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_id" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="medicine_dispensation" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_patient_id" class="el_medicine_dispensation_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_patient_id" class="el_medicine_dispensation_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<?php if (!$Grid->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_patient_id" class="el_medicine_dispensation_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_patient_id" class="el_medicine_dispensation_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<?php if (!$Grid->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_patient_id" class="el_medicine_dispensation_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_patient_id" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_patient_id" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prescription_id->Visible) { // prescription_id ?>
        <td data-name="prescription_id"<?= $Grid->prescription_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_prescription_id" class="el_medicine_dispensation_prescription_id">
<input type="<?= $Grid->prescription_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" data-table="medicine_dispensation" data-field="x_prescription_id" value="<?= $Grid->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_id->formatPattern()) ?>"<?= $Grid->prescription_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_prescription_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_prescription_id" id="o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_prescription_id" class="el_medicine_dispensation_prescription_id">
<input type="<?= $Grid->prescription_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prescription_id" id="x<?= $Grid->RowIndex ?>_prescription_id" data-table="medicine_dispensation" data-field="x_prescription_id" value="<?= $Grid->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->prescription_id->formatPattern()) ?>"<?= $Grid->prescription_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prescription_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_prescription_id" class="el_medicine_dispensation_prescription_id">
<span<?= $Grid->prescription_id->viewAttributes() ?>>
<?= $Grid->prescription_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_prescription_id" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_prescription_id" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_prescription_id" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_prescription_id" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_prescription_id" value="<?= HtmlEncode($Grid->prescription_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dispensation_type->Visible) { // dispensation_type ?>
        <td data-name="dispensation_type"<?= $Grid->dispensation_type->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_dispensation_type" class="el_medicine_dispensation_dispensation_type">
    <select
        id="x<?= $Grid->RowIndex ?>_dispensation_type"
        name="x<?= $Grid->RowIndex ?>_dispensation_type"
        class="form-select ew-select<?= $Grid->dispensation_type->isInvalidClass() ?>"
        <?php if (!$Grid->dispensation_type->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_dispensation_type"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_dispensation_type"
        data-value-separator="<?= $Grid->dispensation_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dispensation_type->getPlaceHolder()) ?>"
        <?= $Grid->dispensation_type->editAttributes() ?>>
        <?= $Grid->dispensation_type->selectOptionListHtml("x{$Grid->RowIndex}_dispensation_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dispensation_type->getErrorMessage() ?></div>
<?php if (!$Grid->dispensation_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dispensation_type", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_dispensation_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.dispensation_type?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dispensation_type", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dispensation_type", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.dispensation_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_dispensation_type" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_dispensation_type" id="o<?= $Grid->RowIndex ?>_dispensation_type" value="<?= HtmlEncode($Grid->dispensation_type->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_dispensation_type" class="el_medicine_dispensation_dispensation_type">
    <select
        id="x<?= $Grid->RowIndex ?>_dispensation_type"
        name="x<?= $Grid->RowIndex ?>_dispensation_type"
        class="form-select ew-select<?= $Grid->dispensation_type->isInvalidClass() ?>"
        <?php if (!$Grid->dispensation_type->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_dispensation_type"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_dispensation_type"
        data-value-separator="<?= $Grid->dispensation_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->dispensation_type->getPlaceHolder()) ?>"
        <?= $Grid->dispensation_type->editAttributes() ?>>
        <?= $Grid->dispensation_type->selectOptionListHtml("x{$Grid->RowIndex}_dispensation_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->dispensation_type->getErrorMessage() ?></div>
<?php if (!$Grid->dispensation_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_dispensation_type", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_dispensation_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.dispensation_type?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_dispensation_type", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_dispensation_type", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.dispensation_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_dispensation_type" class="el_medicine_dispensation_dispensation_type">
<span<?= $Grid->dispensation_type->viewAttributes() ?>>
<?= $Grid->dispensation_type->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_dispensation_type" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_dispensation_type" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_dispensation_type" value="<?= HtmlEncode($Grid->dispensation_type->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_dispensation_type" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_dispensation_type" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_dispensation_type" value="<?= HtmlEncode($Grid->dispensation_type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_status" class="el_medicine_dispensation_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_status" class="el_medicine_dispensation_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fmedicine_dispensationgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fmedicine_dispensationgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fmedicine_dispensationgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_status" class="el_medicine_dispensation_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_status" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_status" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_status" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_status" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_created_by_user_id" class="el_medicine_dispensation_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_created_by_user_id" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_created_by_user_id" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_date_created" class="el_medicine_dispensation_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="medicine_dispensation" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_dispensationgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fmedicine_dispensationgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="medicine_dispensation" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_date_created" class="el_medicine_dispensation_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="medicine_dispensation" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_dispensationgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fmedicine_dispensationgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_date_created" class="el_medicine_dispensation_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation" data-field="x_date_created" data-hidden="1" name="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_date_created" id="fmedicine_dispensationgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation" data-field="x_date_created" data-hidden="1" data-old name="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_date_created" id="fmedicine_dispensationgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
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
loadjs.ready(["fmedicine_dispensationgrid","load"], () => fmedicine_dispensationgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fmedicine_dispensationgrid">
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
    ew.addEventHandlers("medicine_dispensation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
