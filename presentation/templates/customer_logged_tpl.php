<?php
	include PRESENTATION_DIR.'customer_logged.php';
	$obj = new CustomerLogged();
	$obj->init();
	
	echo '
	<h4 class="text-center">Welcome, '.$obj->mCustomerName.'</h4>
	
	<p><a href="'.$obj->mLinkToAccountDetails.'">Change Account</a></p>
	<p><a href="'.$obj->mLinkToAddressDetails.'">Change Address</a></p>
	<p><a href="'.$obj->mLinkToLogout.'">Logout</a></p>';
?>