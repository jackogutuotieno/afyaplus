<?php

namespace PHPMaker2024\afyaplus;

// Table
$patients_discharge = Container("patients_discharge");
$patients_discharge->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patients_discharge->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patients_dischargemaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patients_discharge->id->Visible) { // id ?>
        <tr id="r_id"<?= $patients_discharge->id->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->id->caption() ?></td>
            <td<?= $patients_discharge->id->cellAttributes() ?>>
<span id="el_patients_discharge_id">
<span<?= $patients_discharge->id->viewAttributes() ?>>
<?= $patients_discharge->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->admission_id->Visible) { // admission_id ?>
        <tr id="r_admission_id"<?= $patients_discharge->admission_id->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->admission_id->caption() ?></td>
            <td<?= $patients_discharge->admission_id->cellAttributes() ?>>
<span id="el_patients_discharge_admission_id">
<span<?= $patients_discharge->admission_id->viewAttributes() ?>>
<?= $patients_discharge->admission_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $patients_discharge->patient_id->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->patient_id->caption() ?></td>
            <td<?= $patients_discharge->patient_id->cellAttributes() ?>>
<span id="el_patients_discharge_patient_id">
<span<?= $patients_discharge->patient_id->viewAttributes() ?>>
<?= $patients_discharge->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->discharge->Visible) { // discharge ?>
        <tr id="r_discharge"<?= $patients_discharge->discharge->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->discharge->caption() ?></td>
            <td<?= $patients_discharge->discharge->cellAttributes() ?>>
<span id="el_patients_discharge_discharge">
<span<?= $patients_discharge->discharge->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_discharge_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $patients_discharge->discharge->getViewValue() ?>" disabled<?php if (ConvertToBool($patients_discharge->discharge->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_discharge_<?= $Page->RowCount ?>"></label>
</div>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->admission_reason->Visible) { // admission_reason ?>
        <tr id="r_admission_reason"<?= $patients_discharge->admission_reason->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->admission_reason->caption() ?></td>
            <td<?= $patients_discharge->admission_reason->cellAttributes() ?>>
<span id="el_patients_discharge_admission_reason">
<span<?= $patients_discharge->admission_reason->viewAttributes() ?>>
<?= $patients_discharge->admission_reason->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->discharge_condition->Visible) { // discharge_condition ?>
        <tr id="r_discharge_condition"<?= $patients_discharge->discharge_condition->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->discharge_condition->caption() ?></td>
            <td<?= $patients_discharge->discharge_condition->cellAttributes() ?>>
<span id="el_patients_discharge_discharge_condition">
<span<?= $patients_discharge->discharge_condition->viewAttributes() ?>>
<?= $patients_discharge->discharge_condition->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $patients_discharge->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->created_by_user_id->caption() ?></td>
            <td<?= $patients_discharge->created_by_user_id->cellAttributes() ?>>
<span id="el_patients_discharge_created_by_user_id">
<span<?= $patients_discharge->created_by_user_id->viewAttributes() ?>>
<?= $patients_discharge->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patients_discharge->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patients_discharge->date_created->rowAttributes() ?>>
            <td class="<?= $patients_discharge->TableLeftColumnClass ?>"><?= $patients_discharge->date_created->caption() ?></td>
            <td<?= $patients_discharge->date_created->cellAttributes() ?>>
<span id="el_patients_discharge_date_created">
<span<?= $patients_discharge->date_created->viewAttributes() ?>>
<?= $patients_discharge->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
