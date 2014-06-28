<?php

get_template_part('/inc/theme_widgets/pirenko-social-links/social');
get_template_part('/inc/theme_widgets/pirenko-vcard/vcard');
get_template_part('/inc/theme_widgets/pirenko-twitter/pirenko-twitter');
get_template_part('/inc/theme_widgets/pirenko-advertising/pirenko-ads');
get_template_part('/inc/theme_widgets/pirenko-video/pirenko-video');
get_template_part('/inc/theme_widgets/decent-comments/decent-comments');
get_template_part('/inc/plugins/ambrosite/ambrosite');


function pixia_widgets_init() {
  // Register widgetized areas
  register_sidebar(array(
    'name' => __('Under Menu Sidebar', 'pixia'),
    'id' => 'sidebar-underm',
    'before_widget' => '<section id="%1$s" class="widget %2$s right_floated"><div class="widget-inner-top">',
    'after_widget' => '</div></section>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Footer', 'pixia'),
    'id' => 'sidebar-footer',
    'before_widget' => '<section id="%1$s" class="widget %2$s left_floated"><div class="widget-inner-footer">',
    'after_widget' => '</div></section><div class="cf"></div><div class="simple_line_onbg hide_much_later" style="margin-top:14px;margin-bottom:2px;"></div>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Bottom Sidebar', 'pixia'),
    'id' => 'sidebar-bottom',
    'before_widget' => '<section id="%1$s" class="widget %2$s columns three"><div class="widget-inner-footer">',
    'after_widget' => '</div></section>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '<div class="inner_line_sidebar_block"></div></div>',
  ));

  
}
add_action('widgets_init', 'pixia_widgets_init');
?>