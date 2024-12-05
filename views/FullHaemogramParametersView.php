<?php

namespace PHPMaker2024\afyaplus;

// Page object
$FullHaemogramParametersView = &$Page;
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
<form name="ffull_haemogram_parametersview" id="ffull_haemogram_parametersview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { full_haemogram_parameters: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var ffull_haemogram_parametersview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffull_haemogram_parametersview")
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
<input type="hidden" name="t" value="full_haemogram_parameters">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lab_test_report_id->Visible) { // lab_test_report_id ?>
    <tr id="r_lab_test_report_id"<?= $Page->lab_test_report_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_lab_test_report_id"><?= $Page->lab_test_report_id->caption() ?></span></td>
        <td data-name="lab_test_report_id"<?= $Page->lab_test_report_id->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_lab_test_report_id">
<span<?= $Page->lab_test_report_id->viewAttributes() ?>>
<?= $Page->lab_test_report_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->test->Visible) { // test ?>
    <tr id="r_test"<?= $Page->test->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_test"><?= $Page->test->caption() ?></span></td>
        <td data-name="test"<?= $Page->test->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_test">
<span<?= $Page->test->viewAttributes() ?>>
<?= $Page->test->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->results->Visible) { // results ?>
    <tr id="r_results"<?= $Page->results->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_results"><?= $Page->results->caption() ?></span></td>
        <td data-name="results"<?= $Page->results->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_results">
<span<?= $Page->results->viewAttributes() ?>>
<?= $Page->results->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit->Visible) { // unit ?>
    <tr id="r_unit"<?= $Page->unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_unit"><?= $Page->unit->caption() ?></span></td>
        <td data-name="unit"<?= $Page->unit->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_unit">
<span<?= $Page->unit->viewAttributes() ?>>
<?= $Page->unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_references->Visible) { // unit_references ?>
    <tr id="r_unit_references"<?= $Page->unit_references->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_unit_references"><?= $Page->unit_references->caption() ?></span></td>
        <td data-name="unit_references"<?= $Page->unit_references->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_unit_references">
<span<?= $Page->unit_references->viewAttributes() ?>>
<?= $Page->unit_references->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->comment->Visible) { // comment ?>
    <tr id="r_comment"<?= $Page->comment->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_full_haemogram_parameters_comment"><?= $Page->comment->caption() ?></span></td>
        <td data-name="comment"<?= $Page->comment->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_comment">
<span<?= $Page->comment->viewAttributes() ?>>
<?= $Page->comment->getViewValue() ?></span>
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
