<?php
/**
 * Feature Name: Custom Header Stuff
 * Version:      1
 * Author:       Rene Reimann
 * Author URI:   www.rene-reimann.de
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @uses t30_header_style()
 * @uses t30_admin_header_style()
 * @uses t30_admin_header_image()
 *
 * @return void
 */
function t30_custom_header_setup() {
	/**
	 * Filter Parallactic custom-header support arguments.
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1280.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 800.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 't30_custom_header_args', array(
		'width'                  => 1280,
		'height'                 => 800,
		'default-text-color'     => 'fff',
		'wp-head-callback'       => 't30_header_style',
		'admin-head-callback'    => 't30_admin_header_style',
		'admin-preview-callback' => 't30_admin_header_image',
	) ) );
}

/**
 * Styles the header image and text displayed on the blog
 *
 * Example Stylesheet:
 *
 * body > header {
 * 	color: #<?php echo get_header_textcolor(); ?>;
 * 	height: <?php echo $custom_header->height; ?>px;
 * 	max-height: <?php echo $custom_header->height; ?>px;
 * 	background: url(<?php echo $custom_header->url; ?>) 50% 0 no-repeat fixed;
 * 	background-size: cover !important;
 * }
 *
 * body > header a {
 * 	color: #<?php echo get_header_textcolor(); ?>;
 * }
 *
 * @see t30_custom_header_setup().
 *
 * @return void
 */
function t30_header_style() {

	// load the header, but keep the things clean
	$custom_header = get_custom_header();
	if ( empty( $custom_header->url ) )
		return;
	?>
	<style type="text/css" id="t30-header-css">
	
	</style>
	<?php
}

/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see t30_custom_header_setup().
 *
 * @return void
 */
function t30_admin_header_style() {
	?>
	<style type="text/css" id="t30-header-css">
		#headimg {
		}

		#headimg .header-text-container {
		}

		#headimg a {
		}

		#headimg h1 {
		}

		#headimg #desc {
		}
	</style>
	<?php
}

/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see t30_custom_header_setup().
 *
 * @return void
 */
function t30_admin_header_image() {

	// load the custom header stlye
	$custom_header = get_custom_header();
	$header_image_style = 'background-image:url(' . esc_url( get_header_image() ) . ');';
	if ( $custom_header->width )
		$header_image_style .= 'max-width:' . $custom_header->width . 'px;';
	if ( $custom_header->height )
		$header_image_style .= 'height:' . $custom_header->height . 'px;';

	?>
	<div id="headimg" style="<?php echo $header_image_style; ?>">
		<div class="header-text-container displaying-header-text">
			<?php
			if ( display_header_text() )
				$style = ' style="color:#' . get_header_textcolor() . ';"';
			else
				$style = ' style="display:none;"';
			?>
			<h1><a id="name" class="displaying-header-text" <?php echo $style; ?> onclick="return false;" href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="desc" class="displaying-header-text" <?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		</div>
	</div>
	<?php
}