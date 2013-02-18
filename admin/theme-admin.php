<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */


/*-----------------------------------------------------------------------------------*/
/* REGISTER Admin */
/*-----------------------------------------------------------------------------------*/
function adapt_theme_settings_init(){
	register_setting( 'adapt_theme_settings', 'adapt_theme_settings' );
}


// add js for admin
function adapt_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}
//add css for admin
function adapt_style() {
	wp_enqueue_style('thickbox');
}
function adapt_echo_scripts()
{
?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
	window.formfield = jQuery('.upload_field',jQuery(this).parent());
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
	if (window.formfield) {
		imgurl = jQuery('img',html).attr('src');
		window.formfield.val(imgurl);
		tb_remove();
	}
	else {
		window.original_send_to_editor(html);
	}
	window.formfield = '';
	window.imagefield = false;
}

});
//]]> 
</script>
<?php
}

if (isset($_GET['page']) && $_GET['page'] == '-settings') {
	add_action('admin_print_scripts', 'adapt_scripts'); 
	add_action('admin_print_styles', 'adapt_style');
	add_action('admin_head', 'adapt_echo_scripts');
}


function adapt_add_settings_page() {
add_theme_page( __( '' ), __( 'Theme Settings' ), 'manage_options', '-settings', 'adapt_theme_settings_page');
}

add_action( 'admin_init', 'adapt_theme_settings_init' );
add_action( 'admin_menu', 'adapt_add_settings_page' );

function adapt_theme_settings_page() {
	
global $slider_effects;
?>


<?php 
/*-----------------------------------------------------------------------------------*/
/* START Admin */
/*-----------------------------------------------------------------------------------*/
?>

<div class="wrap">

<?php
// If the form has just been submitted, this shows the notification
if ( $_GET['settings-updated'] ) { ?>
<div id="message" class="updated fade -message"><p><?php _e('Options Saved',''); ?></p></div>
<?php } ?>

<div id="icon-options-general" class="icon32"></div>
<h2><?php _e( ' Theme' ) ?></h2>

<form method="post" action="options.php">

<?php settings_fields( 'adapt_theme_settings' ); ?>
<?php $options = get_option( 'adapt_theme_settings' ); ?>

<table class="form-table">  

<tr valign="top">
<th scope="row"><?php _e( 'Favicon', 'adapt' ); ?></th>
<td>
<input id="adapt_theme_settings[favicon]" class="regular-text" type="text" size="36" name="adapt_theme_settings[favicon]" value="<?php esc_attr_e( $options['favicon'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="adapt_theme_settings[favicon]"><?php _e( 'Upload or type in the URL for the site favicon.','adapt'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Logo', 'adapt' ); ?></th>
<td>
<input id="adapt_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="adapt_theme_settings[upload_mainlogo]" value="<?php esc_attr_e( $options['upload_mainlogo'] ); ?>" />
<input class="upload_image_button button-secondary" type="button" value="Upload Image" />
<br />
<label class="description abouttxtdescription" for="adapt_theme_settings[logo]"><?php _e( 'Upload or type in the URL for the site logo.','adapt'); ?></label>
</td>
</tr>


<tr valign="top">
<th scope="row"><?php _e( 'Home Recent Work Text', 'adapt' ); ?></th>
<td>
<input id="adapt_theme_settings[recent_work_text]" class="regular-text" type="text" size="36" name="adapt_theme_settings[recent_work_text]" value="<?php esc_attr_e( $options['recent_work_text'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="adapt_theme_settings[recent_work_text]"><?php _e( 'Enter your custom text for the recent work heading.','adapt'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Home Recent News Text', 'adapt' ); ?></th>
<td>
<input id="adapt_theme_settings[recent_news_text]" class="regular-text" type="text" size="36" name="adapt_theme_settings[recent_news_text]" value="<?php esc_attr_e( $options['recent_news_text'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="adapt_theme_settings[recent_news_text]"><?php _e( 'Enter your custom text for the recent work heading.','adapt'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row">Theme Credits</th>
<td><p>The  Theme was created by <a href="http://themeforest.net/user/WPExplorer"><strong>AJ Clarke</strong></a> from <a href="http://www.wpexplorer.com"><strong>WPExplorer.com</strong></a><br />
</p>
</td>
</tr>

<tr valign="top">
<th scope="row">Theme License</th>
<td><p>GPL - Use and abuse. Of course any sort of credit is very much appreciated.</p>
</td>
</tr>

</table>
<p class="submit-changes">
<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
</p>
</form>
</div><!-- END wrap -->

<?php
}
//sanitize and validate
function adapt_options_validate( $input ) {
	global $select_options, $radio_options;
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>