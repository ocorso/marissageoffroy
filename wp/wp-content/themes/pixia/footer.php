<?php 
	global $pixia_frontend_options; 
	 if (!isset($pixia_frontend_options['ganalytics_text']))
		$pixia_frontend_options['ganalytics_text']="";
?>
	</div><!-- /#wrap -->
    <div class="push"></div>
    </div><!-- #ultra_wrapper -->
    <div class="footer">
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
         	pixia_init();	
			jQuery( "#accordion" ).accordion();
       	});
  	</script>
    <?php echo $pixia_frontend_options['ganalytics_text']; ?>
 	<?php wp_footer(); ?>
</body>
</html>