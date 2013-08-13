<?php 
/*
Plugin Name: Add Shortcode
Plugin URI:
Description: Module that adds "Add Shortcode" icon to admin panel.
Version: 1.0
Author: Flow
Author URI:
*/

if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );

class FlowShortcodesButton
{
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// execute in the admin panel for users with edit_posts permissions
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		// add new button with an id of #flow_shortcodes_button
		array_push( $buttons, '|', 'flow_shortcodes_button' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		$plugins['flowshortcodesbutton'] = get_template_directory_uri(). '/framework/admin/shortcodes/shortcode_button.js';
		return $plugins;
	}
}

$flowshortcodesbutton = new FlowShortcodesButton();