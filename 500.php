<?php
// Set the 500 status code
header('HTTP/1.0 500 Internal Server Error');
require_once 'include/config.php';
require_once PRESENTATION_DIR . 'link.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>
Shirtswithstamps Application Error (500): Demo Product
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
        <h1>500 - SERVER ERROR OCCURRED</h1>
        <h3>
           Shirtswithstamps is experiencing technical difficulties.
        </h3>
         <p>
             Please <a href="<?php echo Link::Build(''); ?>">visit us</a> soon, or <a href="<?php echo ADMIN_ERROR_MAIL; ?>">contact us</a>.
</p>
         <p>Thank you!</p>
         <p>The Shirtswithstamps team.</p>
</div>
</div>
</body>
</html>