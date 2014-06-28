<?php
/**
 * @package Video.js
 * @version 3.2.2
 */
/*
Plugin Name: Video.js - HTML5 Video Player for WordPress
Plugin URI: http://videojs.com/
Description: A video plugin for WordPress built on the widely used Video.js HTML5 video player library. Allows you to embed video in your post or page using HTML5 with Flash fallback support for non-HTML5 browsers.
Author: <a href="http://steveheffernan.com">Steve Heffernan</a>, <a href="http://www.nosecreekweb.ca">Dustin Lammiman</a>
Version: 3.2.2
*/
/* Flow note: we don't use VideoJS in this project. We use its shortcode to generate <video> tag. */

/* The [video] shortcode */
function video_shortcode($atts, $content=null){
	
	$options = get_option('videojs_options'); //load the defaults
	
	extract(shortcode_atts(array(
		'mp4' => '',
		'webm' => '',
		'ogg' => '',
		'poster' => '',
		'width' => $options['videojs_width'],
		'height' => $options['videojs_height'],
		'preload' => $options['videojs_preload'],
		'autoplay' => $options['videojs_autoplay'],
		'loop' => '',
		'muted' => '',
		'controls' => '',
		'id' => '',
		'class' => ''
	), $atts));

	// ID is required for multiple videos to work
	if ($id == '')
		$id = 'example_video_id_'.rand();

	// MP4 Source Supplied
	if ($mp4)
		$mp4_source = '<source src="'.$mp4.'" type=\'video/mp4\' />';
	else
		$mp4_source = '';

	// WebM Source Supplied
	if ($webm)
		$webm_source = '<source src="'.$webm.'" type=\'video/webm; codecs="vp8, vorbis"\' />';
	else
		$webm_source = '';

	// Ogg source supplied
	if ($ogg)
		$ogg_source = '<source src="'.$ogg.'" type=\'video/ogg; codecs="theora, vorbis"\' />';
	else
		$ogg_source = '';
	
	// Poster image supplied
	if ($poster)
		$poster_attribute = ' poster="'.$poster.'"';
	else
		$poster_attribute = '';
	
	// Preload the video?
	if ($preload == "auto" || $preload == "true" || $preload == "on")
		$preload_attribute = ' preload="auto"';
	elseif ($preload == "metadata")
		$preload_attribute = ' preload="metadata"';
	else 
		$preload_attribute = ' preload="none"';

	// Autoplay the video?
	if ($autoplay == "true" || $autoplay == "on")
		$autoplay_attribute = " autoplay";
	else
		$autoplay_attribute = "";
	
	// Loop the video?
	if ($loop == "true")
		$loop_attribute = " loop";
	else
		$loop_attribute = "";
		
	// Muted?
	if ($muted == "true")
		$muted_attribute = " muted";
	else
		$muted_attribute = "";
	
	// Controls?
	if ($controls == "false")
		$controls_attribute = "";
	else
		$controls_attribute = " controls";
	
	// Is there a custom class?
	if ($class)
		$class = ' ' . $class;
	
	// Tracks
	if(!is_null( $content ))
		$track = do_shortcode($content);
	else
		$track = "";


	$videojs = <<<_end_

	<video id="{$id}" class="video-js vjs-default-skin{$class}" width="{$width}" height="{$height}"{$poster_attribute}{$controls_attribute}{$preload_attribute}{$autoplay_attribute}{$muted_attribute}{$loop_attribute}>
		{$mp4_source}
		{$webm_source}
		{$ogg_source}{$track}
	</video>

_end_;

	return $videojs;

}
add_shortcode('video', 'video_shortcode');


/* The [track] shortcode */
function track_shortcode($atts, $content=null){
	extract(shortcode_atts(array(
		'kind' => '',
		'src' => '',
		'srclang' => '',
		'label' => '',
		'default' => ''
	), $atts));
	
	if($kind)
		$kind = " kind='" . $kind . "'";
	
	if($src)
		$src = " src='" . $src . "'";
	
	if($srclang)
		$srclang = " srclang='" . $srclang . "'";
	
	if($label)
		$label = " label='" . $label . "'";
	
	if($default == "true" || $default == "default")
		$default = " default";
	else
		$default = "";
	
	$track = "
		<track" . $kind . $src . $srclang . $label . $default . " />
	";
	
	return $track;
}
add_shortcode('track', 'track_shortcode');

?>
