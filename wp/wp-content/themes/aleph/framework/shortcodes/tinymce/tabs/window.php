<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/shortcodes/tinymce/tabs/window.php
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
<title>Tabs Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/shortcodes/tinymce/tabs/tinymce.js?1.1"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:100%; }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_tabs" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Tab type</legend>
		<select id="tab_type" name="tab_type">
			<option value="nav-tabs">Regular tabs</option>
			<option value="nav-pills">Pills</option>
			<option value="nav-tabs nav-stacked">Stacked tabs</option>
			<option value="nav-pills nav-stacked">Stacked pills</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Tabs orientation</legend>
		<select id="tab_orientation" name="tab_orientation">
			<option value="tabs-top">Top</option>
			<option value="tabs-below">Bottom</option>
			<option value="tabs-left">Left</option>
			<option value="tabs-right">Right</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Number of tabs</legend>
		<select id="tab_count" name="tab_count">
			<option value="1">1</option>
			<option value="2">1</option>
			<option value="3" selected>3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Generate shortcode" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
