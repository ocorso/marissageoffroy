<?php
if( isset( $_SERVER['SCRIPT_URI'] ) && strpos($_SERVER['SCRIPT_URI'],'http://demo.freshface.net/file/rw/wp/') !== false )
	define('IS_FINAL', false);
else
	define('IS_FINAL', true);



add_theme_support( 'post-thumbnails' );
if(!IS_FINAL)
{
session_start();

    if( isset($_GET['template_number']) ) $_SESSION['custom_template_id'] = $_GET['template_number'];
    if( isset($_GET['template_number_single']) ) $_SESSION['custom_template_id_single'] = $_GET['template_number_single'];
}
$theme_name = 'Rockwell';
function showtime_setup()
{
    add_theme_support( 'menus' );
    register_nav_menu( 'Navigation' , 'Navigation menu' );

}

add_action( 'after_setup_theme', 'showtime_setup' );
add_filter( 'wp_get_attachment_link', 'sant_prettyadd');

function sant_prettyadd ($content) {
	$content = preg_replace("/<a/","<a rel=\"prettyPhoto[slides]\"",$content,1);
	return $content;
}
////////////////////////////////////////////////////////////////////////////////
// INCLUDES
////////////////////////////////////////////////////////////////////////////////


  if ( is_admin() )   // require only files which we need in admin
  {
    add_action('admin_menu', 'manage_admin_menu');     // hustle backend admin menu's
    include 'freshwork/freshpanel/freshpanel.php';     // theme options panel
    include 'freshwork/freshcategory/freshcategory.php';     // theme options panel
    include 'freshwork/freshslider/freshslider.php';     // theme options panel
//    include 'freshwork/content_installer/content_installer.php';     // theme options panel
    include 'freshwork/freshwritepanel/freshwritepanel.php';     // theme options panel
    include 'freshwork/freshfont/freshfont.php';     // theme options panel
  }
  else
  {
     include 'freshwork/freshpanel/freshpanel.php';
   //  include 'freshwork/freshtemplates/freshtemplates.php';     // theme options panel
     if(IS_FINAL)
        include 'functions-template-final.php';
     else
        include 'functions-template-preview.php';
  }
	
	include 'recaptcha/recaptcha.php';
    include 'freshwork/functions/freshshortcodes.php';
    include 'freshwork/functions/freshoptions.php';
    include 'freshwork/functions/freshpagination.php';
    include 'freshwork/functions/freshimage.php';
    include 'freshwork/functions/freshpost.php';
    include 'freshwork/functions/freshwidgets.php';
// $xOption = new xFreshOptions();
// global $xOption;
  function manage_admin_menu()
  {
    global $theme_name;
    // main page
     add_menu_page('Theme Options' , 'Theme Options', 'administrator', basename(__FILE__), 'freshpanel_admin');
    //add_submenu_page( basename(__FILE__), 'sss manager', 'sss manager', 'manage_options', 'category_manager', 'freshpanel_admin');
     add_submenu_page(basename(__FILE__), 'FreshPanel', 'FreshPanel', 'manage_options', 'functions.php', 'freshpanel_admin');

    add_submenu_page( basename(__FILE__), 'Category Manager', 'Category Manager', 'manage_options', 'category_manager', 'category_manager');
  //  add_submenu_page( basename(__FILE__), 'Font manager', 'Font manager', 'manage_options', 'font_manager', 'font_manager');
    add_submenu_page( basename(__FILE__), 'Slider Manager', 'Slider Manager', 'manage_options', 'slider_manager', 'slider_manager');
//     add_submenu_page( basename(__FILE__), 'Content Installer', 'Content Installer', 'manage_options', 'content_installer', 'content_installer');
    /*      add_submenu_page( basename(__FILE__), 'Pricing Table - Generator', 'FreshPrice', 'manage_options', 'pricing_table', 'pricing_table');
      add_submenu_page( basename(__FILE__), 'Take a Tour - Generator', 'FreshTour', 'manage_options', 'tour', 'tour');
    //  add_menu_page('Take a Tour - Generator', 'FreshTour', 'administrator', basename(__FILE__), 'tour');   */
  }
