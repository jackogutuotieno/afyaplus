<?php

namespace PHPMaker2024\afyaplus;

// Table
$radiology_billing_report = Container("radiology_billing_report");
$radiology_billing_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($radiology_billing_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_radiology_billing_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($radiology_billing_report->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $radiology_billing_report->patient_id->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->patient_id->caption() ?></td>
            <td<?= $radiology_billing_report->patient_id->cellAttributes() ?>>
<span id="el_radiology_billing_report_patient_id">
<span<?= $radiology_billing_report->patient_id->viewAttributes() ?>>
<?= $radiology_billing_report->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_billing_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $radiology_billing_report->status->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->status->caption() ?></td>
            <td<?= $radiology_billing_report->status->cellAttributes() ?>>
<span id="el_radiology_billing_report_status">
<span<?= $radiology_billing_report->status->viewAttributes() ?>>
<?= $radiology_billing_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_billing_report->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $radiology_billing_report->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->created_by_user_id->caption() ?></td>
            <td<?= $radiology_billing_report->created_by_user_id->cellAttributes() ?>>
<span id="el_radiology_billing_report_created_by_user_id">
<span<?= $radiology_billing_report->created_by_user_id->viewAttributes() ?>>
<?= $radiology_billing_report->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_billing_report->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $radiology_billing_report->date_created->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->date_created->caption() ?></td>
            <td<?= $radiology_billing_report->date_created->cellAttributes() ?>>
<span id="el_radiology_billing_report_date_created">
<span<?= $radiology_billing_report->date_created->viewAttributes() ?>>
<?= $radiology_billing_report->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
