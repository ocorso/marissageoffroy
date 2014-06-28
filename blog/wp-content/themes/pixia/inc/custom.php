<?php
	
	//GET THEME OPTIONS
	$curr_options = get_option('pixia_theme_options');
	//CHECK IF RESET BUTTON WAS PRESSED
	if (isset($_REQUEST['action']))
	{
		if ('reset_pixia' == $_REQUEST['action'])
		{
			$curr_options['set_default']="";
		}
	}
	//RESET OPTIONS IF NEEDED
	if ($curr_options['set_default']=="")
	{
		//TURN OFF RESET FLAG
		$curr_options['set_default']="false";
		
		//GENERAL
		$curr_options['responsive']="true";
		$curr_options['custom_width']="1030";
		$curr_options['custom_height']="600";
		$curr_options['logo']=get_template_directory_uri().'/images/logo.png';
		$curr_options['alt_logo']='';
		$curr_options['favicon']=get_template_directory_uri()."/images/favicon.ico";
		$curr_options['background_image']="";
		$curr_options['pattern']='';
		$curr_options['site_background_color']='#F3F3F3';
		$curr_options['overlay_image']="";
		$curr_options['pattern_hf']='';
		$curr_options['custom_opacity']=94;
		$curr_options['active_color']="#e4412b";
		$curr_options['inactive_color']="#979797";
		$curr_options['body_color']="#333333";
		$curr_options['background_color_btns']="#000000";
		$curr_options['background_color']="#FFFFFF";
		$curr_options['custom_opacity_mdls']=100;
		$curr_options['custom_shadow']=30;
		$curr_options['shadow_color']="#222222";
		$curr_options['header_font']="Dosis:500,600,700";
		$curr_options['body_font']="Open+Sans:400italic,600italic,700italic,400,600,700";
		$curr_options['undermenu_sidebar']="yes";
		$curr_options['bottom_sidebar']="yes";
		$curr_options['footer_text']='Pixia Responsive WordPress Theme'; 
		$curr_options['ganalytics_text']="";
		
		//PORTFOLIO
		$curr_options['autoplay_portfolio']="true";
		$curr_options['delay_portfolio']="5500";
		$curr_options['dateby_port']="yes";
		$curr_options['categoriesby_port']="yes";
		$curr_options['related_port']="yes";
		
		//BLOG
		$curr_options['postedby_news']="yes";
		$curr_options['categoriesby_news']="yes";
		$curr_options['archives_type']='masonry';
		$curr_options['related_blog']='yes';
		$curr_options['related_blog_elast']='no';
		$curr_options['forcesize_news']='yes';
		$curr_options['blog_bw']="no";
		
		//CONTACT
		$curr_options['email_address']='some_email@mail.com';
		$curr_options['contact-info_title_body']='We would love to meet you';
		$curr_options['contact-info_title']='Our Contacts';
		$curr_options['contact-info_title_form']='Send us a message right away';
		$curr_options['contact-address']='Lorem Ipsum Street, nr. 23<br>1234 NY city';
		$curr_options['contact-info_tel']='+1 234 567 890';
		$curr_options['contact-info_fax']='+1 098 765 432';
		$curr_options['contact-info_email']='pixia@mail.com';
		$curr_options['contact-address_info_msg']='Edit all this information on the Pixia Options menu... Proin lectus nulla, luctus id ultrices nec, lacinia eu mi.';
		$curr_options['google-maps']="<iframe width='100%' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.pt/maps/ms?msa=0&msid=212649048698445052918.0004cb23f1cb4148216c8&ie=UTF8&t=m&z=17&output=embed&iwloc=near'></iframe>";
		$curr_options['contact_name_text']='Name';
		$curr_options['contact_email_text']='Email'; 
		$curr_options['contact_subject_text']='Subject';
		$curr_options['contact_message_text']='Your message here';
		$curr_options['contact_submit']='Send Message';
		$curr_options['contact_error_text']='Error! This field is required.';
		$curr_options['contact_error_email_text']='Error! This email is not valid.'; 
		$curr_options['contact_wait_text']='Please wait';
		$curr_options['contact_ok_text']='Thank you for contacting us. We will reply soon!';
		
		//ERROR 404
		$curr_options['error404']=get_template_directory_uri().'/images/error_404.jpg';
		$curr_options['404_title_text']='Ooops! Page not found...';
		$curr_options['404_body_text']='We do not know how you ended up here, but please could you try again by clicking on the left menu, ok?';
		
		//TRANSLATIONS
		$curr_options['responsive_tip_text']='Navigate to...';
		$curr_options['search_tip_text']='Type and hit ENTER';
		$curr_options['submit_search_res_title']='Search Results for';
		$curr_options['required_text']=' (required)';
		$curr_options['launch_text']='Launch Project';
		$curr_options['skills_text']='Skills';
		$curr_options['client_text']='Client';
		$curr_options['related_text']='Related Projects';
		$curr_options['pprevious_text']='Previous';
		$curr_options['pportfolio_text']='To Portfolio';
		$curr_options['pnext_text']='Next';
		$curr_options['read_more']='Read More';
		$curr_options['posted_by_text']='Posted by';
		$curr_options['comments_no_response']='No comments yet'; 
		$curr_options['comments_one_response']='One comment'; 
		$curr_options['comments_oneplus_response']='comments'; 
		$curr_options['comments_closed']=''; 
		$curr_options['comments_on_separator']='on'; 
		$curr_options['comments_leave_reply']='Leave a comment'; 
		$curr_options['comments_author_text']='Name'; 
		$curr_options['comments_email_text']='Email'; 
		$curr_options['comments_url_text']='Website';
		$curr_options['comments_comment_text']='Your comment here';  
		$curr_options['comments_submit']='Submit Comment';
		$curr_options['comment_ok_message']='Thank you for your feedback!';
		$curr_options['empty_text_error']='Error! Please fill all the required fields.';
		$curr_options['invalid_email_error']='Error! Invalid email.';
		
		//CUSTOM SCRIPTS
		$curr_options['css_text']="";
		$curr_options['js_text']="";
		
		//UPDATE OPTIONS
		update_option('pixia_theme_options', $curr_options );
	}
	
	//FUNCTION TO SPLIT COLOR INTO RGB VALUES
	function html2rgb($color)
	{
		if ($color[0] == '#')
			$color = substr($color, 1);	
		if (strlen($color) == 6)
			list($r, $g, $b) = array($color[0].$color[1],$color[2].$color[3],$color[4].$color[5]);
				elseif (strlen($color) == 3)
					list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
				else
					return false;
		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
		return array($r, $g, $b);
	}
	
	//FUNCTION TO GENERATE A BRIGHTER COLOR
	function alter_brightness($colourstr, $steps) 
	{
		$colourstr = str_replace('#','',$colourstr);
		$rhex = substr($colourstr,0,2);
		$ghex = substr($colourstr,2,2);
		$bhex = substr($colourstr,4,2);
		$r = hexdec($rhex);
		$g = hexdec($ghex);
		$b = hexdec($bhex);
		
		$r = dechex(max(0,min(255,$r + $steps)));
		$g = dechex(max(0,min(255,$g + $steps)));  
		$b = dechex(max(0,min(255,$b + $steps)));
		
		$r = str_pad($r,2,"0");
		$g = str_pad($g,2,"0");
		$b = str_pad($b,2,"0");
		
		$cor = '#'.$r.$g.$b;
		return $cor;
	}
	
	function pixia_custom()
	{
		$options = get_option('pixia_theme_options');
		//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
		if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style.php');	
	}	
	if (!isset($options['custom_opacity_mdls']))
		$options['custom_opacity_mdls']=100;
	if (!isset($options['custom_height']))
		$options['custom_height']=400;
	$active_color = $options['active_color'];
	$inactive_color = $options['inactive_color'];
	$body_color = $options['body_color'];
	$background_color = $options['background_color'];
	$buttons_color=$options['background_color_btns'];
	$shadow_color=$options['shadow_color'];
	$custom_opacity=floatval($options['custom_opacity']/100);
	$custom_opacity_mdls=floatval($options['custom_opacity_mdls']/100);
	$custom_shadow=floatval($options['custom_shadow']/100);
	$custom_opacity_half=floatval($options['custom_opacity']/100/2);
	$splitted_active_color= html2rgb($active_color);
	$splitted_body_color= html2rgb($body_color);
	$splitted_background_color=html2rgb($background_color);
	$splitted_inactive_color=html2rgb($inactive_color);
	$splitted_buttons_color=html2rgb($buttons_color);
	$splitted_shadow_color=html2rgb($shadow_color);
	$clearer_inactive_color=alter_brightness($inactive_color,40);
	$darker_inactive_color=alter_brightness($inactive_color,-80);
	$clearer_body_color=alter_brightness($body_color,40);
	$darker_body_color=alter_brightness($body_color,-50);
	$splitted_darker_body_color=html2rgb($darker_body_color);
	$splitted_darker_inactive_color=html2rgb($darker_inactive_color);
	$splitted_clearer_inactive_color=html2rgb($clearer_inactive_color);
	
	//START BUILDING CSS SENTENCE TO CUSTOMIZE CONTENT
	$css = "<style type='text/css'>\n";
	
	
	function font_google_to_css($google_text)
	{
		switch ($google_text) 
		{
			case "Droid+Sans:400,700":
			return ''.'Droid Sans';
			break;
			case "Droid+Serif":
			return ''.'Droid Serif';
			break;
			case "Open+Sans:400,600,700,800":
			return ''.'Open Sans';
			break;
			case "Open+Sans:400italic,600italic,700italic,400,600,700":
			return ''.'Open Sans';
			break;
			case "PT+Sans:400,700,400italic":
			return ''."'PT Sans', sans-serif;";
			break;
			case "Yanone+Kaffeesatz":
			return ''.'Yanone Kaffeesatz';
			break;
			case "Alegreya:400italic,700italic,400,700":
			return ''.'Alegreya';
			break;
			case "Arvo":
			return ''.'Arvo';
			break;
			case "Ubuntu":
			return ''.'Ubuntu';
			break;
			case "Asul:400,700":
			return ''.'Asul';
			break;
			case "Acme":
			return ''.'Acme';
			break;
			case "Asap":
			return ''.'Asap';
			break;
			case "Cabin:500,500italic":
			return ''."'Cabin', sans-serif";
			break;
			case "Ruda:400,700,900":
			return ''."'Ruda', sans-serif";
			break;
			case "Oswald:700,400,300":
			return ''."'Oswald', sans-serif";
			break;
			case "Arial":
			return ''."'Arial'";
			break;
			case "Francois+One":
			return ''."'Francois One', sans-serif";
			break;
			case "Anton":
			return ''."'Anton', sans-serif";
			break;
			case "Economica:700":
			return ''."'Economica', sans-serif";
			break;
			case "Exo:700,800":
			return ''."'Exo', sans-serif";
			break;
			case "bebas_neue":
			return ''."BebasNeueRegular";
			break;
			case "osp_din":
			return ''."OSPDIN";
			break;
			case "league_gothic":
			return ''."LeagueGothicRegular";
			break;
			case "Dosis:500,600,700":
			return ''."'Dosis', sans-serif";
			break;
			case "novecento":
			return ''."NovecentowideLightBold";
			break;
			case "novecento_bold":
			return ''."NovecentowideBookBold";
			break;
			case "Questrial":
			return ''."'Questrial', sans-serif";
			break;
			case "Cousine:400,700":
			return ''."'Cousine', sans-serif";
			break;
			case "Bree+Serif":
			return ''."'Bree Serif', serif";
			break;
			case "Lato:300,400,700":
			return ''."'Lato', sans-serif";
			break;
			case "Vollkorn:400italic,400":
			return ''."'Vollkorn', serif";
			break;
			case "PT+Sans+Narrow":
			return ''."'PT Sans Narrow', sans-serif";
			break;
			case "courier_new":
			return ''."'Courier New', Courier, monospace";
			break;
			case "helvetica":
			return ''."Helvetica, Arial, sans-serif";
			break;
			case "Montserrat":
			return ''."'Montserrat', sans-serif;";
			break;
			case "Lora":
			return ''."'Lora', serif;";
			break;
			case "Oxygen+Mono":
			return ''."'Oxygen Mono', sans-serif;";
			break;
			case "Raleway:200,400,700":
			return ''."'Raleway', sans-serif;";
			break;
			case "Quicksand:400,700":
			return ''."'Quicksand', sans-serif;";
			break;
			case "Overlock+SC":
			return ''."'Overlock SC', cursive;";
			break;
			case "Muli:400,400italic":
			return ''."'Muli', sans-serif;";
			break;
			case "Rye":
			return ''."'Rye', cursive;";
			break;
			case "Pompiere":
			return ''."'Pompiere', cursive;";
			break;
			case "Titillium+Web:400,600,400italic":
			return ''."'Titillium Web', sans-serif;";
			break;
			case "Patua+One":
			return ''."'Patua One', cursive;";
			break;
			case "Bitter:400,700,400italic":
			return ''."'Bitter', serif;";
			break;
			case "Average+Sans":
			return ''."'Average Sans', sans-serif;";
			break;
			case "Share+Tech":
			return ''."'Share Tech', sans-serif;";
			break;
			case "Orienta":
			return ''."'Orienta', sans-serif;";
			break;
			case "Patua+One":
			return ''."'Patua One', cursive;";
			break;
			case "Cinzel:400,700":
			return ''."'Cinzel', serif;";
			break;
			case "Julius+Sans+One":
			return ''."'Julius Sans One', sans-serif;";
			break;
			case "Raleway+Dots":
			return ''."'Raleway Dots', cursive;";
			break;
			case "Italiana":
			return ''."'Italiana', serif;";
			break;
			case "Antic+Didone":
			return ''."'Antic Didone', serif;";
			break;
			case "IM+Fell+Double+Pica+SC":
			return ''."'IM Fell Double Pica SC', serif;";
			break;
			case "Mate+SC":
			return ''."'Mate SC', serif;";
			break;
			case "Rokkitt:400,700":
			return ''."'Rokkitt', serif;";
			break;
			case "Gilda+Display":
			return ''."'Gilda Display', serif;";
			break;
			case "Rufina:400,700":
			return ''."'Rufina', serif;";
			break;
			case "Roboto:400,700":
			return ''."'Roboto', sans-serif;";
			break;
			case "Rufina:400,700":
			return ''."'Rufina', serif;";
			break;
			default:
			return ''.'Times';
		}		
	}
	$css .=	"body,
			#comment,
			#contact-form #c_message,
			.search-query,
			.page-header h3
			{
				font-family:" .font_google_to_css($options['body_font']). ";
			}
			h1 header_font,
			h2 header_font,
			h3 header_font,
			h4 header_font,
			.nav,
			.bottom_teaser,
			.theme_button,
			.theme_button_inverted,
			#nav_footer,
			.navbar .sf-menu,
			#comments_slider .comment-author,
			#comments_slider .comment-link,
			.day,
			.month,
			.theme_tags,
			#collapsed_menu_text,
			.grid_single_title span,
			.homepage-header,
			.sidebar_bubble,
			.related_single_title,
			#sidebar .widget-title,
			#contact_address h4,
			#contact_description h4,
			#contact_form h4,
			#bottom_sidebar .widget-title,
			#footer_sidebar .widget-title,
			#undermenu_sidebar .widget-title,
			.masonr_title,
			.masonr_date,
			.entry_title_single,
			.search_rs_ttl,
			.flexslider .headings_top h1,
			.shortcode_slider .headings_top h3,
			#extra_filter
			{
				font-family:" .font_google_to_css($options['header_font']). ";
			
			}
			.entry_title h2,
			header h2,
			.inner_skills
			{
				text-transform:none;
			}
			";
	
	//ICON SET MANAGMENT
	$css .=	"
			
			.es-nav span
			{
				background: url(" . get_template_directory_uri() . "/images/icons/arrows.png) no-repeat;
			}
			.blog_icon
			{
				background: url(" . get_template_directory_uri() . "/images/icons/various_icons.png) no-repeat;
			}
			";
			//FOOTER
	//CHECK IF THERE'S A PATTERN TO DISPLAY
	if ($options['pattern_hf']!="")
	{
		$css .=
		"#bottom_sidebar
		{
			background: url(" . get_template_directory_uri() . "/images/patterns/".$options['pattern_hf'].");
			
		}";
	}
	//ICONS SET MANAGMENT
		$css .= ".pir_phone
		{
		  background-position:-39px 0px !important;
		}
		.pir_email
		{
		  background-position:-119px 0px !important;
		}
		.pir_fax
		{
		  background-position:-79px 0px !important;
		}
		.pir_home
		{
		  background-position:0px 0px !important;
		}
		.man_icon 
		{
		  background-position:-172px -10px !important;
		}
		.email_icon 
		{
		  background-position:-211px -11px !important;
		}
		.info_icon 
		{
		  background-position:-250px -9px !important;
		}
		.link_icon 
		{
		  background-position:-290px -9px !important;
		}
		";
	//BACKGROUND OVERLAY MANAGMENT
	if ($options['overlay_image']!="")
	{
		$css .= ".overlay
				{
					background: url(" . get_template_directory_uri() . "/images/overlays/".$options['overlay_image'].") repeat scroll 0 0 transparent;
				}";	
	}	
	
	//COLOR MANAGMENT
	$css .= "body,
			#sidebar .widget-title,
			.widget_recent_entries a,
			.widget_categories a,
			.widget_archive a,
			.blog_meta>p>a,
			.navbar .sf-menu li a,
			h3 small,
			.copy,
			.homepage-header,
			#queed_search,
			.navbar .sf-menu .sub-menu li a,
			.author_name,
			.author_name a,
			.masonr_subs,
			a.comment-reply-link,
			.flexslider .headings_body,
			.shortcode_slider .headings_body,
			#extra_filter a,
			.padded_text a
			{
				color: $body_color;
			}
			.zero_color,
			.zero_color a,
			#pir_categories .theme_tags li.active a,
			#pir_categories .theme_tags li.active a:hover,
			#pir_categories .theme_tags li a:hover,
			.flexslider .headings_top h1,
			.shortcode_slider .headings_top h3 {
				color: $darker_body_color;	
			}
			a,
			a:hover,
			#bottom_sidebar h3,
			#top_widgets h3,
			.home_blog_date_text h4,
			#comment_form_messages,
			.comment_date,
			.author_name a:hover,
			.contact_error,
			#contact_ok,
			#top_widgets .email a:hover,
			h3 a:hover,
			#nbr_helper a:hover,
			.entry-title a:hover,
			#nav_footer .active a,
			#nav_footer a:hover,
			.blog_meta>p>a:hover,
			#blog_entries_masonr .blog_meta a:hover,
			#single_portfolio_meta .comments-link:hover,
			.navbar .sf-menu a:hover,
			.navbar .sf-menu .sub-menu li a:hover,
			.navbar .sf-menu>li.active>a,
			.blog_meta a.comments-link:hover,
			.blog_meta a:hover,
			#contact_address h4,
			#contact_description h4,
			#contact_form h4,
			.grid_single_title span,
			.contact_address_block_last em,
			.author_name a:hover,
			.zero_color_cl a:hover,
			#mini_menu a:hover,
			.post_meta_single a:hover,
			#bottom_sidebar .widget-title,
			#no_more,
			.ui-tabs .ui-tabs-nav li a, 
			.ui-tabs.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-selected a,
			.entry_title_single .masonr_date>span
			{
				color: $active_color;
			}
			#nav_footer ul li a,
			.single_entry_tags a,
			#top_widgets,
			#top_widgets .email a,
			.single-entry-content,
			.on_colored,
			.zero_color_cl,
			.zero_color_cl a,
			.masonr_inactive,
			#pir_categories .theme_tags li a,
			.contact_address_right_single,
			#contact-form #c_name,
			#contact-form #c_email,
			#contact-form #c_subject,
			#contact-form #c_message,
			.contact_address_right_single a,
			.inner_skills,
			.prk_parenthesis,
			#commentform #author,
			#commentform #email,
			#commentform #url,
			#commentform #comment,
			#commentform,
			#pixia_search,
			#collapsed_menu_text,
			.contact_address_right
			{
				color:$inactive_color;	
			}
			.day,
			.month,
			.bottom_teaser
			.search_icon,
			#nbr_helper a,
			.masonr_read_more a,
			#blog_entries_masonr .blog_meta span.masonr_inactive,
			#blog_entries_masonr .blog_meta a,
			.blog_meta>p>span,
			.blog_meta span,
			.masonr_inactive a,
			.blog_meta span.masonr_inactive,
			.blog_meta a,
			.post_meta_single,
			.post_meta_single a,
			.post_meta_single span.masonr_inactive,
			#ext_link a:hover
			{
				color:$clearer_inactive_color;	
			}
			.ui-tooltip-tipsy .ui-tooltip-titlebar, 
			.ui-tooltip-tipsy .ui-tooltip-content
			{
				color:$clearer_inactive_color !important;	
			}		
			.entry_title_single a,
			.form_name_icon,
			.sgl_ttl,
			.page-header h3,
			.single_entry_title,
			#single_portfolio_meta .special_italic_medium,
			.search_rs_ttl,
			.search_rs_ttl a,
			#undermenu_sidebar,
			#mini_menu,
			#mini_menu a
			{
				color: $darker_inactive_color;
			}
			.theme_button a,
			.theme_button_inverted a,
			.sf-menu li li.before_nav_icon:before,
			.entry-title a,
			a.lk_text,
			.sidebar_bubble,
			a.lk_text:hover,
			.theme_tags li a,
			.theme_tags li a:hover
			{
				color:$background_color;
			}
			.flex-control-nav li a
			{
				background-color: $inactive_color;
			}
			.flex-control-nav li a
			{
				-webkit-box-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
				-mobox-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
				box-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
			}
			.navbar .sf-menu > li > a,
			.page-header,
			.sgl_ttl,
			.single_entry_title,
			.entry_title_single {
				text-shadow:0px 0px 1px rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.3);
			}
			.flexslider .headings_top h1 {
				text-shadow:0px 0px 2px rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.7);
			}
			.shortcode_slider .headings_top h3 {
				text-shadow:0px 0px 2px rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.4);
			}
			#collapsed_menu_text{
				text-shadow:0px 0px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.3);
			}
			.navbar .sf-menu > li > a:hover,
			.navbar .sf-menu > li.active > a,
			.entry_title_single .masonr_date
			 {
				text-shadow:0px 0px 1px rgba($splitted_active_color[0], $splitted_active_color[1], $splitted_active_color[2],0.2);
			}
			.flex-control-nav li a:hover,
			.home_fader_grid_folio
			{
				background-color: $clearer_inactive_color;
			}
			.pk_contact_highlighted,
			#collapsed_menu_arrow
			{
				background-color: $inactive_color;
				background-color:rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.15);
			} 
			#nav-main.resp_mode .sf-menu > li > a:hover {
				background-color: $inactive_color;
				background-color: rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.15);
			}
			.theme_button_inverted a {
				background-color: $body_color;
			}
			.theme_tags li,
			.blog_date {
				background-color: $darker_body_color;
			}
			#bottom_sidebar,
			.grid_colored_block,
			.blog_fader_grid,
			.related_fader_grid
			{
				background-color: $buttons_color;
				background-color: rgba($splitted_buttons_color[0], $splitted_buttons_color[1], $splitted_buttons_color[2], ".$custom_opacity.");
			}
			.flex-direction-nav li a.flex-next,
			.flex-direction-nav li a.flex-prev
			{
				background-color: $buttons_color;
				background-color: rgba($splitted_buttons_color[0], $splitted_buttons_color[1], $splitted_buttons_color[2], ".$custom_opacity_half.");
			}
			.liner,
			.es-nav span,
			.btn-primary,
			#magic-line,
			.pirenko_highlighted,
			#commentform #author,
			#commentform #email,
			#commentform #url,
			#commentform #comment,
			#pir_categories .theme_tags li,
			.ui-widget-content,
			#nav-main.resp_mode
			{
				background-color:$background_color;
			}
			.colored_bg,
			.content_block {
				background-color: $background_color;
				background-color:rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2], ".$custom_opacity_mdls.");
			}
			.pir_divider
			{
				background-color: $inactive_color;
				background-color:rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			.pir_divider_dk
			{
				background-color: $darker_inactive_color;
				background-color:rgba($splitted_darker_inactive_color[0], $splitted_darker_inactive_color[1], $splitted_darker_inactive_color[2],0.75);
			}
			.pir_divider_onbg
			{
				background-color: $body_color;
				background-color: rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.5);
			}
			.ui-tooltip-tipsy .ui-tooltip-titlebar, 
			.ui-tooltip-tipsy .ui-tooltip-content,
			.ui-tooltip-zuper .ui-tooltip-titlebar,
			.ui-tooltip-zuper .ui-tooltip-content
			{
				background-color:$clearer_inactive_color;
				background-color: rgba($splitted_clearer_inactive_color[0], $splitted_clearer_inactive_color[1], $splitted_clearer_inactive_color[2], 0.9);	
			}
			ol.commentlist > .comment > .children li:before
			{
				border-bottom:1px dotted $inactive_color;
				border-bottom:1px dotted rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.8);
			}
			.comments_liner
			{
				border-left:1px dotted $inactive_color;
				border-left:1px dotted rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.8);
			}
			#portfolio_info {
				border-left:1px solid $inactive_color;
				border-left:1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			.theme_tags li.active,	
			#pir_categories .theme_tags li.active,		
			.blog_icon,
			.inner_line_block,
			.flex-control-nav li a.flex-active,
			.bottom_teaser,
			.inner_line_single_block,
			.home_fader_grid,
			.theme_button a,
			.sidebar_bubble
			{
				background-color: $active_color;
			}
			.inner_line_sidebar_block
			{
				background-color: $active_color;
				background-color:rgba($splitted_active_color[0], $splitted_active_color[1], $splitted_active_color[2],0.5);
			}
			.ui-tabs .ui-tabs-nav li:hover, 
			.ui-tabs .ui-tabs-nav li a:hover,
			.ui-accordion .ui-state-active,
			.ui-accordion-content {
				background-color:#FBFBFB;
			}
			.ui-state-active {
				border-right: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25) !important;
				border-left: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25) !important;
				border-top: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25) !important;
				border-bottom: 1px solid $background_color !important;
			}
			#nav-main.resp_mode,
			.boxed_shadow
			{
				-webkit-box-shadow:0px 1px 3px rgba($splitted_shadow_color[0], $splitted_shadow_color[1], $splitted_shadow_color[2],".$custom_shadow.");
				box-shadow:0px 1px 3px rgba($splitted_shadow_color[0], $splitted_shadow_color[1], $splitted_shadow_color[2],".$custom_shadow.");
			}
			 #folio_classic .inset_shadow,
			 #folio_masonry .inset_shadow
			 {
				box-shadow: inset 0 0 6px rgba($splitted_buttons_color[0], $splitted_buttons_color[1], $splitted_buttons_color[2],0.4);
				-moz-box-shadow: inset 0 0 6px rgba($splitted_buttons_color[0], $splitted_buttons_color[1], $splitted_buttons_color[2],0.4);
				-webkit-box-shadow: inset 0 0 6px rgba($splitted_buttons_color[0], $splitted_buttons_color[1], $splitted_buttons_color[2],0.4);
			} 
			#bottom_sidebar,
			.bottom_teaser {
				-webkit-box-shadow: 0px -1px 1px 0px rgba($splitted_active_color[0], $splitted_active_color[1], $splitted_active_color[2],".$custom_opacity_half.");
				box-shadow: 0px -1px 1px 0px rgba($splitted_active_color[0], $splitted_active_color[1], $splitted_active_color[2],".$custom_opacity_half."); 
			}
			#bottom_sidebar,
			.sidebar_bubble:after
			{ 
				border-top-color: $active_color !important;
			}
			a.lk_text :after
			{
				border-color: transparent transparent transparent $active_color;	
			}
			a.lk_text.change :after
			{
				border-color: transparent transparent transparent $body_color;	
			}
			.theme_button a.change:after
			{
				border-color: transparent transparent transparent $darker_inactive_color;	
			}
			.theme_button_inverted a.change:after
			{
				border-color: transparent transparent transparent $active_color !important;
			}
			.theme_button a:after
			{
				border-color: transparent transparent transparent $active_color;	
			}
			.theme_button_inverted a:after
			{
				border-color: transparent transparent transparent $body_color;
			}
			.divider_tp,
			#footer_sidebar .simple_line_onbg
			{
				border-bottom: 1px dotted $body_color;
				border-bottom: 1px dotted rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.75);
			}
			.divider_grid
			{
				border-bottom: 1px solid $inactive_color;
				border-bottom: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.3);
			}
			.simple_line_onbg
			{
				border-bottom: 1px solid $body_color;
				border-bottom: 1px solid rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.5);
			}
			.search_rs,
			.simple_line,
			.ui-tabs .ui-tabs-nav,
			#nav-main.resp_mode .sf-menu > li,
			.page-header
			{
				border-bottom: 1px solid $inactive_color;
				border-bottom: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			#collapsed_menu
			{
				border-right: 1px solid $inactive_color;
				border-right: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			#nav-main.resp_mode .left_nav {
				border-top: 1px solid $inactive_color;
				border-top: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			.ui-tabs .ui-tabs-nav li a:hover
			{
				background-color: $clearer_inactive_color;
				background-color:rgba($splitted_clearer_inactive_color[0], $splitted_clearer_inactive_color[1], $splitted_clearer_inactive_color[2],0.25);
			}
			.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, 
			.ui-tabs .ui-tabs-nav li.ui-state-disabled a, 
			.ui-tabs .ui-tabs-nav li.ui-state-processing a {
				border: 1px solid $inactive_color;
				border: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.25);
			}
			.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a{
				border-bottom-color: $background_color !important;
			}
			.simple_line_colored {
				border-bottom: 1px solid rgba($splitted_active_color[0], $splitted_active_color[1], $splitted_active_color[2],0.8);
			}
			.portfolio_entry_li_db
			{
				background-color: $background_color;
				background-color:rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],0.05); 
			}
			.read_more_text
			{
				background-color:$inactive_color;
			}
			.menu_divider {	
				border-right:1px dotted $clearer_inactive_color;
			}
			.sub-menu .menu_divider {	
				border-right:1px dotted $background_color;
			}
			#banner_lixo
			{
				border-bottom: 1px solid $body_color;	
			}
			input, 
			textarea, 
			select, 
			.uneditable-input
			{			
				border: 1px solid $inactive_color;
			}
			#nav-main .sub-menu li {
				
			}
			#nav-main .sub-menu {
				
			}
			#nav-main .sub-menu li:last-child {
				
			}
			#nav-main.resp_mode .left_nav > .sf-menu > li:last-child
			{
				border-bottom: 0px solid $inactive_color;
			}
			#after_widgets
			{
				
			}
			.dotted_line
			{
				border-bottom:1px $body_color dotted;	
			}
			.widget_recent_entries li,
			.widget_categories li,
			.widget_archive li,
			.video_widget_line
			{
				border-bottom:1px $body_color dotted;
			}
			.pirenko_highlighted,
			.pk_contact_highlighted
			{
				border: 0px solid $inactive_color;
			}
			.inverted_triangle s{
				border-bottom: 5px solid $active_color;
			}
			.mini_triangle {
				border-top: 5px solid $clearer_inactive_color;
			}
			.ui-tooltip-zuper .ui-tooltip-icon
			{
				border-color: #FFF;
				text-shadow: none;
			}
			";
			
	//ADD CUSTOM CSS
	if ($options['css_text']!="")
	{
		$css .= "".$options['css_text']."";
	}
	//ADD CSS FOR VERTICALLY SMALL DEVICES 
	$css .="/* Mobile Grid and Overrides ---------------------- */
