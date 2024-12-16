<?php

namespace PHPMaker2024\afyaplus;

// Page object
$InvoiceDetailsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { invoice_details: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var finvoice_detailsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoice_detailsdelete")
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
<form name="finvoice_detailsdelete" id="finvoice_detailsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="invoice_details">
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
<?php if ($Page->item->Visible) { // item ?>
        <th class="<?= $Page->item->headerCellClass() ?>"><span id="elh_invoice_details_item" class="invoice_details_item"><?= $Page->item->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_invoice_details_quantity" class="invoice_details_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cost->Visible) { // cost ?>
        <th class="<?= $Page->cost->headerCellClass() ?>"><span id="elh_invoice_details_cost" class="invoice_details_cost"><?= $Page->cost->caption() ?></span></th>
<?php } ?>
<?php if ($Page->line_total->Visible) { // line_total ?>
        <th class="<?= $Page->line_total->headerCellClass() ?>"><span id="elh_invoice_details_line_total" class="invoice_details_line_total"><?= $Page->line_total->caption() ?></span></th>
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
<?php if ($Page->item->Visible) { // item ?>
        <td<?= $Page->item->cellAttributes() ?>>
<span id="">
<span<?= $Page->item->viewAttributes() ?>>
<?= $Page->item->getViewValue() ?></span>
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
<?php if ($Page->cost->Visible) { // cost ?>
        <td<?= $Page->cost->cellAttributes() ?>>
<span id="">
<span<?= $Page->cost->viewAttributes() ?>>
<?= $Page->cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->line_total->Visible) { // line_total ?>
        <td<?= $Page->line_total->cellAttributes() ?>>
<span id="">
<span<?= $Page->line_total->viewAttributes() ?>>
<?= $Page->line_total->getViewValue() ?></span>
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
