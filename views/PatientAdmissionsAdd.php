<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientAdmissionsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_admissions: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fpatient_admissionsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_admissionsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["payment_method_id", [fields.payment_method_id.visible && fields.payment_method_id.required ? ew.Validators.required(fields.payment_method_id.caption) : null], fields.payment_method_id.isInvalid],
            ["medical_scheme_id", [fields.medical_scheme_id.visible && fields.medical_scheme_id.required ? ew.Validators.required(fields.medical_scheme_id.caption) : null], fields.medical_scheme_id.isInvalid]
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
            "payment_method_id": <?= $Page->payment_method_id->toClientList($Page) ?>,
            "medical_scheme_id": <?= $Page->medical_scheme_id->toClientList($Page) ?>,
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
<form name="fpatient_admissionsadd" id="fpatient_admissionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_admissions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "ipd_patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="ipd_patients">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_patient_admissions_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_patient_admissions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_patient_admissions_patient_id">
<?php
if (IsRTL()) {
    $Page->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_patient_id" class="ew-auto-suggest">
    <input type="<?= $Page->patient_id->getInputTextType() ?>" class="form-control" name="sv_x_patient_id" id="sv_x_patient_id" value="<?= RemoveHtml($Page->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?> aria-describedby="x_patient_id_help">
</span>
<selection-list hidden class="form-control" data-table="patient_admissions" data-field="x_patient_id" data-input="sv_x_patient_id" data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>" name="x_patient_id" id="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>"></selection-list>
<?= $Page->patient_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fpatient_admissionsadd", function() {
    fpatient_admissionsadd.createAutoSuggest(Object.assign({"id":"x_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.patient_admissions.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_method_id->Visible) { // payment_method_id ?>
    <div id="r_payment_method_id"<?= $Page->payment_method_id->rowAttributes() ?>>
        <label id="elh_patient_admissions_payment_method_id" for="x_payment_method_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_method_id->caption() ?><?= $Page->payment_method_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payment_method_id->cellAttributes() ?>>
<span id="el_patient_admissions_payment_method_id">
    <select
        id="x_payment_method_id"
        name="x_payment_method_id"
        class="form-select ew-select<?= $Page->payment_method_id->isInvalidClass() ?>"
        <?php if (!$Page->payment_method_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_admissionsadd_x_payment_method_id"
        <?php } ?>
        data-table="patient_admissions"
        data-field="x_payment_method_id"
        data-value-separator="<?= $Page->payment_method_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->payment_method_id->getPlaceHolder()) ?>"
        <?= $Page->payment_method_id->editAttributes() ?>>
        <?= $Page->payment_method_id->selectOptionListHtml("x_payment_method_id") ?>
    </select>
    <?= $Page->payment_method_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->payment_method_id->getErrorMessage() ?></div>
<?= $Page->payment_method_id->Lookup->getParamTag($Page, "p_x_payment_method_id") ?>
<?php if (!$Page->payment_method_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_admissionsadd", function() {
    var options = { name: "x_payment_method_id", selectId: "fpatient_admissionsadd_x_payment_method_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_admissionsadd.lists.payment_method_id?.lookupOptions.length) {
        options.data = { id: "x_payment_method_id", form: "fpatient_admissionsadd" };
    } else {
        options.ajax = { id: "x_payment_method_id", form: "fpatient_admissionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_admissions.fields.payment_method_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medical_scheme_id->Visible) { // medical_scheme_id ?>
    <div id="r_medical_scheme_id"<?= $Page->medical_scheme_id->rowAttributes() ?>>
        <label id="elh_patient_admissions_medical_scheme_id" for="x_medical_scheme_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medical_scheme_id->caption() ?><?= $Page->medical_scheme_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medical_scheme_id->cellAttributes() ?>>
<span id="el_patient_admissions_medical_scheme_id">
    <select
        id="x_medical_scheme_id"
        name="x_medical_scheme_id"
        class="form-select ew-select<?= $Page->medical_scheme_id->isInvalidClass() ?>"
        <?php if (!$Page->medical_scheme_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_admissionsadd_x_medical_scheme_id"
        <?php } ?>
        data-table="patient_admissions"
        data-field="x_medical_scheme_id"
        data-value-separator="<?= $Page->medical_scheme_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medical_scheme_id->getPlaceHolder()) ?>"
        <?= $Page->medical_scheme_id->editAttributes() ?>>
        <?= $Page->medical_scheme_id->selectOptionListHtml("x_medical_scheme_id") ?>
    </select>
    <?= $Page->medical_scheme_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->medical_scheme_id->getErrorMessage() ?></div>
<?= $Page->medical_scheme_id->Lookup->getParamTag($Page, "p_x_medical_scheme_id") ?>
<?php if (!$Page->medical_scheme_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_admissionsadd", function() {
    var options = { name: "x_medical_scheme_id", selectId: "fpatient_admissionsadd_x_medical_scheme_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_admissionsadd.lists.medical_scheme_id?.lookupOptions.length) {
        options.data = { id: "x_medical_scheme_id", form: "fpatient_admissionsadd" };
    } else {
        options.ajax = { id: "x_medical_scheme_id", form: "fpatient_admissionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_admissions.fields.medical_scheme_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("bed_assignment", explode(",", $Page->getCurrentDetailTable())) && $bed_assignment->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("bed_assignment", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "BedAssignmentGrid.php" ?>
<?php } ?>
<?php
    if (in_array("issue_items", explode(",", $Page->getCurrentDetailTable())) && $issue_items->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("issue_items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "IssueItemsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patients_discharge", explode(",", $Page->getCurrentDetailTable())) && $patients_discharge->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patients_discharge", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientsDischargeGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_vitals->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_services", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_services->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_services", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdServicesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_prescriptions->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_prescriptions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdPrescriptionsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("medicine_ipd_dispensation", explode(",", $Page->getCurrentDetailTable())) && $medicine_ipd_dispensation->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("medicine_ipd_dispensation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MedicineIpdDispensationGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatient_admissionsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatient_admissionsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("patient_admissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
