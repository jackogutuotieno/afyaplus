<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyRequestsDetailsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fradiology_requests_detailsedit" id="fradiology_requests_detailsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { radiology_requests_details: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fradiology_requests_detailsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_requests_detailsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["radiology_request_id", [fields.radiology_request_id.visible && fields.radiology_request_id.required ? ew.Validators.required(fields.radiology_request_id.caption) : null, ew.Validators.integer], fields.radiology_request_id.isInvalid],
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null], fields.service_id.isInvalid],
            ["comments", [fields.comments.visible && fields.comments.required ? ew.Validators.required(fields.comments.caption) : null], fields.comments.isInvalid]
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
            "service_id": <?= $Page->service_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="radiology_requests_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "radiology_requests") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="radiology_requests">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->radiology_request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_radiology_requests_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_radiology_requests_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="radiology_requests_details" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->radiology_request_id->Visible) { // radiology_request_id ?>
    <div id="r_radiology_request_id"<?= $Page->radiology_request_id->rowAttributes() ?>>
        <label id="elh_radiology_requests_details_radiology_request_id" for="x_radiology_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->radiology_request_id->caption() ?><?= $Page->radiology_request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->radiology_request_id->cellAttributes() ?>>
<?php if ($Page->radiology_request_id->getSessionValue() != "") { ?>
<span id="el_radiology_requests_details_radiology_request_id">
<span<?= $Page->radiology_request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->radiology_request_id->getDisplayValue($Page->radiology_request_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_radiology_request_id" name="x_radiology_request_id" value="<?= HtmlEncode($Page->radiology_request_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_radiology_requests_details_radiology_request_id">
<input type="<?= $Page->radiology_request_id->getInputTextType() ?>" name="x_radiology_request_id" id="x_radiology_request_id" data-table="radiology_requests_details" data-field="x_radiology_request_id" value="<?= $Page->radiology_request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->radiology_request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->radiology_request_id->formatPattern()) ?>"<?= $Page->radiology_request_id->editAttributes() ?> aria-describedby="x_radiology_request_id_help">
<?= $Page->radiology_request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->radiology_request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_id->Visible) { // service_id ?>
    <div id="r_service_id"<?= $Page->service_id->rowAttributes() ?>>
        <label id="elh_radiology_requests_details_service_id" for="x_service_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_id->caption() ?><?= $Page->service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_id->cellAttributes() ?>>
<span id="el_radiology_requests_details_service_id">
    <select
        id="x_service_id"
        name="x_service_id"
        class="form-select ew-select<?= $Page->service_id->isInvalidClass() ?>"
        <?php if (!$Page->service_id->IsNativeSelect) { ?>
        data-select2-id="fradiology_requests_detailsedit_x_service_id"
        <?php } ?>
        data-table="radiology_requests_details"
        data-field="x_service_id"
        data-value-separator="<?= $Page->service_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_id->getPlaceHolder()) ?>"
        <?= $Page->service_id->editAttributes() ?>>
        <?= $Page->service_id->selectOptionListHtml("x_service_id") ?>
    </select>
    <?= $Page->service_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->service_id->getErrorMessage() ?></div>
<?= $Page->service_id->Lookup->getParamTag($Page, "p_x_service_id") ?>
<?php if (!$Page->service_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fradiology_requests_detailsedit", function() {
    var options = { name: "x_service_id", selectId: "fradiology_requests_detailsedit_x_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_requests_detailsedit.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x_service_id", form: "fradiology_requests_detailsedit" };
    } else {
        options.ajax = { id: "x_service_id", form: "fradiology_requests_detailsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_requests_details.fields.service_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
    <div id="r_comments"<?= $Page->comments->rowAttributes() ?>>
        <label id="elh_radiology_requests_details_comments" for="x_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->comments->caption() ?><?= $Page->comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->comments->cellAttributes() ?>>
<span id="el_radiology_requests_details_comments">
<input type="<?= $Page->comments->getInputTextType() ?>" name="x_comments" id="x_comments" data-table="radiology_requests_details" data-field="x_comments" value="<?= $Page->comments->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->comments->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->comments->formatPattern()) ?>"<?= $Page->comments->editAttributes() ?> aria-describedby="x_comments_help">
<?= $Page->comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->comments->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fradiology_requests_detailsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fradiology_requests_detailsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("radiology_requests_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
