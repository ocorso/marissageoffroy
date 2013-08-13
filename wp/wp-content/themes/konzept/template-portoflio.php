<?php get_header(); ?>
<?php $count = 0;
$pf_category[0] = get_option('portfolio_pages');
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  if(is_home()){ $post_per_page = -1; }else{ $post_per_page = -1; }
  $do_not_show_stickies = 1; // 0 to show stickies
  $pf_categorynotin = get_post_meta($wp_query->post->ID, "exclude-pf-categories", true);
  if(is_home() && get_option("flow_portfolio_orderbymethod")!="1"){ $orderby = 'rand'; } else { $orderby = 'date'; }
  $fldispmethod = get_option("flow_showcase_mode");
  $nshowtxth = 1; //1-thumbs; 2-text; 3-sshow
  if($fldispmethod == '2'){
	$nshowtxth = 2;
  }else if($fldispmethod == '3'){
	$nshowtxth = 3;
  }

	if($_GET['prj'] == 'thumb') { $_SESSION['webmode']=1; }
	if($_GET['prj'] == 'list') { $_SESSION['webmode']=2; }
	if($_SESSION['webmode'] == 2){ $nshowtxth = 2; }
	if($_SESSION['webmode'] == 1){ $nshowtxth = 1; }
	
  $args=array(
    'post_type' => array ('portfolio'),
    'orderby' => $orderby,
    'order' => 'DESC',
    'paged' => $paged,
    'posts_per_page' => $post_per_page,
    'ignore_sticky_posts' => $do_not_show_stickies
  );
	if($pf_categorynotin){
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'slug',
				'terms' => $pf_categorynotin,
				'operator' => 'NOT IN'
			)
		); //category__in
	}
?>
<ul style="display: block;position: absolute; overflow-x: hidden;" class="imgscontainer portfolio-v6-items<?php if($nshowtxth==2){print(" homepage-project-list");} ?>">
<?php
  $temp = $wp_query;  // assign orginal query to temp variable for later use   
  $wp_query = null;
  $wp_query = new WP_Query($args);
  $fg_image = '';
  $fg_imagemain = '';
  if( have_posts() ) : 
		while ($wp_query->have_posts()) : $wp_query->the_post();
			$post_cat = array();
			$post_cat = wp_get_object_terms($post->ID, "portfolio_category");
			$post_cats = array();
			$post_rel = ' all ';
			for($h=0;$h<count($post_cat);$h++){
				$post_rel .= $post_cat[$h]->slug.' ';
				$post_cats[] = $post_cat[$h]->name;
			}
			$attachments = get_post_meta($post->ID, '300-160-image', true);
			$image_resizer_output = '';
			if($width = get_post_meta($post->ID, 'image_width', true)) { $image_resizer_output.= 'width='.$width.'&amp;';}else{$image_resizer_output.= 'width=400&amp;';}
			if($height = get_post_meta($post->ID, 'image_height', true)) { $image_resizer_output.= 'height='.$height.'&amp;';}else{$image_resizer_output.= 'height=300&amp;';}
			if($crop_ratio_x_y = get_post_meta($post->ID, 'crop_ratio_x_y', true)) { $image_resizer_output.= 'cropratio='.$crop_ratio_x_y.'&amp;';}else{$image_resizer_output.= 'cropratio=4:3&amp;';}
			if ($attachments) {			
				$post_cat = array();
				$post_cat = wp_get_object_terms($post->ID, "portfolio_category");
				$post_cats = array();
				for($h=0;$h<count($post_cat);$h++){
					$post_cats[] = $post_cat[$h]->name;
				}
				$cats_pf_this = implode(", ", $post_cats);
				$cprojvalid = false;
				if(get_post_meta($post->ID, 'Title', true)){
					$cprojvalid = true;
					$thumb_title = get_post_meta($post->ID, 'Title', true);
				}else{
					$thumb_title = get_the_title(); 
				}
				$thumb_descr = preg_replace('/\s+/', ' ', trim(get_post_meta($post->ID, 'Description', true)));
				$tmpddourrole = get_post_meta($post->ID, 'portfolio_ourrole', true);
				$tmpdddate = get_post_meta($post->ID, 'portfolio_date', true);
				$tmpddclient = get_post_meta($post->ID, 'portfolio_client', true);
				$tmpddagency = get_post_meta($post->ID, 'portfolio_agency', true);
				$tmpddbgimg = get_post_meta($post->ID, 'bg_image', true);
				$tmpddtxtcolor = get_post_meta($post->ID, 'portfolio_text_color', true);
				$tmpddtxtcolor = '#ffffff'; //Overwrite with white
				if($fg_image){ $fg_image.=','; } $fg_image.='{"url": "'.$attachments.'"}';
				if($fg_imagemain){ $fg_imagemain.=','; } $fg_imagemain.='{"url": "'.$attachments.'", "aid": '.$post->ID.', "color": "'.addslashes(get_post_meta($post->ID, 'thumbnail_hover_color', true)).'", "thumb_title": "'.addslashes($thumb_title).'", "thumb_descr": "'.addslashes($thumb_descr).'", "thumb_cats": "'.addslashes($cats_pf_this).'", "fullimgsrc": "'.get_post_meta($post->ID, '300-160-image', true).'", "rel": "'.addslashes($post_rel).'", "thumbvalid":'.(($cprojvalid)?'true':'false').', "thumbdate": "'.addslashes($tmpdddate).'", "thumbclient": "'.addslashes($tmpddclient).'", "thumbagency": "'.addslashes($tmpddagency).'", "thumborrole": "'.addslashes($tmpddourrole).'", "bgimg": "'.$tmpddbgimg.'", "txtcolor": "'.$tmpddtxtcolor.'"}';
			}  ?><?php endwhile ?>
                        <?php else : ?>
                      		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
							<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
							<?php //this line is used just to make it valid in theme check. You can remove it 
							wp_link_pages(); ?>
                        <?php endif; $wp_query = $temp;  //reset back to original query 
						?>
            	</ul>
	<div style="clear:both"></div>
<script type="text/javascript">
$ = jQuery.noConflict();
var fg___images = [
    <?php print($fg_image); ?>
];

