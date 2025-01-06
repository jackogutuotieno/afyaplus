<?php

namespace PHPMaker2024\afyaplus;

// Table
$employees_view = Container("employees_view");
$employees_view->TableClass = "table table-bordered table-hover table-sm ew-table ew-master-table";
?>
<?php if ($employees_view->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_employees_viewmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($employees_view->employee_name->Visible) { // employee_name ?>
        <tr id="r_employee_name"<?= $employees_view->employee_name->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->employee_name->caption() ?></td>
            <td<?= $employees_view->employee_name->cellAttributes() ?>>
<span id="el_employees_view_employee_name">
<span<?= $employees_view->employee_name->viewAttributes() ?>>
<?= $employees_view->employee_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->national_id->Visible) { // national_id ?>
        <tr id="r_national_id"<?= $employees_view->national_id->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->national_id->caption() ?></td>
            <td<?= $employees_view->national_id->cellAttributes() ?>>
<span id="el_employees_view_national_id">
<span<?= $employees_view->national_id->viewAttributes() ?>>
<?= $employees_view->national_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->gender->Visible) { // gender ?>
        <tr id="r_gender"<?= $employees_view->gender->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->gender->caption() ?></td>
            <td<?= $employees_view->gender->cellAttributes() ?>>
<span id="el_employees_view_gender">
<span<?= $employees_view->gender->viewAttributes() ?>>
<?= $employees_view->gender->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->phone->Visible) { // phone ?>
        <tr id="r_phone"<?= $employees_view->phone->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->phone->caption() ?></td>
            <td<?= $employees_view->phone->cellAttributes() ?>>
<span id="el_employees_view_phone">
<span<?= $employees_view->phone->viewAttributes() ?>>
<?php if (!EmptyString($employees_view->phone->getViewValue()) && $employees_view->phone->linkAttributes() != "") { ?>
<a<?= $employees_view->phone->linkAttributes() ?>><?= $employees_view->phone->getViewValue() ?></a>
<?php } else { ?>
<?= $employees_view->phone->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->_email->Visible) { // email ?>
        <tr id="r__email"<?= $employees_view->_email->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->_email->caption() ?></td>
            <td<?= $employees_view->_email->cellAttributes() ?>>
<span id="el_employees_view__email">
<span<?= $employees_view->_email->viewAttributes() ?>>
<?php if (!EmptyString($employees_view->_email->getViewValue()) && $employees_view->_email->linkAttributes() != "") { ?>
<a<?= $employees_view->_email->linkAttributes() ?>><?= $employees_view->_email->getViewValue() ?></a>
<?php } else { ?>
<?= $employees_view->_email->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->department_name->Visible) { // department_name ?>
        <tr id="r_department_name"<?= $employees_view->department_name->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->department_name->caption() ?></td>
            <td<?= $employees_view->department_name->cellAttributes() ?>>
<span id="el_employees_view_department_name">
<span<?= $employees_view->department_name->viewAttributes() ?>>
<?= $employees_view->department_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->designation->Visible) { // designation ?>
        <tr id="r_designation"<?= $employees_view->designation->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->designation->caption() ?></td>
            <td<?= $employees_view->designation->cellAttributes() ?>>
<span id="el_employees_view_designation">
<span<?= $employees_view->designation->viewAttributes() ?>>
<?= $employees_view->designation->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($employees_view->date_created->Visible) { // date_created ?>
        <tr id="r_date_created"<?= $employees_view->date_created->rowAttributes() ?>>
            <td class="<?= $employees_view->TableLeftColumnClass ?>"><?= $employees_view->date_created->caption() ?></td>
            <td<?= $employees_view->date_created->cellAttributes() ?>>
<span id="el_employees_view_date_created">
<span<?= $employees_view->date_created->viewAttributes() ?>>
<?= $employees_view->date_created->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
