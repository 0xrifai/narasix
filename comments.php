<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title font-meta">
			<?php
			$comments_number = get_comments_number();
			printf(
				/* translators: 1: number of comments, 2: post title */
				esc_html( _nx(
					'There is %1$s comment',
					'There are %1$s comments',
					$comments_number,
					'comments title',
					'narasix'
				) ),
				number_format_i18n( $comments_number )
			);
			?>
		</h2>

		<ol class="comment-list relative">
			<?php
				wp_list_comments( array(
					'avatar_size' => 56,
					'max_depth'   => 5,
					'style'       => 'ol',
					'short_ping'  => true,
					'callback'    => 'comments_helper',
					'reply_text'  => esc_html__( 'Reply', 'narasix' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'narasix' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'narasix' ) . '</span>',
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'narasix' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
