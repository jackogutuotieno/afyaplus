<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestReportsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="flab_test_reportsedit" id="flab_test_reportsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var flab_test_reportsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_reportsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_request_id", [fields.lab_test_request_id.visible && fields.lab_test_request_id.required ? ew.Validators.required(fields.lab_test_request_id.caption) : null], fields.lab_test_request_id.isInvalid],
            ["details", [fields.details.visible && fields.details.required ? ew.Validators.required(fields.details.caption) : null], fields.details.isInvalid],
            ["report_template", [fields.report_template.visible && fields.report_template.required ? ew.Validators.fileRequired(fields.report_template.caption) : null], fields.report_template.isInvalid]
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
            "lab_test_request_id": <?= $Page->lab_test_request_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="lab_test_reports">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_lab_test_reports_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_lab_test_reports_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
    <div id="r_lab_test_request_id"<?= $Page->lab_test_request_id->rowAttributes() ?>>
        <label id="elh_lab_test_reports_lab_test_request_id" for="x_lab_test_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_request_id->caption() ?><?= $Page->lab_test_request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_request_id->cellAttributes() ?>>
<span id="el_lab_test_reports_lab_test_request_id">
    <select
        id="x_lab_test_request_id"
        name="x_lab_test_request_id"
        class="form-select ew-select<?= $Page->lab_test_request_id->isInvalidClass() ?>"
        <?php if (!$Page->lab_test_request_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_reportsedit_x_lab_test_request_id"
        <?php } ?>
        data-table="lab_test_reports"
        data-field="x_lab_test_request_id"
        data-value-separator="<?= $Page->lab_test_request_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->lab_test_request_id->getPlaceHolder()) ?>"
        <?= $Page->lab_test_request_id->editAttributes() ?>>
        <?= $Page->lab_test_request_id->selectOptionListHtml("x_lab_test_request_id") ?>
    </select>
    <?= $Page->lab_test_request_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->lab_test_request_id->getErrorMessage() ?></div>
<?= $Page->lab_test_request_id->Lookup->getParamTag($Page, "p_x_lab_test_request_id") ?>
<?php if (!$Page->lab_test_request_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_reportsedit", function() {
    var options = { name: "x_lab_test_request_id", selectId: "flab_test_reportsedit_x_lab_test_request_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_reportsedit.lists.lab_test_request_id?.lookupOptions.length) {
        options.data = { id: "x_lab_test_request_id", form: "flab_test_reportsedit" };
    } else {
        options.ajax = { id: "x_lab_test_request_id", form: "flab_test_reportsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_reports.fields.lab_test_request_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
    <div id="r_details"<?= $Page->details->rowAttributes() ?>>
        <label id="elh_lab_test_reports_details" class="<?= $Page->LeftColumnClass ?>"><?= $Page->details->caption() ?><?= $Page->details->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->details->cellAttributes() ?>>
<span id="el_lab_test_reports_details">
<?php $Page->details->EditAttrs->appendClass("editor"); ?>
<textarea data-table="lab_test_reports" data-field="x_details" name="x_details" id="x_details" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->details->getPlaceHolder()) ?>"<?= $Page->details->editAttributes() ?> aria-describedby="x_details_help"><?= $Page->details->EditValue ?></textarea>
<?= $Page->details->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->details->getErrorMessage() ?></div>
<script>
loadjs.ready(["flab_test_reportsedit", "editor"], function() {
    ew.createEditor("flab_test_reportsedit", "x_details", 0, 0, <?= $Page->details->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_template->Visible) { // report_template ?>
    <div id="r_report_template"<?= $Page->report_template->rowAttributes() ?>>
        <label id="elh_lab_test_reports_report_template" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_template->caption() ?><?= $Page->report_template->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_template->cellAttributes() ?>>
<span id="el_lab_test_reports_report_template">
<div id="fd_x_report_template" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_report_template"
        name="x_report_template"
        class="form-control ew-file-input"
        title="<?= $Page->report_template->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="lab_test_reports"
        data-field="x_report_template"
        data-size="2147483647"
        data-accept-file-types="<?= $Page->report_template->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->report_template->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->report_template->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_report_template_help"
        <?= ($Page->report_template->ReadOnly || $Page->report_template->Disabled) ? " disabled" : "" ?>
        <?= $Page->report_template->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->report_template->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->report_template->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_report_template" id= "fn_x_report_template" value="<?= $Page->report_template->Upload->FileName ?>">
<input type="hidden" name="fa_x_report_template" id= "fa_x_report_template" value="<?= (Post("fa_x_report_template") == "0") ? "0" : "1" ?>">
<table id="ft_x_report_template" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="flab_test_reportsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="flab_test_reportsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("lab_test_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
