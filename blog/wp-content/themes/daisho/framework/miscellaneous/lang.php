<?php
add_action('after_setup_theme', 'flow_translation_load');
function flow_translation_load(){
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'flowthemes', TEMPLATEPATH.'/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH."/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);
}

// CHANGE LOCAL LANGUAGE
// must be called before load_theme_textdomain()
add_filter('locale', 'flow_language_change');
function flow_language_change($locale){
	if(isset($_GET['l'])){
		return $_GET['l'];
	}
	return $locale;
}
/* function flow_language_change($locale){
	if(isset($_GET['l'])){
		$_SESSION['l'] = $_GET['l'];
		return $_GET['l'];
	}else if(isset($_SESSION['l']){
		return $_SESSION['l'];
	}
	return $locale;
} */
?>