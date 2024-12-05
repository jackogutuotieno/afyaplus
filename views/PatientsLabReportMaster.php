<?php

namespace PHPMaker2024\afyaplus;

// Table
$patients_lab_report = Container("patients_lab_report");
$patients_lab_report->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patients_lab_report->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patients_lab_reportmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patients_lab_report->id->Visible) { // id ?>
        <tr id="r_id"<?= $patients_lab_report->id->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->id->caption() ?></td>
            <td<?= $patients_lab_report->id->cellAttributes() ?>>
<span id="el_patients_lab_report_id">
<span<?= $patients_lab_report->id->viewAttributes() ?>>
<?= $patients_lab_report->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $patients_lab_report->patient_name->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->patient_name->caption() ?></td>
            <td<?= $patients_lab_report->patient_name->cellAttributes() ?>>
<span id="el_patients_lab_report_patient_name">
<span<?= $patients_lab_report->patient_name->viewAttributes() ?>>
<?= $patients_lab_report->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->patient_age->Visible) { // patient_age ?>
        <tr id="r_patient_age"<?= $patients_lab_report->patient_age->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->patient_age->caption() ?></td>
            <td<?= $patients_lab_report->patient_age->cellAttributes() ?>>
<span id="el_patients_lab_report_patient_age">
<span<?= $patients_lab_report->patient_age->viewAttributes() ?>>
<?= $patients_lab_report->patient_age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->details->Visible) { // details ?>
        <tr id="r_details"<?= $patients_lab_report->details->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->details->caption() ?></td>
            <td<?= $patients_lab_report->details->cellAttributes() ?>>
<span id="el_patients_lab_report_details">
<span<?= $patients_lab_report->details->viewAttributes() ?>>
<?= $patients_lab_report->details->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->status->Visible) { // status ?>
        <tr id="r_status"<?= $patients_lab_report->status->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->status->caption() ?></td>
            <td<?= $patients_lab_report->status->cellAttributes() ?>>
<span id="el_patients_lab_report_status">
<span<?= $patients_lab_report->status->viewAttributes() ?>>
<?= $patients_lab_report->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->laboratorist->Visible) { // laboratorist ?>
        <tr id="r_laboratorist"<?= $patients_lab_report->laboratorist->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->laboratorist->caption() ?></td>
            <td<?= $patients_lab_report->laboratorist->cellAttributes() ?>>
<span id="el_patients_lab_report_laboratorist">
<span<?= $patients_lab_report->laboratorist->viewAttributes() ?>>
<?= $patients_lab_report->laboratorist->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patients_lab_report->date_created->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->date_created->caption() ?></td>
            <td<?= $patients_lab_report->date_created->cellAttributes() ?>>
<span id="el_patients_lab_report_date_created">
<span<?= $patients_lab_report->date_created->viewAttributes() ?>>
<?= $patients_lab_report->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_lab_report->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $patients_lab_report->date_updated->rowAttributes() ?>>
            <td class="<?= $patients_lab_report->TableLeftColumnClass ?>"><?= $patients_lab_report->date_updated->caption() ?></td>
            <td<?= $patients_lab_report->date_updated->cellAttributes() ?>>
<span id="el_patients_lab_report_date_updated">
<span<?= $patients_lab_report->date_updated->viewAttributes() ?>>
<?= $patients_lab_report->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
