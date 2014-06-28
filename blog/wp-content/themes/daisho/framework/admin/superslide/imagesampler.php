<?php
/* Include scripts */
function flow_image_sampler_scripts(){
	wp_register_script( 'flow_parse_url', get_template_directory_uri() . '/framework/admin/superslide/scripts/parseurl.js', false, '1.0', true );
	wp_enqueue_script( 'flow_parse_url' );
	
	//Both the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action('admin_enqueue_scripts', 'flow_image_sampler_scripts');

/* Check if image URL can be accessed via AJAX. Used in Image ColorPicker Module. */
function flow_check_image_callback(){
	if(!check_ajax_referer('flow-check-image-nonce', 'flow-check-image-security', false)){
		die('{"jsonrpc" : "2.0", "error" : {"code": 112, "message": "WordPress nonce verification failed. Please login to save this page."}, "id" : "id"}');
	}
	if(!is_user_logged_in()){
		die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "You need to be logged in to send messages."}, "id" : "id"}');
	}
	if(!isset($_POST['check-image-content'])){
		die('{"jsonrpc" : "2.0", "error" : null, "id" : "id", "result" : "not valid"}');
	}
	
	$image_src = $_POST['check-image-content'];
	$imageArray = @getimagesize($image_src);
	if(is_array($imageArray)){
		die('{"jsonrpc" : "2.0", "error" : null, "id" : "id", "result" : "valid"}');
	}else{
		die('{"jsonrpc" : "2.0", "error" : null, "id" : "id", "result" : "not valid"}');
	}
}
add_action('wp_ajax_flow_check_image', 'flow_check_image_callback');

