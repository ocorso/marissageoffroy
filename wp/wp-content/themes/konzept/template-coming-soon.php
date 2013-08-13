<?php  get_header(); ?>
<style type="text/css">
	body { opacity: 0; }
	.page_arrow_left, .page_arrow_right{ display:none; }
	.ContentFlow .scrollbar{ display:none; }
	</style>
	<div class="page_description"><div class="page_title"><?php  if (get_post_meta($post->ID, 'Title', true)) { ?><?php  echo get_post_meta($post->ID, 'Title', true); ?><?php  }else{ ?><?php  the_title(); ?><?php  } ?></div><div class="page_arrow_left"><</div><div class="page_arrow_right">></div></div>
<!--	<div class="cooming-soon-content" id="scrollbar2" style="display:none;">
<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
	<div class="viewport">
		<div class="overview overview_dribbble" style="margin-left:135px;width:4950px;">
		
        <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
		
		<div class="jquery_height" style="display: table; #position: relative; overflow: hidden;">
    <div style=" #position: absolute; #top: 50%;display: table-cell; vertical-align: middle;">
      <div style=" #position: relative; #top: -50%">
		<?php  /* get_sidebar(); */ ?>
<?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){ }else{ ?>
	<div style="background-image: linear-gradient(left , rgba(242,242,242,0) 0%, rgb(242,242,242) 92%);
background-image: -o-linear-gradient(left , rgba(242,242,242,0) 0%, rgb(242,242,242) 92%);
background-image: -moz-linear-gradient(left , rgba(242,242,242,0) 0%, rgb(242,242,242) 92%);
background-image: -webkit-linear-gradient(left , rgba(242,242,242,0) 0%, rgb(242,242,242) 92%);
background-image: -ms-linear-gradient(left , rgba(242,242,242,0) 0%, rgb(242,242,242) 92%);
background-image: -webkit-gradient(linear, left bottom, right bottom, color-stop(0.0, rgba(242,242,242,0)), color-stop(0.92, rgb(242,242,242))); width: 35%;height:400px;position:fixed;right:0;">
	</div>
<?php  } ?>
		
      </div>
      </div>
      </div>
    </div>
  </div> -->
  
  <style type="text/css">
	.cooming-soon-content .widgettitle{ display:none; }
	.cooming-soon-content .dribbble-over{ display:none; }
