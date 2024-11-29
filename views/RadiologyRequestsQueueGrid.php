<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("RadiologyRequestsQueueGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fradiology_requests_queuegrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { radiology_requests_queue: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_requests_queuegrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["radiology_requests_details_id", [fields.radiology_requests_details_id.visible && fields.radiology_requests_details_id.required ? ew.Validators.required(fields.radiology_requests_details_id.caption) : null, ew.Validators.integer], fields.radiology_requests_details_id.isInvalid],
            ["test_time", [fields.test_time.visible && fields.test_time.required ? ew.Validators.required(fields.test_time.caption) : null], fields.test_time.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["radiology_requests_details_id",false],["test_time",false],["status",false],["date_created",false]];
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
            "status": <?= $Grid->status->toClientList($Grid) ?>,
            "created_by_user_id": <?= $Grid->created_by_user_id->toClientList($Grid) ?>,
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
<div id="fradiology_requests_queuegrid" class="ew-form ew-list-form">
<div id="gmp_radiology_requests_queue" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_radiology_requests_queuegrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Grid->radiology_requests_details_id->Visible) { // radiology_requests_details_id ?>
        <th data-name="radiology_requests_details_id" class="<?= $Grid->radiology_requests_details_id->headerCellClass() ?>"><div id="elh_radiology_requests_queue_radiology_requests_details_id" class="radiology_requests_queue_radiology_requests_details_id"><?= $Grid->renderFieldHeader($Grid->radiology_requests_details_id) ?></div></th>
<?php } ?>
<?php if ($Grid->test_time->Visible) { // test_time ?>
        <th data-name="test_time" class="<?= $Grid->test_time->headerCellClass() ?>"><div id="elh_radiology_requests_queue_test_time" class="radiology_requests_queue_test_time"><?= $Grid->renderFieldHeader($Grid->test_time) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_radiology_requests_queue_status" class="radiology_requests_queue_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_radiology_requests_queue_created_by_user_id" class="radiology_requests_queue_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_radiology_requests_queue_date_created" class="radiology_requests_queue_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
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
    <?php if ($Grid->radiology_requests_details_id->Visible) { // radiology_requests_details_id ?>
        <td data-name="radiology_requests_details_id"<?= $Grid->radiology_requests_details_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->radiology_requests_details_id->getSessionValue() != "") { ?>
<span<?= $Grid->radiology_requests_details_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->radiology_requests_details_id->getDisplayValue($Grid->radiology_requests_details_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" name="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" value="<?= HtmlEncode($Grid->radiology_requests_details_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_radiology_requests_details_id" class="el_radiology_requests_queue_radiology_requests_details_id">
<input type="<?= $Grid->radiology_requests_details_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" id="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" value="<?= $Grid->radiology_requests_details_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->radiology_requests_details_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiology_requests_details_id->formatPattern()) ?>"<?= $Grid->radiology_requests_details_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiology_requests_details_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_radiology_requests_details_id" id="o<?= $Grid->RowIndex ?>_radiology_requests_details_id" value="<?= HtmlEncode($Grid->radiology_requests_details_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->radiology_requests_details_id->getSessionValue() != "") { ?>
<span<?= $Grid->radiology_requests_details_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->radiology_requests_details_id->getDisplayValue($Grid->radiology_requests_details_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" name="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" value="<?= HtmlEncode($Grid->radiology_requests_details_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_radiology_requests_details_id" class="el_radiology_requests_queue_radiology_requests_details_id">
<input type="<?= $Grid->radiology_requests_details_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" id="x<?= $Grid->RowIndex ?>_radiology_requests_details_id" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" value="<?= $Grid->radiology_requests_details_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->radiology_requests_details_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->radiology_requests_details_id->formatPattern()) ?>"<?= $Grid->radiology_requests_details_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->radiology_requests_details_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_radiology_requests_details_id" class="el_radiology_requests_queue_radiology_requests_details_id">
<span<?= $Grid->radiology_requests_details_id->viewAttributes() ?>>
<?= $Grid->radiology_requests_details_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" data-hidden="1" name="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_radiology_requests_details_id" id="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_radiology_requests_details_id" value="<?= HtmlEncode($Grid->radiology_requests_details_id->FormValue) ?>">
<input type="hidden" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" data-hidden="1" data-old name="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_radiology_requests_details_id" id="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_radiology_requests_details_id" value="<?= HtmlEncode($Grid->radiology_requests_details_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->test_time->Visible) { // test_time ?>
        <td data-name="test_time"<?= $Grid->test_time->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_test_time" class="el_radiology_requests_queue_test_time">
<input type="<?= $Grid->test_time->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_test_time" id="x<?= $Grid->RowIndex ?>_test_time" data-table="radiology_requests_queue" data-field="x_test_time" value="<?= $Grid->test_time->EditValue ?>" size="30" maxlength="32" placeholder="<?= HtmlEncode($Grid->test_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->test_time->formatPattern()) ?>"<?= $Grid->test_time->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->test_time->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_test_time" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_test_time" id="o<?= $Grid->RowIndex ?>_test_time" value="<?= HtmlEncode($Grid->test_time->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_test_time" class="el_radiology_requests_queue_test_time">
<input type="<?= $Grid->test_time->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_test_time" id="x<?= $Grid->RowIndex ?>_test_time" data-table="radiology_requests_queue" data-field="x_test_time" value="<?= $Grid->test_time->EditValue ?>" size="30" maxlength="32" placeholder="<?= HtmlEncode($Grid->test_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->test_time->formatPattern()) ?>"<?= $Grid->test_time->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->test_time->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_test_time" class="el_radiology_requests_queue_test_time">
<span<?= $Grid->test_time->viewAttributes() ?>>
<?= $Grid->test_time->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_test_time" data-hidden="1" name="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_test_time" id="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_test_time" value="<?= HtmlEncode($Grid->test_time->FormValue) ?>">
<input type="hidden" data-table="radiology_requests_queue" data-field="x_test_time" data-hidden="1" data-old name="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_test_time" id="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_test_time" value="<?= HtmlEncode($Grid->test_time->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_status" class="el_radiology_requests_queue_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fradiology_requests_queuegrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="radiology_requests_queue"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fradiology_requests_queuegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fradiology_requests_queuegrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_requests_queuegrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fradiology_requests_queuegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fradiology_requests_queuegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_requests_queue.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_status" class="el_radiology_requests_queue_status">
    <select
        id="x<?= $Grid->RowIndex ?>_status"
        name="x<?= $Grid->RowIndex ?>_status"
        class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>"
        <?php if (!$Grid->status->IsNativeSelect) { ?>
        data-select2-id="fradiology_requests_queuegrid_x<?= $Grid->RowIndex ?>_status"
        <?php } ?>
        data-table="radiology_requests_queue"
        data-field="x_status"
        data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>"
        <?= $Grid->status->editAttributes() ?>>
        <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
<?php if (!$Grid->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fradiology_requests_queuegrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_status", selectId: "fradiology_requests_queuegrid_x<?= $Grid->RowIndex ?>_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_requests_queuegrid.lists.status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_status", form: "fradiology_requests_queuegrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_status", form: "fradiology_requests_queuegrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_requests_queue.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_status" class="el_radiology_requests_queue_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_status" data-hidden="1" name="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_status" id="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="radiology_requests_queue" data-field="x_status" data-hidden="1" data-old name="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_status" id="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_created_by_user_id" class="el_radiology_requests_queue_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_created_by_user_id" data-hidden="1" name="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="radiology_requests_queue" data-field="x_created_by_user_id" data-hidden="1" data-old name="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_date_created" class="el_radiology_requests_queue_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="radiology_requests_queue" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fradiology_requests_queuegrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fradiology_requests_queuegrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_date_created" class="el_radiology_requests_queue_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="radiology_requests_queue" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fradiology_requests_queuegrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fradiology_requests_queuegrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_radiology_requests_queue_date_created" class="el_radiology_requests_queue_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="radiology_requests_queue" data-field="x_date_created" data-hidden="1" name="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_date_created" id="fradiology_requests_queuegrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="radiology_requests_queue" data-field="x_date_created" data-hidden="1" data-old name="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_date_created" id="fradiology_requests_queuegrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
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
loadjs.ready(["fradiology_requests_queuegrid","load"], () => fradiology_requests_queuegrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fradiology_requests_queuegrid">
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
    ew.addEventHandlers("radiology_requests_queue");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
