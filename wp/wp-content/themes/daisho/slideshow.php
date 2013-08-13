<?php
	global $mobile;
	global $ipad;
	if(get_option("flow_featured_slideshow") == 0){ ?>
<script type="text/javascript">
var myScroll;
var current_slide = 0; //Initial slide is always 0

function loaded(){
	myScroll = new iScroll('flow_slideshow_wrapper', {
		snap: 'li',
		bounce: false,
		bounceLock: false,
		momentum: false,
		hScrollbar: false,
		vScrollbar: false,
		hScroll: true,
		vScroll: false,
		wheelAction: 'none',
		onScrollMove: function(){ },
		onRefresh: function(){ },
	 });
}
document.addEventListener('DOMContentLoaded', loaded, false);


	
	function slideshow_next_slide(){
		var number_of_slides = jQuery("#thelist li").length; //Number of slides (each slide has id="slide_0", id="slide_1" etc.)
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).pause();
		}
		current_slide++; if(current_slide == number_of_slides){ current_slide = 0; }
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).play();
		}
		<?php if($ipad || $mobile){ ?>
		myScroll.scrollToPage(current_slide, 0, 300);
		<?php }else{ ?>
		if(jQuery(window).width() <= 1024){
			myScroll.scrollToPage(current_slide, 0, 300);
		}else{
			myScroll.scrollToPage(current_slide, 0, 0);
			sliderAnimationsFlow();
		}
		<?php } ?>
	}
	function slideshow_prev_slide(){
		var number_of_slides = jQuery("#thelist li").length; //Number of slides (each slide has id="slide_0", id="slide_1" etc.)
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).pause();
		}
		current_slide--; if(current_slide == -1){ current_slide = number_of_slides-1; }
		if(jQuery("#slide_"+current_slide).hasClass("video-slidex")){
			jQuery("#slide_"+current_slide+" video").get(0).play();
		}
		<?php if($ipad || $mobile){ ?>
		myScroll.scrollToPage(current_slide, 0, 300);
		<?php }else{ ?>
		if(jQuery(window).width() <= 1024){
			myScroll.scrollToPage(current_slide, 0, 300);
		}else{
			myScroll.scrollToPage(current_slide, 0, 0);
			sliderAnimationsFlow();
		}
		<?php } ?>
	}
	function sliderAnimationsFlow(){
		/* Animation - Flow */
		var button_margin = '0.4em';
		var rand_no = (Math.floor(Math.random()*10000000))%3+1;
		var padding_type = 'padding-left';
		if(rand_no == 1){ padding_type = 'padding-left'; }else if(rand_no == 2){ padding_type = 'padding-right'; }else if(rand_no == 3){ padding_type = 'padding-top'; }
		var img_margin = 0;
		jQuery("#slide_"+current_slide).find('.slideshow-project-title').css({ 'opacity': 0, 'margin-top' : 40+'px' });
		jQuery("#slide_"+current_slide).find('.project-description-home').css({ 'opacity': 0, 'margin-top' : 40+'px' });
		jQuery("#slide_"+current_slide).find('.button').css({ 'opacity': 0, 'margin-top' : -40+'px' });
		jQuery("#slide_"+current_slide).find('.slide-img').css({ 'opacity': 0}).css(padding_type,240+'px');
		
		jQuery("#slide_"+current_slide).find('.slideshow-project-title').animate({ 'opacity': 1, 'margin-top' : 0+'px' }, 600);
		jQuery("#slide_"+current_slide).find('.project-description-home').animate({ 'opacity': 1, 'margin-top' : 0+'px' }, 600);
		jQuery("#slide_"+current_slide).find('.button').animate({ 'opacity': 1, 'margin-top' : button_margin }, 700, 'easeOutBounce');
		var amap = {'opacity': 1};
		amap[padding_type] = img_margin;
		jQuery("#slide_"+current_slide).find('.slide-img').animate(amap, 300, 'easeInOutCirc');
	}

