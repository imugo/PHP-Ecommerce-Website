<?php
    // Class that supports admin departments functionality
    class AdminDepartments {
	// Public variables available in template
	public $mDepartmentsCount;
	public $mDepartments;
	public $mErrorMessage;
	public $mEditItem;
	public $mLinkToDepartmentsAdmin;

	// Private members
	private $_mAction;
	private $_mActionedDepartmentId;

	// Class Constructor
	public function __construct() {
	    // Parse the list with posted variables
	    foreach($_POST as $key=>$value) {
		// If a submit button is clicked
		if (substr($key, 0, 6) == 'submit') {
		    // Get the position of the last underscore in submit
		    $last_underscore = strrpos($key, '_');
		    
		    // Get the scope of the submit button (eg edit_dept)
		    $this->_mAction = substr($key, strlen('submit_'), $last_underscore - strlen('submit_'));

		    // Get the department id targeted by submit button (eg submit_edit_dept_'1')
		    $this->_mActionedDepartmentId = substr($key, $last_underscore + 1);

		    break;
		}
	    }
	    $this->mLinkToDepartmentsAdmin = Link::ToDepartmentsAdmin();
	}

	public function init() {
	    // If adding a new department
	    if ($this->_mAction == 'add_dept') {
		$department_name = $_POST['department_name'];
		$department_description = $_POST['department_description'];

		if (empty($department_name))
		    $this->mErrorMessage = 'Department name required';

		if (empty($this->mErrorMessage)) {
		    Catalog::AddDepartment($department_name, $department_description);
		    header('Location: '.$this->mLinkToDepartmentsAdmin);
		}
	    }
	
	    // If editing an existing department
	    if ($this->_mAction == 'edit_dept')
		$this->mEditItem = $this->_mActionedDepartmentId;

	    // If updating a department...
	    if ($this->_mAction == 'update_dept') {
		$department_name = $_POST['name'];
		$department_description = $_POST['description'];

		if (empty($department_name))
		    $this->mErrorMessage = 'Department name required';

		if (empty($this->mErrorMessage)) {
		    Catalog::UpdateDepartment($this->_mActionedDepartmentId, $department_name, $department_description);
		    header('Location: '.$this->mLinkToDepartmentsAdmin);
		}
	    }

	    // If deleting a department...
	    if ($this->_mAction == 'delete_dept') {
		$status = Catalog::DeleteDepartment($this->_mActionedDepartmentId);

		if ($status < 0)
		    $this->mErrorMessage = 'Department not empty';
	 	else
		    header('Location: '.$this->mLinkToDepartmentsAdmin);
	    }

	    if ($this->_mAction == 'edit_cat') {
		header('Location: '.htmlspecialchars_decode(Link::ToDepartmentCategoriesAdmin($this->_mActionedDepartmentId)));
		exit();
	    }
	
	    // Load the list of departments
	    $this->mDepartments = Catalog::GetDepartmentsWithDescriptions();
	    $this->mDepartmentsCount = count($this->mDepartments);
	}
    }
?>