<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /page.php
 * Version of this file : 1.2
 *
 */
?>

<?php get_header(); ?>
				
			<div id="content" class="clearfix container-fluid <?php $level=get_post_meta($post->ID,'level','true'); if(!isset($level) || $level=="") { $level="none"; } if($level!="top") { echo "under-level"; } ?>" data-level="<?php echo $level; ?><?php if($level=='sub') { echo '_page';} ?>">
				<?php 
					// Custom background
					custom_bg($post->ID);
					 						
					// Additional links		
					var_nav($post->ID,$level,'page');	
				?>			
			
				<div class="row-fluid clearfix">	
			
					<div id="main" class="span12 clearfix" role="main">
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<?php 
								if(get_post_meta($post->ID,"page_full",true)=="on") {
									$comments="false";
								} elseif(get_post_meta($post->ID,"page_full",true)!="on" && !comments_open()) {
									$comments="false";
								} else {
									$comments="true";
								}							
							?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							
							<header class="page-header clearfix">
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							</header><!-- end .page-header -->						
							
							<div class="row-fluid clearfix">
								<div class="<?php if($comments=="true") { echo 'span8'; } else { echo 'span12'; } ?>">	
									<section class="post_content clearfix" itemprop="articleBody">
										<?php the_content(); ?>					
									</section> <!-- end .post_content -->
								</div>
								<?php if($comments=="true") { ?>
									<div class="span4 sidebar page clearfix">
										<hr class="hidden-desktop">											
	
										<?php utility_ls($post->ID); ?>
										
										<div class="comment-box clearfix">	
											<div class="box-top clearfix">
	    										<em class="icon-comment"></em> <?php comments_number('<span>' . __("0","alephtheme") . '</span> ' . __("","alephtheme") . '', '<span>' . __("1","alephtheme") . '</span> ' . __("","alephtheme") . '', '<span>%</span> ' . __("","alephtheme") );?>
	    									</div><!-- end .box-top -->       												 				
		    								<div class="box-main clearfix">    				
		    									<?php comments_template(); ?>    					
		    								</div><!-- end .box-main -->
										</div><!-- end .comment-box -->
									</div><!-- end .sidebar -->
								<?php } ?>
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