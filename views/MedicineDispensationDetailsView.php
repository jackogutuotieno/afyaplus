<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineDispensationDetailsView = &$Page;
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
<form name="fmedicine_dispensation_detailsview" id="fmedicine_dispensation_detailsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_dispensation_details: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmedicine_dispensation_detailsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_dispensation_detailsview")
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
<input type="hidden" name="t" value="medicine_dispensation_details">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_dispensation_details_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
    <tr id="r_medicine_dispensation_id"<?= $Page->medicine_dispensation_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_dispensation_details_medicine_dispensation_id"><?= $Page->medicine_dispensation_id->caption() ?></span></td>
        <td data-name="medicine_dispensation_id"<?= $Page->medicine_dispensation_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_medicine_dispensation_id">
<span<?= $Page->medicine_dispensation_id->viewAttributes() ?>>
<?= $Page->medicine_dispensation_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
    <tr id="r_medicine_stock_id"<?= $Page->medicine_stock_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_dispensation_details_medicine_stock_id"><?= $Page->medicine_stock_id->caption() ?></span></td>
        <td data-name="medicine_stock_id"<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_medicine_stock_id">
<span<?= $Page->medicine_stock_id->viewAttributes() ?>>
<?= $Page->medicine_stock_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_dispensation_details_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
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
