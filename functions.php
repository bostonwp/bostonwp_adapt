<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
*/


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) 
    $content_width = 980;



/*-----------------------------------------------------------------------------------*/
/*	Include functions
/*-----------------------------------------------------------------------------------*/
require('admin/theme-admin.php');
require('functions/pagination.php');
require('functions/shortcodes.php');
require('functions/better-comments.php');
require('functions/meta/meta-box-class.php');
require('functions/meta/meta-box-usage.php');


/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/
if (function_exists( 'add_theme_support')) {
	add_theme_support( 'post-thumbnails');
	
	if ( function_exists('add_image_size')) {
		add_image_size( 'full-size',  9999, 9999, false );
		add_image_size( 'slider',  980, 9999, false );
		add_image_size( 'portfolio-single',  550, 9999, false );
		add_image_size( 'small-thumb',  50, 50, true );
		add_image_size( 'grid-thumb',  230, 180, true );
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts','my_theme_scripts_function');
function my_theme_scripts_function() {
	//get theme options
	global $options;
	
	wp_deregister_script('jquery'); 
		wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1');
	wp_enqueue_script('jquery');	
	
	// Site wide js
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js');
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js');
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
	wp_enqueue_script('uniform', get_template_directory_uri() . '/js/jquery.uniform.js');
	wp_enqueue_script('responsify', get_template_directory_uri() . '/js/jquery.responsify.init.js');
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js');
        wp_enqueue_script('jobs-events', get_template_directory_uri() . '/js/events.js');

	//portfolio main
	if(is_page_template('template-portfolio.php')) {
		wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
		wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js');
		wp_enqueue_script('quicksandinit', get_template_directory_uri() . '/js/jquery.quicksandinit.js');
	}
}


/*-----------------------------------------------------------------------------------*/
/*Enqueue CSS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'surplus_enqueue_css');
function surplus_enqueue_css() {
	
	//responsive
	wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', 'style');
	
	//prettyPhoto
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');

	//awesome font - icon fonts
	wp_enqueue_style('awesome-font', get_template_directory_uri() . '/css/awesome-font.css', 'style');
	
}


/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

//Register Sidebars
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => __('Widgets in this area will be shown in the sidebar.','adapt'),
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer One',
		'id' => 'footer-one',
		'description' => __('Widgets in this area will be shown in the first footer area.','adapt'),
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Two',
		'id' => 'footer-two',
		'description' => __('Widgets in this area will be shown in the second footer area.','adapt'),
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Three',
		'id' => 'footer-three',
		'description' => __('Widgets in this area will be shown in the third footer area.','adapt'),
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Four',
		'id' => 'footer-four',
		'description' => __('Widgets in this area will be shown in the fourth footer area.','adapt'),
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));


/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types & Taxonomies
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_post_types' );
function create_post_types() {
	//slider post type
	register_post_type( 'Slides',
		array(
		  'labels' => array(
			'name' => __( 'HP Slides', '' ),
			'singular_name' => __( 'Slide', '' ),		
			'add_new' => _x( 'Add New', 'Slide', '' ),
			'add_new_item' => __( 'Add New Slide', '' ),
			'edit_item' => __( 'Edit Slide', '' ),
			'new_item' => __( 'New Slide', '' ),
			'view_item' => __( 'View Slide', '' ),
			'search_items' => __( 'Search Slides', '' ),
			'not_found' =>  __( 'No Slides found', '' ),
			'not_found_in_trash' => __( 'No Slides found in Trash', '' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'slides' ),
		)
	  );

	//portfolio post type
	register_post_type( 'Portfolio',
		array(
		  'labels' => array(
			'name' => __( 'Portfolio', '' ),
			'singular_name' => __( 'Portfolio', '' ),		
			'add_new' => _x( 'Add New', 'Portfolio Project', '' ),
			'add_new_item' => __( 'Add New Portfolio Project', '' ),
			'edit_item' => __( 'Edit Portfolio Project', '' ),
			'new_item' => __( 'New Portfolio Project', '' ),
			'view_item' => __( 'View Portfolio Project', '' ),
			'search_items' => __( 'Search Portfolio Projects', '' ),
			'not_found' =>  __( 'No Portfolio Projects found', '' ),
			'not_found_in_trash' => __( 'No Portfolio Projects found in Trash', '' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'portfolio' ),
		)
	  );
}


// Add taxonomies
add_action( 'init', 'create_taxonomies' );

//create taxonomies
function create_taxonomies() {
	
// portfolio taxonomies
	$cat_labels = array(
		'name' => __( 'Portfolio Categories', '' ),
		'singular_name' => __( 'Portfolio Category', '' ),
		'search_items' =>  __( 'Search Portfolio Categories', '' ),
		'all_items' => __( 'All Portfolio Categories', '' ),
		'parent_item' => __( 'Parent Portfolio Category', '' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', '' ),
		'edit_item' => __( 'Edit Portfolio Category', '' ),
		'update_item' => __( 'Update Portfolio Category', '' ),
		'add_new_item' => __( 'Add New Portfolio Category', '' ),
		'new_item_name' => __( 'New Portfolio Category Name', '' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', '' )
	); 	

	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => true,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));
}


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Cat Pagination
/*-----------------------------------------------------------------------------------*/

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $option_posts_per_page;
	
    if ( is_tax( 'portfolio_cats') ) {
        return 12;
    }
	else {
        return $option_posts_per_page;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Other functions
/*-----------------------------------------------------------------------------------*/

// Limit Post Word Count
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_length($length) {
	return 40;
}

//Replace Excerpt Link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
       global $post;
	return '...';
}

//custom excerpts
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}

// Enable Custom Background
add_custom_background();

// register navigation menus
register_nav_menus(
	array(
	'menu'=>__('Menu'),
	)
);

/// add home link to menu
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

// menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}


// Localization Support
load_theme_textdomain( '', TEMPLATEPATH.'/lang' );

//create featured image column
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs', 'powered');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'small-thumb' );
    }
}

// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
/*
* Only fetch job posts within the last X days
*/
function bostonwp_jobs_timeframe($where = '') {
   $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
   return $where;
}
/*
* Returns the latest published post object
*/
function bostonwp_get_latest_post() {
   $args = array(
      'post_type' => 'post',
      'showposts' => 1,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
   );
   $query = new WP_Query($args);
   if ($query->post_count > 0) {
      return $query->posts[0];
   }
   
   return false;
}

/*
* Returns the latest forum thread posted via bbPress
*/
function bostonwp_get_latest_thread() {
   global $wpdb;
   // hardcoded query for now/not very clean - need to figure out how to better integrate bbPress
   if ($topic = $wpdb->get_row("SELECT * FROM bb_topics WHERE topic_status < 1 ORDER BY topic_time DESC LIMIT 1")) {
      return $topic;
   }
   
   return false;
}
/*
* Returns the latest job post using the custom "Job" content type
*/
function bostonwp_get_latest_job() {
   $args = array(
      'post_type' => 'job',
      'showposts' => 1,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
   );
   $query = new WP_Query($args);
   if ($query->post_count > 0) {
      return $query->posts[0];
   }
   
   return false;
}

/*
* Returns the latest Boston WordPress Meetup via the group's upcoming calendar feed on Meetup.com
*/
function bostonwp_get_latest_meetup() {
        include_once(ABSPATH . WPINC . '/feed.php');
        $rss = fetch_feed('http://meetup.bostonwp.org/calendar/rss/The+Boston+WordPress+Meetup+Group/');
        if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
            // Figure out how many total items there are, but limit it to 5. 
            $maxitems = $rss->get_item_quantity(1); 

            // Build an array of all the items, starting with element 0 (first element).
            $rss_items = $rss->get_items(0, $maxitems); 
        endif;
        foreach ( $rss_items as $item ) : 
            $event = array (
			'title' => $item->get_title(),
			'desc' => $item->get_description(),
			'guid' => $item->get_permalink(),
			'date' => $item->get_date('j F Y | g:i a')
		);
            break;
        endforeach;
        
//	$doc = new DOMDocument();
//	$doc->load('http://meetup.bostonwp.org/calendar/rss/The+Boston+WordPress+Meetup+Group/');
//	$event = array();
//	foreach ($doc->getElementsByTagName('item') as $node) {
//		$event = array (
//			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
//			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
//			'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
//			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
//		);
//		break;
//	}
	if ( ! empty($event)) {
	   return $event;
	}
	
	return false;
}
/*
* Adds additional user profile fields
*/
function bostonwp_add_profile_fields($user) {
   ?>
   <h3>Jobs</h3>
 
   <table class="form-table">
      <tr>
      <th><label for="job_notifs">New job notifications</label></th>
      <td>
         <?php $checked = (esc_attr( get_the_author_meta( 'job_notifs', $user->ID )) == '1') ? 'checked="checked"' : ''; ?>
         <input name="job_notifs" type="checkbox" id="job_notifs" value="true" <?php echo $checked ?>/> 
         Email me new job postings once per week
      </td>
      </tr>
   </table>
   <?php
}
add_action('show_user_profile', 'bostonwp_add_profile_fields');
add_action('edit_user_profile', 'bostonwp_add_profile_fields');

