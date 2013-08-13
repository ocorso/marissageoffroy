 <?php get_header(); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
		<div id="content_wrapper">
			<div class="content" id="page-fullwidth">

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post                                                  // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="post_area">
                    <div id="post_wrapper">
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Entry                                                 // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
                        <div class="entry"  id="post-<?php the_ID();?>">
                            <div class="entry_holder">
                                <h1 class="post_title"><a href=""><?php echo get_option('ff_404_title'); ?></a></h1>
                                <div class="post_content">
                                    <?php
                                    echo get_option('ff_404_content');
                                    ?>
                                </div><!-- END div.post_content -->
                            </div><!-- END div.entry_holder -->
                            <div class="clear"></div>
                        </div><!-- END div.entry -->

                    </div><!-- END div#post_wrapper -->
				</div><!-- END div#post_area -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Sidebar                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->


                <div class="clear"></div>
			</div><!-- END div#content -->
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>