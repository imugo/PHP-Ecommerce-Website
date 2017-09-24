<?php
	class FirstPageContents {
		public $mNewProducts;
		
		public function __construct() {
			$this->mNewProducts = Catalog::GetNewProductsOnCatalog();
			for ($i=0; $i<count($this->mNewProducts); $i++) {
				$this->mNewProducts[$i]['link_to_product'] = Link::ToProduct($this->mNewProducts[$i]['product_id']);
				
				if ($this->mNewProducts[$i]['image']) {
					$this->mNewProducts[$i]['image'] = Link::Build('product_images/'.$this->mNewProducts[$i]['image']);
				}
			}
		}
	}
?>