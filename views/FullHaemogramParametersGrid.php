<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("FullHaemogramParametersGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var ffull_haemogram_parametersgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { full_haemogram_parameters: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffull_haemogram_parametersgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_report_id", [fields.lab_test_report_id.visible && fields.lab_test_report_id.required ? ew.Validators.required(fields.lab_test_report_id.caption) : null, ew.Validators.integer], fields.lab_test_report_id.isInvalid],
            ["test", [fields.test.visible && fields.test.required ? ew.Validators.required(fields.test.caption) : null], fields.test.isInvalid],
            ["results", [fields.results.visible && fields.results.required ? ew.Validators.required(fields.results.caption) : null, ew.Validators.float], fields.results.isInvalid],
            ["unit", [fields.unit.visible && fields.unit.required ? ew.Validators.required(fields.unit.caption) : null], fields.unit.isInvalid],
            ["unit_references", [fields.unit_references.visible && fields.unit_references.required ? ew.Validators.required(fields.unit_references.caption) : null], fields.unit_references.isInvalid],
            ["comment", [fields.comment.visible && fields.comment.required ? ew.Validators.required(fields.comment.caption) : null], fields.comment.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["lab_test_report_id",false],["test",false],["results",false],["unit",false],["unit_references",false],["comment",false]];
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
            "test": <?= $Grid->test->toClientList($Grid) ?>,
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
<div id="ffull_haemogram_parametersgrid" class="ew-form ew-list-form">
<div id="gmp_full_haemogram_parameters" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_full_haemogram_parametersgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_id" class="full_haemogram_parameters_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->lab_test_report_id->Visible) { // lab_test_report_id ?>
        <th data-name="lab_test_report_id" class="<?= $Grid->lab_test_report_id->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_lab_test_report_id" class="full_haemogram_parameters_lab_test_report_id"><?= $Grid->renderFieldHeader($Grid->lab_test_report_id) ?></div></th>
<?php } ?>
<?php if ($Grid->test->Visible) { // test ?>
        <th data-name="test" class="<?= $Grid->test->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_test" class="full_haemogram_parameters_test"><?= $Grid->renderFieldHeader($Grid->test) ?></div></th>
<?php } ?>
<?php if ($Grid->results->Visible) { // results ?>
        <th data-name="results" class="<?= $Grid->results->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_results" class="full_haemogram_parameters_results"><?= $Grid->renderFieldHeader($Grid->results) ?></div></th>
<?php } ?>
<?php if ($Grid->unit->Visible) { // unit ?>
        <th data-name="unit" class="<?= $Grid->unit->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_unit" class="full_haemogram_parameters_unit"><?= $Grid->renderFieldHeader($Grid->unit) ?></div></th>
<?php } ?>
<?php if ($Grid->unit_references->Visible) { // unit_references ?>
        <th data-name="unit_references" class="<?= $Grid->unit_references->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_unit_references" class="full_haemogram_parameters_unit_references"><?= $Grid->renderFieldHeader($Grid->unit_references) ?></div></th>
<?php } ?>
<?php if ($Grid->comment->Visible) { // comment ?>
        <th data-name="comment" class="<?= $Grid->comment->headerCellClass() ?>"><div id="elh_full_haemogram_parameters_comment" class="full_haemogram_parameters_comment"><?= $Grid->renderFieldHeader($Grid->comment) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id"></span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_id" class="el_full_haemogram_parameters_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_id" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_id" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->lab_test_report_id->Visible) { // lab_test_report_id ?>
        <td data-name="lab_test_report_id"<?= $Grid->lab_test_report_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->lab_test_report_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_report_id->getDisplayValue($Grid->lab_test_report_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<input type="<?= $Grid->lab_test_report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" value="<?= $Grid->lab_test_report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_report_id->formatPattern()) ?>"<?= $Grid->lab_test_report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_lab_test_report_id" id="o<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->lab_test_report_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_report_id->getDisplayValue($Grid->lab_test_report_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<input type="<?= $Grid->lab_test_report_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_report_id" id="x<?= $Grid->RowIndex ?>_lab_test_report_id" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" value="<?= $Grid->lab_test_report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_report_id->formatPattern()) ?>"<?= $Grid->lab_test_report_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_lab_test_report_id" class="el_full_haemogram_parameters_lab_test_report_id">
<span<?= $Grid->lab_test_report_id->viewAttributes() ?>>
<?= $Grid->lab_test_report_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_lab_test_report_id" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_lab_test_report_id" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_lab_test_report_id" value="<?= HtmlEncode($Grid->lab_test_report_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->test->Visible) { // test ?>
        <td data-name="test"<?= $Grid->test->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_test" class="el_full_haemogram_parameters_test">
    <select
        id="x<?= $Grid->RowIndex ?>_test"
        name="x<?= $Grid->RowIndex ?>_test"
        class="form-select ew-select<?= $Grid->test->isInvalidClass() ?>"
        <?php if (!$Grid->test->IsNativeSelect) { ?>
        data-select2-id="ffull_haemogram_parametersgrid_x<?= $Grid->RowIndex ?>_test"
        <?php } ?>
        data-table="full_haemogram_parameters"
        data-field="x_test"
        data-value-separator="<?= $Grid->test->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->test->getPlaceHolder()) ?>"
        <?= $Grid->test->editAttributes() ?>>
        <?= $Grid->test->selectOptionListHtml("x{$Grid->RowIndex}_test") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->test->getErrorMessage() ?></div>
<?php if (!$Grid->test->IsNativeSelect) { ?>
<script>
loadjs.ready("ffull_haemogram_parametersgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_test", selectId: "ffull_haemogram_parametersgrid_x<?= $Grid->RowIndex ?>_test" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffull_haemogram_parametersgrid.lists.test?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_test", form: "ffull_haemogram_parametersgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_test", form: "ffull_haemogram_parametersgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.full_haemogram_parameters.fields.test.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_test" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_test" id="o<?= $Grid->RowIndex ?>_test" value="<?= HtmlEncode($Grid->test->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_test" class="el_full_haemogram_parameters_test">
    <select
        id="x<?= $Grid->RowIndex ?>_test"
        name="x<?= $Grid->RowIndex ?>_test"
        class="form-select ew-select<?= $Grid->test->isInvalidClass() ?>"
        <?php if (!$Grid->test->IsNativeSelect) { ?>
        data-select2-id="ffull_haemogram_parametersgrid_x<?= $Grid->RowIndex ?>_test"
        <?php } ?>
        data-table="full_haemogram_parameters"
        data-field="x_test"
        data-value-separator="<?= $Grid->test->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->test->getPlaceHolder()) ?>"
        <?= $Grid->test->editAttributes() ?>>
        <?= $Grid->test->selectOptionListHtml("x{$Grid->RowIndex}_test") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->test->getErrorMessage() ?></div>
<?php if (!$Grid->test->IsNativeSelect) { ?>
<script>
loadjs.ready("ffull_haemogram_parametersgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_test", selectId: "ffull_haemogram_parametersgrid_x<?= $Grid->RowIndex ?>_test" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffull_haemogram_parametersgrid.lists.test?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_test", form: "ffull_haemogram_parametersgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_test", form: "ffull_haemogram_parametersgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.full_haemogram_parameters.fields.test.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_test" class="el_full_haemogram_parameters_test">
<span<?= $Grid->test->viewAttributes() ?>>
<?= $Grid->test->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_test" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_test" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_test" value="<?= HtmlEncode($Grid->test->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_test" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_test" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_test" value="<?= HtmlEncode($Grid->test->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->results->Visible) { // results ?>
        <td data-name="results"<?= $Grid->results->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_results" class="el_full_haemogram_parameters_results">
<input type="<?= $Grid->results->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_results" id="x<?= $Grid->RowIndex ?>_results" data-table="full_haemogram_parameters" data-field="x_results" value="<?= $Grid->results->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->results->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->results->formatPattern()) ?>"<?= $Grid->results->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->results->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_results" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_results" id="o<?= $Grid->RowIndex ?>_results" value="<?= HtmlEncode($Grid->results->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_results" class="el_full_haemogram_parameters_results">
<input type="<?= $Grid->results->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_results" id="x<?= $Grid->RowIndex ?>_results" data-table="full_haemogram_parameters" data-field="x_results" value="<?= $Grid->results->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->results->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->results->formatPattern()) ?>"<?= $Grid->results->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->results->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_results" class="el_full_haemogram_parameters_results">
<span<?= $Grid->results->viewAttributes() ?>>
<?= $Grid->results->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_results" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_results" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_results" value="<?= HtmlEncode($Grid->results->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_results" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_results" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_results" value="<?= HtmlEncode($Grid->results->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->unit->Visible) { // unit ?>
        <td data-name="unit"<?= $Grid->unit->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit" class="el_full_haemogram_parameters_unit">
<input type="<?= $Grid->unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_unit" id="x<?= $Grid->RowIndex ?>_unit" data-table="full_haemogram_parameters" data-field="x_unit" value="<?= $Grid->unit->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->unit->formatPattern()) ?>"<?= $Grid->unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->unit->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_unit" id="o<?= $Grid->RowIndex ?>_unit" value="<?= HtmlEncode($Grid->unit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit" class="el_full_haemogram_parameters_unit">
<input type="<?= $Grid->unit->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_unit" id="x<?= $Grid->RowIndex ?>_unit" data-table="full_haemogram_parameters" data-field="x_unit" value="<?= $Grid->unit->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->unit->formatPattern()) ?>"<?= $Grid->unit->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->unit->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit" class="el_full_haemogram_parameters_unit">
<span<?= $Grid->unit->viewAttributes() ?>>
<?= $Grid->unit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_unit" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_unit" value="<?= HtmlEncode($Grid->unit->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_unit" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_unit" value="<?= HtmlEncode($Grid->unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->unit_references->Visible) { // unit_references ?>
        <td data-name="unit_references"<?= $Grid->unit_references->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit_references" class="el_full_haemogram_parameters_unit_references">
<input type="<?= $Grid->unit_references->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_unit_references" id="x<?= $Grid->RowIndex ?>_unit_references" data-table="full_haemogram_parameters" data-field="x_unit_references" value="<?= $Grid->unit_references->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->unit_references->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->unit_references->formatPattern()) ?>"<?= $Grid->unit_references->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->unit_references->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit_references" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_unit_references" id="o<?= $Grid->RowIndex ?>_unit_references" value="<?= HtmlEncode($Grid->unit_references->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit_references" class="el_full_haemogram_parameters_unit_references">
<input type="<?= $Grid->unit_references->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_unit_references" id="x<?= $Grid->RowIndex ?>_unit_references" data-table="full_haemogram_parameters" data-field="x_unit_references" value="<?= $Grid->unit_references->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->unit_references->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->unit_references->formatPattern()) ?>"<?= $Grid->unit_references->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->unit_references->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_unit_references" class="el_full_haemogram_parameters_unit_references">
<span<?= $Grid->unit_references->viewAttributes() ?>>
<?= $Grid->unit_references->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit_references" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_unit_references" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_unit_references" value="<?= HtmlEncode($Grid->unit_references->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_unit_references" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_unit_references" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_unit_references" value="<?= HtmlEncode($Grid->unit_references->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->comment->Visible) { // comment ?>
        <td data-name="comment"<?= $Grid->comment->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_comment" class="el_full_haemogram_parameters_comment">
<input type="<?= $Grid->comment->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_comment" id="x<?= $Grid->RowIndex ?>_comment" data-table="full_haemogram_parameters" data-field="x_comment" value="<?= $Grid->comment->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->comment->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->comment->formatPattern()) ?>"<?= $Grid->comment->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->comment->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_comment" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_comment" id="o<?= $Grid->RowIndex ?>_comment" value="<?= HtmlEncode($Grid->comment->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_comment" class="el_full_haemogram_parameters_comment">
<input type="<?= $Grid->comment->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_comment" id="x<?= $Grid->RowIndex ?>_comment" data-table="full_haemogram_parameters" data-field="x_comment" value="<?= $Grid->comment->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->comment->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->comment->formatPattern()) ?>"<?= $Grid->comment->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->comment->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_full_haemogram_parameters_comment" class="el_full_haemogram_parameters_comment">
<span<?= $Grid->comment->viewAttributes() ?>>
<?= $Grid->comment->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_comment" data-hidden="1" name="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_comment" id="ffull_haemogram_parametersgrid$x<?= $Grid->RowIndex ?>_comment" value="<?= HtmlEncode($Grid->comment->FormValue) ?>">
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_comment" data-hidden="1" data-old name="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_comment" id="ffull_haemogram_parametersgrid$o<?= $Grid->RowIndex ?>_comment" value="<?= HtmlEncode($Grid->comment->OldValue) ?>">
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
loadjs.ready(["ffull_haemogram_parametersgrid","load"], () => ffull_haemogram_parametersgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="ffull_haemogram_parametersgrid">
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
    ew.addEventHandlers("full_haemogram_parameters");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
