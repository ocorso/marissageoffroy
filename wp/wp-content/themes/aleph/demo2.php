<?php
/*
Template Name: Alt Home
*/

/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/inc/homeWF.php
 * Version of this file : 1.3
 *
 */
?>
<?php get_header(); ?>
			
			<div id="content" class="clearfix container-fluid" data-level="top" data-type="post">
			
				<?php 
					global $data; 
					$blocks=$data['home_blocks']['enabled']; 
					if($blocks) : 
						
						foreach($blocks as $key=>$value) {						
							switch($key) {							
								case 'home_intro' :
									echo '<div class="row-fluid clearfix home-intro">'; 
									if($data['home_intro_title']!="") {
										echo '<h1>'.$data['home_intro_title'].'</h1>';
									}
									if($data['home_intro_desc']!="") {
										echo '<h3>'.$data['home_intro_desc'].'</h3>';
									}
									echo '</div>';					
									break;
								case 'home_separator' : 
									echo '<hr>';
									break;
								case 'home_works' : 
				?>
									<div id="main" role="main" class="home-works blueberry row-fluid clearfix">
										<?php
											$temp = $wp_query;
											$wp_query= null;
											$homeWF_args = array(
													'post_type'=>array('portfolio','post'),
										 			'posts_per_page'=>'-1',
										 			'nopaging'=>'true',
										 			'orderby'=>'menu_order',
										 			'order'=>'ASC',
										 			'ignore_sticky_posts' => 1,
										 			'meta_query' => array(
										 				array(
										 					'key' => 'home_featured',
										 					'value'=> 'on'
										 				)
										 			)
											);
											$wp_query = new WP_Query( $homeWF_args );																										
										?>					 				 	
											<ul class="slides span8">
												<?php			
												while ($wp_query->have_posts()) : $wp_query->the_post();
													echo '<li><a href="';
													the_permalink();
													echo '">';
													the_post_thumbnail("portfolio-thumb");
													echo '</a></li>';	
												endwhile; 
											?>&nbsp;
											</ul>
											<ul class="pager span4 clearfix">       												
											<?php			
												while ($wp_query->have_posts()) : $wp_query->the_post();
													
													echo '<li><a href="#"><h3>'.get_the_title().'</h3></a></li>';
																						
												endwhile; 	
											?>			
											</ul>					
										<?php				
											$wp_query = null; $wp_query = $temp;
											wp_reset_postdata();			
										?>
							 		</div><!-- end #main -->    				
				<?php								
									break;							
							}							
						}
					
					endif;
				?>	
				<?php the_content(); ?>
			</div><!-- #content -->		 					
	
<?php get_footer(); ?>