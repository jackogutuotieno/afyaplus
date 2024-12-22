<?php

namespace PHPMaker2024\afyaplus;

// Table
$laboratory_billing_report = Container("laboratory_billing_report");
$laboratory_billing_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($laboratory_billing_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_laboratory_billing_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($laboratory_billing_report->id->Visible) { // id ?>
        <tr id="r_id"<?= $laboratory_billing_report->id->rowAttributes() ?>>
            <td class="<?= $laboratory_billing_report->TableLeftColumnClass ?>"><?= $laboratory_billing_report->id->caption() ?></td>
            <td<?= $laboratory_billing_report->id->cellAttributes() ?>>
<span id="el_laboratory_billing_report_id">
<span<?= $laboratory_billing_report->id->viewAttributes() ?>>
<?= $laboratory_billing_report->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($laboratory_billing_report->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $laboratory_billing_report->patient_id->rowAttributes() ?>>
            <td class="<?= $laboratory_billing_report->TableLeftColumnClass ?>"><?= $laboratory_billing_report->patient_id->caption() ?></td>
            <td<?= $laboratory_billing_report->patient_id->cellAttributes() ?>>
<span id="el_laboratory_billing_report_patient_id">
<span<?= $laboratory_billing_report->patient_id->viewAttributes() ?>>
<?= $laboratory_billing_report->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($laboratory_billing_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $laboratory_billing_report->status->rowAttributes() ?>>
            <td class="<?= $laboratory_billing_report->TableLeftColumnClass ?>"><?= $laboratory_billing_report->status->caption() ?></td>
            <td<?= $laboratory_billing_report->status->cellAttributes() ?>>
<span id="el_laboratory_billing_report_status">
<span<?= $laboratory_billing_report->status->viewAttributes() ?>>
<?= $laboratory_billing_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($laboratory_billing_report->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $laboratory_billing_report->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $laboratory_billing_report->TableLeftColumnClass ?>"><?= $laboratory_billing_report->created_by_user_id->caption() ?></td>
            <td<?= $laboratory_billing_report->created_by_user_id->cellAttributes() ?>>
<span id="el_laboratory_billing_report_created_by_user_id">
<span<?= $laboratory_billing_report->created_by_user_id->viewAttributes() ?>>
<?= $laboratory_billing_report->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($laboratory_billing_report->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $laboratory_billing_report->date_created->rowAttributes() ?>>
            <td class="<?= $laboratory_billing_report->TableLeftColumnClass ?>"><?= $laboratory_billing_report->date_created->caption() ?></td>
            <td<?= $laboratory_billing_report->date_created->cellAttributes() ?>>
<span id="el_laboratory_billing_report_date_created">
<span<?= $laboratory_billing_report->date_created->viewAttributes() ?>>
<?= $laboratory_billing_report->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
