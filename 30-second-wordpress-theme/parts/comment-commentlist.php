<?php
/**
 * Comments template
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */

// We have comments, but the comment form has been closed.
if ( ! comments_open() && (int) get_comments_number() !== 0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 't30' ); ?></p>
<?php } ?>

<ol class="commentlist">
	<?php
	wp_list_comments( array(
		'type'	   => 'comment',
		'style'	   => 'ul',
		'callback' => 't30_the_comment'
	) );
	?>
</ol>
