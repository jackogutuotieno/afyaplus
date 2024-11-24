<?php

namespace PHPMaker2024\afyaplus;

// Table
$patient_visits = Container("patient_visits");
$patient_visits->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($patient_visits->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_patient_visitsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($patient_visits->patient_id->Visible) { // patient_id ?>
        <tr id="r_patient_id"<?= $patient_visits->patient_id->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->patient_id->caption() ?></td>
            <td<?= $patient_visits->patient_id->cellAttributes() ?>>
<span id="el_patient_visits_patient_id">
<span<?= $patient_visits->patient_id->viewAttributes() ?>>
<?= $patient_visits->patient_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_visits->_title->Visible) { // title ?>
        <tr id="r__title"<?= $patient_visits->_title->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->_title->caption() ?></td>
            <td<?= $patient_visits->_title->cellAttributes() ?>>
<span id="el_patient_visits__title">
<span<?= $patient_visits->_title->viewAttributes() ?>>
<?= $patient_visits->_title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_visits->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $patient_visits->date_created->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->date_created->caption() ?></td>
            <td<?= $patient_visits->date_created->cellAttributes() ?>>
<span id="el_patient_visits_date_created">
<span<?= $patient_visits->date_created->viewAttributes() ?>>
<?= $patient_visits->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
