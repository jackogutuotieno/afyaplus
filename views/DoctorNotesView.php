<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DoctorNotesView = &$Page;
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
<form name="fdoctor_notesview" id="fdoctor_notesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { doctor_notes: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fdoctor_notesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdoctor_notesview")
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
<input type="hidden" name="t" value="doctor_notes">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_doctor_notes_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_doctor_notes_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_visit_id"><?= $Page->visit_id->caption() ?></span></td>
        <td data-name="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<span id="el_doctor_notes_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->chief_complaint->Visible) { // chief_complaint ?>
    <tr id="r_chief_complaint"<?= $Page->chief_complaint->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_chief_complaint"><?= $Page->chief_complaint->caption() ?></span></td>
        <td data-name="chief_complaint"<?= $Page->chief_complaint->cellAttributes() ?>>
<span id="el_doctor_notes_chief_complaint">
<span<?= $Page->chief_complaint->viewAttributes() ?>>
<?= $Page->chief_complaint->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
    <tr id="r_history_of_presenting_illness"<?= $Page->history_of_presenting_illness->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_history_of_presenting_illness"><?= $Page->history_of_presenting_illness->caption() ?></span></td>
        <td data-name="history_of_presenting_illness"<?= $Page->history_of_presenting_illness->cellAttributes() ?>>
<span id="el_doctor_notes_history_of_presenting_illness">
<span<?= $Page->history_of_presenting_illness->viewAttributes() ?>>
<?= $Page->history_of_presenting_illness->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->past_medical_history->Visible) { // past_medical_history ?>
    <tr id="r_past_medical_history"<?= $Page->past_medical_history->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_past_medical_history"><?= $Page->past_medical_history->caption() ?></span></td>
        <td data-name="past_medical_history"<?= $Page->past_medical_history->cellAttributes() ?>>
<span id="el_doctor_notes_past_medical_history">
<span<?= $Page->past_medical_history->viewAttributes() ?>>
<?= $Page->past_medical_history->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->family_history->Visible) { // family_history ?>
    <tr id="r_family_history"<?= $Page->family_history->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_family_history"><?= $Page->family_history->caption() ?></span></td>
        <td data-name="family_history"<?= $Page->family_history->cellAttributes() ?>>
<span id="el_doctor_notes_family_history">
<span<?= $Page->family_history->viewAttributes() ?>>
<?= $Page->family_history->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->allergies->Visible) { // allergies ?>
    <tr id="r_allergies"<?= $Page->allergies->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_allergies"><?= $Page->allergies->caption() ?></span></td>
        <td data-name="allergies"<?= $Page->allergies->cellAttributes() ?>>
<span id="el_doctor_notes_allergies">
<span<?= $Page->allergies->viewAttributes() ?>>
<?= $Page->allergies->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_doctor_notes_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_doctor_notes_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_doctor_notes_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_doctor_notes_date_updated">
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
