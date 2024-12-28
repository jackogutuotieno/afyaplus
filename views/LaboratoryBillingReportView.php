<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LaboratoryBillingReportView = &$Page;
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
<form name="flaboratory_billing_reportview" id="flaboratory_billing_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { laboratory_billing_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var flaboratory_billing_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flaboratory_billing_reportview")
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
<input type="hidden" name="t" value="laboratory_billing_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_id"><template id="tpc_laboratory_billing_report_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_id"><span id="el_laboratory_billing_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_patient_id"><template id="tpc_laboratory_billing_report_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_patient_id"><span id="el_laboratory_billing_report_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_visit_id"><template id="tpc_laboratory_billing_report_visit_id"><?= $Page->visit_id->caption() ?></template></span></td>
        <td data-name="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_visit_id"><span id="el_laboratory_billing_report_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_status"><template id="tpc_laboratory_billing_report_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_status"><span id="el_laboratory_billing_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_created_by_user_id"><template id="tpc_laboratory_billing_report_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></template></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_created_by_user_id"><span id="el_laboratory_billing_report_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_laboratory_billing_report_date_created"><template id="tpc_laboratory_billing_report_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_laboratory_billing_report_date_created"><span id="el_laboratory_billing_report_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_laboratory_billing_reportview" class="ew-custom-template"></div>
<template id="tpm_laboratory_billing_reportview">
<div id="ct_LaboratoryBillingReportView"><table class="tbl-group" style="width: 100%">
    <tr style="border-top: 1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_laboratory_billing_report_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_laboratory_billing_report_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_laboratory_billing_report_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_laboratory_billing_report_patient_id"></slot></p></td>
    </tr>
    <tr style="border-top: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_laboratory_billing_report_status"></slot>&nbsp;<slot class="ew-slot" name="tpx_laboratory_billing_report_status"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_laboratory_billing_report_created_by_user_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_laboratory_billing_report_created_by_user_id"></slot></p></td>
    </tr>
    <tr style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000">
        <td><p><slot class="ew-slot" name="tpc_laboratory_billing_report_date_created"></slot>&nbsp;<slot class="ew-slot" name="tpx_laboratory_billing_report_date_created"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("laboratory_billing_report_details", explode(",", $Page->getCurrentDetailTable())) && $laboratory_billing_report_details->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("laboratory_billing_report_details", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LaboratoryBillingReportDetailsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_laboratory_billing_reportview", "tpm_laboratory_billing_reportview", "laboratory_billing_reportview", "<?= $Page->Export ?>", "laboratory_billing_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
