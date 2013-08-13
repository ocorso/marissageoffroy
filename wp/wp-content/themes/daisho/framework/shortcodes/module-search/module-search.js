function autoResize(e){
	var ele=e.target;
	if(e.which && (e.which == 8 || e.which == 46)){
		ele.style.height="60px";
	}

	if(ele.scrollHeight > jQuery(ele).height()){
		ele.style.height=(ele.scrollHeight+64)+"px";
	}
}
function checksubmit(e){
	if(e.which == 10 || e.which == 13){
		var tformsub = jQuery(".header-search-form form");
		if(tformsub.length >= 1){
			tformsub.get(0).submit();
			e.preventDefault();
		}
	}
}
jQuery(document).ready(function(){
	jQuery('.header-search').click(function(){
		jQuery('.header-search-form').css({ 'display' : 'block' });
		jQuery('.header-search-input').focus();
		jQuery('.header-search-input').keyup(autoResize);
		jQuery('.header-search-input').keydown(checksubmit);
	});
	jQuery('.header-search-form').click(function(e){
		var target = e.target;

		while (target.nodeType != 1) target = target.parentNode;
		if(target.tagName != 'TEXTAREA'){
			jQuery('.header-search-form').css({ 'display' : 'none' });
		}
	});
});