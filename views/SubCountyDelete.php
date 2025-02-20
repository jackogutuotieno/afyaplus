<?php

namespace PHPMaker2024\afyaplus;

// Page object
$SubCountyDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sub_county: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsub_countydelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsub_countydelete")
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
<form name="fsub_countydelete" id="fsub_countydelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sub_county">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_sub_county_id" class="sub_county_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->county_id->Visible) { // county_id ?>
        <th class="<?= $Page->county_id->headerCellClass() ?>"><span id="elh_sub_county_county_id" class="sub_county_county_id"><?= $Page->county_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
        <th class="<?= $Page->countyName->headerCellClass() ?>"><span id="elh_sub_county_countyName" class="sub_county_countyName"><?= $Page->countyName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
        <th class="<?= $Page->subCounty->headerCellClass() ?>"><span id="elh_sub_county_subCounty" class="sub_county_subCounty"><?= $Page->subCounty->caption() ?></span></th>
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
<?php if ($Page->county_id->Visible) { // county_id ?>
        <td<?= $Page->county_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->county_id->viewAttributes() ?>>
<?= $Page->county_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
        <td<?= $Page->countyName->cellAttributes() ?>>
<span id="">
<span<?= $Page->countyName->viewAttributes() ?>>
<?= $Page->countyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
        <td<?= $Page->subCounty->cellAttributes() ?>>
<span id="">
<span<?= $Page->subCounty->viewAttributes() ?>>
<?= $Page->subCounty->getViewValue() ?></span>
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
