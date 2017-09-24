<?php
class StoreFront {
	public $mSiteUrl;
	
	// Define the template cell for the page contents
	public $mContentsCell = 'first_page_contents_tpl.php';
	
	// Define the template cell for the Categories Cell
	public $mCategoriesCell = 'blank.php';
	
	// Page title
	public $mPageTitle;
	
	//define the pemplate file for the cart summary cell
	public $mCartSummaryCell = 'blank.php';

	//PayPal Continue shopping link
	public $mPayPalContinueShoppingLink;

	// Link to admin
	public $mLinkToAdmin;
	
	
	
	
	// Class construct 
	public function __construct() {
		$this->mLinkToAdmin = Link::ToAdmin();
		$this->mSiteUrl = Link::Build('');
		
	}
	
	
	// Initialise presentation object
	public function init() {
		$_SESSION['link_to_store_front'] = Link::Build(str_replace(VIRTUAL_LOCATION, '', getenv('REQUEST_URI')));
		
		// Build the continue shopping link
		if (!isset($_GET['CartAction'])) {
			$_SESSION['link_to_last_loaded_page'] = $_SESSION['link_to_store_front'];
		}
		
		// Load department details if visiting a department
		if (isset($_GET['DepartmentId'])) {
			$this->mContentsCell = 'department_tpl.php';
			$this->mCategoriesCell = 'categories_list_tpl.php';	
		}
		
		// Load product details page if visiting a product
		if (isset($_GET['ProductId'])) {
			$this->mContentsCell = 'product_tpl.php';	
			$this->mCategoriesCell = 'blank.php';	
		}
		elseif (isset($_GET['SearchResults'])) {
			$this->mContentsCell = 'search_results_tpl.php';
		}
		
		// Load shopping cart or cart summary template
		
		if (isset($_GET['CartAction'])) {
			$this->mContentsCell = 'cart_details_tpl.php';
		}
		else {
			$this->mCartSummaryCell = 'cart_summary_tpl.php';	
		}
		
		// Load page title
		$this->mPageTitle = $this->_GetPageTitle();
	}
	
	// Returns the page title
	public function _GetPageTitle() {
		$page_title = 'Shirtswithstamps: T-Shirts with stamps for every ocassion';
		
		if (isset($_GET['DepartmentId']) && isset($_GET['CategoryId'])) {
			$page_title = Catalog::GetDepartmentName($_GET['DepartmentId']).' &raquo; '.Catalog::GetCategoryName($_GET['CategoryId']).' - Shirts With Stamps';
			
		if (isset($_GET['Page']) && ((int)$_GET['Page']) > 1)
			$page_title = Catalog::GetDepartmentName($_GET['DepartmentId']).' &raquo; '.Catalog::GetCategoryName($_GET['CategoryId']).' - Page '.((int)$_GET['Page']).' - Shirtswithstamps';	
		}
		
		elseif (isset($_GET['DepartmentId'])) {
			$page_title = Catalog::GetDepartmentName($_GET['DepartmentId']).' - Shirts With Stamps';
			
			if (isset($_GET['Page']) && ((int)$_GET['Page']) > 1)
				$page_title = Catalog::GetDepartmentName($_GET['DepartmentId']).' - Page '.((int)$_GET['Page']).' - Shirts With Stamps';
		}
		
		elseif (isset($_GET['ProductId'])) {
			$page_title = Catalog::GetProductName($_GET['ProductId']).' - Shirts With Stamps';
		}
		
		elseif (isset($_GET['SearchResults'])) {
			$page_title = '';
			
			// Display the search string
			$page_title = trim(str_replace('-', ' ', $_GET['SearchString'])).' (';
			
			// Display 'all-words' search or 'any-words' search
			$all_words = isset($_GET['AllWords']) ? $_GET['AllWords'] : 'off';
			
			$page_title .= (($all_words == 'on') ? 'all' : 'any').'-words search';
			
			// Display the page number
			if (isset($_GET['Page']) && ((int)$_GET['Page'] < 1))
				$page_title .= ', page '.((int)$_GET['Page']);
				
			$page_title .= ')';
		}
		
		else {
			if (isset($_GET['Page']) && ((int)$_GET['Page']) > 1)
				$page_title .= ' - Page '.((int)$_GET['Page']);
		}
		
		return $page_title;
	}
}
?>