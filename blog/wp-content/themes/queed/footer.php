
	</div><!-- /#wrap -->
    <div class="push"></div>
    </div><!-- #ultra_wrapper -->
    <?php 
		global $queed_frontend_options; 
		$queed_frontend_options=get_option('queed_theme_options'); 
	?>
    <div class="footer">
        <footer id="content-info" role="contentinfo">
            <div class="<?php echo WRAP_CLASSES; ?>">
                <?php
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) : 
							else : 
								echo 	'<style type="text/css">
								 .ultra_wrapper
								 {
									margin: 0 auto -50px !important;
								 }
								 .footer 
								 {
									height:15px;/*360-45*/
		
								}
								#after_widgets
								{
									margin-top: 2px;
								}
								#content-info {
									min-height:0px;	
								}
								 .push 
								 {
									height: 50px;
								 }
								 </style>';
									
								
							endif;  
					 ?>
                <div id="after_widgets" class="<?php echo WRAP_CLASSES; ?>">
                    <nav id="nav_footer" class="cf" role="navigation">
                        <?php 
                            if ( has_nav_menu( 'footer_navigation' ) ) 
                            {
                                wp_nav_menu(array('theme_location' => 'footer_navigation')); 
                            }
                            ?>
                    </nav>
                    <p class="copy"><?php echo $queed_frontend_options['footer_text']; ?></p>
                </div>
            </div>
        </footer>
    </div>
  	<script type="text/javascript">
		/*jQuery('img').load(function()
		{
			if (jQuery(this).hasClass('desaturated_image'))
			{
				jQuery(this).removeClass('desaturated_image');
				jQuery(this).parent().addClass('desaturated_before');
				var img = document.getElementById(jQuery(this).attr('id'));
				Pixastic.process(img, "desaturate", {average : false});	
			}
		});*/
    	jQuery(document).ready(function()
        {
        	//CALL MAIN JSCRIPT FUNCTION
         	queed_init();	
			jQuery( "#accordion" ).accordion();
			//ADJUST GOOGLE MAPS SIZE - BUG?
			if (jQuery('#google-maps').length)
			{
				jQuery('#google-maps').css({'height':jQuery("#google-maps iframe").attr('height')})
			}	
       	});
  	</script>
 	<?php wp_footer(); ?>
  	<?php roots_footer(); ?>

</body>
</html>