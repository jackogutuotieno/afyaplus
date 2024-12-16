<?php

namespace PHPMaker2024\afyaplus;

// Page object
$FullHaemogramParametersEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="ffull_haemogram_parametersedit" id="ffull_haemogram_parametersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { full_haemogram_parameters: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ffull_haemogram_parametersedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffull_haemogram_parametersedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_report_id", [fields.lab_test_report_id.visible && fields.lab_test_report_id.required ? ew.Validators.required(fields.lab_test_report_id.caption) : null, ew.Validators.integer], fields.lab_test_report_id.isInvalid],
            ["_template", [fields._template.visible && fields._template.required ? ew.Validators.required(fields._template.caption) : null], fields._template.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code in JAVASCRIPT here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="full_haemogram_parameters">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "lab_test_reports") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="lab_test_reports">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->lab_test_report_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="full_haemogram_parameters" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_report_id->Visible) { // lab_test_report_id ?>
    <div id="r_lab_test_report_id"<?= $Page->lab_test_report_id->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_lab_test_report_id" for="x_lab_test_report_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_report_id->caption() ?><?= $Page->lab_test_report_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_report_id->cellAttributes() ?>>
<?php if ($Page->lab_test_report_id->getSessionValue() != "") { ?>
<span<?= $Page->lab_test_report_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->lab_test_report_id->getDisplayValue($Page->lab_test_report_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_lab_test_report_id" name="x_lab_test_report_id" value="<?= HtmlEncode($Page->lab_test_report_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_full_haemogram_parameters_lab_test_report_id">
<input type="<?= $Page->lab_test_report_id->getInputTextType() ?>" name="x_lab_test_report_id" id="x_lab_test_report_id" data-table="full_haemogram_parameters" data-field="x_lab_test_report_id" value="<?= $Page->lab_test_report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lab_test_report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lab_test_report_id->formatPattern()) ?>"<?= $Page->lab_test_report_id->editAttributes() ?> aria-describedby="x_lab_test_report_id_help">
<?= $Page->lab_test_report_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lab_test_report_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_template->Visible) { // template ?>
    <div id="r__template"<?= $Page->_template->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters__template" for="x__template" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_template->caption() ?><?= $Page->_template->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_template->cellAttributes() ?>>
<span id="el_full_haemogram_parameters__template">
<?php echo '<table width="0">' ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ffull_haemogram_parametersedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ffull_haemogram_parametersedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("full_haemogram_parameters");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
