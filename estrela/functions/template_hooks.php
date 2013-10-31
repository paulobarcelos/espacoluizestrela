<?php 
add_filter('ci_footer_credits', 'ci_theme_footer_credits');
if( !function_exists('ci_theme_footer_credits') ):
function ci_theme_footer_credits($string){

	if(!CI_WHITELABEL) {
		return '<a href="http://www.wordpress.org">' 
			. __('Powered by WordPress', 'ci_theme')
			. '</a> - <a href="http://www.cssigniter.com" '
			. 'title="'.esc_attr(__('Premium WordPress Themes', 'ci_theme')).'">'
			. __('A theme by CSSIgniter.com', 'ci_theme')
			. '</a>';
	}
	else {
		return '<a href="' . home_url() . '">' 
			. get_bloginfo('name') 
			. '</a> - <a href="http://www.wordpress.org">' 
			. __('Powered by WordPress', 'ci_theme')
			. '</a>';
	} 

}
endif;


add_action('ci_theme_print_post_custom_css', 'ci_theme_print_post_custom_css_handler');
if( !function_exists('ci_theme_print_post_custom_css_handler') ):
function ci_theme_print_post_custom_css_handler($post_id)
{

	$presets = get_option(CI_DOMAIN.'_post_colors_presets', ci_default_post_color_presets());
	$preset_key = get_post_meta($post_id, 'ci_post_colors_preset', true);
	$p = array();

	if(array_key_exists($preset_key, $presets))
	{
		$p = $presets[$preset_key];
		$color = !empty($p['text_color']) ? $p['text_color'] : get_post_meta($post_id, 'ci_text_color', true);
		$headings_color = !empty($p['headings_color']) ? $p['headings_color'] : get_post_meta($post_id, 'ci_headings_color', true);
		$link_color = !empty($p['link_color']) ? $p['link_color'] : get_post_meta($post_id, 'ci_link_color', true);
		$bg_color = !empty($p['background_color']) ? $p['background_color'] : get_post_meta($post_id, 'ci_post_background', true);
		$bg_image = !empty($p['background_img']) ? $p['background_img'] : get_post_meta($post_id, 'ci_post_background_img', true);
		$bg_image_align = !empty($p['background_align']) ? $p['background_align'] : get_post_meta($post_id, 'ci_post_background_align', true);
		$bg_image_repeat = !empty($p['background_repeat']) ? $p['background_repeat'] : get_post_meta($post_id, 'ci_post_background_repeat', true);
	}
	else
	{
		$color = get_post_meta($post_id, 'ci_text_color', true);
		$headings_color = get_post_meta($post_id, 'ci_headings_color', true);
		$link_color = get_post_meta($post_id, 'ci_link_color', true);
		$bg_color = get_post_meta($post_id, 'ci_post_background', true);
		$bg_image = get_post_meta($post_id, 'ci_post_background_img', true);
		$bg_image_align = get_post_meta($post_id, 'ci_post_background_align', true);
		$bg_image_repeat = get_post_meta($post_id, 'ci_post_background_repeat', true);
	}
	
	echo '<style type="text/css" scoped>';

		echo '#entry-'.$post_id.' .audio-link {';
			if ( !empty($bg_color) ) echo 'background-color: '.$bg_color.';';
		echo '}';

		echo '.searchsubmit, #entry-'.$post_id.' .audio-link-hold {';
		if( !empty($link_color) ) {
			echo 'background-color:' . $link_color;
		}
		echo '}';

		echo '#entry-'.$post_id.' {';
			if ( !empty($color) ) echo 'color: '.$color.';';
			if ( !empty($bg_color) ) echo 'background-color: '.$bg_color.';';

			if ($bg_image)
			{
				echo 'background-image: url('.$bg_image.');';
				echo 'background-position: '.$bg_image_align.';';
				//if($bg_image_attachment=='fixed') echo 'background-attachment: fixed;';
			}
			if ($bg_image_repeat) echo 'background-repeat: '.$bg_image_repeat.';';
			//if ($bg_image_disable=='enabled') echo 'background-image: none;';
		echo '} ';
	
		if( is_single() and !empty($color) )
		{
			echo '#s, #comments input[type=text], #comments input[type=url], #comments input[type=email], #comments textarea {';
				echo 'color: '.$color.';';
			echo '}';
		}

		if( !empty($headings_color) )
		{
			echo '#entry-'.$post_id.' h1, #entry-'.$post_id.' h2, #entry-'.$post_id.' h3, #entry-'.$post_id.' h4, #entry-'.$post_id.' h5, #entry-'.$post_id.' h6 {';
				echo 'color: '.$headings_color.';';
			echo '}';
		}

		if( !empty($link_color) )
		{
			echo '#entry-'.$post_id.' a, #entry-'.$post_id.' a:visited {';
				echo 'color: '.$link_color.';';
			echo '}';

			echo '#entry-'.$post_id.' a.read-more, #entry-'.$post_id.' a.comment-no, #entry-'.$post_id.' a.external-link, #comments input[type=submit] {';
				echo 'background-color: '.$link_color.';';
			echo '}';

			echo '#entry-'.$post_id.' .gallery-wrap img, #entry-'.$post_id.' blockquote {';
				echo 'border-color: '.$link_color.';';
			echo '}';
		}

	echo '</style>';

}
endif;

