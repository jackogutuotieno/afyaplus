<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("LeaveApplicationsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fleave_applicationsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { leave_applications: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_applicationsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
            ["leave_category_id", [fields.leave_category_id.visible && fields.leave_category_id.required ? ew.Validators.required(fields.leave_category_id.caption) : null], fields.leave_category_id.isInvalid],
            ["start_from_date", [fields.start_from_date.visible && fields.start_from_date.required ? ew.Validators.required(fields.start_from_date.caption) : null, ew.Validators.datetime(fields.start_from_date.clientFormatPattern)], fields.start_from_date.isInvalid],
            ["days_applied", [fields.days_applied.visible && fields.days_applied.required ? ew.Validators.required(fields.days_applied.caption) : null, ew.Validators.integer], fields.days_applied.isInvalid],
            ["reporting_date", [fields.reporting_date.visible && fields.reporting_date.required ? ew.Validators.required(fields.reporting_date.caption) : null], fields.reporting_date.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["leave_category_id",false],["start_from_date",false],["days_applied",false],["reporting_date",false],["status",false],["date_created",false],["date_updated",false]];
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
<div id="fleave_applicationsgrid" class="ew-form ew-list-form">
<div id="gmp_leave_applications" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_leave_applicationsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="user_id" class="<?= $Grid->user_id->headerCellClass() ?>"><div id="elh_leave_applications_user_id" class="leave_applications_user_id"><?= $Grid->renderFieldHeader($Grid->user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->leave_category_id->Visible) { // leave_category_id ?>
        <th data-name="leave_category_id" class="<?= $Grid->leave_category_id->headerCellClass() ?>"><div id="elh_leave_applications_leave_category_id" class="leave_applications_leave_category_id"><?= $Grid->renderFieldHeader($Grid->leave_category_id) ?></div></th>
<?php } ?>
<?php if ($Grid->start_from_date->Visible) { // start_from_date ?>
        <th data-name="start_from_date" class="<?= $Grid->start_from_date->headerCellClass() ?>"><div id="elh_leave_applications_start_from_date" class="leave_applications_start_from_date"><?= $Grid->renderFieldHeader($Grid->start_from_date) ?></div></th>
<?php } ?>
<?php if ($Grid->days_applied->Visible) { // days_applied ?>
        <th data-name="days_applied" class="<?= $Grid->days_applied->headerCellClass() ?>"><div id="elh_leave_applications_days_applied" class="leave_applications_days_applied"><?= $Grid->renderFieldHeader($Grid->days_applied) ?></div></th>
<?php } ?>
<?php if ($Grid->reporting_date->Visible) { // reporting_date ?>
        <th data-name="reporting_date" class="<?= $Grid->reporting_date->headerCellClass() ?>"><div id="elh_leave_applications_reporting_date" class="leave_applications_reporting_date"><?= $Grid->renderFieldHeader($Grid->reporting_date) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_leave_applications_status" class="leave_applications_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_leave_applications_date_created" class="leave_applications_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_leave_applications_date_updated" class="leave_applications_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<input type="hidden" data-table="leave_applications" data-field="x_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_user_id" id="o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_user_id" class="el_leave_applications_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<?= $Grid->user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_user_id" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_user_id" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_user_id" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_user_id" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->leave_category_id->Visible) { // leave_category_id ?>
        <td data-name="leave_category_id"<?= $Grid->leave_category_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_leave_category_id" class="el_leave_applications_leave_category_id">
    <select
        id="x<?= $Grid->RowIndex ?>_leave_category_id"
        name="x<?= $Grid->RowIndex ?>_leave_category_id"
        class="form-select ew-select<?= $Grid->leave_category_id->isInvalidClass() ?>"
        <?php if (!$Grid->leave_category_id->IsNativeSelect) { ?>
        data-select2-id="fleave_applicationsgrid_x<?= $Grid->RowIndex ?>_leave_category_id"
        <?php } ?>
        data-table="leave_applications"
        data-field="x_leave_category_id"
        data-value-separator="<?= $Grid->leave_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>"
        <?= $Grid->leave_category_id->editAttributes() ?>>
        <?= $Grid->leave_category_id->selectOptionListHtml("x{$Grid->RowIndex}_leave_category_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->leave_category_id->getErrorMessage() ?></div>
<?= $Grid->leave_category_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_leave_category_id") ?>
<?php if (!$Grid->leave_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fleave_applicationsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_leave_category_id", selectId: "fleave_applicationsgrid_x<?= $Grid->RowIndex ?>_leave_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_applicationsgrid.lists.leave_category_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_leave_category_id", form: "fleave_applicationsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_leave_category_id", form: "fleave_applicationsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.leave_applications.fields.leave_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_leave_category_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_leave_category_id" id="o<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_leave_category_id" class="el_leave_applications_leave_category_id">
    <select
        id="x<?= $Grid->RowIndex ?>_leave_category_id"
        name="x<?= $Grid->RowIndex ?>_leave_category_id"
        class="form-select ew-select<?= $Grid->leave_category_id->isInvalidClass() ?>"
        <?php if (!$Grid->leave_category_id->IsNativeSelect) { ?>
        data-select2-id="fleave_applicationsgrid_x<?= $Grid->RowIndex ?>_leave_category_id"
        <?php } ?>
        data-table="leave_applications"
        data-field="x_leave_category_id"
        data-value-separator="<?= $Grid->leave_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->leave_category_id->getPlaceHolder()) ?>"
        <?= $Grid->leave_category_id->editAttributes() ?>>
        <?= $Grid->leave_category_id->selectOptionListHtml("x{$Grid->RowIndex}_leave_category_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->leave_category_id->getErrorMessage() ?></div>
<?= $Grid->leave_category_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_leave_category_id") ?>
<?php if (!$Grid->leave_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fleave_applicationsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_leave_category_id", selectId: "fleave_applicationsgrid_x<?= $Grid->RowIndex ?>_leave_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_applicationsgrid.lists.leave_category_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_leave_category_id", form: "fleave_applicationsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_leave_category_id", form: "fleave_applicationsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.leave_applications.fields.leave_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_leave_category_id" class="el_leave_applications_leave_category_id">
<span<?= $Grid->leave_category_id->viewAttributes() ?>>
<?= $Grid->leave_category_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_leave_category_id" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_leave_category_id" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_leave_category_id" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_leave_category_id" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_leave_category_id" value="<?= HtmlEncode($Grid->leave_category_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->start_from_date->Visible) { // start_from_date ?>
        <td data-name="start_from_date"<?= $Grid->start_from_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_start_from_date" class="el_leave_applications_start_from_date">
<input type="<?= $Grid->start_from_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_start_from_date" id="x<?= $Grid->RowIndex ?>_start_from_date" data-table="leave_applications" data-field="x_start_from_date" value="<?= $Grid->start_from_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->start_from_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->start_from_date->formatPattern()) ?>"<?= $Grid->start_from_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->start_from_date->getErrorMessage() ?></div>
<?php if (!$Grid->start_from_date->ReadOnly && !$Grid->start_from_date->Disabled && !isset($Grid->start_from_date->EditAttrs["readonly"]) && !isset($Grid->start_from_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_start_from_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_start_from_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_start_from_date" id="o<?= $Grid->RowIndex ?>_start_from_date" value="<?= HtmlEncode($Grid->start_from_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_start_from_date" class="el_leave_applications_start_from_date">
<input type="<?= $Grid->start_from_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_start_from_date" id="x<?= $Grid->RowIndex ?>_start_from_date" data-table="leave_applications" data-field="x_start_from_date" value="<?= $Grid->start_from_date->EditValue ?>" placeholder="<?= HtmlEncode($Grid->start_from_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->start_from_date->formatPattern()) ?>"<?= $Grid->start_from_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->start_from_date->getErrorMessage() ?></div>
<?php if (!$Grid->start_from_date->ReadOnly && !$Grid->start_from_date->Disabled && !isset($Grid->start_from_date->EditAttrs["readonly"]) && !isset($Grid->start_from_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_start_from_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_start_from_date" class="el_leave_applications_start_from_date">
<span<?= $Grid->start_from_date->viewAttributes() ?>>
<?= $Grid->start_from_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_start_from_date" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_start_from_date" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_start_from_date" value="<?= HtmlEncode($Grid->start_from_date->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_start_from_date" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_start_from_date" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_start_from_date" value="<?= HtmlEncode($Grid->start_from_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->days_applied->Visible) { // days_applied ?>
        <td data-name="days_applied"<?= $Grid->days_applied->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_days_applied" class="el_leave_applications_days_applied">
<input type="<?= $Grid->days_applied->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_applied" id="x<?= $Grid->RowIndex ?>_days_applied" data-table="leave_applications" data-field="x_days_applied" value="<?= $Grid->days_applied->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_applied->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_applied->formatPattern()) ?>"<?= $Grid->days_applied->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_applied->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_days_applied" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_days_applied" id="o<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_days_applied" class="el_leave_applications_days_applied">
<input type="<?= $Grid->days_applied->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_days_applied" id="x<?= $Grid->RowIndex ?>_days_applied" data-table="leave_applications" data-field="x_days_applied" value="<?= $Grid->days_applied->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->days_applied->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->days_applied->formatPattern()) ?>"<?= $Grid->days_applied->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->days_applied->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_days_applied" class="el_leave_applications_days_applied">
<span<?= $Grid->days_applied->viewAttributes() ?>>
<?= $Grid->days_applied->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_days_applied" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_days_applied" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_days_applied" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_days_applied" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_days_applied" value="<?= HtmlEncode($Grid->days_applied->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->reporting_date->Visible) { // reporting_date ?>
        <td data-name="reporting_date"<?= $Grid->reporting_date->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_reporting_date" class="el_leave_applications_reporting_date">
<input type="<?= $Grid->reporting_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_reporting_date" id="x<?= $Grid->RowIndex ?>_reporting_date" data-table="leave_applications" data-field="x_reporting_date" value="<?= $Grid->reporting_date->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->reporting_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->reporting_date->formatPattern()) ?>"<?= $Grid->reporting_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->reporting_date->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_reporting_date" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_reporting_date" id="o<?= $Grid->RowIndex ?>_reporting_date" value="<?= HtmlEncode($Grid->reporting_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_reporting_date" class="el_leave_applications_reporting_date">
<input type="<?= $Grid->reporting_date->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_reporting_date" id="x<?= $Grid->RowIndex ?>_reporting_date" data-table="leave_applications" data-field="x_reporting_date" value="<?= $Grid->reporting_date->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->reporting_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->reporting_date->formatPattern()) ?>"<?= $Grid->reporting_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->reporting_date->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_reporting_date" class="el_leave_applications_reporting_date">
<span<?= $Grid->reporting_date->viewAttributes() ?>>
<?= $Grid->reporting_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_reporting_date" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_reporting_date" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_reporting_date" value="<?= HtmlEncode($Grid->reporting_date->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_reporting_date" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_reporting_date" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_reporting_date" value="<?= HtmlEncode($Grid->reporting_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_status" class="el_leave_applications_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="leave_applications" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_status" class="el_leave_applications_status">
<input type="<?= $Grid->status->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" data-table="leave_applications" data-field="x_status" value="<?= $Grid->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->status->formatPattern()) ?>"<?= $Grid->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_status" class="el_leave_applications_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_status" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_status" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_status" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_status" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_created" class="el_leave_applications_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="leave_applications" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_created" class="el_leave_applications_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="leave_applications" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_created" class="el_leave_applications_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_date_created" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_date_created" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_date_created" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_date_created" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_updated" class="el_leave_applications_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="leave_applications" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_updated" class="el_leave_applications_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="leave_applications" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fleave_applicationsgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_leave_applications_date_updated" class="el_leave_applications_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="leave_applications" data-field="x_date_updated" data-hidden="1" name="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_date_updated" id="fleave_applicationsgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="leave_applications" data-field="x_date_updated" data-hidden="1" data-old name="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_date_updated" id="fleave_applicationsgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["fleave_applicationsgrid","load"], () => fleave_applicationsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="fleave_applicationsgrid">
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
    ew.addEventHandlers("leave_applications");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
