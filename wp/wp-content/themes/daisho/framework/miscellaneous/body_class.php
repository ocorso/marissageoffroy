<?php
add_filter('body_class','flow_class_names');
function flow_class_names($classes){

	$portfolio_mode = get_option('portfolio_mode'); /* 1 = thumbnail grid, 0 = classic */
	if(!empty($_GET['prj']) && $_GET['prj'] == 'classic'){ $portfolio_mode = 0; }
	if(!empty($_GET['prj']) && $_GET['prj'] == 'thumb'){ $portfolio_mode = 1; }
	
	$classes[] = 'flow-skin-0';
	
	$front_page = get_option('front_page');
	
	if((($portfolio_mode == '1' and is_home()) or is_page_template('template-portoflio.php')) or ($portfolio_mode == '1' and is_singular('portfolio'))){ /* THUMBNAIL VIEW */
		$classes[] = 'daisho-portfolio';
	}else if(($portfolio_mode == '0' and is_home()) || ($portfolio_mode == '0' && is_singular('portfolio'))){ /* CLASSIC VIEW */
		$classes[] = 'daisho-classic';
		if(!get_option('flow_featured_slideshow')){
			$classes[] = 'daisho-classic-has-slideshow';
		}
		if($front_page != '' && $front_page != 'none' && get_post_meta((int) $front_page, 'page_portfolio_welcome_text', true)){
			$classes[] = 'daisho-classic-has-welcome-text';
		}
	}
	
	if(is_singular('portfolio')){
		$classes[] = 'daisho-portfolio-viewing-project';
	}
		
	// add 'class-name' to the $classes array
	//$classes[] = 'class-name';
	
	/* Potential fix for styling */
	/* global $ipad;
	global $mobile;
	
	if(isset($ipad) && ($ipad || $mobile)){
		$classes[] = 'apple';
	} */
	
	// return the $classes array
	return $classes;
}
?>