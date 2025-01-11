<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientIpdPrescriptionsView = &$Page;
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
<form name="fpatient_ipd_prescriptionsview" id="fpatient_ipd_prescriptionsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_ipd_prescriptions: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatient_ipd_prescriptionsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_ipd_prescriptionsview")
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
<input type="hidden" name="t" value="patient_ipd_prescriptions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_id"><template id="tpc_patient_ipd_prescriptions_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_id"><span id="el_patient_ipd_prescriptions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admission_id->Visible) { // admission_id ?>
    <tr id="r_admission_id"<?= $Page->admission_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_admission_id"><template id="tpc_patient_ipd_prescriptions_admission_id"><?= $Page->admission_id->caption() ?></template></span></td>
        <td data-name="admission_id"<?= $Page->admission_id->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_admission_id"><span id="el_patient_ipd_prescriptions_admission_id">
<span<?= $Page->admission_id->viewAttributes() ?>>
<?= $Page->admission_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_patient_id"><template id="tpc_patient_ipd_prescriptions_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_patient_id"><span id="el_patient_ipd_prescriptions_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_created_by_user_id"><template id="tpc_patient_ipd_prescriptions_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></template></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_created_by_user_id"><span id="el_patient_ipd_prescriptions_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_date_created"><template id="tpc_patient_ipd_prescriptions_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_date_created"><span id="el_patient_ipd_prescriptions_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_ipd_prescriptions_date_updated"><template id="tpc_patient_ipd_prescriptions_date_updated"><?= $Page->date_updated->caption() ?></template></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<template id="tpx_patient_ipd_prescriptions_date_updated"><span id="el_patient_ipd_prescriptions_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patient_ipd_prescriptionsview" class="ew-custom-template"></div>
<template id="tpm_patient_ipd_prescriptionsview">
<div id="ct_PatientIpdPrescriptionsView"><h2 style="text-align:center">IPD - Patient Prescription</h2>
<table class="tbl-group" style="width: 100%">
    <tr style="border-top:1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patient_ipd_prescriptions_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_ipd_prescriptions_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patient_ipd_prescriptions_admission_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_ipd_prescriptions_admission_id"></slot></p></td>
    </tr>
    <tr style="border-top:1px solid #000;">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patient_ipd_prescriptions_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_ipd_prescriptions_patient_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patient_ipd_prescriptions_created_by_user_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_ipd_prescriptions_created_by_user_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_patient_ipd_prescriptions_date_created"></slot>&nbsp;<slot class="ew-slot" name="tpx_patient_ipd_prescriptions_date_created"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("patient_ipd_prescription_details", explode(",", $Page->getCurrentDetailTable())) && $patient_ipd_prescription_details->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_ipd_prescription_details", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("patient_ipd_prescription_details")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "PatientIpdPrescriptionDetailsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patient_ipd_prescriptionsview", "tpm_patient_ipd_prescriptionsview", "patient_ipd_prescriptionsview", "<?= $Page->Export ?>", "patient_ipd_prescriptions", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
