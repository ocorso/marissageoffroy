<div style="clear:both;"></div>
<footer id="footer">
	<div class="inner">
		<?php 
		/*$footer_columns_count_t = array();
		$footer_col_countcustom = get_option('footer_col_countcustom');
		if($footer_col_countcustom){
			$footer_col_countcustome = explode(",", $footer_col_countcustom);
			$colsum = 0;
			for($cce=0;$cce<count($footer_col_countcustome);$cce++){
				$footer_col_countcustomee = (int)$footer_col_countcustome[$cce];
				if($footer_col_countcustomee && is_numeric($footer_col_countcustomee)){
					$colsum += $footer_col_countcustomee;
					$footer_columns_count_t[] = $footer_col_countcustomee;
				}
			}
			if($colsum != 12){
				$footer_columns_count_t = array();
			}
		}
		if(!count($footer_columns_count_t)){
			$footer_columns_count = get_option('footer_col_count');
			if($footer_columns_count == "0"){
			}else if($footer_columns_count == "1"){
				$footer_columns_count_t = array(12);
			}else if($footer_columns_count == "2"){
				$footer_columns_count_t = array(6, 6);
			}else if($footer_columns_count == "3"){
				$footer_columns_count_t = array(4, 4, 4);
			}else if($footer_columns_count == "31"){
				$footer_columns_count_t = array(6, 3, 3);
			}else if($footer_columns_count == "32"){
				$footer_columns_count_t = array(3, 3, 6);
			}else if($footer_columns_count == "4"){
				$footer_columns_count_t = array(3, 3, 3, 3);
			}else if($footer_columns_count == "5"){
				$footer_columns_count_t = array(3, 2, 2, 2, 3);
			}else{
			}
		}*/
		?>
		<div class="container_12">
			<?php 
				/*if(is_array($footer_columns_count_t)){
					for($fi=0;$fi<count($footer_columns_count_t);$fi++){
						print("<div class=\"grid_".$footer_columns_count_t[$fi]."\"><ul>");
						if(function_exists('generated_dynamic_sidebar')){
							if(!generated_dynamic_sidebar($fi+2)){
							}
						}
						print("</ul></div>");
					}
				}*/
			?>
		</div>
		<div class="clear"></div>
</div> <!-- /.inner -->
<div class="footer-bottom clearfix">
	<div class="footer_widgets clearfix">
		<ul class="footer-bottom-widgets">
		<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar(2) ) : ?>
		<?php endif; ?>
			<li style="clear:both;"></li>
		</ul>
	</div> <!-- end of .footer_widgets -->
	<div id="footer_copyright" class="clearfix">
		<?php echo get_option('footer_copyright'); ?>
	</div> <!-- end of #footer_copyright -->
</div> <!-- end of .footer-bottom -->
</footer> <!-- end of #footer -->
	<?php if(!get_option("footer_aff_link")){ ?>
	<div class="footer-affiliate">
		<a href="<?php $footer_affiliate=get_option('footer_affiliate'); echo $footer_affiliate?$footer_affiliate:"http://priceisrightfail.com/"; ?>" rel="external"><?php _e('quit staring', 'flowthemes'); ?></a>
	</div> <?php } ?>
		<?php wp_footer(); ?>
		<?php do_action("changerplugin_panel"); ?>
		<?php echo stripslashes(get_option('analytics_code')); ?>
</body>
</html>