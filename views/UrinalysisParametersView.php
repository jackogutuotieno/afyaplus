<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UrinalysisParametersView = &$Page;
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
<form name="furinalysis_parametersview" id="furinalysis_parametersview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { urinalysis_parameters: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var furinalysis_parametersview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("furinalysis_parametersview")
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
<input type="hidden" name="t" value="urinalysis_parameters">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_urinalysis_parameters_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_urinalysis_parameters_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lab_test_reports_id->Visible) { // lab_test_reports_id ?>
    <tr id="r_lab_test_reports_id"<?= $Page->lab_test_reports_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_urinalysis_parameters_lab_test_reports_id"><?= $Page->lab_test_reports_id->caption() ?></span></td>
        <td data-name="lab_test_reports_id"<?= $Page->lab_test_reports_id->cellAttributes() ?>>
<span id="el_urinalysis_parameters_lab_test_reports_id">
<span<?= $Page->lab_test_reports_id->viewAttributes() ?>>
<?= $Page->lab_test_reports_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parameter->Visible) { // parameter ?>
    <tr id="r_parameter"<?= $Page->parameter->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_urinalysis_parameters_parameter"><?= $Page->parameter->caption() ?></span></td>
        <td data-name="parameter"<?= $Page->parameter->cellAttributes() ?>>
<span id="el_urinalysis_parameters_parameter">
<span<?= $Page->parameter->viewAttributes() ?>>
<?= $Page->parameter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
    <tr id="r_result"<?= $Page->result->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_urinalysis_parameters_result"><?= $Page->result->caption() ?></span></td>
        <td data-name="result"<?= $Page->result->cellAttributes() ?>>
<span id="el_urinalysis_parameters_result">
<span<?= $Page->result->viewAttributes() ?>>
<?= $Page->result->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
    <tr id="r_comments"<?= $Page->comments->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_urinalysis_parameters_comments"><?= $Page->comments->caption() ?></span></td>
        <td data-name="comments"<?= $Page->comments->cellAttributes() ?>>
<span id="el_urinalysis_parameters_comments">
<span<?= $Page->comments->viewAttributes() ?>>
<?= $Page->comments->getViewValue() ?></span>
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
