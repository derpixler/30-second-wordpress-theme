/**
 * Feature Name:    Slider
 * Version:		    0.1
 * Author:		    Inpsyde GmbH for MarketPress.com
 * Author URI:	    http://inpsyde.com/
 */

( function( $ ) {
	$.fn.slider = function() {
		
		$( this ).each( function() {
			
			// current element
			var _self = $( this );
			
			// amount of clicked next and previous button
			var _next = 0;
			var _margin = 0;
			
			// get the width of the slide container
			var container_width = _self.children( '.container' ).width();
			
			// get the width of one element
			var elements = _self.find( '.slide' )
			var element_width = elements.outerWidth( true );
			var element_margin = elements.css( 'margin-right' );
			element_margin = parseInt( element_margin.substr( 0, element_margin.length - 2 ) );
			
			// count the elements
			var element_count = elements.length;
			var elements_per_slide = Math.ceil( container_width / element_width );
			var maximum_slides = Math.ceil( element_count / elements_per_slide ) - 1;
			
			// check if we need the next button
			if ( maximum_slides > _next )
				_self.children( '.next' ).css( 'visibility', 'visible' );
			
			// clicked next button
			_self.children( '.next' ).click( function() {
				next_slide();
				return false;
			} );
			
			// clicked next button
			_self.children( '.previous' ).click( function() {
				previous_slide();
				return false;
			} );
			
			var next_slide = function() {
				// check if we need to slide to the right
				_next++;
				
				// calculate the margin
				_margin = container_width * _next + ( _next * element_margin );
				
				// slide to the right
				_self.children( '.container' ).children( '.slides' ).animate( {
					marginLeft: '-' + _margin + 'px'
				} );
				
				// check if we still need the next button
				if ( maximum_slides == _next )
					_self.children( '.next' ).css( 'visibility', 'hidden' );
				
				// set previous
				if ( _next >= 1 )
					_self.children( '.previous' ).css( 'visibility', 'visible' );
			};
			
			var previous_slide = function() {
				// calculate how far we go left
				var walk_left = container_width + element_margin;
				_margin = _margin - walk_left;
				
				// slide to the left
				_self.children( '.container' ).children( '.slides' ).animate( {
					marginLeft: '-' + _margin + 'px'
				} );
				
				// check if we still need the previous button
				if ( _margin <= 0 )
					_self.children( '.previous' ).css( 'visibility', 'hidden' );
				
				// check if we need the next button
				_next--;
				if ( maximum_slides > _next )
					_self.children( '.next' ).css( 'visibility', 'visible' );
			};
		} );
	}
} )( jQuery );