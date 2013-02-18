<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
		<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string .'&posts_per_page=10&paged=' . $paged);
		if (have_posts()) : ?>
        
		<header id="page-heading">
			<h1 id="archive-title"><?php _e('Search Results For', 'adapt'); ?>: <?php the_search_query(); ?></h1>
		</header>
		<!-- /page-heading -->
            
		<div id="post" class="post clearfix">
			<?php get_template_part( 'loop' , 'entry') ?>
			<?php pagination(); ?>
		</div>
		<!-- /post  -->
        
		<?php else : ?>
        
        <header id="page-heading">
            <h1 id="archive-title"><?php _e('Search Results For', 'adapt'); ?> "<?php the_search_query(); ?>"</h1>
        </header>
        <!-- /page-heading -->

        <div id="post" class="post clearfix">
            <?php _e('No results found for that query.', 'adapt'); ?>
        </div>
			<!-- /post  -->
            
        <?php endif; ?>
        
<?php get_sidebar(); ?>		  
<?php get_footer(); ?>