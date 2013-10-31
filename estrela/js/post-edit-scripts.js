jQuery(document).ready( function($) {
	$('.colorpckr').wpColorPicker();

	$('#ci_post_colors').on('click', '#ci_post_colors_new_preset', function(e){
		e.preventDefault();
		$('#ci_post_colors_new_preset_controls').slideToggle();
		return false;
	});

	$('#ci_post_colors').on('click', '#ci_post_colors_delete_preset', function(e){
		e.preventDefault();

		if( $('#ci_post_colors_preset').val()!='' && confirm('Are you sure you want to delete this preset?') )
		{
			var key_to_delete = $('#ci_post_colors_preset').val();
			$.ajax({
				type: "post",
				url: AjaxHandler.ajaxurl,
				data: { 
					action: 'ci_post_colors_delete_preset',
					preset_key: key_to_delete
				},
				beforeSend: function() {
					$("#ci_post_colors_delete_preset").hide();
					$("#ci_post_colors_delete_preset_progress").html('Deleting...').fadeIn();
				}, 
				success: function(response){ 
					if(response != 'fail')
					{
						clear_preset_and_colorpickers();
						$('#ci_post_colors_preset option[value="'+key_to_delete+'"]').remove();
						$('#ci_post_colors_preset').val('');
					}
				}
			});
			$("#ci_post_colors_delete_preset_progress").delay(2000).fadeOut().html('');
			$("#ci_post_colors_delete_preset").show();
		}
	});

	$('#ci_post_colors').on('change', '#ci_post_colors_preset', function(e){
		if($('#ci_post_colors_preset').val()!='')
		{
			$.ajax({
				type: "post",
				url: AjaxHandler.ajaxurl,
				data: { 
					action: 'ci_post_colors_get_preset_data',
					preset_key: $('#ci_post_colors_preset').val()
				},
				success: function(response){ 
					if(response != 'fail')
					{
						set_color_or_clear('#ci_headings_color', response['headings_color']);
						set_color_or_clear('#ci_text_color', response['text_color']);
						set_color_or_clear('#ci_link_color', response['link_color']);
						set_color_or_clear('#ci_post_background', response['background_color']);
						$('#ci_post_background_img').val(response['background_img']);
						$('#ci_post_background_align').val(response['background_align']);
						$('#ci_post_background_repeat').val(response['background_repeat']);
					}
				}
			});
		}
		else
		{
			clear_preset_and_colorpickers();
		}
	});

	$('#ci_post_colors').on('click', '#create_ci_post_colors_new_preset', function(e){ 

		if($('#ci_post_colors_new_preset_name').val().length > 0) {
			$.ajax({
				type: "post",
				url: AjaxHandler.ajaxurl,
				data: { 
					action: 'ci_post_colors_new_preset',
					preset_name: $('#ci_post_colors_new_preset_name').val(),
					headings_color: $('#ci_headings_color').val(),
					text_color: $('#ci_text_color').val(),
					link_color: $('#ci_link_color').val(),
					background_color: $('#ci_post_background').val(),
					background_img: $('#ci_post_background_img').val(),
					background_align: $('#ci_post_background_align').val(),
					background_repeat: $('#ci_post_background_repeat').val()
				},
				beforeSend: function() {
					$("#ci_post_colors_new_preset_progress").html('Saving...').fadeIn();
				}, 
				success: function(response){ 
	
					if(response['status']=='fail')
					{
						$('#ci_post_colors_new_preset_progress').html(response['status_msg']);
						
					}
					if(response['status']=='success')
					{
						$('#ci_post_colors_new_preset_name').val('');
						$('#ci_post_colors_new_preset_progress').html(response['status_msg']);

						var key = response['preset_key'];
						var data = response['preset_data'];

						$('#ci_post_colors_preset').append($('<option>', { 
							value: key,
							text : data['preset_name'],
							selected: true
						}));

					}														
				}//success	
			});//ajax

		}
		else {
			$('#ci_post_colors_new_preset_progress').html('Error connecting to server.');
		}

		$("#ci_post_colors_new_preset_progress").delay(2000).fadeOut().html('');
	}); 

});

// Color pickers need to have their button pressed in order to clear.
function set_color_or_clear(element_id, color)
{
	if(color=='' || color=='#')
		jQuery(element_id).next('.wp-picker-clear').trigger('click');
	else
		jQuery(element_id).wpColorPicker('color', color);
	
}

function clear_preset_and_colorpickers()
{
	set_color_or_clear('#ci_headings_color', '');
	set_color_or_clear('#ci_text_color', '');
	set_color_or_clear('#ci_link_color', '');
	set_color_or_clear('#ci_post_background', '');
	jQuery('#ci_post_background_img').val('');
	jQuery('#ci_post_background_align').val('');
	jQuery('#ci_post_background_repeat').val('');
}