<?php
/**
 * Feature Name:    WooCommerce Setup for our Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */


/**
 * Setup-Function for Woocommerce which is used in our main setup-Function in functions.php
 *
 * @uses    add_theme_support, add_action, add_filter
 */
function t30_woocommerce_setup(){
	
	/**
	 * Add WooCommerce theme support.
	 * @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
	 */
	add_theme_support( 'woocommerce' );

	// removing some meta
	remove_action( 'wp_head', 'wc_generator_tag' );

	// woocommerce/archive-product.php && woocommerce/single-product.php
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	// woocommerce/content-single-product.php
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

	// woocommerce/content-product.php
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5  );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

	// footer.php
	remove_action( 'wp_footer', 'woocommerce_demo_store' );

	// cart
	include_once( 'cart.php' );
	add_filter( 'add_to_cart_fragments', 't30_woocommerce_filter_add_to_cart_fragments' );

	// attachment and image sizes
	include_once( 'attachment.php' );
	t30_woocommerce_register_image_sizes();
	add_filter( 'woocommerce_get_image_size_shop_single', 't30_woocommerce_get_image_size_shop_single' );
	add_filter( 'woocommerce_get_image_size_shop_catalog', 't30_woocommerce_get_image_size_shop_catalog' );
	add_filter( 'woocommerce_get_image_size_shop_thumbnail', 't30_woocommerce_get_image_size_shop_thumbnail' );
	
	// widgets
	include_once( 'widget.php' );
	add_action( 'widgets_init', 't30_woocommerce_widgets_init' );

	// frontend stuff only
	if ( ! is_admin() ) {

		// taxonomy
		include_once( 'frontend/product.php' );

		// styles
		include_once( 'frontend/style.php' );
		add_filter( 'woocommerce_enqueue_styles', 't30_woocommerce_filter_woocommerce_enqueue_styles_add' );
		add_filter( 'woocommerce_enqueue_styles', 't30_woocommerce_filter_woocommerce_enqueue_styles_remove' );

		// script
		include_once( 'frontend/script.php' );
		add_action( 'wp_enqueue_scripts', 't30_woocommerce_wp_enqueue_scripts' );
		add_action( 'wp_enqueue_scripts', 't30_woocommerce_wp_deregister_script' );
	}
}