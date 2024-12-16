<?php

namespace PHPMaker2024\afyaplus;

// Set up and run Grid object
$Grid = Container("InvoicesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var finvoicesgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { invoices: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoicesgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["payment_status", [fields.payment_status.visible && fields.payment_status.required ? ew.Validators.required(fields.payment_status.caption) : null], fields.payment_status.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["patient_id",false],["description",false],["payment_status",false],["created_by_user_id",false],["date_created",false],["date_updated",false]];
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
            "payment_status": <?= $Grid->payment_status->toClientList($Grid) ?>,
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
<div id="finvoicesgrid" class="ew-form ew-list-form">
<div id="gmp_invoices" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_invoicesgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_invoices_id" class="invoices_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <th data-name="patient_id" class="<?= $Grid->patient_id->headerCellClass() ?>"><div id="elh_invoices_patient_id" class="invoices_patient_id"><?= $Grid->renderFieldHeader($Grid->patient_id) ?></div></th>
<?php } ?>
<?php if ($Grid->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Grid->description->headerCellClass() ?>"><div id="elh_invoices_description" class="invoices_description"><?= $Grid->renderFieldHeader($Grid->description) ?></div></th>
<?php } ?>
<?php if ($Grid->payment_status->Visible) { // payment_status ?>
        <th data-name="payment_status" class="<?= $Grid->payment_status->headerCellClass() ?>"><div id="elh_invoices_payment_status" class="invoices_payment_status"><?= $Grid->renderFieldHeader($Grid->payment_status) ?></div></th>
<?php } ?>
<?php if ($Grid->created_by_user_id->Visible) { // created_by_user_id ?>
        <th data-name="created_by_user_id" class="<?= $Grid->created_by_user_id->headerCellClass() ?>"><div id="elh_invoices_created_by_user_id" class="invoices_created_by_user_id"><?= $Grid->renderFieldHeader($Grid->created_by_user_id) ?></div></th>
<?php } ?>
<?php if ($Grid->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Grid->date_created->headerCellClass() ?>"><div id="elh_invoices_date_created" class="invoices_date_created"><?= $Grid->renderFieldHeader($Grid->date_created) ?></div></th>
<?php } ?>
<?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <th data-name="date_updated" class="<?= $Grid->date_updated->headerCellClass() ?>"><div id="elh_invoices_date_updated" class="invoices_date_updated"><?= $Grid->renderFieldHeader($Grid->date_updated) ?></div></th>
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
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_id" class="el_invoices_id"></span>
<input type="hidden" data-table="invoices" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_id" class="el_invoices_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="invoices" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_id" class="el_invoices_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_id" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_id" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_id" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_id" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="invoices" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->patient_id->Visible) { // patient_id ?>
        <td data-name="patient_id"<?= $Grid->patient_id->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_patient_id" class="el_invoices_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_patient_id" class="el_invoices_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="invoices"
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
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="invoices" data-field="x_patient_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_patient_id" id="o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if ($Grid->patient_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_patient_id" class="el_invoices_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->patient_id->getDisplayValue($Grid->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_patient_id" name="x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_patient_id" class="el_invoices_patient_id">
    <select
        id="x<?= $Grid->RowIndex ?>_patient_id"
        name="x<?= $Grid->RowIndex ?>_patient_id"
        class="form-select ew-select<?= $Grid->patient_id->isInvalidClass() ?>"
        <?php if (!$Grid->patient_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_patient_id"
        <?php } ?>
        data-table="invoices"
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
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_patient_id", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_patient_id", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_patient_id" class="el_invoices_patient_id">
<span<?= $Grid->patient_id->viewAttributes() ?>>
<?= $Grid->patient_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_patient_id" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_patient_id" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_patient_id" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_patient_id" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_patient_id" value="<?= HtmlEncode($Grid->patient_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->description->Visible) { // description ?>
        <td data-name="description"<?= $Grid->description->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_description" class="el_invoices_description">
<?php $Grid->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="invoices" data-field="x_description" name="x<?= $Grid->RowIndex ?>_description" id="x<?= $Grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->description->getPlaceHolder()) ?>"<?= $Grid->description->editAttributes() ?>><?= $Grid->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["finvoicesgrid", "editor"], function() {
    ew.createEditor("finvoicesgrid", "x<?= $Grid->RowIndex ?>_description", 0, 0, <?= $Grid->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="invoices" data-field="x_description" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_description" id="o<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_description" class="el_invoices_description">
<?php $Grid->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="invoices" data-field="x_description" name="x<?= $Grid->RowIndex ?>_description" id="x<?= $Grid->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->description->getPlaceHolder()) ?>"<?= $Grid->description->editAttributes() ?>><?= $Grid->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["finvoicesgrid", "editor"], function() {
    ew.createEditor("finvoicesgrid", "x<?= $Grid->RowIndex ?>_description", 0, 0, <?= $Grid->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_description" class="el_invoices_description">
<span<?= $Grid->description->viewAttributes() ?>>
<?= $Grid->description->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_description" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_description" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_description" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_description" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_description" value="<?= HtmlEncode($Grid->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->payment_status->Visible) { // payment_status ?>
        <td data-name="payment_status"<?= $Grid->payment_status->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_payment_status" class="el_invoices_payment_status">
    <select
        id="x<?= $Grid->RowIndex ?>_payment_status"
        name="x<?= $Grid->RowIndex ?>_payment_status"
        class="form-select ew-select<?= $Grid->payment_status->isInvalidClass() ?>"
        <?php if (!$Grid->payment_status->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_payment_status"
        <?php } ?>
        data-table="invoices"
        data-field="x_payment_status"
        data-value-separator="<?= $Grid->payment_status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->payment_status->getPlaceHolder()) ?>"
        <?= $Grid->payment_status->editAttributes() ?>>
        <?= $Grid->payment_status->selectOptionListHtml("x{$Grid->RowIndex}_payment_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->payment_status->getErrorMessage() ?></div>
<?php if (!$Grid->payment_status->IsNativeSelect) { ?>
<script>
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_payment_status", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_payment_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.payment_status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_payment_status", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_payment_status", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.payment_status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="invoices" data-field="x_payment_status" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_payment_status" id="o<?= $Grid->RowIndex ?>_payment_status" value="<?= HtmlEncode($Grid->payment_status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_payment_status" class="el_invoices_payment_status">
    <select
        id="x<?= $Grid->RowIndex ?>_payment_status"
        name="x<?= $Grid->RowIndex ?>_payment_status"
        class="form-select ew-select<?= $Grid->payment_status->isInvalidClass() ?>"
        <?php if (!$Grid->payment_status->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_payment_status"
        <?php } ?>
        data-table="invoices"
        data-field="x_payment_status"
        data-value-separator="<?= $Grid->payment_status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->payment_status->getPlaceHolder()) ?>"
        <?= $Grid->payment_status->editAttributes() ?>>
        <?= $Grid->payment_status->selectOptionListHtml("x{$Grid->RowIndex}_payment_status") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->payment_status->getErrorMessage() ?></div>
<?php if (!$Grid->payment_status->IsNativeSelect) { ?>
<script>
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_payment_status", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_payment_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.payment_status?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_payment_status", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_payment_status", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.payment_status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_payment_status" class="el_invoices_payment_status">
<span<?= $Grid->payment_status->viewAttributes() ?>>
<?= $Grid->payment_status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_payment_status" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_payment_status" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_payment_status" value="<?= HtmlEncode($Grid->payment_status->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_payment_status" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_payment_status" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_payment_status" value="<?= HtmlEncode($Grid->payment_status->OldValue) ?>">
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
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_created_by_user_id" class="el_invoices_created_by_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_created_by_user_id"
        name="x<?= $Grid->RowIndex ?>_created_by_user_id"
        class="form-select ew-select<?= $Grid->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_created_by_user_id"
        <?php } ?>
        data-table="invoices"
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
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_created_by_user_id", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.created_by_user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_by_user_id" id="o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Grid->userIDAllow("grid")) { // Non system admin ?>
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->created_by_user_id->getDisplayValue($Grid->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_created_by_user_id" id="x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_created_by_user_id" class="el_invoices_created_by_user_id">
    <select
        id="x<?= $Grid->RowIndex ?>_created_by_user_id"
        name="x<?= $Grid->RowIndex ?>_created_by_user_id"
        class="form-select ew-select<?= $Grid->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Grid->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesgrid_x<?= $Grid->RowIndex ?>_created_by_user_id"
        <?php } ?>
        data-table="invoices"
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
loadjs.ready("finvoicesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_created_by_user_id", selectId: "finvoicesgrid_x<?= $Grid->RowIndex ?>_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesgrid.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "finvoicesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_created_by_user_id", form: "finvoicesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.created_by_user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_created_by_user_id" class="el_invoices_created_by_user_id">
<span<?= $Grid->created_by_user_id->viewAttributes() ?>>
<?= $Grid->created_by_user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_created_by_user_id" value="<?= HtmlEncode($Grid->created_by_user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Grid->date_created->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_created" class="el_invoices_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="invoices" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("finvoicesgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="invoices" data-field="x_date_created" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_created" id="o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_created" class="el_invoices_date_created">
<input type="<?= $Grid->date_created->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_created" id="x<?= $Grid->RowIndex ?>_date_created" data-table="invoices" data-field="x_date_created" value="<?= $Grid->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_created->formatPattern()) ?>"<?= $Grid->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_created->getErrorMessage() ?></div>
<?php if (!$Grid->date_created->ReadOnly && !$Grid->date_created->Disabled && !isset($Grid->date_created->EditAttrs["readonly"]) && !isset($Grid->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("finvoicesgrid", "x<?= $Grid->RowIndex ?>_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_created" class="el_invoices_date_created">
<span<?= $Grid->date_created->viewAttributes() ?>>
<?= $Grid->date_created->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_date_created" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_date_created" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_date_created" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_date_created" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_date_created" value="<?= HtmlEncode($Grid->date_created->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->date_updated->Visible) { // date_updated ?>
        <td data-name="date_updated"<?= $Grid->date_updated->cellAttributes() ?>>
<?php if ($Grid->RowType == RowType::ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_updated" class="el_invoices_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="invoices" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("finvoicesgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="invoices" data-field="x_date_updated" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_date_updated" id="o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == RowType::EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_updated" class="el_invoices_date_updated">
<input type="<?= $Grid->date_updated->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_date_updated" id="x<?= $Grid->RowIndex ?>_date_updated" data-table="invoices" data-field="x_date_updated" value="<?= $Grid->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Grid->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->date_updated->formatPattern()) ?>"<?= $Grid->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->date_updated->getErrorMessage() ?></div>
<?php if (!$Grid->date_updated->ReadOnly && !$Grid->date_updated->Disabled && !isset($Grid->date_updated->EditAttrs["readonly"]) && !isset($Grid->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finvoicesgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("finvoicesgrid", "x<?= $Grid->RowIndex ?>_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == RowType::VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_invoices_date_updated" class="el_invoices_date_updated">
<span<?= $Grid->date_updated->viewAttributes() ?>>
<?= $Grid->date_updated->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="invoices" data-field="x_date_updated" data-hidden="1" name="finvoicesgrid$x<?= $Grid->RowIndex ?>_date_updated" id="finvoicesgrid$x<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->FormValue) ?>">
<input type="hidden" data-table="invoices" data-field="x_date_updated" data-hidden="1" data-old name="finvoicesgrid$o<?= $Grid->RowIndex ?>_date_updated" id="finvoicesgrid$o<?= $Grid->RowIndex ?>_date_updated" value="<?= HtmlEncode($Grid->date_updated->OldValue) ?>">
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
loadjs.ready(["finvoicesgrid","load"], () => finvoicesgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
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
<input type="hidden" name="detailpage" value="finvoicesgrid">
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
    ew.addEventHandlers("invoices");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
