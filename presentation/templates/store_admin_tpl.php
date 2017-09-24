<?php
include PRESENTATION_DIR.'store_admin.php';
$stobj = new StoreAdmin();
$stobj->init();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="T-shirts with stamps", shrink-to-fit=no>
    <meta name="author" content="Ugo Oguejiofor">
	
    <title>Admin - Shirts With Stamps</title>
    
    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/shirtswithstamps.css">
    
    <!-- Shirts with stamps icon -->
    <link rel="shortcut icon" href="<?php echo $stobj->mSiteUrl; ?>product_images/STAMPSHIRTS.png">
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/font-awesome-4.6.3/css/font-awesome.min.css">
    
    <!-- OwlCarousel CSS-->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/OwlCarousel2-2.2.0/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/OwlCarousel2-2.2.0/dist/assets/owl.theme.default.min.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    
</head>

<body>
    <div class="black-top"></div>

    <div class="container">
	    <!-- Logo -->
    	<div class="row">
        	<div class="col-xs-4 col-sm-3">
            	<a href="<?php echo $stobj->mSiteUrl; ?>">
            		<img src="<?php echo $stobj->mSiteUrl; ?>product_images/STAMPSHIRTS.png" width="160" height="106" alt="logo">
                </a>
            </div>
            <div class="co-xs-8 col-sm-9"></div>
        </div>
	    <!-- End Logo -->
		
		<!-- nav -->
		<?php include $stobj->mMenuCell; ?>

		<!-- Main contents of the body -->
        <div class="row">
			<div class="col-sm-12">
				<?php include $stobj->mContentsCell; ?>
			</div>
        </div>
		<!-- END. Main contents of the body -->
    </div>


    <script src="<?php echo $stobj->mSiteUrl; ?>styles/jQuery/jquery-3.1.1.min.js"></script>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $stobj->mSiteUrl; ?>styles/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

     <!-- Personal script -->
    <script src="<?php echo $stobj->mSiteUrl; ?>scripts/shirtswithstamps.js"></script>
	<script src="<?php echo $stobj->mSiteUrl; ?>scripts/Dome.js"></script>
	
</body>
</html>