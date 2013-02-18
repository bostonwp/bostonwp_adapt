<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<?php get_header(); ?>

<?php get_header(); ?>

<?php
global $wp_query;
add_filter('posts_where', 'bostonwp_jobs_timeframe');
query_posts($wp_query->query);
?>

<?php if (have_posts()) : ?>

    <header id="page-heading">
        <h1>Jobs Archives</h1>
    </header>
    <!-- END page-heading -->

    <div id="post" class="post clearfix">   
        <table style="font-size:14px" id="jobs">
            <thead>
            <th>Posted</th>
            <th>Title</th>
            <th>Type</th>
            </thead>
            <tbody>
                <?php while (have_posts()) : the_post(); ?>
                    <?php global $post; ?>
                    <?php
                    //$job_categories = WP_Jobs::get_categories_for_job($post);
                    $job_type = WP_Jobs::get_type_for_job($post);
                    ?>
                    <tr class="job <?php echo strtolower(WP_Jobs::get_type_for_job($post)); ?>">
                        <td class="date"><?php the_time('F j, Y'); ?></td>
                        <td class="title">
                            <?php WP_Jobs::new_label_for_job($post); ?>
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </td>
                        <td class="type">
                            <?php WP_Jobs::jobtype_label_for_job($post); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody></table>
    </div>
<?php else : ?>
    <div id="post" class="post clearfix">   
        <p>There are <b>no active jobs</b> at this time. Check back soon!
    </div>
<?php endif; ?>
<?php get_sidebar(); ?>	  
<?php get_footer(); ?>