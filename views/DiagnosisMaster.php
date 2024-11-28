<?php

namespace PHPMaker2024\afyaplus;

// Table
$diagnosis = Container("diagnosis");
$diagnosis->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($diagnosis->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_diagnosismaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($diagnosis->id->Visible) { // id ?>
        <tr id="r_id"<?= $diagnosis->id->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->id->caption() ?></td>
            <td<?= $diagnosis->id->cellAttributes() ?>>
<span id="el_diagnosis_id">
<span<?= $diagnosis->id->viewAttributes() ?>>
<?= $diagnosis->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($diagnosis->lab_test_report_id->Visible) { // lab_test_report_id ?>
        <tr id="r_lab_test_report_id"<?= $diagnosis->lab_test_report_id->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->lab_test_report_id->caption() ?></td>
            <td<?= $diagnosis->lab_test_report_id->cellAttributes() ?>>
<span id="el_diagnosis_lab_test_report_id">
<span<?= $diagnosis->lab_test_report_id->viewAttributes() ?>>
<?= $diagnosis->lab_test_report_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($diagnosis->disease_id->Visible) { // disease_id ?>
        <tr id="r_disease_id"<?= $diagnosis->disease_id->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->disease_id->caption() ?></td>
            <td<?= $diagnosis->disease_id->cellAttributes() ?>>
<span id="el_diagnosis_disease_id">
<span<?= $diagnosis->disease_id->viewAttributes() ?>>
<?= $diagnosis->disease_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($diagnosis->created_by_user_id->Visible) { // created_by_user_id ?>
        <tr id="r_created_by_user_id"<?= $diagnosis->created_by_user_id->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->created_by_user_id->caption() ?></td>
            <td<?= $diagnosis->created_by_user_id->cellAttributes() ?>>
<span id="el_diagnosis_created_by_user_id">
<span<?= $diagnosis->created_by_user_id->viewAttributes() ?>>
<?= $diagnosis->created_by_user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($diagnosis->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $diagnosis->date_created->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->date_created->caption() ?></td>
            <td<?= $diagnosis->date_created->cellAttributes() ?>>
<span id="el_diagnosis_date_created">
<span<?= $diagnosis->date_created->viewAttributes() ?>>
<?= $diagnosis->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($diagnosis->date_updated->Visible) { // date_updated ?>
        <tr id="r_date_updated"<?= $diagnosis->date_updated->rowAttributes() ?>>
            <td class="<?= $diagnosis->TableLeftColumnClass ?>"><?= $diagnosis->date_updated->caption() ?></td>
            <td<?= $diagnosis->date_updated->cellAttributes() ?>>
<span id="el_diagnosis_date_updated">
<span<?= $diagnosis->date_updated->viewAttributes() ?>>
<?= $diagnosis->date_updated->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
