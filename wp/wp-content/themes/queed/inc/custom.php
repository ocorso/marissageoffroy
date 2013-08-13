<?php
	
	//GET THEME OPTIONS
	$curr_options = get_option('queed_theme_options');
	//CHECK IF RESET BUTTON WAS PRESSED
	if (isset($_REQUEST['action']))
	{
		if ('reset_queed' == $_REQUEST['action'])
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
		$curr_options['logo']=get_template_directory_uri().'/images/logo.png';
		$curr_options['menu_vertical']='-54';
		$curr_options['logo_w']='176';
		$curr_options['favicon']=get_template_directory_uri()."/images/favicon.ico";
		$curr_options['background_image']="";
		$curr_options['pattern']='text_gray_light.jpg';
		$curr_options['site_background_color']='FFFFFF';
		$curr_options['custom_opacity_btn']=78;
		$curr_options['custom_shadow']=50;
		$curr_options['overlay_image']="";
		$curr_options['pattern_hf']='dark_tire.png';
		$curr_options['custom_opacity']=86;
		$curr_options['active_color']="dc4141";
		$curr_options['inactive_color']="cccccc";
		$curr_options['body_color']="999999";
		$curr_options['background_color']="000000";
		$curr_options['header_font']="Ruda:400,700,900";
		$curr_options['body_font']="Droid+Sans:400,700";
		$curr_options['icon_set']='clear';
		$curr_options['icon_set_ct']='custom_ic';
		$curr_options['top_sidebar']="yes";
		$curr_options['footer_text']='&copy; 2012 Queed Theme'; 
		$curr_options['css_text']="";
		
		//HOMEPAGE
		$curr_options['show_homepage_welcome']="yes";
		$curr_options['homepage_welcome_text']="Welcome to Queed!";
		$curr_options['homepage_welcomel2_text']="A flexible and responsive theme by Pirenko";
		$curr_options['show_homepage_slider']="1";//ON TOP
		$curr_options['autoplay_homepage']="true";
		$curr_options['delay_homepage']="5500";
		$curr_options['homepage_slider_group']="queed_all_s";//SHOW ALL SLIDER
		$curr_options['show_homepage_blog']="3";
		$curr_options['news_title']="Latest From Our Blog";
		$curr_options['show_homepage_portfolio']="2";
		$curr_options['portfolio_title']="Latest Work";
		$curr_options['portfolio_show_nr']="12";
		$curr_options['show_htmlblock']='0';
		$curr_options['htmlblock_title']='';
		$curr_options['htmlblock_body']='';
		
		//PORTFOLIO
		$curr_options['use_lightbox']="both";
		$curr_options['autoplay_portfolio']="true";
		$curr_options['delay_portfolio']="5500";
		$curr_options['dateby_port']="yes";
		$curr_options['categoriesby_port']="yes";
		$curr_options['portfolio_bw']="no";
		
		//BLOG
		$curr_options['postedby_news']="yes";
		$curr_options['categoriesby_news']="yes";
		$curr_options['forcesize_news']='yes';
		$curr_options['blog_bw']="no";
		
		//CONTACT
		$curr_options['email_address']='some_email@mail.com';
		$curr_options['contact-info_title']='Contact Information';
		$curr_options['contact-address']='Lorem Ipsum Street, nr. 23<br>1234 NY city';
		$curr_options['contact-info_tel']='+1 234 567 890';
		$curr_options['contact-info_fax']='+1 098 765 432';
		$curr_options['contact-info_email']='queed@mail.com';
		$curr_options['contact-address_info_msg']='Edit all this information on the Queed Options menu...';
		$curr_options['google-maps']='<iframe width="698" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=pt-PT&geocode=&q=Time+Square,+Times+Square,+New+York,+NY,+United+States&aq=3&sll=40.706157,-74.01132&sspn=0.006864,0.009731&vpsrc=6&ie=UTF8&hq=Time+Square,+Times+Square,+New+York,+NY,+United+States&t=m&ll=40.763836,-73.985023&spn=0.022753,0.054073&z=14&iwloc=lyrftr:m,0x89c259ab49ca241b:0xea32c7f644e2fad7,40.756035,-73.986225&output=embed&iwloc=near"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&source=embed&hl=pt-PT&geocode=&q=Time+Square,+Times+Square,+New+York,+NY,+United+States&aq=3&sll=40.706157,-74.01132&sspn=0.006864,0.009731&vpsrc=6&ie=UTF8&hq=Time+Square,+Times+Square,+New+York,+NY,+United+States&t=m&ll=40.763836,-73.985023&spn=0.022753,0.054073&z=14&iwloc=lyrftr:m,0x89c259ab49ca241b:0xea32c7f644e2fad7,40.756035,-73.986225" style="color:#0000FF;text-align:left">Enlarge Map</a></small>';
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
		$curr_options['collapsed_text']='Navigation';
		$curr_options['search_tip_text']='Type and hit ENTER';
		$curr_options['submit_search_res_title']='Search Results for';
		$curr_options['previous_nav_text']='Previous entries';
		$curr_options['required_text']=' (required)';
		$curr_options['all_text']='All';
		$curr_options['launch_text']='Launch Project';
		$curr_options['related_text']='Related Projects';
		$curr_options['read_more']='Read More';
		$curr_options['posted_by_text']='Posted by';
		$curr_options['comments_leave_reply']='Leave a reply'; 
		$curr_options['comments_author_text']='Name'; 
		$curr_options['comments_email_text']='Email'; 
		$curr_options['comments_url_text']='Website';
		$curr_options['comments_comment_text']='Your comment here';  
		$curr_options['comments_submit']='Submit Comment';
		$curr_options['comment_ok_message']='Thank you for your feedback!';
		$curr_options['empty_text_error']='Error! Please fill all the required fields.';
		$curr_options['invalid_email_error']='Error! Invalid email.';
		$curr_options['comments_no_response']='No comments yet'; 
		$curr_options['comments_one_response']='One comment'; 
		$curr_options['comments_oneplus_response']='comments'; 
		$curr_options['comments_closed']=''; 
		$curr_options['comments_on_separator']='on'; 
		
		//UPDATE OPTIONS
		update_option('queed_theme_options', $curr_options );
	}
	// QUEED THEME CUSTOM FUNCTIONS
	//$curr_options = get_option('queed_theme_options');
	//$curr_options['background_image']="http://localhost:8888/queed/wp-content/uploads/first_bk.jpg";
	//update_option('queed_theme_options', $curr_options );
	
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
	
	function queed_custom()
	{
		//GET OPTIONS VALUES	
		$options = get_option('queed_theme_options');
		//OVERRIDE OPTIONS ONLY IF IN PREVIEW MODE
		if (isset($_SESSION['front_queed_active_color']))
		{
			if ($_SESSION['front_queed_active_color']!="")
				$options['active_color']=$_SESSION['front_queed_active_color'];
		}
		if (isset($_SESSION['front_queed_pattern']))
		{
			if ($_SESSION['front_queed_pattern']!="")
				$options['pattern']=$_SESSION['front_queed_pattern'];
		}
		if (isset($_SESSION['front_queed_skin']))
		{
			if ($_SESSION['front_queed_skin']!="")
			{
				$options['icon_set']=$_SESSION['front_queed_skin'];
				if ($_SESSION['front_queed_skin']=="dark")
				{
					$options['background_color']="FFFFFF";
					$options['inactive_color']="333333";
					$options['body_color']="777777";
					$options['custom_opacity']="25";
					$options['pattern_hf']="first_aid_kit.png";
				}
				else
				{
	
				}
			}
		}
		$active_color = "#".$options['active_color'];
		$inactive_color = "#".$options['inactive_color'];
		$body_color = "#".$options['body_color'];
		$background_color = "#".$options['background_color'];
		$custom_opacity=floatval($options['custom_opacity']/100);
		$custom_opacity_half=floatval($options['custom_opacity']/100/2);
		$custom_opacity_btn=floatval($options['custom_opacity_btn']/100);
		$custom_opacity_btn_ie=floatval($options['custom_opacity_btn']);
		$splitted_body_color= html2rgb($body_color);
		$splitted_background_color=html2rgb($background_color);
		$splitted_inactive_color=html2rgb($inactive_color);
		$shadow_opacity=floatval($options['custom_shadow']/100);
		$darker_body_color=alter_brightness($body_color,-80);
		$clearer_body_color=alter_brightness($body_color,40);
		//TOOLTIPS BUG WHEN BK COLOR IS BLACK
		if ($background_color=='#000' || $background_color=='#000000')
		{
			$splitted_background_colortips[0]="0";
			$splitted_background_colortips[1]="0"; 
			$splitted_background_colortips[2]="1";
		}
		else
			$splitted_background_colortips=html2rgb($background_color);
		if ($options['icon_set']=="clear")
		{
			$clearer_inactive_color=alter_brightness($inactive_color,40);
			$darker_inactive_color=alter_brightness($inactive_color,-80);
		}
		else
		{
			$clearer_inactive_color=alter_brightness($inactive_color,-80);
			$darker_inactive_color=alter_brightness($inactive_color,40);
		}
		
		//START BUILDING CSS SENTENCE TO CUSTOMIZE CONTENT
		$css = "<style type='text/css'>\n";
		//ADJUT MENU POSITION
		$css .=	".opened_menu
				{
					margin-top:" .$options['menu_vertical']. "px;
				}
				";
		
		
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
				case "PT+Sans":
				return ''.'PT Sans';
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
				case "Lato:400,700":
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
				case "Raleway:400,700":
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
				case "Julius+Sans+One":
				return ''."'Julius Sans One', sans-serif;";
				break;
				case "Gentium+Basic:400,700,400italic,700italic":
				return ''."'Gentium Basic', serif;";
				break;
				default:
				return ''.'Times';
			}		
		}
		$css .=	"body,
				#comment,
				#contact-form #c_message
				{
					font-family:" .font_google_to_css($options['body_font']). ";
				}
				h1,
				h2,
				h3,
				h4,
				.nav,
				.top_teaser,
				.theme_button,
				.theme_button_inverted,
				.comment-reply-link,
				.author_name,
				#nav_footer,
				.copy,
				.navbar .sf-menu,
				#comments_slider .comment-author,
				#comments_slider .comment-link,
				.day,
				.month,
				.theme_tags,
				#collapsed_menu_text,
				.grid_single_title,
				#contact_address h5,
				.homepage-header,
				.search-query,
				.sidebar_bubble,
				.prk_member .prk_member_fctn
				{
					font-family:" .font_google_to_css($options['header_font']). ";
					
				}
				h1,
				h2,
				.nav
				{
					text-transform:uppercase;
				}
				.entry_title h2,
				header h2
				{
					text-transform:none;
				}
				";
		
		//ICON SET MANAGMENT
		$css .=	".flex-direction-nav li a
				{ 
					background: url(" . get_bloginfo('template_url') . "/images/icons/".$options['icon_set']."/arrows.png) no-repeat;
				}
				#sidebar .widget_recent_entries li, 
				#sidebar .widget_categories li,
				#sidebar .widget_archive li
				{
					background:transparent url(" . get_bloginfo('template_url') . "/images/icons/list_minimal.png) no-repeat;
				}
				.pir_home,
				.pir_email,
				.pir_fax,
				.pir_phone,
				.form_name_icon
				{
					background:transparent url(" . get_bloginfo('template_url') . "/images/icons/contact_icons.png) no-repeat;
				}
				#single_slider .flex-direction-nav li a,
				.es-nav span,
				.next_link_portfolio,
				.prev_link_portfolio
				{
					background: url(" . get_bloginfo('template_url') . "/images/icons/".$options['icon_set']."/arrows.png) no-repeat;
				}
				.blog_icon,
				#collapsed_menu_arrow,
				#up_arrow,
				#down_arrow
				{
					background: url(" . get_bloginfo('template_url') . "/images/icons/".$options['icon_set']."/various_icons.png) no-repeat;
				}
				.readmore_btn,
				.lightbox_btn,
				.search_icon
				{
					background: url(" . get_bloginfo('template_url') . "/images/icons/".$options['icon_set']."/various_icons.png);
					background-repeat: no-repeat;
				}
				";
		//ICONS SET MANAGMENT
		if ($options['icon_set_ct']=="black_ic")
		{
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
		}
		if ($options['icon_set_ct']=="white_ic")
		{
			$css .= ".pir_phone
			{
			  background-position:-39px -40px !important;
			}
			.pir_email
			{
			  background-position:-119px -40px !important;
			}
			.pir_fax
			{
			  background-position:-79px -40px !important;
			}
			.pir_home
			{
			  background-position:0px -40px !important;
			}
			.man_icon 
			{
			  background-position:-172px -50px !important;
			}
			.email_icon 
			{
			  background-position:-211px -51px !important;
			}
			.info_icon 
			{
			  background-position:-250px -49px !important;
			}
			.link_icon 
			{
			  background-position:-290px -49px !important;
			}
			";
		}
		if ($options['icon_set_ct']=="custom_ic")
		{
			$css .= ".pir_phone
			{
			  background-position:-39px -80px !important;
			}
			.pir_email
			{
			  background-position:-119px -80px !important;
			}
			.pir_fax
			{
			  background-position:-79px -80px !important;
			}
			.pir_home
			{
			  background-position:0px -80px !important;
			}
			.man_icon 
			{
			  background-position:-172px -90px !important;
			}
			.email_icon 
			{
			  background-position:-211px -91px !important;
			}
			.info_icon 
			{
			  background-position:-250px -89px !important;
			}
			.link_icon 
			{
			  background-position:-290px -89px !important;
			}
			";
		}
		if ($options['icon_set']=="dark")
		{
			$css .= "#pir_loader_wrapper
					{
						top:16px !important;
					}";	
		}	
		//BACKGROUND OVERLAY MANAGMENT
		if ($options['overlay_image']!="")
		{
			$css .= ".overlay
					{
						background: url(" . get_bloginfo('template_url') . "/images/overlays/".$options['overlay_image'].") repeat scroll 0 0 transparent;
					}";	
		}	
		
		//COLOR MANAGMENT
		$css .= "body,
				.widget_recent_entries a,
				.widget_categories a,
				.widget_archive a,
				.zero_color a,
				.blog_meta>p>a,
				#single_portfolio_meta .comments-link,
				.navbar .sf-menu li a,
				h3 small,
				.contact_address_right_single a,
				.copy,
				.homepage-header,
				#nav-main.collapse .sub-menu li a
				{
					color: $body_color;
				}
				a,
				a:hover,
				#content-info h3,
				#top_widgets h3,
				.home_blog_date_text h4,
				#comment_form_messages,
				#single_portfolio_meta a:hover,
				.comment_date,
				.author_name a:hover,
				.flexslider .headings_body h4,
				.grid_single_title,
				.contact_error,
				#contact_ok,
				#top_widgets .email a:hover,
				h3 a:hover,
				#nbr_helper a:hover,
				.entry-title a:hover,
				#nav_footer .active a,
				#nav_footer a:hover,
				.blog_meta>p>a:hover,
				#single_portfolio_meta .comments-link:hover,
				.home_folio_title_grid h4,
				.related_fader_grid h4
				{
					color: $active_color;
				}
				#nav_footer ul li a,
				.single_entry_tags a,
				.theme_tags li a,
				.flexslider .headings_top h3,
				#top_widgets,
				#top_widgets .email a
				{
					color:$inactive_color;	
				}
				.theme_button a,
				.theme_button_inverted a,
				.theme_tags li a,
				.day,
				.month,
				.top_teaser
				#collapsed_menu_text,
				.search_icon,
				#collapsed_menu_text,
				#nbr_helper a,
				#no_more
				{
					color:$clearer_inactive_color;	
				}
				.ui-tooltip-tipsy .ui-tooltip-titlebar, 
				.ui-tooltip-tipsy .ui-tooltip-content
				{
					color:$clearer_inactive_color !important;	
				}
				#commentform #author,
				#commentform #email,
				#commentform #url,
				#commentform #comment,
				#contact-form #c_name,
				#contact-form #c_email,
				#contact-form #c_subject,
				#contact-form #c_message,
				#commentform,				
				#queed_search,
				.form_name_icon,
				.navbar .sf-menu .sub-menu li a,
				.skills_text
				{
					color: $darker_inactive_color;
				}
				::-webkit-input-placeholder
				{
					color: $darker_inactive_color;
				}
				h1,
				h1 small,
				h2,
				h3,
				h3 a,
				h4,
				.blog_meta>p>span,
				.single_heading,
				.sf-menu li li.before_nav_icon:before,
				.single_heading,
				.author_name,
				.author_name a,
				.navbar .sf-menu .active>a,
				.navbar .sf-menu a:hover,
				.navbar .sf-menu .sub-menu li a:hover,
				.entry-title a,
				.bk_color_text,
				a.lk_text,
				.sidebar_bubble,
				a.lk_text:hover,
				.grid_single_title_db a
				{
					color:$background_color;
				}
				.flexslider .headings_body
				{
					background-color: $inactive_color;
				}
				.flex-control-nav li a 
				{
					-webkit-box-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
					-mobox-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
					box-shadow: 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.75);
	}
				#commentform #author,
				#commentform #email,
				#commentform #url,
				#commentform #comment,
				#contact-form #c_name,
				#contact-form #c_email,
				#contact-form #c_subject,
				#contact-form #c_message,
				#queed_search,		
				#nav-main .sub-menu,
				.flex-control-nav li a:hover
				{
					background-color: $clearer_inactive_color;
				}
				.pir_divider
				{
					background-color: $clearer_body_color;
				}
				.theme_button a,
				.theme_tags li,
				.liner,
				.blog_date,
				.es-nav span,
				.flex-direction-nav li .flex-next,
				.flex-direction-nav li .flex-prev,
				#single_slider .flex-direction-nav li .flex-next,
				#single_slider .flex-direction-nav li .flex-prev,
				.next_link_portfolio,
				.prev_link_portfolio,
				.btn-primary,
				#magic-line,
				.grid_colored_block_db,
				.search_icon,
				.blog_fader_grid,
				.home_fader_grid,
				.flex-control-nav li a
				{
					background-color:$background_color;
				}
				.related_fader_grid,
				.grid_colored_block,
				.home_fader_grid_folio {
					background-color:rgba($splitted_background_colortips[0], $splitted_background_colortips[1], $splitted_background_colortips[2], 0.8);
				}
				.ui-tooltip-tipsy .ui-tooltip-titlebar, 
				.ui-tooltip-tipsy .ui-tooltip-content
				{
					background-color:rgba($splitted_background_colortips[0], $splitted_background_colortips[1], $splitted_background_colortips[2], 0.9);
				}
				.theme_tags li.active,			
				.blog_icon,
				.inner_line_block,
				.inner_line_sidebar_block,
				.theme_button_inverted a,
				.flexslider .headings_top,
				.flex-control-nav li a.flex-active,
				#black_bar,
				.top_teaser,
				.inner_line_single_block,
				.sidebar_bubble
				{
					background-color: $active_color;
				}
				.sidebar_bubble:after
				{ 
					border-top-color: $active_color !important;
				}
				.twitter_link
				{
					background-color: $active_color;
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
					border-color: transparent transparent transparent $active_color;	
				}
				.theme_button_inverted a.change:after
				{
					border-color: transparent transparent transparent $background_color !important;
				}
				.theme_button a:after
				{
					border-color: transparent transparent transparent $background_color;	
				}
				.theme_button_inverted a:after
				{
					border-color: transparent transparent transparent $active_color;
				}
				.blog_date,
				.theme_tags li,
				.search_icon,
				.content_block
				{
					background-color:rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],".$custom_opacity_btn."); 
				}
				#nav-main .sub-menu li,
				.navbar .sf-menu > li > a:hover,
				.navbar .sf-menu > li.sfHover a,
				#nav-main .sub-menu li > a:hover,
				.collapse ul>li>a,
				#collapsed_menu,
				#collapsed_menu_arrow
				{
					background-color:$darker_body_color;
					color:$clearer_inactive_color;
				}
				#nav-main .sub-menu li a {
					color:$body_color;
				}
				.navbar .sf-menu > li.active > a
				{
					background-color:$active_color;
					color:$clearer_inactive_color;
				}
				.portfolio_entry_li_db
				{
					background-color:rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],0.05); 
				}
				.flex-direction-nav li .flex-next,
				.flex-direction-nav li .flex-prev,
				.next_link_portfolio,
				.prev_link_portfolio,
				.ui-tooltip-tipsy .ui-tooltip-titlebar, .ui-tooltip-tipsy .ui-tooltip-content,.ui-tooltip-tip
				{
					opacity: ".$custom_opacity_btn.";
    				filter: alpha(opacity=".$custom_opacity_btn_ie.");
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
				input, 
				textarea, 
				select, 
				.uneditable-input
				{			
					border: 1px solid $inactive_color;
				}
				.dotted_line,
				.prk_member_fctn {
					border-bottom: 1px dotted $body_color;
				}
				#nav-main.collapse > .nav-wrap > .right_nav > .sf-menu > li:last-child  a
				{
					border-bottom:none !important;
				}
				.collapse ul a {
					border-top:1px solid rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.3) !important;
				}
				#after_widgets
				{
					border-top:dotted 1px $inactive_color;
				}
				.logo_line {
					border-bottom:8px $active_color solid;
				}
				.simple_line
				{
					border-bottom:1px $body_color solid;	
				}
				.page-header h1
				{
					border-bottom:1px solid $inactive_color;
				}
				#nav-main .sub-menu li {
					border-top:1px solid rgba($splitted_body_color[0], $splitted_body_color[1], $splitted_body_color[2],0.3);	
				}
				#nav-main .sub-menu li:first-child,
				#nav-main.collapse .sub-menu li {
					border-top:0px $body_color solid;	
				}
				#nav-main.collapse .left_nav>ul>li:first-child {
					
						
				}
				.widget_recent_entries li,
				.widget_categories li,
				.widget_archive li,
				.video_widget_line
				{
					border-bottom:1px $body_color dotted;
				}
				.pirenko_highlighted
				{
					border: 1px solid rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2],0.9);
					-webkit-box-shadow: inset 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.45);
					-mobox-shadow: inset 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.45);
					box-shadow: inset 0 1px 1px rgba($splitted_inactive_color[0], $splitted_inactive_color[1], $splitted_inactive_color[2], 0.45);
				}
				input, textarea 
				{
					
				}
				#top_sidebar_lixo 
				{
					border-bottom: 45px solid $active_color;
				}
				.navbar .sf-menu > li
				{
					border-bottom:0px $body_color solid;
				}
				.inverted_triangle
				{
				    border-bottom: 5px solid $active_color;
				}
				.mini_triangle {
					border-top: 5px solid $clearer_inactive_color;
				}
				.submenu_triangle
				{
				    border-bottom: 7px solid $clearer_inactive_color;
				}
				";
		//HEADER AND FOOTER
		//CHECK IF THERE'S A PATTERN TO DISPLAY
		if ($options['pattern_hf']!="")
		{
			$css .=
			"#content-info,
			#top_sidebar
			{
				background: url(" . get_bloginfo('template_url') . "/images/patterns/".$options['pattern_hf'].");
				
			}";
		}
		else
		{
			//SET THE BODY COLOR
			$css .=
			"#content-info,
			#top_sidebar
			{
				background-color:rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],".$custom_opacity.");
			}
			";
		}
		$css .= 
			"#content-info {
				-webkit-box-shadow: 0px 0px 3px 2px rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],".$custom_opacity_half.");
         		box-shadow: 0px 0px 3px 2px rgba($splitted_background_color[0], $splitted_background_color[1], $splitted_background_color[2],".$custom_opacity_half."); 
			}";
				
		//ADD CUSTOM CSS
		if ($options['css_text']!="")
		{
			$css .= "".$options['css_text']."";
		}
		
		$css .= "</style>\n";
		//OUTPUT THE CUSTOM STYLES WE JUST BUILT				
		echo $css;
		
	}//END queed_custom()
	
	
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
		$text = strip_tags($text); 
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
	function queed_entry_meta() 
	{
  		echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. get_the_date() .'</time>';
  		echo '<p class="byline author vcard">'. __('Written by', 'queed') .' <a href="'. get_author_posts_url(get_the_author_meta('id')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
	}
	
?>