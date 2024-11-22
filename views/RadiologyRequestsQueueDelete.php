<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyRequestsQueueDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { radiology_requests_queue: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fradiology_requests_queuedelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_requests_queuedelete")
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
<form name="fradiology_requests_queuedelete" id="fradiology_requests_queuedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="radiology_requests_queue">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_radiology_requests_queue_id" class="radiology_requests_queue_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->radiology_request_id->Visible) { // radiology_request_id ?>
        <th class="<?= $Page->radiology_request_id->headerCellClass() ?>"><span id="elh_radiology_requests_queue_radiology_request_id" class="radiology_requests_queue_radiology_request_id"><?= $Page->radiology_request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->waiting_time->Visible) { // waiting_time ?>
        <th class="<?= $Page->waiting_time->headerCellClass() ?>"><span id="elh_radiology_requests_queue_waiting_time" class="radiology_requests_queue_waiting_time"><?= $Page->waiting_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->waiting_interval->Visible) { // waiting_interval ?>
        <th class="<?= $Page->waiting_interval->headerCellClass() ?>"><span id="elh_radiology_requests_queue_waiting_interval" class="radiology_requests_queue_waiting_interval"><?= $Page->waiting_interval->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_radiology_requests_queue_status" class="radiology_requests_queue_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <th class="<?= $Page->created_by_user_id->headerCellClass() ?>"><span id="elh_radiology_requests_queue_created_by_user_id" class="radiology_requests_queue_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_radiology_requests_queue_date_created" class="radiology_requests_queue_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_radiology_requests_queue_date_updated" class="radiology_requests_queue_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->radiology_request_id->Visible) { // radiology_request_id ?>
        <td<?= $Page->radiology_request_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->radiology_request_id->viewAttributes() ?>>
<?= $Page->radiology_request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->waiting_time->Visible) { // waiting_time ?>
        <td<?= $Page->waiting_time->cellAttributes() ?>>
<span id="">
<span<?= $Page->waiting_time->viewAttributes() ?>>
<?= $Page->waiting_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->waiting_interval->Visible) { // waiting_interval ?>
        <td<?= $Page->waiting_interval->cellAttributes() ?>>
<span id="">
<span<?= $Page->waiting_interval->viewAttributes() ?>>
<?= $Page->waiting_interval->getViewValue() ?></span>
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
