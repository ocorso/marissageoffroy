<?php get_header(); ?>
	<style type="text/css">
	body { opacity: 0; z-index:1; overflow: hidden; }
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){ ?>
	@media (min-width: 1000px) and (max-width: 1050px){ #header { opacity: 0; margin-top: -300px; } .imgscontainer { opacity: 0; } #footer { opacity: 0; } }
	@media (max-width: 750px){ #header { opacity: 0; z-index: -1; margin-top: -600px; } .imgscontainer { opacity: 0; } #footer { opacity: 0; } }
	<?php } ?>
	p { margin: 0; }
	</style>

	<!--[if gt IE 6]>
	<style type="text/css">
	.portfolio-arrow-left{ background-image:url(images/pixel.png);background-repeat:repeat; }
	.portfolio-arrow-right{ background-image:url(images/pixel.png);background-repeat:repeat; }
	</style>
	<![endif]-->
	
	<?php
	//$portfoliotextcolorfl = get_post_meta($post->ID, 'portfolio_text_color', true);
	$portfoliotextcolorfl = "#ffffff";
	$portfoliopageidfl = $post->ID;
	$portfoliopagetitlefl = ((get_post_meta($post->ID, 'Title', true))?get_post_meta($post->ID, 'Title', true):the_title());
	if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="portfolio-arrow-left portfolio-arrow-left-first<?php if($portfoliotextcolorfl=='#ffffff'){print("-white");} ?>"></div>
	<div class="portfolio-arrow-right<?php if($portfoliotextcolorfl=='#ffffff'){print(" portfolio-arrow-right-white");} ?>"></div>
	
	<div class="portfolio-fs-viewport">
		<div class="portfolio-fs-slides">
			<div class="portfolio-fs-slide">
			<?php if(($bgcval_bi = get_option("bgchanger_imgsrc") and get_option("bgchanger_imgsrc") != '') or ($bgcval_bi2 = get_post_meta($post->ID, 'bg_image', true))) { ?>
			<!-- <img class="myimage<?php if($portfoliotextcolorfl=='#ffffff'){print(" text_white");} ?>" alt="" src="<?php if($bgcval_bi2){echo $bgcval_bi2;}elseif($bgcval_bi = get_option("bgchanger_imgsrc") and get_option("bgchanger_imgsrc") != ''){echo $bgcval_bi;}else{echo'';} ?>" style="display:block;opacity:0;" /> -->
			<?php } ?>
			<div class="project-coverslide"></div>
			<div id="content" class="content-projectc<?php if($portfoliotextcolorfl=='#ffffff'){print(" contenttextwhite");} ?>">
				<div class="project-excerpt">
					<ul class="project-meta">
						<?php if(get_post_meta($post->ID, 'portfolio_date', true)){ ?>
							<li class="project-date"><span class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></span> <span class="page-exdate"><?php echo get_post_meta($post->ID, 'portfolio_date', true); ?></span></li>
						<?php } ?>
						<?php if(get_post_meta($post->ID, 'portfolio_client', true)){ ?>
							<li class="project-client"><span class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></span> <span class="page-exclient"><?php echo get_post_meta($post->ID, 'portfolio_client', true); ?></span></li>
						<?php } ?>
						<?php if(get_post_meta($post->ID, 'portfolio_agency', true)){ ?>
							<li class="project-agency"><span class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></span> <span class="page-exagency"><?php echo get_post_meta($post->ID, 'portfolio_agency', true); ?></span></li>
						<?php } ?>
						<?php if(get_post_meta($post->ID, 'portfolio_ourrole', true)){ ?>
							<li class="project-ourrole"><span class="project-meta-heading"><?php _e('ROLE', 'flowthemes'); ?></span> <span class="page-exourrole"><?php echo get_post_meta($post->ID, 'portfolio_ourrole', true); ?></span></li>
						<?php } ?>
						<?php if(get_post_meta($post->ID, 'portfolio_awards', true)){ ?>
							<li class="project-awards"><span class="project-meta-heading"><?php _e('AWARDS', 'flowthemes'); ?></span> <span class="page-exawards"><?php echo get_post_meta($post->ID, 'portfolio_awards', true); ?></span></li>
						<?php } ?>

					</ul>
					<div style="clear:both;"></div>
					
					<h1 class="project-title" style="letter-spacing:-4px;float:left;"><?php if(get_post_meta($post->ID, 'Title', true)){ echo get_post_meta($post->ID, 'Title', true); }else{ the_title(); } ?></h1>
					
					<div class="project-meta project-cats" style="float:left;margin: 14px 0 0 10px;"><?php 
						$post_cat = array();
						$post_cat = wp_get_object_terms($post->ID, "portfolio_category");
						$post_cats = array();
						for($h=0;$h<count($post_cat);$h++){
							$post_cats[] = $post_cat[$h]->name;
						}
						print(implode(", ", $post_cats));
						?>
					</div> <!-- /.project-meta -->
					<div style="clear:both;"></div>
					
					<!--<div style="font-size:11px;line-height:27px;max-width:1140px;min-width:450px;width:50%;">-->
					<h4 class="project-description" style="padding-bottom:10px;"><?php if (get_post_meta($post->ID, 'Description', true)) { echo get_post_meta($post->ID, 'Description', true); } ?></h4>
					
				</div> <!-- /.project-excerpt -->    
				<div class="clear"></div>
			</div> <!-- /#content -->   
			</div> <!-- /.portfolio-fs-slide -->
			<div class="slides-depr"><?php echo do_shortcode(get_the_content()); ?></div>
		</div>
	</div>
	
	<?php endwhile; ?>
	<?php else: ?>
		<p><?php _e('There are no posts to display. Try searching:', 'flowthemes'); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
			
		<div class="moving_gallery" style="position: fixed; top: 1680px; z-index: 24245;"><?php include('template-portoflio.php'); ?></div>
<script type="text/javascript">
jQuery(document).ready(function(){
try{
jQuery(".socialikonsg a[title]").tooltip({"position": "bottom center", "tipClass": "jqttooltip", "effect":"r_fadeslide"});
}catch(e){}
jQuery(".portfolio-cancelclose").click(function(){
	stopajaxloadingaclean();
});
jQuery("body").css({ 'overflow-y' : 'hidden' });
$(window).resize(function(){
	jQuery(".portfolio-loadinghr").css({'height':$(window).height()+400});
});
jQuery(".portfolio-loadinghr").css({'height':$(window).height()+400});
jQuery(".moving_gallery").css({"top":"0","position":"relative"});
jQuery('.imgscontainer').css({'margin':'0 auto 0 auto','left':'0px','right':'0px','top':(jQuery("#header").height())+'px','width':Math.min(1600,jQuery(window).width())+'px','display':'block'});
jQuery(".portfolio-arrow-left, .portfolio-arrow-right").css({"z-index":"1011111"});
});
</script>
<div class="socialikonsg">
<a href="https://twitter.com/share?url=<?php print(esc_url(get_permalink($portfoliopageidfl))); ?>&text=<?php print(urlencode($portfoliopagetitlefl)); ?>" class="twitter" style="color:<?php if($portfoliotextcolorfl=='#ffffff'){print("#ffffff");}else{print("#464646");} ?>;" target="_blank" title="Twitter">t</a>
<a href="http://www.facebook.com/sharer.php?u=<?php print(esc_url(get_permalink($portfoliopageidfl))); ?>&t=<?php print(urlencode($portfoliopagetitlefl)); ?>" class="facebook" style="color:<?php if($portfoliotextcolorfl=='#ffffff'){print("#ffffff");}else{print("#464646");} ?>;" target="_blank" title="Facebook">f</a>
<a href="https://plus.google.com/share?url=<?php print(esc_url(get_permalink($portfoliopageidfl))); ?>" style="color:<?php if($portfoliotextcolorfl=='#ffffff'){print("#ffffff");}else{print("#464646");} ?>;" class="googleplus" target="_blank" title="Google+">g</a>
</div>
<div class="portfolio-cancelclose portfolio-cancelclose-white"></div>
<div class="portfolio-loadingbar"><div class="portfolio-loadinghr"></div><div class="portfolio-indicator">0%</div></div>
<?php get_footer(); ?>