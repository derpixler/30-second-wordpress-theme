<?php
/**
 * Feature Name:    Post Functions for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Paginated posts navigation. Used instead of
 * next_posts()/previous_posts().
 * Displays an unordered list.
 *
 * @param       array $args
 *
 * @return      string
 */
function t30_get_posts_pagination( Array $args = array() ) {
	global $wp_query;

	$paginated = $wp_query->max_num_pages;

	if ( $paginated < 2 )
		return '';

	$default_args   = array(
		'base' 		=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 	=> '',
		'current' 	=> max( 1, get_query_var( 'paged' ) ),
		'total' 	=> $wp_query->max_num_pages,
		'mid_size' 	=> 2,
		'type' 		=> 'list',
		'prev_text'	=> sprintf(
			'<span title="%s">‹</span>',
			__( 'Previous', 't30' )
		),
		'next_text'	=> sprintf(
			'<span title="%s">›</span>',
			__( 'Next', 't30' )
		),
	);

	$rtn = apply_filters( 'pre_t30_get_posts_pagination', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 't30_get_posts_pagination_args', $args );

	$output = paginate_links( $args );

	return apply_filters( 't30_get_posts_pagination', $output, $args );
}


/**
 * Callback for the excerpt_more
 *
 * @wp-hook excerpt_more
 *
 * @param   integer $length
 * @return  string
 */
function t30_filter_excerpt_more( $length ) {

	global $post;

	$markup = '<p><a href="%s" title="%s" class="more-link">%s</a></p>';
	$link = get_permalink();
	$title_attr = esc_attr( $post->title );
	$title = _x( 'Continue&#160;reading&#160;&#8230;', 'More link text', 't30' ); // hard space + […]
	$output = '&#160;[&#8230;] ';
	$output .= sprintf(
		$markup,
		$link,
		$title_attr,
		$title
	);

	return $output;
}