function get_meta_imagesampler( $args = array(), $value = false ){ 
	global $nonce_name;
	extract($args); ?>
	<th style="width:20%;">
		<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
	</th>
	<td>
		<div class="imagesampler-uploader colorpickerholder2flow" style="position:relative;">
			<div class="flowuploader">
				<input class="flowuploader_media_url" type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" />
				<span class="flowuploader_upload_button button">Upload</span>
				<!-- <div class="flowuploader_media_preview_image"></div> -->
			</div>
			
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( $nonce_name ); ?>" />

			<div class="ims_canvas_wrapper" style="width: 100%;">
				<div class="ims_column1" style="width: auto;">
					<canvas id="panel" width="390" height="292"></canvas>
				</div>
				<div class="ims_column2">
					<div style="margin-top: -18px;">
						<input type="text" id="hexVal" class="attcolorpicker" name="<?php echo 'thumbnail_hover_color'; ?>" value="" style="display:none;" />
						<div class="colorSelector pickerlarge" style="top: 14px;">
							<div id="preview" style=""></div>
						</div>
					</div>
					<p style="width:94px;padding-top:7px;margin-left: 7px;line-height:16px;">(Thumbnail highlight color on front page)</p>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div> 
		<style type="text/css">
			.ims_canvas_wrapper { color:#000; margin: 10px auto 20px; position:relative; width:730px; }
				.ims_column1 { float:left; width: 500px; padding-right:20px; }
					#panel { cursor: crosshair; display: block; }
				.ims_column2 { float:left; width: 190px; }
					.ims_column2 > div { margin-bottom:5px; }
					.ims_column2 input[type=text] { width:110px; }
			#swImage { border:1px #000 solid; cursor:pointer; height:25px; line-height:25px; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
			#swImage:hover { margin-left:2px; }
			#preview { border:1px #000 solid; height:80px; width:80px; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
			.imagesampler-uploader .flowuploader_media_preview_image img { display: none; }
			.briskuploader_remove { z-index: 8; }
			.colorpicker input { background-color: transparent; border-color: transparent; }
			.empty-canvas { width: 390px; height: 292px; border: 3px dashed #eee; display: table; }
			.empty-canvas > p { display: table-cell; font-size: 24px!important; line-height: 110%; text-align: center; vertical-align: middle; padding: 40px; }
		</style>
	<?php
		$image_path = esc_html( $value );
		
		$parsed_url = parse_url( $image_path );
		$parsed_site_url = parse_url(get_site_url());
		if(is_array($parsed_site_url)){
			$site_host = $parsed_site_url['host'];
			$site_protocol = $parsed_site_url['scheme'];
		}
		if(is_array($parsed_url) && is_array($parsed_site_url)){
		
			$host = $parsed_url['host'];
			$protocol = $parsed_url['scheme'];
			
			if(($host == $site_host) && ($protocol == $site_protocol)){

			}else{
				if(strlen(end(explode('.', $parsed_url['path']))) >= 1 && strlen(end(explode('.', $parsed_url['path']))) <= 5){
					$image_path = get_bloginfo('template_directory') . '/framework/admin/superslide/flow_get_image.php?image='.esc_html($value);
				}
			}
		}
	?>
<script type="text/javascript">
var site_host = '<?php echo $site_host; ?>';
var site_protocol = '<?php echo $site_protocol; ?>';
var site_image_getter = '<?php echo get_bloginfo('template_directory') . '/framework/admin/superslide/flow_get_image.php?image='; ?>';
<?php $ajax_nonce = wp_create_nonce("flow-check-image-nonce"); ?>
function urlExists(img_src){
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var http = jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: {
				"action": "flow_check_image",
				"flow-check-image-security": '<?php echo $ajax_nonce; ?>',
				//"check-image-content": img_src.attr('src')
				"check-image-content": img_src
			},
		global: false,
		success: function(data, textStatus, jqXHR){
			var cr = JSON.parse(data);
			if(cr.result == 'valid'){
				//jQuery('<img />').attr('src', img_src.attr('src')).one('load', function(){
				jQuery('<img />').attr('src', img_src).one('load', function(){
					jQuery('.empty-canvas').remove();
					jQuery('.ims_column1').append('<canvas id="panel" width="390" height="292"></canvas>');
					init_image_sampler_flow();
				});
				return true;
			}
			if(cr.result == 'not valid'){
				jQuery('.empty-canvas').html('<p>Image will appear here if its URL above is valid.</p>');
				return true;
			}
			return false;
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.status + ' ' + textStatus + ': ' + errorThrown);
			return false;
		}
	});
	return;
}
jQuery(document).ready(function() {
	var currentcolor = jQuery('#thumbnail_hover_color').val();
	jQuery('#hexVal').val(currentcolor);
	jQuery('#hexVal').ColorPickerSetColor(currentcolor);
	jQuery('.colorSelector').ColorPickerSetColor(currentcolor);
	jQuery('.colorSelector div').css({ 'background-color' : currentcolor });
	jQuery('.colorpicker').click(function(){ jQuery('#hexVal').trigger('change'); });
	jQuery('.colorpicker').mousemove(function(){ jQuery('#hexVal').trigger('change'); });
	jQuery('#hexVal').on('change', function() {
	var hexvarval = jQuery('#hexVal').val();
		jQuery('#thumbnail_hover_color').val(hexvarval);
	});

	if(jQuery('#<?php echo $name; ?>').parent().find('.flowuploader_media_preview_image').find('img').attr("src") != ''){
		init_image_sampler_flow('<?php echo $image_path; ?>');
	}
	jQuery('#<?php echo $name; ?>').on('change', function(){
		jQuery('canvas').remove();
		jQuery('.empty-canvas').remove();
		if(jQuery(this).val() != ''){
			jQuery('.ims_column1').append('<div class="empty-canvas"><p>Loading...</p></div>');
			var img_src = jQuery('#<?php echo $name; ?>').val();
			urlExists(img_src);
		}else{
			jQuery('.ims_column1').append('<div class="empty-canvas"><p>Image will appear here if its URL above is present.</p></div>');
		}
	});
});

