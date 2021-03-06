<?php
/**
 * The attachment meta
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */
?>

<div class="entry-meta">
	<?php
	// the author
	printf( '<strong itemprop="author">%s</strong> / ', get_the_author() );

	// the time
	printf( '<time itemprop="datePublished" datetime="%s">%s</time>', esc_attr( get_the_date( 'c' ) ), get_the_date() );
	?>
</div>