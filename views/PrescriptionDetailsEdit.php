<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PrescriptionDetailsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fprescription_detailsedit" id="fprescription_detailsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { prescription_details: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fprescription_detailsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprescription_detailsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null, ew.Validators.integer], fields.prescription_id.isInvalid],
            ["medicine_stock_id", [fields.medicine_stock_id.visible && fields.medicine_stock_id.required ? ew.Validators.required(fields.medicine_stock_id.caption) : null], fields.medicine_stock_id.isInvalid],
            ["dose_quantity", [fields.dose_quantity.visible && fields.dose_quantity.required ? ew.Validators.required(fields.dose_quantity.caption) : null, ew.Validators.integer], fields.dose_quantity.isInvalid],
            ["dose_type", [fields.dose_type.visible && fields.dose_type.required ? ew.Validators.required(fields.dose_type.caption) : null], fields.dose_type.isInvalid],
            ["dose_interval", [fields.dose_interval.visible && fields.dose_interval.required ? ew.Validators.required(fields.dose_interval.caption) : null], fields.dose_interval.isInvalid],
            ["number_of_days", [fields.number_of_days.visible && fields.number_of_days.required ? ew.Validators.required(fields.number_of_days.caption) : null, ew.Validators.integer], fields.number_of_days.isInvalid],
            ["method", [fields.method.visible && fields.method.required ? ew.Validators.required(fields.method.caption) : null], fields.method.isInvalid]
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
            "medicine_stock_id": <?= $Page->medicine_stock_id->toClientList($Page) ?>,
            "dose_type": <?= $Page->dose_type->toClientList($Page) ?>,
            "dose_interval": <?= $Page->dose_interval->toClientList($Page) ?>,
            "number_of_days": <?= $Page->number_of_days->toClientList($Page) ?>,
            "method": <?= $Page->method->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="prescription_details">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "prescriptions") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="prescriptions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->prescription_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_prescription_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_prescription_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="prescription_details" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <div id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <label id="elh_prescription_details_prescription_id" for="x_prescription_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_id->caption() ?><?= $Page->prescription_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_id->cellAttributes() ?>>
