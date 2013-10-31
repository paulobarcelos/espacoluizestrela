<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
	function ci_widgets_init() {

		register_sidebar(array(
			'name' => __( 'Blog Sidebar', 'ci_theme'),
			'id' => 'blog-sidebar',
			'description' => __( 'Sidebar on blog pages', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		));

	}
endif;
?>
