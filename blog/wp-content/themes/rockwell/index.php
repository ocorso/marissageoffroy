<?php get_header();  ?>

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Slider                                                // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php if( get_option('ff_slider2_show') != 'false') require_once(get_template_dir()."/slider.php"); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Message                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php if(get_option('ff_message_enable') == 'true' ) require_once(get_template_dir()."/templates/home/message-1.php") ?>

<?php if(get_option('ff_home_widget_enable') == 'true' ) require_once(get_template_dir()."/templates/home/home-1.php"); ?>
<?php if(get_option('ff_home_blog_enable') == 'true' ) { ?>
	<div id="content_container">
		<div id="content_wrapper">
            <?php include "templates/".get_cat_type()."/".get_cat_template().".php"; ?>
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php } ?>
	
<?php get_footer(); ?>