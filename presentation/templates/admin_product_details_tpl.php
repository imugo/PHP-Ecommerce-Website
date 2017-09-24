<?php
	include PRESENTATION_DIR.'admin_product_details.php';
	$obj = new AdminProductDetails();
	$obj->init();
	
	echo '
	<a href="'.$obj->mLinkToCategoryProductsAdmin.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> back to products</a><br>

	<h1 class="text-center">Editing Product: '.$obj->mProduct['name'].'<span class="badge">'.$obj->mProduct['product_id'].'</span></h1>';
	echo '<form enctype="multipart/form-data" method="post" action="'.$obj->mLinkToProductDetailsAdmin.'">';
		if ($obj->mErrorMessage) {
			echo '
			<div class="alert alert-danger alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><i class="glyphicon glyphicon-warning-sign"></i> '.$obj->mErrorMessage.'</p>
			</div>';
		}
		
		echo '<div class="row"><div class="col-sm-6">';
		echo '
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="ProductName">Product Name:</label><input type="text" name="name" id="ProductName" class="form-control" value="'.$obj->mProduct['name'].'">
			</div>
		</div><br>
		
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="ProductDescription">Product Name:</label>
			<textarea name="description" rows="3" cols="60" class="form-control" id="ProductDescription">'.$obj->mProduct['description'].'</textarea>
			</div>
		</div><br>
		
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="price">Product Price:</label><input type="number" name="price" id="price" class="form-control" value="'.$obj->mProduct['price'].'">
			</div>
		</div><br>
		
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="discounted_price">Product Discounted Price:</label>
			<input type="number" name="discounted_price" id="discounted_price" class="form-control" value="'.$obj->mProduct['discounted_price'].'">
			</div>
		</div><br>
		
		<input type="submit" name="UpdateProductInfo" class="secondary-button" value="Update Product Info"><hr>
		</div>';
		
		// Remove Product from Category section
		echo '
		<div class="col-sm-6">
		<h4>Product belongs to these categories: <span>'.$obj->mProductCategoriesString.'</span></h4>
		
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="sel1">Remove this product from:</label>
			<select name="TargetCategoryIdRemove" class="form-control" id="sel1">';
				foreach ($obj->mRemoveFromCategories as $key=>$value) {
					echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
				}
			echo '
			</select>';
			$disabled = '';
			$RemoveFromCategory = '';
			if ($obj->mRemoveFromCategoriesButtonDisabled) {
				$disabled = 'disabled';
				$RemoveFromCategory = 'disabled';
			}
			else {
				$RemoveFromCategory = 'Remove From Category';
			}
			echo '<br><input type="submit" name="RemoveFromCategory" class="secondary-button" value="'.$RemoveFromCategory.'" '.$disabled.'>
		</div></div><br>';
		// End 
		
		// Assign Product to category section
		echo '
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="assign1">Assign Product to this category:</label>
			<select name="TargetCategoryIdAssign" class="form-control" id="assign1">';
				foreach ($obj->mAssignOrMoveTo as $key=>$value) {
					echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
				}
			echo '
			</select>';
			echo '<br><input type="submit" name="Assign" class="secondary-button" value="Assign">
		</div></div><br>';
		// End
		
		// Nove Product to this category
		echo '
		<div class="form-group row">
			<div class="col-sm-12">
			<label for="move1">Move Product to this category:</label>
			<select name="TargetCategoryIdMove" class="form-control" id="move1">';
				foreach ($obj->mAssignOrMoveTo as $key=>$value) {
					echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
				}
			echo '
			</select>';
			echo '<br><input type="submit" name="Move" class="secondary-button" value="Move">&nbsp;';
			$disabled = '';
			if (!$obj->mRemoveFromCategoriesButtonDisabled) {
				$disabled = 'disabled';
			}
			echo '<input type="submit" name="RemoveFromCatalog" class="secondary-button" value="Remove Product From Catalog" '.$disabled.'>
		</div></div><br>';
		// End 
		
		// Product Attributes section
		if (isset($obj->mProductAttributes)) {
			echo '
			<div class="form-group row">
				<div class="col-sm-12">
				<label for="pa1">Product Attributes:</label>
				<select name="TargetAttributeValueIdRemove" class="form-control" id="pa1">';
					foreach ($obj->mProductAttributes as $key=>$value) {
						echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
					}
				echo '
				</select>';
				echo '<br><input type="submit" name="RemoveAttributeValue" class="secondary-button" value="Remove">';
			echo '</div></div><br>';
		}
		// End
		
		// Catalog Attributes
		if (isset($obj->mCatalogAttributes)) {
			echo '
			<div class="form-group row">
				<div class="col-sm-12">
				<label for="ap1">Assign Attributes To Products:</label>
				<select name="TargetAttributeValueIdAssign" class="form-control" id="ap1">';
					foreach ($obj->mCatalogAttributes as $key=>$value) {
						echo '<option label="'.$value.'" value="'.$key.'">'.$value.'</option>';
					}
				echo '
				</select>';
				echo '<br><input type="submit" name="AssignAttributeValue" class="secondary--button" value="Assign">';
			echo '</div></div><br>';
		}
		// End
		
		// Product display options
		echo '
			<div class="form-group row">
				<div class="col-sm-12">
				<label for="dis1">Set display options for this product:</label>
				<select name="ProductDisplay" class="form-control" id="dis1">';
					
					foreach ($obj->mProductDisplayOptions as $key=>$value) {
						$selected = '';
						if ($obj->mProduct['display'] == $key) {
							$selected = 'selected';
						}
						echo '<option label="'.$value.'" value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				echo '
				</select>';
				echo '<br><input type="submit" name="SetProductDisplayOption" class="secondary-button" value="Set">';
		echo '</div></div></div></div>';
		// End
		echo '<hr>';
		
		// Product Images
		echo '
		<div class="row">
		<div class="col-sm-4">';
		echo '
		<h4>Image Name: <small>'.$obj->mProduct['image'].'</small></h4>';
		if (isset($obj->mProduct['image'])) {
			echo '<img class="img-rounded text-center img-responsive" src="product_images/'.$obj->mProduct['image'].'" alt="'.$obj->mProduct['name'].' image"><hr>';
		}
		echo'
		<input name="ImageUpload" type="file" value="Upload"><br>
		<input type="submit" name="Upload" class="secondary-button" value="Upload">
		</div>';
		
		echo '
		<div class="col-sm-4">
		<h4>Image 2 Name: <small>'.$obj->mProduct['image_2'].'</small></h4>';
		if (isset($obj->mProduct['image_2'])) {
			echo '<img class="text-center img-responsive" src="product_images/'.$obj->mProduct['image_2'].'" alt="'.$obj->mProduct['name'].' image 2"><hr>';
		}
		echo '
		<input name="Image2Upload" type="file" value="Upload"><br>
		<input type="submit" name="Upload" class="secondary-button" value="Upload">
		</div>';
		
		echo '
		<div class="col-sm-4">
		<h4>Thumbnail Name: <small>'.$obj->mProduct['thumbnail'].'</small></h4>';
		if (isset($obj->mProduct['thumbnail'])) {
			echo '<img class="img-rounded img-responsive text-center" src="product_images/'.$obj->mProduct['thumbnail'].'" alt="'.$obj->mProduct['name'].' thumbnail"><hr>';
		}
		echo '
		<input name="ThumbnailUpload" type="file" value="Upload"><br>
		<input type="submit" name="Upload" class="secondary-button" value="Upload">
		</div><hr>
		</div>';	
	echo '</form>';
?>