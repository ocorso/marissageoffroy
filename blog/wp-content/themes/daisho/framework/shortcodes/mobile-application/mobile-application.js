function maToggleMenu(){
	if(jQuery('#mobile_app_menu').hasClass('mobile-menu-open-visible')){
		jQuery('.mobile-menu-open-wrapper').removeClass('mobile-menu-open-wrapper-active');
		jQuery('#mobile_app_menu').removeClass('mobile-menu-open-visible');
		
		/* Fixed */
		jQuery('body').removeClass('mobile-menu-open-fixed');
		jQuery('.mobile_app_menu_main_wrapper').removeClass('mobile_app_menu_main_wrapper-visible');
	}else{
		/* jQuery('meta[name*="viewport"]').attr('content', 'user-scalable=yes, width=635'); */
		jQuery('.mobile-menu-open-wrapper').addClass('mobile-menu-open-wrapper-active');
		jQuery('#mobile_app_menu').addClass('mobile-menu-open-visible');
		
		/* Fixed */
		jQuery('body').addClass('mobile-menu-open-fixed');
		jQuery('.mobile_app_menu_main_wrapper').addClass('mobile_app_menu_main_wrapper-visible');
		
		//jQuery(window).trigger('resize');
		//jQuery('html').css('width', 200).css('width', '');
	}
}
jQuery(document).ready(function(){
// Shorten texts in overflowed paragraphs to emulate Operas text-overflow: -o-ellipsis-lastline
/* jQuery('.element .symbol').each(function(i, e){
    var $e = jQuery(e), original_content = $e.text();
    while (e.scrollHeight > e.clientHeight){
        $e.text($e.text().replace(/\W*\w+\W*$/, '...'));
	}
    $e.attr('data-original-content', original_content);
}); */


jQuery(document).ready(function(){
	setTimeout(function(){
		jQuery(".element .symbol").each(function(){
			jQuery(this).dotdotdot({
				watch: "window",
				height : '2em',
				wrap : 'letter'
			});
		});
	}, 1500);
	
	jQuery('#toggle-sizes').find('a').click(function(){
		setTimeout(function(){ // we need to be in the new thread
			jQuery(".element .symbol").trigger("update.dot");
		}, 10);
	});
	  
});

	jQuery('.mobile_app_menu_main_wrapper .header-back-to-blog-link').on('click', function(){
		maToggleMenu();
	});
	
	jQuery('.mobile-menu-open-wrapper').click(function(){
		maToggleMenu();
	});
	jQuery('.mobile-menu-settings-wrapper').click(function(){
		if(jQuery('body').hasClass('mobile-app-settings-panel')){
			jQuery('body').removeClass('mobile-app-settings-panel');
			jQuery('.mobile_app_settings_wrapper').removeClass('mobile_app_settings_wrapper-visible');
		}else{
			jQuery('body').addClass('mobile-app-settings-panel');
			jQuery('.mobile_app_settings_wrapper').addClass('mobile_app_settings_wrapper-visible');
		}
	});
});
/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT / GPLv2 License.*//* (function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),k=Math.abs(l.z),(!a.orientation||a.orientation===180)&&(i>7||(k>6&&j<8||k<8&&j>6)&&i>5)?h&&n():h||m()}var b=navigator.userAgent;if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1))return;var c=a.document;if(!c.querySelector)return;var d=c.querySelector("meta[name=viewport]"),e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0,i,j,k,l;if(!d)return;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)})(this); */

jQuery(document).ready(function(){
	jQuery(document).on('focus', 'input[type="text"],select,textarea', function(e){
		//e.preventDefault();
		viewport = jQuery('meta[name="viewport"]');
		viewport.attr('content', 'user-scalable=no, width=640');
		setTimeout(function(){
			viewport.attr('content', 'user-scalable=yes, width=640');
		}, 600);
	});
	
	
	/* jQuery(document).on('click', '.myimage', function(){
		var clon = jQuery(this).clone();
		jQuery('.bro').empty().append(clon).css({'display' : 'block'});
	}); */
});

