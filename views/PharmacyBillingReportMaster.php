<?php

namespace PHPMaker2024\afyaplus;

// Table
$pharmacy_billing_report = Container("pharmacy_billing_report");
$pharmacy_billing_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($pharmacy_billing_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pharmacy_billing_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($pharmacy_billing_report->id->Visible) { // id ?>
        <tr id="r_id"<?= $pharmacy_billing_report->id->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->id->caption() ?></td>
            <td<?= $pharmacy_billing_report->id->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_id">
<span<?= $pharmacy_billing_report->id->viewAttributes() ?>>
<?= $pharmacy_billing_report->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pharmacy_billing_report->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $pharmacy_billing_report->patient_id->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->patient_id->caption() ?></td>
            <td<?= $pharmacy_billing_report->patient_id->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_patient_id">
<span<?= $pharmacy_billing_report->patient_id->viewAttributes() ?>>
<?= $pharmacy_billing_report->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pharmacy_billing_report->dispensation_type->Visible) { // dispensation_type ?>
        <tr id="r_dispensation_type"<?= $pharmacy_billing_report->dispensation_type->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->dispensation_type->caption() ?></td>
            <td<?= $pharmacy_billing_report->dispensation_type->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_dispensation_type">
<span<?= $pharmacy_billing_report->dispensation_type->viewAttributes() ?>>
<?= $pharmacy_billing_report->dispensation_type->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pharmacy_billing_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $pharmacy_billing_report->status->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->status->caption() ?></td>
            <td<?= $pharmacy_billing_report->status->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_status">
<span<?= $pharmacy_billing_report->status->viewAttributes() ?>>
<?= $pharmacy_billing_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pharmacy_billing_report->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $pharmacy_billing_report->date_created->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->date_created->caption() ?></td>
            <td<?= $pharmacy_billing_report->date_created->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_date_created">
<span<?= $pharmacy_billing_report->date_created->viewAttributes() ?>>
<?= $pharmacy_billing_report->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pharmacy_billing_report->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $pharmacy_billing_report->date_updated->rowAttributes() ?>>
            <td class="<?= $pharmacy_billing_report->TableLeftColumnClass ?>"><?= $pharmacy_billing_report->date_updated->caption() ?></td>
            <td<?= $pharmacy_billing_report->date_updated->cellAttributes() ?>>
<span id="el_pharmacy_billing_report_date_updated">
<span<?= $pharmacy_billing_report->date_updated->viewAttributes() ?>>
<?= $pharmacy_billing_report->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
