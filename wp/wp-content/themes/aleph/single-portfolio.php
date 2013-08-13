<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /single-portfolio.php
 * Version of this file : 1.7
 *
 */
?>

<?php get_header(); ?>


				<?php

					// Layout builder
					$layout = str_replace(".png","",get_post_meta($post->ID,"layout",true));
					if($layout=="") { $layout="left"; }
					switch($layout) {
						case "left" :
							$layout_args=array('span4','span8 clearfix',"","false","under-level");
							break;
						case "right" :
							$layout_args=array('span4','span8 clearfix',"","false","under-level");
							break;
						case "top" :
							$layout_args=array('span12 clearfix','span12 slider-limited clearfix',"","true","under-level");
							break;
						case "full" :
							$layout_args=array('span12 clearfix','span12 clearfix',"","true","home-full-slider");
							break;
					}

					function portfolio_content($layout_args) {
						global $data, $post;
						if($layout_args[3]=="true") {
							echo '<div class="row-fluid clearfix">';
						}
						echo '<div class="'.$layout_args[0].'">';
							echo '<header class="clearfix">';
								if($layout_args[3]=="true") {
									echo '<div class="row-fluid clearfix utility-ls">';
								}
									echo '<p class="meta single-post clearfix">';
										echo get_the_term_list( get_the_ID(), 'field', '',', ','');
									echo '</p>';
										utility_ls($post->ID);
								if($layout_args[3]=="true") {
									echo '</div>';
								}

							echo '</header>';
							echo  '<section class="post_content clearfix" itemprop="articleBody">';
										the_content();
							echo  '</section>';
						echo  '</div>';
						if($layout_args[3]=="true") {
							echo '</div>';
						}
					}
					function portfolio_media($layout_args,$id) {
						global $layout;
						if($layout_args[3]=="true") {
							echo '<div class="row-fluid clearfix">';
						}
						echo '<div class="media '.$layout_args[1].'">';
							if($layout == "left") {
								echo '<hr class="hidden-desktop">';
							}
								  	$media=get_post_meta($id,'media_display','true');
									if($media=="image_single") {
										echo showfeaturedimage (get_the_ID(),false);
									} elseif ($media=="image_stack") {
										$images = get_children( array(
															'post_parent' => get_the_ID(),
															'post_status' => 'inherit',
															'post_type' => 'attachment',
															'post_mime_type' => 'image',
															'order' => 'ASC',
															'orderby' => 'menu_order' )
															);

										if ( $images ) {
											foreach ( $images as $id => $image ) {
												$attatchmentID = $image->ID;
												$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
												$imageURI = $imagearray[0];
												$imageID = get_post($attatchmentID);
												$imageTitle = $imageID->post_title;
														 echo showimage (
															$imageURI,
															$link_url="",
															$imageTitle=$imageTitle
															);
											}
										}
									} elseif ($media=="slider") {
										$slider_layout="none";
										$slider_layout=str_replace(" ","",strtolower(get_post_meta($id,'slider_layout','true')));
										$resize="width";
										$resize=strtolower(get_post_meta($id,'slider_resize','true'));

										echo efs_get_slider($resize,$slider_layout);
									} elseif($media=="video") {
										$id_v=get_post_meta($id,'project_video','true');
										$site=get_post_meta($id,'project_video_site','true');
										echo get_vid_sc($site, $id_v);

									}
							if($layout == "right" && $media=="slider") {
								echo '<hr class="hidden-desktop after-slider">';
							}
						echo '</div>';
						if($layout_args[3]=="true") {
							echo '</div>';
						}
					}

				?>

			<div id="content" class="clearfix container-fluid <?php echo $layout_args[4]; ?>" data-level="sub_post">

				<?php
					// Custom background
					custom_bg($post->ID);

					// Additional links
					var_nav($post->ID,'sub','portfolio');
				?>

				<div class="row-fluid clearfix">

					<div id="main" class="span12 clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<?php if($layout != "full") { ?>
								<header class="page-header clearfix">
									<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
								</header><!-- end .page-header -->

								<div class="row-fluid clearfix">
									<?php
										if($layout=="top" || $layout=="right") {
											portfolio_media($layout_args,$post->ID);
											portfolio_content($layout_args);
										} elseif($layout=="left") {
											portfolio_content($layout_args);
											portfolio_media($layout_args,$post->ID);
										}
									?>

								</div><!-- end .row-fluid -->

							<?php } else { ?>

								<?php
									$images = get_children( array(
														'post_parent' => get_the_ID(),
														'post_status' => 'inherit',
														'post_type' => 'attachment',
														'post_mime_type' => 'image',
														'order' => 'ASC',
														'orderby' => 'menu_order' )
														);

									// If there are slides
									if ( $images ) {
								?>
										<div id="portfolioFS" class="flexslider clearfix">
											<ul class="slides clearfix">
												<?php
													foreach ( $images as $id => $image ) {

														$attatchmentID = $image->ID;
														$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
														$imageurl = $imagearray[0];
														$imageID = get_post($attatchmentID);
												?>
														<li><div class="slide-media" style="background-image:url(<?php echo $imageurl; ?>);"></div></li>
												<?php
													}
												?>
											</ul>
							  				<div class="info-container">
												<a href="#portfolio-overlay" class="fancybox info-link"><em>i</em></a>
											</div>
										</div>
								<?php
									}
								?>
								<div id="portfolio-overlay">
									<div class="container-fluid clearfix">
										<div class="row-fluid clearfix">
											<header class="page-header clearfix">
												<h2 class="single-title" itemprop="headline"><?php the_title(); ?></h2>
											</header><!-- end .page-header -->
											<?php portfolio_content($layout_args); ?>
										</div>
									</div>
								</div>

							<?php } ?>

						</article> <!-- end article -->

						<?php endwhile; ?>

						<?php else : ?>

						<article id="post-not-found" class="clearfix">
						    <header>
						    	<h1><?php _e("Not Found", "alephtheme"); ?></h1>
						    </header>
						    <section class="post_content">
						    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "alephtheme"); ?></p>
						    </section>
						    <footer>
						    </footer>
						</article><!-- end #post-not-found -->

						<?php endif; ?>

					</div> <!-- end #main -->

				</div><!-- end .row-fluid -->

			</div> <!-- end #content -->

<?php get_footer(); ?>