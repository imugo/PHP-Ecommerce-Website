<?php
class Link {
	public static function Build($link, $type='http') {
		$base = (($type == 'http' || USE_SSL == 'no') ? 'http://' : 'https://').getenv('SERVER_NAME');
		
		// If HTTP_SERVER_PORT is defined and different than default
		if (defined('HTTP_SERVER_PORT') && HTTP_SERVER_PORT != '80' && strpos($base, 'https') === false) {
			// Append Server Port
			$base .= ':' .HTTP_SERVER_PORT;	
		}
		$link = $base . VIRTUAL_LOCATION . $link;
		
		//ESCAPE HTML
		return htmlspecialchars($link, ENT_QUOTES);
	}
	// Prepares a string to be included in an URL
	public static function CleanUrlText($string) {
		// Removes all characters that aren't a-z, 0-9, dash, underscore or space
		$not_acceptable_characters_regex = '#[^-a-zA-Z0-9_ ]#';
		$string = preg_replace($not_acceptable_characters_regex, '', $string);
		
		// Remove all leading and trailing spaces
		$string = trim($string);
		
		// Change all dashes, underscores and spaces to dashes
		$string = preg_replace('#[-_ ]+#', '-', $string); 
		
		// Return the modified string 
		return strtolower($string);
	}
	
