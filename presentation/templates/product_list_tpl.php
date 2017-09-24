<?php
include PRESENTATION_DIR.'products_list.php';
$obj = new ProductsList();
$obj->init();

// Search description
echo '<div class="container">';
if ($obj->mSearchDescription != '');
	echo '<p>'.$obj->mSearchDescription.'</p>';
echo '</div>';

// Begin product lists
echo '<div class="flexrows">';
if ($obj->mProducts) {
	for ($k=0; $k<count($obj->mProducts); $k++) {
		
		echo '<div class="flexcols">';
		
		if ($obj->mProducts[$k]['image'] != '') {
			echo '<a href="'.$obj->mProducts[$k]['link_to_product'].'">
					<img class="lazy img-rounded img-responsive" data-original="'.$obj->mProducts[$k]['image'].'" alt="'.$obj->mProducts[$k]['name'].'"> 
				</a><hr>';
		}
		echo '<h4><a href="'.$obj->mProducts[$k]['link_to_product'].'" class="primary-button" style="box-shadow: 0px 2px 5px lightgrey">'.$obj->mProducts[$k]['name'].'</a></h4>';
		if ($obj->mProducts[$k]['discounted_price'] != 0) {
			echo '<span class="price">'.$obj->mProducts[$k]['discounted_price'].' N</span>';	
		}else {
			echo '<span class="price">'.$obj->mProducts[$k]['price'].' N</span>';
		}
		
		echo '</div>';
		
					
	}
}
echo '</div></div>';
echo '<br>'; 

// Build links to pages
if (count($obj->mProductListPages) > 0) {
		echo '<div class="text-center">
				<div class="pagination">';
		if ($obj->mLinkToPreviousPage) 
			echo '<a href="'.$obj->mLinkToPreviousPage.'">&laquo;</a>';
		else
			echo '<span>&laquo;</span>';
			
		for ($m=0; $m<count($obj->mProductListPages); $m++) {
			if ($obj->mPage === $m+1)
				echo '<a href="#" class="active">'.($m+1).'</a>';
			else
				echo '<a href="'.$obj->mProductListPages[$m].'">'.($m+1);	
		}
		
		if ($obj->mLinkToNextPage)
			echo '<a href="'.$obj->mLinkToNextPage.'">&raquo;</a>';
		else
			echo '<span>&raquo;</span>';
		echo '</div>';
}
else {
	echo '';	
}
?>