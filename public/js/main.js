/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2015, Codrops
 * http://www.codrops.com
 */
;(function(window) {

	'use strict';

	var support = { transitions: Modernizr.csstransitions },
		// transition end event name
		transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		onEndTransition = function( el, callback ) {
			var onEndCallbackFn = function( ev ) {
				if( support.transitions ) {
					if( ev.target != this ) return;
					this.removeEventListener( transEndEventName, onEndCallbackFn );
				}
				if( callback && typeof callback === 'function' ) { callback.call(this); }
			};
			if( support.transitions ) {
				el.addEventListener( transEndEventName, onEndCallbackFn );
			}
			else {
				onEndCallbackFn();
			}
		},
		// the pages wrapper
		stack = document.querySelector('.pages-stack'),
		// page
		page = document.querySelector('.pages-stack .page'),		
		// menu button
		menuCtrl = document.querySelector('button.menu-button'),
		// the navigation wrapper
		nav = document.querySelector('.pages-nav'),
		// the menu nav items
		navItems = [].slice.call(nav.querySelectorAll('.link--page')),
		// check if menu is open
		isMenuOpen = false;

	function init() {
		initEvents();
	}

	// event binding
	function initEvents() {
		// menu button click
		menuCtrl.addEventListener('click', toggleMenu);

		// clicking on a page when the menu is open triggers the menu to close again and open the clicked page
			var pageid = page.getAttribute('id');
			page.addEventListener('click', function(ev) {
				if( isMenuOpen ) {
					ev.preventDefault();
					openPage(pageid);
				}
		});

		// keyboard navigation events
		document.addEventListener( 'keydown', function( ev ) {
			if( !isMenuOpen ) return; 
			var keyCode = ev.keyCode || ev.which;
			if( keyCode === 27 ) {
				closeMenu();
			}
		} );
	}

	// toggle menu fn
	function toggleMenu() {
		if( isMenuOpen ) {
			closeMenu();
		}
		else {
			openMenu();
			isMenuOpen = true;
		}
	}

	// opens the menu
	function openMenu() {
		$('body').css('overflow', 'hidden');
		// toggle the menu button
		$(menuCtrl).addClass('menu-button--open');
		// stack gets the class "pages-stack--open" to add the transitions
		$(stack).addClass('pages-stack--open');
		// reveal the menu
		$(nav).addClass('pages-nav--open');

		page.style.WebkitTransform = 'translate3d(0, 75%, ' + parseInt(-1 * 200 - 50*0) + 'px)'; // -200px, -230px, -260px
		page.style.transform = 'translate3d(0, 75%, ' + parseInt(-1 * 200 - 50*0) + 'px)';
		
	}

	// closes the menu
	function closeMenu() {
		// same as opening the current page again
		openPage();
	}

	// opens a page
	function openPage(id) {
		
		var futurePage = id ? document.getElementById(id) : page;

		// set transforms for the new current page
		futurePage.style.WebkitTransform = 'translate3d(0, 0, 0)';
		futurePage.style.transform = 'translate3d(0, 0, 0)';
		futurePage.style.opacity = 1;

		// close menu..
		$('body').css('overflow', 'visible');
		$(menuCtrl).removeClass('menu-button--open');
		$(nav).removeClass('pages-nav--open');
		onEndTransition(futurePage, function() {
			$(stack).removeClass('pages-stack--open');
			
			isMenuOpen = false;
		});		
	}

	init();

})(window);