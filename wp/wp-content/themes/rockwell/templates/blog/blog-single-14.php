<?php the_post(); ?>
			<div class="content" id="blog-single-14">
                <?php get_post_mainimg($post->ID, 940, 470); ?>

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post                                                  // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
                <?php get_single_post_title(); ?>
				<div id="post_area">
                    <div id="post_wrapper">

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post Content                                          // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
                        <div class="post_content">
                            <?php the_content(); ?>
                        </div><!-- END div.post_content -->

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post Meta                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
                        <div class="post_meta">
                            <div class="post_gallery">
                                <?php get_post_gallery($post->ID); ?>
                                <div class="clear"></div>
                            </div>
                            <div class="post_info_single">
                                <?php echo_post_meta_single_info(); ?>
                            </div><!-- END div.post_info_single -->
                        </div><!-- END div.post_meta -->
                        <div class="clear"></div>
                    </div><!-- END div#post_wrapper -->

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Comments                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php
 $comment_template = 'comments-1.php';
 if ( comments_open() && get_option('cat-sin_display_comments_article-'.get_actual_cat()) == 1 ) comments_template();
// require_once(get_template_dir()."/templates/comments/comments-1.php") ?>

				</div><!-- END div#post_area -->

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Sidebar                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php require_once(get_template_dir()."/templates/sidebar/sidebar-1.php") ?>

                <div class="clear"></div>
</div><!-- END div#content -->