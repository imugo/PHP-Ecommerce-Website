<?php
	// Class that deals with public administration from a specific category
	class AdminProducts {
		// Public variables available in template
		public $mProductsCount;
		public $mProducts;
		public $mErrorMessage;
		public $mDepartmentId;
		public $mCategoryId;
		public $mCategoryName;
		public $mLinkToDepartmentCategoriesAdmin;
		public $mLinkToCategoryProductsAdmin;
		public $mLinkToProductAdmin;
		
		private $_mAction;
		private $_mActionedProductId;
		
		public function __construct() {
			if (isset($_GET['DepartmentId'])) {
				$this->mDepartmentId = (int)$_GET['DepartmentId'];
			} else {
				trigger_error('DepartmentId not set');
			}
			
			if (isset($_GET['CategoryId'])) {
				$this->mCategoryId = (int)$_GET['CategoryId'];
			} else {
				trigger_error('CategoryId not set');
			}
			
			$category_details = Catalog::GetCategoryDetails($this->mCategoryId);
			$this->mCategoryName = $category_details['name'];
			
			foreach ($_POST as $key=>$value) {
				// if a submit button is clicked
				if (substr($key, 0, 6) === 'submit') {
					// Get the position of the last underscore
					$last_underscore = strrpos($key, '_');
					
					// Get the scope of rhe button e.g: edit_prod
					$this->_mAction = substr($key, strlen('submit_'), $last_underscore - strlen('submit_'));
					
					// Get the product id targeted by the submit button
					$this->_mActionedProductId = (int)substr($key, $last_underscore + 1); 
					
					break;
				}
			}
			
			$this->mLinkToDepartmentCategoriesAdmin = Link::ToDepartmentCategoriesAdmin($this->mDepartmentId);
			$this->mLinkToCategoryProductsAdmin = Link::ToCategoryProductsAdmin($this->mDepartmentId, $this->mCategoryId);
		}
			
		public function init() {
			// If adding a new product
			if ($this->_mAction === 'add_prod') {
				$product_name = $_POST['product_name'];
				$product_description = $_POST['product_description'];
				$product_price = $_POST['product_price'];
				
				if ($product_name === null) {
					$this->mErrorMessage = 'Product name is empty';
				}
				if ($product_description === null) {
					$this->mErrorMessage = 'Product description is empty';
				}
				if ($product_price === null || !is_numeric($product_price)) {
					$this->mErrorMessage = 'Product price must be a number';
				}
				
				if ($this->mErrorMessage === null) {
					Catalog::AddProductToCategory($this->mCategoryId, $product_name, $product_description, $product_price);
					
					header('Location: '.htmlspecialchars_decode($this->mLinkToCategoryProductsAdmin));
				}
			}
			
			// If we want to see the product details
			if ($this->_mAction === 'edit_prod') {
				header('Location: '.htmlspecialchars_decode(Link::ToProductAdmin($this->mDepartmentId, $this->mCategoryId, $this->_mActionedProductId)));
				
				exit();
			}		
			
			$this->mProducts = Catalog::GetCategoryProducts($this->mCategoryId);
			$this->mProductsCount = count($this->mProducts);
		}
	}
?>