</style>
<script type="text/javascript">
/*var dribblefeedchsize = 400;
jQuery(document).ready(function() {
	$(".cooming-soon-content").css({'width':(jQuery(window).width()-210)+"px"});
	if($(".dribbbles").length){
		$(".dribbbles").css({'left':'150px', 'width':(jQuery(window).width()-350)+"px", 'height':"500px", 'top':(jQuery(window).height()-600)+'px'});
		$(".dribbbles img").addClass('cloudcarousel');
		$(".dribbbles").CloudCarousel({ 
			reflHeight: 56,
			reflGap:0,
			//titleBox: $(),
			//altBox: $(),
			buttonLeft: jQuery('.page_arrow_left'),
			buttonRight: jQuery('.page_arrow_right'),
			yRadius:70,
			xPos: (jQuery(window).width()-350)/2,
			yPos: 50,
			speed:0.15,
			mouseWheel:true,
			//autoRotate: 'left',
			//autoRotateDelay: 1200,
			bringToFront:true
		});
	}
	jQuery(window).resize(function(){
		if($(".dribbbles").length){
			$(".dribbbles").css({'left':'150px', 'width':(jQuery(window).width()-350)+"px", 'height':"500px"});
			if(jQuery(window).height() <= 750){
				$(".dribbbles").css({'top':jQuery(window).height()-500});
			}else if(jQuery(window).height() <= 1000){
				$(".dribbbles").css({'top':jQuery(window).height()-600});
			}else{
				$(".dribbbles").css({'top':(jQuery(window).height()-500)/2+100});
			}
			$(".dribbbles").data("cloudcarousel").xRadius = ((jQuery(window).width()-350)/2.3);
			$(".dribbbles").data("cloudcarousel").xCentre = (jQuery(window).width()-350)/2;
			if(jQuery(window).width() <= 1100){
				if(dribblefeedchsize != 200){
					dribblefeedchsize = 200;
					$(".dribbbles .reflection").remove();
					$(".dribbbles").data("cloudcarousel").removeImages();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = '200px';
						iie.style.height = '150px';
					});
					$(".dribbbles").data("cloudcarousel").checkImagesLoaded();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = null;
						iie.style.height = null;
					});
					$(".dribbbles").data("cloudcarousel").yCentre = 150;
				}
			}else if(jQuery(window).width() <= 1600){
				if(dribblefeedchsize != 300){
					dribblefeedchsize = 300;
					$(".dribbbles .reflection").remove();
					$(".dribbbles").data("cloudcarousel").removeImages();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = '300px';
						iie.style.height = '225px';
					});
					$(".dribbbles").data("cloudcarousel").checkImagesLoaded();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = null;
						iie.style.height = null;
					});
					$(".dribbbles").data("cloudcarousel").yCentre = 100;
				}
			}else{
				if(dribblefeedchsize != 400){
					dribblefeedchsize = 400;
					$(".dribbbles .reflection").remove();
					$(".dribbbles").data("cloudcarousel").removeImages();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = '400px';
						iie.style.height = '300px';
					});
					$(".dribbbles").data("cloudcarousel").checkImagesLoaded();
					$(".dribbbles img").each(function(ii,iie){
						iie.style.width = null;
						iie.style.height = null;
					});
					$(".dribbbles").data("cloudcarousel").yCentre = 50;
				}
			}
			$(".dribbbles").data("cloudcarousel").updateAll();
		}
	});
});*/
var myNewFlow = false;
function additemcontentflowdelayed(content){
	if(myNewFlow.addItem(content, 'last') == -1){
		console.log("delayed fail");
		setTimeout(function(){additemcontentflowdelayed(content);}, 200);
	}
}
jQuery(document).ready(function() {
	$(".cooming-soon-content").css({'margin-left':'30px','width':(jQuery(window).width()-260)+"px",'height':'510px'});
	$(".cooming-soon-content").css({'top':((jQuery(window).height()-450)/2+110)+'px'});
	//$(".ContentFlow .flow").css({'height':'200px'});
	if($(".dribbbles").length){
		//$(".dribbbles").css({'left':'150px', 'width':(jQuery(window).width()-350)+"px", 'height':"500px", 'top':(jQuery(window).height()-600)+'px'});
		myNewFlow = new ContentFlow('mcontentflowid', { /*reflectionHeight: 50*/ } ) ;
		$(".dribbles_depr").css({'display':'none'});
		try{
			$(".dribbles_depr .dribbbles .dribbble").each(function(i,e){
				//var thitemgn = $("<a class=\"item\" href=\""+$("img", e).parent().attr("href")+"\"></a>");
				//var thitemgn = $("<div class=\"item\"></div>");
				var thitemgn = $("<a class=\"item\" href=\"javascript:void(null);\"></a>");
				thitemgn.append($("img", e).clone().addClass('content'));
				thitemgn.append($("<div class=\"caption\">"+$("img", e).attr("alt")+"</div>"));
				myNewFlow.addItem(thitemgn.get(0), 'first');
			});
			$(".dribbles_depr").remove();
		}catch(e){
			$(".dribbles_depr").css({'display':'block'});
		}
	}
	//$(".ContentFlow .scrollbar").css({"display":"block"});
});
jQuery(window).resize(function(){
	$(".cooming-soon-content").css({'width':(jQuery(window).width()-260)+"px"});
	$(".cooming-soon-content").css({'top':((jQuery(window).height()-450)/2+110)+'px'});
	if(myNewFlow){
		try{
		myNewFlow.resize();
		}catch(e){}
	}
});
</script>
	<div class="cooming-soon-content ContentFlow" id="mcontentflowid" style="display:block;">
		<div class="dribbles_depr">
			<?php  get_sidebar(); ?>
		</div>
		 <div class="__loadIndicator"><div class="__indicator"></div></div>
            <div class="flow">
			</div>
		<div class="globalCaption"></div>
		<div class="scrollbar"><div class="slider"><div class="position"></div></div></div>
  </div>
<div style="clear:both;"></div>
                    <?php  endwhile; ?>
                    <?php  else: ?>
						<p>There are no posts to display. Try searching:</p>
						<?php  get_search_form(); ?>
                    <?php  endif; ?>
    
			<div class="clear"></div>

	</div><div class="moving_gallery" style="position: fixed; top: 1680px; z-index: 2433245;"><?php  include('template-portoflio.php'); ?></div>
<?php  get_footer(); ?>