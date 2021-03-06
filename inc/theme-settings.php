<?php
/**
 * Check and setup theme's default settings
 *
 * @package understrap
 *
 */

if ( ! function_exists ( 'understrap_setup_theme_default_settings' ) ) {
	function understrap_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$understrap_posts_index_style = get_theme_mod( 'understrap_posts_index_style' );
		if ( '' == $understrap_posts_index_style ) {
			set_theme_mod( 'understrap_posts_index_style', 'default' );
		}

		// Sidebar position.
		$understrap_sidebar_position = get_theme_mod( 'understrap_sidebar_position' );
		if ( '' == $understrap_sidebar_position ) {
			set_theme_mod( 'understrap_sidebar_position', 'left' );
		}

		// Container width.
		$understrap_container_type = get_theme_mod( 'understrap_container_type' );
		if ( '' == $understrap_container_type ) {
			set_theme_mod( 'understrap_container_type', 'container-full' );
		}
        add_filter('show_admin_bar', '__return_false');
        add_image_size( 'background', 1920, 9999 ); // Unlimited Height Mode
        add_image_size( 'post-cover', 600, 387,true );
        add_image_size( 'author-cover', 512, 512,true );
        add_post_type_support('page','excerpt');
	}
}
add_filter('show_admin_bar', '__return_false');
