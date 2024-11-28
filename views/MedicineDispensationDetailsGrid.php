<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("MedicineDispensationDetailsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fmedicine_dispensation_detailsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { medicine_dispensation_details: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_dispensation_detailsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["medicine_dispensation_id", [fields.medicine_dispensation_id.visible && fields.medicine_dispensation_id.required ? ew.Validators.required(fields.medicine_dispensation_id.caption) : null, ew.Validators.integer], fields.medicine_dispensation_id.isInvalid],
            ["medicine_stock_id", [fields.medicine_stock_id.visible && fields.medicine_stock_id.required ? ew.Validators.required(fields.medicine_stock_id.caption) : null], fields.medicine_stock_id.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["medicine_dispensation_id",false],["medicine_stock_id",false],["quantity",false]];
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
            "medicine_stock_id": <?= $Grid->medicine_stock_id->toClientList($Grid) ?>,
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
<div id="fmedicine_dispensation_detailsgrid" class="ew-form ew-list-form">
<div id="gmp_medicine_dispensation_details" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_medicine_dispensation_detailsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_medicine_dispensation_details_id" class="medicine_dispensation_details_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
        <th data-name="medicine_dispensation_id" class="<?= $Grid->medicine_dispensation_id->headerCellClass() ?>"><div id="elh_medicine_dispensation_details_medicine_dispensation_id" class="medicine_dispensation_details_medicine_dispensation_id"><?= $Grid->renderFieldHeader($Grid->medicine_dispensation_id) ?></div></th>
<?php } ?>
<?php if ($Grid->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <th data-name="medicine_stock_id" class="<?= $Grid->medicine_stock_id->headerCellClass() ?>"><div id="elh_medicine_dispensation_details_medicine_stock_id" class="medicine_dispensation_details_medicine_stock_id"><?= $Grid->renderFieldHeader($Grid->medicine_stock_id) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_medicine_dispensation_details_quantity" class="medicine_dispensation_details_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_id" class="el_medicine_dispensation_details_id"></span>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_id" class="el_medicine_dispensation_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_id" class="el_medicine_dispensation_details_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_id" data-hidden="1" name="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_id" id="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_id" data-hidden="1" data-old name="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_id" id="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="medicine_dispensation_details" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
        <td data-name="medicine_dispensation_id"<?= $Grid->medicine_dispensation_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->medicine_dispensation_id->getSessionValue() != "") { ?>
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->medicine_dispensation_id->getDisplayValue($Grid->medicine_dispensation_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_dispensation_id" class="el_medicine_dispensation_details_medicine_dispensation_id">
<input type="<?= $Grid->medicine_dispensation_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" value="<?= $Grid->medicine_dispensation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->medicine_dispensation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->medicine_dispensation_id->formatPattern()) ?>"<?= $Grid->medicine_dispensation_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->medicine_dispensation_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="o<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->medicine_dispensation_id->getSessionValue() != "") { ?>
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->medicine_dispensation_id->getDisplayValue($Grid->medicine_dispensation_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_dispensation_id" class="el_medicine_dispensation_details_medicine_dispensation_id">
<input type="<?= $Grid->medicine_dispensation_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="x<?= $Grid->RowIndex ?>_medicine_dispensation_id" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" value="<?= $Grid->medicine_dispensation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->medicine_dispensation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->medicine_dispensation_id->formatPattern()) ?>"<?= $Grid->medicine_dispensation_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->medicine_dispensation_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_dispensation_id" class="el_medicine_dispensation_details_medicine_dispensation_id">
<span<?= $Grid->medicine_dispensation_id->viewAttributes() ?>>
<?= $Grid->medicine_dispensation_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" data-hidden="1" name="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" data-hidden="1" data-old name="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_dispensation_id" id="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_dispensation_id" value="<?= HtmlEncode($Grid->medicine_dispensation_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <td data-name="medicine_stock_id"<?= $Grid->medicine_stock_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_stock_id" class="el_medicine_dispensation_details_medicine_stock_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        name="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        class="form-select ew-select<?= $Grid->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensation_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id"
        <?php } ?>
        data-table="medicine_dispensation_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Grid->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_stock_id->editAttributes() ?>>
        <?= $Grid->medicine_stock_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_stock_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_stock_id->getErrorMessage() ?></div>
<?= $Grid->medicine_stock_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_stock_id") ?>
<?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensation_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_stock_id", selectId: "fmedicine_dispensation_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensation_detailsgrid.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fmedicine_dispensation_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fmedicine_dispensation_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_stock_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_medicine_stock_id" id="o<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_stock_id" class="el_medicine_dispensation_details_medicine_stock_id">
    <select
        id="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        name="x<?= $Grid->RowIndex ?>_medicine_stock_id"
        class="form-select ew-select<?= $Grid->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensation_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id"
        <?php } ?>
        data-table="medicine_dispensation_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Grid->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Grid->medicine_stock_id->editAttributes() ?>>
        <?= $Grid->medicine_stock_id->selectOptionListHtml("x{$Grid->RowIndex}_medicine_stock_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->medicine_stock_id->getErrorMessage() ?></div>
<?= $Grid->medicine_stock_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_medicine_stock_id") ?>
<?php if (!$Grid->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensation_detailsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_medicine_stock_id", selectId: "fmedicine_dispensation_detailsgrid_x<?= $Grid->RowIndex ?>_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensation_detailsgrid.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fmedicine_dispensation_detailsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_medicine_stock_id", form: "fmedicine_dispensation_detailsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_medicine_stock_id" class="el_medicine_dispensation_details_medicine_stock_id">
<span<?= $Grid->medicine_stock_id->viewAttributes() ?>>
<?= $Grid->medicine_stock_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_stock_id" data-hidden="1" name="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_stock_id" id="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_medicine_stock_id" data-hidden="1" data-old name="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_stock_id" id="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_medicine_stock_id" value="<?= HtmlEncode($Grid->medicine_stock_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_quantity" class="el_medicine_dispensation_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="medicine_dispensation_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_quantity" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_quantity" class="el_medicine_dispensation_details_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="medicine_dispensation_details" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->quantity->formatPattern()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_medicine_dispensation_details_quantity" class="el_medicine_dispensation_details_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_quantity" data-hidden="1" name="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" id="fmedicine_dispensation_detailsgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="medicine_dispensation_details" data-field="x_quantity" data-hidden="1" data-old name="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" id="fmedicine_dispensation_detailsgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
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
loadjs.ready(["fmedicine_dispensation_detailsgrid","load"], () => fmedicine_dispensation_detailsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fmedicine_dispensation_detailsgrid">
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
    ew.addEventHandlers("medicine_dispensation_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
