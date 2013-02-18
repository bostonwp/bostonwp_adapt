<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Portfolio
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading" class="clearfix">
	<h1><?php the_title(); ?></h1>	
    <?php 
		//get portfolio categories
		$cats = get_terms('portfolio_cats');
		//show filter if categories exist
		if($cats[0]) { ?>
        
        <!-- Portfolio Filter -->
        <ul id="portfolio-cats" class="filter clearfix">
        	<li class="sort"><?php _e('Sort Items',''); ?>:</li>
            <li><a href="#all" rel="all" class="active"><span><?php _e('All', ''); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li><a href="#<?php echo $cat->slug; ?>" rel="<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
	<?php } ?>	 
</header>
<!-- /page-heading -->
    
<div class="post full-width clearfix">

    <div id="portfolio-wrap" class="clearfix">
    	<ul class="portfolio-content">
			<?php
            //get post type ==> portfolio
            query_posts(array(
                'post_type'=>'portfolio',
                'posts_per_page' => -1,
                'paged'=>$paged
            ));
            ?>
        
            <?php
			$count=0;
            while (have_posts()) : the_post();
			$count++;
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            //get terms
            $terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
			$terms_list = get_the_term_list( get_the_ID(), 'portfolio_cats' );
            ?>
            
            <?php if ( has_post_thumbnail() ) {  ?>
            <li data-id="id-<?php echo $count; ?>" data-type="<?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } else { echo 'none'; } ?>" class="portfolio-item">
            	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                	<img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" />
            		<div class="portfolio-overlay"><h3><?php echo the_title(); ?></h3></div><!-- portfolio-overlay -->
            	</a>
            </li>
            <?php } ?>
            
            <?php endwhile; ?>
		</ul>
        <!-- /portfolio-content -->
    </div>
    <!-- /portfolio-wrap -->
    
	<?php wp_reset_query(); ?>

</div>
<!-- /post full-width -->

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>