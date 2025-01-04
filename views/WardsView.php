<?php

namespace PHPMaker2024\afyaplus;

// Page object
$WardsView = &$Page;
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
<form name="fwardsview" id="fwardsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { wards: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fwardsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fwardsview")
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
<input type="hidden" name="t" value="wards">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_wards_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_wards_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->floor_id->Visible) { // floor_id ?>
    <tr id="r_floor_id"<?= $Page->floor_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_wards_floor_id"><?= $Page->floor_id->caption() ?></span></td>
        <td data-name="floor_id"<?= $Page->floor_id->cellAttributes() ?>>
<span id="el_wards_floor_id">
<span<?= $Page->floor_id->viewAttributes() ?>>
<?= $Page->floor_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
    <tr id="r_ward_type_id"<?= $Page->ward_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_wards_ward_type_id"><?= $Page->ward_type_id->caption() ?></span></td>
        <td data-name="ward_type_id"<?= $Page->ward_type_id->cellAttributes() ?>>
<span id="el_wards_ward_type_id">
<span<?= $Page->ward_type_id->viewAttributes() ?>>
<?= $Page->ward_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ward_name->Visible) { // ward_name ?>
    <tr id="r_ward_name"<?= $Page->ward_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_wards_ward_name"><?= $Page->ward_name->caption() ?></span></td>
        <td data-name="ward_name"<?= $Page->ward_name->cellAttributes() ?>>
<span id="el_wards_ward_name">
<span<?= $Page->ward_name->viewAttributes() ?>>
<?= $Page->ward_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("beds", explode(",", $Page->getCurrentDetailTable())) && $beds->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("beds", "TblCaption") ?>&nbsp;<?= str_replace("%s", "red", str_replace("%c", Container("beds")->Count, $Language->phrase("DetailCount"))) ?></h4>
<?php } ?>
<?php include_once "BedsGrid.php" ?>
<?php } ?>
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
