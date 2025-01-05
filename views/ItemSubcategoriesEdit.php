<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ItemSubcategoriesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fitem_subcategoriesedit" id="fitem_subcategoriesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item_subcategories: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fitem_subcategoriesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitem_subcategoriesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["subcategory_name", [fields.subcategory_name.visible && fields.subcategory_name.required ? ew.Validators.required(fields.subcategory_name.caption) : null], fields.subcategory_name.isInvalid]
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
<input type="hidden" name="t" value="item_subcategories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_item_subcategories_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_item_subcategories_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="item_subcategories" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_item_subcategories_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_item_subcategories_category_id">
    <select
        id="x_category_id"
        name="x_category_id"
        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
        <?php if (!$Page->category_id->IsNativeSelect) { ?>
        data-select2-id="fitem_subcategoriesedit_x_category_id"
        <?php } ?>
        data-table="item_subcategories"
        data-field="x_category_id"
        data-value-separator="<?= $Page->category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>"
        <?= $Page->category_id->editAttributes() ?>>
        <?= $Page->category_id->selectOptionListHtml("x_category_id") ?>
    </select>
    <?= $Page->category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
<?= $Page->category_id->Lookup->getParamTag($Page, "p_x_category_id") ?>
<?php if (!$Page->category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fitem_subcategoriesedit", function() {
    var options = { name: "x_category_id", selectId: "fitem_subcategoriesedit_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fitem_subcategoriesedit.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fitem_subcategoriesedit" };
    } else {
        options.ajax = { id: "x_category_id", form: "fitem_subcategoriesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.item_subcategories.fields.category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subcategory_name->Visible) { // subcategory_name ?>
    <div id="r_subcategory_name"<?= $Page->subcategory_name->rowAttributes() ?>>
        <label id="elh_item_subcategories_subcategory_name" for="x_subcategory_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subcategory_name->caption() ?><?= $Page->subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subcategory_name->cellAttributes() ?>>
<span id="el_item_subcategories_subcategory_name">
<input type="<?= $Page->subcategory_name->getInputTextType() ?>" name="x_subcategory_name" id="x_subcategory_name" data-table="item_subcategories" data-field="x_subcategory_name" value="<?= $Page->subcategory_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->subcategory_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->subcategory_name->formatPattern()) ?>"<?= $Page->subcategory_name->editAttributes() ?> aria-describedby="x_subcategory_name_help">
<?= $Page->subcategory_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subcategory_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fitem_subcategoriesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fitem_subcategoriesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("item_subcategories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
