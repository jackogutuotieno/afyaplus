<?php

namespace PHPMaker2024\afyaplus;

// Table
$lab_test_requests_queue = Container("lab_test_requests_queue");
$lab_test_requests_queue->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($lab_test_requests_queue->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_lab_test_requests_queuemaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($lab_test_requests_queue->id->Visible) { // id ?>
        <tr id="r_id"<?= $lab_test_requests_queue->id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->id->caption() ?></td>
            <td<?= $lab_test_requests_queue->id->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_id">
<span<?= $lab_test_requests_queue->id->viewAttributes() ?>>
<?= $lab_test_requests_queue->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->lab_test_requests_details_id->Visible) { // lab_test_requests_details_id ?>
        <tr id="r_lab_test_requests_details_id"<?= $lab_test_requests_queue->lab_test_requests_details_id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->lab_test_requests_details_id->caption() ?></td>
            <td<?= $lab_test_requests_queue->lab_test_requests_details_id->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_lab_test_requests_details_id">
<span<?= $lab_test_requests_queue->lab_test_requests_details_id->viewAttributes() ?>>
<?= $lab_test_requests_queue->lab_test_requests_details_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->time->Visible) { // time ?>
        <tr id="r_time"<?= $lab_test_requests_queue->time->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->time->caption() ?></td>
            <td<?= $lab_test_requests_queue->time->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_time">
<span<?= $lab_test_requests_queue->time->viewAttributes() ?>>
<?= $lab_test_requests_queue->time->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->status->Visible) { // status ?>
        <tr id="r_status"<?= $lab_test_requests_queue->status->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->status->caption() ?></td>
            <td<?= $lab_test_requests_queue->status->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_status">
<span<?= $lab_test_requests_queue->status->viewAttributes() ?>>
<?= $lab_test_requests_queue->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $lab_test_requests_queue->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->created_by_user_id->caption() ?></td>
            <td<?= $lab_test_requests_queue->created_by_user_id->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_created_by_user_id">
<span<?= $lab_test_requests_queue->created_by_user_id->viewAttributes() ?>>
<?= $lab_test_requests_queue->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $lab_test_requests_queue->date_created->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->date_created->caption() ?></td>
            <td<?= $lab_test_requests_queue->date_created->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_date_created">
<span<?= $lab_test_requests_queue->date_created->viewAttributes() ?>>
<?= $lab_test_requests_queue->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_queue->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $lab_test_requests_queue->date_updated->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_queue->TableLeftColumnClass ?>"><?= $lab_test_requests_queue->date_updated->caption() ?></td>
            <td<?= $lab_test_requests_queue->date_updated->cellAttributes() ?>>
<span id="el_lab_test_requests_queue_date_updated">
<span<?= $lab_test_requests_queue->date_updated->viewAttributes() ?>>
<?= $lab_test_requests_queue->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
