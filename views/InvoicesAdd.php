<?php

namespace PHPMaker2024\afyaplus;

// Page object
$InvoicesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { invoices: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var finvoicesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoicesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null, ew.Validators.integer], fields.visit_id.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["payment_status", [fields.payment_status.visible && fields.payment_status.required ? ew.Validators.required(fields.payment_status.caption) : null], fields.payment_status.isInvalid],
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
            "patient_id": <?= $Page->patient_id->toClientList($Page) ?>,
            "payment_status": <?= $Page->payment_status->toClientList($Page) ?>,
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="finvoicesadd" id="finvoicesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="invoices">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patient_visits") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_visits">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->visit_id->getSessionValue()) ?>">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_invoices_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_invoices_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_invoices_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesadd_x_patient_id"
        <?php } ?>
        data-table="invoices"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <?= $Page->patient_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("finvoicesadd", function() {
    var options = { name: "x_patient_id", selectId: "finvoicesadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "finvoicesadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "finvoicesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <div id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <label id="elh_invoices_visit_id" for="x_visit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_id->caption() ?><?= $Page->visit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_id->cellAttributes() ?>>
<?php if ($Page->visit_id->getSessionValue() != "") { ?>
<span id="el_invoices_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->visit_id->getDisplayValue($Page->visit_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_visit_id" name="x_visit_id" value="<?= HtmlEncode($Page->visit_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_invoices_visit_id">
<input type="<?= $Page->visit_id->getInputTextType() ?>" name="x_visit_id" id="x_visit_id" data-table="invoices" data-field="x_visit_id" value="<?= $Page->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->visit_id->formatPattern()) ?>"<?= $Page->visit_id->editAttributes() ?> aria-describedby="x_visit_id_help">
<?= $Page->visit_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_invoices_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_invoices_description">
<?php $Page->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="invoices" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["finvoicesadd", "editor"], function() {
    ew.createEditor("finvoicesadd", "x_description", 0, 0, <?= $Page->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_status->Visible) { // payment_status ?>
    <div id="r_payment_status"<?= $Page->payment_status->rowAttributes() ?>>
        <label id="elh_invoices_payment_status" for="x_payment_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_status->caption() ?><?= $Page->payment_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payment_status->cellAttributes() ?>>
<span id="el_invoices_payment_status">
    <select
        id="x_payment_status"
        name="x_payment_status"
        class="form-select ew-select<?= $Page->payment_status->isInvalidClass() ?>"
        <?php if (!$Page->payment_status->IsNativeSelect) { ?>
        data-select2-id="finvoicesadd_x_payment_status"
        <?php } ?>
        data-table="invoices"
        data-field="x_payment_status"
        data-value-separator="<?= $Page->payment_status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->payment_status->getPlaceHolder()) ?>"
        <?= $Page->payment_status->editAttributes() ?>>
        <?= $Page->payment_status->selectOptionListHtml("x_payment_status") ?>
    </select>
    <?= $Page->payment_status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->payment_status->getErrorMessage() ?></div>
<?php if (!$Page->payment_status->IsNativeSelect) { ?>
<script>
loadjs.ready("finvoicesadd", function() {
    var options = { name: "x_payment_status", selectId: "finvoicesadd_x_payment_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesadd.lists.payment_status?.lookupOptions.length) {
        options.data = { id: "x_payment_status", form: "finvoicesadd" };
    } else {
        options.ajax = { id: "x_payment_status", form: "finvoicesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.payment_status.selectOptions);
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
        <label id="elh_invoices_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("add")) { // Non system admin ?>
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->created_by_user_id->getDisplayValue($Page->created_by_user_id->EditValue) ?></span></span>
<input type="hidden" data-table="invoices" data-field="x_created_by_user_id" data-hidden="1" name="x_created_by_user_id" id="x_created_by_user_id" value="<?= HtmlEncode($Page->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_invoices_created_by_user_id">
    <select
        id="x_created_by_user_id"
        name="x_created_by_user_id"
        class="form-select ew-select<?= $Page->created_by_user_id->isInvalidClass() ?>"
        <?php if (!$Page->created_by_user_id->IsNativeSelect) { ?>
        data-select2-id="finvoicesadd_x_created_by_user_id"
        <?php } ?>
        data-table="invoices"
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
loadjs.ready("finvoicesadd", function() {
    var options = { name: "x_created_by_user_id", selectId: "finvoicesadd_x_created_by_user_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (finvoicesadd.lists.created_by_user_id?.lookupOptions.length) {
        options.data = { id: "x_created_by_user_id", form: "finvoicesadd" };
    } else {
        options.ajax = { id: "x_created_by_user_id", form: "finvoicesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.invoices.fields.created_by_user_id.selectOptions);
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
    if (in_array("invoice_details", explode(",", $Page->getCurrentDetailTable())) && $invoice_details->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("invoice_details", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "InvoiceDetailsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="finvoicesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="finvoicesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("invoices");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
