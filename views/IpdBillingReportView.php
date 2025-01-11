<?php

namespace PHPMaker2024\afyaplus;

// Page object
$IpdBillingReportView = &$Page;
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
<form name="fipd_billing_reportview" id="fipd_billing_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ipd_billing_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fipd_billing_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fipd_billing_reportview")
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
<input type="hidden" name="t" value="ipd_billing_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->admission_id->Visible) { // admission_id ?>
    <tr id="r_admission_id"<?= $Page->admission_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_admission_id"><template id="tpc_ipd_billing_report_admission_id"><?= $Page->admission_id->caption() ?></template></span></td>
        <td data-name="admission_id"<?= $Page->admission_id->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_admission_id"><span id="el_ipd_billing_report_admission_id">
<span<?= $Page->admission_id->viewAttributes() ?>>
<?= $Page->admission_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_uhid->Visible) { // patient_uhid ?>
    <tr id="r_patient_uhid"<?= $Page->patient_uhid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_patient_uhid"><template id="tpc_ipd_billing_report_patient_uhid"><?= $Page->patient_uhid->caption() ?></template></span></td>
        <td data-name="patient_uhid"<?= $Page->patient_uhid->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_patient_uhid"><span id="el_ipd_billing_report_patient_uhid">
<span<?= $Page->patient_uhid->viewAttributes() ?>>
<?= $Page->patient_uhid->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_patient_name"><template id="tpc_ipd_billing_report_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_patient_name"><span id="el_ipd_billing_report_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_status"><template id="tpc_ipd_billing_report_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_status"><span id="el_ipd_billing_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <tr id="r_age"<?= $Page->age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_age"><template id="tpc_ipd_billing_report_age"><?= $Page->age->caption() ?></template></span></td>
        <td data-name="age"<?= $Page->age->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_age"><span id="el_ipd_billing_report_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_gender"><template id="tpc_ipd_billing_report_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_gender"><span id="el_ipd_billing_report_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <tr id="r_payment_method"<?= $Page->payment_method->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_payment_method"><template id="tpc_ipd_billing_report_payment_method"><?= $Page->payment_method->caption() ?></template></span></td>
        <td data-name="payment_method"<?= $Page->payment_method->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_payment_method"><span id="el_ipd_billing_report_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company->Visible) { // company ?>
    <tr id="r_company"<?= $Page->company->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_company"><template id="tpc_ipd_billing_report_company"><?= $Page->company->caption() ?></template></span></td>
        <td data-name="company"<?= $Page->company->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_company"><span id="el_ipd_billing_report_company">
<span<?= $Page->company->viewAttributes() ?>>
<?= $Page->company->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_admitted->Visible) { // date_admitted ?>
    <tr id="r_date_admitted"<?= $Page->date_admitted->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_date_admitted"><template id="tpc_ipd_billing_report_date_admitted"><?= $Page->date_admitted->caption() ?></template></span></td>
        <td data-name="date_admitted"<?= $Page->date_admitted->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_date_admitted"><span id="el_ipd_billing_report_date_admitted">
<span<?= $Page->date_admitted->viewAttributes() ?>>
<?= $Page->date_admitted->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_discharged->Visible) { // date_discharged ?>
    <tr id="r_date_discharged"<?= $Page->date_discharged->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ipd_billing_report_date_discharged"><template id="tpc_ipd_billing_report_date_discharged"><?= $Page->date_discharged->caption() ?></template></span></td>
        <td data-name="date_discharged"<?= $Page->date_discharged->cellAttributes() ?>>
<template id="tpx_ipd_billing_report_date_discharged"><span id="el_ipd_billing_report_date_discharged">
<span<?= $Page->date_discharged->viewAttributes() ?>>
<?= $Page->date_discharged->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_ipd_billing_reportview" class="ew-custom-template"></div>
<template id="tpm_ipd_billing_reportview">
<div id="ct_IpdBillingReportView"><h2 style="text-align:center">IPD Billing</h2>
<table class="tbl-group" style="width: 100%">
    <tr style="border-top:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_patient_uhid"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_patient_uhid"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_patient_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_patient_name"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_age"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_gender"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_payment_method"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_payment_method"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_company"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_company"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;border-bottom:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_date_admitted"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_date_admitted"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_ipd_billing_report_date_discharged"></slot>&nbsp;<slot class="ew-slot" name="tpx_ipd_billing_report_date_discharged"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("ipd_bill_issued_items", explode(",", $Page->getCurrentDetailTable())) && $ipd_bill_issued_items->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("ipd_bill_issued_items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "IpdBillIssuedItemsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("ipd_bill_services", explode(",", $Page->getCurrentDetailTable())) && $ipd_bill_services->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("ipd_bill_services", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "IpdBillServicesGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_ipd_billing_reportview", "tpm_ipd_billing_reportview", "ipd_billing_reportview", "<?= $Page->Export ?>", "ipd_billing_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
