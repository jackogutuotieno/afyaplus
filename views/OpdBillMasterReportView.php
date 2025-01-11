<?php

namespace PHPMaker2024\afyaplus;

// Page object
$OpdBillMasterReportView = &$Page;
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
<form name="fopd_bill_master_reportview" id="fopd_bill_master_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { opd_bill_master_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fopd_bill_master_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fopd_bill_master_reportview")
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
<input type="hidden" name="t" value="opd_bill_master_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_id"><template id="tpc_opd_bill_master_report_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_id"><span id="el_opd_bill_master_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uhid->Visible) { // uhid ?>
    <tr id="r_uhid"<?= $Page->uhid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_uhid"><template id="tpc_opd_bill_master_report_uhid"><?= $Page->uhid->caption() ?></template></span></td>
        <td data-name="uhid"<?= $Page->uhid->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_uhid"><span id="el_opd_bill_master_report_uhid">
<span<?= $Page->uhid->viewAttributes() ?>>
<?= $Page->uhid->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_patient_name"><template id="tpc_opd_bill_master_report_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_patient_name"><span id="el_opd_bill_master_report_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <tr id="r_age"<?= $Page->age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_age"><template id="tpc_opd_bill_master_report_age"><?= $Page->age->caption() ?></template></span></td>
        <td data-name="age"<?= $Page->age->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_age"><span id="el_opd_bill_master_report_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_gender"><template id="tpc_opd_bill_master_report_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_gender"><span id="el_opd_bill_master_report_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_type->Visible) { // visit_type ?>
    <tr id="r_visit_type"<?= $Page->visit_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_visit_type"><template id="tpc_opd_bill_master_report_visit_type"><?= $Page->visit_type->caption() ?></template></span></td>
        <td data-name="visit_type"<?= $Page->visit_type->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_visit_type"><span id="el_opd_bill_master_report_visit_type">
<span<?= $Page->visit_type->viewAttributes() ?>>
<?= $Page->visit_type->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <tr id="r_payment_method"<?= $Page->payment_method->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_payment_method"><template id="tpc_opd_bill_master_report_payment_method"><?= $Page->payment_method->caption() ?></template></span></td>
        <td data-name="payment_method"<?= $Page->payment_method->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_payment_method"><span id="el_opd_bill_master_report_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company->Visible) { // company ?>
    <tr id="r_company"<?= $Page->company->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_company"><template id="tpc_opd_bill_master_report_company"><?= $Page->company->caption() ?></template></span></td>
        <td data-name="company"<?= $Page->company->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_company"><span id="el_opd_bill_master_report_company">
<span<?= $Page->company->viewAttributes() ?>>
<?= $Page->company->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_status"><template id="tpc_opd_bill_master_report_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_status"><span id="el_opd_bill_master_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_date->Visible) { // visit_date ?>
    <tr id="r_visit_date"<?= $Page->visit_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_opd_bill_master_report_visit_date"><template id="tpc_opd_bill_master_report_visit_date"><?= $Page->visit_date->caption() ?></template></span></td>
        <td data-name="visit_date"<?= $Page->visit_date->cellAttributes() ?>>
<template id="tpx_opd_bill_master_report_visit_date"><span id="el_opd_bill_master_report_visit_date">
<span<?= $Page->visit_date->viewAttributes() ?>>
<?= $Page->visit_date->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_opd_bill_master_reportview" class="ew-custom-template"></div>
<template id="tpm_opd_bill_master_reportview">
<div id="ct_OpdBillMasterReportView"><h2 style="text-align:center">OPD Billing</h2>
<table class="tbl-group" style="width: 100%">
    <tr style="border-top:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_uhid"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_uhid"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_patient_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_patient_name"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_age"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_gender"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_visit_type"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_visit_type"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;border-bottom:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_payment_method"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_payment_method"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_company"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_company"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_opd_bill_master_report_visit_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_opd_bill_master_report_visit_date"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("opd_consultation", explode(",", $Page->getCurrentDetailTable())) && $opd_consultation->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("opd_consultation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "OpdConsultationGrid.php" ?>
<?php } ?>
<?php
    if (in_array("opd_lab_master_bill", explode(",", $Page->getCurrentDetailTable())) && $opd_lab_master_bill->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("opd_lab_master_bill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "OpdLabMasterBillGrid.php" ?>
<?php } ?>
<?php
    if (in_array("opd_radiology_master_bill", explode(",", $Page->getCurrentDetailTable())) && $opd_radiology_master_bill->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("opd_radiology_master_bill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "OpdRadiologyMasterBillGrid.php" ?>
<?php } ?>
<?php
    if (in_array("opd_pharmacy_master_bill", explode(",", $Page->getCurrentDetailTable())) && $opd_pharmacy_master_bill->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("opd_pharmacy_master_bill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "OpdPharmacyMasterBillGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_opd_bill_master_reportview", "tpm_opd_bill_master_reportview", "opd_bill_master_reportview", "<?= $Page->Export ?>", "opd_bill_master_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