var fg___margins = 20;
var fg_preview = false;
var fg_imgsize = [0,0], fg_imgscrolltype = 1, fg_imgscrollmposx = -1, fg_imgscrollmposy = -1;
var fg_imagesthumbs_cache = [], fg_thumbsqueue = [];
var validprojsobjs = [];
var fg_thumbsbarwidth = 0, fg_thumbsbarmpos = -1;
function tcenvpffsviewport(){
	if(!$(".portfolio-fs-viewport").length){
		$("#content").remove();
		$("#myimage_original").css({'display':'none', 'opacity': '0'});
		$("#header").after('<div class="portfolio-arrow-left portfolio-arrow-left-first"></div><div class="portfolio-arrow-right"></div>');
		if(jQuery.browser.msie){
			$("#header").after('<style type="text/css">.portfolio-arrow-left{ background-image:url(images/pixel.png);background-repeat:repeat; } .portfolio-arrow-right{ background-image:url(images/pixel.png);background-repeat:repeat; }</style>');
		}
		jQuery(".portfolio-arrow-left").click(portfolioarrowleft);
		jQuery(".portfolio-arrow-right").click(portfolioarrowright);
		jQuery("#footer").before('<div class="portfolio-fs-viewport"><div class="portfolio-fs-slides"></div></div>');
		if(jQuery(".news-content").length){
			jQuery(".news-content").remove();
		}
		if(jQuery(".cooming-soon-content").length){
			jQuery(".cooming-soon-content").remove();
		}
	}else{
		jQuery(".portfolio-arrow-right").stop().css({ 'display' : 'block' });
		jQuery(".portfolio-arrow-left").stop().css({ 'display' : 'block' });
		jQuery(".portfolio-fs-viewport").stop().css({'display':'block'});
	}
}
function fg_imgpreview(){
    //$(this)
	portfoliocurrentprojectid = $(this).attr('id').substr(8);
	if(validprojsobjs.length){
		var vpcfoundi = -1;
		var portfoliocurrentprojectid_int = parseInt(portfoliocurrentprojectid);
		for(var vpi=0;vpi<validprojsobjs.length;vpi++){
			if(validprojsobjs[vpi].aid == portfoliocurrentprojectid_int){
				vpcfoundi = vpi;
				break;
			}
		}
		if(vpcfoundi == -1){
			portfoliocurrentprojectid = (validprojsobjs[Math.floor(Math.random()*1000000)%(validprojsobjs.length)].aid).toString(10);
		}
	}
        $("body").css({"overflow":"hidden"});
		$('#myimage').stop(true, true).css({'opacity':'0', 'visibility':'visible', 'position':'fixed'});
		$('#myimage').animate({'opacity':'1'}, 1400);
		if(navigator.userAgent.toLowerCase().match(/(ipad)/) || navigator.userAgent.toLowerCase().match(/(msie 7.0)/) || navigator.userAgent.toLowerCase().match(/(iphone)/) || navigator.userAgent.toLowerCase().match(/(ipod)/)){
			//jQuery('.imgscontainer').css({'display':'none'});
			jQuery('.imgscontainer').css({'opacity':'0'});
			jQuery('.imgscontainer').css({'display':'none'});
			jQuery('#footer').css({'opacity':'0'});
			jQuery('#header').css({'opacity':'0'});
			jQuery('#header').stop().css({ 'margin-top': (-jQuery('#header').height())+"px" });
		}
		$("#menu .menu-item").removeClass("current-menu-item").removeClass("current_page_item");
	//	setTimeout(function() {
			//if(!$("#content").length || !$("#content").hasClass("content-projectc")){
			tcenvpffsviewport();
			if(validprojsobjs.length){
				var vpcfoundi = -1;
				var portfoliocurrentprojectid_int = parseInt(portfoliocurrentprojectid);
				for(var vpi=0;vpi<validprojsobjs.length;vpi++){
					if(validprojsobjs[vpi].aid == portfoliocurrentprojectid_int){
						vpcfoundi = vpi;
						break;
					}
				}
				if(vpcfoundi != -1){
					jQuery(".portfolio-fs-slides").empty();
					//jQuery(".portfolio-fs-viewport").css({"z-index":26666});
					jQuery(".portfolio-fs-slides").css({"display":"none"}).prepend('<div class="portfolio-fs-slide current-slide portfolio-ppreview"><div class="project-coverslide"></div><div id="content" class="content-projectc contenttextwhite"><div class="project-excerpt" style="opacity:0;"><ul class="project-meta"><li class="project-date"><span class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></span> <span class="project-exdate">'+validprojsobjs[vpcfoundi].thumbdate+'</span></li><li class="project-client"><span class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></span> <span class="project-exclient">'+validprojsobjs[vpcfoundi].thumbclient+'</span></li><li class="project-agency"><span class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></span> <span class="project-exagency">'+validprojsobjs[vpcfoundi].thumbagency+'</span></li><li class="project-ourrole"><span class="project-meta-heading"><?php _e('ROLE', 'flowthemes'); ?></span> <span class="project-exourrole">'+validprojsobjs[vpcfoundi].thumborrole+'</span></li></ul><div style="clear:both;"></div><h1 class="project-title" style="letter-spacing:-4px;float:left;">'+validprojsobjs[vpcfoundi].thumb_title+'</h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description">'+validprojsobjs[vpcfoundi].thumb_descr+'</h4></div><div class="clear"></div></div></div>');
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
					portfoliocurrentslideactive = 0;
					//jQuery(window).trigger("resize");
					tresizewindowf();
					jQuery(".portfolio-fs-slides").css({'display':'block','left':'0'});
					jQuery(".project-excerpt").stop().animate({ opacity: 1 }, 400);
				}
			}
			if(!jQuery(".portfolio-cancelclose").length){
				jQuery("#footer").before('<div class="portfolio-cancelclose portfolio-cancelclose-white"></div>');
				jQuery(".portfolio-cancelclose").click(function(){
					stopajaxloadingaclean();
				});
			}else{
				jQuery(".portfolio-cancelclose").css({'display':'block'}).addClass("portfolio-cancelclose-white");
			}
			if(!$(".portfolio-loadingbar").length){
				$("#footer").before('<div class="portfolio-loadingbar"><div class="portfolio-loadinghr"></div><div class="portfolio-indicator">0%</div></div>');
				$(".portfolio-loadingbar").css({'height':$(window).height(),'z-index':1055333, 'position':'fixed', top:0, left:$(window).width()});
				$(".portfolio-loadinghr").css({'height':$(window).height()+400,'margin-top':'-200px','transform':'rotate(20deg)','-moz-transform':'rotate(20deg)','-webkit-transform':'rotate(20deg)','-ms-transform':'rotate(20deg)','-o-transform':'rotate(20deg)', 'float':'left'});
				$(".portfolio-indicator").css({'height':'100%','display':'block','float':'left','top':'50%','position':'relative'});
			}else{
				$(".portfolio-loadingbar").stop(true).css({'display':'block','left':$(window).width()});
			}
			$(".portfolio-loadingbar").animate({'left':0.8*$(window).width()},400,function(){
				$(".portfolio-loadingbar").animate({'left':200},25000);
			});
			jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'display':'block','z-index':'1011111'});
			appendloadingcursor(".portfolio-arrow-right, .portfolio-arrow-left");
			portfolioreqsetproject('this');
}
function fg_imgchangepreview(src){
    if(fg_preview){
        var fg_oldimgsrc = $("#fg_preview .imgdisplay .imgprevcontainer img").attr("src");
        if(!fg_oldimgsrc || fg_oldimgsrc != src){
            fg_imgscrolltype = 1;
            $("#fg_preview .imgdisplay .imgprevcontainer").contents().remove("img");
            var fg_img = $("<img>").attr("src",src).css({'position':'relative', 'top':'0', 'left':'0', 'width':'auto', 'height':'auto', 'visibility':'hidden', 'cursor':'pointer'}).load(function(){
                fg_imgsize = [$(this).width(), $(this).height()];
                $(this).css('visibility', 'visible');
                resizefgpreview();
            }).click(function(){
                if(fg_imgscrolltype == 1){
                    $(this).mousemove(function(e){
                        fg_imgscrollmposx = e.pageX;
                        fg_imgscrollmposy = e.pageY;
                        rescrollfgimage();
                    });
                    fg_imgscrolltype = 2;
                    resizefgpreview();
                }else if(fg_imgscrolltype == 2){
                    $(this).unbind("mousemove");
                    fg_imgscrolltype = 1;
                    resizefgpreview();
                }
            });
            $("#fg_preview .imgdisplay .imgprevcontainer").append(fg_img);
        }
    }
}
function resizefgpreview(){
    if(fg_preview){
        var vp_w = $(window).width(), vp_h = $(window).height();
        $("#fg_preview .imgdisplay").css({'width':vp_w+'px', 'height':(vp_h-100)+'px'});
        $("#fg_preview .thumbsprev").css({'width':vp_w+'px', 'height':'100px'});
        var fg_imgareaw = vp_w-2*fg___margins, fg_imgareah = vp_h-100-2*fg___margins;
        if(fg_imgareaw <= 0 || fg_imgareah <= 0){
            if(fg_imgareaw <= 0){
                fg_imgareaw = 10;
            }
            if(fg_imgareah <= 0){
                fg_imgareah = 10;
            }
        }
        $("#fg_preview .imgdisplay .imgprevcontainer").css({'position':'relative',  'overflow':'hidden'});
        $("#fg_preview .imgdisplay .imgprevcontainer img").css({'position':'relative'});
        if(fg_imgscrolltype == 1){
            if(fg_imgsize[0] && fg_imgsize[1]){
                if(fg_imgsize[0] > fg_imgareaw || fg_imgsize[1] > fg_imgareah){
                    var fg_imgnewsizew=0, fg_imgnewsizeh=0;
                    var fg_imgscalerx = fg_imgsize[0]/fg_imgareaw, fg_imgscalery = fg_imgsize[1]/fg_imgareah;
                    if(fg_imgscalerx >= fg_imgscalery){
                        fg_imgnewsizew = fg_imgsize[0]/fg_imgscalerx;
                        fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalerx;
                    }else{
                        fg_imgnewsizew = fg_imgsize[0]/fg_imgscalery;
                        fg_imgnewsizeh = fg_imgsize[1]/fg_imgscalery;
                    }
                    if(fg_imgnewsizew && fg_imgnewsizeh){
                        fg_imgnewsizew = Math.floor(fg_imgnewsizew);
                        fg_imgnewsizeh = Math.floor(fg_imgnewsizeh);
                        $("#fg_preview .imgdisplay .imgprevcontainer").css({'top':Math.floor((vp_h-100-fg_imgnewsizeh)/2)+'px', 'left':Math.floor((vp_w-fg_imgnewsizew)/2)+'px', 'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px'});
                        $("#fg_preview .imgdisplay .imgprevcontainer img").css({'width':fg_imgnewsizew+'px', 'height':fg_imgnewsizeh+'px', 'top':'0', 'left':'0'});
                    }
                }else{
                    $("#fg_preview .imgdisplay .imgprevcontainer").css({'top':Math.floor((vp_h-100-fg_imgsize[1])/2)+'px', 'left':Math.floor((vp_w-fg_imgsize[0])/2)+'px', 'width':fg_imgsize[0]+'px', 'height':fg_imgsize[1]+'px'});
                    $("#fg_preview .imgdisplay .imgprevcontainer img").css({'width':fg_imgsize[0]+'px', 'height':fg_imgsize[1]+'px', 'top':'0', 'left':'0'});
                }
            }
        }else if(fg_imgscrolltype == 2){
            if(fg_imgsize[0] <= fg_imgareaw || fg_imgsize[1] <= fg_imgareah){
                var fg_imgnewwposx=fg___margins, fg_imgnewwposy=fg___margins;
                if(fg_imgsize[0] <= fg_imgareaw){
                    fg_imgnewwposx = Math.floor((vp_w-fg_imgsize[0])/2);
                }
                if(fg_imgsize[1] <= fg_imgareah){
                    fg_imgnewwposy = Math.floor((vp_h-100-fg_imgsize[1])/2);
                }
                $("#fg_preview .imgdisplay .imgprevcontainer").css({'top':fg_imgnewwposy+'px', 'left':fg_imgnewwposx+'px', 'width':fg_imgareaw+'px', 'height':fg_imgareah+'px'});
                $("#fg_preview .imgdisplay .imgprevcontainer img").css({'width':fg_imgsize[0]+'px', 'height':fg_imgsize[1]+'px'});
            }else{
                $("#fg_preview .imgdisplay .imgprevcontainer").css({'top':fg___margins+'px', 'left':fg___margins+'px', 'width':fg_imgareaw+'px', 'height':fg_imgareah+'px'});
                $("#fg_preview .imgdisplay .imgprevcontainer img").css({'width':fg_imgsize[0]+'px', 'height':fg_imgsize[1]+'px'});
            }
        }
    }
}
function rescrollfgimage(){
    if(fg_preview){
        var vp_w = $(window).width(), vp_h = $(window).height();
        var fg_imgareaw = vp_w-2*fg___margins, fg_imgareah = vp_h-100-2*fg___margins;
        if(fg_imgareaw > 0 && fg_imgareah > 0){
            var fg_imgnewposx = 0, fg_imgnewposy = 0;
            if(fg_imgsize[0] > vp_w){
                fg_imgnewposx = -((fg_imgsize[0]-fg_imgareaw)*(fg_imgscrollmposx-fg___margins))/fg_imgareaw;
            }else{
                fg_imgnewposx = 0;
            }
            if(fg_imgsize[1] > vp_h){
                fg_imgnewposy = -((fg_imgsize[1]-fg_imgareah)*(fg_imgscrollmposy-fg___margins))/fg_imgareah;
            }else{
                fg_imgnewposy = 0;
            }
            $("#fg_preview .imgdisplay .imgprevcontainer img").css({'left':fg_imgnewposx+'px', 'top':fg_imgnewposy+'px'});
        }
    }
}
function fgenxtthumb(){
    if(fg_preview){
        if(fg_thumbsqueue.length >= 1){
            var fg_currthumb = fg_thumbsqueue.shift();
            var fg_cachethumbsimg = false;
            for(var fg_j=0;fg_j<fg_imagesthumbs_cache.length;fg_j++){
                if(fg_imagesthumbs_cache[fg_j].src == fg_currthumb.url){
                    //fg_cachethumbsimg = fg_imagesthumbs_cache[fg_j].img;
                    fg_cachethumbsimg = true;
                    break;
                }
            }
            if(!fg_cachethumbsimg){
                var fg_cachethumbsimgg = $("<img>").load(function(){
                    fgenxtthumbout(fg_currthumb,true);
                });
                fg_imagesthumbs_cache.push({"src":fg_currthumb.url, "img":fg_cachethumbsimgg});
                fg_cachethumbsimgg.attr("src",fg_currthumb.url);
            }else{
                fgenxtthumbout(fg_currthumb,false);
                setTimeout("fgenxtthumb();", 300);
            }
        }
    }
}
function fgenxtthumbout(srcobj, fg_isnextthumb){
    if(fg_preview){
        var fg_divthumbimgi = $("<img>").css({'width':'auto', 'height':'80px', 'cursor':'pointer'}).load(function(){
            var fg_thumbimgcrw = $(this).width();
            var fg_thumbimgpr = $(this).parent(".imgthumbcont");
            fg_thumbsbarwidth += 6 + fg_thumbimgcrw; //<--- MARGIN
            $("#fg_preview .thumbsprev .imgthumbscontainer").css('width',fg_thumbsbarwidth+'px');
            rescrollfgthumbs();
            fg_thumbimgpr.css({'visibility':'visible'});
            fg_thumbimgpr.animate({'width':fg_thumbimgcrw+'px'}, 200, function(){ if(fg_isnextthumb){ fgenxtthumb(); } });
        }).click(function(){
            fg_imgchangepreview(srcobj.url);
        });
        var fg_divthumbimg = $("<div>").attr("class","imgthumbcont").css({'display':'block', 'visibility':'visible', 'width':'0', 'overflow-x':'hidden'}).append(fg_divthumbimgi);
        $("#fg_preview .thumbsprev .imgthumbscontainer").append(fg_divthumbimg);
        fg_divthumbimgi.attr("src",srcobj.url);
    }
}
function rescrollfgthumbs(){
    if(fg_preview){
        var vp_w = $(window).width();
        var fg_thumbbarsclw = 0;
        if(fg_thumbsbarwidth > vp_w){
            var fg_mpos = 0;
            if(fg_thumbsbarmpos == -1){
                fg_mpos = Math.floor(vp_w/2);
            }else{
                fg_mpos = fg_thumbsbarmpos;
            }
            fg_thumbbarsclw = -((fg_thumbsbarwidth-vp_w)*fg_mpos)/vp_w;
        }else{
            fg_thumbbarsclw = (vp_w-fg_thumbsbarwidth)/2;
        }
        $("#fg_preview .thumbsprev .imgthumbscontainer").stop(true,true).animate({'left':Math.floor(fg_thumbbarsclw)+'px'},300);
    }
}

