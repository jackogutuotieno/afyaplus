<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientsLabReportGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatients_lab_reportgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patients_lab_report: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_lab_reportgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
            ["patient_name", [fields.patient_name.visible && fields.patient_name.required ? ew.Validators.required(fields.patient_name.caption) : null], fields.patient_name.isInvalid],
            ["Group_Concat_service_name", [fields.Group_Concat_service_name.visible && fields.Group_Concat_service_name.required ? ew.Validators.required(fields.Group_Concat_service_name.caption) : null], fields.Group_Concat_service_name.isInvalid],
            ["patient_age", [fields.patient_age.visible && fields.patient_age.required ? ew.Validators.required(fields.patient_age.caption) : null, ew.Validators.integer], fields.patient_age.isInvalid],
            ["details", [fields.details.visible && fields.details.required ? ew.Validators.required(fields.details.caption) : null], fields.details.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["laboratorist", [fields.laboratorist.visible && fields.laboratorist.required ? ew.Validators.required(fields.laboratorist.caption) : null], fields.laboratorist.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["id",false],["patient_name",false],["Group_Concat_service_name",false],["patient_age",false],["details",false],["status",false],["laboratorist",false],["date_created",false],["date_updated",false]];
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
<div id="fpatients_lab_reportgrid" class="ew-form ew-list-form">
<div id="gmp_patients_lab_report" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patients_lab_reportgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_patients_lab_report_id" class="patients_lab_report_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <th data-name="patient_name" class="<?= $Grid->patient_name->headerCellClass() ?>"><div id="elh_patients_lab_report_patient_name" class="patients_lab_report_patient_name"><?= $Grid->renderFieldHeader($Grid->patient_name) ?></div></th>
<?php } ?>
<?php if ($Grid->Group_Concat_service_name->Visible) { // Group_Concat_service_name ?>
        <th data-name="Group_Concat_service_name" class="<?= $Grid->Group_Concat_service_name->headerCellClass() ?>"><div id="elh_patients_lab_report_Group_Concat_service_name" class="patients_lab_report_Group_Concat_service_name"><?= $Grid->renderFieldHeader($Grid->Group_Concat_service_name) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_age->Visible) { // patient_age ?>
        <th data-name="patient_age" class="<?= $Grid->patient_age->headerCellClass() ?>"><div id="elh_patients_lab_report_patient_age" class="patients_lab_report_patient_age"><?= $Grid->renderFieldHeader($Grid->patient_age) ?></div></th>
<?php } ?>
<?php if ($Grid->details->Visible) { // details ?>
        <th data-name="details" class="<?= $Grid->details->headerCellClass() ?>"><div id="elh_patients_lab_report_details" class="patients_lab_report_details"><?= $Grid->renderFieldHeader($Grid->details) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_patients_lab_report_status" class="patients_lab_report_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->laboratorist->Visible) { // laboratorist ?>
        <th data-name="laboratorist" class="<?= $Grid->laboratorist->headerCellClass() ?>"><div id="elh_patients_lab_report_laboratorist" class="patients_lab_report_laboratorist"><?= $Grid->renderFieldHeader($Grid->laboratorist) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patients_lab_report_date_created" class="patients_lab_report_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_patients_lab_report_date_updated" class="patients_lab_report_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_id" class="el_patients_lab_report_id">
<input type="<?= $Grid->id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" data-table="patients_lab_report" data-field="x_id" value="<?= $Grid->id->EditValue ?>" placeholder="<?= HtmlEncode($Grid->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->id->formatPattern()) ?>"<?= $Grid->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_id" class="el_patients_lab_report_id">
<input type="<?= $Grid->id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" data-table="patients_lab_report" data-field="x_id" value="<?= $Grid->id->EditValue ?>" placeholder="<?= HtmlEncode($Grid->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->id->formatPattern()) ?>"<?= $Grid->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id->getErrorMessage() ?></div>
<input type="hidden" data-table="patients_lab_report" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue ?? $Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_id" class="el_patients_lab_report_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_id" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_id" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_id" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_id" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="patients_lab_report" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name"<?= $Grid->patient_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_name" class="el_patients_lab_report_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="patients_lab_report" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_name" id="o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_name" class="el_patients_lab_report_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="patients_lab_report" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_name" class="el_patients_lab_report_patient_name">
<span<?= $Grid->patient_name->viewAttributes() ?>>
<?= $Grid->patient_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_name" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_patient_name" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_name" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_patient_name" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->Group_Concat_service_name->Visible) { // Group_Concat_service_name ?>
        <td data-name="Group_Concat_service_name"<?= $Grid->Group_Concat_service_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_Group_Concat_service_name" class="el_patients_lab_report_Group_Concat_service_name">
<input type="<?= $Grid->Group_Concat_service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_Group_Concat_service_name" id="x<?= $Grid->RowIndex ?>_Group_Concat_service_name" data-table="patients_lab_report" data-field="x_Group_Concat_service_name" value="<?= $Grid->Group_Concat_service_name->EditValue ?>" size="30" maxlength="4096" placeholder="<?= HtmlEncode($Grid->Group_Concat_service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->Group_Concat_service_name->formatPattern()) ?>"<?= $Grid->Group_Concat_service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->Group_Concat_service_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_Group_Concat_service_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_Group_Concat_service_name" id="o<?= $Grid->RowIndex ?>_Group_Concat_service_name" value="<?= HtmlEncode($Grid->Group_Concat_service_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_Group_Concat_service_name" class="el_patients_lab_report_Group_Concat_service_name">
<input type="<?= $Grid->Group_Concat_service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_Group_Concat_service_name" id="x<?= $Grid->RowIndex ?>_Group_Concat_service_name" data-table="patients_lab_report" data-field="x_Group_Concat_service_name" value="<?= $Grid->Group_Concat_service_name->EditValue ?>" size="30" maxlength="4096" placeholder="<?= HtmlEncode($Grid->Group_Concat_service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->Group_Concat_service_name->formatPattern()) ?>"<?= $Grid->Group_Concat_service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->Group_Concat_service_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_Group_Concat_service_name" class="el_patients_lab_report_Group_Concat_service_name">
<span<?= $Grid->Group_Concat_service_name->viewAttributes() ?>>
<?= $Grid->Group_Concat_service_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_Group_Concat_service_name" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_Group_Concat_service_name" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_Group_Concat_service_name" value="<?= HtmlEncode($Grid->Group_Concat_service_name->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_Group_Concat_service_name" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_Group_Concat_service_name" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_Group_Concat_service_name" value="<?= HtmlEncode($Grid->Group_Concat_service_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_age->Visible) { // patient_age ?>
        <td data-name="patient_age"<?= $Grid->patient_age->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_age" class="el_patients_lab_report_patient_age">
<input type="<?= $Grid->patient_age->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_age" id="x<?= $Grid->RowIndex ?>_patient_age" data-table="patients_lab_report" data-field="x_patient_age" value="<?= $Grid->patient_age->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_age->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_age->formatPattern()) ?>"<?= $Grid->patient_age->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_age->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_age" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_age" id="o<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_age" class="el_patients_lab_report_patient_age">
<input type="<?= $Grid->patient_age->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_age" id="x<?= $Grid->RowIndex ?>_patient_age" data-table="patients_lab_report" data-field="x_patient_age" value="<?= $Grid->patient_age->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_age->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_age->formatPattern()) ?>"<?= $Grid->patient_age->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_age->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_patient_age" class="el_patients_lab_report_patient_age">
<span<?= $Grid->patient_age->viewAttributes() ?>>
<?= $Grid->patient_age->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_age" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_patient_age" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_patient_age" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_patient_age" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_patient_age" value="<?= HtmlEncode($Grid->patient_age->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->details->Visible) { // details ?>
        <td data-name="details"<?= $Grid->details->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_details" class="el_patients_lab_report_details">
<input type="<?= $Grid->details->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_details" id="x<?= $Grid->RowIndex ?>_details" data-table="patients_lab_report" data-field="x_details" value="<?= $Grid->details->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->details->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->details->formatPattern()) ?>"<?= $Grid->details->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->details->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_details" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_details" id="o<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_details" class="el_patients_lab_report_details">
<input type="<?= $Grid->details->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_details" id="x<?= $Grid->RowIndex ?>_details" data-table="patients_lab_report" data-field="x_details" value="<?= $Grid->details->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->details->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->details->formatPattern()) ?>"<?= $Grid->details->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->details->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_details" class="el_patients_lab_report_details">
<span<?= $Grid->details->viewAttributes() ?>>
<?= $Grid->details->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_details" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_details" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_details" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_details" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_status" class="el_patients_lab_report_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patients_lab_report" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_status" class="el_patients_lab_report_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patients_lab_report" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_status" class="el_patients_lab_report_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_status" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_status" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_status" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_status" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->laboratorist->Visible) { // laboratorist ?>
        <td data-name="laboratorist"<?= $Grid->laboratorist->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_laboratorist" class="el_patients_lab_report_laboratorist">
<input type="<?= $Grid->laboratorist->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_laboratorist" id="x<?= $Grid->RowIndex ?>_laboratorist" data-table="patients_lab_report" data-field="x_laboratorist" value="<?= $Grid->laboratorist->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->laboratorist->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->laboratorist->formatPattern()) ?>"<?= $Grid->laboratorist->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->laboratorist->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_laboratorist" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_laboratorist" id="o<?= $Grid->RowIndex ?>_laboratorist" value="<?= HtmlEncode($Grid->laboratorist->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_laboratorist" class="el_patients_lab_report_laboratorist">
<input type="<?= $Grid->laboratorist->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_laboratorist" id="x<?= $Grid->RowIndex ?>_laboratorist" data-table="patients_lab_report" data-field="x_laboratorist" value="<?= $Grid->laboratorist->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->laboratorist->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->laboratorist->formatPattern()) ?>"<?= $Grid->laboratorist->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->laboratorist->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_laboratorist" class="el_patients_lab_report_laboratorist">
<span<?= $Grid->laboratorist->viewAttributes() ?>>
<?= $Grid->laboratorist->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_laboratorist" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_laboratorist" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_laboratorist" value="<?= HtmlEncode($Grid->laboratorist->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_laboratorist" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_laboratorist" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_laboratorist" value="<?= HtmlEncode($Grid->laboratorist->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_created" class="el_patients_lab_report_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_lab_report" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_lab_reportgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_lab_reportgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_created" class="el_patients_lab_report_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_lab_report" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_lab_reportgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_lab_reportgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_created" class="el_patients_lab_report_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_date_created" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_date_created" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_updated" class="el_patients_lab_report_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_lab_report" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_lab_reportgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_lab_reportgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_lab_report" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_updated" class="el_patients_lab_report_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_lab_report" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_lab_reportgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_lab_reportgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_lab_report_date_updated" class="el_patients_lab_report_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_lab_report" data-field="x_date_updated" data-hidden="1" name="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fpatients_lab_reportgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="patients_lab_report" data-field="x_date_updated" data-hidden="1" data-old name="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fpatients_lab_reportgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fpatients_lab_reportgrid","load"], () => fpatients_lab_reportgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatients_lab_reportgrid">
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
    ew.addEventHandlers("patients_lab_report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
