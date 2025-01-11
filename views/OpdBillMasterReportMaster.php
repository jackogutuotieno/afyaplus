<?php

namespace PHPMaker2024\afyaplus;

// Table
$opd_bill_master_report = Container("opd_bill_master_report");
$opd_bill_master_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($opd_bill_master_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_opd_bill_master_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($opd_bill_master_report->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $opd_bill_master_report->patient_name->rowAttributes() ?>>
            <td class="<?= $opd_bill_master_report->TableLeftColumnClass ?>"><?= $opd_bill_master_report->patient_name->caption() ?></td>
            <td<?= $opd_bill_master_report->patient_name->cellAttributes() ?>>
<span id="el_opd_bill_master_report_patient_name">
<span<?= $opd_bill_master_report->patient_name->viewAttributes() ?>>
<?= $opd_bill_master_report->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($opd_bill_master_report->payment_method->Visible) { // payment_method ?>
        <tr id="r_payment_method"<?= $opd_bill_master_report->payment_method->rowAttributes() ?>>
            <td class="<?= $opd_bill_master_report->TableLeftColumnClass ?>"><?= $opd_bill_master_report->payment_method->caption() ?></td>
            <td<?= $opd_bill_master_report->payment_method->cellAttributes() ?>>
<span id="el_opd_bill_master_report_payment_method">
<span<?= $opd_bill_master_report->payment_method->viewAttributes() ?>>
<?= $opd_bill_master_report->payment_method->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($opd_bill_master_report->company->Visible) { // company ?>
        <tr id="r_company"<?= $opd_bill_master_report->company->rowAttributes() ?>>
            <td class="<?= $opd_bill_master_report->TableLeftColumnClass ?>"><?= $opd_bill_master_report->company->caption() ?></td>
            <td<?= $opd_bill_master_report->company->cellAttributes() ?>>
<span id="el_opd_bill_master_report_company">
<span<?= $opd_bill_master_report->company->viewAttributes() ?>>
<?= $opd_bill_master_report->company->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($opd_bill_master_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $opd_bill_master_report->status->rowAttributes() ?>>
            <td class="<?= $opd_bill_master_report->TableLeftColumnClass ?>"><?= $opd_bill_master_report->status->caption() ?></td>
            <td<?= $opd_bill_master_report->status->cellAttributes() ?>>
<span id="el_opd_bill_master_report_status">
<span<?= $opd_bill_master_report->status->viewAttributes() ?>>
<?= $opd_bill_master_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($opd_bill_master_report->visit_date->Visible) { // visit_date ?>
        <tr id="r_visit_date"<?= $opd_bill_master_report->visit_date->rowAttributes() ?>>
            <td class="<?= $opd_bill_master_report->TableLeftColumnClass ?>"><?= $opd_bill_master_report->visit_date->caption() ?></td>
            <td<?= $opd_bill_master_report->visit_date->cellAttributes() ?>>
<span id="el_opd_bill_master_report_visit_date">
<span<?= $opd_bill_master_report->visit_date->viewAttributes() ?>>
<?= $opd_bill_master_report->visit_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
