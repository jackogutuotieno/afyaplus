<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsView = &$Page;
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
<form name="fpatientsview" id="fpatientsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpatientsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatientsview")
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
<input type="hidden" name="t" value="patients">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_patients_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <tr id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_photo"><?= $Page->photo->caption() ?></span></td>
        <td data-name="photo"<?= $Page->photo->cellAttributes() ?>>
<span id="el_patients_photo">
<span<?= $Page->photo->viewAttributes() ?>>
<?= GetFileViewTag($Page->photo, $Page->photo->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <tr id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_first_name"><?= $Page->first_name->caption() ?></span></td>
        <td data-name="first_name"<?= $Page->first_name->cellAttributes() ?>>
<span id="el_patients_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <tr id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_last_name"><?= $Page->last_name->caption() ?></span></td>
        <td data-name="last_name"<?= $Page->last_name->cellAttributes() ?>>
<span id="el_patients_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
    <tr id="r_national_id"<?= $Page->national_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_national_id"><?= $Page->national_id->caption() ?></span></td>
        <td data-name="national_id"<?= $Page->national_id->cellAttributes() ?>>
<span id="el_patients_national_id">
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
    <tr id="r_date_of_birth"<?= $Page->date_of_birth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_date_of_birth"><?= $Page->date_of_birth->caption() ?></span></td>
        <td data-name="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el_patients_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_gender"><?= $Page->gender->caption() ?></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<span id="el_patients_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_patients_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
    <tr id="r_email_address"<?= $Page->email_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_email_address"><?= $Page->email_address->caption() ?></span></td>
        <td data-name="email_address"<?= $Page->email_address->cellAttributes() ?>>
<span id="el_patients_email_address">
<span<?= $Page->email_address->viewAttributes() ?>>
<?= $Page->email_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <tr id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_physical_address"><?= $Page->physical_address->caption() ?></span></td>
        <td data-name="physical_address"<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_patients_physical_address">
<span<?= $Page->physical_address->viewAttributes() ?>>
<?= $Page->physical_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employment_status->Visible) { // employment_status ?>
    <tr id="r_employment_status"<?= $Page->employment_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_employment_status"><?= $Page->employment_status->caption() ?></span></td>
        <td data-name="employment_status"<?= $Page->employment_status->cellAttributes() ?>>
<span id="el_patients_employment_status">
<span<?= $Page->employment_status->viewAttributes() ?>>
<?= $Page->employment_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->religion->Visible) { // religion ?>
    <tr id="r_religion"<?= $Page->religion->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_religion"><?= $Page->religion->caption() ?></span></td>
        <td data-name="religion"<?= $Page->religion->cellAttributes() ?>>
<span id="el_patients_religion">
<span<?= $Page->religion->viewAttributes() ?>>
<?= $Page->religion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
    <tr id="r_next_of_kin"<?= $Page->next_of_kin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_next_of_kin"><?= $Page->next_of_kin->caption() ?></span></td>
        <td data-name="next_of_kin"<?= $Page->next_of_kin->cellAttributes() ?>>
<span id="el_patients_next_of_kin">
<span<?= $Page->next_of_kin->viewAttributes() ?>>
<?= $Page->next_of_kin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
    <tr id="r_next_of_kin_phone"<?= $Page->next_of_kin_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_next_of_kin_phone"><?= $Page->next_of_kin_phone->caption() ?></span></td>
        <td data-name="next_of_kin_phone"<?= $Page->next_of_kin_phone->cellAttributes() ?>>
<span id="el_patients_next_of_kin_phone">
<span<?= $Page->next_of_kin_phone->viewAttributes() ?>>
<?= $Page->next_of_kin_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
    <tr id="r_marital_status"<?= $Page->marital_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_marital_status"><?= $Page->marital_status->caption() ?></span></td>
        <td data-name="marital_status"<?= $Page->marital_status->cellAttributes() ?>>
<span id="el_patients_marital_status">
<span<?= $Page->marital_status->viewAttributes() ?>>
<?= $Page->marital_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_patients_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_patients_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_patients_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
