<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
</div>
<!-- /main -->

    <div id="footer" class="clearfix">
    
        <div id="footer-widget-wrap" class="clearfix">
    
            <div id="footer-one">
            	<?php dynamic_sidebar('footer-one'); ?>
            </div>
            <!-- /footer-one -->
            
            <div id="footer-two">
            	<?php dynamic_sidebar('footer-two'); ?>
            </div>
            <!-- /footer-two -->
            
            <div id="footer-three">
            	<?php dynamic_sidebar('footer-three'); ?>
            </div>
            <!-- /footer-three -->
            
			<div id="footer-four">
            	<?php dynamic_sidebar('footer-four'); ?>
            </div>
            <!-- /footer-four -->
        
        </div>
        <!-- /footer-widget-wrap -->
          
		<div id="footer-bottom" class="clearfix">
        
            <div id="copyright">
                &copy; <?php echo date('Y'); ?>  Powered by WordPress & BBPress
            </div>
            <!-- /copyright -->
            
            <div id="back-to-top">
                <a href="#toplink"><?php _e('back up', ''); ?> &uarr;</a>
            </div>
            <!-- /back-to-top -->
        
        </div>
        <!-- /footer-bottom -->
        
	</div>
	<!-- /footer -->
    
</div>
<!-- wrap --> 

<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>