<?php
/**
 * Feature Name:    General template stuff for 30 Second WordPress Theme-Theme
 * Version:         1
 * Author:          Rene Reimann
 * Author URI:      www.rene-reimann.de
 */

/**
 * Gets the logo
 *
 * @return  string
 */
function t30_get_logo() {

	// register the pre filter to bypass this function
	$pre = apply_filters( 'pre_t30_get_logo', FALSE );
	if ( $pre !== FALSE )
		return $pre;

	// set the default logo
	$default = '<h1 class="logo"><a href="' . get_bloginfo( 'url' ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';

	// return string, by adding the default markup to the filter
	return apply_filters( 't30_get_logo', $default );
}

/**
 * Adds the current blogname to the title
 *
 * @wp-hook wp_title
 *
 * @param   string $title
 * @param   string $sep
 * @param   string $seplocation
 * @return  string
 */
function t30_filter_wp_title( $title, $sep, $seplocation ) {

	// return just the blogname if there is
	// no title to display
	if ( empty( $title ) )
		return get_bloginfo( 'name' );

	// check the seperator location to build
	// the new title
	if ( $seplocation == 'right' )
		return $title . get_bloginfo( 'name' );
	else
		return get_bloginfo( 'name' ) . $title;
}

/**
 * Adds a standard bodyclass to the css-class
 * declaration in the tag <body>
 *
 * @wp-hook body_class
 *
 * @param   array $classes
 * @param   string $class
 * @return  array
 */
function t30_filter_body_class( $classes, $class ) {

	if ( ! in_array( 't30-body', $classes ) )
		$classes[] = 't30-body';

	return $classes;
}

/**
 * Displays the favicon
 *
 * @wp-hook wp_head
 *
 * @return  void
 */
function t30_the_favicon() {
	echo t30_get_favicon();
}

/**
 * gets the favicon markup
 *
 * @return  string
 */
function t30_get_favicon() {

	// the favicon name
	$favicon_name = 'favicon.ico';

	// setting the possible directories
	$asset_dir          = '/assets/img/';
	$child_theme_dir    = get_stylesheet_directory() . $asset_dir;
	$parent_theme_dir   = get_template_directory() . $asset_dir;

	// getting the favicon_uri
	$favicon_uri = '';
	if ( file_exists( $child_theme_dir . $favicon_name ) )
		$favicon_uri = get_stylesheet_directory_uri();
	else if ( file_exists( ( $parent_theme_dir . $asset_dir ) ) )
		$favicon_uri = get_template_directory_uri();

	$markup = '';
	if ( $favicon_uri !== '' )
		$markup = '<link rel="shortcut icon" href="' . $favicon_uri . $asset_dir . $favicon_name . '">';

	return apply_filters( 't30_get_favicon', $markup, $favicon_uri, $asset_dir, $favicon_name );
}

/**
 * Theme info.
 *
 * @return string
 */
function t30_get_theme_info() {

	$theme_data = wp_get_theme( get_template() );

	$author_uri = $theme_data->get( 'AuthorURI' );
	$author     = $theme_data->get( 'Author' );

	$link =  sprintf(
		_x( 'A %1$s Theme', 'Theme author link', 't30' ),
		'<a href="' . $author_uri . '" rel="designer">' . $author . '</a>'
	);

	$markup = sprintf(
		'<p class="mp-site-info">&#169; %1$s %2$s',
		date( 'Y' ),
		$link
	);

	return apply_filters( 't30_get_theme_info', $markup, $author_uri, $author );
}

/**
 * Building the Breadcrumbs
 *
 * @since   0.1
 *
 * @param   Array $args
 * @return  String
 */
function t30_get_breadcrumbs( Array $args = array() ){
	global $paged;

	$default_args = array(
		'before'            => '<nav id="site-breadcrumbs" class="clearfix" xmlns:v="http://rdf.data-vocabulary.org/#">',
		'after'             => '</nav>',
		'standard'          => '<span typeof="v:Breadcrumb">%s</span>',
		'current'           => '<span typeof="v:Breadcrumb" class="current-breadcrumb">%s</span>',
		'link'              => '<a href="%s" rel="v:url"><span property="v:title">%s</span></a>&nbsp;/&nbsp;',
		'show_home_link'    => true,
		'home_text'         => _x( 'Home', 'Breadcrumb Home Text', 't30' )
	);

	// pre-filter
	$rtn = apply_filters( 'pre_t30_get_breadcrumbs', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	// merging the args and arg-filter
	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 't30_get_breadcrumbs_args', $args );

	// init the breadcrumb-array
	$breadcrumbs = array();

	// filling up the breadcrumbs, when we're not on the home- or front-page
	if ( !is_home() && !is_front_page() ) {

		if ( is_tax() || is_category() || is_tag() ) {  // taxonomy archives
			// on custom tax, category or tag pages we've the same logic

			$term       = get_queried_object();
			$term_id    = $term->term_id;

			// fetching the parents
			$parent_id = (int)$term->parent;
			if ( $parent_id !== 0 ) {

				while ( $parent_id !== 0 ){

					$parent_term = get_term( $parent_id, $term->taxonomy );

					if ( is_wp_error( $parent_term ) )
						break;

					// insert on first position
					array_unshift(
						$breadcrumbs,
						array(
							'title'     => $parent_term->name,
							'link'      => get_term_link( $parent_term->term_id, $parent_term->taxonomy )
						)
					);

					$parent_id = (int)$parent_term->parent;

				}

			}

			// adding the current term
			$breadcrumbs[] = array(
				'title'     => $term->name,
				'link'      => get_term_link( $term )
			);

		}
		else if ( is_day() ) {           // day-archive

			$year   = get_the_time( 'Y' );
			$month  = get_the_time( 'm' );
			$day    = get_the_time( 'd' );

			// year link
			$breadcrumbs[] = array(
				'link'  => get_year_link( $year ),
				'title' => get_the_time( 'Y' )
			);

			// month link
			$breadcrumbs[] = array(
				'link'  => get_month_link( $year, $month ),
				'title' => get_the_time( 'F' )
			);

			// day link
			$breadcrumbs[] = array(
				'title'     => $day,
			    'link'      => get_day_link( $day, $month, $year )
			);

		}
		else if ( is_month() ) {         // month-archive

			$year   = get_the_time( 'Y' );
			$month  = get_the_time( 'm' );

			// year link
			$breadcrumbs[] = array(
				'link'  => get_year_link( $year ),
				'title' => $year
			);

			// month link
			$breadcrumbs[] = array(
				'title'     => get_the_time( 'F' ), // month-name
				'link'      => get_month_link( $year, $month ),
			);

		}
		else if ( is_year() ) {			// year-archive

			$year   = get_the_time( 'Y' );

			// year link
			$breadcrumbs[] = array(
				'title'     => $year,
				'link'      => get_year_link( $year )
			);

		}
		else if ( is_attachment() ) {       // attachment-page

			$breadcrumbs[] = array(
				'title'     => get_the_title(),
			    'link'      => get_permalink()
			);

		}
		else if ( is_singular()  ) {        // single-page

			// fetching the hierarchical taxonomy to the current post_type()
			$filter = array(
				'hierarchical'      => TRUE,
				'show_in_nav_menus' => TRUE
			);
			$the_post_type  = get_post_type();
			$taxonomies     = get_object_taxonomies(
				$the_post_type,
				'objects'
			);
			$taxonomies     = wp_list_filter(
				$taxonomies,
				$filter
			);
			$taxonomies = array_values( $taxonomies );

			// checking for taxonomies in this post_type
			if ( !empty( $taxonomies ) ) {

				// get the first taxonomy
				$taxonomy   = $taxonomies[ 0 ]->name;

				// get the post id
				$post_id    = get_the_ID();

				// get all terms
				$terms =  wp_get_post_terms(
					$post_id,
					$taxonomy
				);

				if ( !is_wp_error( $terms ) && ! empty( $terms ) ) {

					// get all ancestor-terms
					$ancestors = get_ancestors(
						$terms[0]->term_id,
						$taxonomy
					);

					if( !is_wp_error( $ancestors ) && !empty( $ancestors ) ) {

						foreach( $ancestors as $term_id ) {

							$term = get_term( $term_id, $taxonomy );

							$term_link = get_term_link(
								$term->term_id,
								$taxonomy
							);

							$breadcrumb = array(
								'title' => $term->name,
								'link'  => $term_link
							);

							array_unshift(
								$breadcrumbs,
								$breadcrumb
							);

						}
					}

					$term_link = get_term_link(
						$terms[ 0 ]->term_id,
						$taxonomy
					);
					$breadcrumbs[] = array(
						'title' => $terms[ 0 ]->name,
						'link'  => $term_link
					);

				}

			}

			// last but not least, adding the current single-site
			$breadcrumbs[] = array(
				'title'     => get_the_title(),
			    'link'      => get_permalink()
			);

		}
		else if ( is_search() ) {    // search

			$search_text    = __( 'Search for: %s', 't30' );
			$search_query   = get_search_query();
			$title          = sprintf( $search_text, $search_query );

			$breadcrumbs[] = array(
				'title'     => $title,
			    'link'      => get_search_link()
			);

		}
		else if ( is_author() ) {    // author page
			global $author;

			$user_data = get_userdata( $author );

			$title = sprintf(
				_x( 'Author: %s', 'breadcrumb nav item', 't30' ),
				$user_data->display_name
			);

			$breadcrumbs[] = array(
				'title'     => $title,
			    'link'      => get_author_posts_url( $user_data->ID, $user_data->user_nicename )
			);

		}
		else if ( is_404() ) {       // 404 page

			$breadcrumbs[] = array(
				'title'     => _x( 'Error: Page does not exist.', 'breadcrumb nav item', 't30' )
			);

		}
	}


	$show_on_front  = get_option( 'show_on_front' );
	$page_on_front  = get_option( 'page_on_front' );

	// first    _> checking if woo exists
	// second   -> checking if not "shop" is set as static front_page
	// third    -> checking if we're on "shop" || in a "shop-category" || on "single product"
	if( class_exists( 'WooCommerce' ) && $page_on_front !== wc_get_page_id( 'shop' ) && ( is_shop() || is_product_taxonomy() || is_product() ) ){
		// adding the "shop"-Link to our breadcrumb, when "shop" is not the static front page
		$page_id = wc_get_page_id( 'shop' );

		$breadcrumb = array(
			'title'     => get_the_title( $page_id ),
			'link'      => get_permalink( $page_id ),
		);

		array_unshift(
			$breadcrumbs,
			$breadcrumb
		);

	}
	else if( $show_on_front === 'page' && !is_page() && get_post_type() === 'post' ) {
		// otherwise, check if we have set a static "page" as front page, than we have to add "blog" to our Breadcrumb
		$page_id = get_option( 'page_for_posts' );

		$breadcrumb = array(
			'title'     => get_the_title( $page_id ),
			'link'      => get_permalink( $page_id ),
		);

		array_unshift(
			$breadcrumbs,
			$breadcrumb
		);

	}

	// adding the home_link if we activated it
	if ( (bool)$args[ 'show_home_link' ] ){

		$breadcrumb = array(
			'title' => $args[ 'home_text' ],
			'link'  => home_url( '/' )
		);

		array_unshift(
			$breadcrumbs,
			$breadcrumb
		);

	}


	// last but no least...adding the Page-Number to Breadcrumb
	if( is_paged() ){

		$title = sprintf(
			__( 'Page %s', 't30' ),
			$paged
		);

		$breadcrumbs[] = array(
			'title'     => $title,
			'link'      => get_pagenum_link( $paged )
		);
	}

	// building the markup
	$markup = $args[ 'before' ];

	$breadcrumb_count = count( $breadcrumbs ) - 1;
	foreach( $breadcrumbs as $k => $breadcrumb ) {

		// the last one is the current one!
		if( $k === $breadcrumb_count ){

			$markup .= sprintf(
				$args[ 'current' ],
				$breadcrumb[ 'title' ]
			);

		}
		else if( isset( $breadcrumb[ 'link' ] ) ){

			$link = sprintf(
				$args[ 'link' ],
				$breadcrumb[ 'link' ],
				$breadcrumb[ 'title' ]
			);

			$markup .= sprintf(
				$args[ 'standard' ],
				$link
			);

		}

	}

	$markup .= $args[ 'after' ];

	return apply_filters( 't30_get_breadcrumbs', $markup, $args, $breadcrumbs );
}

/**
 * Echos the Share Links for our Posts
 *
 * @param   array $args
 *
 * @return  string
 */
function t30_the_social_share_links() {
	echo t30_get_social_share_links();
}

/**
 * Building the Share Links for our Posts
 *
 * @param   array $args
 *
 * @return  string
 */
function t30_get_social_share_links( Array $args = array() ){

	$default_args = array(
		'before'        => '<aside class="social-share">',
		'after'         => '</aside>',
		'before_link'   => '',
		'after_link'    => '',
		'link'          => '<a href="%1$s" title="%2$s"><i class="fa %3$s"></i></a>',
		'networks'      => array(
			array(
				'name'	=> 'google+',
				'link'	=> '//plusone.google.com/_/+1/confirm?hl=de&url=%s',
				'class'	=> 'fa-google-plus'
			),
			array(
				'name'	=> 'facebook',
				'link'	=> '//www.facebook.com/sharer.php?u=%s',
				'class'	=> 'fa-facebook'
			),
			array(
				'name'	=> 'twitter',
				'link'	=> '//twitter.com/share?url=%s',
				'class'	=> 'fa-twitter'
			),
		)
	);

	$rtn = apply_filters( 'pre_t30_get_social_share_links', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 't30_get_social_share_links_args', $args );

	$the_permalink = get_permalink();

	$markup = $args[ 'before' ];
	foreach ( $args[ 'networks' ] as $network ) {

		$link   = sprintf( $network[ 'link' ], $the_permalink );
		$title  = sprintf(
			_x( 'Share on %s', 'The Share-Link in t30_get_social_share_links', 't30' ),
			ucfirst( $network[ 'name' ] )
		);
		$class = $network[ 'class' ];

		$markup .= $args[ 'before_link' ];
		$markup .= sprintf(
			$args[ 'link' ],
			$link,
			$title,
			$class
		);
		$markup .= $args[ 'after_link' ];
	}

	$markup .= $args[ 'after' ];

	return apply_filters( 't30_get_social_share_links', $markup, $args );
}

