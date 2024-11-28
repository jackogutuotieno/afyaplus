<?php

namespace PHPMaker2024\afyaplus;

// Table
$prescriptions = Container("prescriptions");
$prescriptions->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($prescriptions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_prescriptionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($prescriptions->id->Visible) { // id ?>
        <tr id="r_id"<?= $prescriptions->id->rowAttributes() ?>>
            <td class="<?= $prescriptions->TableLeftColumnClass ?>"><?= $prescriptions->id->caption() ?></td>
            <td<?= $prescriptions->id->cellAttributes() ?>>
<span id="el_prescriptions_id">
<span<?= $prescriptions->id->viewAttributes() ?>>
<?= $prescriptions->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($prescriptions->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $prescriptions->patient_id->rowAttributes() ?>>
            <td class="<?= $prescriptions->TableLeftColumnClass ?>"><?= $prescriptions->patient_id->caption() ?></td>
            <td<?= $prescriptions->patient_id->cellAttributes() ?>>
<span id="el_prescriptions_patient_id">
<span<?= $prescriptions->patient_id->viewAttributes() ?>>
<?= $prescriptions->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($prescriptions->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $prescriptions->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $prescriptions->TableLeftColumnClass ?>"><?= $prescriptions->created_by_user_id->caption() ?></td>
            <td<?= $prescriptions->created_by_user_id->cellAttributes() ?>>
<span id="el_prescriptions_created_by_user_id">
<span<?= $prescriptions->created_by_user_id->viewAttributes() ?>>
<?= $prescriptions->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($prescriptions->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $prescriptions->date_created->rowAttributes() ?>>
            <td class="<?= $prescriptions->TableLeftColumnClass ?>"><?= $prescriptions->date_created->caption() ?></td>
            <td<?= $prescriptions->date_created->cellAttributes() ?>>
<span id="el_prescriptions_date_created">
<span<?= $prescriptions->date_created->viewAttributes() ?>>
<?= $prescriptions->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($prescriptions->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $prescriptions->date_updated->rowAttributes() ?>>
            <td class="<?= $prescriptions->TableLeftColumnClass ?>"><?= $prescriptions->date_updated->caption() ?></td>
            <td<?= $prescriptions->date_updated->cellAttributes() ?>>
<span id="el_prescriptions_date_updated">
<span<?= $prescriptions->date_updated->viewAttributes() ?>>
<?= $prescriptions->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
