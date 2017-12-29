<?php
    if ( post_password_required() ) {
        return;
    }
?>

<div id="comments" class="comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments</h2>

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'callback' => 'mytheme_comment',
					'short_ping'  => true,
					'avatar_size' => 50,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.'); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comments-title">',
			'title_reply_after'  => '</h2>',
			'title_reply'          => 'Leave a Comment',
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" class="input-style" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
			'fields'               => array(
				'author' => '<p class="comment-form-author three-coll">' .
				            '<input id="author" class=input-style name="author" type="text" placeholder="Full Name" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
				'email'  => '<p class="comment-form-email three-coll" ><label for="email">' .
				            '<input id="email" class="input-style" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="Email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
            ),
			'submit_field'         => '<p class="form-submit three-coll">%1$s %2$s</p>',
            'class_submit' => 'btn big pink',
			'label_submit' => 'Send',
		) );
	?>

</div><!-- .comments-area -->
