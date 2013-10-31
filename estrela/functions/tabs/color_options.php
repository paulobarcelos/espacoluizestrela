<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_color_options', 20);
	if( !function_exists('ci_add_tab_color_options') ):
		function ci_add_tab_color_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Color Options', 'ci_theme');
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('custom_background');

	remove_action('ci_custom_background', 'ci_custom_background_handler');
	add_filter('ci_custom_footer_background_applied_element', 'ci_theme_custom_footer_background_applied_element');
	if( !function_exists('ci_theme_custom_footer_background_applied_element') ):
	function ci_theme_custom_footer_background_applied_element($element)
	{
		return '#footer, #paging';
	}
	endif;
?>
<?php else: ?>

	<?php load_panel_snippet('custom_background'); ?>

	<style type="text/css">
		#ci-panel-custom-background, #ci-panel-color-scheme { display: none; }
	</style>

<?php endif; ?>
