<?php

namespace PHPMaker2024\afyaplus;

// Table
$lab_test_requests_details = Container("lab_test_requests_details");
$lab_test_requests_details->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($lab_test_requests_details->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_lab_test_requests_detailsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($lab_test_requests_details->id->Visible) { // id ?>
        <tr id="r_id"<?= $lab_test_requests_details->id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_details->TableLeftColumnClass ?>"><?= $lab_test_requests_details->id->caption() ?></td>
            <td<?= $lab_test_requests_details->id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_id">
<span<?= $lab_test_requests_details->id->viewAttributes() ?>>
<?= $lab_test_requests_details->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_details->specimen_id->Visible) { // specimen_id ?>
        <tr id="r_specimen_id"<?= $lab_test_requests_details->specimen_id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_details->TableLeftColumnClass ?>"><?= $lab_test_requests_details->specimen_id->caption() ?></td>
            <td<?= $lab_test_requests_details->specimen_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_specimen_id">
<span<?= $lab_test_requests_details->specimen_id->viewAttributes() ?>>
<?= $lab_test_requests_details->specimen_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($lab_test_requests_details->service_id->Visible) { // service_id ?>
        <tr id="r_service_id"<?= $lab_test_requests_details->service_id->rowAttributes() ?>>
            <td class="<?= $lab_test_requests_details->TableLeftColumnClass ?>"><?= $lab_test_requests_details->service_id->caption() ?></td>
            <td<?= $lab_test_requests_details->service_id->cellAttributes() ?>>
<span id="el_lab_test_requests_details_service_id">
<span<?= $lab_test_requests_details->service_id->viewAttributes() ?>>
<?= $lab_test_requests_details->service_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
