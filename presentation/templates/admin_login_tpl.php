<?php
    include PRESENTATION_DIR.'admin_login.php';
    $obj = new AdminLogin();

    echo '
    
	<div class="admin_form_container">
        <form action="'.$obj->mLinkToAdmin.'" method="post">
            <h4 class="text-center">Enter Login Information</h4>
	    <br>
	    <p><i class="fa fa-home"></i><a href="'.$obj->mLinkToIndex.'">Store Front</a> | <i class="fa fa-user"></i>Welcome, Admin!</p>';

	    if ($obj->mLoginMessage != '')
		echo '
		<div class="alert alert-danger alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p>'.$obj->mLoginMessage.'</p>
		</div>';

            echo '
            <div>
                <input type="text" name="username" placeholder="Username" class="admin_login">
           </div>
	   <div>
                <input type="password" name="password" placeholder="Password" class="admin_login">
           </div>
           <input type="submit" name="submit" value="Login" class="primary-button"> 
        </form>
    </div>';
?>