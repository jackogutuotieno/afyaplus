<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVisitsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fpatient_visitsview" id="fpatient_visitsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_visits: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatient_visitsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_visitsview")
        .setPageId("view")
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
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_visits">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_id"><template id="tpc_patient_visits_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patient_visits_id"><span id="el_patient_visits_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_patient_id"><template id="tpc_patient_visits_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_patient_visits_patient_id"><span id="el_patient_visits_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <tr id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_visit_type_id"><template id="tpc_patient_visits_visit_type_id"><?= $Page->visit_type_id->caption() ?></template></span></td>
        <td data-name="visit_type_id"<?= $Page->visit_type_id->cellAttributes() ?>>
<template id="tpx_patient_visits_visit_type_id"><span id="el_patient_visits_visit_type_id">
<span<?= $Page->visit_type_id->viewAttributes() ?>>
<?= $Page->visit_type_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method_id->Visible) { // payment_method_id ?>
    <tr id="r_payment_method_id"<?= $Page->payment_method_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_payment_method_id"><template id="tpc_patient_visits_payment_method_id"><?= $Page->payment_method_id->caption() ?></template></span></td>
        <td data-name="payment_method_id"<?= $Page->payment_method_id->cellAttributes() ?>>
<template id="tpx_patient_visits_payment_method_id"><span id="el_patient_visits_payment_method_id">
<span<?= $Page->payment_method_id->viewAttributes() ?>>
<?= $Page->payment_method_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medical_scheme_id->Visible) { // medical_scheme_id ?>
    <tr id="r_medical_scheme_id"<?= $Page->medical_scheme_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_medical_scheme_id"><template id="tpc_patient_visits_medical_scheme_id"><?= $Page->medical_scheme_id->caption() ?></template></span></td>
        <td data-name="medical_scheme_id"<?= $Page->medical_scheme_id->cellAttributes() ?>>
<template id="tpx_patient_visits_medical_scheme_id"><span id="el_patient_visits_medical_scheme_id">
<span<?= $Page->medical_scheme_id->viewAttributes() ?>>
<?= $Page->medical_scheme_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_status"><template id="tpc_patient_visits_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_patient_visits_status"><span id="el_patient_visits_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patient_visitsview" class="ew-custom-template"></div>
<template id="tpm_patient_visitsview">
<div id="ct_PatientVisitsView"><div class="row gridder-view">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_visits_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_visits_patient_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_visits_visit_type_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_visits_visit_type_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_visits_payment_method_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_visits_payment_method_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_visits_medical_scheme_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_visits_medical_scheme_id"></slot></p>
        </div>
    </div> <!-- ./col --> 
</div> <!-- ./row --></div>
</template>
<?php
    if (in_array("patient_queue", explode(",", $Page->getCurrentDetailTable())) && $patient_queue->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_queue", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_queue")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientQueueGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_vitals->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_vitals", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_vitals")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("doctor_notes", explode(",", $Page->getCurrentDetailTable())) && $doctor_notes->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("doctor_notes", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("doctor_notes")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "DoctorNotesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("prescriptions", explode(",", $Page->getCurrentDetailTable())) && $prescriptions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("prescriptions", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("prescriptions")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PrescriptionsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("radiology_requests", explode(",", $Page->getCurrentDetailTable())) && $radiology_requests->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("radiology_requests", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("radiology_requests")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "RadiologyRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("invoices", explode(",", $Page->getCurrentDetailTable())) && $invoices->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("invoices", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("invoices")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "InvoicesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_vaccinations", explode(",", $Page->getCurrentDetailTable())) && $patient_vaccinations->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_vaccinations", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_vaccinations")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientVaccinationsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("cash_payments", explode(",", $Page->getCurrentDetailTable())) && $cash_payments->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("cash_payments", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("cash_payments")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "CashPaymentsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("lab_test_requests", explode(",", $Page->getCurrentDetailTable())) && $lab_test_requests->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("lab_test_requests", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("lab_test_requests")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "LabTestRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("laboratory_billing_report", explode(",", $Page->getCurrentDetailTable())) && $laboratory_billing_report->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("laboratory_billing_report", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("laboratory_billing_report")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "LaboratoryBillingReportGrid.php" ?>
<?php } ?>
<?php
    if (in_array("radiology_billing_report", explode(",", $Page->getCurrentDetailTable())) && $radiology_billing_report->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("radiology_billing_report", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("radiology_billing_report")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "RadiologyBillingReportGrid.php" ?>
<?php } ?>
<?php
    if (in_array("pharmacy_billing_report", explode(",", $Page->getCurrentDetailTable())) && $pharmacy_billing_report->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("pharmacy_billing_report", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("pharmacy_billing_report")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PharmacyBillingReportGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patients_lab_report", explode(",", $Page->getCurrentDetailTable())) && $patients_lab_report->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patients_lab_report", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patients_lab_report")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientsLabReportGrid.php" ?>
<?php } ?>
<?php
    if (in_array("medicine_dispensation", explode(",", $Page->getCurrentDetailTable())) && $medicine_dispensation->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("medicine_dispensation", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("medicine_dispensation")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "MedicineDispensationGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patient_visitsview", "tpm_patient_visitsview", "patient_visitsview", "<?= $Page->Export ?>", "patient_visits", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
    loadjs.done("customtemplate");
});
</script>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
