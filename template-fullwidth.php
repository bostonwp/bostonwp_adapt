<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Full-Width
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>
    <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header>
    <!-- /page-heading -->
    
    <div class="post full-width clearfix">
    <?php the_content(); ?>
    </div>
    <!-- /post -->
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>