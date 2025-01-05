<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ItemPurchasesView = &$Page;
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
<form name="fitem_purchasesview" id="fitem_purchasesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { item_purchases: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fitem_purchasesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitem_purchasesview")
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
<input type="hidden" name="t" value="item_purchases">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_item_purchases_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supplier_id->Visible) { // supplier_id ?>
    <tr id="r_supplier_id"<?= $Page->supplier_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_supplier_id"><?= $Page->supplier_id->caption() ?></span></td>
        <td data-name="supplier_id"<?= $Page->supplier_id->cellAttributes() ?>>
<span id="el_item_purchases_supplier_id">
<span<?= $Page->supplier_id->viewAttributes() ?>>
<?= $Page->supplier_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <tr id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_category_id"><?= $Page->category_id->caption() ?></span></td>
        <td data-name="category_id"<?= $Page->category_id->cellAttributes() ?>>
<span id="el_item_purchases_category_id">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subcategory_id->Visible) { // subcategory_id ?>
    <tr id="r_subcategory_id"<?= $Page->subcategory_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_subcategory_id"><?= $Page->subcategory_id->caption() ?></span></td>
        <td data-name="subcategory_id"<?= $Page->subcategory_id->cellAttributes() ?>>
<span id="el_item_purchases_subcategory_id">
<span<?= $Page->subcategory_id->viewAttributes() ?>>
<?= $Page->subcategory_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->item_title->Visible) { // item_title ?>
    <tr id="r_item_title"<?= $Page->item_title->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_item_title"><?= $Page->item_title->caption() ?></span></td>
        <td data-name="item_title"<?= $Page->item_title->cellAttributes() ?>>
<span id="el_item_purchases_item_title">
<span<?= $Page->item_title->viewAttributes() ?>>
<?= $Page->item_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_item_purchases_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { // measuring_unit ?>
    <tr id="r_measuring_unit"<?= $Page->measuring_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_measuring_unit"><?= $Page->measuring_unit->caption() ?></span></td>
        <td data-name="measuring_unit"<?= $Page->measuring_unit->cellAttributes() ?>>
<span id="el_item_purchases_measuring_unit">
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
    <tr id="r_unit_price"<?= $Page->unit_price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_item_purchases_unit_price"><?= $Page->unit_price->caption() ?></span></td>
        <td data-name="unit_price"<?= $Page->unit_price->cellAttributes() ?>>
<span id="el_item_purchases_unit_price">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
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
