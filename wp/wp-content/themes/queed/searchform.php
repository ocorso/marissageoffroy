<?php
	global $queed_frontend_options; 
	$queed_frontend_options=get_option('queed_theme_options');
?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
  	<input type="text" value="" name="s" id="queed_search" class="search-query pirenko_highlighted" placeholder="<?php _e($queed_frontend_options['search_tip_text'], 'queed'); ?>" />
  	<input type="submit" class="search_icon" id="" value="" />
</form>
<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery('.search_icon').click(function(e) 
		{
			if (jQuery(this).parent().find('#queed_search').val()=="")
			{
				e.preventDefault();
				jQuery(this).parent().find('#queed_search').css({'color':active_color});
			}
		});
	});
</script>