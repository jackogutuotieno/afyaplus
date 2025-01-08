<?php

namespace PHPMaker2024\afyaplus;

// Dashboard Page object
$ProcurementOverview = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Procurement_Overview: currentTable } });
var currentPageID = ew.PAGE_ID = "dashboard";
var currentForm;
var fProcurement_Overviewsrch;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fProcurement_Overviewsrch")
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
                    Total Suppliers
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-boxes"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM suppliers";
                            $suppliers = ExecuteScalar($sql);
                            echo $suppliers;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Items Procured
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-boxes"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM item_purchases";
                            $procured = ExecuteScalar($sql);
                            echo $procured;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Procured Today
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-boxes"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM item_purchases WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $procured_today = ExecuteScalar($sql);
                            echo $procured_today;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Total Categories
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-boxes"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM item_categories";
                            $item_categories = ExecuteScalar($sql);
                            echo $item_categories;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Total Subcategories
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-boxes"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM item_subcategories";
                            $item_subcategories = ExecuteScalar($sql);
                            echo $item_subcategories;
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
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Procurement by Month</h4>
                    </div>
                    <div class="card-body">
                        <?= $ProcurementOverview->renderItem($this, 1) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Procurement by Year</h4>
                    </div>
                    <div class="card-body">
                        <?= $ProcurementOverview->renderItem($this, 2) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Procurement by Supplier</h4>
                    </div>
                    <div class="card-body">
                        <?= $ProcurementOverview->renderItem($this, 3) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Procurement by Category</h4>
                    </div>
                    <div class="card-body">
                        <?= $ProcurementOverview->renderItem($this, 4) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Procurement by Subcategory</h4>
                    </div>
                    <div class="card-body">
                        <?= $ProcurementOverview->renderItem($this, 5) ?>
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
<?php if ($ProcurementOverview->isExport() && !$ProcurementOverview->isExport("print")) { ?>
<script class="ew-export-dashboard">
loadjs.ready("load", function() {
    ew.exportCustom("ew-dashboard", "<?= $ProcurementOverview->Export ?>", "Procurement_Overview");
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
