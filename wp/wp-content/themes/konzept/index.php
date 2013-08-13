<?php get_header(); ?>

<?php include('template-portoflio.php'); ?>

<?php
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'Android')){ $mobile = true; }else{ $mobile = false; }
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){ $ipad = true; }else{ $ipad = false; }
	if($_GET['featured'] == 'true') { $_SESSION['featured']=0; }
	if($_GET['featured'] == 'false') { $_SESSION['featured']=1; }
	$cur_slideshow = get_option("flow_featured_slideshow");
	if(isset($_SESSION['featured']) && ($_SESSION['featured'] == 0)){ $cur_slideshow = 0; }
	if(isset($_SESSION['featured']) && ($_SESSION['featured'] == 1)){ $cur_slideshow = 1; }
	if ($cur_slideshow == 0 AND !$mobile) { ?>
<?php // if(get_option("flow_featured_slideshow") == 0 AND !$mobile){ ?>
<script type="text/javascript">
//Setup iScroll4 plugin
var myScroll;

function loaded() {
	myScroll = new iScroll('wrapper', {
		snap: 'li',
		momentum: false,
		hScrollbar: false,
		vScrollbar: false,
		hScroll: true,
		vScroll: false,
		wheelAction: 'none',
		onScrollMove: function() { },
		onRefresh: function() {
		//jQuery(".slide-img").each(function(i,e){ resizeimagesflow(e); });
		//jQuery(window).trigger("resize");
		$(".slide-img").each(function(i,e){
		jQuery(this).imageLoad(function(){
			//resizeimagesflow(this);
			resizeimageslide($(this),false,false);
		});
	});
		},
	 });
}

//This function check if image has already loaded and resizes it to fit screen if so (used in iScroll refresh).
function resizeimagesflow(rrr){
	if(jQuery(rrr).height() == 0 || jQuery(rrr).width() == 0){
		setTimeout(function(){
			resizeimagesflow(rrr);
		}, 500);
	}else{
		resizeimageslide($(rrr),false,false); //Call to function located in header.php
	}
}

//This function resizes all newly added video slides (posters + video tags) and is triggered on window resize event.
function resizevideosflow(){
	jQuery(".video-slidex").each(function(){
		var current_video_height = jQuery(this).find(".videoBG video").height();
		var current_video_width = jQuery(this).find(".videoBG video").width();
		//var current_window_height = jQuery(window).innerHeight(); //Doesn't work on iPhone due to top address bar
		var current_window_height = window.innerHeight ? window.innerHeight:$(window).height();
		var current_window_width = jQuery(window).innerWidth();
		if((current_video_width/current_video_height) >= (current_window_width/current_window_height)){
			jQuery(this).css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG_wrapper").css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG").css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG video").css({ 'height' : current_window_height, 'width' : 'auto', "left" : 0, "top" : 0 });
		}else{
			jQuery(this).css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG_wrapper").css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG").css({ 'height' : current_window_height, 'width' : current_window_width });
			jQuery(this).find(".videoBG video").css({ 'height' : 'auto', 'width' : current_window_width, "left" : 0, "top" : 0 });
		}
	});
}

//This function makes slideshow links clickable by appending them to #konzept_slideshow
function reinitlinkflow(current_slide){
	var current_excerpt = jQuery("#slide_"+current_slide).find(".slideshow-project-excerpt");
	var current_project_excerpt_height = current_excerpt.height();
	jQuery(".excerpt-clone").remove();
	current_excerpt.clone().appendTo('#konzept_slideshow').addClass("excerpt-clone");
	var outer_a_height = jQuery("#slide_"+current_slide).find(".slideshow-project-excerpt a").outerHeight();
	jQuery("#slide_"+current_slide+" .project-more").hide();
	jQuery("#konzept_slideshow>.excerpt-clone>a").fadeIn(400);
	jQuery(".excerpt-clone").find("h1").remove();
	jQuery(".excerpt-clone").find("h4").remove();
	jQuery(".excerpt-clone").height(current_project_excerpt_height+outer_a_height);
}

	var current_slide = 0; //Initial slide is always 0
	
	function slideshow_next_slide(){
		var number_of_slides = jQuery("#thelist li").length; //Number of slides (each slide has id="slide_0", id="slide_1" etc.)
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).pause();
		}
		current_slide++; if(current_slide == number_of_slides){ current_slide = 0; }
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			setTimeout(function(){
				if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
					jQuery("#slide_"+current_slide+" video").get(0).play();
				}
			}, 200);
		}
		//reinitlinkflow(current_slide);
		myScroll.scrollToPage(current_slide, 0, 300);
	}
	function slideshow_prev_slide(){
		var number_of_slides = jQuery("#thelist li").length; //Number of slides (each slide has id="slide_0", id="slide_1" etc.)
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).pause();
		}
		current_slide--; if(current_slide == -1){ current_slide = number_of_slides-1; }
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			setTimeout(function(){
				if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
					jQuery("#slide_"+current_slide+" video").get(0).play();
				}
			}, 200);
		}
		//reinitlinkflow(current_slide);
		myScroll.scrollToPage(current_slide, 0, 300);
	}
	$.fn.imageLoad = function(fn){
		this.load(fn);
		this.each( function() {
			if ( this.complete && this.naturalWidth !== 0 ) {
				$(this).trigger('load');
			}
		});
	}


