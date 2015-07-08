<?php
/**
 * The article
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */
?>

<?php
// display comment count
if ( have_comments() || comments_open() )
	printf( '<div class="comments"><a href="%1$s"><span class="count">%2$s</span> %3$s</a></div>', get_comments_link(), get_comments_number(), _n( 'Comment', 'Comments', get_comments_number(), 't30' ) );
?>