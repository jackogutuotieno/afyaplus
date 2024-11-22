<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DiagnosisView = &$Page;
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
<form name="fdiagnosisview" id="fdiagnosisview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { diagnosis: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fdiagnosisview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdiagnosisview")
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
<input type="hidden" name="t" value="diagnosis">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_diagnosis_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <tr id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_patient_id"><?= $Page->patient_id->caption() ?></span></td>
        <td data-name="patient_id"<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_diagnosis_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<?= $Page->patient_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_visit_id"><?= $Page->visit_id->caption() ?></span></td>
        <td data-name="visit_id"<?= $Page->visit_id->cellAttributes() ?>>
<span id="el_diagnosis_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->report_id->Visible) { // report_id ?>
    <tr id="r_report_id"<?= $Page->report_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_report_id"><?= $Page->report_id->caption() ?></span></td>
        <td data-name="report_id"<?= $Page->report_id->cellAttributes() ?>>
<span id="el_diagnosis_report_id">
<span<?= $Page->report_id->viewAttributes() ?>>
<?= $Page->report_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disease_id->Visible) { // disease_id ?>
    <tr id="r_disease_id"<?= $Page->disease_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_disease_id"><?= $Page->disease_id->caption() ?></span></td>
        <td data-name="disease_id"<?= $Page->disease_id->cellAttributes() ?>>
<span id="el_diagnosis_disease_id">
<span<?= $Page->disease_id->viewAttributes() ?>>
<?= $Page->disease_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->additional_findings->Visible) { // additional_findings ?>
    <tr id="r_additional_findings"<?= $Page->additional_findings->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_additional_findings"><?= $Page->additional_findings->caption() ?></span></td>
        <td data-name="additional_findings"<?= $Page->additional_findings->cellAttributes() ?>>
<span id="el_diagnosis_additional_findings">
<span<?= $Page->additional_findings->viewAttributes() ?>>
<?= $Page->additional_findings->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <tr id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_created_by_user_id"><?= $Page->created_by_user_id->caption() ?></span></td>
        <td data-name="created_by_user_id"<?= $Page->created_by_user_id->cellAttributes() ?>>
<span id="el_diagnosis_created_by_user_id">
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<?= $Page->created_by_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <tr id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_date_created"><?= $Page->date_created->caption() ?></span></td>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el_diagnosis_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_diagnosis_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_diagnosis_date_updated">
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
