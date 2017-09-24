<?php
include PRESENTATION_DIR.'categories_list.php';
$obj = new CategoriesList();
$obj->init();

echo '<div class="container">
	<br>
	<div class=""><span>Categories: </span>';
	
		for ($i=0; $i<count($obj->mCategories); $i++) {
			$selected = '';
			if ($obj->mSelectedCategory == $obj->mCategories[$i]['category_id'])
				$selected = 'active';
			echo '
					<a class="primary-button" href="'.$obj->mCategories[$i]['link_to_category'].'" style="text-transform:uppercase;"><b>'.$obj->mCategories[$i]['name'].'</b></a>';
		}
	echo '</div></div>';
?>