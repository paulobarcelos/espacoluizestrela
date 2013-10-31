<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles()
{
	//
	// Register all front-end and admin styles here. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//

	wp_register_style('ci-base', get_child_or_parent_file_uri('/css/base.css'));
	wp_register_style('font-awesome', get_child_or_parent_file_uri('/css/font-awesome.min.css'));
	wp_register_style('ci-mediaqueries', get_child_or_parent_file_uri('/css/mediaqueries.css'));
	wp_register_style('ci-style', get_stylesheet_uri(), array(), CI_THEME_VERSION, 'screen');

}
endif;

add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles()
{
	//
	// Enqueue all (or most) front-end styles here.
	//	

	wp_enqueue_style('ci-base');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('ci-style');
	wp_enqueue_style('ci-mediaqueries');

}
endif;


if( !function_exists('ci_enqueue_admin_theme_styles') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_styles');
function ci_enqueue_admin_theme_styles() 
{
	global $pagenow;

	//
	// Enqueue here styles that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here styles that are to be loaded only on CSSIgniter Settings panel.
		//

	}
}
endif;

?>
