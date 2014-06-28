<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<?php
		global $ie;
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		$mac = strpos($user_agent, 'Macintosh') ? true : false;
		$win = strpos($user_agent, 'Windows') ? true : false;
		$firefox = strpos($user_agent, 'Firefox') ? true : false;
		$ie = strpos($user_agent, 'MSIE') ? true : false;
		$opera = strpos($user_agent, 'Opera') ? true : false;
		$ipad = strpos($user_agent, 'iPad') ? true : false;
		$windowsphone = strpos($user_agent, 'Windows Phone') ? true : false;
	?>
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'Android') || $windowsphone){ ?>
	<meta name="viewport" content="user-scalable=yes, width=480" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<?php }else if(strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){ ?>
	<meta name="viewport" content="user-scalable=yes, width=1018" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<?php } ?>
	<title><?php
		if(is_home()) {
		echo bloginfo('name').' - Home';
		} elseif(is_category()) {
		echo 'Browsing the Category ';
		wp_title(' ', true, '');
		} elseif(is_archive()){
		echo 'Browsing Archives of';
		wp_title(' ', true, '');
		} elseif(is_search()) {
		echo 'Search Results for "'.esc_attr($s).'"';
		} elseif(is_404()) {
		echo '404 - Page got lost!';
		} else {
		wp_title('-', true, 'right'); bloginfo('name'); 
		} ?></title>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php $custom_favicon=get_option("custom_favicon"); print((($custom_favicon)?$custom_favicon:bloginfo('template_directory')."/images/favicon.ico")); ?>" />
	<?php if(!get_option("disable_css")){ ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/fonts.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/grid.css" />
	<?php } ?>
	<?php wp_head(); ?>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
	$custom_css_style = get_option("custom_css_style");
	if($custom_css_style){
		print("<style type=\"text/css\">".$custom_css_style."</style>");
	}
	?>
<script type="text/javascript">

var portfoliobindevents = ["mousedown", "mousemove", "mouseup"];
if('ontouchstart' in window){
	portfoliobindevents = ["touchstart", "touchmove", "touchend"];
}else{
	portfoliobindevents = ["mousedown", "mousemove", "mouseup"];
}
<?php //Check if fixed menu. 0 = moving, 1 = fixed
	update_option('flow_portfolio_fixed_menu', '2');
	if(!get_option('flow_portfolio_fixed_menu') || get_option('flow_portfolio_fixed_menu') == '0'){
		//mov both
		print("var portfoliofixedmenum = 1;");
	}else if(get_option('flow_portfolio_fixed_menu') == '1'){
		//fixed sub, mov pf
		print("var portfoliofixedmenum = 2;");
	}else{
		//fixed both
		print("var portfoliofixedmenum = 3;");
	}
	if(is_singular('portfolio')){
		print("var portfolioprojectdirect = true;");
	}else{
		print("var portfolioprojectdirect = false;");
	}
?>
var ajaxloadingproc = false;
var ajaxcancelprocessing = false;
<?php if(get_option("flow_showcase_mode") == '3'){ print("var ajaxshowcaseisprev = true;"); }else{ print("var ajaxshowcaseisprev = false;"); } ?>

var menumousetouch = {'isopenspan':false, 'controlactive':false, 'preventdefault':false, 'allowpropagate':false, 'startposition':[-1,-1], 'endposition':[-1,-1]};

var menuisscrollable = false;
function onhovertouchclickopen(){
	menumousetouch.isopenspan = true;
	jQuery('#header').stop().animate({ 'margin-top': "0px" }, 300);
}
function onhovertouchclickclose(){
	menumousetouch.isopenspan = false;
	jQuery('#header').stop().animate({ 'margin-top': (-jQuery('#header').height()+((menuisscrollable)?0:10))+"px" }, 300);
}
function triggermenucompact(){
	var menutrigresizeopt = $(window).get(0).innerWidth;
	if(menutrigresizeopt <= 800){
		if(!menuisscrollable){
			menuisscrollable = true;
			if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/)){
			}else{
				if(!jQuery('#header .handle').length){
					jQuery('#header').append('<div class="handle"><div class="handle-pattern"></div></div>');
				}else{
					jQuery('#header .handle').css({'display':'block'});
				}
				jQuery("#header").unbind("hover").addClass("header-compact").hover(onhovertouchclickopen, onhovertouchclickclose);
				onhovertouchclickclose();
			}
		}
	}else{
		if(menuisscrollable){
			menuisscrollable = false;
			if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/)){
			}else{
				jQuery('#header .handle').css({'display':'none'});
				jQuery("#header").removeClass("header-compact").unbind("hover");
				onhovertouchclickopen();
			}
		}
	}
}
function onhovertouchbindevents(){
	if('ontouchstart' in window){
	}else{
		jQuery("#header").hover(onhovertouchclickopen, onhovertouchclickclose);
	}
}
function onhovertouchunbindevents(){
	if('ontouchstart' in window){
	}else{
		jQuery("#header").unbind("hover");
	}
}

var loadingindicatorval = false;
var loadingindicatorstart = 0;
function setloadingindicatorstart(){
	loadingindicatorstart = (new Date()).getTime();
}
function updateloadincindicatorval(){
	if(ajaxloadingproc){
		var timedel = (((new Date()).getTime())-loadingindicatorstart)/1000;
		if(timedel > 20){
			timedel = 20;
		}else if(timedel < 0){
			timedel = 0;
		}
		var loadproc = (timedel/24)*100;
		jQuery(".portfolio-indicator").text((Math.round(loadproc*10)/10)+"%");
	}else{
		if(loadingindicatorval){
			clearInterval(loadingindicatorval);
		}
	}
}
var cursorhidedelayed = false;
function appendloadingcursor(el){
	if(!jQuery('.portfolio-loadingcursor').length){
		jQuery('body').append('<img style="position:absolute;display:none;cursor:none;z-index:1500001;" class="portfolio-loadingcursor portfolio-loadingcursor-white" src="<?php print(get_bloginfo('template_directory')); ?>/images/cursors/cursor_preloader_white_a.gif" />');
		jQuery('body').append('<img style="position:absolute;display:none;cursor:none;z-index:1500001;" class="portfolio-loadingcursor portfolio-loadingcursor-black" src="<?php print(get_bloginfo('template_directory')); ?>/images/cursors/cursor_preloader_black_a.gif" />');
	}
	//jQuery(el).each(function(i,eli){
		jQuery(el).addClass("cursor-loading").unbind("hover").unbind("mousemove").hover(function(e){
			if(cursorhidedelayed){
				clearTimeout(cursorhidedelayed);
				cursorhidedelayed = false;
			}
			jQuery('.portfolio-loadingcursor').show().css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
		},function(){
			cursorhidedelayed = setTimeout(function(){
				jQuery('.portfolio-loadingcursor').hide();
			},150);
		}).mousemove(function(e){
			jQuery('.portfolio-loadingcursor').css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
		});
	//});
}
function removeloadingcursor(el){
	jQuery(el).removeClass("cursor-loading").unbind("hover").unbind("mousemove");
	jQuery('.portfolio-loadingcursor').hide();
}

