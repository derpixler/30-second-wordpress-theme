<?php
/**
 * The attachment
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */
?>

<article>
	<header>
		<?php the_title(); ?>
		<?php
		/**
		 * Include the article meta
		 */
		get_template_part( 'parts/attachment', 'meta' );
		?>
		<?php do_action( 't30_single_attachment_header' ); ?>
	</header>
	<main>
		<?php do_action( 't30_single_attachment_before_content' ); ?>
		<?php the_content(); ?>
		<?php do_action( 't30_single_attachment_after_content' ); ?>
	</main>
	<footer>
		<?php do_action( 't30_single_attachment_footer' ); ?>
	</footer>
</article>