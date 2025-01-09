<?php

namespace PHPMaker2024\afyaplus;

// Table
$discharge_summary_report = Container("discharge_summary_report");
$discharge_summary_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($discharge_summary_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_discharge_summary_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($discharge_summary_report->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $discharge_summary_report->patient_name->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->patient_name->caption() ?></td>
            <td<?= $discharge_summary_report->patient_name->cellAttributes() ?>>
<span id="el_discharge_summary_report_patient_name">
<span<?= $discharge_summary_report->patient_name->viewAttributes() ?>>
<?= $discharge_summary_report->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($discharge_summary_report->age->Visible) { // age ?>
        <tr id="r_age"<?= $discharge_summary_report->age->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->age->caption() ?></td>
            <td<?= $discharge_summary_report->age->cellAttributes() ?>>
<span id="el_discharge_summary_report_age">
<span<?= $discharge_summary_report->age->viewAttributes() ?>>
<?= $discharge_summary_report->age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($discharge_summary_report->gender->Visible) { // gender ?>
        <tr id="r_gender"<?= $discharge_summary_report->gender->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->gender->caption() ?></td>
            <td<?= $discharge_summary_report->gender->cellAttributes() ?>>
<span id="el_discharge_summary_report_gender">
<span<?= $discharge_summary_report->gender->viewAttributes() ?>>
<?= $discharge_summary_report->gender->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($discharge_summary_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $discharge_summary_report->status->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->status->caption() ?></td>
            <td<?= $discharge_summary_report->status->cellAttributes() ?>>
<span id="el_discharge_summary_report_status">
<span<?= $discharge_summary_report->status->viewAttributes() ?>>
<?= $discharge_summary_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($discharge_summary_report->admission_date->Visible) { // admission_date ?>
        <tr id="r_admission_date"<?= $discharge_summary_report->admission_date->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->admission_date->caption() ?></td>
            <td<?= $discharge_summary_report->admission_date->cellAttributes() ?>>
<span id="el_discharge_summary_report_admission_date">
<span<?= $discharge_summary_report->admission_date->viewAttributes() ?>>
<?= $discharge_summary_report->admission_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($discharge_summary_report->discharge_date->Visible) { // discharge_date ?>
        <tr id="r_discharge_date"<?= $discharge_summary_report->discharge_date->rowAttributes() ?>>
            <td class="<?= $discharge_summary_report->TableLeftColumnClass ?>"><?= $discharge_summary_report->discharge_date->caption() ?></td>
            <td<?= $discharge_summary_report->discharge_date->cellAttributes() ?>>
<span id="el_discharge_summary_report_discharge_date">
<span<?= $discharge_summary_report->discharge_date->viewAttributes() ?>>
<?= $discharge_summary_report->discharge_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
