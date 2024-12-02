<?php

namespace PHPMaker2024\afyaplus;

// Dashboard Page object
$FinancialsOverview = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Financials_Overview: currentTable } });
var currentPageID = ew.PAGE_ID = "dashboard";
var currentForm;
var fFinancials_Overviewsrch;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fFinancials_Overviewsrch")
        .setPageId("dashboard")
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
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar">
<?php
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="ew-dashboard">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Total Income (Kshs)
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-money-bill"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT SUM(cost) FROM income_report";
                            $income_report = ExecuteScalar($sql);
                            echo $income_report;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Total Expenses (Kshs)
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-money-bill"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT SUM(cost) FROM expenses_report";
                            $expenses_report = ExecuteScalar($sql);
                            echo $expenses_report;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Total Invoices
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-invoice"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM invoices";
                            $invoices = ExecuteScalar($sql);
                            echo $invoices;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Today's Invoices
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-invoice"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM invoices WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $invoices_today = ExecuteScalar($sql);
                            echo $invoices_today;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Paid Invoices
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-invoice"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM invoices WHERE payment_status='Paid'";
                            $paid_today = ExecuteScalar($sql);
                            echo $paid_today;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Voided Invoices
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-invoice"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM invoices WHERE payment_status='Voided'";
                            $voided_invoices = ExecuteScalar($sql);
                            echo $voided_invoices;
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chart-content container">
    <div class="row">
        <div class="card-group">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Income Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $FinancialsOverview->renderItem($this, 1) ?>
                    </div>
                </div>
            </div>
                        <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Expenses Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $FinancialsOverview->renderItem($this, 2) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<script>
loadjs.ready("load", () => jQuery('[data-card-widget="card-refresh"]')
    .on("loaded.fail.lte.cardrefresh", (e, jqXHR, textStatus, errorThrown) => console.error(errorThrown))
    .on("loaded.success.lte.cardrefresh", (e, result) => !ew.getError(result) || console.error(result)));
</script>
<?php if ($FinancialsOverview->isExport() && !$FinancialsOverview->isExport("print")) { ?>
<script class="ew-export-dashboard">
loadjs.ready("load", function() {
    ew.exportCustom("ew-dashboard", "<?= $FinancialsOverview->Export ?>", "Financials_Overview");
    loadjs.done("exportdashboard");
});
</script>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
