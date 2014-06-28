<?php
	//SHORTCODES MANAGMENT
	//SLIDERS
	function queed_slider( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'category'    	 => '',//SHOW ALL SLIDES BY DEFAULT
			'id'		 => 'sample_slider'
		), $atts));
					$args=array(	'post_type' => 'pirenko_slides',
								  	'showposts' => 99,
								  	'pirenko_slide_set' => $category
								);
					$loop = new WP_Query( $args );
		$out = '';
		$slide_number=0;
		$out.='	<div class="flexslider shortcode_slider">
                        <ul id="'. $id .'" class="slides">';
                        		while ( $loop->have_posts() ) : $loop->the_post(); ?>				
									<?php 
									if (has_post_thumbnail( $post->ID ) ):
										//GET THE FEATURED IMAGE
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );	
											else :
												//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
												$container="".get_bloginfo('template_directory')."/images/sample_home.jpg";
												$image[0]=get_image_path($container);
											endif; 
											
											$out.='<li>';
													if (get_post_meta(get_the_ID(), "queed_slide_url", true)!="")
													{
                                            			$out.='<a href="'.get_post_meta(get_the_ID(), "queed_slide_url", true) .'">';
                                           
													}
													if (get_the_title()=="")
													{
														$sl_title="&nbsp;";
														$title_class="inv_el";
													}
													else
													{
														$sl_title=get_the_title();
														$title_class="";
													}
													if (get_the_content()=="")
													{
														$sl_body="&nbsp;";
														$body_class="inv_el";
													}
													else
													{
														$sl_body=get_the_content();
														$body_class="";
													}
													
													if (get_post_meta(get_the_ID(), "queed_slide_video", true)==""):
														$out.=' <div class="slider_text_holder">';
														  $out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top '.$title_class.'">';
														   $out.=' <h3>'. $sl_title .'</h3>';
														   $out.=' </div>';
														   $out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															   $out.=' <h4>'. $sl_body .'</h4>';
															$out.='</div>';
														$out.='</div>';
														$out.='<img src='. $image[0] .' alt="">';
													else:
													//IT's A VIDEO SLIDE
													
													$out.=' <div class="slider_text_holder">';
														  $out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top slide_video '.$title_class.'">';
														   $out.=' <h3>'. $sl_title .'</h3>';
														   $out.=' </div>';
														   $out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															   $out.=' <h4>'. $sl_body .'</h4>';
															$out.='</div>';
														$out.='</div>';
													
													$out.=get_post_meta(get_the_ID(), "queed_slide_video", true);
													
												endif;
												if (get_post_meta(get_the_ID(), "queed_slide_url", true)!="")
												{
													
                                                   $out.=' </a>';
                                                    
												}
												
											$out.='</li>';
											$slide_number++;
								endwhile;
                           
                 $out.='       </ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->';
                  return $out;
	}
	add_shortcode('slider', 'queed_slider');
	//CONTACT PAGE
	function phone_icon_shortcode() 
	{
	   return "<span class='pir_phone'></span>";
	}
	add_shortcode('pir_phone_icon', 'phone_icon_shortcode');
	function email_icon_shortcode() 
	{
	   return "<span class='pir_email'></span>";
	}
	add_shortcode('pir_email_icon', 'email_icon_shortcode');
	function home_icon_shortcode() 
	{
	   return "<span class='pir_home'></span>";
	}
	add_shortcode('pir_home_icon', 'home_icon_shortcode');
	function fax_icon_shortcode() 
	{
	   return "<span class='pir_fax'></span>";
	}
	add_shortcode('pir_fax_icon', 'fax_icon_shortcode');
	
	//BLOCKQUOTES
	function blockquotes_shortcode( $atts, $content = null ) 
	{
	   return '<blockquote>' . $content . '<div class="pirenko_author">' . $atts['bf_author'] . $atts['author'] . '</div>' . '</blockquote>';
	}
	add_shortcode('pirenko_blockquote', 'blockquotes_shortcode');
	
	//OK BOX
	function ok_box_shortcode( $atts, $content = null ) 
	{
	   return '<p class="rounded_box ok_box"><a class="close_box" >&times;</a><span>' . $content . '</span></p>';
	}
	add_shortcode('ok_box', 'ok_box_shortcode');
	//INFO BOX
	function info_box_shortcode( $atts, $content = null ) 
	{
	   return '<p class="rounded_box info_box"><a class="close_box" >&times;</a><span>' . $content . '</span></p>';
	}
	add_shortcode('info_box', 'info_box_shortcode');
	//WARNING BOX
	function warning_box_shortcode( $atts, $content = null ) 
	{
	   return '<p class="rounded_box warning_box"><a class="close_box" >&times;</a><span>' . $content . '</span></p>';
	}
	add_shortcode('warning_box', 'warning_box_shortcode');
	//ERROR BOX
	function error_box_shortcode( $atts, $content = null ) 
	{
	   return '<p class="rounded_box error_box"><a class="close_box" >&times;</a><span>' . $content . '</span></p>';
	}
	add_shortcode('error_box', 'error_box_shortcode');
	//SIMPLE BOX
	function simple_box_shortcode( $atts, $content = null ) 
	{
		$mcustom_bk="#EBEBEB";
		if (isset($atts['bk_color']))
			$mcustom_bk=$atts['bk_color'];
		$mcustom_cl="#969696";
		if (isset($atts['ct_color']))
			$mcustom_cl=$atts['ct_color'];
		return '<p class="simple_box" style="background-color:'.$mcustom_bk.';color:'.$mcustom_cl.';border: 1px solid '.$mcustom_cl.';"><a class="close_box" >&times;</a><span>' . $content . '</span></p>';
	}
	add_shortcode('simple_box', 'simple_box_shortcode');
	
	//LISTS
	function list_with_icons_shortcode( $atts, $content = null ) 
	{
		$custom_icons="";
		if (isset($atts['icon']))
			$custom_icons=$atts['icon'];
	return '<div class="list_with_icons '. $custom_icons .'">' . $content . '</div>';
	}
	add_shortcode('list_with_icons', 'list_with_icons_shortcode');
	
	//TOGGLE
	function queed_toogle( $atts, $content = null ) {
		
		extract(shortcode_atts(array(
			'title'    	 => 'Toggle title',
			'state'		 => 'opened'
		), $atts));
	
		$out = '';
		
		$out .= "<div data-id='".$state."' class=\"toggle\"><h3><small><strong>".$title."</strong></small></h3><div class=\"toggle-inner\">".do_shortcode($content)."</div></div>";
		
		return $out;
		
	}
	add_shortcode('toggle', 'queed_toogle');
	
	//ICONS
	function icons_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'icon_set'    	 => '',//Black icons by default
			'icon'		 => 'heart'
		), $atts));
		$out = '';
	
	$out .=  '<div class="icon-'. $icon.' '. $icon_set .'">' . $content . '</div>';
	return $out;
	}
	add_shortcode('theme_icon', 'icons_shortcode'); 
	
	//THEME BUTTONS
	function button_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'caption'    	 => 'This is my text',
			'icon'		 => 'heart'
		), $atts));
		if (isset($atts['link']))
			$link=$atts['link'];
		$out = '';
	   	$out.= '<div class="theme_button"><a href="'.$link.'" target="_blank">' . $content . '&nbsp;&nbsp;&nbsp;&rarr;</a></div>';
	   	return $out;
	}
	add_shortcode('theme_button', 'button_shortcode');
	
	//TEAM
	function prk_team_shortcode( $atts, $content = null ) 
	{
		return '<ul class="prk_member_ul">'.do_shortcode($content).'</ul><div class="clearboth"></div>';
	}
	add_shortcode('prk_team', 'prk_team_shortcode');
	
	//TEAM MEMBER
	function prk_member_shortcode( $atts, $content = null ) 
	{
		$name="";
		if (isset($atts['name']))
			$name=$atts['name'];
		$image="";
		if (isset($atts['image']))
			$image=$atts['image'];
		$fctn="";
		if (isset($atts['role']))
			$fctn=$atts['role'];
		$social="";
		if (isset($atts['delicious']))
			$social.='<a href="'.$atts['delicious'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/delicious.png" pir_title="Delicious" class="pir_icons"></a>';
		if (isset($atts['deviantart']))
			$social.='<a href="'.$atts['deviantart'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/deviantart.png" pir_title="Deviantart" class="pir_icons" ></a>';
		if (isset($atts['digg']))
                $social.='<a href="'.$atts['digg'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/digg.png" pir_title="Digg" class="pir_icons"></a>';
		if (isset($atts['facebook']))
                $social.='<a href="'.$atts['facebook'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/facebook.png" pir_title="Facebook" class="pir_icons"></a>';
		if (isset($atts['flickr']))
                $social.='<a href="'.$atts['flickr'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/flickr.png" pir_title="Flickr" class="pir_icons"></a>';
		if (isset($atts['instagram']))
                $social.='<a href="'.$atts['instagram'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/instagram.png" pir_title="Instagram" class="pir_icons"></a>';
		if (isset($atts['linkedin']))
                $social.='<a href="'.$atts['linkedin'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/linkedin.png" pir_title="Linkedin" class="pir_icons"></a>';
		if (isset($atts['myspace']))
                $social.='<a href="'.$atts['myspace'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/myspace.png" pir_title="MySpace" class="pir_icons"></a>';
		if (isset($atts['pinterest']))
                $social.='<a href="'.$atts['pinterest'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/pinterest.png" pir_title="&nbsp;Pinterest" class="pir_icons" ></a>';
		if (isset($atts['skype']))
                $social.='<a href="'.$atts['skype'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/skype.png" pir_title="&nbsp;Skype" class="pir_icons" ></a>';
		if (isset($atts['twitter']))
                $social.='<a href="'.$atts['twitter'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/twitter.png" pir_title="Twitter" class="pir_icons" ></a>';
		if (isset($atts['vimeo']))
                $social.='<a href="'.$atts['vimeo'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/vimeo.png" pir_title="Vimeo" class="pir_icons" ></a>';
		if (isset($atts['yahoo']))
                $social.='<a href="'.$atts['yahoo'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/yahoo.png" pir_title="Yahoo!" class="pir_icons"></a>';
		if (isset($atts['youtube']))
                $social.='<a href="'.$atts['youtube'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/youtube.png" pir_title="Youtube" class="pir_icons"></a>';
		if (isset($atts['rss']))
                $social.='<a href="'.$atts['rss'].'" target="_blank"><img src="'. get_bloginfo('template_url') . '/images/icons/shortcodes/rounded/rss.png" pir_title="RSS" class="pir_icons"></a>';
				
				
		return '<li class="prk_member one_third"><img src="'.$image.'" class="boxed_shadow"><div class="prk_member_name home_post_title_grid">
<h3>'.$name.'</h3></div><div class="prk_member_fctn">'.$fctn.'</div>'.$content.'<div class="prk_member_social cf">'.$social.'</div></li>';
	}
	add_shortcode('prk_member', 'prk_member_shortcode');
	//LAYOUTS
	function queed_one_full( $atts, $content = null ) {
   	return '<div class="one_full">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_full', 'queed_one_full');
	function queed_one_third( $atts, $content = null ) {
	   return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'queed_one_third');
	
	function queed_one_third_last( $atts, $content = null ) {
	   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'queed_one_third_last');
	
	function queed_two_third( $atts, $content = null ) {
	   return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'queed_two_third');
	
	function queed_two_third_last( $atts, $content = null ) {
	   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'queed_two_third_last');
	
	function queed_one_half( $atts, $content = null ) {
	   return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'queed_one_half');
	
	function queed_one_half_last( $atts, $content = null ) {
	   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'queed_one_half_last');
	
	function queed_one_fourth( $atts, $content = null ) {
	   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'queed_one_fourth');
	
	function queed_one_fourth_last( $atts, $content = null ) {
	   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'queed_one_fourth_last');
	
	function queed_three_fourth( $atts, $content = null ) {
	   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'queed_three_fourth');
	
	function queed_three_fourth_last( $atts, $content = null ) {
	   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'queed_three_fourth_last');
	
	function queed_one_fifth( $atts, $content = null ) {
	   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth', 'queed_one_fifth');
	
	function queed_one_fifth_last( $atts, $content = null ) {
	   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fifth_last', 'queed_one_fifth_last');
	
	function queed_two_fifth( $atts, $content = null ) {
	   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_fifth', 'queed_two_fifth');
	
	function queed_two_fifth_last( $atts, $content = null ) {
	   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_fifth_last', 'queed_two_fifth_last');
	
	function queed_three_fifth( $atts, $content = null ) {
	   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fifth', 'queed_three_fifth');
	
	function queed_three_fifth_last( $atts, $content = null ) {
	   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fifth_last', 'queed_three_fifth_last');
	
	function queed_four_fifth( $atts, $content = null ) {
	   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('four_fifth', 'queed_four_fifth');
	
	function queed_four_fifth_last( $atts, $content = null ) {
	   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('four_fifth_last', 'queed_four_fifth_last');
	
?>