jQuery(document).ready(function() 
{
	//AJAX SAVE OPTIONS
	jQuery('#prk_save_progress').css({'display':'none'});
	jQuery('#prk_main_options').submit( function () {
		var b =  jQuery(this).serialize();
		jQuery('#prk_save_progress').html("Saving...");
		jQuery('#prk_save_progress').css({"top":( jQuery(window).height() - jQuery('#prk_save_progress').height() - 200 ) / 2+jQuery(window).scrollTop() + "px","left":'350px','display':'block'});
		jQuery('#prk_save_progress').animate({"opacity":1},100);
		jQuery.post( 'options.php', b ).error( 
		function() {
			jQuery('#prk_save_progress').html("Save Error!");
		}).success( function() {
			jQuery('#prk_save_progress').html("Settings Updated!");
			jQuery('#prk_save_progress').delay(900).animate({"opacity":0},300,function() {
				jQuery('#prk_save_progress').css({'display':'none'});
			});
		});
		return false;    
	});
	//BACKGROUND MANAGMENT
	if (jQuery('input#queed_theme_options_background').val()=='')
	{
		jQuery('#queed_theme_options_background_image').hide();
	}
	jQuery('#remove_background_button').click(function() 
	{
		jQuery('input#queed_theme_options_background').val('');
		jQuery('#queed_theme_options_background_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_background_button').blur();
		return false;
	});
	
	
	//OVERLAY SELECTOR
	jQuery('#overlay_selector').change(function()
	{
		if (jQuery('#overlay_selector').attr('value')=='')
		{
	
			jQuery('#overlay_preview').css({"display":'none'});
		}
		else
		{
	   		jQuery('#overlay_preview').css({"background-image":'url('+queed_directory+'/images/overlays/'+jQuery('#overlay_selector').attr('value')+')'});
			jQuery('#overlay_preview').css({"display":'inline'});
		}
	});
	
	
	//PATTERN SELECTOR
	jQuery('#pattern_selector').change(function()
	{
		if (jQuery('#pattern_selector').attr('value')=='')
		{
	
			jQuery('.preview_pattern').css({"display":'none'});
		}
		else
		{
	   		jQuery('.preview_pattern').css({"background-image":'url('+queed_directory+'/images/patterns/'+jQuery('#pattern_selector').attr('value')+')'});
			jQuery('.preview_pattern').css({"display":'inline'});
		}
	});
	
	//PATTERN SELECTOR - HEADER AND FOOTER
	jQuery('#pattern_selector_hf').change(function()
	{
		if (jQuery('#pattern_selector_hf').attr('value')=='')
		{
	
			jQuery('.preview_pattern_hf').css({"display":'none'});
		}
		else
		{
	   		jQuery('.preview_pattern_hf').css({"background-image":'url('+queed_directory+'/images/patterns/'+jQuery('#pattern_selector_hf').attr('value')+')'});
			jQuery('.preview_pattern_hf').css({"display":'inline'});
		}
	});
	
	
	//COLOR INPUTS
	jQuery('#active_color').keyup(function() 
	{
		jQuery('#active_preview').css({"background-color":'#'+jQuery('#active_color').val()});		
	});
	jQuery('#inactive_color').keyup(function() 
	{
		jQuery('#inactive_preview').css({"background-color":'#'+jQuery('#inactive_color').val()});		
	});
	jQuery('#body_color').keyup(function() 
	{
		jQuery('#body_preview').css({"background-color":'#'+jQuery('#body_color').val()});		
	});
	jQuery('#background_color').keyup(function() 
	{
		jQuery('#site_background_preview').css({"background-color":'#'+jQuery('#background_color').val()});		
	});
	jQuery('#background_color_modular').keyup(function() 
	{
		jQuery('#background_preview_modular').css({"background-color":'#'+jQuery('#background_color_modular').val()});		
	});
	
	
	//MULTIPLE MEDIA-UPLOAD BOXES MANAGMENT
	//STORE ORIGINAL FUNCTION
	window.original_send_to_editor = window.send_to_editor;
	//CREATE SEMAPHORE VARIABLE
	var header_clicked = false;
	jQuery('.pirenko_upload').click(function() 
	{
		formfield = (jQuery(this).attr("name"));
		post_id = jQuery('#post_ID').val();
 		tb_show('', 'media-upload.php?post_id='+post_id+'type=image&amp;TB_iframe=true');
		header_clicked = true;
 		return false;
	});
	
	jQuery('.pirenko_upload_options').click(function() 
	{
		formfield = (jQuery(this).attr("name"));
		post_id = jQuery(this).attr("secret_id");
 		tb_show('', 'media-upload.php?post_id='+post_id+'&TB_iframe=1');
		header_clicked = true;
 		return false;
	});
	
	window.send_to_editor = function(html) 
	{
		if (header_clicked) 
		{
			imgurl = jQuery('img',html).attr('src');
			//FOR THE THEME OPTIONS - BACKGROUND, LOGO AND FAVICON
			jQuery('img#queed_'+formfield+'_image').show();
			jQuery('img#queed_'+formfield+'_image').attr("src",imgurl);
			//SEND THE IMAGE WIDTH IF NEEDED
			if (formfield=="theme_options_logo")
			{
				jQuery('input#queed_theme_options_logo_w').val(jQuery('img',html).attr('width'));
			}
			//FOR THE WRITE PANEL AND CATEGORIES PANEL
			jQuery('input#queed_'+formfield).val(imgurl);
			jQuery('#queed_theme_options_category_image').attr("src",imgurl);
			jQuery('#queed_theme_options_category_image').show();
			header_clicked = false;
			tb_remove();
		}
		else
		{
			window.original_send_to_editor(html);
		}
	}
	jQuery('#queed_general_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '0%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_homepage_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-100%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_portfolio_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-200%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_news_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-300%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_contact_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-400%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_404_error_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-500%'
		}, 500, function() {
		// Animation complete.
		});
	});
	jQuery('#queed_translations_options_button').click(function()
	{
		jQuery('#queed_options').animate({
    	marginLeft: '-600%'
		}, 500, function() {
		// Animation complete.
		});
	});
	
	jQuery('.bl_icon_preview').click(function()
	{
		jQuery(this).parent().find('.bl_icon_preview').removeClass('active_ic');
		jQuery(this).addClass('active_ic');
		jQuery('#queed_bl_icon').val(jQuery(this).attr("secret_pos"));
	});
	/*
	//HIDE IMAGES BY DEFAULT
	
	jQuery('#site_background_color').keyup(function() 
	{
		jQuery('#site-background_preview').css({"background-color":'#'+jQuery('#site_background_color').val()});		
	});
	
	
	
	if (jQuery('input#mercina_categories_background').val()=='')
	{
		jQuery('#queed_theme_options_category_image').hide();
	}
	jQuery('#remove_categories_background_button').click(function() 
	{
		jQuery('input#mercina_categories_background').val('');
		jQuery('#queed_theme_options_category_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_categories_background_button').blur();
		return false;
	});
	*/
});