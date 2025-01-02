<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LeaveCategoriesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fleave_categoriesedit" id="fleave_categoriesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { leave_categories: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fleave_categoriesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_categoriesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["leave_category", [fields.leave_category.visible && fields.leave_category.required ? ew.Validators.required(fields.leave_category.caption) : null], fields.leave_category.isInvalid],
            ["maximum_days", [fields.maximum_days.visible && fields.maximum_days.required ? ew.Validators.required(fields.maximum_days.caption) : null, ew.Validators.integer], fields.maximum_days.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="leave_categories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_leave_categories_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_leave_categories_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="leave_categories" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->leave_category->Visible) { // leave_category ?>
    <div id="r_leave_category"<?= $Page->leave_category->rowAttributes() ?>>
        <label id="elh_leave_categories_leave_category" for="x_leave_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->leave_category->caption() ?><?= $Page->leave_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->leave_category->cellAttributes() ?>>
<span id="el_leave_categories_leave_category">
<input type="<?= $Page->leave_category->getInputTextType() ?>" name="x_leave_category" id="x_leave_category" data-table="leave_categories" data-field="x_leave_category" value="<?= $Page->leave_category->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->leave_category->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->leave_category->formatPattern()) ?>"<?= $Page->leave_category->editAttributes() ?> aria-describedby="x_leave_category_help">
<?= $Page->leave_category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->leave_category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maximum_days->Visible) { // maximum_days ?>
    <div id="r_maximum_days"<?= $Page->maximum_days->rowAttributes() ?>>
        <label id="elh_leave_categories_maximum_days" for="x_maximum_days" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maximum_days->caption() ?><?= $Page->maximum_days->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->maximum_days->cellAttributes() ?>>
<span id="el_leave_categories_maximum_days">
<input type="<?= $Page->maximum_days->getInputTextType() ?>" name="x_maximum_days" id="x_maximum_days" data-table="leave_categories" data-field="x_maximum_days" value="<?= $Page->maximum_days->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->maximum_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->maximum_days->formatPattern()) ?>"<?= $Page->maximum_days->editAttributes() ?> aria-describedby="x_maximum_days_help">
<?= $Page->maximum_days->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maximum_days->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fleave_categoriesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fleave_categoriesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("leave_categories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
