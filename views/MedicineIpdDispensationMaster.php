<?php

namespace PHPMaker2024\afyaplus;

// Table
$medicine_ipd_dispensation = Container("medicine_ipd_dispensation");
$medicine_ipd_dispensation->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($medicine_ipd_dispensation->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_medicine_ipd_dispensationmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($medicine_ipd_dispensation->status->Visible) { // status ?>
        <tr id="r_status"<?= $medicine_ipd_dispensation->status->rowAttributes() ?>>
            <td class="<?= $medicine_ipd_dispensation->TableLeftColumnClass ?>"><?= $medicine_ipd_dispensation->status->caption() ?></td>
            <td<?= $medicine_ipd_dispensation->status->cellAttributes() ?>>
<span id="el_medicine_ipd_dispensation_status">
<span<?= $medicine_ipd_dispensation->status->viewAttributes() ?>>
<?= $medicine_ipd_dispensation->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_ipd_dispensation->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $medicine_ipd_dispensation->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $medicine_ipd_dispensation->TableLeftColumnClass ?>"><?= $medicine_ipd_dispensation->created_by_user_id->caption() ?></td>
            <td<?= $medicine_ipd_dispensation->created_by_user_id->cellAttributes() ?>>
<span id="el_medicine_ipd_dispensation_created_by_user_id">
<span<?= $medicine_ipd_dispensation->created_by_user_id->viewAttributes() ?>>
<?= $medicine_ipd_dispensation->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_ipd_dispensation->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $medicine_ipd_dispensation->date_created->rowAttributes() ?>>
            <td class="<?= $medicine_ipd_dispensation->TableLeftColumnClass ?>"><?= $medicine_ipd_dispensation->date_created->caption() ?></td>
            <td<?= $medicine_ipd_dispensation->date_created->cellAttributes() ?>>
<span id="el_medicine_ipd_dispensation_date_created">
<span<?= $medicine_ipd_dispensation->date_created->viewAttributes() ?>>
<?= $medicine_ipd_dispensation->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($medicine_ipd_dispensation->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $medicine_ipd_dispensation->date_updated->rowAttributes() ?>>
            <td class="<?= $medicine_ipd_dispensation->TableLeftColumnClass ?>"><?= $medicine_ipd_dispensation->date_updated->caption() ?></td>
            <td<?= $medicine_ipd_dispensation->date_updated->cellAttributes() ?>>
<span id="el_medicine_ipd_dispensation_date_updated">
<span<?= $medicine_ipd_dispensation->date_updated->viewAttributes() ?>>
<?= $medicine_ipd_dispensation->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
