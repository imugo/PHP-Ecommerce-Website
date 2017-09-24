<?php
	include PRESENTATION_DIR.'first_page_contents.php';
	$fobj = new FirstPageContents();
?> 
        <div class="container">
        <!-- featured items section -->
        <div class="relative-image">
                	<img class="lazy img-responsive front_page_image" src="<?php echo $stobj->mSiteUrl; ?>product_images/pexels-photo-437740copy.jpeg" alt="featured-image" />
            <!--<p class="center-text">Beautiful Shirts designed with historic stamps.</p>--> 
        </div><br>
        <div class="cross-section"></div>

        <h3>Featured Items</h3>
       	<?php include_once 'product_list_tpl.php'; ?>
        <div class="container">
        <h3>New Products</h3>
        <?php
			// Begin product lists
			echo '<div class="flexrows">';
			if ($fobj->mNewProducts) {
				for ($k=0; $k<count($fobj->mNewProducts); $k++) {
					
					echo '<div class="flexcols">';
					if ($fobj->mNewProducts[$k]['image'] != '') {
						echo '<a href="'.$fobj->mNewProducts[$k]['link_to_product'].'">
								<img class="lazy img-rounded img-responsive" data-original="'.$fobj->mNewProducts[$k]['image'].'" alt="'.$fobj->mNewProducts[$k]['name'].'"> 
							</a><hr>';
					}
					echo '<h4><a href="'.$fobj->mNewProducts[$k]['link_to_product'].'" class="primary-button">'.$fobj->mNewProducts[$k]['name'].'</a></h4>';
					if ($fobj->mNewProducts[$k]['discounted_price'] != 0) {
						echo '<span class="price">'.$fobj->mNewProducts[$k]['discounted_price'].' N</span>';	
					}else {
						echo '<span class="price">'.$fobj->mNewProducts[$k]['price'].' N</span>';
					}
					
					echo '</div>';
					
								
				}
			}
			echo '</div></div>';
		?>
        <div class="container">
        <h3>Amazing Deals</h3>
        	<p>Get <span class="price">20%</span> off on the purchase of any items belonging to the <strong>flower</strong> category!</p><br>
            <p><a href="index.php?DepartmentId=2&CategoryId=5" class="primary-button">FLOWER Category <i class="fa fa-arrow-right"></i></a></p>
            </div>
