/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */


 ( function( $ ) {
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer, KEYCODE_TAB = 9;;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	initMainNavigation( $( '.main-navigation' ) );
	
	masthead         = $( '.site-header' );
	menuToggle       = masthead.find( '#menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.on( 'click', function() {
			$( this ).add( siteHeaderMenu ).add(siteNavigation).toggleClass( 'toggled-on' );
			var element = document.querySelector( '.site-header-menu.toggled-on' );
			if( element ) {
				$(document).on('keydown', function(e) {
					var focusable = element.querySelectorAll( 'input, a, button' );
					focusable = Array.prototype.slice.call( focusable );
					focusable = focusable.filter( function( focusableelement ) {
						return null !== focusableelement.offsetParent;
					} );
					var firstFocusable = document.querySelector('#menu-toggle');
					var lastFocusable = focusable[focusable.length - 1];
					news_cast_focus_trap( firstFocusable, lastFocusable, e );
				})
			}
			// jscs:disable
			$( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// header slide toggle
	var header_sidebar_trigger = $( ".header-sidebar-trigger" )
    if( header_sidebar_trigger.length ) {
		header_sidebar_trigger.on( "click", function() {
			var element = document.querySelector( '.header-sidebar-content' );
			if( element ) {
				$(document).on('keydown', function(e) {
					var focusable = element.querySelectorAll( 'input, a, button' );
					focusable = Array.prototype.slice.call( focusable );
					focusable = focusable.filter( function( focusableelement ) {
						return null !== focusableelement.offsetParent;
					} );
					var firstFocusable = document.querySelector('.header-sidebar-trigger-close');
					var lastFocusable = focusable[focusable.length - 1];
					news_cast_focus_trap( firstFocusable, lastFocusable, e );
				})
			}
		});
	}
	function news_cast_focus_trap( firstFocusable, lastFocusable, e ) {
        if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
            if ( e.shiftKey ) /* shift + tab */ {
				if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if ( document.activeElement === lastFocusable ) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        }
    }

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.news_cast', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.news_cast', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.news_cast' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.news_cast', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.news_cast blur.news_cast', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();
})( jQuery );