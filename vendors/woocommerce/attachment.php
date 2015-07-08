<?php
/**
 * Feature Name:    Attachment Helper Functions for WooCommerce-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Manipulates the size of the image to the  defaults
 *
 * @param   Array $size
 * @return  Array
 */
function t30_woocommerce_get_image_size_shop_single( Array $size = array() ) {
	
	$size = array(
		'width'  => '500',
		'height' => '400',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Manipulates the size of the image to the  defaults
 * This size is used on the archive pages
 *
 * @param   Array $size
 * @return  Array
 */
function t30_woocommerce_get_image_size_shop_catalog( Array $size = array() ) {
	
	$size = array(
		'width'  => '345',
		'height' => '430',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Manipulates the size of the image to the theme defaults
 * This size is used on the gallery previews and widgets
 *
 * @param   Array $size
 * @return  Array
 */
function t30_woocommerce_get_image_size_shop_thumbnail( Array $size = array() ) {
	
	$size = array(
		'width'  => '80',
		'height' => '95',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Register some more image sizes for woocommerce
 *
 * @return  void
 */
function t30_woocommerce_register_image_sizes() {

	$default_sizes = array(
		'featured-image' => array( 'width' => 400, 'height' => 350, 'crop' => TRUE ),
		'big-zoom-image' => array( 'width' => 1000, 'height' => 800, 'crop' => TRUE ),
		'small-gallery-image' => array( 'width' => 230, 'height' => 150, 'crop' => TRUE ),
	);
	$default_sizes = apply_filters( 't30_woocommerce_image_sizes', $default_sizes );

	foreach ( $default_sizes as $id => $args )
		add_image_size( $id, $args[ 'width' ], $args[ 'height' ], $args[ 'crop' ] );
}