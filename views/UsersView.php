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
<?php if ($Page->full_name->Visible) { // full_name ?>
    <tr id="r_full_name"<?= $Page->full_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_full_name"><?= $Page->full_name->caption() ?></span></td>
        <td data-name="full_name"<?= $Page->full_name->cellAttributes() ?>>
<span id="el_users_full_name">
<span<?= $Page->full_name->viewAttributes() ?>>
<?= $Page->full_name->getViewValue() ?></span>
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
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?php if (!EmptyString($Page->_email->getViewValue()) && $Page->_email->linkAttributes() != "") { ?>
<a<?= $Page->_email->linkAttributes() ?>><?= $Page->_email->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->_email->getViewValue() ?>
<?php } ?>
</span>
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
<?php if ($Page->is_verified->Visible) { // is_verified ?>
    <tr id="r_is_verified"<?= $Page->is_verified->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_is_verified"><?= $Page->is_verified->caption() ?></span></td>
        <td data-name="is_verified"<?= $Page->is_verified->cellAttributes() ?>>
<span id="el_users_is_verified">
<span<?= $Page->is_verified->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_is_verified_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->is_verified->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_verified->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_is_verified_<?= $Page->RowCount ?>"></label>
</div>
</span>
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
