	<div style="clear:both;"></div>
	<footer id="footer">
		<div class="inner">
			<?php 
			$footer_columns_classes = array();
			$footer_col_countcustom = get_option('footer_col_countcustom');
			if($footer_col_countcustom){
				$footer_columns_classes = explode(",", $footer_col_countcustom);
			}
			?>
			<div class="container_12">
				<?php 
					if(is_array($footer_columns_classes)){
						for($fi=0;$fi<count($footer_columns_classes);$fi++){
							if(is_active_sidebar(apply_filters('flow_sidebar', 'flow-footer-'.($fi+1))) || (strpos($footer_columns_classes[$fi], 'demo-placeholder') !== false)){
								echo '<div class="'.$footer_columns_classes[$fi].'"><ul class="footer-widget-container">';
									if(!dynamic_sidebar(apply_filters('flow_sidebar', 'flow-footer-'.($fi+1)))){
										echo '<li></li>';
									}
								echo '</ul></div>';
							}else{
								// Display none
							}
						}
					}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</footer>
	<?php if(!get_option("footer_aff_link")){ ?>
		<div class="footer-affiliate">
			<a href="http://devatic.com/" target="_blank"><?php _e('Powered by Devatic', 'flowthemes'); ?></a>
		</div>
	<?php } ?>
	<?php wp_footer(); ?>
	<?php do_action("changerplugin_panel"); ?>
	<?php echo stripslashes(get_option('analytics_code')); ?>
</body>
</html>