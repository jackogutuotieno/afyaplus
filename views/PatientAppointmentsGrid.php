<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientAppointmentsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatient_appointmentsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patient_appointments: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_appointmentsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["_title", [fields._title.visible && fields._title.required ? ew.Validators.required(fields._title.caption) : null], fields._title.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["doctor_id", [fields.doctor_id.visible && fields.doctor_id.required ? ew.Validators.required(fields.doctor_id.caption) : null], fields.doctor_id.isInvalid],
            ["start_date", [fields.start_date.visible && fields.start_date.required ? ew.Validators.required(fields.start_date.caption) : null, ew.Validators.datetime(fields.start_date.clientFormatPattern)], fields.start_date.isInvalid],
            ["end_date", [fields.end_date.visible && fields.end_date.required ? ew.Validators.required(fields.end_date.caption) : null, ew.Validators.datetime(fields.end_date.clientFormatPattern)], fields.end_date.isInvalid],
            ["is_all_day", [fields.is_all_day.visible && fields.is_all_day.required ? ew.Validators.required(fields.is_all_day.caption) : null], fields.is_all_day.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["_title",false],["description",false],["doctor_id",false],["start_date",false],["end_date",false],["is_all_day",true],["date_created",false],["date_updated",false]];
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
            "doctor_id": <?= $Grid->doctor_id->toClientList($Grid) ?>,
            "is_all_day": <?= $Grid->is_all_day->toClientList($Grid) ?>,
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
<div id="fpatient_appointmentsgrid" class="ew-form ew-list-form">
<div id="gmp_patient_appointments" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patient_appointmentsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patient_appointments_patient_id" class="patient_appointments_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->_title->Visible) { // title ?>
        <th data-name="_title" class="<?= $Grid->_title->headerCellClass() ?>"><div id="elh_patient_appointments__title" class="patient_appointments__title"><?= $Grid->renderFieldHeader($Grid->_title) ?></div></th>
<?php } ?>
<?php if ($Grid->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Grid->description->headerCellClass() ?>"><div id="elh_patient_appointments_description" class="patient_appointments_description"><?= $Grid->renderFieldHeader($Grid->description) ?></div></th>
<?php } ?>
<?php if ($Grid->doctor_id->Visible) { // doctor_id ?>
        <th data-name="doctor_id" class="<?= $Grid->doctor_id->headerCellClass() ?>"><div id="elh_patient_appointments_doctor_id" class="patient_appointments_doctor_id"><?= $Grid->renderFieldHeader($Grid->doctor_id) ?></div></th>
<?php } ?>
<?php if ($Grid->start_date->Visible) { // start_date ?>
        <th data-name="start_date" class="<?= $Grid->start_date->headerCellClass() ?>"><div id="elh_patient_appointments_start_date" class="patient_appointments_start_date"><?= $Grid->renderFieldHeader($Grid->start_date) ?></div></th>
<?php } ?>
<?php if ($Grid->end_date->Visible) { // end_date ?>
        <th data-name="end_date" class="<?= $Grid->end_date->headerCellClass() ?>"><div id="elh_patient_appointments_end_date" class="patient_appointments_end_date"><?= $Grid->renderFieldHeader($Grid->end_date) ?></div></th>
<?php } ?>
<?php if ($Grid->is_all_day->Visible) { // is_all_day ?>
        <th data-name="is_all_day" class="<?= $Grid->is_all_day->headerCellClass() ?>"><div id="elh_patient_appointments_is_all_day" class="patient_appointments_is_all_day"><?= $Grid->renderFieldHeader($Grid->is_all_day) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patient_appointments_date_created" class="patient_appointments_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_patient_appointments_date_updated" class="patient_appointments_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_patient_id" class="el_patient_appointments_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_patient_id" class="el_patient_appointments_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_appointments"
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
loadjs.ready("fpatient_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_appointmentsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_appointments.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="patient_appointments" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_patient_id" class="el_patient_appointments_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_patient_id" class="el_patient_appointments_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_appointments"
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
loadjs.ready("fpatient_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_appointmentsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_appointments.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_patient_id" class="el_patient_appointments_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_patient_id" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_patient_id" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->_title->Visible) { // title ?>
        <td data-name="_title"<?= $Grid->_title->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments__title" class="el_patient_appointments__title">
<input type="<?= $Grid->_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>__title" id="x<?= $Grid->RowIndex ?>__title" data-table="patient_appointments" data-field="x__title" value="<?= $Grid->_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->_title->formatPattern()) ?>"<?= $Grid->_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->_title->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x__title" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>__title" id="o<?= $Grid->RowIndex ?>__title" value="<?= HtmlEncode($Grid->_title->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments__title" class="el_patient_appointments__title">
<input type="<?= $Grid->_title->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>__title" id="x<?= $Grid->RowIndex ?>__title" data-table="patient_appointments" data-field="x__title" value="<?= $Grid->_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->_title->formatPattern()) ?>"<?= $Grid->_title->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->_title->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments__title" class="el_patient_appointments__title">
<span<?= $Grid->_title->viewAttributes() ?>>
<?= $Grid->_title->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x__title" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>__title" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>__title" value="<?= HtmlEncode($Grid->_title->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x__title" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>__title" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>__title" value="<?= HtmlEncode($Grid->_title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->description->Visible) { // description ?>
        <td data-name="description"<?= $Grid->description->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_description" class="el_patient_appointments_description">
<?php $Grid->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patient_appointments" data-field="x_description" name="x<?= $Grid->RowIndex ?>_description" id="x<?= $Grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->description->getPlaceHolder()) ?>"<?= $Grid->description->editAttributes() ?>><?= $Grid->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "editor"], function() {
    ew.createEditor("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_description", 0, 0, <?= $Grid->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_description" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_description" id="o<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_description" class="el_patient_appointments_description">
<?php $Grid->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patient_appointments" data-field="x_description" name="x<?= $Grid->RowIndex ?>_description" id="x<?= $Grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->description->getPlaceHolder()) ?>"<?= $Grid->description->editAttributes() ?>><?= $Grid->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "editor"], function() {
    ew.createEditor("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_description", 0, 0, <?= $Grid->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_description" class="el_patient_appointments_description">
<span<?= $Grid->description->viewAttributes() ?>>
<?= $Grid->description->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_description" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_description" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_description" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_description" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->doctor_id->Visible) { // doctor_id ?>
        <td data-name="doctor_id"<?= $Grid->doctor_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_doctor_id" class="el_patient_appointments_doctor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_doctor_id"
        name="x<?= $Grid->RowIndex ?>_doctor_id"
        class="form-select ew-select<?= $Grid->doctor_id->isInvalidClass() ?>"
        <?php if (!$Grid->doctor_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_doctor_id"
        <?php } ?>
        data-table="patient_appointments"
        data-field="x_doctor_id"
        data-value-separator="<?= $Grid->doctor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->doctor_id->getPlaceHolder()) ?>"
        <?= $Grid->doctor_id->editAttributes() ?>>
        <?= $Grid->doctor_id->selectOptionListHtml("x{$Grid->RowIndex}_doctor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->doctor_id->getErrorMessage() ?></div>
<?= $Grid->doctor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_doctor_id") ?>
<?php if (!$Grid->doctor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_doctor_id", selectId: "fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_doctor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_appointmentsgrid.lists.doctor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_doctor_id", form: "fpatient_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_doctor_id", form: "fpatient_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_appointments.fields.doctor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_doctor_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_doctor_id" id="o<?= $Grid->RowIndex ?>_doctor_id" value="<?= HtmlEncode($Grid->doctor_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_doctor_id" class="el_patient_appointments_doctor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_doctor_id"
        name="x<?= $Grid->RowIndex ?>_doctor_id"
        class="form-select ew-select<?= $Grid->doctor_id->isInvalidClass() ?>"
        <?php if (!$Grid->doctor_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_doctor_id"
        <?php } ?>
        data-table="patient_appointments"
        data-field="x_doctor_id"
        data-value-separator="<?= $Grid->doctor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->doctor_id->getPlaceHolder()) ?>"
        <?= $Grid->doctor_id->editAttributes() ?>>
        <?= $Grid->doctor_id->selectOptionListHtml("x{$Grid->RowIndex}_doctor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->doctor_id->getErrorMessage() ?></div>
<?= $Grid->doctor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_doctor_id") ?>
<?php if (!$Grid->doctor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_appointmentsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_doctor_id", selectId: "fpatient_appointmentsgrid_x<?= $Grid->RowIndex ?>_doctor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_appointmentsgrid.lists.doctor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_doctor_id", form: "fpatient_appointmentsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_doctor_id", form: "fpatient_appointmentsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_appointments.fields.doctor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_doctor_id" class="el_patient_appointments_doctor_id">
<span<?= $Grid->doctor_id->viewAttributes() ?>>
<?= $Grid->doctor_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_doctor_id" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_doctor_id" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_doctor_id" value="<?= HtmlEncode($Grid->doctor_id->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_doctor_id" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_doctor_id" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_doctor_id" value="<?= HtmlEncode($Grid->doctor_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->start_date->Visible) { // start_date ?>
        <td data-name="start_date"<?= $Grid->start_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_start_date" class="el_patient_appointments_start_date">
<input type="<?= $Grid->start_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_start_date" id="x<?= $Grid->RowIndex ?>_start_date" data-table="patient_appointments" data-field="x_start_date" value="<?= $Grid->start_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->start_date->formatPattern()) ?>"<?= $Grid->start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->start_date->getErrorMessage() ?></div>
<?php if (!$Grid->start_date->ReadOnly && !$Grid->start_date->Disabled && !isset($Grid->start_date->EditAttrs["readonly"]) && !isset($Grid->start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_start_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_start_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_start_date" id="o<?= $Grid->RowIndex ?>_start_date" value="<?= HtmlEncode($Grid->start_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_start_date" class="el_patient_appointments_start_date">
<input type="<?= $Grid->start_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_start_date" id="x<?= $Grid->RowIndex ?>_start_date" data-table="patient_appointments" data-field="x_start_date" value="<?= $Grid->start_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->start_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->start_date->formatPattern()) ?>"<?= $Grid->start_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->start_date->getErrorMessage() ?></div>
<?php if (!$Grid->start_date->ReadOnly && !$Grid->start_date->Disabled && !isset($Grid->start_date->EditAttrs["readonly"]) && !isset($Grid->start_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_start_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_start_date" class="el_patient_appointments_start_date">
<span<?= $Grid->start_date->viewAttributes() ?>>
<?= $Grid->start_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_start_date" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_start_date" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_start_date" value="<?= HtmlEncode($Grid->start_date->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_start_date" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_start_date" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_start_date" value="<?= HtmlEncode($Grid->start_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->end_date->Visible) { // end_date ?>
        <td data-name="end_date"<?= $Grid->end_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_end_date" class="el_patient_appointments_end_date">
<input type="<?= $Grid->end_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_end_date" id="x<?= $Grid->RowIndex ?>_end_date" data-table="patient_appointments" data-field="x_end_date" value="<?= $Grid->end_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->end_date->formatPattern()) ?>"<?= $Grid->end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->end_date->getErrorMessage() ?></div>
<?php if (!$Grid->end_date->ReadOnly && !$Grid->end_date->Disabled && !isset($Grid->end_date->EditAttrs["readonly"]) && !isset($Grid->end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_end_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_end_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_end_date" id="o<?= $Grid->RowIndex ?>_end_date" value="<?= HtmlEncode($Grid->end_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_end_date" class="el_patient_appointments_end_date">
<input type="<?= $Grid->end_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_end_date" id="x<?= $Grid->RowIndex ?>_end_date" data-table="patient_appointments" data-field="x_end_date" value="<?= $Grid->end_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->end_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->end_date->formatPattern()) ?>"<?= $Grid->end_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->end_date->getErrorMessage() ?></div>
<?php if (!$Grid->end_date->ReadOnly && !$Grid->end_date->Disabled && !isset($Grid->end_date->EditAttrs["readonly"]) && !isset($Grid->end_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_end_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_end_date" class="el_patient_appointments_end_date">
<span<?= $Grid->end_date->viewAttributes() ?>>
<?= $Grid->end_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_end_date" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_end_date" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_end_date" value="<?= HtmlEncode($Grid->end_date->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_end_date" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_end_date" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_end_date" value="<?= HtmlEncode($Grid->end_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->is_all_day->Visible) { // is_all_day ?>
        <td data-name="is_all_day"<?= $Grid->is_all_day->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_is_all_day" class="el_patient_appointments_is_all_day">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Grid->is_all_day->isInvalidClass() ?>" data-table="patient_appointments" data-field="x_is_all_day" data-boolean name="x<?= $Grid->RowIndex ?>_is_all_day" id="x<?= $Grid->RowIndex ?>_is_all_day" value="1"<?= ConvertToBool($Grid->is_all_day->CurrentValue) ? " checked" : "" ?><?= $Grid->is_all_day->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Grid->is_all_day->getErrorMessage() ?></div>
</div>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_is_all_day" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_is_all_day" id="o<?= $Grid->RowIndex ?>_is_all_day" value="<?= HtmlEncode($Grid->is_all_day->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_is_all_day" class="el_patient_appointments_is_all_day">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Grid->is_all_day->isInvalidClass() ?>" data-table="patient_appointments" data-field="x_is_all_day" data-boolean name="x<?= $Grid->RowIndex ?>_is_all_day" id="x<?= $Grid->RowIndex ?>_is_all_day" value="1"<?= ConvertToBool($Grid->is_all_day->CurrentValue) ? " checked" : "" ?><?= $Grid->is_all_day->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Grid->is_all_day->getErrorMessage() ?></div>
</div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_is_all_day" class="el_patient_appointments_is_all_day">
<span<?= $Grid->is_all_day->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_is_all_day_<?= $Grid->RowCount ?>" class="form-check-input" value="<?= $Grid->is_all_day->getViewValue() ?>" disabled<?php if (ConvertToBool($Grid->is_all_day->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_is_all_day_<?= $Grid->RowCount ?>"></label>
</div>
</span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_is_all_day" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_is_all_day" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_is_all_day" value="<?= HtmlEncode($Grid->is_all_day->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_is_all_day" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_is_all_day" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_is_all_day" value="<?= HtmlEncode($Grid->is_all_day->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_created" class="el_patient_appointments_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_appointments" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_created" class="el_patient_appointments_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_appointments" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_created" class="el_patient_appointments_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_date_created" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_date_created" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_updated" class="el_patient_appointments_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patient_appointments" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_appointments" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_updated" class="el_patient_appointments_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patient_appointments" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_appointmentsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_appointmentsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_appointments_date_updated" class="el_patient_appointments_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_appointments" data-field="x_date_updated" data-hidden="1" name="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fpatient_appointmentsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="patient_appointments" data-field="x_date_updated" data-hidden="1" data-old name="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fpatient_appointmentsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fpatient_appointmentsgrid","load"], () => fpatient_appointmentsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatient_appointmentsgrid">
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
    ew.addEventHandlers("patient_appointments");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
