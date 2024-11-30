<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientVisitsSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patient_visits: currentTable } });
var currentPageID = ew.PAGE_ID = "search";
var currentForm;
var fpatient_visitssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fpatient_visitssearch")
        .setPageId("search")
<?php if ($Page->IsModal && $Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
            ["id", [ew.Validators.integer], fields.id.isInvalid],
            ["patient_id", [], fields.patient_id.isInvalid],
            ["visit_type_id", [], fields.visit_type_id.isInvalid],
            ["payment_method_id", [], fields.payment_method_id.isInvalid],
            ["medical_scheme_id", [], fields.medical_scheme_id.isInvalid],
            ["user_role", [], fields.user_role.isInvalid],
            ["date_created", [ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid],
            ["status", [], fields.status.isInvalid]
        ])
        // Validate form
        .setValidate(
            async function () {
                if (!this.validateRequired)
                    return true; // Ignore validation
                let fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!(await this.customValidate?.(fobj) ?? true)) {
                    this.focus();
                    return false;
                }
                return true;
            }
        )

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
            "visit_type_id": <?= $Page->visit_type_id->toClientList($Page) ?>,
            "payment_method_id": <?= $Page->payment_method_id->toClientList($Page) ?>,
            "medical_scheme_id": <?= $Page->medical_scheme_id->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
