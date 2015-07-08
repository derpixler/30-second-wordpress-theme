/**
 * Feature Name: Frontend Scripts
 * Version:      1
 * Author:       Rene Reimann
 * Author URI:   www.rene-reimann.de
 */

/** Several Other scripts **/

/** Add to Cart **/
( function( $ ) {
	var t30_frontend_add_to_cart = {
			
		// Pseudo-Constructor of this class
		init: function () {
			$( 'body' ).on( 'added_to_cart', function( event, fragments ) {
				$( '#t30-mini-cart' ).html( fragments.t30_mini_cart );
			} );
		}
	};
	
	$( document ).ready( t30_frontend_add_to_cart.init );
} )( jQuery );

/** Gallery **/
( function( $ ) {

	var t30_frontend_gallery = {

		// Pseudo-Constructor of this class
		init: function () {

			// check if there are gallery
			// items if not, we don't need
			// to do anything more
			if ( $( '.product-image' ).length == 0 )
				return;

			// hover
			//  Use empty function to not call `_gallery_hover` on mouseleave
			$( '.gallery-item' ).hover( _gallery_hover, function() {} );

			// zoom
			$( '.product-image-featured' ).zoom();

			// sliders
			$( '.slider' ).slider();
		},
	};

	function _gallery_hover() {
		
		// remove current from all gallery items
		$( '.product-image' ).removeClass( 'current' );

		// add current class to this item
		$( this ).children( '.product-image' ).addClass( 'current' );

		// switch the src of the big image by this
		var big_image_src = $( this ).attr( 'href' );
		var zoom_image_src = $( this ).data( 'zoom-img' );
		
		$( '.product-image-featured' ).attr( 'src', big_image_src );
		$( '.product-image-featured' ).data( 'zoom-img', zoom_image_src );
	}

	$( document ).ready( t30_frontend_gallery.init );

} )( jQuery );

function bind( context, func ) {
	return function() {
		return func.call( context, arguments );
	};
}