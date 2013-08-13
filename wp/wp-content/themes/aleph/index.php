<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /index.php
 * Version of this file : 1.0
 *
 */
?>

<?php get_header(); ?>
			<div id="content" class="clearfix container-fluid template-blog" data-level="none" data-type="post">
			
				<?php 				
					// Close link
					echo "<a href='#' data-rel='".home_url()."' class='SubClose' data-id='".$level_top_id."'><em class='icon-remove icon-white'></em></a>";							
				?>			
			
				<div class="row-fluid clearfix">
			
					<div id="main" class="span12 clearfix" role="main">
					
						<header class="page-header clearfix">
						</header> <!-- end .page-header -->
							
						<div class="loading"></div>
				
						<section class="loop_content clearfix">
	
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
									<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
										<div class="row-fluid post clearfix">	
							
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
															<small>in</small>
															<?php the_category(', '); ?>
															
															// 
															
															<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('j.m.Y'); ?></time>
														</p><!-- end .meta -->
														
														<?php the_excerpt(); ?>
																			
													</div><!-- end .span8 -->
													
													<div class="span4 utility clearfix">
														<a href="<?php comments_link(); ?>" class="btn-rdd comments ttip" title="<?php comments_number('' . __("No","alephtheme") . '' . __(" comments","alephtheme") . '', '' . __("1","alephtheme") . '' . __(" comment","alephtheme") . '', '%' . __(" comments","alephtheme") );?>"><em class="icon-comment icon-white"></em></a>
														<?php echo getPostLikeLinkinTb(get_the_ID()); ?>	
													</div><!-- end .utility -->
												
												</div><!-- end .row-fluid -->
												
											</div><!-- end .span7 -->
																				
										</div><!-- end .post -->				
									</article> <!-- end article -->	
						
								<?php endwhile; ?>	
						
									<?php  if(show_posts_nav()) {	 ?>									
										<div class="spacer clear"></div>
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