<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LabTestReportsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var flab_test_reportsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { lab_test_reports: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_reportsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["details", [fields.details.visible && fields.details.required ? ew.Validators.required(fields.details.caption) : null], fields.details.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["lab_test_request_id", [fields.lab_test_request_id.visible && fields.lab_test_request_id.required ? ew.Validators.required(fields.lab_test_request_id.caption) : null, ew.Validators.integer], fields.lab_test_request_id.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["details",false],["created_by_user_id",false],["date_created",false],["lab_test_request_id",false]];
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
<div id="flab_test_reportsgrid" class="ew-form ew-list-form">
<div id="gmp_lab_test_reports" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_lab_test_reportsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_lab_test_reports_id" class="lab_test_reports_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->details->Visible) { // details ?>
        <th data-name="details" class="<?= $Grid->details->headerCellClass() ?>"><div id="elh_lab_test_reports_details" class="lab_test_reports_details"><?= $Grid->renderFieldHeader($Grid->details) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_lab_test_reports_created_by_user_id" class="lab_test_reports_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_lab_test_reports_date_created" class="lab_test_reports_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->lab_test_request_id->Visible) { // lab_test_request_id ?>
        <th data-name="lab_test_request_id" class="<?= $Grid->lab_test_request_id->headerCellClass() ?>"><div id="elh_lab_test_reports_lab_test_request_id" class="lab_test_reports_lab_test_request_id"><?= $Grid->renderFieldHeader($Grid->lab_test_request_id) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_id" class="el_lab_test_reports_id"></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_id" class="el_lab_test_reports_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_id" class="el_lab_test_reports_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" name="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_id" id="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" data-old name="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_id" id="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->details->Visible) { // details ?>
        <td data-name="details"<?= $Grid->details->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_details" class="el_lab_test_reports_details">
<?php $Grid->details->EditAttrs->appendClass("editor"); ?>
<textarea data-table="lab_test_reports" data-field="x_details" name="x<?= $Grid->RowIndex ?>_details" id="x<?= $Grid->RowIndex ?>_details" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->details->getPlaceHolder()) ?>"<?= $Grid->details->editAttributes() ?>><?= $Grid->details->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->details->getErrorMessage() ?></div>
<script>
loadjs.ready(["flab_test_reportsgrid", "editor"], function() {
    ew.createEditor("flab_test_reportsgrid", "x<?= $Grid->RowIndex ?>_details", 0, 0, <?= $Grid->details->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="lab_test_reports" data-field="x_details" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_details" id="o<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_details" class="el_lab_test_reports_details">
<?php $Grid->details->EditAttrs->appendClass("editor"); ?>
<textarea data-table="lab_test_reports" data-field="x_details" name="x<?= $Grid->RowIndex ?>_details" id="x<?= $Grid->RowIndex ?>_details" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->details->getPlaceHolder()) ?>"<?= $Grid->details->editAttributes() ?>><?= $Grid->details->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->details->getErrorMessage() ?></div>
<script>
loadjs.ready(["flab_test_reportsgrid", "editor"], function() {
    ew.createEditor("flab_test_reportsgrid", "x<?= $Grid->RowIndex ?>_details", 0, 0, <?= $Grid->details->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_details" class="el_lab_test_reports_details">
<span<?= $Grid->details->viewAttributes() ?>>
<?= $Grid->details->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_details" data-hidden="1" name="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_details" id="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->FormValue) ?>">
<input type="hidden" data-table="lab_test_reports" data-field="x_details" data-hidden="1" data-old name="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_details" id="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_details" value="<?= HtmlEncode($Grid->details->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <td data-name="created_by_user_id"<?= $Grid->created_by_user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Grid->userIDAllow("grid")) { // Non system admin ?>
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->created_by_user_id->getDisplayValue($Grid->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_created_by_user_id" class="el_lab_test_reports_created_by_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_created_by_user_id"
        name="x<?= $Grid->RowIndex ?>_created_by_user_id"
        class="form-select ew-select<?= $Grid->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_reportsgrid_x<?= $Grid->RowIndex ?>_created_by_user_id"
        <?php } ?>
        data-table="lab_test_reports"
        data-field="x_created_by_user_id"
        data-value-separator="<?= $Grid->created_by_user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->created_by_user_id->getPlaceHolder()) ?>"
        <?= $Grid->created_by_user_id->editAttributes() ?>>
        <?= $Grid->created_by_user_id->selectOptionListHtml("x{$Grid->RowIndex}_created_by_user_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->created_by_user_id->getErrorMessage() ?></div>
<?= $Grid->created_by_user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_created_by_user_id") ?>
<?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_created_by_user_id", selectId: "flab_test_reportsgrid_x<?= $Grid->RowIndex ?>_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_reportsgrid.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "flab_test_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "flab_test_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_reports.fields.created_by_user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Grid->userIDAllow("grid")) { // Non system admin ?>
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->created_by_user_id->getDisplayValue($Grid->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_created_by_user_id" class="el_lab_test_reports_created_by_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_created_by_user_id"
        name="x<?= $Grid->RowIndex ?>_created_by_user_id"
        class="form-select ew-select<?= $Grid->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_reportsgrid_x<?= $Grid->RowIndex ?>_created_by_user_id"
        <?php } ?>
        data-table="lab_test_reports"
        data-field="x_created_by_user_id"
        data-value-separator="<?= $Grid->created_by_user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->created_by_user_id->getPlaceHolder()) ?>"
        <?= $Grid->created_by_user_id->editAttributes() ?>>
        <?= $Grid->created_by_user_id->selectOptionListHtml("x{$Grid->RowIndex}_created_by_user_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->created_by_user_id->getErrorMessage() ?></div>
<?= $Grid->created_by_user_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_created_by_user_id") ?>
<?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_reportsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_created_by_user_id", selectId: "flab_test_reportsgrid_x<?= $Grid->RowIndex ?>_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_reportsgrid.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "flab_test_reportsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "flab_test_reportsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_reports.fields.created_by_user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_created_by_user_id" class="el_lab_test_reports_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" name="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" data-old name="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_date_created" class="el_lab_test_reports_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="lab_test_reports" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flab_test_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("flab_test_reportsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="lab_test_reports" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_date_created" class="el_lab_test_reports_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="lab_test_reports" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flab_test_reportsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("flab_test_reportsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_date_created" class="el_lab_test_reports_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_date_created" data-hidden="1" name="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_date_created" id="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="lab_test_reports" data-field="x_date_created" data-hidden="1" data-old name="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_date_created" id="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lab_test_request_id->Visible) { // lab_test_request_id ?>
        <td data-name="lab_test_request_id"<?= $Grid->lab_test_request_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->lab_test_request_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_request_id->getDisplayValue($Grid->lab_test_request_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_request_id" name="x<?= $Grid->RowIndex ?>_lab_test_request_id" value="<?= HtmlEncode($Grid->lab_test_request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_lab_test_request_id" class="el_lab_test_reports_lab_test_request_id">
<input type="<?= $Grid->lab_test_request_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_request_id" id="x<?= $Grid->RowIndex ?>_lab_test_request_id" data-table="lab_test_reports" data-field="x_lab_test_request_id" value="<?= $Grid->lab_test_request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_request_id->formatPattern()) ?>"<?= $Grid->lab_test_request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_lab_test_request_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_lab_test_request_id" id="o<?= $Grid->RowIndex ?>_lab_test_request_id" value="<?= HtmlEncode($Grid->lab_test_request_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->lab_test_request_id->getSessionValue() != "") { ?>
<span<?= $Grid->lab_test_request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lab_test_request_id->getDisplayValue($Grid->lab_test_request_id->ViewValue))) ?>"></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_lab_test_request_id" name="x<?= $Grid->RowIndex ?>_lab_test_request_id" value="<?= HtmlEncode($Grid->lab_test_request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_lab_test_request_id" class="el_lab_test_reports_lab_test_request_id">
<input type="<?= $Grid->lab_test_request_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lab_test_request_id" id="x<?= $Grid->RowIndex ?>_lab_test_request_id" data-table="lab_test_reports" data-field="x_lab_test_request_id" value="<?= $Grid->lab_test_request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lab_test_request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->lab_test_request_id->formatPattern()) ?>"<?= $Grid->lab_test_request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lab_test_request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_lab_test_reports_lab_test_request_id" class="el_lab_test_reports_lab_test_request_id">
<span<?= $Grid->lab_test_request_id->viewAttributes() ?>>
<?= $Grid->lab_test_request_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="lab_test_reports" data-field="x_lab_test_request_id" data-hidden="1" name="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_lab_test_request_id" id="flab_test_reportsgrid$x<?= $Grid->RowIndex ?>_lab_test_request_id" value="<?= HtmlEncode($Grid->lab_test_request_id->FormValue) ?>">
<input type="hidden" data-table="lab_test_reports" data-field="x_lab_test_request_id" data-hidden="1" data-old name="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_lab_test_request_id" id="flab_test_reportsgrid$o<?= $Grid->RowIndex ?>_lab_test_request_id" value="<?= HtmlEncode($Grid->lab_test_request_id->OldValue) ?>">
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
loadjs.ready(["flab_test_reportsgrid","load"], () => flab_test_reportsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="flab_test_reportsgrid">
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
    ew.addEventHandlers("lab_test_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
