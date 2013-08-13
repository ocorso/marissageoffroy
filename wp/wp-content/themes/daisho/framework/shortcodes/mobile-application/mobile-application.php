<?php
function flow_mobile_application(){
	global $post;
	?>
	<div class="mobile_app_menu_main_wrapper">
		<div class="mobile_app_menu_main_wrapper_inner" style="padding-right: 100px; height: 100%;">
			<div class="mobile_app_menu_main_wrapper_inner2" style="width: 100%; overflow: auto; height: 100%; box-shadow: 0 0 15px rgba(0,0,0,0.25); background-color: #FFFFFF;">
				<?php 
					if(is_page_template('template-blog.php') or is_archive() or is_singular('post') or is_search() or is_home() or is_page_template('template-portoflio.php') or is_singular('portfolio')){
						$back_link_class = '';
						$blog_page = get_option('flow_blog_page');
						$blog_page_link = get_permalink($blog_page);
						if(is_page_template('template-blog.php')){ $blog_page_link = get_bloginfo('url'); }
						if(is_home() or is_page_template('template-portoflio.php')){
							$visible_or_not = '';
							$blog_page_link = 'javascript:void(null);';
						}else if(is_singular('portfolio')){
							$visible_or_not = 'class="compact_navigation_container-visible"';
							$blog_page_link = 'javascript:void(null);';
							
							if($portfolio_back_button = get_post_meta($post->ID, 'portfolio_back_button', true)){
								$page_portfolio_templatefile = get_post_meta($portfolio_back_button, '_wp_page_template', true);
								if(in_array(strtolower($page_portfolio_templatefile), array("template-portoflio.php"))){
									$blog_page_link = 'javascript:void(null);';
								}else{
									$blog_page_link = get_permalink($portfolio_back_button);
									$back_link_class = 'back-link-external';
								}
							}
						}else{
							$visible_or_not = 'class="compact_navigation_container-visible"';
						}
				?>
					<a class="header-back-to-blog-link <?php echo $back_link_class; ?>" href="<?php echo $blog_page_link; ?>">
						<div class="header-back-to-blog clearfix">
							<div class="header-back-to-blog-icon"></div>
							<div class="header-back-to-blog-icon-svg">
								<svg version="1.1" class="compact-header-arrow-back-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19.201px" height="34.2px" viewBox="0 0 19.201 34.2" enable-background="new 0 0 19.201 34.2" xml:space="preserve" style="height: 45px; width: 35px; display: block; position: absolute; top: 0; bottom: 0; margin: auto;">
									<polyline fill="none" points="17.101,2.1 2.1,17.1 17.101,32.1 "/>
								</svg>
							</div>
							<div class="header-back-to-blog-message"><?php _e('Back', 'flowthemes'); ?></div>
						</div>
					</a>
				<?php } ?>
				
				<?php get_template_part('searchform', ''); ?>
				
				<?php wp_nav_menu(array('sort_column' => 'menu_order', 'theme_location' => 'mobile_menu', 'menu_id' => 'mobile_app_menu', 'walker' => new description_walker())); ?>
				<?php do_action('flow_mobile_app_after_menu'); ?>
			</div>
		</div>
	</div>
	<?php
		if($title = get_post_meta($post->ID, 'flow_post_title', true)){
		}else if($title = get_post_meta($post->ID, 'Title', true)){
		}else{
			$title = get_the_title($post->ID);
		}
		$title = urlencode($title);
		$link = esc_url(get_permalink($post->ID));
	?>
	<div class="mobile_app_settings_wrapper">
		<div class="fma-sharing-icons clearfix">
			<a href="https://twitter.com/share?url=<?php echo $link; ?>&amp;text=<?php echo $title; ?>" target="_blank" class="fma-sharing-icons-icon-wrapper fma-sharing-icons-twitter" data-default-link="<?php echo $link; ?>" data-default-text="<?php echo $title; ?>">
				<span class="fma-sharing-icons-icon">t</span>
				<span class="fma-sharing-icons-tooltip" data-tooltip="Twitter">Twitter</span>
			</a>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo $link; ?>&amp;t=<?php echo $title; ?>" target="_blank" class="fma-sharing-icons-icon-wrapper fma-sharing-icons-facebook" data-default-link="<?php echo $link; ?>" data-default-text="<?php echo $title; ?>">
				<span class="fma-sharing-icons-icon">f</span>
				<span class="fma-sharing-icons-tooltip" data-tooltip="Facebook">Facebook</span>
			</a>
			<a href="https://plus.google.com/share?url=<?php echo $link; ?>" target="_blank" class="fma-sharing-icons-icon-wrapper fma-sharing-icons-googleplus" data-default-link="<?php echo $link; ?>" data-default-text="<?php echo $title; ?>">
				<span class="fma-sharing-icons-icon">g</span>
				<span class="fma-sharing-icons-tooltip" data-tooltip="Google+">Google+</span>
			</a>
			<?php do_action('flow_mobile_app_settings'); ?>
		</div>
	</div>
	<?php
}
add_action('wp_footer', 'flow_mobile_application');
?>