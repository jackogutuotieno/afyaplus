<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("BedAssignmentGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fbed_assignmentgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { bed_assignment: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbed_assignmentgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["floor_id", [fields.floor_id.visible && fields.floor_id.required ? ew.Validators.required(fields.floor_id.caption) : null], fields.floor_id.isInvalid],
            ["ward_type_id", [fields.ward_type_id.visible && fields.ward_type_id.required ? ew.Validators.required(fields.ward_type_id.caption) : null], fields.ward_type_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_id", [fields.bed_id.visible && fields.bed_id.required ? ew.Validators.required(fields.bed_id.caption) : null], fields.bed_id.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["admission_id",false],["patient_id",false],["floor_id",false],["ward_type_id",false],["ward_id",false],["bed_id",false],["status",false],["date_created",false],["date_updated",false]];
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
            "floor_id": <?= $Grid->floor_id->toClientList($Grid) ?>,
            "ward_type_id": <?= $Grid->ward_type_id->toClientList($Grid) ?>,
            "ward_id": <?= $Grid->ward_id->toClientList($Grid) ?>,
            "bed_id": <?= $Grid->bed_id->toClientList($Grid) ?>,
            "status": <?= $Grid->status->toClientList($Grid) ?>,
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
<div id="fbed_assignmentgrid" class="ew-form ew-list-form">
<div id="gmp_bed_assignment" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_bed_assignmentgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="admission_id" class="<?= $Grid->admission_id->headerCellClass() ?>"><div id="elh_bed_assignment_admission_id" class="bed_assignment_admission_id"><?= $Grid->renderFieldHeader($Grid->admission_id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_bed_assignment_patient_id" class="bed_assignment_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->floor_id->Visible) { // floor_id ?>
        <th data-name="floor_id" class="<?= $Grid->floor_id->headerCellClass() ?>"><div id="elh_bed_assignment_floor_id" class="bed_assignment_floor_id"><?= $Grid->renderFieldHeader($Grid->floor_id) ?></div></th>
<?php } ?>
<?php if ($Grid->ward_type_id->Visible) { // ward_type_id ?>
        <th data-name="ward_type_id" class="<?= $Grid->ward_type_id->headerCellClass() ?>"><div id="elh_bed_assignment_ward_type_id" class="bed_assignment_ward_type_id"><?= $Grid->renderFieldHeader($Grid->ward_type_id) ?></div></th>
<?php } ?>
<?php if ($Grid->ward_id->Visible) { // ward_id ?>
        <th data-name="ward_id" class="<?= $Grid->ward_id->headerCellClass() ?>"><div id="elh_bed_assignment_ward_id" class="bed_assignment_ward_id"><?= $Grid->renderFieldHeader($Grid->ward_id) ?></div></th>
<?php } ?>
<?php if ($Grid->bed_id->Visible) { // bed_id ?>
        <th data-name="bed_id" class="<?= $Grid->bed_id->headerCellClass() ?>"><div id="elh_bed_assignment_bed_id" class="bed_assignment_bed_id"><?= $Grid->renderFieldHeader($Grid->bed_id) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_bed_assignment_status" class="bed_assignment_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_bed_assignment_date_created" class="bed_assignment_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_bed_assignment_date_updated" class="bed_assignment_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_admission_id" class="el_bed_assignment_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_admission_id" class="el_bed_assignment_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="bed_assignment" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="bed_assignment" data-field="x_admission_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_admission_id" id="o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->admission_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_admission_id" class="el_bed_assignment_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->admission_id->getDisplayValue($Grid->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_admission_id" name="x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_admission_id" class="el_bed_assignment_admission_id">
<input type="<?= $Grid->admission_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_admission_id" id="x<?= $Grid->RowIndex ?>_admission_id" data-table="bed_assignment" data-field="x_admission_id" value="<?= $Grid->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->admission_id->formatPattern()) ?>"<?= $Grid->admission_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_admission_id" class="el_bed_assignment_admission_id">
<span<?= $Grid->admission_id->viewAttributes() ?>>
<?= $Grid->admission_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_admission_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_admission_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_admission_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_admission_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_admission_id" value="<?= HtmlEncode($Grid->admission_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_patient_id" class="el_bed_assignment_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_patient_id" class="el_bed_assignment_patient_id">
<?php
if (IsRTL()) {
    $Grid->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Grid->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_patient_id" id="sv_x<?= $Grid->RowIndex ?>_patient_id" value="<?= RemoveHtml($Grid->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="bed_assignment" data-field="x_patient_id" data-input="sv_x<?= $Grid->RowIndex ?>_patient_id" data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    fbed_assignmentgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.bed_assignment.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="bed_assignment" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_patient_id" class="el_bed_assignment_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_patient_id" class="el_bed_assignment_patient_id">
<?php
if (IsRTL()) {
    $Grid->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_patient_id" class="ew-auto-suggest">
    <input type="<?= $Grid->patient_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_patient_id" id="sv_x<?= $Grid->RowIndex ?>_patient_id" value="<?= RemoveHtml($Grid->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="bed_assignment" data-field="x_patient_id" data-input="sv_x<?= $Grid->RowIndex ?>_patient_id" data-value-separator="<?= $Grid->patient_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    fbed_assignmentgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.bed_assignment.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Grid->patient_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_patient_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_patient_id" class="el_bed_assignment_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_patient_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_patient_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->floor_id->Visible) { // floor_id ?>
        <td data-name="floor_id"<?= $Grid->floor_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_floor_id" class="el_bed_assignment_floor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_floor_id"
        name="x<?= $Grid->RowIndex ?>_floor_id"
        class="form-select ew-select<?= $Grid->floor_id->isInvalidClass() ?>"
        <?php if (!$Grid->floor_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_floor_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_floor_id"
        data-value-separator="<?= $Grid->floor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->floor_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->floor_id->editAttributes() ?>>
        <?= $Grid->floor_id->selectOptionListHtml("x{$Grid->RowIndex}_floor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->floor_id->getErrorMessage() ?></div>
<?= $Grid->floor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_floor_id") ?>
<?php if (!$Grid->floor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_floor_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_floor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.floor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_floor_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_floor_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.floor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_floor_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_floor_id" id="o<?= $Grid->RowIndex ?>_floor_id" value="<?= HtmlEncode($Grid->floor_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_floor_id" class="el_bed_assignment_floor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_floor_id"
        name="x<?= $Grid->RowIndex ?>_floor_id"
        class="form-select ew-select<?= $Grid->floor_id->isInvalidClass() ?>"
        <?php if (!$Grid->floor_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_floor_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_floor_id"
        data-value-separator="<?= $Grid->floor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->floor_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->floor_id->editAttributes() ?>>
        <?= $Grid->floor_id->selectOptionListHtml("x{$Grid->RowIndex}_floor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->floor_id->getErrorMessage() ?></div>
<?= $Grid->floor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_floor_id") ?>
<?php if (!$Grid->floor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_floor_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_floor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.floor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_floor_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_floor_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.floor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_floor_id" class="el_bed_assignment_floor_id">
<span<?= $Grid->floor_id->viewAttributes() ?>>
<?= $Grid->floor_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_floor_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_floor_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_floor_id" value="<?= HtmlEncode($Grid->floor_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_floor_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_floor_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_floor_id" value="<?= HtmlEncode($Grid->floor_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ward_type_id->Visible) { // ward_type_id ?>
        <td data-name="ward_type_id"<?= $Grid->ward_type_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_type_id" class="el_bed_assignment_ward_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_type_id"
        name="x<?= $Grid->RowIndex ?>_ward_type_id"
        class="form-select ew-select<?= $Grid->ward_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_type_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_type_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_type_id"
        data-value-separator="<?= $Grid->ward_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_type_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->ward_type_id->editAttributes() ?>>
        <?= $Grid->ward_type_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_type_id->getErrorMessage() ?></div>
<?= $Grid->ward_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_type_id") ?>
<?php if (!$Grid->ward_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_type_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.ward_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_type_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_type_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_ward_type_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ward_type_id" id="o<?= $Grid->RowIndex ?>_ward_type_id" value="<?= HtmlEncode($Grid->ward_type_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_type_id" class="el_bed_assignment_ward_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_type_id"
        name="x<?= $Grid->RowIndex ?>_ward_type_id"
        class="form-select ew-select<?= $Grid->ward_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_type_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_type_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_type_id"
        data-value-separator="<?= $Grid->ward_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_type_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->ward_type_id->editAttributes() ?>>
        <?= $Grid->ward_type_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_type_id->getErrorMessage() ?></div>
<?= $Grid->ward_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_type_id") ?>
<?php if (!$Grid->ward_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_type_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.ward_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_type_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_type_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_type_id" class="el_bed_assignment_ward_type_id">
<span<?= $Grid->ward_type_id->viewAttributes() ?>>
<?= $Grid->ward_type_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_ward_type_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_ward_type_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_ward_type_id" value="<?= HtmlEncode($Grid->ward_type_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_ward_type_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_ward_type_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_ward_type_id" value="<?= HtmlEncode($Grid->ward_type_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ward_id->Visible) { // ward_id ?>
        <td data-name="ward_id"<?= $Grid->ward_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_id" class="el_bed_assignment_ward_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_id"
        name="x<?= $Grid->RowIndex ?>_ward_id"
        class="form-select ew-select<?= $Grid->ward_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_id"
        data-value-separator="<?= $Grid->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->ward_id->editAttributes() ?>>
        <?= $Grid->ward_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_id->getErrorMessage() ?></div>
<?= $Grid->ward_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_id") ?>
<?php if (!$Grid->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_ward_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ward_id" id="o<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_id" class="el_bed_assignment_ward_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_id"
        name="x<?= $Grid->RowIndex ?>_ward_id"
        class="form-select ew-select<?= $Grid->ward_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_id"
        data-value-separator="<?= $Grid->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Grid->ward_id->editAttributes() ?>>
        <?= $Grid->ward_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_id->getErrorMessage() ?></div>
<?= $Grid->ward_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_id") ?>
<?php if (!$Grid->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_ward_id" class="el_bed_assignment_ward_id">
<span<?= $Grid->ward_id->viewAttributes() ?>>
<?= $Grid->ward_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_ward_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_ward_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_ward_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_ward_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bed_id->Visible) { // bed_id ?>
        <td data-name="bed_id"<?= $Grid->bed_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_bed_id" class="el_bed_assignment_bed_id">
    <select
        id="x<?= $Grid->RowIndex ?>_bed_id"
        name="x<?= $Grid->RowIndex ?>_bed_id"
        class="form-select ew-select<?= $Grid->bed_id->isInvalidClass() ?>"
        <?php if (!$Grid->bed_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_bed_id"
        data-value-separator="<?= $Grid->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->bed_id->getPlaceHolder()) ?>"
        <?= $Grid->bed_id->editAttributes() ?>>
        <?= $Grid->bed_id->selectOptionListHtml("x{$Grid->RowIndex}_bed_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->bed_id->getErrorMessage() ?></div>
<?= $Grid->bed_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_bed_id") ?>
<?php if (!$Grid->bed_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_bed_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_bed_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_bed_id" id="o<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_bed_id" class="el_bed_assignment_bed_id">
    <select
        id="x<?= $Grid->RowIndex ?>_bed_id"
        name="x<?= $Grid->RowIndex ?>_bed_id"
        class="form-select ew-select<?= $Grid->bed_id->isInvalidClass() ?>"
        <?php if (!$Grid->bed_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_bed_id"
        data-value-separator="<?= $Grid->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->bed_id->getPlaceHolder()) ?>"
        <?= $Grid->bed_id->editAttributes() ?>>
        <?= $Grid->bed_id->selectOptionListHtml("x{$Grid->RowIndex}_bed_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->bed_id->getErrorMessage() ?></div>
<?= $Grid->bed_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_bed_id") ?>
<?php if (!$Grid->bed_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_bed_id", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_bed_id", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_bed_id" class="el_bed_assignment_bed_id">
<span<?= $Grid->bed_id->viewAttributes() ?>>
<?= $Grid->bed_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_bed_id" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_bed_id" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_bed_id" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_bed_id" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_bed_id" value="<?= HtmlEncode($Grid->bed_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_status" class="el_bed_assignment_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_status" class="el_bed_assignment_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fbed_assignmentgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fbed_assignmentgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fbed_assignmentgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_status" class="el_bed_assignment_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_status" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_status" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_status" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_status" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_created" class="el_bed_assignment_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="bed_assignment" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbed_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fbed_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_created" class="el_bed_assignment_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="bed_assignment" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbed_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fbed_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_created" class="el_bed_assignment_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_date_created" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_date_created" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_date_created" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_date_created" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_updated" class="el_bed_assignment_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="bed_assignment" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbed_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fbed_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bed_assignment" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_updated" class="el_bed_assignment_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="bed_assignment" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbed_assignmentgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fbed_assignmentgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_bed_assignment_date_updated" class="el_bed_assignment_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="bed_assignment" data-field="x_date_updated" data-hidden="1" name="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fbed_assignmentgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="bed_assignment" data-field="x_date_updated" data-hidden="1" data-old name="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fbed_assignmentgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fbed_assignmentgrid","load"], () => fbed_assignmentgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fbed_assignmentgrid">
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
    ew.addEventHandlers("bed_assignment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
