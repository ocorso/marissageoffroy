<?php get_header(); ?>
<?php
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
                <?php get_cat_title(); ?>
		<div id="content_wrapper">
            <?php  include "templates/".get_cat_type()."/".get_cat_template().".php"; ?>
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>