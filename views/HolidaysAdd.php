<?php

namespace PHPMaker2024\afyaplus;

// Page object
$HolidaysAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { holidays: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fholidaysadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fholidaysadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["holiday_name", [fields.holiday_name.visible && fields.holiday_name.required ? ew.Validators.required(fields.holiday_name.caption) : null], fields.holiday_name.isInvalid],
            ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid]
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
<form name="fholidaysadd" id="fholidaysadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="holidays">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->holiday_name->Visible) { // holiday_name ?>
    <div id="r_holiday_name"<?= $Page->holiday_name->rowAttributes() ?>>
        <label id="elh_holidays_holiday_name" for="x_holiday_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->holiday_name->caption() ?><?= $Page->holiday_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->holiday_name->cellAttributes() ?>>
<span id="el_holidays_holiday_name">
<input type="<?= $Page->holiday_name->getInputTextType() ?>" name="x_holiday_name" id="x_holiday_name" data-table="holidays" data-field="x_holiday_name" value="<?= $Page->holiday_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->holiday_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->holiday_name->formatPattern()) ?>"<?= $Page->holiday_name->editAttributes() ?> aria-describedby="x_holiday_name_help">
<?= $Page->holiday_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->holiday_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_holidays_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_holidays_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="holidays" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date->formatPattern()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fholidaysadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fholidaysadd", "x_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fholidaysadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fholidaysadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("holidays");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
