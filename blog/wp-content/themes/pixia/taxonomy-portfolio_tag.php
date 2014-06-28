<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	$portfolio_link="HACK";
?>
	<!-- SCRIPT TO AVOID FLICKERING - QUICKSAND SCROLLBAR -->
    <style type="text/css">
	html,body
	{
		height:100.1%;
	}
	</style>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_0">
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_0 foliopage_sl" role="main">
        <?php 
			$make_bw="no";
			$make_lbox="no";
		//APPLY FILTERS FOR CATEGORY IF NEEDED
		$tagname = get_query_var('tag');
		//APPLY FILTERS FOR TAG IF NEEDED
		if ($tagname!="")
			$tag_selector=$tagname;
		else
			$tag_selector="";
		$my_query = new WP_Query();
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		$args = array( 
						'post_type' => 'pirenko_portfolios', 
						'portfolio_tag'=>$term->slug,
						'posts_per_page'=>999
					);
		$my_query->query($args);
        if ($my_query->have_posts()) : 
						$ins=0;
						echo "<div id=\"folio_classic\">";
							while ($my_query->have_posts()) : $my_query->the_post(); 
							$skills_links="";
								$skills_names="";
							$terms = get_the_terms ($post->ID, 'pirenko_skills');
    foreach ($terms as $term) {
        $skills_links[] = $term->slug;
		$skills_names[] = $term->name;
        }

    $skills_yo = join(" ", $skills_links);
	$skills_output = join(", ", $skills_names);
							?>
						<div id="post-<?php the_ID(); ?>" class="portfolio_entry_li boxed_shadow <?php echo $term->slug; ?> p_all" data-id="id-<?php echo $ins; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$image[0] = get_image_path($image[0]);
								$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								
							else :
								//THERE'S NO FEATURED IMAGE
							endif; ?>
								
						<a href="<?php if ($make_lbox=="no"){the_permalink();}else{echo $p_photo_image[0];} ?>" rel="<?php if ($make_lbox=="yes"){echo 'prettyPhoto[pp_gal]';} ?>" class="">
								<div class="grid_image_wrapper">
                                	<div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                             			<span><?php the_title(); ?></span>
                                        <div class="divider_grid"></div>
                                        <div class="inner_skills special_italic_medium">
											<?php echo $skills_output; ?>
                                       	</div>
                          			</div><!-- home_post_title_grid -->
                                <?php $data = get_post_meta( $post->ID, '_custom_meta', true );
								if (!isset($data['skip_featured']))
									$data['skip_featured']=0;
								
								?>
                                	<div class="grid_colored_block">
									</div>
                                  
                                    
									<?php 
                                    if (has_post_thumbnail( $post->ID ) )
                                    {
										if ($make_bw=="no")
										{
											$vt_image = vt_resize( '', $image[0] , 480, 300, true );
											?>
											<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
											<?php
										}
										else
										{
											?>
											<img src="<?php echo get_template_directory_uri(); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=480&h=300&f=2" class="custom-img grid_image<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
											<?php
										}
                                    }
                                    ?>
                                </div>
                                </a>
							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div>";
					?>
                    
				<?php else : ?>
					<h2>Not Found</h2>
				<?php endif; 
        ?>
      	</div><!-- /#main -->
	</div><!-- /#content -->
<?php get_footer(); ?>