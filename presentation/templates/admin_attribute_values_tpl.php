<?php
    include PRESENTATION_DIR.'admin_attribute_values.php';
    $obj = new AdminAttributeValues();
    $obj->init();

    echo '<a href="'.$obj->mLinkToAttributesAdmin.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back To Attributes</a>';
    echo '
    <form method="post" action="'.$obj->mLinkToAttributeValuesAdmin.'">';
    echo '<br><h1 class="text-center">Editing values for attributes: '.$obj->mAttributeName.'</h1>';
    

    if ($obj->mErrorMessage) {
	$error = json_decode($obj->mErrorMessage);
	echo '
	<div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <i class="glyphicon glyphicon-warning-sign"></i>
	    <p>'.$error[0].'</p> <i>'.$error[1].'</i>
        </div>';
}

    if ($obj->mAttributeValuesCount == 0) 
	    echo '
	    <div class="alert alert-warning alert-dismissible fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<p>There are no values for this attribute!</p>
	    </div>';
    else {
        echo '
		<div class="container">
		<div class="table-responsive">
	    <table class="table table-striped table-bordered">
		<tr>
		    <th>Atrribute Value</th>
		    <th>&nbsp;</th>
		</tr>';
		for ($i=0; $i<count($obj->mAttributeValues); $i++) {
		    if ($obj->mEditItem == $obj->mAttributeValues[$i]['attribute_value_id']) {
			echo '
			<tr>
			    <td>
			        <div class="form-group">
			    	    <input type="text" name="value" value="'.$obj->mAttributeValues[$i]['value'].'" class="form-control">
			        </div>
			    </td>
			    <td>
				<input type="submit" name="submit_update_val_'.$obj->mAttributeValues[$i]['attribute_value_id'].'" class="primary-button" value="Update">&nbsp;
				<input type="submit" name="cancel" value="Cancel" class="btn btn-default">&nbsp;
				<input type="submit" name="submit_delete_val_'.$obj->mAttributeValues[$i]['attribute_value_id'].'" class="primary-button" value="Delete">
			    </td>
			</tr>';
		    }
		    else {
			echo '
			<tr>
			    <td>'.$obj->mAttributeValues[$i]['value'].'</td>
			    <td>
				<input type="submit" name="submit_edit_val_'.$obj->mAttributeValues[$i]['attribute_value_id'].'" class="primary-button" value="Edit">&nbsp;
				<input type="submit" name="submit_delete_attr_'.$obj->mAttributeValues[$i]['attribute_value_id'].'" value="Delete" class="primary-button">
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
    <h3>Add new attribute value:</h3>
	<div class="form-group">
		<label for="name">Name:</label><input type="text" name="attribute_value" id="name" class="form-control">
	</div>
	<input type="submit" name="submit_add_val_0" class="primary-button" value="Submit">
	</div>
	<div>
    </form>';
?>