<?php
	function efs_get_sliders($resize, $layout, $discard){
	
		if($layout == "default") { $layout == ""; }
		if($resize == "width") { $resize == ""; }
		
		$posts_to_exclude=explode(",",$discard);
		
		$slider= '<div class="blueberry '.$layout.' clearfix">
		  <ul class="slides clearfix">';
		
			$images = get_children( array( 
									'post_parent' => get_the_ID(),
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order' => 'ASC',
									'orderly' => 'menu_order' )
									);
				
				if ( $images ) 
				{	
		
						foreach ( $images as $id => $image ) {
							$key = array_search($id, $posts_to_exclude);
							if(is_numeric($key)) { 
							} else {
							$attatchmentID = $image->ID; 
							$imagearray = wp_get_attachment_image_src( $attatchmentID , 'portfolio-thumb', false);
							$imageURI = $imagearray[0];
							$imageID = get_post($attatchmentID);
							$imageTitle = $imageID->post_title;
							$slider.="<li class='".$resize."'>";
									$slider .=showimage (
										$imageURI,
										$link_url="",
										$imageTitle=$imageTitle
										);
							$slider .="</li>";
							}
						}
				}	
	
		$slider.= '</ul>';
		$slider .='<ul class="pager span4 clearfix">';
		for ($i=1;$i<=$number;$i++) {
			$slider  .= '<li><a href="#"><span></span></a></li>';
		}
		$slider .='</ul>';
		$slider .='</div>';
		
		return $slider;
	}
	
	function efs_insert_sliders($atts, $content=null){
	
				extract(shortcode_atts(array(
					"resize"=>'width',
					"layout" => 'default',
					"discard"=>''
				), $atts));
	
	$slider= efs_get_sliders($resize, $layout, $discard);
	
	return $slider;
	
	}
	add_shortcode('sliders', 'efs_insert_sliders');
	?>