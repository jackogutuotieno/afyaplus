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
<?php if ($patient_visits->visit_type_id->Visible) { // visit_type_id ?>
        <tr id="r_visit_type_id"<?= $patient_visits->visit_type_id->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->visit_type_id->caption() ?></td>
            <td<?= $patient_visits->visit_type_id->cellAttributes() ?>>
<span id="el_patient_visits_visit_type_id">
<span<?= $patient_visits->visit_type_id->viewAttributes() ?>>
<?= $patient_visits->visit_type_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_visits->payment_method_id->Visible) { // payment_method_id ?>
        <tr id="r_payment_method_id"<?= $patient_visits->payment_method_id->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->payment_method_id->caption() ?></td>
            <td<?= $patient_visits->payment_method_id->cellAttributes() ?>>
<span id="el_patient_visits_payment_method_id">
<span<?= $patient_visits->payment_method_id->viewAttributes() ?>>
<?= $patient_visits->payment_method_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($patient_visits->medical_scheme_id->Visible) { // medical_scheme_id ?>
        <tr id="r_medical_scheme_id"<?= $patient_visits->medical_scheme_id->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->medical_scheme_id->caption() ?></td>
            <td<?= $patient_visits->medical_scheme_id->cellAttributes() ?>>
<span id="el_patient_visits_medical_scheme_id">
<span<?= $patient_visits->medical_scheme_id->viewAttributes() ?>>
<?= $patient_visits->medical_scheme_id->getViewValue() ?></span>
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
<?php if ($patient_visits->status->Visible) { // status ?>
        <tr id="r_status"<?= $patient_visits->status->rowAttributes() ?>>
            <td class="<?= $patient_visits->TableLeftColumnClass ?>"><?= $patient_visits->status->caption() ?></td>
            <td<?= $patient_visits->status->cellAttributes() ?>>
<span id="el_patient_visits_status">
<span<?= $patient_visits->status->viewAttributes() ?>>
<?= $patient_visits->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
