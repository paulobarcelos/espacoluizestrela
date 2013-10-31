<?php
// For documentation of the TGM Plugin Activation class, see http://tgmpluginactivation.com/
get_template_part('panel/libraries/class-tgm-plugin-activation');

/*
 * This is an example of how the theme can suggest/require plugins.
 * It can also be done in a separate array, and then doing an array_merge()
 * Ideally, this code should go into /functions/template_hooks.php
 */

/*
	add_filter('ci_theme_required_plugins', 'ci_theme_add_required_plugins');
	if( !function_exists('ci_theme_add_required_plugins') ):
	function ci_theme_add_required_plugins($plugins)
	{
		// This is an example of how to include a plugin from the WordPress Plugin Repository
		$plugins[] = array(
			'name' => 'WordPress SEO by Yoast',
			'slug' => 'wordpress-seo',
			'required' => false
		);
	
		// This is an example of how to include a plugin pre-packaged with a theme
		$plugins[] = array(
			'name'     				=> 'TGM Example Plugin', // The plugin name
			'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		);
	
		return $plugins;
	}
	endif;
*/


add_action( 'tgmpa_register', 'ci_theme_register_required_plugins' );
if( !function_exists('ci_theme_register_required_plugins') ):
function ci_theme_register_required_plugins() {

	// Default plugins are set via the hooked ci_theme_add_default_required_plugins()
	// If you need to remove a plugin from the defaults, you may want to override or unhook that function,
	// instead of traversing the array itself.
	$plugins = apply_filters('ci_theme_required_plugins', array());
	
	$config = apply_filters('ci_theme_required_plugins_config', array(
		'domain' 			=> 'ci_theme', 					// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '', 							// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu' 				=> 'install-required-plugins', 	// Menu slug
		'has_notices' 		=> true, 						// Show admin notices or not
		'is_automatic' 		=> false, 						// Automatically activate plugins after installation or not
		'message' 			=> '', 							// Message to output right before the plugins table
		'strings' 			=> array(
			'page_title' 						=> __( 'Install Required Plugins', 'ci_theme' ),
			'menu_title' 						=> __( 'Install Plugins', 'ci_theme' ),
			'installing' 						=> __( 'Installing Plugin: %s', 'ci_theme' ), // %1$s = plugin name
			'oops' 								=> __( 'Something went wrong with the plugin API.', 'ci_theme' ),
			'notice_can_install_required' 		=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended' 	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required' 		=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended' 	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 				=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 				=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 						=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 					=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return' 							=> __( 'Return to Required Plugins Installer', 'ci_theme' ),
			'plugin_activated' 					=> __( 'Plugin activated successfully.', 'ci_theme' ),
			'complete' 							=> __( 'All plugins installed and activated successfully. %s', 'ci_theme' ), // %1$s = dashboard link
			'nag_type' 							=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	));

	if(count($plugins) > 0)
	{
		tgmpa( $plugins, $config );
	}

}
endif;

add_filter('ci_theme_required_plugins', 'ci_theme_add_default_required_plugins');
if( !function_exists('ci_theme_add_default_required_plugins') ):
function ci_theme_add_default_required_plugins($plugins)
{
	$plugins[] = array(
		'name' => 'WP-PageNavi',
		'slug' => 'wp-pagenavi',
		'required' => false
	);

	return $plugins;
}
endif;

?>
