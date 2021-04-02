<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme = wp_get_theme();
		$theme_version = '1.0';
		
		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');
		wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );

		wp_enqueue_style( 'quest-slick-slider-styles-1', get_stylesheet_directory_uri() . '/js/slick/slick.min.css');
		wp_enqueue_style( 'quest-slick-slider-styles-2', get_stylesheet_directory_uri() . '/js/slick/slick-theme.min.css');

		wp_enqueue_script( 'jquery');
//		wp_enqueue_script( 'head-scripts', get_template_directory_uri() . '/js/head-js.min.js', array(), $theme_version, false);
		wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), $theme_version, true);

		wp_enqueue_script('quest-slick-slider-script', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery', 'customize-controls'), 1.0, true);

		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js');
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
if ( ! function_exists( 'quest_admin_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function quest_admin_scripts() {
        wp_enqueue_style('quest-admin', get_template_directory_uri() . '/css/admin.min.css');
        wp_enqueue_style( 'wp-jquery-ui-dialog');
        wp_enqueue_script( 'jquery-ui-selectmenu');
        wp_enqueue_script('jquery-f-select', get_template_directory_uri() . '/js/jquery-f-select/fSelect.js', array('jquery'), 1.0);
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'admin_enqueue_scripts', 'quest_admin_scripts' );