var imgsqueue = [], imgsqueuep = false;
function fg_imgbeforeload(){
    //$("#log").html("Image: "+$(this).get(0).src+" before loaded<br>"+$("#log").html());
    var fg_pdiv = $(this).parents(".imgcontainer");
    fg_pdiv.css({'visibility':'hidden'});
}
function fg_imgloaded(){
    //$("#log").html("Image: "+$(this).get(0).src+" loaded<br>"+$("#log").html());
    addtoqueue.apply(this);
}
function addtoqueue(){
    imgsqueue.push(this);
    animatequeue();
}
function animateimage(){
    var fg_pdiv = $(this).parents(".imgcontainer");
    var fg_imgwidth = $(this).width();
    fg_pdiv.css({'display':'block', 'visibility':'visible', 'width':'0', 'overflow-x':'hidden'});
    fg_pdiv.animate({'width':fg_imgwidth+'px'}, 100, function(){ imgsqueuep=false; animatequeue(); });
}
function animatequeue(){
    if(!imgsqueuep){
        imgsqueuep = true;
        if(imgsqueue.length >= 1){
            animateimage.apply(imgsqueue.shift());
        }else{
            imgsqueue = false;
        }
    }
}
var g_fg___images = [<?php print($fg_imagemain); ?>];
var g_fg_imagesthumbs_cache = [], g_fg_thumbsqueue = [];
function g_fgenxtthumb(){
	if(g_fg_thumbsqueue.length >= 1){
		var fg_currthumb = g_fg_thumbsqueue.shift();
		var fg_cachethumbsimg = false;
		for(var fg_j=0;fg_j<g_fg_imagesthumbs_cache.length;fg_j++){
			if(g_fg_imagesthumbs_cache[fg_j].src == fg_currthumb.url){
				//fg_cachethumbsimg = fg_imagesthumbs_cache[fg_j].img;
				fg_cachethumbsimg = true;
				break;
			}
		}
		if(!fg_cachethumbsimg){
			var fg_cachethumbsimgg = $("<img>").load(function(){
				g_fgenxtthumbout(fg_currthumb,true);
			}).error(function(){
				//error handling...
				g_fgenxtthumbout(fg_currthumb,true);
			});
			g_fg_imagesthumbs_cache.push({"src":fg_currthumb.url, "img":fg_cachethumbsimgg});
			fg_cachethumbsimgg.attr("src",fg_currthumb.url);
		}else{
			g_fgenxtthumbout(fg_currthumb,false);
			setTimeout("g_fgenxtthumb();", 150);
		}
	}
}
var previous_state;
var g_fgthumbsstartingwidth = 0;

