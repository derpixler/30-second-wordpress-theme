<?php
/**
 * Feature Name:    Script Functions for Woocommerce
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */


/**
 * Unset WooCommerce prettyPhoto-Scripts
 *
 * @wp-hook  woocommerce_enqueue_styles
 * @return  Void
 */
function t30_woocommerce_wp_deregister_script() {
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
}

/**
 * Enqueue styles and scripts.
 *
 * @wp-hook wp_enqueue_scripts
 *
 * @return  void
 */
function t30_woocommerce_wp_enqueue_scripts() {

	$scripts = t30_woocommerce_get_scripts();

	foreach ( $scripts as $handle => $script ) {

		wp_enqueue_script(
			$handle,
			$script[ 'src' ],
			$script[ 'deps' ],
			$script[ 'version' ],
			$script[ 'in_footer' ]
		);
	}
}

/**
 * Returning our 30 Second WordPress Theme-WooCommerce-Scripts
 *
 * @return  array
 */
function t30_woocommerce_get_scripts(){

	$scripts = array();
	$suffix = t30_get_script_suffix();
	$dir = get_template_directory_uri() . '/assetes/js/';

	// adding the slider-js
	$scripts[ 'jquery-slider' ] = array(
		'src'       => $dir . 'jquery.slider' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'version'   => NULL,
		'in_footer' => TRUE
	);

	// adding the zoom-js
	$scripts[ 'jquery-zoom' ] = array(
		'src'       => $dir . 'jquery.zoom' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'version'   => NULL,
		'in_footer' => TRUE
	);

	// adding the main-js
	$scripts[ 't30-woo-js' ] = array(
		'src'       => $dir . 'woo' . $suffix . '.js',
		'deps'      => array( 'jquery', 'jquery-magnific', 'jquery-slider', 'jquery-zoom' ),
		'version'   => NULL,
		'in_footer' => TRUE
	);

	return apply_filters( 't30_woocommerce_get_scripts', $scripts );
}