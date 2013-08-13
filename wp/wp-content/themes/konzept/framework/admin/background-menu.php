<?php 
	add_action( 'admin_init', 'backgroundmenuregs' );
	add_action( 'wp_head', 'add_bg_changerstyle' );
	function backgroundmenuregs(){
		wp_enqueue_script('jquery');
		wp_register_style( 'FlowTypographyMainStylesheet', WP_PLUGIN_URL . '/typography/js/colorpicker/css/colorpicker.css' );
		wp_register_style( 'FlowTypographyLayoutStylesheet', WP_PLUGIN_URL . '/typography/js/colorpicker/css/layout.css' );
		wp_register_script('jquery_colorpicker_script', WP_PLUGIN_URL . '/typography/js/colorpicker/js/colorpicker.js', array('jquery'), '1.0' );
		wp_enqueue_style( 'FlowTypographyMainStylesheet' );
		wp_enqueue_style( 'FlowTypographyLayoutStylesheet' );
		wp_enqueue_script('jquery_colorpicker_script');
	}
	function add_bg_menu(){
		//must check that the user has the required capability 
		if (!current_user_can('manage_options'))
		{
		  wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		
		echo '<div class="wrap">';
		echo "<h2>" . __( 'Styling', 'menu-test' ) . "</h2>";
	
		if($_POST['bg_submit_h'] && $_POST['bg_submit_h'] == "Y"){
			$bgrepeat = array("repeat"=>"repeat","repeatx"=>"repeat-x","repeaty"=>"repeat-y","norepeat"=>"no-repeat");
			update_option("bgchanger_color", $_POST['bc']);
			update_option("bgchanger_imgsrc", $_POST['bi']);
			if($_POST['bpx'] == "left" || $_POST['bpx'] == "center" || $_POST['bpx'] == "right"){
				update_option("bgchanger_posx", $_POST['bpx']);
			}
			if($_POST['bpy'] == "top" || $_POST['bpy'] == "center" || $_POST['bpy'] == "bottom"){
				update_option("bgchanger_posy", $_POST['bpy']);
			}
			if($_POST['ba'] == "fixed" || $_POST['ba'] == "scroll"){
				update_option("bgchanger_attach", $_POST['ba']);
			}
			if(array_key_exists($_POST['br'], $bgrepeat)){
				update_option("bgchanger_repeat", $bgrepeat[$_POST['br']]);
			}
			?>
			<div class="updated"><p><strong><?php  _e('settings saved.', 'menu-test' ); ?></strong></p></div>
			<?php 
		}
		
		$bgcval_bc = get_option("bgchanger_color");
		$bgcval_bi = get_option("bgchanger_imgsrc");
		$bgcval_bpx = get_option("bgchanger_posx");
		$bgcval_bpy = get_option("bgchanger_posy");
		$bgcval_ba = get_option("bgchanger_attach");
		$bgcval_br = get_option("bgchanger_repeat");
		?>
		
		<script type="text/javascript">
jQuery(document).ready(function(){jQuery(".attcolorpicker").each(function(){jQuery(this).ColorPicker({onShow:function(cp){jQuery(cp).fadeIn(500);return false;},onHide:function(cp){jQuery(cp).fadeOut(500);return false;},onChange:function(hsb, hex, rgb){jQuery(this).parent().find('.attcolorpicker').val('#'+hex);jQuery(this).parent().find('.colorSelector div').css('backgroundColor', '#'+hex);jQuery(this).parent().find('.colorSelector').ColorPickerSetColor(hex);}});jQuery(this).parent().find('.colorSelector').ColorPicker({onShow:function(cp){jQuery(cp).fadeIn(500);return false;},onHide:function(cp){jQuery(cp).fadeOut(500);return false;},onChange:function(hsb, hex, rgb){jQuery(this).parent().find('.attcolorpicker').val('#'+hex);jQuery(this).parent().find('.colorSelector div').css('backgroundColor', '#'+hex);jQuery(this).parent().find('.attcolorpicker').ColorPickerSetColor(hex);}});});});</script>
		<form method="post" action="">
		<table class="form-table">
		<tr><th>Background color</th><td>
		<input type="text" class="attcolorpicker" name="bc" value="<?php  if($bgcval_bc) print($bgcval_bc); ?>"> <div class="colorSelector"><div<?php  if($bgcval_bc) print(" style=\"background-color:".$bgcval_bc.";\""); ?>></div></div>
		</td></tr>
		<tr><th>Background image</th><td><input type="text" name="bi" value="<?php  if($bgcval_bi) print($bgcval_bi); ?>"><span href="#" title="" class="briskuploader button">Upload</span><br/><div class="briskuploader_preview"></div></td></tr>
<!-- 		<tr><th>Background position</th><td><select name="bpx"><option value="left"<?php  if($bgcval_bpx=="left") print(" selected=\"selected\""); ?>>left</option><option value="center"<?php  if($bgcval_bpx=="center") print(" selected=\"selected\""); ?>>center</option><option value="right"<?php  if($bgcval_bpx=="right") print(" selected=\"selected\""); ?>>right</option></select><select name="bpy"><option value="top"<?php  if($bgcval_bpy=="top") print(" selected=\"selected\""); ?>>top</option><option value="center"<?php  if($bgcval_bpy=="center") print(" selected=\"selected\""); ?>>center</option><option value="bottom"<?php  if($bgcval_bpy=="bottom") print(" selected=\"selected\""); ?>>bottom</option></select></td></tr>
		<tr><th>Background attachment</th><td><select name="ba"><option value="scroll"<?php  if($bgcval_ba=="scroll") print(" selected=\"selected\""); ?>>Scroll</option><option value="fixed"<?php  if($bgcval_ba=="fixed") print(" selected=\"selected\""); ?>>Fixed</option></select></td></tr>
		<tr><th>Background repeat</th><td><select name="br"><option value="repeat"<?php  if($bgcval_br=="repeat") print(" selected=\"selected\""); ?>>repeat</option><option value="repeatx"<?php  if($bgcval_br=="repeat-x") print(" selected=\"selected\""); ?>>repeat-x</option><option value="repeaty"<?php  if($bgcval_br=="repeat-y") print(" selected=\"selected\""); ?>>repeat-y</option><option value="norepeat"<?php  if($bgcval_br=="no-repeat") print(" selected=\"selected\""); ?>>no-repeat</option></td></tr> -->
		</table>
		<p class="submit">
		<input type="hidden" name="bg_submit_h" value="Y">
		<input type="submit" name="Submit" class="button-primary" value="<?php  esc_attr_e('Save Changes') ?>" />
		</p>
		</form>
		
		</div>
		
		<?php 
	}
	
	function add_bg_changerstyle(){
		$bgcval_bc = get_option("bgchanger_color");
		$bgcval_bi = get_option("bgchanger_imgsrc");
		if($bgcval_bc || $bgcval_bi){
			print("<style type=\"text/css\"> body{ ");
			if($bgcval_bc){
				print("background-color:".$bgcval_bc.";");
			}
			if($bgcval_bi){
				if($bgcval_bi == "none"){
					print("background-image:none;");
				}else{
					print("background-image:url(".$bgcval_bi.");");
					$bgcval_bpx = get_option("bgchanger_posx");
					$bgcval_bpy = get_option("bgchanger_posy");
					$bgcval_ba = get_option("bgchanger_attach");
					$bgcval_br = get_option("bgchanger_repeat");
					if($bgcval_bpx == "left" || $bgcval_bpx == "center" || $bgcval_bpx == "right"){
						if($bgcval_bpy == "top" || $bgcval_bpy == "center" || $bgcval_bpy == "bottom"){
							print("background-position:".$bgcval_bpx." ".$bgcval_bpy.";");
						}
					}
					if($bgcval_ba == "fixed" || $bgcval_ba == "scroll"){
						print("background-attachment:".$bgcval_ba.";");
					}
					if($bgcval_br == "repeat" || $bgcval_br == "repeat-x" || $bgcval_br == "repeat-y" || $bgcval_br == "no-repeat"){
						print("background-repeat:".$bgcval_br.";");
					}
				}
			}
			print(" } </style>");
		}
	}
	
?>