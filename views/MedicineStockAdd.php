<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineStockAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmedicine_stockadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_stockadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["supplier_id", [fields.supplier_id.visible && fields.supplier_id.required ? ew.Validators.required(fields.supplier_id.caption) : null], fields.supplier_id.isInvalid],
            ["brand_id", [fields.brand_id.visible && fields.brand_id.required ? ew.Validators.required(fields.brand_id.caption) : null], fields.brand_id.isInvalid],
            ["batch_number", [fields.batch_number.visible && fields.batch_number.required ? ew.Validators.required(fields.batch_number.caption) : null], fields.batch_number.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["measuring_unit", [fields.measuring_unit.visible && fields.measuring_unit.required ? ew.Validators.required(fields.measuring_unit.caption) : null], fields.measuring_unit.isInvalid],
            ["buying_price_per_unit", [fields.buying_price_per_unit.visible && fields.buying_price_per_unit.required ? ew.Validators.required(fields.buying_price_per_unit.caption) : null, ew.Validators.float], fields.buying_price_per_unit.isInvalid],
            ["selling_price_per_unit", [fields.selling_price_per_unit.visible && fields.selling_price_per_unit.required ? ew.Validators.required(fields.selling_price_per_unit.caption) : null, ew.Validators.float], fields.selling_price_per_unit.isInvalid],
            ["expiry_date", [fields.expiry_date.visible && fields.expiry_date.required ? ew.Validators.required(fields.expiry_date.caption) : null, ew.Validators.datetime(fields.expiry_date.clientFormatPattern)], fields.expiry_date.isInvalid],
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
            "supplier_id": <?= $Page->supplier_id->toClientList($Page) ?>,
            "brand_id": <?= $Page->brand_id->toClientList($Page) ?>,
            "measuring_unit": <?= $Page->measuring_unit->toClientList($Page) ?>,
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
<form name="fmedicine_stockadd" id="fmedicine_stockadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medicine_stock">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
    <div id="r_supplier_id"<?= $Page->supplier_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_supplier_id" for="x_supplier_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supplier_id->caption() ?><?= $Page->supplier_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->supplier_id->cellAttributes() ?>>
<span id="el_medicine_stock_supplier_id">
    <select
        id="x_supplier_id"
        name="x_supplier_id"
        class="form-select ew-select<?= $Page->supplier_id->isInvalidClass() ?>"
        <?php if (!$Page->supplier_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_stockadd_x_supplier_id"
        <?php } ?>
        data-table="medicine_stock"
        data-field="x_supplier_id"
        data-value-separator="<?= $Page->supplier_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->supplier_id->getPlaceHolder()) ?>"
        <?= $Page->supplier_id->editAttributes() ?>>
        <?= $Page->supplier_id->selectOptionListHtml("x_supplier_id") ?>
    </select>
    <?= $Page->supplier_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->supplier_id->getErrorMessage() ?></div>
<?= $Page->supplier_id->Lookup->getParamTag($Page, "p_x_supplier_id") ?>
<?php if (!$Page->supplier_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_stockadd", function() {
    var options = { name: "x_supplier_id", selectId: "fmedicine_stockadd_x_supplier_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_stockadd.lists.supplier_id?.lookupOptions.length) {
        options.data = { id: "x_supplier_id", form: "fmedicine_stockadd" };
    } else {
        options.ajax = { id: "x_supplier_id", form: "fmedicine_stockadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_stock.fields.supplier_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->brand_id->Visible) { // brand_id ?>
    <div id="r_brand_id"<?= $Page->brand_id->rowAttributes() ?>>
        <label id="elh_medicine_stock_brand_id" for="x_brand_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->brand_id->caption() ?><?= $Page->brand_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->brand_id->cellAttributes() ?>>
<span id="el_medicine_stock_brand_id">
    <select
        id="x_brand_id"
        name="x_brand_id"
        class="form-select ew-select<?= $Page->brand_id->isInvalidClass() ?>"
        <?php if (!$Page->brand_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_stockadd_x_brand_id"
        <?php } ?>
        data-table="medicine_stock"
        data-field="x_brand_id"
        data-value-separator="<?= $Page->brand_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->brand_id->getPlaceHolder()) ?>"
        <?= $Page->brand_id->editAttributes() ?>>
        <?= $Page->brand_id->selectOptionListHtml("x_brand_id") ?>
    </select>
    <?= $Page->brand_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->brand_id->getErrorMessage() ?></div>
<?= $Page->brand_id->Lookup->getParamTag($Page, "p_x_brand_id") ?>
<?php if (!$Page->brand_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_stockadd", function() {
    var options = { name: "x_brand_id", selectId: "fmedicine_stockadd_x_brand_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_stockadd.lists.brand_id?.lookupOptions.length) {
        options.data = { id: "x_brand_id", form: "fmedicine_stockadd" };
    } else {
        options.ajax = { id: "x_brand_id", form: "fmedicine_stockadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_stock.fields.brand_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
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
        <label id="elh_medicine_stock_measuring_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->measuring_unit->caption() ?><?= $Page->measuring_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_medicine_stock_measuring_unit">
<?php
if (IsRTL()) {
    $Page->measuring_unit->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_measuring_unit" class="ew-auto-suggest">
    <input type="<?= $Page->measuring_unit->getInputTextType() ?>" class="form-control" name="sv_x_measuring_unit" id="sv_x_measuring_unit" value="<?= RemoveHtml($Page->measuring_unit->EditValue) ?>" autocomplete="off" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->measuring_unit->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->measuring_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->measuring_unit->formatPattern()) ?>"<?= $Page->measuring_unit->editAttributes() ?> aria-describedby="x_measuring_unit_help">
</span>
<selection-list hidden class="form-control" data-table="medicine_stock" data-field="x_measuring_unit" data-input="sv_x_measuring_unit" data-value-separator="<?= $Page->measuring_unit->displayValueSeparatorAttribute() ?>" name="x_measuring_unit" id="x_measuring_unit" value="<?= HtmlEncode($Page->measuring_unit->CurrentValue) ?>"></selection-list>
<?= $Page->measuring_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->measuring_unit->getErrorMessage() ?></div>
<script>
loadjs.ready("fmedicine_stockadd", function() {
    fmedicine_stockadd.createAutoSuggest(Object.assign({"id":"x_measuring_unit","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->measuring_unit->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.medicine_stock.fields.measuring_unit.autoSuggestOptions));
});
</script>
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
loadjs.ready(["fmedicine_stockadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fmedicine_stockadd", "x_expiry_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_attachment->Visible) { // invoice_attachment ?>
    <div id="r_invoice_attachment"<?= $Page->invoice_attachment->rowAttributes() ?>>
        <label id="elh_medicine_stock_invoice_attachment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_attachment->caption() ?><?= $Page->invoice_attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_attachment->cellAttributes() ?>>
<span id="el_medicine_stock_invoice_attachment">
<div id="fd_x_invoice_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_invoice_attachment"
        name="x_invoice_attachment"
        class="form-control ew-file-input"
        title="<?= $Page->invoice_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="medicine_stock"
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedicine_stockadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedicine_stockadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medicine_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
