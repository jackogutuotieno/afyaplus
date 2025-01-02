<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ServiceChargesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fservice_chargesedit" id="fservice_chargesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_charges: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fservice_chargesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_chargesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["service_category_id", [fields.service_category_id.visible && fields.service_category_id.required ? ew.Validators.required(fields.service_category_id.caption) : null], fields.service_category_id.isInvalid],
            ["service_subcategory_id", [fields.service_subcategory_id.visible && fields.service_subcategory_id.required ? ew.Validators.required(fields.service_subcategory_id.caption) : null], fields.service_subcategory_id.isInvalid],
            ["service_name", [fields.service_name.visible && fields.service_name.required ? ew.Validators.required(fields.service_name.caption) : null], fields.service_name.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid]
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
            "service_subcategory_id": <?= $Page->service_subcategory_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="service_charges">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_service_charges_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_service_charges_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="service_charges" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_category_id->Visible) { // service_category_id ?>
    <div id="r_service_category_id"<?= $Page->service_category_id->rowAttributes() ?>>
        <label id="elh_service_charges_service_category_id" for="x_service_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_category_id->caption() ?><?= $Page->service_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_category_id->cellAttributes() ?>>
<span id="el_service_charges_service_category_id">
    <select
        id="x_service_category_id"
        name="x_service_category_id"
        class="form-select ew-select<?= $Page->service_category_id->isInvalidClass() ?>"
        <?php if (!$Page->service_category_id->IsNativeSelect) { ?>
        data-select2-id="fservice_chargesedit_x_service_category_id"
        <?php } ?>
        data-table="service_charges"
        data-field="x_service_category_id"
        data-value-separator="<?= $Page->service_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_category_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->service_category_id->editAttributes() ?>>
        <?= $Page->service_category_id->selectOptionListHtml("x_service_category_id") ?>
    </select>
    <?= $Page->service_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->service_category_id->getErrorMessage() ?></div>
<?= $Page->service_category_id->Lookup->getParamTag($Page, "p_x_service_category_id") ?>
<?php if (!$Page->service_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fservice_chargesedit", function() {
    var options = { name: "x_service_category_id", selectId: "fservice_chargesedit_x_service_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fservice_chargesedit.lists.service_category_id?.lookupOptions.length) {
        options.data = { id: "x_service_category_id", form: "fservice_chargesedit" };
    } else {
        options.ajax = { id: "x_service_category_id", form: "fservice_chargesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.service_charges.fields.service_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_subcategory_id->Visible) { // service_subcategory_id ?>
    <div id="r_service_subcategory_id"<?= $Page->service_subcategory_id->rowAttributes() ?>>
        <label id="elh_service_charges_service_subcategory_id" for="x_service_subcategory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_subcategory_id->caption() ?><?= $Page->service_subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_subcategory_id->cellAttributes() ?>>
<span id="el_service_charges_service_subcategory_id">
    <select
        id="x_service_subcategory_id"
        name="x_service_subcategory_id"
        class="form-select ew-select<?= $Page->service_subcategory_id->isInvalidClass() ?>"
        <?php if (!$Page->service_subcategory_id->IsNativeSelect) { ?>
        data-select2-id="fservice_chargesedit_x_service_subcategory_id"
        <?php } ?>
        data-table="service_charges"
        data-field="x_service_subcategory_id"
        data-value-separator="<?= $Page->service_subcategory_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->service_subcategory_id->getPlaceHolder()) ?>"
        <?= $Page->service_subcategory_id->editAttributes() ?>>
        <?= $Page->service_subcategory_id->selectOptionListHtml("x_service_subcategory_id") ?>
    </select>
    <?= $Page->service_subcategory_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->service_subcategory_id->getErrorMessage() ?></div>
<?= $Page->service_subcategory_id->Lookup->getParamTag($Page, "p_x_service_subcategory_id") ?>
<?php if (!$Page->service_subcategory_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fservice_chargesedit", function() {
    var options = { name: "x_service_subcategory_id", selectId: "fservice_chargesedit_x_service_subcategory_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fservice_chargesedit.lists.service_subcategory_id?.lookupOptions.length) {
        options.data = { id: "x_service_subcategory_id", form: "fservice_chargesedit" };
    } else {
        options.ajax = { id: "x_service_subcategory_id", form: "fservice_chargesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.service_charges.fields.service_subcategory_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
    <div id="r_service_name"<?= $Page->service_name->rowAttributes() ?>>
        <label id="elh_service_charges_service_name" for="x_service_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_name->caption() ?><?= $Page->service_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_name->cellAttributes() ?>>
<span id="el_service_charges_service_name">
<input type="<?= $Page->service_name->getInputTextType() ?>" name="x_service_name" id="x_service_name" data-table="service_charges" data-field="x_service_name" value="<?= $Page->service_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->service_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_name->formatPattern()) ?>"<?= $Page->service_name->editAttributes() ?> aria-describedby="x_service_name_help">
<?= $Page->service_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cost->Visible) { // cost ?>
    <div id="r_cost"<?= $Page->cost->rowAttributes() ?>>
        <label id="elh_service_charges_cost" for="x_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cost->caption() ?><?= $Page->cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cost->cellAttributes() ?>>
<span id="el_service_charges_cost">
<input type="<?= $Page->cost->getInputTextType() ?>" name="x_cost" id="x_cost" data-table="service_charges" data-field="x_cost" value="<?= $Page->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cost->formatPattern()) ?>"<?= $Page->cost->editAttributes() ?> aria-describedby="x_cost_help">
<?= $Page->cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fservice_chargesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fservice_chargesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("service_charges");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
