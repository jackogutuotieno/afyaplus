<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fpatientsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatientsdelete")
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
<form name="fpatientsdelete" id="fpatientsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patients">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_patients_id" class="patients_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <th class="<?= $Page->first_name->headerCellClass() ?>"><span id="elh_patients_first_name" class="patients_first_name"><?= $Page->first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <th class="<?= $Page->last_name->headerCellClass() ?>"><span id="elh_patients_last_name" class="patients_last_name"><?= $Page->last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
        <th class="<?= $Page->national_id->headerCellClass() ?>"><span id="elh_patients_national_id" class="patients_national_id"><?= $Page->national_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <th class="<?= $Page->date_of_birth->headerCellClass() ?>"><span id="elh_patients_date_of_birth" class="patients_date_of_birth"><?= $Page->date_of_birth->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th class="<?= $Page->gender->headerCellClass() ?>"><span id="elh_patients_gender" class="patients_gender"><?= $Page->gender->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_patients_phone" class="patients_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
        <th class="<?= $Page->email_address->headerCellClass() ?>"><span id="elh_patients_email_address" class="patients_email_address"><?= $Page->email_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
        <th class="<?= $Page->physical_address->headerCellClass() ?>"><span id="elh_patients_physical_address" class="patients_physical_address"><?= $Page->physical_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employment_status->Visible) { // employment_status ?>
        <th class="<?= $Page->employment_status->headerCellClass() ?>"><span id="elh_patients_employment_status" class="patients_employment_status"><?= $Page->employment_status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->religion->Visible) { // religion ?>
        <th class="<?= $Page->religion->headerCellClass() ?>"><span id="elh_patients_religion" class="patients_religion"><?= $Page->religion->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
        <th class="<?= $Page->next_of_kin->headerCellClass() ?>"><span id="elh_patients_next_of_kin" class="patients_next_of_kin"><?= $Page->next_of_kin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
        <th class="<?= $Page->next_of_kin_phone->headerCellClass() ?>"><span id="elh_patients_next_of_kin_phone" class="patients_next_of_kin_phone"><?= $Page->next_of_kin_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
        <th class="<?= $Page->marital_status->headerCellClass() ?>"><span id="elh_patients_marital_status" class="patients_marital_status"><?= $Page->marital_status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_patients_date_created" class="patients_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_patients_date_updated" class="patients_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->first_name->Visible) { // first_name ?>
        <td<?= $Page->first_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <td<?= $Page->last_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
        <td<?= $Page->national_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <td<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <td<?= $Page->gender->cellAttributes() ?>>
<span id="">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td<?= $Page->phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->phone->getViewValue()) && $Page->phone->linkAttributes() != "") { ?>
<a<?= $Page->phone->linkAttributes() ?>><?= $Page->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
        <td<?= $Page->email_address->cellAttributes() ?>>
<span id="">
<span<?= $Page->email_address->viewAttributes() ?>>
<?php if (!EmptyString($Page->email_address->getViewValue()) && $Page->email_address->linkAttributes() != "") { ?>
<a<?= $Page->email_address->linkAttributes() ?>><?= $Page->email_address->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->email_address->getViewValue() ?>
<?php } ?>
</span>
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
<?php if ($Page->employment_status->Visible) { // employment_status ?>
        <td<?= $Page->employment_status->cellAttributes() ?>>
<span id="">
<span<?= $Page->employment_status->viewAttributes() ?>>
<?= $Page->employment_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->religion->Visible) { // religion ?>
        <td<?= $Page->religion->cellAttributes() ?>>
<span id="">
<span<?= $Page->religion->viewAttributes() ?>>
<?= $Page->religion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
        <td<?= $Page->next_of_kin->cellAttributes() ?>>
<span id="">
<span<?= $Page->next_of_kin->viewAttributes() ?>>
<?= $Page->next_of_kin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
        <td<?= $Page->next_of_kin_phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->next_of_kin_phone->viewAttributes() ?>>
<?= $Page->next_of_kin_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
        <td<?= $Page->marital_status->cellAttributes() ?>>
<span id="">
<span<?= $Page->marital_status->viewAttributes() ?>>
<?= $Page->marital_status->getViewValue() ?></span>
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
