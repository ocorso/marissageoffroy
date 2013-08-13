;jQuery(document).ready(function(){
	//jQuery('.toggle_title').on('click.toggle', function(){
	jQuery(document).on('click.toggle', '.toggle_title', function(){
		if(jQuery(this).hasClass('toggle_active')){
			jQuery(this).removeClass('toggle_active');
			jQuery(this).siblings('.toggle_content').stop(true,true).slideUp("fast"); 
		}else{
			jQuery(this).addClass('toggle_active');
			jQuery(this).siblings('.toggle_content').stop(true,true).slideDown("fast");
		}
	});
	jQuery(".accordion").accordion({
		icons: { "header": "accordion-no-icon", "headerSelected": "accordion-no-icon" }
	});
	jQuery(".tabs-prev").each(function(){
		jQuery(this).tabs();
	});
});