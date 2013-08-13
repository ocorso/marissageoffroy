<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file to customize admin section
 *
 * /framework/theme-admin.php
 * Version of this file : 1.7
 *
 *
 * Customize login page
 * Customize admin
 * Theme options
 * Customize admin dashboard
 *
 */
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* Customize login page
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wp_admin_login_css' ) ) :
	function wp_admin_login_css() {
		global $data;
		if($data["general_login_screen"]=="1") {
	  		$template_url=get_bloginfo('template_directory');
		    $url = $template_url . '/framework/admin/assets/css/login.css';
	    	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
	  		if ( $data['logo_image']!="" ) {
	  			echo "<style>.login h1 a { background:url(".$data['logo_image'].") no-repeat;}</style>";
	  		}
		}
	  }
	add_action('login_head', 'wp_admin_login_css');
endif;

// changing the logo link from wordpress.org to your site
function bones_login_url() { return home_url(); }
add_filter('login_headerurl', 'bones_login_url');

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option('blogname'); }
add_filter('login_headertitle', 'bones_login_title');

/*-----------------------------------------------------------------------------------*/
/* Customize admin
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'my_admin_menu' ) ) :
	add_action('admin_menu','my_admin_menu');
	function my_admin_menu() {
	  swap_admin_menu_sections('Pages','Media');
	}
endif;

/*-----------------------------------------------------------------------------------*/
/* Theme Options
/*-----------------------------------------------------------------------------------*/
require_once( get_template_directory() . '/framework/admin/index.php');
if(is_admin()) {
	require_once( get_template_directory() . '/framework/admin/update-notifier.php');
}
if(!has_nav_menu('main_nav')) {
		add_action('admin_notices','theme_menu_notice');
		function theme_menu_notice() {
			global $pagenow;

			if($pagenow=="admin.php") {
				echo "<div id='message' style='-webkit-border-radius:3px;border-radius:3px;border-width:1px;border-style:solid;padding:0 .6em;margin:5px 15px 2px;
				background:#ff7c6e;color:#fff;border:1px solid #000;'>";
				echo "<p><strong>Please activate a menu in the <a style='color:#000;' href='".admin_url()."nav-menus.php'>Appearance > Menus</a> tab to start displaying the icons in the top right bar.</strong></p>";
				echo '</div>';
			}
		}
}

/*-----------------------------------------------------------------------------------*/
/* Customize admin dashboard
/*-----------------------------------------------------------------------------------*/
	/*
	This file handles the admin area and functions.
	You can use this file to make changes to the
	dashboard. Updates to this page are coming soon.
	It's turned off by default, but you can call it
	via the functions file.

	Developed by: Eddie Machado
	URL: http://themble.com/bones/

	Special Thanks for code & inspiration to:
	@jackmcconnell - http://www.voltronik.co.uk/
	Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

	*/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}
add_action('admin_menu', 'disable_default_dashboard_widgets');