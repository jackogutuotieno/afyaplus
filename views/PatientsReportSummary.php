<?php

namespace PHPMaker2024\afyaplus;

// Page object
$PatientsReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Patients_Report: currentTable } });
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
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
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
<div id="gmp_Patients_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Patients_Report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->national_id->Visible) { ?>
    <th data-name="national_id" class="<?= $Page->national_id->headerCellClass() ?>"><div class="Patients_Report_national_id"><?= $Page->renderFieldHeader($Page->national_id) ?></div></th>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
    <th data-name="date_of_birth" class="<?= $Page->date_of_birth->headerCellClass() ?>"><div class="Patients_Report_date_of_birth"><?= $Page->renderFieldHeader($Page->date_of_birth) ?></div></th>
<?php } ?>
<?php if ($Page->age->Visible) { ?>
    <th data-name="age" class="<?= $Page->age->headerCellClass() ?>"><div class="Patients_Report_age"><?= $Page->renderFieldHeader($Page->age) ?></div></th>
<?php } ?>
<?php if ($Page->gender->Visible) { ?>
    <th data-name="gender" class="<?= $Page->gender->headerCellClass() ?>"><div class="Patients_Report_gender"><?= $Page->renderFieldHeader($Page->gender) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { ?>
    <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div class="Patients_Report_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->email_address->Visible) { ?>
    <th data-name="email_address" class="<?= $Page->email_address->headerCellClass() ?>"><div class="Patients_Report_email_address"><?= $Page->renderFieldHeader($Page->email_address) ?></div></th>
<?php } ?>
<?php if ($Page->physical_address->Visible) { ?>
    <th data-name="physical_address" class="<?= $Page->physical_address->headerCellClass() ?>"><div class="Patients_Report_physical_address"><?= $Page->renderFieldHeader($Page->physical_address) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin->Visible) { ?>
    <th data-name="next_of_kin" class="<?= $Page->next_of_kin->headerCellClass() ?>"><div class="Patients_Report_next_of_kin"><?= $Page->renderFieldHeader($Page->next_of_kin) ?></div></th>
<?php } ?>
<?php if ($Page->next_of_kin_phone->Visible) { ?>
    <th data-name="next_of_kin_phone" class="<?= $Page->next_of_kin_phone->headerCellClass() ?>"><div class="Patients_Report_next_of_kin_phone"><?= $Page->renderFieldHeader($Page->next_of_kin_phone) ?></div></th>
<?php } ?>
<?php if ($Page->marital_status->Visible) { ?>
    <th data-name="marital_status" class="<?= $Page->marital_status->headerCellClass() ?>"><div class="Patients_Report_marital_status"><?= $Page->renderFieldHeader($Page->marital_status) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Patients_Report_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
    <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div class="Patients_Report_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
<?php if ($Page->national_id->Visible) { ?>
        <td data-field="national_id"<?= $Page->national_id->cellAttributes() ?>>
<span<?= $Page->national_id->viewAttributes() ?>>
<?= $Page->national_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { ?>
        <td data-field="date_of_birth"<?= $Page->date_of_birth->cellAttributes() ?>>
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->age->Visible) { ?>
        <td data-field="age"<?= $Page->age->cellAttributes() ?>>
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
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
<?php if ($Page->physical_address->Visible) { ?>
        <td data-field="physical_address"<?= $Page->physical_address->cellAttributes() ?>>
<span<?= $Page->physical_address->viewAttributes() ?>>
<?= $Page->physical_address->getViewValue() ?></span>
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
<?php if ($Page->marital_status->Visible) { ?>
        <td data-field="marital_status"<?= $Page->marital_status->cellAttributes() ?>>
<span<?= $Page->marital_status->viewAttributes() ?>>
<?= $Page->marital_status->getViewValue() ?></span>
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
