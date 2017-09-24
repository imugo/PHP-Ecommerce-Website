<?php
	// Business tier class that manages customer account functionality
	class Customer {
		// stores the user's customer id
		private static $_mCustomerId;
		
		private function __construct() {
			
		}
		
		// Check if a customer id exists in a function
		public static function IsAuthenticated() {
			// if self::$_mCustomerId hasn't already been set
			if (self::$_mCustomerId == '') {
				// if the customer's id is in the session get it from there
				if (isset($_SESSION['shirtswithstamps_customer_id'])) {
					self::$_mCustomerId = $_SESSION['shirtswithstamps_customer_id'];
					return 1;
				}
			}
				else {
					return 0;	
				}
		}
		
		// return customer id and password with email
		public static function GetLoginInfo($email) {
			// Build the sql query
			$sql = 'CALL customer_get_login_info(:email)';
			
			// Build the parameters array
			$params = array(':email'=>$email);
			
			// Execute the query and return the results
			return DatabaseHandler::GetRow($sql, $params);	
		}
		
		public static function IsValid($email, $password) {
			$customer = self::GetLoginInfo($email);
			
			if (empty($customer['customer_id'])) {
				return 2;
			}
			
			$customer_id = $customer['customer_id'];
			$hashed_password = $customer['password'];
			
			if (!password_verify($password, $hashed_password)) {
				return 1;
			}
			else {
				$_SESSION['shirtswithstamps_customer_id'] = $customer_id;
				return 0;	
			}
		}
		
		public static function Logout() {
			unset($_SESSION['shirtswithstamps_customer_id']);	
		}
		
		public static function GetCurrentCustomerId() {
			if (self::IsAuthenticated()) {
				return $_SESSION['shirtswithstamps_customer_id'];
			}
			else {
				return 0;	
			}
		}
		// Add a new customer account and login if $addAndLogi is true
		public static function Add($name, $email, $password, $addAndLogin = true) {
			$hashed_password = PasswordHasher::Hash($password);
			
			// Build the sql query
			$sql = 'CALL customer_add(:name, :email, :password)';
			
			// Bild the parameters array
			$params = array(':name'=>$name, ':email'=>$email, ':password'=>$hashed_password);
			
			// Execute the query and return the results
			$customer_id = DatabaseHandler::GetOne($sql, $params);
			
			if ($addAndLogin) {
				$_SESSION['shirtswithstamps_customer_id'] = $customer_id;
			}
			
			return $customer_id;
		}
		
		public static function Get($customerId = null) {
			if (is_null($customerId)) {
				$customerId = self::GetCurrentCustomerId();
			}
			
			// Build the sql query
			$sql = 'CALL customer_get_customer(:customer_id)';
			
			// Build the params
			$params = array(':customer_id'=>$customerId);
			
			// Execute the quer and return the results
			return DatabaseHandler::GetRow($sql, $params);
		}
		
		public static function UpdateAccountDetails($name, $email, $password, $dayPhone, $evePhone, $mobPhone, $customerId = null) {
			if (is_null($customerId)) {
				$customerId = self::GetCurrentCustomerId();
			}
			
			$hashed_password = PasswordHasher::Hash($password);
			
			// Build the sql query
			$sql = 'CALL customer_Update_account(:customer_id, :name, :email, :password, :dayPhone, :evePhone, :mobPhone)';
			
			// Build the query params
			$params = array(':customer_id'=>$customerId, ':name'=>$name, ':email'=>$email, ':password'=>$password, ':dayPhone'=>$dayPhone, 'evePhone'=>$evePhone, ':mobPhone'=>$mobPhone);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
		
		public static function GetShippingRegions() {
			// Build the sql query
			$sql = 'CALL customer_get_shipping_regions()';
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql);	
		}
		
		public static function UpdateAddressDetails($address1, $address2, $city, $region, $postalCode, $country, $shippingRegionId, $customerId = null) {
			if (is_null($customerId)) {
				$customerId = self::GetCurrentCustomerId();
			}
			
			// Build the sql query
			$sql = 'customer_update_address(:customer_id, :address1, :address2, :city, :region, :postalCode, :country, :shippingRegionId)';
			
			// Build the query params
			$params = array(':customer_id'=>$customerId, ':address1'=>$address1, ':address2'=>$address2, ':city'=>$city, ':region'=>$regiondayPhone, 'postalCode'=>$postalCode, ':country'=>$country, ':shippingRegionId'=>$shippingRegionId);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
	}
?>