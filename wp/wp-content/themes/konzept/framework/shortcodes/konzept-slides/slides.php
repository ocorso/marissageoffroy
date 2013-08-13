<?php 
	function custom_slidessc($atts, $content = null) {

	$user_agent = $_SERVER["HTTP_USER_AGENT"];
	if(strpos($user_agent,'iPhone') || strpos($user_agent,'iPod') || strpos($user_agent,'Android')){ $mobile = true; }else{ $mobile = false; }
	$ipad = strpos($user_agent, 'iPad') ? true : false;
	
	$class = shortcode_atts( array('text_color' => '#ffffff', 'image' => '', 'video_vimeo' => '', 'video_youtube' => '', 'video_mp4' => '', 'video_ogg' => '', 'video_webm' => '', 'video_poster' => '', 'slide_desc' => '', 'slide_horizontal' => '', 'slide_fitscreen' => '', 'slide_noresize' => ''), $atts );

		/* Slide Description */
		if($class['slide_desc'] != ''){ 
			$slide_desc = $class['slide_desc']; 
			$slide_desc = "title=\"".$slide_desc."\"";
		}
		
		/* Slide Text/Cursor Color */
		if($class['text_color'] == '#ffffff'){
			$text_color = 'text_white'; 
		}else{
			$text_color = 'text_black'; 
		}
		
		/* ------------------------------------*/
		/* -------->>> IMAGE SLIDE <<<---------*/
		/* ------------------------------------*/
		if($class['image'] != ''){
			$image = $class['image'];
			if($class['slide_horizontal'] == 'true'){ $horizontal = 'slide_horizontal '; }else{ $horizontal = ''; }
			if($class['slide_horizontal'] == 'true' || $class['slide_fitscreen'] == 'true'){ $slide_fitscreen = 'slide_fitscreen'; }else{ $slide_fitscreen = ''; }
			return '<img class="myimage '.$text_color.' '.$horizontal.$slide_fitscreen.'" src="'.$image.'" alt="" '.$slide_desc.' />';
			
		/* ------------------------------------*/
		/* ----->>> HTML5 VIDEO SLIDE <<<------*/
		/* ------------------------------------*/
		}elseif(($class['video_mp4'] != '' or $class['video_ogg'] != '' or $class['video_webm'] != '') AND !$mobile){
			$video_mp4 = $class['video_mp4'];
			$video_ogg = $class['video_ogg'];
			$video_webm = $class['video_webm'];
			if($class['video_poster'] != ''){ $video_poster = "poster=\"".$class['video_poster']."\""; }else{ $video_poster = ""; }
			return '<div class="myimage myvideo '.$text_color.'" '.$slide_desc.'>'.do_shortcode('[video mp4="'.$video_mp4.'" ogg="'.$video_ogg.'" webm="'.$video_webm.'" '.$video_poster.' preload="true"]').'</div>';
			
		/* ------------------------------------*/
		/* ------->>> YOUTUBE SLIDE <<<--------*/
		/* ------------------------------------*/
		}elseif($class['video_youtube'] != ''){
			$video_youtube = $class['video_youtube'];
			if($class['slide_noresize'] = 'true'){ $video_noresize = 'height="360" width="640"'; }else{ $video_noresize = 'height="100%" width="100%"'; }
			
			$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_youtube );
			if($strText == 'link'){
				$array_link_explode = explode('v=', $video_youtube); 
				$array_link_explode = explode('&', $array_link_explode[1]); 
				$video_youtube =$array_link_explode[0];
			}
			$video_poster = $class['video_poster'];
			
			if($mobile){
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.'><div style="height: 100%; width: auto; margin: 0 auto; position: relative;"><iframe style="bottom: 0; margin: auto; position: absolute; top: 0; z-index: 9999999999;" type="text/html" '.$video_noresize.' src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><img src="'.$video_poster.'" alt="" style="position:absolute;" /></div>';
			}else if($ipad){
				if($video_poster){ $ipad_poster = '<img src="'.$video_poster.'" alt="" style="position:absolute;" />'; }else{ $ipad_poster = ''; }
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.' style="height: 100%;"><div style="height: 100%; width: 640px; margin: 0 auto; position: relative;"><iframe class="youtube-player" style="position:absolute;top:0;bottom:0;margin:auto;z-index: 77777777;" type="text/html" '.$video_noresize.' src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque" frameborder="0"></iframe></div>'.$ipad_poster.'</div>';
			}else if($video_poster != ''){
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.' style="height: 100%;"><div style="height: 100%; width: 640px; margin: 0 auto; position: relative;"><iframe class="youtube-player" style="position:absolute;top:0;bottom:0;margin:auto;z-index: 77777777;" type="text/html" '.$video_noresize.' src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque" frameborder="0"></iframe></div><img src="'.$video_poster.'" alt="" style="position:absolute;" /></div>';
			}else if(!$ipad){ //disable fullscreen for ipad
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'" '.$slide_desc.'><iframe class="youtube-player" type="text/html" width="100%" height="100%" src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque" frameborder="0"></iframe></div>';
			}

		/* ------------------------------------*/
		/* -------->>> VIMEO SLIDE <<<---------*/
		/* ------------------------------------*/
		}elseif($class['video_vimeo'] != ''){
			$video_vimeo = $class['video_vimeo'];
			if($class['slide_noresize'] = 'true'){ $video_noresize = 'height="360" width="640"'; }else{ $video_noresize = 'height="100%" width="100%"'; }
			
			$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_vimeo );
			if($strText == 'link'){ 
				$array_link_explode = explode('.com/', $video_vimeo); 
				$video_vimeo = $array_link_explode[1]; 
			}
			$video_poster = $class['video_poster'];
			
			if($mobile){
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.'><div style="height: 100%; width: auto; margin: 0 auto; position: relative;"><iframe style="bottom: 0; margin: auto; position: absolute; top: 0; z-index: 9999999999;" src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" '.$video_noresize.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><img src="'.$video_poster.'" alt="" style="position:absolute;" /></div>';
			}else if($ipad){
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.' style="height: 100%;"><div style="height: 100%; width: 640px; margin: 0 auto; position: relative;"><iframe style="bottom: 0; margin: auto; position: absolute; top: 0; z-index: 77777777;" src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" '.$video_noresize.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><img src="'.$video_poster.'" alt="" style="position:absolute;" /></div>';
			}else if($video_poster != ''){
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'"  '.$slide_desc.' style="height: 100%;"><div style="height: 100%; width: 640px; margin: 0 auto; position: relative;"><iframe style="bottom: 0; margin: auto; position: absolute; top: 0; z-index: 77777777;" src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" '.$video_noresize.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><img src="'.$video_poster.'" alt="" style="position:absolute;" /></div>';
			}else if(!$ipad){ //disable fullscreen for ipad
				return '<div class="myimage myvideo myvideo_yt '.$text_color.'" '.$slide_desc.'><iframe src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
			}
		}else{
			return false;
		}
	}
	add_shortcode("slide", "custom_slidessc");
?>