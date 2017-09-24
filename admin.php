<?php
// Activate session
session_start();

// Start Output Buffer
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
require_once BUSINESS_DIR.'orders.php';

require_once PRESENTATION_DIR.'templates/store_admin_tpl.php';

// Close the database connection
DatabaseHandler::Close();

// Output content from the buffer
flush();
ob_flush();
ob_end_clean();
?>