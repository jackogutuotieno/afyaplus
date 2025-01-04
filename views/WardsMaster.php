<?php

namespace PHPMaker2024\afyaplus;

// Table
$wards = Container("wards");
$wards->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($wards->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_wardsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($wards->floor_id->Visible) { // floor_id ?>
        <tr id="r_floor_id"<?= $wards->floor_id->rowAttributes() ?>>
            <td class="<?= $wards->TableLeftColumnClass ?>"><?= $wards->floor_id->caption() ?></td>
            <td<?= $wards->floor_id->cellAttributes() ?>>
<span id="el_wards_floor_id">
<span<?= $wards->floor_id->viewAttributes() ?>>
<?= $wards->floor_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($wards->ward_type_id->Visible) { // ward_type_id ?>
        <tr id="r_ward_type_id"<?= $wards->ward_type_id->rowAttributes() ?>>
            <td class="<?= $wards->TableLeftColumnClass ?>"><?= $wards->ward_type_id->caption() ?></td>
            <td<?= $wards->ward_type_id->cellAttributes() ?>>
<span id="el_wards_ward_type_id">
<span<?= $wards->ward_type_id->viewAttributes() ?>>
<?= $wards->ward_type_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($wards->ward_name->Visible) { // ward_name ?>
        <tr id="r_ward_name"<?= $wards->ward_name->rowAttributes() ?>>
            <td class="<?= $wards->TableLeftColumnClass ?>"><?= $wards->ward_name->caption() ?></td>
            <td<?= $wards->ward_name->cellAttributes() ?>>
<span id="el_wards_ward_name">
<span<?= $wards->ward_name->viewAttributes() ?>>
<?= $wards->ward_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
