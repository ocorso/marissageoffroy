<?php
function flow_install_theme_settings($install = false, $return = false, $uninstall = false){
	$theme_settings = array(
		'flowessencethemeactivated' => 1,
		'flow_logo' => 'http://themes.devatic.com/daisho/wp-content/uploads/2012/05/logo.png',
		'flow_logo_svg' => 'http://themes.devatic.com/daisho/wp-content/uploads/2012/10/daisho.svg',
		'tagline_disable' => '0',
		'custom_favicon' => 'http://themes.devatic.com/daisho/wp-content/uploads/2012/06/favicon.png',
		'flow_mobile_app_icon' => 'http://themes.devatic.com/daisho/wp-content/uploads/2013/02/mobile-app-icon.png',
		'portfolio_mode' => '1',
		'flow_featured_slideshow' => '0',
		'portfolio_recent' => '0',
		'blog_recent' => '0',
		'front_page' => '3232',
		'info_box' => '3393',
		'flow_portfolio_page' => '3433',
		'flow_blog_page' => '2482',
		'flow_homepage_shuffle_button' => '',
		'flow_wpml_switcher' => 0,
		'flow_styling' => array('.conatainer_language_selector' => array('top' => '5px', 'left' => '170px')),
		'flow_portfolio_orderbymethod' => 0,
		'analytics_code' => '',
		'custom_css_style' => '',
		'blog_items_per_page' => '5',
		'blog_exclude_categories' => '',
		'footer_aff_link' => 'off',
		'footer_col_countcustom' => 'grid_12 grid_not_responsive, grid_12, grid_6 push_6 last, grid_6 pull_6'
	);
	if($return){
		return $theme_settings;
	}
	if($install && is_admin() && current_user_can('manage_options') && current_user_can('edit_theme_options')){
		foreach($theme_settings as $k => $v){
			update_option($k, $v);
		}
		return true;
	}	
	if($uninstall && is_admin() && current_user_can('manage_options') && current_user_can('edit_theme_options')){
		foreach($theme_settings as $k => $v){
			delete_option($k);
		}
		return true;
	}
	return false;
}
function flow_theme_activate(){
	global $pagenow;
	if(is_admin() && $pagenow == 'themes.php' && isset($_GET['activated'])){
		if(!get_option("flowessencethemeactivated")){
			flow_install_theme_settings(true, false, false);
		}
		wp_redirect(admin_url("admin.php?page=sub-page42"));
		exit();
	}
}
add_action('after_setup_theme', 'flow_theme_activate');
?>