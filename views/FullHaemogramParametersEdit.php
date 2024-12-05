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
            ["test", [fields.test.visible && fields.test.required ? ew.Validators.required(fields.test.caption) : null], fields.test.isInvalid],
            ["results", [fields.results.visible && fields.results.required ? ew.Validators.required(fields.results.caption) : null, ew.Validators.float], fields.results.isInvalid],
            ["unit", [fields.unit.visible && fields.unit.required ? ew.Validators.required(fields.unit.caption) : null], fields.unit.isInvalid],
            ["unit_references", [fields.unit_references.visible && fields.unit_references.required ? ew.Validators.required(fields.unit_references.caption) : null], fields.unit_references.isInvalid],
            ["comment", [fields.comment.visible && fields.comment.required ? ew.Validators.required(fields.comment.caption) : null], fields.comment.isInvalid]
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
            "test": <?= $Page->test->toClientList($Page) ?>,
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
<?php if ($Page->getCurrentMasterTable() == "patients_lab_report") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patients_lab_report">
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
<?php if ($Page->test->Visible) { // test ?>
    <div id="r_test"<?= $Page->test->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_test" for="x_test" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test->caption() ?><?= $Page->test->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_test">
    <select
        id="x_test"
        name="x_test"
        class="form-select ew-select<?= $Page->test->isInvalidClass() ?>"
        <?php if (!$Page->test->IsNativeSelect) { ?>
        data-select2-id="ffull_haemogram_parametersedit_x_test"
        <?php } ?>
        data-table="full_haemogram_parameters"
        data-field="x_test"
        data-value-separator="<?= $Page->test->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->test->getPlaceHolder()) ?>"
        <?= $Page->test->editAttributes() ?>>
        <?= $Page->test->selectOptionListHtml("x_test") ?>
    </select>
    <?= $Page->test->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->test->getErrorMessage() ?></div>
<?php if (!$Page->test->IsNativeSelect) { ?>
<script>
loadjs.ready("ffull_haemogram_parametersedit", function() {
    var options = { name: "x_test", selectId: "ffull_haemogram_parametersedit_x_test" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffull_haemogram_parametersedit.lists.test?.lookupOptions.length) {
        options.data = { id: "x_test", form: "ffull_haemogram_parametersedit" };
    } else {
        options.ajax = { id: "x_test", form: "ffull_haemogram_parametersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.full_haemogram_parameters.fields.test.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->results->Visible) { // results ?>
    <div id="r_results"<?= $Page->results->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_results" for="x_results" class="<?= $Page->LeftColumnClass ?>"><?= $Page->results->caption() ?><?= $Page->results->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->results->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_results">
<input type="<?= $Page->results->getInputTextType() ?>" name="x_results" id="x_results" data-table="full_haemogram_parameters" data-field="x_results" value="<?= $Page->results->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->results->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->results->formatPattern()) ?>"<?= $Page->results->editAttributes() ?> aria-describedby="x_results_help">
<?= $Page->results->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->results->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit->Visible) { // unit ?>
    <div id="r_unit"<?= $Page->unit->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_unit" for="x_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit->caption() ?><?= $Page->unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_unit">
<input type="<?= $Page->unit->getInputTextType() ?>" name="x_unit" id="x_unit" data-table="full_haemogram_parameters" data-field="x_unit" value="<?= $Page->unit->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->unit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unit->formatPattern()) ?>"<?= $Page->unit->editAttributes() ?> aria-describedby="x_unit_help">
<?= $Page->unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_references->Visible) { // unit_references ?>
    <div id="r_unit_references"<?= $Page->unit_references->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_unit_references" for="x_unit_references" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_references->caption() ?><?= $Page->unit_references->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_references->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_unit_references">
<input type="<?= $Page->unit_references->getInputTextType() ?>" name="x_unit_references" id="x_unit_references" data-table="full_haemogram_parameters" data-field="x_unit_references" value="<?= $Page->unit_references->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->unit_references->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unit_references->formatPattern()) ?>"<?= $Page->unit_references->editAttributes() ?> aria-describedby="x_unit_references_help">
<?= $Page->unit_references->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_references->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->comment->Visible) { // comment ?>
    <div id="r_comment"<?= $Page->comment->rowAttributes() ?>>
        <label id="elh_full_haemogram_parameters_comment" for="x_comment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->comment->caption() ?><?= $Page->comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->comment->cellAttributes() ?>>
<span id="el_full_haemogram_parameters_comment">
<input type="<?= $Page->comment->getInputTextType() ?>" name="x_comment" id="x_comment" data-table="full_haemogram_parameters" data-field="x_comment" value="<?= $Page->comment->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->comment->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->comment->formatPattern()) ?>"<?= $Page->comment->editAttributes() ?> aria-describedby="x_comment_help">
<?= $Page->comment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->comment->getErrorMessage() ?></div>
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
