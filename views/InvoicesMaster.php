<?php

namespace PHPMaker2024\afyaplus;

// Table
$invoices = Container("invoices");
$invoices->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($invoices->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_invoicesmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($invoices->id->Visible) { // id ?>
        <tr id="r_id"<?= $invoices->id->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->id->caption() ?></td>
            <td<?= $invoices->id->cellAttributes() ?>>
<span id="el_invoices_id">
<span<?= $invoices->id->viewAttributes() ?>>
<?= $invoices->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $invoices->patient_id->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->patient_id->caption() ?></td>
            <td<?= $invoices->patient_id->cellAttributes() ?>>
<span id="el_invoices_patient_id">
<span<?= $invoices->patient_id->viewAttributes() ?>>
<?= $invoices->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->description->Visible) { // description ?>
        <tr id="r_description"<?= $invoices->description->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->description->caption() ?></td>
            <td<?= $invoices->description->cellAttributes() ?>>
<span id="el_invoices_description">
<span<?= $invoices->description->viewAttributes() ?>>
<?= $invoices->description->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->payment_status->Visible) { // payment_status ?>
        <tr id="r_payment_status"<?= $invoices->payment_status->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->payment_status->caption() ?></td>
            <td<?= $invoices->payment_status->cellAttributes() ?>>
<span id="el_invoices_payment_status">
<span<?= $invoices->payment_status->viewAttributes() ?>>
<?= $invoices->payment_status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $invoices->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->created_by_user_id->caption() ?></td>
            <td<?= $invoices->created_by_user_id->cellAttributes() ?>>
<span id="el_invoices_created_by_user_id">
<span<?= $invoices->created_by_user_id->viewAttributes() ?>>
<?= $invoices->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $invoices->date_created->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->date_created->caption() ?></td>
            <td<?= $invoices->date_created->cellAttributes() ?>>
<span id="el_invoices_date_created">
<span<?= $invoices->date_created->viewAttributes() ?>>
<?= $invoices->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($invoices->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $invoices->date_updated->rowAttributes() ?>>
            <td class="<?= $invoices->TableLeftColumnClass ?>"><?= $invoices->date_updated->caption() ?></td>
            <td<?= $invoices->date_updated->cellAttributes() ?>>
<span id="el_invoices_date_updated">
<span<?= $invoices->date_updated->viewAttributes() ?>>
<?= $invoices->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
