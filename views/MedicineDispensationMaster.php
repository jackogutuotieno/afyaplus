<?php

namespace PHPMaker2024\afyaplus;

// Table
$medicine_dispensation = Container("medicine_dispensation");
$medicine_dispensation->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($medicine_dispensation->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_medicine_dispensationmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($medicine_dispensation->id->Visible) { // id ?>
        <tr id="r_id"<?= $medicine_dispensation->id->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->id->caption() ?></td>
            <td<?= $medicine_dispensation->id->cellAttributes() ?>>
<span id="el_medicine_dispensation_id">
<span<?= $medicine_dispensation->id->viewAttributes() ?>>
<?= $medicine_dispensation->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $medicine_dispensation->patient_id->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->patient_id->caption() ?></td>
            <td<?= $medicine_dispensation->patient_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_patient_id">
<span<?= $medicine_dispensation->patient_id->viewAttributes() ?>>
<?= $medicine_dispensation->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->prescription_id->Visible) { // prescription_id ?>
        <tr id="r_prescription_id"<?= $medicine_dispensation->prescription_id->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->prescription_id->caption() ?></td>
            <td<?= $medicine_dispensation->prescription_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_prescription_id">
<span<?= $medicine_dispensation->prescription_id->viewAttributes() ?>>
<?= $medicine_dispensation->prescription_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->dispensation_type->Visible) { // dispensation_type ?>
        <tr id="r_dispensation_type"<?= $medicine_dispensation->dispensation_type->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->dispensation_type->caption() ?></td>
            <td<?= $medicine_dispensation->dispensation_type->cellAttributes() ?>>
<span id="el_medicine_dispensation_dispensation_type">
<span<?= $medicine_dispensation->dispensation_type->viewAttributes() ?>>
<?= $medicine_dispensation->dispensation_type->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->status->Visible) { // status ?>
        <tr id="r_status"<?= $medicine_dispensation->status->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->status->caption() ?></td>
            <td<?= $medicine_dispensation->status->cellAttributes() ?>>
<span id="el_medicine_dispensation_status">
<span<?= $medicine_dispensation->status->viewAttributes() ?>>
<?= $medicine_dispensation->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $medicine_dispensation->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->created_by_user_id->caption() ?></td>
            <td<?= $medicine_dispensation->created_by_user_id->cellAttributes() ?>>
<span id="el_medicine_dispensation_created_by_user_id">
<span<?= $medicine_dispensation->created_by_user_id->viewAttributes() ?>>
<?= $medicine_dispensation->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_dispensation->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $medicine_dispensation->date_created->rowAttributes() ?>>
            <td class="<?= $medicine_dispensation->TableLeftColumnClass ?>"><?= $medicine_dispensation->date_created->caption() ?></td>
            <td<?= $medicine_dispensation->date_created->cellAttributes() ?>>
<span id="el_medicine_dispensation_date_created">
<span<?= $medicine_dispensation->date_created->viewAttributes() ?>>
<?= $medicine_dispensation->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
