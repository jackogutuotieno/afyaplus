<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ItemPurchasesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fitem_purchasesedit" id="fitem_purchasesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item_purchases: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fitem_purchasesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitem_purchasesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["supplier_id", [fields.supplier_id.visible && fields.supplier_id.required ? ew.Validators.required(fields.supplier_id.caption) : null], fields.supplier_id.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["subcategory_id", [fields.subcategory_id.visible && fields.subcategory_id.required ? ew.Validators.required(fields.subcategory_id.caption) : null], fields.subcategory_id.isInvalid],
            ["item_title", [fields.item_title.visible && fields.item_title.required ? ew.Validators.required(fields.item_title.caption) : null], fields.item_title.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["measuring_unit", [fields.measuring_unit.visible && fields.measuring_unit.required ? ew.Validators.required(fields.measuring_unit.caption) : null], fields.measuring_unit.isInvalid],
            ["unit_price", [fields.unit_price.visible && fields.unit_price.required ? ew.Validators.required(fields.unit_price.caption) : null, ew.Validators.float], fields.unit_price.isInvalid],
            ["selling_price", [fields.selling_price.visible && fields.selling_price.required ? ew.Validators.required(fields.selling_price.caption) : null, ew.Validators.float], fields.selling_price.isInvalid],
            ["amount_paid", [fields.amount_paid.visible && fields.amount_paid.required ? ew.Validators.required(fields.amount_paid.caption) : null, ew.Validators.float], fields.amount_paid.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="item_purchases">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_item_purchases_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_item_purchases_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="item_purchases" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
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
        data-select2-id="fitem_purchasesedit_x_supplier_id"
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
<?= $Page->supplier_id->Lookup->getParamTag($Page, "p_x_supplier_id") ?>
<?php if (!$Page->supplier_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_purchasesedit", function() {
    var options = { name: "x_supplier_id", selectId: "fitem_purchasesedit_x_supplier_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesedit.lists.supplier_id?.lookupOptions.length) {
        options.data = { id: "x_supplier_id", form: "fitem_purchasesedit" };
    } else {
        options.ajax = { id: "x_supplier_id", form: "fitem_purchasesedit", limit: ew.LOOKUP_PAGE_SIZE };
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
        data-select2-id="fitem_purchasesedit_x_category_id"
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
loadjs.ready("fitem_purchasesedit", function() {
    var options = { name: "x_category_id", selectId: "fitem_purchasesedit_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesedit.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fitem_purchasesedit" };
    } else {
        options.ajax = { id: "x_category_id", form: "fitem_purchasesedit", limit: ew.LOOKUP_PAGE_SIZE };
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
        data-select2-id="fitem_purchasesedit_x_subcategory_id"
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
loadjs.ready("fitem_purchasesedit", function() {
    var options = { name: "x_subcategory_id", selectId: "fitem_purchasesedit_x_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesedit.lists.subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_subcategory_id", form: "fitem_purchasesedit" };
    } else {
        options.ajax = { id: "x_subcategory_id", form: "fitem_purchasesedit", limit: ew.LOOKUP_PAGE_SIZE };
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
        data-select2-id="fitem_purchasesedit_x_measuring_unit"
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
loadjs.ready("fitem_purchasesedit", function() {
    var options = { name: "x_measuring_unit", selectId: "fitem_purchasesedit_x_measuring_unit" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_purchasesedit.lists.measuring_unit?.lookupOptions.length) {
        options.data = { id: "x_measuring_unit", form: "fitem_purchasesedit" };
    } else {
        options.ajax = { id: "x_measuring_unit", form: "fitem_purchasesedit", limit: ew.LOOKUP_PAGE_SIZE };
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
<?php if ($Page->selling_price->Visible) { // selling_price ?>
    <div id="r_selling_price"<?= $Page->selling_price->rowAttributes() ?>>
        <label id="elh_item_purchases_selling_price" for="x_selling_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->selling_price->caption() ?><?= $Page->selling_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->selling_price->cellAttributes() ?>>
<span id="el_item_purchases_selling_price">
<input type="<?= $Page->selling_price->getInputTextType() ?>" name="x_selling_price" id="x_selling_price" data-table="item_purchases" data-field="x_selling_price" value="<?= $Page->selling_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->selling_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->selling_price->formatPattern()) ?>"<?= $Page->selling_price->editAttributes() ?> aria-describedby="x_selling_price_help">
<?= $Page->selling_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->selling_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
    <div id="r_amount_paid"<?= $Page->amount_paid->rowAttributes() ?>>
        <label id="elh_item_purchases_amount_paid" for="x_amount_paid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount_paid->caption() ?><?= $Page->amount_paid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->amount_paid->cellAttributes() ?>>
<span id="el_item_purchases_amount_paid">
<input type="<?= $Page->amount_paid->getInputTextType() ?>" name="x_amount_paid" id="x_amount_paid" data-table="item_purchases" data-field="x_amount_paid" value="<?= $Page->amount_paid->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->amount_paid->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->amount_paid->formatPattern()) ?>"<?= $Page->amount_paid->editAttributes() ?> aria-describedby="x_amount_paid_help">
<?= $Page->amount_paid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount_paid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice_attachment->Visible) { // invoice_attachment ?>
    <div id="r_invoice_attachment"<?= $Page->invoice_attachment->rowAttributes() ?>>
        <label id="elh_item_purchases_invoice_attachment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_attachment->caption() ?><?= $Page->invoice_attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_attachment->cellAttributes() ?>>
<span id="el_item_purchases_invoice_attachment">
<div id="fd_x_invoice_attachment" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_invoice_attachment"
        name="x_invoice_attachment"
        class="form-control ew-file-input"
        title="<?= $Page->invoice_attachment->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="item_purchases"
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
<input type="hidden" name="fa_x_invoice_attachment" id= "fa_x_invoice_attachment" value="<?= (Post("fa_x_invoice_attachment") == "0") ? "0" : "1" ?>">
<table id="ft_x_invoice_attachment" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fitem_purchasesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fitem_purchasesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("item_purchases");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
