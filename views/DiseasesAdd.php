<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DiseasesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { diseases: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fdiseasesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdiseasesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["icd10_code", [fields.icd10_code.visible && fields.icd10_code.required ? ew.Validators.required(fields.icd10_code.caption) : null], fields.icd10_code.isInvalid],
            ["disease_name", [fields.disease_name.visible && fields.disease_name.required ? ew.Validators.required(fields.disease_name.caption) : null], fields.disease_name.isInvalid],
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
<form name="fdiseasesadd" id="fdiseasesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="diseases">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->icd10_code->Visible) { // icd10_code ?>
    <div id="r_icd10_code"<?= $Page->icd10_code->rowAttributes() ?>>
        <label id="elh_diseases_icd10_code" for="x_icd10_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->icd10_code->caption() ?><?= $Page->icd10_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->icd10_code->cellAttributes() ?>>
<span id="el_diseases_icd10_code">
<input type="<?= $Page->icd10_code->getInputTextType() ?>" name="x_icd10_code" id="x_icd10_code" data-table="diseases" data-field="x_icd10_code" value="<?= $Page->icd10_code->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->icd10_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->icd10_code->formatPattern()) ?>"<?= $Page->icd10_code->editAttributes() ?> aria-describedby="x_icd10_code_help">
<?= $Page->icd10_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->icd10_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disease_name->Visible) { // disease_name ?>
    <div id="r_disease_name"<?= $Page->disease_name->rowAttributes() ?>>
        <label id="elh_diseases_disease_name" for="x_disease_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disease_name->caption() ?><?= $Page->disease_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disease_name->cellAttributes() ?>>
<span id="el_diseases_disease_name">
<input type="<?= $Page->disease_name->getInputTextType() ?>" name="x_disease_name" id="x_disease_name" data-table="diseases" data-field="x_disease_name" value="<?= $Page->disease_name->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->disease_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->disease_name->formatPattern()) ?>"<?= $Page->disease_name->editAttributes() ?> aria-describedby="x_disease_name_help">
<?= $Page->disease_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->disease_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_diseases_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_diseases_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="diseases" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiseasesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiseasesadd", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_diseases_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_diseases_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="diseases" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiseasesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdiseasesadd", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdiseasesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdiseasesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("diseases");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
