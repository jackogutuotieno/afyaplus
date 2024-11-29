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
<?php if ($radiology_billing_report->id->Visible) { // id ?>
        <tr id="r_id"<?= $radiology_billing_report->id->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->id->caption() ?></td>
            <td<?= $radiology_billing_report->id->cellAttributes() ?>>
<span id="el_radiology_billing_report_id">
<span<?= $radiology_billing_report->id->viewAttributes() ?>>
<?= $radiology_billing_report->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
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
<?php if ($radiology_billing_report->visit_id->Visible) { // visit_id ?>
        <tr id="r_visit_id"<?= $radiology_billing_report->visit_id->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->visit_id->caption() ?></td>
            <td<?= $radiology_billing_report->visit_id->cellAttributes() ?>>
<span id="el_radiology_billing_report_visit_id">
<span<?= $radiology_billing_report->visit_id->viewAttributes() ?>>
<?= $radiology_billing_report->visit_id->getViewValue() ?></span>
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
<?php if ($radiology_billing_report->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $radiology_billing_report->date_updated->rowAttributes() ?>>
            <td class="<?= $radiology_billing_report->TableLeftColumnClass ?>"><?= $radiology_billing_report->date_updated->caption() ?></td>
            <td<?= $radiology_billing_report->date_updated->cellAttributes() ?>>
<span id="el_radiology_billing_report_date_updated">
<span<?= $radiology_billing_report->date_updated->viewAttributes() ?>>
<?= $radiology_billing_report->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
