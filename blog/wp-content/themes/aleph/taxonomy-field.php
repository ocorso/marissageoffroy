<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /taxonomy-field.php
 * Version of this file : 1.0
 *
 */
?>

<?php get_header(); ?>

<?php 
	// Global query variable
	global $wp_query; 
	// Get taxonomy query object
	$taxonomy_archive_query_obj = $wp_query->get_queried_object();
	// Taxonomy term name
	$taxonomy_term_nice_name = $taxonomy_archive_query_obj->name;
	// Get taxonomy object
	$taxonomy_short_name = $taxonomy_archive_query_obj->taxonomy;
	$taxonomy_raw_obj = get_taxonomy($taxonomy_short_name);
	// You can alternate between these labels: name, singular_name
	$taxonomy_full_name = $taxonomy_raw_obj->labels->name;
?>

			<div id="content" class="clearfix container-fluid template-blog under-level" data-level="none" data-type="post">
			
				<?php 				
					// Close link
					echo "<a href='#' data-rel='".home_url()."' class='SubClose' data-id='".$level_top_id."'><em class='icon-remove icon-white'></em></a>";											
				?>			
			
				<div class="row-fluid clearfix">
			
					<div id="main" class="span12 clearfix" role="main">
					
						<header class="page-header clearfix">
							<h1 class="page-title" itemprop="headline">
								<span><?php echo $taxonomy_full_name; ?> :</span> <?php echo $taxonomy_term_nice_name; ?>
							</h1>							
						</header> <!-- end .page-header -->
							
						<div class="loading"></div>
				
						<section class="loop_content clearfix">
	
							<?php global $query_string;		
								  query_posts($query_string .'&post_type=portfolio');							
					 			  if (have_posts()) : while(have_posts()) : the_post();								
							?>
							
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
															<?php echo get_the_term_list( get_the_ID(), 'field', '',', ',''); ?>
															
															// 
															
															<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('j.m.Y'); ?></time>
														</p><!-- end .meta -->
														
														<?php the_excerpt(); ?>
																			
													</div><!-- end .span8 -->
													
													<div class="span4 utility clearfix">
														<?php echo getPostLikeLinkinTb(get_the_ID()); ?>	
													</div><!-- end .utility -->
												
												</div><!-- end .row-fluid -->
												
											</div><!-- end .span7 -->
																				
										</div><!-- end .row-fluid -->				
									</article> <!-- end article -->	
						
								<?php endwhile; ?>	
							
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
								</article><!-- end #post-not-found -->
							
							<?php endif; wp_reset_query(); ?>
				
						</section><!-- end .loop-content -->
						
					</div> <!-- end #main -->
    			
    			</div><!-- end .row-fluid -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>