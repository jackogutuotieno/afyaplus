<?php

namespace PHPMaker2024\afyaplus;

// Table
$patient_ipd_prescriptions = Container("patient_ipd_prescriptions");
$patient_ipd_prescriptions->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patient_ipd_prescriptions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patient_ipd_prescriptionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patient_ipd_prescriptions->admission_id->Visible) { // admission_id ?>
        <tr id="r_admission_id"<?= $patient_ipd_prescriptions->admission_id->rowAttributes() ?>>
            <td class="<?= $patient_ipd_prescriptions->TableLeftColumnClass ?>"><?= $patient_ipd_prescriptions->admission_id->caption() ?></td>
            <td<?= $patient_ipd_prescriptions->admission_id->cellAttributes() ?>>
<span id="el_patient_ipd_prescriptions_admission_id">
<span<?= $patient_ipd_prescriptions->admission_id->viewAttributes() ?>>
<?= $patient_ipd_prescriptions->admission_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_ipd_prescriptions->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $patient_ipd_prescriptions->patient_id->rowAttributes() ?>>
            <td class="<?= $patient_ipd_prescriptions->TableLeftColumnClass ?>"><?= $patient_ipd_prescriptions->patient_id->caption() ?></td>
            <td<?= $patient_ipd_prescriptions->patient_id->cellAttributes() ?>>
<span id="el_patient_ipd_prescriptions_patient_id">
<span<?= $patient_ipd_prescriptions->patient_id->viewAttributes() ?>>
<?= $patient_ipd_prescriptions->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_ipd_prescriptions->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $patient_ipd_prescriptions->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $patient_ipd_prescriptions->TableLeftColumnClass ?>"><?= $patient_ipd_prescriptions->created_by_user_id->caption() ?></td>
            <td<?= $patient_ipd_prescriptions->created_by_user_id->cellAttributes() ?>>
<span id="el_patient_ipd_prescriptions_created_by_user_id">
<span<?= $patient_ipd_prescriptions->created_by_user_id->viewAttributes() ?>>
<?= $patient_ipd_prescriptions->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_ipd_prescriptions->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patient_ipd_prescriptions->date_created->rowAttributes() ?>>
            <td class="<?= $patient_ipd_prescriptions->TableLeftColumnClass ?>"><?= $patient_ipd_prescriptions->date_created->caption() ?></td>
            <td<?= $patient_ipd_prescriptions->date_created->cellAttributes() ?>>
<span id="el_patient_ipd_prescriptions_date_created">
<span<?= $patient_ipd_prescriptions->date_created->viewAttributes() ?>>
<?= $patient_ipd_prescriptions->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_ipd_prescriptions->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $patient_ipd_prescriptions->date_updated->rowAttributes() ?>>
            <td class="<?= $patient_ipd_prescriptions->TableLeftColumnClass ?>"><?= $patient_ipd_prescriptions->date_updated->caption() ?></td>
            <td<?= $patient_ipd_prescriptions->date_updated->cellAttributes() ?>>
<span id="el_patient_ipd_prescriptions_date_updated">
<span<?= $patient_ipd_prescriptions->date_updated->viewAttributes() ?>>
<?= $patient_ipd_prescriptions->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
