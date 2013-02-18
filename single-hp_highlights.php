<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article class="post clearfix">

	<header>
		<h1 class="single-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry clearfix">
		<?php the_content(); ?>
        <div class="clear"></div>
        
        <?php wp_link_pages(' '); ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags">',' , ','</div>'); ?>
        </div>
        <!-- /post-bottom -->
	</div>
	<!-- /entry -->
	<?php comments_template(); ?>
         
</article>
<!-- /post -->

<?php endwhile; ?>
<?php endif; ?>
             
<?php get_sidebar(); ?>
<?php get_footer(); ?>