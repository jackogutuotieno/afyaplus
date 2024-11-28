<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { patients: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fpatientsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpatientsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.fileRequired(fields.photo.caption) : null], fields.photo.isInvalid],
            ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
            ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
            ["national_id", [fields.national_id.visible && fields.national_id.required ? ew.Validators.required(fields.national_id.caption) : null, ew.Validators.integer], fields.national_id.isInvalid],
            ["date_of_birth", [fields.date_of_birth.visible && fields.date_of_birth.required ? ew.Validators.required(fields.date_of_birth.caption) : null, ew.Validators.datetime(fields.date_of_birth.clientFormatPattern)], fields.date_of_birth.isInvalid],
            ["gender", [fields.gender.visible && fields.gender.required ? ew.Validators.required(fields.gender.caption) : null], fields.gender.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["email_address", [fields.email_address.visible && fields.email_address.required ? ew.Validators.required(fields.email_address.caption) : null], fields.email_address.isInvalid],
            ["physical_address", [fields.physical_address.visible && fields.physical_address.required ? ew.Validators.required(fields.physical_address.caption) : null], fields.physical_address.isInvalid],
            ["employment_status", [fields.employment_status.visible && fields.employment_status.required ? ew.Validators.required(fields.employment_status.caption) : null], fields.employment_status.isInvalid],
            ["religion", [fields.religion.visible && fields.religion.required ? ew.Validators.required(fields.religion.caption) : null], fields.religion.isInvalid],
            ["next_of_kin", [fields.next_of_kin.visible && fields.next_of_kin.required ? ew.Validators.required(fields.next_of_kin.caption) : null], fields.next_of_kin.isInvalid],
            ["next_of_kin_phone", [fields.next_of_kin_phone.visible && fields.next_of_kin_phone.required ? ew.Validators.required(fields.next_of_kin_phone.caption) : null], fields.next_of_kin_phone.isInvalid],
            ["marital_status", [fields.marital_status.visible && fields.marital_status.required ? ew.Validators.required(fields.marital_status.caption) : null], fields.marital_status.isInvalid]
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
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "employment_status": <?= $Page->employment_status->toClientList($Page) ?>,
            "religion": <?= $Page->religion->toClientList($Page) ?>,
            "marital_status": <?= $Page->marital_status->toClientList($Page) ?>,
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
<form name="fpatientsadd" id="fpatientsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="patients">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->photo->Visible) { // photo ?>
    <div id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <label id="elh_patients_photo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo->caption() ?><?= $Page->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo->cellAttributes() ?>>
<span id="el_patients_photo">
<div id="fd_x_photo" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_photo"
        name="x_photo"
        class="form-control ew-file-input"
        title="<?= $Page->photo->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="patients"
        data-field="x_photo"
        data-size="65535"
        data-accept-file-types="<?= $Page->photo->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->photo->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->photo->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_photo_help"
        <?= ($Page->photo->ReadOnly || $Page->photo->Disabled) ? " disabled" : "" ?>
        <?= $Page->photo->editAttributes() ?>
    >
    <div class="text-body-secondary ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->photo->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->photo->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?= $Page->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<table id="ft_x_photo" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <label id="elh_patients_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->first_name->cellAttributes() ?>>
<span id="el_patients_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" name="x_first_name" id="x_first_name" data-table="patients" data-field="x_first_name" value="<?= $Page->first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->first_name->formatPattern()) ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <label id="elh_patients_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_name->cellAttributes() ?>>
<span id="el_patients_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" name="x_last_name" id="x_last_name" data-table="patients" data-field="x_last_name" value="<?= $Page->last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_name->formatPattern()) ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
    <div id="r_national_id"<?= $Page->national_id->rowAttributes() ?>>
        <label id="elh_patients_national_id" for="x_national_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->national_id->caption() ?><?= $Page->national_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->national_id->cellAttributes() ?>>
<span id="el_patients_national_id">
<input type="<?= $Page->national_id->getInputTextType() ?>" name="x_national_id" id="x_national_id" data-table="patients" data-field="x_national_id" value="<?= $Page->national_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->national_id->formatPattern()) ?>"<?= $Page->national_id->editAttributes() ?> aria-describedby="x_national_id_help">
<?= $Page->national_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->national_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
    <div id="r_date_of_birth"<?= $Page->date_of_birth->rowAttributes() ?>>
        <label id="elh_patients_date_of_birth" for="x_date_of_birth" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_of_birth->caption() ?><?= $Page->date_of_birth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el_patients_date_of_birth">
<input type="<?= $Page->date_of_birth->getInputTextType() ?>" name="x_date_of_birth" id="x_date_of_birth" data-table="patients" data-field="x_date_of_birth" value="<?= $Page->date_of_birth->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_of_birth->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_of_birth->formatPattern()) ?>"<?= $Page->date_of_birth->editAttributes() ?> aria-describedby="x_date_of_birth_help">
<?= $Page->date_of_birth->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_of_birth->getErrorMessage() ?></div>
<?php if (!$Page->date_of_birth->ReadOnly && !$Page->date_of_birth->Disabled && !isset($Page->date_of_birth->EditAttrs["readonly"]) && !isset($Page->date_of_birth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpatientsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpatientsadd", "x_date_of_birth", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <div id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <label id="elh_patients_gender" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gender->caption() ?><?= $Page->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gender->cellAttributes() ?>>
<span id="el_patients_gender">
<template id="tp_x_gender">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="patients" data-field="x_gender" name="x_gender" id="x_gender"<?= $Page->gender->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_gender" class="ew-item-list"></div>
<selection-list hidden
    id="x_gender"
    name="x_gender"
    value="<?= HtmlEncode($Page->gender->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_gender"
    data-target="dsl_x_gender"
    data-repeatcolumn="5"
    class="form-control<?= $Page->gender->isInvalidClass() ?>"
    data-table="patients"
    data-field="x_gender"
    data-value-separator="<?= $Page->gender->displayValueSeparatorAttribute() ?>"
    <?= $Page->gender->editAttributes() ?>></selection-list>
<?= $Page->gender->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gender->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_patients_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_patients_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="patients" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
    <div id="r_email_address"<?= $Page->email_address->rowAttributes() ?>>
        <label id="elh_patients_email_address" for="x_email_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_address->caption() ?><?= $Page->email_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email_address->cellAttributes() ?>>
<span id="el_patients_email_address">
<input type="<?= $Page->email_address->getInputTextType() ?>" name="x_email_address" id="x_email_address" data-table="patients" data-field="x_email_address" value="<?= $Page->email_address->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email_address->formatPattern()) ?>"<?= $Page->email_address->editAttributes() ?> aria-describedby="x_email_address_help">
<?= $Page->email_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <div id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <label id="elh_patients_physical_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->physical_address->caption() ?><?= $Page->physical_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_patients_physical_address">
<?php $Page->physical_address->EditAttrs->appendClass("editor"); ?>
<textarea data-table="patients" data-field="x_physical_address" name="x_physical_address" id="x_physical_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->physical_address->getPlaceHolder()) ?>"<?= $Page->physical_address->editAttributes() ?> aria-describedby="x_physical_address_help"><?= $Page->physical_address->EditValue ?></textarea>
<?= $Page->physical_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->physical_address->getErrorMessage() ?></div>
<script>
loadjs.ready(["fpatientsadd", "editor"], function() {
    ew.createEditor("fpatientsadd", "x_physical_address", 0, 0, <?= $Page->physical_address->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employment_status->Visible) { // employment_status ?>
    <div id="r_employment_status"<?= $Page->employment_status->rowAttributes() ?>>
        <label id="elh_patients_employment_status" for="x_employment_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employment_status->caption() ?><?= $Page->employment_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employment_status->cellAttributes() ?>>
<span id="el_patients_employment_status">
    <select
        id="x_employment_status"
        name="x_employment_status"
        class="form-select ew-select<?= $Page->employment_status->isInvalidClass() ?>"
        <?php if (!$Page->employment_status->IsNativeSelect) { ?>
        data-select2-id="fpatientsadd_x_employment_status"
        <?php } ?>
        data-table="patients"
        data-field="x_employment_status"
        data-value-separator="<?= $Page->employment_status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employment_status->getPlaceHolder()) ?>"
        <?= $Page->employment_status->editAttributes() ?>>
        <?= $Page->employment_status->selectOptionListHtml("x_employment_status") ?>
    </select>
    <?= $Page->employment_status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->employment_status->getErrorMessage() ?></div>
<?php if (!$Page->employment_status->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatientsadd", function() {
    var options = { name: "x_employment_status", selectId: "fpatientsadd_x_employment_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatientsadd.lists.employment_status?.lookupOptions.length) {
        options.data = { id: "x_employment_status", form: "fpatientsadd" };
    } else {
        options.ajax = { id: "x_employment_status", form: "fpatientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients.fields.employment_status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->religion->Visible) { // religion ?>
    <div id="r_religion"<?= $Page->religion->rowAttributes() ?>>
        <label id="elh_patients_religion" for="x_religion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->religion->caption() ?><?= $Page->religion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->religion->cellAttributes() ?>>
<span id="el_patients_religion">
    <select
        id="x_religion"
        name="x_religion"
        class="form-select ew-select<?= $Page->religion->isInvalidClass() ?>"
        <?php if (!$Page->religion->IsNativeSelect) { ?>
        data-select2-id="fpatientsadd_x_religion"
        <?php } ?>
        data-table="patients"
        data-field="x_religion"
        data-value-separator="<?= $Page->religion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->religion->getPlaceHolder()) ?>"
        <?= $Page->religion->editAttributes() ?>>
        <?= $Page->religion->selectOptionListHtml("x_religion") ?>
    </select>
    <?= $Page->religion->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->religion->getErrorMessage() ?></div>
<?php if (!$Page->religion->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatientsadd", function() {
    var options = { name: "x_religion", selectId: "fpatientsadd_x_religion" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatientsadd.lists.religion?.lookupOptions.length) {
        options.data = { id: "x_religion", form: "fpatientsadd" };
    } else {
        options.ajax = { id: "x_religion", form: "fpatientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients.fields.religion.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
    <div id="r_next_of_kin"<?= $Page->next_of_kin->rowAttributes() ?>>
        <label id="elh_patients_next_of_kin" for="x_next_of_kin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_of_kin->caption() ?><?= $Page->next_of_kin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->next_of_kin->cellAttributes() ?>>
<span id="el_patients_next_of_kin">
<input type="<?= $Page->next_of_kin->getInputTextType() ?>" name="x_next_of_kin" id="x_next_of_kin" data-table="patients" data-field="x_next_of_kin" value="<?= $Page->next_of_kin->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->next_of_kin->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->next_of_kin->formatPattern()) ?>"<?= $Page->next_of_kin->editAttributes() ?> aria-describedby="x_next_of_kin_help">
<?= $Page->next_of_kin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_of_kin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
    <div id="r_next_of_kin_phone"<?= $Page->next_of_kin_phone->rowAttributes() ?>>
        <label id="elh_patients_next_of_kin_phone" for="x_next_of_kin_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_of_kin_phone->caption() ?><?= $Page->next_of_kin_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->next_of_kin_phone->cellAttributes() ?>>
<span id="el_patients_next_of_kin_phone">
<input type="<?= $Page->next_of_kin_phone->getInputTextType() ?>" name="x_next_of_kin_phone" id="x_next_of_kin_phone" data-table="patients" data-field="x_next_of_kin_phone" value="<?= $Page->next_of_kin_phone->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->next_of_kin_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->next_of_kin_phone->formatPattern()) ?>"<?= $Page->next_of_kin_phone->editAttributes() ?> aria-describedby="x_next_of_kin_phone_help">
<?= $Page->next_of_kin_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_of_kin_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
    <div id="r_marital_status"<?= $Page->marital_status->rowAttributes() ?>>
        <label id="elh_patients_marital_status" for="x_marital_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->marital_status->caption() ?><?= $Page->marital_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->marital_status->cellAttributes() ?>>
<span id="el_patients_marital_status">
    <select
        id="x_marital_status"
        name="x_marital_status"
        class="form-select ew-select<?= $Page->marital_status->isInvalidClass() ?>"
        <?php if (!$Page->marital_status->IsNativeSelect) { ?>
        data-select2-id="fpatientsadd_x_marital_status"
        <?php } ?>
        data-table="patients"
        data-field="x_marital_status"
        data-value-separator="<?= $Page->marital_status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->marital_status->getPlaceHolder()) ?>"
        <?= $Page->marital_status->editAttributes() ?>>
        <?= $Page->marital_status->selectOptionListHtml("x_marital_status") ?>
    </select>
    <?= $Page->marital_status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->marital_status->getErrorMessage() ?></div>
<?php if (!$Page->marital_status->IsNativeSelect) { ?>
<script>
loadjs.ready("fpatientsadd", function() {
    var options = { name: "x_marital_status", selectId: "fpatientsadd_x_marital_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpatientsadd.lists.marital_status?.lookupOptions.length) {
        options.data = { id: "x_marital_status", form: "fpatientsadd" };
    } else {
        options.ajax = { id: "x_marital_status", form: "fpatientsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.patients.fields.marital_status.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("patient_appointments", explode(",", $Page->getCurrentDetailTable())) && $patient_appointments->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_appointments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientAppointmentsGrid.php" ?>
<?php } ?>
<?php
    if (in_array("patient_visits", explode(",", $Page->getCurrentDetailTable())) && $patient_visits->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("patient_visits", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PatientVisitsGrid.php" ?>
<?php } ?>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpatientsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpatientsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("patients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
