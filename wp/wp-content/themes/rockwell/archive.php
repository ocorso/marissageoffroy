<?php
/*
Template Name: Archives
*/?>
<?php get_header(); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
                <?php get_cat_title(); ?>
		<div id="content_wrapper">
            <?php include "templates/".get_cat_type()."/".get_cat_template().".php"; ?>
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>