<?php

namespace PHPMaker2024\afyaplus;

// Page object
$UsersEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fusersedit" id="fusersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fusersedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fusersedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.fileRequired(fields.photo.caption) : null], fields.photo.isInvalid],
            ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
            ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
            ["national_id", [fields.national_id.visible && fields.national_id.required ? ew.Validators.required(fields.national_id.caption) : null, ew.Validators.integer], fields.national_id.isInvalid],
            ["gender", [fields.gender.visible && fields.gender.required ? ew.Validators.required(fields.gender.caption) : null], fields.gender.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["department_id", [fields.department_id.visible && fields.department_id.required ? ew.Validators.required(fields.department_id.caption) : null, ew.Validators.integer], fields.department_id.isInvalid],
            ["designation_id", [fields.designation_id.visible && fields.designation_id.required ? ew.Validators.required(fields.designation_id.caption) : null, ew.Validators.integer], fields.designation_id.isInvalid],
            ["physical_address", [fields.physical_address.visible && fields.physical_address.required ? ew.Validators.required(fields.physical_address.caption) : null], fields.physical_address.isInvalid],
            ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
            ["user_role_id", [fields.user_role_id.visible && fields.user_role_id.required ? ew.Validators.required(fields.user_role_id.caption) : null, ew.Validators.integer], fields.user_role_id.isInvalid],
            ["account_status", [fields.account_status.visible && fields.account_status.required ? ew.Validators.required(fields.account_status.caption) : null], fields.account_status.isInvalid],
            ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
            ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid],
            ["otp_code", [fields.otp_code.visible && fields.otp_code.required ? ew.Validators.required(fields.otp_code.caption) : null], fields.otp_code.isInvalid],
            ["otp_date", [fields.otp_date.visible && fields.otp_date.required ? ew.Validators.required(fields.otp_date.caption) : null, ew.Validators.datetime(fields.otp_date.clientFormatPattern)], fields.otp_date.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_users_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="users" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <div id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <label id="elh_users_photo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo->caption() ?><?= $Page->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo->cellAttributes() ?>>
<span id="el_users_photo">
<div id="fd_x_photo" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_photo"
        name="x_photo"
        class="form-control ew-file-input"
        title="<?= $Page->photo->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="users"
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
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="<?= (Post("fa_x_photo") == "0") ? "0" : "1" ?>">
<table id="ft_x_photo" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <label id="elh_users_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->first_name->cellAttributes() ?>>
<span id="el_users_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" name="x_first_name" id="x_first_name" data-table="users" data-field="x_first_name" value="<?= $Page->first_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->first_name->formatPattern()) ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <label id="elh_users_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_name->cellAttributes() ?>>
<span id="el_users_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" name="x_last_name" id="x_last_name" data-table="users" data-field="x_last_name" value="<?= $Page->last_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_name->formatPattern()) ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
    <div id="r_national_id"<?= $Page->national_id->rowAttributes() ?>>
        <label id="elh_users_national_id" for="x_national_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->national_id->caption() ?><?= $Page->national_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->national_id->cellAttributes() ?>>
<span id="el_users_national_id">
<input type="<?= $Page->national_id->getInputTextType() ?>" name="x_national_id" id="x_national_id" data-table="users" data-field="x_national_id" value="<?= $Page->national_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->national_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->national_id->formatPattern()) ?>"<?= $Page->national_id->editAttributes() ?> aria-describedby="x_national_id_help">
<?= $Page->national_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->national_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
    <div id="r_gender"<?= $Page->gender->rowAttributes() ?>>
        <label id="elh_users_gender" for="x_gender" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gender->caption() ?><?= $Page->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gender->cellAttributes() ?>>
<span id="el_users_gender">
<input type="<?= $Page->gender->getInputTextType() ?>" name="x_gender" id="x_gender" data-table="users" data-field="x_gender" value="<?= $Page->gender->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->gender->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->gender->formatPattern()) ?>"<?= $Page->gender->editAttributes() ?> aria-describedby="x_gender_help">
<?= $Page->gender->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gender->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_users_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_users_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="users" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_users__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="users" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_email->formatPattern()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->department_id->Visible) { // department_id ?>
    <div id="r_department_id"<?= $Page->department_id->rowAttributes() ?>>
        <label id="elh_users_department_id" for="x_department_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->department_id->caption() ?><?= $Page->department_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->department_id->cellAttributes() ?>>
<span id="el_users_department_id">
<input type="<?= $Page->department_id->getInputTextType() ?>" name="x_department_id" id="x_department_id" data-table="users" data-field="x_department_id" value="<?= $Page->department_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->department_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->department_id->formatPattern()) ?>"<?= $Page->department_id->editAttributes() ?> aria-describedby="x_department_id_help">
<?= $Page->department_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->department_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->designation_id->Visible) { // designation_id ?>
    <div id="r_designation_id"<?= $Page->designation_id->rowAttributes() ?>>
        <label id="elh_users_designation_id" for="x_designation_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->designation_id->caption() ?><?= $Page->designation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->designation_id->cellAttributes() ?>>
<span id="el_users_designation_id">
<input type="<?= $Page->designation_id->getInputTextType() ?>" name="x_designation_id" id="x_designation_id" data-table="users" data-field="x_designation_id" value="<?= $Page->designation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->designation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->designation_id->formatPattern()) ?>"<?= $Page->designation_id->editAttributes() ?> aria-describedby="x_designation_id_help">
<?= $Page->designation_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->designation_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->physical_address->Visible) { // physical_address ?>
    <div id="r_physical_address"<?= $Page->physical_address->rowAttributes() ?>>
        <label id="elh_users_physical_address" for="x_physical_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->physical_address->caption() ?><?= $Page->physical_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->physical_address->cellAttributes() ?>>
<span id="el_users_physical_address">
<input type="<?= $Page->physical_address->getInputTextType() ?>" name="x_physical_address" id="x_physical_address" data-table="users" data-field="x_physical_address" value="<?= $Page->physical_address->EditValue ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->physical_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->physical_address->formatPattern()) ?>"<?= $Page->physical_address->editAttributes() ?> aria-describedby="x_physical_address_help">
<?= $Page->physical_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->physical_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_password->formatPattern()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_role_id->Visible) { // user_role_id ?>
    <div id="r_user_role_id"<?= $Page->user_role_id->rowAttributes() ?>>
        <label id="elh_users_user_role_id" for="x_user_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_role_id->caption() ?><?= $Page->user_role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_role_id->cellAttributes() ?>>
<span id="el_users_user_role_id">
<input type="<?= $Page->user_role_id->getInputTextType() ?>" name="x_user_role_id" id="x_user_role_id" data-table="users" data-field="x_user_role_id" value="<?= $Page->user_role_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->user_role_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->user_role_id->formatPattern()) ?>"<?= $Page->user_role_id->editAttributes() ?> aria-describedby="x_user_role_id_help">
<?= $Page->user_role_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_role_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_status->Visible) { // account_status ?>
    <div id="r_account_status"<?= $Page->account_status->rowAttributes() ?>>
        <label id="elh_users_account_status" for="x_account_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_status->caption() ?><?= $Page->account_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_status->cellAttributes() ?>>
<span id="el_users_account_status">
<input type="<?= $Page->account_status->getInputTextType() ?>" name="x_account_status" id="x_account_status" data-table="users" data-field="x_account_status" value="<?= $Page->account_status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->account_status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->account_status->formatPattern()) ?>"<?= $Page->account_status->editAttributes() ?> aria-describedby="x_account_status_help">
<?= $Page->account_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_users_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_users_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="users" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_users_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_users_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="users" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->otp_code->Visible) { // otp_code ?>
    <div id="r_otp_code"<?= $Page->otp_code->rowAttributes() ?>>
        <label id="elh_users_otp_code" for="x_otp_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->otp_code->caption() ?><?= $Page->otp_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->otp_code->cellAttributes() ?>>
<span id="el_users_otp_code">
<input type="<?= $Page->otp_code->getInputTextType() ?>" name="x_otp_code" id="x_otp_code" data-table="users" data-field="x_otp_code" value="<?= $Page->otp_code->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->otp_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->otp_code->formatPattern()) ?>"<?= $Page->otp_code->editAttributes() ?> aria-describedby="x_otp_code_help">
<?= $Page->otp_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->otp_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->otp_date->Visible) { // otp_date ?>
    <div id="r_otp_date"<?= $Page->otp_date->rowAttributes() ?>>
        <label id="elh_users_otp_date" for="x_otp_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->otp_date->caption() ?><?= $Page->otp_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->otp_date->cellAttributes() ?>>
<span id="el_users_otp_date">
<input type="<?= $Page->otp_date->getInputTextType() ?>" name="x_otp_date" id="x_otp_date" data-table="users" data-field="x_otp_date" value="<?= $Page->otp_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->otp_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->otp_date->formatPattern()) ?>"<?= $Page->otp_date->editAttributes() ?> aria-describedby="x_otp_date_help">
<?= $Page->otp_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->otp_date->getErrorMessage() ?></div>
<?php if (!$Page->otp_date->ReadOnly && !$Page->otp_date->Disabled && !isset($Page->otp_date->EditAttrs["readonly"]) && !isset($Page->otp_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fusersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fusersedit", "x_otp_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fusersedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fusersedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
