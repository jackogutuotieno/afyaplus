<?php

namespace PHPMaker2024\afyaplus;

// Page object
$IncomeAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { income: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fincomeadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fincomeadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["income_title", [fields.income_title.visible && fields.income_title.required ? ew.Validators.required(fields.income_title.caption) : null], fields.income_title.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid],
            ["invoice_attachment", [fields.invoice_attachment.visible && fields.invoice_attachment.required ? ew.Validators.fileRequired(fields.invoice_attachment.caption) : null], fields.invoice_attachment.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fincomeadd" id="fincomeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="income">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->income_title->Visible) { // income_title ?>
    <div id="r_income_title"<?= $Page->income_title->rowAttributes() ?>>
        <label id="elh_income_income_title" for="x_income_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->income_title->caption() ?><?= $Page->income_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->income_title->cellAttributes() ?>>
<span id="el_income_income_title">
<input type="<?= $Page->income_title->getInputTextType() ?>" name="x_income_title" id="x_income_title" data-table="income" data-field="x_income_title" value="<?= $Page->income_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->income_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->income_title->formatPattern()) ?>"<?= $Page->income_title->editAttributes() ?> aria-describedby="x_income_title_help">
<?= $Page->income_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->income_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_income_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_income_description">
<?php $Page->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="income" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fincomeadd", "editor"], function() {
    ew.createEditor("fincomeadd", "x_description", 0, 0, <?= $Page->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cost->Visible) { // cost ?>
    <div id="r_cost"<?= $Page->cost->rowAttributes() ?>>
        <label id="elh_income_cost" for="x_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cost->caption() ?><?= $Page->cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cost->cellAttributes() ?>>
<span id="el_income_cost">
<input type="<?= $Page->cost->getInputTextType() ?>" name="x_cost" id="x_cost" data-table="income" data-field="x_cost" value="<?= $Page->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cost->formatPattern()) ?>"<?= $Page->cost->editAttributes() ?> aria-describedby="x_cost_help">
<?= $Page->cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_attachment->Visible) { // invoice_attachment ?>
    <div id="r_invoice_attachment"<?= $Page->invoice_attachment->rowAttributes() ?>>
        <label id="elh_income_invoice_attachment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_attachment->caption() ?><?= $Page->invoice_attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_attachment->cellAttributes() ?>>
<span id="el_income_invoice_attachment">
<div id="fd_x_invoice_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_invoice_attachment"
        name="x_invoice_attachment"
        class="form-control ew-file-input"
        title="<?= $Page->invoice_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="income"
        data-field="x_invoice_attachment"
        data-size="2147483647"
        data-accept-file-types="<?= $Page->invoice_attachment->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->invoice_attachment->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->invoice_attachment->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_invoice_attachment_help"
        <?= ($Page->invoice_attachment->ReadOnly || $Page->invoice_attachment->Disabled) ? " disabled" : "" ?>
        <?= $Page->invoice_attachment->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->invoice_attachment->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->invoice_attachment->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_invoice_attachment" id= "fn_x_invoice_attachment" value="<?= $Page->invoice_attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x_invoice_attachment" id= "fa_x_invoice_attachment" value="0">
<table id="ft_x_invoice_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fincomeadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fincomeadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("income");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