add_action('wp_ajax_ci_post_colors_get_preset_data', 'ci_post_colors_get_preset_data');
if( !function_exists('ci_post_colors_get_preset_data') ):
function ci_post_colors_get_preset_data()
{
	$presets = get_option(CI_DOMAIN.'_post_colors_presets', ci_default_post_color_presets());

	if( array_key_exists($_POST['preset_key'], $presets))
	{
		wp_send_json($presets[$_POST['preset_key']]);
	}
	else
	{
		echo 'fail';
		exit;
	}
}
endif;

add_action('wp_ajax_ci_post_colors_delete_preset', 'ci_post_colors_delete_preset');
if( !function_exists('ci_post_colors_delete_preset') ):
function ci_post_colors_delete_preset()
{
	$preset_key = sanitize_text_field($_POST['preset_key']);
	if(!empty($preset_key))
	{
		$presets = get_option(CI_DOMAIN.'_post_colors_presets', ci_default_post_color_presets());
		if(array_key_exists($preset_key, $presets))
		{
			unset($presets[$preset_key]);
			update_option(CI_DOMAIN.'_post_colors_presets', $presets);

			wp_send_json(array(
				'status' => 'success',
				'status_msg' => __('Deleted!', 'ci_theme'),
				'preset_key' => $preset_key
			));
		}
		else
		{
			wp_send_json(array(
				'status' => 'fail',
				'status_msg' => __('Could not delete preset.', 'ci_theme')
			));
		}
	}
}
endif;

add_action('wp_ajax_ci_post_colors_new_preset', 'ci_post_colors_new_preset');
if( !function_exists('ci_post_colors_new_preset') ):
function ci_post_colors_new_preset()
{
	$preset_name = sanitize_text_field($_POST['preset_name']);
	if(!empty($preset_name))
	{
		$key_name = sanitize_key($preset_name);
		$p['preset_name'] = $preset_name;
		$p['headings_color'] = ci_sanitize_hex_color($_POST['headings_color']);
		$p['text_color'] = ci_sanitize_hex_color($_POST['text_color']);
		$p['link_color'] = ci_sanitize_hex_color($_POST['link_color']);
		$p['background_color'] = ci_sanitize_hex_color($_POST['background_color']);
		$p['background_img'] = esc_url($_POST['background_img']);
		$p['background_align'] = sanitize_text_field($_POST['background_align']);
		$p['background_repeat'] = sanitize_text_field($_POST['background_repeat']);
		
		$presets = get_option(CI_DOMAIN.'_post_colors_presets', ci_default_post_color_presets());
		if(array_key_exists($key_name, $presets))
		{
			wp_send_json(array(
				'status' => 'fail',
				'status_msg' => __('Preset name already exists', 'ci_theme')
			));
		}
		
		$presets[$key_name] = $p;
		update_option(CI_DOMAIN.'_post_colors_presets', $presets);

		wp_send_json(array(
			'status' => 'success',
			'status_msg' => __('Saved!', 'ci_theme'),
			'preset_key' => $key_name,
			'preset_data' => $p
		));
	}
}
endif;

?>
