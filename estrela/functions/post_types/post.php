<?php
//
// Normal Post related functions.
//
add_action('admin_init', 'ci_add_cpt_post_meta');
add_action('save_post', 'ci_update_cpt_post_meta');

if( !function_exists('ci_add_cpt_post_meta') ):
function ci_add_cpt_post_meta()
{
	add_meta_box("ci_post_colors", __('Post Customizer', 'ci_theme'), "ci_add_post_colors_meta_box", "post", "normal", "high");
	add_meta_box("ci_post_colors", __('Page Customizer', 'ci_theme'), "ci_add_post_colors_meta_box", "page", "normal", "high");
	add_meta_box("ci_format_box_gallery", __('Gallery Details', 'ci_theme'), "ci_add_format_gallery_meta_box", "post", "normal", "high");
	add_meta_box("ci_format_box_image", __('Image Details', 'ci_theme'), "ci_add_format_image_meta_box", "post", "normal", "high");
	add_meta_box("ci_format_box_quote", __('Quote Details', 'ci_theme'), "ci_add_format_quote_meta_box", "post", "normal", "high");
	add_meta_box("ci_format_box_video", __('Video Details', 'ci_theme'), "ci_add_format_video_meta_box", "post", "normal", "high");
	add_meta_box("ci_format_box_audio", __('Audio Details', 'ci_theme'), "ci_add_format_audio_meta_box", "post", "normal", "high");
	add_meta_box("ci_format_box_link", __('Link Details', 'ci_theme'), "ci_add_format_link_meta_box", "post", "normal", "high");
}
endif;

if( !function_exists('ci_update_cpt_post_meta') ):
function ci_update_cpt_post_meta($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if (isset($_POST['post_view']) and $_POST['post_view']=='list') return;

	if (isset($_POST['post_type']) and $_POST['post_type'] == "post")
	{
		update_post_meta($post_id, "ci_format_quote_text", (isset($_POST["ci_format_quote_text"]) ? $_POST["ci_format_quote_text"] : '') );
		update_post_meta($post_id, "ci_format_quote_cite", (isset($_POST["ci_format_quote_cite"]) ? $_POST["ci_format_quote_cite"] : '') );
		update_post_meta($post_id, "ci_format_quote_credit", (isset($_POST["ci_format_quote_credit"]) ? $_POST["ci_format_quote_credit"] : '') );
		update_post_meta($post_id, "ci_format_video_url", (isset($_POST["ci_format_video_url"]) ? $_POST["ci_format_video_url"] : '') );
		update_post_meta($post_id, "ci_format_audio_url", (isset($_POST["ci_format_audio_url"]) ? $_POST["ci_format_audio_url"] : '') );
		update_post_meta($post_id, "ci_format_link_url", (isset($_POST["ci_format_link_url"]) ? $_POST["ci_format_link_url"] : '') );
		update_post_meta($post_id, "ci_format_link_nofollow", (isset($_POST["ci_format_link_nofollow"]) ? $_POST["ci_format_link_nofollow"] : '') );
	}

	if (isset($_POST['post_type']) and ($_POST['post_type'] == "post" or $_POST['post_type'] == "page"))
	{
		//if(!empty($_POST["ci_post_colors_preset"]))
		//{
		//	update_post_meta($post_id, "ci_post_colors_preset", (isset($_POST["ci_post_colors_preset"]) ? $_POST["ci_post_colors_preset"] : '') );
		//}
		//else
		//{
			update_post_meta($post_id, "ci_post_colors_preset", (isset($_POST["ci_post_colors_preset"]) ? $_POST["ci_post_colors_preset"] : '') );
			update_post_meta($post_id, "ci_post_background", (isset($_POST["ci_post_background"]) ? $_POST["ci_post_background"] : '') );
			update_post_meta($post_id, "ci_headings_color", (isset($_POST["ci_headings_color"]) ? $_POST["ci_headings_color"] : '') );
			update_post_meta($post_id, "ci_link_color", (isset($_POST["ci_link_color"]) ? $_POST["ci_link_color"] : '') );
			update_post_meta($post_id, "ci_text_color", (isset($_POST["ci_text_color"]) ? $_POST["ci_text_color"] : '') );
			update_post_meta($post_id, "ci_image_on_left", (isset($_POST["ci_image_on_left"]) ? $_POST["ci_image_on_left"] : '') );
			update_post_meta($post_id, "ci_post_background_img", (isset($_POST["ci_post_background_img"]) ? $_POST["ci_post_background_img"] : '') );
			update_post_meta($post_id, "ci_post_background_align", (isset($_POST["ci_post_background_align"]) ? $_POST["ci_post_background_align"] : '') );
			update_post_meta($post_id, "ci_post_background_repeat", (isset($_POST["ci_post_background_repeat"]) ? $_POST["ci_post_background_repeat"] : '') );
		//}
	}

}
endif;

