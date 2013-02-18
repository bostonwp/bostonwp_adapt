<?php
/******************************************
/* Shortcodes
******************************************/
/**** Clean UP SHORTCODES ****///Clean Up WordPress Shortcode Formatting - important for nested shortcodes
//adjusted from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

//move wpautop filter to AFTER shortcode is processed
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );

//highlights
function highlight_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
	array(
      'color' => 'yellow',
      ),
	  $atts ) );

      return '<span class="text-highlight highlight-' . $color . '">' . $content . '</span>';

}
add_shortcode('highlight', 'highlight_shortcode');

//Break
function line_break_shortcode() {
   return '<br />';
}

add_shortcode( 'br', 'line_break_shortcode' );

//clear
function clear_shortcode() {
   return '<div class="clear"></div>';
}

add_shortcode( 'clear', 'clear_shortcode' );

//Buttons
function button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'default',
	  'url' => '',
	  'text' => ''
      ), $atts ) );
	  if($url) {
		return '<a href="' . $url . '" class="button ' . $color . '" target="_blank"><span>' . $text . $content . '</span></a>';
	  } else {
		return '<div class="button ' . $color . '"><span>' . $text . $content . '</span></div>';
	}
}
add_shortcode('button', 'button_shortcode');

//Boxes
function box_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'orange',
      'size' => 'normal',
      'type' => '',
	  'align' => 'default',
      ), $atts ) );

      return '<div class="box-shortcode box-' . $color . '">' . $content . '</div>';

}
add_shortcode('box', 'box_shortcode');

//Columns
function column_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
	  'offset' =>'',
      'size' => '',
	  'position' =>''
      ), $atts ) );


	  if($offset !='') { $column_offset = $offset; } else { $column_offset ='one'; }
		
      return '<div class="'.$column_offset.'-' . $size . ' column-'.$position.'">' . do_shortcode($content) . '</div>';

}
add_shortcode('column', 'column_shortcode');

/*shortcode filters - alow shortcodes in widgets*/
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
?>