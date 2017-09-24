<?php
//SITE_ROOT contains full path to the shirtswithstamps shop
define('SITE_ROOT', dirname(dirname(__FILE__)));

// Server HTTP PORT (can omit if the default 80 is used)
define('HTTP_SERVER_PORT', '80');

// Name of the virtual directory the site runs in
define('VIRTUAL_LOCATION', '/shirtswithstamps/');

//Application presentation directories
define('PRESENTATION_DIR', SITE_ROOT.'/presentation/');
define('BUSINESS_DIR', SITE_ROOT.'/business/');

//These should be true while developing the site
define('IS_WARNING_FATAL', true);
define('DEBUGGING', true);

//The error types to be reported
define('ERROR_TYPES', E_ALL);

//Settings about mailing the error message to admin
define('SEND_ERROR_MAIL', false);
define('ADMIN_ERROR_MAIL', 'ugochukwu95@gmail.com');
define('SENDMAIL_FROM', 'ERRORS@example.com');
ini_set('sendmail_from', 'SENDMAIL_FROM');

//By default we don't log errors to file
define('LOG_ERRORS', false);
define('LOG_ERRORS_FILE', 'c:\\xampp\htdocs\shirtswithstamps\errors.log');
define('SITE_GENERIC_ERROR_MESSAGE', 'ERROR! occured');

//Database connectivity setup
define('DB_PERSISTENCY', 'true');
define('DB_SERVER', 'localhost');
const DB_USERNAME = 'root';
define('DB_PASSWORD', 'mysql');
define('DB_DATABASE', 'shirtswithstamps');
define('PDO_DSN', 'mysql:host='.DB_SERVER.';dbname='.DB_DATABASE);

// Configure product lists display optiond
define('SHORT_PRODUCT_DESCRIPTION_LENGTH', '150');
const PRODUCTS_PER_PAGE = '16';

// Minimum word length for searches; this constant must be kept in sync with the ft_min_word_len MySQL variable
define('FT_MIN_WORD_LEN', 4);

// PayPal configuration
define('PAYPAL_URL', 'https://www.paypal.com/xclick/business=youremail@example.com');
define('PAYPAL_CURRENCY_CODE', 'USD');
define('PAYPAL_RETURN_URL', 'http://www.example.com');
define('PAYPAL_CANCEL_RETURN_URL', 'http://www.example.com');

// We enable and enforce SSL whent this is set to anything else than 'no'
define('USE_SSL', 'no');

// Administration login information
define('ADMIN_USERNAME', 'shirtswithstampsadmin');
define('ADMIN_PASSWORD', 'shirtswithstampsadmin');

// Shopping cart item types
define('GET_CART_PRODUCTS', 1);
define('GET_CART_SAVED_PRODUCTS', 2);

// Cart actions
define('ADD_PRODUCT', 1);
define('REMOVE_PRODUCT', 2);
define('UPDATE_PRODUCTS_QUANTITIES', 3);
define('SAVE_PRODUCT_FOR_LATER', 4);
define('MOVE_PRODUCT_TO_CART', 5);

?>