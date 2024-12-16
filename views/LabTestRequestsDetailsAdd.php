<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestRequestsDetailsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_requests_details: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var flab_test_requests_detailsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_requests_detailsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["lab_test_request_id", [fields.lab_test_request_id.visible && fields.lab_test_request_id.required ? ew.Validators.required(fields.lab_test_request_id.caption) : null, ew.Validators.integer], fields.lab_test_request_id.isInvalid],
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null], fields.service_id.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="flab_test_requests_detailsadd" id="flab_test_requests_detailsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="lab_test_requests_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "lab_test_requests") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="lab_test_requests">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->lab_test_request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
    <div id="r_lab_test_request_id"<?= $Page->lab_test_request_id->rowAttributes() ?>>
        <label id="elh_lab_test_requests_details_lab_test_request_id" for="x_lab_test_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_request_id->caption() ?><?= $Page->lab_test_request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_request_id->cellAttributes() ?>>
<?php if ($Page->lab_test_request_id->getSessionValue() != "") { ?>
<span id="el_lab_test_requests_details_lab_test_request_id">
<span<?= $Page->lab_test_request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->lab_test_request_id->getDisplayValue($Page->lab_test_request_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_lab_test_request_id" name="x_lab_test_request_id" value="<?= HtmlEncode($Page->lab_test_request_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_lab_test_requests_details_lab_test_request_id">
<input type="<?= $Page->lab_test_request_id->getInputTextType() ?>" name="x_lab_test_request_id" id="x_lab_test_request_id" data-table="lab_test_requests_details" data-field="x_lab_test_request_id" value="<?= $Page->lab_test_request_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lab_test_request_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lab_test_request_id->formatPattern()) ?>"<?= $Page->lab_test_request_id->editAttributes() ?> aria-describedby="x_lab_test_request_id_help">
<?= $Page->lab_test_request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lab_test_request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_id->Visible) { // service_id ?>
    <div id="r_service_id"<?= $Page->service_id->rowAttributes() ?>>
        <label id="elh_lab_test_requests_details_service_id" for="x_service_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_id->caption() ?><?= $Page->service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_service_id">
    <select
        id="x_service_id"
        name="x_service_id"
        class="form-select ew-select<?= $Page->service_id->isInvalidClass() ?>"
        <?php if (!$Page->service_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_requests_detailsadd_x_service_id"
        <?php } ?>
        data-table="lab_test_requests_details"
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
loadjs.ready("flab_test_requests_detailsadd", function() {
    var options = { name: "x_service_id", selectId: "flab_test_requests_detailsadd_x_service_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_requests_detailsadd.lists.service_id?.lookupOptions.length) {
        options.data = { id: "x_service_id", form: "flab_test_requests_detailsadd" };
    } else {
        options.ajax = { id: "x_service_id", form: "flab_test_requests_detailsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_requests_details.fields.service_id.selectOptions);
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="flab_test_requests_detailsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="flab_test_requests_detailsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("lab_test_requests_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
