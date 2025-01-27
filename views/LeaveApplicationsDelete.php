<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LeaveApplicationsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { leave_applications: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fleave_applicationsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_applicationsdelete")
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
<form name="fleave_applicationsdelete" id="fleave_applicationsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
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
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_leave_applications_user_id" class="leave_applications_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->leave_category_id->Visible) { // leave_category_id ?>
        <th class="<?= $Page->leave_category_id->headerCellClass() ?>"><span id="elh_leave_applications_leave_category_id" class="leave_applications_leave_category_id"><?= $Page->leave_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->start_from_date->Visible) { // start_from_date ?>
        <th class="<?= $Page->start_from_date->headerCellClass() ?>"><span id="elh_leave_applications_start_from_date" class="leave_applications_start_from_date"><?= $Page->start_from_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->days_applied->Visible) { // days_applied ?>
        <th class="<?= $Page->days_applied->headerCellClass() ?>"><span id="elh_leave_applications_days_applied" class="leave_applications_days_applied"><?= $Page->days_applied->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reporting_date->Visible) { // reporting_date ?>
        <th class="<?= $Page->reporting_date->headerCellClass() ?>"><span id="elh_leave_applications_reporting_date" class="leave_applications_reporting_date"><?= $Page->reporting_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_leave_applications_status" class="leave_applications_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_leave_applications_date_created" class="leave_applications_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_leave_applications_date_updated" class="leave_applications_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->leave_category_id->Visible) { // leave_category_id ?>
        <td<?= $Page->leave_category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->leave_category_id->viewAttributes() ?>>
<?= $Page->leave_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->start_from_date->Visible) { // start_from_date ?>
        <td<?= $Page->start_from_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->start_from_date->viewAttributes() ?>>
<?= $Page->start_from_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->days_applied->Visible) { // days_applied ?>
        <td<?= $Page->days_applied->cellAttributes() ?>>
<span id="">
<span<?= $Page->days_applied->viewAttributes() ?>>
<?= $Page->days_applied->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reporting_date->Visible) { // reporting_date ?>
        <td<?= $Page->reporting_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->reporting_date->viewAttributes() ?>>
<?= $Page->reporting_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
