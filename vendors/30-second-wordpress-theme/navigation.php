<?php
/**
 * Feature Name:    Navigation Helper Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Registering the nav_menus to our blog
 *
 * @return void
 */
function t30_register_nav_menus() {


	register_nav_menus( array(

	) );

}

/**
 * Callback for empty wp_nav_menu
 *
 * @wp-hook wp_nav_menuwp-link-aja
 *
 * @param   array $args
 * @return  void
 */
function t30_the_nav_menu_fallback_cb( Array $args = array() ) {
	global $current_user;

	// Return early if user cannot edit widgets and menus.
	if ( $args['theme_location'] !== 't30_header'
	     || ! is_user_logged_in()
	     || ! current_user_can( 'edit_theme_options' )
	)
		return;

	$h4 = _x(
		'Hi, %s!',
		'%s = current user display name',
		't30'
	);
	$p = _x(
		'Please <a href="%s">create a custom menu</a> and assign it to one of the available menu locations.',
		'%s = wp-admin/nav-menus.php',
		't30'
	);
	?>
	<aside class="navigation-error message-error" role="alert">
		<h4><?php printf( $h4, $current_user->display_name ); ?></h4>
		<p><?php  printf( $p, esc_url( admin_url( 'nav-menus.php' ) ) ); ?></p>
	</aside>
<?php
}