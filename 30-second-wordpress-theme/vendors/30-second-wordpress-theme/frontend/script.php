<?php
/**
 * Feature Name:    Script Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Enqueue styles and scripts.
 *
 * @wp-hook wp_enqueue_scripts
 *
 * @return  void
 */
function t30_wp_enqueue_scripts() {

	$scripts = t30_get_scripts();

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
 * Returning our 30 Second WordPress Theme-Scripts
 *
 * @return  array
 */
function t30_get_scripts(){

	$scripts = array();
	$suffix = t30_get_script_suffix();
	$dir = get_template_directory_uri() . '/assets/js/';

	// adding the main-js
	$scripts[ 't30-js' ] = array(
		'src'       => $dir . 'frontend' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'version'   => NULL,
		'in_footer' => TRUE
	);
	
	// adding the magnific-js
	$scripts[ 't30-js' ] = array(
		'src'       => $dir . 'jquery.magnific' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'version'   => NULL,
		'in_footer' => TRUE
	);

	/*
	 * Custom modernizr build, adds classes to <html>
	 * displaying browser support for CSS3 and HTML5 features.
	 */
	$scripts[ 'modernizr' ] = array(
		'src'       => $dir . 'modernizr' . $suffix . '.js',
		'deps'      => array(),
		'version'   => NULL,
		'in_footer' => FALSE
	);

	return apply_filters( 't30_get_scripts', $scripts );
}
