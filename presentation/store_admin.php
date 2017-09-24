<?php
    class StoreAdmin {
	public $mSiteUrl;

	// Define the template file for the page menu
	public $mMenuCell = 'blank.php';

	// Define the template file for the content menu
	public $mContentsCell = 'blank.php';

	// Class constructor
	public function __construct() {
	    $this->mSiteUrl = Link::Build('', 'https');

	    // Enforce page to be accessed through HTTPS if USE_SSL == yes
	    if (USE_SSL === 'yes' && getenv('HTTPS') !== 'on') {
		header('Location: https://'.getenv('SERVER_NAME').getenv('REQUEST_URI'));
		exit();
	    }
	}

	public function init() {
	    // If admin is not logged in, load the admin_login template
	    if (!(isset($_SESSION['admin_logged'])) || $_SESSION['admin_logged'] != true) {
			$this->mContentsCell = 'admin_login_tpl.php';
		}
	    else {
			// If admin is logged in, load the admin menu page
			$this->mMenuCell = 'admin_menu_tpl.php';
	
			// If logging out...
			if (isset($_GET['Page']) && ($_GET['Page'] == 'Logout')) {
				unset($_SESSION['admin_logged']);
				header('Location: '.Link::ToAdmin());
				exit();
			}
	
			// If page not explicitly set, assume the departments page
			$admin_page = isset($_GET['Page']) ? $_GET['Page'] : 'Departments';
			
			// Choose what admin page to load...
			if ($admin_page == 'Departments') { 
				$this->mContentsCell = 'admin_departments_tpl.php';
			}
			elseif ($admin_page == 'Categories') { 
				$this->mContentsCell = 'admin_categories_tpl.php';
			}
			elseif ($admin_page == 'Attributes') {
				 $this->mContentsCell = 'admin_attributes_tpl.php';
			}
			elseif ($admin_page == 'AttributeValues') {
				 $this->mContentsCell = 'admin_attribute_values_tpl.php';
			}
			elseif ($admin_page === 'Products') {
				 $this->mContentsCell = 'admin_products_tpl.php';
			}
			elseif ($admin_page === 'ProductDetails') {
				 $this->mContentsCell = 'admin_product_details_tpl.php';
			}
			elseif ($admin_page === 'Carts') {
				$this->mContentsCell = 'admin_carts_tpl.php';	
			}
			elseif ($admin_page === 'Orders') {
				$this->mContentsCell = 'admin_orders_tpl.php';	
			}
			elseif ($admin_page === 'OrderDetails') {
				$this->mContentsCell = 'admin_order_details_tpl.php';	
			}
	    }
	}
    }
?>