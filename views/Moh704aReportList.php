<?php

namespace PHPMaker2024\afyaplus;

// Page object
$Moh704aReportList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { moh704a_report: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Dynamic selection lists
        .setLists({
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "countyName": <?= $Page->countyName->toClientList($Page) ?>,
            "subCounty": <?= $Page->subCounty->toClientList($Page) ?>,
            "marital_status": <?= $Page->marital_status->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
window.Tabulator || loadjs([
    ew.PATH_BASE + "js/tabulator.min.js?v=24.16.6",
    ew.PATH_BASE + "css/<?= CssFile("tabulator_bootstrap5.css", false) ?>?v=24.16.6"
], "import");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fmoh704a_reportsrch" id="fmoh704a_reportsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fmoh704a_reportsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { moh704a_report: currentTable } });
var currentForm;
var fmoh704a_reportsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fmoh704a_reportsrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Add fields
        .addFields([
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
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "countyName": <?= $Page->countyName->toClientList($Page) ?>,
            "subCounty": <?= $Page->subCounty->toClientList($Page) ?>,
            "marital_status": <?= $Page->marital_status->toClientList($Page) ?>,
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = RowType::SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->gender->Visible) { // gender ?>
<?php
if (!$Page->gender->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_gender" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->gender->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_gender"
            name="x_gender[]"
            class="form-control ew-select<?= $Page->gender->isInvalidClass() ?>"
            data-select2-id="fmoh704a_reportsrch_x_gender"
            data-table="moh704a_report"
            data-field="x_gender"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->gender->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->gender->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->gender->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->gender->editAttributes() ?>>
            <?= $Page->gender->selectOptionListHtml("x_gender", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->gender->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmoh704a_reportsrch", function() {
            var options = {
                name: "x_gender",
                selectId: "fmoh704a_reportsrch_x_gender",
                ajax: { id: "x_gender", form: "fmoh704a_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.moh704a_report.fields.gender.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
<?php
if (!$Page->countyName->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_countyName" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->countyName->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_countyName"
            name="x_countyName[]"
            class="form-control ew-select<?= $Page->countyName->isInvalidClass() ?>"
            data-select2-id="fmoh704a_reportsrch_x_countyName"
            data-table="moh704a_report"
            data-field="x_countyName"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->countyName->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->countyName->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->countyName->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->countyName->editAttributes() ?>>
            <?= $Page->countyName->selectOptionListHtml("x_countyName", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->countyName->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmoh704a_reportsrch", function() {
            var options = {
                name: "x_countyName",
                selectId: "fmoh704a_reportsrch_x_countyName",
                ajax: { id: "x_countyName", form: "fmoh704a_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.moh704a_report.fields.countyName.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
<?php
if (!$Page->subCounty->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_subCounty" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->subCounty->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_subCounty"
            name="x_subCounty[]"
            class="form-control ew-select<?= $Page->subCounty->isInvalidClass() ?>"
            data-select2-id="fmoh704a_reportsrch_x_subCounty"
            data-table="moh704a_report"
            data-field="x_subCounty"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->subCounty->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->subCounty->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->subCounty->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->subCounty->editAttributes() ?>>
            <?= $Page->subCounty->selectOptionListHtml("x_subCounty", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->subCounty->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmoh704a_reportsrch", function() {
            var options = {
                name: "x_subCounty",
                selectId: "fmoh704a_reportsrch_x_subCounty",
                ajax: { id: "x_subCounty", form: "fmoh704a_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.moh704a_report.fields.subCounty.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
<?php
if (!$Page->marital_status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_marital_status" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->marital_status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_marital_status"
            name="x_marital_status[]"
            class="form-control ew-select<?= $Page->marital_status->isInvalidClass() ?>"
            data-select2-id="fmoh704a_reportsrch_x_marital_status"
            data-table="moh704a_report"
            data-field="x_marital_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->marital_status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->marital_status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->marital_status->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->marital_status->editAttributes() ?>>
            <?= $Page->marital_status->selectOptionListHtml("x_marital_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->marital_status->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("fmoh704a_reportsrch", function() {
            var options = {
                name: "x_marital_status",
                selectId: "fmoh704a_reportsrch_x_marital_status",
                ajax: { id: "x_marital_status", form: "fmoh704a_reportsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.moh704a_report.fields.marital_status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmoh704a_reportsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmoh704a_reportsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmoh704a_reportsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmoh704a_reportsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="moh704a_report">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_moh704a_report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_moh704a_reportlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_moh704a_report_id" class="moh704a_report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_name->Visible) { // patient_name ?>
        <th data-name="patient_name" class="<?= $Page->patient_name->headerCellClass() ?>"><div id="elh_moh704a_report_patient_name" class="moh704a_report_patient_name"><?= $Page->renderFieldHeader($Page->patient_name) ?></div></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <th data-name="date_of_birth" class="<?= $Page->date_of_birth->headerCellClass() ?>"><div id="elh_moh704a_report_date_of_birth" class="moh704a_report_date_of_birth"><?= $Page->renderFieldHeader($Page->date_of_birth) ?></div></th>
<?php } ?>
<?php if ($Page->patient_age->Visible) { // patient_age ?>
        <th data-name="patient_age" class="<?= $Page->patient_age->headerCellClass() ?>"><div id="elh_moh704a_report_patient_age" class="moh704a_report_patient_age"><?= $Page->renderFieldHeader($Page->patient_age) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div id="elh_moh704a_report_gender" class="moh704a_report_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div id="elh_moh704a_report_phone" class="moh704a_report_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->email_address->Visible) { // email_address ?>
        <th data-name="email_address" class="<?= $Page->email_address->headerCellClass() ?>"><div id="elh_moh704a_report_email_address" class="moh704a_report_email_address"><?= $Page->renderFieldHeader($Page->email_address) ?></div></th>
<?php } ?>
<?php if ($Page->countyName->Visible) { // countyName ?>
        <th data-name="countyName" class="<?= $Page->countyName->headerCellClass() ?>"><div id="elh_moh704a_report_countyName" class="moh704a_report_countyName"><?= $Page->renderFieldHeader($Page->countyName) ?></div></th>
<?php } ?>
<?php if ($Page->subCounty->Visible) { // subCounty ?>
        <th data-name="subCounty" class="<?= $Page->subCounty->headerCellClass() ?>"><div id="elh_moh704a_report_subCounty" class="moh704a_report_subCounty"><?= $Page->renderFieldHeader($Page->subCounty) ?></div></th>
<?php } ?>
<?php if ($Page->marital_status->Visible) { // marital_status ?>
        <th data-name="marital_status" class="<?= $Page->marital_status->headerCellClass() ?>"><div id="elh_moh704a_report_marital_status" class="moh704a_report_marital_status"><?= $Page->renderFieldHeader($Page->marital_status) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
        <th data-name="next_of_kin" class="<?= $Page->next_of_kin->headerCellClass() ?>"><div id="elh_moh704a_report_next_of_kin" class="moh704a_report_next_of_kin"><?= $Page->renderFieldHeader($Page->next_of_kin) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
        <th data-name="next_of_kin_phone" class="<?= $Page->next_of_kin_phone->headerCellClass() ?>"><div id="elh_moh704a_report_next_of_kin_phone" class="moh704a_report_next_of_kin_phone"><?= $Page->renderFieldHeader($Page->next_of_kin_phone) ?></div></th>
<?php } ?>
<?php if ($Page->registration_date->Visible) { // registration_date ?>
        <th data-name="registration_date" class="<?= $Page->registration_date->headerCellClass() ?>"><div id="elh_moh704a_report_registration_date" class="moh704a_report_registration_date"><?= $Page->renderFieldHeader($Page->registration_date) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
$isInlineAddOrCopy = ($Page->isCopy() || $Page->isAdd());
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$' || $isInlineAddOrCopy && $Page->RowIndex == 0) {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        !($isInlineAddOrCopy && $Page->RowIndex == 0)
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_id" class="el_moh704a_report_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->patient_name->Visible) { // patient_name ?>
        <td data-name="patient_name"<?= $Page->patient_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_patient_name" class="el_moh704a_report_patient_name">
<span<?= $Page->patient_name->viewAttributes() ?>>
<?= $Page->patient_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
        <td data-name="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_date_of_birth" class="el_moh704a_report_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->patient_age->Visible) { // patient_age ?>
        <td data-name="patient_age"<?= $Page->patient_age->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_patient_age" class="el_moh704a_report_patient_age">
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gender->Visible) { // gender ?>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_gender" class="el_moh704a_report_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->phone->Visible) { // phone ?>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_phone" class="el_moh704a_report_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->email_address->Visible) { // email_address ?>
        <td data-name="email_address"<?= $Page->email_address->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_email_address" class="el_moh704a_report_email_address">
<span<?= $Page->email_address->viewAttributes() ?>>
<?= $Page->email_address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->countyName->Visible) { // countyName ?>
        <td data-name="countyName"<?= $Page->countyName->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_countyName" class="el_moh704a_report_countyName">
<span<?= $Page->countyName->viewAttributes() ?>>
<?= $Page->countyName->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subCounty->Visible) { // subCounty ?>
        <td data-name="subCounty"<?= $Page->subCounty->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_subCounty" class="el_moh704a_report_subCounty">
<span<?= $Page->subCounty->viewAttributes() ?>>
<?= $Page->subCounty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->marital_status->Visible) { // marital_status ?>
        <td data-name="marital_status"<?= $Page->marital_status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_marital_status" class="el_moh704a_report_marital_status">
<span<?= $Page->marital_status->viewAttributes() ?>>
<?= $Page->marital_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->next_of_kin->Visible) { // next_of_kin ?>
        <td data-name="next_of_kin"<?= $Page->next_of_kin->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_next_of_kin" class="el_moh704a_report_next_of_kin">
<span<?= $Page->next_of_kin->viewAttributes() ?>>
<?= $Page->next_of_kin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->next_of_kin_phone->Visible) { // next_of_kin_phone ?>
        <td data-name="next_of_kin_phone"<?= $Page->next_of_kin_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_next_of_kin_phone" class="el_moh704a_report_next_of_kin_phone">
<span<?= $Page->next_of_kin_phone->viewAttributes() ?>>
<?= $Page->next_of_kin_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->registration_date->Visible) { // registration_date ?>
        <td data-name="registration_date"<?= $Page->registration_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_moh704a_report_registration_date" class="el_moh704a_report_registration_date">
<span<?= $Page->registration_date->viewAttributes() ?>>
<?= $Page->registration_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("moh704a_report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
