<?php
	class AdminOrderDetails {
		public $mOrderId;
		public $mOrderInfo;
		public $mOrderDetails;
		public $mEditEnabled;
		public $mOrderStatusOptions;
		public $mLinkToAdmin;
		public $mLinkToOrdersAdmin;
		
		public function __construct() {
			// Get the back link from the session
			$this->mLinkToOrdersAdmin = $_SESSION['link_to_orders_admin'];
			
			$this->mLinkToAdmin = Link::ToAdmin();
			
			// We recieve the order id in the query string 
			if (isset($_GET['OrderId'])) {
				$this->mOrderId = (int)$_GET['OrderId'];
			}
			else {
				trigger_error('OrderId not set');	
			}
			$this->mOrderStatusOptions = Orders::$mOrderStatusOptions;
		}
		
		// Initialixes class members
		public function init() {
			if (isset($_GET['submitUpdate'])) {
				Orders::UpdateOrder($this->mOrderId, $_GET['status'], $_GET['comments'], $_GET['customerName'], $_GET['shippingAddress'],
									$_GET['customerEmail']);
			}
			
			$this->mOrderInfo = Orders::GetOrderInfo($this->mOrderId);
			$this->mOrderDetails = Orders::GetOrderDetails($this->mOrderId);
			
			// Value which specifies whether to enable or disable edit mode
			if (isset($_GET['submitEdit'])) {
				$this->mEditEnabled = true;
			}
			else {
				$this->mEditEnabled = false;	
			}
			
		}
	}
?>