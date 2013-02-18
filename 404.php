<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>

<header id="page-heading">
    <h1 class="page-title"><?php _e('404 Error',''); ?></h1>		
</header>
<!-- END page-heading -->

<div class="post clearfix">

<div class="entry clearfix">		
	<p><?php _e('Sorry, the page you were looking for could not be found.',''); ?>.</p>
</div><!-- END entry -->

</div>
<!-- END post -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>