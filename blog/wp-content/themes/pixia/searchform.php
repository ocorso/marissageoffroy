<?php
	global $pixia_frontend_options; 
	$pixia_frontend_options=get_option('pixia_theme_options');
?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
<div class="sform_wrapper">
  	<input type="text" value="" name="s" id="pixia_search" class="search-query pirenko_highlighted boxed_shadow" placeholder="<?php _e($pixia_frontend_options['search_tip_text'], 'pixia'); ?>" />
  	<input type="submit" class="search_icon" id="" value="" />
    <div class="small_icon_wrapper" style="top:6px;left:160px;">
    	<div class="multiple_icons">
    		<img class="pir_search_icon filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/glyphicons-halflings-white.png" />
        </div>
 	</div>
    </div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery('.search_icon').click(function(e) 
		{
			if (jQuery(this).parent().find('#pixia_search').val()=="")
			{
				e.preventDefault();
				jQuery(this).parent().find('#pixia_search').css({'color':active_color});
			}
		});
	});
</script>