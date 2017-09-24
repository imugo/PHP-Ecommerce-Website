(function() {  
	// Holds an instance of XMLHttpRequest
	var xmlHttp = createXmlHttpObject();
	
	// Display error messages (true) or degrade to non-Ajax behaviour
	var showErrors = true;
	
	// Contains the link or form clicked or submitted by the visitor
	var actionObject = '';
	
	// This is true when the place order button is clicked, false otherwise
	var placingOrder = false;
	
	// Creates an XmlHttpRequest instance
	function createXmlHttpObject() {
		// Will store the XMLHttpRequest instance
		var xmlHttp;
		
		// Create the XMLHttpObject
		try {
			xmlHttp = new XMLHttpRequest();	
		}
		catch(e) {
			// Assume IE6 or older
			var XmlHttpVersions = new Array(
				"MSXML2.XMLHTTP.6.0", "MSXML2.XMLHTTP.5.0", "MSXML2.XMLHTTP.4.0",
				"MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP");
				
			// Try every id until one works
			for (var i = 0; i < XmlHttpVersions.length && !xmlHttp; i++) {
				try {
					// Try to create XMLHttpRequest object
					xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
				}
				catch (e) {} // Ignore potential error	
			}
		}
	
		// if th XMLHttpRequest object was created successfully, return it
		if (xmlHttp) {
			return xmlHttp;
		}
		// If an error occurred pass it to handler
		else {
			handleError("Error creating the XMLHttpRequest Object");	
		}
	}
	
	function handleError($message) {
		// Ignore errors if show errors is false
		if (showErrors) {
			// Display Error message
			alert("Error encountered: <br>" + $message);
			return false;	
		}
		// Fall back to non ajax behaviour
		else if (!actionObject.tagName) {
			return true;
		}
		// Fall back to non-ajax behaviour by following the link
		else if (actionObject.tagName === 'A') {
			window.location = actionObject.href;
		}
		// Fall back to non-ajax behaviour by submitting the form
		else if (actionObject.tagName === 'FORM') {
			actionObject.submit();
		}
	}
	
	// Adds a product to the shopping cart
	function addProductToCart(form) {
		if (!xmlHttp) {
			return true;	
		}
		
		// Create the URL we open asynchronously
		var request = form.action + '&AjaxRequest';
		var params = '';

		// obtain selected attributes
		var formSelects = form.getElementsByTagName('SELECT');
		
		if (formSelects) {
			for (var i = 0; i < formSelects.length; i++) {
				params += '&' + formSelects[i].name + '=';
				var selected_index = formSelects[i].selectedIndex;
				params += encodeURIComponent(formSelects[i][selected_index].text);
			}
		}
	
		// Try to connect to the server
		try {
			// Continue only if the XMLHttpRequest object isn't busy
			if (xmlHttp.readyState === 4 || xmlHttp.readyState === 0) {
				// Make a server request to validate the extracted data
				xmlHttp.open("POST", request, true);
				xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				xmlHttp.onreadystatechange = addToCartStateChange;
				xmlHttp.send(params);
			}
		}
		catch (e) {
			// Handle error
			handleError(e.toString());
		}
		
		// Stop classical form submit if AJAX action succeeded
		return false;
	}

	// Function that retrieves the HTTP response
	function addToCartStateChange() {
		// When readyState is 4, we also read the server response
		if (xmlHttp.readyState === 4) {
			// Continue only if HTTP status is "OK"
			if (xmlHttp.status === 200) {
				try {
					updateCartSummary();
				}
				catch (e) {
					handleError(e.toString());
				}
			}
			else {
				handleError(xmlHttp.statusText);
			}
		}
	}

	// Process server's response
	function updateCartSummary() {
		// Read the response
		var response = xmlHttp.responseText;

		// Server error?
		if (response.indexOf("ERRNO") >= 0 || response.indexOf("error") >= 0) {
			handleError(response);
		}
		else {
			// Extract the contents of the cart_summary span element
			var cartSummaryRegEx = /^<span id="cart-summary">([\s\S]*)<\/span>$/m;
			var matches = cartSummaryRegEx.exec(response);
			response = matches[1];
			// Update the cart summary box and hide the Loading message
			document.getElementById("cart-summary").innerHTML = response;
			// Scroll to the top of the page
			$('#cart-dropdown-menu').toggle();
			$('html, body').animate({
				scrollTop: $('body').offset().top
			}, 500);
			
		}
	}
	
	// called on shopping cart update actions
	function executeCartAction(obj) {
		// Degrade to classical form submit for place order action
		if (placingOrder){ 
			return true;
		}
		
		// Degrade to classical form submit if xmlhttprequest object is unavailable
		if (!xmlHttp) {
			return true;	
		}
		
		// Save object reference
		actionObject = obj;
		
		// Initialize response and parameters
		var response = "";
		var params = "";
		
		// If a link was clicked
		if (obj.tagName === 'A') {
			var url = obj.href + "&AjaxRequest";
		}
		// If the form was submitted we get its elements
		else {
			var url = obj.action + "&AjaxRequest";
			var formElements = obj.getElementsByTagName("INPUT");	
			
			if (formElements) {
				for (var j = 0; j<formElements.length; j++) {
					if (formElements[j].name !== 'place_order') {
						params += '&' + formElements[j].name + "=";
						params += encodeURIComponent(formElements[j].value);
					}
				}
			}
		}
		
		// try to connect to the server
		try {
			// Make server request only if the XMLHttpRequest object isn't busy
			if (xmlHttp.readyState === 4 || xmlHttp.readyState === 0) {
				xmlHttp.open("POST", url, true);
				xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlHttp.onreadystatechange = cartActionStateChange;
				xmlHttp.send(params);
			}
		}
		catch(e) {
			handleError(e.toString());
		}
		// Stop classical form submit if AJAX action succeded
		return false;
	}
	
	function cartActionStateChange() {
		// When readyState is 4, we also read the server response
		if (xmlHttp.readyState === 4) {
			// Continue only if http status is ok
			if (xmlHttp.status === 200) {
				try {
					// Read the response
					var response = xmlHttp.responseText;
					
					// Server error?
					if (response.indexOf("ERRNO") >= 0 || response.indexOf("error") >= 0) {
						handleError(response);
					}
					else {
						// Extract contents of the contents span
						var cartDetailsRegExec = /^<div id="contents">([\s\S]*)<\/div>$/m;
						var matches = cartDetailsRegExec.exec(response);
						response = matches[1];
						document.getElementById("contents").innerHTML = response;	
					}
				}
				catch(e) {
					handleError(e.toString());
				}
			}
			else {
				handleError(xmlHttp.statusText);	
			}
		}
	}
}());
