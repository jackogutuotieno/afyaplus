<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsDischargeEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fpatients_dischargeedit" id="fpatients_dischargeedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients_discharge: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpatients_dischargeedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_dischargeedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["discharge", [fields.discharge.visible && fields.discharge.required ? ew.Validators.required(fields.discharge.caption) : null], fields.discharge.isInvalid],
            ["admission_reason", [fields.admission_reason.visible && fields.admission_reason.required ? ew.Validators.required(fields.admission_reason.caption) : null], fields.admission_reason.isInvalid],
            ["discharge_condition", [fields.discharge_condition.visible && fields.discharge_condition.required ? ew.Validators.required(fields.discharge_condition.caption) : null], fields.discharge_condition.isInvalid],
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
            "discharge": <?= $Page->discharge->toClientList($Page) ?>,
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patients_discharge">
<input type="hidden" name="action" id="action" value="update">
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
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_patients_discharge_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_patients_discharge_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="patients_discharge" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admission_id->Visible) { // admission_id ?>
    <div id="r_admission_id"<?= $Page->admission_id->rowAttributes() ?>>
        <label id="elh_patients_discharge_admission_id" for="x_admission_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admission_id->caption() ?><?= $Page->admission_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admission_id->cellAttributes() ?>>
<?php if ($Page->admission_id->getSessionValue() != "") { ?>
<span id="el_patients_discharge_admission_id">
<span<?= $Page->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->admission_id->getDisplayValue($Page->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_admission_id" name="x_admission_id" value="<?= HtmlEncode($Page->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_patients_discharge_admission_id">
<input type="<?= $Page->admission_id->getInputTextType() ?>" name="x_admission_id" id="x_admission_id" data-table="patients_discharge" data-field="x_admission_id" value="<?= $Page->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->admission_id->formatPattern()) ?>"<?= $Page->admission_id->editAttributes() ?> aria-describedby="x_admission_id_help">
<?= $Page->admission_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_patients_discharge_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_patients_discharge_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_patients_discharge_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatients_dischargeedit_x_patient_id"
        <?php } ?>
        data-table="patients_discharge"
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
loadjs.ready("fpatients_dischargeedit", function() {
    var options = { name: "x_patient_id", selectId: "fpatients_dischargeedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatients_dischargeedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fpatients_dischargeedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fpatients_dischargeedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients_discharge.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->discharge->Visible) { // discharge ?>
    <div id="r_discharge"<?= $Page->discharge->rowAttributes() ?>>
        <label id="elh_patients_discharge_discharge" class="<?= $Page->LeftColumnClass ?>"><?= $Page->discharge->caption() ?><?= $Page->discharge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->discharge->cellAttributes() ?>>
<span id="el_patients_discharge_discharge">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->discharge->isInvalidClass() ?>" data-table="patients_discharge" data-field="x_discharge" data-boolean name="x_discharge" id="x_discharge" value="1"<?= ConvertToBool($Page->discharge->CurrentValue) ? " checked" : "" ?><?= $Page->discharge->editAttributes() ?> aria-describedby="x_discharge_help">
    <div class="invalid-feedback"><?= $Page->discharge->getErrorMessage() ?></div>
</div>
<?= $Page->discharge->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admission_reason->Visible) { // admission_reason ?>
    <div id="r_admission_reason"<?= $Page->admission_reason->rowAttributes() ?>>
        <label id="elh_patients_discharge_admission_reason" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admission_reason->caption() ?><?= $Page->admission_reason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admission_reason->cellAttributes() ?>>
<span id="el_patients_discharge_admission_reason">
<?php $Page->admission_reason->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_admission_reason" name="x_admission_reason" id="x_admission_reason" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->admission_reason->getPlaceHolder()) ?>"<?= $Page->admission_reason->editAttributes() ?> aria-describedby="x_admission_reason_help"><?= $Page->admission_reason->EditValue ?></textarea>
<?= $Page->admission_reason->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admission_reason->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargeedit", "editor"], function() {
    ew.createEditor("fpatients_dischargeedit", "x_admission_reason", 0, 0, <?= $Page->admission_reason->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->discharge_condition->Visible) { // discharge_condition ?>
    <div id="r_discharge_condition"<?= $Page->discharge_condition->rowAttributes() ?>>
        <label id="elh_patients_discharge_discharge_condition" class="<?= $Page->LeftColumnClass ?>"><?= $Page->discharge_condition->caption() ?><?= $Page->discharge_condition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->discharge_condition->cellAttributes() ?>>
<span id="el_patients_discharge_discharge_condition">
<?php $Page->discharge_condition->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients_discharge" data-field="x_discharge_condition" name="x_discharge_condition" id="x_discharge_condition" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->discharge_condition->getPlaceHolder()) ?>"<?= $Page->discharge_condition->editAttributes() ?> aria-describedby="x_discharge_condition_help"><?= $Page->discharge_condition->EditValue ?></textarea>
<?= $Page->discharge_condition->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->discharge_condition->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatients_dischargeedit", "editor"], function() {
    ew.createEditor("fpatients_dischargeedit", "x_discharge_condition", 0, 0, <?= $Page->discharge_condition->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("patient_ipd_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_vitals->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdVitalsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatients_dischargeedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatients_dischargeedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("patients_discharge");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
