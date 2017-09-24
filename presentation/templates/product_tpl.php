<?php
	include_once PRESENTATION_DIR.'product.php';
	$obj = new Product();
	$obj->init();
	
	echo '	<div class="container">
		    <div class="btn-breadcrumb btn-group">
		  				<a class="btn btn-default" href="'.$obj->mLinkToIndex.'"><i class="fa fa-home"></i></strong></a>';
					for ($i=0; $i<count($obj->mLocations); $i++) {
						echo '
						<a class="btn btn-default" href="'.$obj->mLocations[$i]['link_to_department'].'">'.$obj->mLocations[$i]['department_name'].'</strong></a>
						<a class="btn btn-default" href="'.$obj->mLocations[$i]['link_to_category'].'">'.$obj->mLocations[$i]['category_name'].'</strong></a>';
					}
	
			echo '</div>';
		
		echo '
			<div class="productDetailsRow">
				<div class="productDetailsCol item1">
					<img class="img-rounded img-responsive lazy product-col-img" data-original="'.$obj->mProduct['image'].'" alt="'.$obj->mProduct['name'].'"><br><br>
					<img class="lazy img-responsive product-col-img" data-original="'.$obj->mProduct['image_2'].'" alt="'.$obj->mProduct['name'].'"><br><br>';
					
					// Admin button functionality
					if ($obj->mShowEditButton) {
						echo '
						<form action="'.$obj->mEditActionTarget.'" method="post" target="_self">
							<input type="submit" name="submit_edit" value="Edit Product details" class="btn btn-default">
						</form>';
					}
					
					// Continue shopping functionality
					if ($obj->mLinkToContinueShopping)
						echo '<a class="secondary-button" href="'.$obj->mLinkToContinueShopping.'"><i class="fa fa-arrow-left"></i> Continue Shopping</a><br>';
				echo '
				</div>
				<div class="productDetailsCol item2">
					<h1>'.$obj->mProduct['name'].'</h1>
					<p class="product-description-text">'.$obj->mProduct['description'].'</p><br><hr>';
					
					// Add to cart form
					echo '<form class="add-product-form" target="_self" method="post" action="'.$obj->mProduct['link_to_add_product'].'" onsubmit="return addProductToCart(this)">';
					// For product attributes
					echo '<div class="row">'; 
					
					for ($i=0; $i<count($obj->mProduct['attributes']); $i++) {
						// Generate a select tag? 
						if ($i == 0 || $obj->mProduct['attributes'][$i]['attribute_name'] !== $obj->mProduct['attributes'][$i-1]['attribute_name']) {
						echo '<div class="col-sm-2 col-xs-3"><p>'.$obj->mProduct['attributes'][$i]['attribute_name'].'</p></div>';
						echo '<div class="col-sm-10 col-xs-9"><select name="attr_'.$obj->mProduct['attributes'][$i]['attribute_name'].'">';
						}
						
						// Generate option tags
						echo '<option value="'.$obj->mProduct['attributes'][$i]['attribute_value'].'">'.$obj->mProduct['attributes'][$i]['attribute_value'].'</option>';
						
						// Close the select tag?
						if ($obj->mProduct['attributes'][$i]['attribute_name'] !== $obj->mProduct['attributes'][$i+1]['attribute_name'])
							echo '</select></div><br><br>';
					}
					
					echo '</div><hr>';
					
					echo '
					<div class="product-price text-right">'.$obj->mProduct['price'].' N</div><br>
										
					<div class="text-right">
					    <button type="submit" name="add_to_cart" class="add-to-cart-primary-button"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button>
					</div>
					</form></div></div>';
					
					// Product recommendations
					echo '
					
					<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">';
					if (count($obj->mRecommendations) > 0) {
						echo '<h3>FIND SIMILAR PRODUCTS IN OUR CATALOG</h3>
						<div id="product-carousel" class="owl-carousel">';
							for ($i=0; $i<count($obj->mRecommendations); $i++) {
								echo '
								<div class="item">
									<img class="img-responsive" src="'.$obj->mRecommendations[$i]['image'].'" alt="'.$obj->mRecommendations[$i]['product_name'].'"/>
								</div>';
							}
					}
						echo '
					</div></div></div>';
	
?>
