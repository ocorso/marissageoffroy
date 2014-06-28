<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]--><head>
  <meta charset="utf-8">

  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />

  <?php
  	$count = wp_count_posts('post'); 
	if ($count->publish > 0) {
    echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
  } 
	global $pixia_frontend_options; 
	$pixia_frontend_options=get_option('pixia_theme_options');
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	global $portfolio_link;
	global $portfolio_link_ms;
	global $blog_linked;
	$portfolio_link="";
	$portfolio_link_ms="";
	$blog_linked="";
	//GET PORTFOLIO PAGE LINK IF NEEDED
	if (is_page_template ('template_portfolio.php'))
		$portfolio_link=get_page_link( ); 
	//GET PORTFOLIO MASONRY PAGE LINK IF NEEDED
	if (is_page_template ('template_portfolio_masonry.php'))
		$portfolio_link_ms=get_page_link( ); 
	$active_color = $pixia_frontend_options['active_color'];
	add_action('wp_footer','jquery_sender');
	function jquery_sender() 
	{
		pixia_custom();
		global $bk_url;
		global $portfolio_link;
		global $portfolio_link_ms;
		$blog_linked="";
		if ((is_single() && get_post_type()!="pirenko_portfolios") || is_archive())
		{
			$s_cats=get_the_category();
			$i=0;
			$inside_filter="";
			$cats_arr = array("");
			if($s_cats){
				foreach($s_cats as $s_cat) {
					array_push($cats_arr,$s_cat->slug);
					$i++;
				}
			}
			$final_link="";
			$pages_blog = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template_blog.php'
			));
			foreach($pages_blog as $page_blog)
			{
				$blog_linked=get_page_link( $page_blog->post_id );
				$data = get_post_meta( $page_blog->post_id, '_custom_meta_blog_template', true );
				$inside_filter="";
				if (!empty($data))
				{
					if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
					{
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								if (in_array($childs, $cats_arr)) {
									$final_link=$blog_linked;
								}
							}
						}
					}
				}
			}
			$pages_blog = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template_blog_masonry.php'
			));
			foreach($pages_blog as $page_blog)
			{
				$blog_linked=get_page_link( $page_blog->post_id );
				$data = get_post_meta( $page_blog->post_id, '_custom_meta_blog_template', true );
				$inside_filter="";
				if (!empty($data))
				{
					if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
					{
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								if (in_array($childs, $cats_arr)) {
									$final_link=$blog_linked;
								}
							}
						}
					}
				}
			}
			if ($final_link!="")
				$blog_linked=$final_link;
		}
		$home_link="";
		$home_slug="";
		if (is_page_template ('template_blog_masonry.php') && is_front_page())
		{
			$home_link=get_page_link(get_query_var('page_id'));
			$home_slug=the_slug(get_query_var('page_id'));
		}
		if (is_page_template ('template_blog.php') && is_front_page())
		{
			$home_link=get_page_link(get_query_var('page_id'));
			$home_slug=the_slug(get_query_var('page_id'));
		}
		if (is_page_template ('template_portfolio_masonry.php') && is_front_page())
		{
			$home_link=get_page_link(get_query_var('page_id'));
			$home_slug=the_slug(get_query_var('page_id'));
		}
		if (is_page_template ('template_portfolio.php') && is_front_page())
		{
			$home_link=get_page_link(get_query_var('page_id'));
			$home_slug=the_slug(get_query_var('page_id'));
		}
		if ($portfolio_link!="" || $portfolio_link_ms!="")
			$blog_linked="";
		$jquery_options=get_option('pixia_theme_options');
		//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
		if (INJECT_STYLE)
		{
			include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_js.php');	
		}
		$clearer_inactive_color=alter_brightness($jquery_options['inactive_color'],40);
		$darker_inactive_color=alter_brightness($jquery_options['inactive_color'],-80);
		$darker_body_color=alter_brightness($jquery_options['body_color'],-50);
		$custom_opacity_half=floatval($jquery_options['custom_opacity']/100/2);
		if (!isset($jquery_options['custom_shadow']))
			$jquery_options['custom_shadow']=0;
		$custom_shadow=floatval($jquery_options['custom_shadow']/100);
		//GET POST SKILLS
		global $category_ids;
		//CONVERT INTO ARRAY
		$arr=explode(",",$category_ids);
		//ALTERNATIVE LOGO?
		$alt_logo="";
		if (isset($jquery_options['alt_logo']) && $jquery_options['alt_logo']!="")
			$alt_logo=$jquery_options['alt_logo'];
		$custom_height="400";
		if (isset($jquery_options['custom_height']) && $jquery_options['custom_height']!="")
			$custom_height=$jquery_options['custom_height'];
		//SEND VALUES TO JQUERY
		?>
		<script type="text/javascript">
			var bk_url = '<?php echo $bk_url ?>';
			var active_color = '<?php echo $jquery_options['active_color']; ?>';
			var inactive_color = '<?php echo $jquery_options['inactive_color']; ?>';
			var body_color = '<?php echo $jquery_options['body_color']; ?>';
			var darker_body_color = '<?php echo $darker_body_color ?>';
			var clearer_inactive_color = '<?php echo $clearer_inactive_color ?>';
			var darker_inactive_color = '<?php echo $darker_inactive_color ?>';
			var background_color = '<?php echo $jquery_options['background_color']; ?>';
			var custom_opacity_half = '<?php echo $custom_opacity_half; ?>';
			var custom_shadow= '<?php echo $custom_shadow; ?>';
			var portfolio_link = '<?php echo $portfolio_link; ?>';
			var portfolio_link_ms = '<?php echo $portfolio_link_ms; ?>';
			var blog_link = '<?php echo $blog_linked; ?>';
			var home_link = '<?php echo $home_link; ?>';
			var home_slug = '<?php echo $home_slug; ?>';
			var autoplay_portfolio = '<?php echo $jquery_options['autoplay_portfolio']; ?>';
			var delay_portfolio = '<?php echo $jquery_options['delay_portfolio']; ?>';
			var resp_mode = '<?php echo $jquery_options['responsive']; ?>';
			var theme_url_js="<?php echo get_template_directory_uri(); ?>";
			var alt_logo="<?php echo $alt_logo; ?>";
			var custom_height="<?php echo $custom_height; ?>";
			<?php echo $jquery_options['js_text']; ?>
		</script>
        <?php
	}
	?>
	<!-- GOOGLE FONTS - IF NEEDED -->
     <?php
	 	if (is_google_font($pixia_frontend_options['header_font']))
		{
			?>
            <link href='http://fonts.googleapis.com/css?family=<?php echo ($pixia_frontend_options['header_font']); ?>' rel='stylesheet' type='text/css' />
            <?php
		}
		else
		{
			if ($pixia_frontend_options['header_font']!="courier_new" && $pixia_frontend_options['header_font']!="helvetica" && $pixia_frontend_options['header_font']!="Arial")
			{
				?>
				<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/fonts/<?php echo ($pixia_frontend_options['header_font']); ?>/stylesheet.css" type="text/css" charset="utf-8">
				<?php
			}
		}
	?>
    
    <?php 
		if (is_google_font($pixia_frontend_options['body_font']))
		{
			?>
			<link href='http://fonts.googleapis.com/css?family=<?php echo ($pixia_frontend_options['body_font']); ?>' rel='stylesheet' type='text/css' />
            <?php
		}
		else
		{
			if ($pixia_frontend_options['body_font']!="courier_new" && $pixia_frontend_options['body_font']!="helvetica" && $pixia_frontend_options['body_font']!="Arial")
			{
				?>
				<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/fonts/<?php echo ($pixia_frontend_options['body_font']); ?>/stylesheet.css" type="text/css" charset="utf-8">
				<?php
			}
		}
	?>
    <link href='http://fonts.googleapis.com/css?family=Poly:400italic' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo $pixia_frontend_options['favicon']; ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(roots_body_class()); ?>>
	 <?php
            //BACKGROUND CONFIGURATION 
            global $bk_url;
            $bk_url= $pixia_frontend_options['background_image'];
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
                if ($pixia_frontend_options['background_image']!="")
                {
                    ?>
                    <img id="full-screen-background-image" />
                    <?php
                }
			}
                //CHECK IF THERE'S A PATTERN TO DISPLAY
                if ($pixia_frontend_options['pattern']!="")
                {
                    $background_css .=
                    "body
                    {
                        background: url(" . get_template_directory_uri() . "/images/patterns/".$pixia_frontend_options['pattern'].");
                        background-attachment:fixed;
                    }";
                }
                    //SET THE BODY COLOR
                    $background_css .=
                    "body
                    {
                        background-color:".$pixia_frontend_options['site_background_color'].";	
                    }";
                
            $background_css .= "</style>\n";			
            echo $background_css;
        ?>
	<div class="overlay"></div>
    <div id="dump"></div>
    <div class="ultra_wrapper">
    <div id="wrap" class="<?php echo WRAP_CLASSES; ?>" role="document">
    <div id="aj_loader"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="pir_loader"></div>
    <div id="left_ar" class="">
        <header id="banner" class="navbar three columns right_0" role="banner">
            <div class="navbar-inner">
                    <div id="logo_holder" class="cf">
                         <div class="brand" style="overflow:hidden;">
                            <a href="<?php echo home_url(); ?>" class="cf">
                                <img id="pixia_logo_image" src="<?php echo $pixia_frontend_options['logo']; ?>" class="" />
                            </a>
                    	</div>
                    	<div class="cf">
                    </div>
                    <div class="coll_wrapper boxed_shadow colored_bg">
                        <a class="btn-navbar cf">
                            <div id="collapsed_menu" class="colored_bg">
                                <div id="collapsed_menu_text"> 
                                    <?php echo ($pixia_frontend_options['responsive_tip_text']); ?>
                                </div>
                            </div>
                            <div id="collapsed_menu_arrow" class="">  
                            	<div class="tr_wrapper" style="z-index:0;top:3px;margin-left:8px;">
                                  <div class="submenu_lowerarrow pirenko_tinted">
                                      <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $active_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                  </div>
                              </div>  
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="divider_tp hide_later"></div>
                    <div class="opened_menu">
                        <nav id="nav-main" class="nav-collapse cf collapse" role="navigation">
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
                        </nav>
                    </div>
                    
                    <div class="clearfix"></div>
                    <?php 
						if ($pixia_frontend_options['undermenu_sidebar']=="yes")
						{
							?>
                            <div class="divider_tp hide_much_later"></div>
                            <div class="clearfix"></div>
                        	<div id="undermenu_sidebar">
                                <?php 
                                    if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-underm')) : 
                                    else : 
                                        ?>
                                        <!-- THIS CONTENT WILL BE DISPLAYED IF THERE ARE NO WIDGETS -->
                                        <div id="no-widgets" class="">
                                          <p>
                                              <strong>NO WIDGETS YET</strong><br>
                                              There are still no widgets here. To add some content please go to the Dashboard and add some Widgets to the Under Menu Sidebar. If you don't need this section just go to Pixia Options and switch off the Under Menu Sidebar.
                                          </p>
                                        </div><!-- no-widgets -->
                                        <?php 
                                    endif; 
                                ?>
                                <div id="height_helper">
                                </div>
                                <div class="divider_tp show_later hide_much_later"></div>
                            </div>
                        <?php
						}
					?>
            </div>
        </header>
            <footer id="content-info" role="contentinfo">
            <div style="position:relative">
                <div class="<?php echo WRAP_CLASSES; ?>">       
                    <div id="footer_sidebar">
                        <?php
                            if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) : 
                            else : 
        
                            endif;  
                        ?>
                    </div>
                    <div id="after_widgets" class="<?php echo WRAP_CLASSES; ?>">
                        <p class="copy"><?php echo $pixia_frontend_options['footer_text']; ?></p>
                    </div>
                </div>
                </div> 
                <div class="clearfix"></div>
            </footer> 
            
        </div>
        <!-- SIDEBAR IF AVAILABLE-->
            <?php 
		if ($pixia_frontend_options['bottom_sidebar']=="yes")
		{
			?>
            <div id="bottom_sidebar" class="boxed_shadow row">
                <div id="bottom_sidebar_in" class="<?php echo WRAP_CLASSES; ?>">
                    <div id="top_widgets" class="twelve columns unpadded_low" >
                    <div class="row">
                        <?php 
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-bottom')) : 
							else : 
								?>
								<!-- THIS CONTENT WILL BE DISPLAYED IF THERE ARE NO WIDGETS -->
								<div id="no-widgets" class="">
									<h3>NO WIDGETS YET </h3>
										<p>
											There are still no widgets here. To add some content please go to the Dashboard and add some Widgets to the Top Sidebar. If you don't need this section just go to Pixia Options and switch off the Top Sidebar.
										</p>
								</div><!-- no-widgets -->
								<?php 
							endif; 
						?>
                        <div id="height_helper">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div id="trapezoid" >
           		<div class="bottom_teaser rotated">
             	</div>
                
                <div id="down_arrow">
                <div class="tr_wrapper" style="z-index:0">
                	<div class="submenu_plus pirenko_tinted">
                     	<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['body_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                     	</div>
              	</div>
                </div>
                <div id="up_arrow">
                <div class="tr_wrapper" style="z-index:0">
                	<div class="submenu_minus pirenko_tinted">
                     	<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['body_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                     	</div>
              	</div>
                </div>
         	</div>
            <?php
		}
	?>