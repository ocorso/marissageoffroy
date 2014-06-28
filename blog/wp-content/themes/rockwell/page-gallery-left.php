<?php
 /*
Template Name: Page-gallery-left
*/ ?>
 <?php get_header(); ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
		<div id="content_wrapper">
			<div class="content" id="page-gallery-left">

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
                    <div id="gallery">
                      <?php
                      $attachment_args = array(
                           'post_type' => 'attachment',
                           'numberposts' => -1,          // one attachement image per post
                           'post_status' => null,
                           'post_parent' =>$post->ID,
                           'orderby' => 'menu_order ID'
                      );
                      $attachments = get_posts($attachment_args);
                      if ($attachments) {
                        $row = 1;
                        
                        foreach($attachments as $key=> $gall_image )
                        {
                          if($row == 1) echo '<div class="row">';

                          $att_img =  wp_get_attachment_url( $gall_image->ID);
                          echo '<a title="'.$gall_image->post_title.'" rel="prettyPhoto[Gallery]" href="'.$att_img.'" class="gallery_image_wrapper">';
                          echo  '<img src="'.get_bloginfo('template_url').'/scripts/timthumb.php?src='.$att_img.'&amp;w=100&amp;h=100&amp;zc=1" class="gallery_image" alt=""/>';
                          echo '</a>';
                          if($row == 6 || $key == (count($attachments)-1) ) {
                            echo '<div class="clear"></div></div>';
                            $row = 0;
                          }
                          $row++;
                        }
                      }
                        ?>


                    </div><!-- END div#gallery -->
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