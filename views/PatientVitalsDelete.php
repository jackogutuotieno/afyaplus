<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVitalsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fpatient_vitalsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_vitalsdelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpatient_vitalsdelete" id="fpatient_vitalsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_vitals">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_patient_vitals_patient_id" class="patient_vitals_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
        <th class="<?= $Page->visit_id->headerCellClass() ?>"><span id="elh_patient_vitals_visit_id" class="patient_vitals_visit_id"><?= $Page->visit_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <th class="<?= $Page->height->headerCellClass() ?>"><span id="elh_patient_vitals_height" class="patient_vitals_height"><?= $Page->height->caption() ?></span></th>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
        <th class="<?= $Page->weight->headerCellClass() ?>"><span id="elh_patient_vitals_weight" class="patient_vitals_weight"><?= $Page->weight->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <th class="<?= $Page->bmi->headerCellClass() ?>"><span id="elh_patient_vitals_bmi" class="patient_vitals_bmi"><?= $Page->bmi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
        <th class="<?= $Page->temperature->headerCellClass() ?>"><span id="elh_patient_vitals_temperature" class="patient_vitals_temperature"><?= $Page->temperature->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pulse->Visible) { // pulse ?>
        <th class="<?= $Page->pulse->headerCellClass() ?>"><span id="elh_patient_vitals_pulse" class="patient_vitals_pulse"><?= $Page->pulse->caption() ?></span></th>
<?php } ?>
<?php if ($Page->blood_pressure->Visible) { // blood_pressure ?>
        <th class="<?= $Page->blood_pressure->headerCellClass() ?>"><span id="elh_patient_vitals_blood_pressure" class="patient_vitals_blood_pressure"><?= $Page->blood_pressure->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <th class="<?= $Page->created_by_user_id->headerCellClass() ?>"><span id="elh_patient_vitals_created_by_user_id" class="patient_vitals_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_patient_vitals_date_created" class="patient_vitals_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
        <td<?= $Page->visit_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <td<?= $Page->height->cellAttributes() ?>>
<span id="">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
        <td<?= $Page->weight->cellAttributes() ?>>
<span id="">
<span<?= $Page->weight->viewAttributes() ?>>
<?= $Page->weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bmi->Visible) { // bmi ?>
        <td<?= $Page->bmi->cellAttributes() ?>>
<span id="">
<span<?= $Page->bmi->viewAttributes() ?>>
<?= $Page->bmi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
        <td<?= $Page->temperature->cellAttributes() ?>>
<span id="">
<span<?= $Page->temperature->viewAttributes() ?>>
<?= $Page->temperature->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pulse->Visible) { // pulse ?>
        <td<?= $Page->pulse->cellAttributes() ?>>
<span id="">
<span<?= $Page->pulse->viewAttributes() ?>>
<?= $Page->pulse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->blood_pressure->Visible) { // blood_pressure ?>
        <td<?= $Page->blood_pressure->cellAttributes() ?>>
<span id="">
<span<?= $Page->blood_pressure->viewAttributes() ?>>
<?= $Page->blood_pressure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <td<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
