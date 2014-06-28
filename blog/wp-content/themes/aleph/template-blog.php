<?php
/*
Template Name: Blog
*/

/**
 *
 * Aleph - Premium Theme for WordPress
 *
 * Template used to display a blog
 * /template-blog.php
 * Version of this file : 1.4
 *
 */
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix container-fluid template-blog <?php $level=get_post_meta($post->ID,'level','true'); if(!isset($level) || $level=="") { $level="none"; } if($level!="top") { echo "under-level"; } ?>" data-level="<?php echo $level; ?><?php if($level=='sub') { echo '_page';} ?>"  data-type="post">
				<?php 
					// Custom background
					custom_bg($post->ID);
					 						
					// Additional links		
					var_nav($post->ID,$level,'page');	
				?>					
			
				<div class="row-fluid clearfix">	
			
					<div id="main" class="span12 clearfix" role="main">
					
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">														
							<header class="page-header clearfix ">
								
								<h1 class="page-title"><?php the_title(); ?></h1>
							
							</header> <!-- end .page-header -->	
							
	 						<div class="clearfix">
								<?php
									$grid=get_post_meta($post->ID,'post_per_row',true);
									
									if(get_post_meta($post->ID,'blog_filter',true)=="on" && get_post_meta($post->ID,'blog_tax_specific',true)!="on") {				
										$reset_link=get_page_link();							    
						    			$link="#";
						    			$terms = get_terms("category");
		 								$count = count($terms);
		 								if ( $count > 0 ){
					    		?>				
											<ul id="blog_categories" class="nav nav-pills custom-dropdown" name="blog_categories">
												<li><a href="#" data-rel="<?php echo $reset_link; ?>?grid=<?php echo $grid; ?>" title="View all categories" class="ttip blog-reset active"><em class="icon-refresh icon-white"></em></a></li>
												<li class="dropdown clearfix" id="menu1">
													<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
														<?php _e("Categories", "alephtheme"); ?>
														<em class="icon-chevron-down icon-white pull-right"></em>
													</a>
													<ul class="dropdown-menu">
													<?php
														foreach ( $terms as $term ) {
															$link=get_bloginfo('url')."/category/".$term->slug."";
															echo "<li><a href='' data-rel='".$link."?grid=".$grid."'>".$term->name."<span class='count'>".$term->count."</span></a></li>";
														}
													?>
													</ul><!-- end .dropdown-menu -->
												</li><!-- end #menu1 -->
											</ul><!-- end #blog_categories -->
								<?php
										}								
									}
								?>	 						
	 						</div><!-- end .clearfix -->
							
							<div class="loading"></div>
							
							<section class="loop_content clearfix">
								
								<?php	
									$temp = $wp_query;
									$wp_query= null;
									$wp_query = new WP_Query();
									
									if(get_post_meta($post->ID,'blog_tax_specific',true)!="on") {
										$args = array(
												'post_type'=>array('post'),
									 			'orderby'=>'date',
									 			'order'=>'DSC',
									 			'ignore_sticky_posts' => 1,
									 			'paged' => $paged
									 			);								
									} else {
										$args = array(
												'post_type'=>array('post'),
									 			'orderby'=>'date',
									 			'order'=>'DSC',
									 			'ignore_sticky_posts' => 1,
									 			'paged' => $paged,
									 			'tax_query' => array(
									 				array(
														'taxonomy' => 'category',
														'field' => 'id',
														'terms' => get_post_meta($post->ID,'blog_tax',true)
									 				)
									 			)
										);
									}
									$wp_query->query($args);											
							
									$i=0;
									switch($grid) {
										case "1" : 
											break;
										case "2" : 
											$span="span6";										
											break;
										case "3" : 
											$span="span4";											
											break;
										case "4" :
											$span="span3";										
											break;										
									}
									while ($wp_query->have_posts()) : $wp_query->the_post();
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
																			the_post_thumbnail('portfolio-thumbnail'); 
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
										<footer class="page-footer no-nav"></footer><!-- end .page-footer.no-nav -->
									<?php } ?>
									
								<?php
									$wp_query = null; $wp_query = $temp;
									wp_reset_query();
								?>			
						
							</section> <!-- end .loop_content -->							
						
						</article> <!-- end article -->
				
					</div> <!-- end #main -->
    
    			</div><!-- end .row-fluid -->
    			
			</div> <!-- end #content -->

<?php get_footer(); ?>