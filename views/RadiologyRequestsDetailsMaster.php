<?php

namespace PHPMaker2024\afyaplus;

// Table
$radiology_requests_details = Container("radiology_requests_details");
$radiology_requests_details->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($radiology_requests_details->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_radiology_requests_detailsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($radiology_requests_details->radiology_request_id->Visible) { // radiology_request_id ?>
        <tr id="r_radiology_request_id"<?= $radiology_requests_details->radiology_request_id->rowAttributes() ?>>
            <td class="<?= $radiology_requests_details->TableLeftColumnClass ?>"><?= $radiology_requests_details->radiology_request_id->caption() ?></td>
            <td<?= $radiology_requests_details->radiology_request_id->cellAttributes() ?>>
<span id="el_radiology_requests_details_radiology_request_id">
<span<?= $radiology_requests_details->radiology_request_id->viewAttributes() ?>>
<?= $radiology_requests_details->radiology_request_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($radiology_requests_details->service_id->Visible) { // service_id ?>
        <tr id="r_service_id"<?= $radiology_requests_details->service_id->rowAttributes() ?>>
            <td class="<?= $radiology_requests_details->TableLeftColumnClass ?>"><?= $radiology_requests_details->service_id->caption() ?></td>
            <td<?= $radiology_requests_details->service_id->cellAttributes() ?>>
<span id="el_radiology_requests_details_service_id">
<span<?= $radiology_requests_details->service_id->viewAttributes() ?>>
<?= $radiology_requests_details->service_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
