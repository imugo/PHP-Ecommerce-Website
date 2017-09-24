<?php
// Manages the Categories List
class CategoriesList {
	// Public variables for the template
	public $mSelectedDepartment= 0;
	public $mSelectedCategory= 0;
	public $mCategories;
	public $mLinkToIndex;
	
	// Constructor reads query string parameters
	public function __construct() {
		if (!isset($_GET['ProductId'])) {
		
		if (isset($_GET['DepartmentId']))
			$this->mSelectedDepartment = (int)$_GET['DepartmentId'];
		else
			trigger_error('Department Id not set');
			
		if (isset($_GET['CategoryId']))
			$this->mSelectedCategory = (int)$_GET['CategoryId'];
		}
		else {
			$continue_shopping = Link::QueryStringToArray($_SESSION['link_to_continue_shopping']);
			
			if (array_key_exists('DepartmentId', $continue_shopping)) 
				$this->mSelectedDepartment = (int)$continue_shopping['DepartmentId'];
			else
				trigger_error('Department Id not set');
				
			if (array_key_exists('CategoryId', $continue_shopping)) 
				$this->mSelectedCategory = (int)$continue_shopping['CategoryId'];
		}
		$this->mLinkToIndex = Link::ToIndex();
	}
	
	public function init() {
		$this->mCategories = Catalog::GetCategoriesInDepartment($this->mSelectedDepartment);
		
		// Building the links for the category pages
		for ($i=0; $i<count($this->mCategories); $i++) {
			$this->mCategories[$i]['link_to_category'] = Link::ToCategory($this->mSelectedDepartment, 
															$this->mCategories[$i]['category_id']); 	
		}
	}
}
?>