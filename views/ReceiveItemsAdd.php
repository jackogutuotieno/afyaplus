<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ReceiveItemsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { receive_items: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var freceive_itemsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("freceive_itemsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["item_id", [fields.item_id.visible && fields.item_id.required ? ew.Validators.required(fields.item_id.caption) : null], fields.item_id.isInvalid],
            ["total_items_received", [fields.total_items_received.visible && fields.total_items_received.required ? ew.Validators.required(fields.total_items_received.caption) : null, ew.Validators.integer], fields.total_items_received.isInvalid],
            ["measuring_unit", [fields.measuring_unit.visible && fields.measuring_unit.required ? ew.Validators.required(fields.measuring_unit.caption) : null], fields.measuring_unit.isInvalid]
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
            "item_id": <?= $Page->item_id->toClientList($Page) ?>,
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
<form name="freceive_itemsadd" id="freceive_itemsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="receive_items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->item_id->Visible) { // item_id ?>
    <div id="r_item_id"<?= $Page->item_id->rowAttributes() ?>>
        <label id="elh_receive_items_item_id" for="x_item_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_id->caption() ?><?= $Page->item_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_id->cellAttributes() ?>>
<span id="el_receive_items_item_id">
    <select
        id="x_item_id"
        name="x_item_id"
        class="form-select ew-select<?= $Page->item_id->isInvalidClass() ?>"
        <?php if (!$Page->item_id->IsNativeSelect) { ?>
        data-select2-id="freceive_itemsadd_x_item_id"
        <?php } ?>
        data-table="receive_items"
        data-field="x_item_id"
        data-value-separator="<?= $Page->item_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->item_id->getPlaceHolder()) ?>"
        <?= $Page->item_id->editAttributes() ?>>
        <?= $Page->item_id->selectOptionListHtml("x_item_id") ?>
    </select>
    <?= $Page->item_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->item_id->getErrorMessage() ?></div>
<?= $Page->item_id->Lookup->getParamTag($Page, "p_x_item_id") ?>
<?php if (!$Page->item_id->IsNativeSelect) { ?>
<script>
loadjs.ready("freceive_itemsadd", function() {
    var options = { name: "x_item_id", selectId: "freceive_itemsadd_x_item_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (freceive_itemsadd.lists.item_id?.lookupOptions.length) {
        options.data = { id: "x_item_id", form: "freceive_itemsadd" };
    } else {
        options.ajax = { id: "x_item_id", form: "freceive_itemsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.receive_items.fields.item_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_items_received->Visible) { // total_items_received ?>
    <div id="r_total_items_received"<?= $Page->total_items_received->rowAttributes() ?>>
        <label id="elh_receive_items_total_items_received" for="x_total_items_received" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_items_received->caption() ?><?= $Page->total_items_received->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_items_received->cellAttributes() ?>>
<span id="el_receive_items_total_items_received">
<input type="<?= $Page->total_items_received->getInputTextType() ?>" name="x_total_items_received" id="x_total_items_received" data-table="receive_items" data-field="x_total_items_received" value="<?= $Page->total_items_received->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_items_received->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->total_items_received->formatPattern()) ?>"<?= $Page->total_items_received->editAttributes() ?> aria-describedby="x_total_items_received_help">
<?= $Page->total_items_received->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_items_received->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
    <div id="r_measuring_unit"<?= $Page->measuring_unit->rowAttributes() ?>>
        <label id="elh_receive_items_measuring_unit" for="x_measuring_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->measuring_unit->caption() ?><?= $Page->measuring_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_receive_items_measuring_unit">
<input type="<?= $Page->measuring_unit->getInputTextType() ?>" name="x_measuring_unit" id="x_measuring_unit" data-table="receive_items" data-field="x_measuring_unit" value="<?= $Page->measuring_unit->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->measuring_unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->measuring_unit->formatPattern()) ?>"<?= $Page->measuring_unit->editAttributes() ?> aria-describedby="x_measuring_unit_help">
<?= $Page->measuring_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->measuring_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="freceive_itemsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="freceive_itemsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("receive_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
