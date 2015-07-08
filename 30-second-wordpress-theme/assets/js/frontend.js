/**
 * Feature Name: Frontend Scripts
 * Version:      1
 * Author:       Rene Reimann
 * Author URI:   www.rene-reimann.de
 */

/** Menu **/
( function( $ ) {
	var t30 = {
			
		// Pseudo-Constructor of this class
		init: function () {
			
			// click
			$( '.gallery-item a' ).magnificPopup( {
				type: 'image',
				gallery: {
					enabled: true
				}
			} );
		}
	};
	
	$( document ).ready( t30.init );
} )( jQuery );