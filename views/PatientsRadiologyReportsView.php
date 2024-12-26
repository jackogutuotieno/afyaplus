<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsRadiologyReportsView = &$Page;
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
<form name="fpatients_radiology_reportsview" id="fpatients_radiology_reportsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients_radiology_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatients_radiology_reportsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_radiology_reportsview")
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
<input type="hidden" name="t" value="patients_radiology_reports">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_id"><template id="tpc_patients_radiology_reports_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_id"><span id="el_patients_radiology_reports_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->radiology_requests_id->Visible) { // radiology_requests_id ?>
    <tr id="r_radiology_requests_id"<?= $Page->radiology_requests_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_radiology_requests_id"><template id="tpc_patients_radiology_reports_radiology_requests_id"><?= $Page->radiology_requests_id->caption() ?></template></span></td>
        <td data-name="radiology_requests_id"<?= $Page->radiology_requests_id->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_radiology_requests_id"><span id="el_patients_radiology_reports_radiology_requests_id">
<span<?= $Page->radiology_requests_id->viewAttributes() ?>>
<?= $Page->radiology_requests_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_patient_id"><template id="tpc_patients_radiology_reports_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_patient_id"><span id="el_patients_radiology_reports_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_visit_id"><template id="tpc_patients_radiology_reports_visit_id"><?= $Page->visit_id->caption() ?></template></span></td>
        <td data-name="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_visit_id"><span id="el_patients_radiology_reports_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_patient_name"><template id="tpc_patients_radiology_reports_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_patient_name"><span id="el_patients_radiology_reports_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
    <tr id="r_patient_age"<?= $Page->patient_age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_patient_age"><template id="tpc_patients_radiology_reports_patient_age"><?= $Page->patient_age->caption() ?></template></span></td>
        <td data-name="patient_age"<?= $Page->patient_age->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_patient_age"><span id="el_patients_radiology_reports_patient_age">
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_gender"><template id="tpc_patients_radiology_reports_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_gender"><span id="el_patients_radiology_reports_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->service_name->Visible) { // service_name ?>
    <tr id="r_service_name"<?= $Page->service_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_service_name"><template id="tpc_patients_radiology_reports_service_name"><?= $Page->service_name->caption() ?></template></span></td>
        <td data-name="service_name"<?= $Page->service_name->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_service_name"><span id="el_patients_radiology_reports_service_name">
<span<?= $Page->service_name->viewAttributes() ?>>
<?= $Page->service_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_status"><template id="tpc_patients_radiology_reports_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_status"><span id="el_patients_radiology_reports_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->radiologist->Visible) { // radiologist ?>
    <tr id="r_radiologist"<?= $Page->radiologist->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_radiologist"><template id="tpc_patients_radiology_reports_radiologist"><?= $Page->radiologist->caption() ?></template></span></td>
        <td data-name="radiologist"<?= $Page->radiologist->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_radiologist"><span id="el_patients_radiology_reports_radiologist">
<span<?= $Page->radiologist->viewAttributes() ?>>
<?= $Page->radiologist->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_radiology_reports_date_created"><template id="tpc_patients_radiology_reports_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_patients_radiology_reports_date_created"><span id="el_patients_radiology_reports_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patients_radiology_reportsview" class="ew-custom-template"></div>
<template id="tpm_patients_radiology_reportsview">
<div id="ct_PatientsRadiologyReportsView"><table class="tbl-group" style="width: 100%">
    <tr style="border-top: 2px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patients_radiology_reports_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patients_radiology_reports_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_patient_id"></slot></p></td>
    </tr>
    <tr style="border-top: 2px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patients_radiology_reports_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_gender"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patients_radiology_reports_patient_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_patient_age"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patients_radiology_reports_service_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_service_name"></slot></p></td>
    </tr>
    <tr style="border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 1px solid #000;border-right: 1px solid #000">
        <td><p><slot class="ew-slot" name="tpc_patients_radiology_reports_status"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_status"></slot></p></td>
        <td><p><slot class="ew-slot" name="tpc_patients_radiology_reports_radiologist"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_radiologist"></slot></p></td>
        <td><p><slot class="ew-slot" name="tpc_patients_radiology_reports_date_created"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_radiology_reports_date_created"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("patients_radiology_reports_details", explode(",", $Page->getCurrentDetailTable())) && $patients_radiology_reports_details->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patients_radiology_reports_details", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientsRadiologyReportsDetailsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patients_radiology_reportsview", "tpm_patients_radiology_reportsview", "patients_radiology_reportsview", "<?= $Page->Export ?>", "patients_radiology_reports", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
