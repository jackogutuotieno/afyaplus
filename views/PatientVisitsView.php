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
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_patient_visits_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_patient_visits_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <tr id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits__title"><?= $Page->_title->caption() ?></span></td>
        <td data-name="_title"<?= $Page->_title->cellAttributes() ?>>
<span id="el_patient_visits__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <tr id="r_visit_type_id"<?= $Page->visit_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_visit_type_id"><?= $Page->visit_type_id->caption() ?></span></td>
        <td data-name="visit_type_id"<?= $Page->visit_type_id->cellAttributes() ?>>
<span id="el_patient_visits_visit_type_id">
<span<?= $Page->visit_type_id->viewAttributes() ?>>
<?= $Page->visit_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->doctor_id->Visible) { // doctor_id ?>
    <tr id="r_doctor_id"<?= $Page->doctor_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_doctor_id"><?= $Page->doctor_id->caption() ?></span></td>
        <td data-name="doctor_id"<?= $Page->doctor_id->cellAttributes() ?>>
<span id="el_patient_visits_doctor_id">
<span<?= $Page->doctor_id->viewAttributes() ?>>
<?= $Page->doctor_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method_id->Visible) { // payment_method_id ?>
    <tr id="r_payment_method_id"<?= $Page->payment_method_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_payment_method_id"><?= $Page->payment_method_id->caption() ?></span></td>
        <td data-name="payment_method_id"<?= $Page->payment_method_id->cellAttributes() ?>>
<span id="el_patient_visits_payment_method_id">
<span<?= $Page->payment_method_id->viewAttributes() ?>>
<?= $Page->payment_method_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medical_scheme_id->Visible) { // medical_scheme_id ?>
    <tr id="r_medical_scheme_id"<?= $Page->medical_scheme_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_medical_scheme_id"><?= $Page->medical_scheme_id->caption() ?></span></td>
        <td data-name="medical_scheme_id"<?= $Page->medical_scheme_id->cellAttributes() ?>>
<span id="el_patient_visits_medical_scheme_id">
<span<?= $Page->medical_scheme_id->viewAttributes() ?>>
<?= $Page->medical_scheme_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->section->Visible) { // section ?>
    <tr id="r_section"<?= $Page->section->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_section"><?= $Page->section->caption() ?></span></td>
        <td data-name="section"<?= $Page->section->cellAttributes() ?>>
<span id="el_patient_visits_section">
<span<?= $Page->section->viewAttributes() ?>>
<?= $Page->section->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->checkin_date->Visible) { // checkin_date ?>
    <tr id="r_checkin_date"<?= $Page->checkin_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_visits_checkin_date"><?= $Page->checkin_date->caption() ?></span></td>
        <td data-name="checkin_date"<?= $Page->checkin_date->cellAttributes() ?>>
<span id="el_patient_visits_checkin_date">
<span<?= $Page->checkin_date->viewAttributes() ?>>
<?= $Page->checkin_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("lab_test_requests", explode(",", $Page->getCurrentDetailTable())) && $lab_test_requests->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("lab_test_requests", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LabTestRequestsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_vitals->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_vaccinations", explode(",", $Page->getCurrentDetailTable())) && $patient_vaccinations->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_vaccinations", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientVaccinationsGrid.php" ?>
<?php } ?>
</form>
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