var portfoliohistorywpurl = "<?php $biurl=substr(get_bloginfo("url"),7);if(strpos($biurl,"/")!==false){print(substr($biurl,strpos($biurl,"/")+1));} ?>";
var portfoliocurrentprojectid = <?php print($wp_query->post->ID?$wp_query->post->ID:"0"); ?>;
var portfoliocurrentslideactive = 0;
var ajaxloadinginstance = false;
var portfolioreqsetproject = function(prevnext){
	ajaxloadingproc = true;
	ajaxcancelprocessing = false;
	portfoliokillifaceevents();
	setloadingindicatorstart(); loadingindicatorval = setInterval(function(){updateloadincindicatorval();},100);
	setTimeout(function(){
		ajaxloadinginstance = $.ajax({ url: '<?php print(get_bloginfo("wpurl")); ?>/wp-admin/admin-ajax.php',
			data: {'action': 'nextprevproject', 'projectid': portfoliocurrentprojectid, 'prevnext': prevnext},
			//dataFilter: function(data,type){
				//alert(data);
			//},
			success: function(data){
				if(data.err){
					ajaxloadingproc = false;
					alert(data.errmsg);
				}else{
					if(!ajaxcancelprocessing){
						ajaxshowcaseisprev = false;
						var databgimagecp = "";
						var datatxtcolorcp = "";
						var datatitle = "";
						try{
							portfoliocurrentprojectid = data.projectid; 
							if(!jQuery(jQuery(".portfolio-fs-slide").get(0)).hasClass("portfolio-ppreview")){
								jQuery(".portfolio-fs-slides").css('display','none').empty();
							}else{
								jQuery(".portfolio-fs-slides .portfolio-fs-slide:not(.portfolio-ppreview)").remove();
							}
							jQuery(".portfolio-fs-slides").append(data.content);
							jQuery(".portfolio-fs-slides .myimage").each(function(i,e){
								$(".portfolio-fs-slides").append($("<div>").attr("class", "portfolio-fs-slide").html($(e).clone(true)));
								$(e).remove();
							});
							if(!jQuery(jQuery(".portfolio-fs-slide").get(0)).hasClass("portfolio-ppreview")){
								jQuery(".portfolio-fs-slides").prepend('<div class="portfolio-fs-slide current-slide"><div class="project-coverslide"></div><div id="content" class="content-projectc"><div class="project-excerpt" style="opacity:0;"><ul class="project-meta"><li class="project-date"><span class="project-meta-heading">DATE</span> <span class="project-exdate"></span></li><li class="project-client"><span class="project-meta-heading">CLIENT</span> <span class="project-exclient"></span></li><li class="project-agency"><span class="project-meta-heading">AGENCY</span> <span class="project-exagency"></span></li><li class="project-ourrole"><span class="project-meta-heading">ROLE</span> <span class="project-exourrole"></span></li></ul><div style="clear:both;"></div><h1 class="project-title" style="letter-spacing:-4px;float:left;"></h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description"></h4></div><div class="clear"></div></div></div>');
							}else{
								jQuery(".portfolio-fs-slide").removeClass("portfolio-ppreview");
								jQuery(".portfolio-fs-slides").css({'left':0,'display':'block'});
							}
							jQuery(".project-excerpt .project-title").text(data.title);
							if(!jQuery.browser.msie){
								jQuery("title").text(data.title);
							}
							jQuery(".project-excerpt .project-description").html(data.desc);
							if(!data.date){
								jQuery(".project-date").css({'display':'none'});
							}else{
								jQuery(".project-date").css({'display':'block'});
								jQuery(".project-excerpt .project-exdate").text(data.date);
							}
							if(!data.client){
								jQuery(".project-client").css({'display':'none'});
							}else{
								jQuery(".project-client").css({'display':'block'});
								jQuery(".project-excerpt .project-exclient").html(data.client);
							}
							if(!data.agency){
								jQuery(".project-agency").css({'display':'none'});
							}else{
								jQuery(".project-agency").css({'display':'block'});
								jQuery(".project-excerpt .project-exagency").html(data.agency);
							}
							if(!data.ourrole){
								jQuery(".project-ourrole").css({'display':'none'});
							}else{
								jQuery(".project-ourrole").css({'display':'block'});
								jQuery(".project-excerpt .project-exourrole").text(data.ourrole);
							}
							jQuery(".project-excerpt .project-cats").text(data.categories.join(", "));
							datatxtcolorcp = data.txtcolor;
							databgimagecp = data.bgimage;
							datatitle = data.title;
							if(!jQuery.browser.msie){
								window.history.pushState({}, data.title, ((portfoliohistorywpurl)?("/"+portfoliohistorywpurl):"")+"/portfolio/"+data.postname+"/");
							}
						}catch(e){console.log(e);}
						portfoliocurrentslideactive = 0;
						if(jQuery(".socialikonsg").length){
							jQuery(".socialikonsg").css({'display':'block', 'opacity':'0', 'right':'120px'});
						}else{
							jQuery("body").append(jQuery("<div style=\"opacity:0;\" class=\"socialikonsg\"><a href=\"javascript:void(null);\" class=\"twitter\" target=\"_blank\" title=\"Twitter\">t</a> <a href=\"javascript:void(null);\" class=\"facebook\" target=\"_blank\" title=\"Facebook\">f</a> <a href=\"javascript:void(null);\" class=\"googleplus\" target=\"_blank\" title=\"Google+\">g</a></div>"));
							try{
								jQuery(".socialikonsg a[title]").tooltip({"position": "bottom center", "tipClass": "jqttooltip", "effect":"r_fadeslide"});
							}catch(e){}
						}
						jQuery(".socialikonsg .twitter").attr("href", "https://twitter.com/share?url="+escape(window.location.href)+"&text="+escape(datatitle));
						jQuery(".socialikonsg .facebook").attr("href", "http://www.facebook.com/sharer.php?u="+escape(window.location.href)+"&t="+escape(datatitle));
						jQuery(".socialikonsg .googleplus").attr("href", "https://plus.google.com/share?url="+escape(window.location.href));
						jQuery(".portfolio-fs-slides").css({'left':0,'display':'block'});
						jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'display':'block','z-index':'1011111'});
						if(jQuery.browser.msie){
							jQuery(".portfolio-arrow-left, .portfolio-arrow-right").css({"background-image":"url(images/pixel.png)","background-repeat":"repeat" });
						}
						jQuery(".portfolio-arrow-right").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
						jQuery(".portfolio-arrow-left").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
						if(datatxtcolorcp == "#ffffff"){
							//jQuery(".myimage", jQuery(".portfolio-fs-slide").get(0)).addClass('text_white');
							jQuery("#content", jQuery(".portfolio-fs-slide").get(0)).addClass('contenttextwhite');
							jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-first');
							jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-white');
							jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-last');
							jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-first-white');
							if(jQuery(".portfolio-fs-slide").length > 1){
								jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-last-white');
								jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-white');
							}else{
								jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-white');
								jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-last-white');
							}
							jQuery(".socialikonsg a").css({'color':'#ffffff'});
							jQuery(".portfolio-cancelclose").addClass("portfolio-cancelclose-white");
						}else{
							jQuery("#content", jQuery(".portfolio-fs-slide").get(0)).removeClass('contenttextwhite');
							jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-first-white');
							jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-white');
							jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-white');
							jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-last-white');
							jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-first');
							if(jQuery(".portfolio-fs-slide").length > 1){
								jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-last');
							}else{
								jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-last');
							}
							jQuery(".socialikonsg a").css({'color':'#464646'});
						}
						jQuery(".current_sli_desc").css({'opacity':'0'});
						try{
							VideoJS.setupAllWhenReady();
							videojsvolumemuteclick();
						}catch(e){}
						
						if(loadingindicatorval){ clearInterval(loadingindicatorval); }
						$(".portfolio-loadingbar").stop().animate({'left':-200},400,function(){$(".portfolio-loadingbar").css("display","none");});
						//jQuery(".portfolio-arrow-right, .portfolio-arrow-left").removeClass("cursor-loading");
						removeloadingcursor(".portfolio-arrow-right, .portfolio-arrow-left");
						if(jQuery.browser.msie || (false && (jQuery.client.os == 'Mac' && jQuery.client.browser == 'Firefox'))){
							ierepairarrowcursorsym();
						}

						setTimeout(function(){
							jQuery(window).trigger("resize");
							jQuery(".loading").stop().animate({'opacity':'0'}, 0, function(){
								if(!ajaxcancelprocessing){
									jQuery(".loading").css({'display':'none'});
									jQuery(".project-excerpt").stop().animate({ opacity: 1 }, 400);
									jQuery(".socialikonsg").stop().animate({'opacity':1},400);
									portfolioinitifaceevents();
								}
								ajaxloadingproc = false;
							});
						}, 0);
						
						if(portfoliofixedmenum == 2){
							if(menumousetouch.isopenspan){
								onhovertouchclickclose();
								onhovertouchbindevents();
								jQuery('.imgscontainer').css({'top': "0px"});
							}
						}
					}else{
						ajaxloadingproc = false;
					}
				}
			},
			error: function(req, status, err){
				ajaxloadingproc = false;
				if(status != "abort"){
					alert("Error ("+status+"): "+err);
				}
			},
			dataType: 'json'
		});
	}, 200);
}
function stopajaxloadingaclean(){
	//if(ajaxloadingproc){
		ajaxcancelprocessing = true;
	//}
	if(ajaxloadinginstance){
		try{
			ajaxloadinginstance.abort();
		}catch(e){}
		ajaxloadinginstance = false;
	}
	removeloadingcursor(".portfolio-arrow-right, .portfolio-arrow-left");
	<?php if(get_option("flow_showcase_mode") == '3'){ ?>
	if(!ajaxshowcaseisprev){
		ajaxshowcaseisprev = true;
		recreateprojbyvalidsarr();
	}
	<?php }else{ ?>
	portfoliokillifaceevents();
	if(jQuery.browser.msie){
		removearrowcursor();
	}
	jQuery(".portfolio-fs-viewport").css({'display':'none'});
	jQuery(".portfolio-fs-slides").css({'display':'none'});
	jQuery(".portfolio-fs-slides .portfolio-fs-slide").empty();
	jQuery(".portfolio-arrow-right").stop().css({ 'display' : 'none' });
	jQuery(".portfolio-arrow-left").stop().css({ 'display' : 'none' });
	jQuery("body").css({"overflow":"auto"});
	jQuery(".moving_gallery").stop().css({top: '0px', 'position' : 'relative'});
	
	/* Shows #header and #footer on iPad/iPhone (after clicking X), second part of code is in template-portfolio.php: fg_imgpreview(). */
	if(jQuery('.imgscontainer').css('opacity') == 0){
		jQuery('.imgscontainer').css({'opacity': 1 });
		jQuery('.imgscontainer').css({'display':'block'});
	}	
	if(jQuery('#header').css('opacity') == 0){
		jQuery('#header').css({'opacity': 1 });
		jQuery('#header').stop().css({ 'margin-top': '0' });
	}	
	if(jQuery('#footer').css('opacity') == 0){
		jQuery('#footer').css({'opacity': 1 });
	}
	
	jQuery('.imgscontainer').css({'display':'block'}).stop().animate({ top: "0px" }, 300);
	<?php } ?>
	jQuery(".portfolio-loadingbar").css({'display':'none'});
	jQuery(".loading").css({'display':'none'});
	jQuery(".portfolio-cancelclose").css({'display':'none'});
	jQuery(".socialikonsg").css({'display':'none'});
	jQuery(".current_sli_desc").remove();
	try{
		if(!jQuery.browser.msie){
		jQuery("title").text("<?php print(addslashes(bloginfo('name')).' - Home'); ?>");
		window.history.pushState({}, "", ((portfoliohistorywpurl)?("/"+portfoliohistorywpurl):"")+"/");
		}
	}catch(e){}
	if(portfoliofixedmenum == 2 || portfoliofixedmenum == 3){
		if(!menuisscrollable){
			onhovertouchunbindevents();
			menumousetouch.isopenspan = true;
			jQuery(".header-arrow").css({'display':'none'});
			jQuery('.imgscontainer').stop().animate({ top: (jQuery('#header').height())+"px" });
			jQuery('#header').stop().animate({ 'margin-top': "0px" }, 300);
		}
	}
	if(menuisscrollable){
		jQuery('#header .handle').css({'display':'block'});
	}
	jQuery("#footer").css({"margin-bottom": "0px"});
	jQuery(window).trigger("resize");
}

