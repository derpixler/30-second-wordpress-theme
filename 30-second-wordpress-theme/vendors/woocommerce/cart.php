<?php
/**
 * Feature Name:    Cart Functions for Woocommerce
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Adds mini cart markup to the woocommerce ajax fragments
 *
 * @wp-hook add_to_cart_fragments
 *
 * @param   Array $fragments
 * @return  Array $fragments
 */
function t30_woocommerce_filter_add_to_cart_fragments( $fragments ) {
	global $woocommerce;
	$fragments[ 't30_mini_cart' ] = t30_woocommerce_get_mini_cart( );
	return $fragments;
}

/**
 * WooCommerce cart shortcode handler.
 *
 * @param   array $args
 * @return  string $output
 */
function t30_woocommerce_get_mini_cart( Array $args = array() ) {
	global $woocommerce;

	// Get cart contents
	$items = $woocommerce->cart->get_cart();

	// Sum quantity of each item
	$quantity = 0;
	foreach ( $items as $item )
		$quantity += $item[ 'quantity' ];

	$default_args = array(
		'before'            => '',
		'after'             => '',
		'total_link'        => ' <a href="%s">%s</a>',
		'total'             => $woocommerce->cart->get_cart_total(),
		'quantity'          => $quantity,
		'quantity_before'   => '<span> - ',
		'quantity_after'    => '</span>',
	);

	$rtn = apply_filters( 'pre_t30_woocommerce_get_mini_cart', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 't30_woocommerce_get_mini_cart_args', $args );

	$output = $args[ 'before' ];
	$output .= sprintf(
		$args[ 'total_link' ],
		$woocommerce->cart->get_cart_url(),
		$args[ 'total' ]
	);
	
	$output .= $args[ 'quantity_before' ];
	$output .= $args[ 'quantity' ];
	$output .= $args[ 'quantity_after' ];
	$output .= $args[ 'after' ];

	return apply_filters( 't30_woocommerce_get_mini_cart', $output, $args );
}