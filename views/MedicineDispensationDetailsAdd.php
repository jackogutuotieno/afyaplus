<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineDispensationDetailsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { medicine_dispensation_details: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmedicine_dispensation_detailsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmedicine_dispensation_detailsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["medicine_dispensation_id", [fields.medicine_dispensation_id.visible && fields.medicine_dispensation_id.required ? ew.Validators.required(fields.medicine_dispensation_id.caption) : null, ew.Validators.integer], fields.medicine_dispensation_id.isInvalid],
            ["medicine_stock_id", [fields.medicine_stock_id.visible && fields.medicine_stock_id.required ? ew.Validators.required(fields.medicine_stock_id.caption) : null], fields.medicine_stock_id.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
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
            "medicine_stock_id": <?= $Page->medicine_stock_id->toClientList($Page) ?>,
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
<form name="fmedicine_dispensation_detailsadd" id="fmedicine_dispensation_detailsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="medicine_dispensation_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "medicine_dispensation") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="medicine_dispensation">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->medicine_dispensation_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->medicine_dispensation_id->Visible) { // medicine_dispensation_id ?>
    <div id="r_medicine_dispensation_id"<?= $Page->medicine_dispensation_id->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_details_medicine_dispensation_id" for="x_medicine_dispensation_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_dispensation_id->caption() ?><?= $Page->medicine_dispensation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_dispensation_id->cellAttributes() ?>>
<?php if ($Page->medicine_dispensation_id->getSessionValue() != "") { ?>
<span<?= $Page->medicine_dispensation_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->medicine_dispensation_id->getDisplayValue($Page->medicine_dispensation_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_medicine_dispensation_id" name="x_medicine_dispensation_id" value="<?= HtmlEncode($Page->medicine_dispensation_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_medicine_dispensation_details_medicine_dispensation_id">
<input type="<?= $Page->medicine_dispensation_id->getInputTextType() ?>" name="x_medicine_dispensation_id" id="x_medicine_dispensation_id" data-table="medicine_dispensation_details" data-field="x_medicine_dispensation_id" value="<?= $Page->medicine_dispensation_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->medicine_dispensation_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->medicine_dispensation_id->formatPattern()) ?>"<?= $Page->medicine_dispensation_id->editAttributes() ?> aria-describedby="x_medicine_dispensation_id_help">
<?= $Page->medicine_dispensation_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->medicine_dispensation_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medicine_stock_id->Visible) { // medicine_stock_id ?>
    <div id="r_medicine_stock_id"<?= $Page->medicine_stock_id->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_details_medicine_stock_id" for="x_medicine_stock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medicine_stock_id->caption() ?><?= $Page->medicine_stock_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->medicine_stock_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_medicine_stock_id">
    <select
        id="x_medicine_stock_id"
        name="x_medicine_stock_id"
        class="form-select ew-select<?= $Page->medicine_stock_id->isInvalidClass() ?>"
        <?php if (!$Page->medicine_stock_id->IsNativeSelect) { ?>
        data-select2-id="fmedicine_dispensation_detailsadd_x_medicine_stock_id"
        <?php } ?>
        data-table="medicine_dispensation_details"
        data-field="x_medicine_stock_id"
        data-value-separator="<?= $Page->medicine_stock_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->medicine_stock_id->getPlaceHolder()) ?>"
        <?= $Page->medicine_stock_id->editAttributes() ?>>
        <?= $Page->medicine_stock_id->selectOptionListHtml("x_medicine_stock_id") ?>
    </select>
    <?= $Page->medicine_stock_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->medicine_stock_id->getErrorMessage() ?></div>
<?= $Page->medicine_stock_id->Lookup->getParamTag($Page, "p_x_medicine_stock_id") ?>
<?php if (!$Page->medicine_stock_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fmedicine_dispensation_detailsadd", function() {
    var options = { name: "x_medicine_stock_id", selectId: "fmedicine_dispensation_detailsadd_x_medicine_stock_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmedicine_dispensation_detailsadd.lists.medicine_stock_id?.lookupOptions.length) {
        options.data = { id: "x_medicine_stock_id", form: "fmedicine_dispensation_detailsadd" };
    } else {
        options.ajax = { id: "x_medicine_stock_id", form: "fmedicine_dispensation_detailsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.medicine_dispensation_details.fields.medicine_stock_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_details_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="medicine_dispensation_details" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_details_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="medicine_dispensation_details" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_created->formatPattern()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_dispensation_detailsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmedicine_dispensation_detailsadd", "x_date_created", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_medicine_dispensation_details_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_medicine_dispensation_details_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="medicine_dispensation_details" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->date_updated->formatPattern()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedicine_dispensation_detailsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmedicine_dispensation_detailsadd", "x_date_updated", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmedicine_dispensation_detailsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmedicine_dispensation_detailsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("medicine_dispensation_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