if ( !function_exists('ci_add_post_colors_meta_box') ) :
function ci_add_post_colors_meta_box() {
	global $post;

	$selected_preset = get_post_meta($post->ID, 'ci_post_colors_preset', true);
	$ci_post_background = get_post_meta($post->ID, 'ci_post_background', true);
	$ci_headings_color = get_post_meta($post->ID, 'ci_headings_color', true);
	$ci_link_color = get_post_meta($post->ID, 'ci_link_color', true);
	$ci_text_color = get_post_meta($post->ID, 'ci_text_color', true);
	$ci_image_on_left = get_post_meta($post->ID, 'ci_image_on_left', true);
	$ci_post_background_img = get_post_meta($post->ID, 'ci_post_background_img', true);
	$ci_post_background_align = get_post_meta($post->ID, 'ci_post_background_align', true);
	$ci_post_background_repeat = get_post_meta($post->ID, 'ci_post_background_repeat', true);

	?>
	<p><?php _e('You can customize the way that this post will be displayed. Select one of the available presets, or choose custom colors.', 'ci_theme'); ?></p>

	<div class="postbox-container ci-post-customizer-col" style="width: 46%; float:left; margin-right: 15px;">
		<div class="postbox">
			<h3 class="hndle"><?php _e('Color Selection', 'ci_theme'); ?></h3>
			<div class="inside">

				<p>
					<label for="ci_image_on_left"><input type="checkbox" id="ci_image_on_left" name="ci_image_on_left" value="disabled" <?php checked($ci_image_on_left, 'disabled'); ?>> <?php _e('Show featured image on the left?', 'ci_theme'); ?></label>
				</p>

				<p>
					<label for="ci_headings_color"><?php _e('Headings Text Color (H1-H6):', 'ci_theme'); ?></label><br>
					<input type="text" id="ci_headings_color" class="colorpckr" name="ci_headings_color" value="<?php echo esc_attr($ci_headings_color); ?>">

					<br />

					<label for="ci_text_color"><?php _e('Post Text Color:', 'ci_theme'); ?></label><br>
					<input type="text" id="ci_text_color" class="colorpckr" name="ci_text_color" value="<?php echo esc_attr($ci_text_color); ?>">

					<br />

					<label for="ci_link_color"><?php _e('Link Color:', 'ci_theme'); ?></label><br>
					<input type="text" id="ci_link_color" class="colorpckr" name="ci_link_color" value="<?php echo esc_attr($ci_link_color); ?>">
				</p>

			</div>
		</div>
	</div>

	<div class="postbox-container ci-post-customizer-col" style="width: 46%; float: left;">
		<div class="postbox">
			<h3 class="hndle"><?php _e('Background Selection', 'ci_theme'); ?></h3>
			<div class="inside">
				<p>
					<label for="ci_post_background"><?php _e('Background Color:', 'ci_theme'); ?></label><br>
					<input type="text" id="ci_post_background" class="colorpckr" name="ci_post_background" value="<?php echo esc_attr($ci_post_background); ?>">

					<br />

					<label for="ci_post_background_img"><?php _e('Background Image:', 'ci_theme'); ?></label><br>
					<input type="text" id="ci_post_background_img" class="uploaded" name="ci_post_background_img" value="<?php echo esc_url($ci_post_background_img); ?>">
					<input type="button" class="ci-upload button" value="<?php _e('Select', 'ci_theme'); ?>" />

					<br />

					<label for="ci_post_background_align"><?php _e('Image alignment:', 'ci_theme'); ?></label><br>
					<select id="ci_post_background_align" name="ci_post_background_align">
						<option value="top left" <?php selected('top left', $ci_post_background_align); ?>><?php _e('Top Left', 'ci_theme'); ?></option>
						<option value="top center" <?php selected('top center', $ci_post_background_align); ?>><?php _e('Top Center', 'ci_theme'); ?></option>
						<option value="top right" <?php selected('top right', $ci_post_background_align); ?>><?php _e('Top Right', 'ci_theme'); ?></option>
						<option value="center left" <?php selected('center left', $ci_post_background_align); ?>><?php _e('Center Left', 'ci_theme'); ?></option>
						<option value="center center" <?php selected('center center', $ci_post_background_align); ?>><?php _e('Center Center', 'ci_theme'); ?></option>
						<option value="center right" <?php selected('center right', $ci_post_background_align); ?>><?php _e('Center Right', 'ci_theme'); ?></option>
						<option value="bottom left" <?php selected('bottom left', $ci_post_background_align); ?>><?php _e('Bottom Left', 'ci_theme'); ?></option>
						<option value="bottom center" <?php selected('bottom center', $ci_post_background_align); ?>><?php _e('Bottom Center', 'ci_theme'); ?></option>
						<option value="bottom right" <?php selected('bottom right', $ci_post_background_align); ?>><?php _e('Bottom Right', 'ci_theme'); ?></option>
					</select>

					<br />

					<label for="ci_post_background_repeat"><?php _e('Image repeat:', 'ci_theme'); ?></label><br>
					<select id="ci_post_background_repeat" name="ci_post_background_repeat">
						<option value="no-repeat" <?php selected('no-repeat', $ci_post_background_repeat); ?>><?php _e('No Repeat', 'ci_theme'); ?></option>
						<option value="repeat" <?php selected('repeat', $ci_post_background_repeat); ?>><?php _e('Repeat', 'ci_theme'); ?></option>
						<option value="repeat-x" <?php selected('repeat-x', $ci_post_background_repeat); ?>><?php _e('Repeat X', 'ci_theme'); ?></option>
						<option value="repeat-y" <?php selected('repeat-y', $ci_post_background_repeat); ?>><?php _e('Repeat Y', 'ci_theme'); ?></option>
					</select>
				</p>
			</div>
		</div>
	</div>

	<div style="clear: both;">
	<fieldset>
		<strong><label for="ci_post_colors_preset"><?php _e('Use a preset:', 'ci_theme'); ?></label></strong><br>
		<select id="ci_post_colors_preset" name="ci_post_colors_preset">
			<option value="" <?php selected($selected_preset, ''); ?>>&nbsp</option>
			<?php
				$presets = get_option(CI_DOMAIN.'_post_colors_presets', ci_default_post_color_presets());
				foreach($presets as $key => $values)
				{
					?><option value="<?php echo $key; ?>" <?php selected($selected_preset, $key); ?>><?php echo $values['preset_name']; ?></option><?php
				}
			?>
		</select>
		<a href="#" id="ci_post_colors_delete_preset"><?php _e('Delete selected preset', 'ci_theme'); ?></a><span id="ci_post_colors_delete_preset_progress" style="display: none;"></span>
	</fieldset>


	<p><a href="#" class="button" id="ci_post_colors_new_preset"><?php _e('Save as new preset', 'ci_theme'); ?></a></p>
	<p id="ci_post_colors_new_preset_controls" style="display: none;">
		<label for="ci_post_colors_new_preset_name"><?php _e('Preset name:', 'ci_theme'); ?></label><br>
		<input type="text" id="ci_post_colors_new_preset_name" name="ci_post_colors_new_preset_name" value="" />
		<input type="button" class="button" id="create_ci_post_colors_new_preset" name="create_ci_post_colors_new_preset" value="Save" />
		<span id="ci_post_colors_new_preset_progress" style="display: none;"></span>
	</p>
	</div>
	<?php
}
endif;

