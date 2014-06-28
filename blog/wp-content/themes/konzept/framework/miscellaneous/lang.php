<?php 
// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'flowthemes', TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

?>