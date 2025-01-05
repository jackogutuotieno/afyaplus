<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ItemPurchasesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item_purchases: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fitem_purchasesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitem_purchasesdelete")
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
<form name="fitem_purchasesdelete" id="fitem_purchasesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="item_purchases">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_item_purchases_id" class="item_purchases_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <th class="<?= $Page->category_id->headerCellClass() ?>"><span id="elh_item_purchases_category_id" class="item_purchases_category_id"><?= $Page->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
        <th class="<?= $Page->subcategory_id->headerCellClass() ?>"><span id="elh_item_purchases_subcategory_id" class="item_purchases_subcategory_id"><?= $Page->subcategory_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->item_title->Visible) { // item_title ?>
        <th class="<?= $Page->item_title->headerCellClass() ?>"><span id="elh_item_purchases_item_title" class="item_purchases_item_title"><?= $Page->item_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_item_purchases_quantity" class="item_purchases_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <th class="<?= $Page->measuring_unit->headerCellClass() ?>"><span id="elh_item_purchases_measuring_unit" class="item_purchases_measuring_unit"><?= $Page->measuring_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <th class="<?= $Page->unit_price->headerCellClass() ?>"><span id="elh_item_purchases_unit_price" class="item_purchases_unit_price"><?= $Page->unit_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
        <th class="<?= $Page->selling_price->headerCellClass() ?>"><span id="elh_item_purchases_selling_price" class="item_purchases_selling_price"><?= $Page->selling_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <th class="<?= $Page->amount_paid->headerCellClass() ?>"><span id="elh_item_purchases_amount_paid" class="item_purchases_amount_paid"><?= $Page->amount_paid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_item_purchases_date_created" class="item_purchases_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_item_purchases_date_updated" class="item_purchases_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->category_id->Visible) { // category_id ?>
        <td<?= $Page->category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
        <td<?= $Page->subcategory_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->subcategory_id->viewAttributes() ?>>
<?= $Page->subcategory_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->item_title->Visible) { // item_title ?>
        <td<?= $Page->item_title->cellAttributes() ?>>
<span id="">
<span<?= $Page->item_title->viewAttributes() ?>>
<?= $Page->item_title->getViewValue() ?></span>
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
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
        <td<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="">
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <td<?= $Page->unit_price->cellAttributes() ?>>
<span id="">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->selling_price->Visible) { // selling_price ?>
        <td<?= $Page->selling_price->cellAttributes() ?>>
<span id="">
<span<?= $Page->selling_price->viewAttributes() ?>>
<?= $Page->selling_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <td<?= $Page->amount_paid->cellAttributes() ?>>
<span id="">
<span<?= $Page->amount_paid->viewAttributes() ?>>
<?= $Page->amount_paid->getViewValue() ?></span>
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
