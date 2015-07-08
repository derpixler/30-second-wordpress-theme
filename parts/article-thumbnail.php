<?php
/**
 * The article thumbnail
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'post-thumbnail' ); ?>
	</div>
<?php endif; ?>