var iecursorhidedelayed = false;
function ierepairarrowcursorsym(){
	if(!jQuery('.portfolio-arrowcursor').length){
		jQuery('body').append('<img style="position:absolute;display:none;cursor:none;z-index:1500002;}" class="portfolio-arrowcursor" src="" />');
	}
	jQuery(".portfolio-arrow-right, .portfolio-arrow-left").unbind("hover").unbind("mousemove").hover(function(e){
		if(iecursorhidedelayed){
			clearTimeout(iecursorhidedelayed);
			iecursorhidedelayed = false;
		}
		var cursorsrcarrow = "cursor_prev_black.png";
		if(jQuery(e.target).hasClass("portfolio-arrow-right")){
			if(jQuery(e.target).hasClass("portfolio-arrow-right-last-white")){
				cursorsrcarrow = "cursor_nextproject_white.png";
			}else if(jQuery(e.target).hasClass("portfolio-arrow-right-white")){
				cursorsrcarrow = "cursor_next_white.png";
			}else if(jQuery(e.target).hasClass("portfolio-arrow-right-last")){
				cursorsrcarrow = "cursor_nextproject_black.png";
			}else{
				cursorsrcarrow = "cursor_next_black.png";
			}
		}else if(jQuery(e.target).hasClass("portfolio-arrow-left")){
			if(jQuery(e.target).hasClass("portfolio-arrow-left-first-white")){
				cursorsrcarrow = "cursor_prevproject_white.png";
			}else if(jQuery(e.target).hasClass("portfolio-arrow-left-white")){
				cursorsrcarrow = "cursor_prev_white.png";
			}else if(jQuery(e.target).hasClass("portfolio-arrow-left-first")){
				cursorsrcarrow = "cursor_prevproject_black.png";
			}else{
				//default
			}
		}
		cursorsrcarrow = "<?php print(get_bloginfo('template_directory')); ?>/images/cursors/"+cursorsrcarrow;
		jQuery('.portfolio-arrowcursor').attr("src",cursorsrcarrow).show().css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
	},function(){
		iecursorhidedelayed = setTimeout(function(){
			jQuery('.portfolio-arrowcursor').hide();
		},150);
	}).mousemove(function(e){
		jQuery('.portfolio-arrowcursor').css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
	});
}
function removearrowcursor(){
	jQuery(".portfolio-arrow-right, .portfolio-arrow-left").unbind("hover").unbind("mousemove");
	jQuery('.portfolio-arrowcursor').hide();
}

