<?php

namespace PHPMaker2024\afyaplus;

// Dashboard Page object
$FrontOfficeOverview = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Front_Office_Overview: currentTable } });
var currentPageID = ew.PAGE_ID = "dashboard";
var currentForm;
var fFront_Office_Overviewsrch;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fFront_Office_Overviewsrch")
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
                    Patients
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-hospital-user"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patients";
                            $patients = ExecuteScalar($sql);
                            echo $patients;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Registered Today
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-list"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patients WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $registered_today = ExecuteScalar($sql);
                            echo $registered_today;
                        ?>
                    </p>
                </div>
            </div>
        </div>
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
                    Appointments
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-calendar"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_appointments";
                            $appointments = ExecuteScalar($sql);
                            echo $appointments;
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card counters">
                <div class="card-header">
                    Today's Appointments
                </div>
                <div class="card-body d-flex align-items-center pt-0 pb-0">
                    <p class="card-text"><i class="fas fa-calendar"></i></p>
                    <p class="record-count">
                        <?php
                            $sql = "SELECT COUNT(*) FROM patient_appointments WHERE STR_TO_DATE(date_created,'%Y-%m-%d')=CURRENT_DATE()";
                            $today_appointments = ExecuteScalar($sql);
                            echo $today_appointments;
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
                        <h4>Registration Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $FrontOfficeOverview->renderItem($this, 1) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header content-header">
                        <h4>Visits Graph</h4>
                    </div>
                    <div class="card-body">
                        <?= $FrontOfficeOverview->renderItem($this, 2) ?>
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
<?php if ($FrontOfficeOverview->isExport() && !$FrontOfficeOverview->isExport("print")) { ?>
<script class="ew-export-dashboard">
loadjs.ready("load", function() {
    ew.exportCustom("ew-dashboard", "<?= $FrontOfficeOverview->Export ?>", "Front_Office_Overview");
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