/*
* Updates user profile with additional fields
*/
function bostonwp_save_profile_fields($user_id) {
   if ( ! current_user_can('edit_user', $user_id)) return false;
   update_usermeta($user_id, 'job_notifs', (isset($_POST['job_notifs']) && ! empty($_POST['job_notifs']) ? true : false));
}
add_action('personal_options_update', 'bostonwp_save_profile_fields');
add_action('edit_user_profile_update', 'bostonwp_save_profile_fields');

/*
* Handy debug function for dumping PHP variables to a web browser
*/
function bostonwp_dump(&$variable) {
   ?>
      <div id="bostonwp_dump" style="background:#eee; border:1px solid #999; padding:10px;">
         <pre><?php var_dump($variable) ?></pre>
      </div>
   <?php
}

/*
* Add 'weekly' cron schedule option
*/
function bostonwp_add_cron_weekly() {
	return array(
		'weekly' => array('interval' => 604800, 'display' => 'Once Weekly')
	);
}
add_filter('cron_schedules', 'bostonwp_add_cron_weekly');

/*
* Schedules weekly job notification event
*/
add_action('bostonwp_weekly_job_notif', 'bostonwp_send_job_notif_email');

function bostonwp_schedule_weekly_job_notif() {
	if ( ! wp_next_scheduled( 'bostonwp_weekly_job_notif' ) ) {
		wp_schedule_event(time(), 'weekly', 'bostonwp_weekly_job_notif');
	}

	// disable the event (for debugging)
	/*
	if (wp_next_scheduled( 'bostonwp_weekly_job_notif' ) ) {
		$timestamp = wp_next_scheduled( 'bostonwp_weekly_job_notif' );
		wp_unschedule_event($timestamp, 'bostonwp_weekly_job_notif');
	}
	*/
}

add_action('wp', 'bostonwp_schedule_weekly_job_notif');

function bostonwp_send_job_notif_email() {
	
	global $wpdb;

	$newjobs = $wpdb->get_results("
		SELECT post_title, post_name, post_date
		FROM wp_posts
		WHERE post_status = 'publish' 
			AND post_type = 'job' 
		   AND post_date > '" . date('Y-m-d', strtotime('-8 days')) . "'
	", ARRAY_A);

	if ( ! $newjobs) return false;
	
	$subscribers = $wpdb->get_col("
		SELECT wp_users.user_email AS email FROM wp_users
		JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID
		WHERE wp_usermeta.meta_key = 'job_notifs' AND wp_usermeta.meta_value = 1
	");

	if ( ! $subscribers) return false;

	$batches = array_chunk($subscribers, 10);

	// send out job notification emails in batches, Bcc'ing recipients to hide their email addrs
	foreach($batches as $batch) {
	   $headers = "From: Boston WordPress <admin@bostonwp.org>\r\n"
			. "Bcc: " . implode(',', $batch) . "\r\n";
	   $message = "New jobs have been posted to the Boston WordPress Job Board in the past 8 days:\n\n";

		foreach($newjobs as $job) {
			$message .= " - {$job['post_title']}\n"
				. date('F, jS', strtotime($job['post_date'])) . "\n"
				. "http://bostonwp.org/jobs/{$job['post_name']}/\n\n";
		}

		$message .= "You are receiving this message because you opted into receiving new job notifications from bostonwp.org.\n"
			. "To STOP receiving these messages, update your profile at: http://bostonwp.org/wp-admin/profile.php\n"
			. "If you are having trouble, please email admin@bostonwp.org\n";

	   wp_mail('admin@bostonwp.org', 'Boston WordPress Weekly Jobs', $message, $headers);

		sleep(mt_rand(60, 180)); // delay next batch between 1-3 minutes
	}
}
add_theme_support( 'bbpress' );
?>