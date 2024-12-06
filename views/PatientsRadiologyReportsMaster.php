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
<?php if ($patients_radiology_reports->radiology_requests_id->Visible) { // radiology_requests_id ?>
        <tr id="r_radiology_requests_id"<?= $patients_radiology_reports->radiology_requests_id->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->radiology_requests_id->caption() ?></td>
            <td<?= $patients_radiology_reports->radiology_requests_id->cellAttributes() ?>>
<span id="el_patients_radiology_reports_radiology_requests_id">
<span<?= $patients_radiology_reports->radiology_requests_id->viewAttributes() ?>>
<?= $patients_radiology_reports->radiology_requests_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $patients_radiology_reports->patient_name->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->patient_name->caption() ?></td>
            <td<?= $patients_radiology_reports->patient_name->cellAttributes() ?>>
<span id="el_patients_radiology_reports_patient_name">
<span<?= $patients_radiology_reports->patient_name->viewAttributes() ?>>
<?= $patients_radiology_reports->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_radiology_reports->gender->Visible) { // gender ?>
        <tr id="r_gender"<?= $patients_radiology_reports->gender->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->gender->caption() ?></td>
            <td<?= $patients_radiology_reports->gender->cellAttributes() ?>>
<span id="el_patients_radiology_reports_gender">
<span<?= $patients_radiology_reports->gender->viewAttributes() ?>>
<?= $patients_radiology_reports->gender->getViewValue() ?></span>
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
<?php if ($patients_radiology_reports->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $patients_radiology_reports->date_updated->rowAttributes() ?>>
            <td class="<?= $patients_radiology_reports->TableLeftColumnClass ?>"><?= $patients_radiology_reports->date_updated->caption() ?></td>
            <td<?= $patients_radiology_reports->date_updated->cellAttributes() ?>>
<span id="el_patients_radiology_reports_date_updated">
<span<?= $patients_radiology_reports->date_updated->viewAttributes() ?>>
<?= $patients_radiology_reports->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
