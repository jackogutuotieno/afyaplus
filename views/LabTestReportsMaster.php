<?php

namespace PHPMaker2024\afyaplus;

// Table
$lab_test_reports = Container("lab_test_reports");
$lab_test_reports->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($lab_test_reports->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_lab_test_reportsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($lab_test_reports->id->Visible) { // id ?>
        <tr id="r_id"<?= $lab_test_reports->id->rowAttributes() ?>>
            <td class="<?= $lab_test_reports->TableLeftColumnClass ?>"><?= $lab_test_reports->id->caption() ?></td>
            <td<?= $lab_test_reports->id->cellAttributes() ?>>
<span id="el_lab_test_reports_id">
<span<?= $lab_test_reports->id->viewAttributes() ?>>
<?= $lab_test_reports->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_reports->lab_test_request_id->Visible) { // lab_test_request_id ?>
        <tr id="r_lab_test_request_id"<?= $lab_test_reports->lab_test_request_id->rowAttributes() ?>>
            <td class="<?= $lab_test_reports->TableLeftColumnClass ?>"><?= $lab_test_reports->lab_test_request_id->caption() ?></td>
            <td<?= $lab_test_reports->lab_test_request_id->cellAttributes() ?>>
<span id="el_lab_test_reports_lab_test_request_id">
<span<?= $lab_test_reports->lab_test_request_id->viewAttributes() ?>>
<?= $lab_test_reports->lab_test_request_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_reports->details->Visible) { // details ?>
        <tr id="r_details"<?= $lab_test_reports->details->rowAttributes() ?>>
            <td class="<?= $lab_test_reports->TableLeftColumnClass ?>"><?= $lab_test_reports->details->caption() ?></td>
            <td<?= $lab_test_reports->details->cellAttributes() ?>>
<span id="el_lab_test_reports_details">
<span<?= $lab_test_reports->details->viewAttributes() ?>>
<?= $lab_test_reports->details->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_reports->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $lab_test_reports->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $lab_test_reports->TableLeftColumnClass ?>"><?= $lab_test_reports->created_by_user_id->caption() ?></td>
            <td<?= $lab_test_reports->created_by_user_id->cellAttributes() ?>>
<span id="el_lab_test_reports_created_by_user_id">
<span<?= $lab_test_reports->created_by_user_id->viewAttributes() ?>>
<?= $lab_test_reports->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_reports->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $lab_test_reports->date_created->rowAttributes() ?>>
            <td class="<?= $lab_test_reports->TableLeftColumnClass ?>"><?= $lab_test_reports->date_created->caption() ?></td>
            <td<?= $lab_test_reports->date_created->cellAttributes() ?>>
<span id="el_lab_test_reports_date_created">
<span<?= $lab_test_reports->date_created->viewAttributes() ?>>
<?= $lab_test_reports->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
