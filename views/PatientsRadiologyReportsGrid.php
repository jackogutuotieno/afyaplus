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
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["radiologist", [fields.radiologist.visible && fields.radiologist.required ? ew.Validators.required(fields.radiologist.caption) : null], fields.radiologist.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["id",false],["patient_id",false],["service_name",false],["status",false],["radiologist",false],["date_created",false]];
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
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_patients_radiology_reports_id" class="patients_radiology_reports_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patients_radiology_reports_patient_id" class="patients_radiology_reports_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_id" class="el_patients_radiology_reports_id">
<input type="<?= $Grid->id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" data-table="patients_radiology_reports" data-field="x_id" value="<?= $Grid->id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->id->formatPattern()) ?>"<?= $Grid->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_id" class="el_patients_radiology_reports_id">
<input type="<?= $Grid->id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" data-table="patients_radiology_reports" data-field="x_id" value="<?= $Grid->id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->id->formatPattern()) ?>"<?= $Grid->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_id" class="el_patients_radiology_reports_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_id" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_id" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_id" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_id" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_id" class="el_patients_radiology_reports_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_id" class="el_patients_radiology_reports_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatients_radiology_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patients_radiology_reports"
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
loadjs.ready("fpatients_radiology_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatients_radiology_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_radiology_reportsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_radiology_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_radiology_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_radiology_reports.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_id" class="el_patients_radiology_reports_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_id" class="el_patients_radiology_reports_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatients_radiology_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patients_radiology_reports"
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
loadjs.ready("fpatients_radiology_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatients_radiology_reportsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_radiology_reportsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_radiology_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatients_radiology_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_radiology_reports.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_radiology_reports_patient_id" class="el_patients_radiology_reports_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_id" data-hidden="1" name="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatients_radiology_reportsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patients_radiology_reports" data-field="x_patient_id" data-hidden="1" data-old name="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatients_radiology_reportsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
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
