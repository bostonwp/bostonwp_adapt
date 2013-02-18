<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>
<form method="get" id="searchbar" action="<?php echo home_url( '/' ); ?>">
<input type="text" size="16" name="s" value="<?php _e('to search type and hit enter','adapt'); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" id="search" />
</form>