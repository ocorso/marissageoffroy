var arrvisibleb = false;
var arrcposleftind = 0;
var arrcposlptr = {'cols':0,'colwidth':0};
function newsarrowsbindclick(){
	jQuery('.scrollbar-arrowleft').click(function(){
		if(arrcposlptr.cols && arrcposlptr.colwidth){
			var news_count = (jQuery('.news-container .excerpt-blog').length);
			arrcposleftind -= arrcposlptr.cols;
			if(arrcposleftind < 0){
				arrcposleftind = 0;
			}
			jQuery('.news-container').stop().animate({'left':(-arrcposleftind*arrcposlptr.colwidth)+"px"}, 300);
			if(arrcposleftind <= 0){
				jQuery('.scrollbar-arrowleft').addClass('scrollbar-arrowleft-inactive');
			}
			if(arrcposleftind+arrcposlptr.cols < news_count){
				jQuery('.scrollbar-arrowright').removeClass('scrollbar-arrowright-inactive');
			}
		}
	});
	jQuery('.scrollbar-arrowright').click(function(){
		if(arrcposlptr.cols && arrcposlptr.colwidth){
			var news_count = (jQuery('.news-container .excerpt-blog').length);
			arrcposleftind += arrcposlptr.cols;
			if(arrcposleftind > (news_count-arrcposlptr.cols)){
				arrcposleftind = news_count-arrcposlptr.cols;
			}
			jQuery('.news-container').stop().animate({'left':(-arrcposleftind*arrcposlptr.colwidth)+"px"}, 300);
			if(arrcposleftind >= 1){
				jQuery('.scrollbar-arrowleft').removeClass('scrollbar-arrowleft-inactive');
			}
			if(arrcposleftind+arrcposlptr.cols >= news_count){
				jQuery('.scrollbar-arrowright').addClass('scrollbar-arrowright-inactive');
			}
		}
	});
}
function newsarrowsunbindclick(){
	jQuery('.scrollbar-arrowleft, .scrollbar-arrowright').unbind("click");
}
function resizenewsdribbcontent(){
	if(jQuery('.overview_dribbble').length){
		var scrollbar_width = jQuery('.dribbbles li').length;
		jQuery('#scrollbar2 .overview_dribbble').css({'width' : (420*scrollbar_width)+(1/2)*jQuery(window).width()+"px" });
	}
	var newsposd = getnewscontentwidths();
	if(jQuery('.news-container-outer').length){
		var news_count = (jQuery('.news-container .excerpt-blog').length);
		if(news_count){
			arrcposlptr.cols=newsposd.newslinecount;
			arrcposlptr.colwidth=newsposd.newsbswidth;
			jQuery('.news-container-outer').css({'width':(newsposd.viewportwidth)+"px"});
			jQuery('.news-container .excerpt-blog').css({'width':(newsposd.newsbwidth), 'margin-left':(newsposd.newsbmargins), 'margin-right':(newsposd.newsbmargins)});
			if(newsposd.newslinecount > 1){
				jQuery('.news-container').css({'width':(news_count*newsposd.newsbswidth)+'px'});
				jQuery('.news-container').stop().animate({'left':(-arrcposleftind*newsposd.newsbswidth)+"px"}, 300);
				if(!arrvisibleb){
					arrvisibleb = true;
					newsarrowsbindclick();
					jQuery('.news-container .excerpt-blog').css({'clear':'none'});
					jQuery('.scrollbar-arrowleft, .scrollbar-arrowright').css({'display':'block'});
					jQuery('.news-container').css({'left':'0'});
					arrcposleftind = 0;
					jQuery('.scrollbar-arrowleft').addClass('scrollbar-arrowleft-inactive');
					if(news_count <= newsposd.newslinecount){
						jQuery('.scrollbar-arrowright').addClass('scrollbar-arrowright-inactive');
					}else{
						jQuery('.scrollbar-arrowright').removeClass('scrollbar-arrowright-inactive');
					}
				}
			}else{
				jQuery('.news-container').css({'left':'0', 'width':(newsposd.newsbswidth)});
				if(arrvisibleb){
					arrvisibleb = false;
					newsarrowsunbindclick();
					jQuery('.news-container .excerpt-blog').css({'clear':'both'});
					jQuery('.scrollbar-arrowleft, .scrollbar-arrowright').css({'display':'none'});
					jQuery('.news-container').css({'left':'0'});
					arrcposleftind = 0;
				}
			}
			if(arrvisibleb){
				var newscposrel = jQuery('.news-container-outer').position();
				//jQuery('.scrollbar-arrowleft').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2-newsposd.arrowwidth)+"px", 'top':(110+newscposrel.top)+"px"}); //original
				//jQuery('.scrollbar-arrowright').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2+newsposd.viewportwidth)+"px", 'top':(110+newscposrel.top)+"px"}); //original		
				jQuery('.scrollbar-arrowleft').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2-newsposd.arrowwidth)+40+"px", 'top':(110+newscposrel.top)+"px"});
				jQuery('.scrollbar-arrowright').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2+newsposd.viewportwidth)-40+"px", 'top':(110+newscposrel.top)+"px"});
			}
		}
	}
}
function getnewscontentwidths(){
	var arrowwidth = 110;
	var newsbmargins = 15; //original
	var newsbmargins = 25;
	var windowwidther = Math.max(50, Math.min(1200-2*arrowwidth,jQuery(window).width()-2*arrowwidth)); //original
	var windowwidther = Math.max(50, Math.min(1200-2*arrowwidth,jQuery(window).width()-2*arrowwidth))+140+50;
	var newsviewed = 3; //Math.max(1, Math.min(3, Math.ceil(windowwidther/533)));
	//if(windowwidther < 800){ //original
	if(windowwidther < 1000){
		newsviewed = 2;
	}
	var newsbwidth = 350;
	if(windowwidther < 750){
		var windowwidther = Math.max(50, Math.min(1200-2*arrowwidth,jQuery(window).width()-2*arrowwidth));//dodane
		newsviewed = 1;
		windowwidther += 2*arrowwidth;
		arrowwidth = 0;
		newsbwidth = "92%";
		newsbmargins = "4%";
	}else{
		newsbwidth = Math.floor(windowwidther/newsviewed) - 2*newsbmargins;
		if(newsbwidth > 350){
			//newsbmargins += (newsbwidth-350)/2;
			//newsbwidth = 350;
		}
	}
	return {'viewportwidth':windowwidther, 'newsbswidth': ((newsviewed>1)?(newsbwidth+2*newsbmargins):"100%"), 'newsbwidth':newsbwidth, 'newsbmargins':newsbmargins, 'arrowwidth':arrowwidth, 'newslinecount':newsviewed};
}
	jQuery(document).ready(function(){
	resizenewsdribbcontent();
		jQuery(window).resize(function(){
			resizenewsdribbcontent();
			//triggermenucompact();
		});
	});