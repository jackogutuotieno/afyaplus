<?php

namespace PHPMaker2024\afyaplus;

// Page object
$ExportlogEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fexportlogedit" id="fexportlogedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { exportlog: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fexportlogedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fexportlogedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["FileId", [fields.FileId.visible && fields.FileId.required ? ew.Validators.required(fields.FileId.caption) : null], fields.FileId.isInvalid],
            ["DateTime", [fields.DateTime.visible && fields.DateTime.required ? ew.Validators.required(fields.DateTime.caption) : null, ew.Validators.datetime(fields.DateTime.clientFormatPattern)], fields.DateTime.isInvalid],
            ["User", [fields.User.visible && fields.User.required ? ew.Validators.required(fields.User.caption) : null], fields.User.isInvalid],
            ["_ExportType", [fields._ExportType.visible && fields._ExportType.required ? ew.Validators.required(fields._ExportType.caption) : null], fields._ExportType.isInvalid],
            ["_Table", [fields._Table.visible && fields._Table.required ? ew.Validators.required(fields._Table.caption) : null], fields._Table.isInvalid],
            ["KeyValue", [fields.KeyValue.visible && fields.KeyValue.required ? ew.Validators.required(fields.KeyValue.caption) : null], fields.KeyValue.isInvalid],
            ["Filename", [fields.Filename.visible && fields.Filename.required ? ew.Validators.required(fields.Filename.caption) : null], fields.Filename.isInvalid],
            ["__Request", [fields.__Request.visible && fields.__Request.required ? ew.Validators.required(fields.__Request.caption) : null], fields.__Request.isInvalid]
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
            "User": <?= $Page->User->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="exportlog">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->FileId->Visible) { // FileId ?>
    <div id="r_FileId"<?= $Page->FileId->rowAttributes() ?>>
        <label id="elh_exportlog_FileId" for="x_FileId" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FileId->caption() ?><?= $Page->FileId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->FileId->cellAttributes() ?>>
<span id="el_exportlog_FileId">
<input type="<?= $Page->FileId->getInputTextType() ?>" name="x_FileId" id="x_FileId" data-table="exportlog" data-field="x_FileId" value="<?= $Page->FileId->EditValue ?>" size="30" maxlength="36" placeholder="<?= HtmlEncode($Page->FileId->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->FileId->formatPattern()) ?>"<?= $Page->FileId->editAttributes() ?> aria-describedby="x_FileId_help">
<?= $Page->FileId->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FileId->getErrorMessage() ?></div>
<input type="hidden" data-table="exportlog" data-field="x_FileId" data-hidden="1" data-old name="o_FileId" id="o_FileId" value="<?= HtmlEncode($Page->FileId->OldValue ?? $Page->FileId->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DateTime->Visible) { // DateTime ?>
    <div id="r_DateTime"<?= $Page->DateTime->rowAttributes() ?>>
        <label id="elh_exportlog_DateTime" for="x_DateTime" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DateTime->caption() ?><?= $Page->DateTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DateTime->cellAttributes() ?>>
<span id="el_exportlog_DateTime">
<input type="<?= $Page->DateTime->getInputTextType() ?>" name="x_DateTime" id="x_DateTime" data-table="exportlog" data-field="x_DateTime" value="<?= $Page->DateTime->EditValue ?>" placeholder="<?= HtmlEncode($Page->DateTime->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->DateTime->formatPattern()) ?>"<?= $Page->DateTime->editAttributes() ?> aria-describedby="x_DateTime_help">
<?= $Page->DateTime->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DateTime->getErrorMessage() ?></div>
<?php if (!$Page->DateTime->ReadOnly && !$Page->DateTime->Disabled && !isset($Page->DateTime->EditAttrs["readonly"]) && !isset($Page->DateTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fexportlogedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fexportlogedit", "x_DateTime", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
    <div id="r_User"<?= $Page->User->rowAttributes() ?>>
        <label id="elh_exportlog_User" for="x_User" class="<?= $Page->LeftColumnClass ?>"><?= $Page->User->caption() ?><?= $Page->User->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->User->cellAttributes() ?>>
<span id="el_exportlog_User">
    <select
        id="x_User"
        name="x_User"
        class="form-select ew-select<?= $Page->User->isInvalidClass() ?>"
        <?php if (!$Page->User->IsNativeSelect) { ?>
        data-select2-id="fexportlogedit_x_User"
        <?php } ?>
        data-table="exportlog"
        data-field="x_User"
        data-value-separator="<?= $Page->User->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->User->getPlaceHolder()) ?>"
        <?= $Page->User->editAttributes() ?>>
        <?= $Page->User->selectOptionListHtml("x_User") ?>
    </select>
    <?= $Page->User->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->User->getErrorMessage() ?></div>
<?= $Page->User->Lookup->getParamTag($Page, "p_x_User") ?>
<?php if (!$Page->User->IsNativeSelect) { ?>
<script>
loadjs.ready("fexportlogedit", function() {
    var options = { name: "x_User", selectId: "fexportlogedit_x_User" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fexportlogedit.lists.User?.lookupOptions.length) {
        options.data = { id: "x_User", form: "fexportlogedit" };
    } else {
        options.ajax = { id: "x_User", form: "fexportlogedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.exportlog.fields.User.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_ExportType->Visible) { // ExportType ?>
    <div id="r__ExportType"<?= $Page->_ExportType->rowAttributes() ?>>
        <label id="elh_exportlog__ExportType" for="x__ExportType" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_ExportType->caption() ?><?= $Page->_ExportType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_ExportType->cellAttributes() ?>>
<span id="el_exportlog__ExportType">
<input type="<?= $Page->_ExportType->getInputTextType() ?>" name="x__ExportType" id="x__ExportType" data-table="exportlog" data-field="x__ExportType" value="<?= $Page->_ExportType->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_ExportType->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_ExportType->formatPattern()) ?>"<?= $Page->_ExportType->editAttributes() ?> aria-describedby="x__ExportType_help">
<?= $Page->_ExportType->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_ExportType->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_Table->Visible) { // Table ?>
    <div id="r__Table"<?= $Page->_Table->rowAttributes() ?>>
        <label id="elh_exportlog__Table" for="x__Table" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Table->caption() ?><?= $Page->_Table->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Table->cellAttributes() ?>>
<span id="el_exportlog__Table">
<input type="<?= $Page->_Table->getInputTextType() ?>" name="x__Table" id="x__Table" data-table="exportlog" data-field="x__Table" value="<?= $Page->_Table->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_Table->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_Table->formatPattern()) ?>"<?= $Page->_Table->editAttributes() ?> aria-describedby="x__Table_help">
<?= $Page->_Table->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Table->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KeyValue->Visible) { // KeyValue ?>
    <div id="r_KeyValue"<?= $Page->KeyValue->rowAttributes() ?>>
        <label id="elh_exportlog_KeyValue" for="x_KeyValue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KeyValue->caption() ?><?= $Page->KeyValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->KeyValue->cellAttributes() ?>>
<span id="el_exportlog_KeyValue">
<input type="<?= $Page->KeyValue->getInputTextType() ?>" name="x_KeyValue" id="x_KeyValue" data-table="exportlog" data-field="x_KeyValue" value="<?= $Page->KeyValue->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->KeyValue->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->KeyValue->formatPattern()) ?>"<?= $Page->KeyValue->editAttributes() ?> aria-describedby="x_KeyValue_help">
<?= $Page->KeyValue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeyValue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Filename->Visible) { // Filename ?>
    <div id="r_Filename"<?= $Page->Filename->rowAttributes() ?>>
        <label id="elh_exportlog_Filename" for="x_Filename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Filename->caption() ?><?= $Page->Filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Filename->cellAttributes() ?>>
<span id="el_exportlog_Filename">
<input type="<?= $Page->Filename->getInputTextType() ?>" name="x_Filename" id="x_Filename" data-table="exportlog" data-field="x_Filename" value="<?= $Page->Filename->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Filename->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Filename->formatPattern()) ?>"<?= $Page->Filename->editAttributes() ?> aria-describedby="x_Filename_help">
<?= $Page->Filename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Filename->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->__Request->Visible) { // Request ?>
    <div id="r___Request"<?= $Page->__Request->rowAttributes() ?>>
        <label id="elh_exportlog___Request" for="x___Request" class="<?= $Page->LeftColumnClass ?>"><?= $Page->__Request->caption() ?><?= $Page->__Request->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->__Request->cellAttributes() ?>>
<span id="el_exportlog___Request">
<textarea data-table="exportlog" data-field="x___Request" name="x___Request" id="x___Request" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->__Request->getPlaceHolder()) ?>"<?= $Page->__Request->editAttributes() ?> aria-describedby="x___Request_help"><?= $Page->__Request->EditValue ?></textarea>
<?= $Page->__Request->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->__Request->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fexportlogedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fexportlogedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("exportlog");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
