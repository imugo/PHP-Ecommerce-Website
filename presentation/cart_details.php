<?php
	// Class that deals with managing the shopping cart
	class CartDetails {
		public $mCartProducts;
		public $mSavedCartProducts;
		public $mTotalAmount;
		public $mIsCartNowEmpty = 0; // Is shopping cart empty
		public $mIsCartLaterEmpty = 0; // Is the 'save for later list' empty
		public $mLinkToContinueShopping;
		public $mUpdateCartTarget;
		public $mRecommendations;
		
		// Private attributes
		private $_mItemId;
		private $_mCartAction;
		
		public function __construct() {
			if (isset($_GET['CartAction'])) {
				$this->_mCartAction = $_GET['CartAction'];
			}
			else {
				trigger_error('CartAction not set', E_USER_ERROR);	
			}
			
			// These cart actions require a valid product id
			if ($this->_mCartAction == ADD_PRODUCT || $this->_mCartAction == REMOVE_PRODUCT ||
				$this->_mCartAction == SAVE_PRODUCT_FOR_LATER || $this->_mCartAction == MOVE_PRODUCT_TO_CART) {
				if (isset($_GET['ItemId'])) {
					$this->_mItemId = $_GET['ItemId'];
				}
				else {
					trigger_error('ItemId must be set for this kind of request', E_USER_ERROR);	
				}
			}
				$this->mUpdateCartTarget = Link::ToCart(UPDATE_PRODUCTS_QUANTITIES);
				
				// Setting the continue shopping link target
				if (isset($_SESSION['link_to_last_loaded_page'])) {
					$this->mLinkToContinueShopping = $_SESSION['link_to_last_loaded_page'];
				}
		}
			
		public function init() {
			switch ($this->_mCartAction) {
				case ADD_PRODUCT:
					$selected_attributes = array();
					$selected_attribute_values = array();
					
					// Get selected product attributes if any
					foreach ($_POST as $key=>$value) {
						// If there are fields starting with the $_POST array
						if (substr($key, 0, 5) == 'attr_') {
							// Get the selected attribute name and value
							$selected_attributes[] = substr($key, strlen('attr_'));
							$selected_attribute_values[] = $_POST[$key];
						}
					}
					
					$attributes = '';
					
					if (count($selected_attributes) > 0) {
						$attributes = implode('/', $selected_attributes).': '.implode('/', $selected_attribute_values); 
					}
					
					ShoppingCart::AddProduct($this->_mItemId, $attributes);
					
					if (!isset ($_GET['AjaxRequest']))
						header('Location: ' . $this->mLinkToContinueShopping);
					else
						return;
					
					break;
				
				case REMOVE_PRODUCT:
					ShoppingCart::RemoveProduct($this->_mItemId);
					
					if (!isset ($_GET['AjaxRequest']))
						header('Location: ' . Link::ToCart());
					break;
					
				case UPDATE_PRODUCTS_QUANTITIES:
					for ($i=0; $i<count($_POST['ItemId']); $i++) {
						ShoppingCart::Update($_POST['ItemId'][$i], $_POST['quantity'][$i]);
					}
					if (!isset ($_GET['AjaxRequest']))
						header('Location: ' . Link::ToCart());
					
					break;
				case SAVE_PRODUCT_FOR_LATER:
					ShoppingCart::SaveProductForLater($this->_mItemId);
					if (!isset ($_GET['AjaxRequest']))
						header('Location: ' . Link::ToCart());
					
					break;
				case MOVE_PRODUCT_TO_CART:
					ShoppingCart::MoveProductToCart($this->_mItemId);
					if (!isset ($_GET['AjaxRequest']))
						header('Location: ' . Link::ToCart());
					
					break;
				default:
					// Do Nothing
				break;
			}
			
			// Calculate the total amount before taxes and shipping costs
			$this->mTotalAmount = ShoppingCart::GetTotalAmount();
			
			// If the place order button was clicked
			if (isset($_POST['place_order'])) {
				// Create the order and get the order id
				$order_id = ShoppingCart::CreateOrder();
				
				// This will contain the PayPal link
				$redirect =
				PAYPAL_URL . '&item_name=TShirtShop Order ' . urlencode('#') . $order_id .
				'&item_number=' . $order_id .
				'&amount=' . $this->mTotalAmount .
				'&currency_code=' . PAYPAL_CURRENCY_CODE .
				'&return=' . PAYPAL_RETURN_URL .
				'&cancel_return=' . PAYPAL_CANCEL_RETURN_URL;
				// Redirection to the payment page
				header('Location: ' . $redirect);
				exit();
			}
			
			// Get shipping cart products
			$this->mCartProducts = ShoppingCart::GetCartProducts(GET_CART_PRODUCTS);
			
			// Get the save for later products
			$this->mSavedCartProducts = ShoppingCart::GetCartProducts(GET_CART_SAVED_PRODUCTS);
			
			// Check if we have an empty cart
			if (count($this->mCartProducts) == 0) {
				$this->mIsCartNowEmpty = 1;
			}
			
			// Check if we have an empty saved for later list
			if (count($this->mSavedCartProducts) == 0) {
				$this->mIsCartLaterEmpty = 1;
			}
			
			// Build the links for the cart actions
			for ($i=0; $i<count($this->mCartProducts); $i++) {
				$this->mCartProducts[$i]['save'] = Link::ToCart(SAVE_PRODUCT_FOR_LATER, $this->mCartProducts[$i]['item_id']);
				$this->mCartProducts[$i]['remove'] = Link::ToCart(REMOVE_PRODUCT, $this->mCartProducts[$i]['item_id']);
				$this->mCartProducts[$i]['thumbnail'] = Link::Build('product_images/'.$this->mCartProducts[$i]['thumbnail']);
			}
			
			for ($i=0; $i<count($this->mSavedCartProducts); $i++) {
				$this->mSavedCartProducts[$i]['move'] = Link::ToCart(MOVE_PRODUCT_TO_CART, $this->mSavedCartProducts[$i]['item_id']);
				$this->mSavedCartProducts[$i]['remove'] = Link::ToCart(REMOVE_PRODUCT, $this->mSavedCartProducts[$i]['item_id']);
				$this->mSavedCartProducts[$i]['thumbnail'] = Link::Build('product_images/'.$this->mSavedCartProducts[$i]['thumbnail']);
			}
			
			// Get Shopping Cart recommendations
			$this->mRecommendations = ShoppingCart::GetRecommendations();
			
			// Create recommended product links
			for ($i=0; $i<count($this->mRecommendations); $i++) {
				$this->mRecommendations[$i]['link_to_product'] = Link::ToProduct($this->mRecommendations[$i]['product_id']);
				$this->mRecommendations[$i]['image'] = Link::Build('product_images/'.$this->mRecommendations[$i]['image']);	
			}
		}
	}
?>