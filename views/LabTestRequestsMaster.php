<?php

namespace PHPMaker2024\afyaplus;

// Table
$lab_test_requests = Container("lab_test_requests");
$lab_test_requests->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($lab_test_requests->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_lab_test_requestsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($lab_test_requests->id->Visible) { // id ?>
        <tr id="r_id"<?= $lab_test_requests->id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->id->caption() ?></td>
            <td<?= $lab_test_requests->id->cellAttributes() ?>>
<span id="el_lab_test_requests_id">
<span<?= $lab_test_requests->id->viewAttributes() ?>>
<?= $lab_test_requests->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $lab_test_requests->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->created_by_user_id->caption() ?></td>
            <td<?= $lab_test_requests->created_by_user_id->cellAttributes() ?>>
<span id="el_lab_test_requests_created_by_user_id">
<span<?= $lab_test_requests->created_by_user_id->viewAttributes() ?>>
<?= $lab_test_requests->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $lab_test_requests->date_created->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->date_created->caption() ?></td>
            <td<?= $lab_test_requests->date_created->cellAttributes() ?>>
<span id="el_lab_test_requests_date_created">
<span<?= $lab_test_requests->date_created->viewAttributes() ?>>
<?= $lab_test_requests->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
