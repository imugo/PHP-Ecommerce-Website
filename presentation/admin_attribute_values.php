<?php
    class AdminAttributeValues {
	public $mAttributeValuesCount;
	public $mAttributeValues;
	public $mErrorMessage;
	public $mEditItem;
	public $mAttributeId;
	public $mAttributeName;
	public $mLinkToAttributesAdmin;
	public $mLinkToAttributeValuesAdmin;

	private $_mAction;
	private $_mActionedAttributeValueId;

	public function __construct() {
	    if (isset($_GET['AttributeId'])) {
		$this->mAttributeId = (int)$_GET['AttributeId'];
	    } else {
		trigger_error('AttributeId not set');
	    }
	    
	    $attribute_details = Catalog::GetAttributeDetails($this->mAttributeId);
	    $this->mAttributeName = $attribute_details['name'];

	    // Parse the list with posted variables
	    foreach ($_POST as $key=>$value) {
		// If a submit button was clicked
		if (substr($key, 0, 6) == 'submit') {
		    // Get the position of the last underscore '_'
		    $last_underscore = strrpos($key, '_');

		    // Get the scope of the submit button
		    $this->_mAction = substr($key, strlen('submit_'), $last_underscore - strlen('submit_'));

		    // Get the targeted attribute id
		    $this->_mActionedAttributeValueId = (int)substr($key, $last_underscore+1);

		    break;
		}
	    }
	
	    $this->mLinkToAttributesAdmin = Link::ToAttributesAdmin();

	    $this->mLinkAttributeValuesAdmin = Link::ToAttributeValuesAdmin($this->mAttributeId);
	}

	public function init() {
	    // If adding a new attribute
	    if ($this->_mAction == 'add_val') {
		$attribute_value = $_POST['attribute_value'];

		if ($attribute_value == null)
		    $this->mErrorMessage = 'Attribute value required';

		if ($this->mErrorMessage == null) {
		    Catalog::AddAttributeValue($this->mAttributeId, $attribute_value);

		    header('Location: '.htmlspecialchars_decode($this->mLinkToAttributeValuesAdmin));
		}
	    }

	    // If editing an existing an existing attribute...
	    if ($this->_mAction == 'edit_val')
		$this->mEditItem = $this->_mActionedAttributeValueId;

	    // If updating an attribute value...
	    if ($this->_mAction == 'update_val') {
		$attribute_value = $_POST['value'];

		if ($attribute_value == null) {
		    $this->mErrorMessage = json_encode(array('You need to input a Value!','Please, try again'));
		}

		if ($this->mErrorMessage == null) {
		    Catalog::UpdateAttribute($this->_mActionedAttributeValueId, $attribute_value);

		    header('Location: '.htmlspecialchars_decode($this->mLinkToAttributeValuesAdmin));
		}
	    }

	    // If deleting an attribute ...
	    if ($this->_mAction == 'delete_val') {
		$status = Catalog::DeleteAttributeValue($this->_mActionedAttributeValueId);

		if ($status < 0)
		    $this->mErrorMessage = 'Cannot delete this value, One or more values are using it';
		else
		    header('Location: '.htmlspecialchars_decode($this->mLinkToAttributeValuesAdmin));
	    }

	    // Load the list of attributes
	    $this->mAttributeValues = Catalog::GetAttributeValues($this->mAttributeId);
	    $this->mAttributeValuesCount = count($this->mAttributeValues);
	}
    }
    
?>