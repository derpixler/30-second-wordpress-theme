<?php
/**
 * The article
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
		 * Include the page meta
		 */
		get_template_part( 'parts/page', 'meta' );
		?>
		<?php do_action( 't30_single_page_header' ); ?>
	</header>
	<main>
		<?php do_action( 't30_single_page_before_content' ); ?>
		<?php the_content(); ?>
		<?php do_action( 't30_single_page_after_content' ); ?>
	</main>
	<footer>
		<?php do_action( 't30_single_page_footer' ); ?>
	</footer>
</article>