<?php if ($Page->prescription_id->getSessionValue() != "") { ?>
<span<?= $Page->prescription_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->prescription_id->getDisplayValue($Page->prescription_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_prescription_id" name="x_prescription_id" value="<?= HtmlEncode($Page->prescription_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_prescription_details_prescription_id">
<input type="<?= $Page->prescription_id->getInputTextType() ?>" name="x_prescription_id" id="x_prescription_id" data-table="prescription_details" data-field="x_prescription_id" value="<?= $Page->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_id->formatPattern()) ?>"<?= $Page->prescription_id->editAttributes() ?> aria-describedby="x_prescription_id_help">
<?= $Page->prescription_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prescription_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
    <div id="r_medicine_stock_id"<?= $Page->medicine_stock_id->rowAttributes() ?>>
        <label id="elh_prescription_details_medicine_stock_id" for="x_medicine_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_stock_id->caption() ?><?= $Page->medicine_stock_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el_prescription_details_medicine_stock_id">
    <select
        id="x_medicine_stock_id"
        name="x_medicine_stock_id"
        class="form-select ew-select<?= $Page->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Page->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsedit_x_medicine_stock_id"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Page->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_stock_id->editAttributes() ?>>
        <?= $Page->medicine_stock_id->selectOptionListHtml("x_medicine_stock_id") ?>
    </select>
    <?= $Page->medicine_stock_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->medicine_stock_id->getErrorMessage() ?></div>
<?= $Page->medicine_stock_id->Lookup->getParamTag($Page, "p_x_medicine_stock_id") ?>
<?php if (!$Page->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsedit", function() {
    var options = { name: "x_medicine_stock_id", selectId: "fprescription_detailsedit_x_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsedit.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x_medicine_stock_id", form: "fprescription_detailsedit" };
    } else {
        options.ajax = { id: "x_medicine_stock_id", form: "fprescription_detailsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
    <div id="r_dose_quantity"<?= $Page->dose_quantity->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_quantity" for="x_dose_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_quantity->caption() ?><?= $Page->dose_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_quantity->cellAttributes() ?>>
<span id="el_prescription_details_dose_quantity">
<input type="<?= $Page->dose_quantity->getInputTextType() ?>" name="x_dose_quantity" id="x_dose_quantity" data-table="prescription_details" data-field="x_dose_quantity" value="<?= $Page->dose_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->dose_quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dose_quantity->formatPattern()) ?>"<?= $Page->dose_quantity->editAttributes() ?> aria-describedby="x_dose_quantity_help">
<?= $Page->dose_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dose_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
    <div id="r_dose_type"<?= $Page->dose_type->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_type" for="x_dose_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_type->caption() ?><?= $Page->dose_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_type->cellAttributes() ?>>
<span id="el_prescription_details_dose_type">
    <select
        id="x_dose_type"
        name="x_dose_type"
        class="form-select ew-select<?= $Page->dose_type->isInvalidClass() ?>"
        <?php if (!$Page->dose_type->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsedit_x_dose_type"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_type"
        data-value-separator="<?= $Page->dose_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->dose_type->getPlaceHolder()) ?>"
        <?= $Page->dose_type->editAttributes() ?>>
        <?= $Page->dose_type->selectOptionListHtml("x_dose_type") ?>
    </select>
    <?= $Page->dose_type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->dose_type->getErrorMessage() ?></div>
<?php if (!$Page->dose_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsedit", function() {
    var options = { name: "x_dose_type", selectId: "fprescription_detailsedit_x_dose_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsedit.lists.dose_type?.lookupOptions.length) {
        options.data = { id: "x_dose_type", form: "fprescription_detailsedit" };
    } else {
        options.ajax = { id: "x_dose_type", form: "fprescription_detailsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
    <div id="r_dose_interval"<?= $Page->dose_interval->rowAttributes() ?>>
        <label id="elh_prescription_details_dose_interval" for="x_dose_interval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dose_interval->caption() ?><?= $Page->dose_interval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dose_interval->cellAttributes() ?>>
<span id="el_prescription_details_dose_interval">
    <select
        id="x_dose_interval"
        name="x_dose_interval"
        class="form-select ew-select<?= $Page->dose_interval->isInvalidClass() ?>"
        <?php if (!$Page->dose_interval->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsedit_x_dose_interval"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_dose_interval"
        data-value-separator="<?= $Page->dose_interval->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->dose_interval->getPlaceHolder()) ?>"
        <?= $Page->dose_interval->editAttributes() ?>>
        <?= $Page->dose_interval->selectOptionListHtml("x_dose_interval") ?>
    </select>
    <?= $Page->dose_interval->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->dose_interval->getErrorMessage() ?></div>
<?php if (!$Page->dose_interval->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsedit", function() {
    var options = { name: "x_dose_interval", selectId: "fprescription_detailsedit_x_dose_interval" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsedit.lists.dose_interval?.lookupOptions.length) {
        options.data = { id: "x_dose_interval", form: "fprescription_detailsedit" };
    } else {
        options.ajax = { id: "x_dose_interval", form: "fprescription_detailsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.dose_interval.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
    <div id="r_number_of_days"<?= $Page->number_of_days->rowAttributes() ?>>
        <label id="elh_prescription_details_number_of_days" class="<?= $Page->LeftColumnClass ?>"><?= $Page->number_of_days->caption() ?><?= $Page->number_of_days->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->number_of_days->cellAttributes() ?>>
<span id="el_prescription_details_number_of_days">
<?php
if (IsRTL()) {
    $Page->number_of_days->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_number_of_days" class="ew-auto-suggest">
    <input type="<?= $Page->number_of_days->getInputTextType() ?>" class="form-control" name="sv_x_number_of_days" id="sv_x_number_of_days" value="<?= RemoveHtml($Page->number_of_days->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->number_of_days->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->number_of_days->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->number_of_days->formatPattern()) ?>"<?= $Page->number_of_days->editAttributes() ?> aria-describedby="x_number_of_days_help">
</span>
<selection-list hidden class="form-control" data-table="prescription_details" data-field="x_number_of_days" data-input="sv_x_number_of_days" data-value-separator="<?= $Page->number_of_days->displayValueSeparatorAttribute() ?>" name="x_number_of_days" id="x_number_of_days" value="<?= HtmlEncode($Page->number_of_days->CurrentValue) ?>"></selection-list>
<?= $Page->number_of_days->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->number_of_days->getErrorMessage() ?></div>
<script>
loadjs.ready("fprescription_detailsedit", function() {
    fprescription_detailsedit.createAutoSuggest(Object.assign({"id":"x_number_of_days","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->number_of_days->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.prescription_details.fields.number_of_days.autoSuggestOptions));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
    <div id="r_method"<?= $Page->method->rowAttributes() ?>>
        <label id="elh_prescription_details_method" for="x_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->method->caption() ?><?= $Page->method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->method->cellAttributes() ?>>
<span id="el_prescription_details_method">
    <select
        id="x_method"
        name="x_method"
        class="form-select ew-select<?= $Page->method->isInvalidClass() ?>"
        <?php if (!$Page->method->IsNativeSelect) { ?>
        data-select2-id="fprescription_detailsedit_x_method"
        <?php } ?>
        data-table="prescription_details"
        data-field="x_method"
        data-value-separator="<?= $Page->method->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->method->getPlaceHolder()) ?>"
        <?= $Page->method->editAttributes() ?>>
        <?= $Page->method->selectOptionListHtml("x_method") ?>
    </select>
    <?= $Page->method->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->method->getErrorMessage() ?></div>
<?php if (!$Page->method->IsNativeSelect) { ?>
<script>
loadjs.ready("fprescription_detailsedit", function() {
    var options = { name: "x_method", selectId: "fprescription_detailsedit_x_method" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprescription_detailsedit.lists.method?.lookupOptions.length) {
        options.data = { id: "x_method", form: "fprescription_detailsedit" };
    } else {
        options.ajax = { id: "x_method", form: "fprescription_detailsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.prescription_details.fields.method.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fprescription_detailsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fprescription_detailsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("prescription_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