var portfolioslideswidths = [];
function portfolioslidescountnleft(scrolltoslide){
	var nleftslide = 0;
	var defaultslidewidth = jQuery(window).width();
	var nleftslidescreen = 0;
	var nrightslidescreen = defaultslidewidth;
	if(scrolltoslide && scrolltoslide >= 1){
		if(portfolioslideswidths.length > scrolltoslide){
			for(var psslidei=0;psslidei<scrolltoslide;psslidei++){
				nleftslide += portfolioslideswidths[psslidei];
			}
			var nleftslideuadj = nleftslide;
			var nleftslidesum = nleftslide;
			for(var psslideis=scrolltoslide;psslideis<portfolioslideswidths.length;psslideis++){
				nleftslidesum += portfolioslideswidths[psslideis];
			}
			nleftslide -= (defaultslidewidth-portfolioslideswidths[scrolltoslide])/2;
			if(nleftslide > (nleftslidesum-defaultslidewidth)){
				nleftslide = nleftslidesum-defaultslidewidth;
				nleftslidescreen = defaultslidewidth-(nleftslidesum-nleftslideuadj);
			}else{
				nleftslidescreen = (defaultslidewidth-portfolioslideswidths[scrolltoslide])/2;
			}
			nrightslidescreen = nleftslidescreen + portfolioslideswidths[scrolltoslide];
		}else{
			for(var psslidei=0;psslidei<portfolioslideswidths.length;psslidei++){
				nleftslide += portfolioslideswidths[psslidei];
			}
			for(var psslideri=0;psslideri<(scrolltoslide-portfolioslideswidths.length);psslideri++){
				nleftslide += defaultslidewidth;
			}
		}
	}
	return {'left':-nleftslide, 'screenleft':nleftslidescreen, 'screenright':nrightslidescreen, 'screenrightabsalign':(defaultslidewidth-nrightslidescreen)};
}
var portfolioarrowright = function() {
	var allslidesl = jQuery(".portfolio-fs-slide");
	if(allslidesl.length > (portfoliocurrentslideactive+1)){
		portfoliocurrentslideactive++;
		//jQuery(".portfolio-fs-slides").stop().animate({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left}, 400);
		<?php if($ie){ ?>
		jQuery(".portfolio-fs-slides").stop().animate({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left}, {duration: 400, queue: false, easing: 'easeInOutExpo'}, function(){
			$(window).trigger("resize");
		});
		<?php }else{ ?>
		jQuery(".portfolio-fs-slides").stop().animate({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left}, {duration: 400, queue: false, easing: 'easeInOutExpo'});
		<?php } ?>
		var currentslidesl = jQuery(allslidesl.get(portfoliocurrentslideactive));
		if(currentslidesl.length){
			allslidesl.removeClass('current-slide');
			currentslidesl.addClass('current-slide');
			jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'z-index':'99999'});
			//if(portfoliofixedmenum == 2){
				if(menumousetouch.isopenspan && !ajaxshowcaseisprev){
					//onhovertouchclickclose();
					menumousetouch.isopenspan = false;
					//jQuery('#header').stop().css({ 'margin-top': (-jQuery('#header').height())+"px" });
					onhovertouchbindevents();
					//jQuery("#footer").stop().css({"margin-bottom":(-jQuery("#footer").height())+"px"});
					//jQuery('.imgscontainer').animate({'top': "0px"}, 300);
				}
				if(menuisscrollable){
					//jQuery('#header .handle').css({'display':'none'});
				}
			//}
			if(jQuery(".myimage", currentslidesl).hasClass("myvideo")){
				jQuery(".vjs-big-play-button").css({ "visibility": "visible" });
				//jQuery(".vjs-volume-control div span").next().next().remove().next().remove().next().remove();
				jQuery(".portfolio-arrow-right").css({ "height": ($(window).height()-200)+"px" }).css({ width: '15%' });
				jQuery(".portfolio-arrow-left").css({ "height": ($(window).height()-200)+"px" }).css({ width: '15%' });
			}else{
				jQuery(".vjs-big-play-button").css({ "visibility": "hidden" });
				jQuery(".portfolio-arrow-right").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
				jQuery(".portfolio-arrow-left").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
			}
			var currentslidetitle = jQuery(".myimage", currentslidesl).attr("title");
			if(currentslidetitle){
				while(currentslidetitle.indexOf('*') != -1){
					currentslidetitle = currentslidetitle.replace('*','"');
				}
				if(!jQuery(".current_sli_desc").length){
					jQuery('body').append('<div class="current_sli_desc"></div>');
				}
				//setSlideDescriptionScale();
				jQuery(".current_sli_desc").stop().css({'opacity':'0'}).html(currentslidetitle).delay(100).animate({'opacity':'1'}, 300, function(){
					setSlideDescriptionLinks()
				});
				jQuery(".video-js-box").click(function() {
					jQuery(".current_sli_desc").animate({"opacity" : "0"}, 500);
				});
			}else{
				jQuery(".current_sli_desc").stop().css({'opacity':'0'});
			}
			if(jQuery(".myimage", currentslidesl).hasClass('text_white') || jQuery("#content", currentslidesl).hasClass('contenttextwhite')){
				jQuery(".current_sli_desc").css({'color':'#ffffff'});
				jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-white');
				jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-white');
				if(allslidesl.length == (portfoliocurrentslideactive+1)){
					jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-last-white');
				}
				jQuery(".socialikonsg a").css({'color':'#ffffff'});
				jQuery(".portfolio-cancelclose").addClass("portfolio-cancelclose-white");
			}else{
				jQuery(".current_sli_desc").css({'color':'#000000'});
				jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-white');
				jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-white');
				if(allslidesl.length == (portfoliocurrentslideactive+1)){
					jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-last');
				}
				jQuery(".socialikonsg a").css({'color':'#464646'});
				jQuery(".portfolio-cancelclose").removeClass("portfolio-cancelclose-white");
			}
			jQuery(".socialikonsg").stop().animate({'right':(portfolioslidescountnleft(portfoliocurrentslideactive).screenrightabsalign+120)+"px"},300);
		}
		if(portfoliocurrentslideactive > 0){
			jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-first').removeClass('portfolio-arrow-left-first-white');
		}
	}else{
		if(ajaxshowcaseisprev){
			return;
		}
		var currentslidesl = allslidesl;//jQuery(allslidesl.get(portfoliocurrentslideactive));
		if(currentslidesl.length){
			jQuery(".myimage", currentslidesl).stop().animate({ 'opacity': 0 }, 400);
		}
		jQuery(".project-excerpt").stop().css({'opacity':'0'});
		jQuery(".current_sli_desc").css({'opacity':'0'});
		jQuery(".socialikonsg").css({'opacity':'0'});
		
		var vpcfoundi = -1;
		if(validprojsobjs.length){
			var portfoliocurrentprojectid_int = parseInt(portfoliocurrentprojectid);
			var validprojindex = -1;
			for(var tmpi=0;tmpi<validprojsobjs.length;tmpi++){
				if(validprojsobjs[tmpi].aid == portfoliocurrentprojectid_int){
					validprojindex = tmpi;
					break;
				}
			}
			var tmplupnodeid = false;
			if(validprojindex == -1){
				vpcfoundi = 0;
			}else{
				if(validprojindex == (validprojsobjs.length-1)){
					vpcfoundi = 0;
				}else{
					vpcfoundi = validprojindex+1;
				}
			}
		}
		if(vpcfoundi != -1){
			portfoliocurrentprojectid = validprojsobjs[vpcfoundi].aid;
			//jQuery(".portfolio-fs-slides").empty();
			//jQuery(".portfolio-fs-viewport").css({"z-index":26666});
			jQuery(".portfolio-fs-slide").removeClass("portfolio-ppreview");
			jQuery(".portfolio-fs-slides").css({"display":"none"}).prepend('<div class="portfolio-fs-slide current-slide portfolio-ppreview"><div class="project-coverslide"></div><div id="content" class="content-projectc contenttextwhite"><div class="project-excerpt" style="opacity:0;"><ul class="project-meta"><li class="project-date"><span class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></span> <span class="project-exdate">'+validprojsobjs[vpcfoundi].thumbdate+'</span></li><li class="project-client"><span class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></span> <span class="project-exclient">'+validprojsobjs[vpcfoundi].thumbclient+'</span></li><li class="project-agency"><span class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></span> <span class="project-exagency">'+validprojsobjs[vpcfoundi].thumbagency+'</span></li><li class="project-ourrole"><span class="project-meta-heading"><?php _e('ROLE', 'flowthemes'); ?></span> <span class="project-exourrole">'+validprojsobjs[vpcfoundi].thumborrole+'</span></li></ul><div style="clear:both;"></div><h1 class="project-title" style="letter-spacing:-4px;float:left;">'+validprojsobjs[vpcfoundi].thumb_title+'</h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description">'+validprojsobjs[vpcfoundi].thumb_descr+'</h4></div><div class="clear"></div></div></div>');
			portfoliocurrentslideactive = 0;
			jQuery(".portfolio-fs-slides").stop().css({'display':'block','left':'0'});
			jQuery(".portfolio-fs-slides .portfolio-fs-slide:not(.portfolio-ppreview)").remove();
			if(!validprojsobjs[vpcfoundi].thumbdate){
				jQuery(".project-date").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumbclient){
				jQuery(".project-client").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumbagency){
				jQuery(".project-agency").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumborrole){
				jQuery(".project-ourrole").css({'display':'none'});
			}
			//jQuery(window).trigger("resize");
			tresizewindowf();
			jQuery(".project-excerpt").stop().animate({ opacity: 1 }, 400);
		}
		
		if(!menumousetouch.isopenspan){
			onhovertouchunbindevents();
			menumousetouch.isopenspan = true;
			//jQuery('#header').stop().animate({ 'margin-top': "0px" }, 300);
			//jQuery('.imgscontainer').stop().animate({ top: (jQuery('#header').height())+"px" }, 300);
		}
		if(menuisscrollable){
			jQuery('#header .handle').css({'display':'block'});
		}
		$(".portfolio-loadingbar").stop(true).css({'display':'block','left':$(window).width()});
		$(".portfolio-loadingbar").animate({'left':0.8*$(window).width()},400,function(){
			$(".portfolio-loadingbar").animate({'left':200},20000);
		});
		if(jQuery.browser.msie){
			removearrowcursor();
		}
		appendloadingcursor(".portfolio-arrow-right, .portfolio-arrow-left");
		portfolioreqsetproject(((vpcfoundi != -1)?'this':'next'));
	}
}
var portfolioarrowleft = function() {
	var allslidesl = jQuery(".portfolio-fs-slide");
	if(portfoliocurrentslideactive > 0){
		portfoliocurrentslideactive--;
		jQuery(".portfolio-fs-slides").stop().animate({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left}, 400);
		var currentslidesl = jQuery(allslidesl.get(portfoliocurrentslideactive));
		if(currentslidesl.length){
			allslidesl.removeClass('current-slide');
			currentslidesl.addClass('current-slide');
			if(portfoliocurrentslideactive == 0){
				if(!ajaxshowcaseisprev){
					jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'z-index':'1011111'});
				}
				if(!menumousetouch.isopenspan && !ajaxshowcaseisprev){
				onhovertouchbindevents();
					//onhovertouchunbindevents();
					menumousetouch.isopenspan = true;
					//jQuery('#header').stop().animate({ 'margin-top': "0px" },300);
					//jQuery("#footer").stop().animate({"margin-bottom": "0px"},300);
					//jQuery('.imgscontainer').stop().animate({ top: (jQuery('#header').height())+"px" }, 300);
				}
				if(menuisscrollable){
					//jQuery('#header .handle').css({'display':'block'});
				}
			}
			if(jQuery(".myimage", currentslidesl).hasClass("myvideo")){
				jQuery(".vjs-big-play-button").css({ "visibility": "visible" });
				//jQuery(".vjs-volume-control div span").next().next().remove().next().remove().next().remove();
				jQuery(".portfolio-arrow-right").css({ "height": ($(window).height()-200)+"px" }).css({ width: '15%' });
				jQuery(".portfolio-arrow-left").css({ "height": ($(window).height()-200)+"px" }).css({ width: '15%' });
			}else{
				jQuery(".vjs-big-play-button").css({ "visibility": "hidden" });
				jQuery(".portfolio-arrow-right").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
				jQuery(".portfolio-arrow-left").css({ "height": ($(window).height())+"px" }).css({ width: '50%' });
			}
			var currentslidetitle = jQuery(".myimage", currentslidesl).attr("title");
			if(currentslidetitle){
				while(currentslidetitle.indexOf('*') != -1){
					currentslidetitle = currentslidetitle.replace('*','"');
				}
				if(!jQuery(".current_sli_desc").length){
					jQuery('body').append('<div class="current_sli_desc"></div>');
				}
				//setSlideDescriptionScale();
				jQuery(".current_sli_desc").stop().css({'opacity':'0'}).html(currentslidetitle).delay(100).animate({'opacity':'1'}, 300, function(){
					setSlideDescriptionLinks();
				});
			}else{
				jQuery(".current_sli_desc").stop().css({'opacity':'0'});
			}
			if(jQuery(".myimage", currentslidesl).hasClass('text_white') || jQuery("#content", currentslidesl).hasClass('contenttextwhite')){
				jQuery(".current_sli_desc").css({'color':'#ffffff'});
				jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-white');
				jQuery(".portfolio-arrow-right").addClass('portfolio-arrow-right-white');
				if(portfoliocurrentslideactive == 0){
					jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-first-white');
				}
				jQuery(".socialikonsg a").css({'color':'#ffffff'});
				jQuery(".portfolio-cancelclose").addClass("portfolio-cancelclose-white");
			}else{
				jQuery(".current_sli_desc").css({'color':'#000000'});
				jQuery(".portfolio-arrow-left").removeClass('portfolio-arrow-left-white');
				jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-white');
				if(portfoliocurrentslideactive == 0){
					jQuery(".portfolio-arrow-left").addClass('portfolio-arrow-left-first');
				}
				jQuery(".socialikonsg a").css({'color':'#464646'});
				jQuery(".portfolio-cancelclose").removeClass("portfolio-cancelclose-white");
			}
			jQuery(".socialikonsg").stop().animate({'right':(portfolioslidescountnleft(portfoliocurrentslideactive).screenrightabsalign+120)+"px"},300);
		}
		if(allslidesl.length > (portfoliocurrentslideactive+1)){
			jQuery(".portfolio-arrow-right").removeClass('portfolio-arrow-right-last').removeClass('portfolio-arrow-right-last-white');
		}
	}else{
		if(ajaxshowcaseisprev){
			return;
		}
		var currentslidesl = allslidesl;//jQuery(allslidesl.get(portfoliocurrentslideactive));
		if(currentslidesl.length){
			jQuery(".myimage", currentslidesl).stop().animate({ 'opacity': 0 }, 400);
		}
		jQuery(".project-excerpt").stop().animate({'opacity':'0'}, 400);
		jQuery(".current_sli_desc").css({'opacity':'0'});
		jQuery(".socialikonsg").css({'opacity':'0'});
		
		var vpcfoundi = -1;
		if(validprojsobjs.length){
			var portfoliocurrentprojectid_int = parseInt(portfoliocurrentprojectid);
			var validprojindex = -1;
			for(var tmpi=0;tmpi<validprojsobjs.length;tmpi++){
				if(validprojsobjs[tmpi].aid == portfoliocurrentprojectid_int){
					validprojindex = tmpi;
					break;
				}
			}
			var tmplupnodeid = false;
			if(validprojindex == -1){
				vpcfoundi = 0;
			}else{
				if(validprojindex == 0){
					vpcfoundi = validprojsobjs.length-1;
				}else{
					vpcfoundi = validprojindex-1;
				}
			}
		}
		if(vpcfoundi != -1){
			portfoliocurrentprojectid = validprojsobjs[vpcfoundi].aid;
			//jQuery(".portfolio-fs-slides").empty();
			//jQuery(".portfolio-fs-viewport").css({"z-index":26666});
			jQuery(".portfolio-fs-slide").removeClass("portfolio-ppreview");
			jQuery(".portfolio-fs-slides").css({"display":"none"}).prepend('<div class="portfolio-fs-slide current-slide portfolio-ppreview"><div class="project-coverslide"></div><div id="content" class="content-projectc contenttextwhite"><div class="project-excerpt" style="opacity:0;"><ul class="project-meta"><li class="project-date"><span class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></span> <span class="project-exdate">'+validprojsobjs[vpcfoundi].thumbdate+'</span></li><li class="project-client"><span class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></span> <span class="project-exclient">'+validprojsobjs[vpcfoundi].thumbclient+'</span></li><li class="project-agency"><span class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></span> <span class="project-exagency">'+validprojsobjs[vpcfoundi].thumbagency+'</span></li><li class="project-ourrole"><span class="project-meta-heading"><?php _e('ROLE', 'flowthemes'); ?></span> <span class="project-exourrole">'+validprojsobjs[vpcfoundi].thumborrole+'</span></li></ul><div style="clear:both;"></div><h1 class="project-title" style="letter-spacing:-4px;float:left;">'+validprojsobjs[vpcfoundi].thumb_title+'</h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description">'+validprojsobjs[vpcfoundi].thumb_descr+'</h4></div><div class="clear"></div></div></div>');
			portfoliocurrentslideactive = 0;
			jQuery(".portfolio-fs-slides").stop().css({'display':'block','left':'0'});
			jQuery(".portfolio-fs-slides .portfolio-fs-slide:not(.portfolio-ppreview)").remove();
			if(!validprojsobjs[vpcfoundi].thumbdate){
				jQuery(".project-date").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumbclient){
				jQuery(".project-client").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumbagency){
				jQuery(".project-agency").css({'display':'none'});
			}
			if(!validprojsobjs[vpcfoundi].thumborrole){
				jQuery(".project-ourrole").css({'display':'none'});
			}
			//jQuery(window).trigger("resize");
			tresizewindowf();
			jQuery(".project-excerpt").stop().animate({ opacity: 1 }, 400);
		}
		
		$(".portfolio-loadingbar").stop(true).css({'display':'block','left':$(window).width()});
		$(".portfolio-loadingbar").animate({'left':0.8*$(window).width()},400,function(){
			$(".portfolio-loadingbar").animate({'left':200},20000);
		});
		if(jQuery.browser.msie){
			removearrowcursor();
		}
		jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'display':'block','z-index':'1011111'});
		appendloadingcursor(".portfolio-arrow-right, .portfolio-arrow-left");
		//setTimeout(function(){
			//$(".loading").css('display','block').animate({'opacity':'1'}, 400);
		//}, 300);
		portfolioreqsetproject(((vpcfoundi != -1)?'this':'prev'));
	}
}
		
