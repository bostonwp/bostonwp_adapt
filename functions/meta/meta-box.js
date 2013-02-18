jQuery(document).ready(function($) {
	// datepicker field
	$('.-date').each(function(){
		var $this = $(this),
			format = $this.attr('rel');

		$this.datepicker({
			showButtonPanel: true,
			dateFormat: format
		});
	});

	// timepicker field
	$('.-time').each(function(){
		var $this = $(this),
			format = $this.attr('rel');

		$this.timepicker({
			showSecond: true,
			timeFormat: format
		});
	});
	
	// slider field
	$('.-slider').each(function(){
		var $this = $(this);
		var id = $this.attr('rel');
		var val = $('#' + id).val();
		var max = $('#' + id).attr('rel');
		val = parseInt(val);
		max = parseInt(max);
		//var step = $('#' + id).closest('input').attr('rel');
		$this.slider({
			value: val,
			max: max,
			step: 1,
			slide: function(event, ui) {
				$('#' + id).val(ui.value);
			}
		});
	});

	// colorpicker field
	$('.-color-picker').each(function(){
		var $this = $(this),
			id = $this.attr('rel');

		$this.farbtastic('#' + id);
	});
	$('.-color-select').click(function(){
		$parent = $(this).parent();
		$(this).siblings('.-color-picker').toggle();
		$('.-color-select', $parent).toggle();
		return false;
	});

	// add more file
	$('.-add-file').click(function(){
		var $first = $(this).parent().find('.file-input:first');
		$first.clone().insertAfter($first).show();
		return false;
	});

	// delete file
	$('.-upload').delegate('.-delete-file', 'click' , function(){
		var $this = $(this),
			$parent = $this.parent(),
			data = $this.attr('rel');
		$.post(ajaxurl, {action: 'rw_delete_file', data: data}, function(response){
			response == '0' ? (alert('File has been successfully deleted.'), $parent.remove()) : alert('You do NOT have permission to delete this file.');
		});
		return false;
	});

	// reorder images
	$('.-images').each(function(){
		var $this = $(this),
			order, data;
		$this.sortable({
			placeholder: 'ui-state-highlight',
			update: function (){
				order = $this.sortable('serialize');
				data = order + '|' + $this.siblings('.-images-data').val();

				$.post(ajaxurl, {action: 'rw_reorder_images', data: data}, function(response){
					response == '0' ? alert('Order saved') : alert("You don't have permission to reorder images.");
				});
			}
		});
	});

	// thickbox upload
	$('.-upload-button').click(function(){
		var data = $(this).attr('rel').split('|'),
			post_id = data[0],
			field_id = data[1],
			backup = window.send_to_editor;		// backup the original 'send_to_editor' function which adds images to the editor

		// change the function to make it adds images to our section of uploaded images
		window.send_to_editor = function(html) {
			$('#smw-images-' + field_id).append($(html));

			tb_remove();
			window.send_to_editor = backup;
		};

		// note that we pass the field_id and post_id here
		tb_show('', 'media-upload.php?post_id=' + post_id + '&field_id=' + field_id + '&type=image&TB_iframe=true');

		return false;
	});

	// thickbox upload
    window.formfield = '';
    $('.-upload-single-image').live('click', function() {
        window.formfield = $('.-single-image',$(this).parent());
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
    window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html) {
        if (window.formfield) {
            imgurl = $('img',html).attr('src');
            window.formfield.val(imgurl);
            tb_remove();
        }
        else {
            window.original_send_to_editor(html);
        }
        window.formfield = '';
        window.imagefield = false;
		
		var visibleTR = $('#portfolio-images tr:visible:last');
		var nextInput = $(visibleTR).next();
		nextInput.fadeIn();
    }
	

	
	// add checkboxes to select images to add
	$('#media-items .new').each(function() {
		var id = $(this).parent().attr('id').split('-')[2];
		$(this).prepend('<input type="checkbox" class="item_selection" id="attachments[' + id + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
	});
	

	// add checkboxes to select images to add
	$('.ml-submit').live('mouseenter',function() {
		$('#media-items .new').each(function() {
			var id = $(this).parent().children('input[value="image"]').attr('id');
			if (!id) return;
			id = id.split('-')[2];
			$(this).not(':has("input")').prepend('<input type="checkbox" class="item_selection" id="attachments[' + id + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
		});
	});

	// add 'Insert selected images' button
	// we need to pull out the 'field_id' from the url as the media uploader is an iframe
	var field_id = get_query_var('field_id');
	$('.ml-submit:first').append('<input type="hidden" name="field_id" value="' + field_id + '" /> <input type="submit" class="button" name="smw-insert" value="Insert selected images" />');

	// helper function
	// get query string value by name, http://goo.gl/r0CH5
	function get_query_var(name) {
		var match = RegExp('[?&]' + name + '=([^&#]*)').exec(location.href);

		return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	}
});