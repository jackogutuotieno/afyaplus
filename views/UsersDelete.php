<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UsersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fusersdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusersdelete")
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
<form name="fusersdelete" id="fusersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
        <th class="<?= $Page->photo->headerCellClass() ?>"><span id="elh_users_photo" class="users_photo"><?= $Page->photo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->full_name->Visible) { // full_name ?>
        <th class="<?= $Page->full_name->headerCellClass() ?>"><span id="elh_users_full_name" class="users_full_name"><?= $Page->full_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
        <th class="<?= $Page->national_id->headerCellClass() ?>"><span id="elh_users_national_id" class="users_national_id"><?= $Page->national_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th class="<?= $Page->gender->headerCellClass() ?>"><span id="elh_users_gender" class="users_gender"><?= $Page->gender->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_users_phone" class="users_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_users__email" class="users__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->department_id->Visible) { // department_id ?>
        <th class="<?= $Page->department_id->headerCellClass() ?>"><span id="elh_users_department_id" class="users_department_id"><?= $Page->department_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->designation_id->Visible) { // designation_id ?>
        <th class="<?= $Page->designation_id->headerCellClass() ?>"><span id="elh_users_designation_id" class="users_designation_id"><?= $Page->designation_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
        <th class="<?= $Page->physical_address->headerCellClass() ?>"><span id="elh_users_physical_address" class="users_physical_address"><?= $Page->physical_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_role_id->Visible) { // user_role_id ?>
        <th class="<?= $Page->user_role_id->headerCellClass() ?>"><span id="elh_users_user_role_id" class="users_user_role_id"><?= $Page->user_role_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <th class="<?= $Page->is_verified->headerCellClass() ?>"><span id="elh_users_is_verified" class="users_is_verified"><?= $Page->is_verified->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_users_date_created" class="users_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_users_date_updated" class="users_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->photo->Visible) { // photo ?>
        <td<?= $Page->photo->cellAttributes() ?>>
<span id="">
<span>
<?= GetFileViewTag($Page->photo, $Page->photo->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->full_name->Visible) { // full_name ?>
        <td<?= $Page->full_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->full_name->viewAttributes() ?>>
<?= $Page->full_name->getViewValue() ?></span>
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
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="">
<span<?= $Page->_email->viewAttributes() ?>>
<?php if (!EmptyString($Page->_email->getViewValue()) && $Page->_email->linkAttributes() != "") { ?>
<a<?= $Page->_email->linkAttributes() ?>><?= $Page->_email->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->_email->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->department_id->Visible) { // department_id ?>
        <td<?= $Page->department_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->department_id->viewAttributes() ?>>
<?= $Page->department_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->designation_id->Visible) { // designation_id ?>
        <td<?= $Page->designation_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->designation_id->viewAttributes() ?>>
<?= $Page->designation_id->getViewValue() ?></span>
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
<?php if ($Page->user_role_id->Visible) { // user_role_id ?>
        <td<?= $Page->user_role_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->user_role_id->viewAttributes() ?>>
<?= $Page->user_role_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_verified->Visible) { // is_verified ?>
        <td<?= $Page->is_verified->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_verified->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_is_verified_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->is_verified->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_verified->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_is_verified_<?= $Page->RowCount ?>"></label>
</div>
</span>
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
