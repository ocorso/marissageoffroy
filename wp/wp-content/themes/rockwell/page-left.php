<?php
 /*
Template Name: Page-sidebar-left
*/ ?>
 <?php get_header(); include_homepage_data();?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
		<div id="content_wrapper">
			<div class="content" id="page-left-sidebar">

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
                            <div class="entry_holder">
                                <?php if(get_post_meta( $post->ID, 'hide_title', true) != true ){?><h1 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php } ?>
                                <div class="post_content">
                                    <?php
                                    if(!empty($post->post_excerpt)) {
                                        the_excerpt();
                                    }
                                    else
                                    {
                                        the_content(get_option('ff_translate_readmore'));
                                    }
                                    ?>
                                </div><!-- END div.post_content -->
                            </div><!--- END div.entry_holder -->
                            <div class="clear"></div>
                        </div><!-- END div.entry -->
<?php endwhile; endif; ?>

                    </div><!-- END div#post_wrapper -->
<?php

 $comment_template = 'comments-2.php';
 if ( comments_open() ) comments_template();
// require_once(get_template_dir()."/templates/comments/comments-1.php") ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Comments                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->

				</div><!-- END div#post_area -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Sidebar                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<?php require_once(get_template_dir()."/templates/sidebar/sidebar-2.php") ?>

                <div class="clear"></div>
			</div><!-- END div#content -->
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>