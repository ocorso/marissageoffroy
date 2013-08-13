<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_body_color=alter_brightness($pixia_frontend_options['body_color'],40);
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    <?php pirenko_main_before(); ?>
      <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_25" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
      	<ul id="blog_entries">
      	<?php 
			$ins=0;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$posts_per_page = get_query_var('posts_per_page');
			$post_counter=($paged-1)*$posts_per_page;
        	while (have_posts()) : the_post(); 
				$count_posts=wp_count_posts();
				$total_pages = ceil( $count_posts->publish / $posts_per_page );
				$post_counter++;
				?>
            	<li id="post-<?php the_ID(); ?>" class="blog_entry_li cf<?php if ($post_counter == $my_query->post_count) echo " last_li"; ?>" data-type="<?php $category= get_the_category();
							foreach($category as $test) 
							{ 
								echo $test->slug;echo " ";
							}  ?>" data-id="id-<?php echo $post_counter; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$image[0] = get_image_path($image[0]);
								$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								
							else :
								//THERE'S NO FEATURED IMAGE
							endif; 
							$data = get_post_meta( $post->ID, 'key', true );
							?>
								<div class="blog_content twelve columns">
                                <div class="colored_bg boxed_shadow">
								<?php 
								if (has_post_thumbnail( $post->ID ) )
								{
									?>
                                    <a href="<?php the_permalink() ?>">
                                        <div class="blog_top_image ">
                                        	<div class="blog_fader_grid">
                                            </div>
                                            <?php 
												if (!isset($pixia_frontend_options['forcesize_news']))
													$pixia_frontend_options['forcesize_news']='yes';
												$height_force=0;
												if ($pixia_frontend_options['forcesize_news']=='yes')
													$height_force=200;
												if ($pixia_frontend_options['blog_bw']=="no")
												{
													
													$vt_image = vt_resize( '', $image[0] , 585, $height_force, true );
                                            		?>
													<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image boxed_shadow" alt="" />
                                                    <?php
												}
												else
												{
													?>
                                            		<img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=585&f=2<?php if ($pixia_frontend_options['forcesize_news']=='yes'){echo "&h=" . $height_force;} ?>" class="custom-img grid_image boxed_shadow<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
                                            		<?php
												}
											?>
                                        </div>
                                    </a>
                                <?php
								}
								else
								{
									?>
                                    <div class="blog_top_image" style="margin-bottom:28px;">&nbsp;</div>
                                    <?php	
								}
								?>
                                 <div class="entry_title entry_title_single padded_text unpadded_low">
									<h3>
                                    	<header_font>
                                    		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    	</header_font>
                                    </h3>
                               	</div>
                                <div class="on_colored padded_text entry_content unpadded_low">
								  <?php 
                                      the_excerpt_dynamic(240);
                                  ?>
                                </div>
                                <div class="simple_line"></div>
                                          
                        <div class="blog_meta blog_meta_single padded_text">
                            <span class="left_floated"><?php echo get_the_date('j'); ?>&nbsp;</span>
                            <span class="left_floated"><?php echo get_the_date('F'); ?></span>
							<?php 
                                if ($pixia_frontend_options['postedby_news']=="yes")
                                {
                                    ?>
                                        <span class="left_floated">
                                        	&nbsp;<?php _e($pixia_frontend_options['posted_by_text'], 'pixia'); 
											echo " ".get_the_author();?>
                                     	</span>
                                    <?php
                                }
                            ?>
                            <span class="pir_divider left_floated hide_much_later"></span>
                            <div class="clearfix show_much_later"></div>
                            <?php 
								if ($pixia_frontend_options['categoriesby_news']=="yes")
								{
									?>
                                    	<span class="left_floated">
										<?php the_category(', '); //CATS WITH LINKS ?>
                                        </span>
                                        <span class="pir_divider left_floated hide_later"></span>
                         				<div class="clearfix show_later"></div>
									<?php
								}
							?>
                            <?php
                                if ( comments_open() ) :
                                    ?>
                                    <span class="left_floated">
                                                    <?php 
														comments_popup_link( __($pixia_frontend_options['comments_no_response'], 'pixia'), __($pixia_frontend_options['comments_one_response'], 'pixia'), '% '.__($pixia_frontend_options['comments_oneplus_response'], 'pixia'), 'comments-link', 'Comments are off for this post');
                                                    ?>
                                                    </span>
                                           	<span class="pir_divider left_floated hide_later"></span>
                         					<div class="clearfix show_later"></div>
                                    <?php
                                endif;
								
                            ?>
                            <div class="left_floated" style="margin-left:-3px;">
                            <?php echo getblogLikeLink(get_the_ID());
								
							?>
                            	</div>
                            <?php 
								 if (is_big_excerpt(240))
												{
													?>
                                                       <div class="right_floated">
                                                            <a class="read_more_blog"href="<?php the_permalink() ?>"><?php _e($pixia_frontend_options['read_more'], 'pixia'); ?>
                                                            <div class="tr_wrapper" style="margin-top:-37px;z-index:0;right:32px;">
                                                                <div class="submenu_arrow_r pirenko_tinted">
                                                                    <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/arrows.png" />
                                                                </div>
                                                            </div>
                                                            </a>
                                                            
                                                            </div>
                                                       
                                                    
                                                    <?php
												}
							?>
                            	
                        </div>
                                            <div class="clearfix"></div>
                                            
                                      </div>
                                </div>
							
						</li>
						<?php $ins++;
			endwhile; /* End loop */ ?>
            </ul>
            <?php
				//SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
				if ($paged!=$total_pages)
				{
					?>
					<div id="entries_navigation" style="float:none;">
						<div class="navigation columns twelve">	
							<div class="next-posts">
								<div id="nbr_helper" pir_curr="<?php echo $paged; ?>" pir_max="<?php echo $total_pages; ?>">
                                <h4><div id="pir_loader_wrapper" class="cf">
							<img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="pir_loader">
							
							</div>
										<?php next_posts_link('',$total_pages); ?>
										
									</h4>
								</div>
							</div>
							<div id="no_more" class="content_block boxed_shadow special_italic"></div>
							<div class="clearfix show_later"></div>
						</div><!-- navigation -->
					</div><!-- entries_navigation --> 
					<?php
				}
			?>
      </div><!-- /#main -->
    <?php pirenko_main_after(); ?>
    </div><!-- /#content -->
<?php get_footer(); ?>