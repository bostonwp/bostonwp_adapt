<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
 
 global $data, $post; //get theme options
?>

<?php
//get custom post type === > Slides
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'order' => 'ASC'
);
$slides = new WP_Query( $args );
//$slides = get_posts($args);
?>
<?php if($slides->have_posts()) { ?>
<div id="slider-wrap">
	<div class="full-slides flexslider clearfix">
		<ul class="slides">
            <?php
            while ( $slides->have_posts() ) : $slides->the_post();
            //foreach($slides as $post) : setup_postdata($post);
			
			//image
            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider');
			
			//meta
            $slidelink = get_post_meta($post->ID, 'adapt_slides_url', TRUE);
			$slide_description = get_post_meta($post->ID, 'adapt_slides_description', TRUE);
            ?>
            	<?php if (has_post_thumbnail()) { ?>
            	<li class="slide">
                <?php if(!empty($slidelink)) { ?>
                    <a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" /></a>
                <?php } else { ?> 
                	<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" />
                <?php } ?>
                <?php if(!empty($slide_description)) { ?>
				<div class="caption">
                    <?php if(!empty($slide_description)) { echo '<p> '. $slide_description .'</p>'; } ?>
				</div>
                <!-- /caption -->
                <?php } ?>
			</li><!--/slide -->
            <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
		</ul><!-- /slides -->
    </div><!--/full-slides -->
</div>
<!-- /slider-wrap -->
<?php } ?>
