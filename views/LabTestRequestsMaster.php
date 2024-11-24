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
<?php if ($lab_test_requests->test_title->Visible) { // test_title ?>
        <tr id="r_test_title"<?= $lab_test_requests->test_title->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->test_title->caption() ?></td>
            <td<?= $lab_test_requests->test_title->cellAttributes() ?>>
<span id="el_lab_test_requests_test_title">
<span<?= $lab_test_requests->test_title->viewAttributes() ?>>
<?= $lab_test_requests->test_title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests->status->Visible) { // status ?>
        <tr id="r_status"<?= $lab_test_requests->status->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->status->caption() ?></td>
            <td<?= $lab_test_requests->status->cellAttributes() ?>>
<span id="el_lab_test_requests_status">
<span<?= $lab_test_requests->status->viewAttributes() ?>>
<?= $lab_test_requests->status->getViewValue() ?></span>
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
<?php if ($lab_test_requests->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $lab_test_requests->date_updated->rowAttributes() ?>>
            <td class="<?= $lab_test_requests->TableLeftColumnClass ?>"><?= $lab_test_requests->date_updated->caption() ?></td>
            <td<?= $lab_test_requests->date_updated->cellAttributes() ?>>
<span id="el_lab_test_requests_date_updated">
<span<?= $lab_test_requests->date_updated->viewAttributes() ?>>
<?= $lab_test_requests->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