function g_fgenxtthumbalt(){
	if(g_fg_thumbsqueue.length >= 1){
		for(var fg_tqi=0;fg_tqi<g_fg_thumbsqueue.length;fg_tqi++){
			g_fgenxtthumboutalt(g_fg_thumbsqueue[fg_tqi]);
		}
	}
}
function g_hover_thumbnailsaltimg(e){
	<?php if(get_option("flow_portfolio_hover_type") != 1){ ?> //hover type
		var pfnavmenuselectedi = $('.pf_nav li.selected a');
		if(pfnavmenuselectedi.length){
			var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
			if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
				$(this).parent().css({"background-color" : "#ffffff"});
				$(this).stop().animate({ opacity: ".9" }, 150);
			}else{
				$(this).parent().css({"background-color" : "#000000"});
				$(this).stop().animate({ opacity: "1" }, 250);
			}
		}else{
			$(this).parent().css({"background-color" : "#ffffff"});
			$(this).stop().animate({ opacity: ".9" }, 250);
		}
	<?php }else{ ?>
	/* In this part of code (and also in hover out function below we commented out all animation for performance reasons. In the future once browsers will be able to parse javascript faster animations may be returned and adjusted if necessary. */
		var pfnavmenuselectedi = $('.pf_nav li.selected a');
		if(pfnavmenuselectedi.length){
			var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
			if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
				$(this).parent().css({"background-color" : "transparent"});
				//$(this).parent().parent().stop().animate({"opacity" : "1"}, 850);
				$(this).parent().parent().stop().css({"opacity" : "1"});
				//$(this).stop().animate({ opacity: ".2" }, 220);
				$(this).stop().css({ opacity: "0" }); //thumbnail opacity 0.2
				
				//skrypt wykrywajacy od ktorej strony thumbnaila najezdza kursor by ryjek
				var offset = $(this).offset();
				var mindeltaside = 4;
				var mindeltacth = Math.abs(e.pageX - offset.left);
				if(Math.abs(offset.left+$(this).width() - e.pageX) < mindeltacth){
					mindeltaside = 2;
					mindeltacth = Math.abs(offset.left+$(this).width() - e.pageX);
				}
				if(Math.abs(e.pageY - offset.top) < mindeltacth){
					mindeltaside = 1;
					mindeltacth = Math.abs(e.pageY - offset.top);
				}
				if(Math.abs(offset.top+$(this).height() - e.pageY) < mindeltacth){
					mindeltaside = 3;
				}
				if(mindeltaside == 1){
					$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "opacity" : "1", "top": ~$(this).height() }).animate({"top" : 0 }, 350);
				}else if(mindeltaside == 2){
					$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "opacity" : "1", "left": $(this).height() }).animate({"left" : 0 }, 350);
				}else if(mindeltaside == 3){
					$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "opacity" : "1", "top": $(this).height() }).animate({"top" : 0 }, 350);
				}else if(mindeltaside == 4){
					$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "opacity" : "1", "left": ~$(this).width() }).animate({"left" : 0}, 350);
				}
			}else{
				$(this).parent().css({"background-color" : "transparent"});
				//$(this).parent().parent().animate({"opacity" : "1"}, 350);
				$(this).parent().parent().css({"opacity" : "1"});
				//$(this).stop().animate({ opacity: "0.25" }, 350);
				$(this).stop().css({ opacity: "0.25" });
				
				//skrypt wykrywajacy od ktorej strony thumbnaila najezdza kursor by ryjek
				var offset = $(this).offset();
				var mindeltaside = 4;
				var mindeltacth = Math.abs(e.pageX - offset.left);
				if(Math.abs(offset.left+$(this).width() - e.pageX) < mindeltacth){
					mindeltaside = 2;
					mindeltacth = Math.abs(offset.left+$(this).width() - e.pageX);
				}
				if(Math.abs(e.pageY - offset.top) < mindeltacth){
					mindeltaside = 1;
					mindeltacth = Math.abs(e.pageY - offset.top);
				}
				if(Math.abs(offset.top+$(this).height() - e.pageY) < mindeltacth){
					mindeltaside = 3;
				}
				if(mindeltaside == 1){
					$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "opacity" : "1", "top": ~$(this).height() }).animate({"top" : 0 }, 350);
				}else if(mindeltaside == 2){
					$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "opacity" : "1", "left": $(this).height() }).animate({"left" : 0 }, 350);
				}else if(mindeltaside == 3){
					$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "opacity" : "1", "top": $(this).height() }).animate({"top" : 0 }, 350);
				}else if(mindeltaside == 4){
					$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "opacity" : "1", "left": ~$(this).width() }).animate({"left" : 0}, 350);
				}
			}
		}else{
			$(this).parent().css({"background-color" : "transparent"});
			//$(this).stop().animate({ opacity: ".25" }, 250);
			$(this).stop().css({ opacity: ".25" });
		}
	<?php } ?>
}
function g_hoverout_thumbnailsaltimg(e){
	var pfnavmenuselectedi = $('.pf_nav li.selected a');
	if(pfnavmenuselectedi.length){
		var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
		if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
			//$(this).parent().parent().next().animate({"opacity" : "0"}, 350).delay(400).css({"display" : "none" });
			//$(this).parent().parent().next().animate({"left" : $(this).width()}, 350).delay(400).css({"display" : "none" });
			//$(this).parent().parent().next().animate({"left" : $(this).width()}, 150);
			//$(this).parent().parent().stop().animate({"opacity" : "0"}, 850);
				//$(this).stop().animate({ opacity: 1 }, 250);
			$(this).stop().css({ "opacity": 1 });
			//setTimeout(function(){
				$(this).parent().css({"background-color" : "<?php echo get_option("bgchanger_color"); ?>"});
			//}, 250);
			//$(this).html('<div class="display:none;">' + mindeltaside + '</div>');
			
			//skrypt wykrywajacy od ktorej strony thumbnaila najezdza kursor by ryjek
				var offset = $(this).offset();
				var mindeltaside = 4;
				var mindeltacth = Math.abs(e.pageX - offset.left);
				if(Math.abs(offset.left+$(this).width() - e.pageX) < mindeltacth){
					mindeltaside = 2;
					mindeltacth = Math.abs(offset.left+$(this).width() - e.pageX);
				}
				if(Math.abs(e.pageY - offset.top) < mindeltacth){
					mindeltaside = 1;
					mindeltacth = Math.abs(e.pageY - offset.top);
				}
				if(Math.abs(offset.top+$(this).height() - e.pageY) < mindeltacth){
					mindeltaside = 3;
				}
				if(mindeltaside == 1){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "top" : ~$(this).height() }, { queue: false, duration: 250, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"top" : $(this).height() }, { queue: false, duration: 250, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 2){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "left" : $(this).width() }, { queue: false, duration: 250, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "left" : ~$(this).width() }, { queue: false, duration: 250, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 3){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "top" : $(this).height() }, { queue: false, duration: 250, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "top" : ~$(this).height() }, { queue: false, duration: 250, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 4){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "left" : ~$(this).width() }, { queue: false, duration: 250, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "left" : $(this).width() }, { queue: false, duration: 250, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}
		}else{
			$(this).parent().css({"background-color" : "<?php echo get_option("bgchanger_color"); ?>"});
			$(this).stop().css({ "opacity": 0.11 });//.animate({ opacity: 0.11 }, 250);
			
			//skrypt wykrywajacy od ktorej strony thumbnaila najezdza kursor by ryjek
				var offset = $(this).offset();
				var mindeltaside = 4;
				var mindeltacth = Math.abs(e.pageX - offset.left);
				if(Math.abs(offset.left+$(this).width() - e.pageX) < mindeltacth){
					mindeltaside = 2;
					mindeltacth = Math.abs(offset.left+$(this).width() - e.pageX);
				}
				if(Math.abs(e.pageY - offset.top) < mindeltacth){
					mindeltaside = 1;
					mindeltacth = Math.abs(e.pageY - offset.top);
				}
				if(Math.abs(offset.top+$(this).height() - e.pageY) < mindeltacth){
					mindeltaside = 3;
				}
				if(mindeltaside == 1){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "top" : ~$(this).height() }, { queue: false, duration: 180, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "top" : $(this).height() }, { queue: false, duration: 180, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 2){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "left" : $(this).width() }, { queue: false, duration: 180, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "left" : ~$(this).width() }, { queue: false, duration: 180, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 3){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "top" : $(this).height() }, { queue: false, duration: 180, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "top" : ~$(this).height() }, { queue: false, duration: 180, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}else if(mindeltaside == 4){
					//$(this).parent().parent().next().stop().animate({"opacity" : "1", "left" : ~$(this).width() }, { queue: false, duration: 180, easing: 'easeInQuint' });
					$(this).parent().parent().next().stop().animate({"opacity" : "0", "left" : $(this).width() }, { queue: false, duration: 180, easing: 'easeInQuint' }, function() { $(this).css({"opacity" : "0"}); });
				}
		}
	}else{
		$(this).parent().css({"background-color" : "#000000"});
		//$(this).stop().animate({ opacity: 1 }, 250);
		$(this).stop().css({ opacity: 1 });
	}
}
var txtmodefirstnots = false;
function g_fgenxtthumboutalt(srcobj){
	if(srcobj.thumbvalid){
		validprojsobjs[validprojsobjs.length] = srcobj;
	}
	<?php if($nshowtxth == 1){ ?>
		var imgloaderrorfalt = function(){
			var newimagewidth = getcthumbnailsize();
			var fg_thumbimgcrw = newimagewidth;//$(this).width();
			
			<?php if($orderby == 'date'){ ?>
				var fg_divthumbimg = $(this).parent().parent().parent();
				fg_divthumbimg.css({'display':'block'});
			<?php }else{ ?>
				var fg_divthumvsecdiv = $("<div>").addClass("hoverbgpfthnailmiddle").css({'float':'left', 'line-height':'0', 'background-color':'<?php echo get_option("bgchanger_color"); ?>'}).append($(this)); //fg_divthumbimgi
				var fg_divhoverbg = $("<div>").addClass("hoverbgpfthnail").css({"background-color" : (srcobj.color)?srcobj.color:"#008eeb" }).append(fg_divthumvsecdiv);
				var fg_divhoverbgmetadata = $("<div>").addClass("hoverbgpfthnailmetadata").html('<span class="thumb_title">'+srcobj.thumb_title+'</span><span class="thumb_cats">'+srcobj.thumb_cats+'</span><span class="thumb_plus">+</span>');//.append(fg_divthumvsecdiv);
				var fg_divthumbimg = $("<div>").attr("class","imgcontainer").attr('rel', srcobj.rel).css({'display':'block', 'visibility':'visible', 'width':'0', 'overflow':'hidden'}).append(fg_divhoverbg);
				fg_divthumbimg.append(fg_divhoverbgmetadata);
				
				var fg_divhoverbghover = $("<div>").addClass("hoverbgpfthnailiface").hover(function(e){
					g_hover_thumbnailsaltimg.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
					e.stopPropagation();
				},function(e){
					g_hoverout_thumbnailsaltimg.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
					e.stopPropagation();
				}).click(function(){
					fg_imgpreview.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"));
				});
				if(jQuery.browser.msie){
					fg_divthumbimg.click(function(){
						fg_imgpreview.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"));
					}).hover(function(e){
						g_hover_thumbnailsaltimg.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
						e.stopPropagation();
					},function(e){
						g_hoverout_thumbnailsaltimg.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
						e.stopPropagation();
					});
					fg_divhoverbghover.unbind('click').unbind('hover');
				}
				
				fg_divthumbimg.append(fg_divhoverbghover);
				//fg_divthumvsecdiv.append(fg_divhoverbgmetadata);
				$(".imgscontainer").append(fg_divthumbimg);
			<?php } ?>

			//var fg_thumbimgpr = $(this).parent().parent(".imgcontainer");
			var fg_thumbimgpr = fg_divthumbimg;
			$(this).css({width: newimagewidth+'px'});
			fg_thumbimgpr.css({'visibility':'visible', width: newimagewidth+'px'});
			if(!navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/)){
				$(this).css({'opacity':0}).animate({'opacity':1}, 400);
			}
			//fg_thumbimgpr.animate({'width':fg_thumbimgcrw+'px'}, 50, function(){ if(fg_isnextthumb){ g_fgenxtthumb(); } });
			//fg_thumbimgpr.css({'opacity':0, 'width':fg_thumbimgcrw+'px'});
			//setTimeout(function(){
			//	fg_thumbimgpr.animate({'opacity':1}, 400);
			//}, 250);
		};
		var fg_divthumbimgi = $("<img>").attr('class', 'pf_img').attr('id', 'post-id-'+srcobj.aid).css({'width':'auto', 'cursor':'pointer'}).load(imgloaderrorfalt).error(imgloaderrorfalt)/*.click(function(){
			fg_imgpreview.apply(this);
		}).hover(function(e){
			if(<?php if(get_option("flow_portfolio_hover_type") != 1){ echo "true"; }else{ echo "false"; } ?>){ //hover type
				var pfnavmenuselectedi = $('.pf_nav li.selected a');
				if(pfnavmenuselectedi.length){
					var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
					if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
						$(this).parent().css({"background-color" : "#ffffff"});
						$(this).stop().animate({ opacity: ".9" }, 150);
					}else{
						$(this).parent().css({"background-color" : "#000000"});
						$(this).stop().animate({ opacity: "1" }, 250);
					}
				}else{
					$(this).parent().css({"background-color" : "#ffffff"});
					$(this).stop().animate({ opacity: ".9" }, 250);
				}
			}else{
				var pfnavmenuselectedi = $('.pf_nav li.selected a');
				if(pfnavmenuselectedi.length){
					var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
					if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
						$(this).parent().css({"background-color" : "transparent"});
						$(this).parent().parent().stop().animate({"opacity" : "1"}, 850);
						$(this).stop().animate({ opacity: ".25" }, 250);
						
						var offset = $(this).offset();
						
						//skrypt wykrywajacy od ktorej strony thumbnaila najezdza kursor by ryjek
						var mindeltaside = 4;
						var mindeltacth = Math.abs(e.pageX - offset.left);
						if(Math.abs(offset.left+$(this).width() - e.pageX) < mindeltacth){
							mindeltaside = 2;
							mindeltacth = Math.abs(offset.left+$(this).width() - e.pageX);
							$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "left": $(this).height() }).animate({"opacity" : "1", "left" : 0 }, 350);
						}
						if(Math.abs(e.pageY - offset.top) < mindeltacth){
							mindeltaside = 1;
							mindeltacth = Math.abs(e.pageY - offset.top);
							$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "top": ~$(this).height() }).animate({"opacity" : "1", "top" : 0 }, 350);
						}
						if(Math.abs(offset.top+$(this).height() - e.pageY) < mindeltacth){
							mindeltaside = 3;
							$(this).parent().parent().next().stop().css({"display" : "block", "left" : 0, "top": $(this).height() }).animate({"opacity" : "1", "top" : 0 }, 350);
						}
						if(mindeltaside == 4){
							$(this).parent().parent().next().stop().css({"display" : "block", "top" : 0, "left": ~$(this).width() }).animate({"opacity" : "1", "left" : 0}, 350);
						}

					}else{
						$(this).parent().css({"background-color" : "transparent"});
						$(this).parent().parent().animate({"opacity" : "1"}, 350);
						$(this).stop().animate({ opacity: "0.25" }, 350);
					}
				}else{
					$(this).parent().css({"background-color" : "transparent"});
					$(this).stop().animate({ opacity: ".25" }, 250);
				}
			}
		},function(){
			var pfnavmenuselectedi = $('.pf_nav li.selected a');
			if(pfnavmenuselectedi.length){
				var pfnavmenuselectedititle = pfnavmenuselectedi.attr('title');
				if(($(this).parent().parent().parent().attr('rel')).indexOf(pfnavmenuselectedititle) != -1){
					//$(this).parent().parent().next().animate({"opacity" : "0"}, 350).delay(400).css({"display" : "none" });
					//$(this).parent().parent().next().animate({"left" : $(this).width()}, 350).delay(400).css({"display" : "none" });
					$(this).parent().parent().next().animate({"left" : $(this).width()}, 150);
					$(this).stop().animate({ opacity: 1 }, 250);
					//setTimeout(function(){
						$(this).parent().css({"background-color" : "#000000"});
					//}, 250);

					
					
					//$(this).html('<div class="display:none;">' + mindeltaside + '</div>');
					
				}else{
					$(this).parent().css({"background-color" : "#000000"});
					$(this).stop().animate({ opacity: 0.11 }, 250);
				}
			}else{
				$(this).parent().css({"background-color" : "#000000"});
				$(this).stop().animate({ opacity: 1 }, 250);
			}
		})*/;
		
		<?php if($orderby == 'date'){ ?>
			var fg_divthumvsecdiv = $("<div>").addClass("hoverbgpfthnailmiddle").css({'float':'left', 'line-height':'0', /* 'border-top':'1px solid rgba(0,0,0,0.8)', 'border-left':'1px solid rgba(0,0,0,0.8)', */ 'background-color':'<?php echo get_option("bgchanger_color"); ?>'}).append(fg_divthumbimgi);
			var fg_divhoverbg = $("<div>").addClass("hoverbgpfthnail").css({"background-color" : (srcobj.color)?srcobj.color:"#008eeb" }).append(fg_divthumvsecdiv);
			var fg_divhoverbgmetadata = $("<div>").addClass("hoverbgpfthnailmetadata").html('<span class="thumb_title">'+srcobj.thumb_title+'</span><span class="thumb_cats">'+srcobj.thumb_cats+'</span><span class="thumb_plus">+</span>');//.append(fg_divthumvsecdiv);
			var fg_divthumbimg = $("<div>").attr("class","imgcontainer").attr('rel', srcobj.rel).css({'display':'none', 'visibility':'visible', 'width':'0', 'overflow':'hidden'}).append(fg_divhoverbg);
			fg_divthumbimg.append(fg_divhoverbgmetadata);
			
			var fg_divhoverbghover = $("<div>").addClass("hoverbgpfthnailiface").hover(function(e){
				g_hover_thumbnailsaltimg.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
				e.stopPropagation();
			},function(e){
				g_hoverout_thumbnailsaltimg.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
				e.stopPropagation();
			}).click(function(){
				fg_imgpreview.apply($(this).parent().children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"));
			});
			if(jQuery.browser.msie){
				fg_divthumbimg.click(function(){
					fg_imgpreview.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"));
				}).hover(function(e){
					g_hover_thumbnailsaltimg.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
					e.stopPropagation();
				},function(e){
					g_hoverout_thumbnailsaltimg.apply($(this).children(".hoverbgpfthnail").children(".hoverbgpfthnailmiddle").children(".pf_img"), [e]);
					e.stopPropagation();
				});
				fg_divhoverbghover.unbind('click').unbind('hover');
			}
			
			fg_divthumbimg.append(fg_divhoverbghover);
			//fg_divthumvsecdiv.append(fg_divhoverbgmetadata);
			$(".imgscontainer").append(fg_divthumbimg);
		<?php } ?>
		
		fg_divthumbimgi.attr("src",srcobj.url);
	<?php }else if($nshowtxth == 2){ ?>
		if(txtmodefirstnots){
			$(".imgscontainer").append("<div class=\"thtitled-separator\">/</div>");
		}else{
			txtmodefirstnots = true;
		}
		var thtitlet = $("<div class=\"thtitled-thtitle\"></div>").attr('rel', srcobj.rel).attr('id', 'post-id-'+srcobj.aid);
		thtitlet.append("<div class=\"thtitles-title\">"+srcobj.thumb_title+"</div><div class=\"thtitles-titlebold\" style=\"visibility:hidden;\">"+srcobj.thumb_title+"</div>");
		thtitlet.click(function(){
			fg_imgpreview.apply($(this));
		});
		$(".imgscontainer").append(thtitlet);
	<?php }else if($nshowtxth == 3){ ?>
	<?php } ?>
}
function recreateprojbyvalidsarr(){
	jQuery(".portfolio-fs-slides").empty();
	for(var si=0;si<validprojsobjs.length;si++){
		if(validprojsobjs[si].thumbvalid){
			//jQuery(".portfolio-fs-slides").prepend('<div class="portfolio-fs-slide"><img class="myimage" src="'+validprojsobjs[si].bgimg+'" style="display:block;position:absolute;"></img><div id="content" class="content-projectc'+((validprojsobjs[si].txtcolor=="#ffffff")?' contenttextwhite':'')+'"><div class="project-excerpt" style="opacity:1;"><ul class="project-meta"><li class="project-date"><span class="project-meta-heading">DATE</span> <span class="project-exdate">'+validprojsobjs[si].thumbdate+'</span></li><li class="project-client"><span class="project-meta-heading">CLIENT</span> <span class="project-exclient">'+validprojsobjs[si].thumbclient+'</span></li><li class="project-agency"><span class="project-meta-heading">AGENCY</span> <span class="project-exagency">'+validprojsobjs[si].thumbagency+'</span></li><li class="project-ourrole"><span class="project-meta-heading">ROLE</span> <span class="project-exourrole">'+validprojsobjs[si].thumborrole+'</span></li></ul><div style="clear:both;"></div><h1 class="project-title" style="letter-spacing:-4px;float:left;">'+validprojsobjs[si].thumb_title+'</h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description">'+validprojsobjs[si].thumb_descr+'</h4><div id="post-id-'+validprojsobjs[si].aid+'" class="project-view">+ View project</div></div><div class="clear"></div></div></div>');
			jQuery(".portfolio-fs-slides").prepend('<div class="portfolio-fs-slide"><img class="myimage" src="'+validprojsobjs[si].bgimg+'" style="display:block;position:absolute;"></img><div id="content" class="content-projectc'+((validprojsobjs[si].txtcolor=="#ffffff")?' contenttextwhite':'')+'"><h1 class="project-title" style="letter-spacing:-4px;float:left;">'+validprojsobjs[si].thumb_title+'</h1><div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"></div><div style="clear:both;"></div><h4 class="project-description">'+validprojsobjs[si].thumb_descr+'</h4><div id="post-id-'+validprojsobjs[si].aid+'" class="project-view">+ View project</div></div><div class="clear"></div></div></div>');
		}
	}
	tresizewindowf();
	portfoliocurrentslideactive = 0;
	jQuery(".portfolio-fs-slides").css({'display':'block','left':'0'});
	if(jQuery(".portfolio-fs-slide").length){
		jQuery(jQuery(".portfolio-fs-slide").get(0)).css({"z-index":88888}).addClass("current-slide");
		if(jQuery(".content-projectc", jQuery(jQuery(".portfolio-fs-slide").get(0))).hasClass("contenttextwhite")){
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
		}else{
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
		}
	}
	portfoliokillifaceevents();
	portfolioinitifaceevents();
	jQuery(".project-view").click(function(){
		fg_imgpreview.apply(jQuery(this));
		return false;
	});
}
$(document).ready(function(){
   /*$(".imgscontainer img").each(function(i,e){
        fg_imgbeforeload.apply(e);
        $(e).css('cursor','pointer');
        $(e).click(function(){
            fg_imgpreview.apply(e);
        });
        if($(e).get(0).complete || $(e).get(0).readyState === 4){
            fg_imgloaded.apply(e);
        }else{
            $(e).load(function(){
                fg_imgloaded.apply(this);
            });
        }
    });*/
	g_fg_thumbsqueue = [];
	for(var fg_i=0;fg_i<g_fg___images.length;fg_i++){
		g_fg_thumbsqueue[fg_i] = g_fg___images[fg_i];
	}
	//g_fgthumbsstartingwidth = $(window).width();
	//$(".imgscontainer").css('width', g_fgthumbsstartingwidth+'px');
	//g_fgenxtthumb();
	<?php if($nshowtxth == 3){ ?>
	jQuery(".imgscontainer").remove();
		<?php if(is_home()){ ?>
	tcenvpffsviewport();
	jQuery(".portfolio-arrow-right, .portfolio-arrow-left").css({'z-index':'99999'});
	g_fgenxtthumbalt();
	recreateprojbyvalidsarr();
		<?php }
	}else{ ?>
	g_fgenxtthumbalt();
	<?php } ?>
	
	/* $("#fg_preview .imgprevarrows .arrowleft").click(function(){
        fg_imgsetbyordcache(1);
    });
    $("#fg_preview .imgprevarrows .arrowright").click(function(){
        fg_imgsetbyordcache(2);
    }); */
    $("#fg_preview").css('display','none');
});
</script>				
<?php //get_footer(); ?>