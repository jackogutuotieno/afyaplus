<?php

namespace PHPMaker2024\afyaplus;

// Table
$invoice_report = Container("invoice_report");
$invoice_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($invoice_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_invoice_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($invoice_report->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $invoice_report->patient_id->rowAttributes() ?>>
            <td class="<?= $invoice_report->TableLeftColumnClass ?>"><?= $invoice_report->patient_id->caption() ?></td>
            <td<?= $invoice_report->patient_id->cellAttributes() ?>>
<span id="el_invoice_report_patient_id">
<span<?= $invoice_report->patient_id->viewAttributes() ?>>
<?= $invoice_report->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoice_report->payment_status->Visible) { // payment_status ?>
        <tr id="r_payment_status"<?= $invoice_report->payment_status->rowAttributes() ?>>
            <td class="<?= $invoice_report->TableLeftColumnClass ?>"><?= $invoice_report->payment_status->caption() ?></td>
            <td<?= $invoice_report->payment_status->cellAttributes() ?>>
<span id="el_invoice_report_payment_status">
<span<?= $invoice_report->payment_status->viewAttributes() ?>>
<?= $invoice_report->payment_status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoice_report->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $invoice_report->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $invoice_report->TableLeftColumnClass ?>"><?= $invoice_report->created_by_user_id->caption() ?></td>
            <td<?= $invoice_report->created_by_user_id->cellAttributes() ?>>
<span id="el_invoice_report_created_by_user_id">
<span<?= $invoice_report->created_by_user_id->viewAttributes() ?>>
<?= $invoice_report->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoice_report->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $invoice_report->date_created->rowAttributes() ?>>
            <td class="<?= $invoice_report->TableLeftColumnClass ?>"><?= $invoice_report->date_created->caption() ?></td>
            <td<?= $invoice_report->date_created->cellAttributes() ?>>
<span id="el_invoice_report_date_created">
<span<?= $invoice_report->date_created->viewAttributes() ?>>
<?= $invoice_report->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
