<?php
  function get_logo()
  {
      if(isset($_COOKIE['skin_changer_default']))
      {
           return get_bloginfo('template_url')."/skins/".$_COOKIE['skin_changer_default']."/gfx/logo.png";
      }
      if(get_option('ff_header_logo') == '')
      {
          $template_skin = get_option('ff_template_skin');
          return get_bloginfo('template_url')."/skins/".$template_skin."/gfx/logo.png";
      }
      else
          return get_option('ff_header_logo');
  }
 function get_header_template(){
    if( isset($_GET['livepanel_header_template'] ) )  $_SESSION['live_header_template'] = $_GET['livepanel_header_template'];
    if( isset( $_SESSION['live_header_template'] ) ) return $_SESSION['live_header_template'];
    return get_option('ff_template_header');
 }
 function get_slider_type(){
    if( isset($_GET['live_slider_type'] ) )  $_SESSION['live_slider_type'] = $_GET['live_slider_type'];
    if( isset( $_SESSION['live_slider_type'] ) ) return $_SESSION['live_slider_type'];
    return get_option('ff_template_slider_type');
 }
 function get_slider_grid(){
    if( isset($_GET['live_slider_grid'] ) )  $_SESSION['live_slider_grid'] = $_GET['live_slider_grid'];
    if( isset( $_SESSION['live_slider_grid'] ) ) return $_SESSION['live_slider_grid'];
    return get_option('ff_slider2_grid');
 }
 function get_slider_title(){
    if( isset($_GET['live_slider_title'] ) )  $_SESSION['live_slider_title'] = $_GET['live_slider_title'];
    if( isset( $_SESSION['live_slider_title'] ) ) return $_SESSION['live_slider_title'];
    return get_option('ff_slider2_title');
 }
  function get_slider_infobox(){
    if( isset($_GET['live_slider_infobox'] ) )  $_SESSION['live_slider_infobox'] = $_GET['live_slider_infobox'];
    if( isset( $_SESSION['live_slider_infobox'] ) ) return $_SESSION['live_slider_infobox'];
    return get_option('ff_slider2_infobox');
 }
 function get_stencil(){
     $template_skin = get_option('ff_template_skin');
     if( isset($_COOKIE['skin_changer_default']) )$template_skin = $_COOKIE['skin_changer_default'];
     
     if( isset($_COOKIE['stencil_default']  ) && $_COOKIE['stencil_default'] != 'null' ) $template_stencil = $_COOKIE['stencil_default'];
     else $template_stencil = get_option('ff_stencil_'.$template_skin);
     
     $slider_type = ' option-'.get_slider_type();
     
     return 'stencil_'.$template_stencil.$slider_type;
 }
  function get_cat_single_template() {

      if( $_SESSION['custom_template_id_single'] != '')
      {
          $cat_type = get_single_cat_type();

          //$to_return = get_option('cat_template-'.get_actual_cat());
          //if($to_return == '')
          $to_return = $cat_type.'-single-'.$_SESSION['custom_template_id_single'];
          return $to_return;
      }

      global $post;
      $post_meta_single = get_post_meta( $post->ID, 'single_template_custom', true);
      if($post_meta_single) return $post_meta_single;
      $to_return = get_option('cat_single_template-'.get_actual_cat());
      if($to_return == '') $to_return = 'blog-single-1';
      return $to_return;
  }
  function get_cat_template() {

      if($_SESSION['custom_template_id'] != '')
      {
          $cat_type = get_cat_type();

          //$to_return = get_option('cat_template-'.get_actual_cat());
          //if($to_return == '')
          $to_return = $cat_type.'-cat-'.$_SESSION['custom_template_id'];
          return $to_return;
      }
      $to_return = get_option('cat_template-'.get_actual_cat());
      if($to_return == '') $to_return = 'blog-cat-1';
      return $to_return;
  }
  function get_cat_type() {
      $to_return = 'blog';
      $cat_template = get_option('cat_template-'.get_actual_cat());
      if(strpos($cat_template, 'ortfolio') != false) $to_return = 'portfolio';
      return $to_return;
  }
?>