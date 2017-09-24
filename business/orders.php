<?php 
	class Orders {
		public static $mOrderStatusOptions = array(
												'placed', // 0
												'verified', // 1
												'completed', // 2
												'canceled'); // 3	
												
		// Get the most recent $how_many orders
		public static function GetMostRecentOrders($how_many) {
			// Build the sql query
			$sql = 'CALL orders_get_most_recent_orders(:how_many)';
			
			// Build the params
			$params = array(':how_many'=>$how_many);
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql, $params);	
		}
		
		// Get orders between two dates
		public static function GetOrdersBetweenDates($startDate, $endDate) {
			// Build the sql query
			$sql = 'CALL orders_get_orders_between_dates(:start_date, :end_date)';
			
			// Build the params
			$params = array(':start_date'=>$startDate, ':end_date'=>$endDate);
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql, $params);
		}
		
		// Get orders by status
		public static function GetOrdersByStatus($status) {
			// Build the sql query
			$sql = 'CALL orders_get_orders_by_status(:status)';
			
			// Build the params
			$params = array(':status'=>$status);
			
			// Execute the query and return the results
			return DatabaseHandler::GetAll($sql, $params);	
		}
		
		// Get the details of a specific order
		public static function GetOrderInfo($orderId) {
			// Build the sql query
			$sql = 'CALL orders_get_order_info(:order_id)';
			
			// Build the parameters
			$params = array(':order_id'=>$orderId);
			
			// Execute and return the results
			return DatabaseHandler::GetRow($sql, $params);
		}
		
		// Get the products that belong to a specific category
		public static function GetOrderDetails($orderId) {
			// Build the sql query
			$sql = 'CALL orders_get_order_details(:order_id)';
			
			// Build the parameters
			$params = array(':order_id'=>$orderId);
			
			// Execute and return the results
			return DatabaseHandler::GetAll($sql, $params);
		}
		
		// Update order details
		public static function UpdateOrder($orderId, $status, $comments, $customerName, $shippingAddress, $customerEmail) {
			// Build the sql query
			$sql = 'CALL orders_update_order(:order_id, :status, :comments, :customer_name, :shipping_address, :customer_email)';
			
			// Build the parameters
			$params = array(':order_id'=>$orderId,
							':status'=>$status,
							':comments'=>$comments,
							':customer_name'=>$customerName,
							':shipping_address'=>$shippingAddress,
							':customer_email'=>$customerEmail);
			
			// Execute the query
			DatabaseHandler::Execute($sql, $params);
		}
	}
?>