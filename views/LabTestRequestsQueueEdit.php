<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestRequestsQueueEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="flab_test_requests_queueedit" id="flab_test_requests_queueedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_requests_queue: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var flab_test_requests_queueedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_requests_queueedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_requests_detail_id", [fields.lab_test_requests_detail_id.visible && fields.lab_test_requests_detail_id.required ? ew.Validators.required(fields.lab_test_requests_detail_id.caption) : null, ew.Validators.integer], fields.lab_test_requests_detail_id.isInvalid],
            ["waiting_time", [fields.waiting_time.visible && fields.waiting_time.required ? ew.Validators.required(fields.waiting_time.caption) : null, ew.Validators.integer], fields.waiting_time.isInvalid],
            ["waiting_interval", [fields.waiting_interval.visible && fields.waiting_interval.required ? ew.Validators.required(fields.waiting_interval.caption) : null], fields.waiting_interval.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid]
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
            "waiting_interval": <?= $Page->waiting_interval->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
            "created_by_user_id": <?= $Page->created_by_user_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="lab_test_requests_queue">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "lab_test_requests_details") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="lab_test_requests_details">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->lab_test_requests_detail_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_lab_test_requests_queue_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="lab_test_requests_queue" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_requests_detail_id->Visible) { // lab_test_requests_detail_id ?>
    <div id="r_lab_test_requests_detail_id"<?= $Page->lab_test_requests_detail_id->rowAttributes() ?>>
        <label id="elh_lab_test_requests_queue_lab_test_requests_detail_id" for="x_lab_test_requests_detail_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_requests_detail_id->caption() ?><?= $Page->lab_test_requests_detail_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_requests_detail_id->cellAttributes() ?>>
<?php if ($Page->lab_test_requests_detail_id->getSessionValue() != "") { ?>
<span<?= $Page->lab_test_requests_detail_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->lab_test_requests_detail_id->getDisplayValue($Page->lab_test_requests_detail_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_lab_test_requests_detail_id" name="x_lab_test_requests_detail_id" value="<?= HtmlEncode($Page->lab_test_requests_detail_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_lab_test_requests_queue_lab_test_requests_detail_id">
<input type="<?= $Page->lab_test_requests_detail_id->getInputTextType() ?>" name="x_lab_test_requests_detail_id" id="x_lab_test_requests_detail_id" data-table="lab_test_requests_queue" data-field="x_lab_test_requests_detail_id" value="<?= $Page->lab_test_requests_detail_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lab_test_requests_detail_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lab_test_requests_detail_id->formatPattern()) ?>"<?= $Page->lab_test_requests_detail_id->editAttributes() ?> aria-describedby="x_lab_test_requests_detail_id_help">
<?= $Page->lab_test_requests_detail_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lab_test_requests_detail_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waiting_time->Visible) { // waiting_time ?>
    <div id="r_waiting_time"<?= $Page->waiting_time->rowAttributes() ?>>
        <label id="elh_lab_test_requests_queue_waiting_time" for="x_waiting_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waiting_time->caption() ?><?= $Page->waiting_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->waiting_time->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_waiting_time">
<input type="<?= $Page->waiting_time->getInputTextType() ?>" name="x_waiting_time" id="x_waiting_time" data-table="lab_test_requests_queue" data-field="x_waiting_time" value="<?= $Page->waiting_time->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->waiting_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->waiting_time->formatPattern()) ?>"<?= $Page->waiting_time->editAttributes() ?> aria-describedby="x_waiting_time_help">
<?= $Page->waiting_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waiting_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waiting_interval->Visible) { // waiting_interval ?>
    <div id="r_waiting_interval"<?= $Page->waiting_interval->rowAttributes() ?>>
        <label id="elh_lab_test_requests_queue_waiting_interval" for="x_waiting_interval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waiting_interval->caption() ?><?= $Page->waiting_interval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->waiting_interval->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_waiting_interval">
    <select
        id="x_waiting_interval"
        name="x_waiting_interval"
        class="form-select ew-select<?= $Page->waiting_interval->isInvalidClass() ?>"
        <?php if (!$Page->waiting_interval->IsNativeSelect) { ?>
        data-select2-id="flab_test_requests_queueedit_x_waiting_interval"
        <?php } ?>
        data-table="lab_test_requests_queue"
        data-field="x_waiting_interval"
        data-value-separator="<?= $Page->waiting_interval->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->waiting_interval->getPlaceHolder()) ?>"
        <?= $Page->waiting_interval->editAttributes() ?>>
        <?= $Page->waiting_interval->selectOptionListHtml("x_waiting_interval") ?>
    </select>
    <?= $Page->waiting_interval->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->waiting_interval->getErrorMessage() ?></div>
<?php if (!$Page->waiting_interval->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_requests_queueedit", function() {
    var options = { name: "x_waiting_interval", selectId: "flab_test_requests_queueedit_x_waiting_interval" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_requests_queueedit.lists.waiting_interval?.lookupOptions.length) {
        options.data = { id: "x_waiting_interval", form: "flab_test_requests_queueedit" };
    } else {
        options.ajax = { id: "x_waiting_interval", form: "flab_test_requests_queueedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_requests_queue.fields.waiting_interval.selectOptions);
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
        <label id="elh_lab_test_requests_queue_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        <?php if (!$Page->status->IsNativeSelect) { ?>
        data-select2-id="flab_test_requests_queueedit_x_status"
        <?php } ?>
        data-table="lab_test_requests_queue"
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
loadjs.ready("flab_test_requests_queueedit", function() {
    var options = { name: "x_status", selectId: "flab_test_requests_queueedit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_requests_queueedit.lists.status?.lookupOptions.length) {
        options.data = { id: "x_status", form: "flab_test_requests_queueedit" };
    } else {
        options.ajax = { id: "x_status", form: "flab_test_requests_queueedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_requests_queue.fields.status.selectOptions);
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="flab_test_requests_queueedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="flab_test_requests_queueedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("lab_test_requests_queue");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
