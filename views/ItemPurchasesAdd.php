<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ItemPurchasesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item_purchases: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fitem_purchasesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitem_purchasesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["supplier_id", [fields.supplier_id.visible && fields.supplier_id.required ? ew.Validators.required(fields.supplier_id.caption) : null], fields.supplier_id.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["subcategory_id", [fields.subcategory_id.visible && fields.subcategory_id.required ? ew.Validators.required(fields.subcategory_id.caption) : null], fields.subcategory_id.isInvalid],
            ["item_title", [fields.item_title.visible && fields.item_title.required ? ew.Validators.required(fields.item_title.caption) : null], fields.item_title.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["measuring_unit", [fields.measuring_unit.visible && fields.measuring_unit.required ? ew.Validators.required(fields.measuring_unit.caption) : null], fields.measuring_unit.isInvalid],
            ["unit_price", [fields.unit_price.visible && fields.unit_price.required ? ew.Validators.required(fields.unit_price.caption) : null, ew.Validators.float], fields.unit_price.isInvalid],
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
            "category_id": <?= $Page->category_id->toClientList($Page) ?>,
            "subcategory_id": <?= $Page->subcategory_id->toClientList($Page) ?>,
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
<form name="fitem_purchasesadd" id="fitem_purchasesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="item_purchases">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
    <div id="r_supplier_id"<?= $Page->supplier_id->rowAttributes() ?>>
        <label id="elh_item_purchases_supplier_id" for="x_supplier_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supplier_id->caption() ?><?= $Page->supplier_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->supplier_id->cellAttributes() ?>>
<span id="el_item_purchases_supplier_id">
    <select
        id="x_supplier_id"
        name="x_supplier_id"
        class="form-select ew-select<?= $Page->supplier_id->isInvalidClass() ?>"
        <?php if (!$Page->supplier_id->IsNativeSelect) { ?>
        data-select2-id="fitem_purchasesadd_x_supplier_id"
        <?php } ?>
        data-table="item_purchases"
        data-field="x_supplier_id"
        data-value-separator="<?= $Page->supplier_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->supplier_id->getPlaceHolder()) ?>"
        <?= $Page->supplier_id->editAttributes() ?>>
        <?= $Page->supplier_id->selectOptionListHtml("x_supplier_id") ?>
    </select>
    <?= $Page->supplier_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->supplier_id->getErrorMessage() ?></div>
<?php if (!$Page->supplier_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_purchasesadd", function() {
    var options = { name: "x_supplier_id", selectId: "fitem_purchasesadd_x_supplier_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesadd.lists.supplier_id?.lookupOptions.length) {
        options.data = { id: "x_supplier_id", form: "fitem_purchasesadd" };
    } else {
        options.ajax = { id: "x_supplier_id", form: "fitem_purchasesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.item_purchases.fields.supplier_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_item_purchases_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_item_purchases_category_id">
    <select
        id="x_category_id"
        name="x_category_id"
        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
        <?php if (!$Page->category_id->IsNativeSelect) { ?>
        data-select2-id="fitem_purchasesadd_x_category_id"
        <?php } ?>
        data-table="item_purchases"
        data-field="x_category_id"
        data-value-separator="<?= $Page->category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->category_id->editAttributes() ?>>
        <?= $Page->category_id->selectOptionListHtml("x_category_id") ?>
    </select>
    <?= $Page->category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
<?= $Page->category_id->Lookup->getParamTag($Page, "p_x_category_id") ?>
<?php if (!$Page->category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_purchasesadd", function() {
    var options = { name: "x_category_id", selectId: "fitem_purchasesadd_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesadd.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fitem_purchasesadd" };
    } else {
        options.ajax = { id: "x_category_id", form: "fitem_purchasesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.item_purchases.fields.category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
    <div id="r_subcategory_id"<?= $Page->subcategory_id->rowAttributes() ?>>
        <label id="elh_item_purchases_subcategory_id" for="x_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subcategory_id->caption() ?><?= $Page->subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subcategory_id->cellAttributes() ?>>
<span id="el_item_purchases_subcategory_id">
    <select
        id="x_subcategory_id"
        name="x_subcategory_id"
        class="form-select ew-select<?= $Page->subcategory_id->isInvalidClass() ?>"
        <?php if (!$Page->subcategory_id->IsNativeSelect) { ?>
        data-select2-id="fitem_purchasesadd_x_subcategory_id"
        <?php } ?>
        data-table="item_purchases"
        data-field="x_subcategory_id"
        data-value-separator="<?= $Page->subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->subcategory_id->editAttributes() ?>>
        <?= $Page->subcategory_id->selectOptionListHtml("x_subcategory_id") ?>
    </select>
    <?= $Page->subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->subcategory_id->getErrorMessage() ?></div>
<?= $Page->subcategory_id->Lookup->getParamTag($Page, "p_x_subcategory_id") ?>
<?php if (!$Page->subcategory_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_purchasesadd", function() {
    var options = { name: "x_subcategory_id", selectId: "fitem_purchasesadd_x_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesadd.lists.subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_subcategory_id", form: "fitem_purchasesadd" };
    } else {
        options.ajax = { id: "x_subcategory_id", form: "fitem_purchasesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.item_purchases.fields.subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_title->Visible) { // item_title ?>
    <div id="r_item_title"<?= $Page->item_title->rowAttributes() ?>>
        <label id="elh_item_purchases_item_title" for="x_item_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_title->caption() ?><?= $Page->item_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_title->cellAttributes() ?>>
<span id="el_item_purchases_item_title">
<input type="<?= $Page->item_title->getInputTextType() ?>" name="x_item_title" id="x_item_title" data-table="item_purchases" data-field="x_item_title" value="<?= $Page->item_title->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->item_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->item_title->formatPattern()) ?>"<?= $Page->item_title->editAttributes() ?> aria-describedby="x_item_title_help">
<?= $Page->item_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_item_purchases_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_item_purchases_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="item_purchases" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
    <div id="r_measuring_unit"<?= $Page->measuring_unit->rowAttributes() ?>>
        <label id="elh_item_purchases_measuring_unit" for="x_measuring_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->measuring_unit->caption() ?><?= $Page->measuring_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_item_purchases_measuring_unit">
    <select
        id="x_measuring_unit"
        name="x_measuring_unit"
        class="form-select ew-select<?= $Page->measuring_unit->isInvalidClass() ?>"
        <?php if (!$Page->measuring_unit->IsNativeSelect) { ?>
        data-select2-id="fitem_purchasesadd_x_measuring_unit"
        <?php } ?>
        data-table="item_purchases"
        data-field="x_measuring_unit"
        data-value-separator="<?= $Page->measuring_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->measuring_unit->getPlaceHolder()) ?>"
        <?= $Page->measuring_unit->editAttributes() ?>>
        <?= $Page->measuring_unit->selectOptionListHtml("x_measuring_unit") ?>
    </select>
    <?= $Page->measuring_unit->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->measuring_unit->getErrorMessage() ?></div>
<?php if (!$Page->measuring_unit->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_purchasesadd", function() {
    var options = { name: "x_measuring_unit", selectId: "fitem_purchasesadd_x_measuring_unit" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesadd.lists.measuring_unit?.lookupOptions.length) {
        options.data = { id: "x_measuring_unit", form: "fitem_purchasesadd" };
    } else {
        options.ajax = { id: "x_measuring_unit", form: "fitem_purchasesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.item_purchases.fields.measuring_unit.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
    <div id="r_unit_price"<?= $Page->unit_price->rowAttributes() ?>>
        <label id="elh_item_purchases_unit_price" for="x_unit_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_price->caption() ?><?= $Page->unit_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_price->cellAttributes() ?>>
<span id="el_item_purchases_unit_price">
<input type="<?= $Page->unit_price->getInputTextType() ?>" name="x_unit_price" id="x_unit_price" data-table="item_purchases" data-field="x_unit_price" value="<?= $Page->unit_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->unit_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unit_price->formatPattern()) ?>"<?= $Page->unit_price->editAttributes() ?> aria-describedby="x_unit_price_help">
<?= $Page->unit_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_item_purchases_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_item_purchases_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="item_purchases" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fitem_purchasesadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fitem_purchasesadd", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_item_purchases_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_item_purchases_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="item_purchases" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fitem_purchasesadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fitem_purchasesadd", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fitem_purchasesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fitem_purchasesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("item_purchases");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
