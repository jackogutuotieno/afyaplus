<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DoctorNotesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { doctor_notes: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fdoctor_notesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdoctor_notesdelete")
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
<form name="fdoctor_notesdelete" id="fdoctor_notesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="doctor_notes">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_doctor_notes_id" class="doctor_notes_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <th class="<?= $Page->patient_id->headerCellClass() ?>"><span id="elh_doctor_notes_patient_id" class="doctor_notes_patient_id"><?= $Page->patient_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
        <th class="<?= $Page->visit_id->headerCellClass() ?>"><span id="elh_doctor_notes_visit_id" class="doctor_notes_visit_id"><?= $Page->visit_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->chief_complaint->Visible) { // chief_complaint ?>
        <th class="<?= $Page->chief_complaint->headerCellClass() ?>"><span id="elh_doctor_notes_chief_complaint" class="doctor_notes_chief_complaint"><?= $Page->chief_complaint->caption() ?></span></th>
<?php } ?>
<?php if ($Page->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
        <th class="<?= $Page->history_of_presenting_illness->headerCellClass() ?>"><span id="elh_doctor_notes_history_of_presenting_illness" class="doctor_notes_history_of_presenting_illness"><?= $Page->history_of_presenting_illness->caption() ?></span></th>
<?php } ?>
<?php if ($Page->past_medical_history->Visible) { // past_medical_history ?>
        <th class="<?= $Page->past_medical_history->headerCellClass() ?>"><span id="elh_doctor_notes_past_medical_history" class="doctor_notes_past_medical_history"><?= $Page->past_medical_history->caption() ?></span></th>
<?php } ?>
<?php if ($Page->family_history->Visible) { // family_history ?>
        <th class="<?= $Page->family_history->headerCellClass() ?>"><span id="elh_doctor_notes_family_history" class="doctor_notes_family_history"><?= $Page->family_history->caption() ?></span></th>
<?php } ?>
<?php if ($Page->allergies->Visible) { // allergies ?>
        <th class="<?= $Page->allergies->headerCellClass() ?>"><span id="elh_doctor_notes_allergies" class="doctor_notes_allergies"><?= $Page->allergies->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
        <th class="<?= $Page->created_by_user_id->headerCellClass() ?>"><span id="elh_doctor_notes_created_by_user_id" class="doctor_notes_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_doctor_notes_date_created" class="doctor_notes_date_created"><?= $Page->date_created->caption() ?></span></th>
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
<?php if ($Page->patient_id->Visible) { // patient_id ?>
        <td<?= $Page->patient_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
        <td<?= $Page->visit_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->chief_complaint->Visible) { // chief_complaint ?>
        <td<?= $Page->chief_complaint->cellAttributes() ?>>
<span id="">
<span<?= $Page->chief_complaint->viewAttributes() ?>>
<?= $Page->chief_complaint->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
        <td<?= $Page->history_of_presenting_illness->cellAttributes() ?>>
<span id="">
<span<?= $Page->history_of_presenting_illness->viewAttributes() ?>>
<?= $Page->history_of_presenting_illness->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->past_medical_history->Visible) { // past_medical_history ?>
        <td<?= $Page->past_medical_history->cellAttributes() ?>>
<span id="">
<span<?= $Page->past_medical_history->viewAttributes() ?>>
<?= $Page->past_medical_history->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->family_history->Visible) { // family_history ?>
        <td<?= $Page->family_history->cellAttributes() ?>>
<span id="">
<span<?= $Page->family_history->viewAttributes() ?>>
<?= $Page->family_history->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->allergies->Visible) { // allergies ?>
        <td<?= $Page->allergies->cellAttributes() ?>>
<span id="">
<span<?= $Page->allergies->viewAttributes() ?>>
<?= $Page->allergies->getViewValue() ?></span>
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
