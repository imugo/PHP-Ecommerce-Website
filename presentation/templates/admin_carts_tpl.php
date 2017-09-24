<?php
	include PRESENTATION_DIR.'admin_carts.php';
	$obj = new AdminCarts();
	$obj->init();
	
	echo '
	<form action="'.$obj->mLinkToCartsAdmin.'" method="post"><br>
		<h1 class="text-center">Admin users&#039; shopping carts:</h1>';
		
		if ($obj->mMessage)
		echo '
		<div class="alert alert-info alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p>'.$obj->mMessage.'</p>
		</div>';
		
		echo '<div class="row">
				<div class="col-sm-6 col-sm-offset-3">';
		echo '<p>Select carts: ';
			$selected = '';
			echo '<select name="days">';
			foreach ($obj->mDaysOptions as $key=>$value) {
				$selected = '';
				if ($obj->mSelectedDaysNumber == $key) {
					$selected = 'selected';
				}
				echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>'; 
			}
			echo '</select> <br><br>';
			
			echo '<input type="submit" class="primary-button" name="submit_count" value="Count Old Shopping Carts">
				   <input type="submit" name="submit_delete" class="primary-button" value="Delete Old Shopping Carts">';
			echo '</p>
			</div></div>';
	echo '</form>';
?>