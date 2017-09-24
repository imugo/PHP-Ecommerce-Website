<?php
	class CustomerLogin {
		public $mErrorMessage;
		public $mLinkToLogin;
		public $mLinkToRegisterCustomer;
		public $mEmail = '';
		
		public function __construct() {
			$this->mLinkToLogin = Link::Build(str_replace(VIRTUAL_LOCATION, '', getenv('REQUEST_URI')));
			
			$this->mLinkToRegisterCustomer = Link::ToRegisterCustomer();	
		}
		
		public function init() {
			// Decide if we have submitted
			if (isset($_POST['Login'])) {
				// Get Login status
				$login_status = Customer::IsValid($_POST['email'], $_POST['password']);
				
				switch ($login_status) {
					case 2:
						echo 'Unrecognised email';
						break;
					case 1:
						echo 'Unrecognised password';
						break;
					case 0:
						$redirect_to_link = Link::Build(str_replace(VIRTUAL_LOCATION, '', getenv('REQUEST_URI')));
						header('Location: '.$redirect_to_link);
						exit();
				}
			}
		}
	}
?>