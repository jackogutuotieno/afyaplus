<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("UrinalysisParametersGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var furinalysis_parametersgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { urinalysis_parameters: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("furinalysis_parametersgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["parameter", [fields.parameter.visible && fields.parameter.required ? ew.Validators.required(fields.parameter.caption) : null], fields.parameter.isInvalid],
            ["result", [fields.result.visible && fields.result.required ? ew.Validators.required(fields.result.caption) : null], fields.result.isInvalid],
            ["comments", [fields.comments.visible && fields.comments.required ? ew.Validators.required(fields.comments.caption) : null], fields.comments.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["parameter",false],["result",false],["comments",false]];
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
            "parameter": <?= $Grid->parameter->toClientList($Grid) ?>,
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
<div id="furinalysis_parametersgrid" class="ew-form ew-list-form">
<div id="gmp_urinalysis_parameters" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_urinalysis_parametersgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->parameter->Visible) { // parameter ?>
        <th data-name="parameter" class="<?= $Grid->parameter->headerCellClass() ?>"><div id="elh_urinalysis_parameters_parameter" class="urinalysis_parameters_parameter"><?= $Grid->renderFieldHeader($Grid->parameter) ?></div></th>
<?php } ?>
<?php if ($Grid->result->Visible) { // result ?>
        <th data-name="result" class="<?= $Grid->result->headerCellClass() ?>"><div id="elh_urinalysis_parameters_result" class="urinalysis_parameters_result"><?= $Grid->renderFieldHeader($Grid->result) ?></div></th>
<?php } ?>
<?php if ($Grid->comments->Visible) { // comments ?>
        <th data-name="comments" class="<?= $Grid->comments->headerCellClass() ?>"><div id="elh_urinalysis_parameters_comments" class="urinalysis_parameters_comments"><?= $Grid->renderFieldHeader($Grid->comments) ?></div></th>
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
    <?php if ($Grid->parameter->Visible) { // parameter ?>
        <td data-name="parameter"<?= $Grid->parameter->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_parameter" class="el_urinalysis_parameters_parameter">
    <select
        id="x<?= $Grid->RowIndex ?>_parameter"
        name="x<?= $Grid->RowIndex ?>_parameter"
        class="form-select ew-select<?= $Grid->parameter->isInvalidClass() ?>"
        <?php if (!$Grid->parameter->IsNativeSelect) { ?>
        data-select2-id="furinalysis_parametersgrid_x<?= $Grid->RowIndex ?>_parameter"
        <?php } ?>
        data-table="urinalysis_parameters"
        data-field="x_parameter"
        data-value-separator="<?= $Grid->parameter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->parameter->getPlaceHolder()) ?>"
        <?= $Grid->parameter->editAttributes() ?>>
        <?= $Grid->parameter->selectOptionListHtml("x{$Grid->RowIndex}_parameter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->parameter->getErrorMessage() ?></div>
<?php if (!$Grid->parameter->IsNativeSelect) { ?>
<script>
loadjs.ready("furinalysis_parametersgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_parameter", selectId: "furinalysis_parametersgrid_x<?= $Grid->RowIndex ?>_parameter" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (furinalysis_parametersgrid.lists.parameter?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_parameter", form: "furinalysis_parametersgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_parameter", form: "furinalysis_parametersgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.urinalysis_parameters.fields.parameter.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_parameter" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_parameter" id="o<?= $Grid->RowIndex ?>_parameter" value="<?= HtmlEncode($Grid->parameter->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_parameter" class="el_urinalysis_parameters_parameter">
    <select
        id="x<?= $Grid->RowIndex ?>_parameter"
        name="x<?= $Grid->RowIndex ?>_parameter"
        class="form-select ew-select<?= $Grid->parameter->isInvalidClass() ?>"
        <?php if (!$Grid->parameter->IsNativeSelect) { ?>
        data-select2-id="furinalysis_parametersgrid_x<?= $Grid->RowIndex ?>_parameter"
        <?php } ?>
        data-table="urinalysis_parameters"
        data-field="x_parameter"
        data-value-separator="<?= $Grid->parameter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->parameter->getPlaceHolder()) ?>"
        <?= $Grid->parameter->editAttributes() ?>>
        <?= $Grid->parameter->selectOptionListHtml("x{$Grid->RowIndex}_parameter") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->parameter->getErrorMessage() ?></div>
<?php if (!$Grid->parameter->IsNativeSelect) { ?>
<script>
loadjs.ready("furinalysis_parametersgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_parameter", selectId: "furinalysis_parametersgrid_x<?= $Grid->RowIndex ?>_parameter" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (furinalysis_parametersgrid.lists.parameter?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_parameter", form: "furinalysis_parametersgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_parameter", form: "furinalysis_parametersgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.urinalysis_parameters.fields.parameter.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_parameter" class="el_urinalysis_parameters_parameter">
<span<?= $Grid->parameter->viewAttributes() ?>>
<?= $Grid->parameter->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_parameter" data-hidden="1" name="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_parameter" id="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_parameter" value="<?= HtmlEncode($Grid->parameter->FormValue) ?>">
<input type="hidden" data-table="urinalysis_parameters" data-field="x_parameter" data-hidden="1" data-old name="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_parameter" id="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_parameter" value="<?= HtmlEncode($Grid->parameter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->result->Visible) { // result ?>
        <td data-name="result"<?= $Grid->result->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_result" class="el_urinalysis_parameters_result">
<input type="<?= $Grid->result->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_result" id="x<?= $Grid->RowIndex ?>_result" data-table="urinalysis_parameters" data-field="x_result" value="<?= $Grid->result->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->result->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->result->formatPattern()) ?>"<?= $Grid->result->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->result->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_result" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_result" id="o<?= $Grid->RowIndex ?>_result" value="<?= HtmlEncode($Grid->result->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_result" class="el_urinalysis_parameters_result">
<input type="<?= $Grid->result->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_result" id="x<?= $Grid->RowIndex ?>_result" data-table="urinalysis_parameters" data-field="x_result" value="<?= $Grid->result->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->result->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->result->formatPattern()) ?>"<?= $Grid->result->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->result->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_result" class="el_urinalysis_parameters_result">
<span<?= $Grid->result->viewAttributes() ?>>
<?= $Grid->result->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_result" data-hidden="1" name="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_result" id="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_result" value="<?= HtmlEncode($Grid->result->FormValue) ?>">
<input type="hidden" data-table="urinalysis_parameters" data-field="x_result" data-hidden="1" data-old name="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_result" id="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_result" value="<?= HtmlEncode($Grid->result->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->comments->Visible) { // comments ?>
        <td data-name="comments"<?= $Grid->comments->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_comments" class="el_urinalysis_parameters_comments">
<input type="<?= $Grid->comments->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_comments" id="x<?= $Grid->RowIndex ?>_comments" data-table="urinalysis_parameters" data-field="x_comments" value="<?= $Grid->comments->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->comments->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->comments->formatPattern()) ?>"<?= $Grid->comments->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->comments->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_comments" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_comments" id="o<?= $Grid->RowIndex ?>_comments" value="<?= HtmlEncode($Grid->comments->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_comments" class="el_urinalysis_parameters_comments">
<input type="<?= $Grid->comments->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_comments" id="x<?= $Grid->RowIndex ?>_comments" data-table="urinalysis_parameters" data-field="x_comments" value="<?= $Grid->comments->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Grid->comments->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->comments->formatPattern()) ?>"<?= $Grid->comments->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->comments->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_urinalysis_parameters_comments" class="el_urinalysis_parameters_comments">
<span<?= $Grid->comments->viewAttributes() ?>>
<?= $Grid->comments->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_comments" data-hidden="1" name="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_comments" id="furinalysis_parametersgrid$x<?= $Grid->RowIndex ?>_comments" value="<?= HtmlEncode($Grid->comments->FormValue) ?>">
<input type="hidden" data-table="urinalysis_parameters" data-field="x_comments" data-hidden="1" data-old name="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_comments" id="furinalysis_parametersgrid$o<?= $Grid->RowIndex ?>_comments" value="<?= HtmlEncode($Grid->comments->OldValue) ?>">
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
loadjs.ready(["furinalysis_parametersgrid","load"], () => furinalysis_parametersgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="furinalysis_parametersgrid">
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
    ew.addEventHandlers("urinalysis_parameters");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
