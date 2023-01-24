<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

# Enqueue Styles and Scripts
if ( ! function_exists( 'ashade_child_enqueue_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'ashade_child_enqueue_styles' );
	function ashade_child_enqueue_styles() {
		# Define Parent Style
		$parent_style = 'ashade-style-parent';
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		
		# Define Child Styles
		wp_enqueue_style( 'ashade-style-child',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);
	 
	}
}