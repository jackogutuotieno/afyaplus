<?php

namespace PHPMaker2024\afyaplus;

// Page object
$SubCountyEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fsub_countyedit" id="fsub_countyedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sub_county: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fsub_countyedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsub_countyedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["county_id", [fields.county_id.visible && fields.county_id.required ? ew.Validators.required(fields.county_id.caption) : null, ew.Validators.integer], fields.county_id.isInvalid],
            ["countyName", [fields.countyName.visible && fields.countyName.required ? ew.Validators.required(fields.countyName.caption) : null], fields.countyName.isInvalid],
            ["subCounty", [fields.subCounty.visible && fields.subCounty.required ? ew.Validators.required(fields.subCounty.caption) : null], fields.subCounty.isInvalid]
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
<input type="hidden" name="t" value="sub_county">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_sub_county_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_sub_county_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="sub_county" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->county_id->Visible) { // county_id ?>
    <div id="r_county_id"<?= $Page->county_id->rowAttributes() ?>>
        <label id="elh_sub_county_county_id" for="x_county_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->county_id->caption() ?><?= $Page->county_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->county_id->cellAttributes() ?>>
<span id="el_sub_county_county_id">
<input type="<?= $Page->county_id->getInputTextType() ?>" name="x_county_id" id="x_county_id" data-table="sub_county" data-field="x_county_id" value="<?= $Page->county_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->county_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->county_id->formatPattern()) ?>"<?= $Page->county_id->editAttributes() ?> aria-describedby="x_county_id_help">
<?= $Page->county_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->county_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
    <div id="r_countyName"<?= $Page->countyName->rowAttributes() ?>>
        <label id="elh_sub_county_countyName" for="x_countyName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->countyName->caption() ?><?= $Page->countyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->countyName->cellAttributes() ?>>
<span id="el_sub_county_countyName">
<input type="<?= $Page->countyName->getInputTextType() ?>" name="x_countyName" id="x_countyName" data-table="sub_county" data-field="x_countyName" value="<?= $Page->countyName->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->countyName->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->countyName->formatPattern()) ?>"<?= $Page->countyName->editAttributes() ?> aria-describedby="x_countyName_help">
<?= $Page->countyName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->countyName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
    <div id="r_subCounty"<?= $Page->subCounty->rowAttributes() ?>>
        <label id="elh_sub_county_subCounty" for="x_subCounty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subCounty->caption() ?><?= $Page->subCounty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subCounty->cellAttributes() ?>>
<span id="el_sub_county_subCounty">
<input type="<?= $Page->subCounty->getInputTextType() ?>" name="x_subCounty" id="x_subCounty" data-table="sub_county" data-field="x_subCounty" value="<?= $Page->subCounty->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->subCounty->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->subCounty->formatPattern()) ?>"<?= $Page->subCounty->editAttributes() ?> aria-describedby="x_subCounty_help">
<?= $Page->subCounty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subCounty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsub_countyedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsub_countyedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("sub_county");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
