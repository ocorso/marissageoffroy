<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/shortcodes/tinymce/alerts/window.php
 * Version of this file : 1.0
 * 
 */
?>
<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here",'alephtheme'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Alerts Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/shortcodes/tinymce/alerts/tinymce.js?1.1"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:100%; }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_alerts" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Alert type</legend>
		<select id="alert_type" name="alert_type">
			<option value="blue">Information (blue)</option>
			<option value="green">Success (green)</option>
			<option value="red">Error (red)</option>
			<option value="yellow">Warning (yellow)</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Alert content</legend>
		<textarea id="alert_content" name="alert_content" cols="80" rows="4"></textarea>
	</fieldset>
	<fieldset>
		<legend>Add close button</legend>
		<select id="alert_close" name="alert_close">
			<option value="on" selected>Yes</option>
			<option value="off">No</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Fade in animation (for closing)</legend>
		<select id="alert_fade" name="alert_fade">
			<option value="on" selected>Yes</option>
			<option value="off">No</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Display as block</legend>
		<select id="alert_block" name="alert_block">
			<option value="on">Yes</option>
			<option value="off" selected>No</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Generate shortcode" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
