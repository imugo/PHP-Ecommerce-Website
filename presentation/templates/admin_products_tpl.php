<?php
	include PRESENTATION_DIR.'admin_products.php';
	$obj = new AdminProducts();
	$obj->init();
	
	echo '
	<form method="post" action="'.$obj->mLinkToCategoryProductsAdmin.'">
		<a href="'.$obj->mLinkToDepartmentCategoriesAdmin.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back To Categories</a><br>
		<h1 class="text-center">Editing products for category: <small>'.$obj->mCategoryName.'</small></h1>';		
		if ($obj->mErrorMessage) {
			echo '
			<div class="alert alert-danger alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><i class="glyphicon glyphicon-warning-sign"></i> '.$obj->mErrorMessage.'</p>
			</div>';
		}

    	if ($obj->mProductsCount == 0) { 
			echo '
			<div class="alert alert-warning alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p>There are no products in this category!</p>
			</div>';
		}
		
   		else {
			echo '
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Discounted Price</th>
				<th>&nbsp;</th>
			</tr>';
			for ($i=0; $i<count($obj->mProducts); $i++) {
				echo '
				<tr>
					<td>'.$obj->mProducts[$i]['name'].'</td>
					<td>'.$obj->mProducts[$i]['description'].'</td>
					<td>'.$obj->mProducts[$i]['price'].'</td>
					<td>'.$obj->mProducts[$i]['discounted_price'].'</td>
			    	<td><input type="submit" name="submit_edit_prod_'.$obj->mProducts[$i]['product_id'].'" class="primary-button" value="Edit"></td>
				</tr>';
			}
	    echo '</table></div>';
		}
		echo '
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
		<h3 class="text-center">Add new product:</h3>
		<div class="form-group">
			<label for="name">Name:</label><input type="text" name="product_name" id="name" class="form-control">
		</div>
		<div class="form-group">
			<label for="desc">Description:</label><input type="text" name="product_description" id="desc" class="form-control">
		</div>
		<div class="form-group">
			<label for="price">Price:</label><input type="text" name="product_price" id="price" class="form-control">
		</div>
		<input type="submit" name="submit_add_prod_0" class="primary-button text-center" value="Add">
		</div></div> 
	</form>';
?>