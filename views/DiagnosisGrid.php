<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("DiagnosisGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fdiagnosisgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { diagnosis: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdiagnosisgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null, ew.Validators.integer], fields.visit_id.isInvalid],
            ["report_id", [fields.report_id.visible && fields.report_id.required ? ew.Validators.required(fields.report_id.caption) : null, ew.Validators.integer], fields.report_id.isInvalid],
            ["disease_id", [fields.disease_id.visible && fields.disease_id.required ? ew.Validators.required(fields.disease_id.caption) : null, ew.Validators.integer], fields.disease_id.isInvalid],
            ["additional_findings", [fields.additional_findings.visible && fields.additional_findings.required ? ew.Validators.required(fields.additional_findings.caption) : null], fields.additional_findings.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null, ew.Validators.integer], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["visit_id",false],["report_id",false],["disease_id",false],["additional_findings",false],["created_by_user_id",false],["date_created",false],["date_updated",false]];
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
<div id="fdiagnosisgrid" class="ew-form ew-list-form">
<div id="gmp_diagnosis" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_diagnosisgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_diagnosis_id" class="diagnosis_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_diagnosis_patient_id" class="diagnosis_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <th data-name="visit_id" class="<?= $Grid->visit_id->headerCellClass() ?>"><div id="elh_diagnosis_visit_id" class="diagnosis_visit_id"><?= $Grid->renderFieldHeader($Grid->visit_id) ?></div></th>
<?php } ?>
<?php if ($Grid->report_id->Visible) { // report_id ?>
        <th data-name="report_id" class="<?= $Grid->report_id->headerCellClass() ?>"><div id="elh_diagnosis_report_id" class="diagnosis_report_id"><?= $Grid->renderFieldHeader($Grid->report_id) ?></div></th>
<?php } ?>
<?php if ($Grid->disease_id->Visible) { // disease_id ?>
        <th data-name="disease_id" class="<?= $Grid->disease_id->headerCellClass() ?>"><div id="elh_diagnosis_disease_id" class="diagnosis_disease_id"><?= $Grid->renderFieldHeader($Grid->disease_id) ?></div></th>
<?php } ?>
<?php if ($Grid->additional_findings->Visible) { // additional_findings ?>
        <th data-name="additional_findings" class="<?= $Grid->additional_findings->headerCellClass() ?>"><div id="elh_diagnosis_additional_findings" class="diagnosis_additional_findings"><?= $Grid->renderFieldHeader($Grid->additional_findings) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_diagnosis_created_by_user_id" class="diagnosis_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_diagnosis_date_created" class="diagnosis_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_diagnosis_date_updated" class="diagnosis_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_id" class="el_diagnosis_id"></span>
<input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_id" class="el_diagnosis_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_id" class="el_diagnosis_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_patient_id" class="el_diagnosis_patient_id">
<input type="<?= $Grid->patient_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" data-table="diagnosis" data-field="x_patient_id" value="<?= $Grid->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="diagnosis" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span<?= $Grid->patient_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_patient_id" class="el_diagnosis_patient_id">
<input type="<?= $Grid->patient_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_patient_id" id="x<?= $Grid->RowIndex ?>_patient_id" data-table="diagnosis" data-field="x_patient_id" value="<?= $Grid->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->patient_id->formatPattern()) ?>"<?= $Grid->patient_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->patient_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_patient_id" class="el_diagnosis_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_patient_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_patient_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_patient_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_patient_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->visit_id->Visible) { // visit_id ?>
        <td data-name="visit_id"<?= $Grid->visit_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_visit_id" class="el_diagnosis_visit_id">
<input type="<?= $Grid->visit_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_id" id="x<?= $Grid->RowIndex ?>_visit_id" data-table="diagnosis" data-field="x_visit_id" value="<?= $Grid->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_id->formatPattern()) ?>"<?= $Grid->visit_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_visit_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_visit_id" id="o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_visit_id" class="el_diagnosis_visit_id">
<input type="<?= $Grid->visit_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_visit_id" id="x<?= $Grid->RowIndex ?>_visit_id" data-table="diagnosis" data-field="x_visit_id" value="<?= $Grid->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->visit_id->formatPattern()) ?>"<?= $Grid->visit_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->visit_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_visit_id" class="el_diagnosis_visit_id">
<span<?= $Grid->visit_id->viewAttributes() ?>>
<?= $Grid->visit_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_visit_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_visit_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_visit_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_visit_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_visit_id" value="<?= HtmlEncode($Grid->visit_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->report_id->Visible) { // report_id ?>
        <td data-name="report_id"<?= $Grid->report_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_report_id" class="el_diagnosis_report_id">
<input type="<?= $Grid->report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_report_id" id="x<?= $Grid->RowIndex ?>_report_id" data-table="diagnosis" data-field="x_report_id" value="<?= $Grid->report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->report_id->formatPattern()) ?>"<?= $Grid->report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->report_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_report_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_report_id" id="o<?= $Grid->RowIndex ?>_report_id" value="<?= HtmlEncode($Grid->report_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_report_id" class="el_diagnosis_report_id">
<input type="<?= $Grid->report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_report_id" id="x<?= $Grid->RowIndex ?>_report_id" data-table="diagnosis" data-field="x_report_id" value="<?= $Grid->report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->report_id->formatPattern()) ?>"<?= $Grid->report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_report_id" class="el_diagnosis_report_id">
<span<?= $Grid->report_id->viewAttributes() ?>>
<?= $Grid->report_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_report_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_report_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_report_id" value="<?= HtmlEncode($Grid->report_id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_report_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_report_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_report_id" value="<?= HtmlEncode($Grid->report_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->disease_id->Visible) { // disease_id ?>
        <td data-name="disease_id"<?= $Grid->disease_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_disease_id" class="el_diagnosis_disease_id">
<input type="<?= $Grid->disease_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_disease_id" id="x<?= $Grid->RowIndex ?>_disease_id" data-table="diagnosis" data-field="x_disease_id" value="<?= $Grid->disease_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->disease_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->disease_id->formatPattern()) ?>"<?= $Grid->disease_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->disease_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_disease_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_disease_id" id="o<?= $Grid->RowIndex ?>_disease_id" value="<?= HtmlEncode($Grid->disease_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_disease_id" class="el_diagnosis_disease_id">
<input type="<?= $Grid->disease_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_disease_id" id="x<?= $Grid->RowIndex ?>_disease_id" data-table="diagnosis" data-field="x_disease_id" value="<?= $Grid->disease_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->disease_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->disease_id->formatPattern()) ?>"<?= $Grid->disease_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->disease_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_disease_id" class="el_diagnosis_disease_id">
<span<?= $Grid->disease_id->viewAttributes() ?>>
<?= $Grid->disease_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_disease_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_disease_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_disease_id" value="<?= HtmlEncode($Grid->disease_id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_disease_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_disease_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_disease_id" value="<?= HtmlEncode($Grid->disease_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->additional_findings->Visible) { // additional_findings ?>
        <td data-name="additional_findings"<?= $Grid->additional_findings->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_additional_findings" class="el_diagnosis_additional_findings">
<input type="<?= $Grid->additional_findings->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_additional_findings" id="x<?= $Grid->RowIndex ?>_additional_findings" data-table="diagnosis" data-field="x_additional_findings" value="<?= $Grid->additional_findings->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->additional_findings->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->additional_findings->formatPattern()) ?>"<?= $Grid->additional_findings->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->additional_findings->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_additional_findings" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_additional_findings" id="o<?= $Grid->RowIndex ?>_additional_findings" value="<?= HtmlEncode($Grid->additional_findings->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_additional_findings" class="el_diagnosis_additional_findings">
<input type="<?= $Grid->additional_findings->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_additional_findings" id="x<?= $Grid->RowIndex ?>_additional_findings" data-table="diagnosis" data-field="x_additional_findings" value="<?= $Grid->additional_findings->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->additional_findings->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->additional_findings->formatPattern()) ?>"<?= $Grid->additional_findings->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->additional_findings->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_additional_findings" class="el_diagnosis_additional_findings">
<span<?= $Grid->additional_findings->viewAttributes() ?>>
<?= $Grid->additional_findings->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_additional_findings" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_additional_findings" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_additional_findings" value="<?= HtmlEncode($Grid->additional_findings->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_additional_findings" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_additional_findings" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_additional_findings" value="<?= HtmlEncode($Grid->additional_findings->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_created_by_user_id" class="el_diagnosis_created_by_user_id">
<input type="<?= $Grid->created_by_user_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" data-table="diagnosis" data-field="x_created_by_user_id" value="<?= $Grid->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->created_by_user_id->formatPattern()) ?>"<?= $Grid->created_by_user_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->created_by_user_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_created_by_user_id" class="el_diagnosis_created_by_user_id">
<input type="<?= $Grid->created_by_user_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" data-table="diagnosis" data-field="x_created_by_user_id" value="<?= $Grid->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->created_by_user_id->formatPattern()) ?>"<?= $Grid->created_by_user_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->created_by_user_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_created_by_user_id" class="el_diagnosis_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_created_by_user_id" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_created_by_user_id" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_created" class="el_diagnosis_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="diagnosis" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiagnosisgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_created" class="el_diagnosis_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="diagnosis" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiagnosisgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_created" class="el_diagnosis_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_date_created" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_date_created" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_date_created" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_date_created" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_updated" class="el_diagnosis_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="diagnosis" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiagnosisgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="diagnosis" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_updated" class="el_diagnosis_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="diagnosis" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiagnosisgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_diagnosis_date_updated" class="el_diagnosis_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="diagnosis" data-field="x_date_updated" data-hidden="1" name="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fdiagnosisgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="diagnosis" data-field="x_date_updated" data-hidden="1" data-old name="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fdiagnosisgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fdiagnosisgrid","load"], () => fdiagnosisgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fdiagnosisgrid">
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
    ew.addEventHandlers("diagnosis");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
