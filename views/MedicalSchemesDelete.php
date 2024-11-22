<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicalSchemesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medical_schemes: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmedical_schemesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedical_schemesdelete")
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
<form name="fmedical_schemesdelete" id="fmedical_schemesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medical_schemes">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_medical_schemes_id" class="medical_schemes_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company->Visible) { // company ?>
        <th class="<?= $Page->company->headerCellClass() ?>"><span id="elh_medical_schemes_company" class="medical_schemes_company"><?= $Page->company->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_medical_schemes_phone" class="medical_schemes_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
        <th class="<?= $Page->email_address->headerCellClass() ?>"><span id="elh_medical_schemes_email_address" class="medical_schemes_email_address"><?= $Page->email_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
        <th class="<?= $Page->physical_address->headerCellClass() ?>"><span id="elh_medical_schemes_physical_address" class="medical_schemes_physical_address"><?= $Page->physical_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <th class="<?= $Page->created_by_user_id->headerCellClass() ?>"><span id="elh_medical_schemes_created_by_user_id" class="medical_schemes_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_medical_schemes_date_created" class="medical_schemes_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_medical_schemes_date_updated" class="medical_schemes_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->company->Visible) { // company ?>
        <td<?= $Page->company->cellAttributes() ?>>
<span id="">
<span<?= $Page->company->viewAttributes() ?>>
<?= $Page->company->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td<?= $Page->phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
        <td<?= $Page->email_address->cellAttributes() ?>>
<span id="">
<span<?= $Page->email_address->viewAttributes() ?>>
<?= $Page->email_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
        <td<?= $Page->physical_address->cellAttributes() ?>>
<span id="">
<span<?= $Page->physical_address->viewAttributes() ?>>
<?= $Page->physical_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <td<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
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
