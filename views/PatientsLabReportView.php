<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsLabReportView = &$Page;
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
<form name="fpatients_lab_reportview" id="fpatients_lab_reportview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients_lab_report: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatients_lab_reportview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatients_lab_reportview")
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
<input type="hidden" name="t" value="patients_lab_report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_id"><template id="tpc_patients_lab_report_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_patients_lab_report_id"><span id="el_patients_lab_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
    <tr id="r_patient_name"<?= $Page->patient_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_patient_name"><template id="tpc_patients_lab_report_patient_name"><?= $Page->patient_name->caption() ?></template></span></td>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<template id="tpx_patients_lab_report_patient_name"><span id="el_patients_lab_report_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Group_Concat_service_name->Visible) { // Group_Concat_service_name ?>
    <tr id="r_Group_Concat_service_name"<?= $Page->Group_Concat_service_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_Group_Concat_service_name"><template id="tpc_patients_lab_report_Group_Concat_service_name"><?= $Page->Group_Concat_service_name->caption() ?></template></span></td>
        <td data-name="Group_Concat_service_name"<?= $Page->Group_Concat_service_name->cellAttributes() ?>>
<template id="tpx_patients_lab_report_Group_Concat_service_name"><span id="el_patients_lab_report_Group_Concat_service_name">
<span<?= $Page->Group_Concat_service_name->viewAttributes() ?>>
<?= $Page->Group_Concat_service_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
    <tr id="r_date_of_birth"<?= $Page->date_of_birth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_date_of_birth"><template id="tpc_patients_lab_report_date_of_birth"><?= $Page->date_of_birth->caption() ?></template></span></td>
        <td data-name="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<template id="tpx_patients_lab_report_date_of_birth"><span id="el_patients_lab_report_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_gender"><template id="tpc_patients_lab_report_gender"><?= $Page->gender->caption() ?></template></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<template id="tpx_patients_lab_report_gender"><span id="el_patients_lab_report_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
    <tr id="r_patient_age"<?= $Page->patient_age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_patient_age"><template id="tpc_patients_lab_report_patient_age"><?= $Page->patient_age->caption() ?></template></span></td>
        <td data-name="patient_age"<?= $Page->patient_age->cellAttributes() ?>>
<template id="tpx_patients_lab_report_patient_age"><span id="el_patients_lab_report_patient_age">
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
    <tr id="r_details"<?= $Page->details->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_details"><template id="tpc_patients_lab_report_details"><?= $Page->details->caption() ?></template></span></td>
        <td data-name="details"<?= $Page->details->cellAttributes() ?>>
<template id="tpx_patients_lab_report_details"><span id="el_patients_lab_report_details">
<span<?= $Page->details->viewAttributes() ?>>
<?= $Page->details->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_status"><template id="tpc_patients_lab_report_status"><?= $Page->status->caption() ?></template></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<template id="tpx_patients_lab_report_status"><span id="el_patients_lab_report_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->laboratorist->Visible) { // laboratorist ?>
    <tr id="r_laboratorist"<?= $Page->laboratorist->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_laboratorist"><template id="tpc_patients_lab_report_laboratorist"><?= $Page->laboratorist->caption() ?></template></span></td>
        <td data-name="laboratorist"<?= $Page->laboratorist->cellAttributes() ?>>
<template id="tpx_patients_lab_report_laboratorist"><span id="el_patients_lab_report_laboratorist">
<span<?= $Page->laboratorist->viewAttributes() ?>>
<?= $Page->laboratorist->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_date_created"><template id="tpc_patients_lab_report_date_created"><?= $Page->date_created->caption() ?></template></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_patients_lab_report_date_created"><span id="el_patients_lab_report_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_lab_report_date_updated"><template id="tpc_patients_lab_report_date_updated"><?= $Page->date_updated->caption() ?></template></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<template id="tpx_patients_lab_report_date_updated"><span id="el_patients_lab_report_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_patients_lab_reportview" class="ew-custom-template"></div>
<template id="tpm_patients_lab_reportview">
<div id="ct_PatientsLabReportView"><div class="row gridder-view">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_id"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_patient_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_patient_name"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_gender"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_gender"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_patient_age"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_patient_age"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_Group_Concat_service_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_Group_Concat_service_name"></slot></p>
        </div>
    </div> <!-- ./col -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <p><slot class="ew-slot" name="tpc_patients_lab_report_details"></slot>&nbsp;<slot class="ew-slot" name="tpx_patients_lab_report_details"></slot></p>
        </div>
    </div> <!-- ./col -->
</div> <!-- ./row --></div>
</template>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("urinalysis_results", explode(",", $Page->getCurrentDetailTable())) && $urinalysis_results->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("urinalysis_results") ?><?= $Page->DetailPages->activeClasses("urinalysis_results") ?>" data-bs-target="#tab_urinalysis_results" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_urinalysis_results" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("urinalysis_results")) ?>"><?= $Language->tablePhrase("urinalysis_results", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("full_haemo_results", explode(",", $Page->getCurrentDetailTable())) && $full_haemo_results->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("full_haemo_results") ?><?= $Page->DetailPages->activeClasses("full_haemo_results") ?>" data-bs-target="#tab_full_haemo_results" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_full_haemo_results" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("full_haemo_results")) ?>"><?= $Language->tablePhrase("full_haemo_results", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("urinalysis_results", explode(",", $Page->getCurrentDetailTable())) && $urinalysis_results->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("urinalysis_results") ?><?= $Page->DetailPages->activeClasses("urinalysis_results") ?>" id="tab_urinalysis_results" role="tabpanel"><!-- page* -->
<?php include_once "UrinalysisResultsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("full_haemo_results", explode(",", $Page->getCurrentDetailTable())) && $full_haemo_results->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("full_haemo_results") ?><?= $Page->DetailPages->activeClasses("full_haemo_results") ?>" id="tab_full_haemo_results" role="tabpanel"><!-- page* -->
<?php include_once "FullHaemoResultsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_patients_lab_reportview", "tpm_patients_lab_reportview", "patients_lab_reportview", "<?= $Page->Export ?>", "patients_lab_report", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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