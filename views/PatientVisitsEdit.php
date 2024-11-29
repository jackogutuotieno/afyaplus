<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVisitsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fpatient_visitsedit" id="fpatient_visitsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_visits: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpatient_visitsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_visitsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_type_id", [fields.visit_type_id.visible && fields.visit_type_id.required ? ew.Validators.required(fields.visit_type_id.caption) : null], fields.visit_type_id.isInvalid],
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
            "visit_type_id": <?= $Page->visit_type_id->toClientList($Page) ?>,
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_visits">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patients") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patients">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_patient_visits_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_patient_visits_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="patient_visits" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_patient_visits_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_patient_visits_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsedit_x_patient_id"
        <?php } ?>
        data-table="patient_visits"
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
loadjs.ready("fpatient_visitsedit", function() {
    var options = { name: "x_patient_id", selectId: "fpatient_visitsedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fpatient_visitsedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fpatient_visitsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <div id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <label id="elh_patient_visits_visit_type_id" for="x_visit_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_type_id->caption() ?><?= $Page->visit_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el_patient_visits_visit_type_id">
    <select
        id="x_visit_type_id"
        name="x_visit_type_id"
        class="form-select ew-select<?= $Page->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Page->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsedit_x_visit_type_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Page->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->visit_type_id->getPlaceHolder()) ?>"
        <?= $Page->visit_type_id->editAttributes() ?>>
        <?= $Page->visit_type_id->selectOptionListHtml("x_visit_type_id") ?>
    </select>
    <?= $Page->visit_type_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->visit_type_id->getErrorMessage() ?></div>
<?= $Page->visit_type_id->Lookup->getParamTag($Page, "p_x_visit_type_id") ?>
<?php if (!$Page->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitsedit", function() {
    var options = { name: "x_visit_type_id", selectId: "fpatient_visitsedit_x_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsedit.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x_visit_type_id", form: "fpatient_visitsedit" };
    } else {
        options.ajax = { id: "x_visit_type_id", form: "fpatient_visitsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_method_id->Visible) { // payment_method_id ?>
    <div id="r_payment_method_id"<?= $Page->payment_method_id->rowAttributes() ?>>
        <label id="elh_patient_visits_payment_method_id" for="x_payment_method_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_method_id->caption() ?><?= $Page->payment_method_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payment_method_id->cellAttributes() ?>>
<span id="el_patient_visits_payment_method_id">
    <select
        id="x_payment_method_id"
        name="x_payment_method_id"
        class="form-select ew-select<?= $Page->payment_method_id->isInvalidClass() ?>"
        <?php if (!$Page->payment_method_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsedit_x_payment_method_id"
        <?php } ?>
        data-table="patient_visits"
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
loadjs.ready("fpatient_visitsedit", function() {
    var options = { name: "x_payment_method_id", selectId: "fpatient_visitsedit_x_payment_method_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsedit.lists.payment_method_id?.lookupOptions.length) {
        options.data = { id: "x_payment_method_id", form: "fpatient_visitsedit" };
    } else {
        options.ajax = { id: "x_payment_method_id", form: "fpatient_visitsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.payment_method_id.selectOptions);
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
        <label id="elh_patient_visits_medical_scheme_id" for="x_medical_scheme_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medical_scheme_id->caption() ?><?= $Page->medical_scheme_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medical_scheme_id->cellAttributes() ?>>
<span id="el_patient_visits_medical_scheme_id">
    <select
        id="x_medical_scheme_id"
        name="x_medical_scheme_id"
        class="form-select ew-select<?= $Page->medical_scheme_id->isInvalidClass() ?>"
        <?php if (!$Page->medical_scheme_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitsedit_x_medical_scheme_id"
        <?php } ?>
        data-table="patient_visits"
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
loadjs.ready("fpatient_visitsedit", function() {
    var options = { name: "x_medical_scheme_id", selectId: "fpatient_visitsedit_x_medical_scheme_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitsedit.lists.medical_scheme_id?.lookupOptions.length) {
        options.data = { id: "x_medical_scheme_id", form: "fpatient_visitsedit" };
    } else {
        options.ajax = { id: "x_medical_scheme_id", form: "fpatient_visitsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.medical_scheme_id.selectOptions);
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
    if (in_array("patient_queue", explode(",", $Page->getCurrentDetailTable())) && $patient_queue->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_queue", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientQueueGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_vitals->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("doctor_notes", explode(",", $Page->getCurrentDetailTable())) && $doctor_notes->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("doctor_notes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "DoctorNotesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("lab_test_requests", explode(",", $Page->getCurrentDetailTable())) && $lab_test_requests->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("lab_test_requests", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LabTestRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("prescriptions", explode(",", $Page->getCurrentDetailTable())) && $prescriptions->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("prescriptions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PrescriptionsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("radiology_requests", explode(",", $Page->getCurrentDetailTable())) && $radiology_requests->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("radiology_requests", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RadiologyRequestsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatient_visitsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatient_visitsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("patient_visits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
