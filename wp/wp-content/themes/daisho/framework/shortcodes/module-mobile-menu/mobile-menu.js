/* This script handles drop-down menu for mobile devices */
jQuery(document).ready(function(){
	jQuery('#mobile_menu').change(function(e){
		window.location = jQuery(this).val();
	})
	jQuery('#mobile_menu .mob-sub').hide();
	
	jQuery('.menu-item-has-submenu > a').on('mouseover', function(){
		var windowWidth = jQuery(window).width();
		
		var hoveredItemWidth = jQuery(this).parent().parent().width();
		var subMenuWidth = jQuery(this).next('ul').width();
		var subMenuOffset = jQuery(this).offset();
		
		var tt = hoveredItemWidth + subMenuWidth + subMenuOffset.left;

		if(tt >= windowWidth){
			jQuery(this).next('ul').addClass('menu-hover-left');
		}else if(subMenuOffset.left <= 0){
			//jQuery(this).next('ul').removeClass('menu-hover-left');
		}else{
		}
	});
	
	jQuery(window).on('resize', function(){
		if(jQuery('.sub-menu').hasClass('menu-hover-left')){
			jQuery('.sub-menu').removeClass('menu-hover-left');
		}
		if(jQuery('#menu > .menu-item-has-submenu > ul').hasClass('menu-reversed')){
			jQuery('#menu > .menu-item-has-submenu > ul').removeClass('menu-reversed');
		}
	});
	
	/* var maxWidth;
	jQuery('.sub-menu').each(function(){
		jQuery(this).find('li').each(function(){
			//maxWidth = parseInt(jQuery(this).css('width'));
			if(maxWidth >= jQuery(this).innerWidth()){
			
			}else{
				maxWidth = jQuery(this).innerWidth();
			}
		});
		maxWidth = parseInt(maxWidth);
		if(maxWidth > 140){
			//jQuery(this).css({'width' : (jQuery(this).width()+15)+'px' });
		}
	}); */
	
	/* var max_width = 0;
	var current_compact_display = 0;
	jQuery('#menu .sub-menu, #menu-compact .sub-menu').each(function(){
		jQuery(this).css({ 'display' : 'block' });
		current_compact_display = jQuery('#main-nav-compact').css('display');
		jQuery('#main-nav-compact').css({ 'display' : 'block' });
		max_width = 0;
		jQuery(this).find('li').each(function(){
			if(max_width >= jQuery(this).innerWidth()){
			
			}else{
				max_width = jQuery(this).innerWidth();
			}
		});
		jQuery(this).find('li').width(max_width+10);
		jQuery(this).css({ 'display' : 'none' });
		jQuery('#main-nav-compact').css({ 'display' : current_compact_display });
	}); */
	jQuery('#menu > .menu-item-has-submenu').on('hover.subMenuLeftOrRightTab', function(){
		subMenuLeftOrRightTab();
	});
});

function subMenuLeftOrRightTab(){
	var windowWidth, subMenuWidth, subMenuOffset, subMenuPosition;
	
	windowWidth = jQuery(window).width();
	
	jQuery('#menu > .menu-item-has-submenu > ul').each(function(){
		subMenuWidth = jQuery(this).width();
		subMenuOffset = jQuery(this).offset();
		subMenuPosition = subMenuWidth + subMenuOffset.left;
		
		if(subMenuPosition >= windowWidth){
			jQuery(this).addClass('menu-reversed');
		}else{
		}
	});
}