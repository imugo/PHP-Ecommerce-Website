<?php
include PRESENTATION_DIR.'department.php';
$obj = new Department();
$obj->init();

echo '
	<div class="container" style="border-top: 1px solid lightgrey; margin-top: 20px;"><br>
		<h1 class="department-title text-center">'.$obj->mName.'</h1>
		<p class="text-center">'.$obj->mDescription.'</p>
	<hr>';
	
	if ($obj->mShowEditButton === true) {
		echo '
		<form action="'.$obj->mEditActionTarget.'" method="post">';
			echo '<input type="submit" name="submit_'.$obj->mEditAction.'" value="'.$obj->mEditButtonCaption.'" class="btn btn-default">';
		echo '</form>';
	}
	include_once 'product_list_tpl.php';
	echo '</div>';
?>