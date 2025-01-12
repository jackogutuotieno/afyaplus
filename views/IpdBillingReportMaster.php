<?php

namespace PHPMaker2024\afyaplus;

// Table
$ipd_billing_report = Container("ipd_billing_report");
$ipd_billing_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($ipd_billing_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ipd_billing_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($ipd_billing_report->patient_uhid->Visible) { // patient_uhid ?>
        <tr id="r_patient_uhid"<?= $ipd_billing_report->patient_uhid->rowAttributes() ?>>
            <td class="<?= $ipd_billing_report->TableLeftColumnClass ?>"><?= $ipd_billing_report->patient_uhid->caption() ?></td>
            <td<?= $ipd_billing_report->patient_uhid->cellAttributes() ?>>
<span id="el_ipd_billing_report_patient_uhid">
<span<?= $ipd_billing_report->patient_uhid->viewAttributes() ?>>
<?= $ipd_billing_report->patient_uhid->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_billing_report->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $ipd_billing_report->patient_name->rowAttributes() ?>>
            <td class="<?= $ipd_billing_report->TableLeftColumnClass ?>"><?= $ipd_billing_report->patient_name->caption() ?></td>
            <td<?= $ipd_billing_report->patient_name->cellAttributes() ?>>
<span id="el_ipd_billing_report_patient_name">
<span<?= $ipd_billing_report->patient_name->viewAttributes() ?>>
<?= $ipd_billing_report->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_billing_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $ipd_billing_report->status->rowAttributes() ?>>
            <td class="<?= $ipd_billing_report->TableLeftColumnClass ?>"><?= $ipd_billing_report->status->caption() ?></td>
            <td<?= $ipd_billing_report->status->cellAttributes() ?>>
<span id="el_ipd_billing_report_status">
<span<?= $ipd_billing_report->status->viewAttributes() ?>>
<?= $ipd_billing_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_billing_report->date_admitted->Visible) { // date_admitted ?>
        <tr id="r_date_admitted"<?= $ipd_billing_report->date_admitted->rowAttributes() ?>>
            <td class="<?= $ipd_billing_report->TableLeftColumnClass ?>"><?= $ipd_billing_report->date_admitted->caption() ?></td>
            <td<?= $ipd_billing_report->date_admitted->cellAttributes() ?>>
<span id="el_ipd_billing_report_date_admitted">
<span<?= $ipd_billing_report->date_admitted->viewAttributes() ?>>
<?= $ipd_billing_report->date_admitted->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_billing_report->date_discharged->Visible) { // date_discharged ?>
        <tr id="r_date_discharged"<?= $ipd_billing_report->date_discharged->rowAttributes() ?>>
            <td class="<?= $ipd_billing_report->TableLeftColumnClass ?>"><?= $ipd_billing_report->date_discharged->caption() ?></td>
            <td<?= $ipd_billing_report->date_discharged->cellAttributes() ?>>
<span id="el_ipd_billing_report_date_discharged">
<span<?= $ipd_billing_report->date_discharged->viewAttributes() ?>>
<?= $ipd_billing_report->date_discharged->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
