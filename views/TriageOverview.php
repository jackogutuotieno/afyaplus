<?php

namespace PHPMaker2024\afyaplus;

// Dashboard Page object
$TriageOverview = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Triage_Overview: currentTable } });
var currentPageID = ew.PAGE_ID = "dashboard";
var currentForm;
var fTriage_Overviewsrch;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fTriage_Overviewsrch")
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
                    All Time Visits
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-list"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_visits";
                            $patient_visits = ExecuteScalar($sql);
                            echo $patient_visits;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Today's Visits
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-list"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_visits WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $today_visits = ExecuteScalar($sql);
                            echo $today_visits;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Vitals
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-thermometer-half"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_vitals";
                            $vitals = ExecuteScalar($sql);
                            echo $vitals;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Vitals Today
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-users"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_vitals WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $vitals_today = ExecuteScalar($sql);
                            echo $vitals_today;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Vaccinations
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-syringe"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_vaccinations";
                            $vaccinations = ExecuteScalar($sql);
                            echo $vaccinations;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Vaccinations Today
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-users"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_vaccinations WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $vaccinations_today = ExecuteScalar($sql);
                            echo $vaccinations_today;
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
                        <h4>Vaccinations Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $TriageOverview->renderItem($this, 1) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Visits Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $TriageOverview->renderItem($this, 2) ?>
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
<?php if ($TriageOverview->isExport() && !$TriageOverview->isExport("print")) { ?>
<script class="ew-export-dashboard">
loadjs.ready("load", function() {
    ew.exportCustom("ew-dashboard", "<?= $TriageOverview->Export ?>", "Triage_Overview");
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
