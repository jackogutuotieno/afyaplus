<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineStockView = &$Page;
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
<form name="fmedicine_stockview" id="fmedicine_stockview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmedicine_stockview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_stockview")
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
<input type="hidden" name="t" value="medicine_stock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_medicine_stock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
    <tr id="r_supplier_id"<?= $Page->supplier_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_supplier_id"><?= $Page->supplier_id->caption() ?></span></td>
        <td data-name="supplier_id"<?= $Page->supplier_id->cellAttributes() ?>>
<span id="el_medicine_stock_supplier_id">
<span<?= $Page->supplier_id->viewAttributes() ?>>
<?= $Page->supplier_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->brand_id->Visible) { // brand_id ?>
    <tr id="r_brand_id"<?= $Page->brand_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_brand_id"><?= $Page->brand_id->caption() ?></span></td>
        <td data-name="brand_id"<?= $Page->brand_id->cellAttributes() ?>>
<span id="el_medicine_stock_brand_id">
<span<?= $Page->brand_id->viewAttributes() ?>>
<?= $Page->brand_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->batch_number->Visible) { // batch_number ?>
    <tr id="r_batch_number"<?= $Page->batch_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_batch_number"><?= $Page->batch_number->caption() ?></span></td>
        <td data-name="batch_number"<?= $Page->batch_number->cellAttributes() ?>>
<span id="el_medicine_stock_batch_number">
<span<?= $Page->batch_number->viewAttributes() ?>>
<?= $Page->batch_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_medicine_stock_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
    <tr id="r_measuring_unit"<?= $Page->measuring_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_measuring_unit"><?= $Page->measuring_unit->caption() ?></span></td>
        <td data-name="measuring_unit"<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_medicine_stock_measuring_unit">
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { // buying_price_per_unit ?>
    <tr id="r_buying_price_per_unit"<?= $Page->buying_price_per_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_buying_price_per_unit"><?= $Page->buying_price_per_unit->caption() ?></span></td>
        <td data-name="buying_price_per_unit"<?= $Page->buying_price_per_unit->cellAttributes() ?>>
<span id="el_medicine_stock_buying_price_per_unit">
<span<?= $Page->buying_price_per_unit->viewAttributes() ?>>
<?= $Page->buying_price_per_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
    <tr id="r_selling_price_per_unit"<?= $Page->selling_price_per_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_selling_price_per_unit"><?= $Page->selling_price_per_unit->caption() ?></span></td>
        <td data-name="selling_price_per_unit"<?= $Page->selling_price_per_unit->cellAttributes() ?>>
<span id="el_medicine_stock_selling_price_per_unit">
<span<?= $Page->selling_price_per_unit->viewAttributes() ?>>
<?= $Page->selling_price_per_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
    <tr id="r_expiry_date"<?= $Page->expiry_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_expiry_date"><?= $Page->expiry_date->caption() ?></span></td>
        <td data-name="expiry_date"<?= $Page->expiry_date->cellAttributes() ?>>
<span id="el_medicine_stock_expiry_date">
<span<?= $Page->expiry_date->viewAttributes() ?>>
<?= $Page->expiry_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_medicine_stock_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modified_by_user_id->Visible) { // modified_by_user_id ?>
    <tr id="r_modified_by_user_id"<?= $Page->modified_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_modified_by_user_id"><?= $Page->modified_by_user_id->caption() ?></span></td>
        <td data-name="modified_by_user_id"<?= $Page->modified_by_user_id->cellAttributes() ?>>
<span id="el_medicine_stock_modified_by_user_id">
<span<?= $Page->modified_by_user_id->viewAttributes() ?>>
<?= $Page->modified_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_medicine_stock_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_medicine_stock_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_medicine_stock_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
