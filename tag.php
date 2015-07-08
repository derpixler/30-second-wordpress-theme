<?php
/**
 * The template for displaying Tag pages
 * Used to display archive-type pages for posts in a tag.
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme
 */

get_header();
?>
<main id="primary">
		
	<section id="main" class="row">
		
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php
			/**
			  * Include a template part specific to the Post Format.
			  *
			  * @link http://codex.wordpress.org/Post_Formats
			  */
			get_template_part( 'parts/archive', 'content' );
			?>
		<?php endwhile; endif; ?>


	</section>

</main>
<?php
get_footer();