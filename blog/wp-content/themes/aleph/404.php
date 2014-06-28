<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /404.php
 * Version of this file : 1.0
 *
 */
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix container-fluid" data-level="none">		
			
				<?php 				
					// Close link
					echo "<a href='#' data-rel='".home_url()."' class='SubClose' data-id='".$level_top_id."'><em class='icon-remove icon-white'></em></a>";											
				?>								
			
				<div class="row-fluid clearfix">	
			
					<div id="main" class="span12 clearfix" role="main">
							
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	
							<header class="page-header clearfix">
								<h1 class="page-title" itemprop="headline">
									<?php  
										global $data;
										if($data['error404']!="") {
											echo $data['error404'];
										} else {
											_e("Error 404 - Page Not Found","alephtheme");
										}
									?>
								</h1>
							</header><!-- end .page-header -->													
													
						</article> <!-- end article -->
				
					</div> <!-- end #main -->
    
    			</div><!-- end .row-fluid -->
    			
			</div> <!-- end #content -->

<?php get_footer(); ?>