<?php
// Set the 500 status code
header('HTTP/1.0 404 NOT FOUND');
require_once 'include/config.php';
require_once PRESENTATION_DIR . 'link.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>
Shirtswithstamps PAGE NOT FOUND (404): Demo Product
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
    <link href="<?php echo Link::Build('styles/bootstrap-3.3.7-dist/css/bootstrap.min.css')?>" rel="stylesheet">
    
	<!-- Custom CSS -->
    <link href="<?php echo Link::Build('styles/shirtswithstamps.css')?>" rel="stylesheet">

<!-- jQuery  -->
<script src="<?php echo Link::Build('styles/jQuery/jquery-3.1.1.min.js')?>"></script>


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo Link::Build('styles/bootstrap-3.3.7-dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-sm-12 text-center">
         <h1>The Page you have requested does not exist on Shirtswithstamps Shop</h1>
         <p>Please visit the <a href="<?php echo Link::Build(''); ?>">Shirtswithstamps catalog</a> if you're looking for T-shirts, or <a href="<?php echo ADMIN_ERROR_MAIL; ?>">email us</a> if you need further assistance.
</p>
         <p>Thank you!</p>
         <p>The Shirtswithstamps team.</p>
    </div>
</div> 
</div>   
</body>
</html>