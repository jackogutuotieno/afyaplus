<?php

namespace PHPMaker2024\afyaplus;

// Page object
$SuppliersView = &$Page;
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
<form name="fsuppliersview" id="fsuppliersview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { suppliers: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsuppliersview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsuppliersview")
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
<input type="hidden" name="t" value="suppliers">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_suppliers_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_suppliers_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supplier_name->Visible) { // supplier_name ?>
    <tr id="r_supplier_name"<?= $Page->supplier_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_suppliers_supplier_name"><?= $Page->supplier_name->caption() ?></span></td>
        <td data-name="supplier_name"<?= $Page->supplier_name->cellAttributes() ?>>
<span id="el_suppliers_supplier_name">
<span<?= $Page->supplier_name->viewAttributes() ?>>
<?= $Page->supplier_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_suppliers_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_suppliers_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->phone->getViewValue()) && $Page->phone->linkAttributes() != "") { ?>
<a<?= $Page->phone->linkAttributes() ?>><?= $Page->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
    <tr id="r_email_address"<?= $Page->email_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_suppliers_email_address"><?= $Page->email_address->caption() ?></span></td>
        <td data-name="email_address"<?= $Page->email_address->cellAttributes() ?>>
<span id="el_suppliers_email_address">
<span<?= $Page->email_address->viewAttributes() ?>>
<?php if (!EmptyString($Page->email_address->getViewValue()) && $Page->email_address->linkAttributes() != "") { ?>
<a<?= $Page->email_address->linkAttributes() ?>><?= $Page->email_address->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->email_address->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <tr id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_suppliers_physical_address"><?= $Page->physical_address->caption() ?></span></td>
        <td data-name="physical_address"<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_suppliers_physical_address">
<span<?= $Page->physical_address->viewAttributes() ?>>
<?= $Page->physical_address->getViewValue() ?></span>
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
