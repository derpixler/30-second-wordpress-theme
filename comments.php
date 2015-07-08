<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme
 */

if ( ! have_comments() && ! comments_open() )
	return;
?>

<div id="comments" class="comments">

	<?php if ( post_password_required() ) : ?>
		<p class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view any comments.', 't30' ); ?>
		</p>
	<?php
		return;
	endif; // post_password_required

	// comments template
	get_template_part( 'parts/comment', 'commentlist' );

	// Paginated comments. Again.
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )
		get_template_part( 'parts/comment', 'pagination' );

	// Pings with favicons.
	get_template_part( 'parts/comment', 'pingbacklist' );
	?>
</div>

<?php
// comment form.
if ( comments_open() )
	comment_form();
?>