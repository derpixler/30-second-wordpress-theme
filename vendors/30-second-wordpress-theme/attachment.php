<?php
/**
 * Feature Name:    Attachment Helper Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Register the image sizes
 *
 * @return  void
 */
function t30_register_image_sizes() {

	$default_sizes = array(
		'post-thumbnail'    => array( 'width' => 650, 'height' => 300, 'crop' => TRUE ),
	);
	$default_sizes = apply_filters( 't30_image_sizes', $default_sizes );

	foreach ( $default_sizes as $id => $args )
		add_image_size( $id, $args[ 'width' ], $args[ 'height' ], $args[ 'crop' ] );
}

/**
 * Manipulates the caption shortcode of WordPress
 * to set the caption above the image
 *
 * @param   String $output
 * @param   Array $attr
 * @param   String $content
 * @return  String
 */
function t30_caption_shortcode( $output, $attr, $content ) {

	$output = '<figure class="wp-caption ' . $attr[ 'align' ] . '">';
	$output .= $content;
	$output .= '<figcaption class="wp-caption-text">' . $attr[ 'caption' ] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}