<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<?php get_header(); ?>

<div class="home-wrap clearfix">
    
    <!-- Homepage tagline -->
    <?php if(get_bloginfo('description')) { ?>
    <aside id="home-tagline">
    	<?php echo bloginfo('description'); ?>
    </aside>
    <!-- /home-tagline -->
    <?php } ?>
    
    <!-- /Homepage Slider -->
    <?php get_template_part( 'includes/slides' ); ?>       
    
    
    <section id="home-highlights" class="clearfix">
        <?php
        get_template_part('home-highlights');
        ?>
    </section>
    <!-- /home-projects -->      	
    
    
    <!-- Recent Portfolio Items -->
    <?php
    //get post type ==> portfolio
        global $post;
        $args = array(
            'post_type' =>'portfolio',
            'numberposts' => '4'
        );
        $portfolio_posts = get_posts($args);
    ?>
    <?php if($portfolio_posts) { ?>        
        <section id="home-projects" class="clearfix">
            <h2 class="heading"><span><?php if(!empty($options['recent_work_text'])) { echo $options['recent_work_text']; } else { _e('Recent Work','adapt'); }?></span></h2>
        
            <?php
            $count=0;
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            ?>
            
            <?php if ($feat_img) {  ?>
            <div class="portfolio-item <?php if($count == '4') { echo 'remove-margin'; } if($count == '3') { echo ' responsive-clear'; } ?>">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                <div class="portfolio-overlay"><h3><?php echo the_title(); ?></h3></div><!-- portfolio-overlay -->
                </a>
            </div>
            <!-- /portfolio-item -->
            <?php } ?>
            
            <?php
            if($count == '4') { echo '<div class="clear"></div>'; $count=0; }
            endforeach; ?>
        </section>
        <!-- /home-projects -->      	
    <?php } ?>
    
    
    <!-- Recent Blog Posts -->
    <?php
    //get post type ==> regular posts
        global $post;
        $args = array(
            'post_type' =>'post',
            'numberposts' => '4'
        );
        $blog_posts = get_posts($args);
    ?>
    <?php if($blog_posts) { ?>        
        <section id="home-posts" class="clearfix">
            <h2 class="heading"><span><?php if(!empty($options['recent_work_text'])) { echo $options['recent_news_text']; } else { _e('Recent News','adapt'); }?></span></h2>
            <?php
            $count=0;
            foreach($blog_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            ?>
            
            
            <article class="home-entry <?php if($count == '4') { echo 'remove-margin'; } if($count == '3') { echo ' responsive-clear'; } ?>">
            	<?php if ($feat_img) {  ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                <?php } ?>
                <div class="home-entry-description">
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h3>
                    <?php echo excerpt('15'); ?>
                </div> 
                <!-- /home-entry-description -->
            </article>
            <!-- /home-entry-->
            <?php
            if($count == '4') { echo '<div class="clear"></div>'; $count=0; }
            endforeach; ?>
        </section>
        <!-- /home-posts -->      	
    <?php } ?>

</div>
<!-- END home-wrap -->   
<?php get_footer(); ?>