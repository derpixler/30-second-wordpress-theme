<?php
/**
 * The article
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */
?>

<article class="post" role="article" itemscope itemtype="http://schema.org/Article">
	<header>

	    <h1>
            <a href="<?php the_permalink() ?>">
                <?php the_title(); ?>
            </a>
        </h1>
        
		<?php
		/**
		 * Include the article meta
		 */
		get_template_part( 'parts/article', 'meta' );
		?>
		<?php do_action( 't30_archive_post_header' ); ?>
	</header>
	<main>
		<?php do_action( 't30_archive_post_before_content' ); ?>
		<?php
		/**
		 * Include the article thumbnail
		 */
		get_template_part( 'parts/article', 'thumbnail' );
		?>
		<?php the_excerpt(); ?>
		<?php do_action( 't30_archive_post_after_content' ); ?>
	</main>
	<footer>
		<?php
		/**
		 * Include the article comment count
		 */
		get_template_part( 'parts/article', 'comment-count' );
		?>
		<?php do_action( 't30_archive_post_footer' ); ?>
	</footer>
</article>