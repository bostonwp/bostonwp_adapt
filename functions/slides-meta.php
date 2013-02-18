<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */

//add slides meta box
add_action('admin_menu', 'adapt_slides_add_box');
function adapt_slides_add_box() {
    global $adapt_slides_meta_box;
    
add_meta_box($adapt_slides_meta_box['id'], $adapt_slides_meta_box['title'], 'adapt_slides_show_box', $adapt_slides_meta_box['page'], $adapt_slides_meta_box['context'], $adapt_slides_meta_box['priority']);
}

// Callback function to show fields in meta box
function adapt_slides_show_box() {
    global $adapt_slides_meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="adapt_slides_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($adapt_slides_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '
', $field['desc'];
                break; 
			case 'upload':
                echo '<input type="text" class="adapt_slides_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="35" style="width:70%" /><input class="upload_image_button" type="button" value="Upload Image" id="button_' . $field['id'] . '" />', '
', $field['desc'];
                break; 
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '
', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}
add_action('save_post', 'adapt_slides_save_data');

// Save data from meta box
function adapt_slides_save_data($post_id) {
    global $adapt_slides_meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['adapt_slides_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($adapt_slides_meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
// slides Options
$slides_prefix = 'slides_';
$adapt_slides_meta_box = array(
    'id' => 'slides-meta',
    'title' => 'Slide Options',
    'page' => 'slides',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'URL',
            'desc' => 'Enter a URL to link this slide to - perfect for linking slides to pages or other sites.',
            'id' => $slides_prefix . 'url',
            'type' => 'text',
            'std' => ''
        ),
    ));
?>