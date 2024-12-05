<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LabTestReportsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="flab_test_reportsedit" id="flab_test_reportsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lab_test_reports: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var flab_test_reportsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("flab_test_reportsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_request_id", [fields.lab_test_request_id.visible && fields.lab_test_request_id.required ? ew.Validators.required(fields.lab_test_request_id.caption) : null], fields.lab_test_request_id.isInvalid],
            ["details", [fields.details.visible && fields.details.required ? ew.Validators.required(fields.details.caption) : null], fields.details.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null], fields.created_by_user_id.isInvalid]
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
            "lab_test_request_id": <?= $Page->lab_test_request_id->toClientList($Page) ?>,
            "created_by_user_id": <?= $Page->created_by_user_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="lab_test_reports">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_lab_test_reports_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_lab_test_reports_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_request_id->Visible) { // lab_test_request_id ?>
    <div id="r_lab_test_request_id"<?= $Page->lab_test_request_id->rowAttributes() ?>>
        <label id="elh_lab_test_reports_lab_test_request_id" for="x_lab_test_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_request_id->caption() ?><?= $Page->lab_test_request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_request_id->cellAttributes() ?>>
<span id="el_lab_test_reports_lab_test_request_id">
    <select
        id="x_lab_test_request_id"
        name="x_lab_test_request_id"
        class="form-select ew-select<?= $Page->lab_test_request_id->isInvalidClass() ?>"
        <?php if (!$Page->lab_test_request_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_reportsedit_x_lab_test_request_id"
        <?php } ?>
        data-table="lab_test_reports"
        data-field="x_lab_test_request_id"
        data-value-separator="<?= $Page->lab_test_request_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->lab_test_request_id->getPlaceHolder()) ?>"
        <?= $Page->lab_test_request_id->editAttributes() ?>>
        <?= $Page->lab_test_request_id->selectOptionListHtml("x_lab_test_request_id") ?>
    </select>
    <?= $Page->lab_test_request_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->lab_test_request_id->getErrorMessage() ?></div>
<?= $Page->lab_test_request_id->Lookup->getParamTag($Page, "p_x_lab_test_request_id") ?>
<?php if (!$Page->lab_test_request_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_reportsedit", function() {
    var options = { name: "x_lab_test_request_id", selectId: "flab_test_reportsedit_x_lab_test_request_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_reportsedit.lists.lab_test_request_id?.lookupOptions.length) {
        options.data = { id: "x_lab_test_request_id", form: "flab_test_reportsedit" };
    } else {
        options.ajax = { id: "x_lab_test_request_id", form: "flab_test_reportsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_reports.fields.lab_test_request_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->details->Visible) { // details ?>
    <div id="r_details"<?= $Page->details->rowAttributes() ?>>
        <label id="elh_lab_test_reports_details" class="<?= $Page->LeftColumnClass ?>"><?= $Page->details->caption() ?><?= $Page->details->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->details->cellAttributes() ?>>
<span id="el_lab_test_reports_details">
<?php $Page->details->EditAttrs->appendClass("editor"); ?>
<textarea data-table="lab_test_reports" data-field="x_details" name="x_details" id="x_details" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->details->getPlaceHolder()) ?>"<?= $Page->details->editAttributes() ?> aria-describedby="x_details_help"><?= $Page->details->EditValue ?></textarea>
<?= $Page->details->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->details->getErrorMessage() ?></div>
<script>
loadjs.ready(["flab_test_reportsedit", "editor"], function() {
    ew.createEditor("flab_test_reportsedit", "x_details", 0, 0, <?= $Page->details->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_lab_test_reports_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->created_by_user_id->getDisplayValue($Page->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="lab_test_reports" data-field="x_created_by_user_id" data-hidden="1" name="x_created_by_user_id" id="x_created_by_user_id" value="<?= HtmlEncode($Page->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_lab_test_reports_created_by_user_id">
    <select
        id="x_created_by_user_id"
        name="x_created_by_user_id"
        class="form-select ew-select<?= $Page->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Page->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="flab_test_reportsedit_x_created_by_user_id"
        <?php } ?>
        data-table="lab_test_reports"
        data-field="x_created_by_user_id"
        data-value-separator="<?= $Page->created_by_user_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->created_by_user_id->getPlaceHolder()) ?>"
        <?= $Page->created_by_user_id->editAttributes() ?>>
        <?= $Page->created_by_user_id->selectOptionListHtml("x_created_by_user_id") ?>
    </select>
    <?= $Page->created_by_user_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->created_by_user_id->getErrorMessage() ?></div>
<?= $Page->created_by_user_id->Lookup->getParamTag($Page, "p_x_created_by_user_id") ?>
<?php if (!$Page->created_by_user_id->IsNativeSelect) { ?>
<script>
loadjs.ready("flab_test_reportsedit", function() {
    var options = { name: "x_created_by_user_id", selectId: "flab_test_reportsedit_x_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (flab_test_reportsedit.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x_created_by_user_id", form: "flab_test_reportsedit" };
    } else {
        options.ajax = { id: "x_created_by_user_id", form: "flab_test_reportsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.lab_test_reports.fields.created_by_user_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("urinalysis_parameters", explode(",", $Page->getCurrentDetailTable())) && $urinalysis_parameters->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("urinalysis_parameters", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "UrinalysisParametersGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="flab_test_reportsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="flab_test_reportsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("lab_test_reports");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
