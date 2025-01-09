<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientIpdPrescriptionDetailsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_ipd_prescription_details: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fpatient_ipd_prescription_detailsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_ipd_prescription_detailsdelete")
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
<form name="fpatient_ipd_prescription_detailsdelete" id="fpatient_ipd_prescription_detailsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_ipd_prescription_details">
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
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <th class="<?= $Page->prescription_id->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_prescription_id" class="patient_ipd_prescription_details_prescription_id"><?= $Page->prescription_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <th class="<?= $Page->medicine_stock_id->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_medicine_stock_id" class="patient_ipd_prescription_details_medicine_stock_id"><?= $Page->medicine_stock_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <th class="<?= $Page->method->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_method" class="patient_ipd_prescription_details_method"><?= $Page->method->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
        <th class="<?= $Page->dose_quantity->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_dose_quantity" class="patient_ipd_prescription_details_dose_quantity"><?= $Page->dose_quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
        <th class="<?= $Page->dose_type->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_dose_type" class="patient_ipd_prescription_details_dose_type"><?= $Page->dose_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->formulation->Visible) { // formulation ?>
        <th class="<?= $Page->formulation->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_formulation" class="patient_ipd_prescription_details_formulation"><?= $Page->formulation->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
        <th class="<?= $Page->dose_interval->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_dose_interval" class="patient_ipd_prescription_details_dose_interval"><?= $Page->dose_interval->caption() ?></span></th>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
        <th class="<?= $Page->number_of_days->headerCellClass() ?>"><span id="elh_patient_ipd_prescription_details_number_of_days" class="patient_ipd_prescription_details_number_of_days"><?= $Page->number_of_days->caption() ?></span></th>
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
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
        <td<?= $Page->prescription_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
        <td<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->medicine_stock_id->viewAttributes() ?>>
<?= $Page->medicine_stock_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <td<?= $Page->method->cellAttributes() ?>>
<span id="">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
        <td<?= $Page->dose_quantity->cellAttributes() ?>>
<span id="">
<span<?= $Page->dose_quantity->viewAttributes() ?>>
<?= $Page->dose_quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
        <td<?= $Page->dose_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->dose_type->viewAttributes() ?>>
<?= $Page->dose_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->formulation->Visible) { // formulation ?>
        <td<?= $Page->formulation->cellAttributes() ?>>
<span id="">
<span<?= $Page->formulation->viewAttributes() ?>>
<?= $Page->formulation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
        <td<?= $Page->dose_interval->cellAttributes() ?>>
<span id="">
<span<?= $Page->dose_interval->viewAttributes() ?>>
<?= $Page->dose_interval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
        <td<?= $Page->number_of_days->cellAttributes() ?>>
<span id="">
<span<?= $Page->number_of_days->viewAttributes() ?>>
<?= $Page->number_of_days->getViewValue() ?></span>
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
