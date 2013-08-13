<?php
/**/
// TEMP: Enable update check on every request. Normally you don't need this! This is for testing only!
//set_site_transient('update_themes', null);

// NOTE: All variables and functions will need to be prefixed properly to allow multiple plugins to be updated

/******************Change this*******************/
$api_url = 'http://updates.devatic.com/';
$api_login = get_option('flow_support_login');
$api_password = get_option('flow_support_password');
/************************************************/

/*******************Child Theme******************
//Use this section to provide updates for a child theme
//If using on child theme be sure to prefix all functions properly to avoid 
//function exists errors
if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('stylesheet'));
    $theme_version = $theme_data->Version;  
} else {
    $theme_data = get_theme_data( get_stylesheet_directory() . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('stylesheet');
**************************************************/


/***********************Parent Theme**************/
if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('template'));
    $theme_version = $theme_data->Version;
} else {
    $theme_data = get_theme_data( TEMPLATEPATH . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('template');
/**************************************************/

//Uncomment below to find the theme slug that will need to be setup on the api server
//var_dump($theme_base);

add_filter('pre_set_site_transient_update_themes', 'daisho_check_for_update');
function daisho_check_for_update($checked_data) {
	global $wp_version, $theme_version, $theme_base, $api_url, $api_login, $api_password;

	if(empty($api_login) || empty($api_password)){
		return $checked_data;
	}
	
	$request = array(
		'slug' => $theme_base,
		'version' => $theme_version,
		'username' => $api_login,
		'password' => $api_password
	);
	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update',
			'request' => serialize($request),
			'api-key' => md5(get_bloginfo('url'))
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);
	$raw_response = wp_remote_post($api_url, $send_for_check);
	if(!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)){
		$response = unserialize($raw_response['body']);
	}
	
	// Feed the update data into WP updater
	if(!empty($response)){
		$checked_data->response[$theme_base] = $response;
	}

	return $checked_data;
}

// Take over the Theme info screen on WP multisite
//add_filter('themes_api', 'daisho_api_call', 10, 3);

function daisho_api_call($def, $action, $args) {
	global $theme_base, $api_url, $theme_version;
	
	if ($args->slug != $theme_base)
		return false;
	
	// Get the current version

	$args->version = $theme_version;
	$request_string = prepare_request($action, $args);
	$request = wp_remote_post($api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('themes_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}

/* if (is_admin())
	$current = get_transient('update_themes'); */
	
/* Flow functions */
function getRemote_version(){
	global $wp_version, $theme_version, $theme_base, $api_url, $api_login, $api_password;
	
	/* $response = wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 'username' => 'bob', 'password' => '1234xyz' ),
		'cookies' => array()
		)
	); */

	$request = array(
		'slug' => $theme_base,
		'version' => $theme_version,
		'username' => $api_login,
		'password' => $api_password
	);
	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'basic_theme_information', 
			'request' => serialize($request),
			'api-key' => md5(get_bloginfo('url'))
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);
	
	$raw_response = wp_remote_post($api_url, $send_for_check);
    if (!is_wp_error($raw_response) || wp_remote_retrieve_response_code($raw_response) === 200){  
        return $raw_response['body'];  
    }  
    return false;  
}
function getRemote_verifyUser($user_login, $user_password, $result_boolean = false){
	global $api_url, $api_login, $api_password;

	if(!empty($user_login)){
		$api_login = $user_login;
	}	
	if(!empty($user_password)){
		$api_password = $user_password;
	}
	
	if(empty($api_login) || empty($api_password)){
		return false;
	}

	$raw_response = wp_remote_post( $api_url, array(
		'method' => 'POST',
		'timeout' => 15,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 'action' => 'verify_user', 'request' => serialize(array('username' => $api_login, 'password' => $api_password)) ),
		'cookies' => array()
		)
	);

    if(!is_wp_error($raw_response) || wp_remote_retrieve_response_code($raw_response) === 200){
		$verify_account = json_decode(unserialize($raw_response['body']));
		if($verify_account->error !== null){
			if($result_boolean){
				return false;
			}
			return $verify_account->error->message;
		}else{
			if($result_boolean){
				return true;
			}
			return $verify_account->result->message;
		}
    }
    return false;
}
?>