<?php
//
// Uncomment one of the following two. Their functions are in panel/generic.php
//
add_action('wp_enqueue_scripts', 'ci_enqueue_modernizr', 1);
//add_action('wp_enqueue_scripts', 'ci_print_html5shim', 1);


// This function lives in panel/generic.php
add_action('wp_footer', 'ci_print_selectivizr', 100);



add_action('init', 'ci_register_theme_scripts');
if( !function_exists('ci_register_theme_scripts') ):
function ci_register_theme_scripts()
{
	//
	// Register all scripts here, both front-end and admin. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	wp_register_script('ci-post-edit-scripts', get_child_or_parent_file_uri('/js/post-edit-scripts.js'), array('jquery'), false, false);
	wp_register_script('jquery-superfish', get_child_or_parent_file_uri('/panel/scripts/superfish.js'), array('jquery'), false, false);
	wp_register_script('jquery-fitVids', get_child_or_parent_file_uri('/panel/scripts/jquery.fitvid-1.0.js'), array('jquery'), false, false);
	wp_register_script('jquery-mmenu', get_child_or_parent_file_uri('/js/jquery.mmenu.min.js'), array('jquery'), false, false);
	wp_register_script('soundmanager2', get_child_or_parent_file_uri('/js/soundmanager2.js'), array('jquery'), false, false);
	wp_register_script('inlineplayer', get_child_or_parent_file_uri('/js/inlineplayer.js'), array('jquery'), false, false);

	wp_register_script('ci-front-scripts', get_child_or_parent_file_uri('/js/scripts.js'),
		array(
			'jquery',
			'jquery-superfish',
			'jquery-fitVids',
			'jquery-mmenu',
			'soundmanager2',
			'inlineplayer'
		),
		CI_THEME_VERSION, true);

}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
if( !function_exists('ci_enqueue_theme_scripts') ):
function ci_enqueue_theme_scripts()
{
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );


	//
	// Slider options export for ci-front-scripts
	//
	$params['swfPath'] = get_template_directory_uri().'/js/swf/';

	wp_enqueue_script('ci-front-scripts');
	wp_localize_script('ci-front-scripts', 'ThemeOption', $params);

}
endif;


add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_scripts');
if( !function_exists('ci_enqueue_admin_theme_scripts') ):
function ci_enqueue_admin_theme_scripts() 
{
	global $pagenow;

	//
	// Enqueue here scripts that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here scripts that are to be loaded only on CSSIgniter Settings panel.
		//

	}
}
endif;

?>
