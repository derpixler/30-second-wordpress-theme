<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme
 */

get_header();
?>
<main id="primary">
		
	<section id="main" class="row">
		
		
		<article>
			<header>
				<h2><?php _e( '404 - Page not found!', 't30' ); ?></h2>
			</header>
			<main>
				<p><?php _e( 'Sorry, the page you are looking for does not exist. If you think, that this is a sirious problem, please contact us. Elsewise you may want to use our search?', 't30' ); ?></p>
			</main>
			<footer>
				<?php get_search_form(); ?>
			</footer>
		</article>


	</section>

</main>
<?php
get_footer();