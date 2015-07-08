<?php
/**
 * Feature Name: General Template Functions for 30 Second WordPress Theme
 * Version:      1
 * Author:       Rene Reimann
 * Author URI:   www.rene-reimann.de
 */

/**
 * getting the Script and Style suffix for 30 Second WordPress Theme-Theme
 * Adds a conditional ".min" suffix to the file name when WP_DEBUG is NOT set to TRUE.
 *
 * @return string
 */
function t30_get_script_suffix() {

	$script_debug   = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
	$suffix         = $script_debug ? '' : '.min';

	return $suffix;
}