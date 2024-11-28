<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DoctorNotesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fdoctor_notesedit" id="fdoctor_notesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { doctor_notes: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fdoctor_notesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdoctor_notesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null, ew.Validators.integer], fields.visit_id.isInvalid],
            ["chief_complaint", [fields.chief_complaint.visible && fields.chief_complaint.required ? ew.Validators.required(fields.chief_complaint.caption) : null], fields.chief_complaint.isInvalid],
            ["history_of_presenting_illness", [fields.history_of_presenting_illness.visible && fields.history_of_presenting_illness.required ? ew.Validators.required(fields.history_of_presenting_illness.caption) : null], fields.history_of_presenting_illness.isInvalid],
            ["past_medical_history", [fields.past_medical_history.visible && fields.past_medical_history.required ? ew.Validators.required(fields.past_medical_history.caption) : null], fields.past_medical_history.isInvalid],
            ["family_history", [fields.family_history.visible && fields.family_history.required ? ew.Validators.required(fields.family_history.caption) : null], fields.family_history.isInvalid],
            ["allergies", [fields.allergies.visible && fields.allergies.required ? ew.Validators.required(fields.allergies.caption) : null], fields.allergies.isInvalid],
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
<input type="hidden" name="t" value="doctor_notes">
<input type="hidden" name="action" id="action" value="update">
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
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_doctor_notes_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_doctor_notes_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="doctor_notes" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_doctor_notes_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_doctor_notes_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fdoctor_notesedit_x_patient_id"
        <?php } ?>
        data-table="doctor_notes"
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
loadjs.ready("fdoctor_notesedit", function() {
    var options = { name: "x_patient_id", selectId: "fdoctor_notesedit_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdoctor_notesedit.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fdoctor_notesedit" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fdoctor_notesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.doctor_notes.fields.patient_id.selectOptions);
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
        <label id="elh_doctor_notes_visit_id" for="x_visit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_id->caption() ?><?= $Page->visit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_id->cellAttributes() ?>>
<?php if ($Page->visit_id->getSessionValue() != "") { ?>
<span<?= $Page->visit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->visit_id->getDisplayValue($Page->visit_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_visit_id" name="x_visit_id" value="<?= HtmlEncode($Page->visit_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_doctor_notes_visit_id">
<input type="<?= $Page->visit_id->getInputTextType() ?>" name="x_visit_id" id="x_visit_id" data-table="doctor_notes" data-field="x_visit_id" value="<?= $Page->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->visit_id->formatPattern()) ?>"<?= $Page->visit_id->editAttributes() ?> aria-describedby="x_visit_id_help">
<?= $Page->visit_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->chief_complaint->Visible) { // chief_complaint ?>
    <div id="r_chief_complaint"<?= $Page->chief_complaint->rowAttributes() ?>>
        <label id="elh_doctor_notes_chief_complaint" for="x_chief_complaint" class="<?= $Page->LeftColumnClass ?>"><?= $Page->chief_complaint->caption() ?><?= $Page->chief_complaint->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->chief_complaint->cellAttributes() ?>>
<span id="el_doctor_notes_chief_complaint">
<textarea data-table="doctor_notes" data-field="x_chief_complaint" name="x_chief_complaint" id="x_chief_complaint" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->chief_complaint->getPlaceHolder()) ?>"<?= $Page->chief_complaint->editAttributes() ?> aria-describedby="x_chief_complaint_help"><?= $Page->chief_complaint->EditValue ?></textarea>
<?= $Page->chief_complaint->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->chief_complaint->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->history_of_presenting_illness->Visible) { // history_of_presenting_illness ?>
    <div id="r_history_of_presenting_illness"<?= $Page->history_of_presenting_illness->rowAttributes() ?>>
        <label id="elh_doctor_notes_history_of_presenting_illness" for="x_history_of_presenting_illness" class="<?= $Page->LeftColumnClass ?>"><?= $Page->history_of_presenting_illness->caption() ?><?= $Page->history_of_presenting_illness->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->history_of_presenting_illness->cellAttributes() ?>>
<span id="el_doctor_notes_history_of_presenting_illness">
<textarea data-table="doctor_notes" data-field="x_history_of_presenting_illness" name="x_history_of_presenting_illness" id="x_history_of_presenting_illness" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->history_of_presenting_illness->getPlaceHolder()) ?>"<?= $Page->history_of_presenting_illness->editAttributes() ?> aria-describedby="x_history_of_presenting_illness_help"><?= $Page->history_of_presenting_illness->EditValue ?></textarea>
<?= $Page->history_of_presenting_illness->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->history_of_presenting_illness->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->past_medical_history->Visible) { // past_medical_history ?>
    <div id="r_past_medical_history"<?= $Page->past_medical_history->rowAttributes() ?>>
        <label id="elh_doctor_notes_past_medical_history" for="x_past_medical_history" class="<?= $Page->LeftColumnClass ?>"><?= $Page->past_medical_history->caption() ?><?= $Page->past_medical_history->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->past_medical_history->cellAttributes() ?>>
<span id="el_doctor_notes_past_medical_history">
<textarea data-table="doctor_notes" data-field="x_past_medical_history" name="x_past_medical_history" id="x_past_medical_history" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->past_medical_history->getPlaceHolder()) ?>"<?= $Page->past_medical_history->editAttributes() ?> aria-describedby="x_past_medical_history_help"><?= $Page->past_medical_history->EditValue ?></textarea>
<?= $Page->past_medical_history->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->past_medical_history->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->family_history->Visible) { // family_history ?>
    <div id="r_family_history"<?= $Page->family_history->rowAttributes() ?>>
        <label id="elh_doctor_notes_family_history" for="x_family_history" class="<?= $Page->LeftColumnClass ?>"><?= $Page->family_history->caption() ?><?= $Page->family_history->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->family_history->cellAttributes() ?>>
<span id="el_doctor_notes_family_history">
<textarea data-table="doctor_notes" data-field="x_family_history" name="x_family_history" id="x_family_history" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->family_history->getPlaceHolder()) ?>"<?= $Page->family_history->editAttributes() ?> aria-describedby="x_family_history_help"><?= $Page->family_history->EditValue ?></textarea>
<?= $Page->family_history->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->family_history->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->allergies->Visible) { // allergies ?>
    <div id="r_allergies"<?= $Page->allergies->rowAttributes() ?>>
        <label id="elh_doctor_notes_allergies" for="x_allergies" class="<?= $Page->LeftColumnClass ?>"><?= $Page->allergies->caption() ?><?= $Page->allergies->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->allergies->cellAttributes() ?>>
<span id="el_doctor_notes_allergies">
<textarea data-table="doctor_notes" data-field="x_allergies" name="x_allergies" id="x_allergies" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->allergies->getPlaceHolder()) ?>"<?= $Page->allergies->editAttributes() ?> aria-describedby="x_allergies_help"><?= $Page->allergies->EditValue ?></textarea>
<?= $Page->allergies->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->allergies->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdoctor_notesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdoctor_notesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("doctor_notes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
