<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PrescriptionDetailsView = &$Page;
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
<form name="fprescription_detailsview" id="fprescription_detailsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { prescription_details: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fprescription_detailsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprescription_detailsview")
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
<input type="hidden" name="t" value="prescription_details">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_prescription_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prescription_id->Visible) { // prescription_id ?>
    <tr id="r_prescription_id"<?= $Page->prescription_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_prescription_id"><?= $Page->prescription_id->caption() ?></span></td>
        <td data-name="prescription_id"<?= $Page->prescription_id->cellAttributes() ?>>
<span id="el_prescription_details_prescription_id">
<span<?= $Page->prescription_id->viewAttributes() ?>>
<?= $Page->prescription_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
    <tr id="r_medicine_stock_id"<?= $Page->medicine_stock_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_medicine_stock_id"><?= $Page->medicine_stock_id->caption() ?></span></td>
        <td data-name="medicine_stock_id"<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el_prescription_details_medicine_stock_id">
<span<?= $Page->medicine_stock_id->viewAttributes() ?>>
<?= $Page->medicine_stock_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dose_quantity->Visible) { // dose_quantity ?>
    <tr id="r_dose_quantity"<?= $Page->dose_quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_dose_quantity"><?= $Page->dose_quantity->caption() ?></span></td>
        <td data-name="dose_quantity"<?= $Page->dose_quantity->cellAttributes() ?>>
<span id="el_prescription_details_dose_quantity">
<span<?= $Page->dose_quantity->viewAttributes() ?>>
<?= $Page->dose_quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dose_type->Visible) { // dose_type ?>
    <tr id="r_dose_type"<?= $Page->dose_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_dose_type"><?= $Page->dose_type->caption() ?></span></td>
        <td data-name="dose_type"<?= $Page->dose_type->cellAttributes() ?>>
<span id="el_prescription_details_dose_type">
<span<?= $Page->dose_type->viewAttributes() ?>>
<?= $Page->dose_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dose_interval->Visible) { // dose_interval ?>
    <tr id="r_dose_interval"<?= $Page->dose_interval->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_dose_interval"><?= $Page->dose_interval->caption() ?></span></td>
        <td data-name="dose_interval"<?= $Page->dose_interval->cellAttributes() ?>>
<span id="el_prescription_details_dose_interval">
<span<?= $Page->dose_interval->viewAttributes() ?>>
<?= $Page->dose_interval->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->number_of_days->Visible) { // number_of_days ?>
    <tr id="r_number_of_days"<?= $Page->number_of_days->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_number_of_days"><?= $Page->number_of_days->caption() ?></span></td>
        <td data-name="number_of_days"<?= $Page->number_of_days->cellAttributes() ?>>
<span id="el_prescription_details_number_of_days">
<span<?= $Page->number_of_days->viewAttributes() ?>>
<?= $Page->number_of_days->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
    <tr id="r_method"<?= $Page->method->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_prescription_details_method"><?= $Page->method->caption() ?></span></td>
        <td data-name="method"<?= $Page->method->cellAttributes() ?>>
<span id="el_prescription_details_method">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
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
