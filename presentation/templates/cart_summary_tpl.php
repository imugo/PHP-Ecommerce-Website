<?php
	include PRESENTATION_DIR.'cart_summary.php';
	$obj = new CartSummary();
	
	if (!$obj->mEmptyCart) {
		echo '
		<div class="btn-group btn-group-lg" id="contents">
			<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-shopping-cart"></i><i class="badge">';
					if ($obj->mCartItems == null) {
						echo '0';	
					}
					else {
						echo $obj->mCartItems;	
					}
				echo '</i><i class="caret"></i>
			</a>
			<div class="dropdown-menu col-xs-12" role="menu"><div class="container">';
				for ($i=0; $i<count($obj->mItems); $i++) {
					echo '<div class="row">';
						echo '
						<div class="col-sm-6 col-xs-6">
							<p>'.$obj->mItems[$i]['quantity'].' x '.$obj->mItems[$i]['name'].'</p>
							<p>'.$obj->mItems[$i]['attributes'].'</p>
						</div>
						<div class="col-sm-6 col-xs-6">
							<p>'.$obj->mItems[$i]['subtotal'].'</p>
						</div>';
					echo '</div><br>';
				}
				// Total amount in cart
				echo '
					<div class="row">
						<div class="col-sm-12 col-xs-12 col-sm-12 col-lg-12">';
							echo '<strong>Total: '.$obj->mTotalAmount.'</strong>';
						echo '</div>';
					echo '</div><hr><br>';
					
					echo '<div class="row">';
						echo '<div class="col-sm-12 col-xs-12">';
							echo '<a href="'.$obj->mLinkToCartDetails.'" class="primary-button">MAKE AN ORDER</a>';
						echo '</div>
					</div>
				
				</div>
				';
			echo '	
			</div></div>';
		}
		
		else {
			echo '
				<div class="btn-group btn-group-lg" id="contents">
				<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">	
					<i class="glyphicon glyphicon-shopping-cart"></i><i class="badge">';
						if ($obj->mCartItems == null) {
							echo '0';	
						}
						else {
							echo $obj->mCartItems;	
						}
					echo '</i>
				</a>
				<div class="dropdown-menu" role="menu"><div class="container">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<p>Your shopping cart is empty</p><br><hr>';
			   				if (count($obj->mSavedCartProducts) > 0) {
								echo '<a href="'.$obj->mLinkToCartDetails.'" class="primary-button">Saved Items</a>';
							}
					echo '</div></div></div>';
			   echo '
				</div>
			<div>';
		}
	
?>