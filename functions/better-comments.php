<?php
function better_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">

                <div class="comment-details">
                
	        		<div class="comment-avatar">
						<?php echo get_avatar($comment, $size = '45'); ?>
	                </div>
         
                    <div class="comment-content">
                    
	                    <div class="comment-author vcard">
							<span><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></span>
	                    </div>
	                    <div class="comment-meta commentmetadata">
	                    	<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'adapt'), get_comment_date(),  get_comment_time()) ?></a> - <span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
	                    </div>
	                    <!-- END comment-meta commentmetadata -->
	                    
	                    <?php comment_text() ?>
                        
						<?php if ($comment->comment_approved == '0') : ?>
	                    	<p class="comment-waiting-moderation">* <?php _e('Your comment is awaiting moderation.','adapt') ?></p>
	                    <?php endif; ?>
                    
                    </div>
                    
				</div>
                <!-- END comment-details -->
		</article>
        <!-- END comment -->
<?php
}
?>