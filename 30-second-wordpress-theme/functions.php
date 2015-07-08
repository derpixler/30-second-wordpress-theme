<?php
/**
 * 30 Second WordPress Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme
 */

add_action( 'after_setup_theme', 't30_setup', 0 );
/**
 * Callback on theme_init
 *
 * @wp-hook after_setup_theme
 *
 * @return  Void
 */
function t30_setup() {

	$vendor_dir = dirname( __FILE__ ) . '/vendors/';

	// localization
	load_theme_textdomain( 't30', get_template_directory() . '/languages' );

	// theme support
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	// include helpers
	include_once( $vendor_dir . '/30-second-wordpress-theme/helper.php' );

	// image sizes
	include_once( $vendor_dir . '/30-second-wordpress-theme/attachment.php' );
	t30_register_image_sizes();
	add_filter( 'img_caption_shortcode', 't30_caption_shortcode', 10, 3 );
	add_filter( 'use_default_gallery_style', '__return_false' );

	// navigation
	include_once( $vendor_dir . '/30-second-wordpress-theme/navigation.php' );
	t30_register_nav_menus();

	// widgets
	include_once( $vendor_dir . '30-second-wordpress-theme/widget.php' );
	add_action( 'widgets_init', 't30_widgets_init' );
	add_filter( 'dynamic_sidebar_params', 't30_filter_dynamic_sidebar_params' );
	
	// custom header
	include_once( $vendor_dir . '30-second-wordpress-theme/header.php' );
	t30_custom_header_setup();



	if ( ! is_admin() ) {

		// scripts
		include_once( $vendor_dir . '30-second-wordpress-theme/frontend/script.php' );
		add_action( 'wp_enqueue_scripts', 't30_wp_enqueue_scripts' );

		// style
		include_once( $vendor_dir . '30-second-wordpress-theme/frontend/style.php' );
		add_action( 'wp_enqueue_scripts', 't30_wp_enqueue_styles' );

		// general template
		include_once( $vendor_dir . '30-second-wordpress-theme/frontend/general.php' );
		add_filter( 'wp_title', 't30_filter_wp_title', 10, 3 );
		add_filter( 'body_class', 't30_filter_body_class', 10, 2 );
		add_action( 'wp_head', 't30_the_favicon' );
		add_action( 't30_single_post_footer', 't30_the_social_share_links' );
		add_action( 't30_archive_post_footer', 't30_the_social_share_links' );
		add_action( 't30_single_page_footer', 't30_the_social_share_links' );
		add_action( 't30_single_attachment_footer', 't30_the_social_share_links' );


		// comments
		include_once( $vendor_dir . '30-second-wordpress-theme/frontend/comment.php' );

		// posts
		include_once( $vendor_dir . '30-second-wordpress-theme/frontend/post.php' );
		add_filter( 'excerpt_more', 't30_filter_excerpt_more' );
	}
	

}