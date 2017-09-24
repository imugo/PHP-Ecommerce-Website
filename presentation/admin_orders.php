<?php
	class AdminOrders {
		public $mOrders;
		public $mStartDate;
		public $mEndDate;
		public $mRecordCount = 20;
		public $mOrderStatusOptions;
		public $mSelectedStatus = 0;
		public $mErrorMessage = '';
		public $mLinkToAdmin;
		
		public function __construct() {
			/***
			* Save the link to the current page in the link_to_orders_admin session variable.
			* It will create the "back to admin orders" link in admin order details pages.
			**/	
			$_SESSION['link_to_orders_admin'] = Link::Build(str_replace(VIRTUAL_LOCATION, '', getenv('REQUEST_URI')));
			
			$this->mLinkToAdmin = Link::ToAdmin();
			$this->mOrderStatusOptions = Orders::$mOrderStatusOptions;
		}
		
		public function init() {
			// If the "Show the most recent x orders.." is in action
			if (isset($_GET['submitMostRecent'])) {
				// if the record count is not a valid integer, display error
				if ((string)(int)$_GET['recordCount'] == (string)$_GET['recordCount']) {
					$this->mRecordCount = (int)$_GET['recordCount'];
					$this->mOrders = Orders::GetMostRecentOrders($this->mRecordCount);
				}
				else {
					$this->mErrorMessage = $_GET['recordCount'].' is not a number.';	
				}
			}
			
			// If the show all records between dates in action
			if (isset($_GET['submitBetweenDates'])) {
				$this->mStartDate = $_GET['startDate'];
				$this->mEndDate = $_GET['endDate'];
				
				// Chesck if the start date is in accepted form
				if (($this->mStartDate == '') || ($timestamp = strtotime($this->mStartDate)) == -1) {
					$this->mErrorMessage = 'The start date is invalid.';
				}
				else {
					// Transform date to YY/MM/DD HH:DD:SS	
					$this->mStartDate = strftime('%Y/%m/%d %H:%M:%S', strtotime($this->mStartDate));
				}
				
				// Chesck if the end date is in accepted form
				if (($this->mEndDate == '') || ($timestamp = strtotime($this->mEndDate)) == -1) {
					$this->mErrorMessage = 'The end date is invalid.';
				}
				else {
					// Transform date to YY/MM/DD HH:DD:SS	
					$this->mEndDate = strftime('%Y/%m/%d %H:%M:%S', strtotime($this->mEndDate));
				}
				
				// Check if start date is more recent than end date
				if ((empty($this->mErrorMessage)) && (strtotime($this->mStartDate) > strtotime($this->mEndDate))) {
					$this->mErrorMessage = 'The start date should be more recent than the end date';	
				}
				
				// If there are no errors get the orders between the two dates
				if (empty($this->mErrorMessage)) {
					$this->mOrders = Orders::GetOrdersBetweenDates($this->mStartDate, $this->mEndDate);
				}
			}
			// If "Show Orders by status" filter is in action...
			if (isset($_GET['submitOrdersByStatus'])) {
				$this->mSelectedStatus = $_GET['status'];
				$this->mOrders = Orders::GetOrdersByStatus($this->mSelectedStatus);
			}
				
			if (is_array($this->mOrders) && count($this->mOrders) == 0) {
				$this->mErrorMessage = 'No orders found matching your searching criteria!';
			}
			// Build view detail links!
			for ($i=0; $i<count($this->mOrders); $i++) {
				$this->mOrders[$i]['link_to_orders_detail_admin'] = Link::ToOrderDetailsAdmin($this->mOrders[$i]['order_id']);
			}
		}
	}
?>