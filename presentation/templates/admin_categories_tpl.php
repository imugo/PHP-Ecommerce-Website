<?php
    include PRESENTATION_DIR.'admin_categories.php';
    $obj = new AdminCategories();
    $obj->init();

    
	echo '<a href="'.$obj->mLinkToDepartmentsAdmin.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back To Department</a>';
	echo '<br><h1 class="text-center">Editing categories for department: '.$obj->mDepartmentName.'</h1>';
	
	echo '
    <form method="post" action="'.$obj->mLinkToDepartmentCategoriesAdmin.'">';
        // If an error occured
	if ($obj->mErrorMessage)
	    echo '
	        <div class="alert alert-danger alert-dismissible fade in">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <p><i class="glyphicon glyphicon-warning-sign"></i> '.$obj->mErrorMessage.'</p>
		</div>';

	if ($obj->mCategoriesCount == 0) 
	    echo '
	    <div class="alert alert-warning alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<p>There are no categories in this department!</p>
	    </div>';
	else {
	    echo '
			<div class="table-responsive">
		    <table class="table-bordered table table-striped">
			<tr>
			    <th>Category Name</th>
			    <th>Category Description</th>
 			    <th width="240">&nbsp;</th>	
			</tr>';
			for ($i=0; $i<count($obj->mCategories); $i++) {
			    if ($obj->mEditItem == $obj->mCategories[$i]['category_id']) {
			    echo '
			    <tr>
				<td>
				    <div class="form-group">		
					<input type="text" name="name" class="form-control" value="'.$obj->mCategories[$i]['name'].'">
				    </div>
				</td>
				<td>
				    <div class="form-group">
					<textarea name="description" rows="3" cols="60" class="form-control">'.$obj->mCategories[$i]['description'].'</textarea>
				    </div>
				</td>
				<td><input type="submit" name="submit_edit_prod_'.$obj->mCategories[$i]['category_id'].'" value="Edit Products" class="primary-button"><br><br>
				    <input type="submit" name="submit_update_cat_'.$obj->mCategories[$i]['category_id'].'" value="Update" class="primary-button"><br><br>
				    <input type="submit" name="cancel" value="Cancel" class="primary-button"><br><br>
				    <input type="submit" name="submit_delete_cat_'.$obj->mCategories[$i]['category_id'].'" value="Delete" class="primary-button"></td>
			    </tr>';
			    }
			    else {
				echo '
				<tr>
				    <td>'.$obj->mCategories[$i]['name'].'</td>
				    <td>'.$obj->mCategories[$i]['description'].'</td>
				    <td><input type="submit" name="submit_edit_prod_'.$obj->mCategories[$i]['category_id'].'" value="Edit Products" class="primary-button"><br><br>
				    <input type="submit" name="submit_edit_cat_'.$obj->mCategories[$i]['category_id'].'" value="Edit" class="primary-button"><br><br>
				    <input type="submit" name="submit_delete_cat_'.$obj->mCategories[$i]['category_id'].'" value="Delete" class="primary-button"></td>				    
				</tr>';
			    }
			}
		    echo '
		    </table>
		</div>';
	}
	 echo '
	    <div class="row">
   	    <div class="col-sm-4 col-sm-offset-4">
	    <h3 class="text-center">Add a new Category</h3>';
	    	echo '
		<div class="form-group row">
		    <div class="col-sm-12">
		    <label for="name">Name</label><input type="text" name="category_name" id="name" class="form-control">
		    </div>
		</div>
		<div class="form-group row">
		    <div class="col-sm-12">
		    <label for="description">Description</label><input type="text" name="category_description" id="description" class="form-control">
		    </div>
		</div>
		<input type="submit" name="submit_add_cat_0" class="primary-button" value="Submit">
	    </div>
	    </div>
    </form>';
?>