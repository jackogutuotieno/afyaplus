<?php

namespace PHPMaker2024\afyaplus;

// Page object
$InvoiceReportView = &$Page;
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
<form name="finvoice_reportview" id="finvoice_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { invoice_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var finvoice_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoice_reportview")
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
<input type="hidden" name="t" value="invoice_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_id"><template id="tpc_invoice_report_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_invoice_report_id"><span id="el_invoice_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_patient_id"><template id="tpc_invoice_report_patient_id"><?= $Page->patient_id->caption() ?></template></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<template id="tpx_invoice_report_patient_id"><span id="el_invoice_report_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_description"><template id="tpc_invoice_report_description"><?= $Page->description->caption() ?></template></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<template id="tpx_invoice_report_description"><span id="el_invoice_report_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_status->Visible) { // payment_status ?>
    <tr id="r_payment_status"<?= $Page->payment_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_payment_status"><template id="tpc_invoice_report_payment_status"><?= $Page->payment_status->caption() ?></template></span></td>
        <td data-name="payment_status"<?= $Page->payment_status->cellAttributes() ?>>
<template id="tpx_invoice_report_payment_status"><span id="el_invoice_report_payment_status">
<span<?= $Page->payment_status->viewAttributes() ?>>
<?= $Page->payment_status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_created_by_user_id"><template id="tpc_invoice_report_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></template></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<template id="tpx_invoice_report_created_by_user_id"><span id="el_invoice_report_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_invoice_report_date_created"><template id="tpc_invoice_report_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_invoice_report_date_created"><span id="el_invoice_report_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_invoice_reportview" class="ew-custom-template"></div>
<template id="tpm_invoice_reportview">
<div id="ct_InvoiceReportView"><h2 style="text-align:center">Invoice</h2>
<table class="tbl-group" style="width: 100%">
    <tr style="border-top: 1px solid #000;border-right: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_invoice_report_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_id"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_invoice_report_patient_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_patient_id"></slot></p></td>
    </tr>
    <tr style="border-top: 1px solid #000">
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_invoice_report_description"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_description"></slot></p></td>
        <td style="border-left: 1px solid #000;border-right: 1px solid #000"><p><slot class="ew-slot" name="tpc_invoice_report_payment_status"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_payment_status"></slot></p></td>
    </tr>
    <tr style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000">
        <td><p><slot class="ew-slot" name="tpc_invoice_report_created_by_user_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_created_by_user_id"></slot></p></td>
        <td><p><slot class="ew-slot" name="tpc_invoice_report_date_created"></slot>&nbsp;<slot class="ew-slot" name="tpx_invoice_report_date_created"></slot></p></td>
    </tr>
</table></div>
</template>
<?php
    if (in_array("invoice_report_details", explode(",", $Page->getCurrentDetailTable())) && $invoice_report_details->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("invoice_report_details", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "InvoiceReportDetailsGrid.php" ?>
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_invoice_reportview", "tpm_invoice_reportview", "invoice_reportview", "<?= $Page->Export ?>", "invoice_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
