<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DischargeSummaryReportView = &$Page;
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
<form name="fdischarge_summary_reportview" id="fdischarge_summary_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { discharge_summary_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fdischarge_summary_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdischarge_summary_reportview")
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
<input type="hidden" name="t" value="discharge_summary_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_id"><template id="tpc_discharge_summary_report_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_id"><span id="el_discharge_summary_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_patient_id"><template id="tpc_discharge_summary_report_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_patient_id"><span id="el_discharge_summary_report_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_patient_name"><template id="tpc_discharge_summary_report_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_patient_name"><span id="el_discharge_summary_report_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <tr id="r_age"<?= $Page->age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_age"><template id="tpc_discharge_summary_report_age"><?= $Page->age->caption() ?></template></span></td>
        <td data-name="age"<?= $Page->age->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_age"><span id="el_discharge_summary_report_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_gender"><template id="tpc_discharge_summary_report_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_gender"><span id="el_discharge_summary_report_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_status"><template id="tpc_discharge_summary_report_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_status"><span id="el_discharge_summary_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admission_reason->Visible) { // admission_reason ?>
    <tr id="r_admission_reason"<?= $Page->admission_reason->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_admission_reason"><template id="tpc_discharge_summary_report_admission_reason"><?= $Page->admission_reason->caption() ?></template></span></td>
        <td data-name="admission_reason"<?= $Page->admission_reason->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_admission_reason"><span id="el_discharge_summary_report_admission_reason">
<span<?= $Page->admission_reason->viewAttributes() ?>>
<?= $Page->admission_reason->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->discharge_condition->Visible) { // discharge_condition ?>
    <tr id="r_discharge_condition"<?= $Page->discharge_condition->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_discharge_condition"><template id="tpc_discharge_summary_report_discharge_condition"><?= $Page->discharge_condition->caption() ?></template></span></td>
        <td data-name="discharge_condition"<?= $Page->discharge_condition->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_discharge_condition"><span id="el_discharge_summary_report_discharge_condition">
<span<?= $Page->discharge_condition->viewAttributes() ?>>
<?= $Page->discharge_condition->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_created_by_user_id"><template id="tpc_discharge_summary_report_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></template></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_created_by_user_id"><span id="el_discharge_summary_report_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admission_date->Visible) { // admission_date ?>
    <tr id="r_admission_date"<?= $Page->admission_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_admission_date"><template id="tpc_discharge_summary_report_admission_date"><?= $Page->admission_date->caption() ?></template></span></td>
        <td data-name="admission_date"<?= $Page->admission_date->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_admission_date"><span id="el_discharge_summary_report_admission_date">
<span<?= $Page->admission_date->viewAttributes() ?>>
<?= $Page->admission_date->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->discharge_date->Visible) { // discharge_date ?>
    <tr id="r_discharge_date"<?= $Page->discharge_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_discharge_date"><template id="tpc_discharge_summary_report_discharge_date"><?= $Page->discharge_date->caption() ?></template></span></td>
        <td data-name="discharge_date"<?= $Page->discharge_date->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_discharge_date"><span id="el_discharge_summary_report_discharge_date">
<span<?= $Page->discharge_date->viewAttributes() ?>>
<?= $Page->discharge_date->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_days->Visible) { // total_days ?>
    <tr id="r_total_days"<?= $Page->total_days->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_discharge_summary_report_total_days"><template id="tpc_discharge_summary_report_total_days"><?= $Page->total_days->caption() ?></template></span></td>
        <td data-name="total_days"<?= $Page->total_days->cellAttributes() ?>>
<template id="tpx_discharge_summary_report_total_days"><span id="el_discharge_summary_report_total_days">
<span<?= $Page->total_days->viewAttributes() ?>>
<?= $Page->total_days->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_discharge_summary_reportview" class="ew-custom-template"></div>
<template id="tpm_discharge_summary_reportview">
<div id="ct_DischargeSummaryReportView"><h2 style="text-align:center">Discharge Summary</h2>
<table class="tbl-group" style="width: 100%">
    <tr style="border-top:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_patient_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_patient_name"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_age"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_gender"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_admission_reason"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_admission_reason"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_discharge_condition"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_discharge_condition"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_admission_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_admission_date"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_discharge_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_discharge_date"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_discharge_summary_report_total_days"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_total_days"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000; ;border-right: 1px solid #000;;border-bottom: 1px solid #000">
        <td style="border-left: 1px solid #000;"><p><slot class="ew-slot" name="tpc_discharge_summary_report_created_by_user_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_discharge_summary_report_created_by_user_id"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("patient_ipd_vitals", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_vitals->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_vitals", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdVitalsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("issue_items", explode(",", $Page->getCurrentDetailTable())) && $issue_items->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("issue_items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "IssueItemsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_services", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_services->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_services", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdServicesGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_ipd_prescriptions", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_prescriptions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_prescriptions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientIpdPrescriptionsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_discharge_summary_reportview", "tpm_discharge_summary_reportview", "discharge_summary_reportview", "<?= $Page->Export ?>", "discharge_summary_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
