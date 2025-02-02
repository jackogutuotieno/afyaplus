<?php

namespace PHPMaker2024\afyaplus;

// Page object
$SubCountyView = &$Page;
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
<form name="fsub_countyview" id="fsub_countyview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sub_county: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsub_countyview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsub_countyview")
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
<input type="hidden" name="t" value="sub_county">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_county_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_sub_county_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->county_id->Visible) { // county_id ?>
    <tr id="r_county_id"<?= $Page->county_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_county_county_id"><?= $Page->county_id->caption() ?></span></td>
        <td data-name="county_id"<?= $Page->county_id->cellAttributes() ?>>
<span id="el_sub_county_county_id">
<span<?= $Page->county_id->viewAttributes() ?>>
<?= $Page->county_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
    <tr id="r_countyName"<?= $Page->countyName->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_county_countyName"><?= $Page->countyName->caption() ?></span></td>
        <td data-name="countyName"<?= $Page->countyName->cellAttributes() ?>>
<span id="el_sub_county_countyName">
<span<?= $Page->countyName->viewAttributes() ?>>
<?= $Page->countyName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
    <tr id="r_subCounty"<?= $Page->subCounty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_county_subCounty"><?= $Page->subCounty->caption() ?></span></td>
        <td data-name="subCounty"<?= $Page->subCounty->cellAttributes() ?>>
<span id="el_sub_county_subCounty">
<span<?= $Page->subCounty->viewAttributes() ?>>
<?= $Page->subCounty->getViewValue() ?></span>
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
