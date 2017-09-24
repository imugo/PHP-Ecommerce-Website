<?php
// Departments List in the nav
include PRESENTATION_DIR.'departments_list.php';
$obj = new DepartmentsList();
$obj->init();

// Loop through list of departments

for ($i=0; $i<count($obj->mDepartments); $i++) {
		$selected = '';
		if ($obj->mSelectedDepartment == $obj->mDepartments[$i]['department_id'])
			$selected = 'class="active"';
echo '
      <li class="list-group-item"><a '.$selected.' href="'.$obj->mDepartments[$i]['link_to_department'].'">'.$obj->mDepartments[$i]['name'].'</a></li>';
}
?>
