<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineStockEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmedicine_stockedit" id="fmedicine_stockedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmedicine_stockedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_stockedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["supplier_id", [fields.supplier_id.visible && fields.supplier_id.required ? ew.Validators.required(fields.supplier_id.caption) : null, ew.Validators.integer], fields.supplier_id.isInvalid],
            ["brand_id", [fields.brand_id.visible && fields.brand_id.required ? ew.Validators.required(fields.brand_id.caption) : null, ew.Validators.integer], fields.brand_id.isInvalid],
            ["batch_number", [fields.batch_number.visible && fields.batch_number.required ? ew.Validators.required(fields.batch_number.caption) : null], fields.batch_number.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["measuring_unit", [fields.measuring_unit.visible && fields.measuring_unit.required ? ew.Validators.required(fields.measuring_unit.caption) : null], fields.measuring_unit.isInvalid],
            ["buying_price_per_unit", [fields.buying_price_per_unit.visible && fields.buying_price_per_unit.required ? ew.Validators.required(fields.buying_price_per_unit.caption) : null, ew.Validators.float], fields.buying_price_per_unit.isInvalid],
            ["selling_price_per_unit", [fields.selling_price_per_unit.visible && fields.selling_price_per_unit.required ? ew.Validators.required(fields.selling_price_per_unit.caption) : null, ew.Validators.float], fields.selling_price_per_unit.isInvalid],
            ["expiry_date", [fields.expiry_date.visible && fields.expiry_date.required ? ew.Validators.required(fields.expiry_date.caption) : null, ew.Validators.datetime(fields.expiry_date.clientFormatPattern)], fields.expiry_date.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null, ew.Validators.integer], fields.created_by_user_id.isInvalid],
            ["modified_by_user_id", [fields.modified_by_user_id.visible && fields.modified_by_user_id.required ? ew.Validators.required(fields.modified_by_user_id.caption) : null, ew.Validators.integer], fields.modified_by_user_id.isInvalid],
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
<input type="hidden" name="t" value="medicine_stock">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_medicine_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_medicine_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="medicine_stock" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
    <div id="r_supplier_id"<?= $Page->supplier_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_supplier_id" for="x_supplier_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supplier_id->caption() ?><?= $Page->supplier_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->supplier_id->cellAttributes() ?>>
