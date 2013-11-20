/**
 * Roots Child
 * http://github.com/duanecilliers/roots-child
 *
 * Copyright (c) 2013 Duane Cilliers
 * Licensed under the GPLv2+ license.
 */

// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var RootsChild = {
	// All pages
	common: {
		init: function() {
			// JS here
		},
		finalize: function() { }
	},
	// Home page
	home: {
		init: function() {
			// JS here
		}
	},
	// About page
	about: {
		init: function() {
			// JS here
		}
	}
};

var UTIL = {
	fire: function(func, funcname, args) {
		var namespace = RootsChild;
		funcname = (funcname === undefined) ? 'init' : funcname;
		if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
			namespace[func][funcname](args);
		}
	},
	loadEvents: function() {

		UTIL.fire('common');

		$.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
			UTIL.fire(classnm);
		});

		UTIL.fire('common', 'finalize');
	}
};

jQuery(document).ready(function($) {
	UTIL.loadEvents
});
