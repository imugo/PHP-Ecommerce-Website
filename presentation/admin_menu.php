<?php
    class AdminMenu {
		public $mLinkToStoreAdmin;
		public $mLinkToStoreFront;
		public $mLinkToCartsAdmin;
		public $mLinkToOrdersAdmin;
		public $mLinkToAttributesAdmin;
		public $mLinkToLogout;
	
		public function __construct() {
			$this->mLinkToStoreAdmin = Link::ToAdmin();
			$this->mLinkToAttributesAdmin = Link::ToAttributesAdmin();
			
			$this->mLinkToOrdersAdmin = Link::ToOrdersAdmin();
			
			if (isset($_SESSION['link_to_store_front'])) {
				$this->mLinkToStoreFront = $_SESSION['link_to_store_front'];
			}
			else {
				$this->mLinkToStoreFront = Link::ToIndex();
			}
	
			$this->mLinkToCartsAdmin = Link::ToCartsadmin();
			$this->mLinkToLogout = Link::ToLogout();
			
			
		}
    }
?>