			<div class="content blog" id="blog-cat-24">

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post                                                  // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="post_area">
                    <div id="post_wrapper">
<?php if (  $wp_query->have_posts()) : while (have_posts()) : the_post();  ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Entry                                                 // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
                        <div class="entry"  id="post-<?php the_ID();?>">
                            <?php get_post_title(); ?>
                            <div class="post_info">
	                        	<p>
	                                <?php echo_post_meta_info(); ?>
	                            </p>
                            </div><!-- END div.post_info -->
                            <div class="entry_holder">
                                <div class="post_content">
                            <?php get_post_content(); ?>
                                </div><!-- END div.post_content -->
                            </div><!-- END div.entry_holder -->
                            <?php main_post_image($post->ID, 700, 360); ?>
                            <div class="clear"></div>
                        </div><!-- END div.entry -->
						<?php endwhile; endif; fPagination::Render(); ?>

                    </div><!-- END div#post_wrapper -->

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Comments                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->

				</div><!-- END div#post_area -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Sidebar                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->


                <div class="clear"></div>
			</div><!-- END div#content -->