jQuery(document).ready(function() {
	if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|android)/)){
		var header_height = jQuery('#header').height();
		jQuery('#header').css({ 'position' : 'absolute', top: ~(header_height+80) });
		jQuery('#header').append('<div class="handle"><div class="handle-pattern"></div></div>');
		menu = new slideInMenu('header',true);
	}
});