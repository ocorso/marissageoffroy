<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php if(is_singular())        wp_enqueue_script( 'comment-reply' );?>
    <?php wp_enqueue_script("jquery");  // JQUERY including by wordpress ?>
    <?php wp_head(); ?>

<?php
    /***************************************************************************
     * HEADER PART
     **************************************************************************/
?>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/header/<?php echo get_header_template(); ?>.css' type='text/css'/>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<?php
    /***************************************************************************
     * INCLUDE COMMON CSS FILES
     **************************************************************************/
?>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/js/prettyphoto/css/prettyPhoto.css' type='text/css'/>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/global.css' type='text/css'/>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/style.css' type='text/css'/>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/sidebar/sidebars.css' type='text/css'/>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/comments/comments.css' type='text/css'/>

    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/templates/header/<?php echo get_header_template(); ?>.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/prettyphoto/js/jquery.prettyPhoto.js"></script>

<?php
    /***************************************************************************
     * SKIN PART
     **************************************************************************/
     $template_skin = get_option('ff_template_skin');
     if( isset($_COOKIE['skin_changer_default']) )$template_skin = $_COOKIE['skin_changer_default'];
     echo "<link rel='stylesheet' id='changeable_stylesheet' href='".get_bloginfo('template_url')."/skins/".$template_skin."/".$template_skin.".css' type='text/css'/>";
?>
 <!--   <link rel='stylesheet' id="changeable_stylesheet" href='<?php echo get_bloginfo('template_url'); ?>/skins/<?php echo get_option('ff_template_skin').'/'.get_option('ff_template_skin'); ?>.css' type='text/css'/> -->

<?php
    /***************************************************************************
     * CONTENT PART
     **************************************************************************/
     require 'font-selector.php';
?>
<?php if(( get_option('ff_header_sub_menu_width') != 100 && get_option('ff_header_sub_menu_width') != '') || ( get_option('ff_header_top_menu_width') != 100 && get_option('ff_header_top_menu_width') != '')) {?>

<style type="text/css">
#header-1 #navigation li a {width: <?php echo get_option('ff_header_top_menu_width'); ?>px !important;}
#header-1 #navigation ul li ul li a {width: <?php echo get_option('ff_header_sub_menu_width'); ?>px !important;}

#header-2 #navigation ul li li a {width: <?php echo get_option('ff_header_sub_menu_width'); ?>px !important;}
#header-2 #navigation ul li li ul li a {width: <?php echo get_option('ff_header_sub_menu_width'); ?>px !important;}
#header-1 #navigation ul li ul li .sub-menu, #header-2 #navigation ul li ul li .sub-menu  {margin-left:  <?php echo (get_option('ff_header_sub_menu_width') + 20); ?>px !important; }
.sub-menu .has-sub-menu	{ background-position: <?php echo (get_option('ff_header_sub_menu_width') + 6); ?>px 17px !important;}
.sub-menu .has-sub-menu:hover	{ background-position: <?php echo (get_option('ff_header_sub_menu_width') + 6); ?>px -83px !important;}


</style><?php } ?>

<?php if(is_front_page()) { ?>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/home/home-1.css' type='text/css'/>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/home/message-1.css' type='text/css'/>
<link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/<?php echo get_cat_type(); ?>/<?php echo get_cat_template(); ?>.css' type='text/css'/>
<?php if( get_option('ff_slider2_show') != 'false') { ?>    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/slider/<?php echo get_slider_type();?>.css' type='text/css'/><?php } ?>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.easing.js"></script>
    <script type="text/javascript">
        var show_slider2_grid = '<?php echo get_slider_grid();?>';
        var show_slider_title = '<?php echo get_slider_title();?>';
        var slider_autoslide = '<?php echo get_option('ff_slider_autoslide')?>';
    </script>
<?php if( get_option('ff_slider2_show') != 'false') { ?>    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/templates/slider/<?php echo get_slider_type(); ?>.js"></script><?php } ?>
<?php }
     else if(is_category() || is_search() || is_archive() || is_author() ) { ?>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/<?php echo get_cat_type(); ?>/<?php echo get_cat_template(); ?>.css' type='text/css'/>
<?php }
     else if(is_single()) {
?>
    <link rel='stylesheet' href='<?php echo get_bloginfo('template_url'); ?>/templates/<?php echo get_single_cat_type(); ?>/<?php echo get_cat_single_template(); ?>.css' type='text/css'/>
<?php } ?>

    <script type="text/javascript">
        jQuery(document).ready(function($){
        $('a[rel^="prettyPhoto"]').prettyPhoto({theme: '<?php echo get_option('ff_template_lightbox')?>',slideshow:5000, autoplay_slideshow:false, overlay_gallery:false});
        $('.size-thumbnail, .size-medium, .size-large, .size-full').parent().prettyPhoto({theme: '<?php echo get_option('ff_template_lightbox')?>', autoplay_slideshow:false, overlay_gallery:false});
        });
    </script>

    <title><?php if(is_home()) { echo bloginfo('name'); echo ' | '; echo bloginfo('description'); } else { echo wp_title(' | ', false, right); echo bloginfo('name'); } ?></title>



    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/main.js"></script>

<?php
    if( get_option('ff_css') != '' ) {
        echo '<style type="text/css">'.stripslashes(get_option('ff_css')).'</style>';
    }
    if( get_option('ff_tracking') != '' ) {
        echo stripslashes(get_option('ff_tracking'));
    }
?>
    </head>
<body class="<?php echo get_stencil(); ?>">
<?php include "templates/header/".get_header_template().".php"; ?>