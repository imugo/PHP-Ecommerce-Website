<?php
    include PRESENTATION_DIR.'customer_login.php';
    $obj = new CustomerLogin();

    echo '
    
	<div class="admin_form_container">
        <form action="'.$obj->mLinkToLogin.'" method="post">
            <h4 class="text-center">Enter Login Information</h4>
	    <br>
	    <p><i class="fa fa-user"></i>Welcome!</p>';

	    if ($obj->mErrorMessage != '')
		echo '
		<div class="alert alert-danger alert-dismissible fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p>'.$obj->mErrorMessage.'</p>
		</div>';

            echo '
            <div>
                <input type="text" name="email" value="'.$obj->mEmail.'" placeholder="Email" class="admin_login"><span style="color:red;">*</span>
				<p class="remember-me"><input type="checkbox" name="rememberMe"> Remember my email address</p>      
			</div>
	   		<div>
                <input type="password" name="password" placeholder="Password" class="admin_login"><span style="color:red;">*</span>
           </div>
           <input type="submit" name="Login" value="Login" class="primary-button">
		   <p>Don\'t have an account yet? <a href="'.$obj->mLinkToRegisterCustomer.'" class="secondary-button">Register here</a></p> 
        </form>
    </div>';
?>