<?php
/**
 * Feature Name:    Product-Functions for our WooCommerce-Shop
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */


/**
 * Function to return our featured products for the front_page-teaser
 *
 * @param   Array $args
 * @return  WP_Query
 */
function t30_woocommerce_get_teaser_products( Array $args = array() ){

	$default_args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => -1,
		'meta_key'            => '_featured',
		'meta_value'          => 'yes'
	);
	$rtn = apply_filters( 'pre_t30_woocommerce_get_teaser_products', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 't30_woocommerce_get_teaser_products_args', $args );

	$products = new WP_Query( $args );
	return apply_filters( 't30_woocommerce_get_teaser_products', $products, $args );
}