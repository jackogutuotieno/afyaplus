<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestReportsView = &$Page;
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
<form name="flab_test_reportsview" id="flab_test_reportsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var flab_test_reportsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_reportsview")
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
<input type="hidden" name="t" value="lab_test_reports">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_reports_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_lab_test_reports_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lab_test_requests_queue_id->Visible) { // lab_test_requests_queue_id ?>
    <tr id="r_lab_test_requests_queue_id"<?= $Page->lab_test_requests_queue_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_reports_lab_test_requests_queue_id"><?= $Page->lab_test_requests_queue_id->caption() ?></span></td>
        <td data-name="lab_test_requests_queue_id"<?= $Page->lab_test_requests_queue_id->cellAttributes() ?>>
<span id="el_lab_test_reports_lab_test_requests_queue_id">
<span<?= $Page->lab_test_requests_queue_id->viewAttributes() ?>>
<?= $Page->lab_test_requests_queue_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
    <tr id="r_details"<?= $Page->details->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_reports_details"><?= $Page->details->caption() ?></span></td>
        <td data-name="details"<?= $Page->details->cellAttributes() ?>>
<span id="el_lab_test_reports_details">
<span<?= $Page->details->viewAttributes() ?>>
<?= $Page->details->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_reports_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_lab_test_reports_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lab_test_reports_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_lab_test_reports_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("diagnosis", explode(",", $Page->getCurrentDetailTable())) && $diagnosis->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("diagnosis", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "DiagnosisGrid.php" ?>
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
