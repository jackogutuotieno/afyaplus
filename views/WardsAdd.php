<?php

namespace PHPMaker2024\afyaplus;

// Page object
$WardsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { wards: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fwardsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fwardsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["ward_type_id", [fields.ward_type_id.visible && fields.ward_type_id.required ? ew.Validators.required(fields.ward_type_id.caption) : null], fields.ward_type_id.isInvalid],
            ["ward_name", [fields.ward_name.visible && fields.ward_name.required ? ew.Validators.required(fields.ward_name.caption) : null, ew.Validators.integer], fields.ward_name.isInvalid]
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
            "ward_type_id": <?= $Page->ward_type_id->toClientList($Page) ?>,
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
<form name="fwardsadd" id="fwardsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="wards">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
    <div id="r_ward_type_id"<?= $Page->ward_type_id->rowAttributes() ?>>
        <label id="elh_wards_ward_type_id" for="x_ward_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_type_id->caption() ?><?= $Page->ward_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_type_id->cellAttributes() ?>>
<span id="el_wards_ward_type_id">
    <select
        id="x_ward_type_id"
        name="x_ward_type_id"
        class="form-select ew-select<?= $Page->ward_type_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_type_id->IsNativeSelect) { ?>
        data-select2-id="fwardsadd_x_ward_type_id"
        <?php } ?>
        data-table="wards"
        data-field="x_ward_type_id"
        data-value-separator="<?= $Page->ward_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_type_id->getPlaceHolder()) ?>"
        <?= $Page->ward_type_id->editAttributes() ?>>
        <?= $Page->ward_type_id->selectOptionListHtml("x_ward_type_id") ?>
    </select>
    <?= $Page->ward_type_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_type_id->getErrorMessage() ?></div>
<?= $Page->ward_type_id->Lookup->getParamTag($Page, "p_x_ward_type_id") ?>
<?php if (!$Page->ward_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fwardsadd", function() {
    var options = { name: "x_ward_type_id", selectId: "fwardsadd_x_ward_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fwardsadd.lists.ward_type_id?.lookupOptions.length) {
        options.data = { id: "x_ward_type_id", form: "fwardsadd" };
    } else {
        options.ajax = { id: "x_ward_type_id", form: "fwardsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.wards.fields.ward_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_name->Visible) { // ward_name ?>
    <div id="r_ward_name"<?= $Page->ward_name->rowAttributes() ?>>
        <label id="elh_wards_ward_name" for="x_ward_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_name->caption() ?><?= $Page->ward_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_name->cellAttributes() ?>>
<span id="el_wards_ward_name">
<input type="<?= $Page->ward_name->getInputTextType() ?>" name="x_ward_name" id="x_ward_name" data-table="wards" data-field="x_ward_name" value="<?= $Page->ward_name->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ward_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ward_name->formatPattern()) ?>"<?= $Page->ward_name->editAttributes() ?> aria-describedby="x_ward_name_help">
<?= $Page->ward_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ward_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fwardsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fwardsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("wards");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
