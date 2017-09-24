<?php
include PRESENTATION_DIR.'store_front.php';
$stobj = new StoreFront();
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
	
    
    <title><?php echo $stobj->mPageTitle; ?></title>
    
    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/shirtswithstamps.css">
    
    <!-- Shirts with stamps icon -->
    <link rel="shortcut icon" href="<?php echo $stobj->mSiteUrl; ?>product_images/T-SHIRTS.png">
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $stobj->mSiteUrl; ?>styles/font-awesome-4.7.0/css/font-awesome.min.css">
    
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
	<!-- BTN GROUP -->
    <div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
                <div class="btn-group btn-group-justified btn-group-lg">
                    <a href="#" class="btn btn-default">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a href="#" class="btn btn-default">NAIRA</a>
                    <?php include $stobj->mCartSummaryCell; ?>
                </div>
        	</div>
        </div>
    </div>
    <br><br>
    <!-- END BTN GROUP -->    
        <!-- navbar -->
        <!--<nav class="navbar navbar-custom">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<a href="#" data-toggle="modal" data-target="#mySearchModal" class="search-button"><i class="fa fa-search"></i></a>
            
            
            <!-- Nav Collapse functionality -->
            <!--<div class="collapse navbar-collapse" id="myNavbar">
       			<ul class="navbar-nav nav">
                	<li><a href="<?php //echo $stobj->mSiteUrl; ?>">HOME</a></li>
					           			
				</ul>
            <ul class="navbar-right nav navbar-nav">
                <li>
                	<a href="#" data-toggle="modal" data-target="#mySearchModal" class="search-button-desktop"><i class="fa fa-search"></i></a>
                </li>
        	</ul>
            <hr>
            <a href="<?php //echo $stobj->mSiteUrl; ?>" style="float:right;">
            	<img src="<?php //echo $stobj->mSiteUrl; ?>product_images/STAMPSHIRTS.png" width="160" height="106" alt="logo" id="logo">
            </a>-->
             <!-- End Nav collapse functionality -->
			<!--</div>
		</nav>
        </div>-->
        <!-- End Navbar -->
        <br>
        <div class="container">
        <div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            	<?php include 'search_box_tpl.php'; ?>
            </div>
        </div>
        </div>

            <!-- Logo -->
    	<div class="row">
        	<div class="col-lg-12 col-sm-12 col-md-12">
            	<a href="<?php echo $stobj->mSiteUrl; ?>">
            		<img class="img-responsive" style="display:block; margin:auto;" src="<?php echo $stobj->mSiteUrl; ?>product_images/T-SHIRTS.png" alt="logo">
                </a>
            </div>
        </div>
	    <!-- End Logo -->
        
        <div class="container">
        <div class="row">
        	<div class="col-lg-12 col-sm-12 col-md-12">
            	<div class="panel-group">
                	<div class="panel panel-custom">
                	<div class="panel-heading">
                    	<h4 class="panel-title">
                        	<a href="#collapse1" data-toggle="collapse">MENU <i class="fa fa-bars" style="float:right"></i></a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="collapse1">
                    	<div class="panel-body">
                        	<ul class="list-group">
                        		<?php include_once 'departments_list_tpl.php'; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
		<?php
			require_once $stobj->mCategoriesCell;
			require_once $stobj->mContentsCell;
		?>
		<!-- Search Button Modal -->
            <div class="modal fade" id="mySearchModal" role="dialog">
            	<div class="modal-dialog">
                	
                    <!-- Modal Content -->
                    <div class="modal-content">
                    	<div class="modal-header">
                        	<button type="button" class="close" data-dismiss="modal">&times;</button>
                        	<h4 class="modal-title">Search our catalog</h4>
                        </div>
                        <div class="modal-body">
                        	
                        </div>
                        <div class="modal-footer">
                        	<button type="button" class="secondary-button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Search Button Modal -->
        
                
        <!-- footer -->
        <br>
        <footer>
        <div class="container">
        <div class="cross-section"></div>
        <div class="row">
                 <div class="col-xs-6">
                	<h3>FOLLOW US</h3>
                    	<a href="#" style="color:black;"><i class="fa fa-facebook"></i></a>
                        <a href="#" style="color:black;"><i class="fa fa-twitter"></i></a>
                        <a href="#" style="color:black;"><i class="fa fa-instagram"></i></a>
                        <a href="#" style="color:black;"><i class="fa fa-google-plus"></i></a>
                    </ul>
                </div>
                <div class="col-xs-6">
                	<a href="<?php echo $stobj->mSiteUrl; ?>">
            		<img class="img-responsive" src="<?php echo $stobj->mSiteUrl; ?>product_images/T-SHIRTS.png" alt="logo">
                </a>
                </div>
                </div>
            </div>
                </footer>
                    
		<p><a href="<?php echo $stobj->mLinkToAdmin ?>">Site Admin</a></p>
      <!-- Ajax -->
    <script src="<?php echo $stobj->mSiteUrl; ?>scripts/ajax.js"></script>  
        <!-- Personal script -->
    <script src="<?php echo $stobj->mSiteUrl; ?>scripts/shirtswithstamps.js" type="text/javascript"></script>
            
	<!-- jQuery -->
    <script src="<?php echo $stobj->mSiteUrl; ?>styles/jQuery/jquery-3.1.1.min.js"></script>
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $stobj->mSiteUrl; ?>styles/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    
    <!-- Lazy Load -->
    <script src="<?php echo $stobj->mSiteUrl; ?>scripts/tuupola-jquery_lazyload-2cfbdb5/jquery.lazyload.min.js"></script>
    
    <!-- OwlCarousel -->
    <script src="<?php echo $stobj->mSiteUrl; ?>styles/OwlCarousel2-2.2.0/dist/owl.carousel.min.js"></script>
    
  
    <script>
			
			 $(function() {
				$("img.lazy").lazyload({
					effect: "fadeIn"
				});
			});
			
			/*var owl = $("#owl-carousel");
			console.log(owl);
			owl.owlCarousel({
				loop:true,
				dots: true,
				items: 1,
				margin: 0,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:false,				
			});
			owl.trigger('play.owl.autoplay');
			$('#owl-carousel').on('mouseleave',function(){
				owl.trigger('play.owl.autoplay',[3000]);
			})
			$('#owl-carousel').on('mouseenter',function(){
				owl.trigger('stop.owl.autoplay');
			});*/
			
			
			var owl2 = $('#product-carousel');
			
			owl2.owlCarousel({
				loop:true,
				dots: true,
				margin: 30,
				items: 3,
				autoplay:true,
				autoplayTimeout:5000,
				autoplayHoverPause:false				
			});
			
			owl2.trigger('play.owl.autoplay');
			$('#product-carousel').on('mouseleave',function(){
				owl2.trigger('play.owl.autoplay',[5000]);
			})
			$('#product-carousel').on('mouseenter',function(){
				owl2.trigger('stop.owl.autoplay');
			});

			
			$('#cart-summary').click(function() {
				$('#cart-dropdown-menu').toggle(); 
			});
			
			
			$(document).click(function(e) {
				e.stopPropagation();
				var container = $('.cart-dropdown');
				// check if the clicked area is dropdown or not
				if (container.has(e.target).length === 0) {
					$('#cart-dropdown-menu').hide();
				}
			});
			

	</script>
</body>
</html>