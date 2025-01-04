<?php

namespace PHPMaker2024\afyaplus;

// Table
$ipd_patients = Container("ipd_patients");
$ipd_patients->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($ipd_patients->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ipd_patientsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($ipd_patients->id->Visible) { // id ?>
        <tr id="r_id"<?= $ipd_patients->id->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->id->caption() ?></td>
            <td<?= $ipd_patients->id->cellAttributes() ?>>
<span id="el_ipd_patients_id">
<span<?= $ipd_patients->id->viewAttributes() ?>>
<?= $ipd_patients->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $ipd_patients->patient_name->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->patient_name->caption() ?></td>
            <td<?= $ipd_patients->patient_name->cellAttributes() ?>>
<span id="el_ipd_patients_patient_name">
<span<?= $ipd_patients->patient_name->viewAttributes() ?>>
<?= $ipd_patients->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->national_id->Visible) { // national_id ?>
        <tr id="r_national_id"<?= $ipd_patients->national_id->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->national_id->caption() ?></td>
            <td<?= $ipd_patients->national_id->cellAttributes() ?>>
<span id="el_ipd_patients_national_id">
<span<?= $ipd_patients->national_id->viewAttributes() ?>>
<?= $ipd_patients->national_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->date_of_birth->Visible) { // date_of_birth ?>
        <tr id="r_date_of_birth"<?= $ipd_patients->date_of_birth->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->date_of_birth->caption() ?></td>
            <td<?= $ipd_patients->date_of_birth->cellAttributes() ?>>
<span id="el_ipd_patients_date_of_birth">
<span<?= $ipd_patients->date_of_birth->viewAttributes() ?>>
<?= $ipd_patients->date_of_birth->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->age->Visible) { // age ?>
        <tr id="r_age"<?= $ipd_patients->age->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->age->caption() ?></td>
            <td<?= $ipd_patients->age->cellAttributes() ?>>
<span id="el_ipd_patients_age">
<span<?= $ipd_patients->age->viewAttributes() ?>>
<?= $ipd_patients->age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->gender->Visible) { // gender ?>
        <tr id="r_gender"<?= $ipd_patients->gender->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->gender->caption() ?></td>
            <td<?= $ipd_patients->gender->cellAttributes() ?>>
<span id="el_ipd_patients_gender">
<span<?= $ipd_patients->gender->viewAttributes() ?>>
<?= $ipd_patients->gender->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ipd_patients->phone->Visible) { // phone ?>
        <tr id="r_phone"<?= $ipd_patients->phone->rowAttributes() ?>>
            <td class="<?= $ipd_patients->TableLeftColumnClass ?>"><?= $ipd_patients->phone->caption() ?></td>
            <td<?= $ipd_patients->phone->cellAttributes() ?>>
<span id="el_ipd_patients_phone">
<span<?= $ipd_patients->phone->viewAttributes() ?>>
<?= $ipd_patients->phone->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
