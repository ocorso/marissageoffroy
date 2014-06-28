<?php
	add_action('init', 'prk_tinymce_button');
 
	function prk_tinymce_button() 
	{
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) 
	   {
		 return;
	   }
	   if ( get_user_option('rich_editing') == 'true' ) 
	   {
		 add_filter( 'mce_external_plugins', 'add_plugin' );
		 add_filter( 'mce_buttons', 'register_button' );
	   }
	}
	function register_button( $buttons ) 
	{
		array_push( $buttons, "|", "prk_tinymce_btn" );
		return $buttons;
	}
	 
	function add_plugin( $plugin_array ) 
	{
	   $plugin_array['prk_tinymce'] = get_template_directory_uri() . '/inc/pirenko_scodes/prk_tinymce.js';
	   return $plugin_array;
	}
	function pirenko_scodes_init()
	{
	if (is_admin())
		{
			wp_enqueue_style('prk_mce_style', get_template_directory_uri() . '/inc/pirenko_scodes/prk_tinymce.css', false, null);
			wp_enqueue_script( 'jq_dynotbl', get_template_directory_uri() . '/inc/pirenko_scodes/dynotable.js', false, null );
		}
	}
	add_action('admin_init','pirenko_scodes_init');
	//SHORTCODES MANAGMENT
	//SLIDERS
	function pixia_slider( $atts, $content = null ) 
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
                        		while ( $loop->have_posts() ) : $loop->the_post();
								$use_txt = get_post_meta(get_the_ID(), "pixia_slide_txt", true);
								 $h_align = get_post_meta(get_the_ID(), "pixia_slide_txt_horz", true);
								 $v_align = get_post_meta(get_the_ID(), "pixia_slide_txt_vert", true);
								 $pos_class="sld_".$h_align." "."sld_".$v_align;				
									if (has_post_thumbnail( get_the_ID() ) ):
										//GET THE FEATURED IMAGE
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );	
											else :
												//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
												$container="".get_bloginfo('template_directory')."/images/sample_home.jpg";
												$image[0]=get_image_path($container);
											endif; 
											
											$out.='<li>';
													if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
													{
                                            			$out.='<a href="'.get_post_meta(get_the_ID(), "pixia_slide_url", true) .'">';
                                           
													}
													if (!isset($use_txt))
													$use_txt=1;
													if (get_the_title()=="" || $use_txt==0)
													{
														$sl_title="&nbsp;";
														$title_class="inv_el";
													}
													else
													{
														$sl_title=get_the_title();
														$title_class="";
													}
													if (get_the_content()=="" || $use_txt==0)
													{
														$sl_body="&nbsp;";
														$body_class="inv_el";
													}
													else
													{
														$sl_body=get_the_content();
														$body_class="";
													}
													
													if (get_post_meta(get_the_ID(), "pixia_slide_video", true)=="")
													{
														if ($use_txt==1)
														{
															$out.=' <div class="slider_text_holder '. $pos_class .'">';
															$out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top '.$title_class.'">';
															$out.=' <h3 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_header_color", true).'">'. $sl_title .'</h3>';
															$out.=' </div>';
															$out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															$out.=' <h4 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_body_color", true).'">'. $sl_body .'</h4>';
															$out.='</div>';
															$out.='</div>';
														}
														$out.='<img src='. $image[0] .' alt="">';
													}
													else
													{
														if ($use_txt==1)
														{
															//IT's A VIDEO SLIDE
															$out.=' <div class="slider_text_holder">';
															$out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top slide_video '.$title_class.'">';
															$out.=' <h3 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_header_color", true).'">'. $sl_title .'</h3>';
															$out.=' </div>';
															$out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															$out.=' <h4 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_body_color", true).'">'. $sl_body .'</h4>';
															$out.='</div>';
															$out.='</div>';	
														}
														$out.=get_post_meta(get_the_ID(), "pixia_slide_video", true);
													}
												if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
												{
													
                                                   $out.=' </a>';
                                                    
												}
												
											$out.='</li>';
											$slide_number++;
								endwhile;
                           
                 $out.='       </ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->';
					wp_reset_query();
                  return $out;
	}
	add_shortcode('slider', 'pixia_slider');
	
	//BLOCKQUOTES
	function blockquotes_shortcode( $atts, $content = null ) 
	{
	   return '<blockquote>' . $content . '<div class="pirenko_author">' . $atts['bf_author'] . $atts['author'] . '</div>' . '</blockquote>';
	}
	add_shortcode('pirenko_blockquote', 'blockquotes_shortcode');
	
	//INFO BOX
	function info_box_shortcode( $atts, $content = null ) 
	{
	   return '<div class="ui-widget">
              <div class="ui-state-default ui-corner-all" style="margin-bottom:18px">
                <p><span class="ui-icon ui-icon-comment" style="float: left; margin-right: .3em;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('info_box', 'info_box_shortcode');
	//WARNING BOX
	function warning_box_shortcode( $atts, $content = null ) 
	{
	   return '<div class="ui-widget">
              <div class="ui-state-highlight ui-corner-all">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;margin-top:1px;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('warning_box', 'warning_box_shortcode');
	//ERROR BOX
	function error_box_shortcode( $atts, $content = null ) 
	{
	   
	   return '<div class="ui-widget">
              <div class="ui-state-error ui-corner-all">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;margin-top:1px;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('error_box', 'error_box_shortcode');
	
	//LISTS
	function list_with_icons_shortcode( $atts, $content = null ) 
	{
		$custom_icons="";
		if (isset($atts['icon']))
			$custom_icons=$atts['icon'];
	return '<div class="list_with_icons '. $custom_icons .'">' . $content . '</div>';
	}
	add_shortcode('list_with_icons', 'list_with_icons_shortcode');

	//TABS
	//CHILD TABS RETRIEVAL
	function prk_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<div id="prk_tab_'. sanitize_title( $title ) .'" class="prk_tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'prk_tab', 'prk_tab' );
	//MAIN TABS RETRIEVAL
	function prk_tabs( $atts, $content = null ) 
	{
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		//EXTRACT TAB TITLES
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) )
		{ 
			$tab_titles = $matches[1]; 
		}
		
		$output = '';
		
		if( count($tab_titles) )
		{
		    $output .= '<div id="tabs_'. rand(1, 1000) .'" class="prk_tabs">';
			$output .= '<ul>';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#prk_tab_'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} 
		else 
		{
			$output .= "SHORTCODE ERROR! No Tab Titles were found.";
		}
		
		return $output;
	}
	add_shortcode( 'prk_tabs', 'prk_tabs' );
	//ACCORDION
	//CHILDNODES RETRIEVAL
	function prk_ac_single( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<div class="prk_ac_single">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'prk_ac_single', 'prk_ac_single' );
	//MAIN ACCORDION RETRIEVAL
	function prk_accordion( $atts, $content = null ) 
	{
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		//EXTRACT ACCORDION TITLES
		preg_match_all( '/prk_ac_single title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		//print_r ($matches);
		$tab_titles = array();
		if( isset($matches[1]) )
		{ 
			$tab_titles = $matches[1]; 
		}
		preg_match_all( '/prk_ac_single title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$output = '';
		//LETS CONVERT THE STRING FOR THE ACCORDION USAGE
		$finale=$content;
		$finale=str_replace('[prk_ac_single title="', '<h3><a href="#">', $finale);
		$finale=str_replace("[/prk_ac_single]", '</div>', $finale);
		$finale=str_replace('"]', '</h3></a><div>', $finale);
		if( count($tab_titles) )
		{
			$helper=1;
		    $output .= '<div id="accordion_'. rand(1, 1000) .'" class="prk_accordion">';
			$output .= $finale;
		    $output .= '</div>';
		} 
		else 
		{
			$output .= "SHORTCODE ERROR! No Accordion Title were found.";
		}
		
		return $output;
	}
	add_shortcode( 'prk_accordion', 'prk_accordion' );
	
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
		$link="";
		if (isset($atts['link']))
			$link=$atts['link'];
		$out = '';
	   	$out.= '<div class="theme_button"><a href="'.$link.'">' . $content . '&nbsp;&nbsp;&nbsp;&rarr;</a></div>';
	   	return $out;
	}
	add_shortcode('theme_button', 'button_shortcode');
	
	//LAYOUTS
	function pixia_one_full( $atts, $content = null ) {
   	return '<div class="twelve columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_full', 'pixia_one_full');
	
	
	function pixia_one_half( $atts, $content = null ) {
	   return '<div class="six columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'pixia_one_half');
	
	
	function pixia_one_half_last( $atts, $content = null ) {
	   return '<div class="six columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'pixia_one_half_last');
	
	
	function pixia_one_third( $atts, $content = null ) {
	   return '<div class="four columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'pixia_one_third');
	
	
	function pixia_one_third_last( $atts, $content = null ) {
	   return '<div class="four columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'pixia_one_third_last');
	
	
	function pixia_two_third( $atts, $content = null ) {
	   return '<div class="eight columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'pixia_two_third');
	
	
	function pixia_two_third_last( $atts, $content = null ) {
	   return '<div class="eight columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'pixia_two_third_last');
	
	
	function pixia_one_fourth( $atts, $content = null ) {
	   return '<div class="three columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'pixia_one_fourth');
	
	
	function pixia_one_fourth_last( $atts, $content = null ) {
	   return '<div class="three columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'pixia_one_fourth_last');
	
	
	function pixia_three_fourth( $atts, $content = null ) {
	   return '<div class="nine columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'pixia_three_fourth');
	
	
	function pixia_three_fourth_last( $atts, $content = null ) {
	   return '<div class="nine columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'pixia_three_fourth_last');
	
	
	function pixia_one_sixth( $atts, $content = null ) {
	   return '<div class="two columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'pixia_one_sixth');
	
	
	function pixia_one_sixth_last( $atts, $content = null ) {
	   return '<div class="two columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_sixth_last', 'pixia_one_sixth_last');
	
	
	function pixia_five_sixth( $atts, $content = null ) {
	   return '<div class="ten columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('five_sixth', 'pixia_five_sixth');
	
	
	function pixia_five_sixth_last( $atts, $content = null ) {
	   return '<div class="ten columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('five_sixth_last', 'pixia_five_sixth_last');
?>