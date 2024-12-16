<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientQueueEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fpatient_queueedit" id="fpatient_queueedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_queue: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpatient_queueedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_queueedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["section", [fields.section.visible && fields.section.required ? ew.Validators.required(fields.section.caption) : null], fields.section.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
        ])

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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
            "section": <?= $Page->section->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_queue">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patient_visits") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_visits">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->visit_id->getSessionValue()) ?>">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_patient_queue_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_patient_queue_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="patient_queue" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_patient_queue_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_patient_queue_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_patient_queue_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_queueedit_x_patient_id"
        <?php } ?>
        data-table="patient_queue"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_queueedit", function() {
    var options = { name: "x_patient_id", selectId: "fpatient_queueedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_queueedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fpatient_queueedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fpatient_queueedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_queue.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->section->Visible) { // section ?>
    <div id="r_section"<?= $Page->section->rowAttributes() ?>>
        <label id="elh_patient_queue_section" for="x_section" class="<?= $Page->LeftColumnClass ?>"><?= $Page->section->caption() ?><?= $Page->section->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->section->cellAttributes() ?>>
<span id="el_patient_queue_section">
    <select
        id="x_section"
        name="x_section"
        class="form-select ew-select<?= $Page->section->isInvalidClass() ?>"
        <?php if (!$Page->section->IsNativeSelect) { ?>
        data-select2-id="fpatient_queueedit_x_section"
        <?php } ?>
        data-table="patient_queue"
        data-field="x_section"
        data-value-separator="<?= $Page->section->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->section->getPlaceHolder()) ?>"
        <?= $Page->section->editAttributes() ?>>
        <?= $Page->section->selectOptionListHtml("x_section") ?>
    </select>
    <?= $Page->section->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->section->getErrorMessage() ?></div>
<?php if (!$Page->section->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_queueedit", function() {
    var options = { name: "x_section", selectId: "fpatient_queueedit_x_section" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_queueedit.lists.section?.lookupOptions.length) {
        options.data = { id: "x_section", form: "fpatient_queueedit" };
    } else {
        options.ajax = { id: "x_section", form: "fpatient_queueedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_queue.fields.section.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_patient_queue_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_patient_queue_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        <?php if (!$Page->status->IsNativeSelect) { ?>
        data-select2-id="fpatient_queueedit_x_status"
        <?php } ?>
        data-table="patient_queue"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<?php if (!$Page->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_queueedit", function() {
    var options = { name: "x_status", selectId: "fpatient_queueedit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_queueedit.lists.status?.lookupOptions.length) {
        options.data = { id: "x_status", form: "fpatient_queueedit" };
    } else {
        options.ajax = { id: "x_status", form: "fpatient_queueedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_queue.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatient_queueedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatient_queueedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("patient_queue");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