if( !function_exists('ci_add_format_gallery_meta_box') ):
function ci_add_format_gallery_meta_box()
{
	?>
	<p><?php echo sprintf(__('You need to upload (or assign) two images to the post. This can be done by clicking <a href="#" class="ci-upload">here</a>, or pressing the <strong>Upload Images</strong> button bellow, or via the <strong>Add Media <img src="%s" /> button</strong>, just below the post\'s title.', 'ci_theme'), get_admin_url().'/images/media-button.png'); ?></p>
	<p><input type="button" class="button ci-upload" value="<?php echo esc_attr(__('Upload Images', 'ci_theme')); ?>" /></p>
	<?php
}
endif;

if( !function_exists('ci_add_format_image_meta_box') ):
function ci_add_format_image_meta_box()
{
	?>
	<p><?php sprintf(__('You need to upload (or assign) a <strong>Featured Image</strong> to the post. This can be done by clicking <a href="#" class="ci-upload">here</a>, or pressing the <strong>Upload Images</strong> button bellow, or via the <strong>Add Media <img src="%s" /> button</strong>, just below the post\'s title.', 'ci_theme'), get_admin_url().'/images/media-button.png'); ?></p>
	<p><?php _e('Once you have uploaded or selected your image, click on the <strong>Use as featured image</strong> link.', 'ci_theme'); ?></p>
	<p><input type="button" class="button ci-upload" value="<?php echo esc_attr(__('Upload Images', 'ci_theme')); ?>" /></p>
	<?php
}
endif;

