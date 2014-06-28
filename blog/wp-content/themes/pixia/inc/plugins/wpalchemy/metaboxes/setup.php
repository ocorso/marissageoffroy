<?php


include_once (TEMPLATEPATH . '/inc/plugins/wpalchemy/MetaBox.php');
 
// global styles for the meta boxes
//if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/includes/plugins/wpalchemy/metaboxes/meta.css');
add_action( 'init', 'my_metabox_styles' );

function my_metabox_styles()
{
    if ( is_admin() ) 
    { 
        wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/inc/plugins/wpalchemy/metaboxes/meta.css' );
    }
}
/* eof */