<?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = form;
<?php } else { ?>
    currentForm = form;
<?php } ?>
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
<form name="fpatient_visitssearch" id="fpatient_visitssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patient_visits">
<input type="hidden" name="action" id="action" value="search">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="row"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="patient_visits" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->id->formatPattern()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->patient_id->Visible) { // patient_id ?>
    <div id="r_patient_id" class="row"<?= $Page->patient_id->rowAttributes() ?>>
        <label for="x_patient_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_patient_id"><?= $Page->patient_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_patient_id" id="z_patient_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->patient_id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_patient_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_patient_id"
        name="x_patient_id"
        class="form-select ew-select<?= $Page->patient_id->isInvalidClass() ?>"
        <?php if (!$Page->patient_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitssearch_x_patient_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_patient_id"
        data-value-separator="<?= $Page->patient_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->patient_id->getPlaceHolder()) ?>"
        <?= $Page->patient_id->editAttributes() ?>>
        <?= $Page->patient_id->selectOptionListHtml("x_patient_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->patient_id->getErrorMessage(false) ?></div>
<?= $Page->patient_id->Lookup->getParamTag($Page, "p_x_patient_id") ?>
<?php if (!$Page->patient_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitssearch", function() {
    var options = { name: "x_patient_id", selectId: "fpatient_visitssearch_x_patient_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitssearch.lists.patient_id?.lookupOptions.length) {
        options.data = { id: "x_patient_id", form: "fpatient_visitssearch" };
    } else {
        options.ajax = { id: "x_patient_id", form: "fpatient_visitssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.patient_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->visit_type_id->Visible) { // visit_type_id ?>
    <div id="r_visit_type_id" class="row"<?= $Page->visit_type_id->rowAttributes() ?>>
        <label for="x_visit_type_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_visit_type_id"><?= $Page->visit_type_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_visit_type_id" id="z_visit_type_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->visit_type_id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_visit_type_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_visit_type_id"
        name="x_visit_type_id"
        class="form-select ew-select<?= $Page->visit_type_id->isInvalidClass() ?>"
        <?php if (!$Page->visit_type_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitssearch_x_visit_type_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_visit_type_id"
        data-value-separator="<?= $Page->visit_type_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->visit_type_id->getPlaceHolder()) ?>"
        <?= $Page->visit_type_id->editAttributes() ?>>
        <?= $Page->visit_type_id->selectOptionListHtml("x_visit_type_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->visit_type_id->getErrorMessage(false) ?></div>
<?= $Page->visit_type_id->Lookup->getParamTag($Page, "p_x_visit_type_id") ?>
<?php if (!$Page->visit_type_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitssearch", function() {
    var options = { name: "x_visit_type_id", selectId: "fpatient_visitssearch_x_visit_type_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitssearch.lists.visit_type_id?.lookupOptions.length) {
        options.data = { id: "x_visit_type_id", form: "fpatient_visitssearch" };
    } else {
        options.ajax = { id: "x_visit_type_id", form: "fpatient_visitssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.visit_type_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->payment_method_id->Visible) { // payment_method_id ?>
    <div id="r_payment_method_id" class="row"<?= $Page->payment_method_id->rowAttributes() ?>>
        <label for="x_payment_method_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_payment_method_id"><?= $Page->payment_method_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_payment_method_id" id="z_payment_method_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->payment_method_id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_payment_method_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_payment_method_id"
        name="x_payment_method_id"
        class="form-select ew-select<?= $Page->payment_method_id->isInvalidClass() ?>"
        <?php if (!$Page->payment_method_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitssearch_x_payment_method_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_payment_method_id"
        data-value-separator="<?= $Page->payment_method_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->payment_method_id->getPlaceHolder()) ?>"
        <?= $Page->payment_method_id->editAttributes() ?>>
        <?= $Page->payment_method_id->selectOptionListHtml("x_payment_method_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->payment_method_id->getErrorMessage(false) ?></div>
<?= $Page->payment_method_id->Lookup->getParamTag($Page, "p_x_payment_method_id") ?>
<?php if (!$Page->payment_method_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitssearch", function() {
    var options = { name: "x_payment_method_id", selectId: "fpatient_visitssearch_x_payment_method_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitssearch.lists.payment_method_id?.lookupOptions.length) {
        options.data = { id: "x_payment_method_id", form: "fpatient_visitssearch" };
    } else {
        options.ajax = { id: "x_payment_method_id", form: "fpatient_visitssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.payment_method_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->medical_scheme_id->Visible) { // medical_scheme_id ?>
    <div id="r_medical_scheme_id" class="row"<?= $Page->medical_scheme_id->rowAttributes() ?>>
        <label for="x_medical_scheme_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_medical_scheme_id"><?= $Page->medical_scheme_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_medical_scheme_id" id="z_medical_scheme_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->medical_scheme_id->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_medical_scheme_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_medical_scheme_id"
        name="x_medical_scheme_id"
        class="form-select ew-select<?= $Page->medical_scheme_id->isInvalidClass() ?>"
        <?php if (!$Page->medical_scheme_id->IsNativeSelect) { ?>
        data-select2-id="fpatient_visitssearch_x_medical_scheme_id"
        <?php } ?>
        data-table="patient_visits"
        data-field="x_medical_scheme_id"
        data-value-separator="<?= $Page->medical_scheme_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medical_scheme_id->getPlaceHolder()) ?>"
        <?= $Page->medical_scheme_id->editAttributes() ?>>
        <?= $Page->medical_scheme_id->selectOptionListHtml("x_medical_scheme_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->medical_scheme_id->getErrorMessage(false) ?></div>
<?= $Page->medical_scheme_id->Lookup->getParamTag($Page, "p_x_medical_scheme_id") ?>
<?php if (!$Page->medical_scheme_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatient_visitssearch", function() {
    var options = { name: "x_medical_scheme_id", selectId: "fpatient_visitssearch_x_medical_scheme_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatient_visitssearch.lists.medical_scheme_id?.lookupOptions.length) {
        options.data = { id: "x_medical_scheme_id", form: "fpatient_visitssearch" };
    } else {
        options.ajax = { id: "x_medical_scheme_id", form: "fpatient_visitssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patient_visits.fields.medical_scheme_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->user_role->Visible) { // user_role ?>
    <div id="r_user_role" class="row"<?= $Page->user_role->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_user_role"><?= $Page->user_role->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_user_role" id="z_user_role" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->user_role->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_user_role" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->user_role->getInputTextType() ?>" name="x_user_role" id="x_user_role" data-table="patient_visits" data-field="x_user_role" value="<?= $Page->user_role->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->user_role->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->user_role->formatPattern()) ?>"<?= $Page->user_role->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->user_role->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created" class="row"<?= $Page->date_created->rowAttributes() ?>>
        <label for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_date_created"><?= $Page->date_created->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_date_created" id="z_date_created" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_created->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_date_created" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="patient_visits" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_visitssearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatient_visitssearch", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated" class="row"<?= $Page->date_updated->rowAttributes() ?>>
        <label for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_date_updated"><?= $Page->date_updated->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_date_updated" id="z_date_updated" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_updated->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_date_updated" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="patient_visits" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage(false) ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatient_visitssearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(11) ?>",
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
    ew.createDateTimePicker("fpatient_visitssearch", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="row"<?= $Page->status->rowAttributes() ?>>
        <label for="x_status" class="<?= $Page->LeftColumnClass ?>"><span id="elh_patient_visits_status"><?= $Page->status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_status" id="z_status" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
                <div class="d-flex align-items-start">
                <span id="el_patient_visits_status" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="patient_visits" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
</span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatient_visitssearch"><?= $Language->phrase("Search") ?></button>
        <?php if ($Page->IsModal) { ?>
        <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatient_visitssearch"><?= $Language->phrase("CancelBtn") ?></button>
        <?php } else { ?>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" form="fpatient_visitssearch" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("patient_visits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
