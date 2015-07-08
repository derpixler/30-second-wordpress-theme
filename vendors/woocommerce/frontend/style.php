<?php
/**
 * Feature Name:    Style Functions for Woocommerce
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */


/**
 * Unset WooCommerce default stylesheet
 *
 * @wp-hook woocommerce_enqueue_styles
 *
 * @param   Array $styles
 * @return  Array
 */
function t30_woocommerce_filter_woocommerce_enqueue_styles_remove( Array $styles = array() ){

	// unset woo-styles
	unset( $styles[ 'woocommerce-layout' ] );
	unset( $styles[ 'woocommerce-smallscreen' ] );
	unset( $styles[ 'woocommerce-general' ] );

	// we also don't need prettyPhoto
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );

	return $styles;
}

/**
 * Register our own styles to WooCommerce
 *
 * @wp-hook woocommerce_enqueue_styles
 *
 * @param   Array $styles
 * @return  Array
 */
function t30_woocommerce_filter_woocommerce_enqueue_styles_add( Array $styles = array() ) {

	$suffix = t30_get_script_suffix();
	$dir    = get_template_directory_uri() . '/assets/css';
	
	$styles[ 't30-woo' ] = array(
		'src'     => $dir . 'style.woo' . $suffix . '.css',
		'deps'    => array( 't30' ),
		'version' => null,
		'media'   => 'all'
	);
	
	return $styles;
}