<?php
	include PRESENTATION_DIR.'cart_details.php';
	$obj = new CartDetails();
	$obj->init();
	
	echo '<div id="contents">';
	if ($obj->mIsCartNowEmpty == 1) {
		echo '<h2 class="text-center">Your shopping cart is empty</h2><br>';
	}
	else {
		echo '<div class="container" style="margin-top: 20px;">';
		echo '<h1 class="text-center">Your Shopping Cart <small><i class="glyphicon glyphicon-shopping-cart" style="color: black;"></i></small></h1>';
		echo '<form method="post" action="'.$obj->mUpdateCartTarget.'" onsubmit="return executeCartAction(this)">';
		echo '<div class="table-responsive">';
			echo '<table class="table">';
			echo '<tr>
					<th>Product(s)</th>
					<th>&nbsp;</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>&nbsp;</th>
				  </tr>';
				
				for ($i = 0; $i < count($obj->mCartProducts); $i++) {
					echo '
					<tr>
						<td>
							<img class="lazy img-responsive img-rounded" src="'.$obj->mCartProducts[$i]['thumbnail'].'" alt="'.$obj->mCartProducts[$i]['name'].'" width="92" height="102">
						</td>
						<td>
							<input type="hidden" name="ItemId[]" value="'.$obj->mCartProducts[$i]['item_id'].'">
							'.$obj->mCartProducts[$i]['name'] .'('.$obj->mCartProducts[$i]['attributes'].')
						</td>
						<td>N '.$obj->mCartProducts[$i]['price'].'</td>
						<td>
							<input type="text" name="quantity[]" size="5" value="'.$obj->mCartProducts[$i]['quantity'].'">
						</td>
						<td>
							N '.$obj->mCartProducts[$i]['subtotal'].'
						</td>
						<td>
							<button type="submit" class="primary-button" name="update">Update</button><br><br>
							<a href="'.$obj->mCartProducts[$i]['save'].'" class="primary-button" onclick="return executeCartAction(this)">Save for later</a><br><br><br>
							<a href="'.$obj->mCartProducts[$i]['remove'].'" class="primary-button" onclick="return executeCartAction(this)">Remove</a><br><br>
						</td>	
					</tr>';
				}
			echo '</table></div><hr>';
			echo '
				<div class="row">
					<div class="col-sm-6">
						<p>Total Amount:</p>
					    <span class="product-price">N '.$obj->mTotalAmount.'</span><br><br>
					</div>
					<div class="col-sm-6">
						<span class="">
							<input type="submit" class="add-to-cart-primary-button" value="Place Order" name="place_order" onclick="placingOrder=true;">
						</span>
					</div><br><br>
				</div>	
		</form>
		';
	}
	
	if ($obj->mIsCartLaterEmpty == 0) {
		echo '<div class="container">';
		echo '
		<h3>Saved products to buy later</h3>';
		echo '<div class="table-responsive">
		<table class="table">
			<tr>
				<th width="4">Product(s)</th>
				<th width="4">&nbsp;</th>
				<th>Price</th>
				<th>&nbsp;</th>
			</tr>';
			
			for ($j = 0; $j < count($obj->mSavedCartProducts); $j++) {
				echo '
				<tr>
					<td><img class="lazy img-responsive img-rounded" src="'.$obj->mSavedCartProducts[$j]['thumbnail'].'" alt="'.$obj->mSavedCartProducts[$j]['name'].'" width="92" height="102"></td>
					<td>'.$obj->mSavedCartProducts[$j]['name'] .'('.$obj->mSavedCartProducts[$j]['attributes'].')</td>
					<td>&nbsp;'.$obj->mSavedCartProducts[$j]['price'].'</td>
					<td>
						<a href="'.$obj->mSavedCartProducts[$j]['move'].'" class="primary-button" onclick="return executeCartAction(this)">Move to cart</a>
						<a href="'.$obj->mSavedCartProducts[$j]['remove'].'" class="primary-button" onclick="return executeCartAction(this)">Remove</a>
					</td> 
				</tr>';
			}
		echo '</table></div></div><hr>';
	}
	if ($obj->mLinkToContinueShopping) {
		echo '<div class="container">
			<a href="'.$obj->mLinkToContinueShopping.'" class="secondary-button"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
			</div><br><hr>';
	}
	
	
	
					// Product recommendations
					echo '
					<div class="row">
					<div class="col-sm-12">';
					if (count($obj->mRecommendations) > 0) {
						echo '<h3 class="text-center">FIND SIMILAR PRODUCTS IN OUR CATALOG</h3>
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
					echo '</div>';
?>