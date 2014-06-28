<?php 
	add_action( 'admin_init', 'flow_admin_styles_init' );
	add_action( 'admin_init', 'flow_admin_styles_enqueue' );
   
	function flow_admin_styles_init() {
		wp_register_style( 'FlowTypographyStylesheet2', get_bloginfo('template_directory') . '/framework/admin/style.css' );
	}
	function flow_admin_styles_enqueue() {
		wp_enqueue_style( 'FlowTypographyStylesheet2' );
	}
	
add_action('admin_menu', 'create_admin_menu');
add_action('admin_menu', 'create_footer_menu');
//add_action('admin_menu', 'create_portfolio_menu');
add_action('admin_menu', 'create_blog_menu');
//add_action('admin_menu', 'create_slideshow_menu');
add_action('admin_menu', 'create_background_menu');

function create_admin_menu() {
    add_menu_page(__('Konzept','flowthemes'), __('Konzept','flowthemes'), 'manage_options', 'brisk-mainmenu', 'add_main_menu2', '', 40 );
	add_submenu_page('brisk-mainmenu', __( 'General', 'flowthemes' ), __( 'General', 'flowthemes' ), 'manage_options', 'brisk-mainmenu', 'add_main_menu2');
}

function create_footer_menu() {
    add_submenu_page('brisk-mainmenu', __('Footer','flowthemes'), __('Footer','flowthemes'), 'manage_options', 'sub-page', 'add_footer_menu');
}

//function create_portfolio_menu() {
//    add_submenu_page('brisk-mainmenu', __('Portfolio','flowthemes'), __('Portfolio','flowthemes'), 'manage_options', 'sub-page2', 'add_portfolio_menu');
//}

//function create_slideshow_menu() {
//    add_submenu_page('brisk-mainmenu', __('Slideshow','flowthemes'), __('Slideshow','flowthemes'), 'manage_options', 'sub-page3', 'add_slideshow_menu');
//}

function create_blog_menu() {
    add_submenu_page('brisk-mainmenu', __('Blog','flowthemes'), __('Blog','flowthemes'), 'manage_options', 'sub-page4', 'add_blog_menu');
}

function create_background_menu() {
   add_submenu_page('brisk-mainmenu', __('Styling','flowthemes'), __('Styling','flowthemes'), 'manage_options', 'sub-page41', 'add_bg_menu');
}

require('main-menu.php');
//require('portfolio-menu.php');
require('blog-menu.php');
require('footer-menu.php');
//require('slideshow-menu.php');
require('background-menu.php');
?>
