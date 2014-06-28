<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /single.php
 * Version of this file : 1.2
 *
 */
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix container-fluid under-level" data-level="sub_post">
			
				<?php 
					// Custom background
					custom_bg($post->ID);
											
					// Additional links		
					var_nav($post->ID,'sub','post');
				?>
						
				<div class="row-fluid clearfix">	
						
					<div id="main" class="span12 clearfix" role="main">
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							
							<header class="page-header clearfix">
								<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
							</header><!-- end .page-header -->
									
							<div class="row-fluid clearfix">
								<div class="span8">	
									<?php if(has_post_thumbnail()) { ?>
										<div class="post-thumb">				
											<?php the_post_thumbnail('full'); ?>
										</div><!-- end .post-thumb -->
									<?php } ?>
									<section class="post_content clearfix" itemprop="articleBody">
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>						
									</section> <!-- end .post_content -->
								</div><!-- end .span8 -->
								<div class="span4 sidebar clearfix">	
									<hr class="hidden-desktop">	
									<p class="meta single-post clearfix">
										// <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('j.m.Y'); ?></time>
										<br/>
										<small>posted in</small> <?php the_category(', '); ?>
										<br/>
										<?php the_tags('' . __("tagged ","alephtheme") . '', ', ', ''); ?>
									</p><!-- end .meta.single-post -->
									
									<?php utility_ls($post->ID); ?>
									
									<div class="comment-box clearfix">	
										<div class="box-top clearfix">
    										<em class="icon-comment"></em> <?php comments_number('<span>' . __("0","alephtheme") . '</span> ' . __("","alephtheme") . '', '<span>' . __("1","alephtheme") . '</span> ' . __("","alephtheme") . '', '<span>%</span> ' . __("","alephtheme") );?>
    									</div><!-- end .box-top --> 												 				
	    								<div class="box-main clearfix">    				
	    									<?php comments_template(); ?>    					
	    								</div> <!-- end .box-main -->
									</div><!-- end .comment-box -->
								</div><!-- end .sidebar -->
							</div><!-- end .row-fluid -->
						
						</article> <!-- end article -->
						
						<?php endwhile; ?>			
						
						<?php else : ?>
						
							<article id="post-not-found">
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