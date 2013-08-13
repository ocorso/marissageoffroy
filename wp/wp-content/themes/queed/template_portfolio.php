<?php 
/*
Template Name: Portfolio Page
*/
?>
<?php get_header(); ?>
	<!-- SCRIPT TO AVOID FLICKERING - QUICKSAND SCROLLBAR -->
    <style type="text/css">
	html,body
	{
		height:100.1%;
	}
	</style>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?>" role="main">
        	<div class="page-header">
        		<h1>
                <?php
                  	//$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    the_title();
                ?>
             	</h1>
				<?php 
					while (have_posts()) : the_post();
                   		the_content();
                	endwhile; /* End loop */ 
				?>
                <?php
					if (!isset($queed_frontend_options['all_text']))
						$queed_frontend_options['all_text']='All';
					$inside_filter="";
					$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
					if (!empty($data))
					{
						
						if (isset($data['queed_filter']) && $data['queed_filter']=="yes")
						{
							$cats_counter=0;
							foreach ($data as $childs)
							{
								//ADD THE CATEGORIES TO THE FILTER
								if ($childs!='yes')
								{
									$inside_filter.=$childs.", ";
									$cats_counter++;
								}
							}
							if ($cats_counter>1)
							{
								?>
                                <div id="pir_categories" class="cf">
                                    
                                            <ul class="filter clearfix theme_tags">
                                                <li class="active">
                                                    <a class="all" href="javascript:void(0)"><?php echo $queed_frontend_options['all_text']; ?></a>
                                                </li>
                                            <?php
                                            foreach ($data as $childs)
                                            {
												if ($childs!='yes') {
													$arra=get_term_by('slug', $childs, 'pirenko_skills');
                                                	echo '<li class="capitalized"><a class="'.$childs.'"href="javascript:void(0)">'.$arra->name.'</a></li>';
												}
                                            }
                                            echo "</ul>";
                                    ?>
                                </div><!--pir_categories-->
                                <?php
							}
						}
						else
						{
							?>
							<div id="pir_categories" class="cf">
								<?php 
									$terms = get_terms("pirenko_skills");
									$count = count($terms);
									if ( $count > 0 )
									{
										?>
										<ul class="filter clearfix theme_tags">
											<li class="active">
												<a class="all" href="javascript:void(0)"><?php echo $queed_frontend_options['all_text']; ?></a>
											</li>
										<?php
										foreach ( $terms as $term ) 
										{
											echo '<li><a class="'.$term->slug.'"href="javascript:void(0)">'.$term->name.'</a></li>';
										}
										echo "</ul>";
									}
								?>
							</div><!--pir_categories-->
							<?php
						}
					}
					else
					{
						?>
							<div id="pir_categories" class="cf">
								<?php 
									$terms = get_terms("pirenko_skills");
									$count = count($terms);
									if ( $count > 0 )
									{
										?>
										<ul class="filter clearfix theme_tags">
											<li class="active">
												<a class="all" href="javascript:void(0)"><?php echo $queed_frontend_options['all_text']; ?></a>
											</li>
										<?php
										foreach ( $terms as $term ) 
										{
											echo '<li><a class="'.$term->slug.'"href="javascript:void(0)">'.$term->name.'</a></li>';
										}
										echo "</ul>";
									}
								?>
							</div><!--pir_categories-->
							<?php
						}
				?>
        	</div>
        <?php 
		$my_query = new WP_Query();
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'paged' => get_query_var( 'paged' ),
			'posts_per_page' => 999,
			//'orderby' => 'rand',
			'pirenko_skills'=>$inside_filter
			);
			//'category_name'=>$cat_selector,
		$my_query->query($args);
        if ($my_query->have_posts()) : 
						$ins=0;
						echo "<ul class=\"filterable-grid cf\">";
							while ($my_query->have_posts()) : $my_query->the_post(); 
						
							?>
						<li id="post-<?php the_ID(); ?>" class="portfolio_entry_li portfolio_entry_li-sixth cf boxed_shadow" data-type="<?php $skills_links="";
							$terms = get_the_terms ($post->ID, 'pirenko_skills');
    foreach ($terms as $term) {
        $skills_links[] = $term->slug;
        }

    $skills_yo = join(" ", $skills_links);
    ?>

    <?php echo $skills_yo; ?>" data-id="id-<?php echo $ins; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$image[0] = get_image_path($image[0]);
								$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								
							else :
								//THERE'S NO FEATURED IMAGE
							endif; ?>
								
                                <div class="grid_colored_block">
                                    <div class="home_folio_title_grid">
                                        <h4>
                                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                        </h4>
                                    </div>
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
								<div class="">
               <?php $data = get_post_meta( $post->ID, '_custom_meta', true );
								if (!isset($data['skip_featured']))
									$data['skip_featured']=0;
								if ($data['skip_featured']!=1 || $data['skip_featured']=="")
								{
									?>
									<a href="<?php echo $p_photo_image[0]; ?>" rel="prettyPhoto[pp_gal]" class="lightbox_btn"></a>
									<?php
								}
								else
								{
									//CHECK IF THERE'S A SECOND IMAGE
									if (!isset($data['image_2']))
									{
										?>
										<a href="<?php echo $p_photo_image[0]; ?>" rel="prettyPhoto[pp_gal]" class="lightbox_btn"></a>
										<?php
									}
									else
									{
										//CHECK IF IT'S AN IMAGE OR A VIDEO
										if (substr($data['image_2'],0,6)=="http:/")
										{
											?>
											<a href="<?php echo $data['image_2']; ?>" rel="prettyPhoto[pp_gal]" class="lightbox_btn"></a>
											<?php
										}
										else
										{
											$doc=new DOMDocument();
											$doc->loadHTML($data['image_2']);
											$xml=simplexml_import_dom($doc); // just to make xpath more simple
											$iframes=$xml->xpath('//iframe');
											foreach ($iframes as $iframe) 
											{
												//FIX STRING FOR VIMEO ON LIGHTBOX
												$iframe['src']=str_replace("player.vimeo.com/video","vimeo.com",$iframe['src']);
											}
											?>
											<a href="<?php echo $iframe['src']."?iframe=true&width=".$iframe['width']."&height=".$iframe['height']; ?>" rel="prettyPhoto[pp_gal]" class="lightbox_btn" style="background-position:-64px -40px !important;"></a>
											<?php
										}
									}
								}
								?>
                                	
                                    <a href="<?php the_permalink() ?>" class="readmore_btn"></a>
                                    
									<?php 
                                    if (has_post_thumbnail( $post->ID ) )
                                    {
										if ($queed_frontend_options['portfolio_bw']=="no")
										{
											$vt_image = vt_resize( '', $image[0] , 234, 234, true );
											?>
											<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
											<?php
										}
										else
										{
											?>
											<img src="<?php bloginfo('template_directory'); ?>/inc/plugins/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=234&h=234&f=2" class="custom-img grid_image<?php if ($queed_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
											<?php
										}
                                    }
                                    ?>
                                </div>
							</li>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</ul>";
					?>
                    
				<?php else : ?>
					<h2>Not Found</h2>
				<?php endif; 
        ?>
      	</div><!-- /#main -->
	</div><!-- /#content -->
<?php get_footer(); ?>