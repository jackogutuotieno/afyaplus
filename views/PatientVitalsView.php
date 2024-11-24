<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVitalsView = &$Page;
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
<form name="fpatient_vitalsview" id="fpatient_vitalsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatient_vitalsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_vitalsview")
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
<input type="hidden" name="t" value="patient_vitals">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_patient_vitals_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_patient_vitals_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_visit_id"><?= $Page->visit_id->caption() ?></span></td>
        <td data-name="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<span id="el_patient_vitals_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <tr id="r_height"<?= $Page->height->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_height"><?= $Page->height->caption() ?></span></td>
        <td data-name="height"<?= $Page->height->cellAttributes() ?>>
<span id="el_patient_vitals_height">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
    <tr id="r_weight"<?= $Page->weight->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_weight"><?= $Page->weight->caption() ?></span></td>
        <td data-name="weight"<?= $Page->weight->cellAttributes() ?>>
<span id="el_patient_vitals_weight">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
    <tr id="r_bmi"<?= $Page->bmi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_bmi"><?= $Page->bmi->caption() ?></span></td>
        <td data-name="bmi"<?= $Page->bmi->cellAttributes() ?>>
<span id="el_patient_vitals_bmi">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
    <tr id="r_temperature"<?= $Page->temperature->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_temperature"><?= $Page->temperature->caption() ?></span></td>
        <td data-name="temperature"<?= $Page->temperature->cellAttributes() ?>>
<span id="el_patient_vitals_temperature">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pulse->Visible) { // pulse ?>
    <tr id="r_pulse"<?= $Page->pulse->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_pulse"><?= $Page->pulse->caption() ?></span></td>
        <td data-name="pulse"<?= $Page->pulse->cellAttributes() ?>>
<span id="el_patient_vitals_pulse">
<span<?= $Page->pulse->viewAttributes() ?>>
<?= $Page->pulse->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->blood_pressure->Visible) { // blood_pressure ?>
    <tr id="r_blood_pressure"<?= $Page->blood_pressure->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patient_vitals_blood_pressure"><?= $Page->blood_pressure->caption() ?></span></td>
        <td data-name="blood_pressure"<?= $Page->blood_pressure->cellAttributes() ?>>
<span id="el_patient_vitals_blood_pressure">
<span<?= $Page->blood_pressure->viewAttributes() ?>>
<?= $Page->blood_pressure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
