<?php get_header(); ?>
	<div class="page-header">
		<h1><?php _e('Latest Posts', 'queed');?></h1>
	</div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php 
		queed_main_before();
	?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      	<ul class="blog_entries">
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
            	<li id="post-<?php the_ID(); ?>" class="blog_entry_li cf <?php if ($post_counter == $count_posts->publish){ echo "last_li";} ?>">
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
								
								<div class="top_blog_single">
                        <div class="blog_date">
                            	<time class="updated">
                                	<span class="day"><?php echo get_the_date('j'); ?></span>
                                	<span class="month"><?php echo get_the_date('M'); ?></span>
                                </time>
                            </div>
                            <div class="entry_icon">
                                <div class="blog_icon blog_icon_default" style="background-position:<?php echo $data['bl_icon']; ?>px 4px !important;">   
                                </div>
                            </div>
                       	</div>
                        <div class="blog_meta blog_meta_single">
							<?php 
                                if ($queed_frontend_options['postedby_news']=="yes")
                                {
                                    ?>
                                    <p>
                                        <span class="special_italic"><?php _e($queed_frontend_options['posted_by_text'], 'queed'); ?></span>
                                        <?php echo get_the_author(); ?>
                                    </p>
                                    <?php
                                }
                            ?>
                            <?php 
								if ($queed_frontend_options['categoriesby_news']=="yes")
								{
									?>
									<p>
										<span class="special_italic"><?php _e('Categories', 'queed'); ?></span>
										<?php the_category(', '); //CATS WITH LINKS ?>
									</p>
									<?php
								}
							?>
                            <?php
                                $tags = get_the_tags();
                                if ($tags) 
                                {
                                    ?>
                                    <p class="">
                                        <span class="special_italic"><?php _e('Tags', 'queed'); ?></span>
                                        <?php the_tags(''); ?>
                                    </p>
                                    <?php
                                }
                                if ( comments_open() ) :
                                    ?>
                                    <p class="">
                                        <span class="special_italic"><?php _e('Comments', 'queed'); ?></span>
                                        
                                            
                                                <a href="<?php comments_link(); ?>">
                                                    <?php 
														comments_popup_link( __($queed_frontend_options['comments_no_response'], 'queed'), __($queed_frontend_options['comments_one_response'], 'queed'), '% '.__($queed_frontend_options['comments_oneplus_response'], 'queed'), 'comments-link', 'Comments are off for this post');
                                                    ?>
                                                </a>
                                           
                                        
                                    </p>
                                    <?php
                                endif;
                            ?>
                        </div><!-- blog_meta -->
						
								<div class="blog_content span75">
								<?php 
								if (has_post_thumbnail( $post->ID ) )
								{
									$vt_image = vt_resize( '', $image[0] , 585, 0, true );
									?>
                                    <a href="<?php the_permalink() ?>">
                                        <div class="blog_top_image">
                                        	<div class="blog_fader_grid">
                                            </div>
                                            <?php
												if ($queed_frontend_options['blog_bw']=="no")
												{
													$vt_image = vt_resize( '', $image[0] , 585, 0, true );
                                            		?>
													<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image boxed_shadow" alt="" />
                                                    <?php
												}
												else
												{
													?>
                                            		<img src="<?php bloginfo('template_directory'); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=585&f=2" class="custom-img grid_image boxed_shadow<?php if ($queed_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
                                            		<?php
												}
											?>
                                        </div>
                                    </a>
                                <?php
								}
								?>
                                    
                                    	<div class="entry_title entry_title_single">
                                   	
                                        <h3>
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </h3>
                                   	</div>
                                        	<?php the_excerpt_dynamic(270);
                                            if (is_big_excerpt(270))
												{
													?>
                                                   
                                                        <div class="theme_button">
                                                            <a href="<?php the_permalink() ?>">Read more&nbsp;&nbsp;&nbsp;&rarr;</a>
                                                        </div>
                                                    
                                                    <?php
												}			
					if ($post_counter < $count_posts->publish || $paged!=$total_pages)
					{
						?>
                		<div class="dotted_line" style="margin-top:28px"></div>
                		<div class="dotted_line"></div>
                		<div class="dotted_line" style="margin-bottom:4px"></div>
                        <?php 
					}
				?>
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
				  
					<div id="entries_navigation" class="content_block">
						<div class="navigation">
							
							<div class="next-posts">
								<div id="nbr_helper" pir_curr="<?php echo $paged; ?>" pir_max="<?php echo $total_pages; ?>">
								
									<h4>​
									<div id="pir_loader_wrapper" class="cf">
							<img src="<?php echo bloginfo('template_directory'); ?>/images/icons/<?php echo $queed_frontend_options['icon_set']; ?>/ajax-loader.gif" id="pir_loader">
							
							</div>
										<?php next_posts_link($queed_frontend_options["previous_nav_text"],$total_pages); ?>
										
									</h4>
								</div>
							</div>
							
							<h4><div id="no_more"></div></h4>
							
						</div><!-- navigation -->
					</div><!-- entries_navigation --> 
					<?php
				}
			?>
      </div><!-- /#main -->
    <?php queed_main_after(); ?>
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
    </div><!-- /#content -->
<?php get_footer(); ?>