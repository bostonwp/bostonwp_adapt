<?php get_header(); ?>
<?php if (have_posts()) : ?>

<div id="page-heading">
		<?php
        if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
        else :
        $curauth = get_userdata(intval($author));
        endif;
        ?>
        <h1><?php _e('Posts by',''); ?>: <?php echo $curauth->nickname; ?></h1>		
</div>
<!-- END page-heading -->

<div id="post" class="post clearfix">

	<?php // Author Page Description - set invisible for this theme
	/*
	<div class="entry clearfix">
            <?php echo $curauth->user_description; ?>    
	</div>
    <!-- END entry -->
	*/
    ?>
      
	<?php
    // get post entry
	get_template_part('loop', 'entry') ?>    
	<?php
    //get pagination
	if (function_exists("pagination")) { pagination(); } ?>
</div>
<!-- END #post -->
<?php endif; ?>     
<?php get_sidebar(); ?>	   
<?php get_footer(); ?>