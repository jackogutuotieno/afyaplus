<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RadiologyReportsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { radiology_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fradiology_reportsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fradiology_reportsdelete")
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
<form name="fradiology_reportsdelete" id="fradiology_reportsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="radiology_reports">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_radiology_reports_id" class="radiology_reports_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
        <th class="<?= $Page->lab_test_request_id->headerCellClass() ?>"><span id="elh_radiology_reports_lab_test_request_id" class="radiology_reports_lab_test_request_id"><?= $Page->lab_test_request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->report_title->Visible) { // report_title ?>
        <th class="<?= $Page->report_title->headerCellClass() ?>"><span id="elh_radiology_reports_report_title" class="radiology_reports_report_title"><?= $Page->report_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
        <th class="<?= $Page->details->headerCellClass() ?>"><span id="elh_radiology_reports_details" class="radiology_reports_details"><?= $Page->details->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <th class="<?= $Page->created_by_user_id->headerCellClass() ?>"><span id="elh_radiology_reports_created_by_user_id" class="radiology_reports_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_radiology_reports_date_created" class="radiology_reports_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_radiology_reports_date_updated" class="radiology_reports_date_updated"><?= $Page->date_updated->caption() ?></span></th>
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
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
        <td<?= $Page->lab_test_request_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->lab_test_request_id->viewAttributes() ?>>
<?= $Page->lab_test_request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->report_title->Visible) { // report_title ?>
        <td<?= $Page->report_title->cellAttributes() ?>>
<span id="">
<span<?= $Page->report_title->viewAttributes() ?>>
<?= $Page->report_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
        <td<?= $Page->details->cellAttributes() ?>>
<span id="">
<span<?= $Page->details->viewAttributes() ?>>
<?= $Page->details->getViewValue() ?></span>
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
