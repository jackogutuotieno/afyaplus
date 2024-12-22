<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsView = &$Page;
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
<form name="fpatientsview" id="fpatientsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatientsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatientsview")
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
<input type="hidden" name="t" value="patients">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_id"><template id="tpc_patients_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patients_id"><span id="el_patients_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_patient_name"><template id="tpc_patients_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_patients_patient_name"><span id="el_patients_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <tr id="r_age"<?= $Page->age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_age"><template id="tpc_patients_age"><?= $Page->age->caption() ?></template></span></td>
        <td data-name="age"<?= $Page->age->cellAttributes() ?>>
<template id="tpx_patients_age"><span id="el_patients_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_gender"><template id="tpc_patients_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_patients_gender"><span id="el_patients_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patientsview" class="ew-custom-template"></div>
<template id="tpm_patientsview">
<div id="ct_PatientsView"><div class="row gridder-view">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_patient_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_patient_name"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_age"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_gender"></slot></p>
        </div>
    </div> <!-- ./col --> 
</div> <!-- ./row --></div>
</template>
<?php
    if (in_array("patient_appointments", explode(",", $Page->getCurrentDetailTable())) && $patient_appointments->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_appointments", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_appointments")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientAppointmentsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patients_dependants", explode(",", $Page->getCurrentDetailTable())) && $patients_dependants->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patients_dependants", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patients_dependants")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientsDependantsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_visits", explode(",", $Page->getCurrentDetailTable())) && $patient_visits->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_visits", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_visits")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientVisitsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patientsview", "tpm_patientsview", "patientsview", "<?= $Page->Export ?>", "patients", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
