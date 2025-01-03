<?php

namespace PHPMaker2024\afyaplus;

// Page object
$WardTypeAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ward_type: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fward_typeadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fward_typeadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["floor_id", [fields.floor_id.visible && fields.floor_id.required ? ew.Validators.required(fields.floor_id.caption) : null, ew.Validators.integer], fields.floor_id.isInvalid],
            ["ward_type", [fields.ward_type.visible && fields.ward_type.required ? ew.Validators.required(fields.ward_type.caption) : null], fields.ward_type.isInvalid]
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
            "floor_id": <?= $Page->floor_id->toClientList($Page) ?>,
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
<form name="fward_typeadd" id="fward_typeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ward_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->floor_id->Visible) { // floor_id ?>
    <div id="r_floor_id"<?= $Page->floor_id->rowAttributes() ?>>
        <label id="elh_ward_type_floor_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->floor_id->caption() ?><?= $Page->floor_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->floor_id->cellAttributes() ?>>
<span id="el_ward_type_floor_id">
<?php
if (IsRTL()) {
    $Page->floor_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_floor_id" class="ew-auto-suggest">
    <input type="<?= $Page->floor_id->getInputTextType() ?>" class="form-control" name="sv_x_floor_id" id="sv_x_floor_id" value="<?= RemoveHtml($Page->floor_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->floor_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->floor_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->floor_id->formatPattern()) ?>"<?= $Page->floor_id->editAttributes() ?> aria-describedby="x_floor_id_help">
</span>
<selection-list hidden class="form-control" data-table="ward_type" data-field="x_floor_id" data-input="sv_x_floor_id" data-value-separator="<?= $Page->floor_id->displayValueSeparatorAttribute() ?>" name="x_floor_id" id="x_floor_id" value="<?= HtmlEncode($Page->floor_id->CurrentValue) ?>"></selection-list>
<?= $Page->floor_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->floor_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fward_typeadd", function() {
    fward_typeadd.createAutoSuggest(Object.assign({"id":"x_floor_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->floor_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.ward_type.fields.floor_id.autoSuggestOptions));
});
</script>
<?= $Page->floor_id->Lookup->getParamTag($Page, "p_x_floor_id") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_type->Visible) { // ward_type ?>
    <div id="r_ward_type"<?= $Page->ward_type->rowAttributes() ?>>
        <label id="elh_ward_type_ward_type" for="x_ward_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_type->caption() ?><?= $Page->ward_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_type->cellAttributes() ?>>
<span id="el_ward_type_ward_type">
<input type="<?= $Page->ward_type->getInputTextType() ?>" name="x_ward_type" id="x_ward_type" data-table="ward_type" data-field="x_ward_type" value="<?= $Page->ward_type->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ward_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ward_type->formatPattern()) ?>"<?= $Page->ward_type->editAttributes() ?> aria-describedby="x_ward_type_help">
<?= $Page->ward_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ward_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fward_typeadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fward_typeadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("ward_type");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
