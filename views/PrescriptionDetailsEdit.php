<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PrescriptionDetailsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fprescription_detailsedit" id="fprescription_detailsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { prescription_details: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fprescription_detailsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprescription_detailsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null, ew.Validators.integer], fields.prescription_id.isInvalid],
            ["medicine_stock_id", [fields.medicine_stock_id.visible && fields.medicine_stock_id.required ? ew.Validators.required(fields.medicine_stock_id.caption) : null, ew.Validators.integer], fields.medicine_stock_id.isInvalid],
            ["dose_quantity", [fields.dose_quantity.visible && fields.dose_quantity.required ? ew.Validators.required(fields.dose_quantity.caption) : null, ew.Validators.integer], fields.dose_quantity.isInvalid],
            ["dose_type", [fields.dose_type.visible && fields.dose_type.required ? ew.Validators.required(fields.dose_type.caption) : null], fields.dose_type.isInvalid],
            ["dose_interval", [fields.dose_interval.visible && fields.dose_interval.required ? ew.Validators.required(fields.dose_interval.caption) : null], fields.dose_interval.isInvalid],
            ["number_of_days", [fields.number_of_days.visible && fields.number_of_days.required ? ew.Validators.required(fields.number_of_days.caption) : null, ew.Validators.integer], fields.number_of_days.isInvalid],
            ["method", [fields.method.visible && fields.method.required ? ew.Validators.required(fields.method.caption) : null], fields.method.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="prescription_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_prescription_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_prescription_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <div id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <label id="elh_prescription_details_prescription_id" for="x_prescription_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_id->caption() ?><?= $Page->prescription_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el_prescription_details_prescription_id">
<input type="<?= $Page->prescription_id->getInputTextType() ?>" name="x_prescription_id" id="x_prescription_id" data-table="prescription_details" data-field="x_prescription_id" value="<?= $Page->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_id->formatPattern()) ?>"<?= $Page->prescription_id->editAttributes() ?> aria-describedby="x_prescription_id_help">
<?= $Page->prescription_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prescription_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
    <div id="r_medicine_stock_id"<?= $Page->medicine_stock_id->rowAttributes() ?>>
        <label id="elh_prescription_details_medicine_stock_id" for="x_medicine_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_stock_id->caption() ?><?= $Page->medicine_stock_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el_prescription_details_medicine_stock_id">
<input type="<?= $Page->medicine_stock_id->getInputTextType() ?>" name="x_medicine_stock_id" id="x_medicine_stock_id" data-table="prescription_details" data-field="x_medicine_stock_id" value="<?= $Page->medicine_stock_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->medicine_stock_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->medicine_stock_id->formatPattern()) ?>"<?= $Page->medicine_stock_id->editAttributes() ?> aria-describedby="x_medicine_stock_id_help">
<?= $Page->medicine_stock_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->medicine_stock_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
    <div id="r_dose_quantity"<?= $Page->dose_quantity->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_quantity" for="x_dose_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_quantity->caption() ?><?= $Page->dose_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_quantity->cellAttributes() ?>>
<span id="el_prescription_details_dose_quantity">
<input type="<?= $Page->dose_quantity->getInputTextType() ?>" name="x_dose_quantity" id="x_dose_quantity" data-table="prescription_details" data-field="x_dose_quantity" value="<?= $Page->dose_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->dose_quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dose_quantity->formatPattern()) ?>"<?= $Page->dose_quantity->editAttributes() ?> aria-describedby="x_dose_quantity_help">
<?= $Page->dose_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dose_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
    <div id="r_dose_type"<?= $Page->dose_type->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_type" for="x_dose_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_type->caption() ?><?= $Page->dose_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_type->cellAttributes() ?>>
<span id="el_prescription_details_dose_type">
<input type="<?= $Page->dose_type->getInputTextType() ?>" name="x_dose_type" id="x_dose_type" data-table="prescription_details" data-field="x_dose_type" value="<?= $Page->dose_type->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->dose_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dose_type->formatPattern()) ?>"<?= $Page->dose_type->editAttributes() ?> aria-describedby="x_dose_type_help">
<?= $Page->dose_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dose_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
    <div id="r_dose_interval"<?= $Page->dose_interval->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_interval" for="x_dose_interval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_interval->caption() ?><?= $Page->dose_interval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_interval->cellAttributes() ?>>
<span id="el_prescription_details_dose_interval">
<input type="<?= $Page->dose_interval->getInputTextType() ?>" name="x_dose_interval" id="x_dose_interval" data-table="prescription_details" data-field="x_dose_interval" value="<?= $Page->dose_interval->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->dose_interval->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dose_interval->formatPattern()) ?>"<?= $Page->dose_interval->editAttributes() ?> aria-describedby="x_dose_interval_help">
<?= $Page->dose_interval->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dose_interval->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
    <div id="r_number_of_days"<?= $Page->number_of_days->rowAttributes() ?>>
        <label id="elh_prescription_details_number_of_days" for="x_number_of_days" class="<?= $Page->LeftColumnClass ?>"><?= $Page->number_of_days->caption() ?><?= $Page->number_of_days->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->number_of_days->cellAttributes() ?>>
<span id="el_prescription_details_number_of_days">
<input type="<?= $Page->number_of_days->getInputTextType() ?>" name="x_number_of_days" id="x_number_of_days" data-table="prescription_details" data-field="x_number_of_days" value="<?= $Page->number_of_days->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->number_of_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->number_of_days->formatPattern()) ?>"<?= $Page->number_of_days->editAttributes() ?> aria-describedby="x_number_of_days_help">
<?= $Page->number_of_days->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->number_of_days->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
    <div id="r_method"<?= $Page->method->rowAttributes() ?>>
        <label id="elh_prescription_details_method" for="x_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->method->caption() ?><?= $Page->method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->method->cellAttributes() ?>>
<span id="el_prescription_details_method">
<input type="<?= $Page->method->getInputTextType() ?>" name="x_method" id="x_method" data-table="prescription_details" data-field="x_method" value="<?= $Page->method->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->method->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->method->formatPattern()) ?>"<?= $Page->method->editAttributes() ?> aria-describedby="x_method_help">
<?= $Page->method->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->method->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_prescription_details_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_prescription_details_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="prescription_details" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprescription_detailsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fprescription_detailsedit", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_prescription_details_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_prescription_details_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="prescription_details" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprescription_detailsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fprescription_detailsedit", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fprescription_detailsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fprescription_detailsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("prescription_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
