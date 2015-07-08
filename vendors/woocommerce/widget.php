<?php
/**
 * Feature Name:	Widget Functions for WooCommerce
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */


/**
 * Callback to register the Widgets for WooCommerce
 *
 * @wp-hook widgets_init
 *
 * @return  mixed
 */
function t30_woocommerce_widgets_init() {

	$sidebars = array(
		'shop'		=> array(
			'name'	=> _x(
				'Shop Sidebar',
				'Widget area name in wp-admin/widgets.php',
				't30'
			),
			'desc'	=> _x(
				'Widgets on WooCommerce shop pages',
				'Widget area description in wp-admin/widgets.php',
				't30'
			),
		),
	);

	// Create widget areas
	foreach ( $sidebars as $id => $args ) {
		register_sidebar( array(
			'name'			=> $args['name'],
			'id'			=> $id,
			'description'	=> $args['desc'],
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	// Return a value for unit tests
	return $GLOBALS[ 'wp_registered_sidebars' ];
}