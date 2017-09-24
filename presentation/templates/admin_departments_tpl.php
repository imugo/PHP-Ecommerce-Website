<?php
    include PRESENTATION_DIR.'admin_departments.php';
    $obj = new AdminDepartments();
    $obj->init();

	echo '<br><h1 class="text-center">Edit departments</h1>';
	echo '
	<form action="'.$obj->mLinkToDepartmentsAdmin.'" method="post" class="admin_department_form">';
	    // If an error occured
	    if ($obj->mErrorMessage)
		echo '
		<div class="alert alert-danger alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><i class="glyphicon glyphicon-warning-sign"></i> '.$obj->mErrorMessage.'</p>
		</div>';

	    // If there are no departments left in the database
	    if ($obj->mDepartmentsCount == 0) {
		echo '
		<div class="alert alert-warning alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p>There are no departments in your database!</p>
		</div>';
	    }
	    else {
		echo '
			<div class="table-responsive">
		    <table class="table table-bordered table-striped">
			<tr>
			    <th>Department Name</th>
			    <th>Department Description</th>
 			    <th width="240">&nbsp;</th>	
			</tr>';
			for ($i=0; $i<count($obj->mDepartments); $i++) {
			    if ($obj->mEditItem === $obj->mDepartments[$i]['department_id']) {
			    echo '
			    <tr>
				<td>
				    <div class="form-group">		
					<input type="text" name="name" class="form-control" value="'.$obj->mDepartments[$i]['name'].'">
				    </div>
				</td>
				<td>
				    <div class="form-group">
					<textarea name="description" rows="3" cols="60" class="form-control">'.$obj->mDepartments[$i]['description'].'</textarea>
				    </div>
				</td>
				<td><input type="submit" name="submit_edit_cat_'.$obj->mDepartments[$i]['department_id'].'" value="Edit Categories" class="primary-button"><br><br>
				    <input type="submit" name="submit_update_dept_'.$obj->mDepartments[$i]['department_id'].'" value="Update" class="primary-button"><br><br>
				    <input type="submit" name="cancel" value="Cancel" class="primary-button"><br><br>
				    <input type="submit" name="submit_delete_dept_'.$obj->mDepartments[$i]['department_id'].'" value="Delete" class="primary-button"></td>
			    </tr>';
			    }
			    else {
				echo '
				<tr>
				    <td>'.$obj->mDepartments[$i]['name'].'</td>
				    <td>'.$obj->mDepartments[$i]['description'].'</td>
				    <td><input type="submit" name="submit_edit_cat_'.$obj->mDepartments[$i]['department_id'].'" value="Edit Categories" class="primary-button"><br><br>
				    <input type="submit" name="submit_edit_dept_'.$obj->mDepartments[$i]['department_id'].'" value="Edit" class="primary-button"><br><br>
				    <input type="submit" name="submit_delete_dept_'.$obj->mDepartments[$i]['department_id'].'" value="Delete" class="primary-button"></td>				    
				</tr>';
			    }
			}
		    echo '
		    </table></div>';
	    }

	    echo '
	    <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
	    <h3 class="text-center">Add a new department</h3>';
	    	echo '
		<div class="form-group row">
		    <div class="col-sm-12">
		    <label for="name">Name</label><input type="text" name="department_name" id="name" class="form-control">
		    </div>
		</div>
		<div class="form-group row">
		    <div class="col-sm-12">
		    <label for="description">Description</label><input type="text" name="department_description" id="description" class="form-control">
		    </div>
		</div>
		<input type="submit" name="submit_add_dept_0" class="primary-button" value="Submit">
	    </div>
	    </div>
	</form>';

?>