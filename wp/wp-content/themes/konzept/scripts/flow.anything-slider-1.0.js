jQuery(document).ready(function() {
	jQuery('.anything-slider').before('<div id="nav">');
	jQuery('.anything-slider').cycle({
		fx: 'fade',
		timeout: 11000, 
		pager:  '#nav',
		cleartypeNoBg: true,
		//pause: 1, // pause and resume commands not working with pause on hover option
		next: '.anything-slider-next-slide'
	});
	$("#content").before("<div id=\"cycledump\"></div>");
	jQuery("iframe").each(function(){
		var rr_iframeel = jQuery(this).get(0);
		var rr_iframesrc = jQuery(this).attr("src");
		if(rr_iframesrc.toLowerCase().indexOf("vimeo.com") != -1){
			var rr_newiframesrc = false;
			var rr_srcgetparamspos = rr_iframesrc.indexOf("?");
			if(rr_srcgetparamspos == -1){
				rr_newiframesrc = rr_iframesrc+"?api=1";
			}else{
				var rr_srcgetparams = rr_iframesrc.substr(rr_srcgetparamspos+1);
				var rr_srcgetparamsarr = rr_srcgetparams.replace("&amp;","&").split("&");
				var rr_srcgetparamsisapiloaded = false;
				for(var rr_i=0;rr_i<rr_srcgetparamsarr.length;rr_i++){
					var rr_srcgetparamsarrparamisvalue = rr_srcgetparamsarr[rr_i].indexOf("=");
					if(rr_srcgetparamsarrparamisvalue != -1){
						var rr_srcgetparamsarrparamkey = rr_srcgetparamsarr[rr_i].substr(0,rr_srcgetparamsarrparamisvalue);
						if(rr_srcgetparamsarrparamkey == "api"){
							var rr_srcgetparamsarrparamval = rr_srcgetparamsarr[rr_i].substr(rr_srcgetparamsarrparamisvalue+1);
							if(rr_srcgetparamsarrparamval == "1"){
								rr_srcgetparamsisapiloaded = true;
								break;
							}
						}
					}
				}
				if(!rr_srcgetparamsisapiloaded){
					rr_newiframesrc = rr_iframesrc+"&api=1";
				}
			}
			if(rr_newiframesrc){
				jQuery(this).attr("src", rr_newiframesrc);
			}
			Froogaloop(rr_iframeel).addEvent("ready", function(iframeid){
				Froogaloop(rr_iframeel).addEvent("play", function(data){
					jQuery('.anything-slider').cycle("pause");
				});
				Froogaloop(rr_iframeel).addEvent("pause", function(data){
					jQuery('.anything-slider').cycle("resume");
				});
				Froogaloop(rr_iframeel).addEvent("finish", function(data){
					jQuery('.anything-slider').cycle("resume");
				});
			});
		}
	});
});
