<?php

namespace PHPMaker2024\afyaplus;

// Page object
$EmployeesViewList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { employees_view: currentTable } });
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
            "employee_name": <?= $Page->employee_name->toClientList($Page) ?>,
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "department_name": <?= $Page->department_name->toClientList($Page) ?>,
            "designation": <?= $Page->designation->toClientList($Page) ?>,
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
<form name="femployees_viewsrch" id="femployees_viewsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="femployees_viewsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { employees_view: currentTable } });
var currentForm;
var femployees_viewsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("femployees_viewsrch")
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
            "employee_name": <?= $Page->employee_name->toClientList($Page) ?>,
            "gender": <?= $Page->gender->toClientList($Page) ?>,
            "department_name": <?= $Page->department_name->toClientList($Page) ?>,
            "designation": <?= $Page->designation->toClientList($Page) ?>,
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
<?php if ($Page->employee_name->Visible) { // employee_name ?>
<?php
if (!$Page->employee_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_employee_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->employee_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_employee_name"
            name="x_employee_name[]"
            class="form-control ew-select<?= $Page->employee_name->isInvalidClass() ?>"
            data-select2-id="femployees_viewsrch_x_employee_name"
            data-table="employees_view"
            data-field="x_employee_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->employee_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->employee_name->editAttributes() ?>>
            <?= $Page->employee_name->selectOptionListHtml("x_employee_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("femployees_viewsrch", function() {
            var options = {
                name: "x_employee_name",
                selectId: "femployees_viewsrch_x_employee_name",
                ajax: { id: "x_employee_name", form: "femployees_viewsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.employees_view.fields.employee_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
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
            data-select2-id="femployees_viewsrch_x_gender"
            data-table="employees_view"
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
        loadjs.ready("femployees_viewsrch", function() {
            var options = {
                name: "x_gender",
                selectId: "femployees_viewsrch_x_gender",
                ajax: { id: "x_gender", form: "femployees_viewsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.employees_view.fields.gender.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->department_name->Visible) { // department_name ?>
<?php
if (!$Page->department_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_department_name" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->department_name->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_department_name"
            name="x_department_name[]"
            class="form-control ew-select<?= $Page->department_name->isInvalidClass() ?>"
            data-select2-id="femployees_viewsrch_x_department_name"
            data-table="employees_view"
            data-field="x_department_name"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->department_name->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->department_name->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->department_name->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->department_name->editAttributes() ?>>
            <?= $Page->department_name->selectOptionListHtml("x_department_name", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->department_name->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("femployees_viewsrch", function() {
            var options = {
                name: "x_department_name",
                selectId: "femployees_viewsrch_x_department_name",
                ajax: { id: "x_department_name", form: "femployees_viewsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.employees_view.fields.department_name.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->designation->Visible) { // designation ?>
<?php
if (!$Page->designation->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_designation" class="col-sm-auto d-sm-flex align-items-start mb-3 px-0 pe-sm-2<?= $Page->designation->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_designation"
            name="x_designation[]"
            class="form-control ew-select<?= $Page->designation->isInvalidClass() ?>"
            data-select2-id="femployees_viewsrch_x_designation"
            data-table="employees_view"
            data-field="x_designation"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->designation->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->designation->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->designation->getPlaceHolder()) ?>"
            data-ew-action="update-options"
            <?= $Page->designation->editAttributes() ?>>
            <?= $Page->designation->selectOptionListHtml("x_designation", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->designation->getErrorMessage(false) ?></div>
        <script>
        loadjs.ready("femployees_viewsrch", function() {
            var options = {
                name: "x_designation",
                selectId: "femployees_viewsrch_x_designation",
                ajax: { id: "x_designation", form: "femployees_viewsrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.employees_view.fields.designation.filterOptions);
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="femployees_viewsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="femployees_viewsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="femployees_viewsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="femployees_viewsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="employees_view">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_employees_view" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_employees_viewlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->employee_name->Visible) { // employee_name ?>
        <th data-name="employee_name" class="<?= $Page->employee_name->headerCellClass() ?>"><div id="elh_employees_view_employee_name" class="employees_view_employee_name"><?= $Page->renderFieldHeader($Page->employee_name) ?></div></th>
<?php } ?>
<?php if ($Page->national_id->Visible) { // national_id ?>
        <th data-name="national_id" class="<?= $Page->national_id->headerCellClass() ?>"><div id="elh_employees_view_national_id" class="employees_view_national_id"><?= $Page->renderFieldHeader($Page->national_id) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { // gender ?>
        <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div id="elh_employees_view_gender" class="employees_view_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div id="elh_employees_view_phone" class="employees_view_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_employees_view__email" class="employees_view__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->department_name->Visible) { // department_name ?>
        <th data-name="department_name" class="<?= $Page->department_name->headerCellClass() ?>"><div id="elh_employees_view_department_name" class="employees_view_department_name"><?= $Page->renderFieldHeader($Page->department_name) ?></div></th>
<?php } ?>
<?php if ($Page->designation->Visible) { // designation ?>
        <th data-name="designation" class="<?= $Page->designation->headerCellClass() ?>"><div id="elh_employees_view_designation" class="employees_view_designation"><?= $Page->renderFieldHeader($Page->designation) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div id="elh_employees_view_date_created" class="employees_view_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
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
    <?php if ($Page->employee_name->Visible) { // employee_name ?>
        <td data-name="employee_name"<?= $Page->employee_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_employee_name" class="el_employees_view_employee_name">
<span<?= $Page->employee_name->viewAttributes() ?>>
<?= $Page->employee_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->national_id->Visible) { // national_id ?>
        <td data-name="national_id"<?= $Page->national_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_national_id" class="el_employees_view_national_id">
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gender->Visible) { // gender ?>
        <td data-name="gender"<?= $Page->gender->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_gender" class="el_employees_view_gender">
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->phone->Visible) { // phone ?>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_phone" class="el_employees_view_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->phone->getViewValue()) && $Page->phone->linkAttributes() != "") { ?>
<a<?= $Page->phone->linkAttributes() ?>><?= $Page->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view__email" class="el_employees_view__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?php if (!EmptyString($Page->_email->getViewValue()) && $Page->_email->linkAttributes() != "") { ?>
<a<?= $Page->_email->linkAttributes() ?>><?= $Page->_email->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->_email->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->department_name->Visible) { // department_name ?>
        <td data-name="department_name"<?= $Page->department_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_department_name" class="el_employees_view_department_name">
<span<?= $Page->department_name->viewAttributes() ?>>
<?= $Page->department_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->designation->Visible) { // designation ?>
        <td data-name="designation"<?= $Page->designation->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_designation" class="el_employees_view_designation">
<span<?= $Page->designation->viewAttributes() ?>>
<?= $Page->designation->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_created->Visible) { // date_created ?>
        <td data-name="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_employees_view_date_created" class="el_employees_view_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
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
    ew.addEventHandlers("employees_view");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
