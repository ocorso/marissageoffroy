<?php
  require 'data-array.php';
  //////////////////////////////////////////////////////////////////////////////
  // INIT FUNCTION
  //////////////////////////////////////////////////////////////////////////////    
  function freshpanel_add_init()
  {    
    if($_GET['page'] == 'functions.php')
    {

        $file_dir=get_bloginfo('template_directory');
        wp_enqueue_style("freshpanel_css", $file_dir."/freshwork/freshpanel/freshpanel.css", false, "1.0", "all");
        wp_enqueue_script("freshpanel_js", $file_dir."/freshwork/freshpanel/js/controls.js", false, "1.0");
        //wp_enqueue_script("freshpanel_select_js", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");
    }

   /* wp_enqueue_style("functionss", $file_dir."/freshwork/freshslider/freshslider.css", false, "1.0", "all");
    wp_enqueue_style("functions", $file_dir."/freshwork/freshpanel/freshpanel.css", false, "1.0", "all");
   // wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/jquery.livequery.js", false, "1.0");
      wp_enqueue_script("rm_scripts", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
    wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/controls.js", false, "1.0");
    wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0"); */
  }
  
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL ADD FUNCTION
  ////////////////////////////////////////////////////////////////////////////// 
  function freshpanel_add_admin()
  {
    global $themename, $shortname, $options;

    //if ( $_GET['page'] == basename(__FILE__) )
    {


         if( 'freshpanel_reset' == $_GET['action']  && $_GET['page'] == 'functions.php' && is_admin() && $_POST['anti_degen_protector'] == 'true') {

             foreach ($options as $value) {
                 delete_option( $value['id'] ); }

     //  header("Location: admin.php?page=freshpanel.php&reset=true");
       }
       else if ( 'freshpanel_save' == $_GET['action']  && $_GET['page'] == 'functions.php'  && is_admin() && $_POST['anti_degen_protector'] == 'true'  ) {
     //{
          /* foreach ($options as $value) {
      //    echo $_REQUEST['st_checkbox1111']."sa";
           update_option( $value['id'], addslashes($_REQUEST[ $value['id'] ]) );

            }  */

       foreach ($options as $value) {

           if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  htmlspecialchars_decode($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

    //       header("Location: admin.php?page=freshpanel.php&saved=true");
     //  die;

      }

     /*  else if( 'reset' == $_REQUEST['action'] ) {

           foreach ($options as $value) {
               delete_option( $value['id'] ); }

           header("Location: admin.php?page=zodiacbox.php&reset=true");
       die;

       }          */
   }



  }
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL CORE FUNCTION
  ////////////////////////////////////////////////////////////////////////////// 
  function freshpanel_admin()
  {
   global $themename, $shortname, $options;
   $navigation_content ="";
   $tab_content = "";
   $navigation_counter = 0;
   $tab_counter= 0;
   $options_content = "";
   foreach ($options as $value) {
 //    echo "xxxxxxx".get_option( $value['id'] ); 
      if (get_option( $value['id'] ) != "") $value['std'] =   get_option( $value['id'] );
      else
      {
        update_option( $value['id'],$value['std'] ); 
      }
      $value['std'] = htmlspecialchars( $value['std']);
      switch ( $value['type'] ) {        
        case "navigation":
          $tab_counter = 0;
          $style = ""; $selected = 'name="selected"';
   
          if($navigation_counter != 0) {$style = 'style="display:none;"'; $selected="";};
          $navigation_content .= '<li '.$selected.'>';
          $navigation_content .= '  <div class="passive" name="nav_'.$navigation_counter.'"></div>';
          $navigation_content .= '  <div class="active" '.$style.'></div>';
          $navigation_content .= '  <a href="javascript:" class="'.$value['icon'].'" >'.$value['name'].'</a>';
          $navigation_content .= '  <div class="active_arrow"></div>';
          $navigation_content .= '</li>';
          $tab_content .= '<ul class="tabs_wrapper" '.$style.' id="nav_'.$navigation_counter.'_tab">';   
          $options_content .= '<div class="box" id="nav_'.$navigation_counter.'_box" '.$style.' '.$selected.'>';    
        break;
        
        case "tab":
          $style = 'class="tab_active"'; $selected = 'name="selected"';
          $display = "";
          if($tab_counter != 0) {$style = 'class="tab_passive"'; $selected=""; $display='style="display:none;"';};
          $tab_content .= '<li '.$selected.'>';
          $tab_content .= '  <a href="javascript:" '.$style.' name="tab_'.$navigation_counter.'_'.$tab_counter.'">'.$value["name"].'</a>';
          $tab_content .= '</li>';
          $options_content .= '<div class="content_wrapper" id="tab_'.$navigation_counter.'_'.$tab_counter.'_wrapper" '.$display.' '. $selected . '>';  
        break;
   
        case "info":
          $options_content .= '<div class="intro_info">';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_big.png" alt="info" class="info_big" />';
          $options_content .= '<p>'.$value['name'].'</p>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/divider.png" class="divider" alt="divider" />';
          $options_content .= '</div>';
          $options_content .= '<div class="content">';
          
        break;
        
        case "select":
          $select_content = "";
          foreach ($value['options'] as $select_options) {
            $select_content .=   '<li>'.$select_options.'</li>';
          }
          $options_content .= '
                            <div class="select">
                                <h2>'.$value['name'].'</h2>
                                <img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" class="info_small" />
                                <p class="desc" style="display:none;">'.$value['desc'].'</p>
                                <div class="selectbox_wrapper">
                                    <input type="hidden" value="'.$value['std'].'" name="'.$value['id'].'" id="'.$value['id'].'">
                                    <div class="selected">'.$value['std'].'</div>
                                    <div class="select_options_wrapper">
                                      <div class="select_options_container">
                                            <ul class="select_options">
                                            '.$select_content.'
                                            </ul>
                                        </div>
                                        <div class="scrollbox">
                                            <div class="scrollbar_wrapper">
                                              <div class="scrollbar" name="0">
                                              </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="select_shadow"></div>
                                    </div>
                                </div>
                            </div><!-- END "div.select" -->';

        break;
        

        case "checkbox":
          $options_content .= '<div class="switch">';
          $options_content .= '<h2>'.$value['name'].'</h2>';
          $options_content .= '<div class="btn_switch">';
          $options_content .= '<input type="hidden" class="btn_switch_input" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$value['std'].'">';
          if($value['std']=="true") $options_content .= '<div class="on_off" style="left:0px"></div>';
          else $options_content .= '<div class="on_off"></div>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/btn_switch_overlay.png" class="over" />';

          $options_content .= '</div><!-- END "div.btn_switch" -->';
          
					$options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" alt="info" class="info_small" />';
          $options_content .= '<p class="desc" style="display:none;">'.$value['desc'].'</p>';
					$options_content .= '</div><!-- END "div.switch" -->';
        break;
        

        
        case "text":
          $options_content .= '<div class="input">';
          $options_content .= '<h2>'.$value['name'].'</h2>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" alt="info" class="info_small"/>';
          $options_content .= '<p class="desc" style="display:none;">'.$value['desc'].'</p>';
          $options_content .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.(stripslashes(($value['std']))).'">';
          $options_content .= '</div><!-- END "div.input" -->';
        break;
        
        case "textarea":
          $options_content .= '<div class="input">';
          $options_content .= '<h2>'.$value['name'].'</h2>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" alt="info" class="info_small"/>';
          $options_content .= '<p class="desc" style="display:none;">'.$value['desc'].'</p>';
          $options_content .= '<textarea id="'.$value['id'].'" name="'.$value['id'].'">'.(stripslashes(($value['std']))).'</textarea>';
          $options_content .= '<div class="clear"></div></div><!-- END "div.input" -->';
        break;
        
        case "reset":
          $options_content .= '<input type="submit" value="freshpanel_reset" class="btn_reset" name="reset" id="reset">';        
        break; 
        
        case "tab-close":
          $options_content .= '  <input name="save" type="submit" class="btn_save" value="" />  ';
          $options_content .= '<br /></div>';
          $options_content .= '</div>';
          $tab_counter++;
        break;  
   
        case "navigation-close":
          $tab_content .= '</ul>';
          $navigation_counter++;  
          $options_content .= '</div>';  
        break; 
                

      }    
   }  
  ?>
<img id="sneak_peak" style='position:absolute; z-index:999;'>
<div class="fresh_tooltip" style="position:absolute";>'.$value['desc'].'</div>
<div id="freshpanel">  
  <form id="freshpanel_form" method="post" action="?page=functions.php&action=freshpanel_save">
    <input type="hidden" name="anti_degen_protector" value="true" />
	<div id="wrapper_glogal">
    	<div class="wrapper_bg_outer">
            <div class="wrapper_bg">
                <div class="left">
                    <div class="logo"><img src="<?php echo get_bloginfo('template_url') ?>/freshwork/freshpanel/gfx/logo.png" alt="freshpanel logo" /></div>
                    <ul class="wrapper_nav">
                            <?php echo $navigation_content;?>
                    </ul><!-- END "ul.wrapper_nav" -->
                    <div class="shadow_bottom"></div>
                </div><!-- END "div.left" -->
                <div class="right">
                    <div class="header">
                        <div class="header_inner">
                        <?php if(get_option('ff_fr_links') != "false" ){ ?>
                            <div class="links">
                                <h2>G'day admin!</h2>
                                <p><a href="http://themeforest.net/item/rockwell-portfolio-blog-wordpress-theme/249087?ref=freshface" target="_blank" class="btn_small">TF Item Page</a></p>
                                <p><a href="http://themeforest.net/item/rockwell-portfolio-blog-wordpress-theme/249087?ref=freshface" target="_blank" class="btn_small">Check for newer version</a></p>
                                <p><a href="<?php echo get_bloginfo('template_url');?>/documentation/documentation.html" target="_blank" class="btn_small">Documentation</a></p>
                            </div><!-- END "div.links" -->
                        <div class="fresh_items">
                            <h2>Browse my themes:</h2>
                            <div class="fresh_themes_wrapper">
								<?php 
									/* gets the data from a URL */
									if( function_exists  (  'curl_init'  ) )
									{
									  $fresh_url = 'http://freshface.cz/freshpanel/mythemes.php';
									$ch = curl_init();
									$timeout = 5;
									curl_setopt($ch,CURLOPT_URL,$fresh_url);
									curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
									curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
									$fresh_data = curl_exec($ch);
									curl_close($ch);
									echo $fresh_data;
									}      
								?>
                            </div><!-- END "div.fresh_themes_wrapper" -->
                            <div class="button_wrapper">
                                <p><a href="http://themeforest.net/user/freshface/portfolio?ref=freshface" target="_blank" class="btn_small">Browse all</a></p>
                                <p><a href="http://www.freshface.net/fffp-lcp/" target="_blank" class="btn_small">Visit my Blog</a></p>
                                <div class="btn_nav">
                                    <div class="btn_nav_left"></div>
                                    <div class="btn_nav_right"></div>
                                </div>
                            </div><!-- END "div.button_wrapper" -->
                        </div><!-- END "div.fresh_items" -->
                        <?php } ?>
                    </div><!-- END "div.header_inner" -->
                       <?php echo $tab_content; ?>
                    </div><!-- END "div.header" -->
                    <?php echo $options_content; ?>
    
                </div><!-- END "div.right" -->
                <div class="clear"></div>
            </div><!-- END "div.wrapper_bg" -->
        </div><!-- END "div.wrapper_bg_outer" -->
	</div>
    <!-- END "div#wrapper_glogal" -->
    <div class="theme_version">
	    <?php
		    $theme_data = get_theme_data(get_stylesheet_uri());
		    echo $theme_data['Name'];
		?>
    </div>
    </form>
</div><!-- END "div#freshpanel" -->
  <?php
  }
  //////////////////////////////////////////////////////////////////////////////
  // ACTIONS
  ////////////////////////////////////////////////////////////////////////////// 
  add_action('admin_init', 'freshpanel_add_init');  
  add_action('admin_menu', 'freshpanel_add_admin');         
 
?>
