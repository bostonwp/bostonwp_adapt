<?php
while (have_posts()) : the_post();
//get featured img
$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
?>  

<article class="loop-entry clearfix">
	<?php if($feat_img) { ?>
    	<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
	<?php } ?>
	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <?php
	//show meta only on blog posts
    if ( get_post_type() != 'page' || get_post_type() != 'portfolio') { ?>
	<div class="loop-entry-meta">
        <span class="awesome-icon-calendar"></span><?php _e('On','surplus'); ?> <?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?>
        <span class="awesome-icon-user"></span><?php _e('By', 'surplus'); ?> <?php the_author_posts_link(); ?>
        <span class="awesome-icon-comments"></span><?php _e('With', 'surplus'); ?>  <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
    </div>
    <!-- /loop-entry-meta -->
    <?php } ?>
	<?php the_excerpt(''); ?>
</article>
<!-- loop-entry -->

<?php endwhile; ?>