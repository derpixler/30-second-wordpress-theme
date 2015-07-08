<?php
/**
 * Feature Name:    Style Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Enqueue styles and scripts.
 *
 * @wp-hook wp_enqueue_scripts
 *
 * @return  Void
 */
function t30_wp_enqueue_styles() {

	$styles = t30_get_styles();

	foreach( $styles as $key => $style ){
		wp_enqueue_style(
			$key,
			$style[ 'src' ],
			$style[ 'deps' ],
			$style[ 'version' ],
			$style[ 'media' ]
		);
	}
}

/**
 * Returning our 30 Second WordPress Theme-Styles
 *
 * @return  Array
 */
function t30_get_styles(){

	$suffix = t30_get_script_suffix();
	$dir    = get_template_directory_uri() . '/assets/css/';

	// $handle => array( 'src' => $src, 'deps' => $deps, 'version' => $version, 'media' => $media )
	$styles = array();

	// adding the main-CSS
	$styles[ 't30' ] = array(
		'src'       => $dir . 'style' . $suffix . '.css',
	    'deps'      => NULL,
	    'version'   => NULL,
	    'media'     => NULL
	);

	// adding the media-CSS
	$styles[ 't30-media' ] = array(
		'src'       => $dir . 'media' . $suffix . '.css',
		'deps'      => NULL,
		'version'   => NULL,
		'media'     => NULL
	);
	
	// adding the magnific-CSS
	$styles[ 't30-media' ] = array(
		'src'       => $dir . 'magnific' . $suffix . '.css',
		'deps'      => NULL,
		'version'   => NULL,
		'media'     => NULL
	);
	
	// adding the fonts-CSS
	$styles[ 't30-media' ] = array(
		'src'       => $dir . 'fonts' . $suffix . '.css',
		'deps'      => NULL,
		'version'   => NULL,
		'media'     => NULL
	);



	return apply_filters( 't30_get_styles', $styles );
}
