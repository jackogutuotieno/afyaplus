<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestRequestsDetailsView = &$Page;
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
<form name="flab_test_requests_detailsview" id="flab_test_requests_detailsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_requests_details: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var flab_test_requests_detailsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_requests_detailsview")
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
<input type="hidden" name="t" value="lab_test_requests_details">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_requests_details_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
    <tr id="r_lab_test_request_id"<?= $Page->lab_test_request_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_requests_details_lab_test_request_id"><?= $Page->lab_test_request_id->caption() ?></span></td>
        <td data-name="lab_test_request_id"<?= $Page->lab_test_request_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_lab_test_request_id">
<span<?= $Page->lab_test_request_id->viewAttributes() ?>>
<?= $Page->lab_test_request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->specimen_id->Visible) { // specimen_id ?>
    <tr id="r_specimen_id"<?= $Page->specimen_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_requests_details_specimen_id"><?= $Page->specimen_id->caption() ?></span></td>
        <td data-name="specimen_id"<?= $Page->specimen_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_specimen_id">
<span<?= $Page->specimen_id->viewAttributes() ?>>
<?= $Page->specimen_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->service_id->Visible) { // service_id ?>
    <tr id="r_service_id"<?= $Page->service_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_requests_details_service_id"><?= $Page->service_id->caption() ?></span></td>
        <td data-name="service_id"<?= $Page->service_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_service_id">
<span<?= $Page->service_id->viewAttributes() ?>>
<?= $Page->service_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("lab_test_requests_queue", explode(",", $Page->getCurrentDetailTable())) && $lab_test_requests_queue->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("lab_test_requests_queue") ?><?= $Page->DetailPages->activeClasses("lab_test_requests_queue") ?>" data-bs-target="#tab_lab_test_requests_queue" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_lab_test_requests_queue" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("lab_test_requests_queue")) ?>"><?= $Language->tablePhrase("lab_test_requests_queue", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("laboratory_billing_report", explode(",", $Page->getCurrentDetailTable())) && $laboratory_billing_report->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("laboratory_billing_report") ?><?= $Page->DetailPages->activeClasses("laboratory_billing_report") ?>" data-bs-target="#tab_laboratory_billing_report" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_laboratory_billing_report" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("laboratory_billing_report")) ?>"><?= $Language->tablePhrase("laboratory_billing_report", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("lab_test_requests_queue", explode(",", $Page->getCurrentDetailTable())) && $lab_test_requests_queue->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("lab_test_requests_queue") ?><?= $Page->DetailPages->activeClasses("lab_test_requests_queue") ?>" id="tab_lab_test_requests_queue" role="tabpanel"><!-- page* -->
<?php include_once "LabTestRequestsQueueGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("laboratory_billing_report", explode(",", $Page->getCurrentDetailTable())) && $laboratory_billing_report->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("laboratory_billing_report") ?><?= $Page->DetailPages->activeClasses("laboratory_billing_report") ?>" id="tab_laboratory_billing_report" role="tabpanel"><!-- page* -->
<?php include_once "LaboratoryBillingReportGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
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
