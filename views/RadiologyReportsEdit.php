<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyReportsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fradiology_reportsedit" id="fradiology_reportsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { radiology_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fradiology_reportsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_reportsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["radiology_requests_details_id", [fields.radiology_requests_details_id.visible && fields.radiology_requests_details_id.required ? ew.Validators.required(fields.radiology_requests_details_id.caption) : null], fields.radiology_requests_details_id.isInvalid],
            ["findings", [fields.findings.visible && fields.findings.required ? ew.Validators.required(fields.findings.caption) : null], fields.findings.isInvalid],
            ["attachment", [fields.attachment.visible && fields.attachment.required ? ew.Validators.fileRequired(fields.attachment.caption) : null], fields.attachment.isInvalid],
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
            "radiology_requests_details_id": <?= $Page->radiology_requests_details_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="radiology_reports">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_radiology_reports_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_radiology_reports_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="radiology_reports" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->radiology_requests_details_id->Visible) { // radiology_requests_details_id ?>
    <div id="r_radiology_requests_details_id"<?= $Page->radiology_requests_details_id->rowAttributes() ?>>
        <label id="elh_radiology_reports_radiology_requests_details_id" for="x_radiology_requests_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->radiology_requests_details_id->caption() ?><?= $Page->radiology_requests_details_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->radiology_requests_details_id->cellAttributes() ?>>
<span id="el_radiology_reports_radiology_requests_details_id">
    <select
        id="x_radiology_requests_details_id"
        name="x_radiology_requests_details_id"
        class="form-select ew-select<?= $Page->radiology_requests_details_id->isInvalidClass() ?>"
        <?php if (!$Page->radiology_requests_details_id->IsNativeSelect) { ?>
        data-select2-id="fradiology_reportsedit_x_radiology_requests_details_id"
        <?php } ?>
        data-table="radiology_reports"
        data-field="x_radiology_requests_details_id"
        data-value-separator="<?= $Page->radiology_requests_details_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->radiology_requests_details_id->getPlaceHolder()) ?>"
        <?= $Page->radiology_requests_details_id->editAttributes() ?>>
        <?= $Page->radiology_requests_details_id->selectOptionListHtml("x_radiology_requests_details_id") ?>
    </select>
    <?= $Page->radiology_requests_details_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->radiology_requests_details_id->getErrorMessage() ?></div>
<?= $Page->radiology_requests_details_id->Lookup->getParamTag($Page, "p_x_radiology_requests_details_id") ?>
<?php if (!$Page->radiology_requests_details_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fradiology_reportsedit", function() {
    var options = { name: "x_radiology_requests_details_id", selectId: "fradiology_reportsedit_x_radiology_requests_details_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fradiology_reportsedit.lists.radiology_requests_details_id?.lookupOptions.length) {
        options.data = { id: "x_radiology_requests_details_id", form: "fradiology_reportsedit" };
    } else {
        options.ajax = { id: "x_radiology_requests_details_id", form: "fradiology_reportsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.radiology_reports.fields.radiology_requests_details_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->findings->Visible) { // findings ?>
    <div id="r_findings"<?= $Page->findings->rowAttributes() ?>>
        <label id="elh_radiology_reports_findings" class="<?= $Page->LeftColumnClass ?>"><?= $Page->findings->caption() ?><?= $Page->findings->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->findings->cellAttributes() ?>>
<span id="el_radiology_reports_findings">
<?php $Page->findings->EditAttrs->appendClass("editor"); ?>
<textarea data-table="radiology_reports" data-field="x_findings" name="x_findings" id="x_findings" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->findings->getPlaceHolder()) ?>"<?= $Page->findings->editAttributes() ?> aria-describedby="x_findings_help"><?= $Page->findings->EditValue ?></textarea>
<?= $Page->findings->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->findings->getErrorMessage() ?></div>
<script>
loadjs.ready(["fradiology_reportsedit", "editor"], function() {
    ew.createEditor("fradiology_reportsedit", "x_findings", 0, 0, <?= $Page->findings->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->attachment->Visible) { // attachment ?>
    <div id="r_attachment"<?= $Page->attachment->rowAttributes() ?>>
        <label id="elh_radiology_reports_attachment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->attachment->caption() ?><?= $Page->attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->attachment->cellAttributes() ?>>
<span id="el_radiology_reports_attachment">
<div id="fd_x_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_attachment"
        name="x_attachment"
        class="form-control ew-file-input"
        title="<?= $Page->attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="radiology_reports"
        data-field="x_attachment"
        data-size="2147483647"
        data-accept-file-types="<?= $Page->attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->attachment->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_attachment_help"
        <?= ($Page->attachment->ReadOnly || $Page->attachment->Disabled) ? " disabled" : "" ?>
        <?= $Page->attachment->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->attachment->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->attachment->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_attachment" id= "fn_x_attachment" value="<?= $Page->attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x_attachment" id= "fa_x_attachment" value="<?= (Post("fa_x_attachment") == "0") ? "0" : "1" ?>">
<table id="ft_x_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fradiology_reportsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fradiology_reportsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("radiology_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
