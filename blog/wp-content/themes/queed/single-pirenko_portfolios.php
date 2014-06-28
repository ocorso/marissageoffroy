<?php get_header(); ?>
    <div class="page-header">
        <h1>
            <?php
				$arra=get_the_terms( get_the_ID(),'pirenko_skills' );
				$cats_arr = array("");
				if($arra){
					foreach($arra as $s_cat) {
						array_push($cats_arr,$s_cat->slug);
					}
				}
				$pages_blog = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template_portfolio.php'
				));
				if (empty($pages_blog))
				{
					$pages_blog = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template_portfolio-dcols.php'
						)); 
				}
				foreach($pages_blog as $page_blog)
				{
					//CHECK IF THIS PORTFOLIO PAGE CONTAINS THE CATEGORY CURRENTLY BEING USED
					$data = get_post_meta($page_blog->post_id, '_custom_meta_portfolio_template', TRUE);
					if (isset($data['queed_filter']) && $data['queed_filter']=="yes")
					{
						
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								if (in_array($childs, $cats_arr)) {
									$final_link=get_page( $page_blog->post_id );
								}
								
							}
						}
					}
					else
					{
						$blog_link=get_page( $page_blog->post_id );
					}
				}
				if(isset( $final_link->post_title) && $final_link->post_title!="")
					echo $final_link->post_title;
				else
					echo $blog_link->post_title;
			?>
    	</h1>
    </div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    	<?php queed_main_before(); ?>
        
      	<div id="main" class="<?php echo MAIN_CLASSES_PORTFOLIO; ?>" role="main">
			<?php while (have_posts()) : the_post(); ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                	<div id="single_slider" class="flexslider boxed_shadow">
                        <ul class="slides">
							<?php
                                //GET THEME CUSTOM FIELDS INFO
                                $meta = get_post_meta( $post->ID, 'key', true );
								global $simple_mb;
								$data=$simple_mb->the_meta();
                                $ext_count=0;
                                if (!isset($data['skip_featured']))
                               		$data['skip_featured']=0;
                             	if ($data['skip_featured']!=1 || $data['skip_featured']=="")
                              	{
									if (has_post_thumbnail( $post->ID ) )
									{
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										$image[0] = get_image_path($image[0]);
										$ext_count=1;
										$vt_image = vt_resize( '', $image[0] , 620, 0, false );
										?>
										<li id="slide_0">
											<img src="<?php echo $vt_image['url']; ?>" alt="" title="" />
										</li>
                                      	<?php
									}
                             	}
                                $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                //PLACE THE OTHER NINE IMAGES
                                for ($count=2;$count<11;$count++)
                                {
                                 	if (isset($data['image_'.$count]))
                                    {
                                    	if ($data['image_'.$count]!="")
                                        {
                                        	$ext_count++;
                                            if ($ext_count>1):
                                            	$flagger=false;
                                            endif;
                                            ?>
                                           	
                                            	<?php 
                                                	if (substr($data['image_'.$count],0,6)=="http:/")
                                                    {
														$ext_count_h=$ext_count-1;
                                                    	$data['image_'.$count] = get_image_path($data['image_'.$count]);
                                                        echo "<li id=slide_".$ext_count_h.">";
														$vt_image = vt_resize( '', $data['image_'.$count] , 620, 0, false );
														?>
                                                        <img src="<?php echo $vt_image['url']; ?>" alt="" title="" />
                                                    	<?php
														echo "</li>";
                                                    }
                                                    else
                                                    {
														$ext_count_h=$ext_count-1;
														echo "<li id=slide_".$ext_count_h." class='slide_video'>";
                                                    	echo $data['image_'.$count];
														echo "</li>";
                                                    }
                                             	?>
                                         	
                                        	<?php 
                                      	}
                               		}
                            	}
								//ADJUST CONTENTS IF THERE ARE NO IMAGES TO SHOW
								if ($ext_count==0)
								{
									echo 	'<style type="text/css">
											.flexslider
											{
												display:none;
											}
											</style>';
								}
							?>
                    	</ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->  
                    
           		
        	<?php endwhile; /* End loop */ ?>
      	</div><!-- /#main -->
      	<div id="portfolio_info" class="<?php echo SIDEBAR_CLASSES_PORTFOLIO; ?>" role="">
        <header>
        	<div id="mini_menu" style="">
				<div id="nav_bar">
                                <div class="navigation-previous">
										<div class="portfolio_nav_button">
											<?php 
											if (previous_post_link_plus( array(
												'in_same_cat' => false,
												'format' => '%link',
												'link' => '<div class="prev_link_portfolio"></div>'
												) ))
											{
												
											}
											 else
													  {
														  echo 	'<style type="text/css">
														.navigation-previous
														{
															display:none;
														}
														</style>';
													  }
											?>
										</div>
									</div><!-- navigation_previous -->
									<div class="navigation-next">
										<div class="portfolio_nav_button">
											<?php if (next_post_link_plus( array(
												'in_same_cat' => false,
												'format' => '%link',
												'link' => '<div class="next_link_portfolio"></div>'
												) ))
													  {
														  
													  }
													  else
													  {
														  echo 	'<style type="text/css">
														.navigation-next
														{
															display:none;
														}
														</style>';
													  }
											?>
										</div>
									</div><!-- navigation_next -->
									
								</div><!-- nav_bar -->
                                
							</div><!-- mini_menu -->
        	<div class="single_entry_title">
                        	<h2>
								<?php the_title(); ?>
                        	</h2>
                        </div>
                        
                         <div id="single_portfolio_meta">
							 <?php 
                          		if ($queed_frontend_options['dateby_port']=="yes")
                                {
                                    ?>
                                    <p>
                                        <span class="single_heading special_italic">
                                            <?php _e('Date', 'queed'); ?>: 
                                        </span>
                                        <span class="portfolio_single_info"><?php echo get_the_date('M j, Y'); ?></span>
                                    </p>
                                    <?php
                                }
                            ?>
                            <?php
                            if (isset($data['client_url']))
							{
								if ($data['client_url']!="")
								{	
									?>
                                    <p>
                                        <span class="single_heading special_italic">
                                        Client: 
                                        </span>
                                        <span class="portfolio_single_info">
                                            <?php echo $data['client_url']; ?>
                                        </span>
                                    </p>
									<?php
								}
							}
							?>
                            <?php 
								if ($queed_frontend_options['categoriesby_port']=="yes")
								{
									if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
									{
										if (!isset($queed_frontend_options['skills_text']))
											$queed_frontend_options['skills_text']='Skills';
										?>
										<p>
											<span class="single_heading special_italic">
												<?php _e($queed_frontend_options['skills_text'], 'queed'); ?>: 
											</span>
											<span class="zero_color">
												<?php 
													echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); 
												?>
											</span>
										</p>
										<?php
									}
								}
							?>
        					<?php
                        		if ( comments_open() ) :
								?>
                                <p class="">
                                    <span class="single_heading special_italic">
                                	<?php _e('Comments', 'queed'); ?>: 
                                </span>
                                          		<?php 
										comments_popup_link( __($queed_frontend_options['comments_no_response'], 'queed'), __($queed_frontend_options['comments_one_response'], 'queed'), '% '.__($queed_frontend_options['comments_oneplus_response'], 'queed'), 'comments-link', 'Comments are off for this post');
                                      ?> 
                                </p>
								<?php
							endif;
						?>
                        </div>
						
                        <div class="single-entry-content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                            if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
							{
								?>
                                <p>
                                	<ul class="theme_tags">
										<?php 
                                    		echo get_the_term_list(get_the_ID(),'portfolio_tag', '<li>', '</li><li>', '</li>' );
										?>
                                    </ul>
                               	</p>
                              	<?php
							} 
							if (isset($data['ext_url']))
							{
								if ($data['ext_url']!="")
								{	
									?>
									<div class="special_size dotted_line"></div>
									<div class="special_size dotted_line"></div>
									<div class="special_size dotted_line"></div>
									<div class="theme_button_inverted project_button">
										<a href="<?php echo $data['ext_url']; ?>" target="_blank"><?php _e($queed_frontend_options['launch_text'], 'queed'); ?>&nbsp;&nbsp;&nbsp;&rarr;</a>
									</div>
									<?php
								}
							}
						?>
      			</div><!-- /#sidebar -->
            <div class="<?php echo MAIN_CLASSES_PORTFOLIO; ?>">     		
            	<?php 
					if (get_the_terms(get_the_ID(), 'pirenko_skills')!="") 
					{
						global $category_ids;
						$category_ids="";
						foreach(get_the_terms(get_the_ID(), 'pirenko_skills') as $term)
						{
							$category_ids.= $term->slug.", ";	
						}
						$args=array(
							'post_type' => 'pirenko_portfolios',
							'pirenko_skills' => $category_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page'=> 3,
							'orderby' => 'rand'
						);
					}
					else
					{
						//THIS POST HAS NO CATEGORIES. LET'S SHOW ALL
						$args=array(
							'post_type' => 'pirenko_portfolios',
							'post__not_in' => array($post->ID),
							'posts_per_page'=> 3,
							'orderby' => 'rand'
						);
					}
                    $loop = new WP_Query( $args );
					if ($loop->post_count>0)
					{
						?>
						<div id="related_projects">
							<h3><?php _e($queed_frontend_options['related_text'], 'queed'); ?></h3>
						</div>
                        <div class="inner_line_single_block"></div>
						<div id="carousel_single" class="es-carousel-wrapper">
							<div class="es-carousel">
								<ul class="">	
									<?php 
										
									$l_count=1;
									while ( $loop->have_posts() ) : $loop->the_post();
										if($l_count % 3 == 0)
											$p_class="third_related";
										else
											$p_class="";
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
										$image[0] = get_image_path($image[0]);
										?>
										<li class="related_post related_post-sixth <?php echo $p_class; ?>">
											<a href="<?php the_permalink(); ?>">
                                            	<div class="related_fader_grid">
                                                	
                                                		<h4><?php the_title(); ?></h4>
                                                	
                                            	</div>
                                                
                                                <?php
													if ($queed_frontend_options['portfolio_bw']=="no")
													{
														$vt_image = vt_resize( '', $image[0] , 206, 160, true );
														?>
														<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img" style="z-index:-1;" />
														<?php
													}
													else
													{
														?>
														<img src="<?php bloginfo('template_directory'); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=206&h=160&f=2" class="custom-img<?php if ($queed_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" style="z-index:-1;" />
														<?php
													}
													?>
											</a>
										</li>
										<?php
										$l_count++;
									endwhile;
									//RESET MAIN LOOP
									wp_reset_postdata();
									?>
								</ul>
							</div>
						</div>
                    	<?php
					}
			?>
            <div class="dotted_line" style="margin-top:40px"></div>
            <div class="dotted_line"></div>
            <div class="dotted_line" style="margin-bottom:-3px"></div>    
            <?php comments_template(); ?>
          	</div>
          	</article>
        </header>
    </div><!-- /#content -->
<?php get_footer(); ?>
