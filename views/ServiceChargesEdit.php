<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ServiceChargesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fservice_chargesedit" id="fservice_chargesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_charges: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fservice_chargesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_chargesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["service_category_id", [fields.service_category_id.visible && fields.service_category_id.required ? ew.Validators.required(fields.service_category_id.caption) : null, ew.Validators.integer], fields.service_category_id.isInvalid],
            ["service_subcategory_id", [fields.service_subcategory_id.visible && fields.service_subcategory_id.required ? ew.Validators.required(fields.service_subcategory_id.caption) : null, ew.Validators.integer], fields.service_subcategory_id.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null, ew.Validators.integer], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid]
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
<input type="hidden" name="t" value="service_charges">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_service_charges_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_service_charges_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="service_charges" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_category_id->Visible) { // service_category_id ?>
    <div id="r_service_category_id"<?= $Page->service_category_id->rowAttributes() ?>>
        <label id="elh_service_charges_service_category_id" for="x_service_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_category_id->caption() ?><?= $Page->service_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_category_id->cellAttributes() ?>>
<span id="el_service_charges_service_category_id">
<input type="<?= $Page->service_category_id->getInputTextType() ?>" name="x_service_category_id" id="x_service_category_id" data-table="service_charges" data-field="x_service_category_id" value="<?= $Page->service_category_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->service_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_category_id->formatPattern()) ?>"<?= $Page->service_category_id->editAttributes() ?> aria-describedby="x_service_category_id_help">
<?= $Page->service_category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_category_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_subcategory_id->Visible) { // service_subcategory_id ?>
    <div id="r_service_subcategory_id"<?= $Page->service_subcategory_id->rowAttributes() ?>>
        <label id="elh_service_charges_service_subcategory_id" for="x_service_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_subcategory_id->caption() ?><?= $Page->service_subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_subcategory_id->cellAttributes() ?>>
<span id="el_service_charges_service_subcategory_id">
<input type="<?= $Page->service_subcategory_id->getInputTextType() ?>" name="x_service_subcategory_id" id="x_service_subcategory_id" data-table="service_charges" data-field="x_service_subcategory_id" value="<?= $Page->service_subcategory_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->service_subcategory_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_subcategory_id->formatPattern()) ?>"<?= $Page->service_subcategory_id->editAttributes() ?> aria-describedby="x_service_subcategory_id_help">
<?= $Page->service_subcategory_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_subcategory_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
    <div id="r_service_name"<?= $Page->service_name->rowAttributes() ?>>
        <label id="elh_service_charges_service_name" for="x_service_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_name->caption() ?><?= $Page->service_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_name->cellAttributes() ?>>
<span id="el_service_charges_service_name">
<input type="<?= $Page->service_name->getInputTextType() ?>" name="x_service_name" id="x_service_name" data-table="service_charges" data-field="x_service_name" value="<?= $Page->service_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_name->formatPattern()) ?>"<?= $Page->service_name->editAttributes() ?> aria-describedby="x_service_name_help">
<?= $Page->service_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_service_charges_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_service_charges_created_by_user_id">
<input type="<?= $Page->created_by_user_id->getInputTextType() ?>" name="x_created_by_user_id" id="x_created_by_user_id" data-table="service_charges" data-field="x_created_by_user_id" value="<?= $Page->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by_user_id->formatPattern()) ?>"<?= $Page->created_by_user_id->editAttributes() ?> aria-describedby="x_created_by_user_id_help">
<?= $Page->created_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by_user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_service_charges_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_service_charges_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="service_charges" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservice_chargesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fservice_chargesedit", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_service_charges_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_service_charges_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="service_charges" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservice_chargesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fservice_chargesedit", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cost->Visible) { // cost ?>
    <div id="r_cost"<?= $Page->cost->rowAttributes() ?>>
        <label id="elh_service_charges_cost" for="x_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cost->caption() ?><?= $Page->cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cost->cellAttributes() ?>>
<span id="el_service_charges_cost">
<input type="<?= $Page->cost->getInputTextType() ?>" name="x_cost" id="x_cost" data-table="service_charges" data-field="x_cost" value="<?= $Page->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cost->formatPattern()) ?>"<?= $Page->cost->editAttributes() ?> aria-describedby="x_cost_help">
<?= $Page->cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fservice_chargesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fservice_chargesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("service_charges");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
