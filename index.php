<?php
// Activate Session
session_start();

// Start output buffer
ob_start();

// Include utility files
require_once 'include/config.php';
require_once BUSINESS_DIR.'error_handler.php';

// Set the error handler
ErrorHandler::SetHandler();

require_once PRESENTATION_DIR.'link.php';

// Load the database handler
require_once BUSINESS_DIR.'database_handler.php';

// Load the business tier
require_once BUSINESS_DIR.'catalog.php';
require_once BUSINESS_DIR.'shopping_cart.php';

// URL correction
Link::CheckRequest();

// Handle AJAX requests
if (isset ($_GET['AjaxRequest'])) {
	
	// Headers are sent to prevent browsers from caching
	header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // Time in the past
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('Content-Type: text/html');
	
	if (isset($_GET['CartAction'])) {
		$cart_action = $_GET['CartAction'];

		if ($cart_action == ADD_PRODUCT) {
			require_once PRESENTATION_DIR . 'cart_details.php';
			$cart_details = new CartDetails();
			$cart_details->init();
			require_once PRESENTATION_DIR.'templates/cart_summary_tpl.php';
		}
		else {
			require_once PRESENTATION_DIR . 'templates/cart_details_tpl.php';
		}
	}
	else {
		trigger_error('CartAction not set', E_USER_ERROR);
	}
}
else {
	// Display the page
	require_once PRESENTATION_DIR.'templates/store_front_tpl.php';
}

// Close the database connection
DatabaseHandler::Close();

// Output content from the buffer
flush();
ob_flush();
ob_end_clean();
?>