////////////////////////////////////////////////////////////////////////////////
// SIDEBARS
////////////////////////////////////////////////////////////////////////////////

if ( function_exists('register_sidebar') )  {
    register_sidebar(array(
        'name' => 'Home Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div><!-- END "div.widget" -->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Blog Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div><!-- END "div.widget" -->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Portfolio Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div><!-- END "div.widget" -->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div><!-- END "div.widget" -->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Gallery Page Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div><!-- END "div.widget" -->',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    $home_widget_count =fOptions::get_option('ff_home_widget_count');// get_option('ff_home_widget_count');
    for($i = 1; $i<= $home_widget_count; $i++)
    {

        register_sidebar(array(
            'name' => 'Home Widget '.$i,
            'before_widget' => '<div class="home_widget %2$s">',
            'after_widget' => '</div><!-- END "div.home_widget" -->',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }

    $footer_widget_count = get_option('ff_footer_widget_count');//3;   // how many sidebars we have? theme options
    for($i = 1; $i<= $footer_widget_count; $i++)
    {

        register_sidebar(array(
            'name' => 'Footer Widget '.$i,
            'before_widget' => '<div class="footer_widget %2$s">',
            'after_widget' => '</div><!-- END "div.home_widget" -->',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }
}

////////////////////////////////////////////////////////////////////////////////
// IMAGE FUNCTIONS
////////////////////////////////////////////////////////////////////////////////

/**
 *  RETURN ABSOLUTE DIRECTORY OF CURRENT TEMPLATE BECAUSE OF FILE INCLUDING
 **/
function get_template_dir() {
    return ABSPATH."/wp-content/themes/".get_template();
}

/**
 * RETURN TEXT THEME OPTION
 **/
function get_option_text($option_name) {
    return htmlspecialchars_decode(get_option($option_name) );
}

/**
 * RETURN LINK TO THE IMAGE RESIZED VIA TIMTHUMB
 **/
function get_resized_image($url, $width, $height, $fixed_height = true) {
    if($fixed_height == true)
        return get_bloginfo('template_url').'/scripts/timthumb.php?src='.$url.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1';
    else
        return get_bloginfo('template_url').'/scripts/timthumb.php?src='.$url.'&amp;w='.$width.'&amp;zc=1';
}
/**
 * RETURN LINK TO THE POST IMAGE
 **/
function get_post_image_all_info($post_id) {
    $featured_img = get_post_thumbnail_id( $post_id );
    if( $featured_img != '')
    {
        $attachment = get_post( $featured_img );
        $to_return['title'] = $attachment->post_title;
        $to_return['description'] = $attachment->post_content;
        $to_return['url'] = wp_get_attachment_url( $attachment->ID);
        //echo 'dick';
        return $to_return;
    }
    $attachment_args = array(
         'post_type' => 'attachment',
         'numberposts' => 1,          // one attachement image per post
         'post_status' => null,
         'post_parent' =>$post_id,
         'orderby' => 'menu_order ID'
    );
    $attachments = get_posts($attachment_args);
    $to_return = array();
    $to_return['title'] = $attachments[0]->post_title;
    $to_return['description'] = $attachments[0]->post_content;
    $to_return['url'] = wp_get_attachment_url( $attachments[0]->ID);
    //var_dump($attachments);
    return $to_return;
}
function get_post_image($post_id) {
    $attachment_args = array(
         'post_type' => 'attachment',
         'numberposts' => 1,          // one attachement image per post
         'post_status' => null,
         'post_parent' =>$post_id,
         'orderby' => 'menu_order ID'
    );
    $attachments = get_posts($attachment_args);
    return wp_get_attachment_url( $attachments[0]->ID);
}
function gets_post_gallery($post_id, $width = false, $height = false) {
    $attachment_args = array(
         'post_type' => 'attachment',
         'numberposts' => -1,          // one attachement image per post
         'post_status' => null,
         'post_parent' =>$post_id,
         'orderby' => 'menu_order ID'
    );
	
	if(!$width) $width=100;
	if(!$height) $height=100;

    $attachments = get_posts($attachment_args);
    //echo $attach
    //$to_return ='<h2>Post Gallery</h2>';


    foreach ( $attachments as $key => $att ) {
        if($key == 0) continue;
        $to_return .= '<a href="'.wp_get_attachment_url( $att->ID).'" rel="prettyPhoto[Gallery]" title="'.$att->post_title.'" class="small_image_wrapper"><img src="'. get_resized_image ( wp_get_attachment_url( $att->ID), $width, $height ).'" class="small_image" style="width:100px; height:100px;" alt="" /></a>';
    }

    echo $to_return;
}
function get_single_post_title() {
     global $post;
    if( is_single()  && get_option('cat-sin_display_display_title-'.get_actual_cat()) != 1 ) return;
    if(get_post_meta( $post->ID, 'hide_title', true) != false ) return;



    echo '<div class="post_title"><h1>';
    if ( get_option('cat-sin_display_clickable_title-'.get_actual_cat()) == 1 ){
        echo '<a href="'; the_permalink(); echo'">'; the_title(); echo '</a>';
    }
    else {
        the_title();
    }
    echo '</h1></div>';


}
function get_post_title()
{
        global $post;
    if( get_option('cat-cat_display_display_title-'.get_actual_cat()) != 1 ) return;
    if(get_post_meta( $post->ID, 'hide_title', true) != false ) return;




    echo ' <h2 class="post_title">';
    if( get_option('cat-cat_display_clickable_title-'.get_actual_cat()) == 1 ) {
       echo '<a href="'; the_permalink(); echo'">'; the_title(); echo '</a>';
    }
    else {
          the_title();
    }
    echo '</h2>';

}

function get_portfolio_title()
{
    if( get_option('cat-cat_display_display_title-'.get_actual_cat()) != 1 ) return;
    if(get_post_meta( $post->ID, 'hide_title', true) != false ) return;

    global $post;

    if( get_option('cat-cat_display_clickable_title-'.get_actual_cat()) == 1 ) {
       echo '<a class="post_title" href="'; the_permalink(); echo'">'; the_title(); echo '</a>';
    }
    else {
          the_title();
    }

}
function get_page_template_name()
{
    $page_template_path = split('/',get_page_template());
    return $page_template_path[count($page_template_path) -1];
}


function echo_post_meta_info()
{
    if( get_post_meta( $post->ID, 'hide_meta', true) != false ) return;
    global $post;

    if( get_cat_author() != 0 ) { echo '<span class="post_info_author">'.get_option('ff_blogpost_meta_written').'  '; the_author_posts_link(); echo '</span>' ; }

    if ( IS_FINAL ) {
        if(  get_cat_category() != 0 ) {  echo '<span class="post_info_categories">'.get_option('ff_blogpost_meta_postedin').' ';  the_category(','); echo '</span>'; }
    } else {
        if(  get_cat_category() != 0 && !(is_search() || is_archive() || is_author())  ) {  echo '<span class="post_info_categories">'.get_option('ff_blogpost_meta_postedin').' ';  the_category(','); echo '</span>'; }
    }

    if( has_tag() && get_cat_tags() != 0 ) {  echo '<span class="post_info_tags">'.get_option('ff_blogpost_meta_tags').':  '; the_tags('', ', ', ''); echo '</span>'; }
    if( get_cat_date() != 0 ) {  echo '<span class="post_info_date">';the_time(get_option('ff_translate_date')); echo '</span>'; }
    if( get_cat_comments() != 0 ) {  echo '<span class="post_info_comments">';comments_popup_link(get_option_text('ff_com2_no'),get_option_text('ff_com2_1'), get_option_text('ff_com2_more'), 'comment_counter'); echo '</span>'; }
}

function echo_post_meta_single_info()
{
    $post_meta_buffer = '';
    global $post;
    if( get_post_meta( $post->ID, 'hide_meta', true) != false ) return;
    ob_start();
    if( get_cat_author() != 0 ) { echo '<span class="post_info_author">'.get_option('ff_blogpost_meta_written').'  '; the_author_posts_link(); echo '</span>' ; }
    if( get_cat_category()!= 0 ) {  echo '<span class="post_info_categories">'.get_option('ff_blogpost_meta_postedin').' ';  the_category(','); echo '</span>'; }
    if( has_tag() && get_cat_tags()!= 0 ) {  echo '<span class="post_info_tags">'.get_option('ff_blogpost_meta_tags').':  '; the_tags('', ', ', ''); echo '</span>'; }
    if( get_cat_date()!= 0 ) {  echo '<span class="post_info_date">';the_time(get_option('ff_translate_date')); echo '</span>'; }
    if( get_cat_comments()!= 0 ) {  echo '<span class="post_info_comments">';comments_popup_link(get_option_text('ff_com2_no'),get_option_text('ff_com2_1'), get_option_text('ff_com2_more'), 'comment_counter'); echo '</span>'; }
    $post_meta_buffer = ob_get_clean();
    if($post_meta_buffer != '')
    {
	   echo '<h2>'.get_option('ff_translate_postinfo').'</h2>';
	   echo '<p>';
       echo $post_meta_buffer;
       echo '</p>';
    }
}

function get_cat_title() {
    global $wp_query;
    if(is_category() )
    {
      if(category_description() != '')
      {
          echo '<div class="cat_title_container">';
          echo '<div id="cat_title_wrapper"><div id="cat_title">';
        //  echo '<h2><a href="'.get_category_link( $wp_query->get('cat') ).'">'.single_cat_title("", true).'</a></h2>';
          echo '<h1><a href="'.get_category_link( $wp_query->get('cat') ).'">'; single_cat_title("", true); echo '</a></h1>';
          echo category_description();
          echo '    <div class="clear"></div>';
          echo '</div><!-- END div#cat_title --></div><!-- END div#cat_title_wrapper -->';
          echo '</div>';
      }
    }
    else if(is_search()) {
     echo '<div class="cat_title_container">';
      echo '<div id="cat_title_wrapper"><div id="cat_title">';
    //  echo '<h2><a href="'.get_category_link( $wp_query->get('cat') ).'">'.single_cat_title("", true).'</a></h2>';
      echo '<h1><a href="">'.get_option('ff_trans_search').'</a></h1>';
      echo '<p>'.$_GET['s'].'</p>';
      echo '    <div class="clear"></div>';
      echo '</div><!-- END div#cat_title --></div><!-- END div#cat_title_wrapper -->';
      echo '</div>';
    }
    else if(is_author())
    {
      global $curauth;
      echo '<div class="cat_title_container">';
      echo '<div id="cat_title_wrapper"><div id="cat_title">';
    //  echo '<h2><a href="'.get_category_link( $wp_query->get('cat') ).'">'.single_cat_title("", true).'</a></h2>';
      echo '<h1><a href="">'.get_option('ff_trans_archive').'</a></h1>';
      echo '<p>'.$curauth->user_description.'</p>';
      echo '    <div class="clear"></div>';
      echo '</div><!-- END div#cat_title --></div><!-- END div#cat_title_wrapper -->';
      echo '</div>';
    }
    else if(is_archive()) {
      echo '<div class="cat_title_container">';
      echo '<div id="cat_title_wrapper"><div id="cat_title">';
    //  echo '<h2><a href="'.get_category_link( $wp_query->get('cat') ).'">'.single_cat_title("", true).'</a></h2>';
      echo '<h1><a href="">'.get_option('ff_trans_archive').'</a></h1>';
      echo '<p>';
         if ( is_day() ) :

         printf( __( '%s', 'your-theme' ), get_the_time(get_option('date_format')) );

         elseif ( is_month() ) :

             printf( __( '%s', 'your-theme' ), get_the_time('F Y') );

          elseif ( is_year() ) :

          printf( __( '%s', 'your-theme' ), get_the_time('Y') );

         elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) :

            _e( get_option('ff_trans_archive'), 'your-theme' );
            endif;

      echo '</p>';
      echo '    <div class="clear"></div>';
      echo '</div><!-- END div#cat_title --></div><!-- END div#cat_title_wrapper -->';
      echo '</div>';
    }
}


function get_post_mainimg($post_id, $width, $height) {

    $img_all = get_post_image_all_info($post_id);
    $image_url = $img_all['url'];
    if($image_url == '') return;
    $rel =  'rel="prettyPhoto[Gallery]"';
    $image_link = $image_url;
    $resize_image = true;

    $resize_image = true;
    if( is_single() ) {

        $img_height = get_option('cat-sin_fixed_height-'.get_actual_cat());
        $img_height_post_meta = get_post_meta($post_id, 'single_image_height',true);
        if ($img_height_post_meta != 0 && $img_height_post_meta )
            $img_height = $img_height_post_meta;
        if($img_height == 0 || $img_height == '') $resize_image = false;
    }
    else {
        $img_height = get_option('cat-cat_fixed_height-'.get_actual_cat());
        $img_height_post_meta = get_post_meta($post_id, 'category_image_height',true);
        if ($img_height_post_meta != 0 && $img_height_post_meta != '' )
            $img_height = $img_height_post_meta;
        if($img_height == 0 || $img_height == '') $resize_image = false;
    }
    if($img_height == -1) $img_height = $height;
       if( ( !is_single() && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 'true' && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 1 )  ||

        (is_single() && get_option('cat-sin_display_lightbox-'.get_actual_cat()) != 'true' && get_option('cat-sin_display_lightbox-'.get_actual_cat()) != 1 ) ||
        (is_front_page() && get_option('ff_index_lightbox') == 'false')
         )

    {   $rel = '';
        $image_link = get_permalink( $post->ID );
    }

  //  if( (get_option('single_lightbox-'.get_actual_cat()) != 'false' || (!is_single() && get_option('cat-cat_display_clickable_title-'.get_actual_cat()) != 1 && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 1)) || (is_front_page() && get_option('ff_index_clickable_title') != 'false')) {
   if(  get_option('cat-cat_display_clickable_title-'.get_actual_cat()) != 0 || ( get_option('cat-cat_display_clickable_title-'.get_actual_cat()) != 1 && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 0) )  {
        echo '<a '.$rel.' href="'.$image_link.'" class="big_image_wrapper" title="'.$img_all['title'].'">';
        echo '  <img src="'.get_resized_image($image_url, $width, $img_height, $resize_image).'" alt="'.$img_all['title'].'" class="big_image" />';
        echo '</a>';
    }
    else {
   echo '<div class="big_image_wrapper"><img src="'.get_resized_image($image_url, $width, $img_height, $resize_image).'" alt="" class="big_image" /></div>';
    }

}
function main_post_image($post_id, $width, $height) {
get_post_mainimg($post_id, $width, $height);

}

function main_portfolio_image($post_id, $width, $height) {

    $img_all = get_post_image_all_info($post_id);
    $image_url = $img_all['url'];

    $rel =  'rel="prettyPhoto[Gallery]"';
    $image_link = $image_url;

   $resize_image = true;
    if( is_single() ) {

        $img_height = get_option('cat-sin_fixed_height-'.get_actual_cat());
        $img_height_post_meta = get_post_meta($post_id, 'single_image_height',true);
        if ($img_height_post_meta != 0 && $img_height_post_meta )
            $img_height = $img_height_post_meta;
        if($img_height == 0 || $img_height == '') $resize_image = false;
    }
    else {
        $img_height = get_option('cat-cat_fixed_height-'.get_actual_cat());
        $img_height_post_meta = get_post_meta($post_id, 'category_image_height',true);
        if ($img_height_post_meta != 0 && $img_height_post_meta != '' )
            $img_height = $img_height_post_meta;
        if($img_height == 0 || $img_height == '') $resize_image = false;
    }

    if($img_height != -1)
    {
        if($img_height != 0 && $img_height != '') { $height = $img_height; $resize_image = true; }
        else $resize_image = false;
    }

       if( ( !is_single() && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 'true' && get_option('cat-cat_display_lightbox-'.get_actual_cat()) != 1 )  ||
        (is_front_page() && get_option('ff_index_lightbox') == 'false') ||
        (is_single() && get_option('cat-sin_display_lightbox-'.get_actual_cat()) != 'true' && get_option('cat-sin_display_lightbox-'.get_actual_cat()) != 1 )  )

    {     $rel = '';
        $image_link = get_permalink( $post->ID );
    }
    if(get_option('cat-cat_display_clickable_title-'.get_actual_cat()) == 'true' || get_option('cat-cat_display_clickable_title-'.get_actual_cat()) == 1) {
        echo '<a '.$rel.' href="'.$image_link.'" class="big_image_wrapper"  title="'.$img_all['title'].'">';
        echo '  <img src="'.get_resized_image($image_url, $width, $height, $resize_image).'" alt="'.$img_all['title'].'" class="big_image" />';
        echo '</a>';
    }
    else {
        echo '<div class="big_image_wrapper"><img src="'.get_resized_image($image_url, $width, $height, $resize_image).'" alt="" class="big_image" /></div>';
    }
}

function get_actual_cat_from_query($query) {
	if($query->query_vars['cat'] != '') return $query->query_vars['cat'];
	else {
		$category = get_category_by_slug($query->get('category_name'));
		return $category->term_id;
	}
	
}

$is_main_loop = true;


function change_posts_per_page( $query ) {
    global $is_main_loop;
    if( !$is_main_loop ) return;
    $is_main_loop = false;

    if ( $query->is_home ) {
           $post_per_page = get_option('cat-cat_ppp-index');
           $categories = get_option('cat-cat_cat_exclude-index');
           $order_by = get_option('cat-cat_order_by-index');
           $order = get_option('cat-cat_order-index');
           
           if( $categories != ' ' || $categories != '0' )
                $query->set('cat', $categories);

           $query->set('posts_per_page',$post_per_page);
           
           if($order_by != 'default' || $oder_by != '')
                $query->set('orderby',$order_by);
                
           if($order != 'default' || $order != '')
               $query->set('order',$order);

    }
    else if ( $query->is_category )
    {
        $cat_id = get_actual_cat_from_query($query);            
            
        $post_per_page = get_option('cat-cat_ppp-'.$cat_id);


        $order_by = get_option('cat-cat_order_by-'.$cat_id);
        $order = get_option('cat-cat_order-'.$cat_id);
        
        
        if($order_by != 'default' || $oder_by != '')
                $query->set('orderby',$order_by);

         if($order != 'default' || $order != '')
             $query->set('order',$order);
        
        $query->set('posts_per_page',$post_per_page);
    }
    else if ( $query->is_search )
    {
           $post_per_page = get_option('cat-cat_ppp-search');
           $query->set('posts_per_page',$post_per_page);
           
           $order_by = get_option('cat-cat_order_by-search');
           $order = get_option('cat-cat_order-search');
           
           if($order_by != 'default' || $oder_by != '')
                $query->set('orderby',$order_by);

           if($order != 'default' || $order != '')
               $query->set('order',$order);
    }
    else if ( $query->is_author )
    {
           $post_per_page = get_option('cat-cat_ppp-author');
           $query->set('posts_per_page',$post_per_page);
           
           $order_by = get_option('cat-cat_order_by-author');
           $order = get_option('cat-cat_order-author');

           if($order_by != 'default' || $oder_by != '')
                $query->set('orderby',$order_by);

           if($order != 'default' || $order != '')
               $query->set('order',$order);
    }
    else if ( $query->is_archive )
    {
           $post_per_page = get_option('cat-cat_ppp-archive');
           $query->set('posts_per_page',$post_per_page);
           
           
           $order_by = get_option('cat-cat_order_by-archive');
           $order = get_option('cat-cat_order-archive');

           if($order_by != 'default' || $oder_by != '')
                $query->set('orderby',$order_by);

           if($order != 'default' || $order != '')
               $query->set('order',$order);
    }
}
add_filter( 'pre_get_posts', 'change_posts_per_page' );

function influence_pagination() {
   /* $post_per_page = get_option('cat-cat_ppp-'.get_actual_cat());
    if( $post_per_page == 0 || $post_per_page == "")
   // echo '$post_per_page'.$post_per_page;
    if($post_per_page == '' || $post_per_page <= 0) return;
      global $wp_query;
      $args = array_merge( $wp_query->query, array( 'posts_per_page' => $post_per_page ) );
      query_posts( $args );         */
}
////////////////////////////////////////////////////////////////////////////////
// CATEGORY FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
$templates = array(
    'index' => array('cat_template' => 'home-1',
                     'cat_template_type' => 'home')
);
function get_index_cat_template() {
    return get_option('ff_template_home_php');
   /* global $templates;
    return $templates['index']['cat_template'];   */
}
function get_index_cat_css() {
    return get_option('ff_template_home_css');
}
function get_index_cat_type() {
    global $templates;
    return $templates['index']['cat_template_type'];
}
function get_actual_cat() {
    if( is_single() )
    {
        $category = get_the_category();
        return $category[0]->cat_ID;
    }
    else if( is_front_page() ) return 'index';
    else if( is_search() )     return 'search';
    else if( !is_category() && is_author() ) return 'author';
    else if( !is_category() && is_archive() ) return 'archive';

    else
    {
        global $wp_query;
        return $wp_query->get('cat');
    }

}

   // 'cat-'.$key.'-'.$cat
function get_cat_author(){
    if( is_single() )
        return get_option('cat-sin_display_author-'.get_actual_cat());
    else
        return get_option('cat-cat_display_author-'.get_actual_cat());
}
function get_cat_date(){
    if( is_single() )
        return get_option('cat-sin_display_date-'.get_actual_cat());
    else
        return get_option('cat-cat_display_date-'.get_actual_cat());
}
function get_cat_category(){
    if( is_single() )
        return get_option('cat-sin_display_category-'.get_actual_cat());
    else
        return get_option('cat-cat_display_category-'.get_actual_cat());
}
function get_cat_tags(){
    if( is_single() )
        return get_option('cat-sin_display_tags-'.get_actual_cat());
    else
        return get_option('cat-cat_display_tags-'.get_actual_cat());
}
function get_cat_comments(){
    if( is_single() )
        return get_option('cat-sin_display_comments-'.get_actual_cat());
    else
        return get_option('cat-cat_display_comments-'.get_actual_cat());
}


function get_single_cat_type(){

    return 'blog';
}

add_action('the_content','remove_sharp_in_more_link');
function remove_sharp_in_more_link($content)
{
    return ereg_replace('#more-[0-9]+',' ',$content);
}
////////////////////////////////////////////////////////////////////////////////
// PAGINATION FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function fresh_pagination() {
  /*  global $wp_query, $paged;
    $range = 10;
    if( $paged == '' ) $paged = 1;

    $smallest_page = $paged - $range;
    $highest_page = $paged + $range;

    if( $paged == 1 ) $actual_page_first = 'style="color:red;"';
    else if( $paged == $wp_query->max_num_pages ) $actual_page_last = 'style="color:red;"';

    if( $smallest_page <= 1 ) $smallest_page = 2;
    if( $highest_page >= $wp_query->max_num_pages ) $highest_page = $wp_query->max_num_pages - 1;

    if ( $wp_query->max_num_pages != 1 ) {
        // first page
        echo '<a '.$actual_page_first.' href="'.get_pagenum_link(1).'">1</a>&nbsp&nbsp';

        if( $wp_query->max_num_pages > 2) {
            for( $i = $smallest_page; $i <= $highest_page; $i ++ ) {
                 if( $i == $paged ) $actual_page = 'style="color:red"';
                 else $actual_page = '';
                 echo '<a '.$actual_page.' href="'.get_pagenum_link($i).'">'.$i.'</a>&nbsp&nbsp';
            }
        }
        // last page
        echo '<a '.$actual_page_last.' href="'.get_pagenum_link($wp_query->max_num_pages).'">'.$wp_query->max_num_pages.'</a>&nbsp&nbsp';
    }       */
}
////////////////////////////////////////////////////////////////////////////////
// THEME OPTIONS FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function ff_option( $option_name ) {
    echo get_option( 'ff_'.$option_name );
}
function ff_text_option( $option_name ) {
    echo htmlspecialchars_decode( stripslashes( get_option( 'ff_'.$option_name ) ) );
}
////////////////////////////////////////////////////////////////////////////////
// COMMENTS
////////////////////////////////////////////////////////////////////////////////
function rockwell_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  $GLOBALS['comment_depth'] = $depth;
?>
							<li id="comment-<?php comment_ID() ?>">
                                <div class="comment_wrapper">
                                    <div class="user_wrapper">
                                        <?php echo get_avatar( $comment,  40); ?>
                                        <p class="comment_user_meta">
                                          <span class="comment_author"><?php echo comment_author_link() ?></span>
                                          <span class="comment_date"><?php echo comment_date(); ?></span>
                                        </p>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="comment_content">

                                        <?php comment_text(); ?>

										<?php
										if($args['type'] == 'all' || get_comment_type() == 'comment') :

										comment_reply_link(array_merge($args, array(

										'reply_text' => __('Respond','your-theme'),

										'login_text' => __('Log in to reply.','your-theme'),

										'depth' => $depth,

										'before' => '',

										'after' => ''

										)));

										endif;
										if ($comment->comment_approved == '0') {
                                            echo '<p class="comment_approval">'.get_option('ff_com2_approval').'</p>';
                                        }
										?>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
<?php

}

add_action('comment_text','remove_p_in_comment_text');



// our steve-o-magic function, parameter $content is the content of your post/page

function remove_p_in_comment_text($content)

{
    return $content;
    // here we use regular expression to remove the more ID

    // the [0-9] means every number, and the + means 1 or more numbers in a row ("5" or "55" or "5555")
   // return 'd';

}


class sub_nav_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
	//	var_dump($item);
        //if(get_header_template() == 'header-1' && $depth > 0) return;
       // $output = get_header_template().'xxx';
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .' >';

	//	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		if($depth==0)
		  $item_output .= $args->link_before . '<span class="top-menu-item">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
		else
		  $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if($item->attr_title) $item_output .= '<span class="menu-description">'. esc_attr ($item->attr_title) .'</span>';
        $item_output .= '</a>';


		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class sub_nav_walker2 extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
	//	var_dump($item);
        //if(get_header_template() == 'header-1' && $depth > 0) return;
       // $output = get_header_template().'xxx';
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .' >';

	//	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		if($depth==0)
		  $item_output .= $args->link_before . '<span class="top-menu-item">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
		else
		  $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        $item_output .= '</a>';


		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
function get_post_content()
{
    global $post;
  if(!empty($post->post_excerpt)) {
      the_excerpt();
       echo '<a class="more-link" href="'.get_permalink().'">'.get_option('ff_translate_readmore').'</a>';
  }
  else
  {
      the_content('', FALSE,'' );
      if ( strpos($post->post_content, '<!--more-->') != false )

      echo '<a class="more-link" href="'.get_permalink().'">'.get_option('ff_translate_readmore').'</a>';
  }

}
add_filter('widget_text', 'do_shortcode');


function include_homepage_data() {
if( !is_front_page() ) return false;
?>
<?php if( get_option('ff_slider2_show') != 'false') require_once(get_template_dir()."/slider.php"); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Message                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php if(get_option('ff_message_enable') == 'true' ) require_once(get_template_dir()."/templates/home/message-1.php") ?>

<?php if(get_option('ff_home_widget_enable') == 'true' ) require_once(get_template_dir()."/templates/home/home-1.php"); ?>
<?php
}
?>
