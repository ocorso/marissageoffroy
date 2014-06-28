<?php
function load_codemirror_files(){

	/* CORE */
	wp_register_script( 'codemirror', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/codemirror.js', array('jquery') );
	
	/* LANGUAGES... */
	wp_register_script( 'codemirror_javascript', get_bloginfo('template_directory') . '/framework/admin/codemirror/mode/javascript/javascript.js', array('codemirror') );
	wp_register_script( 'codemirror_css', get_bloginfo('template_directory') . '/framework/admin/codemirror/mode/css/css.js', array('codemirror') );
	wp_register_script( 'codemirror_htmlmixed', get_bloginfo('template_directory') . '/framework/admin/codemirror/mode/htmlmixed/htmlmixed.js', array('codemirror') );
	wp_register_script( 'codemirror_xml', get_bloginfo('template_directory') . '/framework/admin/codemirror/mode/xml/xml.js', array('codemirror') );
	
	/* UTILITIES... */
	wp_register_script( 'codemirror_formatting', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/formatting.js', array('codemirror') );
	wp_register_script( 'codemirror_closetag', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/closetag.js', array('codemirror') );
	wp_register_script( 'codemirror_searchcursor', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/searchcursor.js', array('codemirror') );
	wp_register_script( 'codemirror_match_highlighter', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/match-highlighter.js', array('codemirror') );
	wp_register_script( 'codemirror_searchcursor', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/searchcursor.js', array('codemirror') );
	wp_register_script( 'codemirror_search', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/search.js', array('codemirror') );
	wp_register_script( 'codemirror_dialog', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/dialog.js', array('codemirror') );
	
	/* LAUNCH IT! */
	wp_register_script( 'codemirror_init', get_bloginfo('template_directory') . '/framework/admin/codemirror/codemirror.js', array('codemirror') );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'codemirror' );
	
	wp_enqueue_script( 'codemirror_javascript' );
	wp_enqueue_script( 'codemirror_css' );
	wp_enqueue_script( 'codemirror_htmlmixed' );
	wp_enqueue_script( 'codemirror_xml' );
	
	wp_enqueue_script( 'codemirror_formatting' );
	wp_enqueue_script( 'codemirror_closetag' );
	wp_enqueue_script( 'codemirror_searchcursor' );
	wp_enqueue_script( 'codemirror_match_highlighter' );
	wp_enqueue_script( 'codemirror_searchcursor' );
	wp_enqueue_script( 'codemirror_search' );
	wp_enqueue_script( 'codemirror_dialog' );
	
	wp_enqueue_script( 'codemirror_init' );
	
	/* STYLES START HERE */
	wp_register_style( 'codemirror_css', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/codemirror.css', false );
	wp_register_style( 'codemirror_css_ambiance', get_bloginfo('template_directory') . '/framework/admin/codemirror/theme/ambiance.css', false );
	wp_register_style( 'codemirror_css_init', get_bloginfo('template_directory') . '/framework/admin/codemirror/codemirror.css', false );
	wp_register_style( 'codemirror_css_dialog', get_bloginfo('template_directory') . '/framework/admin/codemirror/lib/util/dialog.css', false );
	wp_enqueue_style( 'codemirror_css' );
	wp_enqueue_style( 'codemirror_css_ambiance' );
	wp_enqueue_style( 'codemirror_css_dialog' );
	wp_enqueue_style( 'codemirror_css_init' );
}
add_action('admin_enqueue_scripts', 'load_codemirror_files');
?>