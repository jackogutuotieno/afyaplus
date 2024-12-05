<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UrinalysisParametersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { urinalysis_parameters: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var furinalysis_parametersdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("furinalysis_parametersdelete")
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
<form name="furinalysis_parametersdelete" id="furinalysis_parametersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="urinalysis_parameters">
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
<?php if ($Page->parameter->Visible) { // parameter ?>
        <th class="<?= $Page->parameter->headerCellClass() ?>"><span id="elh_urinalysis_parameters_parameter" class="urinalysis_parameters_parameter"><?= $Page->parameter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
        <th class="<?= $Page->result->headerCellClass() ?>"><span id="elh_urinalysis_parameters_result" class="urinalysis_parameters_result"><?= $Page->result->caption() ?></span></th>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
        <th class="<?= $Page->comments->headerCellClass() ?>"><span id="elh_urinalysis_parameters_comments" class="urinalysis_parameters_comments"><?= $Page->comments->caption() ?></span></th>
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
<?php if ($Page->parameter->Visible) { // parameter ?>
        <td<?= $Page->parameter->cellAttributes() ?>>
<span id="">
<span<?= $Page->parameter->viewAttributes() ?>>
<?= $Page->parameter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
        <td<?= $Page->result->cellAttributes() ?>>
<span id="">
<span<?= $Page->result->viewAttributes() ?>>
<?= $Page->result->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
        <td<?= $Page->comments->cellAttributes() ?>>
<span id="">
<span<?= $Page->comments->viewAttributes() ?>>
<?= $Page->comments->getViewValue() ?></span>
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
