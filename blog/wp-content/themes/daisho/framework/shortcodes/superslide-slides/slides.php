<?php 
	function custom_slidessc($atts, $content = null){
		$class = shortcode_atts( array('text_color' => '#ffffff', 'image' => '', 'image_alt' => '', 'video_vimeo' => '', 'video_youtube' => '', 'video_mp4' => '', 'video_ogg' => '', 'video_webm' => '', 'video_poster' => '', 'slide_desc' => '', 'slide_horizontal' => '', 'slide_fitscreen' => '', 'slide_noresize' => '', 'custom' => ''), $atts );

		/* Slide Description */
		if(($class['slide_desc'] != '') && ($class['slide_desc'] != '<h4></h4>')){ 
			$slide_desc = $class['slide_desc']; 
			//$slide_desc = "data-title=\"".$slide_desc."\"";
		}else{
			$slide_desc = false;
		}
		
		if($content && ($content != '') && ($content != '<h4></h4>')){ 
			$slide_desc = $content; 
			//$slide_desc = "data-title=\"".$slide_desc."\"";
		}else{
			$slide_desc = false;
		}
				
		
		if((isset($class['image_alt'])) && ($class['image_alt'] != '')){
			$image_alt = $class['image_alt'];
		}else{
			$image_alt = '';
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
		if((isset($class['image'])) && ($class['image'] != '')){
			$image = $class['image'];
			if($class['slide_horizontal'] == 'true'){ $horizontal = 'slide_horizontal '; }else{ $horizontal = ''; }
			if($class['slide_horizontal'] == 'true' || $class['slide_fitscreen'] == 'true'){ $slide_fitscreen = 'slide_fitscreen'; }else{ $slide_fitscreen = ''; }
			
			$the_slide = '<div class="project-slide project-slide-image portfolio-fs-slide">';
				$the_slide .= '<img class="myimage" src="'.$image.'" alt="'.$image_alt.'" />';
				if($slide_desc){
					$the_slide .= '<span style="opacity:0;" class="project-slide-description">' . $slide_desc . '</span>';
				}
			$the_slide .= '</div>';
			
			return $the_slide;

		/* ------------------------------------*/
		/* ----->>> HTML5 VIDEO SLIDE <<<------*/
		/* ------------------------------------*/
		}elseif(($class['video_mp4'] != '' or $class['video_ogg'] != '' or $class['video_webm'] != '')){
			$video_mp4 = $class['video_mp4'];
			$video_ogg = $class['video_ogg'];
			$video_webm = $class['video_webm'];
			
			if($class['video_poster'] != ''){ 
				$video_poster = 'poster="'.$class['video_poster'].'"'; 
			}else{ 
				$video_poster = ""; 
			}
			
			$the_slide = '<div class="project-slide project-slide-video portfolio-fs-slide">';
				$the_slide .= do_shortcode('[video mp4="'.$video_mp4.'" ogg="'.$video_ogg.'" webm="'.$video_webm.'" '.$video_poster.' preload="true"]');
				if($slide_desc){
					$the_slide .= '<span class="project-slide-description-below">' . $slide_desc . '</span>';
				}
			$the_slide .= '</div>';
			
			return $the_slide;
			
		/* ------------------------------------*/
		/* ------->>> YOUTUBE SLIDE <<<--------*/
		/* ------------------------------------*/
		}elseif($class['video_youtube'] != ''){
			$video_youtube = $class['video_youtube'];
			if($class['slide_noresize'] = 'true'){ $video_noresize = 'height="360" width="640"'; }else{ $video_noresize = 'height="100%" width="100%"'; }
			$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_youtube );
			if($strText == 'link'){ $array_link_explode = explode('v=', $video_youtube); $array_link_explode = explode('&', $array_link_explode[1]); $video_youtube =$array_link_explode[0]; }
			$video_poster = $class['video_poster'];
			
			$the_slide = '<div class="project-slide project-slide-youtube portfolio-fs-slide">';
				$the_slide .= '<div class="youtube_container">';
					$the_slide .= '<iframe class="youtube-player" type="text/html" width="1120" height="660" src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque&amp;hd=1" frameborder="0"></iframe>';
				$the_slide .= '</div>';
				if($slide_desc){
					$the_slide .= '<span class="project-slide-description-below">' . $slide_desc . '</span>';
				}
			$the_slide .= '</div>';
			
			return $the_slide;
			
			//return '<div class="myimage myvideo myvideo_yt description_below_capable '.$text_color.'" '.$slide_desc.'><div class="youtube_container"><iframe class="youtube-player" type="text/html" width="1120" height="660" src="http://www.youtube.com/embed/'.$video_youtube.'?wmode=opaque&amp;hd=1" frameborder="0"></iframe></div></div>';

		/* ------------------------------------*/
		/* -------->>> VIMEO SLIDE <<<---------*/
		/* ------------------------------------*/
		}elseif($class['video_vimeo'] != ''){
			$video_vimeo = $class['video_vimeo'];
			if($class['slide_noresize'] = 'true'){ $video_noresize = 'height="360" width="640"'; }else{ $video_noresize = 'height="100%" width="100%"'; }
			$strText = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', 'link', $video_vimeo );
			if($strText == 'link'){ $array_link_explode = explode('.com/', $video_vimeo); $video_vimeo = $array_link_explode[1]; }
			$video_poster = $class['video_poster'];
			
			$the_slide = '<div class="project-slide project-slide-vimeo portfolio-fs-slide">';
				$the_slide .= '<div class="youtube_container">';
					$the_slide .= '<iframe src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;hd=1" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				$the_slide .= '</div>';
				if($slide_desc){
					$the_slide .= '<span class="project-slide-description-below">' . $slide_desc . '</span>';
				}
			$the_slide .= '</div>';
			
			return $the_slide;
			
			//return '<div class="myimage myvideo myvideo_vimeo description_below_capable '.$text_color.'" '.$slide_desc.'><div class="youtube_container"><iframe src="http://player.vimeo.com/video/'.$video_vimeo.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;hd=1" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
		/* -------------------------------------*/
		/* -------->>> CUSTOM SLIDE <<<---------*/
		/* -------------------------------------*/
		}elseif($class['custom'] != ''){
			return $class['custom'];
		}else{
			//return '[slide] error: no data<br />'.$content;
			return false;
		}
	}
	add_shortcode("slide", "custom_slidessc");
?>