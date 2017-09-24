<?php
	class ProductsList {
		// Public variables to be read from templates
		public $mPage = 1;
		public $mrTotalPages;
		public $mLinkToNextPage;
		public $mLinkToPreviousPage;
		public $mProducts;
		public $mProductListPages = array();
		public $mSearchDescription;
		public $mSearchString;
		public $mAllWords = 'off';
		
		// Private members
		private $_mDepartmentId;
		private $_mCategoryId;
		
		public function __construct() {
			// Retrieve the search string and all words from the query string
			if (isset($_GET['SearchResults'])) {
				$this->mSearchString = trim(str_replace('-', ' ', $_GET['SearchString']));
				$this->mAllWords = isset($_GET['AllWords']) ? $_GET['AllWords'] : 'off';	
			}
			
			// Get department from query string
			if (isset($_GET['DepartmentId'])) 
				$this->_mDepartmentId = (int)$_GET['DepartmentId']; 
			
			// Get Category id from query string	
			if (isset($_GET['CategoryId']))
				$this->_mCategoryId = (int)$_GET['CategoryId'];
				
			// Get page number from query string
			if (isset($_GET['Page']))
				$this->mPage = (int)$_GET['Page'];
				
			if ($this->mPage < 1)
				trigger_error('incorrect page value');
				
			// Save request for continue shopping functionality
			$_SESSION['link_to_continue_shopping'] = $_SERVER['QUERY_STRING'];	
		}
		
		public function init() {
			// If searching the catalog, get the list of products by calling the Search Business tier method
			if (isset($this->mSearchString)) {
				// Get Search results
				$search_results = Catalog::Search($this->mSearchString, $this->mAllWords, $this->mPage, $this->mrTotalPages);
				
				// Get the list of products
				$this->mProducts = $search_results['products'];
				
				// Build the titles for the list of products
				if (count($search_results['accepted_words']) > 0)
				$this->mSearchDescription = '<p class="text-center">Products containing <span class="lead">'.($this->mAllWords == 'on' ? 'all' : 'any').'</span> of these words: <span class="lead">'.implode(', ', $search_results['accepted_words']).'</span></p>';
				if (count($search_results['ignored_words']) > 0)
					$this->mSearchDescription .= '<p>Ignored words: <span class="lead">'.implode(', ', $search_results['ignored_words']).'</span></p>';	
					
				if (!(count($search_results['products'])) > 0)
					$this->mSearchDescription .= '<p class="lead text-center">Your search generated no results.</p>';
			}
			
			// If browsing a category get the list of products by calling the GetProductsInCategory() Business tier method
			elseif (isset($this->_mCategoryId)) {
				$this->mProducts = Catalog::GetProductsInCategory($this->_mCategoryId, $this->mPage, $this->mrTotalPages);
			} 
			
			// If browsing a department	get the list of products by calling the GetProductsOnDepartment() Business tier method
			elseif (isset($this->_mDepartmentId)){
				$this->mProducts = Catalog::GetProductsOnDepartment($this->_mDepartmentId, $this->mPage, $this->mrTotalPages);
			}
			
			// If browsing the fist page get the list of products by calling the GetProductsOnCatalog() Business tier method	
			else {
				$this->mProducts = Catalog::GetProductsOnCatalog($this->mPage, $this->mrTotalPages);
			}
				
			// If there are subpages of products display navigation controls
			if ($this->mrTotalPages > 1) {
				// Build the Next link
				if ($this->mPage < $this->mrTotalPages) {
					if (isset($_GET['SearchResults']))
						$this->mLinkToNextPage = Link::ToSearchResults($this->mSearchString, $this->mAllWords, $this->mPage+1);
					elseif (isset($this->_mCategoryId))
						$this->mLinkToNextPage = Link::ToCategory($this->_mDepartmentId, $this->_mCategoryId, $this->mPage+1);
					elseif(isset($this->_mDepartmentId))
						$this->mLinkToNextPage = Link::ToDepartment($this->_mDepartmentId, $this->mPage+1);
					else
						$this->mLinkToNextPage = Link::ToIndex($this->mPage+1);
				}
				// Build the previous link
				if ($this->mPage > 1) {
					if (isset($_GET['SearchResults']))
						$this->mLinkToPreviousPage = Link::ToSearchResults($this->mSearchString, $this->mAllWords, $this->mPage-1);
					if (isset($this->_mCategoryId))
						$this->mLinkToPreviousPage = Link::ToCategory($this->_mDepartmentId, $this->_mCategoryId, $this->mPage-1);
					elseif(isset($this->_mDepartmentId))
						$this->mLinkToPreviousPage = Link::ToDepartment($this->_mDepartmentId, $this->mPage-1);
					else
						$this->mLinkToPreviousPage = Link::ToIndex($this->mPage-1);	
				}
			}
			
			// Build the pages links
			for ($i=1; $i<=$this->mrTotalPages; $i++) {
				if (isset($_GET['SearchResults']))
					$this->mProductListPages[] = Link::ToSearchResults($this->mSearchString, $this->mAllWords, $i);
				elseif (isset($this->_mCategoryId))
					$this->mProductListPages[] = Link::ToCategory($this->_mDepartmentId, $this->_mCategoryId, $i);
					
				elseif (isset($this->_mDepartmentId))
					$this->mProductListPages[] = Link::ToDepartment($this->_mDepartmentId, $i);	
					
				else
					if ($this->mrTotalPages > 1)
						$this->mProductListPages[] = Link::ToIndex($i);	
			}
			
			// 404 redirect if the page number is greater than the total number of pages
			if ($this->mPage > $this->mrTotalPages && !empty($this->mrTotalPages)) {
				ob_clean();
				
				// Load 404 page
				include '404.php';
				
				flush();
				ob_flush();
				ob_end_clean();	
			}
			
			// Build the links for the product details page
			for ($i=0; $i<count($this->mProducts); $i++) {
				$this->mProducts[$i]['link_to_product'] = Link::ToProduct($this->mProducts[$i]['product_id']);
				
				if ($this->mProducts[$i]['image'])
					$this->mProducts[$i]['image'] = Link::Build('product_images/'.$this->mProducts[$i]['image']);	
			}
		}
	}
?>