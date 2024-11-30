<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("PatientVisitsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpatient_visitsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { patient_visits: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_visitsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_type_id", [fields.visit_type_id.visible && fields.visit_type_id.required ? ew.Validators.required(fields.visit_type_id.caption) : null], fields.visit_type_id.isInvalid],
            ["payment_method_id", [fields.payment_method_id.visible && fields.payment_method_id.required ? ew.Validators.required(fields.payment_method_id.caption) : null], fields.payment_method_id.isInvalid],
            ["medical_scheme_id", [fields.medical_scheme_id.visible && fields.medical_scheme_id.required ? ew.Validators.required(fields.medical_scheme_id.caption) : null], fields.medical_scheme_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["visit_type_id",false],["payment_method_id",false],["medical_scheme_id",false],["date_created",false],["status",false]];
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
            "visit_type_id": <?= $Grid->visit_type_id->toClientList($Grid) ?>,
            "payment_method_id": <?= $Grid->payment_method_id->toClientList($Grid) ?>,
            "medical_scheme_id": <?= $Grid->medical_scheme_id->toClientList($Grid) ?>,
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
<div id="fpatient_visitsgrid" class="ew-form ew-list-form">
<div id="gmp_patient_visits" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_patient_visitsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_patient_visits_patient_id" class="patient_visits_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->visit_type_id->Visible) { // visit_type_id ?>
        <th data-name="visit_type_id" class="<?= $Grid->visit_type_id->headerCellClass() ?>"><div id="elh_patient_visits_visit_type_id" class="patient_visits_visit_type_id"><?= $Grid->renderFieldHeader($Grid->visit_type_id) ?></div></th>
<?php } ?>
<?php if ($Grid->payment_method_id->Visible) { // payment_method_id ?>
        <th data-name="payment_method_id" class="<?= $Grid->payment_method_id->headerCellClass() ?>"><div id="elh_patient_visits_payment_method_id" class="patient_visits_payment_method_id"><?= $Grid->renderFieldHeader($Grid->payment_method_id) ?></div></th>
<?php } ?>
<?php if ($Grid->medical_scheme_id->Visible) { // medical_scheme_id ?>
        <th data-name="medical_scheme_id" class="<?= $Grid->medical_scheme_id->headerCellClass() ?>"><div id="elh_patient_visits_medical_scheme_id" class="patient_visits_medical_scheme_id"><?= $Grid->renderFieldHeader($Grid->medical_scheme_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_patient_visits_date_created" class="patient_visits_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_patient_visits_status" class="patient_visits_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
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
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_patient_id" class="el_patient_visits_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_visits"
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
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="patient_visits" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_patient_id" class="el_patient_visits_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="patient_visits"
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
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_patient_id" class="el_patient_visits_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_patient_id" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_patient_id" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->visit_type_id->Visible) { // visit_type_id ?>
        <td data-name="visit_type_id"<?= $Grid->visit_type_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_visit_type_id" class="el_patient_visits_visit_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_type_id"
        name="x<?= $Grid->RowIndex ?>_visit_type_id"
        class="form-select ew-select<?= $Grid->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Grid->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_type_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_type_id->editAttributes() ?>>
        <?= $Grid->visit_type_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_type_id->getErrorMessage() ?></div>
<?= $Grid->visit_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_type_id") ?>
<?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_type_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_visits" data-field="x_visit_type_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_type_id" id="o<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_visit_type_id" class="el_patient_visits_visit_type_id">
    <select
        id="x<?= $Grid->RowIndex ?>_visit_type_id"
        name="x<?= $Grid->RowIndex ?>_visit_type_id"
        class="form-select ew-select<?= $Grid->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Grid->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->visit_type_id->getPlaceHolder()) ?>"
        <?= $Grid->visit_type_id->editAttributes() ?>>
        <?= $Grid->visit_type_id->selectOptionListHtml("x{$Grid->RowIndex}_visit_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->visit_type_id->getErrorMessage() ?></div>
<?= $Grid->visit_type_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_visit_type_id") ?>
<?php if (!$Grid->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_visit_type_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_visit_type_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_visit_type_id" class="el_patient_visits_visit_type_id">
<span<?= $Grid->visit_type_id->viewAttributes() ?>>
<?= $Grid->visit_type_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_visit_type_id" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_type_id" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_visit_type_id" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_type_id" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_visit_type_id" value="<?= HtmlEncode($Grid->visit_type_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->payment_method_id->Visible) { // payment_method_id ?>
        <td data-name="payment_method_id"<?= $Grid->payment_method_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_payment_method_id" class="el_patient_visits_payment_method_id">
    <select
        id="x<?= $Grid->RowIndex ?>_payment_method_id"
        name="x<?= $Grid->RowIndex ?>_payment_method_id"
        class="form-select ew-select<?= $Grid->payment_method_id->isInvalidClass() ?>"
        <?php if (!$Grid->payment_method_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_payment_method_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_payment_method_id"
        data-value-separator="<?= $Grid->payment_method_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->payment_method_id->getPlaceHolder()) ?>"
        <?= $Grid->payment_method_id->editAttributes() ?>>
        <?= $Grid->payment_method_id->selectOptionListHtml("x{$Grid->RowIndex}_payment_method_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->payment_method_id->getErrorMessage() ?></div>
<?= $Grid->payment_method_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_payment_method_id") ?>
<?php if (!$Grid->payment_method_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_payment_method_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_payment_method_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.payment_method_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_payment_method_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_payment_method_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.payment_method_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_visits" data-field="x_payment_method_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_payment_method_id" id="o<?= $Grid->RowIndex ?>_payment_method_id" value="<?= HtmlEncode($Grid->payment_method_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_payment_method_id" class="el_patient_visits_payment_method_id">
    <select
        id="x<?= $Grid->RowIndex ?>_payment_method_id"
        name="x<?= $Grid->RowIndex ?>_payment_method_id"
        class="form-select ew-select<?= $Grid->payment_method_id->isInvalidClass() ?>"
        <?php if (!$Grid->payment_method_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_payment_method_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_payment_method_id"
        data-value-separator="<?= $Grid->payment_method_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->payment_method_id->getPlaceHolder()) ?>"
        <?= $Grid->payment_method_id->editAttributes() ?>>
        <?= $Grid->payment_method_id->selectOptionListHtml("x{$Grid->RowIndex}_payment_method_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->payment_method_id->getErrorMessage() ?></div>
<?= $Grid->payment_method_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_payment_method_id") ?>
<?php if (!$Grid->payment_method_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_payment_method_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_payment_method_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.payment_method_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_payment_method_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_payment_method_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.payment_method_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_payment_method_id" class="el_patient_visits_payment_method_id">
<span<?= $Grid->payment_method_id->viewAttributes() ?>>
<?= $Grid->payment_method_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_payment_method_id" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_payment_method_id" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_payment_method_id" value="<?= HtmlEncode($Grid->payment_method_id->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_payment_method_id" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_payment_method_id" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_payment_method_id" value="<?= HtmlEncode($Grid->payment_method_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->medical_scheme_id->Visible) { // medical_scheme_id ?>
        <td data-name="medical_scheme_id"<?= $Grid->medical_scheme_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_medical_scheme_id" class="el_patient_visits_medical_scheme_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medical_scheme_id"
        name="x<?= $Grid->RowIndex ?>_medical_scheme_id"
        class="form-select ew-select<?= $Grid->medical_scheme_id->isInvalidClass() ?>"
        <?php if (!$Grid->medical_scheme_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_medical_scheme_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_medical_scheme_id"
        data-value-separator="<?= $Grid->medical_scheme_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medical_scheme_id->getPlaceHolder()) ?>"
        <?= $Grid->medical_scheme_id->editAttributes() ?>>
        <?= $Grid->medical_scheme_id->selectOptionListHtml("x{$Grid->RowIndex}_medical_scheme_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medical_scheme_id->getErrorMessage() ?></div>
<?= $Grid->medical_scheme_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medical_scheme_id") ?>
<?php if (!$Grid->medical_scheme_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medical_scheme_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_medical_scheme_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.medical_scheme_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medical_scheme_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medical_scheme_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.medical_scheme_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_visits" data-field="x_medical_scheme_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medical_scheme_id" id="o<?= $Grid->RowIndex ?>_medical_scheme_id" value="<?= HtmlEncode($Grid->medical_scheme_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_medical_scheme_id" class="el_patient_visits_medical_scheme_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medical_scheme_id"
        name="x<?= $Grid->RowIndex ?>_medical_scheme_id"
        class="form-select ew-select<?= $Grid->medical_scheme_id->isInvalidClass() ?>"
        <?php if (!$Grid->medical_scheme_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_medical_scheme_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_medical_scheme_id"
        data-value-separator="<?= $Grid->medical_scheme_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medical_scheme_id->getPlaceHolder()) ?>"
        <?= $Grid->medical_scheme_id->editAttributes() ?>>
        <?= $Grid->medical_scheme_id->selectOptionListHtml("x{$Grid->RowIndex}_medical_scheme_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medical_scheme_id->getErrorMessage() ?></div>
<?= $Grid->medical_scheme_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medical_scheme_id") ?>
<?php if (!$Grid->medical_scheme_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medical_scheme_id", selectId: "fpatient_visitsgrid_x<?= $Grid->RowIndex ?>_medical_scheme_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsgrid.lists.medical_scheme_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medical_scheme_id", form: "fpatient_visitsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medical_scheme_id", form: "fpatient_visitsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.medical_scheme_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_medical_scheme_id" class="el_patient_visits_medical_scheme_id">
<span<?= $Grid->medical_scheme_id->viewAttributes() ?>>
<?= $Grid->medical_scheme_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_medical_scheme_id" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_medical_scheme_id" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_medical_scheme_id" value="<?= HtmlEncode($Grid->medical_scheme_id->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_medical_scheme_id" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_medical_scheme_id" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_medical_scheme_id" value="<?= HtmlEncode($Grid->medical_scheme_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_date_created" class="el_patient_visits_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_visits" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_visitsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_visitsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="patient_visits" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_date_created" class="el_patient_visits_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="patient_visits" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_visitsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_visitsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_date_created" class="el_patient_visits_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_date_created" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_date_created" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_status" class="el_patient_visits_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patient_visits" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="patient_visits" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_status" class="el_patient_visits_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="patient_visits" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_patient_visits_status" class="el_patient_visits_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="patient_visits" data-field="x_status" data-hidden="1" name="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_status" id="fpatient_visitsgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="patient_visits" data-field="x_status" data-hidden="1" data-old name="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_status" id="fpatient_visitsgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
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
loadjs.ready(["fpatient_visitsgrid","load"], () => fpatient_visitsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fpatient_visitsgrid">
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
    ew.addEventHandlers("patient_visits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
