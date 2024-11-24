<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("DoctorNotesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fdoctor_notesgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { doctor_notes: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdoctor_notesgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null], fields.visit_id.isInvalid],
            ["chief_complaint", [fields.chief_complaint.visible && fields.chief_complaint.required ? ew.Validators.required(fields.chief_complaint.caption) : null], fields.chief_complaint.isInvalid],
            ["history_of_presenting_illness", [fields.history_of_presenting_illness.visible && fields.history_of_presenting_illness.required ? ew.Validators.required(fields.history_of_presenting_illness.caption) : null], fields.history_of_presenting_illness.isInvalid],
            ["past_medical_history", [fields.past_medical_history.visible && fields.past_medical_history.required ? ew.Validators.required(fields.past_medical_history.caption) : null], fields.past_medical_history.isInvalid],
            ["family_history", [fields.family_history.visible && fields.family_history.required ? ew.Validators.required(fields.family_history.caption) : null], fields.family_history.isInvalid],
            ["allergies", [fields.allergies.visible && fields.allergies.required ? ew.Validators.required(fields.allergies.caption) : null], fields.allergies.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["visit_id",false],["chief_complaint",false],["history_of_presenting_illness",false],["past_medical_history",false],["family_history",false],["allergies",false],["date_created",false],["date_updated",false]];
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
            "visit_id": <?= $Grid->visit_id->toClientList($Grid) ?>,
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
<div id="fdoctor_notesgrid" class="ew-form ew-list-form">
<div id="gmp_doctor_notes" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_doctor_notesgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_doctor_notes_id" class="doctor_notes_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_doctor_notes_patient_id" class="doctor_notes_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <th data-name="visit_id" class="<?= $Grid->visit_id->headerCellClass() ?>"><div id="elh_doctor_notes_visit_id" class="doctor_notes_visit_id"><?= $Grid->renderFieldHeader($Grid->visit_id) ?></div></th>
<?php } ?>
<?php if ($Grid->chief_complaint->Visible) { // chief_complaint ?>
        <th data-name="chief_complaint" class="<?= $Grid->chief_complaint->headerCellClass() ?>"><div id="elh_doctor_notes_chief_complaint" class="doctor_notes_chief_complaint"><?= $Grid->renderFieldHeader($Grid->chief_complaint) ?></div></th>
<?php } ?>
<?php if ($Grid->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
        <th data-name="history_of_presenting_illness" class="<?= $Grid->history_of_presenting_illness->headerCellClass() ?>"><div id="elh_doctor_notes_history_of_presenting_illness" class="doctor_notes_history_of_presenting_illness"><?= $Grid->renderFieldHeader($Grid->history_of_presenting_illness) ?></div></th>
<?php } ?>
<?php if ($Grid->past_medical_history->Visible) { // past_medical_history ?>
        <th data-name="past_medical_history" class="<?= $Grid->past_medical_history->headerCellClass() ?>"><div id="elh_doctor_notes_past_medical_history" class="doctor_notes_past_medical_history"><?= $Grid->renderFieldHeader($Grid->past_medical_history) ?></div></th>
<?php } ?>
<?php if ($Grid->family_history->Visible) { // family_history ?>
        <th data-name="family_history" class="<?= $Grid->family_history->headerCellClass() ?>"><div id="elh_doctor_notes_family_history" class="doctor_notes_family_history"><?= $Grid->renderFieldHeader($Grid->family_history) ?></div></th>
<?php } ?>
<?php if ($Grid->allergies->Visible) { // allergies ?>
        <th data-name="allergies" class="<?= $Grid->allergies->headerCellClass() ?>"><div id="elh_doctor_notes_allergies" class="doctor_notes_allergies"><?= $Grid->renderFieldHeader($Grid->allergies) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_doctor_notes_created_by_user_id" class="doctor_notes_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_doctor_notes_date_created" class="doctor_notes_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_doctor_notes_date_updated" class="doctor_notes_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_id" class="el_doctor_notes_id"></span>
<input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_id" class="el_doctor_notes_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_id" class="el_doctor_notes_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_id" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_id" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_patient_id" class="el_doctor_notes_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="doctor_notes"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<?php if (!$Grid->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdoctor_notesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdoctor_notesgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fdoctor_notesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fdoctor_notesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.doctor_notes.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="doctor_notes" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_patient_id" class="el_doctor_notes_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="doctor_notes"
        data-field="x_patient_id"
        data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->patient_id->editAttributes() ?>>
        <?= $Grid->patient_id->selectOptionListHtml("x{$Grid->RowIndex}_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
<?php if (!$Grid->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdoctor_notesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdoctor_notesgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fdoctor_notesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fdoctor_notesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.doctor_notes.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_patient_id" class="el_doctor_notes_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_patient_id" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_patient_id" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <td data-name="visit_id"<?= $Grid->visit_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_visit_id" class="el_doctor_notes_visit_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_id"
        name="x<?= $Grid->RowIndex ?>_visit_id"
        class="form-select ew-select<?= $Grid->visit_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_id->IsNativeSelect) { ?>
        data-select2-id="fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_visit_id"
        <?php } ?>
        data-table="doctor_notes"
        data-field="x_visit_id"
        data-value-separator="<?= $Grid->visit_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_id->editAttributes() ?>>
        <?= $Grid->visit_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
<?= $Grid->visit_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_id") ?>
<?php if (!$Grid->visit_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdoctor_notesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_id", selectId: "fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_visit_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdoctor_notesgrid.lists.visit_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_id", form: "fdoctor_notesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_id", form: "fdoctor_notesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.doctor_notes.fields.visit_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_visit_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_id" id="o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_visit_id" class="el_doctor_notes_visit_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_id"
        name="x<?= $Grid->RowIndex ?>_visit_id"
        class="form-select ew-select<?= $Grid->visit_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_id->IsNativeSelect) { ?>
        data-select2-id="fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_visit_id"
        <?php } ?>
        data-table="doctor_notes"
        data-field="x_visit_id"
        data-value-separator="<?= $Grid->visit_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_id->editAttributes() ?>>
        <?= $Grid->visit_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
<?= $Grid->visit_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_id") ?>
<?php if (!$Grid->visit_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdoctor_notesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_id", selectId: "fdoctor_notesgrid_x<?= $Grid->RowIndex ?>_visit_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdoctor_notesgrid.lists.visit_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_id", form: "fdoctor_notesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_id", form: "fdoctor_notesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.doctor_notes.fields.visit_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_visit_id" class="el_doctor_notes_visit_id">
<span<?= $Grid->visit_id->viewAttributes() ?>>
<?= $Grid->visit_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_visit_id" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_visit_id" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_visit_id" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_visit_id" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->chief_complaint->Visible) { // chief_complaint ?>
        <td data-name="chief_complaint"<?= $Grid->chief_complaint->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_chief_complaint" class="el_doctor_notes_chief_complaint">
<input type="<?= $Grid->chief_complaint->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_chief_complaint" id="x<?= $Grid->RowIndex ?>_chief_complaint" data-table="doctor_notes" data-field="x_chief_complaint" value="<?= $Grid->chief_complaint->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->chief_complaint->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->chief_complaint->formatPattern()) ?>"<?= $Grid->chief_complaint->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->chief_complaint->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_chief_complaint" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_chief_complaint" id="o<?= $Grid->RowIndex ?>_chief_complaint" value="<?= HtmlEncode($Grid->chief_complaint->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_chief_complaint" class="el_doctor_notes_chief_complaint">
<input type="<?= $Grid->chief_complaint->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_chief_complaint" id="x<?= $Grid->RowIndex ?>_chief_complaint" data-table="doctor_notes" data-field="x_chief_complaint" value="<?= $Grid->chief_complaint->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->chief_complaint->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->chief_complaint->formatPattern()) ?>"<?= $Grid->chief_complaint->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->chief_complaint->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_chief_complaint" class="el_doctor_notes_chief_complaint">
<span<?= $Grid->chief_complaint->viewAttributes() ?>>
<?= $Grid->chief_complaint->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_chief_complaint" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_chief_complaint" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_chief_complaint" value="<?= HtmlEncode($Grid->chief_complaint->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_chief_complaint" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_chief_complaint" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_chief_complaint" value="<?= HtmlEncode($Grid->chief_complaint->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
        <td data-name="history_of_presenting_illness"<?= $Grid->history_of_presenting_illness->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_history_of_presenting_illness" class="el_doctor_notes_history_of_presenting_illness">
<input type="<?= $Grid->history_of_presenting_illness->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_history_of_presenting_illness" id="x<?= $Grid->RowIndex ?>_history_of_presenting_illness" data-table="doctor_notes" data-field="x_history_of_presenting_illness" value="<?= $Grid->history_of_presenting_illness->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->history_of_presenting_illness->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->history_of_presenting_illness->formatPattern()) ?>"<?= $Grid->history_of_presenting_illness->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->history_of_presenting_illness->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_history_of_presenting_illness" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_history_of_presenting_illness" id="o<?= $Grid->RowIndex ?>_history_of_presenting_illness" value="<?= HtmlEncode($Grid->history_of_presenting_illness->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_history_of_presenting_illness" class="el_doctor_notes_history_of_presenting_illness">
<input type="<?= $Grid->history_of_presenting_illness->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_history_of_presenting_illness" id="x<?= $Grid->RowIndex ?>_history_of_presenting_illness" data-table="doctor_notes" data-field="x_history_of_presenting_illness" value="<?= $Grid->history_of_presenting_illness->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->history_of_presenting_illness->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->history_of_presenting_illness->formatPattern()) ?>"<?= $Grid->history_of_presenting_illness->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->history_of_presenting_illness->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_history_of_presenting_illness" class="el_doctor_notes_history_of_presenting_illness">
<span<?= $Grid->history_of_presenting_illness->viewAttributes() ?>>
<?= $Grid->history_of_presenting_illness->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_history_of_presenting_illness" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_history_of_presenting_illness" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_history_of_presenting_illness" value="<?= HtmlEncode($Grid->history_of_presenting_illness->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_history_of_presenting_illness" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_history_of_presenting_illness" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_history_of_presenting_illness" value="<?= HtmlEncode($Grid->history_of_presenting_illness->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->past_medical_history->Visible) { // past_medical_history ?>
        <td data-name="past_medical_history"<?= $Grid->past_medical_history->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_past_medical_history" class="el_doctor_notes_past_medical_history">
<input type="<?= $Grid->past_medical_history->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_past_medical_history" id="x<?= $Grid->RowIndex ?>_past_medical_history" data-table="doctor_notes" data-field="x_past_medical_history" value="<?= $Grid->past_medical_history->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->past_medical_history->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->past_medical_history->formatPattern()) ?>"<?= $Grid->past_medical_history->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->past_medical_history->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_past_medical_history" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_past_medical_history" id="o<?= $Grid->RowIndex ?>_past_medical_history" value="<?= HtmlEncode($Grid->past_medical_history->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_past_medical_history" class="el_doctor_notes_past_medical_history">
<input type="<?= $Grid->past_medical_history->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_past_medical_history" id="x<?= $Grid->RowIndex ?>_past_medical_history" data-table="doctor_notes" data-field="x_past_medical_history" value="<?= $Grid->past_medical_history->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->past_medical_history->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->past_medical_history->formatPattern()) ?>"<?= $Grid->past_medical_history->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->past_medical_history->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_past_medical_history" class="el_doctor_notes_past_medical_history">
<span<?= $Grid->past_medical_history->viewAttributes() ?>>
<?= $Grid->past_medical_history->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_past_medical_history" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_past_medical_history" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_past_medical_history" value="<?= HtmlEncode($Grid->past_medical_history->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_past_medical_history" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_past_medical_history" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_past_medical_history" value="<?= HtmlEncode($Grid->past_medical_history->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->family_history->Visible) { // family_history ?>
        <td data-name="family_history"<?= $Grid->family_history->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_family_history" class="el_doctor_notes_family_history">
<input type="<?= $Grid->family_history->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_family_history" id="x<?= $Grid->RowIndex ?>_family_history" data-table="doctor_notes" data-field="x_family_history" value="<?= $Grid->family_history->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->family_history->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->family_history->formatPattern()) ?>"<?= $Grid->family_history->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->family_history->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_family_history" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_family_history" id="o<?= $Grid->RowIndex ?>_family_history" value="<?= HtmlEncode($Grid->family_history->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_family_history" class="el_doctor_notes_family_history">
<input type="<?= $Grid->family_history->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_family_history" id="x<?= $Grid->RowIndex ?>_family_history" data-table="doctor_notes" data-field="x_family_history" value="<?= $Grid->family_history->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->family_history->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->family_history->formatPattern()) ?>"<?= $Grid->family_history->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->family_history->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_family_history" class="el_doctor_notes_family_history">
<span<?= $Grid->family_history->viewAttributes() ?>>
<?= $Grid->family_history->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_family_history" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_family_history" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_family_history" value="<?= HtmlEncode($Grid->family_history->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_family_history" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_family_history" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_family_history" value="<?= HtmlEncode($Grid->family_history->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->allergies->Visible) { // allergies ?>
        <td data-name="allergies"<?= $Grid->allergies->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_allergies" class="el_doctor_notes_allergies">
<input type="<?= $Grid->allergies->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_allergies" id="x<?= $Grid->RowIndex ?>_allergies" data-table="doctor_notes" data-field="x_allergies" value="<?= $Grid->allergies->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->allergies->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->allergies->formatPattern()) ?>"<?= $Grid->allergies->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->allergies->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_allergies" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_allergies" id="o<?= $Grid->RowIndex ?>_allergies" value="<?= HtmlEncode($Grid->allergies->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_allergies" class="el_doctor_notes_allergies">
<input type="<?= $Grid->allergies->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_allergies" id="x<?= $Grid->RowIndex ?>_allergies" data-table="doctor_notes" data-field="x_allergies" value="<?= $Grid->allergies->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->allergies->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->allergies->formatPattern()) ?>"<?= $Grid->allergies->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->allergies->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_allergies" class="el_doctor_notes_allergies">
<span<?= $Grid->allergies->viewAttributes() ?>>
<?= $Grid->allergies->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_allergies" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_allergies" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_allergies" value="<?= HtmlEncode($Grid->allergies->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_allergies" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_allergies" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_allergies" value="<?= HtmlEncode($Grid->allergies->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<input type="hidden" data-table="doctor_notes" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_created_by_user_id" class="el_doctor_notes_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_created_by_user_id" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_created_by_user_id" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_created" class="el_doctor_notes_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="doctor_notes" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdoctor_notesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdoctor_notesgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_created" class="el_doctor_notes_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="doctor_notes" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdoctor_notesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdoctor_notesgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_created" class="el_doctor_notes_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_date_created" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_date_created" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_date_created" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_date_created" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_updated" class="el_doctor_notes_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="doctor_notes" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdoctor_notesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdoctor_notesgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="doctor_notes" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_updated" class="el_doctor_notes_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="doctor_notes" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdoctor_notesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdoctor_notesgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_doctor_notes_date_updated" class="el_doctor_notes_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="doctor_notes" data-field="x_date_updated" data-hidden="1" name="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fdoctor_notesgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="doctor_notes" data-field="x_date_updated" data-hidden="1" data-old name="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fdoctor_notesgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fdoctor_notesgrid","load"], () => fdoctor_notesgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fdoctor_notesgrid">
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
    ew.addEventHandlers("doctor_notes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
