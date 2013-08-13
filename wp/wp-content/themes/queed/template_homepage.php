<?php 
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
	<?php
	if ($queed_frontend_options['show_homepage_welcome']=="yes")
	{
		?>
        <div class="homepage-header">
            <?php echo ($queed_frontend_options['homepage_welcome_text']); echo "<br />";?>
            <span class="sub_line"><?php echo ($queed_frontend_options['homepage_welcomel2_text']); ?></span>
        </div>
        <?php
	}
	?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php queed_main_before(); ?>
      <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?>" role="main">
        <?php
			for ($i=1;$i<5;$i++)
			{
				//HOMEPAGE SLIDER MANAGMENT
				if ($queed_frontend_options['show_homepage_slider']==$i)
				{	
					$q_slides_id=$queed_frontend_options['homepage_slider_group'];
					if ($queed_frontend_options['homepage_slider_group']=="queed_all_s")
					{
						$q_slides_id="";
					}
					$args=array(	'post_type' => 'pirenko_slides',
								  	'showposts' => 99,
								  	'pirenko_slide_set' => $q_slides_id
								);
					$loop = new WP_Query( $args );
					$slide_number=0;
					?>
					<div id="home_slider" class="flexslider home_slider">
                        <ul class="slides boxed_shadow">
                        	<?php
                        		while ( $loop->have_posts() ) : $loop->the_post(); ?>				
									<?php if (has_post_thumbnail( $post->ID ) ):
										//GET THE FEATURED IMAGE
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );	
											else :
												//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
												$container="".get_bloginfo('template_directory')."/images/sample_home.jpg";
												$image[0]=get_image_path($container);
											endif; 
											?>
											<li>
                                            	<?php
													if (get_post_meta(get_the_ID(), "queed_slide_url", true)!="")
													{
														?>
                                            			<a href="<?php echo get_post_meta(get_the_ID(), "queed_slide_url", true) ?>">
                                                        <?php
													}
													if (get_the_title()=="")
													{
														$sl_title="&nbsp;";
														$title_class="inv_el";
													}
													else
													{
														$sl_title=get_the_title();
														$title_class="";
													}
													if (get_the_content()=="")
													{
														$sl_body="&nbsp;";
														$body_class="inv_el";
													}
													else
													{
														$sl_body=get_the_content();
														$body_class="";
													}
													if (get_post_meta(get_the_ID(), "queed_slide_video", true)==""):
													?>
                                                    <div class="slider_text_holder">
                                                        <div id="queed_slidetop_<?php echo $slide_number; ?>" class="headings_top <?php echo $title_class; ?>">
                                                        <h3><?php echo $sl_title; ?></h3>
                                                        </div>
                                                        <div id="queed_slidebody_<?php echo $slide_number; ?>" class="headings_body <?php echo $body_class; ?>">
                                                            <h4><?php echo $sl_body; ?></h4>
                                                        </div>
                                                    </div>
													<img src=<?php echo ($image[0]); ?> alt="">
													<?php
												else:
													//IT's A VIDEO SLIDE
													?>
                                                    <div class="slider_text_holder">
                                                        <div id="queed_slidetop_<?php echo $slide_number; ?>" class="headings_top slide_video <?php echo $title_class; ?>">
                                                        <h3><?php echo $sl_title; ?></h3>
                                                        </div>
                                                        <div id="queed_slidebody_<?php echo $slide_number; ?>" class="headings_body <?php echo $body_class; ?>">
                                                            <h4><?php echo $sl_body; ?></h4>
                                                        </div>
                                                    </div>
													<?php
													echo (get_post_meta(get_the_ID(), "queed_slide_video", true));
													
												endif;
												if (get_post_meta(get_the_ID(), "queed_slide_url", true)!="")
												{
													?>
                                                    </a>
                                                    <?php
												}
												?>
											</li> 
											<?php $slide_number++; ?>
							<?php 
								endwhile; 
								if ($slide_number==0)
								{
									?>
									<li>
                                    	<span style="text-align:center;display: block;"><h4>The slider is on, but there are no slides to display.</h4><br />Add some slides on the Wordpress Dashboard.<br />If you don't need the slider turn off under Queed Options>Homepage Tab>Slider>Show Slider on Homepage.</span>
									</li> 
                                    <?php
								}
								?>
                         
                        </ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->
                  	<?php
				}
				//HOMEPAGE PORTFOLIO MANAGMENT
				if ($queed_frontend_options['show_homepage_portfolio']==$i)
				{
					$q_portfolio_link="";
					$q_portfolio_title="";
					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template_portfolio.php'
						)); 
						foreach($pages as $page)
						{
							$q_portfolio_link=get_page_link( $page->post_id ); 
							$q_portfolio_title = $page->post_title;
						}
						if ($q_portfolio_link=="")
						{
							$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template_portfolio-dcols.php'
						)); 
						foreach($pages as $page)
						{
							$q_portfolio_link=get_page_link( $page->post_id ); 
							$q_portfolio_title = $page->post_title;
						}
						}
					?>
					<h1 class="entry-title">
                    	<small>
							<a href="<?php echo $q_portfolio_link ?>">
								<?php 
                                	if ($queed_frontend_options['portfolio_title']!="")
                                    {
                                    	echo $queed_frontend_options['portfolio_title'];
                                  	}
                                  	else
                                   	{
                                    	echo $q_portfolio_title;
                                  	}
                             	?>
                        	</a>
                       	</small>
                    </h1>
                    <div class="simple_line"></div>
						<?php
                            $ins=1;
                            $my_home_query = new WP_Query();
                            $args = array( 'post_type' => 'pirenko_portfolios','posts_per_page' => $queed_frontend_options['portfolio_show_nr']);
                            $my_home_query->query($args);
                        ?>
						<div class="cf pir_content">
                                <?php
                                    if ($my_home_query->have_posts()) : 
									?>
                                    <div id="carousel" class="es-carousel-wrapper">
									<div class="es-carousel hpage_pwrap">
                                	<ul class="">
                                    <?php
									while ($my_home_query->have_posts()) : $my_home_query->the_post(); 
                                ?>
                                    <li id="post-<?php the_ID(); ?>" class="folio_grid folio_grid-sixth cf" data-type="<?php $category= get_the_category(); foreach($category as $test) { echo $test->slug;echo " "; }  ?>" data-id="id-<?php echo $ins; ?>">
                                            <?php 
                                            if (has_post_thumbnail( $post->ID ) ):
                                                //GET THE FEATURED IMAGE											
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                                               $image[0] = get_image_path($image[0]);
                                                $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                            else :
                                                //THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
                                                $p_photo_image[0]=$image[0]='/images/sample.jpg';
                                            endif; 
											?>
                                                <a href="<?php the_permalink() ?>" class="">
                                                    <div class="folio_images_wrapper">
                                                        <div class="home_fader_grid_folio">
                                                        <div class="home_folio_title_grid" id="grid_title-<?php the_ID(); ?>">
                                                        <h4><?php the_title(); ?></h4>
                                                    </div><!-- home_post_title_grid -->
                                                    <?php
                                                        $folio_terms=get_the_terms(get_the_ID(),'pirenko_skills');
                                                        if (!empty($folio_terms))
                                                        {
                                                            $folio_names = array();
                                                            foreach ( $folio_terms as $folio_term ) {
                                                                $folio_names[] = $folio_term->name;
                                                            }
                                                                                
                                                            $final_string = join( " . ", $folio_names );
                                                            
                                                            ?>
                                                            <div class="skills_text">
                                                                <h5 class="special_italic">
                                                                    <?php 
                                                                        echo ($final_string); 
                                                                    ?>
                                                                    
                                                                </h5>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>
                                                        </div>
                                                        <div class="home_bottom_image">
                                                            <?php 
																if ($queed_frontend_options['portfolio_bw']=="no")
																{
																	$vt_image = vt_resize( '', $image[0] , 234, 234, true );
																	?>
																	<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img" alt="" />
																	<?php
																}
																else
																{
																	?>
																	<img src="<?php bloginfo('template_directory'); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=234&h=180&f=2" class="custom-img<?php if ($queed_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
																	<?php
																}
															?>
                                                        </div>
                                                    </div> <!-- images_wrapper -->
                                                </a>                      
                                            </li>
                                            <?php $ins++; 
                                        ?>
                                    <?php endwhile; ?>
                                    </ul>
                                	</div>
                          			</div>
								<?php else : ?>
									<span style="text-align:center;display: block;"><h4>The Portfolio module is on, but there are no Portfolio Items to display.</h4><br />Add some Portfolio Items on the Wordpress Dashboard.<br />If you don't need this block turn off under Queed Options>Homepage Tab>Portfolio>Show Portfolio entries on Homepage.</span>
								<?php endif; 
							?>
                    	</div><!-- pir_content -->
                    <?php
				}
				//HOMEPAGE BLOG MANAGMENT
				if ($queed_frontend_options['show_homepage_blog']==$i)
				{
					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template_blog.php'
						)); 
						foreach($pages as $page)
						{
							$q_news_link=get_page_link( $page->post_id ); 
							$q_news_title = $page->post_title;
						}
					?>
					<h1 class="entry-title">
                    	<small>
							<a href="<?php echo $q_news_link ?>">
								<?php 
                                	if ($queed_frontend_options['news_title']!="")
                                    {
                                    	echo $queed_frontend_options['news_title'];
                                  	}
                                  	else
                                   	{
                                    	echo $q_news_title;
                                  	}
                             	?>
                        	</a>
                       	</small>
                    </h1>
                   	<div class="simple_line"></div>
						<?php
                            $ins=1;
                            $my_home_query = new WP_Query();
							
							if (!isset($queed_frontend_options['blog_group']))
								$queed_frontend_options['blog_group']='queed_all_s';
							$q_blog_id=$queed_frontend_options['blog_group'];
							if ($queed_frontend_options['blog_group']=="queed_all_s")
							{
								$q_blog_id="";
							}							
                            $args = array	( 	'post_type=post', 
												'paged' => get_query_var( 'paged' ),
												'posts_per_page' => 3,
												'category_name' => $q_blog_id
											);
                            $my_home_query->query($args);
							if ($my_home_query->have_posts()) :
							?>
								<div id="" class="cf pir_content">
                       			<ul class="blog_ul">
								<?php
								while ($my_home_query->have_posts()) : $my_home_query->the_post(); 
								//SHOW ONLY 3 ENTRIES
								if($ins % 3 == 0)
									$p_class="last_grid";
								else
									$p_class="";
								?>
                            	<li id="post-<?php the_ID(); ?>" class="post_grid <?php echo $p_class; ?> cf" data-type="<?php $category= get_the_category(); foreach($category as $test) { echo $test->slug;echo " "; }  ?>" data-id="id-<?php echo $ins; ?>">
										<?php 
                                        if (has_post_thumbnail( $post->ID ) ):
                                            //GET THE FEATURED IMAGE											
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
											$image[0] = get_image_path($image[0]);
											$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
											$vt_image = vt_resize( '', $image[0] , 300, 232, true );
											?>
											<a href="<?php the_permalink() ?>" class="">
                                                <div class="blog_images_wrapper">
                                                	<div class="home_fader_grid">
                                                    </div>
                                                    <div class="home_blog_image">
                                                        <?php 
															if ($queed_frontend_options['blog_bw']=="no")
															{
																?>
																<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img boxed_shadow" alt="" />
																<?php
															}
															else
															{
																?>
																<img src="<?php bloginfo('template_directory'); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=300&h=232&f=2" class="custom-img boxed_shadow<?php if ($queed_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
																<?php
															}
														?>
                                                    </div>
												</div> <!-- images_wrapper -->
                                           	</a>
                                            <?php
                                        else :
                                            //THERE'S NO THUMBNAIL
      										
                                        endif; ?>
                                        	
                                            <div class="home_blog_date_text">
                                            	<h4><?php echo get_the_date(); ?></h4>
                                            </div>
                                            <div class="home_post_title_grid" id="grid_title-<?php the_ID(); ?>">
                                            	<h3><?php the_title(); ?></h3>
                                         	</div><!-- home_post_title_grid -->
                                            <?php 
												the_excerpt_dynamic(135);
												if (is_big_excerpt(135))
												{
													?>
                                                   
                                                        <div class="theme_button">
                                                            <a href="<?php the_permalink() ?>"><?php _e($queed_frontend_options['read_more'], 'queed'); ?>&nbsp;&nbsp;&nbsp;&rarr;</a>
                                                        </div>
                                                    
                                                    <?php
												}
												?>
										</li>
										<?php $ins++; 
									?>
								<?php endwhile; ?>
                                </ul>
                                </div>
                          		</div>
								<?php else : ?>
									<span style="text-align:center;display: block;"><h4>The Blog module is on, but there are no Posts to display.</h4><br />Add some Posts on the Wordpress Dashboard.<br />If you don't need this block turn off under Queed Options>Homepage Tab>Blog>Show Blog entries on Homepage.</span>
								<?php endif; 
							?>
                            </div><!-- pir_content -->
                    <?php
				}
				//HTML BLOCK MANAGMENT
				if ($queed_frontend_options['show_htmlblock']==$i)
				{
					if ($queed_frontend_options['htmlblock_title']!="")
					{
						?>
							<h1 class="entry-title">
                    			<small>
									<?php 
										echo $queed_frontend_options['htmlblock_title'];
									?>
								</small>
                            </h1>	
							<div class="simple_line"></div>
						<?php
					}
					?>
					<div class="cf pir_content">
						<?php 
							echo do_shortcode($queed_frontend_options['htmlblock_body']);
						?>
					</div>
					<?php 
				}
	
			}//FOR CYCLE
		?>
        
					
					
      </div><!-- /#main -->
    <?php queed_main_after(); ?>
    <?php 
		/*roots_sidebar_before(); ?>
		  <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
		  <?php roots_sidebar_inside_before(); ?>
			<?php get_sidebar(); ?>
		  <?php roots_sidebar_inside_after(); ?>
		  </aside><!-- /#sidebar -->
		<?php roots_sidebar_after(); */
	?>
    </div><!-- /#content -->
<?php get_footer(); ?>