<?php

namespace PHPMaker2024\afyaplus;

// Page object
$InvoiceDetailsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { invoice_details: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var finvoice_detailsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvoice_detailsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["invoice_id", [fields.invoice_id.visible && fields.invoice_id.required ? ew.Validators.required(fields.invoice_id.caption) : null, ew.Validators.integer], fields.invoice_id.isInvalid],
            ["item", [fields.item.visible && fields.item.required ? ew.Validators.required(fields.item.caption) : null], fields.item.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["cost", [fields.cost.visible && fields.cost.required ? ew.Validators.required(fields.cost.caption) : null, ew.Validators.float], fields.cost.isInvalid],
            ["line_total", [fields.line_total.visible && fields.line_total.required ? ew.Validators.required(fields.line_total.caption) : null, ew.Validators.float], fields.line_total.isInvalid]
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
<form name="finvoice_detailsadd" id="finvoice_detailsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="invoice_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "invoices") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="invoices">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->invoice_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->invoice_id->Visible) { // invoice_id ?>
    <div id="r_invoice_id"<?= $Page->invoice_id->rowAttributes() ?>>
        <label id="elh_invoice_details_invoice_id" for="x_invoice_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice_id->caption() ?><?= $Page->invoice_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice_id->cellAttributes() ?>>
<?php if ($Page->invoice_id->getSessionValue() != "") { ?>
<span<?= $Page->invoice_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->invoice_id->getDisplayValue($Page->invoice_id->ViewValue))) ?>"></span>
<input type="hidden" id="x_invoice_id" name="x_invoice_id" value="<?= HtmlEncode($Page->invoice_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_invoice_details_invoice_id">
<input type="<?= $Page->invoice_id->getInputTextType() ?>" name="x_invoice_id" id="x_invoice_id" data-table="invoice_details" data-field="x_invoice_id" value="<?= $Page->invoice_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->invoice_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->invoice_id->formatPattern()) ?>"<?= $Page->invoice_id->editAttributes() ?> aria-describedby="x_invoice_id_help">
<?= $Page->invoice_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item->Visible) { // item ?>
    <div id="r_item"<?= $Page->item->rowAttributes() ?>>
        <label id="elh_invoice_details_item" for="x_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item->caption() ?><?= $Page->item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item->cellAttributes() ?>>
<span id="el_invoice_details_item">
<input type="<?= $Page->item->getInputTextType() ?>" name="x_item" id="x_item" data-table="invoice_details" data-field="x_item" value="<?= $Page->item->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->item->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->item->formatPattern()) ?>"<?= $Page->item->editAttributes() ?> aria-describedby="x_item_help">
<?= $Page->item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_invoice_details_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_invoice_details_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="invoice_details" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cost->Visible) { // cost ?>
    <div id="r_cost"<?= $Page->cost->rowAttributes() ?>>
        <label id="elh_invoice_details_cost" for="x_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cost->caption() ?><?= $Page->cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cost->cellAttributes() ?>>
<span id="el_invoice_details_cost">
<input type="<?= $Page->cost->getInputTextType() ?>" name="x_cost" id="x_cost" data-table="invoice_details" data-field="x_cost" value="<?= $Page->cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->cost->formatPattern()) ?>"<?= $Page->cost->editAttributes() ?> aria-describedby="x_cost_help">
<?= $Page->cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_total->Visible) { // line_total ?>
    <div id="r_line_total"<?= $Page->line_total->rowAttributes() ?>>
        <label id="elh_invoice_details_line_total" for="x_line_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_total->caption() ?><?= $Page->line_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_total->cellAttributes() ?>>
<span id="el_invoice_details_line_total">
<input type="<?= $Page->line_total->getInputTextType() ?>" name="x_line_total" id="x_line_total" data-table="invoice_details" data-field="x_line_total" value="<?= $Page->line_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->line_total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->line_total->formatPattern()) ?>"<?= $Page->line_total->editAttributes() ?> aria-describedby="x_line_total_help">
<?= $Page->line_total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->line_total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="finvoice_detailsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="finvoice_detailsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("invoice_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
