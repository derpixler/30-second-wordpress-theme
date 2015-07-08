<?php
/**
 * Feature Name:    Widget Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Callback to register the widget areas
 *
 * @wp-hook widgets_init
 *
 * @return  array
 */
function t30_widgets_init() {


	// Define widget areas
	$widget_areas = array(

	);


	// Create widget areas
	foreach ( $widget_areas as $id => $args ) {
		register_sidebar( array(
				'name'			=> $args[ 'name' ],
				'id'			=> $id,
				'description'	=> $args[ 'desc' ],
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	// Return a value for unit tests
	return $GLOBALS[ 'wp_registered_sidebars' ];
}


/**
 * Add classes for widgets with counters or dropdowns.
 *
 * @wp-hook dynamic_sidebar_params
 *
 * @param   array $params
 * @return  array
 */
function t30_filter_dynamic_sidebar_params( Array $params ) {
	global $wp_registered_widgets;

	$classes     = array();
	$instance_id = $params[ 1 ][ 'number' ];
	$widget_id   = $params[ 0 ][ 'widget_id' ];

	// The class handling the widget.
	$settings    = $wp_registered_widgets[ $widget_id ][ 'callback' ][ 0 ]->get_settings();

	if ( empty ( $settings[ $instance_id ] ) )
		return $params;

	if ( ! empty ( $settings[ $instance_id ][ 'dropdown' ] ) )
		$classes[] = 'widget-with-dropdown';

	if ( ! empty ( $settings[ $instance_id ][ 'count' ] ) )
		$classes[] = 'widget-with-counters';

	if ( empty ( $classes ) )
		return $params;

	$params[ 0 ][ 'before_widget' ] = str_replace(
		'class="',
		'class="' . join( ' ', $classes ) . ' ',
		$params[ 0 ][ 'before_widget' ]
	);

	return $params;
}