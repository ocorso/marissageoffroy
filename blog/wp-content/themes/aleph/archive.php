<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /archive.php
 * Version of this file : 1.4
 *
 */
?>

<?php get_header(); ?>
			<div id="content" class="clearfix container-fluid template-blog under-level" data-level="none" data-type="post">
			
				<?php 				
					// Close link
					echo "<a href='#' data-rel='".home_url()."' class='SubClose' data-id='".$level_top_id."'><em class='icon-remove icon-white'></em></a>";											
				?>			
			
				<div class="row-fluid clearfix">
			
					<div id="main" class="span12 clearfix" role="main">
					
						<header class="page-header clearfix">
							<?php if (is_category()) { ?>
								<h1 class="page-title" itemprop="headline">
									<span><?php _e("Category :", "alephtheme"); ?></span> <?php single_cat_title(); ?>
								</h1>
							<?php } elseif (is_tag()) { ?> 
								<h1 class="page-title" itemprop="headline">
									<span><?php _e("Tag :", "alephtheme"); ?></span> <?php single_tag_title(); ?>
								</h1>
							<?php } elseif (is_author()) { ?>
								<h1 class="page-title" itemprop="headline">
									<span><?php _e("Author :", "alephtheme"); ?></span> 
									<?php 
										$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
										$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
										if ( $google_profile ) {
											echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>'; 
										} else {
											echo get_the_author_meta('display_name', $curauth->ID);
										}
									?>
								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="page-title" itemprop="headline">
									<span><?php _e("Daily Archives :", "alephtheme"); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>
							<?php } elseif (is_month()) { ?>
							    <h1 class="page-title" itemprop="headline">
							    	<span><?php _e("Monthly Archives :", "alephtheme"); ?></span> <?php the_time('F Y'); ?>
							    </h1>
							<?php } elseif (is_year()) { ?>
							   <h1 class="page-title" itemprop="headline">
							    	<span><?php _e("Yearly Archives :", "alephtheme"); ?></span> <?php the_time('Y'); ?>
							    </h1>
							<?php } ?>
						</header> <!-- end .page-header -->
							
						<div class="loading"></div>
				
						<section class="loop_content clearfix">
	
							<?php 
								$grid = ($_GET['grid']) ? $_GET['grid'] : "1";
								
								$i=0;
								switch($grid) {
									case "2" : 
										$span="span6";										
										break;
									case "3" : 
										$span="span4";											
										break;
									case "4" :
										$span="span3";										
										break;	
									default :
										break;									
								}		
								
													
								if (have_posts()) : while (have_posts()) : the_post(); 
							?>
							
										<?php if($grid!="1") {?>
											<?php if($i%$grid==0) { ?>
												<div class="row-fluid clearfix post blog_grid">												
											<?php } ?>
												<div class="<?php echo $span; ?>">	
									
													<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">											
														<div class="row-fluid clearfix">
															<div class="img-container span9">														
																<?php 
																	if(has_post_thumbnail()) { 
																		the_post_thumbnail('portfolio-thumb'); 
																	} else {
																		echo "&nbsp;";
																	}		
																?>																											
															</div><!-- end .img-container -->										
															<div class="span3 clearfix">
																<div class="utility clearfix">
																	<a href="<?php comments_link(); ?>" class="btn-rdd comments ttip" title="<?php comments_number('' . __("No","alephtheme") . '' . __(" comments","alephtheme") . '', '' . __("1","alephtheme") . '' . __(" comment","alephtheme") . '', '%' . __(" comments","alephtheme") );?>"><em class="icon-comment"></em></a>
																	<?php echo getPostLikeLinkinTb(get_the_ID()); ?>
																</div>	
															</div>	
														</div>	
														<div class="row-fluid clearfix">													
															<div class="span12">															
																<h3 class="entry-title clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>		
																<?php the_excerpt(); ?>		
																
																<p class="meta clearfix">
																
																	<small><?php _e("in", "alephtheme"); ?></small>
																	<?php the_category(', '); ?>
																	
																	// 
																	
																	<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('j.m.Y'); ?></time>
																</p>																		
															</div><!-- end .span8 -->													
														</div><!-- end .row-fluid -->	
													</article> <!-- end article -->																							
												</div>	
										<?php if($i%$grid==($grid-1)) { ?>								
											</div><!-- end .row-fluid.post -->
										<?php } ?>	
									<?php } else { ?>		
										<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
											<div class="row-fluid clearfix post">	
								
												<section class="img-container span5">
												
													<?php 
														if(has_post_thumbnail()) { 
															the_post_thumbnail('portfolio-thumb'); 
														} else {
															echo "&nbsp;";
														}		
													?>												
													
												</section><!-- end .img-container -->
								
												<div class="span7 clearfix">
												
													<div class="row-fluid clearfix">
													
														<div class="span8">
															
															<h3 class="entry-title clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>										

															<p class="meta clearfix">
																<small><?php _e("in", "alephtheme"); ?></small>
																<?php the_category(', '); ?>
																
																// 
																
																<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('j.m.Y'); ?></time>
															</p>
															
															<?php the_excerpt(); ?>
																				
														</div><!-- end .span8 -->
														
														<div class="span4 utility clearfix">
															<a href="<?php comments_link(); ?>" class="btn-rdd comments ttip" title="<?php comments_number('' . __("No","alephtheme") . '' . __(" comments","alephtheme") . '', '' . __("1","alephtheme") . '' . __(" comment","alephtheme") . '', '%' . __(" comments","alephtheme") );?>"><em class="icon-comment"></em></a>
															<?php echo getPostLikeLinkinTb(get_the_ID()); ?>	
														</div><!-- end .utility -->
													
													</div><!-- end .row-fluid -->
													
												</div><!-- end .span7 -->
																					
											</div><!-- end .row-fluid.post -->
							
										</article> <!-- end article -->													
									<?php } ?>
									<hr class="hidden-desktop">	
						
								<?php 
									$i++; 
									endwhile; 									
									if($grid!="1" && $i%$grid!=0) {
										echo '</div>';
									}
								?>	
						
									<?php  if(show_posts_nav()) {	 ?>									
										<div class="clear"></div>
										<div class="row-fluid clearfix">
											<footer class="span12 page-footer clearfix">	
												<nav class="archive-nav clearfix">
													<ul class="pager clearfix">
														<li class="prev"><?php echo get_next_posts_link('<em class="icon-chevron-left icon-white"></em> Older Entries'); ?></li>
														<li class="next"><?php echo get_previous_posts_link('Newer Entries <em class="icon-chevron-right icon-white"></em>'); ?></li>
													</ul>
												</nav><!-- end .archive-nav -->
											</footer><!-- end .page-footer -->
										</div><!-- end .row-fluid -->
									<?php } else { ?>
										<footer class="page-footer no-nav clearfix"></footer><!-- end .page-footer.no-nav -->
									<?php } ?>
						
							<?php else : ?>
							
								<article id="post-not-found" class="clearfix">
									<header>
										<h1><?php _e("No Posts Yet", "alephtheme"); ?></h1>
									</header>
									<section class="post_content">
										<p><?php _e("Sorry, What you were looking for is not here.", "alephtheme"); ?></p>
									</section>
									<footer>
									</footer>
								</article><!-- end #page-not-found -->
							
							<?php endif; ?>
				
						</section><!-- end .loop_content -->
						
					</div> <!-- end #main -->
    			
    			</div><!-- end .row-fluid -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>