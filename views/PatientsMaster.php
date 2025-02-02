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
<?php if ($patients->national_id->Visible) { // national_id ?>
        <tr id="r_national_id"<?= $patients->national_id->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->national_id->caption() ?></td>
            <td<?= $patients->national_id->cellAttributes() ?>>
<span id="el_patients_national_id">
<span<?= $patients->national_id->viewAttributes() ?>>
<?= $patients->national_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->date_of_birth->Visible) { // date_of_birth ?>
        <tr id="r_date_of_birth"<?= $patients->date_of_birth->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->date_of_birth->caption() ?></td>
            <td<?= $patients->date_of_birth->cellAttributes() ?>>
<span id="el_patients_date_of_birth">
<span<?= $patients->date_of_birth->viewAttributes() ?>>
<?= $patients->date_of_birth->getViewValue() ?></span>
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
<?php if ($patients->phone->Visible) { // phone ?>
        <tr id="r_phone"<?= $patients->phone->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->phone->caption() ?></td>
            <td<?= $patients->phone->cellAttributes() ?>>
<span id="el_patients_phone">
<span<?= $patients->phone->viewAttributes() ?>>
<?php if (!EmptyString($patients->phone->getViewValue()) && $patients->phone->linkAttributes() != "") { ?>
<a<?= $patients->phone->linkAttributes() ?>><?= $patients->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $patients->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->email_address->Visible) { // email_address ?>
        <tr id="r_email_address"<?= $patients->email_address->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->email_address->caption() ?></td>
            <td<?= $patients->email_address->cellAttributes() ?>>
<span id="el_patients_email_address">
<span<?= $patients->email_address->viewAttributes() ?>>
<?php if (!EmptyString($patients->email_address->getViewValue()) && $patients->email_address->linkAttributes() != "") { ?>
<a<?= $patients->email_address->linkAttributes() ?>><?= $patients->email_address->getViewValue() ?></a>
<?php } else { ?>
<?= $patients->email_address->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->county_id->Visible) { // county_id ?>
        <tr id="r_county_id"<?= $patients->county_id->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->county_id->caption() ?></td>
            <td<?= $patients->county_id->cellAttributes() ?>>
<span id="el_patients_county_id">
<span<?= $patients->county_id->viewAttributes() ?>>
<?= $patients->county_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients->subcounty_id->Visible) { // subcounty_id ?>
        <tr id="r_subcounty_id"<?= $patients->subcounty_id->rowAttributes() ?>>
            <td class="<?= $patients->TableLeftColumnClass ?>"><?= $patients->subcounty_id->caption() ?></td>
            <td<?= $patients->subcounty_id->cellAttributes() ?>>
<span id="el_patients_subcounty_id">
<span<?= $patients->subcounty_id->viewAttributes() ?>>
<?= $patients->subcounty_id->getViewValue() ?></span>
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
