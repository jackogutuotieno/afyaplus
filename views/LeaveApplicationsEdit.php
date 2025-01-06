<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LeaveApplicationsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fleave_applicationsedit" id="fleave_applicationsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { leave_applications: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fleave_applicationsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_applicationsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
            ["leave_category_id", [fields.leave_category_id.visible && fields.leave_category_id.required ? ew.Validators.required(fields.leave_category_id.caption) : null], fields.leave_category_id.isInvalid],
            ["start_from_date", [fields.start_from_date.visible && fields.start_from_date.required ? ew.Validators.required(fields.start_from_date.caption) : null, ew.Validators.datetime(fields.start_from_date.clientFormatPattern)], fields.start_from_date.isInvalid],
            ["days_applied", [fields.days_applied.visible && fields.days_applied.required ? ew.Validators.required(fields.days_applied.caption) : null, ew.Validators.integer], fields.days_applied.isInvalid]
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
            "user_id": <?= $Page->user_id->toClientList($Page) ?>,
            "leave_category_id": <?= $Page->leave_category_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "employees_view") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="employees_view">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->user_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_leave_applications_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_leave_applications_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="leave_applications" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->leave_category_id->Visible) { // leave_category_id ?>
    <div id="r_leave_category_id"<?= $Page->leave_category_id->rowAttributes() ?>>
        <label id="elh_leave_applications_leave_category_id" for="x_leave_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->leave_category_id->caption() ?><?= $Page->leave_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->leave_category_id->cellAttributes() ?>>
<span id="el_leave_applications_leave_category_id">
    <select
        id="x_leave_category_id"
        name="x_leave_category_id"
        class="form-select ew-select<?= $Page->leave_category_id->isInvalidClass() ?>"
        <?php if (!$Page->leave_category_id->IsNativeSelect) { ?>
        data-select2-id="fleave_applicationsedit_x_leave_category_id"
        <?php } ?>
        data-table="leave_applications"
        data-field="x_leave_category_id"
        data-value-separator="<?= $Page->leave_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->leave_category_id->getPlaceHolder()) ?>"
        <?= $Page->leave_category_id->editAttributes() ?>>
        <?= $Page->leave_category_id->selectOptionListHtml("x_leave_category_id") ?>
    </select>
    <?= $Page->leave_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->leave_category_id->getErrorMessage() ?></div>
<?= $Page->leave_category_id->Lookup->getParamTag($Page, "p_x_leave_category_id") ?>
<?php if (!$Page->leave_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fleave_applicationsedit", function() {
    var options = { name: "x_leave_category_id", selectId: "fleave_applicationsedit_x_leave_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_applicationsedit.lists.leave_category_id?.lookupOptions.length) {
        options.data = { id: "x_leave_category_id", form: "fleave_applicationsedit" };
    } else {
        options.ajax = { id: "x_leave_category_id", form: "fleave_applicationsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.leave_applications.fields.leave_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->start_from_date->Visible) { // start_from_date ?>
    <div id="r_start_from_date"<?= $Page->start_from_date->rowAttributes() ?>>
        <label id="elh_leave_applications_start_from_date" for="x_start_from_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->start_from_date->caption() ?><?= $Page->start_from_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->start_from_date->cellAttributes() ?>>
<span id="el_leave_applications_start_from_date">
<input type="<?= $Page->start_from_date->getInputTextType() ?>" name="x_start_from_date" id="x_start_from_date" data-table="leave_applications" data-field="x_start_from_date" value="<?= $Page->start_from_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->start_from_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->start_from_date->formatPattern()) ?>"<?= $Page->start_from_date->editAttributes() ?> aria-describedby="x_start_from_date_help">
<?= $Page->start_from_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->start_from_date->getErrorMessage() ?></div>
<?php if (!$Page->start_from_date->ReadOnly && !$Page->start_from_date->Disabled && !isset($Page->start_from_date->EditAttrs["readonly"]) && !isset($Page->start_from_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(7) ?>",
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
    ew.createDateTimePicker("fleave_applicationsedit", "x_start_from_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->days_applied->Visible) { // days_applied ?>
    <div id="r_days_applied"<?= $Page->days_applied->rowAttributes() ?>>
        <label id="elh_leave_applications_days_applied" for="x_days_applied" class="<?= $Page->LeftColumnClass ?>"><?= $Page->days_applied->caption() ?><?= $Page->days_applied->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->days_applied->cellAttributes() ?>>
<span id="el_leave_applications_days_applied">
<input type="<?= $Page->days_applied->getInputTextType() ?>" name="x_days_applied" id="x_days_applied" data-table="leave_applications" data-field="x_days_applied" value="<?= $Page->days_applied->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->days_applied->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->days_applied->formatPattern()) ?>"<?= $Page->days_applied->editAttributes() ?> aria-describedby="x_days_applied_help">
<?= $Page->days_applied->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->days_applied->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fleave_applicationsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fleave_applicationsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("leave_applications");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
