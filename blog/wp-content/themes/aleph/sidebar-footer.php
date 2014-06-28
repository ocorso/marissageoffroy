<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /sidebar-footer.php
 * Version of this file : 1.4
 *
 */
?>

<?php
	
	global $data;
		
	if (   ! is_active_sidebar( 'sidebar-1'  )
			&& ! is_active_sidebar( 'sidebar-2' )
			&& ! is_active_sidebar( 'sidebar-3'  )
		)
		return;
		
?>
	
	<div id="footer-sidebar">
		<div class="container-fluid clearfix">
			<div class="row-fluid clearfix">
			
				<?php
			
					if ( is_active_sidebar( 'sidebar-1' ) ) : 
					
				?>
						<div role="complementary" <?php footer_sidebar_class(); ?>>
							
						<?php 
						
							dynamic_sidebar( 'sidebar-1' ); 
						
						?>
						
						</div><!-- #first .widget-area -->
				<?php 
				
					endif; 
					
					if ( is_active_sidebar( 'sidebar-2' ) ) : 
				
				?>
						
						<div sidebar-role="complementary" <?php footer_sidebar_class(); ?>>
						
						<?php 
							dynamic_sidebar( 'sidebar-2' ); 
						?>
							
						</div><!-- #second .widget-area -->
				<?php 
					endif; 
				
					if ( is_active_sidebar( 'sidebar-3' ) ) : 
					
				?>
				
						<div sidebar-role="complementary" <?php footer_sidebar_class(); ?>>
						
						<?php 
							
							dynamic_sidebar( 'sidebar-3' ); 
							
						?>
						
						</div><!-- #third .widget-area -->
				<?php 
					
					endif; 
					
				?>
			
			</div>
			
		</div>
			
	</div><!-- #supplementary -->
