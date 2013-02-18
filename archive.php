<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>

<header id="page-heading">
	<?php $post = $posts[0]; ?>
	<?php if (is_category()) { ?>
	<h1><?php single_cat_title(); ?></h1>
	<?php } elseif( is_tag() ) { ?>
	<h1>Posts Tagged &quot;<?php single_tag_title(); ?>&quot;</h1>
	<?php  } elseif (is_day()) { ?>
	<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php  } elseif (is_month()) { ?>
	<h1>Archive for <?php the_time('F, Y'); ?></h1>
	<?php  } elseif (is_year()) { ?>
	<h1>Archive for <?php the_time('Y'); ?></h1>
	<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1>Blog Archives</h1>
	<?php } ?>
</header>
<!-- END page-heading -->

<div id="post" class="post clearfix">   
	<?php get_template_part( 'loop' , 'entry') ?>                	     
	<?php pagination(); ?>
</div>
<!-- END post -->
<?php endif; ?>
<?php get_sidebar(); ?>	  
<?php get_footer(); ?>