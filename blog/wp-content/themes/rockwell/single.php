<?php get_header(); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
		<div id="content_wrapper">
            <?php include "templates/".get_single_cat_type()."/".get_cat_single_template().".php"; ?>
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>