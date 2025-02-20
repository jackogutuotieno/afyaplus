<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DiagnosisEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fdiagnosisedit" id="fdiagnosisedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { diagnosis: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fdiagnosisedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdiagnosisedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["lab_test_report_id", [fields.lab_test_report_id.visible && fields.lab_test_report_id.required ? ew.Validators.required(fields.lab_test_report_id.caption) : null], fields.lab_test_report_id.isInvalid],
            ["disease_id", [fields.disease_id.visible && fields.disease_id.required ? ew.Validators.required(fields.disease_id.caption) : null], fields.disease_id.isInvalid],
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
            "lab_test_report_id": <?= $Page->lab_test_report_id->toClientList($Page) ?>,
            "disease_id": <?= $Page->disease_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="diagnosis">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_diagnosis_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_diagnosis_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="diagnosis" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lab_test_report_id->Visible) { // lab_test_report_id ?>
    <div id="r_lab_test_report_id"<?= $Page->lab_test_report_id->rowAttributes() ?>>
        <label id="elh_diagnosis_lab_test_report_id" for="x_lab_test_report_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lab_test_report_id->caption() ?><?= $Page->lab_test_report_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lab_test_report_id->cellAttributes() ?>>
<span id="el_diagnosis_lab_test_report_id">
    <select
        id="x_lab_test_report_id"
        name="x_lab_test_report_id"
        class="form-select ew-select<?= $Page->lab_test_report_id->isInvalidClass() ?>"
        <?php if (!$Page->lab_test_report_id->IsNativeSelect) { ?>
        data-select2-id="fdiagnosisedit_x_lab_test_report_id"
        <?php } ?>
        data-table="diagnosis"
        data-field="x_lab_test_report_id"
        data-value-separator="<?= $Page->lab_test_report_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->lab_test_report_id->getPlaceHolder()) ?>"
        <?= $Page->lab_test_report_id->editAttributes() ?>>
        <?= $Page->lab_test_report_id->selectOptionListHtml("x_lab_test_report_id") ?>
    </select>
    <?= $Page->lab_test_report_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->lab_test_report_id->getErrorMessage() ?></div>
<?= $Page->lab_test_report_id->Lookup->getParamTag($Page, "p_x_lab_test_report_id") ?>
<?php if (!$Page->lab_test_report_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdiagnosisedit", function() {
    var options = { name: "x_lab_test_report_id", selectId: "fdiagnosisedit_x_lab_test_report_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdiagnosisedit.lists.lab_test_report_id?.lookupOptions.length) {
        options.data = { id: "x_lab_test_report_id", form: "fdiagnosisedit" };
    } else {
        options.ajax = { id: "x_lab_test_report_id", form: "fdiagnosisedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.diagnosis.fields.lab_test_report_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disease_id->Visible) { // disease_id ?>
    <div id="r_disease_id"<?= $Page->disease_id->rowAttributes() ?>>
        <label id="elh_diagnosis_disease_id" for="x_disease_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disease_id->caption() ?><?= $Page->disease_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disease_id->cellAttributes() ?>>
<span id="el_diagnosis_disease_id">
    <select
        id="x_disease_id"
        name="x_disease_id"
        class="form-select ew-select<?= $Page->disease_id->isInvalidClass() ?>"
        <?php if (!$Page->disease_id->IsNativeSelect) { ?>
        data-select2-id="fdiagnosisedit_x_disease_id"
        <?php } ?>
        data-table="diagnosis"
        data-field="x_disease_id"
        data-value-separator="<?= $Page->disease_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->disease_id->getPlaceHolder()) ?>"
        <?= $Page->disease_id->editAttributes() ?>>
        <?= $Page->disease_id->selectOptionListHtml("x_disease_id") ?>
    </select>
    <?= $Page->disease_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->disease_id->getErrorMessage() ?></div>
<?= $Page->disease_id->Lookup->getParamTag($Page, "p_x_disease_id") ?>
<?php if (!$Page->disease_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fdiagnosisedit", function() {
    var options = { name: "x_disease_id", selectId: "fdiagnosisedit_x_disease_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdiagnosisedit.lists.disease_id?.lookupOptions.length) {
        options.data = { id: "x_disease_id", form: "fdiagnosisedit" };
    } else {
        options.ajax = { id: "x_disease_id", form: "fdiagnosisedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.diagnosis.fields.disease_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_diagnosis_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->created_by_user_id->getDisplayValue($Page->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="diagnosis" data-field="x_created_by_user_id" data-hidden="1" name="x_created_by_user_id" id="x_created_by_user_id" value="<?= HtmlEncode($Page->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_diagnosis_created_by_user_id">
    <select
        id="x_created_by_user_id"
        name="x_created_by_user_id"
        class="form-select ew-select<?= $Page->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Page->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="fdiagnosisedit_x_created_by_user_id"
        <?php } ?>
        data-table="diagnosis"
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
loadjs.ready("fdiagnosisedit", function() {
    var options = { name: "x_created_by_user_id", selectId: "fdiagnosisedit_x_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdiagnosisedit.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x_created_by_user_id", form: "fdiagnosisedit" };
    } else {
        options.ajax = { id: "x_created_by_user_id", form: "fdiagnosisedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.diagnosis.fields.created_by_user_id.selectOptions);
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
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdiagnosisedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdiagnosisedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("diagnosis");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
