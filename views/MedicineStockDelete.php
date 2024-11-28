<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineStockDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_stock: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmedicine_stockdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_stockdelete")
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
<form name="fmedicine_stockdelete" id="fmedicine_stockdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medicine_stock">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_medicine_stock_id" class="medicine_stock_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
        <th class="<?= $Page->supplier_id->headerCellClass() ?>"><span id="elh_medicine_stock_supplier_id" class="medicine_stock_supplier_id"><?= $Page->supplier_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->brand_id->Visible) { // brand_id ?>
        <th class="<?= $Page->brand_id->headerCellClass() ?>"><span id="elh_medicine_stock_brand_id" class="medicine_stock_brand_id"><?= $Page->brand_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->batch_number->Visible) { // batch_number ?>
        <th class="<?= $Page->batch_number->headerCellClass() ?>"><span id="elh_medicine_stock_batch_number" class="medicine_stock_batch_number"><?= $Page->batch_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_medicine_stock_quantity" class="medicine_stock_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity_left->Visible) { // quantity_left ?>
        <th class="<?= $Page->quantity_left->headerCellClass() ?>"><span id="elh_medicine_stock_quantity_left" class="medicine_stock_quantity_left"><?= $Page->quantity_left->caption() ?></span></th>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <th class="<?= $Page->measuring_unit->headerCellClass() ?>"><span id="elh_medicine_stock_measuring_unit" class="medicine_stock_measuring_unit"><?= $Page->measuring_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { // buying_price_per_unit ?>
        <th class="<?= $Page->buying_price_per_unit->headerCellClass() ?>"><span id="elh_medicine_stock_buying_price_per_unit" class="medicine_stock_buying_price_per_unit"><?= $Page->buying_price_per_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <th class="<?= $Page->selling_price_per_unit->headerCellClass() ?>"><span id="elh_medicine_stock_selling_price_per_unit" class="medicine_stock_selling_price_per_unit"><?= $Page->selling_price_per_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
        <th class="<?= $Page->expiry_date->headerCellClass() ?>"><span id="elh_medicine_stock_expiry_date" class="medicine_stock_expiry_date"><?= $Page->expiry_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_medicine_stock_date_created" class="medicine_stock_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_medicine_stock_date_updated" class="medicine_stock_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
        <td<?= $Page->supplier_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->supplier_id->viewAttributes() ?>>
<?= $Page->supplier_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->brand_id->Visible) { // brand_id ?>
        <td<?= $Page->brand_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->brand_id->viewAttributes() ?>>
<?= $Page->brand_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->batch_number->Visible) { // batch_number ?>
        <td<?= $Page->batch_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->batch_number->viewAttributes() ?>>
<?= $Page->batch_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity_left->Visible) { // quantity_left ?>
        <td<?= $Page->quantity_left->cellAttributes() ?>>
<span id="">
<span<?= $Page->quantity_left->viewAttributes() ?>>
<?= $Page->quantity_left->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <td<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="">
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { // buying_price_per_unit ?>
        <td<?= $Page->buying_price_per_unit->cellAttributes() ?>>
<span id="">
<span<?= $Page->buying_price_per_unit->viewAttributes() ?>>
<?= $Page->buying_price_per_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { // selling_price_per_unit ?>
        <td<?= $Page->selling_price_per_unit->cellAttributes() ?>>
<span id="">
<span<?= $Page->selling_price_per_unit->viewAttributes() ?>>
<?= $Page->selling_price_per_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
        <td<?= $Page->expiry_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->expiry_date->viewAttributes() ?>>
<?= $Page->expiry_date->getViewValue() ?></span>
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
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
