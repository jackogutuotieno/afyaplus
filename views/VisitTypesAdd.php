<?php

namespace PHPMaker2024\afyaplus;

// Page object
$VisitTypesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { visit_types: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fvisit_typesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fvisit_typesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["visit_type", [fields.visit_type.visible && fields.visit_type.required ? ew.Validators.required(fields.visit_type.caption) : null], fields.visit_type.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fvisit_typesadd" id="fvisit_typesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="visit_types">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->visit_type->Visible) { // visit_type ?>
    <div id="r_visit_type"<?= $Page->visit_type->rowAttributes() ?>>
        <label id="elh_visit_types_visit_type" for="x_visit_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_type->caption() ?><?= $Page->visit_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_type->cellAttributes() ?>>
<span id="el_visit_types_visit_type">
<input type="<?= $Page->visit_type->getInputTextType() ?>" name="x_visit_type" id="x_visit_type" data-table="visit_types" data-field="x_visit_type" value="<?= $Page->visit_type->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->visit_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->visit_type->formatPattern()) ?>"<?= $Page->visit_type->editAttributes() ?> aria-describedby="x_visit_type_help">
<?= $Page->visit_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fvisit_typesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fvisit_typesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("visit_types");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