/* Copyright (c) 2011 Andrey Prikaznov (aramisgc@gmail.com || http://www.script-tutorials.com/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Image sampler only (uploader + colorpicker and integration scripts are licensed differently).
 *
 * Version: 1.0
 *
 */
 
function init_image_sampler_flow(img_src){
	var canvas;
	var ctx;
	
	if(img_src == '' || typeof(img_src) === 'undefined'){ // perhaps replace undefined with img_src == false and add "false" as an argument everywhere - seems more solid
		var img_src = jQuery('#<?php echo $name; ?>').parent().find('.flowuploader_media_preview_image').find('img').attr("src");
		var img_src = jQuery('#<?php echo $name; ?>').val();
		var myURL = parseURL(img_src);
		if(myURL.host == site_host && myURL.protocol == site_protocol){
			// ok...
		}else{
			img_src = site_image_getter + img_src;
		}
	}
	var images = [ // predefined array of used images
		img_src
	];
	var iActiveImage = 0;

	jQuery(function(){
			jQuery('#panel').off();
		// drawing active image
		var image = new Image();
		image.onload = function (){
			var image_height = image.height;
			var image_width = image.width;
			var image_ratio = image_width/image_height;
			if(image_width < image_height){
				if(image_height <= 292){ var image_height2 = image_height; var image_width2 = image_width; }else{ var image_height2 = 292; var image_width2 = image_height*image_ratio; }
			}else{
				if(image_width <= 390){ var image_height2 = image_height; var image_width2 = image_width; }else{ var image_width2 = 390; var image_height2 = (image_width2*image_height)/image_width; }
			}
			jQuery('#<?php echo $name; ?>').parent().find('.flowuploader_media_preview_image').find('img').css({'display':'none'});
			//jQuery('#<?php echo $name; ?>').parent().find('.flowuploader_media_preview_image').css({'width':'390px'});
			//ctx.drawImage(image, 0, 0, image.width, image.height); // draw the image on the canvas
			ctx.drawImage(image, 0, 0, image_width2, image_height2); // draw the image on the canvas
		}
		image.src = images[iActiveImage];

		// creating canvas object
		canvas = document.getElementById('panel');
		ctx = canvas.getContext('2d');
		
		// Delete handler
		jQuery('#<?php echo $name; ?>').parent().find('.briskuploader_remove').on('click', function(){
			canvas.width = canvas.width;
			//jQuery('#panel').remove();
		});

		jQuery('#panel').live("mousemove", function(e) { // mouse move handler
			var canvasOffset = jQuery(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);

			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;

			var pixelColor = "rgba("+pixel[0]+", "+pixel[1]+", "+pixel[2]+", "+pixel[3]+")";
			jQuery('#preview').css('backgroundColor', pixelColor);
		});
		jQuery('#panel').mouseleave(function(){
			var good_color = jQuery('.colorpicker_hex input').val();
			jQuery('#preview').css('backgroundColor', '#'+good_color);
		});

		jQuery('#panel').live("click",function(e) { // mouse click handler
			var canvasOffset = jQuery(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);

			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;

			var dColor = pixel[2] + 256 * pixel[1] + 65536 * pixel[0];
			var convstr = dColor.toString(16);
			while (convstr.length < 6) {
				convstr = '0' + convstr;
			}
			jQuery('#hexVal').val( '#' + convstr );
			jQuery('#thumbnail_hover_color').val( '#' + convstr );
			jQuery('.colorSelector div').css({ 'background-color' : '#' + convstr });
			jQuery('#hexVal').ColorPickerSetColor('#' + convstr);
			jQuery('.colorSelector').ColorPickerSetColor('#' + convstr);
		}); 

		jQuery('#swImage').live("click",function(e) { // switching images
			iActiveImage++;
			if (iActiveImage >= 10) iActiveImage = 0;
			image.src = images[iActiveImage];
		});
	});
}
	</script>
	
	 <input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( $nonce_name ); ?>" />
	 <p><?php echo $desc; ?></p>
	</td>
	</tr>
<?php } ?>