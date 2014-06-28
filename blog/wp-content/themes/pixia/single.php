<?php 
	get_header();
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	//GET THEME CUSTOM FIELDS INFO
    $data = get_post_meta( $post->ID, 'key', true );
	$sl_id="single_slider";
	$sl_class="flexslider";
	if (isset($data['no_slider']) && $data['no_slider']=="1")
	{
		$sl_id="not_slider";
		$sl_class="";
	}
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    	<?php pirenko_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
			<?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('lpad'); ?> id="post-<?php the_ID(); ?>">
                	<div class="boxed_shadow colored_bg blog_single">
                	<div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>">
                        <ul class="slides">
							<?php
                                $ext_count=0;
                                if (!isset($data['skip_featured']))
                               		$data['skip_featured']=0;
                             	if ($data['skip_featured']!=0 || $data['skip_featured']=="")
                              	{
									if (has_post_thumbnail( $post->ID ) )
									{
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										//$image[0] = get_image_path($image[0]);
										$ext_count=1;
										?>
										<li>
											<img src="<?php echo $image[0]; ?>" />
										</li>
                                      	<?php
									}
                             	}
                                $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                //PLACE THE OTHER NINE IMAGES
                                for ($count=2;$count<11;$count++)
                                {
                                 	if (isset($data['image-'.$count]))
                                    {
                                    	if ($data['image-'.$count]!="")
                                        {
                                        	$ext_count++;
                                            if ($ext_count>1):
                                            	$flagger=false;
                                            endif;
                                            ?>
                                           	<li>
                                            	<?php 
                                                	if (substr($data['image-'.$count],0,6)=="http:/")
                                                    {
                                                    	//$data['image-'.$count] = get_image_path($data['image-'.$count]);
														?>
                                                        <img src="<?php echo $data['image-'.$count]; ?>" />
                                                    	<?php
                                                    }
                                                    else
                                                    {
														$el_class='video-container';
														if (strpos($data['image-'.$count],'soundcloud.com') !== false) {
															$el_class= 'soundcloud-container';
														}
														echo "<div class='".$el_class."'>";
                                                    	echo $data['image-'.$count];
														echo "</div>";
                                                    }
                                             	?>
                                         	</li>
                                        	<?php 
                                      	}
                               		}
                            	}
							?>
                    	</ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->
                    <div class="clearfix"></div>
                    <?php
						//ADJUST CONTENTS IF THERE ARE NO IMAGES TO SHOW
						if ($ext_count==0)
						{
							echo 	'<style type="text/css">
									.flexslider
									{
										display:none;
									}
									</style>';
							echo '<div style="margin-bottom:0px">&nbsp;</div>';
						}
					?>
                    <header>
                    <div class="blog_meta blog_meta_single padded_text">
                                	<span class="left_floated  adj_ss"><?php echo get_the_date('j'); ?>&nbsp;</span>
                                	<span class="left_floated"><?php echo get_the_date('F'); ?></span>
							<?php 
                                if ($pixia_frontend_options['postedby_news']=="yes")
                                {
                                    ?>
                                    
                                        <span class="left_floated">&nbsp;<?php _e($pixia_frontend_options['posted_by_text'], 'pixia'); echo " ".get_the_author();?></span>
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
                                        	<div class="tr_wrapper" style="margin-left:-7px;z-index:0;margin-top:1px;width:25px;height:22px;">
                                                    <div class="submenu_catgr pirenko_tinted">
                                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                                    </div>
                                                </div>
                                                <div style="margin-left:22px">
										<?php the_category(', '); //CATS WITH LINKS ?>
                                        </div>
                                        </span>
                                        <span class="pir_divider left_floated hide_much_later"></span>
                                        <div class="clearfix show_much_later"></div>
									<?php
								}
							?>
                            <?php
								  if ( comments_open() ) :
								  ?>
								  <a href="<?php comments_link(); ?>">
									  <div class="left_floated" style="margin-left:-5px;">
										  <div class="tr_wrapper" style="z-index:0;height:22px;margin-top:-1px;">
											  <div class="submenu_speech pirenko_tinted">
												  <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
											  </div>
										  </div>
										  <div class="" style="margin-left:30px;margin-top:1px;">
											  <div class="">
											  <?php 
												  comments_number( '0', '1 ', '%');
												?> 
											   </div>
											</div>
										</div>
									</a>
								 <span class="pir_divider left_floated hide_much_later"></span>
								  <div class="clearfix show_much_later"></div>
								  <?php
							  endif;
                            ?>
                            <div class="left_floated" style="margin-left:-4px;">
                            <?php echo getblogLikeLink(get_the_ID());
								
							?>
                            	</div>
                        </div>
                    	<div class="simple_line"></div>
                       	<div class="padded_text sgl_ttl">
                        	<h2>
								<header_font><?php the_title(); ?></header_font>
                        	</h2>
                        </div>
                  	</header>	
                   
                  
                    <div class="padded_text">
                        <div class="on_colored">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php 
						if (isset($pixia_frontend_options['related_blog']) && $pixia_frontend_options['related_blog']=="yes")
						{
							?>
							<div class="clearfix"></div>
							<div class="simple_line"></div>
							<div class="padded_text post_meta_single twelve columns">
								<div class="navigation-previous">
									<div id="previous_button">
										<?php 
										previous_post_link_plus( array(
											'in_same_cat' => false,
											'format' => '%link',
											'link' => '<div class="prev_link_portfolio">
																		<div class="tr_wrapper zero_index" style="height:20px;">
																			<div class="submenu_arrow_lport pirenko_tinted">
																				<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $clearer_inactive_color .'" src="'.get_template_directory_uri() .'/images/icons/arrows.png" />
																			</div>
																		</div>
																	</div>
																	<div class="after_icon">%title</div>'
											) );
										?>
									</div>
								</div><!-- navigation_previous -->
								<div class="navigation-next right_floated">
									<div id="next_button">
										<?php next_post_link_plus( array(
											'in_same_cat' => false,
											'format' => '%link',
											'link' => '<div class="next_link_portfolio">
											  <div class="left_floated">
											  %title
											  </div>
										  </div>
										  <div class="left_floated">
				  <div class="tr_wrapper zero_index" style="height:20px;margin-left:-8px;">
												  <div class="submenu_arrow_rport pirenko_tinted">
													  <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $clearer_inactive_color .'" src="'.get_template_directory_uri() .'/images/icons/arrows.png" />
												  </div>  
												  </div>
												  </div> '
											) );
										?>
									</div>
								</div><!-- navigation_next -->
							</div>
							<div class="clearfix"></div>
							<?php
                    	}
					?>
                    </div>
                    <div class="clearfix"></div>
                    <div id="c_wrap_single">
                    <?php 
				if (isset($pixia_frontend_options['related_blog_elast']) && $pixia_frontend_options['related_blog_elast']=="yes")
				{
					$args=array(
					  'orderby' => 'name',
					  'order' => 'ASC'
					  );
					  global $category_ids;
					$category_ids="";
					foreach((get_the_category()) as $category) 
					{
						$category_ids.= $category->slug . ', ';
					} 
					if ($category_ids!="") 
					{
						$args=array(
							'category_name'=>$category_ids,
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
							<h3><header_font>
								<?php _e($pixia_frontend_options['related_text_blog'], 'pixia'); ?>
                          	</header_font></h3>
						</div>
                        <div class="simple_line_onbg"></div>
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
										if ($image[0]!="")
										{
											?>
											<li class="related_post <?php echo $p_class; ?>">
												<a href="<?php the_permalink(); ?>">
													<div class="related_fader_grid">
													</div>
													<div class="related_single_title">
														<?php the_title(); ?>
														<div class="inner_skills special_italic_medium">
															<?php 
																$virgul=0;
																foreach((get_the_category()) as $category) 
																{
																	if ($virgul==0)
																		echo $category->cat_name;
																	else
																		echo ', '.$category->cat_name;
																	$virgul++;
																} 
															?>
														</div>
													</div>
													<?php
														$pixia_frontend_options['portfolio_bw']="no";
														if ($pixia_frontend_options['portfolio_bw']=="no")
														{
															$vt_image = vt_resize( '', $image[0] , 700, 463, true );
															?>
															<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img" />
															<?php
														}
														else
														{
															?>
															<img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=700&h=463&f=2" class="custom-img<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" />
															<?php
														}
														?>
												</a>
											</li>
										<?php
										$l_count++;
										}
										
									endwhile;
									//RESET MAIN LOOP
									wp_reset_postdata();
									?>
								</ul>
							</div>
						</div>
                    	<?php
					}
				}
			?>  
                  		<?php comments_template(); ?>
                  	</div>
           		</article>
        	<?php endwhile; /* End loop */ ?>
      	</div><!-- /#main -->
    	<?php pirenko_main_after(); ?>
    </div><!-- /#content -->
<?php get_footer(); ?>