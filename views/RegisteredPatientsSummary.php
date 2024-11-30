<?php

namespace PHPMaker2024\afyaplus;

// Page object
$RegisteredPatientsSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Registered_Patients: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<form name="fRegistered_Patientssrch" id="fRegistered_Patientssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fRegistered_Patientssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Registered_Patients: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
var fRegistered_Patientssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fRegistered_Patientssrch")
        .setPageId("summary")
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
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
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
            data-select2-id="fRegistered_Patientssrch_x_gender"
            data-table="Registered_Patients"
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
        <div class="invalid-feedback"><?= $Page->gender->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fRegistered_Patientssrch", function() {
            var options = {
                name: "x_gender",
                selectId: "fRegistered_Patientssrch_x_gender",
                ajax: { id: "x_gender", form: "fRegistered_Patientssrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Registered_Patients.fields.gender.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
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
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Middle Container -->
<div id="ew-middle" class="<?= $Page->MiddleContentClass ?>">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-content" class="<?= $Page->ContainerClass ?>">
<?php } ?>
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?= $Page->ReportContainerClass ?>">
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Registered_Patients" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Registered_Patients_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->patient_full_name->Visible) { ?>
    <th data-name="patient_full_name" class="<?= $Page->patient_full_name->headerCellClass() ?>"><div class="Registered_Patients_patient_full_name"><?= $Page->renderFieldHeader($Page->patient_full_name) ?></div></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
    <th data-name="date_of_birth" class="<?= $Page->date_of_birth->headerCellClass() ?>"><div class="Registered_Patients_date_of_birth"><?= $Page->renderFieldHeader($Page->date_of_birth) ?></div></th>
<?php } ?>
<?php if ($Page->patient_age->Visible) { ?>
    <th data-name="patient_age" class="<?= $Page->patient_age->headerCellClass() ?>"><div class="Registered_Patients_patient_age"><?= $Page->renderFieldHeader($Page->patient_age) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
    <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div class="Registered_Patients_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { ?>
    <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div class="Registered_Patients_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->email_address->Visible) { ?>
    <th data-name="email_address" class="<?= $Page->email_address->headerCellClass() ?>"><div class="Registered_Patients_email_address"><?= $Page->renderFieldHeader($Page->email_address) ?></div></th>
<?php } ?>
<?php if ($Page->marital_status->Visible) { ?>
    <th data-name="marital_status" class="<?= $Page->marital_status->headerCellClass() ?>"><div class="Registered_Patients_marital_status"><?= $Page->renderFieldHeader($Page->marital_status) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { ?>
    <th data-name="next_of_kin" class="<?= $Page->next_of_kin->headerCellClass() ?>"><div class="Registered_Patients_next_of_kin"><?= $Page->renderFieldHeader($Page->next_of_kin) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { ?>
    <th data-name="next_of_kin_phone" class="<?= $Page->next_of_kin_phone->headerCellClass() ?>"><div class="Registered_Patients_next_of_kin_phone"><?= $Page->renderFieldHeader($Page->next_of_kin_phone) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Registered_Patients_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
    <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div class="Registered_Patients_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
<?php } ?>
<?php if ($Page->registration_month->Visible) { ?>
    <th data-name="registration_month" class="<?= $Page->registration_month->headerCellClass() ?>"><div class="Registered_Patients_registration_month"><?= $Page->renderFieldHeader($Page->registration_month) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = RowType::DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id->Visible) { ?>
        <td data-field="id"<?= $Page->id->cellAttributes() ?>>
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->patient_full_name->Visible) { ?>
        <td data-field="patient_full_name"<?= $Page->patient_full_name->cellAttributes() ?>>
<span<?= $Page->patient_full_name->viewAttributes() ?>>
<?= $Page->patient_full_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
        <td data-field="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->patient_age->Visible) { ?>
        <td data-field="patient_age"<?= $Page->patient_age->cellAttributes() ?>>
<span<?= $Page->patient_age->viewAttributes() ?>>
<?= $Page->patient_age->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
        <td data-field="gender"<?= $Page->gender->cellAttributes() ?>>
<span<?= $Page->gender->viewAttributes() ?>>
<?= $Page->gender->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { ?>
        <td data-field="phone"<?= $Page->phone->cellAttributes() ?>>
<span<?= $Page->phone->viewAttributes() ?>>
<?php if (!EmptyString($Page->phone->getViewValue()) && $Page->phone->linkAttributes() != "") { ?>
<a<?= $Page->phone->linkAttributes() ?>><?= $Page->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->phone->getViewValue() ?>
<?php } ?>
</span>
</td>
<?php } ?>
<?php if ($Page->email_address->Visible) { ?>
        <td data-field="email_address"<?= $Page->email_address->cellAttributes() ?>>
<span<?= $Page->email_address->viewAttributes() ?>>
<?php if (!EmptyString($Page->email_address->getViewValue()) && $Page->email_address->linkAttributes() != "") { ?>
<a<?= $Page->email_address->linkAttributes() ?>><?= $Page->email_address->getViewValue() ?></a>
<?php } else { ?>
<?= $Page->email_address->getViewValue() ?>
<?php } ?>
</span>
</td>
<?php } ?>
<?php if ($Page->marital_status->Visible) { ?>
        <td data-field="marital_status"<?= $Page->marital_status->cellAttributes() ?>>
<span<?= $Page->marital_status->viewAttributes() ?>>
<?= $Page->marital_status->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { ?>
        <td data-field="next_of_kin"<?= $Page->next_of_kin->cellAttributes() ?>>
<span<?= $Page->next_of_kin->viewAttributes() ?>>
<?= $Page->next_of_kin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { ?>
        <td data-field="next_of_kin_phone"<?= $Page->next_of_kin_phone->cellAttributes() ?>>
<span<?= $Page->next_of_kin_phone->viewAttributes() ?>>
<?= $Page->next_of_kin_phone->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
        <td data-field="date_created"<?= $Page->date_created->cellAttributes() ?>>
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
        <td data-field="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->registration_month->Visible) { ?>
        <td data-field="registration_month"<?= $Page->registration_month->cellAttributes() ?>>
<span<?= $Page->registration_month->viewAttributes() ?>>
<?= $Page->registration_month->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = RowType::TOTAL;
    $Page->RowTotalType = RowSummary::GRAND;
    $Page->RowTotalSubType = RowTotal::FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Page->TotalGroups > 0) { ?>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</main>
<!-- /.report-summary -->
<!-- Summary report (end) -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-content -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-middle -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->RegisteredPatientsbyMonth->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->RegisteredPatientsbyMonth->render("ew-chart-bottom");
}
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if (!$DashboardReport && !$Page->isExport() && !$Page->DrillDown) { ?>
<div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
