<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineDispensationAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_dispensation: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmedicine_dispensationadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_dispensationadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["prescription_id", [fields.prescription_id.visible && fields.prescription_id.required ? ew.Validators.required(fields.prescription_id.caption) : null, ew.Validators.integer], fields.prescription_id.isInvalid],
            ["dispensation_type", [fields.dispensation_type.visible && fields.dispensation_type.required ? ew.Validators.required(fields.dispensation_type.caption) : null], fields.dispensation_type.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
            "dispensation_type": <?= $Page->dispensation_type->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
            "created_by_user_id": <?= $Page->created_by_user_id->toClientList($Page) ?>,
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
<form name="fmedicine_dispensationadd" id="fmedicine_dispensationadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medicine_dispensation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patient_visits") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_visits">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->visit_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_medicine_dispensation_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_medicine_dispensation_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationadd_x_patient_id"
        <?php } ?>
        data-table="medicine_dispensation"
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
loadjs.ready("fmedicine_dispensationadd", function() {
    var options = { name: "x_patient_id", selectId: "fmedicine_dispensationadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fmedicine_dispensationadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fmedicine_dispensationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <div id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_prescription_id" for="x_prescription_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prescription_id->caption() ?><?= $Page->prescription_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_prescription_id">
<input type="<?= $Page->prescription_id->getInputTextType() ?>" name="x_prescription_id" id="x_prescription_id" data-table="medicine_dispensation" data-field="x_prescription_id" value="<?= $Page->prescription_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->prescription_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->prescription_id->formatPattern()) ?>"<?= $Page->prescription_id->editAttributes() ?> aria-describedby="x_prescription_id_help">
<?= $Page->prescription_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prescription_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dispensation_type->Visible) { // dispensation_type ?>
    <div id="r_dispensation_type"<?= $Page->dispensation_type->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_dispensation_type" for="x_dispensation_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dispensation_type->caption() ?><?= $Page->dispensation_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dispensation_type->cellAttributes() ?>>
<span id="el_medicine_dispensation_dispensation_type">
    <select
        id="x_dispensation_type"
        name="x_dispensation_type"
        class="form-select ew-select<?= $Page->dispensation_type->isInvalidClass() ?>"
        <?php if (!$Page->dispensation_type->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationadd_x_dispensation_type"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_dispensation_type"
        data-value-separator="<?= $Page->dispensation_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->dispensation_type->getPlaceHolder()) ?>"
        <?= $Page->dispensation_type->editAttributes() ?>>
        <?= $Page->dispensation_type->selectOptionListHtml("x_dispensation_type") ?>
    </select>
    <?= $Page->dispensation_type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->dispensation_type->getErrorMessage() ?></div>
<?php if (!$Page->dispensation_type->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationadd", function() {
    var options = { name: "x_dispensation_type", selectId: "fmedicine_dispensationadd_x_dispensation_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationadd.lists.dispensation_type?.lookupOptions.length) {
        options.data = { id: "x_dispensation_type", form: "fmedicine_dispensationadd" };
    } else {
        options.ajax = { id: "x_dispensation_type", form: "fmedicine_dispensationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.dispensation_type.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_medicine_dispensation_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        <?php if (!$Page->status->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensationadd_x_status"
        <?php } ?>
        data-table="medicine_dispensation"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<?php if (!$Page->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensationadd", function() {
    var options = { name: "x_status", selectId: "fmedicine_dispensationadd_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensationadd.lists.status?.lookupOptions.length) {
        options.data = { id: "x_status", form: "fmedicine_dispensationadd" };
    } else {
        options.ajax = { id: "x_status", form: "fmedicine_dispensationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->visit_id->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_visit_id" id="x_visit_id" value="<?= HtmlEncode(strval($Page->visit_id->getSessionValue())) ?>">
    <?php } ?>
<?php
    if (in_array("medicine_dispensation_details", explode(",", $Page->getCurrentDetailTable())) && $medicine_dispensation_details->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("medicine_dispensation_details", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MedicineDispensationDetailsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedicine_dispensationadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedicine_dispensationadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medicine_dispensation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
