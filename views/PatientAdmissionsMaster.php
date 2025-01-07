<?php

namespace PHPMaker2024\afyaplus;

// Table
$patient_admissions = Container("patient_admissions");
$patient_admissions->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patient_admissions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patient_admissionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patient_admissions->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $patient_admissions->patient_id->rowAttributes() ?>>
            <td class="<?= $patient_admissions->TableLeftColumnClass ?>"><?= $patient_admissions->patient_id->caption() ?></td>
            <td<?= $patient_admissions->patient_id->cellAttributes() ?>>
<span id="el_patient_admissions_patient_id">
<span<?= $patient_admissions->patient_id->viewAttributes() ?>>
<?= $patient_admissions->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_admissions->status->Visible) { // status ?>
        <tr id="r_status"<?= $patient_admissions->status->rowAttributes() ?>>
            <td class="<?= $patient_admissions->TableLeftColumnClass ?>"><?= $patient_admissions->status->caption() ?></td>
            <td<?= $patient_admissions->status->cellAttributes() ?>>
<span id="el_patient_admissions_status">
<span<?= $patient_admissions->status->viewAttributes() ?>>
<?= $patient_admissions->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_admissions->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patient_admissions->date_created->rowAttributes() ?>>
            <td class="<?= $patient_admissions->TableLeftColumnClass ?>"><?= $patient_admissions->date_created->caption() ?></td>
            <td<?= $patient_admissions->date_created->cellAttributes() ?>>
<span id="el_patient_admissions_date_created">
<span<?= $patient_admissions->date_created->viewAttributes() ?>>
<?= $patient_admissions->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
