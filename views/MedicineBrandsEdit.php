<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineBrandsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmedicine_brandsedit" id="fmedicine_brandsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_brands: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmedicine_brandsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_brandsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null], fields.category_id.isInvalid],
            ["brand_name", [fields.brand_name.visible && fields.brand_name.required ? ew.Validators.required(fields.brand_name.caption) : null], fields.brand_name.isInvalid]
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
<input type="hidden" name="t" value="medicine_brands">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_medicine_brands_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_medicine_brands_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="medicine_brands" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_medicine_brands_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_medicine_brands_category_id">
    <select
        id="x_category_id"
        name="x_category_id"
        class="form-select ew-select<?= $Page->category_id->isInvalidClass() ?>"
        <?php if (!$Page->category_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_brandsedit_x_category_id"
        <?php } ?>
        data-table="medicine_brands"
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
loadjs.ready("fmedicine_brandsedit", function() {
    var options = { name: "x_category_id", selectId: "fmedicine_brandsedit_x_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_brandsedit.lists.category_id?.lookupOptions.length) {
        options.data = { id: "x_category_id", form: "fmedicine_brandsedit" };
    } else {
        options.ajax = { id: "x_category_id", form: "fmedicine_brandsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_brands.fields.category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->brand_name->Visible) { // brand_name ?>
    <div id="r_brand_name"<?= $Page->brand_name->rowAttributes() ?>>
        <label id="elh_medicine_brands_brand_name" for="x_brand_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->brand_name->caption() ?><?= $Page->brand_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->brand_name->cellAttributes() ?>>
<span id="el_medicine_brands_brand_name">
<input type="<?= $Page->brand_name->getInputTextType() ?>" name="x_brand_name" id="x_brand_name" data-table="medicine_brands" data-field="x_brand_name" value="<?= $Page->brand_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->brand_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->brand_name->formatPattern()) ?>"<?= $Page->brand_name->editAttributes() ?> aria-describedby="x_brand_name_help">
<?= $Page->brand_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->brand_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedicine_brandsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedicine_brandsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medicine_brands");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
