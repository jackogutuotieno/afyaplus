<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyRequestsQueueAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { radiology_requests_queue: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fradiology_requests_queueadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_requests_queueadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["radiology_requests_details_id", [fields.radiology_requests_details_id.visible && fields.radiology_requests_details_id.required ? ew.Validators.required(fields.radiology_requests_details_id.caption) : null, ew.Validators.integer], fields.radiology_requests_details_id.isInvalid],
            ["test_time", [fields.test_time.visible && fields.test_time.required ? ew.Validators.required(fields.test_time.caption) : null], fields.test_time.isInvalid],
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fradiology_requests_queueadd" id="fradiology_requests_queueadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="radiology_requests_queue">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "radiology_requests_details") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="radiology_requests_details">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->radiology_requests_details_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->radiology_requests_details_id->Visible) { // radiology_requests_details_id ?>
    <div id="r_radiology_requests_details_id"<?= $Page->radiology_requests_details_id->rowAttributes() ?>>
        <label id="elh_radiology_requests_queue_radiology_requests_details_id" for="x_radiology_requests_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->radiology_requests_details_id->caption() ?><?= $Page->radiology_requests_details_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->radiology_requests_details_id->cellAttributes() ?>>
<?php if ($Page->radiology_requests_details_id->getSessionValue() != "") { ?>
<span<?= $Page->radiology_requests_details_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->radiology_requests_details_id->getDisplayValue($Page->radiology_requests_details_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_radiology_requests_details_id" name="x_radiology_requests_details_id" value="<?= HtmlEncode($Page->radiology_requests_details_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_radiology_requests_queue_radiology_requests_details_id">
<input type="<?= $Page->radiology_requests_details_id->getInputTextType() ?>" name="x_radiology_requests_details_id" id="x_radiology_requests_details_id" data-table="radiology_requests_queue" data-field="x_radiology_requests_details_id" value="<?= $Page->radiology_requests_details_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->radiology_requests_details_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->radiology_requests_details_id->formatPattern()) ?>"<?= $Page->radiology_requests_details_id->editAttributes() ?> aria-describedby="x_radiology_requests_details_id_help">
<?= $Page->radiology_requests_details_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->radiology_requests_details_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test_time->Visible) { // test_time ?>
    <div id="r_test_time"<?= $Page->test_time->rowAttributes() ?>>
        <label id="elh_radiology_requests_queue_test_time" for="x_test_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test_time->caption() ?><?= $Page->test_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test_time->cellAttributes() ?>>
<span id="el_radiology_requests_queue_test_time">
<input type="<?= $Page->test_time->getInputTextType() ?>" name="x_test_time" id="x_test_time" data-table="radiology_requests_queue" data-field="x_test_time" value="<?= $Page->test_time->EditValue ?>" size="30" maxlength="32" placeholder="<?= HtmlEncode($Page->test_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->test_time->formatPattern()) ?>"<?= $Page->test_time->editAttributes() ?> aria-describedby="x_test_time_help">
<?= $Page->test_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waiting_time->Visible) { // waiting_time ?>
    <div id="r_waiting_time"<?= $Page->waiting_time->rowAttributes() ?>>
        <label id="elh_radiology_requests_queue_waiting_time" for="x_waiting_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waiting_time->caption() ?><?= $Page->waiting_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->waiting_time->cellAttributes() ?>>
<span id="el_radiology_requests_queue_waiting_time">
<input type="<?= $Page->waiting_time->getInputTextType() ?>" name="x_waiting_time" id="x_waiting_time" data-table="radiology_requests_queue" data-field="x_waiting_time" value="<?= $Page->waiting_time->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->waiting_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->waiting_time->formatPattern()) ?>"<?= $Page->waiting_time->editAttributes() ?> aria-describedby="x_waiting_time_help">
<?= $Page->waiting_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waiting_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waiting_interval->Visible) { // waiting_interval ?>
    <div id="r_waiting_interval"<?= $Page->waiting_interval->rowAttributes() ?>>
        <label id="elh_radiology_requests_queue_waiting_interval" for="x_waiting_interval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waiting_interval->caption() ?><?= $Page->waiting_interval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->waiting_interval->cellAttributes() ?>>
<span id="el_radiology_requests_queue_waiting_interval">
    <select
        id="x_waiting_interval"
        name="x_waiting_interval"
        class="form-select ew-select<?= $Page->waiting_interval->isInvalidClass() ?>"
        <?php if (!$Page->waiting_interval->IsNativeSelect) { ?>
        data-select2-id="fradiology_requests_queueadd_x_waiting_interval"
        <?php } ?>
        data-table="radiology_requests_queue"
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
loadjs.ready("fradiology_requests_queueadd", function() {
    var options = { name: "x_waiting_interval", selectId: "fradiology_requests_queueadd_x_waiting_interval" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_requests_queueadd.lists.waiting_interval?.lookupOptions.length) {
        options.data = { id: "x_waiting_interval", form: "fradiology_requests_queueadd" };
    } else {
        options.ajax = { id: "x_waiting_interval", form: "fradiology_requests_queueadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_requests_queue.fields.waiting_interval.selectOptions);
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
        <label id="elh_radiology_requests_queue_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_radiology_requests_queue_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        <?php if (!$Page->status->IsNativeSelect) { ?>
        data-select2-id="fradiology_requests_queueadd_x_status"
        <?php } ?>
        data-table="radiology_requests_queue"
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
loadjs.ready("fradiology_requests_queueadd", function() {
    var options = { name: "x_status", selectId: "fradiology_requests_queueadd_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_requests_queueadd.lists.status?.lookupOptions.length) {
        options.data = { id: "x_status", form: "fradiology_requests_queueadd" };
    } else {
        options.ajax = { id: "x_status", form: "fradiology_requests_queueadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_requests_queue.fields.status.selectOptions);
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fradiology_requests_queueadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fradiology_requests_queueadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
