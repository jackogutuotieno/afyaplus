<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientsDependantsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatients_dependantsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patients_dependants: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_dependantsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
            ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
            ["relationship", [fields.relationship.visible && fields.relationship.required ? ew.Validators.required(fields.relationship.caption) : null], fields.relationship.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["first_name",false],["last_name",false],["relationship",false],["date_created",false],["date_updated",false]];
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
            "relationship": <?= $Grid->relationship->toClientList($Grid) ?>,
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
<div id="fpatients_dependantsgrid" class="ew-form ew-list-form">
<div id="gmp_patients_dependants" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patients_dependantsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_patients_dependants_id" class="patients_dependants_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patients_dependants_patient_id" class="patients_dependants_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->first_name->Visible) { // first_name ?>
        <th data-name="first_name" class="<?= $Grid->first_name->headerCellClass() ?>"><div id="elh_patients_dependants_first_name" class="patients_dependants_first_name"><?= $Grid->renderFieldHeader($Grid->first_name) ?></div></th>
<?php } ?>
<?php if ($Grid->last_name->Visible) { // last_name ?>
        <th data-name="last_name" class="<?= $Grid->last_name->headerCellClass() ?>"><div id="elh_patients_dependants_last_name" class="patients_dependants_last_name"><?= $Grid->renderFieldHeader($Grid->last_name) ?></div></th>
<?php } ?>
<?php if ($Grid->relationship->Visible) { // relationship ?>
        <th data-name="relationship" class="<?= $Grid->relationship->headerCellClass() ?>"><div id="elh_patients_dependants_relationship" class="patients_dependants_relationship"><?= $Grid->renderFieldHeader($Grid->relationship) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patients_dependants_date_created" class="patients_dependants_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_patients_dependants_date_updated" class="patients_dependants_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_id" class="el_patients_dependants_id"></span>
<input type="hidden" data-table="patients_dependants" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_id" class="el_patients_dependants_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="patients_dependants" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_id" class="el_patients_dependants_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_id" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_id" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_id" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_id" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="patients_dependants" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_patient_id" class="el_patients_dependants_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_patient_id" class="el_patients_dependants_patient_id">
<input type="<?= $Grid->patient_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" data-table="patients_dependants" data-field="x_patient_id" value="<?= $Grid->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="patients_dependants" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_patient_id" class="el_patients_dependants_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_patient_id" class="el_patients_dependants_patient_id">
<input type="<?= $Grid->patient_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" data-table="patients_dependants" data-field="x_patient_id" value="<?= $Grid->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_patient_id" class="el_patients_dependants_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_patient_id" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_patient_id" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->first_name->Visible) { // first_name ?>
        <td data-name="first_name"<?= $Grid->first_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_first_name" class="el_patients_dependants_first_name">
<input type="<?= $Grid->first_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_first_name" id="x<?= $Grid->RowIndex ?>_first_name" data-table="patients_dependants" data-field="x_first_name" value="<?= $Grid->first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->first_name->formatPattern()) ?>"<?= $Grid->first_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->first_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_dependants" data-field="x_first_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_first_name" id="o<?= $Grid->RowIndex ?>_first_name" value="<?= HtmlEncode($Grid->first_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_first_name" class="el_patients_dependants_first_name">
<input type="<?= $Grid->first_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_first_name" id="x<?= $Grid->RowIndex ?>_first_name" data-table="patients_dependants" data-field="x_first_name" value="<?= $Grid->first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->first_name->formatPattern()) ?>"<?= $Grid->first_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->first_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_first_name" class="el_patients_dependants_first_name">
<span<?= $Grid->first_name->viewAttributes() ?>>
<?= $Grid->first_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_first_name" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_first_name" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_first_name" value="<?= HtmlEncode($Grid->first_name->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_first_name" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_first_name" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_first_name" value="<?= HtmlEncode($Grid->first_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->last_name->Visible) { // last_name ?>
        <td data-name="last_name"<?= $Grid->last_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_last_name" class="el_patients_dependants_last_name">
<input type="<?= $Grid->last_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_last_name" id="x<?= $Grid->RowIndex ?>_last_name" data-table="patients_dependants" data-field="x_last_name" value="<?= $Grid->last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->last_name->formatPattern()) ?>"<?= $Grid->last_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->last_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patients_dependants" data-field="x_last_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_last_name" id="o<?= $Grid->RowIndex ?>_last_name" value="<?= HtmlEncode($Grid->last_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_last_name" class="el_patients_dependants_last_name">
<input type="<?= $Grid->last_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_last_name" id="x<?= $Grid->RowIndex ?>_last_name" data-table="patients_dependants" data-field="x_last_name" value="<?= $Grid->last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->last_name->formatPattern()) ?>"<?= $Grid->last_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->last_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_last_name" class="el_patients_dependants_last_name">
<span<?= $Grid->last_name->viewAttributes() ?>>
<?= $Grid->last_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_last_name" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_last_name" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_last_name" value="<?= HtmlEncode($Grid->last_name->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_last_name" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_last_name" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_last_name" value="<?= HtmlEncode($Grid->last_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->relationship->Visible) { // relationship ?>
        <td data-name="relationship"<?= $Grid->relationship->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_relationship" class="el_patients_dependants_relationship">
    <select
        id="x<?= $Grid->RowIndex ?>_relationship"
        name="x<?= $Grid->RowIndex ?>_relationship"
        class="form-select ew-select<?= $Grid->relationship->isInvalidClass() ?>"
        <?php if (!$Grid->relationship->IsNativeSelect) { ?>
        data-select2-id="fpatients_dependantsgrid_x<?= $Grid->RowIndex ?>_relationship"
        <?php } ?>
        data-table="patients_dependants"
        data-field="x_relationship"
        data-value-separator="<?= $Grid->relationship->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->relationship->getPlaceHolder()) ?>"
        <?= $Grid->relationship->editAttributes() ?>>
        <?= $Grid->relationship->selectOptionListHtml("x{$Grid->RowIndex}_relationship") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->relationship->getErrorMessage() ?></div>
<?php if (!$Grid->relationship->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatients_dependantsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_relationship", selectId: "fpatients_dependantsgrid_x<?= $Grid->RowIndex ?>_relationship" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_dependantsgrid.lists.relationship?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_relationship", form: "fpatients_dependantsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_relationship", form: "fpatients_dependantsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_dependants.fields.relationship.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_dependants" data-field="x_relationship" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_relationship" id="o<?= $Grid->RowIndex ?>_relationship" value="<?= HtmlEncode($Grid->relationship->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_relationship" class="el_patients_dependants_relationship">
    <select
        id="x<?= $Grid->RowIndex ?>_relationship"
        name="x<?= $Grid->RowIndex ?>_relationship"
        class="form-select ew-select<?= $Grid->relationship->isInvalidClass() ?>"
        <?php if (!$Grid->relationship->IsNativeSelect) { ?>
        data-select2-id="fpatients_dependantsgrid_x<?= $Grid->RowIndex ?>_relationship"
        <?php } ?>
        data-table="patients_dependants"
        data-field="x_relationship"
        data-value-separator="<?= $Grid->relationship->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->relationship->getPlaceHolder()) ?>"
        <?= $Grid->relationship->editAttributes() ?>>
        <?= $Grid->relationship->selectOptionListHtml("x{$Grid->RowIndex}_relationship") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->relationship->getErrorMessage() ?></div>
<?php if (!$Grid->relationship->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatients_dependantsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_relationship", selectId: "fpatients_dependantsgrid_x<?= $Grid->RowIndex ?>_relationship" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_dependantsgrid.lists.relationship?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_relationship", form: "fpatients_dependantsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_relationship", form: "fpatients_dependantsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_dependants.fields.relationship.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_relationship" class="el_patients_dependants_relationship">
<span<?= $Grid->relationship->viewAttributes() ?>>
<?= $Grid->relationship->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_relationship" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_relationship" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_relationship" value="<?= HtmlEncode($Grid->relationship->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_relationship" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_relationship" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_relationship" value="<?= HtmlEncode($Grid->relationship->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_created" class="el_patients_dependants_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_dependants" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dependantsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_dependantsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_dependants" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_created" class="el_patients_dependants_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patients_dependants" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dependantsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_dependantsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_created" class="el_patients_dependants_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_date_created" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_date_created" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_updated" class="el_patients_dependants_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_dependants" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dependantsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_dependantsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patients_dependants" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_updated" class="el_patients_dependants_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="patients_dependants" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatients_dependantsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatients_dependantsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patients_dependants_date_updated" class="el_patients_dependants_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patients_dependants" data-field="x_date_updated" data-hidden="1" name="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fpatients_dependantsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="patients_dependants" data-field="x_date_updated" data-hidden="1" data-old name="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fpatients_dependantsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fpatients_dependantsgrid","load"], () => fpatients_dependantsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatients_dependantsgrid">
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
    ew.addEventHandlers("patients_dependants");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
