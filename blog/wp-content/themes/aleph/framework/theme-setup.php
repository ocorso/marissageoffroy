<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file containg essential setup
 *
 * /framework/theme-setup.php
 * Version of this file : 1.7
 *
 */
?>
<?php

add_action( 'after_setup_theme', 'aleph_setup' );

/**
 * ------------------------------------------------------------------------
 * Setup fonctions
 * ------------------------------------------------------------------------
 */
if ( ! function_exists( 'aleph_setup' ) ):

	function aleph_setup() {
	
		// Define directory constant
			define('PARENT_DIR', get_template_directory());
	
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
			load_theme_textdomain( 'alephtheme', get_template_directory() . '/languages' );
			$locale = get_locale();
			$locale_file = get_template_directory() . "/languages/$locale.php";
			if ( is_readable( $locale_file ) )
				require_once( $locale_file );
	
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style('editor-style.css');
	
		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );
	
		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 200, 200, true);
		add_image_size( 'edit-screen-thumbnail', 100, 75, true );
		add_image_size( 'portfolio-thumb', 800, 600, true);
		add_image_size( 'portfolio-thumbnail', 400, 225, true);
		add_image_size( 'portfolio-thumbnail-prop', 400, '', false);
		
		// Set content width
		if ( ! isset( $content_width ) ) $content_width = 940;
		
		add_theme_support( 'custom-background', array(
			'default-color' => '',
		) );
	
		add_theme_support( 'menus' );            // wp menus
		register_nav_menus(                      // wp3+ menus
			array( 
				'main_nav' => 'The Main Menu',   // main nav in header
			)
		);	

		register_sidebar( array(
			'name' => __( 'Footer area 1', 'alephtheme' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer area 2', 'alephtheme' ),
			'id' => 'sidebar-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer area 3', 'alephtheme' ),
			'id' => 'sidebar-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
		
		// Remove Twenty Eleven Options page
		remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
	
	}
endif; // aleph_setup