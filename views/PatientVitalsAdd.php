<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVitalsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_vitals: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fpatient_vitalsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatient_vitalsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null], fields.patient_id.isInvalid],
            ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null, ew.Validators.float], fields.height.isInvalid],
            ["weight", [fields.weight.visible && fields.weight.required ? ew.Validators.required(fields.weight.caption) : null, ew.Validators.integer], fields.weight.isInvalid],
            ["temperature", [fields.temperature.visible && fields.temperature.required ? ew.Validators.required(fields.temperature.caption) : null, ew.Validators.float], fields.temperature.isInvalid],
            ["pulse", [fields.pulse.visible && fields.pulse.required ? ew.Validators.required(fields.pulse.caption) : null, ew.Validators.integer], fields.pulse.isInvalid],
            ["blood_pressure", [fields.blood_pressure.visible && fields.blood_pressure.required ? ew.Validators.required(fields.blood_pressure.caption) : null], fields.blood_pressure.isInvalid]
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
<form name="fpatient_vitalsadd" id="fpatient_vitalsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_vitals">
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
        <label id="elh_patient_vitals_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<?php if ($Page->patient_id->getSessionValue() != "") { ?>
<span id="el_patient_vitals_patient_id">
<span<?= $Page->patient_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->patient_id->getDisplayValue($Page->patient_id->ViewValue) ?></span></span>
<input type="hidden" id="x_patient_id" name="x_patient_id" value="<?= HtmlEncode($Page->patient_id->CurrentValue) ?>" data-hidden="1">
</span>
<?php } else { ?>
<span id="el_patient_vitals_patient_id">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_vitalsadd_x_patient_id"
        <?php } ?>
        data-table="patient_vitals"
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
loadjs.ready("fpatient_vitalsadd", function() {
    var options = { name: "x_patient_id", selectId: "fpatient_vitalsadd_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_vitalsadd.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fpatient_vitalsadd" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fpatient_vitalsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_vitals.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <div id="r_height"<?= $Page->height->rowAttributes() ?>>
        <label id="elh_patient_vitals_height" for="x_height" class="<?= $Page->LeftColumnClass ?>"><?= $Page->height->caption() ?><?= $Page->height->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->height->cellAttributes() ?>>
<span id="el_patient_vitals_height">
<input type="<?= $Page->height->getInputTextType() ?>" name="x_height" id="x_height" data-table="patient_vitals" data-field="x_height" value="<?= $Page->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->height->formatPattern()) ?>"<?= $Page->height->editAttributes() ?> aria-describedby="x_height_help">
<?= $Page->height->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->height->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->weight->Visible) { // weight ?>
    <div id="r_weight"<?= $Page->weight->rowAttributes() ?>>
        <label id="elh_patient_vitals_weight" for="x_weight" class="<?= $Page->LeftColumnClass ?>"><?= $Page->weight->caption() ?><?= $Page->weight->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->weight->cellAttributes() ?>>
<span id="el_patient_vitals_weight">
<input type="<?= $Page->weight->getInputTextType() ?>" name="x_weight" id="x_weight" data-table="patient_vitals" data-field="x_weight" value="<?= $Page->weight->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->weight->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->weight->formatPattern()) ?>"<?= $Page->weight->editAttributes() ?> aria-describedby="x_weight_help">
<?= $Page->weight->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->weight->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->temperature->Visible) { // temperature ?>
    <div id="r_temperature"<?= $Page->temperature->rowAttributes() ?>>
        <label id="elh_patient_vitals_temperature" for="x_temperature" class="<?= $Page->LeftColumnClass ?>"><?= $Page->temperature->caption() ?><?= $Page->temperature->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->temperature->cellAttributes() ?>>
<span id="el_patient_vitals_temperature">
<input type="<?= $Page->temperature->getInputTextType() ?>" name="x_temperature" id="x_temperature" data-table="patient_vitals" data-field="x_temperature" value="<?= $Page->temperature->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->temperature->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->temperature->formatPattern()) ?>"<?= $Page->temperature->editAttributes() ?> aria-describedby="x_temperature_help">
<?= $Page->temperature->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->temperature->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pulse->Visible) { // pulse ?>
    <div id="r_pulse"<?= $Page->pulse->rowAttributes() ?>>
        <label id="elh_patient_vitals_pulse" for="x_pulse" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pulse->caption() ?><?= $Page->pulse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pulse->cellAttributes() ?>>
<span id="el_patient_vitals_pulse">
<input type="<?= $Page->pulse->getInputTextType() ?>" name="x_pulse" id="x_pulse" data-table="patient_vitals" data-field="x_pulse" value="<?= $Page->pulse->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pulse->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->pulse->formatPattern()) ?>"<?= $Page->pulse->editAttributes() ?> aria-describedby="x_pulse_help">
<?= $Page->pulse->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pulse->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->blood_pressure->Visible) { // blood_pressure ?>
    <div id="r_blood_pressure"<?= $Page->blood_pressure->rowAttributes() ?>>
        <label id="elh_patient_vitals_blood_pressure" for="x_blood_pressure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->blood_pressure->caption() ?><?= $Page->blood_pressure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->blood_pressure->cellAttributes() ?>>
<span id="el_patient_vitals_blood_pressure">
<input type="<?= $Page->blood_pressure->getInputTextType() ?>" name="x_blood_pressure" id="x_blood_pressure" data-table="patient_vitals" data-field="x_blood_pressure" value="<?= $Page->blood_pressure->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->blood_pressure->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->blood_pressure->formatPattern()) ?>"<?= $Page->blood_pressure->editAttributes() ?> aria-describedby="x_blood_pressure_help">
<?= $Page->blood_pressure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->blood_pressure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->visit_id->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_visit_id" id="x_visit_id" value="<?= HtmlEncode(strval($Page->visit_id->getSessionValue())) ?>">
    <?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatient_vitalsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatient_vitalsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("patient_vitals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
