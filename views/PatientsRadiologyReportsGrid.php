<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientsRadiologyReportsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatients_radiology_reportsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patients_radiology_reports: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_radiology_reportsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["radiology_requests_id", [fields.radiology_requests_id.visible && fields.radiology_requests_id.required ? ew.Validators.required(fields.radiology_requests_id.caption) : null, ew.Validators.integer], fields.radiology_requests_id.isInvalid],
            ["patient_name", [fields.patient_name.visible && fields.patient_name.required ? ew.Validators.required(fields.patient_name.caption) : null], fields.patient_name.isInvalid],
            ["gender", [fields.gender.visible && fields.gender.required ? ew.Validators.required(fields.gender.caption) : null], fields.gender.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["radiologist", [fields.radiologist.visible && fields.radiologist.required ? ew.Validators.required(fields.radiologist.caption) : null], fields.radiologist.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["radiology_requests_id",false],["patient_name",false],["gender",false],["service_name",false],["status",false],["radiologist",false],["date_created",false],["date_updated",false]];
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
<div id="fpatients_radiology_reportsgrid" class="ew-form ew-list-form">
<div id="gmp_patients_radiology_reports" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patients_radiology_reportsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->radiology_requests_id->Visible) { // radiology_requests_id ?>
        <th data-name="radiology_requests_id" class="<?= $Grid->radiology_requests_id->headerCellClass() ?>"><div id="elh_patients_radiology_reports_radiology_requests_id" class="patients_radiology_reports_radiology_requests_id"><?= $Grid->renderFieldHeader($Grid->radiology_requests_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <th data-name="patient_name" class="<?= $Grid->patient_name->headerCellClass() ?>"><div id="elh_patients_radiology_reports_patient_name" class="patients_radiology_reports_patient_name"><?= $Grid->renderFieldHeader($Grid->patient_name) ?></div></th>
<?php } ?>
<?php if ($Grid->gender->Visible) { // gender ?>
        <th data-name="gender" class="<?= $Grid->gender->headerCellClass() ?>"><div id="elh_patients_radiology_reports_gender" class="patients_radiology_reports_gender"><?= $Grid->renderFieldHeader($Grid->gender) ?></div></th>
<?php } ?>
<?php if ($Grid->service_name->Visible) { // service_name ?>
        <th data-name="service_name" class="<?= $Grid->service_name->headerCellClass() ?>"><div id="elh_patients_radiology_reports_service_name" class="patients_radiology_reports_service_name"><?= $Grid->renderFieldHeader($Grid->service_name) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_patients_radiology_reports_status" class="patients_radiology_reports_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->radiologist->Visible) { // radiologist ?>
        <th data-name="radiologist" class="<?= $Grid->radiologist->headerCellClass() ?>"><div id="elh_patients_radiology_reports_radiologist" class="patients_radiology_reports_radiologist"><?= $Grid->renderFieldHeader($Grid->radiologist) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patients_radiology_reports_date_created" class="patients_radiology_reports_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_patients_radiology_reports_date_updated" class="patients_radiology_reports_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
    <?php if ($Grid->radiology_requests_id->Visible) { // radiology_requests_id ?>
        <td data-name="radiology_requests_id"<?= $Grid->radiology_requests_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiology_requests_id" class="el_patients_radiology_reports_radiology_requests_id">
<input type="<?= $Grid->radiology_requests_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiology_requests_id" id="x<?= $Grid->RowIndex ?>_radiology_requests_id" data-table="patients_radiology_reports" data-field="x_radiology_requests_id" value="<?= $Grid->radiology_requests_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->radiology_requests_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiology_requests_id->formatPattern()) ?>"<?= $Grid->radiology_requests_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiology_requests_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiology_requests_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_radiology_requests_id" id="o<?= $Grid->RowIndex ?>_radiology_requests_id" value="<?= HtmlEncode($Grid->radiology_requests_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiology_requests_id" class="el_patients_radiology_reports_radiology_requests_id">
<input type="<?= $Grid->radiology_requests_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiology_requests_id" id="x<?= $Grid->RowIndex ?>_radiology_requests_id" data-table="patients_radiology_reports" data-field="x_radiology_requests_id" value="<?= $Grid->radiology_requests_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->radiology_requests_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiology_requests_id->formatPattern()) ?>"<?= $Grid->radiology_requests_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiology_requests_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiology_requests_id" class="el_patients_radiology_reports_radiology_requests_id">
<span<?= $Grid->radiology_requests_id->viewAttributes() ?>>
<?= $Grid->radiology_requests_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiology_requests_id" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_radiology_requests_id" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_radiology_requests_id" value="<?= HtmlEncode($Grid->radiology_requests_id->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiology_requests_id" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_radiology_requests_id" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_radiology_requests_id" value="<?= HtmlEncode($Grid->radiology_requests_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name"<?= $Grid->patient_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_name" class="el_patients_radiology_reports_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="patients_radiology_reports" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_name" id="o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_name" class="el_patients_radiology_reports_patient_name">
<input type="<?= $Grid->patient_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_name" id="x<?= $Grid->RowIndex ?>_patient_name" data-table="patients_radiology_reports" data-field="x_patient_name" value="<?= $Grid->patient_name->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->patient_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_name->formatPattern()) ?>"<?= $Grid->patient_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_name" class="el_patients_radiology_reports_patient_name">
<span<?= $Grid->patient_name->viewAttributes() ?>>
<?= $Grid->patient_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_name" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_patient_name" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_name" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_patient_name" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_patient_name" value="<?= HtmlEncode($Grid->patient_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->gender->Visible) { // gender ?>
        <td data-name="gender"<?= $Grid->gender->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_gender" class="el_patients_radiology_reports_gender">
<input type="<?= $Grid->gender->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_gender" id="x<?= $Grid->RowIndex ?>_gender" data-table="patients_radiology_reports" data-field="x_gender" value="<?= $Grid->gender->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->gender->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->gender->formatPattern()) ?>"<?= $Grid->gender->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gender->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_gender" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_gender" id="o<?= $Grid->RowIndex ?>_gender" value="<?= HtmlEncode($Grid->gender->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_gender" class="el_patients_radiology_reports_gender">
<input type="<?= $Grid->gender->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_gender" id="x<?= $Grid->RowIndex ?>_gender" data-table="patients_radiology_reports" data-field="x_gender" value="<?= $Grid->gender->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->gender->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->gender->formatPattern()) ?>"<?= $Grid->gender->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gender->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_gender" class="el_patients_radiology_reports_gender">
<span<?= $Grid->gender->viewAttributes() ?>>
<?= $Grid->gender->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_gender" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_gender" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_gender" value="<?= HtmlEncode($Grid->gender->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_gender" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_gender" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_gender" value="<?= HtmlEncode($Grid->gender->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->service_name->Visible) { // service_name ?>
        <td data-name="service_name"<?= $Grid->service_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_service_name" class="el_patients_radiology_reports_service_name">
<input type="<?= $Grid->service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_service_name" id="x<?= $Grid->RowIndex ?>_service_name" data-table="patients_radiology_reports" data-field="x_service_name" value="<?= $Grid->service_name->EditValue ?>" size="30" maxlength="4096" placeholder="<?= HtmlEncode($Grid->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->service_name->formatPattern()) ?>"<?= $Grid->service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->service_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_service_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_service_name" id="o<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_service_name" class="el_patients_radiology_reports_service_name">
<input type="<?= $Grid->service_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_service_name" id="x<?= $Grid->RowIndex ?>_service_name" data-table="patients_radiology_reports" data-field="x_service_name" value="<?= $Grid->service_name->EditValue ?>" size="30" maxlength="4096" placeholder="<?= HtmlEncode($Grid->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->service_name->formatPattern()) ?>"<?= $Grid->service_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->service_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_service_name" class="el_patients_radiology_reports_service_name">
<span<?= $Grid->service_name->viewAttributes() ?>>
<?= $Grid->service_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_service_name" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_service_name" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_service_name" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_service_name" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_service_name" value="<?= HtmlEncode($Grid->service_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_status" class="el_patients_radiology_reports_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patients_radiology_reports" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_status" class="el_patients_radiology_reports_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patients_radiology_reports" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_status" class="el_patients_radiology_reports_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_status" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_status" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_status" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_status" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->radiologist->Visible) { // radiologist ?>
        <td data-name="radiologist"<?= $Grid->radiologist->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiologist" class="el_patients_radiology_reports_radiologist">
<input type="<?= $Grid->radiologist->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiologist" id="x<?= $Grid->RowIndex ?>_radiologist" data-table="patients_radiology_reports" data-field="x_radiologist" value="<?= $Grid->radiologist->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->radiologist->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiologist->formatPattern()) ?>"<?= $Grid->radiologist->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiologist->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiologist" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_radiologist" id="o<?= $Grid->RowIndex ?>_radiologist" value="<?= HtmlEncode($Grid->radiologist->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiologist" class="el_patients_radiology_reports_radiologist">
<input type="<?= $Grid->radiologist->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiologist" id="x<?= $Grid->RowIndex ?>_radiologist" data-table="patients_radiology_reports" data-field="x_radiologist" value="<?= $Grid->radiologist->EditValue ?>" size="30" maxlength="101" placeholder="<?= HtmlEncode($Grid->radiologist->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiologist->formatPattern()) ?>"<?= $Grid->radiologist->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiologist->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_radiologist" class="el_patients_radiology_reports_radiologist">
<span<?= $Grid->radiologist->viewAttributes() ?>>
<?= $Grid->radiologist->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiologist" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_radiologist" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_radiologist" value="<?= HtmlEncode($Grid->radiologist->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_radiologist" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_radiologist" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_radiologist" value="<?= HtmlEncode($Grid->radiologist->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_created" class="el_patients_radiology_reports_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_radiology_reports" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_radiology_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_radiology_reportsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_created" class="el_patients_radiology_reports_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_radiology_reports" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_radiology_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_radiology_reportsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_created" class="el_patients_radiology_reports_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_created" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_created" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_updated" class="el_patients_radiology_reports_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_radiology_reports" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_radiology_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_radiology_reportsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_updated" class="el_patients_radiology_reports_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_radiology_reports" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_radiology_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_radiology_reportsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_date_updated" class="el_patients_radiology_reports_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_updated" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_date_updated" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fpatients_radiology_reportsgrid","load"], () => fpatients_radiology_reportsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatients_radiology_reportsgrid">
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
    ew.addEventHandlers("patients_radiology_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
