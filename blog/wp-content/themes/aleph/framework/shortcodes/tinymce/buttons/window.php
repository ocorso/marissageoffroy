<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/shortcodes/tinymce/buttons/window.php
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
<title>Buttons Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/framework/shortcodes/tinymce/buttons/tinymce.js?1.1"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/framework/shortcodes/icons.css">
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:100%; }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}


.of-radio-tile-img {
	width:20px;
	height:20px;
	border:3px solid #f9f9f9;
	margin:0 5px 10px 0;
	display:none;
	cursor:pointer;
	float:left;
	font-size: 20px;
	text-align: center;
}
.of-radio-tile-img em {
	font-size: 20px;
	line-height: 20px;
	width: 20px;
	height: 20px;
	vertical-align: bottom;
}
.of-radio-tile-selected {
	border:3px solid #ccc
}
.of-radio-tile-img:hover {
	opacity:.8;
}
input.checkbox {
	width: 20px;
	margin-top:3px;
}
input.of-radio {
	width: 20px;
}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_button" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Button color</legend>
		<select id="buttons_shortcode" name="buttons_shortcode">
			<option value="default">Light grey (default)</option>
			<option value="primary">Blue (primary)</option>
			<option value="info">Light blue (info)</option>
			<option value="success">Green (success)</option>
			<option value="warning">Orange (warning)</option>
			<option value="danger">Red (danger)</option>
			<option value="inverse">Black (inverse)</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Button size</legend>
		<select id="buttons_size" name="buttons_size">
			<option value="small">Small</option>
			<option value="medium" selected>Medium</option>
			<option value="large">Large</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Button Text</legend>
		<input id="buttons_text" value="Text" name="buttons_text" type="text">
	</fieldset>
	<fieldset>
		<legend>Button Link</legend>
		<input id="buttons_link" value="" name="buttons_link" type="text">
	</fieldset>
	<fieldset>
		<legend>Button Target</legend>
		<select id="buttons_target" name="buttons_target">
			<option value="_self">Open in Same Window</option>
			<option value="_blank">Open in New Window</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Inner link ? (check this if it is an inner link)</legend>
		<select id="buttons_inner_link" name="buttons_inner_link">
			<option value="true" selected>True</option>
			<option value="false">False</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Inner link level (if the option above is true)</legend>
		<select id="buttons_inner_level" name="buttons_inner_level">
			<option value="sub" selected>Sub/None</option>
			<option value="top">Top</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Icon</legend>

		<input name="buttons_icon" type="radio" value="icon-adjust" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-adjust"></em></div>

		<input name="buttons_icon" type="radio" value="icon-asterisk" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-asterisk"></em></div>

		<input name="buttons_icon" type="radio" value="icon-ban-circle" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-ban-circle"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bar-chart" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bar-chart"></em></div>

		<input name="buttons_icon" type="radio" value="icon-barcode" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-barcode"></em></div>

		<input name="buttons_icon" type="radio" value="icon-beaker" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-beaker"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bell" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bell"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bolt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bolt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-book" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-book"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bookmark" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bookmark"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bookmark-empty" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bookmark-empty"></em></div>

		<input name="buttons_icon" type="radio" value="icon-briefcase" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-briefcase"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bullhorn" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bullhorn"></em></div>

		<input name="buttons_icon" type="radio" value="icon-calendar" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-calendar"></em></div>

		<input name="buttons_icon" type="radio" value="icon-camera" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-camera"></em></div>

		<input name="buttons_icon" type="radio" value="icon-camera-retro" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-camera-retro"></em></div>

		<input name="buttons_icon" type="radio" value="icon-certificate" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-certificate"></em></div>

		<input name="buttons_icon" type="radio" value="icon-check" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-check"></em></div>

		<input name="buttons_icon" type="radio" value="icon-check-empty" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-check-empty"></em></div>

		<input name="buttons_icon" type="radio" value="icon-cloud" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-cloud"></em></div>

		<input name="buttons_icon" type="radio" value="icon-cog" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-cog"></em></div>

		<input name="buttons_icon" type="radio" value="icon-cogs" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-cogs"></em></div>

		<input name="buttons_icon" type="radio" value="icon-comment" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-comment"></em></div>

		<input name="buttons_icon" type="radio" value="icon-comment-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-comment-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-comments" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-comments"></em></div>

		<input name="buttons_icon" type="radio" value="icon-comments-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-comments-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-credit-card" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-credit-card"></em></div>

		<input name="buttons_icon" type="radio" value="icon-dashboard" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-dashboard"></em></div>

		<input name="buttons_icon" type="radio" value="icon-download" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-download"></em></div>

		<input name="buttons_icon" type="radio" value="icon-download-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-download-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-edit" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-edit"></em></div>

		<input name="buttons_icon" type="radio" value="icon-envelope" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-envelope"></em></div>

		<input name="buttons_icon" type="radio" value="icon-envelope-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-envelope-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-exclamation-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-exclamation-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-external-link" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-external-link"></em></div>

		<input name="buttons_icon" type="radio" value="icon-eye-close" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-eye-close"></em></div>

		<input name="buttons_icon" type="radio" value="icon-eye-open" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-eye-open"></em></div>

		<input name="buttons_icon" type="radio" value="icon-facetime-video" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-facetime-video"></em></div>

		<input name="buttons_icon" type="radio" value="icon-film" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-film"></em></div>

		<input name="buttons_icon" type="radio" value="icon-filter" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-filter"></em></div>

		<input name="buttons_icon" type="radio" value="icon-fire" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-fire"></em></div>

		<input name="buttons_icon" type="radio" value="icon-flag" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-flag"></em></div>

		<input name="buttons_icon" type="radio" value="icon-folder-close" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-folder-close"></em></div>

		<input name="buttons_icon" type="radio" value="icon-folder-open" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-folder-open"></em></div>

		<input name="buttons_icon" type="radio" value="icon-gift" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-gift"></em></div>

		<input name="buttons_icon" type="radio" value="icon-glass" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-glass"></em></div>

		<input name="buttons_icon" type="radio" value="icon-globe" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-globe"></em></div>

		<input name="buttons_icon" type="radio" value="icon-group" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-group"></em></div>

		<input name="buttons_icon" type="radio" value="icon-hdd" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-hdd"></em></div>

		<input name="buttons_icon" type="radio" value="icon-headphones" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-headphones"></em></div>

		<input name="buttons_icon" type="radio" value="icon-heart" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-heart"></em></div>

		<input name="buttons_icon" type="radio" value="icon-heart-empty" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-heart-empty"></em></div>

		<input name="buttons_icon" type="radio" value="icon-home" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-home"></em></div>

		<input name="buttons_icon" type="radio" value="icon-inbox" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-inbox"></em></div>

		<input name="buttons_icon" type="radio" value="icon-info-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-info-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-key" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-key"></em></div>

		<input name="buttons_icon" type="radio" value="icon-leaf" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-leaf"></em></div>

		<input name="buttons_icon" type="radio" value="icon-legal" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-legal"></em></div>

		<input name="buttons_icon" type="radio" value="icon-lemon" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-lemon"></em></div>

		<input name="buttons_icon" type="radio" value="icon-lock" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-lock"></em></div>

		<input name="buttons_icon" type="radio" value="icon-unlock" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-unlock"></em></div>

		<input name="buttons_icon" type="radio" value="icon-magic" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-magic"></em></div>

		<input name="buttons_icon" type="radio" value="icon-magnet" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-magnet"></em></div>

		<input name="buttons_icon" type="radio" value="icon-map-marker" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-map-marker"></em></div>

		<input name="buttons_icon" type="radio" value="icon-minus" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-minus"></em></div>

		<input name="buttons_icon" type="radio" value="icon-minus-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-minus-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-money" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-money"></em></div>

		<input name="buttons_icon" type="radio" value="icon-move" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-move"></em></div>

		<input name="buttons_icon" type="radio" value="icon-music" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-music"></em></div>

		<input name="buttons_icon" type="radio" value="icon-off" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-off"></em></div>

		<input name="buttons_icon" type="radio" value="icon-ok" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-ok"></em></div>

		<input name="buttons_icon" type="radio" value="icon-ok-circle" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-ok-circle"></em></div>

		<input name="buttons_icon" type="radio" value="icon-ok-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-ok-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-pencil" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-pencil"></em></div>

		<input name="buttons_icon" type="radio" value="icon-picture" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-picture"></em></div>

		<input name="buttons_icon" type="radio" value="icon-plane" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-plane"></em></div>

		<input name="buttons_icon" type="radio" value="icon-plus" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-plus"></em></div>

		<input name="buttons_icon" type="radio" value="icon-plus-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-plus-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-print" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-print"></em></div>

		<input name="buttons_icon" type="radio" value="icon-pushpin" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-pushpin"></em></div>

		<input name="buttons_icon" type="radio" value="icon-qrcode" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-qrcode"></em></div>

		<input name="buttons_icon" type="radio" value="icon-question-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-question-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-random" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-random"></em></div>

		<input name="buttons_icon" type="radio" value="icon-refresh" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-refresh"></em></div>

		<input name="buttons_icon" type="radio" value="icon-remove" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-remove"></em></div>

		<input name="buttons_icon" type="radio" value="icon-remove-circle" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-remove-circle"></em></div>

		<input name="buttons_icon" type="radio" value="icon-remove-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-remove-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-reorder" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-reorder"></em></div>

		<input name="buttons_icon" type="radio" value="icon-resize-horizontal" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-resize-horizontal"></em></div>

		<input name="buttons_icon" type="radio" value="icon-resize-vertical" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-resize-vertical"></em></div>

		<input name="buttons_icon" type="radio" value="icon-retweet" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-retweet"></em></div>

		<input name="buttons_icon" type="radio" value="icon-road" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-road"></em></div>

		<input name="buttons_icon" type="radio" value="icon-screenshot" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-screenshot"></em></div>

		<input name="buttons_icon" type="radio" value="icon-search" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-search"></em></div>

		<input name="buttons_icon" type="radio" value="icon-share" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-share"></em></div>

		<input name="buttons_icon" type="radio" value="icon-share-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-share-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-shopping-cart" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-shopping-cart"></em></div>

		<input name="buttons_icon" type="radio" value="icon-signal" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-signal"></em></div>

		<input name="buttons_icon" type="radio" value="icon-signin" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-signin"></em></div>

		<input name="buttons_icon" type="radio" value="icon-signout" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-signout"></em></div>

		<input name="buttons_icon" type="radio" value="icon-sitemap" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-sitemap"></em></div>

		<input name="buttons_icon" type="radio" value="icon-sort" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-sort"></em></div>

		<input name="buttons_icon" type="radio" value="icon-sort-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-sort-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-sort-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-sort-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-star" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-star"></em></div>

		<input name="buttons_icon" type="radio" value="icon-star-empty" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-star-empty"></em></div>

		<input name="buttons_icon" type="radio" value="icon-star-half" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-star-half"></em></div>

		<input name="buttons_icon" type="radio" value="icon-tag" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-tag"></em></div>

		<input name="buttons_icon" type="radio" value="icon-tags" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-tags"></em></div>

		<input name="buttons_icon" type="radio" value="icon-tasks" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-tasks"></em></div>

		<input name="buttons_icon" type="radio" value="icon-thumbs-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-thumbs-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-thumbs-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-thumbs-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-time" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-time"></em></div>

		<input name="buttons_icon" type="radio" value="icon-tint" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-tint"></em></div>

		<input name="buttons_icon" type="radio" value="icon-trash" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-trash"></em></div>

		<input name="buttons_icon" type="radio" value="icon-trophy" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-trophy"></em></div>

		<input name="buttons_icon" type="radio" value="icon-truck" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-truck"></em></div>

		<input name="buttons_icon" type="radio" value="icon-umbrella" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-umbrella"></em></div>

		<input name="buttons_icon" type="radio" value="icon-upload" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-upload"></em></div>

		<input name="buttons_icon" type="radio" value="icon-upload-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-upload-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-user" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-user"></em></div>

		<input name="buttons_icon" type="radio" value="icon-user-md" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-user-md"></em></div>

		<input name="buttons_icon" type="radio" value="icon-volume-off" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-volume-off"></em></div>

		<input name="buttons_icon" type="radio" value="icon-volume-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-volume-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-volume-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-volume-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-warning-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-warning-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-wrench" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-wrench"></em></div>

		<input name="buttons_icon" type="radio" value="icon-zoom-in" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-zoom-in"></em></div>

		<input name="buttons_icon" type="radio" value="icon-zoom-out" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-zoom-out"></em></div>

		<input name="buttons_icon" type="radio" value="icon-file" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-file"></em></div>

		<input name="buttons_icon" type="radio" value="icon-cut" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-cut"></em></div>

		<input name="buttons_icon" type="radio" value="icon-copy" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-copy"></em></div>

		<input name="buttons_icon" type="radio" value="icon-paste" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-paste"></em></div>

		<input name="buttons_icon" type="radio" value="icon-save" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-save"></em></div>

		<input name="buttons_icon" type="radio" value="icon-undo" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-undo"></em></div>

		<input name="buttons_icon" type="radio" value="icon-repeat" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-repeat"></em></div>

		<input name="buttons_icon" type="radio" value="icon-paper-clip" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-paper-clip"></em></div>

		<input name="buttons_icon" type="radio" value="icon-text-height" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-text-height"></em></div>

		<input name="buttons_icon" type="radio" value="icon-text-width" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-text-width"></em></div>

		<input name="buttons_icon" type="radio" value="icon-align-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-align-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-align-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-align-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-align-justify" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-align-justify"></em></div>

		<input name="buttons_icon" type="radio" value="icon-indent-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-indent-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-indent-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-indent-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-font" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-font"></em></div>

		<input name="buttons_icon" type="radio" value="icon-bold" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-bold"></em></div>

		<input name="buttons_icon" type="radio" value="icon-italic" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-italic"></em></div>

		<input name="buttons_icon" type="radio" value="icon-strikethrough" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-strikethrough"></em></div>

		<input name="buttons_icon" type="radio" value="icon-underline" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-underline"></em></div>

		<input name="buttons_icon" type="radio" value="icon-link" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-link"></em></div>

		<input name="buttons_icon" type="radio" value="icon-columns" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-columns"></em></div>

		<input name="buttons_icon" type="radio" value="icon-table" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-table"></em></div>

		<input name="buttons_icon" type="radio" value="icon-th-large" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-th-large"></em></div>

		<input name="buttons_icon" type="radio" value="icon-th" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-th"></em></div>

		<input name="buttons_icon" type="radio" value="icon-th-list" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-th-list"></em></div>

		<input name="buttons_icon" type="radio" value="icon-list" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-list"></em></div>

		<input name="buttons_icon" type="radio" value="icon-list-ol" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-list-ol"></em></div>

		<input name="buttons_icon" type="radio" value="icon-list-ul" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-list-ul"></em></div>

		<input name="buttons_icon" type="radio" value="icon-list-alt" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-list-alt"></em></div>

		<input name="buttons_icon" type="radio" value="icon-arrow-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-arrow-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-arrow-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-arrow-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-arrow-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-arrow-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-arrow-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-arrow-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-chevron-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-chevron-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-circle-arrow-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-circle-arrow-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-circle-arrow-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-circle-arrow-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-circle-arrow-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-circle-arrow-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-circle-arrow-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-circle-arrow-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-chevron-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-chevron-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-caret-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-caret-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-caret-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-caret-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-caret-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-caret-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-caret-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-caret-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-chevron-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-chevron-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-hand-down" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-hand-down"></em></div>

		<input name="buttons_icon" type="radio" value="icon-hand-left" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-hand-left"></em></div>

		<input name="buttons_icon" type="radio" value="icon-hand-right" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-hand-right"></em></div>

		<input name="buttons_icon" type="radio" value="icon-hand-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-hand-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-chevron-up" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-chevron-up"></em></div>

		<input name="buttons_icon" type="radio" value="icon-play-circle" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-play-circle"></em></div>

		<input name="buttons_icon" type="radio" value="icon-play" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-play"></em></div>

		<input name="buttons_icon" type="radio" value="icon-pause" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-pause"></em></div>

		<input name="buttons_icon" type="radio" value="icon-stop" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-stop"></em></div>

		<input name="buttons_icon" type="radio" value="icon-step-backward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-step-backward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-fast-backward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-fast-backward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-backward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-backward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-forward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-forward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-fast-forward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-fast-forward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-step-forward" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-step-forward"></em></div>

		<input name="buttons_icon" type="radio" value="icon-eject" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-eject"></em></div>

		<input name="buttons_icon" type="radio" value="icon-fullscreen" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-fullscreen"></em></div>

		<input name="buttons_icon" type="radio" value="icon-resize-full" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-resize-full"></em></div>

		<input name="buttons_icon" type="radio" value="icon-resize-small" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-resize-small"></em></div>

		<input name="buttons_icon" type="radio" value="icon-phone" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-phone"></em></div>

		<input name="buttons_icon" type="radio" value="icon-phone-sign" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-phone-sign"></em></div>

		<input name="buttons_icon" type="radio" value="icon-sign-blank" class="checkbox of-radio-tile-radio" />
		<div class="of-radio-tile-img"><em class="icon-sign-blank"></em></div>

	</fieldset>
	<fieldset>
		<legend>Icon Position</legend>
		<select id="buttons_iconpos" name="buttons_iconpos">
			<option value="left" selected>Left</option>
			<option value="right">Right</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Disable</legend>
		<select id="buttons_disable" name="buttons_disable">
			<option value="on">Yes</option>
			<option value="off" selected>No</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Generate shortcode" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
<script type="text/javascript">

jQuery(document).ready(function($){
	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();
	$('.of-radio-tile-img').live("click", function(){
  		$(this).prev().attr("checked", "checked");
	});
}); //end doc ready
</script>
</body>
</html>
