<?php

namespace PHPMaker2024\afyaplus;

// Table
$patients = Container("patients");
$patients->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patients->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patientsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patients->id->Visible) { // id ?>
        <tr id="r_id"<?= $patients->id->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->id->caption() ?></td>
            <td<?= $patients->id->cellAttributes() ?>>
<span id="el_patients_id">
<span<?= $patients->id->viewAttributes() ?>>
<?= $patients->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->patient_name->Visible) { // patient_name ?>
        <tr id="r_patient_name"<?= $patients->patient_name->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->patient_name->caption() ?></td>
            <td<?= $patients->patient_name->cellAttributes() ?>>
<span id="el_patients_patient_name">
<span<?= $patients->patient_name->viewAttributes() ?>>
<?= $patients->patient_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->age->Visible) { // age ?>
        <tr id="r_age"<?= $patients->age->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->age->caption() ?></td>
            <td<?= $patients->age->cellAttributes() ?>>
<span id="el_patients_age">
<span<?= $patients->age->viewAttributes() ?>>
<?= $patients->age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->gender->Visible) { // gender ?>
        <tr id="r_gender"<?= $patients->gender->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->gender->caption() ?></td>
            <td<?= $patients->gender->cellAttributes() ?>>
<span id="el_patients_gender">
<span<?= $patients->gender->viewAttributes() ?>>
<?= $patients->gender->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patients->date_created->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->date_created->caption() ?></td>
            <td<?= $patients->date_created->cellAttributes() ?>>
<span id="el_patients_date_created">
<span<?= $patients->date_created->viewAttributes() ?>>
<?= $patients->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
