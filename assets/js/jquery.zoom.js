/**
 * Feature Name:    Zoom
 * Version:         0.1
 * Author:          Inpsyde GmbH for MarketPress.com
 * Author URI:      http://inpsyde.com/
 */

( function( $ ) {
	$.fn.zoom = function() {
		this.hover( bind( this, _zoom_hover ), bind( this, _remove_zoom ) );
	};

	_zoom_hover = function() {
		// set defaults
		var defaults = {
			image_url: this.data( 'zoom-img' ),
			image_width: 0,
			image_height: 0,
			image: {},
			ratio: 1
		};

		// kickoff
		_fetch_image.call( this, defaults );
	};

	// fetches the image and starts the zoom
	function _fetch_image( defaults ) {

		var image = new Image();
		var self = this;
		var options = {};

		image.onload = function() {

			// prepare image data
			options.image = this;
			options.image_width = this.width;
			options.image_height = this.height;
			options.ratio = options.image_width / self.width();

			// zoom the image
			_zoom_image.call( self, $.extend( {}, defaults, options ) );
		};

		image.src = defaults.image_url;
	}

	// zooms the image
	function _zoom_image( options ) {

		// insert the zoom container
		_build_zoom_container.call( this, options );

		// get mouse position on current image
		this.mousemove( bind( { $: this, options: options }, _zoom_move ) );
	}

	// build zoom container
	function _build_zoom_container( options ) {

		var position = this.position();
		var position_left = position.left + this.width();
		var position_top = position.top;

		var zoom_container = $('<div class="zoom"></div>')
			.insertAfter( 'body' )
			.html( options.image )
			.css( {
				'position': 'fixed',
				'width': 300,
				'height': 200,
				'border': '2px solid #eee',
				'overflow': 'hidden',
				'background': '#fff'
			} );
	}

	function _zoom_move( e ) {

		// Arguments passed by `call`
		e = e[0];

		var offset  =   this.$.offset(),
			offsetX =   offset.left,
			offsetY =   offset.top,
			x       =   e.pageX - offsetX,
			y       =   e.pageY - offsetY;

		$( '.zoom' ).css( {
			'top': ( e.clientY + 10 ),
			'left': ( e.clientX + 10 )
		} );

		$( '.zoom img' ).css( {
			'position': 'absolute',
			'z-index': 100,
			'border': 0,
			'top'   : - ( ( y * this.options.ratio ) - ( 300 / 2 ) ),
			'left' : - ( ( x * this.options.ratio ) - ( 200 / 2 ) )
		} );
	}

	function _remove_zoom() {
		$( '.zoom' ).remove();
	}
} )( jQuery );