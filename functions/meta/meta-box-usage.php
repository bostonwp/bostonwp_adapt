<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'adapt_';

$adapt_meta_boxes = array();

// meta box ===> Slides
$adapt_meta_boxes[] = array(
	'id' => 'slides_meta',
	'title' => __('Slide Options',''),
	'pages' => array('slides'),

	'fields' => array(
			array(
            'name' => __('Slide Description',''),
            'desc' => __('Enter a description for your slider (optiona). Use h2 tag for a nice title.',''),
            'id' => $prefix . 'slides_description',
            'type' => 'textarea',
            'std' => ''
        ),
		array(
            'name' => __('Slide URL',''),
            'desc' => __('Enter a URL to link this slide to - perfect for linking slides to pages on your site or other sites. Optional.',''),
            'id' => $prefix . 'slides_url',
            'type' => 'text',
            'std' => ''
        )
	)
);




// DO NOT DELETE BELOW
foreach ($adapt_meta_boxes as $meta_box) {
	new adapt_meta_box($meta_box);
}
?>