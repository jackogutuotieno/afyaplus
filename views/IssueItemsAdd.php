<?php

namespace PHPMaker2024\afyaplus;

// Page object
$IssueItemsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { issue_items: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fissue_itemsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fissue_itemsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["item_id", [fields.item_id.visible && fields.item_id.required ? ew.Validators.required(fields.item_id.caption) : null], fields.item_id.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid]
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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
            "item_id": <?= $Page->item_id->toClientList($Page) ?>,
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
<form name="fissue_itemsadd" id="fissue_itemsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="issue_items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patient_admissions") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_admissions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->admission_id->getSessionValue()) ?>">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->admission_id->Visible) { // admission_id ?>
    <div id="r_admission_id"<?= $Page->admission_id->rowAttributes() ?>>
        <label id="elh_issue_items_admission_id" for="x_admission_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admission_id->caption() ?><?= $Page->admission_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admission_id->cellAttributes() ?>>
<?php if ($Page->admission_id->getSessionValue() != "") { ?>
<span id="el_issue_items_admission_id">
<span<?= $Page->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->admission_id->getDisplayValue($Page->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_admission_id" name="x_admission_id" value="<?= HtmlEncode($Page->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_issue_items_admission_id">
<input type="<?= $Page->admission_id->getInputTextType() ?>" name="x_admission_id" id="x_admission_id" data-table="issue_items" data-field="x_admission_id" value="<?= $Page->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->admission_id->formatPattern()) ?>"<?= $Page->admission_id->editAttributes() ?> aria-describedby="x_admission_id_help">
<?= $Page->admission_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_issue_items_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_issue_items_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_issue_items_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fissue_itemsadd_x_patient_id"
        <?php } ?>
        data-table="issue_items"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fissue_itemsadd", function() {
    var options = { name: "x_patient_id", selectId: "fissue_itemsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fissue_itemsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fissue_itemsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fissue_itemsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.issue_items.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_id->Visible) { // item_id ?>
    <div id="r_item_id"<?= $Page->item_id->rowAttributes() ?>>
        <label id="elh_issue_items_item_id" for="x_item_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_id->caption() ?><?= $Page->item_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_id->cellAttributes() ?>>
<span id="el_issue_items_item_id">
    <select
        id="x_item_id"
        name="x_item_id"
        class="form-select ew-select<?= $Page->item_id->isInvalidClass() ?>"
        <?php if (!$Page->item_id->IsNativeSelect) { ?>
        data-select2-id="fissue_itemsadd_x_item_id"
        <?php } ?>
        data-table="issue_items"
        data-field="x_item_id"
        data-value-separator="<?= $Page->item_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->item_id->getPlaceHolder()) ?>"
        <?= $Page->item_id->editAttributes() ?>>
        <?= $Page->item_id->selectOptionListHtml("x_item_id") ?>
    </select>
    <?= $Page->item_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->item_id->getErrorMessage() ?></div>
<?= $Page->item_id->Lookup->getParamTag($Page, "p_x_item_id") ?>
<?php if (!$Page->item_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fissue_itemsadd", function() {
    var options = { name: "x_item_id", selectId: "fissue_itemsadd_x_item_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fissue_itemsadd.lists.item_id?.lookupOptions.length) {
        options.data = { id: "x_item_id", form: "fissue_itemsadd" };
    } else {
        options.ajax = { id: "x_item_id", form: "fissue_itemsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.issue_items.fields.item_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_issue_items_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_issue_items_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="issue_items" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fissue_itemsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fissue_itemsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("issue_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
