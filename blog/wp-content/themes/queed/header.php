<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
  	$count = wp_count_posts('post'); 
	if ($count->publish > 0) {
    echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
  } 
	global $queed_frontend_options; 
	$queed_frontend_options=get_option('queed_theme_options');
	//OVERRIDE OPTIONS ONLY IF IN PREVIEW MODE
	if (isset($_SESSION['front_queed_active_color']))
	{
		if ($_SESSION['front_queed_active_color']!="")
			$queed_frontend_options['active_color']=$_SESSION['front_queed_active_color'];
	}
	if (isset($_SESSION['front_queed_pattern']))
	{
		if ($_SESSION['front_queed_pattern']!="")
			$queed_frontend_options['pattern']=$_SESSION['front_queed_pattern'];
	}
	if (isset($_SESSION['front_queed_skin']))
		{
			if ($_SESSION['front_queed_skin']!="")
			{
				$queed_frontend_options['icon_set']=$_SESSION['front_queed_skin'];
				if ($_SESSION['front_queed_skin']=="dark")
				{
					$queed_frontend_options['background_color']="FFFFFF";
					$queed_frontend_options['inactive_color']="333333";
					$queed_frontend_options['body_color']="777777";
					$queed_frontend_options['logo']="http://www.munto.net/queed-v1/files/2012/07/logofnlcl.png";
				}
				else
				{

				}
			}
		}
		global $portfolio_link;
		global $blog_linked;
		$portfolio_link="";
		$blog_linked="";
		//GET PORTFOLIO PAGE LINK IF NEEDED
		if (get_post_type()=="pirenko_portfolios")
		{
			$pages_port = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'template_portfolio.php'
			)); 
			foreach($pages_port as $page_port)
			{
				//CHECK IF THIS PORTFOLIO PAGE CONTAINS THE CATEGORY CURRENTLY BEING USED
				global $custom_metabox;
				$meta = get_post_meta($page_port->post_id, $custom_metabox->get_the_id(), TRUE);
				if (isset($meta['use_featured']))
				{
					foreach($arr as $term)
                    {
						//REMOVE WHITE SPACES IF NEEDED
						$my_n = str_replace (" ", "", $term);
						if (isset($meta[$my_n]))
						{
                    		$portfolio_link=get_page_link( $page_port->post_id );
						}
                 	}
				}
				else
				{
					$portfolio_link=get_page_link( $page_port->post_id ); 
				}
			}
		}
	
		if ((is_single() && get_post_type()!="pirenko_portfolios") || is_archive())
		{
			//CHECK IF IT'S A TAG PAGE
			//if (is_tag())
			//{
				$pages_blog = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'template_blog.php'
				));
				foreach($pages_blog as $page_blog)
				{
					$blog_linked=get_page_link( $page_blog->post_id );
				}
			//}
		}
	add_action('wp_footer','jquery_sender');
	function jquery_sender() 
	{
		queed_custom();
		global $bk_url;
		global $portfolio_link;
		$blog_linked="";
		if ((is_single() && get_post_type()!="pirenko_portfolios") || is_archive())
		{
			//CHECK IF IT'S A TAG PAGE
			//if (is_tag())
			//{
				$pages_blog = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'template_blog.php'
				));
				foreach($pages_blog as $page_blog)
				{
					$blog_linked=get_page_link( $page_blog->post_id );
				}
			//}
		}
		if ($portfolio_link!="")
			$blog_linked="";
		$jquery_options=get_option('queed_theme_options');
		//OVERRIDE OPTIONS ONLY IF IN PREVIEW MODE
		if (isset($_SESSION['front_queed_active_color']))
		{
			if ($_SESSION['front_queed_active_color']!="")
				$jquery_options['active_color']=$_SESSION['front_queed_active_color'];
		}
		if (isset($_SESSION['front_queed_pattern']))
		{
			if ($_SESSION['front_queed_pattern']!="")
				$jquery_options['pattern']=$_SESSION['front_queed_pattern'];
		}
		if (isset($_SESSION['front_queed_skin']))
		{
			if ($_SESSION['front_queed_skin']!="")
			{
				$jquery_options['icon_set']=$_SESSION['front_queed_skin'];
				if ($_SESSION['front_queed_skin']=="dark")
				{
					$jquery_options['background_color']="FFFFFF";
					$jquery_options['inactive_color']="333333";
					$jquery_options['body_color']="777777";
					$jquery_options['custom_opacity']="25";
				}
				else
				{
	
				}
			}
		}
		if ($jquery_options['icon_set']=="clear")
		{
			$clearer_inactive_color=alter_brightness($jquery_options['inactive_color'],40);
			$darker_inactive_color=alter_brightness($jquery_options['inactive_color'],-80);
		}
		else
		{
			$clearer_inactive_color=alter_brightness($jquery_options['inactive_color'],-80);
			$darker_inactive_color=alter_brightness($jquery_options['inactive_color'],40);
		}
		$custom_opacity_half=floatval($jquery_options['custom_opacity']/100/2);
		$custom_opacity_btn=floatval($jquery_options['custom_opacity_btn']/100);
		if (!isset($jquery_options['custom_shadow']))
			$jquery_options['custom_shadow']=0;
		$custom_shadow=floatval($jquery_options['custom_shadow']/100);
		//GET POST SKILLS
		global $category_ids;
		//CONVERT INTO ARRAY
		$arr=explode(",",$category_ids);
		
		$home_link="";
		$home_slug="";
		if (is_page_template ('template_blog.php') && is_front_page())
		{
			$home_link=get_page_link(get_query_var('page_id'));
			$home_slug=the_slug(get_query_var('page_id'));
		}
		//SEND VALUES TO JQUERY
		?>
		<script type="text/javascript">
			var bk_url = '<?php echo $bk_url ?>';
			var logo_w = '<?php echo $jquery_options['logo_w']; ?>';
			var active_color = '<?php echo "#".$jquery_options['active_color']; ?>';
			var inactive_color = '<?php echo "#".$jquery_options['inactive_color']; ?>';
			var body_color = '<?php echo "#".$jquery_options['body_color']; ?>';
			var clearer_inactive_color = '<?php echo $clearer_inactive_color ?>';
			var darker_inactive_color = '<?php echo $darker_inactive_color ?>';
			var background_color = '<?php echo "#".$jquery_options['background_color']; ?>';
			var custom_opacity_half = '<?php echo $custom_opacity_half; ?>';
			var custom_shadow= '<?php echo $custom_shadow; ?>';
			var portfolio_link = '<?php echo $portfolio_link; ?>';
			var blog_link = '<?php echo $blog_linked; ?>';
			var home_link = '<?php echo $home_link; ?>';
			var home_slug = '<?php echo $home_slug; ?>';
			var autoplay_homepage = '<?php echo $jquery_options['autoplay_homepage']; ?>';
			var delay_homepage = '<?php echo $jquery_options['delay_homepage']; ?>';
			var autoplay_portfolio = '<?php echo $jquery_options['autoplay_portfolio']; ?>';
			var delay_portfolio = '<?php echo $jquery_options['delay_portfolio']; ?>';
			var use_lightbox="<?php echo $jquery_options['use_lightbox']; ?>";
		</script>
        <?php
	}
	?>
	<!-- GOOGLE FONTS - IF NEEDED -->
     <?php
	 	if (is_google_font($queed_frontend_options['header_font']))
		{
			?>
            <link href='http://fonts.googleapis.com/css?family=<?php echo ($queed_frontend_options['header_font']); ?>' rel='stylesheet' type='text/css' />
            <?php
		}
		else
		{
			?>
            <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/inc/fonts/<?php echo ($queed_frontend_options['header_font']); ?>/stylesheet.css" type="text/css" charset="utf-8">
            <?php
		}
	?>
    
    <?php 
		if ($queed_frontend_options['body_font']!="Arial")
		{
			?>
			<link href='http://fonts.googleapis.com/css?family=<?php echo ($queed_frontend_options['body_font']); ?>' rel='stylesheet' type='text/css' />
            <?php
		}
	?>
    <link rel="shortcut icon" href="<?php echo $queed_frontend_options['favicon']; ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(roots_body_class()); ?>>
	<div class="overlay"></div>
    <div class="ultra_wrapper">
	<div id="black_bar" class=""></div>
    <?php 
		if ($queed_frontend_options['top_sidebar']=="yes")
		{
			?>
            <div id="top_sidebar">
                <div id="top_sidebar_in" class="<?php echo WRAP_CLASSES; ?>">
                    <div id="top_widgets">
                        <?php 
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-top')) : 
							else : 
								?>
								<!-- THIS CONTENT WILL BE DISPLAYED IF THERE ARE NO WIDGETS -->
								<div id="no-widgets" class="">
									<h3>NO WIDGETS YET </h3>
										<p>
											There are still no widgets here. To add some content please go to the Dashboard and add some Widgets to the Top Sidebar. If you don't need this section just go to Queed Options and switch off the Top Sidebar.
										</p>
								</div><!-- no-widgets -->
								<?php 
							endif; 
						?>
                        <div id="height_helper">
                        </div>
                    </div>
                    <div id="trapezoid" >
                        <div class="top_teaser rotated">
                        </div>
                        <div id="up_arrow" class=""></div>
                        <div id="down_arrow" class=""></div>
                    </div>
                </div>
            </div>
            <?php
		}
	?>
    <header id="banner" class="navbar navbar-fixed-top" role="banner">
  		<div class="navbar-inner">
    		<div class="<?php echo WRAP_CLASSES; ?>">
                <div id="logo_holder" class="cf">
               		<div class="brand" style="overflow:hidden;">
                		<a href="<?php echo home_url(); ?>" class="cf">
                			<img id="queed_logo_image" src="<?php echo $queed_frontend_options['logo']; ?>" class="" />
                    	</a>
              			</div>
            		<div class="cf"></div>
                   	<a class="btn-navbar cf">
                    	<div id="collapsed_menu">
                        	<div id="collapsed_menu_text">
                            	<?php
									if (!isset($queed_frontend_options['collapsed_text']))
										$queed_frontend_options['collapsed_text']='Navigation';
									echo $queed_frontend_options['collapsed_text'];
								?>
                            </div>
                        </div>
                        <div id="collapsed_menu_arrow">    
                       	</div>
                  	</a>
             	</div>
                <div class="opened_menu">
                    <nav id="nav-main" class="nav-collapse cf" role="navigation">
                        <div class="nav-wrap">
                        	<div class="left_nav">
                            <?php 
								if ( has_nav_menu( 'top_left_navigation' ) ) 
								{
									wp_nav_menu(array('theme_location' => 'top_left_navigation', 'menu_class' => 'sf-menu ','link_after' => '')); 
								}
								else
								{
									//if ( has_nav_menu( 'Top Left Menu' ) )
									//wp_nav_menu(array('menu' => 'Top Left Menu', 'menu_class' => 'sf-menu ','link_after' => ''));
								}
							?>
                            </div>
                            <div class="right_nav">
                            <?php 
								if ( has_nav_menu( 'top_right_navigation' ) ) 
								{
									wp_nav_menu(array('theme_location' => 'top_right_navigation', 'menu_class' => 'sf-menu ','link_after' => '')); 
								}
							?>
                            </div>
                            </div>
                    </nav>
                    
                </div>
                <div class="clearfix"></div>
                <div class="line_wrapper">
                <div class="logo_line"></div>
                </div>
    		</div>
  		</div>
	</header>
    <?php
		//BACKGROUND CONFIGURATION 
		global $bk_url;
		$bk_url= $queed_frontend_options['background_image'];
		$background_css = "<style type='text/css'>\n";
		if (isset($post->ID) ? has_post_thumbnail( $post->ID ) && is_page() : false)
		{
			?>
			<img id="full-screen-background-image" />
			<?php
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			$bk_url=$image[0];
		}
		else
		{
			if ($queed_frontend_options['background_image']!="")
			{
				?>
				<img id="full-screen-background-image" />
				<?php
			}
			else
			{
			//CHECK IF THERE'S A PATTERN TO DISPLAY
			if ($queed_frontend_options['pattern']!="")
			{
				$background_css .=
				"body
				{
					background: url(" . get_bloginfo('template_url') . "/images/patterns/".$queed_frontend_options['pattern'].");
					background-attachment:fixed;
				}";
			}
			else
			{
				//SET THE BODY COLOR
				$background_css .=
				"body
				{
					background-color:#".$queed_frontend_options['site_background_color'].";	
				}";
			}
				}
		}
		$background_css .= "</style>\n";			
		echo $background_css;
	?>
 	
  <div id="wrap" class="<?php echo WRAP_CLASSES; ?>" role="document">