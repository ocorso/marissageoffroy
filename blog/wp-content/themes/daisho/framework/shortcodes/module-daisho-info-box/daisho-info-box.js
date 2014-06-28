function info_box_resize(){
	var info_box_height = jQuery('.info-box').height();
	jQuery('.info-box').css({ 'margin-top' : ~info_box_height+5 });
	jQuery(".info-box").hover(
	  function () {
		jQuery(this).stop().animate({ 'margin-top' : 0 }, 300);
	  },
	  function () {
		jQuery(this).stop().animate({ 'margin-top' : ~info_box_height+5 }, 300);
	  }
	);
}
jQuery(document).ready(function(){
	info_box_resize();
	jQuery(window).on("resize.infobox", function(){
		info_box_resize();
	});
});