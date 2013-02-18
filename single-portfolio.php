<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>   

<article>
    <header id="page-heading">
        <h1><?php the_title(); ?></h1>
        <nav id="single-nav" class="clearfix"> 
            <?php next_post_link('<div id="single-nav-left">%link</div>', '<span class="awesome-icon-chevron-left"></span> '.__('Newer','adapt').'', false); ?>
            <?php previous_post_link('<div id="single-nav-right">%link</div>', ''.__('Older','adapt').' <span class="awesome-icon-chevron-right"></span>', false); ?>
        </nav>
        <!-- /single-nav --> 
    </header>
    <!-- /page-heading -->
    
    <div id="single-portfolio" class="post full-width clearfix">
        
        <div id="single-portfolio-left">
            <div id="slider-wrap">
                <div class="flexslider clearfix">
                    <ul class="slides">
                    <?php   
                        //attachement loop
                        $args = array(
                            'orderby' => 'menu_order',
                            'post_type' => 'attachment',
                            'post_parent' => get_the_ID(),
                            'post_mime_type' => 'image',
                            'post_status' => null,
                            'posts_per_page' => -1
                        );
                        $attachments = get_posts($args);
                        
                        //start loop
                        foreach ($attachments as $attachment) :
                        
                        //get images
                        $full_img = wp_get_attachment_image_src( $attachment->ID, 'full-size');
                        $portfolio_single = wp_get_attachment_image_src( $attachment->ID, 'portfolio-single');
                        ?>
                            <li><a href="<?php echo $full_img[0]; ?>" title="<?php echo apply_filters('the_title', $attachment->post_title); ?>" <?php if($attachments_count =='1') { echo 'class="prettyphoto-link"'; } else { echo 'rel="prettyPhoto[gallery]"'; } ?>><img src="<?php echo $portfolio_single[0]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" /></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /flex-slider -->
            </div>
            <!-- /slider-wrap -->
        </div>
        <!-- /single-portfolio-left -->
        
        <div id="single-portfolio-right" class="clearfix">
            <?php the_content(); ?>
        </div>
        <!-- /single-portfolio-right -->
        
    </div>
    <!-- /post --> 
</article>
<?php endwhile; ?>
<?php endif; ?>	
<?php get_footer(); ?>