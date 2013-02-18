$(function() {
	
	/* Universal Yellow Button - Sliding Doors */
	$(".button").each(function() {
		var $this = $(this);
		$this.wrapInner('<span class="tail" />').prepend('<span class="head" />').after('<div class="clear" />');
		if ($this.hasClass('center')) {
			$this.width($this.children('.head').innerWidth() + $this.children('.tail').innerWidth());
		}	
	});
	
	/* Job Category Listing */
	$("#jobs").before('<ul id="jobsNav"><li class="on"><a href="javascript:;" class="all">All Jobs</a></li><li><a class="project" href="javascript:;">Projects</a></li><li><a class="full-time" href="javascript:;">Full-Time</a></li></ul><div class="clear"></div>');
	$("#jobsNav a").bind('click', function() { 
		var $this = $(this);
		if (!$this.hasClass("on")) {
			$this.parent().siblings(".on").removeClass("on").end().addClass("on");
			if ($this.hasClass("all")) {
				$("#jobs tbody tr").show();
			} else {
				$("#jobs tbody tr").hide();
				$("#jobs tbody tr."+ $this.attr("class")).show();
			}			
		}
	});
});