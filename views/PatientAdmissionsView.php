<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientAdmissionsView = &$Page;
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
<form name="fpatient_admissionsview" id="fpatient_admissionsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_admissions: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatient_admissionsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_admissionsview")
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
<input type="hidden" name="t" value="patient_admissions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_admissions_id"><template id="tpc_patient_admissions_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patient_admissions_id"><span id="el_patient_admissions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_admissions_patient_id"><template id="tpc_patient_admissions_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_patient_admissions_patient_id"><span id="el_patient_admissions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_admissions_status"><template id="tpc_patient_admissions_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_patient_admissions_status"><span id="el_patient_admissions_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_admissions_date_created"><template id="tpc_patient_admissions_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_patient_admissions_date_created"><span id="el_patient_admissions_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patient_admissionsview" class="ew-custom-template"></div>
<template id="tpm_patient_admissionsview">
<div id="ct_PatientAdmissionsView"><div class="row gridder-view">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_admissions_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_admissions_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_admissions_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_admissions_patient_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_admissions_status"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_admissions_status"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patient_admissions_date_created"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_admissions_date_created"></slot></p>
        </div>
    </div> <!-- ./col -->
</div> <!-- ./row --></div>
</template>
<?php
    if (in_array("bed_assignment", explode(",", $Page->getCurrentDetailTable())) && $bed_assignment->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("bed_assignment", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("bed_assignment")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "BedAssignmentGrid.php" ?>
<?php } ?>
<?php
    if (in_array("issue_items", explode(",", $Page->getCurrentDetailTable())) && $issue_items->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("issue_items", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("issue_items")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "IssueItemsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patients_discharge", explode(",", $Page->getCurrentDetailTable())) && $patients_discharge->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patients_discharge", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patients_discharge")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientsDischargeGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_vitals->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_vitals", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_ipd_vitals")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientIpdVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_services", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_services->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_services", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_ipd_services")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientIpdServicesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_prescriptions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_prescriptions", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_ipd_prescriptions")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientIpdPrescriptionsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patient_admissionsview", "tpm_patient_admissionsview", "patient_admissionsview", "<?= $Page->Export ?>", "patient_admissions", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
