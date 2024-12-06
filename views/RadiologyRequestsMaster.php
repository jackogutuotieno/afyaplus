<?php

namespace PHPMaker2024\afyaplus;

// Table
$radiology_requests = Container("radiology_requests");
$radiology_requests->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($radiology_requests->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_radiology_requestsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($radiology_requests->id->Visible) { // id ?>
        <tr id="r_id"<?= $radiology_requests->id->rowAttributes() ?>>
            <td class="<?= $radiology_requests->TableLeftColumnClass ?>"><?= $radiology_requests->id->caption() ?></td>
            <td<?= $radiology_requests->id->cellAttributes() ?>>
<span id="el_radiology_requests_id">
<span<?= $radiology_requests->id->viewAttributes() ?>>
<?= $radiology_requests->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_requests->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $radiology_requests->patient_id->rowAttributes() ?>>
            <td class="<?= $radiology_requests->TableLeftColumnClass ?>"><?= $radiology_requests->patient_id->caption() ?></td>
            <td<?= $radiology_requests->patient_id->cellAttributes() ?>>
<span id="el_radiology_requests_patient_id">
<span<?= $radiology_requests->patient_id->viewAttributes() ?>>
<?= $radiology_requests->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_requests->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $radiology_requests->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $radiology_requests->TableLeftColumnClass ?>"><?= $radiology_requests->created_by_user_id->caption() ?></td>
            <td<?= $radiology_requests->created_by_user_id->cellAttributes() ?>>
<span id="el_radiology_requests_created_by_user_id">
<span<?= $radiology_requests->created_by_user_id->viewAttributes() ?>>
<?= $radiology_requests->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_requests->status->Visible) { // status ?>
        <tr id="r_status"<?= $radiology_requests->status->rowAttributes() ?>>
            <td class="<?= $radiology_requests->TableLeftColumnClass ?>"><?= $radiology_requests->status->caption() ?></td>
            <td<?= $radiology_requests->status->cellAttributes() ?>>
<span id="el_radiology_requests_status">
<span<?= $radiology_requests->status->viewAttributes() ?>>
<?= $radiology_requests->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_requests->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $radiology_requests->date_created->rowAttributes() ?>>
            <td class="<?= $radiology_requests->TableLeftColumnClass ?>"><?= $radiology_requests->date_created->caption() ?></td>
            <td<?= $radiology_requests->date_created->cellAttributes() ?>>
<span id="el_radiology_requests_date_created">
<span<?= $radiology_requests->date_created->viewAttributes() ?>>
<?= $radiology_requests->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
