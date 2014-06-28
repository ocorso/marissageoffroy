<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file containing scripts to be loaded
 *
 * /framework/scripts.php
 * Version of this file : 1.7
 *
 */
?>
<?php

	function JS_scripts() {

		global $data;
		$file_dir=get_bloginfo('template_directory');

		/**
		 * -------------------------------------------------
		 * 	jQuery plugins
		 * -------------------------------------------------
		 */
		if(!is_admin()) {
		wp_enqueue_script( 'plugins', $file_dir . '/js/plugins.js', array('jquery'), '1.6', true );
		wp_enqueue_script( 'main', $file_dir . '/js/main.js', array('jquery'), '1.6', true );
			if($data["contact_activate"]==true) {
				wp_enqueue_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false');
				wp_enqueue_script( 'ajax-contact', $file_dir . '/js/ajax-contact.js', array('jquery'), '1.0', true );
			}
			if($data["header_fullscreen"]=="1") {
				wp_enqueue_script( 'screenfull', $file_dir . '/js/screenfull.js', array('jquery'), '1.0', true );
			}
			if($data["footer_sidebar_activate"]==true) {
				wp_enqueue_script( 'tweet', $file_dir . '/js/tweet.js', array('jquery'), '1.0', true );
			}
			//	Cufon
			if($data["cufon_activate"]==true) {
				wp_enqueue_script( 'cufon', $file_dir.'/js/cufon-yui.js', array('jquery'), '1.0', true );
				$font1=$data["cufon_font1_source"];
				wp_enqueue_script( 'font1', $file_dir . '/js/fonts/cufon/'.$font1, array('jquery'), '1.0', true );
				if($data["cufon_font2_activate"]=="1") {
					$font2=$data["cufon_font2_source"];
					wp_enqueue_script( 'font2', $file_dir . '/js/fonts/cufon/'.$font1, array('jquery'), '1.0', true );
				}
			}
			if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		}

	}
	add_action('init', 'JS_scripts');