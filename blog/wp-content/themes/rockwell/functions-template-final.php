<?php
  function get_logo()
  {
      if(get_option('ff_header_logo') == '')
      {
          $template_skin = get_option('ff_template_skin');
          return get_bloginfo('template_url')."/skins/".$template_skin."/gfx/logo.png";
      }
      else
          return get_option('ff_header_logo');
  }
 function get_header_template(){
    return get_option('ff_template_header');
 }
 function get_slider_type(){
    return get_option('ff_template_slider_type');
 }
 function get_slider_grid(){
    return get_option('ff_slider2_grid');
 }
 function get_slider_title(){
    return get_option('ff_slider2_title');
 }
  function get_slider_infobox(){
    return get_option('ff_slider2_infobox');
 }
 function get_stencil(){
     $template_skin = get_option('ff_template_skin');
     $template_stencil = get_option('ff_stencil_'.$template_skin);
     $stencil_fixed = '';
     if(get_option('ff_stencil_fixed') == 'true' ) $stencil_fixed = ' stencil_fixed';
     $slider_type = ' option-'.get_slider_type();
     return 'stencil_'.$template_stencil.$stencil_fixed.$slider_type;
 }
  function get_cat_single_template() {
      global $post;
      $post_meta_single = get_post_meta( $post->ID, 'single_template_custom', true);
      if($post_meta_single) return $post_meta_single;
      $to_return = get_option('cat_single_template-'.get_actual_cat());
      if($to_return == '') $to_return = 'blog-single-1';
      return $to_return;
  }
  function get_cat_template() {

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