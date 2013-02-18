<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>

<?php get_header(); ?>

<article>

    <header id="page-heading">
        <?php
            $term =	$wp_query->queried_object;
            echo '<h1 class="page-title">'.$term->name.'</h1>';
        ?>		
    </header>
    
    <?php if (have_posts()) : ?>
    
        <div class="post full-width clearfix">
    
            <div id="portfolio-description">
                 <?php echo category_description( ); ?>
            </div> 
            
            <div id="portfolio-wrap" class="clearfix">
            
                <div class="portfolio-content">
                    <?php
                    while (have_posts()) : the_post();
                    //get portfolio thumbnail
                    $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
                    ?>
                    
                    <?php if ( has_post_thumbnail() ) {  ?>
                    <div class="portfolio-item <?php if($count == '4') { echo 'no-margin'; } ?>">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" />
                        <div class="portfolio-overlay"><h3><?php echo the_title(); ?></h3></div><!-- portfolio-overlay -->
                        </a>
                    </div>
                    <?php } ?>
                    
                    <?php endwhile; ?>
                </div>
            </div>
            
            <?php pagination(); ?>
        </div>
        <!-- /post -->
        
	<?php endif; ?>

</article>
<?php get_footer(); ?>