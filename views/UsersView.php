<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UsersView = &$Page;
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
<form name="fusersview" id="fusersview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fusersview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusersview")
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
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <tr id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_photo"><?= $Page->photo->caption() ?></span></td>
        <td data-name="photo"<?= $Page->photo->cellAttributes() ?>>
<span id="el_users_photo">
<span<?= $Page->photo->viewAttributes() ?>>
<?= GetFileViewTag($Page->photo, $Page->photo->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <tr id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_first_name"><?= $Page->first_name->caption() ?></span></td>
        <td data-name="first_name"<?= $Page->first_name->cellAttributes() ?>>
<span id="el_users_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <tr id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_last_name"><?= $Page->last_name->caption() ?></span></td>
        <td data-name="last_name"<?= $Page->last_name->cellAttributes() ?>>
<span id="el_users_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
    <tr id="r_national_id"<?= $Page->national_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_national_id"><?= $Page->national_id->caption() ?></span></td>
        <td data-name="national_id"<?= $Page->national_id->cellAttributes() ?>>
<span id="el_users_national_id">
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <tr id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_gender"><?= $Page->gender->caption() ?></span></td>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<span id="el_users_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_users_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->department_id->Visible) { // department_id ?>
    <tr id="r_department_id"<?= $Page->department_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_department_id"><?= $Page->department_id->caption() ?></span></td>
        <td data-name="department_id"<?= $Page->department_id->cellAttributes() ?>>
<span id="el_users_department_id">
<span<?= $Page->department_id->viewAttributes() ?>>
<?= $Page->department_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->designation_id->Visible) { // designation_id ?>
    <tr id="r_designation_id"<?= $Page->designation_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_designation_id"><?= $Page->designation_id->caption() ?></span></td>
        <td data-name="designation_id"<?= $Page->designation_id->cellAttributes() ?>>
<span id="el_users_designation_id">
<span<?= $Page->designation_id->viewAttributes() ?>>
<?= $Page->designation_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <tr id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_physical_address"><?= $Page->physical_address->caption() ?></span></td>
        <td data-name="physical_address"<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_users_physical_address">
<span<?= $Page->physical_address->viewAttributes() ?>>
<?= $Page->physical_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <tr id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users__password"><?= $Page->_password->caption() ?></span></td>
        <td data-name="_password"<?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_role_id->Visible) { // user_role_id ?>
    <tr id="r_user_role_id"<?= $Page->user_role_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_user_role_id"><?= $Page->user_role_id->caption() ?></span></td>
        <td data-name="user_role_id"<?= $Page->user_role_id->cellAttributes() ?>>
<span id="el_users_user_role_id">
<span<?= $Page->user_role_id->viewAttributes() ?>>
<?= $Page->user_role_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_status->Visible) { // account_status ?>
    <tr id="r_account_status"<?= $Page->account_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_account_status"><?= $Page->account_status->caption() ?></span></td>
        <td data-name="account_status"<?= $Page->account_status->cellAttributes() ?>>
<span id="el_users_account_status">
<span<?= $Page->account_status->viewAttributes() ?>>
<?= $Page->account_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_users_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_users_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->otp_code->Visible) { // otp_code ?>
    <tr id="r_otp_code"<?= $Page->otp_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_otp_code"><?= $Page->otp_code->caption() ?></span></td>
        <td data-name="otp_code"<?= $Page->otp_code->cellAttributes() ?>>
<span id="el_users_otp_code">
<span<?= $Page->otp_code->viewAttributes() ?>>
<?= $Page->otp_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->otp_date->Visible) { // otp_date ?>
    <tr id="r_otp_date"<?= $Page->otp_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_otp_date"><?= $Page->otp_date->caption() ?></span></td>
        <td data-name="otp_date"<?= $Page->otp_date->cellAttributes() ?>>
<span id="el_users_otp_date">
<span<?= $Page->otp_date->viewAttributes() ?>>
<?= $Page->otp_date->getViewValue() ?></span>
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
