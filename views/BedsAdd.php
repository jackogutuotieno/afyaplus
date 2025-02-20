<?php

namespace PHPMaker2024\afyaplus;

// Page object
$BedsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beds: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fbedsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbedsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["floor_id", [fields.floor_id.visible && fields.floor_id.required ? ew.Validators.required(fields.floor_id.caption) : null], fields.floor_id.isInvalid],
            ["ward_type_id", [fields.ward_type_id.visible && fields.ward_type_id.required ? ew.Validators.required(fields.ward_type_id.caption) : null], fields.ward_type_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_name", [fields.bed_name.visible && fields.bed_name.required ? ew.Validators.required(fields.bed_name.caption) : null], fields.bed_name.isInvalid],
            ["bed_charges", [fields.bed_charges.visible && fields.bed_charges.required ? ew.Validators.required(fields.bed_charges.caption) : null, ew.Validators.float], fields.bed_charges.isInvalid]
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
            "ward_type_id": <?= $Page->ward_type_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
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
<form name="fbedsadd" id="fbedsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="beds">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "wards") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="wards">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->ward_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->floor_id->Visible) { // floor_id ?>
    <div id="r_floor_id"<?= $Page->floor_id->rowAttributes() ?>>
        <label id="elh_beds_floor_id" for="x_floor_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->floor_id->caption() ?><?= $Page->floor_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->floor_id->cellAttributes() ?>>
<span id="el_beds_floor_id">
    <select
        id="x_floor_id"
        name="x_floor_id"
        class="form-select ew-select<?= $Page->floor_id->isInvalidClass() ?>"
        <?php if (!$Page->floor_id->IsNativeSelect) { ?>
        data-select2-id="fbedsadd_x_floor_id"
        <?php } ?>
        data-table="beds"
        data-field="x_floor_id"
        data-value-separator="<?= $Page->floor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->floor_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->floor_id->editAttributes() ?>>
        <?= $Page->floor_id->selectOptionListHtml("x_floor_id") ?>
    </select>
    <?= $Page->floor_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->floor_id->getErrorMessage() ?></div>
<?= $Page->floor_id->Lookup->getParamTag($Page, "p_x_floor_id") ?>
<?php if (!$Page->floor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbedsadd", function() {
    var options = { name: "x_floor_id", selectId: "fbedsadd_x_floor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsadd.lists.floor_id?.lookupOptions.length) {
        options.data = { id: "x_floor_id", form: "fbedsadd" };
    } else {
        options.ajax = { id: "x_floor_id", form: "fbedsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.floor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
    <div id="r_ward_type_id"<?= $Page->ward_type_id->rowAttributes() ?>>
        <label id="elh_beds_ward_type_id" for="x_ward_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_type_id->caption() ?><?= $Page->ward_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_type_id->cellAttributes() ?>>
<span id="el_beds_ward_type_id">
    <select
        id="x_ward_type_id"
        name="x_ward_type_id"
        class="form-select ew-select<?= $Page->ward_type_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_type_id->IsNativeSelect) { ?>
        data-select2-id="fbedsadd_x_ward_type_id"
        <?php } ?>
        data-table="beds"
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
loadjs.ready("fbedsadd", function() {
    var options = { name: "x_ward_type_id", selectId: "fbedsadd_x_ward_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsadd.lists.ward_type_id?.lookupOptions.length) {
        options.data = { id: "x_ward_type_id", form: "fbedsadd" };
    } else {
        options.ajax = { id: "x_ward_type_id", form: "fbedsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.ward_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_beds_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<?php if ($Page->ward_id->getSessionValue() != "") { ?>
<span id="el_beds_ward_id">
<span<?= $Page->ward_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->ward_id->getDisplayValue($Page->ward_id->ViewValue) ?></span></span>
<input type="hidden" id="x_ward_id" name="x_ward_id" value="<?= HtmlEncode($Page->ward_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_beds_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbedsadd_x_ward_id"
        <?php } ?>
        data-table="beds"
        data-field="x_ward_id"
        data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
        <?= $Page->ward_id->editAttributes() ?>>
        <?= $Page->ward_id->selectOptionListHtml("x_ward_id") ?>
    </select>
    <?= $Page->ward_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage() ?></div>
<?= $Page->ward_id->Lookup->getParamTag($Page, "p_x_ward_id") ?>
<?php if (!$Page->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbedsadd", function() {
    var options = { name: "x_ward_id", selectId: "fbedsadd_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbedsadd.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fbedsadd" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fbedsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beds.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_name->Visible) { // bed_name ?>
    <div id="r_bed_name"<?= $Page->bed_name->rowAttributes() ?>>
        <label id="elh_beds_bed_name" for="x_bed_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_name->caption() ?><?= $Page->bed_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_name->cellAttributes() ?>>
<span id="el_beds_bed_name">
<input type="<?= $Page->bed_name->getInputTextType() ?>" name="x_bed_name" id="x_bed_name" data-table="beds" data-field="x_bed_name" value="<?= $Page->bed_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->bed_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->bed_name->formatPattern()) ?>"<?= $Page->bed_name->editAttributes() ?> aria-describedby="x_bed_name_help">
<?= $Page->bed_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bed_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_charges->Visible) { // bed_charges ?>
    <div id="r_bed_charges"<?= $Page->bed_charges->rowAttributes() ?>>
        <label id="elh_beds_bed_charges" for="x_bed_charges" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_charges->caption() ?><?= $Page->bed_charges->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_charges->cellAttributes() ?>>
<span id="el_beds_bed_charges">
<input type="<?= $Page->bed_charges->getInputTextType() ?>" name="x_bed_charges" id="x_bed_charges" data-table="beds" data-field="x_bed_charges" value="<?= $Page->bed_charges->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->bed_charges->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->bed_charges->formatPattern()) ?>"<?= $Page->bed_charges->editAttributes() ?> aria-describedby="x_bed_charges_help">
<?= $Page->bed_charges->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bed_charges->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbedsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbedsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("beds");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
