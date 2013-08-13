 function resizeimageslide(ielement,isvideo,chkpushwidthtoarr){
	var iel = jQuery(ielement);
	
	/* Create slideshow container, var winheight is height() fix for iPhone */
var winheight = window.innerHeight ? window.innerHeight:jQuery(window).height();
	//var fg_imgareaw = jQuery(window).width(), fg_imgareah = jQuery(window).height();
	var fg_imgareaw = jQuery(window).width(), fg_imgareah = winheight;
	var fg_imgsize = [iel.width(), iel.height()];
	var fg_fitscreen = false;
	if(iel.hasClass("slide_horizontal")){
		fg_fitscreen = true;
	}
	if(isvideo){
		fg_imgsize = [16,9];
	}
	if(iel.is("div")){
		fg_imgsize = [fg_imgareaw, fg_imgareah];
		resizeimageslide(jQuery("img:not(.myimage)", iel),false,false);
	}
	if(fg_imgsize[0] && fg_imgsize[1] && fg_imgareaw && fg_imgareah){
		//if(fg_imgsize[0] < fg_imgareaw || fg_imgsize[1] < fg_imgareah){
		var fg_imgnewsizew=0, fg_imgnewsizeh=0;
		var fg_imgscalerx = fg_imgsize[0]/fg_imgareaw, fg_imgscalery = fg_imgsize[1]/fg_imgareah;
		if(fg_fitscreen){
			if(fg_imgscalerx <= fg_imgscalery){
				fg_imgnewsizew = fg_imgsize[0]/fg_imgscalery;
				fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalery;
			}else{
				fg_imgnewsizew = fg_imgsize[0]/fg_imgscalerx;
				fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalerx;
			}
		}else{
			if(fg_imgscalerx <= fg_imgscalery){
				fg_imgnewsizew = fg_imgsize[0]/fg_imgscalerx;
				fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalerx;
			}else{
				fg_imgnewsizew = fg_imgsize[0]/fg_imgscalery;
				fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalery;
			}
		}
		if(fg_imgnewsizew && fg_imgnewsizeh){
			fg_imgnewsizew = Math.round(fg_imgnewsizew);
			fg_imgnewsizeh = Math.round(fg_imgnewsizeh);
			if(!isvideo){
				if(fg_fitscreen){
					if(fg_imgscalerx <= fg_imgscalery){
						iel.css({'top':'0px', 'left':'0px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
						iel.parent().css({'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
					}else{
						iel.css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
					}
					if(chkpushwidthtoarr){
						if(fg_imgscalerx <= fg_imgscalery){
							portfolioslideswidths[portfolioslideswidths.length] = fg_imgnewsizew;
						}else{
							portfolioslideswidths[portfolioslideswidths.length] = fg_imgareaw;
						}
					}
				}else{
					iel.css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
					if(chkpushwidthtoarr){
						portfolioslideswidths[portfolioslideswidths.length] = fg_imgareaw;
					}
				}
			}else{
				jQuery(".video-js", iel).css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
				if(chkpushwidthtoarr){
					portfolioslideswidths[portfolioslideswidths.length] = fg_imgareaw;
				}
			}
		}
	}else{
		return false;
	}
	return true;
}