document.addEventListener('DOMContentLoaded', loaded, false);

jQuery(document).ready(function(){

	/* Define correct height() for iPhone (jQuery 1.7.2 FIX). Announced to be repaired in jQuery 1.8 */
	var winheight = window.innerHeight ? window.innerHeight:$(window).height();
	
	/* Initial visual fixes */
	jQuery(".video-slidex").css({ 'height' : winheight, 'width' : $(window).width() });
	jQuery("body").css({ 'overflow' : "hidden" });
	jQuery(".imgscontainer").css({ 'opacity' : 0 });
	setTimeout(function(){
		jQuery('body').stop().animate({"opacity":1}, 400);
	}, 500);
	
	//Eliminate window resizing problems
	$(window).bind("resize.featuredhandler", function(){
		winheight = window.innerHeight ? window.innerHeight:$(window).height();
		jQuery(".image-slide").css({ 'height' : winheight, 'width' : $(window).width() });
		resizevideosflow();
		jQuery(".slideshow-project-excerpt").each(function(){
			var outer_a_height = jQuery(this).children(".project-more").css({"display":"block"}).outerHeight(true);
			jQuery(this).parent().parent().parent().parent().find(".excerpt-clone").css({ "height" : jQuery(this).height()+outer_a_height });
			jQuery(this).css({ "bottom" : "auto" }).css({ "height" : jQuery(this).height() }).css({ "bottom" : "0" });
			jQuery(this).css({ "height" : "auto" }).css({ "bottom" : "auto" });
			var project_excerpt_height = jQuery(this).height();
			jQuery(this).css({ "height" : project_excerpt_height }).css({ "bottom" : "0" });
		});
		setTimeout(function(){
			jQuery(".konzept_arrow_left").trigger("click");
			jQuery(".konzept_arrow_right").trigger("click");
		}, 0);
	});
	jQuery(".image-slide").css({ 'height' : winheight, 'width' : $(window).width() });
	jQuery(".video-slidex").css({ 'height' : winheight, 'width' : $(window).width() });
	jQuery(".slideshow-project-excerpt").each(function(){
		var project_excerpt_height = parseInt(jQuery(this).height());
		jQuery(this).css({ "height" : project_excerpt_height }).css({ "bottom" : "0" });
	});
	//jQuery(".slide-img").each(function(i,e){ resizeimagesflow(this); });
	$(".slide-img").each(function(i,e){
		jQuery(this).imageLoad(function(){
			//resizeimagesflow(this);
			resizeimageslide($(this),false,false);
		});
	});
	
	//Kill all events, restore normal state
	var header_color = jQuery("#header").css("background-color");
	jQuery("#header").css({"background-color" : "transparent"});
	jQuery(".pf_nav a").bind("click.featuredhandler", function(){
		jQuery(".pf_nav a").unbind("click.featuredhandler");
		jQuery(window).unbind("resize.featuredhandler");
		jQuery(".konzept_arrow_left").unbind("click");
		jQuery(".konzept_arrow_right").unbind("click");
		jQuery(".imgscontainer").css({ 'opacity' : 0 });
		jQuery("#konzept_slideshow").animate({ 'opacity' : 0 }, 1000, function(){
			jQuery("#konzept_slideshow").css({ 'display' : "none" });
			jQuery("#header").css({ 'background-color' : header_color });
			jQuery("#konzept_slideshow").remove();
			jQuery(".imgscontainer").animate({ 'opacity' : 1 }, 1000 );
		});
		
		// Necessary to resize thumbnails after browser's scrollbar is added
		jQuery(window).trigger("resize");
	});
	
	/* Create controls (keyboard, mousewheel, mouse click) */	
	$("#konzept_slideshow").mousewheel(function(event, delta) {
	var dir = delta > 0 ? slideshow_prev_slide() : slideshow_next_slide();
		event.preventDefault();
	});
   	jQuery(window).keydown(function(e){
		if(e.keyCode == 37 || e.keyCode == 38){
			slideshow_prev_slide();
		}else if(e.keyCode == 39 || e.keyCode == 40){
			slideshow_next_slide();
		}
	});
	if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/)){
		jQuery(".konzept_arrow_left").remove();
		jQuery(".konzept_arrow_right").remove();
	}
	jQuery(".konzept_arrow_left").click(function(){
		slideshow_prev_slide();
	});	
	jQuery(".konzept_arrow_right").click(function(){
		slideshow_next_slide();
	});
	<?php if($ie){ ?>
	ie_konzept_featured_slideshow_cursor_fix();
	<?php } ?>
});

