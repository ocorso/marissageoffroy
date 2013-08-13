<?php 
function iframe_vimeo_video_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'link' => '' ), $atts);

	$video_vimeo = $atts['link'];
	$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_vimeo );
	if($strText == 'link'){ $array_link_explode = explode('.com/', $video_vimeo); $video_vimeo = $array_link_explode[1]; }

	return '<div class="youtube_container"><iframe src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}
function iframe_youtube_video_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'link' => '' ), $atts);

	$video_youtube = $atts['link'];
	$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_youtube );
	if($strText == 'link'){ $array_link_explode = explode('v=', $video_youtube); $array_link_explode = explode('&', $array_link_explode[1]); $video_youtube = $array_link_explode[0]; }

	return '<div class="youtube_container"><iframe class="youtube-player" type="text/html" src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque" frameborder="0"></iframe></div>';
}

add_shortcode("vimeo", "iframe_vimeo_video_shortcode");
add_shortcode("youtube", "iframe_youtube_video_shortcode");
?>