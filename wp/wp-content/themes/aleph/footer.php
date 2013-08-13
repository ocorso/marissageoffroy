<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /footer.php
 * Version of this file : 1.0
 *
 */
?>

<?php global $data; ?>

				</div><!-- end .nano -->
			</div><!-- end .content -->
		</div> <!-- end #container -->
		
		<div id="utilities"></div>
		
		<?php 		
			if ($data['footer_sidebar_activate']=="1") {		
				get_sidebar( 'footer' );	
			}		
		?>
		
		<footer role="contentinfo">
		
			<div class="container-fluid clearfix">
				<div id="inner-footer" class="row-fluid clearfix">
											
					<p class="attribution pull-left"><?php echo $data['footer_text']; ?></p>			
															
					<div class="social pull-right clearfix">
						<?php include( get_template_directory() . '/framework/inc/social_links.php' ); ?>
					</div><!-- end .social -->	
			
				</div> <!-- end #inner-footer -->
			</div><!-- end .container-fluid -->
			
		</footer> <!-- end footer -->		
		
		<!-- scripts are now optimized via Modernizr.load -->	
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php 
		echo $data['footer_code'];
		wp_footer(); // js scripts are inserted using this function ?>
	</body>

</html>