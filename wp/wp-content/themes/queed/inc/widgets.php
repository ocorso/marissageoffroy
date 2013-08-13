<?php

get_template_part('/inc/theme_widgets/pirenko-social-links/social');
get_template_part('/inc/theme_widgets/pirenko-vcard/vcard');
get_template_part('/inc/theme_widgets/pirenko-twitter/pirenko-twitter');
get_template_part('/inc/theme_widgets/pirenko-advertising/pirenko-ads');
get_template_part('/inc/theme_widgets/pirenko-tags/tags');
get_template_part('/inc/theme_widgets/pirenko-tags_portfolio/tags');
get_template_part('/inc/theme_widgets/pirenko-video/pirenko-video');
get_template_part('/inc/theme_widgets/decent-comments/decent-comments');
get_template_part('/inc/plugins/ambrosite/ambrosite');


function queed_widgets_init() {
  // Register widgetized areas
  register_sidebar(array(
    'name' => __('Top Sidebar', 'queed'),
    'id' => 'sidebar-top',
    'before_widget' => '<section id="%1$s" class="widget %2$s left_floated span35"><div class="widget-inner-top">',
    'after_widget' => '</div></section>',
    'before_title' => '<div class="widget-footer-title sidebar_bubble">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Primary Sidebar', 'queed'),
    'id' => 'sidebar-primary',
    'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h4>',
    'after_title' => '</h4><div <div class="simple_line_sidebar"></div><div class="inner_line_sidebar_block"></div>',
  ));
  register_sidebar(array(
    'name' => __('Footer', 'queed'),
    'id' => 'sidebar-footer',
    'before_widget' => '<section id="%1$s" class="widget %2$s left_floated span35"><div class="widget-inner-footer">',
    'after_widget' => '</div></section>',
    'before_title' => '<div class="widget-footer-title sidebar_bubble">',
    'after_title' => '</div>',
  ));

  
}
add_action('widgets_init', 'queed_widgets_init');
?>