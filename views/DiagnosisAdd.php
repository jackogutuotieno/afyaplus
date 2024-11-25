<?php

namespace PHPMaker2024\afyaplus;

// Page object
$DiagnosisAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { diagnosis: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fdiagnosisadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdiagnosisadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["patient_id", [fields.patient_id.visible && fields.patient_id.required ? ew.Validators.required(fields.patient_id.caption) : null, ew.Validators.integer], fields.patient_id.isInvalid],
            ["visit_id", [fields.visit_id.visible && fields.visit_id.required ? ew.Validators.required(fields.visit_id.caption) : null, ew.Validators.integer], fields.visit_id.isInvalid],
            ["report_id", [fields.report_id.visible && fields.report_id.required ? ew.Validators.required(fields.report_id.caption) : null, ew.Validators.integer], fields.report_id.isInvalid],
            ["disease_id", [fields.disease_id.visible && fields.disease_id.required ? ew.Validators.required(fields.disease_id.caption) : null, ew.Validators.integer], fields.disease_id.isInvalid],
            ["additional_findings", [fields.additional_findings.visible && fields.additional_findings.required ? ew.Validators.required(fields.additional_findings.caption) : null], fields.additional_findings.isInvalid],
            ["created_by_user_id", [fields.created_by_user_id.visible && fields.created_by_user_id.required ? ew.Validators.required(fields.created_by_user_id.caption) : null, ew.Validators.integer], fields.created_by_user_id.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdiagnosisadd" id="fdiagnosisadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="diagnosis">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id"<?= $Page->patient_id->rowAttributes() ?>>
        <label id="elh_diagnosis_patient_id" for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->patient_id->caption() ?><?= $Page->patient_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->patient_id->cellAttributes() ?>>
<span id="el_diagnosis_patient_id">
<input type="<?= $Page->patient_id->getInputTextType() ?>" name="x_patient_id" id="x_patient_id" data-table="diagnosis" data-field="x_patient_id" value="<?= $Page->patient_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->patient_id->formatPattern()) ?>"<?= $Page->patient_id->editAttributes() ?> aria-describedby="x_patient_id_help">
<?= $Page->patient_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <div id="r_visit_id"<?= $Page->visit_id->rowAttributes() ?>>
        <label id="elh_diagnosis_visit_id" for="x_visit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visit_id->caption() ?><?= $Page->visit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visit_id->cellAttributes() ?>>
<span id="el_diagnosis_visit_id">
<input type="<?= $Page->visit_id->getInputTextType() ?>" name="x_visit_id" id="x_visit_id" data-table="diagnosis" data-field="x_visit_id" value="<?= $Page->visit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->visit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->visit_id->formatPattern()) ?>"<?= $Page->visit_id->editAttributes() ?> aria-describedby="x_visit_id_help">
<?= $Page->visit_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visit_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->report_id->Visible) { // report_id ?>
    <div id="r_report_id"<?= $Page->report_id->rowAttributes() ?>>
        <label id="elh_diagnosis_report_id" for="x_report_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->report_id->caption() ?><?= $Page->report_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->report_id->cellAttributes() ?>>
<span id="el_diagnosis_report_id">
<input type="<?= $Page->report_id->getInputTextType() ?>" name="x_report_id" id="x_report_id" data-table="diagnosis" data-field="x_report_id" value="<?= $Page->report_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->report_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->report_id->formatPattern()) ?>"<?= $Page->report_id->editAttributes() ?> aria-describedby="x_report_id_help">
<?= $Page->report_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->report_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disease_id->Visible) { // disease_id ?>
    <div id="r_disease_id"<?= $Page->disease_id->rowAttributes() ?>>
        <label id="elh_diagnosis_disease_id" for="x_disease_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disease_id->caption() ?><?= $Page->disease_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disease_id->cellAttributes() ?>>
<span id="el_diagnosis_disease_id">
<input type="<?= $Page->disease_id->getInputTextType() ?>" name="x_disease_id" id="x_disease_id" data-table="diagnosis" data-field="x_disease_id" value="<?= $Page->disease_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->disease_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->disease_id->formatPattern()) ?>"<?= $Page->disease_id->editAttributes() ?> aria-describedby="x_disease_id_help">
<?= $Page->disease_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->disease_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->additional_findings->Visible) { // additional_findings ?>
    <div id="r_additional_findings"<?= $Page->additional_findings->rowAttributes() ?>>
        <label id="elh_diagnosis_additional_findings" for="x_additional_findings" class="<?= $Page->LeftColumnClass ?>"><?= $Page->additional_findings->caption() ?><?= $Page->additional_findings->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->additional_findings->cellAttributes() ?>>
<span id="el_diagnosis_additional_findings">
<input type="<?= $Page->additional_findings->getInputTextType() ?>" name="x_additional_findings" id="x_additional_findings" data-table="diagnosis" data-field="x_additional_findings" value="<?= $Page->additional_findings->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->additional_findings->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->additional_findings->formatPattern()) ?>"<?= $Page->additional_findings->editAttributes() ?> aria-describedby="x_additional_findings_help">
<?= $Page->additional_findings->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->additional_findings->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by_user_id->Visible) { // created_by_user_id ?>
    <div id="r_created_by_user_id"<?= $Page->created_by_user_id->rowAttributes() ?>>
        <label id="elh_diagnosis_created_by_user_id" for="x_created_by_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by_user_id->caption() ?><?= $Page->created_by_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by_user_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("add")) { // Non system admin ?>
<span<?= $Page->created_by_user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->created_by_user_id->getDisplayValue($Page->created_by_user_id->EditValue))) ?>"></span>
<input type="hidden" data-table="diagnosis" data-field="x_created_by_user_id" data-hidden="1" name="x_created_by_user_id" id="x_created_by_user_id" value="<?= HtmlEncode($Page->created_by_user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_diagnosis_created_by_user_id">
<input type="<?= $Page->created_by_user_id->getInputTextType() ?>" name="x_created_by_user_id" id="x_created_by_user_id" data-table="diagnosis" data-field="x_created_by_user_id" value="<?= $Page->created_by_user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by_user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by_user_id->formatPattern()) ?>"<?= $Page->created_by_user_id->editAttributes() ?> aria-describedby="x_created_by_user_id_help">
<?= $Page->created_by_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by_user_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_diagnosis_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_diagnosis_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="diagnosis" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fdiagnosisadd", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_diagnosis_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_diagnosis_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="diagnosis" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdiagnosisadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fdiagnosisadd", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdiagnosisadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdiagnosisadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("diagnosis");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
