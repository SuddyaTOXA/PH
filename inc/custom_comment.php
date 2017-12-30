<?php
function mytheme_comment($comment, $args, $depth) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
    <<?php echo $tag;?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
	<?php
	if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body <?php if ( $comment->comment_approved == '0' ) { echo 'awaiting-moderation'; } ?>"><?php
	}
	?>
    <div class="comment-author-box">
        <div class="comment-author-img vcard">
            <?php
                if ( $args['avatar_size'] != 0 ) {
                    echo get_avatar( $comment, $args['avatar_size'] );
                }
            ?>
        </div>
    </div>
    <div class="comment-box">
        <div class="comment-info-box">
            <?php printf( __( '<span class="comment-author">%s</span>' ), get_comment_author_link() ); ?>
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                    printf(
                        __('%1$s'),
                        get_comment_date('j F Y')
    //                    get_comment_time()
                    ); ?>
                </a><?php
                edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
            </div>
        </div>
        <div class="comment-content-box">
            <?php
                if ( $comment->comment_approved == '0' ) { ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><?php
                }
                comment_text();
            ?>
        </div>

        <div class="reply"><?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); ?>
        </div>
    </div>
	<?php
	if ( 'div' != $args['style'] ) { ?>
        </div><?php
	}
}


