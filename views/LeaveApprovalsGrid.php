<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LeaveApprovalsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fleave_approvalsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { leave_approvals: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_approvalsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
            ["leave_category_id", [fields.leave_category_id.visible && fields.leave_category_id.required ? ew.Validators.required(fields.leave_category_id.caption) : null, ew.Validators.integer], fields.leave_category_id.isInvalid],
            ["days_applied", [fields.days_applied.visible && fields.days_applied.required ? ew.Validators.required(fields.days_applied.caption) : null, ew.Validators.integer], fields.days_applied.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["user_id",false],["leave_category_id",false],["days_applied",false],["status",false],["date_created",false],["date_updated",false]];
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
            "user_id": <?= $Grid->user_id->toClientList($Grid) ?>,
            "leave_category_id": <?= $Grid->leave_category_id->toClientList($Grid) ?>,
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
<div id="fleave_approvalsgrid" class="ew-form ew-list-form">
<div id="gmp_leave_approvals" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_leave_approvalsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Grid->user_id->headerCellClass() ?>"><div id="elh_leave_approvals_user_id" class="leave_approvals_user_id"><?= $Grid->renderFieldHeader($Grid->user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->leave_category_id->Visible) { // leave_category_id ?>
        <th data-name="leave_category_id" class="<?= $Grid->leave_category_id->headerCellClass() ?>"><div id="elh_leave_approvals_leave_category_id" class="leave_approvals_leave_category_id"><?= $Grid->renderFieldHeader($Grid->leave_category_id) ?></div></th>
<?php } ?>
<?php if ($Grid->days_applied->Visible) { // days_applied ?>
        <th data-name="days_applied" class="<?= $Grid->days_applied->headerCellClass() ?>"><div id="elh_leave_approvals_days_applied" class="leave_approvals_days_applied"><?= $Grid->renderFieldHeader($Grid->days_applied) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_leave_approvals_status" class="leave_approvals_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_leave_approvals_date_created" class="leave_approvals_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_leave_approvals_date_updated" class="leave_approvals_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
    <?php if ($Grid->user_id->Visible) { // user_id ?>
        <td data-name="user_id"<?= $Grid->user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->user_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_user_id" class="el_leave_approvals_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->user_id->getDisplayValue($Grid->user_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_user_id" name="x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_user_id" class="el_leave_approvals_user_id">
<?php
if (IsRTL()) {
    $Grid->user_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_user_id" class="ew-auto-suggest">
    <input type="<?= $Grid->user_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_user_id" id="sv_x<?= $Grid->RowIndex ?>_user_id" value="<?= RemoveHtml($Grid->user_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->user_id->formatPattern()) ?>"<?= $Grid->user_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="leave_approvals" data-field="x_user_id" data-input="sv_x<?= $Grid->RowIndex ?>_user_id" data-value-separator="<?= $Grid->user_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    fleave_approvalsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_user_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->user_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.leave_approvals.fields.user_id.autoSuggestOptions));
});
</script>
<?= $Grid->user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_user_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="leave_approvals" data-field="x_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_user_id" id="o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->user_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_user_id" class="el_leave_approvals_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->user_id->getDisplayValue($Grid->user_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_user_id" name="x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_user_id" class="el_leave_approvals_user_id">
<?php
if (IsRTL()) {
    $Grid->user_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_user_id" class="ew-auto-suggest">
    <input type="<?= $Grid->user_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_user_id" id="sv_x<?= $Grid->RowIndex ?>_user_id" value="<?= RemoveHtml($Grid->user_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->user_id->formatPattern()) ?>"<?= $Grid->user_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="leave_approvals" data-field="x_user_id" data-input="sv_x<?= $Grid->RowIndex ?>_user_id" data-value-separator="<?= $Grid->user_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    fleave_approvalsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_user_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->user_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.leave_approvals.fields.user_id.autoSuggestOptions));
});
</script>
<?= $Grid->user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_user_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_user_id" class="el_leave_approvals_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<?= $Grid->user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_user_id" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_user_id" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_user_id" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_user_id" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->leave_category_id->Visible) { // leave_category_id ?>
        <td data-name="leave_category_id"<?= $Grid->leave_category_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_leave_category_id" class="el_leave_approvals_leave_category_id">
<?php
if (IsRTL()) {
    $Grid->leave_category_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_leave_category_id" class="ew-auto-suggest">
    <input type="<?= $Grid->leave_category_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_leave_category_id" id="sv_x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= RemoveHtml($Grid->leave_category_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->leave_category_id->formatPattern()) ?>"<?= $Grid->leave_category_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="leave_approvals" data-field="x_leave_category_id" data-input="sv_x<?= $Grid->RowIndex ?>_leave_category_id" data-value-separator="<?= $Grid->leave_category_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_leave_category_id" id="x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->leave_category_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    fleave_approvalsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_leave_category_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->leave_category_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.leave_approvals.fields.leave_category_id.autoSuggestOptions));
});
</script>
<?= $Grid->leave_category_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_leave_category_id") ?>
</span>
<input type="hidden" data-table="leave_approvals" data-field="x_leave_category_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_leave_category_id" id="o<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_leave_category_id" class="el_leave_approvals_leave_category_id">
<?php
if (IsRTL()) {
    $Grid->leave_category_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_leave_category_id" class="ew-auto-suggest">
    <input type="<?= $Grid->leave_category_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_leave_category_id" id="sv_x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= RemoveHtml($Grid->leave_category_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->leave_category_id->formatPattern()) ?>"<?= $Grid->leave_category_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="leave_approvals" data-field="x_leave_category_id" data-input="sv_x<?= $Grid->RowIndex ?>_leave_category_id" data-value-separator="<?= $Grid->leave_category_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_leave_category_id" id="x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->CurrentValue) ?>"></selection-list>
<div class="invalid-feedback"><?= $Grid->leave_category_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    fleave_approvalsgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_leave_category_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Grid->leave_category_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.leave_approvals.fields.leave_category_id.autoSuggestOptions));
});
</script>
<?= $Grid->leave_category_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_leave_category_id") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_leave_category_id" class="el_leave_approvals_leave_category_id">
<span<?= $Grid->leave_category_id->viewAttributes() ?>>
<?= $Grid->leave_category_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_leave_category_id" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_leave_category_id" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_leave_category_id" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_leave_category_id" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->days_applied->Visible) { // days_applied ?>
        <td data-name="days_applied"<?= $Grid->days_applied->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_days_applied" class="el_leave_approvals_days_applied">
<input type="<?= $Grid->days_applied->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_applied" id="x<?= $Grid->RowIndex ?>_days_applied" data-table="leave_approvals" data-field="x_days_applied" value="<?= $Grid->days_applied->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_applied->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_applied->formatPattern()) ?>"<?= $Grid->days_applied->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_applied->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_approvals" data-field="x_days_applied" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_days_applied" id="o<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_days_applied" class="el_leave_approvals_days_applied">
<input type="<?= $Grid->days_applied->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_applied" id="x<?= $Grid->RowIndex ?>_days_applied" data-table="leave_approvals" data-field="x_days_applied" value="<?= $Grid->days_applied->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_applied->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_applied->formatPattern()) ?>"<?= $Grid->days_applied->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_applied->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_days_applied" class="el_leave_approvals_days_applied">
<span<?= $Grid->days_applied->viewAttributes() ?>>
<?= $Grid->days_applied->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_days_applied" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_days_applied" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_days_applied" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_days_applied" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_status" class="el_leave_approvals_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fleave_approvalsgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="leave_approvals"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fleave_approvalsgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_approvalsgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fleave_approvalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fleave_approvalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.leave_approvals.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_approvals" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_status" class="el_leave_approvals_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fleave_approvalsgrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="leave_approvals"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fleave_approvalsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fleave_approvalsgrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_approvalsgrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fleave_approvalsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fleave_approvalsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.leave_approvals.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_status" class="el_leave_approvals_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_status" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_status" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_status" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_status" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_created" class="el_leave_approvals_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="leave_approvals" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_approvalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_approvalsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_approvals" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_created" class="el_leave_approvals_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="leave_approvals" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_approvalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_approvalsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_created" class="el_leave_approvals_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_date_created" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_date_created" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_updated" class="el_leave_approvals_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="leave_approvals" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_approvalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_approvalsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_approvals" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_updated" class="el_leave_approvals_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="leave_approvals" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_approvalsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_approvalsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_approvals_date_updated" class="el_leave_approvals_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_approvals" data-field="x_date_updated" data-hidden="1" name="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fleave_approvalsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="leave_approvals" data-field="x_date_updated" data-hidden="1" data-old name="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fleave_approvalsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fleave_approvalsgrid","load"], () => fleave_approvalsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fleave_approvalsgrid">
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
    ew.addEventHandlers("leave_approvals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
