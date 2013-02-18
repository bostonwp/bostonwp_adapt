jQuery(function($){
	$(document).ready(function(){
		
		//remove img height and width attributes for better responsiveness
		$('img').each(function(){
			$(this).removeAttr('width')
			$(this).removeAttr('height');
		});
		
		//responsive drop-down
		$("<select />").appendTo("#masternav");
		$("<option />", {
		   "selected": "selected",
		   "value": "",
		   "text": "Menu"
		}).appendTo("#masternav select");
		$("#masternav a").each(function() {
		 var el = $(this);
		 $("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : el.text()
		 }).appendTo("#masternav select");
		});
		
		//remove options with # symbol for value
		$("#masternav option").each(function() {
			var navOption = $(this);
			
			if( navOption.val() == '#' ) {
				navOption.remove();
			}
		});
		
		$("#masternav select").change(function() {
		  window.location = $(this).find("option:selected").val();
		});
		
		//uniform
		$(function(){
       		 $("#masternav select").uniform();
      	});
	
	}); // END doc ready
}); // END function