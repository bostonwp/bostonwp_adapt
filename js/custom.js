jQuery(function($){
	$(document).ready(function(){
		
		// superFish
		$("ul.sf-menu").superfish({ 
			autoArrows: true,
			delay: 400,
		});
		
		// back to top
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 200);
			return false;
		});
		
		// PrettyPhoto Without gallery
		$(".prettyphoto-link").prettyPhoto({
			theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook */
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			social_tools: false,
			autoplay_slideshow: false
		});
		
		//comment check
		$('#commentform').submit(function(e) {
			var $urlField = $(this).children('#url');
			if($urlField.val() == 'Website') {
				$urlField.val('')
			}
		});
	
			
		//PrettyPhoto With Gallery
		$("a[rel^='prettyPhoto']").prettyPhoto({
			theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook */
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			slideshow:3000,
			social_tools: false,
			autoplay_slideshow: false,
			overlay_gallery: false
		});
		
		//animate
		$('.portfolio-item img, .home-entry img, .loop-entry img').hover(function(){
			$(this).stop(true, true).animate({opacity: 0.4}, 300);
		}, function(){
			$(this).stop(true, true).animate({opacity: 1}, 300);
		});
		
	
	}); // END doc ready
}); // END function


jQuery(function($){
	$(window).load(function() {
		
		//homepage slides
		$('.flexslider').flexslider({
			animation: "fade", //Select your animation type (fade/slide)
			slideshow: true, //Should the slider animate automatically by default? (true/false)
			slideshowSpeed: 6000, //Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 600, //Set the speed of animations, in milliseconds
			directionNav: true, //Create navigation for previous/next navigation? (true/false)
			controlNav: false, //Create navigation for paging control of each slide? (true/false)
			keyboardNav: true, //Allow for keyboard navigation using left/right keys (true/false)
			touchSwipe: true, //Touch swipe gestures for left/right slide navigation (true/false)
			prevText: '<span class="awesome-icon-chevron-left"></span>', //Set the text for the "previous" directionNav item
			nextText: '<span class="awesome-icon-chevron-right"></span>', //Set the text for the "next" directionNav item
			randomize: false, //Randomize slide order on page load? (true/false)
			animationLoop: true, //Should the animation loop? If false, directionNav will received disabled classes when at either end (true/false)
			pauseOnAction: true, //Pause the slideshow when interacting with control elements, highly recommended. (true/false)
			pauseOnHover: false, //Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)
		});
	
	});// END window load
});// END function