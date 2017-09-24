<?php
    include PRESENTATION_DIR.'admin_attributes.php';
    $obj = new AdminAttributes();
    $obj->init();

    echo '<form method="post" action="'.$obj->mLinkToAttributesAdmin.'">';
    echo '<br><h1 class="text-center">Edit Product Attributes:</h1>';

    if ($obj->mErrorMessage)
	echo '
	<div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <p><i class="glyphicon glyphicon-warning-sign"></i> '.$obj->mErrorMessage.'</p>
        </div>';

    if ($obj->mAttributesCount == 0) 
	    echo '
	    <div class="alert alert-warning alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<p>There are no products attributes in our database!</p>
	    </div>';
    else {
	echo '
		<div class="container">
		<div class="table-responsive">
	    <table class="table table-striped table-bordered">
		<tr>
		    <th>Atrribute Name</th>
		    <th>&nbsp;</th>
		</tr>';
		for ($i=0; $i<count($obj->mAttributes); $i++) {
		    if ($obj->mEditItem == $obj->mAttributes[$i]['attribute_id']) {
			echo '
			<tr>
			    <td>
			        <div class="form-group">
			    	    <input type="text" name="name" value="'.$obj->mAttributes[$i]['name'].'" class="form-control">
			        </div>
			    </td>
			    <td>
				<input type="submit" name="submit_edit_attr_val_'.$obj->mAttributes[$i]['attribute_id'].'" class="primary-button" value="Edit Attribute values"><br><br>
				<input type="submit" name="submit_update_attr_'.$obj->mAttributes[$i]['attribute_id'].'" class="primary-button" value="Update"><br><br>
				<input type="submit" name="cancel" value="Cancel" class="primary-button"><br><br>
				<input type="submit" name="submit_delete_attr_'.$obj->mAttributes[$i]['attribute_id'].'" class="primary-button" value="Delete">
			    </td>
			</tr>';
		    }
		    else {
			echo '
			<tr>
			    <td>'.$obj->mAttributes[$i]['name'].'</td>
			    <td>
				<input type="submit" name="submit_edit_val_'.$obj->mAttributes[$i]['attribute_id'].'" class="primary-button" value="Edit Attribute Values"><br><br>
				<input type="submit" name="submit_edit_attr_'.$obj->mAttributes[$i]['attribute_id'].'" value="Edit" class="primary-button"><br><br>
				<input type="submit" name="submit_delete_attr_'.$obj->mAttributes[$i]['attribute_id'].'" value="Delete" class="primary-button">
			    </td>
			</tr>';
		    }
		}
	    echo '</table></div></div>
	';
    }
    echo '
    <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
    <h3 class="text-center">Add new attribute:</h3>
	<div class="form-group row">
	    <div class="col-sm-12">
		<label for="name">Name</label><input type="text" name="attribute_name" id="name" class="form-control">
	    </div>
	</div>
	<input type="submit" name="submit_add_attr_0" class="primary-button" value="Submit">
    </div>
    </div>
    </form>';
?>