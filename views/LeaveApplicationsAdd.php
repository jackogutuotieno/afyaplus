<?php

namespace PHPMaker2024\afyaplus;

// Page object
$LeaveApplicationsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { leave_applications: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fleave_applicationsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fleave_applicationsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null], fields.user_id.isInvalid],
            ["leave_category_id", [fields.leave_category_id.visible && fields.leave_category_id.required ? ew.Validators.required(fields.leave_category_id.caption) : null], fields.leave_category_id.isInvalid],
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fleave_applicationsadd" id="fleave_applicationsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
        data-select2-id="fleave_applicationsadd_x_leave_category_id"
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
loadjs.ready("fleave_applicationsadd", function() {
    var options = { name: "x_leave_category_id", selectId: "fleave_applicationsadd_x_leave_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fleave_applicationsadd.lists.leave_category_id?.lookupOptions.length) {
        options.data = { id: "x_leave_category_id", form: "fleave_applicationsadd" };
    } else {
        options.ajax = { id: "x_leave_category_id", form: "fleave_applicationsadd", limit: ew.LOOKUP_PAGE_SIZE };
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fleave_applicationsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fleave_applicationsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("leave_applications");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
