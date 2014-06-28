<?php 
/*
Template Name: Fullscreen Slider
*/
?>
<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	?>
	<!-- SCRIPT TO AVOID FLICKERING - SCROLLBAR -->
    <style type="text/css">
	body
	{
		overflow-x:hidden;
	}
	#full-screen-background-image {
		margin-left:265px;	
	}
	</style>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_0">
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_0 homepage_sl" role="main">
        <?php
			//HOMEPAGE SLIDER MANAGMENT
			$inside_filter="";
			$autoplay_homepage="no";
			$delay_homepage="6000";
			$data = get_post_meta( $post->ID, '_custom_meta_homepage_template', true );
			if (!empty($data))
			{
				if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
				{
					$cats_counter=0;
					$in_flag=false;
					foreach ($data as $childs)
					{
						//ADD THE CATEGORIES TO THE FILTER
						if ($in_flag==true)
						{
							$inside_filter.=$childs.", ";
							$cats_counter++;
						}
						if ($childs=='weirdostf')
							$in_flag=true;
					}
				}
				if (isset($data['pixia_full_slide']))
					$autoplay_homepage=$data['pixia_full_slide'];
				if (isset($data['pixia_full_delay']) && $data['pixia_full_delay']!="")
					$delay_homepage=$data['pixia_full_delay'];
			}
			$args=array(	'post_type' => 'pirenko_slides',
							'showposts' => 99,
							'pirenko_slide_set' => $inside_filter
						);
			$loop = new WP_Query( $args );
			$slide_number=0;
			?>
			<div id="home_slider" class="flexslider boxed_shadow">
				<ul class="slides" style="overflow:hidden;" data-autoplay="<?php echo $autoplay_homepage; ?>" data-delay="<?php echo $delay_homepage; ?>">
					<?php
						while ( $loop->have_posts() ) : $loop->the_post(); ?>				
							<?php $use_txt = get_post_meta(get_the_ID(), "pixia_slide_txt", true);
								 $h_align = get_post_meta(get_the_ID(), "pixia_slide_txt_horz", true);
								 $v_align = get_post_meta(get_the_ID(), "pixia_slide_txt_vert", true);
								 $pos_class="sld_".$h_align." "."sld_".$v_align;
								 if (has_post_thumbnail( $post->ID ) ):
								 
								//GET THE FEATURED IMAGE
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );	
									else :
										//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
										$container="".get_bloginfo('template_directory')."/images/sample_home.jpg";
										$image[0]=get_image_path($container);
									endif; 
									?>
									<li id="pixia_slide_<?php echo $slide_number; ?>">
										<?php
											if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
											{
												?>
												<a href="<?php echo get_post_meta(get_the_ID(), "pixia_slide_url", true); ?>" target="<?php echo get_post_meta(get_the_ID(), "pixia_slide_wdw", true); ?>">
												<?php
											}
										
											if (!isset($use_txt))
												$use_txt=1;
											if (get_the_title()=="" || $use_txt==0)
											{
												$sl_title="&nbsp;";
												$title_class="inv_el";
											}
											else
											{
												$sl_title=get_the_title();
												$title_class="";
											}
											if (get_the_content()=="" || $use_txt==0)
											{
												$sl_body="&nbsp;";
												$body_class="inv_el";
											}
											else
											{
												$sl_body=get_the_content();
												$body_class="";
											}
											if (get_post_meta(get_the_ID(), "pixia_slide_video", true)=="")
											{
												if ($use_txt==1)
												{
													?>
													<div class="slider_text_holder <?php echo ($pos_class); ?>">
														<div id="pixia_slidetop_<?php echo $slide_number; ?>" class="headings_top <?php echo $title_class; ?>" >
														<h1 style="color:<?php echo get_post_meta(get_the_ID(), "pixia_slide_header_color", true); ?>"><?php echo $sl_title; ?></h1>
														</div>
														<div id="pixia_slidebody_<?php echo $slide_number; ?>" class="headings_body <?php echo $body_class; ?>" style="color:<?php echo get_post_meta(get_the_ID(), "pixia_slide_body_color", true); ?>">
															<?php echo $sl_body; ?>
														</div>
                                                        <div class="clearfix"></div>
													</div>
													<?php 
												}
												$vt_image = vt_resize( '', $image[0] , 0, 0, true ); 
												?>
												<img src="<?php echo ($image[0]); ?>" or_w="<?php echo $vt_image['width']; ?>" or_h="<?php echo $vt_image['height']; ?>">
												<?php
											}
										else
										{
											if ($use_txt==1)
											{
											//IT's A VIDEO SLIDE
											?>
											<div class="slider_text_holder <?php echo ($pos_class); ?>">
												<div id="pixia_slidetop_<?php echo $slide_number; ?>" class="headings_top slide_video <?php echo $title_class; ?>">
												<h1 style="color:<?php echo get_post_meta(get_the_ID(), "pixia_slide_header_color", true); ?>"><?php echo $sl_title; ?></h1>
												</div>
												<div id="pixia_slidebody_<?php echo $slide_number; ?>" class="headings_body <?php echo $body_class; ?>" style="color:<?php echo get_post_meta(get_the_ID(), "pixia_slide_body_color", true); ?>">
													<?php echo $sl_body; ?>
												</div>
                                                <div class="clearfix"></div>
											</div>
											<?php
											}
											echo (get_post_meta(get_the_ID(), "pixia_slide_video", true));
										}
										if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
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
							<li class="colored_bg" >
								<span class="colored_bg" style="padding-top:40%;height:1500px;text-align:center;display: block;"><h2>Ooops!</h2><br /><h4>The slider is on, but there are still no slides to display.</h4><br />Add some Slides from the Wordpress Dashboard by clicking the respective button on the left menu.<br /></span>
							</li> 
							<?php
						}
						?>
				 
				</ul><!-- slides -->
			</div><!-- flexslider home_slider -->
      </div><!-- /#main -->
    <?php pirenko_main_after(); ?>
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