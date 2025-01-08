<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientsDischargeGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatients_dischargegrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patients_discharge: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_dischargegrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["discharge", [fields.discharge.visible && fields.discharge.required ? ew.Validators.required(fields.discharge.caption) : null], fields.discharge.isInvalid],
            ["admission_reason", [fields.admission_reason.visible && fields.admission_reason.required ? ew.Validators.required(fields.admission_reason.caption) : null], fields.admission_reason.isInvalid],
            ["discharge_condition", [fields.discharge_condition.visible && fields.discharge_condition.required ? ew.Validators.required(fields.discharge_condition.caption) : null], fields.discharge_condition.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["admission_id",false],["patient_id",false],["discharge",true],["admission_reason",false],["discharge_condition",false],["date_created",false]];
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
            "discharge": <?= $Grid->discharge->toClientList($Grid) ?>,
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
<div id="fpatients_dischargegrid" class="ew-form ew-list-form">
<div id="gmp_patients_discharge" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patients_dischargegrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_patients_discharge_id" class="patients_discharge_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->admission_id->Visible) { // admission_id ?>
        <th data-name="admission_id" class="<?= $Grid->admission_id->headerCellClass() ?>"><div id="elh_patients_discharge_admission_id" class="patients_discharge_admission_id"><?= $Grid->renderFieldHeader($Grid->admission_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patients_discharge_patient_id" class="patients_discharge_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->discharge->Visible) { // discharge ?>
        <th data-name="discharge" class="<?= $Grid->discharge->headerCellClass() ?>"><div id="elh_patients_discharge_discharge" class="patients_discharge_discharge"><?= $Grid->renderFieldHeader($Grid->discharge) ?></div></th>
<?php } ?>
<?php if ($Grid->admission_reason->Visible) { // admission_reason ?>
        <th data-name="admission_reason" class="<?= $Grid->admission_reason->headerCellClass() ?>"><div id="elh_patients_discharge_admission_reason" class="patients_discharge_admission_reason"><?= $Grid->renderFieldHeader($Grid->admission_reason) ?></div></th>
<?php } ?>
<?php if ($Grid->discharge_condition->Visible) { // discharge_condition ?>
        <th data-name="discharge_condition" class="<?= $Grid->discharge_condition->headerCellClass() ?>"><div id="elh_patients_discharge_discharge_condition" class="patients_discharge_discharge_condition"><?= $Grid->renderFieldHeader($Grid->discharge_condition) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_patients_discharge_created_by_user_id" class="patients_discharge_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patients_discharge_date_created" class="patients_discharge_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_id" class="el_patients_discharge_id"></span>
<input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_id" class="el_patients_discharge_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_id" class="el_patients_discharge_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_id" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_id" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->admission_id->Visible) { // admission_id ?>
        <td data-name="admission_id"<?= $Grid->admission_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_id" class="el_patients_discharge_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_id" class="el_patients_discharge_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="patients_discharge" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="patients_discharge" data-field="x_admission_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_id" id="o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_id" class="el_patients_discharge_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_id" class="el_patients_discharge_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="patients_discharge" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_id" class="el_patients_discharge_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<?= $Grid->admission_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_admission_id" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_admission_id" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_admission_id" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_admission_id" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_patient_id" class="el_patients_discharge_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_patient_id" class="el_patients_discharge_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatients_dischargegrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patients_discharge"
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
loadjs.ready("fpatients_dischargegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatients_dischargegrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_dischargegrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_dischargegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_dischargegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_discharge.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="patients_discharge" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_patient_id" class="el_patients_discharge_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_patient_id" class="el_patients_discharge_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatients_dischargegrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patients_discharge"
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
loadjs.ready("fpatients_dischargegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatients_dischargegrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_dischargegrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_dischargegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_dischargegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_discharge.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_patient_id" class="el_patients_discharge_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_patient_id" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_patient_id" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->discharge->Visible) { // discharge ?>
        <td data-name="discharge"<?= $Grid->discharge->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge" class="el_patients_discharge_discharge">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Grid->discharge->isInvalidClass() ?>" data-table="patients_discharge" data-field="x_discharge" data-boolean name="x<?= $Grid->RowIndex ?>_discharge" id="x<?= $Grid->RowIndex ?>_discharge" value="1"<?= ConvertToBool($Grid->discharge->CurrentValue) ? " checked" : "" ?><?= $Grid->discharge->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Grid->discharge->getErrorMessage() ?></div>
</div>
</span>
<input type="hidden" data-table="patients_discharge" data-field="x_discharge" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_discharge" id="o<?= $Grid->RowIndex ?>_discharge" value="<?= HtmlEncode($Grid->discharge->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge" class="el_patients_discharge_discharge">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Grid->discharge->isInvalidClass() ?>" data-table="patients_discharge" data-field="x_discharge" data-boolean name="x<?= $Grid->RowIndex ?>_discharge" id="x<?= $Grid->RowIndex ?>_discharge" value="1"<?= ConvertToBool($Grid->discharge->CurrentValue) ? " checked" : "" ?><?= $Grid->discharge->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Grid->discharge->getErrorMessage() ?></div>
</div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge" class="el_patients_discharge_discharge">
<span<?= $Grid->discharge->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_discharge_<?= $Grid->RowCount ?>" class="form-check-input" value="<?= $Grid->discharge->getViewValue() ?>" disabled<?php if (ConvertToBool($Grid->discharge->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_discharge_<?= $Grid->RowCount ?>"></label>
</div>
</span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_discharge" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_discharge" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_discharge" value="<?= HtmlEncode($Grid->discharge->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_discharge" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_discharge" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_discharge" value="<?= HtmlEncode($Grid->discharge->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->admission_reason->Visible) { // admission_reason ?>
        <td data-name="admission_reason"<?= $Grid->admission_reason->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_reason" class="el_patients_discharge_admission_reason">
<?php $Grid->admission_reason->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_admission_reason" name="x<?= $Grid->RowIndex ?>_admission_reason" id="x<?= $Grid->RowIndex ?>_admission_reason" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->admission_reason->getPlaceHolder()) ?>"<?= $Grid->admission_reason->editAttributes() ?>><?= $Grid->admission_reason->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->admission_reason->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargegrid", "editor"], function() {
    ew.createEditor("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_admission_reason", 0, 0, <?= $Grid->admission_reason->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="patients_discharge" data-field="x_admission_reason" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_reason" id="o<?= $Grid->RowIndex ?>_admission_reason" value="<?= HtmlEncode($Grid->admission_reason->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_reason" class="el_patients_discharge_admission_reason">
<?php $Grid->admission_reason->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_admission_reason" name="x<?= $Grid->RowIndex ?>_admission_reason" id="x<?= $Grid->RowIndex ?>_admission_reason" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->admission_reason->getPlaceHolder()) ?>"<?= $Grid->admission_reason->editAttributes() ?>><?= $Grid->admission_reason->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->admission_reason->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargegrid", "editor"], function() {
    ew.createEditor("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_admission_reason", 0, 0, <?= $Grid->admission_reason->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_admission_reason" class="el_patients_discharge_admission_reason">
<span<?= $Grid->admission_reason->viewAttributes() ?>>
<?= $Grid->admission_reason->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_admission_reason" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_admission_reason" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_admission_reason" value="<?= HtmlEncode($Grid->admission_reason->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_admission_reason" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_admission_reason" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_admission_reason" value="<?= HtmlEncode($Grid->admission_reason->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->discharge_condition->Visible) { // discharge_condition ?>
        <td data-name="discharge_condition"<?= $Grid->discharge_condition->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge_condition" class="el_patients_discharge_discharge_condition">
<?php $Grid->discharge_condition->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_discharge_condition" name="x<?= $Grid->RowIndex ?>_discharge_condition" id="x<?= $Grid->RowIndex ?>_discharge_condition" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->discharge_condition->getPlaceHolder()) ?>"<?= $Grid->discharge_condition->editAttributes() ?>><?= $Grid->discharge_condition->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->discharge_condition->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargegrid", "editor"], function() {
    ew.createEditor("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_discharge_condition", 0, 0, <?= $Grid->discharge_condition->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="patients_discharge" data-field="x_discharge_condition" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_discharge_condition" id="o<?= $Grid->RowIndex ?>_discharge_condition" value="<?= HtmlEncode($Grid->discharge_condition->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge_condition" class="el_patients_discharge_discharge_condition">
<?php $Grid->discharge_condition->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_discharge_condition" name="x<?= $Grid->RowIndex ?>_discharge_condition" id="x<?= $Grid->RowIndex ?>_discharge_condition" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->discharge_condition->getPlaceHolder()) ?>"<?= $Grid->discharge_condition->editAttributes() ?>><?= $Grid->discharge_condition->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->discharge_condition->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargegrid", "editor"], function() {
    ew.createEditor("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_discharge_condition", 0, 0, <?= $Grid->discharge_condition->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_discharge_condition" class="el_patients_discharge_discharge_condition">
<span<?= $Grid->discharge_condition->viewAttributes() ?>>
<?= $Grid->discharge_condition->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_discharge_condition" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_discharge_condition" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_discharge_condition" value="<?= HtmlEncode($Grid->discharge_condition->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_discharge_condition" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_discharge_condition" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_discharge_condition" value="<?= HtmlEncode($Grid->discharge_condition->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<input type="hidden" data-table="patients_discharge" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_created_by_user_id" class="el_patients_discharge_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_created_by_user_id" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_created_by_user_id" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_date_created" class="el_patients_discharge_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_discharge" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dischargegrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_discharge" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_date_created" class="el_patients_discharge_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_discharge" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dischargegrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fpatients_dischargegrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_discharge_date_created" class="el_patients_discharge_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_discharge" data-field="x_date_created" data-hidden="1" name="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatients_dischargegrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patients_discharge" data-field="x_date_created" data-hidden="1" data-old name="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatients_dischargegrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
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
loadjs.ready(["fpatients_dischargegrid","load"], () => fpatients_dischargegrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatients_dischargegrid">
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
    ew.addEventHandlers("patients_discharge");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
