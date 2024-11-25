<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicalSchemesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medical_schemes: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmedical_schemesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedical_schemesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["company", [fields.company.visible && fields.company.required ? ew.Validators.required(fields.company.caption) : null], fields.company.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["email_address", [fields.email_address.visible && fields.email_address.required ? ew.Validators.required(fields.email_address.caption) : null], fields.email_address.isInvalid],
            ["physical_address", [fields.physical_address.visible && fields.physical_address.required ? ew.Validators.required(fields.physical_address.caption) : null], fields.physical_address.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null, ew.Validators.integer], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
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
<form name="fmedical_schemesadd" id="fmedical_schemesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medical_schemes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->company->Visible) { // company ?>
    <div id="r_company"<?= $Page->company->rowAttributes() ?>>
        <label id="elh_medical_schemes_company" for="x_company" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company->caption() ?><?= $Page->company->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company->cellAttributes() ?>>
<span id="el_medical_schemes_company">
<input type="<?= $Page->company->getInputTextType() ?>" name="x_company" id="x_company" data-table="medical_schemes" data-field="x_company" value="<?= $Page->company->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->company->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company->formatPattern()) ?>"<?= $Page->company->editAttributes() ?> aria-describedby="x_company_help">
<?= $Page->company->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_medical_schemes_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_medical_schemes_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="medical_schemes" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
    <div id="r_email_address"<?= $Page->email_address->rowAttributes() ?>>
        <label id="elh_medical_schemes_email_address" for="x_email_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_address->caption() ?><?= $Page->email_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email_address->cellAttributes() ?>>
<span id="el_medical_schemes_email_address">
<input type="<?= $Page->email_address->getInputTextType() ?>" name="x_email_address" id="x_email_address" data-table="medical_schemes" data-field="x_email_address" value="<?= $Page->email_address->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email_address->formatPattern()) ?>"<?= $Page->email_address->editAttributes() ?> aria-describedby="x_email_address_help">
<?= $Page->email_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <div id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <label id="elh_medical_schemes_physical_address" for="x_physical_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->physical_address->caption() ?><?= $Page->physical_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_medical_schemes_physical_address">
<input type="<?= $Page->physical_address->getInputTextType() ?>" name="x_physical_address" id="x_physical_address" data-table="medical_schemes" data-field="x_physical_address" value="<?= $Page->physical_address->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->physical_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->physical_address->formatPattern()) ?>"<?= $Page->physical_address->editAttributes() ?> aria-describedby="x_physical_address_help">
<?= $Page->physical_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->physical_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_medical_schemes_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("add")) { // Non system admin ?>
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->created_by_user_id->getDisplayValue($Page->created_by_user_id->EditValue))) ?>"></span>
<input type="hidden" data-table="medical_schemes" data-field="x_created_by_user_id" data-hidden="1" name="x_created_by_user_id" id="x_created_by_user_id" value="<?= HtmlEncode($Page->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_medical_schemes_created_by_user_id">
<input type="<?= $Page->created_by_user_id->getInputTextType() ?>" name="x_created_by_user_id" id="x_created_by_user_id" data-table="medical_schemes" data-field="x_created_by_user_id" value="<?= $Page->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by_user_id->formatPattern()) ?>"<?= $Page->created_by_user_id->editAttributes() ?> aria-describedby="x_created_by_user_id_help">
<?= $Page->created_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by_user_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_medical_schemes_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_medical_schemes_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="medical_schemes" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedical_schemesadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
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
    ew.createDateTimePicker("fmedical_schemesadd", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_medical_schemes_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_medical_schemes_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="medical_schemes" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedical_schemesadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
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
    ew.createDateTimePicker("fmedical_schemesadd", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedical_schemesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedical_schemesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medical_schemes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