	// Redirects to proper url if not already there
	public static function CheckRequest() {
		$proper_url = '';
		
		if (isset($_GET['Search']) || isset($_GET['SearchResults']) || isset($_GET['AddProduct']) || isset($_GET['CartAction']) || isset ($_GET['AjaxRequest'])) {
			return;
		}
		
		// Obtain proper url for category pages
		elseif (isset($_GET['DepartmentId']) && isset($_GET['CategoryId'])) {
			if (isset($_GET['Page'])) 
				$proper_url = self::ToCategory($_GET['DepartmentId'], $_GET['CategoryId'], $_GET['Page']);
			else
				$proper_url = self::ToCategory($_GET['DepartmentId'], $_GET['CategoryId']);
		}
		
		// Obtain proper url for department pages
		elseif (isset($_GET['DepartmentId'])) {
			if (isset($_GET['Page'])) 
				$proper_url = self::ToDepartment($_GET['DepartmentId'], $_GET['Page']);
			else
				$proper_url = self::ToDepartment($_GET['DepartmentId']);
		}
		
		// Obtain proper url for product pages
		elseif (isset($_GET['ProductId'])) {
			$proper_url = self::ToProduct($_GET['ProductId']);
		}
		
		// Obtain proper url for the homepage
		else { 
			if (isset($_GET['Page'])) 
				$proper_url = self::ToIndex($_GET['Page']);
			else
				$proper_url = self::Build('');
		}
		
		// Remove the virtual location from the requested url so we can compare paths
		$requested_url = self::Build(str_replace(VIRTUAL_LOCATION, '', $_SERVER['REQUEST_URI']));
		
		// 404 redirect if the requested product, category or department doesn't exist
		if (strstr($proper_url, '/-')) {
			ob_clean();
			
			// Load the 404 page
			include '404.php';
			
			flush();
			ob_flush();
			ob_end_clean();
			exit();	
		}
		
		// 301 redirect to proper url if necessary
		if ($requested_url != $proper_url) {
			// Clean output buffer
			ob_clean();
			
			// Redirect 301
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$proper_url);
			
			// Clear the output buffer and stop execution
			flush();
			ob_flush();
			ob_end_clean();
			exit();	
		}
	}
	
	public static function ToDepartment($departmentId, $page=1) {
		$link = self::CleanUrlText(Catalog::GetDepartmentName($departmentId)).'-d'.$departmentId.'/';
		if ($page > 1)
			$link .= 'page-'.$page.'/';
		return self::Build($link);	
	}
	
	public static function ToCategory($departmentId, $categoryId, $page=1) {
		$link =  self::CleanUrlText(Catalog::GetDepartmentName($departmentId)).'-d'.$departmentId.'/'.self::CleanUrlText(Catalog::GetCategoryName($categoryId)).'-c'.$categoryId.'/';
		if ($page > 1)
			$link .= 'page-'.$page.'/';
		return self::Build($link);	
	}
	
	public static function ToIndex($page = 1) {
		$link = 'index.php';
		if ($page>1)
			$link .= 'page-'.$page.'/';
		return self::Build($link);	
	}
	
	public static function ToProduct($productId) {
		$link =  self::CleanUrlText(Catalog::GetProductName($productId)).'-p'.$productId.'/';
		
		return self::Build($link);	
	}
	
	public static function QueryStringToArray($queryString) {
		$result = array();
		
		if ($queryString != '') {
			$elements = explode('&', $queryString);	
			
			foreach ($elements as $key=>$value) {
				$element = explode('=', $value);
				$result[urldecode($element[0])] = isset($element[1]) ? urldecode($element[1]) : '';
					
			}
		}
		return $result;
	}
	
	// Create link to search page
	public static function ToSearch() {
		return self::Build('index.php?Search');	
	}
	
	// Create link to a search result page
	public static function ToSearchResults($searchString, $allWords, $page = 1) {
		$link = 'search-results/find';
		
		if (empty($searchString))
			$link .= '/';
		else
			$link .= '-'.self::CleanUrlText($searchString).'/';
			
		$link .= 'all-words-'.$allWords.'/';
		
		if ($page > 1)
			$link .= 'page-'.$page.'/';
			
		return self::Build($link);	
	}

	// Create an Add to Cart link
	// Create a shopping cart link
	public static function ToCart($action = 0, $target = null) {
		$link = '';
		switch ($action) {
			case ADD_PRODUCT:
				$link = 'index.php?CartAction=' . ADD_PRODUCT . '&ItemId=' . $target;
				break;
			case REMOVE_PRODUCT:
				$link = 'index.php?CartAction=' . REMOVE_PRODUCT . '&ItemId=' . $target;
				break;
			case UPDATE_PRODUCTS_QUANTITIES:
				$link = 'index.php?CartAction=' . UPDATE_PRODUCTS_QUANTITIES . '&ItemId=' . $target;
				break;
			case SAVE_PRODUCT_FOR_LATER:
				$link = 'index.php?CartAction=' . SAVE_PRODUCT_FOR_LATER . '&ItemId=' . $target;
				break;
			case MOVE_PRODUCT_TO_CART:
				$link = 'index.php?CartAction=' . MOVE_PRODUCT_TO_CART . '&ItemId=' . $target;
				break;	
			default:
				$link = 'cart-details/';
		}
		return self::Build($link);
	}

	// Create link to admin page
	public static function ToAdmin($params = '') {
	    $link = 'admin.php';
	   
	    if ($params != '')
		$link .= '?'.$params;

	    return self::Build($link, 'https');
	}

	// Create logout link
	public static function ToLogout() {
	    return self::ToAdmin('Page=Logout');
	}

	// Create link to departments admin
	public static function ToDepartmentsAdmin() {
	    return self::ToAdmin('Page=Departments');
	}

	// Create link to the categories admin
	public static function ToDepartmentCategoriesAdmin($departmentId) {
	    $link = 'Page=Categories&DepartmentId='.$departmentId;
	    return self::ToAdmin($link);
	}

	// Create link to attributes admin
	public static function ToAttributesAdmin() {
	    return self::ToAdmin('Page=Attributes');
	}

	// Create link to attribute values admin
	public static function ToAttributeValuesAdmin($attributeId) {
	    $link = 'Page=AttributeValues&AttributeId='.$attributeId;
	
	    return self::ToAdmin($link);
	}
	
	// Create Link to products admin page
	public static function ToCategoryProductsAdmin($departmentId, $categoryId) {
		$link = 'Page=Products&DepartmentId='.$departmentId.'&CategoryId='.$categoryId;
		
		return self::ToAdmin($link);
	}
	
	// Create Link to product details administration
	public static function ToProductAdmin($departmentId, $categoryId, $productId) {
		$link = 'Page=ProductDetails&DepartmentId='.$departmentId.'&CategoryId='.$categoryId.'&ProductId='.$productId;
		return self::ToAdmin($link);
	}
	
	// Create link to shopping carts administration page
	public static function ToCartsAdmin() {
		return self::ToAdmin('Page=Carts');	
	}
	
	// Create link to Orders administration page
	public static function ToOrdersAdmin() {
		return self::ToAdmin('Page=Orders');	
	}
	
	// Create link to the order details admin page
	public static function ToOrderDetailsAdmin($orderId) {
		$link = 'Page=OrderDetails&OrderId='.$orderId;
		return self::ToAdmin($link);	
	}
}
?>