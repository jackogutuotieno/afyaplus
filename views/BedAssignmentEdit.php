<?php

namespace PHPMaker2024\afyaplus;

// Page object
$BedAssignmentEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fbed_assignmentedit" id="fbed_assignmentedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bed_assignment: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fbed_assignmentedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbed_assignmentedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["admission_id", [fields.admission_id.visible && fields.admission_id.required ? ew.Validators.required(fields.admission_id.caption) : null, ew.Validators.integer], fields.admission_id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["floor_id", [fields.floor_id.visible && fields.floor_id.required ? ew.Validators.required(fields.floor_id.caption) : null], fields.floor_id.isInvalid],
            ["ward_type_id", [fields.ward_type_id.visible && fields.ward_type_id.required ? ew.Validators.required(fields.ward_type_id.caption) : null], fields.ward_type_id.isInvalid],
            ["ward_id", [fields.ward_id.visible && fields.ward_id.required ? ew.Validators.required(fields.ward_id.caption) : null], fields.ward_id.isInvalid],
            ["bed_id", [fields.bed_id.visible && fields.bed_id.required ? ew.Validators.required(fields.bed_id.caption) : null], fields.bed_id.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
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
            "floor_id": <?= $Page->floor_id->toClientList($Page) ?>,
            "ward_type_id": <?= $Page->ward_type_id->toClientList($Page) ?>,
            "ward_id": <?= $Page->ward_id->toClientList($Page) ?>,
            "bed_id": <?= $Page->bed_id->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="bed_assignment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "patient_admissions") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="patient_admissions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->admission_id->getSessionValue()) ?>">
<input type="hidden" name="fk_patient_id" value="<?= HtmlEncode($Page->patient_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_bed_assignment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_bed_assignment_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="bed_assignment" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admission_id->Visible) { // admission_id ?>
    <div id="r_admission_id"<?= $Page->admission_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_admission_id" for="x_admission_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admission_id->caption() ?><?= $Page->admission_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admission_id->cellAttributes() ?>>
<?php if ($Page->admission_id->getSessionValue() != "") { ?>
<span id="el_bed_assignment_admission_id">
<span<?= $Page->admission_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->admission_id->getDisplayValue($Page->admission_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_admission_id" name="x_admission_id" value="<?= HtmlEncode($Page->admission_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_bed_assignment_admission_id">
<input type="<?= $Page->admission_id->getInputTextType() ?>" name="x_admission_id" id="x_admission_id" data-table="bed_assignment" data-field="x_admission_id" value="<?= $Page->admission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->admission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->admission_id->formatPattern()) ?>"<?= $Page->admission_id->editAttributes() ?> aria-describedby="x_admission_id_help">
<?= $Page->admission_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admission_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_bed_assignment_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_bed_assignment_patient_id">
<?php
if (IsRTL()) {
    $Page->patient_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_patient_id" class="ew-auto-suggest">
    <input type="<?= $Page->patient_id->getInputTextType() ?>" class="form-control" name="sv_x_patient_id" id="sv_x_patient_id" value="<?= RemoveHtml($Page->patient_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?> aria-describedby="x_patient_id_help">
</span>
<selection-list hidden class="form-control" data-table="bed_assignment" data-field="x_patient_id" data-input="sv_x_patient_id" data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>" name="x_patient_id" id="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>"></selection-list>
<?= $Page->patient_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    fbed_assignmentedit.createAutoSuggest(Object.assign({"id":"x_patient_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->patient_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.bed_assignment.fields.patient_id.autoSuggestOptions));
});
</script>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->floor_id->Visible) { // floor_id ?>
    <div id="r_floor_id"<?= $Page->floor_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_floor_id" for="x_floor_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->floor_id->caption() ?><?= $Page->floor_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->floor_id->cellAttributes() ?>>
<span id="el_bed_assignment_floor_id">
    <select
        id="x_floor_id"
        name="x_floor_id"
        class="form-select ew-select<?= $Page->floor_id->isInvalidClass() ?>"
        <?php if (!$Page->floor_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentedit_x_floor_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_floor_id"
        data-value-separator="<?= $Page->floor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->floor_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->floor_id->editAttributes() ?>>
        <?= $Page->floor_id->selectOptionListHtml("x_floor_id") ?>
    </select>
    <?= $Page->floor_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->floor_id->getErrorMessage() ?></div>
<?= $Page->floor_id->Lookup->getParamTag($Page, "p_x_floor_id") ?>
<?php if (!$Page->floor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    var options = { name: "x_floor_id", selectId: "fbed_assignmentedit_x_floor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentedit.lists.floor_id?.lookupOptions.length) {
        options.data = { id: "x_floor_id", form: "fbed_assignmentedit" };
    } else {
        options.ajax = { id: "x_floor_id", form: "fbed_assignmentedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.floor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_type_id->Visible) { // ward_type_id ?>
    <div id="r_ward_type_id"<?= $Page->ward_type_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_ward_type_id" for="x_ward_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_type_id->caption() ?><?= $Page->ward_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_type_id->cellAttributes() ?>>
<span id="el_bed_assignment_ward_type_id">
    <select
        id="x_ward_type_id"
        name="x_ward_type_id"
        class="form-select ew-select<?= $Page->ward_type_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_type_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentedit_x_ward_type_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_type_id"
        data-value-separator="<?= $Page->ward_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_type_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->ward_type_id->editAttributes() ?>>
        <?= $Page->ward_type_id->selectOptionListHtml("x_ward_type_id") ?>
    </select>
    <?= $Page->ward_type_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_type_id->getErrorMessage() ?></div>
<?= $Page->ward_type_id->Lookup->getParamTag($Page, "p_x_ward_type_id") ?>
<?php if (!$Page->ward_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    var options = { name: "x_ward_type_id", selectId: "fbed_assignmentedit_x_ward_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentedit.lists.ward_type_id?.lookupOptions.length) {
        options.data = { id: "x_ward_type_id", form: "fbed_assignmentedit" };
    } else {
        options.ajax = { id: "x_ward_type_id", form: "fbed_assignmentedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ward_id->Visible) { // ward_id ?>
    <div id="r_ward_id"<?= $Page->ward_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_ward_id" for="x_ward_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ward_id->caption() ?><?= $Page->ward_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ward_id->cellAttributes() ?>>
<span id="el_bed_assignment_ward_id">
    <select
        id="x_ward_id"
        name="x_ward_id"
        class="form-select ew-select<?= $Page->ward_id->isInvalidClass() ?>"
        <?php if (!$Page->ward_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentedit_x_ward_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_ward_id"
        data-value-separator="<?= $Page->ward_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ward_id->getPlaceHolder()) ?>"
        data-ew-action="update-options"
        <?= $Page->ward_id->editAttributes() ?>>
        <?= $Page->ward_id->selectOptionListHtml("x_ward_id") ?>
    </select>
    <?= $Page->ward_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ward_id->getErrorMessage() ?></div>
<?= $Page->ward_id->Lookup->getParamTag($Page, "p_x_ward_id") ?>
<?php if (!$Page->ward_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    var options = { name: "x_ward_id", selectId: "fbed_assignmentedit_x_ward_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentedit.lists.ward_id?.lookupOptions.length) {
        options.data = { id: "x_ward_id", form: "fbed_assignmentedit" };
    } else {
        options.ajax = { id: "x_ward_id", form: "fbed_assignmentedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.ward_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bed_id->Visible) { // bed_id ?>
    <div id="r_bed_id"<?= $Page->bed_id->rowAttributes() ?>>
        <label id="elh_bed_assignment_bed_id" for="x_bed_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bed_id->caption() ?><?= $Page->bed_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bed_id->cellAttributes() ?>>
<span id="el_bed_assignment_bed_id">
    <select
        id="x_bed_id"
        name="x_bed_id"
        class="form-select ew-select<?= $Page->bed_id->isInvalidClass() ?>"
        <?php if (!$Page->bed_id->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentedit_x_bed_id"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_bed_id"
        data-value-separator="<?= $Page->bed_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->bed_id->getPlaceHolder()) ?>"
        <?= $Page->bed_id->editAttributes() ?>>
        <?= $Page->bed_id->selectOptionListHtml("x_bed_id") ?>
    </select>
    <?= $Page->bed_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->bed_id->getErrorMessage() ?></div>
<?= $Page->bed_id->Lookup->getParamTag($Page, "p_x_bed_id") ?>
<?php if (!$Page->bed_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    var options = { name: "x_bed_id", selectId: "fbed_assignmentedit_x_bed_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentedit.lists.bed_id?.lookupOptions.length) {
        options.data = { id: "x_bed_id", form: "fbed_assignmentedit" };
    } else {
        options.ajax = { id: "x_bed_id", form: "fbed_assignmentedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.bed_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_bed_assignment_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_bed_assignment_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        <?php if (!$Page->status->IsNativeSelect) { ?>
        data-select2-id="fbed_assignmentedit_x_status"
        <?php } ?>
        data-table="bed_assignment"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<?php if (!$Page->status->IsNativeSelect) { ?>
<script>
loadjs.ready("fbed_assignmentedit", function() {
    var options = { name: "x_status", selectId: "fbed_assignmentedit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbed_assignmentedit.lists.status?.lookupOptions.length) {
        options.data = { id: "x_status", form: "fbed_assignmentedit" };
    } else {
        options.ajax = { id: "x_status", form: "fbed_assignmentedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.bed_assignment.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbed_assignmentedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbed_assignmentedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("bed_assignment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
