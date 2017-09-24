	window.dome = (function() {
		var Dome = function(els) {
			for (var i = 0; i < els.length; i+=1) {
				this[i] = els[i];
			}
			this.length = els.length;
		};
		
		Dome.prototype.map = function(callback) {
			var results = [], i = 0;
			for ( ; i < this.length; i+=1) {
				results.push(callback.call(this, this[i], i));
			}
			return results;
		};
		
		Dome.prototype.forEach = function(callback) {
			this.map(callback);
			return this;
		};
		
		Dome.prototype.mapOne = function(callback) {
			var m = this.map(callback);
			return m.length > 1 ? m : m[0];
		};
		
		Dome.prototype.text = function(text) {
			if (typeof text !== "undefined") {
				return this.forEach(function(el) { el.innerText = text; });
			}
			else {
				return this.mapOne(function(el) { return el.innerText; });
			}
		};
		
		Dome.prototype.addClass = function(classes) {
			var className = "";
			if (typeof classes !== "string") {
				for (var i = 0; i < classes.length; i+=1) {
					className += " " + classes[i];
				}
			}
			else {
				className  = " " + classes;
			}
			return this.forEach(function(el) { el.className += className; });
		};
		
		Dome.prototype.removeClass = function(clazz) {
			/*return this.forEach(function(el) {
							var cs = el.className.split(" "), i;
							
							while ((i = cs.indexOf(clazz)) > -1) {
								cs = cs.slice(0, i).concat(cs.slice(++i));
							}
							
							el.className = cs.join(" "); 
						});*/
			  return this.forEach(function(el) {
			  		var removing = clazz.split(" "), i, j, arr = [], cs = el.className.split(" ");
					
					for (i=0; i<removing.length; i++) {
						if ((j = cs.indexOf(removing[i])) > -1) {
							cs = cs.slice(0, j).concat(cs.slice(j+1));
						}
					}
					el.className = cs.join(" "); 
			  });
		};
		
		Dome.prototype.attr = function(attr, val) {
			if (typeof val !== "undefined") {
				return this.forEach(function(el) { el.setAttribute(attr, val); });
			}
			else {
				return this.mapOne(function(el) { return el.getAttribute(attr); });
			}
		};
		
		Dome.prototype.append = function(els) {
			return this.forEach(function(parEl, i) {
						els.forEach(function(childEl) {
							if (i > 0) {
								childEl = childEl.cloneNode(true);
							}
							parEl.appendChild(childEl);
						});
					});
		};
		
		Dome.prototype.prepend = function(els) {
			return this.forEach(function(parEl, i) {
						for (var j = els.length - 1; j > -1; j--) {
							childEl = (i>0) ? els[j].cloneNode(true) : els[j];
							parEl.insertBefore(childEl, parEl.firstChild);
						}
					});
		};
		
		Dome.prototype.remove = function() {
			return this.forEach(function(el) {
				return el.parentNode.removeChild(el);
			});
		};
		
		Dome.prototype.on = function() {
			return function(evt, fn) {
				return this.forEach(function(el) {
					el.addEventListener(evt, fn, false);
				});
			};
		}();
		
		var dome = {
			create: function(tagName, attrs) {
						var el = new Dome([document.createElement(tagName)]);
						if (attrs) {
							if (attrs.className) {
								el.addClass(attrs.className);
								delete attrs.className;
							}
							if (attrs.text) {
								el.text(attrs.text);
								delete attrs.text;
							}
							for (var key in attrs) {
								if (attrs.hasOwnProperty(key)) {
									el.attr(key, attrs[key]);
								}
							}
						}
						return el;
					},
				
			get: function(selector) {
					var els;
					
					if (typeof selector === "string") {
						els = document.querySelectorAll(selector);
					}
					else if (selector.length) {
						els = selector;
					}
					else {
						els = [selector];
					}
					
					return new Dome(els);
				}
		};
		
		return dome;
	}());
