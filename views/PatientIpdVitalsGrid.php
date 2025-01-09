<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientIpdVitalsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatient_ipd_vitalsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patient_ipd_vitals: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_ipd_vitalsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null, ew.Validators.float], fields.height.isInvalid],
            ["weight", [fields.weight.visible && fields.weight.required ? ew.Validators.required(fields.weight.caption) : null, ew.Validators.integer], fields.weight.isInvalid],
            ["temperature", [fields.temperature.visible && fields.temperature.required ? ew.Validators.required(fields.temperature.caption) : null, ew.Validators.float], fields.temperature.isInvalid],
            ["pulse", [fields.pulse.visible && fields.pulse.required ? ew.Validators.required(fields.pulse.caption) : null, ew.Validators.integer], fields.pulse.isInvalid],
            ["blood_pressure", [fields.blood_pressure.visible && fields.blood_pressure.required ? ew.Validators.required(fields.blood_pressure.caption) : null], fields.blood_pressure.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["admission_id",false],["patient_id",false],["height",false],["weight",false],["temperature",false],["pulse",false],["blood_pressure",false],["date_created",false]];
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
<div id="fpatient_ipd_vitalsgrid" class="ew-form ew-list-form">
<div id="gmp_patient_ipd_vitals" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patient_ipd_vitalsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="admission_id" class="<?= $Grid->admission_id->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_admission_id" class="patient_ipd_vitals_admission_id"><?= $Grid->renderFieldHeader($Grid->admission_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_patient_id" class="patient_ipd_vitals_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->height->Visible) { // height ?>
        <th data-name="height" class="<?= $Grid->height->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_height" class="patient_ipd_vitals_height"><?= $Grid->renderFieldHeader($Grid->height) ?></div></th>
<?php } ?>
<?php if ($Grid->weight->Visible) { // weight ?>
        <th data-name="weight" class="<?= $Grid->weight->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_weight" class="patient_ipd_vitals_weight"><?= $Grid->renderFieldHeader($Grid->weight) ?></div></th>
<?php } ?>
<?php if ($Grid->temperature->Visible) { // temperature ?>
        <th data-name="temperature" class="<?= $Grid->temperature->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_temperature" class="patient_ipd_vitals_temperature"><?= $Grid->renderFieldHeader($Grid->temperature) ?></div></th>
<?php } ?>
<?php if ($Grid->pulse->Visible) { // pulse ?>
        <th data-name="pulse" class="<?= $Grid->pulse->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_pulse" class="patient_ipd_vitals_pulse"><?= $Grid->renderFieldHeader($Grid->pulse) ?></div></th>
<?php } ?>
<?php if ($Grid->blood_pressure->Visible) { // blood_pressure ?>
        <th data-name="blood_pressure" class="<?= $Grid->blood_pressure->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_blood_pressure" class="patient_ipd_vitals_blood_pressure"><?= $Grid->renderFieldHeader($Grid->blood_pressure) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_created_by_user_id" class="patient_ipd_vitals_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patient_ipd_vitals_date_created" class="patient_ipd_vitals_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
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
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_admission_id" class="el_patient_ipd_vitals_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_admission_id" class="el_patient_ipd_vitals_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="patient_ipd_vitals" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_admission_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_id" id="o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_admission_id" class="el_patient_ipd_vitals_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_admission_id" class="el_patient_ipd_vitals_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="patient_ipd_vitals" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_admission_id" class="el_patient_ipd_vitals_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<?= $Grid->admission_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_admission_id" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_admission_id" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_admission_id" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_admission_id" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_patient_id" class="el_patient_ipd_vitals_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_patient_id" class="el_patient_ipd_vitals_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_ipd_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_ipd_vitals"
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
loadjs.ready("fpatient_ipd_vitalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_ipd_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_ipd_vitalsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_ipd_vitalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_ipd_vitalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_ipd_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_patient_id" class="el_patient_ipd_vitals_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_patient_id" class="el_patient_ipd_vitals_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_ipd_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_ipd_vitals"
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
loadjs.ready("fpatient_ipd_vitalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_ipd_vitalsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_ipd_vitalsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_ipd_vitalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_ipd_vitalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_ipd_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_patient_id" class="el_patient_ipd_vitals_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_patient_id" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_patient_id" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->height->Visible) { // height ?>
        <td data-name="height"<?= $Grid->height->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_height" class="el_patient_ipd_vitals_height">
<input type="<?= $Grid->height->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_height" id="x<?= $Grid->RowIndex ?>_height" data-table="patient_ipd_vitals" data-field="x_height" value="<?= $Grid->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->height->formatPattern()) ?>"<?= $Grid->height->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->height->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_height" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_height" id="o<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_height" class="el_patient_ipd_vitals_height">
<input type="<?= $Grid->height->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_height" id="x<?= $Grid->RowIndex ?>_height" data-table="patient_ipd_vitals" data-field="x_height" value="<?= $Grid->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->height->formatPattern()) ?>"<?= $Grid->height->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->height->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_height" class="el_patient_ipd_vitals_height">
<span<?= $Grid->height->viewAttributes() ?>>
<?= $Grid->height->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_height" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_height" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_height" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_height" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_height" value="<?= HtmlEncode($Grid->height->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->weight->Visible) { // weight ?>
        <td data-name="weight"<?= $Grid->weight->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_weight" class="el_patient_ipd_vitals_weight">
<input type="<?= $Grid->weight->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_weight" id="x<?= $Grid->RowIndex ?>_weight" data-table="patient_ipd_vitals" data-field="x_weight" value="<?= $Grid->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->weight->formatPattern()) ?>"<?= $Grid->weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->weight->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_weight" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_weight" id="o<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_weight" class="el_patient_ipd_vitals_weight">
<input type="<?= $Grid->weight->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_weight" id="x<?= $Grid->RowIndex ?>_weight" data-table="patient_ipd_vitals" data-field="x_weight" value="<?= $Grid->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->weight->formatPattern()) ?>"<?= $Grid->weight->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->weight->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_weight" class="el_patient_ipd_vitals_weight">
<span<?= $Grid->weight->viewAttributes() ?>>
<?= $Grid->weight->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_weight" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_weight" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_weight" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_weight" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_weight" value="<?= HtmlEncode($Grid->weight->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->temperature->Visible) { // temperature ?>
        <td data-name="temperature"<?= $Grid->temperature->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_temperature" class="el_patient_ipd_vitals_temperature">
<input type="<?= $Grid->temperature->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_temperature" id="x<?= $Grid->RowIndex ?>_temperature" data-table="patient_ipd_vitals" data-field="x_temperature" value="<?= $Grid->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->temperature->formatPattern()) ?>"<?= $Grid->temperature->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->temperature->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_temperature" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_temperature" id="o<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_temperature" class="el_patient_ipd_vitals_temperature">
<input type="<?= $Grid->temperature->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_temperature" id="x<?= $Grid->RowIndex ?>_temperature" data-table="patient_ipd_vitals" data-field="x_temperature" value="<?= $Grid->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->temperature->formatPattern()) ?>"<?= $Grid->temperature->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->temperature->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_temperature" class="el_patient_ipd_vitals_temperature">
<span<?= $Grid->temperature->viewAttributes() ?>>
<?= $Grid->temperature->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_temperature" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_temperature" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_temperature" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_temperature" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_temperature" value="<?= HtmlEncode($Grid->temperature->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pulse->Visible) { // pulse ?>
        <td data-name="pulse"<?= $Grid->pulse->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_pulse" class="el_patient_ipd_vitals_pulse">
<input type="<?= $Grid->pulse->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pulse" id="x<?= $Grid->RowIndex ?>_pulse" data-table="patient_ipd_vitals" data-field="x_pulse" value="<?= $Grid->pulse->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pulse->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pulse->formatPattern()) ?>"<?= $Grid->pulse->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pulse->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_pulse" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_pulse" id="o<?= $Grid->RowIndex ?>_pulse" value="<?= HtmlEncode($Grid->pulse->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_pulse" class="el_patient_ipd_vitals_pulse">
<input type="<?= $Grid->pulse->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pulse" id="x<?= $Grid->RowIndex ?>_pulse" data-table="patient_ipd_vitals" data-field="x_pulse" value="<?= $Grid->pulse->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->pulse->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->pulse->formatPattern()) ?>"<?= $Grid->pulse->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pulse->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_pulse" class="el_patient_ipd_vitals_pulse">
<span<?= $Grid->pulse->viewAttributes() ?>>
<?= $Grid->pulse->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_pulse" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_pulse" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_pulse" value="<?= HtmlEncode($Grid->pulse->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_pulse" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_pulse" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_pulse" value="<?= HtmlEncode($Grid->pulse->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->blood_pressure->Visible) { // blood_pressure ?>
        <td data-name="blood_pressure"<?= $Grid->blood_pressure->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_blood_pressure" class="el_patient_ipd_vitals_blood_pressure">
<input type="<?= $Grid->blood_pressure->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_blood_pressure" id="x<?= $Grid->RowIndex ?>_blood_pressure" data-table="patient_ipd_vitals" data-field="x_blood_pressure" value="<?= $Grid->blood_pressure->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->blood_pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->blood_pressure->formatPattern()) ?>"<?= $Grid->blood_pressure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->blood_pressure->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_blood_pressure" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_blood_pressure" id="o<?= $Grid->RowIndex ?>_blood_pressure" value="<?= HtmlEncode($Grid->blood_pressure->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_blood_pressure" class="el_patient_ipd_vitals_blood_pressure">
<input type="<?= $Grid->blood_pressure->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_blood_pressure" id="x<?= $Grid->RowIndex ?>_blood_pressure" data-table="patient_ipd_vitals" data-field="x_blood_pressure" value="<?= $Grid->blood_pressure->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->blood_pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->blood_pressure->formatPattern()) ?>"<?= $Grid->blood_pressure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->blood_pressure->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_blood_pressure" class="el_patient_ipd_vitals_blood_pressure">
<span<?= $Grid->blood_pressure->viewAttributes() ?>>
<?= $Grid->blood_pressure->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_blood_pressure" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_blood_pressure" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_blood_pressure" value="<?= HtmlEncode($Grid->blood_pressure->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_blood_pressure" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_blood_pressure" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_blood_pressure" value="<?= HtmlEncode($Grid->blood_pressure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_created_by_user_id" class="el_patient_ipd_vitals_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_created_by_user_id" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_created_by_user_id" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_date_created" class="el_patient_ipd_vitals_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_ipd_vitals" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_ipd_vitalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_ipd_vitalsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_date_created" class="el_patient_ipd_vitals_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_ipd_vitals" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_ipd_vitalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_ipd_vitalsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_ipd_vitals_date_created" class="el_patient_ipd_vitals_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_date_created" data-hidden="1" name="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatient_ipd_vitalsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patient_ipd_vitals" data-field="x_date_created" data-hidden="1" data-old name="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatient_ipd_vitalsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
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
loadjs.ready(["fpatient_ipd_vitalsgrid","load"], () => fpatient_ipd_vitalsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatient_ipd_vitalsgrid">
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
    ew.addEventHandlers("patient_ipd_vitals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