<?php if($ie){ ?>
var iecursorhidedelayed = false;
function ie_konzept_featured_slideshow_cursor_fix(){
	if(!jQuery('.konzept-arrowcursor').length){
		var cursorsrcarrow = "<?php print(get_bloginfo('template_directory')); ?>/images/cursors/cursor_prev_black.png";
		jQuery('body').prepend('<img style="position:absolute;display:none;cursor:none;z-index:1500002;" class="konzept-arrowcursor" src="'+cursorsrcarrow+'" />');
	}
	//console.log('test');
	jQuery(".konzept_arrow_right, .konzept_arrow_left").unbind("hover").unbind("mousemove").hover(function(e){
		if(iecursorhidedelayed){
			clearTimeout(iecursorhidedelayed);
			iecursorhidedelayed = false;
		}
		var cursorsrcarrow = "cursor_prev_black.png";
		if(jQuery(e.target).hasClass("konzept_arrow_right")){
			//if(jQuery(e.target).hasClass("portfolio-arrow-right-last-white")){
			//	cursorsrcarrow = "cursor_nextproject_white.png";
			//}else if(jQuery(e.target).hasClass("portfolio-arrow-right-white")){
			//	cursorsrcarrow = "cursor_next_white.png";
			//}else if(jQuery(e.target).hasClass("portfolio-arrow-right-last")){
			//	cursorsrcarrow = "cursor_nextproject_black.png";
			//}else{
				cursorsrcarrow = "cursor_next_black.png";
				cursorsrcarrow = "cursor_next_white.png";
			//}
		}else if(jQuery(e.target).hasClass("konzept_arrow_left")){
			//if(jQuery(e.target).hasClass("portfolio-arrow-left-first-white")){
			//	cursorsrcarrow = "cursor_prevproject_white.png";
			//}else if(jQuery(e.target).hasClass("portfolio-arrow-left-white")){
				cursorsrcarrow = "cursor_prev_white.png";
			//}else if(jQuery(e.target).hasClass("portfolio-arrow-left-first")){
			//	cursorsrcarrow = "cursor_prevproject_black.png";
			//}else{
				//default
			//}
		}
		cursorsrcarrow = "<?php print(get_bloginfo('template_directory')); ?>/images/cursors/"+cursorsrcarrow;
		jQuery('.konzept-arrowcursor').attr("src",cursorsrcarrow).css({'display':'block'}).show().css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
	},function(){
		iecursorhidedelayed = setTimeout(function(){
			jQuery('.konzept-arrowcursor').hide();
		},150);
	}).mousemove(function(e){
		jQuery('.konzept-arrowcursor').css({'left':(e.pageX+1)+'px','top':(e.pageY+1)+'px'});
	});
	
	jQuery(".pf_nav a").bind("click.featuredhandlerie", function(){
		jQuery(".pf_nav a").unbind("click.featuredhandlerie");
		jQuery('.konzept-arrowcursor').remove();
	});
}
<?php } ?>
</script>
<style type="text/css">
	body { opacity: 0; }
	#konzept_slideshow { width:100%; position: fixed; z-index: 8; top: 0; }
	#scroller { float:left; padding: 0 0 0 0; }
	#scroller ul { list-style:none; display:block; float:left; width:21000px; }
	#scroller li { float:left; margin: 0; position: relative; overflow: hidden; }
	#scroller li img { width: 100%; position: absolute; }
	.slideshow-project-excerpt { display: block; left: 0; margin: auto; max-width: 1200px; position: absolute; right: 0; top: 0; width: 92%; z-index: 2143833; padding-top: 90px; }
	.slideshow-project-title { color: #F8F8F8; font-family: 'NovecentowideBold',Arial,sans-serif; font-size: 140px; line-height: 110px; margin-bottom: 2%; margin-top: 0; width: 100%; word-wrap: break-word; }
	.slideshow-project-title-dark { color: #222222; }
	.slideshow-project-desc-dark { color: #464646!important; }
	.imgscontainer { opacity: 0; }
	.videoBG_wrapper { width: inherit; height; inherit; }
	.videoBG { width: inherit; height; inherit; }
	.videoBG video { }
	.project-more { position: relative; z-index: 99999999; }
	@media (max-width: 1440px) {
		.slideshow-project-title { font-size: 100px; line-height: 80px; margin-bottom: 1%; }
		.project-more { font-size: 30px; margin-top: 5%; }
	}	
	@media (max-width: 1200px) {
		.slideshow-project-title { font-size: 75px; line-height: 58px; }
		.project-description { font-size: 18px; }
		.project-more { font-size: 24px; }
	}	
	@media (max-width: 900px) {
		.slideshow-project-title { font-size: 45px; line-height: 38px; }
		.project-description { font-size: 16px; }
		.project-more { font-size: 22px; margin-top: 7%; }
	}
	.konzept_arrow_left { position: absolute; }
	.konzept_arrow_right { position: absolute; }	
	
	<?php if($ie){ ?>
	.konzept_arrow_left { background-color:#000;opacity:0.01; }
	.konzept_arrow_right { background-color:#000;opacity:0.01; }
	<?php } ?>
	
	.excerpt-clone { z-index: auto; }
	.excerpt-clone a { position: absolute!important; bottom: 0!important; z-index: 13242323; color: #3B95B1; display: block; float: left; font-family: 'NovecentowideBold',Arial,sans-serif; margin-top: 7%; }
</style>
<div id="konzept_slideshow">
	<?php if(false and $ie){ ?>
	<div class="konzept_arrow_left" style="background-color:#000;opacity:0.01;"></div>
	<div class="konzept_arrow_right" style="background-color:#000;opacity:0.01;"></div>
	<?php } ?>
	<!--<div class="konzept_arrow_left"></div>
	<div class="konzept_arrow_right"></div>-->
	<div id="wrapper">
		<div id="scroller">
			<ul id="thelist">
<?php 
	$args = array( 'post_type' => 'slideshow' );
	$recent = new WP_Query( $args );
	while($recent->have_posts()) : $recent->the_post();
	
	// Set variables
	if(get_post_meta($post->ID, 'slide-link', true)){ $slide_link = get_post_meta($post->ID, 'slide-link', true); }else{ $slide_link = get_permalink(); }
	if(get_post_meta($post->ID, 'slide-link-name', true)){ $slide_link_name = get_post_meta($post->ID, 'slide-link-name', true); }else{ $slide_link_name = '+ View Project'; }
	if(get_post_meta($post->ID, 'Title', true)){ $page_title = get_post_meta($post->ID, 'Title', true); }else{ $page_title = get_the_title(); }
	if(get_post_meta($post->ID, 'Description', true)){ $page_description = get_post_meta($post->ID, 'Description', true); }
	if(get_post_meta($post->ID, 'slide-image', true)){ $slide_image = get_post_meta($post->ID, 'slide-image', true); }else{ unset($slide_image); }
	if(get_post_meta($post->ID, 'slide-video', true)){ $slide_video = get_post_meta($post->ID, 'slide-video', true); }else{ unset($slide_video); }
	if(get_post_meta($post->ID, 'slide-video-mp4', true)){ $slide_video_mp4 = get_post_meta($post->ID, 'slide-video-mp4', true); }else{ unset($slide_video_mp4); }
	if(get_post_meta($post->ID, 'slide-video-ogg', true)){ $slide_video_ogg = get_post_meta($post->ID, 'slide-video-ogg', true); }
	if(get_post_meta($post->ID, 'slide-video-webm', true)){ $slide_video_webm = get_post_meta($post->ID, 'slide-video-webm', true); }
	if(get_post_meta($post->ID, 'slide-video-poster', true)){ $slide_video_poster = get_post_meta($post->ID, 'slide-video-poster', true); }
	if(get_post_meta($post->ID, 'slide-text-color', true) == '#464646'){ $slide_text_color_title = 'slideshow-project-title-dark'; $slide_text_color_desc = 'slideshow-project-desc-dark'; }else{ unset($slide_text_color_title); unset($slide_text_color_desc); }
	if(isset($slide_id)){ $slide_id++; }else{ $slide_id = 0; }
	
	//Display slides
	if($slide_image){ ?>
	<li id="slide_<?php echo $slide_id; ?>" class="image-slide">
		<div class="konzept_arrow_left"></div>
		<div class="konzept_arrow_right"></div>
		<div class="slideshow-project-excerpt">
			<div class="konzept_arrow_left"></div>
			<div class="konzept_arrow_right"></div>
			<h1 class="slideshow-project-title <?php echo $slide_text_color_title; ?>"><?php echo $page_title; ?></h1>
			<h4 class="project-description <?php echo $slide_text_color_desc; ?>"><?php echo summarise_excerpt($page_description,70); ?></h4>
			<a class="project-more" href="<?php echo $slide_link; ?>" title="<?php echo $page_title; ?>"><?php echo $slide_link_name; ?></a>
		</div>
		<img class="slide-img" src="<?php echo $slide_image; ?>" alt="<?php echo $page_title; ?>" />
	</li>
	<?php }else if($slide_video_mp4){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(window).load(function(){
				jQuery('#slide_<?php echo $slide_id; ?>').videoBG({
					mp4:'<?php echo $slide_video_mp4; ?>',
					ogv:'<?php echo $slide_video_ogg; ?>',
					webm:'<?php echo $slide_video_webm; ?>',
					poster:'<?php echo $slide_video_poster; ?>',
					scale:true,
					//fullscreen: true,
					//autoplay:false, //Doesn't work! Workaround below.
					zIndex:0,
					loop: true,
				});
				setTimeout(function(){ //Bad luck, this is some crappy plugin and settimeout seems to be the only way out. No callback supported!
				<?php if($slide_id == 0){ }else{ echo '$("#slide_'.$slide_id.' video").get(0).pause();'; } ?>
				<?php if($ipad){ echo '$("#slide_'.$slide_id.' video").get(0).play();'; } ?>
				}, 1500);
				jQuery(".konzept_arrow_left").unbind("click");
				jQuery(".konzept_arrow_right").unbind("click");
				jQuery(".konzept_arrow_left").click(function(){
					slideshow_prev_slide();
				});	
				jQuery(".konzept_arrow_right").click(function(){
					slideshow_next_slide();
				});
			});
		});
	</script>
	<li id="slide_<?php echo $slide_id; ?>" class="video-slidex">
		<div class="konzept_arrow_left"></div>
		<div class="konzept_arrow_right"></div>
		<div class="slideshow-project-excerpt">
			<div class="konzept_arrow_left"></div>
			<div class="konzept_arrow_right"></div>
			<h1 class="slideshow-project-title"><?php echo $page_title; ?></h1>
			<h4 class="project-description"><?php echo summarise_excerpt($page_description,70); ?></h4>
			<a class="project-more" href="<?php echo $slide_link; ?>" title="<?php echo $page_title; ?>"><?php echo $slide_link_name; ?></a>
		</div>
	</li>
	<?php } ?>
	<?php endwhile; ?>
			</ul>
		</div> <!-- /#scroller -->
	</div> <!-- /#wrapper -->
</div> <!-- /#konzept_slideshow -->
<?php } ?>

<?php get_footer(); ?>