if( !function_exists('ci_add_format_quote_meta_box') ):
function ci_add_format_quote_meta_box(){
	global $post;
	$text = get_post_meta($post->ID, 'ci_format_quote_text', true);
	$cite = get_post_meta($post->ID, 'ci_format_quote_cite', true);
	$credit = get_post_meta($post->ID, 'ci_format_quote_credit', true);
	?>
	<p class="form-field">
		<label for="ci_format_quote_text"><?php _e('Quoted text:', 'ci_theme'); ?></label>
		<textarea id="ci_format_quote_text" name="ci_format_quote_text" class="large-text code" wrap="virtual"><?php echo esc_textarea($text); ?></textarea>
	</p>
	<p><?php _e('Write the name of your source here. Always give credit to the person who said it, rather than the place you found it. Even if it is something you found on a website, try to find out who wrote it, and write the author\'s name instead of the website\'s/company\'s name.', 'ci_theme'); ?></p>
	<p class="form-field">
		<label for="ci_format_quote_credit" class="ci-block"><?php _e('Cite:', 'ci_theme'); ?></label>
		<input type="text" id="ci_format_quote_credit" name="ci_format_quote_credit" class="code" value="<?php echo esc_attr($credit); ?>" />
	</p>
	<p><?php _e('If your quote is something you found online, you can enter the URL here, and the name you entered above will become a link.', 'ci_theme'); ?></p>
	<p class="form-field">
		<label for="ci_format_quote_cite" class="ci-block"><?php _e('Citation URL:', 'ci_theme'); ?></label>
		<input type="text" id="ci_format_quote_cite" name="ci_format_quote_cite" class="code" value="<?php echo esc_attr($cite); ?>" />
	</p>
	<?php
}
endif;

if( !function_exists('ci_add_format_video_meta_box') ):
function ci_add_format_video_meta_box(){
	global $post;
	$url = get_post_meta($post->ID, 'ci_format_video_url', true);
	?>
	<p><?php _e('In the following box, you can simply enter the URL of a supported website\'s video. It needs to start with <strong>http://</strong> or <strong>https://</strong> (E.g. <em>http://www.youtube.com/watch?v=4Z9WVZddH9w</em>). A list of supported websites can be <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">found here</a>.', 'ci_theme'); ?></p>
	<p><?php _e('If you want to embed a video from an unsupported website, copy the video\'s embed code and paste it into the same box below.', 'ci_theme'); ?></p>
	<p><?php _e('Your video will be resized automatically to fit the width of the post area.', 'ci_theme'); ?></p>
	<label for="ci_format_video_url"><?php _e('The URL to the video to be embedded:', 'ci_theme'); ?></label>
	<input id="ci_format_video_url" type="text" class="code widefat" name="ci_format_video_url" value="<?php echo esc_attr($url); ?>" /> 
	<?php
}
endif;

if( !function_exists('ci_add_format_audio_meta_box') ):
function ci_add_format_audio_meta_box(){
	global $post;
	$url = get_post_meta($post->ID, 'ci_format_audio_url', true);
	?>
	<p><?php _e('In the following box, you can simply enter the URL of an <strong>MP3</strong> file, or click on the <strong>Upload</strong> button to upload and/or select an MP3 file from within WordPress.', 'ci_theme'); ?></p>
	<label for="ci_format_audio_url"><?php _e('The URL of the MP3 file to embed:', 'ci_theme'); ?></label>
	<input id="ci_format_audio_url" type="text" class="code widefat uploaded" name="ci_format_audio_url" value="<?php echo esc_url($url); ?>" /> 
	<input id="ci-upload-audio-button" type="button" class="button ci-upload" value="<?php echo esc_attr(__('Upload MP3', 'ci_theme')); ?>" />
	<?php
}
endif;

if( !function_exists('ci_add_format_link_meta_box') ):
function ci_add_format_link_meta_box(){
	global $post;
	$url = get_post_meta($post->ID, 'ci_format_link_url', true);
	$nofollow = get_post_meta($post->ID, 'ci_format_link_nofollow', true);
	?>
	<p><?php _e('Linked posts are just like normal posts, but their title redirects to the URL you enter instead of the normal post content. You may optionally mark the link with the <strong>nofollow</strong> attribute, in case you link against a naughty website which you don\'t want search engines to affiliate you with.', 'ci_theme'); ?></p>
	<p class="form-field">
		<label for="ci_format_link_url"><?php _e('URL:', 'ci_theme'); ?></label>
		<input type="text" id="ci_format_link_url" name="ci_format_link_url" class="code" value="<?php echo esc_url($url); ?>" />
	</p>
	<p>
		<input type="checkbox" name="ci_format_link_nofollow" id="ci_format_link_nofollow" value="nofollow" <?php checked($nofollow, 'nofollow'); ?> /><label for="ci_format_link_nofollow"><?php _e('Add <strong><code>rel="nofollow"</code></strong> to link.', 'ci_theme'); ?></label>
	</p>
	<?php
}
endif;
?>
