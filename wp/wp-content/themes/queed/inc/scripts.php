<?php

	include_once(TEMPLATEPATH . '/inc/plugins/vt_resize.php');
	
	function queed_scripts() 
	{
		wp_enqueue_style('roots_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.css', false, null);
		
		if (current_theme_supports('bootstrap-responsive')) 
		{
			wp_enqueue_style('roots_bootstrap_responsive_style', get_template_directory_uri() . '/css/bootstrap-responsive.css', array('roots_bootstrap_style'), null);
		}
		
		//wp_enqueue_style('roots_app_style', get_template_directory_uri() . '/css/app.css', false, null);
	
		wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/inc/plugins/flexslider/flexslider.css', false, null);
		wp_enqueue_style('elastislide_css', get_template_directory_uri() . '/inc/plugins/elastislide/css/elastislide.css', false, null);
		wp_enqueue_style('better_comments_css', get_template_directory_uri() .'/inc/theme_widgets/decent-comments/css/decent-comments-widget.css', false, null);
		wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/inc/plugins/prettyphoto/css/prettyPhoto.css' );
		wp_enqueue_style('prettyPhoto');
		wp_register_style( 'qtip_css', get_template_directory_uri() . '/inc/plugins/qtip/jquery.qtip.css' );
		wp_enqueue_style('qtip_css');
		
		
		
		if (is_child_theme()) 
		{
			wp_enqueue_style('roots_child_style', get_stylesheet_uri());
		}
	
		if (is_single() && comments_open() && get_option('thread_comments')) 
		{
			wp_enqueue_script('comment-reply');
		}
	
		wp_register_script('queed_main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, false);
		wp_register_script('flexslider', get_template_directory_uri() . '/inc/plugins/flexslider/jquery.flexslider-min.js', array('jquery'), null, false);
		wp_register_script('qtip', get_template_directory_uri() . '/inc/plugins/qtip/jquery.qtip.js', array('jquery'), null, false);
		//wp_register_script('fitvid', get_template_directory_uri() . '/inc/plugins/flexslider/jquery.fitvid.js', false, null, false);
		wp_register_script('jquery-color', get_template_directory_uri() . '/js/jquery.color.js', array('jquery'), null, false);
		wp_register_script( 'easing-functions', get_template_directory_uri() . '/js/easing.js', array('jquery'), null, false);
		wp_register_script('elastislide', get_template_directory_uri() . '/inc/plugins/elastislide/js/jquery.elastislide.js', array('jquery'), null, false);
		wp_register_script( 'quicksand', get_template_directory_uri() . '/js/quicksand.js', array('jquery'), null, false);
		wp_register_script( 'modernizr_or', get_template_directory_uri() . '/js/vendor/modernizr-2.5.3.min.js', array('jquery'), null, false);
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), null, false);
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/inc/plugins/prettyphoto/js/jquery.prettyPhoto.js', array( 'jquery' ));
		wp_register_script( 'transit', get_template_directory_uri() . '/js/jquery.transit.js', array('jquery'), null, false);
		
		wp_enqueue_script('roots_plugins');
		wp_enqueue_script('queed_main');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('qtip');
		//wp_enqueue_script('fitvid');
		wp_enqueue_script('jquery-color');
		wp_enqueue_script( 'easing-functions');
		wp_enqueue_script( 'elastislide');
		wp_enqueue_script( 'quicksand');
		//wp_enqueue_script( 'pixastic');
		wp_enqueue_script( 'modernizr');
		wp_enqueue_script( 'prettyPhoto');
		wp_enqueue_script( 'transit');
		
		//INCLUDE SCRIPT FROM WORDPRESS CORE
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui');
		
		
		//MENU SCRIPTS
		// Register each script, setting appropriate dependencies
		wp_register_script('hoverintent', get_template_directory_uri() . '/inc/plugins/superfish/js/hoverIntent.js');
		wp_register_script('bgiframe',    get_template_directory_uri() . '/inc/plugins/superfish/js/jquery.bgiframe.min.js');
		wp_register_script('superfish',   get_template_directory_uri() . '/inc/plugins/superfish/js/superfish.js', array( 'jquery', 'hoverintent', 'bgiframe' ));
		wp_register_script('supersubs',   get_template_directory_uri() . '/inc/plugins/superfish/js/supersubs.js', array( 'superfish' ));
	
		// Enqueue supersubs, we don't need to enqueue any others in this case, as the dependencies take care of it for us
		wp_enqueue_script('supersubs');
	
		// Register each style, setting appropriate dependencies
		wp_register_style('superfishbase',   get_template_directory_uri() . '/inc/plugins/superfish/css/superfish.css');
		wp_register_style('superfishvert',   get_template_directory_uri() . '/inc/plugins/superfish/css/superfish-vertical.css', array( 'superfishbase' ));
		wp_register_style('superfishnavbar', get_template_directory_uri() . '/inc/plugins/superfish/css/superfish-navbar.css', array( 'superfishvert' ));

	// Enqueue superfishnavbar, we don't need to enqueue any others in this case either, as the dependencies take care of it
	wp_enqueue_style('superfishbase');
	}
	
	add_action('wp_enqueue_scripts', 'queed_scripts', 100);
	
	//ADD CUSTOM SCRIPTS FOR THE BACKEND
	function queed_admin_scripts() 
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/js/admin_scripts.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
	}
	
	function queed_admin_styles() 
	{
		wp_enqueue_style('thickbox');
	}
	
	add_action('admin_print_scripts', 'queed_admin_scripts');
	add_action('admin_print_styles', 'queed_admin_styles');
?>