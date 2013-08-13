<?php

	include_once(TEMPLATEPATH . '/inc/plugins/vt_resize.php');
	function pixia_scripts() 
	{
		wp_enqueue_style('pixia_custom_style', get_template_directory_uri() . '/css/custom.css', false, null);
		$pixia_frontend_options=get_option('pixia_theme_options');
		if ($pixia_frontend_options['responsive']=="true") 
		{
			wp_enqueue_style('pirenko_responsive_style', get_template_directory_uri() . '/css/responsive.css', false, null);
		}
		
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
		wp_register_script('froogaloop', get_template_directory_uri() . '/js/froogaloop.js', array( 'jquery'));
		wp_register_script('jquery-color', get_template_directory_uri() . '/js/jquery.color.js', array('jquery'), null, false);
		wp_register_script('easing-functions', get_template_directory_uri() . '/js/easing.js', array('jquery'), null, false);
		wp_register_script('elastislide', get_template_directory_uri() . '/inc/plugins/elastislide/js/jquery.elastislide.js', array('jquery'), null, false);
		wp_register_script('modernizr_or', get_template_directory_uri() . '/js/vendor/modernizr-2.5.3.min.js', array('jquery'), null, false);
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), null, false);
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/inc/plugins/prettyphoto/js/jquery.prettyPhoto.js', array( 'jquery' ));
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ));
		wp_register_script('debounced', get_template_directory_uri() . '/js/jquery.debouncedresize.js', array( 'jquery'));
		wp_register_script('transit', get_template_directory_uri() . '/js/jquery.transit.js', array('jquery'), null, false);
		wp_register_script('simple_retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), null, false);
		
		wp_enqueue_script('roots_plugins');
		wp_enqueue_script('queed_main');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('qtip');
		wp_enqueue_script('froogaloop');
		wp_enqueue_script('jquery-color');
		wp_enqueue_script( 'easing-functions');
		wp_enqueue_script( 'elastislide');
		wp_enqueue_script( 'isotope');
		wp_enqueue_script( 'modernizr');
		wp_enqueue_script( 'prettyPhoto');
		wp_enqueue_script( 'debounced');
		wp_enqueue_script( 'transit');
		wp_enqueue_script( 'simple_retina');
				
		//INCLUDE SCRIPT FROM WORDPRESS CORE
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-button');
		
		//SCRIPTS FOR COLOR MANIPULATION
		wp_register_script( 'color_common', get_template_directory_uri() . '/js/common.js', array('jquery'), null, false);
		wp_register_script( 'color_paint', get_template_directory_uri() . '/js/paintbrush.js', array('jquery'), null, false);
		wp_enqueue_script( 'color_common');
		wp_enqueue_script( 'color_paint');
		
		//POST LIKE SCRIPTS
		wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
		wp_localize_script('like_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
		));
	}
	
	add_action('wp_enqueue_scripts', 'pixia_scripts', 100);
	
	//ADD CUSTOM SCRIPTS FOR THE BACKEND
	function pixia_admin_scripts() 
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/js/admin_scripts.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_register_script('c_picker', get_template_directory_uri() .'/inc/admin/colorpicker.js', array('jquery'), null, false);
		wp_enqueue_script('c_picker');
		wp_register_style( 'c_picker_css', get_template_directory_uri() . '/inc/admin/colorpicker.css' );
		wp_enqueue_style('c_picker_css');
	}
	
	function pixia_admin_styles() 
	{
		wp_enqueue_style('thickbox');
	}
	
	add_action('admin_print_scripts', 'pixia_admin_scripts');
	add_action('admin_print_styles', 'pixia_admin_styles');
?>