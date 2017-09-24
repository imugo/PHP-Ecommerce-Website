<?php
// Deals with retrieving department details
class Department {
	// Public variables for the template
	public $mName;
	public $mDescription;
	public $mEditActionTarget;
	public $mEditAction;
	public $mEditButtonAction;
	public $mShowEditButton;
	
	// Private members
	private $_mDepartmentId;
	private $_mCategoryId;
	
	// Class function to recieve id from query string
	public function __construct() {
		if (isset($_GET['DepartmentId'])) {
		    $this->_mDepartmentId = (int)$_GET['DepartmentId'];	
		}else {
			trigger_error('Department Id not set');	
		}
		
		if (isset($_GET['CategoryId'])) {
		    $this->_mCategoryId = (int)$_GET['CategoryId'];	
		}
		
		if (!(isset ($_SESSION['admin_logged'])) || $_SESSION['admin_logged'] != true) {
			$this->mShowEditButton = false;
		}
		else {
			$this->mShowEditButton = true;
		}
	}
	
	public function init() {
		// If visiting a department
		$department_details = Catalog::GetDepartmentDetails($this->_mDepartmentId);
		
		$this->mName = $department_details['name'];
		$this->mDescription = $department_details['description'];
		
		// If visiting a category...
		if (isset($this->_mCategoryId)) {
			$category_details =	Catalog::GetCategoryDetails($this->_mCategoryId);
		
			$this->mName = $this->mName.' &raquo; '.$category_details['name'];
			$this->mDescription = $category_details['description'];
			
			$this->mEditActionTarget = Link::ToDepartmentCategoriesAdmin($this->_mDepartmentId);
			$this->mEditAction = 'edit_cat_'.$this->_mCategoryId;
			$this->mEditButtonCaption = 'Edit Category details';
		}
		else {
			$this->mEditActionTarget = Link::ToDepartmentsAdmin();
			$this->mEditAction = 'edit_dept_'.$this->_mDepartmentId;
			$this->mEditButtonCaption = 'Edit Department details';
		}
	}
}
?>