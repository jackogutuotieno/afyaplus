<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("BedsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fbedsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { beds: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbedsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_name", [fields.bed_name.visible && fields.bed_name.required ? ew.Validators.required(fields.bed_name.caption) : null], fields.bed_name.isInvalid],
            ["bed_charges", [fields.bed_charges.visible && fields.bed_charges.required ? ew.Validators.required(fields.bed_charges.caption) : null, ew.Validators.float], fields.bed_charges.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["ward_id",false],["bed_name",false],["bed_charges",false]];
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
            "ward_id": <?= $Grid->ward_id->toClientList($Grid) ?>,
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
<div id="fbedsgrid" class="ew-form ew-list-form">
<div id="gmp_beds" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_bedsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->ward_id->Visible) { // ward_id ?>
        <th data-name="ward_id" class="<?= $Grid->ward_id->headerCellClass() ?>"><div id="elh_beds_ward_id" class="beds_ward_id"><?= $Grid->renderFieldHeader($Grid->ward_id) ?></div></th>
<?php } ?>
<?php if ($Grid->bed_name->Visible) { // bed_name ?>
        <th data-name="bed_name" class="<?= $Grid->bed_name->headerCellClass() ?>"><div id="elh_beds_bed_name" class="beds_bed_name"><?= $Grid->renderFieldHeader($Grid->bed_name) ?></div></th>
<?php } ?>
<?php if ($Grid->bed_charges->Visible) { // bed_charges ?>
        <th data-name="bed_charges" class="<?= $Grid->bed_charges->headerCellClass() ?>"><div id="elh_beds_bed_charges" class="beds_bed_charges"><?= $Grid->renderFieldHeader($Grid->bed_charges) ?></div></th>
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
    <?php if ($Grid->ward_id->Visible) { // ward_id ?>
        <td data-name="ward_id"<?= $Grid->ward_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->ward_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
<span<?= $Grid->ward_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ward_id->getDisplayValue($Grid->ward_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ward_id" name="x<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_id"
        name="x<?= $Grid->RowIndex ?>_ward_id"
        class="form-select ew-select<?= $Grid->ward_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbedsgrid_x<?= $Grid->RowIndex ?>_ward_id"
        <?php } ?>
        data-table="beds"
        data-field="x_ward_id"
        data-value-separator="<?= $Grid->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_id->getPlaceHolder()) ?>"
        <?= $Grid->ward_id->editAttributes() ?>>
        <?= $Grid->ward_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_id->getErrorMessage() ?></div>
<?= $Grid->ward_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_id") ?>
<?php if (!$Grid->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbedsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_id", selectId: "fbedsgrid_x<?= $Grid->RowIndex ?>_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsgrid.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbedsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbedsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="beds" data-field="x_ward_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_ward_id" id="o<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->ward_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
<span<?= $Grid->ward_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ward_id->getDisplayValue($Grid->ward_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ward_id" name="x<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
    <select
        id="x<?= $Grid->RowIndex ?>_ward_id"
        name="x<?= $Grid->RowIndex ?>_ward_id"
        class="form-select ew-select<?= $Grid->ward_id->isInvalidClass() ?>"
        <?php if (!$Grid->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbedsgrid_x<?= $Grid->RowIndex ?>_ward_id"
        <?php } ?>
        data-table="beds"
        data-field="x_ward_id"
        data-value-separator="<?= $Grid->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ward_id->getPlaceHolder()) ?>"
        <?= $Grid->ward_id->editAttributes() ?>>
        <?= $Grid->ward_id->selectOptionListHtml("x{$Grid->RowIndex}_ward_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ward_id->getErrorMessage() ?></div>
<?= $Grid->ward_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ward_id") ?>
<?php if (!$Grid->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbedsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ward_id", selectId: "fbedsgrid_x<?= $Grid->RowIndex ?>_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsgrid.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbedsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ward_id", form: "fbedsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_ward_id" class="el_beds_ward_id">
<span<?= $Grid->ward_id->viewAttributes() ?>>
<?= $Grid->ward_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="beds" data-field="x_ward_id" data-hidden="1" name="fbedsgrid$x<?= $Grid->RowIndex ?>_ward_id" id="fbedsgrid$x<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->FormValue) ?>">
<input type="hidden" data-table="beds" data-field="x_ward_id" data-hidden="1" data-old name="fbedsgrid$o<?= $Grid->RowIndex ?>_ward_id" id="fbedsgrid$o<?= $Grid->RowIndex ?>_ward_id" value="<?= HtmlEncode($Grid->ward_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bed_name->Visible) { // bed_name ?>
        <td data-name="bed_name"<?= $Grid->bed_name->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_name" class="el_beds_bed_name">
<input type="<?= $Grid->bed_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_name" id="x<?= $Grid->RowIndex ?>_bed_name" data-table="beds" data-field="x_bed_name" value="<?= $Grid->bed_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->bed_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_name->formatPattern()) ?>"<?= $Grid->bed_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="beds" data-field="x_bed_name" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_bed_name" id="o<?= $Grid->RowIndex ?>_bed_name" value="<?= HtmlEncode($Grid->bed_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_name" class="el_beds_bed_name">
<input type="<?= $Grid->bed_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_name" id="x<?= $Grid->RowIndex ?>_bed_name" data-table="beds" data-field="x_bed_name" value="<?= $Grid->bed_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->bed_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_name->formatPattern()) ?>"<?= $Grid->bed_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_name" class="el_beds_bed_name">
<span<?= $Grid->bed_name->viewAttributes() ?>>
<?= $Grid->bed_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="beds" data-field="x_bed_name" data-hidden="1" name="fbedsgrid$x<?= $Grid->RowIndex ?>_bed_name" id="fbedsgrid$x<?= $Grid->RowIndex ?>_bed_name" value="<?= HtmlEncode($Grid->bed_name->FormValue) ?>">
<input type="hidden" data-table="beds" data-field="x_bed_name" data-hidden="1" data-old name="fbedsgrid$o<?= $Grid->RowIndex ?>_bed_name" id="fbedsgrid$o<?= $Grid->RowIndex ?>_bed_name" value="<?= HtmlEncode($Grid->bed_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bed_charges->Visible) { // bed_charges ?>
        <td data-name="bed_charges"<?= $Grid->bed_charges->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_charges" class="el_beds_bed_charges">
<input type="<?= $Grid->bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_charges" id="x<?= $Grid->RowIndex ?>_bed_charges" data-table="beds" data-field="x_bed_charges" value="<?= $Grid->bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_charges->formatPattern()) ?>"<?= $Grid->bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_charges->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="beds" data-field="x_bed_charges" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_bed_charges" id="o<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_charges" class="el_beds_bed_charges">
<input type="<?= $Grid->bed_charges->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_bed_charges" id="x<?= $Grid->RowIndex ?>_bed_charges" data-table="beds" data-field="x_bed_charges" value="<?= $Grid->bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->bed_charges->formatPattern()) ?>"<?= $Grid->bed_charges->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->bed_charges->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_beds_bed_charges" class="el_beds_bed_charges">
<span<?= $Grid->bed_charges->viewAttributes() ?>>
<?= $Grid->bed_charges->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="beds" data-field="x_bed_charges" data-hidden="1" name="fbedsgrid$x<?= $Grid->RowIndex ?>_bed_charges" id="fbedsgrid$x<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->FormValue) ?>">
<input type="hidden" data-table="beds" data-field="x_bed_charges" data-hidden="1" data-old name="fbedsgrid$o<?= $Grid->RowIndex ?>_bed_charges" id="fbedsgrid$o<?= $Grid->RowIndex ?>_bed_charges" value="<?= HtmlEncode($Grid->bed_charges->OldValue) ?>">
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
loadjs.ready(["fbedsgrid","load"], () => fbedsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fbedsgrid">
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
    ew.addEventHandlers("beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
