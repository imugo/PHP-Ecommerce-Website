<?php
	class CartSummary {
		public $mTotalAmount;
		public $mItems;
		public $mLinkToCartDetails;
		public $mEmptyCart;
		public $mSiteUrl;
		public $mSavedCartProducts;
		// Total quantity of items in cart
		public $mCartItems;
		
		public function __construct() {
			$this->mCartItems = ShoppingCart::GetCurrentProducts();	
			// Calculate the total amount for the shopping cart 
			// Before applicable taxes and shipping
			$this->mTotalAmount = ShoppingCart::GetTotalAmount();
			
			// Get shopping cart products
			$this->mItems = ShoppingCart::GetCartProducts(GET_CART_PRODUCTS);
			
			for ($i=0; $i<count($this->mItems); $i++) {
				$this->mItems[$i]['thumbnail'] = Link::Build('product_images/'.$this->mItems[$i]['thumbnail']);
			}
		
			if (empty($this->mItems)) {
				$this->mEmptyCart = true;
			}
			else {
				$this->mEmptyCart = false;	
			}
			
			$this->mLinkToCartDetails = Link::ToCart();
			
			// Get the save for later products
			$this->mSavedCartProducts = ShoppingCart::GetCartProducts(GET_CART_SAVED_PRODUCTS);
		}
	}
?>