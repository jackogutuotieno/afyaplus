<?php

namespace PHPMaker2024\afyaplus;

// Table
$patients_radiology_reports = Container("patients_radiology_reports");
$patients_radiology_reports->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patients_radiology_reports->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patients_radiology_reportsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patients_radiology_reports->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $patients_radiology_reports->patient_id->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->patient_id->caption() ?></td>
            <td<?= $patients_radiology_reports->patient_id->cellAttributes() ?>>
<span id="el_patients_radiology_reports_patient_id">
<span<?= $patients_radiology_reports->patient_id->viewAttributes() ?>>
<?= $patients_radiology_reports->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->service_name->Visible) { // service_name ?>
        <tr id="r_service_name"<?= $patients_radiology_reports->service_name->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->service_name->caption() ?></td>
            <td<?= $patients_radiology_reports->service_name->cellAttributes() ?>>
<span id="el_patients_radiology_reports_service_name">
<span<?= $patients_radiology_reports->service_name->viewAttributes() ?>>
<?= $patients_radiology_reports->service_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->status->Visible) { // status ?>
        <tr id="r_status"<?= $patients_radiology_reports->status->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->status->caption() ?></td>
            <td<?= $patients_radiology_reports->status->cellAttributes() ?>>
<span id="el_patients_radiology_reports_status">
<span<?= $patients_radiology_reports->status->viewAttributes() ?>>
<?= $patients_radiology_reports->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->radiologist->Visible) { // radiologist ?>
        <tr id="r_radiologist"<?= $patients_radiology_reports->radiologist->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->radiologist->caption() ?></td>
            <td<?= $patients_radiology_reports->radiologist->cellAttributes() ?>>
<span id="el_patients_radiology_reports_radiologist">
<span<?= $patients_radiology_reports->radiologist->viewAttributes() ?>>
<?= $patients_radiology_reports->radiologist->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patients_radiology_reports->date_created->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->date_created->caption() ?></td>
            <td<?= $patients_radiology_reports->date_created->cellAttributes() ?>>
<span id="el_patients_radiology_reports_date_created">
<span<?= $patients_radiology_reports->date_created->viewAttributes() ?>>
<?= $patients_radiology_reports->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