// * iOS zooms on form element focus. This script prevents that behavior.
// * <meta name="viewport" content="width=device-width,initial-scale=1">
//      If you dynamically add a maximum-scale where no default exists,
//      the value persists on the page even after removed from viewport.content.
//      So if no maximum-scale is set, adds maximum-scale=10 on blur.
//      If maximum-scale is set, reuses that original value.
// * <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0,maximum-scale=1.0">
//      second maximum-scale declaration will take precedence.
// * Will respect original maximum-scale, if set.
// * Works with int or float scale values.
/* function AllowZoom(flag) {
  if (flag == true) {
    jQuery('head meta[name=viewport]').remove();
    jQuery('head').prepend('<meta name="viewport" content="user-scalable=yes, width=640, initial-scale=1, maximum-scale=10.0, minimum-scale=1, user-scalable=1" /><');
  } else {
    jQuery('head meta[name=viewport]').remove();
    jQuery('head').prepend('<meta name="viewport" content="width=640, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0" />');              
  }
} */

/* function cancelZoom()
{
    var d = document,
        viewport,
        content,
        maxScale = ',maximum-scale=',
        maxScaleRegex = /,*maximum\-scale\=\d*\.*\d*/;
/*
    // this should be a focusable DOM Element
    if(!this.addEventListener || !d.querySelector) {
        return;
    }
 
    viewport = d.querySelector('meta[name="viewport"]');
    content = viewport.content;
 
    function changeViewport(event)
    {
        // http://nerd.vasilis.nl/prevent-ios-from-zooming-onfocus/
        viewport.content = content + (event.type == 'blur' ? (content.match(maxScaleRegex, '') ? '' : maxScale + 10) : maxScale + 1);
    }
 
    // We could use DOMFocusIn here, but it's deprecated.
    this.addEventListener('focus', changeViewport, true);
    this.addEventListener('blur', changeViewport, false);
	//alert('test');
} */
 
// jQuery-plugin
/* (function($)
{
    $.fn.cancelZoom = function()
    {
        return this.each(cancelZoom);
    };

    // Usage:
    $('input,select,textarea').cancelZoom();
})(jQuery);

jQuery(document).on('focus,blur', 'input,select,textarea', function(e){
e.preventDefault();
AllowZoom(false);
setTimeout(function(){
AllowZoom(true);
},500);
}); */
// Listen for ALL links at the top level of the document. For
// testing purposes, we're not going to worry about LOCAL vs.
// EXTERNAL links - we'll just demonstrate the feature.
if(("standalone" in window.navigator) && window.navigator.standalone){ // detects app mode in iOS
	jQuery( document ).on("click", "a", function( event ){
		// Stop the default behavior of the browser, which
		// is to change the URL of the page.
		event.preventDefault();
		 
		// Manually change the location of the page to stay in
		// "Standalone" mode and change the URL at the same time.
		location.href = jQuery( this ).attr( "href" );
	});
}

	 function switchMeta(flag) {
	  if (flag == true) {
		jQuery('head meta[name=viewport]').remove();
		jQuery('head').prepend('<meta name="viewport" content="user-scalable=yes, width=540" /><');
	  } else {
		jQuery('head meta[name=viewport]').remove();
		jQuery('head').prepend('<meta name="viewport" content="user-scalable=yes, width=820" />');              
	  }
	}

	function changeOrientation(){
		if(jQuery('body').hasClass('daisho-portfolio')){
	switch(window.orientation) {
	case 0: // portrait, home bottom
	switchMeta(true);
	case 180: // portrait, home top
	 //alert("portrait H: "+jQuery(window).height()+" W: "+jQuery(window).width());
	 switchMeta(true);
	 break;
			  case -90: // landscape, home left
			  switchMeta(false);
			  case 90: // landscape, home right
			//alert("landscape H: "+$(window).height()+" W: "+$(window).width());
			switchMeta(false);
				break;
			}
		}

	 window.onorientationchange = function() {
		//Need at least 800 milliseconds
		setTimeout(changeOrientation, 0);
		}
	}