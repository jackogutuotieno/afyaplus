<?php

namespace PHPMaker2024\afyaplus;

// Page object
$BrandingEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fbrandingedit" id="fbrandingedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { branding: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fbrandingedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbrandingedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["header_image", [fields.header_image.visible && fields.header_image.required ? ew.Validators.fileRequired(fields.header_image.caption) : null], fields.header_image.isInvalid]
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
<input type="hidden" name="t" value="branding">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_branding_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_branding_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="branding" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->header_image->Visible) { // header_image ?>
    <div id="r_header_image"<?= $Page->header_image->rowAttributes() ?>>
        <label id="elh_branding_header_image" class="<?= $Page->LeftColumnClass ?>"><?= $Page->header_image->caption() ?><?= $Page->header_image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->header_image->cellAttributes() ?>>
<span id="el_branding_header_image">
<div id="fd_x_header_image" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_header_image"
        name="x_header_image"
        class="form-control ew-file-input"
        title="<?= $Page->header_image->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="branding"
        data-field="x_header_image"
        data-size="2147483647"
        data-accept-file-types="<?= $Page->header_image->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->header_image->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->header_image->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_header_image_help"
        <?= ($Page->header_image->ReadOnly || $Page->header_image->Disabled) ? " disabled" : "" ?>
        <?= $Page->header_image->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->header_image->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->header_image->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_header_image" id= "fn_x_header_image" value="<?= $Page->header_image->Upload->FileName ?>">
<input type="hidden" name="fa_x_header_image" id= "fa_x_header_image" value="<?= (Post("fa_x_header_image") == "0") ? "0" : "1" ?>">
<table id="ft_x_header_image" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbrandingedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbrandingedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("branding");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
