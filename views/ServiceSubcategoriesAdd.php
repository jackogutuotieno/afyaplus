<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ServiceSubcategoriesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_subcategories: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fservice_subcategoriesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_subcategoriesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["service_category_id", [fields.service_category_id.visible && fields.service_category_id.required ? ew.Validators.required(fields.service_category_id.caption) : null], fields.service_category_id.isInvalid],
            ["subcategory", [fields.subcategory.visible && fields.subcategory.required ? ew.Validators.required(fields.subcategory.caption) : null], fields.subcategory.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
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
            "service_category_id": <?= $Page->service_category_id->toClientList($Page) ?>,
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
<form name="fservice_subcategoriesadd" id="fservice_subcategoriesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_subcategories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->service_category_id->Visible) { // service_category_id ?>
    <div id="r_service_category_id"<?= $Page->service_category_id->rowAttributes() ?>>
        <label id="elh_service_subcategories_service_category_id" for="x_service_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_category_id->caption() ?><?= $Page->service_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_category_id->cellAttributes() ?>>
<span id="el_service_subcategories_service_category_id">
    <select
        id="x_service_category_id"
        name="x_service_category_id"
        class="form-select ew-select<?= $Page->service_category_id->isInvalidClass() ?>"
        <?php if (!$Page->service_category_id->IsNativeSelect) { ?>
        data-select2-id="fservice_subcategoriesadd_x_service_category_id"
        <?php } ?>
        data-table="service_subcategories"
        data-field="x_service_category_id"
        data-value-separator="<?= $Page->service_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_category_id->getPlaceHolder()) ?>"
        <?= $Page->service_category_id->editAttributes() ?>>
        <?= $Page->service_category_id->selectOptionListHtml("x_service_category_id") ?>
    </select>
    <?= $Page->service_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->service_category_id->getErrorMessage() ?></div>
<?= $Page->service_category_id->Lookup->getParamTag($Page, "p_x_service_category_id") ?>
<?php if (!$Page->service_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fservice_subcategoriesadd", function() {
    var options = { name: "x_service_category_id", selectId: "fservice_subcategoriesadd_x_service_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fservice_subcategoriesadd.lists.service_category_id?.lookupOptions.length) {
        options.data = { id: "x_service_category_id", form: "fservice_subcategoriesadd" };
    } else {
        options.ajax = { id: "x_service_category_id", form: "fservice_subcategoriesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.service_subcategories.fields.service_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subcategory->Visible) { // subcategory ?>
    <div id="r_subcategory"<?= $Page->subcategory->rowAttributes() ?>>
        <label id="elh_service_subcategories_subcategory" for="x_subcategory" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subcategory->caption() ?><?= $Page->subcategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subcategory->cellAttributes() ?>>
<span id="el_service_subcategories_subcategory">
<input type="<?= $Page->subcategory->getInputTextType() ?>" name="x_subcategory" id="x_subcategory" data-table="service_subcategories" data-field="x_subcategory" value="<?= $Page->subcategory->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->subcategory->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->subcategory->formatPattern()) ?>"<?= $Page->subcategory->editAttributes() ?> aria-describedby="x_subcategory_help">
<?= $Page->subcategory->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subcategory->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_service_subcategories_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_service_subcategories_description">
<textarea data-table="service_subcategories" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fservice_subcategoriesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fservice_subcategoriesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("service_subcategories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
