<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<header id="page-heading">
	<h1><?php _e('Jobs',''); ?></h1>	
	<nav id="single-nav" class="clearfix"> 
		<?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="awesome-icon-chevron-left"></span> '.__('Newer','adapt').'', false); ?>
		<?php previous_post_link('<div id="single-nav-right">%link</div>', ''.__('Older','adapt').' <span class="awesome-icon-chevron-right"></span>', false); ?>
	</nav>
    <!-- /single-nav -->	
</header>

<article class="post clearfix">

	<header>
        <h1 class="single-title"><?php the_title(); ?></h1>
        <div class="post-meta">
            <span class="awesome-icon-calendar"></span><?php _e('On','surplus'); ?> <?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?>
            <span class="awesome-icon-user"></span><?php _e('By', 'surplus'); ?> <?php the_author_posts_link(); ?>
            <span class="awesome-icon-comments"></span><?php WP_Jobs::jobtype_label_for_job() ?>
        </div>
        <!-- /loop-entry-meta -->
    </header>


    <div class="entry clearfix">
      
      <p><?php the_content(); ?></p>
      
		<?php
			$email = get_the_author_meta('user_email');
			$email = str_replace('@', ' at ', $email);
			$email = str_replace('.', ' dot ', $email);			
		?>
            
      <p><a href="/jobs">See all Jobs</a></p>
        <div class="clear"></div>
        
        <?php wp_link_pages(' '); ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags"><span class="awesome-icon-tags"></span>',' , ','</div>'); ?>
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