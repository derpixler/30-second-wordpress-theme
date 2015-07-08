<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
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
			get_template_part( 'parts/page', 'content' );
			comments_template();
			?>
		<?php endwhile; endif; ?>


	</section>

</main>
<?php
get_footer();