var portfolioscrollf = function(event){
	event = event?event:window.event;
	var del = 0;
	if(event.wheelDelta){
		del = event.wheelDelta/120;
	}
	if(event.detail){
		del = -event.detail/3;
	}
	if(del>0){
		portfolioarrowleft();
	}else if(del<0){
		portfolioarrowright();
	}
	event.stopPropagation();
	event.preventDefault();
}
		
var portfoliomousetouch = {'controlactive':false, 'allowpropagate':false, 'startposition':[-1,-1], 'endposition':[-1,-1]};
function ontouchmousestart(e){
	var prentisembed = false;
	var target = e.target;
	while(target.nodeType != 1) target=target.parentNode;
	if(jQuery(target).hasClass("portfolio-cancelclose")){
		prentisembed = true;
	}
	if(jQuery(target).hasClass("myvideo")){
		prentisembed = true;
	}
	if(target.tagName == 'EMBED' || target.tagName == 'IFRAME' || target.tagName == 'A'){
		prentisembed = true;
	}
	if(!prentisembed){
		portfoliomousetouch.controlactive = true;
		portfoliomousetouch.startposition = [-1,-1];
		portfoliomousetouch.endposition = [-1,-1];
		olmovehandlerto = false;
		jQuery("body").unbind(portfoliobindevents[1], ontouchmousemove).bind(portfoliobindevents[1], ontouchmousemove);
		e.cancelBubble = true;
		e.preventDefault();
		e.stopPropagation();
	}else{
		//jQuery("body").unbind(portfoliobindevents[0]).bind(portfoliobindevents[0], ontouchmousestart);
	}
}
function ontouchmousemove(e){
	//olmovehandlerto = false;
	if(portfoliomousetouch.controlactive){
		var t = false;
		if(e.originalEvent.touches && e.originalEvent.touches[0]){
			t = e.originalEvent.touches[0];
		}else if(e.originalEvent.changedTouches && e.originalEvent.changedTouches[0]){
			t = e.originalEvent.changedTouches[0];
		}else{
			t = e;
		}
		if(t){
			if(t.pageX){
				if(portfoliomousetouch.startposition[0] == -1){
					portfoliomousetouch.startposition[0] = t.pageX;
				}else{
					portfoliomousetouch.endposition[0] = t.pageX;
					var portfolioseposdelta = portfoliomousetouch.endposition[0] - portfoliomousetouch.startposition[0];
					jQuery(".portfolio-fs-slides").css({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left+portfolioseposdelta});
				}
			}
		}
	}
}
function ontouchmouseend(e){
	if(portfoliomousetouch.controlactive){
		var prentisembed = false;
		var parentpropevent = true;
		var target = e.target;
		while(target.nodeType != 1) target=target.parentNode;
		if(jQuery(target).hasClass("portfolio-cancelclose")){
			prentisembed = true;
			parentpropevent = false;
		}
		if(jQuery(target).hasClass("myvideo")){
			prentisembed = true;
			parentpropevent = false;
		}
		if(target.tagName == 'EMBED' || target.tagName == 'IFRAME' || target.tagName == 'A'){
			prentisembed = true;
		}
		jQuery("body").unbind(portfoliobindevents[1], ontouchmousemove);
		if(portfoliomousetouch.startposition[0] != -1 && portfoliomousetouch.endposition[0] != -1){
			var portfolioseposdelta = portfoliomousetouch.endposition[0] - portfoliomousetouch.startposition[0];
			if(portfolioseposdelta){
				if(Math.abs(portfolioseposdelta) >= 50){
					if(portfolioseposdelta > 0){
						portfolioarrowleft();
					}else if(portfolioseposdelta < 0){
						portfolioarrowright();
					}
				}else{
					jQuery(".portfolio-fs-slides").stop().animate({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left}, 400);
				}
				portfoliomousetouch.allowpropagate = false;
				if(parentpropevent){
					e.preventDefault();
				}
				if(!prentisembed){
					e.stopPropagation();
				}
			}else{
				portfoliomousetouch.allowpropagate = true;
			}
		}else{
			portfoliomousetouch.allowpropagate = true;
		}
		portfoliomousetouch.controlactive = false;
	}
}
var portfoliokeyboardonce = false;
function portfolioinitifaceevents(){
	jQuery(".portfolio-arrow-right").click(function(e){
		if(!portfoliomousetouch.controlactive && portfoliomousetouch.allowpropagate){
			<?php if(get_option("flow_showcase_mode")=='3'){ ?>
				if(ajaxshowcaseisprev){
					if(jQuery(".portfolio-fs-slide").length > portfoliocurrentslideactive){
						var emposelem = jQuery(".project-view", jQuery(jQuery(".portfolio-fs-slide").get(portfoliocurrentslideactive)));
						var emposoffset = emposelem.offset();
						if(e.pageX >= emposoffset.left && e.pageX <= (emposoffset.left+emposelem.width()) && e.pageY >= emposoffset.top && e.pageY <= (emposoffset.top+emposelem.height())){
							fg_imgpreview.apply(emposelem);
							return false;
						}
					}
				}
			<?php } ?>
			portfolioarrowright();
		}
	});
	jQuery(".portfolio-arrow-left").click(function(e){
		if(!portfoliomousetouch.controlactive && portfoliomousetouch.allowpropagate){
			<?php if(get_option("flow_showcase_mode")=='3'){ ?>
				if(ajaxshowcaseisprev){
					if(jQuery(".portfolio-fs-slide").length > portfoliocurrentslideactive){
						var emposelem = jQuery(".project-view", jQuery(jQuery(".portfolio-fs-slide").get(portfoliocurrentslideactive)));
						var emposoffset = emposelem.offset();
						if(e.pageX >= emposoffset.left && e.pageX <= (emposoffset.left+emposelem.width()) && e.pageY >= emposoffset.top && e.pageY <= (emposoffset.top+emposelem.height())){
							fg_imgpreview.apply(emposelem);
							return false;
						}
					}
				}
			<?php } ?>
			portfolioarrowleft();
		}
	});

	jQuery(window).keydown(function(e){
		if(!portfoliokeyboardonce){
			portfoliokeyboardonce = true;
			if(!portfoliomousetouch.controlactive){
				if(e.keyCode == 37 || e.keyCode == 38){
					portfolioarrowleft();
				}else if(e.keyCode == 39 || e.keyCode == 40){
					portfolioarrowright();
				}
			}
		}
	});
	jQuery(window).keyup(function(e){
		portfoliokeyboardonce = false;
	});
	
	if(jQuery("body").length){
		var portfolioscrollobj = jQuery("body").get(0);
		if(portfolioscrollobj.addEventListener){
			portfolioscrollobj.addEventListener('DOMMouseScroll', portfolioscrollf, false);
			portfolioscrollobj.addEventListener('mousewheel', portfolioscrollf, false);
		}else if(portfolioscrollobj.attachEvent){
			portfolioscrollobj.attachEvent('onmousewheel', portfolioscrollf);
		}
	}
	
	portfoliomousetouch.controlactive = false;
	jQuery("body").bind(portfoliobindevents[0], ontouchmousestart);
	jQuery("body").bind(portfoliobindevents[2], ontouchmouseend);
}
function portfoliokillifaceevents(){
	jQuery(".portfolio-arrow-right").unbind('click');
	jQuery(".portfolio-arrow-left").unbind('click');
	
	jQuery(window).unbind('keypress');
	
	jQuery("body").unbind(portfoliobindevents[0], ontouchmousestart).unbind(portfoliobindevents[1], ontouchmousemove).unbind(portfoliobindevents[2], ontouchmouseend);
	
	var portfolioscrollobj = jQuery("body").get(0);
	if(portfolioscrollobj.removeEventListener){
		portfolioscrollobj.removeEventListener('DOMMouseScroll', portfolioscrollf, false);  
		portfolioscrollobj.removeEventListener('mousewheel', portfolioscrollf, false);
	}else if(portfolioscrollobj.detachEvent){
		portfolioscrollobj.detachEvent('onmousewheel', portfolioscrollf);
	}
	
	jQuery(".project-coverslide, .content-projectc").unbind("click");
}

