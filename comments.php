<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) {
?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','adapt'); ?></p>
<?php return; } ?>

<!-- You can start editing here. -->
<?php if ( comments_open() ) : ?>
    <div id="commentsbox">
        <h3 id="comments"><span class="awesome-icon-comments"></span><?php _e('This Post Has', 'adapt'); ?> <?php comments_number(__('0 Comments', 'adapt'), __('1 Comment', 'adapt'), __('% Comments', 'adapt') );?></h3>
    
    <?php if ( have_comments()) : ?>
        <ol class="commentlist">
            <?php wp_list_comments('callback=better_comments'); ?>
        </ol>
        <nav class="comment-nav">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </nav>
    <?php endif; ?>
    <?php else :
    // comments are closed ?>
    <?php endif; ?>
    <?php if (comments_open()) : ?>
        <div id="comment-form">
            <div id="respond">
                <h3 id="comments-respond"><?php _e('Leave A Reply','adapt') ?></h3>
                <div class="cancel-comment-reply">
                    <?php cancel_comment_reply_link(); ?>
                </div>
                <!-- /cancel-comment-reply -->
                <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                    <p><?php _e('You must be','adapt'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','adapt'); ?></a><?php _e(' to post a comment.','adapt'); ?></p>
                <?php else : ?>
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <?php if ( is_user_logged_in() ) : ?>
                    <p id="comments-respond-meta"><?php _e('Logged in as','adapt'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','adapt'); ?>"><?php _e('Log out','adapt'); ?> &raquo;</a></p>
                <?php else : ?>
                    <input type="text" name="author" id="author" value="<?php if ($comment_author == '') { echo _e('Username', 'adapt' ); echo '*'; } elseif ($comment_author >= '') { echo $comment_author; } ?>" onfocus="if(this.value=='<?php _e('Username', 'adapt' ); ?>*')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Username', 'adapt' ); ?>*';" size="22" tabindex="1" />
                    <br />
                    <input type="text" name="email" id="email" value="<?php if ($comment_author_email == '') { echo _e('Email', 'adapt' ); echo '*'; } elseif ($comment_author_email >= '') { echo $comment_author_email; } ?>" onfocus="if(this.value=='<?php _e('Email', 'adapt' ); ?>*')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Email', 'adapt' ); ?>*';" size="2" tabindex="2" />
                    <br />
                    <input type="text" name="url" id="url" value="<?php if ($comment_author_url == '') { echo _e('Website', 'adapt' ); } elseif ($comment_author_url >= '') { echo $comment_author_url; } ?>" onfocus="if(this.value=='<?php _e('Website', 'adapt' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Website', 'adapt' ); ?>';" size="2" tabindex="3" />
                    <br />
                <?php endif; ?>
                <textarea name="comment" id="comment" rows="10" tabindex="4"></textarea><br />
                <button type="submit" id="commentSubmit"><?php _e('Submit Comment', 'adapt' ); ?></button>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
                </form>
                <?php
                // registration required and not logged in
                endif; ?>
            </div>
            <!-- /respond -->
		</div>
		<!-- /comment-form -->
	</div>
	<!-- /commentsbox -->
    <?php
	// comments are closed
    else : ?>
<?php endif; ?>