<span id="el_medicine_stock_supplier_id">
<input type="<?= $Page->supplier_id->getInputTextType() ?>" name="x_supplier_id" id="x_supplier_id" data-table="medicine_stock" data-field="x_supplier_id" value="<?= $Page->supplier_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->supplier_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->supplier_id->formatPattern()) ?>"<?= $Page->supplier_id->editAttributes() ?> aria-describedby="x_supplier_id_help">
<?= $Page->supplier_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supplier_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->brand_id->Visible) { // brand_id ?>
    <div id="r_brand_id"<?= $Page->brand_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_brand_id" for="x_brand_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->brand_id->caption() ?><?= $Page->brand_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->brand_id->cellAttributes() ?>>
<span id="el_medicine_stock_brand_id">
<input type="<?= $Page->brand_id->getInputTextType() ?>" name="x_brand_id" id="x_brand_id" data-table="medicine_stock" data-field="x_brand_id" value="<?= $Page->brand_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->brand_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->brand_id->formatPattern()) ?>"<?= $Page->brand_id->editAttributes() ?> aria-describedby="x_brand_id_help">
<?= $Page->brand_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->brand_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->batch_number->Visible) { // batch_number ?>
    <div id="r_batch_number"<?= $Page->batch_number->rowAttributes() ?>>
        <label id="elh_medicine_stock_batch_number" for="x_batch_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->batch_number->caption() ?><?= $Page->batch_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->batch_number->cellAttributes() ?>>
<span id="el_medicine_stock_batch_number">
<input type="<?= $Page->batch_number->getInputTextType() ?>" name="x_batch_number" id="x_batch_number" data-table="medicine_stock" data-field="x_batch_number" value="<?= $Page->batch_number->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->batch_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->batch_number->formatPattern()) ?>"<?= $Page->batch_number->editAttributes() ?> aria-describedby="x_batch_number_help">
<?= $Page->batch_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->batch_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_medicine_stock_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_medicine_stock_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="medicine_stock" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
    <div id="r_measuring_unit"<?= $Page->measuring_unit->rowAttributes() ?>>
        <label id="elh_medicine_stock_measuring_unit" for="x_measuring_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->measuring_unit->caption() ?><?= $Page->measuring_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_medicine_stock_measuring_unit">
<input type="<?= $Page->measuring_unit->getInputTextType() ?>" name="x_measuring_unit" id="x_measuring_unit" data-table="medicine_stock" data-field="x_measuring_unit" value="<?= $Page->measuring_unit->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->measuring_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->measuring_unit->formatPattern()) ?>"<?= $Page->measuring_unit->editAttributes() ?> aria-describedby="x_measuring_unit_help">
<?= $Page->measuring_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->measuring_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { // buying_price_per_unit ?>
    <div id="r_buying_price_per_unit"<?= $Page->buying_price_per_unit->rowAttributes() ?>>
        <label id="elh_medicine_stock_buying_price_per_unit" for="x_buying_price_per_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->buying_price_per_unit->caption() ?><?= $Page->buying_price_per_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->buying_price_per_unit->cellAttributes() ?>>
<span id="el_medicine_stock_buying_price_per_unit">
<input type="<?= $Page->buying_price_per_unit->getInputTextType() ?>" name="x_buying_price_per_unit" id="x_buying_price_per_unit" data-table="medicine_stock" data-field="x_buying_price_per_unit" value="<?= $Page->buying_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->buying_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->buying_price_per_unit->formatPattern()) ?>"<?= $Page->buying_price_per_unit->editAttributes() ?> aria-describedby="x_buying_price_per_unit_help">
<?= $Page->buying_price_per_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->buying_price_per_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
    <div id="r_selling_price_per_unit"<?= $Page->selling_price_per_unit->rowAttributes() ?>>
        <label id="elh_medicine_stock_selling_price_per_unit" for="x_selling_price_per_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->selling_price_per_unit->caption() ?><?= $Page->selling_price_per_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->selling_price_per_unit->cellAttributes() ?>>
<span id="el_medicine_stock_selling_price_per_unit">
<input type="<?= $Page->selling_price_per_unit->getInputTextType() ?>" name="x_selling_price_per_unit" id="x_selling_price_per_unit" data-table="medicine_stock" data-field="x_selling_price_per_unit" value="<?= $Page->selling_price_per_unit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->selling_price_per_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->selling_price_per_unit->formatPattern()) ?>"<?= $Page->selling_price_per_unit->editAttributes() ?> aria-describedby="x_selling_price_per_unit_help">
<?= $Page->selling_price_per_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->selling_price_per_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
    <div id="r_expiry_date"<?= $Page->expiry_date->rowAttributes() ?>>
        <label id="elh_medicine_stock_expiry_date" for="x_expiry_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiry_date->caption() ?><?= $Page->expiry_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiry_date->cellAttributes() ?>>
<span id="el_medicine_stock_expiry_date">
<input type="<?= $Page->expiry_date->getInputTextType() ?>" name="x_expiry_date" id="x_expiry_date" data-table="medicine_stock" data-field="x_expiry_date" value="<?= $Page->expiry_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->expiry_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->expiry_date->formatPattern()) ?>"<?= $Page->expiry_date->editAttributes() ?> aria-describedby="x_expiry_date_help">
<?= $Page->expiry_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiry_date->getErrorMessage() ?></div>
<?php if (!$Page->expiry_date->ReadOnly && !$Page->expiry_date->Disabled && !isset($Page->expiry_date->EditAttrs["readonly"]) && !isset($Page->expiry_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_stockedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmedicine_stockedit", "x_expiry_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_medicine_stock_created_by_user_id">
<input type="<?= $Page->created_by_user_id->getInputTextType() ?>" name="x_created_by_user_id" id="x_created_by_user_id" data-table="medicine_stock" data-field="x_created_by_user_id" value="<?= $Page->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by_user_id->formatPattern()) ?>"<?= $Page->created_by_user_id->editAttributes() ?> aria-describedby="x_created_by_user_id_help">
<?= $Page->created_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by_user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->modified_by_user_id->Visible) { // modified_by_user_id ?>
    <div id="r_modified_by_user_id"<?= $Page->modified_by_user_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_modified_by_user_id" for="x_modified_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->modified_by_user_id->caption() ?><?= $Page->modified_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->modified_by_user_id->cellAttributes() ?>>
<span id="el_medicine_stock_modified_by_user_id">
<input type="<?= $Page->modified_by_user_id->getInputTextType() ?>" name="x_modified_by_user_id" id="x_modified_by_user_id" data-table="medicine_stock" data-field="x_modified_by_user_id" value="<?= $Page->modified_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->modified_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->modified_by_user_id->formatPattern()) ?>"<?= $Page->modified_by_user_id->editAttributes() ?> aria-describedby="x_modified_by_user_id_help">
<?= $Page->modified_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->modified_by_user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_medicine_stock_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_medicine_stock_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="medicine_stock" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_stockedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmedicine_stockedit", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_medicine_stock_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_medicine_stock_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="medicine_stock" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_stockedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmedicine_stockedit", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedicine_stockedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedicine_stockedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medicine_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
