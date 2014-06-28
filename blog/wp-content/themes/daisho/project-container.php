<?php if(false && is_singular('portfolio')){ ?>
	<div class="project-navigation project-navigation-visible">
		<div class="portfolio-arrowleft portfolio-arrowleft-visible">&lt;</div>
		<div class="portfolio-arrowright portfolio-arrowright-visible">&gt;</div>
	</div>
	<div class="portfolio_box portfolio_box-visible">
		<div class="content-projectc">
			<div class="project-meta">
				<div class="project-meta-col-1">
					<?php 
					$date_display = '';
					if(!($date = get_post_meta($post->ID, 'portfolio_date', true))){
						$date = '';
						$date_display = 'style="display: none;"';
					}
					$client_display = '';
					if(!($client = get_post_meta($post->ID, 'portfolio_client', true))){
						$client = '';
						$client_display = 'style="display: none;"';
					}
					$agency_display = '';
					if(!($agency = get_post_meta($post->ID, 'portfolio_agency', true))){
						$agency = '';
						$agency_display = 'style="display: none;"';
					}
					$ourrole_display = '';
					if(!($ourrole = get_post_meta($post->ID, 'portfolio_ourrole', true))){
						$ourrole = '';
						$ourrole_display = 'style="display: none;"';
					}
					?>
					<div class="project-meta-data project-date clearfix" <?php echo $date_display; ?>>
						<div class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exdate"><?php echo $date; ?></div>
					</div>
					<div class="project-meta-data project-client clearfix" <?php echo $client_display; ?>>
						<div class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exclient"><?php echo $client; ?></div>
					</div>
					<div class="project-meta-data project-agency clearfix" <?php echo $agency_display; ?>>
						<div class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exagency"><?php echo $agency; ?></div>
					</div>
				</div>
				<div class="project-meta-col-2">
					<div class="project-meta-data project-ourrole clearfix" <?php echo $ourrole_display; ?>>
						<div class="project-meta-heading"><?php _e('OUR ROLE', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exourrole"><?php echo $ourrole; ?></div>
					</div>
				</div>
			</div>
			<div class="sharing-icons">
				<a href="https://twitter.com/share?url=<?php print(esc_url(get_permalink($post->ID))); ?>&amp;text=<?php if($title = get_post_meta($post->ID, 'Title', true)){ print(urlencode($title)); }else{ print(urlencode(get_the_title($post->ID))); } ?>" target="_blank" class="sharing-icons-twitter">
					<span class="sharing-icons-icon">t</span>
					<span class="sharing-icons-tooltip" data-tooltip="Twitter"></span>
				</a>
				<a href="http://www.facebook.com/sharer.php?u=<?php print(esc_url(get_permalink($post->ID))); ?>&amp;t=<?php if($title = get_post_meta($post->ID, 'Title', true)){ print(urlencode($title)); }else{ print(urlencode(get_the_title($post->ID))); } ?>" target="_blank" class="sharing-icons-facebook">
					<span class="sharing-icons-icon">f</span>
					<span class="sharing-icons-tooltip" data-tooltip="Facebook"></span>
				</a>
				<a href="https://plus.google.com/share?url=<?php print(esc_url(get_permalink($post->ID))); ?>" target="_blank" class="sharing-icons-googleplus">
					<span class="sharing-icons-icon">g</span>
					<span class="sharing-icons-tooltip" data-tooltip="Google+"></span>
				</a>
			</div>
			<h2 class="project-title"><?php if(get_post_meta($post->ID, 'Title', true)){ echo get_post_meta($post->ID, 'Title', true); }else{ the_title(); } ?></h2>
			<div class="project-description"><?php if($description = get_post_meta($post->ID, 'Description', true)){ echo do_shortcode($description); } ?></div>
			<div class="project-slides"><?php $this_page = get_page($post->ID); echo do_shortcode($this_page->post_content); ?></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="project-coverslide project-coverslide-visible"></div>
<?php }else{ ?>
	<div class="project-navigation">
		<div class="portfolio-arrowleft portfolio-arrowleft-normal portfolio-arrowleft-visible">&lt;</div>
		<div class="portfolio-arrowright portfolio-arrowright-normal portfolio-arrowright-visible">&gt;</div>
	</div>
	
	<div class="portfolio-arrowleft portfolio-arrowleft-mobile portfolio-arrowleft-visible">&lt;</div>
	<div class="portfolio-arrowright portfolio-arrowright-mobile portfolio-arrowright-visible">&gt;</div>
	
	<div class="portfolio_box">
		<div class="content-projectc">
			<div class="project-meta">
				<div class="project-meta-col-1">
					<div class="project-meta-data project-date clearfix">
						<div class="project-meta-heading"><?php _e('DATE', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exdate"></div>
					</div>
					<div class="project-meta-data project-client clearfix">
						<div class="project-meta-heading"><?php _e('CLIENT', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exclient"></div>
					</div>
					<div class="project-meta-data project-agency clearfix">
						<div class="project-meta-heading"><?php _e('AGENCY', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exagency"></div>
					</div>
				</div>
				<div class="project-meta-col-2">
					<div class="project-meta-data project-ourrole clearfix">
						<div class="project-meta-heading"><?php _e('OUR ROLE', 'flowthemes'); ?></div>
						<div class="project-meta-description project-exourrole"></div>
					</div>
				</div>
			</div>
			<div class="sharing-icons">
				<a href="https://twitter.com/share?url=<?php print(esc_url(get_home_url())); ?>&amp;text=<?php print(urlencode(get_bloginfo('name'))); ?>" target="_blank" class="sharing-icons-twitter">
					<span class="sharing-icons-icon">t</span>
					<span class="sharing-icons-tooltip" data-tooltip="Twitter"></span>
				</a>
				<a href="http://www.facebook.com/sharer.php?u=<?php print(esc_url(get_home_url())); ?>&amp;t=<?php print(urlencode(get_bloginfo('name'))); ?>" target="_blank" class="sharing-icons-facebook">
					<span class="sharing-icons-icon">f</span>
					<span class="sharing-icons-tooltip" data-tooltip="Facebook"></span>
				</a>
				<a href="https://plus.google.com/share?url=<?php print(esc_url(get_home_url())); ?>" target="_blank" class="sharing-icons-googleplus">
					<span class="sharing-icons-icon">g</span>
					<span class="sharing-icons-tooltip" data-tooltip="Google+"></span>
				</a>
				<!-- <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Ftest.com&media=http%3A%2F%2Ftesst.com&description=test2" class="pin-it-button" count-layout="none">
					<span class="sharing-icons-icon" style="font-family: WebSymbolsLigaRegular;">&#237;</span>
					<span class="sharing-icons-tooltip" data-tooltip="Pin It"></span>
				</a> -->
				<!-- <script>(function(d){var e=d.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);d.body.appendChild(e)})(document);</script> -->
			</div>
			<h2 class="project-title"></h2>
			<div class="project-description"></div>
			<div class="project-slides"></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="project-coverslide <?php if(is_singular('portfolio')){ echo 'project-coverslide-visible'; } ?>"></div>
<?php } ?>