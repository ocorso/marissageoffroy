<?php
	require_once (TEMPLATEPATH . '/framework/miscellaneous/updater.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/excerpt.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/usefulvariables.php');
	
	require_once (TEMPLATEPATH . '/framework/admin/admin-menu.php');
	require_once (TEMPLATEPATH . '/framework/admin/shortcodes/shortcode-generator.php');
	$flow_seo_module = get_option("flow_seo_module");
	if($flow_seo_module == 1){ }else{
		require_once (TEMPLATEPATH . '/framework/admin/seo/flow-seo.php');
	}
	require_once (TEMPLATEPATH . '/framework/admin/meta-boxes.php');
	require_once (TEMPLATEPATH . '/framework/admin/portfolio-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/slideshow-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/news-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/toolbar.php');

	require_once (TEMPLATEPATH . '/framework/miscellaneous/add_theme_support.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/allowed_mimes.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/body_class.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/is_.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/nav.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/lang.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/menus.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/sidebars-generator.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/sidebars.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/search.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/comments.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/theme_activate.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/hexdarker.php');
	
	//require_once (TEMPLATEPATH . '/framework/admin/shortcodes/DI-shortcode_button.php'); //Module that adds "Add Shortcode" icon to admin panel. DISABLED
	require_once (TEMPLATEPATH . '/framework/admin/codemirror/codemirror.php'); 

	add_action('init', 'init_loadshortcodes');
	function init_loadshortcodes(){
		require_once (TEMPLATEPATH . '/framework/shortcodes/loader.php');
	}
	
	//require_once (TEMPLATEPATH . '/framework/widgets/loader.php');
	
	add_action('init', 'my_init_method');
	add_action('wp_enqueue_scripts', 'my_scripts_method');
	add_action('admin_enqueue_scripts', 'my_wp_admin_scripts_method');
	add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// unregister all default WP Widgets
function unregister_default_wp_widgets(){
    //unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    //unregister_widget('WP_Widget_Archives');
    //unregister_widget('WP_Widget_Links');
    //unregister_widget('WP_Widget_Meta');
    //unregister_widget('WP_Widget_Search');
    //unregister_widget('WP_Widget_Text');
    //unregister_widget('WP_Widget_Categories');
    //unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    //unregister_widget('WP_Widget_Tag_Cloud');
}
	
/* A tricky method to add scripts only on particular admin sub pages by Flow
add_action( "admin_print_scripts-options.php", 'my_admin_scripts' );

function my_admin_scripts() {
} 
*/
function my_init_method(){
}

function my_scripts_method(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	//wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-accordion');
	//wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tabs');
	//wp_enqueue_script('jquery-ui-sortable');
	//wp_enqueue_script('jquery-ui-draggable');
	//wp_enqueue_script('jquery-ui-droppable');
	//wp_enqueue_script('jquery-ui-selectable');
	//wp_enqueue_script('jquery-ui-datepicker');
	//wp_enqueue_script('jquery-ui-resizable');
	//wp_enqueue_script('jquery-ui-dialog');
	//wp_enqueue_script('jquery-ui-button');

	if(is_singular()){
		wp_enqueue_script('comment-reply');
	}
}

