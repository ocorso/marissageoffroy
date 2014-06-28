<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/shortcodes/tinymce/config.php
 * Version of this file : 1.0
 * 
 */
?>
<?php
/**
 * Look for the server path to the file wp-load.php for user authentication
 *
 */

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

?>