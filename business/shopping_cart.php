<?php
	class ShoppingCart {
		// Stores the visitor's cart id
		private static $_mCartId;
		
		private function __construct() {
			
		}
		
		// This will be called by the GetCartId to ensure we have the visitor's cart ID in the visitor's session
		// in case $_mCartId has no value set
		public static function SetCartId() {
			// If $_mCartId hasn't already been set
			if (self::$_mCartId == '') {
				// If the visitor's cart Id is in the session get it from there
				if (isset($_SESSION['cart_id'])) {
					self::$_mCartId = $_SESSION['cart_id'];
				}
				// If not check the visitor's cookie
				elseif (isset($_COOKIE['cart_id'])) {
					self::$_mCartId = $_COOKIE['cart_id'];
					$_SESSION['cart_id'] = self::$_mCartId;	
					
					// Regenerate cookie to be valid for seven days
					setcookie('cart_id', self::$_mCartId, time() + 604800);
				}
				// Generate cart ID and save it to self::$_mCartId, the session and the cookie 
				// (on subsequent requests self::$_mCartId will be populated from the session
				else {
					self::$_mCartId = md5(uniqid(rand(), true));
					
					// Store cart ID in the session
					$_SESSION['cart_id'] = self::$_mCartId;
					
					// Cookie to be valid for seven days (604800 seconds)
					setcookie('cart_id', self::$_mCartId, time() + 604800);
				}
			}
		}
		
		// Return the current visitor's ID
		public static function GetCartId() {
			// Ensure we have the cart ID for the current visitor
			if (!isset(self::$_mCartId)) {
				self::SetCartId();
			}
			
			return self::$_mCartId;
		}
		
		// Adds product to the shopping cart
		public static function AddProduct($productId, $attributes) {
			// Build SQL query
			$sql = 'CALL shopping_cart_add_product(:cart_id, :product_id, :attributes)';
			
			// Build the parameters array
			$params = array(':cart_id'=>self::GetCartId(), ':product_id'=>$productId, ':attributes'=>$attributes);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		// Updates the shopping cart with new prosucts and quantities
		public static function Update($itemId, $quantity) {
			// Build SQL query
			$sql = 'CALL shopping_cart_update(:item_id, :quantity)';
			
			// Build the parameters array
			$params = array(':item_id'=>$itemId, ':quantity'=>$quantity);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		// Removes product from shopping cart
		public static function RemoveProduct($itemId) {
			// Build SQL query
			$sql = 'CALL shopping_cart_remove_product(:item_id)';
			
			// Build the parameters array
			$params = array(':item_id'=>$itemId);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		// Get Shopping cart products
		public static function GetCartProducts($cartProductsType) {
			$sql = '';	
			// If retrieving active shopping cart products
			if ($cartProductsType == GET_CART_PRODUCTS) {
				// Build SQL query
				$sql = 'CALL shopping_cart_get_products(:cart_id)';	
			}
			// If retrieving saved shopping cart products
			elseif ($cartProductsType == GET_CART_SAVED_PRODUCTS) {
				// Build SQL query
				$sql = 'CALL shopping_cart_get_saved_products(:cart_id)';
			}
			else {
				trigger_error($cartProductsType.' Value Uknown ', E_USER_ERROR);	
			}
			
			// Build the paras array
			$params = array(':cart_id'=>self::GetCartId());
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql, $params);
		}
		
		// Get total amount of shopping cart products before tax or shipping charges
		// (not including the ones saved for later
		public static function GetTotalAmount() {
			// Build the SQL query
			$sql = 'CALL shopping_cart_get_total_amount(:cart_id)';
			
			// Build the parameters array
			$params = array(':cart_id'=>self::GetCartId());
			
			// Execute the query
			return DatabaseHandler::GetOne($sql, $params);
		}	
		
		// Save products to the save for later list
		public static function SaveProductForLater($itemId) {
			// Build the SQL query
			$sql = 'CALL shopping_cart_save_product_for_later(:item_id)';
			
			// Build the parameters array
			$params = array(':item_id'=>$itemId);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		// Get product from the save for later list
		public static function MoveProductToCart($itemId) {
			// Build the sql query
			$sql = 'CALL shopping_cart_move_product_to_cart(:item_id)';	
			
			// Build the parameters array
			$params = array(':item_id'=>$itemId);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		// Count old shopping carts
		public static function CountOldShoppingCarts($days) {
			// Build SQL query
			$sql = 'CALL shopping_cart_count_old_carts(:days)';
			
			// Build the params
			$params = array(':days'=>$days);
			
			// Execute the query and return the result
			return DatabaseHandler::GetOne($sql,$params);	
		}
		
		// Delete old shopping carts
		public static function DeleteOldShoppingCarts($days) {
			// Build the sql query
			$sql = 'CALL shopping_cart_delete_old_carts(:days)';
			
			// Build the params
			$params = array(':days'=>$days);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);	
		}
		
		// Count current products
		public static function GetCurrentProducts() {
			// Build the sql query
			$sql = 'CALL shopping_cart_count_products(:cart_id)';
			
			// Build the params
			$params = array(':cart_id'=>self::GetCartId());
			
			// Execute the query
			return DatabaseHandler::GetOne($sql, $params);	
		}
		
		// Create a new odrse
		public static function CreateOrder() {
			// Build SQL query
			$sql = 'CALL shopping_cart_create_order(:cart_id)';
			
			// Build the params
			$params = array(':cart_id'=>self::GetCartId());
			
			// Execute the query and return the results
			return DatabaseHandler::GetOne($sql, $params);	
		}
		
		// Get the product recommendations
		public static function GetRecommendations() {
			// Build the SQL query
			$sql = 'CALL shopping_cart_get_recommendations(:cart_id)';
			
			// Build the params
			$params = array(':cart_id'=>self::GetCartId());
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql, $params);	
		}
	}
?>