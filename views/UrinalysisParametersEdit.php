<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UrinalysisParametersEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="furinalysis_parametersedit" id="furinalysis_parametersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { urinalysis_parameters: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var furinalysis_parametersedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("furinalysis_parametersedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_reports_id", [fields.lab_test_reports_id.visible && fields.lab_test_reports_id.required ? ew.Validators.required(fields.lab_test_reports_id.caption) : null, ew.Validators.integer], fields.lab_test_reports_id.isInvalid],
            ["parameter", [fields.parameter.visible && fields.parameter.required ? ew.Validators.required(fields.parameter.caption) : null], fields.parameter.isInvalid],
            ["result", [fields.result.visible && fields.result.required ? ew.Validators.required(fields.result.caption) : null], fields.result.isInvalid],
            ["comments", [fields.comments.visible && fields.comments.required ? ew.Validators.required(fields.comments.caption) : null], fields.comments.isInvalid]
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
            "parameter": <?= $Page->parameter->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="urinalysis_parameters">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "lab_test_reports") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="lab_test_reports">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->lab_test_reports_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_urinalysis_parameters_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_urinalysis_parameters_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="urinalysis_parameters" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_reports_id->Visible) { // lab_test_reports_id ?>
    <div id="r_lab_test_reports_id"<?= $Page->lab_test_reports_id->rowAttributes() ?>>
        <label id="elh_urinalysis_parameters_lab_test_reports_id" for="x_lab_test_reports_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_reports_id->caption() ?><?= $Page->lab_test_reports_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_reports_id->cellAttributes() ?>>
<?php if ($Page->lab_test_reports_id->getSessionValue() != "") { ?>
<span<?= $Page->lab_test_reports_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->lab_test_reports_id->getDisplayValue($Page->lab_test_reports_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_lab_test_reports_id" name="x_lab_test_reports_id" value="<?= HtmlEncode($Page->lab_test_reports_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_urinalysis_parameters_lab_test_reports_id">
<input type="<?= $Page->lab_test_reports_id->getInputTextType() ?>" name="x_lab_test_reports_id" id="x_lab_test_reports_id" data-table="urinalysis_parameters" data-field="x_lab_test_reports_id" value="<?= $Page->lab_test_reports_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lab_test_reports_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lab_test_reports_id->formatPattern()) ?>"<?= $Page->lab_test_reports_id->editAttributes() ?> aria-describedby="x_lab_test_reports_id_help">
<?= $Page->lab_test_reports_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lab_test_reports_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parameter->Visible) { // parameter ?>
    <div id="r_parameter"<?= $Page->parameter->rowAttributes() ?>>
        <label id="elh_urinalysis_parameters_parameter" for="x_parameter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parameter->caption() ?><?= $Page->parameter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->parameter->cellAttributes() ?>>
<span id="el_urinalysis_parameters_parameter">
    <select
        id="x_parameter"
        name="x_parameter"
        class="form-select ew-select<?= $Page->parameter->isInvalidClass() ?>"
        <?php if (!$Page->parameter->IsNativeSelect) { ?>
        data-select2-id="furinalysis_parametersedit_x_parameter"
        <?php } ?>
        data-table="urinalysis_parameters"
        data-field="x_parameter"
        data-value-separator="<?= $Page->parameter->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->parameter->getPlaceHolder()) ?>"
        <?= $Page->parameter->editAttributes() ?>>
        <?= $Page->parameter->selectOptionListHtml("x_parameter") ?>
    </select>
    <?= $Page->parameter->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->parameter->getErrorMessage() ?></div>
<?php if (!$Page->parameter->IsNativeSelect) { ?>
<script>
loadjs.ready("furinalysis_parametersedit", function() {
    var options = { name: "x_parameter", selectId: "furinalysis_parametersedit_x_parameter" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (furinalysis_parametersedit.lists.parameter?.lookupOptions.length) {
        options.data = { id: "x_parameter", form: "furinalysis_parametersedit" };
    } else {
        options.ajax = { id: "x_parameter", form: "furinalysis_parametersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.urinalysis_parameters.fields.parameter.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
    <div id="r_result"<?= $Page->result->rowAttributes() ?>>
        <label id="elh_urinalysis_parameters_result" for="x_result" class="<?= $Page->LeftColumnClass ?>"><?= $Page->result->caption() ?><?= $Page->result->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->result->cellAttributes() ?>>
<span id="el_urinalysis_parameters_result">
<input type="<?= $Page->result->getInputTextType() ?>" name="x_result" id="x_result" data-table="urinalysis_parameters" data-field="x_result" value="<?= $Page->result->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->result->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->result->formatPattern()) ?>"<?= $Page->result->editAttributes() ?> aria-describedby="x_result_help">
<?= $Page->result->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->result->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
    <div id="r_comments"<?= $Page->comments->rowAttributes() ?>>
        <label id="elh_urinalysis_parameters_comments" for="x_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->comments->caption() ?><?= $Page->comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->comments->cellAttributes() ?>>
<span id="el_urinalysis_parameters_comments">
<input type="<?= $Page->comments->getInputTextType() ?>" name="x_comments" id="x_comments" data-table="urinalysis_parameters" data-field="x_comments" value="<?= $Page->comments->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->comments->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->comments->formatPattern()) ?>"<?= $Page->comments->editAttributes() ?> aria-describedby="x_comments_help">
<?= $Page->comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->comments->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="furinalysis_parametersedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="furinalysis_parametersedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("urinalysis_parameters");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
