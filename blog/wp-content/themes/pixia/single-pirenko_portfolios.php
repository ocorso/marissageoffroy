<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	$darker_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],-80);
	$clearer_body_color=alter_brightness($pixia_frontend_options['body_color'],40);
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    	<?php pirenko_main_before(); ?>
        <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
			<?php while (have_posts()) : the_post(); 
				$meta = get_post_meta( $post->ID, 'key', true );
				global $simple_mb;
				$data=$simple_mb->the_meta();
				$sl_id="single_slider";
				$sl_class="flexslider";
				if (isset($data['no_slider']) && $data['no_slider']=="1")
				{
					$sl_id="not_slider";
					$sl_class="";
				}
			?>
                <article <?php post_class('colored_bg boxed_shadow'); ?> id="post-<?php the_ID(); ?>">
                	<div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>">
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
										$in_ttl="";
										$alt_text="";
										if ( $thumb = get_post_thumbnail_id() )
										{
											$in_ttl=get_post( $thumb )->post_title;
											$alt_text=get_post_meta($thumb, '_wp_attachment_image_alt', true);
										}
										$ext_count=1;
										?>
										<li id="slide_0">
											<img src="<?php echo $image[0]; ?>" title="<?php echo $in_ttl; ?>" alt="<?php echo $alt_text; ?>" />
										</li>
                                      	<?php
									}
                             	}
                                $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                //PLACE THE OTHER IMAGES
                                for ($count=2;$count<30;$count++)
                                {
                                 	if (isset($data['image_'.$count]))
                                    {
                                    	if ($data['image_'.$count]!="" && $data['image_'.$count]!="A")
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
                                                    	//$data['image_'.$count] = get_image_path($data['image_'.$count]);
                                                        echo "<li id=slide_".$ext_count_h.">";
														$alt_text = get_post_meta(get_attachment_id_from_src($data['image_'.$count]), '_wp_attachment_image_alt', true);
														?>
                                                        <img src="<?php echo $data['image_'.$count]; ?>" title="<?php echo get_post( get_attachment_id_from_src($data['image_'.$count]) )->post_title; ?>" alt="<?php echo $alt_text; ?>" />
                                                    	<?php
														echo "</li>";
                                                    }
                                                    else
                                                    {
														$ext_count_h=$ext_count-1;
														echo "<li id=slide_".$ext_count_h." class='slide_video'>";
														$el_class='video-container';
														if (strpos($data['image_'.$count],'soundcloud.com') !== false) {
															$el_class= 'soundcloud-container';
														}
														echo "<div class='".$el_class."'>";
                                                    	echo $data['image_'.$count];
														echo "</div></li>";
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
                            <div id="ctrls_container" class="four columns">
                            </div>
                    	</ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->  
                    
           		
        	<?php endwhile; /* End loop */ ?>
            <div class="single_entry_title">
                        	<h2><header_font>
								<?php the_title(); ?>
                        	</header_font></h2>
                        </div>
                        <div class="eight columns single-entry-content padded_text">
                            <?php the_content(); ?>
                          	
                        </div>
                        <div id="portfolio_info" class="four columns unpadded_low" role="">
                         <?php
							if (isset($data['ext_url']))
							{
								if ($data['ext_url']!="" && $data['ext_url']!="A")
								{	
									//ADD HTTP PREFIX IF NEEDED
									if (substr($data['ext_url'],0,7)!="http://")
										$data['ext_url']="http://".$data['ext_url'];
									?>
									<span id="ext_link" class="single_heading special_italic_medium">
										<a href="<?php echo $data['ext_url']; ?>" target="_blank"><?php _e($pixia_frontend_options['launch_text'], 'pixia'); ?>&nbsp;<span style="">&rarr;</span></a>
									</span>
									<?php
								}
							}
						?>
                         <div id="single_portfolio_meta">
                            <?php
                            if (isset($data['client_url']))
							{
								if ($data['client_url']!="" && $data['client_url']!="A")
								{	
									?>
                                       <span class="single_heading special_italic_medium">
                                        <?php _e($pixia_frontend_options['client_text'], 'pixia'); ?>: 
                                        </span>
                                    	<div style="margin-bottom:6px">
                                        <span class="zero_color_cl">
                                            <?php echo $data['client_url']; ?>
                                        </span>
                                    	</div>
									<?php
								}
							}
							?>
                            <?php 
								$arra=get_the_terms( get_the_ID(),'pirenko_skills' );
								$cats_arr = array("");
								if($arra){
									foreach($arra as $s_cat) {
										array_push($cats_arr,$s_cat->slug);
									}
								}
								if ($pixia_frontend_options['categoriesby_port']=="yes")
								{
									if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
									{
										?>
                                        <span class="single_heading special_italic_medium">
										<?php _e($pixia_frontend_options['skills_text'], 'pixia'); ?>:
                                        </span>
                                            <div style="margin-bottom:6px">
                                            	<span class="zero_color_cl">
                                                	<?php 
                                                    	echo get_the_term_list(get_the_ID(),'pirenko_skills',"","<br />");
                                                   	?>
                                              	</span>
                                          	</div>
										
										<?php
									}
								}
							?>
                            </div>
  
      			</div><!-- /#sidebar -->
                <div class="clearfix"></div>
                <div class="simple_line"></div>
                <div class="padded_text post_meta_single eight columns">
				  <?php 
                      if ($pixia_frontend_options['dateby_port']=="yes")
                      {
                          ?>
                              <div class=" left_floated">
                                  <span class=""><?php echo the_date(); ?></span>
                              </div>
                          	<span class="pir_divider left_floated hide_much_later"></span>
                            <div class="clearfix show_much_later"></div>
                          <?php
                      }
                  ?>
                  <?php
                  if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                  {
                      ?>
                          <div class="left_floated" style="margin-left:-5px;">
                              <div class="tr_wrapper" style="width:22px;z-index:0;">
                                  <div class="submenu_tag pirenko_tinted">
                                      <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                  </div>
                              </div>
                              <div style="margin-left:30px;">                              	
                                  <?php 
                                      echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' );
                                  ?>
                             </div>
                          </div>
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
                              <div class="tr_wrapper" style="z-index:0;height:22px;">
                                  <div class="submenu_speech pirenko_tinted">
                                      <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                  </div>
                              </div>
                              <div class="" style="margin-left:30px;margin-top:1px;">
                                  <span class="">
                                  <?php 
                                      comments_number( '0', '1 ', '%');
                                    ?> 
                                   </span>
                                </div>
                            </div>
                      	</a>
                     <span class="pir_divider left_floated hide_much_later"></span>
                      <div class="clearfix show_much_later"></div>
                      <?php
                  endif;
              ?>
                  <div class="left_floated left_5" style="margin-left:-9px;">
                  <?php echo getPostLikeLink(get_the_ID());?> 
                      </div>
                  </div>
                  <div class="clearfix show_much_later"></div>
                  <div class="four columns">
                  
               <div id="mini_menu">
               <div class="navigation-previous">
                  <div class="portfolio_nav_button">
                      <?php 
					  $divide_count=0;
                      if (previous_post_link_plus( array(
                          'in_same_cat' => false,
                          'format' => '%link',
						  'ex_cats' => '25,26',
                          'link' => '	<div class="prev_link_portfolio">
										  <div class="tr_wrapper zero_index" style="height:20px;">
											  <div class="submenu_arrow_lport pirenko_tinted">
												  <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $darker_inactive_color .'" src="'.get_template_directory_uri() .'/images/icons/arrows.png" />
											  </div>
										  </div>
									  </div>
									  <div class="after_icon">
									  '.$pixia_frontend_options['pprevious_text'].'
									  </div>
                                      '
                          ) ))
                      {
                          $divide_count++;
                      }
                       else
                                {
                                    echo 	'<style type="text/css">
                                  .prev_link_portfolio
                                  {
                                      display:none;
                                  }
                                  </style>';
                                }
                      ?>
                  </div>
              </div><!-- navigation_previous -->
              <span class="pir_divider_dk left_floated"></span>
               <div class="left_floated to_portfolio">
               <?php
				//GET PORTFOLIO PAGE LINK
				$pages_port = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template_portfolio.php'
				)); 
				foreach($pages_port as $page_port)
				{
					//CHECK IF THIS PORTFOLIO PAGE CONTAINS THE CATEGORY CURRENTLY BEING USED
					$data = get_post_meta($page_port->post_id, '_custom_meta_portfolio_template', TRUE);
					if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
					{
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								if (in_array($childs, $cats_arr)) {
									$portfolio_link=get_page_link( $page_port->post_id ); 
								}
								
							}
						}
					}
					else
					{
						$portfolio_link=get_page_link( $page_port->post_id ); 
					}
				}
				$pages_port = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template_portfolio_masonry.php'
				)); 
				foreach($pages_port as $page_port)
				{
					//CHECK IF THIS PORTFOLIO PAGE CONTAINS THE CATEGORY CURRENTLY BEING USED
					$data = get_post_meta($page_port->post_id, '_custom_meta_portfolio_template', TRUE);
					if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
					{
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								if (in_array($childs, $cats_arr)) {
									$portfolio_link_ms=get_page_link( $page_port->post_id ); 
								}
								
							}
						}
					}
					else
					{
						$portfolio_link_ms=get_page_link( $page_port->post_id ); 
					}
				}
			?>
              <a href="<?php if ($portfolio_link!="") echo $portfolio_link; else echo $portfolio_link_ms; ?>">
                  <div class="left_floated">
                  <?php echo $pixia_frontend_options['pportfolio_text']; ?>
                  </div>
              </a>
            </div>
            <span class="pir_divider_dk left_floated"></span>
              <div class="navigation-next">
              <div class="portfolio_nav_button">
                  <?php 
                      if (next_post_link_plus( array(
                      'in_same_cat' => false,
                      'format' => '%link',
                      'link' => '	<div class="next_link_portfolio">
									  <div class="left_floated">
									  '.$pixia_frontend_options['pnext_text'].'
									  </div>
								  </div>
								  <div class="left_floated">
          <div class="tr_wrapper zero_index" style="height:20px;margin-left:-8px;">
										  <div class="submenu_arrow_rport pirenko_tinted">
											  <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $darker_inactive_color .'" src="'.get_template_directory_uri() .'/images/icons/arrows.png" />
										  </div>  
                                          </div>
                                          </div> 
									  '
                      ) ))
                            {
                              $divide_count++;
                            }
                            else
                            {
                                echo 	'<style type="text/css">
                              .navigation-next {
                                  display:none;
                              }
                              </style>';
                            }
                  ?>
              </div>
          </div><!-- navigation_next --> 
                       
		  <?php
          if ($divide_count<2)
                      {
                          echo 	'<style type="text/css">
                              #lw_div
                              {
                                  display:none;
                              }
                              </style>';
                      }
          ?>
                      
                  </div><!-- mini_menu -->
            </div>


            <div class="clearfix"></div>
            </article>
                                    
             <div class="">     		
            <?php 
				if (isset($pixia_frontend_options['related_port']) && $pixia_frontend_options['related_port']=="yes")
				{
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
							<h3><header_font>
								<?php _e($pixia_frontend_options['related_text'], 'pixia'); ?>
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
										$skills_links="";
										$skills_names="";
										$skills_yo="";
										$skills_output="";
										$terms = get_the_terms ($post->ID, 'pirenko_skills');
										if (!empty($terms))
										{
											foreach ($terms as $term) {
												$skills_links[] = $term->slug;
												$skills_names[] = $term->name;
												}
										
											$skills_yo = join(" ", $skills_links);
											$skills_output = join(", ", $skills_names);
										}
										?>
										<li class="related_post <?php echo $p_class; ?>">
											<a href="<?php the_permalink(); ?>">
                                            	<div class="related_fader_grid">
                                            	</div>
                                                <div class="related_single_title">
                                                	<?php the_title(); ?>
                                                    <div class="inner_skills special_italic_medium">
														<?php echo $skills_output; ?>
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
      	</div><!-- /#main -->
      	
    </div><!-- /#content -->
<?php get_footer(); ?>