jQuery(document).ready(function(){

	jQuery('#thelist').css({ 'width' : (jQuery('.slideshow-slide').length * jQuery(window).width()) });

	/* Define correct height() for iPhone (jQuery 1.7.2 FIX). Announced to be repaired in jQuery 1.8 */
	//var winheight = window.innerHeight ? window.innerHeight:jQuery(window).height();
	
	//Eliminate window resizing problems
	function resizeSlideshow(){
		//winheight = window.innerHeight ? window.innerHeight:jQuery(window).height();
		//jQuery(".slideshow-slide").css({ 'height' : winheight, 'width' : jQuery(window).width() });
		jQuery(".slideshow-slide").css({ 'width' : jQuery(window).width() });
		//jQuery(".slideshow-slide:nth-child(2)").css({ 'width' : jQuery(window).width()-100 });
		
		setTimeout(function (){
			jQuery('#thelist').css({ 'width' : (jQuery('.slideshow-slide').length * jQuery(window).width()) });
			myScroll.refresh();
			myScroll.scrollToPage(myScroll.currPageX, 0, 0);
		}, 0);
		
	}
	
	var TO = false;
	jQuery(window).bind("resize.featuredhandler", function(){
		/* if(TO !== false){
			clearTimeout(TO);
		}
		TO = setTimeout(resizeSlideshow, 2200); */
		resizeSlideshow();
	});
	
	/* Set dimensions */
	jQuery(".slideshow-slide").css({ 'width' : jQuery(window).width() });
	
	/* Create controls (keyboard, mousewheel, mouse click) */
	
	<?php $flow_slideshow_mousewheel = get_option('flow_slideshow_mousewheel'); ?>
	<?php if($flow_slideshow_mousewheel == 1){ }else{ ?>
	jQuery("#flow_slideshow").mousewheel(function(event, delta){
		var dir = delta > 0 ? slideshow_prev_slide() : slideshow_next_slide();
		event.preventDefault();
	});
	<?php } ?>
	
   	jQuery(window).keydown(function(e){
		if(e.keyCode == 37 || e.keyCode == 38){
			slideshow_prev_slide();
		}else if(e.keyCode == 39 || e.keyCode == 40){
			slideshow_next_slide();
		}
	});
	if(Modernizr.touch){
		jQuery(".konzept_arrow_left").remove();
		jQuery(".konzept_arrow_right").remove();
	}
	jQuery(".konzept_arrow_left").on('click.flow_slideshow_arrow_left', function(){
		slideshow_prev_slide();
	});
	jQuery(".konzept_arrow_right").on('click.flow_slideshow_arrow_right', function(){
		slideshow_next_slide();
	});
	<?php $flow_slideshow_autoplay = get_option('flow_slideshow_autoplay'); ?>
	<?php if($flow_slideshow_autoplay != ''){ ?>
		autoplay_flow();
	<?php } ?>
});
function autoplay_flow(){
	setTimeout(function(){
		slideshow_next_slide();
		autoplay_flow();
	}, <?php if($flow_slideshow_autoplay != '' && $flow_slideshow_autoplay >= 0){ echo $flow_slideshow_autoplay; }else{ echo '12000'; } ?>);
}
</script>
<div id="flow_slideshow">
	<div class="konzept_arrow_left"></div>
			<div class="konzept_arrow_right"></div>
	<div id="flow_slideshow_wrapper">
		<div id="scroller">
			<ul id="thelist">
				<?php 
				$args = array('post_type' => 'slideshow');
				$recent = new WP_Query($args);
				while($recent->have_posts()){
					$recent->the_post();
					
					// Set variables
					if(get_post_meta($post->ID, 'slide-link', true)){ $slide_link = get_post_meta($post->ID, 'slide-link', true); }else{ $slide_link = get_permalink(); }
					if(get_post_meta($post->ID, 'slide-link-name', true)){ $slide_link_name = get_post_meta($post->ID, 'slide-link-name', true); }else{ $slide_link_name = ''; }
					
					// Title
					if(get_post_meta($post->ID, 'flow_post_title', true)){
						$page_title = get_post_meta($post->ID, 'flow_post_title', true); 
					}else if(get_post_meta($post->ID, 'Title', true)){
						$page_title = get_post_meta($post->ID, 'Title', true);
					}else{
						$page_title = get_the_title();
					}
					
					// Description
					if(get_post_meta($post->ID, 'flow_post_description', true)){
						$page_description = get_post_meta($post->ID, 'flow_post_description', true); 
					}else if(get_post_meta($post->ID, 'Description', true)){
						$page_description = get_post_meta($post->ID, 'Description', true); 
					}else{ 
						$page_description = '';
					}
					
					if(get_post_meta($post->ID, 'slide-image', true)){ $slide_image = get_post_meta($post->ID, 'slide-image', true); }else{ $slide_image = ''; }
					

					if(get_post_meta($post->ID, 'slide-image-x-offset', true)){ $slide_image_x_offset = 'left:'.get_post_meta($post->ID, 'slide-image-x-offset', true).';'; }else{ $slide_image_x_offset = ''; }
					if(get_post_meta($post->ID, 'slide-image-y-offset', true)){ $slide_image_y_offset = 'top:'.get_post_meta($post->ID, 'slide-image-y-offset', true).';'; }else{ $slide_image_y_offset = ''; }
					if(get_post_meta($post->ID, 'slide-button-x-offset', true)){ $slide_button_x_offset = get_post_meta($post->ID, 'slide-button-x-offset', true); }else{ $slide_button_x_offset = '0px'; }
					if(get_post_meta($post->ID, 'slide-button-y-offset', true)){ $slide_button_y_offset = get_post_meta($post->ID, 'slide-button-y-offset', true); }else{ $slide_button_y_offset = '0px'; }
					if(get_post_meta($post->ID, 'slide-button-icon', true)){ $slide_button_icon = get_post_meta($post->ID, 'slide-button-icon', true); }else{ $slide_button_icon = ''; }
					
					if(!($slide_button_text_color = get_post_meta($post->ID, 'slide-button-text-color', true))){ $slide_button_text_color = '#f1f1f1'; }
					if(!($slide_title_text_color = get_post_meta($post->ID, 'slide-title-text-color', true))){ $slide_title_text_color = '#ffffff'; }
					if(!($slide_description_text_color = get_post_meta($post->ID, 'slide-description-text-color', true))){ $slide_description_text_color = '#ffffff'; }
					
					if(get_post_meta($post->ID, 'slide-color', true)){ $slide_color = get_post_meta($post->ID, 'slide-color', true); }else{ $slide_color = '#00a4a7'; }
					if(isset($slide_id)){ $slide_id++; }else{ $slide_id = 0; }
					
					//Display slides
					if($slide_image){ ?>
						<li id="slide_<?php echo $slide_id; ?>" class="slideshow-slide">
							<div class="slideshow-meta-wrapper">
								<div class="slideshow-meta-inner">
									<div class="slideshow-meta-inner-2">
										<h1 class="slideshow-meta-title" style="color: <?php echo $slide_title_text_color; ?>;"><?php echo $page_title; ?></h1>
										<h4 class="slideshow-meta-description" style="color: <?php echo $slide_description_text_color; ?>;"><?php echo summarise_excerpt($page_description,70); ?></h4>
									</div>
								</div>
							</div>
							<?php if($slide_link_name != ''){ ?>
								<div class="slideshow-button-wrapper">
									<a href="<?php echo $slide_link; ?>" data-icon="<?php echo $slide_button_icon; ?>" class="slideshow-button" style="top: <?php echo $slide_button_y_offset; ?>; right: <?php echo $slide_button_x_offset; ?>; color: <?php echo $slide_button_text_color; ?>; text-shadow: 0px -1px 0px <?php echo hexDarker($slide_color, 8); ?>; background-color: <?php echo $slide_color; ?>;"><?php echo $slide_link_name; ?></a>
								</div>
							<?php } ?>
							<img class="slide-img" style="position: absolute; clear: both; <?php echo $slide_image_x_offset.$slide_image_y_offset; ?>" src="<?php echo $slide_image; ?>" alt="<?php echo $page_title; ?>" />
							<div class="slideshow-background" style="background-color: <?php echo $slide_color; ?>;"></div>
						</li>
					<?php } ?>
				<?php } // endwhile; ?>
			</ul>
		</div> <!-- /#scroller -->
	</div> <!-- /#flow_slideshow_wrapper -->
	<?php
		//$pager = '<div class="flow_slideshow_pager" style="display:none;"><ul class="inner">';
		//for($i=0;$i<=$slide_id;$i++){ $pager .= '<li class="flow_slideshow_pager_'.$i.'"></li>'; }
		//$pager .= '</ul></div>';
		//echo $pager;
	?>
</div> <!-- /#flow_slideshow -->
<?php } ?>