function my_wp_admin_scripts_method(){
	/* 
	wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
	wp_enqueue_script(Default: None - Name of the script. Lowercase string., false, array(), false, false);
	A complete list of registered files - inspect the $GLOBALS['wp_scripts'] in the admin UI. Registered scripts might change per requested page.
	*/
	wp_register_script( 'brisk-uploader', get_bloginfo( 'template_directory').'/framework/admin/scripts/brisk-uploader.js', array('jquery', 'thickbox'));
	wp_register_script( 'flow-uploader', get_bloginfo( 'template_directory').'/framework/admin/scripts/flow-uploader.js', array('jquery', 'media-upload')); // WP3.5 Media Gallery
	wp_register_style( 'flow-uploader', get_bloginfo( 'template_directory').'/framework/admin/scripts/flow-uploader.css');
	
	/* colorpicker field in meta-boxes.php */
	wp_register_style( 'FlowTypographyStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/style.css' );
	wp_register_style( 'FlowTypographyMainStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/css/colorpicker.css' );
	wp_register_style( 'FlowTypographyLayoutStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/css/layout-flow.css' );
	wp_register_style( 'superslide-style', get_bloginfo('template_directory') . '/framework/admin/superslide/style.css' );
	wp_register_script('image_sampler', get_bloginfo('template_directory') . '/framework/admin/imagesampler/jquery.ImageColorPicker.js', array('jquery', 'jquery-ui-widget'), '1.0', true);
	wp_register_script('jquery_colorpicker_script', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/colorpicker.js', array('jquery'), '1.0' );
	wp_register_script('jquery_colorpicker_script2', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/eye.js', array('jquery', 'jquery_colorpicker_script'), '1.0' );
	wp_register_script('jquery_colorpicker_script3', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/layout.js', array('jquery', 'jquery_colorpicker_script2'), '1.0' );
	wp_register_script('jquery_colorpicker_script4', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/utils.js', array('jquery', 'jquery_colorpicker_script3'), '1.0' );
	wp_register_script('jquery_colorpicker_script_main', get_bloginfo('template_directory') . '/framework/admin/colorpicker/colorpicker_uruchamiajacy_w_adminie.js', array('jquery', 'jquery_colorpicker_script'), '1.0' );
	wp_register_script('plupload_queue', get_bloginfo('template_directory') . '/framework/admin/superslide/jquery.plupload.queue.js', array('jquery'), '1.0' );
	
	wp_enqueue_script('jquery');
	/* wp_enqueue_script('jquery-ui-core', false, array('jquery'), false, true);
	wp_enqueue_script('jquery-ui-widget', false, array('jquery'), false, true); */
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');
	
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('brisk-uploader');
	
	wp_enqueue_media();
	wp_enqueue_script('flow-uploader');
	wp_enqueue_style('flow-uploader');
	
	// WordPress Module
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	
	wp_enqueue_style( 'FlowTypographyLayoutStylesheet' );
	wp_enqueue_style( 'FlowTypographyStylesheet' );
	wp_enqueue_style( 'FlowTypographyMainStylesheet' );
	wp_enqueue_style( 'superslide-style' );
	wp_enqueue_script('image_sampler');
	wp_enqueue_script('jquery_colorpicker_script');
	wp_enqueue_script('jquery_colorpicker_script2');
	wp_enqueue_script('jquery_colorpicker_script3');
	wp_enqueue_script('jquery_colorpicker_script4');
	wp_enqueue_script('jquery_colorpicker_script_main');
	wp_enqueue_script('plupload-full');
	wp_enqueue_script('plupload-handlers');
	wp_enqueue_script('plupload_queue');
	wp_enqueue_script('swfobject');
}

/* The purpose of $content_width: http://core.trac.wordpress.org/ticket/5777 */
if(!isset($content_width)){
	$content_width = 1120;
}

function flow_default_post_content($post_content, $post){
    if($post->post_type){
		switch($post->post_type){
			case 'page':
				$post->comment_status = 'closed';
				$post->ping_status = 'closed';
				break;
		}
	}
    return $post_content;
}
add_filter('default_content', 'flow_default_post_content', 10, 2);

	add_action('admin_head', 'flow_page_placeholder');
	function flow_page_placeholder(){
		$front_page_id = get_option('front_page');
		if(!empty($front_page_id)){
			echo '<style>#post-'.$front_page_id.' { background-color: #FFFFCC; } #post-'.$front_page_id.' .post-title strong:after { color: #999999; content: "'.__('(This page is a placeholder for front page)', 'flowthemes').'"; font-size: 11px; font-style: italic; font-weight: normal; text-decoration: none; margin-left: 10px;</style>';
		}
	}
	
	remove_filter( 'the_content', 'wpautop' );
	//remove_filter( 'the_excerpt', 'wpautop' );
?>