/*function setDescriptionScale_cov() {
	var currentmargin = $(window).width()*0.07;
	if(currentmargin <= 80){ currentmargin = 80; }
	jQuery('#content').stop().css({ 'margin-left': currentmargin+"px" });
	jQuery('#content').stop().css({ 'bottom': currentmargin+"px" });
	jQuery('.overview:not(.overview_news)').stop().css({ 'margin-left': currentmargin+"px" }); 
}*/

function setSlideDescriptionLinks() {
	$('.current_sli_desc A').click(function(){
		window.open($(this).attr('href'));
		return false;
	});
}
/*function setBlogLinks() {
	$('.excerpt-blog A').click(function(){
		window.open($(this).attr('href'));
		return false;
	});
}*/

/* function resizeimageslide(ielement,isvideo,chkpushwidthtoarr){
	var iel = jQuery(ielement);
	
	var winheight = window.innerHeight ? window.innerHeight:$(window).height();
	var fg_imgareaw = $(window).width(), fg_imgareah = winheight;
	var fg_imgsize = [iel.width(), iel.height()];
	
	<?php //if($ie){ ?>
	var my_img = iel[0];
	if(jQuery(my_img).is('img')){
		jQuery("<img/>").attr('src', jQuery(my_img).attr('src')).load(function(){
			var original_width = this.width;
			var original_height = this.height;
			var fg_imgsize = [original_width, original_height];
		});
	}
	<?php //} ?>
	
	var fg_fitscreen = false;
	if(iel.hasClass("slide_horizontal")){
		fg_fitscreen = true;
	}
	if(isvideo){
		fg_imgsize = [16,9];
	}
	if(iel.is("div")){
		fg_imgsize = [fg_imgareaw, fg_imgareah];
		resizeimageslide($("img:not(.myimage)", iel),false,false);
	}
	if(fg_imgsize[0] && fg_imgsize[1] && fg_imgareaw && fg_imgareah){
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
				$(".video-js", iel).css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
				if(chkpushwidthtoarr){
					portfolioslideswidths[portfolioslideswidths.length] = fg_imgareaw;
				}
			}
		}
	}else{
		return false;
	}
	return true;
} */
function resizeimageslide(ielement,isvideo,chkpushwidthtoarr){
	var iel = jQuery(ielement);
	/* Create slideshow container, var winheight is height() fix for iPhone */
	var winheight = window.innerHeight ? window.innerHeight:$(window).height();
	var fg_imgareaw = $(window).width(), fg_imgareah = winheight;
	var fg_imgsize = [iel.width(), iel.height()];
	
	function resizeimageslideint(fg_imgsize, arrwindex){
		var fg_fitscreen = false;
		if(iel.hasClass("slide_horizontal")){
			fg_fitscreen = true;
		}
		if(isvideo){
			fg_imgsize = [16,9];
		}
		if(iel.is("div")){
			fg_imgsize = [fg_imgareaw, fg_imgareah];
			resizeimageslide($("img:not(.myimage)", iel),false,false);
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
				//console.log(fg_imgsize[0]+'|'+fg_imgsize[1]+'|'+fg_imgnewsizew+'|'+fg_imgnewsizeh+'|'+fg_imgareah+'|'+fg_imgareaw+'|'+fg_fitscreen+'|'+fg_imgscalerx+'|'+fg_imgscalery);
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
								portfolioslideswidths[arrwindex] = fg_imgnewsizew;
							}else{
								portfolioslideswidths[arrwindex] = fg_imgareaw;
							}
						}
					}else{
						//console.log(iel);
						//console.log("top: "+Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+" left: "+(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+" width: "+fg_imgnewsizew+" height: "+fg_imgnewsizeh+".");
						iel.css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
						if(chkpushwidthtoarr){
							portfolioslideswidths[arrwindex] = fg_imgareaw;
						}
					}
				}else{
					$(".video-js", iel).css({'top':Math.floor((fg_imgareah-fg_imgnewsizeh)/2)+'px', 'left':(Math.floor((fg_imgareaw-fg_imgnewsizew)/2))+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
					if(chkpushwidthtoarr){
						portfolioslideswidths[arrwindex] = fg_imgareaw;
					}
				}
			}
		}else{
			return false;
		}
		return true;
	}
		
	<?php if($ie){ ?>
	
	var arrwindexl = 0;
	if(chkpushwidthtoarr){
		arrwindexl=portfolioslideswidths.length;
		portfolioslideswidths[arrwindexl]=fg_imgareaw;
	}
	
	var my_img = iel[0];
	if(jQuery(my_img).is('img')){
		jQuery("<img/>").one('load', function(){
			var original_width = this.width;
			var original_height = this.height;
			fg_imgsize = [original_width, original_height];
			//console.log(fg_imgsize);
			
			resizeimageslideint(fg_imgsize, arrwindexl);
		}).attr('src', jQuery(my_img).attr('src'));
	}
	
	/* my_img2 = new Image();
	my_img2.src = jQuery(my_img).attr('src');
	if(my_img2.complete){
		somefunc();
	} else {
		my_img2.attachEvent( "onload", somefunc );
		my_img2.src = my_img2.src;
	}
	
	function somefunc(){
		var original_width = this.width;
		var original_height = this.height;
		var fg_imgsize = [original_width, original_height];
	} */
	return true;
	<?php }else{ ?>
	return resizeimageslideint(fg_imgsize, portfolioslideswidths.length);
	<?php } ?>
}
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
		jQuery('#scrollbar2 .overview_dribbble').css({'width' : (420*scrollbar_width)+(1/2)*$(window).width()+"px" });
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
				jQuery('.scrollbar-arrowleft').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2-newsposd.arrowwidth)+"px", 'top':(110+newscposrel.top)+"px"});
				jQuery('.scrollbar-arrowright').css({'left':((jQuery(window).width()-newsposd.viewportwidth)/2+newsposd.viewportwidth)+"px", 'top':(110+newscposrel.top)+"px"});
			}
		}
	}
}
function getcthumbnailsize(){
	var windowwidther = Math.min(1600,$(window).width());
	/*var scalingfactor = 220;
	if(windowwidther <= 800){
		scalingfactor = 220;
	}else if(windowwidther >= 1600){
		scalingfactor = 400;
	}else{
		scalingfactor = 9*windowwidther/40+40;
	}
	var imagesinrow = Math.floor(windowwidther / scalingfactor);*/
	var imagesinrow = 4;
	if(windowwidther <= 400){
		imagesinrow = 1;
	}else if(windowwidther <= 720){
		imagesinrow = 2;
	}else if(windowwidther <= 1024){
		imagesinrow = 3;
	}
	var newimagewidth = Math.floor(windowwidther / imagesinrow);
	return newimagewidth;
}
function getnewscontentwidths(){
	var arrowwidth = 110;
	var newsbmargins = 15;
	var windowwidther = Math.max(50, Math.min(1200-2*arrowwidth,$(window).width()-2*arrowwidth));
	var newsviewed = 3; //Math.max(1, Math.min(3, Math.ceil(windowwidther/533)));
	if(windowwidther < 800){
		newsviewed = 2;
	}
	var newsbwidth = 350;
	if(windowwidther < 700){
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
var stoutresize = false;
function tresizewindowf(){
	/* Create slideshow container, var winheight is height() fix for iPhone */
	var winheight = window.innerHeight ? window.innerHeight:$(window).height();
	//$(".portfolio-fs-viewport, .portfolio-fs-slide").css({'width':$(window).width(), 'height':$(window).height()});
	$(".portfolio-fs-viewport, .portfolio-fs-slide").css({'width':$(window).width(), 'height':winheight});
	if(portfoliofixedmenum == 3){
	} 
	if($(".portfolio-fs-slide").length){
		//$(".portfolio-fs-slides").css({'width': ($(".portfolio-fs-slide").length*$(window).width()), 'height':$(window).height()});
		$(".portfolio-fs-slides").css({'width': ($(".portfolio-fs-slide").length*$(window).width()), 'height':winheight});
	}
	
	resizeimageslide($("#myimage_original"),false,false);
	portfolioslideswidths = [];
	if($(".portfolio-fs-slide").length && !$(".myimage", $($(".portfolio-fs-slide").get(0))).length){
		portfolioslideswidths[0] = $(window).width();
	}
	//$(".myimage:not(.myvideo)").each(function(i,e){
	var reqrerun = false;
	$(".myimage").each(function(i,e){
		var trslt = true;
		if($(e).hasClass("myvideo")){
			trslt = resizeimageslide(e,true,true);
		}else{
			trslt = resizeimageslide(e,false,true);
		}
		if(!trslt){
			reqrerun = true;
		}
	});
	//$(".myimage.myvideo").each(function(i,e){
		//resizeimageslide(e,true,true);
	//});
	//$(".myimage.myvideo:not(.current_sli)").css({'margin-left':($(window).width())+"px"});
	
	if(portfoliocurrentslideactive){
		$(".portfolio-fs-slides").stop().css({'left':portfolioslidescountnleft(portfoliocurrentslideactive).left});
	}
	
	if(reqrerun){
		if(!stoutresize){
			stoutresize = setTimeout(function(){
				stoutresize = false;
				tresizewindowf();
			},500);
		}
	}
}
function videojsvolumemuteclick(){
	jQuery(".vjs-volume-control").click(function() {
		if(jQuery(".video-js").prop('muted')){
			jQuery(".video-js").prop('muted', false).prop('volume', 1);
		}else{
			jQuery(".video-js").prop('muted', true).prop('volume', 0);
		}
	});
}
var tiscrollbpositionleft = 0;
var sbnewsscrollbar = false;
jQuery(document).ready(function() {
	if($(".slides-depr").length){
		$(".portfolio-fs-slides .slides-depr .myimage").each(function(i,e){
			$(".portfolio-fs-slides").append($("<div>").attr("class", "portfolio-fs-slide").html($(e).clone(true)));
			$(e).remove(); 
		});
		$(".slides-depr").remove();
		jQuery(jQuery(".portfolio-fs-slide").get(0)).addClass('current-slide');
	}
	if($(".portfolio-fs-slide").length){
		if($(".myimage", $(".portfolio-fs-slide").get(0)).length){
			jQuery("#myimage_original").css({'display':'none'});
			$(".myimage", $(".portfolio-fs-slide").get(0)).animate({'opacity':'1'}, 400);
		}
	}
	
	<?php if(!is_home()){ ?>
		jQuery("body").stop().delay(400).animate({ opacity: "1" }, 700);
		jQuery('.imgscontainer').stop().css({ top: $(window).height()+"px", 'display':'none'});
	<?php }else{ ?>
		jQuery("body").stop().css({ 'overflow-y' : 'auto' });
	<?php } ?>
	<?php if(is_singular('portfolio')){ ?>
		portfolioinitifaceevents();
	<?php } ?>
	
	jQuery('.imgscontainer').css({'margin':'0 auto 0 auto','left':'0px','right':'0px'});
	if(portfoliofixedmenum == 1 || (portfolioprojectdirect && portfoliofixedmenum==2)){
		jQuery('.imgscontainer').css({ left: "0px", 'width': Math.min(1600,jQuery(window).width())+'px'});
		onhovertouchbindevents();
	}else{
		menumousetouch.isopenspan = true;
		jQuery('#header').css({ 'margin-top': "0px" });
		if(portfolioprojectdirect){
		}else{
		}
		jQuery('.imgscontainer').css({ 'top': (jQuery("#header").height())+'px', 'width': Math.min(1600,jQuery(window).width())+'px'});
	}
	
	$(window).resize(function(){
		jQuery(".video-js, .vjs-poster, .video-js-thumb, .vjs-flash-fallback").css({"width":$(window).width(), "height":$(window).height()});
		jQuery(".video-js-box").css("width", $(window).width());
		jQuery(".video-js-box").css({ "display" : "block" });
		if(portfoliofixedmenum == 1 || (portfolioprojectdirect && portfoliofixedmenum==2)){
		}else{
			jQuery('.imgscontainer').css({ left: "0", 'width': Math.min(1600,jQuery(window).width())+'px'});
		}

		jQuery(".vvqbox").stop().css({ "width": ($(window).width()-10)+"px" }).css({ "height": ($(window).height())+"px"  });
		
		var newimagewidth = getcthumbnailsize();
		$(".imgcontainer, .imgcontainer img").css({width: newimagewidth});
		
		tresizewindowf();
		resizenewsdribbcontent();
		triggermenucompact();
	});
	
	var thisfnoverflowev = function(){
		var newimagewidth = getcthumbnailsize();
		$(".imgcontainer, .imgcontainer img").css({width: newimagewidth});
		$(window).unbind("overflow", thisfnoverflowev);
	}
	$(window).bind("overflow", thisfnoverflowev);
	var thisfnoverflowchev = function(){
		var newimagewidth = getcthumbnailsize();
		$(".imgcontainer, .imgcontainer img").css({width: newimagewidth});
		$("body").unbind("overflowchanged", thisfnoverflowchev);
	}
	$("body").bind("overflowchanged", thisfnoverflowchev);
	
	tresizewindowf();
	triggermenucompact();
	
	if(jQuery(".menuhoversubcats").length){
		jQuery(".menuhoversubcats ul").css({"overflow-y":"hidden"});
		jQuery(".menuhoversubcats").each(function(oi,oe){
			(function(lel){
				var tleltimer = false;
				jQuery("ul",lel).css({'height':0});
				jQuery(lel).hover(function(){
					if(tleltimer){
						clearTimeout(tleltimer);
					}
					jQuery("ul",lel).css("display","block").stop().animate({'height':(jQuery("ul li", lel).length*16)+"px"},200);
				}, function(){
					tleltimer = setTimeout(function(){
						jQuery("ul",lel).stop().animate({'height':0},200,function(){jQuery(this).css("display","none");});
					},100);
				});
			})(oe);
		});
	}
	/*jQuery("#header, .slides, .slides .myimage, #footer, .content-projectc, body").each(function(){
		$(this).attr('unselectable', 'on').css({'-moz-user-select':'none', '-webkit-user-select':'none', 'user-select':'none' }).each(function(){ this.onselectstart = function(){ return false; }; });
	});*/
		
	jQuery(".pf_nav a").click(function(){
		stopajaxloadingaclean();
		<?php if(get_option("flow_showcase_mode") != '3'){ ?>
		jQuery("#content").stop().css({'display':'none'});
		jQuery(".page_description").stop().css({'display':'none'});
		jQuery(".myimage", jQuery(".portfolio-fs-slide").get(0)).stop().css({ 'display' : 'none' });
		<?php } ?>
		jQuery("#myimage_original").stop().css({ 'display' : 'none' });
		jQuery(".news-content, .cooming-soon-content").css({'display':'none'});
		jQuery(".cooming-soon-content").stop().animate({ marginTop: ~$(window).height() }, 500);
		jQuery(".news-content").stop().animate({ marginTop: ~$(window).height() }, 500);
		jQuery(".video-js").stop().delay(500).remove();
		jQuery("#menu li").removeClass("current_page_item");
	});
	
	resizenewsdribbcontent();
	jQuery("#content").css({'display':'block'}).delay(500).animate({'opacity':'1'}, 400);

	try{
		VideoJS.setupAllWhenReady();
		videojsvolumemuteclick();
	}catch(e){}
	
	if(jQuery.browser.msie){
		if(jQuery(".portfolio-arrow-right, .portfolio-arrow-left").length){
			ierepairarrowcursorsym();
		}
	}
});
</script>
<?php //if($ie){ ?>
	<script>
	jQuery(window).load(function(){
		setTimeout(function(){
			jQuery(window).trigger("resize");
		}, 500);
		<?php if($ie){ ?>
			setTimeout(function(){
				jQuery(window).trigger("resize");
				setTimeout(function(){
					jQuery(window).trigger("resize");
				}, 4500);
			}, 1500);
		<?php } ?>
	});
	</script>
<?php //} ?>
<?php if( (is_page() && !is_page_template()) or is_page_template( 'template-coming-soon2.php' ) or is_page_template( 'template-two-columns.php' ) or is_page_template( 'template-news.php' ) or is_page_template( 'template-content-slider.php' ) ){ ?>
	<script type="text/javascript">
	// This script centers content on News, About, Coming soon, Contact, Services vertically on resolutions width >= 1440 (by Flow)
		function flow_center_content() {
			if(jQuery(window).width() >= 1440){
				var heading_height = jQuery(".page-title").outerHeight(true);
				var heading_margin_bottom = parseInt(jQuery(".page-title").css('marginBottom'));
				var content_height = jQuery(".page-content").outerHeight(true);
				var contact_height = jQuery(".contact-page").outerHeight(true);
				var pagewrapper_height = jQuery(".pageWrapper").outerHeight(true);
				var news_height = jQuery(".news-container-outer").outerHeight(true);
				var description_height = jQuery(".page-description").outerHeight(true);
				var window_height = jQuery(window).innerHeight();
				var content_margin = parseInt(jQuery(".page-content").css('marginTop'));
				var contact_margin = parseInt(jQuery(".contact-page").css('marginTop'));
				var pagewrapper_margin = parseInt(jQuery(".pageWrapper").css('marginTop'));
				var news_margin = parseInt(jQuery(".news-container-outer").css('marginTop'));
				if((content_height+description_height)-100 >= window_height){ }else{ //Prevents centering long pages (window.height - 200px)
					jQuery(".page-content").css({"margin-top": (((window_height-heading_height)-(description_height+content_height-content_margin))/2)-30 });
				}
				if((contact_height+description_height)-200 >= window_height){ }else{ //Prevents centering long contact pages (window.height - 200px)
					//jQuery(".contact-page").css({"margin-top": (((window_height-heading_height)-(description_height+contact_height-contact_margin))/2)-30 });
				}
				jQuery(".pageWrapper").css({"margin-top": (((window_height-heading_height)-(description_height+pagewrapper_height-pagewrapper_margin))/2)-30 });
				jQuery(".news-container-outer").css({"margin-top": (((window_height-heading_height)-(description_height+news_height-news_margin))/2)-30 });
				jQuery(".scrollbar-arrowleft, .scrollbar-arrowright").css({"top": (((window_height-heading_height)-(description_height+news_height-news_margin))/2)-30+heading_height+95 });
			}else{
				jQuery(".page-content").css({"margin-top": 0 });
				//jQuery(".contact-page").css({"margin-top": 0 });
				jQuery(".pageWrapper").css({"margin-top": 0 });
				jQuery(".news-container-outer").css({"margin-top": 0 });
			}
		}
		jQuery(document).ready(function(){
			flow_center_content();
			jQuery(window).resize(function(){
				flow_center_content();
			});
		});
	</script>
<?php } ?>
<style type="text/css">
	.portfolio-fs-viewport{ width:1920px; height:1080px; overflow:hidden; position:fixed; top:0; left:0; }
	.portfolio-fs-slides{ width:20000px; position:relative; left:0; }
	.portfolio-fs-slides .portfolio-fs-slide{ width:2560px; height:2560px; overflow:hidden; float:left; }
	.portfolio-fs-slides .portfolio-fs-slide .myimage{ position:relative; top:0; left:0; }
	<?php if(($mac && $firefox) || ($mac && $opera)){ ?>
	.portfolio-arrow-right {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_next_black.png") no-repeat scroll 94% center transparent;
		cursor: pointer;
	}	
	.portfolio-arrow-right-white {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_next_white.png") no-repeat scroll 94% center transparent;
		cursor: pointer;
	}
	.portfolio-arrow-left {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_prev_black.png") no-repeat scroll 6% center transparent;
		cursor: pointer;
	}	
	.portfolio-arrow-left-white {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_prev_white.png") no-repeat scroll 6% center transparent;
		cursor: pointer;
	}
	.portfolio-arrow-left-first {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_prevproject_black.png") no-repeat scroll 6% center transparent;
		cursor: pointer;
	}		
	.portfolio-arrow-left-first-white {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_prevproject_white.png") no-repeat scroll 6% center transparent;
		cursor: pointer;
	}
	.portfolio-arrow-right-last {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_nextproject_black.png") no-repeat scroll 94% center transparent;
		cursor: pointer;
	}
	.portfolio-arrow-right-last-white {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_nextproject_white.png") no-repeat scroll 94% center transparent;
		cursor: pointer;
	}
	/* First is always white */
	.portfolio-arrow-left-first {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_prevproject_white.png") no-repeat scroll 6% center transparent;
		cursor: pointer;
	}
	.portfolio-arrow-left-first + .portfolio-arrow-right {
		background: url("<?php bloginfo('template_directory'); ?>/images/cursors/cursor_next_white.png") no-repeat scroll 94% center transparent;
		cursor: pointer;
	}
	<?php } ?>
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE')){ ?>
		.pageWrapper { display: none!important; }
		.dribbble-image-mobile, .dribbble-image-mobile img, .dribbble-title-mobile, .pageWrapper-mobile { display: block!important; }
	<?php } ?>
</style>
<?php
if(get_option("bgchanger_color")){
	print("<style type=\"text/css\">body{background-color:".get_option("bgchanger_color").";}</style>");
	print("<style type=\"text/css\">body{background-color:".get_post_meta($post->ID, 'bg_color', true).";}</style>");
	print("<style type=\"text/css\">.portfolio-fs-slide{background-color:".get_option("bgchanger_color").";} .portfolio-fs-slide:first-child { background-color: transparent; }</style>");
}
?>
<?php
	if($_GET['style'] == 'dark') { $_SESSION['stylemode']=0; }
	if($_GET['style'] == 'light') { $_SESSION['stylemode']=1; }
	$cur_style = get_option("website_style");
	if(isset($_SESSION['stylemode']) && ($_SESSION['stylemode'] == 0)){ $cur_style = 0; }
	if(isset($_SESSION['stylemode']) && ($_SESSION['stylemode'] == 1)){ $cur_style = 1; }
	if ($cur_style == 1) { ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/light.css" />

	<?php if($_SERVER['SERVER_NAME'] == 'themes.devatic.com'){ ?>
		<!-- demo only -->
		<script type="text/javascript">
		jQuery(document).ready(function(){
			var new_logo = "<?php bloginfo('template_directory'); ?>/images/logo-black.png";
			jQuery('#logo-image img').attr("src",new_logo);
		});
		</script>
		<style type="text/css">
		#myimage_original { display: none!important; }
		body { background-color: #ffffff; background-image: none; }
		</style>
		<!-- /demo only -->
	<?php } ?>

<?php }else{ ?>
<style type="text/css">
	.portfolio-loadingcursor-black { display: none!important; }
	body { background-image: none; }
</style>
<?php } ?>
</head>

<body <?php if(!isset($class)){ $class = ''; } body_class( $class ); ?>>
<div class="header-search-form" style="display:none;"><div class="header-search-label"><?php _e('What are you looking for?', 'flowthemes'); ?></div><?php get_search_form(); ?></div>
<div class="loading"></div>

<?php if(($bgcval_bi2 = get_post_meta($post->ID, 'bg_image', true)) or ($bgcval_bi = get_option("bgchanger_imgsrc") and get_option("bgchanger_imgsrc") != '')) { ?>
<img src="<?php if($bgcval_bi2){echo $bgcval_bi2;}else if($bgcval_bi = get_option("bgchanger_imgsrc") and get_option("bgchanger_imgsrc") != ''){echo $bgcval_bi;}else{echo'';} ?>" alt="" id="myimage_original" style="display: block; overflow: hidden; position: fixed;z-index:-1; opacity:0;">
<?php } ?>

<header id="header">
	<div class="inner clearfix">
	<?php $logo_type = get_option('logo_type');
	if(preg_match('/^.*\.(jpg|jpeg|png|gif|ico)$/i', $logo_type)){
		$blog_url = get_home_url();
		$blog_desc = get_bloginfo('description');
		echo "<div id=\"logo-image\"><a title=\"". $blog_desc ."\" href=\"". $blog_url ."\"><img src=\"".$logo_type."\" alt=\"" . $blog_desc . "\" /></a><div class=\"clear\"></div></div>";
	} else { ?>
	<div id="logo-text">
		<div class="logo-text-inner">
			<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php if(get_option('tagline_disable') == 0){ ?>
			<div id="tagline">
				<a rel="home" title="<?php bloginfo('description'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('description'); ?></a>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php } ?>
	<nav id="main-nav">
		<div class="menu-col clearfix">
			<div class="menu-title"><?php _e('PAGES', 'flowthemes'); ?></div>
			<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location'=>'main_menu', 'menu_class'=>'sf-menu sf-js-enabled sf-shadow', 'menu_id'=>'menu' ) ); ?>
		</div>
		<div class="menu-col clearfix">
			<div class="menu-title"><?php _e('WORKS', 'flowthemes'); ?></div>
			<ul class="pf_nav">
				<li <?php if(is_home() or is_singular("portfolio")){ echo 'class="selected"'; } ?>><a title="all" href="#"><?php _e('ALL WORKS', 'flowthemes'); ?></a></li>
				<?php
					$arraycatss = get_terms("portfolio_category");
					$arrcatsnested = array();
					$arrcatgli = 0;
					foreach($arraycatss as $arraycatss_a){
						if($arraycatss_a->parent == 0){
							$arrcatsnested[$arrcatgli] = array('obj'=>$arraycatss_a, 'childobjs'=>array());
							foreach($arraycatss as $arraycatss_achild){
								if($arraycatss_achild->parent == $arraycatss_a->term_id){
									$arrcatsnested[$arrcatgli]['childobjs'][] = $arraycatss_achild;
								}
							}
							$arrcatgli++;
						}
					}
					//foreach($arraycatss as $arraycatss_a){
						//echo '<li><a title="'.$arraycatss_a->slug.'" href="javascript:void(null);">'.$arraycatss_a->name.'</a></li>';
					//}
					for($ci=0;$ci<count($arrcatsnested);$ci++){
						print('<li'.((count($arrcatsnested[$ci]['childobjs'])?" class=\"menuhoversubcats\"":"")).'><a title="'.$arrcatsnested[$ci]['obj']->slug.'" href="javascript:void(null);">'.$arrcatsnested[$ci]['obj']->name.'</a>');
						if(count($arrcatsnested[$ci]['childobjs'])){
							print("<ul style=\"display:none;\">");
							for($cj=0;$cj<count($arrcatsnested[$ci]['childobjs']);$cj++){
								print('<li><a title="'.$arrcatsnested[$ci]['childobjs'][$cj]->slug.'" href="javascript:void(null);">'.$arrcatsnested[$ci]['childobjs'][$cj]->name.'</a></li>');
							}
							print("</ul>");
						}
						print("</li>");
					}
				?>
			</ul>
		</div>
		<div class="clear"></div>
	</nav>
	<div class="header-search" style="display:none;">L</div>
</div> <!-- /.inner -->
<img src="<?php bloginfo('template_directory'); ?>/images/header-arrow.png" class="header-arrow" style="display:none;">
<div class="load-fonts-div">
<span class="load-fonts1">&nbsp;</span>
<span class="load-fonts2">&nbsp;</span>
<span class="load-fonts3">&nbsp;</span>
<span class="load-fonts4">&nbsp;</span>
<span class="load-fonts5">&nbsp;</span>
<span class="load-fonts6">&nbsp;</span>
<span class="load-fonts7">&nbsp;</span>
</div>
</header>