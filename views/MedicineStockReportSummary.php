<?php

namespace PHPMaker2024\afyaplus;

// Page object
$MedicineStockReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Medicine_Stock_Report: currentTable } });
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
<div id="gmp_Medicine_Stock_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { ?>
    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div class="Medicine_Stock_Report_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->batch_number->Visible) { ?>
    <th data-name="batch_number" class="<?= $Page->batch_number->headerCellClass() ?>"><div class="Medicine_Stock_Report_batch_number"><?= $Page->renderFieldHeader($Page->batch_number) ?></div></th>
<?php } ?>
<?php if ($Page->brand_name->Visible) { ?>
    <th data-name="brand_name" class="<?= $Page->brand_name->headerCellClass() ?>"><div class="Medicine_Stock_Report_brand_name"><?= $Page->renderFieldHeader($Page->brand_name) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
    <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>"><div class="Medicine_Stock_Report_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { ?>
    <th data-name="measuring_unit" class="<?= $Page->measuring_unit->headerCellClass() ?>"><div class="Medicine_Stock_Report_measuring_unit"><?= $Page->renderFieldHeader($Page->measuring_unit) ?></div></th>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { ?>
    <th data-name="buying_price_per_unit" class="<?= $Page->buying_price_per_unit->headerCellClass() ?>"><div class="Medicine_Stock_Report_buying_price_per_unit"><?= $Page->renderFieldHeader($Page->buying_price_per_unit) ?></div></th>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { ?>
    <th data-name="selling_price_per_unit" class="<?= $Page->selling_price_per_unit->headerCellClass() ?>"><div class="Medicine_Stock_Report_selling_price_per_unit"><?= $Page->renderFieldHeader($Page->selling_price_per_unit) ?></div></th>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { ?>
    <th data-name="expiry_date" class="<?= $Page->expiry_date->headerCellClass() ?>"><div class="Medicine_Stock_Report_expiry_date"><?= $Page->renderFieldHeader($Page->expiry_date) ?></div></th>
<?php } ?>
<?php if ($Page->expiry_status_o->Visible) { ?>
    <th data-name="expiry_status_o" class="<?= $Page->expiry_status_o->headerCellClass() ?>"><div class="Medicine_Stock_Report_expiry_status_o"><?= $Page->renderFieldHeader($Page->expiry_status_o) ?></div></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { ?>
    <th data-name="date_created" class="<?= $Page->date_created->headerCellClass() ?>"><div class="Medicine_Stock_Report_date_created"><?= $Page->renderFieldHeader($Page->date_created) ?></div></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { ?>
    <th data-name="date_updated" class="<?= $Page->date_updated->headerCellClass() ?>"><div class="Medicine_Stock_Report_date_updated"><?= $Page->renderFieldHeader($Page->date_updated) ?></div></th>
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
<?php if ($Page->batch_number->Visible) { ?>
        <td data-field="batch_number"<?= $Page->batch_number->cellAttributes() ?>>
<span<?= $Page->batch_number->viewAttributes() ?>>
<?= $Page->batch_number->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->brand_name->Visible) { ?>
        <td data-field="brand_name"<?= $Page->brand_name->cellAttributes() ?>>
<span<?= $Page->brand_name->viewAttributes() ?>>
<?= $Page->brand_name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { ?>
        <td data-field="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->measuring_unit->Visible) { ?>
        <td data-field="measuring_unit"<?= $Page->measuring_unit->cellAttributes() ?>>
<span<?= $Page->measuring_unit->viewAttributes() ?>>
<?= $Page->measuring_unit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->buying_price_per_unit->Visible) { ?>
        <td data-field="buying_price_per_unit"<?= $Page->buying_price_per_unit->cellAttributes() ?>>
<span<?= $Page->buying_price_per_unit->viewAttributes() ?>>
<?= $Page->buying_price_per_unit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->selling_price_per_unit->Visible) { ?>
        <td data-field="selling_price_per_unit"<?= $Page->selling_price_per_unit->cellAttributes() ?>>
<span<?= $Page->selling_price_per_unit->viewAttributes() ?>>
<?= $Page->selling_price_per_unit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { ?>
        <td data-field="expiry_date"<?= $Page->expiry_date->cellAttributes() ?>>
<span<?= $Page->expiry_date->viewAttributes() ?>>
<?= $Page->expiry_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->expiry_status_o->Visible) { ?>
        <td data-field="expiry_status_o"<?= $Page->expiry_status_o->cellAttributes() ?>>
<span<?= $Page->expiry_status_o->viewAttributes() ?>>
<?= $Page->expiry_status_o->getViewValue() ?></span>
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
    $Page->StockUpdatebyMonth->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->StockUpdatebyMonth->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->StockbySupplier->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->StockbySupplier->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->StockbyExpiryStatus->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->StockbyExpiryStatus->render("ew-chart-bottom");
}
?>
<?php
if (!$DashboardReport) {
    // Set up chart drilldown
    $Page->StockbyMedicineBrand->DrillDownInPanel = $Page->DrillDownInPanel;
    echo $Page->StockbyMedicineBrand->render("ew-chart-bottom");
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
