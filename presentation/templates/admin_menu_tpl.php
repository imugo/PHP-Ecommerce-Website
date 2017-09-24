<?php
    include PRESENTATION_DIR.'admin_menu.php';
    $obj = new AdminMenu();

    echo '
		<nav class="navbar navbar-custom">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">';
					/*$selected = '';
					if ($obj->mSelectedDepartment == $obj->mDepartments[$i]['department_id']) {
						$selected = 'class="active"';
					}*/
					echo '
       				<ul class="navbar-nav nav">
						<li><a href="'.$obj->mLinkToStoreAdmin.'">Catalog Admin</a></li>
						<li><a href="'.$obj->mLinkToAttributesAdmin.'">Products Attributes Admin</a></li>
						<li><a href="'.$obj->mLinkToCartsAdmin.'">Carts Admin</a></li>
						<li><a href="'.$obj->mLinkToOrdersAdmin.'">Orders Admin</a></li>
						<li><a href="'.$obj->mLinkToStoreFront.'">Store Front</a></li>
						<li><a href="'.$obj->mLinkToLogout.'">Logout</a></li>          			
				</ul>
				</div>
		</nav>';
?>