@media only screen and (max-height: ".$options['custom_height']."px) { 
body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; width: 100%; min-width: 0; margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; }
  .row { width: auto; min-width: 0; margin-left: 0; margin-right: 0; }
  .column, .columns { width: auto !important; float: none; }
  .column:last-child, .columns:last-child { float: none; }
  #main.formasonr {
	padding-left:10px !important;
	padding-right:0px !important;  
  }
  #full-screen-background-image {
	margin-left:0px;
}
  #footer_sidebar .widget-title,
	#undermenu_sidebar .widget-title, 
	.copy {
		text-align:center;	
	}
	#extra_filter {
		display:block;	
	}
	#aj_loader {
		top: 5%;
		right: 5%;
		left:inherit;
	 }
	 #top_widgets .widget {
		 margin-bottom:40px;
	 }
	 #top_widgets .widget-last {
		 margin-bottom:0px;
	 }
	 .flexslider {
		min-height:20px !important; 
	 }
	 .homepage_sl {
		padding:0px !important;
		margin:40px 0px 0px!important;	
	}
	.foliopage_sl {
		padding:0px !important;
		margin:40px 0px -60px !important;	
	}
  #banner {
	  position:relative;
	  margin:inherit;
	  padding-left:15px; 
  }
  #left_ar {
		position:relative;  
  }
  #nav-main .sub-menu {
	top:-8px;  
  }
  #logo_holder {
	   margin-top:15px;
  }	
  #content {
	padding-left:0px;  
  }
  .navbar .btn-navbar {
	display:inline;  
	width:250px;
  }
  .opened_menu {
	position:relative;
	margin-top:-22px;
	margin-bottom:36px;  
  }
  #nav-main {
	width:250px;
	overflow:hidden;
  }
  .coll_wrapper {
	  	width: 250px;
		left: 50%;
		display: inline;
		position: relative;
		float: left;
		margin-left: -125px;
		margin-top:26px;
  }
  .brand,
  #undermenu_sidebar {
	text-align:center;  
  }
  .navbar .sf-menu > li {
	text-align:left; 
  }
  .navbar .sf-menu > li > a {
	font-size:14px;  
	padding: 10px 0px 8px 20px; 
	display:block;
	width:100%;
  }
  .navbar .sf-menu > li > ul > li > a {
	padding: 6px 0px 4px 20px; 
	display:block;
	width:100%;
  }
  #content-info {
	position:relative;
	bottom:0px;  
	width:100%;
	padding:0px 15px;
	margin-left:inherit;
	text-align:center;
	box-sizing:border-box;
  }
  #footer_sidebar {
	width:100%;  
  }
  .hide_later {
	display:none;  
  }
  .show_later {
	display:block;	
	}
	.right_floated_later {
	float:right;	
	}
	.blog_content .blog_meta_single {
		padding-bottom:36px !important;
		height:auto;	
		margin-left:0px;
	}
	#entries_navigation .navigation {
		display:inline;	
		top:-20px;
	}
	#no_more {
		margin-bottom:60px;	
	}
  .divider_tp {
	float:none;
	left:50%;
	margin-left:-30px;  
  }
   #undermenu_sidebar .right_floated {
	float:none;
  }
   #mini_menu {
	margin-top: 0px;
	position: relative;
	float:left;
  }
  .column,
  .columns {
  	padding: 0 15px;
  }
  .blog_content {
		padding:0px;	
	}
	.blog_content .blog_meta_single .right_floated .tr_wrapper {
		right:17px !important;	
	}
  .padded_text {
	padding:0px 30px 20px 30px;	
	max-width:100%;
	}
	.mini_padded_text {
		padding:0px 15px 10px 15px;	
		max-width:100%;
	}
	.unpadded_low {
		padding:0px 30px 0px 30px;	
	}
	.mini_unpadded_low {
		padding:0px 15px 0px 15px;	
	}
	#single_slider .flex-control-nav {
		right:30px;	
	}
  #portfolio_info {
		border-left:0px #000000 !important;	
		margin-bottom:30px;
		padding-left:30px;
	}
  .sform_wrapper {
		width:185px;
		left:50%;
		margin-left:-93px;
		position:relative;
  }
  #footer_sidebar .simple_line_onbg {
	width:185px;  
	left:50%;
	margin-left:-93px;
	position:relative;
  }
  .push {
	height:60px;  
  }
  [class*='column'] + [class*='column']:last-child { float: none; }
  .column:before, .columns:before, .column:after, .columns:after { content: ''; display: table; }
  .column:after, .columns:after { clear: both; }
  .offset-by-one, .offset-by-two, .offset-by-three, .offset-by-four, .offset-by-five, .offset-by-six, .offset-by-seven, .offset-by-eight, .offset-by-nine, .offset-by-ten { margin-left: 0 !important; }
  .push-two, .push-three, .push-four, .push-five, .push-six, .push-seven, .push-eight, .push-nine, .push-ten { left: auto; }
  .pull-two, .pull-three, .pull-four, .pull-five, .pull-six, .pull-seven, .pull-eight, .pull-nine, .pull-ten { right: auto; }
  /* Mobile 4-column Grid */
  .row .mobile-one { width: 25% !important; float: left; padding: 0 15px; }
  .row .mobile-one:last-child { float: right; }
  .row .mobile-one.end { float: left; }
  .row.collapse .mobile-one { padding: 0; }
  .row .mobile-two { width: 50% !important; float: left; padding: 0 15px; }
  .row .mobile-two:last-child { float: right; }
  .row .mobile-two.end { float: left; }
  .row.collapse .mobile-two { padding: 0; }
  .row .mobile-three { width: 75% !important; float: left; padding: 0 15px; }
  .row .mobile-three:last-child { float: right; }
  .row .mobile-three.end { float: left; }
  .row.collapse .mobile-three { padding: 0; }
  .row .mobile-four { width: 100% !important; float: left; padding: 0 15px; }
  .row .mobile-four:last-child { float: right; }
  .row .mobile-four.end { float: left; }
  .row.collapse .mobile-four { padding: 0; }
  .push-one-mobile { left: 25%; }
  .pull-one-mobile { right: 25%; }
  .push-two-mobile { left: 50%; }
  .pull-two-mobile { right: 50%; }
  .push-three-mobile { left: 75%; }
  .pull-three-mobile { right: 75%; } 
  }";
	
	$css .= "</style>\n";
	//OUTPUT THE CUSTOM STYLES WE JUST BUILT				
	echo $css;
		
	}//END pixia_custom()
	
	
	//FUNCTION TO ENSURE THAT TIMTHUMB WORKS ON MULTISITE WORDPRESS INSTALLATIONS
	function get_image_path($src) 
	{
		global $blog_id;
		if(isset($blog_id) && $blog_id > 0) 
		{
			$imageParts = explode('/files/' , $src);//implode(",",$src)
			if(isset($imageParts[1])) 
			{
				$src = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
			}
		}
		return $src;
	}
	
	//VARIABLE SIZE EXCERPT FUNCTION FOR NEWS
	function the_excerpt_dynamic($length) 
	{
		global $post;
		$text = $post->post_excerpt;
		if ( '' == $text ) 
		{
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
		}
		$text = strip_shortcodes( $text ); // optional, recommended
		$text = strip_tags($text); //HIS WILL REMOVE EVENTUAL HTML TAGS
		//CHECK IF WE SHOULD ADD [...] AT THE END
		if ($text>substr($text,0,$length))
			$text = substr($text,0,$length).' [...]';
		echo apply_filters('the_excerpt',$text);
	}
	//CHECK IF EXCERPT IS LARGER THAN POST TEXT (USEFULL TO SEE IF WE NEED A READ MORE BUTTON
	function is_big_excerpt($length) 
	{
		global $post;
		$text = $post->post_excerpt;
		if ( '' == $text ) 
		{
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
		}
		$text = strip_shortcodes( $text ); // optional, recommended
		$text = strip_tags($text); 
		//CHECK IF WE SHOULD ADD [...] AT THE END
		if ($text>substr($text,0,$length))
			return true;
		else
			return false;
	}
	
	//SHOW ENTRY META INFO
	function pixia_entry_meta() 
	{
  		echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. get_the_date() .'</time>';
  		echo '<p class="byline author vcard">'. __('Written by', 'pixia') .' <a href="'. get_author_posts_url(get_the_author_meta('id')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
	}
	
?>