<?php
function flow_superslide_scripts(){
	wp_register_script( 'flow_parse_url', get_template_directory_uri() . '/framework/admin/superslide/scripts/parseurl.js', false, '1.0', true );
	wp_enqueue_script( 'flow_parse_url' );
	wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'flow_superslide_scripts');

function get_meta_slidemanager( $args = array(), $value = false ) {
	extract( $args );
	global $nonce_name;

	function superslide_forms(){
		$form_boxes['image'] = array(
			'form_id' => 'flow_image_form',
			'form_prefix' => 'flow_image',
			'form_title' => 'Add Image Slide',
			'thumbnail_title' => 'Image',
			'icon_class' => '.image-icon',
			'icon' => '',
			'fields' => array(
				'image' => array( 'name' => 'image', 'title' => __('Slide Image', 'flowthemes'), 'desc' => 'Image URL.', 'type' => 'upload' ),
				'image_alt' => array( 'name' => 'image_alt', 'title' => __('Image Alternative Text', 'flowthemes'), 'desc' => 'Alt tag for this image.', 'type' => 'input' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Slide Description (optional)', 'flowthemes'), 'desc' => __('Description will be displayed in the bottom left corner of each image. Keep it short. Use &lt;h4&gt; HTML tag to define heading.<br>Example:<br><b>&lt;h4&gt;Slide Title&lt;/h4&gt;<br>&lt;p&gt;Project description.&lt;/p&gt;', 'flowthemes'), 'type' => 'textarea' )
			)
		);
		$form_boxes['video'] = array(
			'form_id' => 'flow_video_form',
			'form_prefix' => 'flow_video',
			'form_title' => 'Add Self-hosted Video Slide',
			'thumbnail_title' => 'Video Slide',
			'icon_class' => '.video-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/video-preview.jpg',
			'fields' => array(
				'video_mp4' => array( 'name' => 'video_mp4', 'title' => __('Slide video (MP4):', 'flowthemes'), 'desc' => 'A link to the MP4 format of your video.', 'type' => 'upload' ),
				'video_ogg' => array( 'name' => 'video_ogg', 'title' => __('Slide video (OGG):', 'flowthemes'), 'desc' => 'A link to the OGG format of your video.', 'type' => 'upload' ),
				'video_webm' => array( 'name' => 'video_webm', 'title' => __('Slide video (WEBM):', 'flowthemes'), 'desc' => 'A link to the WEBM format of your video.', 'type' => 'upload' ),
				'video_poster' => array( 'name' => 'video_poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'A link to the PNG, JPG, GIF or SVG image that will be displayed before video is played. Aspect ratio must match the one the video has - it is usually 16:9 or 4:3.', 'type' => 'upload' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Description', 'flowthemes'), 'desc' => __('Optional video description that will be displayed below the video. Keep it short. Use &lt;h4&gt; HTML tag to define heading.<br>Example:<br><b>&lt;h4&gt;Slide Title&lt;/h4&gt;<br>&lt;p&gt;Project description.&lt;/p&gt;', 'flowthemes'), 'type' => 'textarea' )
			)
		);
		$form_boxes['vimeo'] = array(
			'form_id' => 'flow_vimeo_form',
			'form_prefix' => 'flow_vimeo',
			'form_title' => 'Add Vimeo Video Slide',
			'thumbnail_title' => 'Vimeo Slide',
			'icon_class' => '.vimeo-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/vimeo-preview.jpg',
			'fields' => array(
				'video_vimeo' => array( 'name' => 'video_vimeo', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Vimeo <b>video ID</b> or a link to the video. Shortlinks and links without ID in it will not work.', 'type' => 'input' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Description', 'flowthemes'), 'desc' => __('Optional video description that will be displayed below the video. Keep it short. Use &lt;h4&gt; HTML tag to define heading.<br>Example:<br><b>&lt;h4&gt;Slide Title&lt;/h4&gt;<br>&lt;p&gt;Project description.&lt;/p&gt;', 'flowthemes'), 'type' => 'textarea' )
			)
		);
		$form_boxes['youtube'] = array(
			'form_id' => 'flow_youtube_form',
			'form_prefix' => 'flow_youtube',
			'form_title' => 'Add YouTube Video Slide',
			'thumbnail_title' => 'YouTube Slide',
			'icon_class' => '.youtube-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/youtube-preview.jpg',
			'fields' => array(
				'video_youtube' => array( 'name' => 'video_youtube', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'YouTube <b>video ID</b> or a link to the video. Shortlinks and links without ID in it will not work.', 'type' => 'input' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Description', 'flowthemes'), 'desc' => __('Optional video description that will be displayed below the video. Keep it short. Use &lt;h4&gt; HTML tag to define heading.<br>Example:<br><b>&lt;h4&gt;Slide Title&lt;/h4&gt;<br>&lt;p&gt;Project description.&lt;/p&gt;', 'flowthemes'), 'type' => 'textarea' )
			)
		);
		$form_boxes['custom'] = array(
			'form_id' => 'flow_custom_form',
			'form_prefix' => 'flow_custom',
			'form_title' => 'Add Custom Code',
			'thumbnail_title' => 'Custom Code',
			'icon_class' => '.custom-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/custom-preview.jpg',
			'fields' => array(
				'custom' => array( 'name' => 'custom', 'title' => __('Custom Code', 'flowthemes'), 'desc' => 'Custom Code accepts any HTML. You can use it to create <b>SoundCloud</b> iframe, <b>Blip.tv</b> video player and other elements. See documentation for examples.', 'type' => 'textarea' ),
				'css_class' => array( 'name' => 'css_class', 'title' => __('CSS class(es)', 'flowthemes'), 'desc' => 'Your custom code will be placed inside a <code>DIV</code>. You can give that <code>DIV</code> a class.', 'type' => 'input' )
			)
		);
		
		$forms = '';
			foreach($form_boxes as $form_box_key => $form_box_value){
				$forms .= '<div id="'.$form_box_value['form_id'].'" class="ss_form_wrapper" style="display: none;"><table class="form-table ss-forms-table '.$form_box_value['form_id'].'" data-form-type="'.$form_box_key.'" data-form-thumbnail="'.$form_box_value['icon'].'">';
					$current_fields = '';
					foreach($form_box_value['fields'] as $field_id => $field_data){
					
						// Create array of available form fields for JS use
						/* if($form_box_value['type'] != false){
							$all_fields[$form_box_value['type']][$field_id] = $field_data['name'];
						} */
						// End array of available form fields for JS use
					
						$current_field = '';
						if($field_data['type'] == 'input'){
						
							$current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<input class="ss_form_field ss_form_field_text_input" type="text" name="'.$field_data['name'].'" value="" />';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>';

						}else if($field_data['type'] == 'upload'){
						
							$current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<div class="flowuploader">';
										$current_field .= '<input class="flowuploader_media_url ss_form_field ss_form_field_upload_input" type="text" name="'.$field_data['name'].'" value="" />';
										$current_field .= '<span class="flowuploader_upload_button button">Upload</span>';
										$current_field .= '<div class="flowuploader_media_preview_image"></div>';
									$current_field .= '</div>';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>';

						}else if($field_data['type'] == 'upload2'){ // Old Uploader
						
							/* $current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td><input type="text" name="'.$field_data['name'].'" id="'.$field_id.'" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />';
								$current_field .= '<small>'.$field_data['desc'].'</small></td>';
							$current_field .= '</tr>'; */

						}else if($field_data['type'] == 'textarea'){
						
							$current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<textarea class="ss_form_field ss_form_field_textarea" cols="50" rows="5" name="'.$field_data['name'].'" value=""></textarea>';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>';

						}else if($field_data['type'] == 'checkbox'){
						
							$current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<input class="ss_form_field" type="checkbox" name="'.$field_data['name'].'" />';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>';
						
						}else if($field_data['type'] == 'colorpicker2'){ // Old colorpicker
						
							/* $current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<input name="'.$field_data['name'].'" class="attcolorpicker" type="text" id="'.$field_id.'" /><div class="colorSelector"><div style="background-color:#000000;"></div></div>';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>'; */
							
						}else if($field_data['type'] == 'colorpicker'){
						
							$current_field .= '<tr>';
								$current_field .= '<th><label for="'.$field_data['name'].'">'.$field_data['title'].'</label></th>';
								$current_field .= '<td>';
									$current_field .= '<input name="'.$field_data['name'].'" class="flow-wp-color-picker ss_form_field" type="text" />';
									$current_field .= '<p>'.$field_data['desc'].'</p>';
								$current_field .= '</td>';
							$current_field .= '</tr>';
							
						}
						$current_fields .= $current_field;
					}
					$forms .= $current_fields;
					
					$forms .= '</table>';
					$forms .= '<div class="ss-form-submit-wrapper">';
						$forms .= '<input type="button" id="'.$form_box_value['form_id'].'_submit" class="button-primary" value="'.esc_attr__('Save Changes', 'flowthemes').'" name="'.$form_box_value['form_id'].'_submit" />';
					$forms .= '</div>';
				$forms .= '</div>';
				?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							if(typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function'){
								jQuery('#<?php echo $form_box_value['form_id']; ?>').find(".flow-wp-color-picker").wpColorPicker();
							}
							jQuery("<?php echo $form_box_value['icon_class']; ?>").click(function(){
								clearForms();
								var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
								W = W - 80;
								H = H - 104;
								tb_show('<?php echo $form_box_value['form_title']; ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=<?php echo $form_box_value['form_id']; ?>');
								
								jQuery("<?php echo '#'.$form_box_value['form_id'].'_submit'; ?>").unbind('click');
								jQuery("<?php echo '#'.$form_box_value['form_id'].'_submit'; ?>").on('click', function(){
									//addSlideByIcon(<?php echo json_encode((object) $form_box_value); ?>);
									addSlideByIcon("<?php echo $form_box_value['icon_class']; ?>");
								});
							});
						});
					</script>
				<?php
			}
		echo $forms;
		?>
		<script>
			var form_boxes = <?php echo json_encode((object) $form_boxes); ?>;
			//var all_fields = <?php //echo json_encode((object) $all_fields); ?>;
		</script>
		<?php
	}
	add_action('admin_footer', 'superslide_forms'); ?>
	
	<tr>
		<td colspan="2">
			<div class="superslide-wrapper">
				<div class="demo-box">
					<div class="ready_images_heading">
						<div id="status-message"><?php _e('Slide management', 'flowthemes'); ?></div>
						<div class="separator-icon"></div>
						<div class="image-icon" data-form-type="image"><a id="upload-image" class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Add Image Slide', 'flowthemes'); ?>"></a></div>
						<div class="video-icon" data-form-type="video"><a id="upload-video" class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Add Self-hosted Video', 'flowthemes'); ?>"></a></div>
						<div class="vimeo-icon" data-form-type="vimeo"><a class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Add Vimeo Video', 'flowthemes'); ?>"></a></div>
						<div class="youtube-icon" data-form-type="youtube"><a class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Add YouTube Video', 'flowthemes'); ?>"></a></div>
						<div class="custom-icon" data-form-type="custom"><a class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Add Custom Code', 'flowthemes'); ?>"></a></div>
						<div class="separator-icon"></div>
						<div class="shuffle-icon" title="<?php _e('Shuffle Slides', 'flowthemes'); ?>"><a class="ss-icon-link" href="javascript:void(null);" title="<?php _e('Shuffle Slides', 'flowthemes'); ?>"></a></div>
						<div class="media-library-icon"><a class="icon-medialibrary" href="javascript:void(null);" title="<?php _e('Media Library', 'flowthemes'); ?>"><?php _e('Media Library', 'flowthemes'); ?></a></div>
					</div>
				</div>
				<div id="ready_images">
					<?php 
					$slides = get_post_meta(get_the_ID(), 'slides', true);
					//var_dump($slides);
					if(is_object(json_decode($slides))){ 
						$objectForEverything = json_decode($slides);
						?>
						
						<script>
							jQuery(document).ready(function(){
								createTilesFromObject();
							});
						</script>
					<?php }else{
					
						$content = get_post(get_the_ID())->post_content;
						$objectForEverything = array();
						$i = 0;
						
						//$pattern = get_shortcode_regex(); // this one is disabled only because shortcodes aren't included in the admin panel
						$pattern = '\[(\[?)(embed|wp_caption|caption|gallery|slide)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
						if ( preg_match_all( '/'. $pattern .'/s', $content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'slide', $matches[2] ) ){
							/* Array
								[0] => Array
										[0] => [slide video_youtube="http://www.youtube.com/watch?v=xmgQR2oZ9qk" video_poster="http://themes.devatic.com/konzept/wp-content/uploads/2012/05/shapesinmotion.jpg" slide_desc="<h4>test</h4>" text_color="#ffffff" slide_noresize="false"]
										[1] => [slide video_youtube="xmgQR2oZ9qk" video_poster="" slide_desc="" text_color="#ffffff" slide_noresize="false"]
								[2] => Array
										[0] => slide
										[1] => slide
								[3] => Array
										[0] =>  video_youtube="http://www.youtube.com/watch?v=xmgQR2oZ9qk" video_poster="http://themes.devatic.com/konzept/wp-content/uploads/2012/05/shapesinmotion.jpg" slide_desc="<h4>test</h4>" text_color="#ffffff" slide_noresize="false"
										[1] =>  video_youtube="xmgQR2oZ9qk" video_poster="" slide_desc="" text_color="#ffffff" slide_noresize="false"
							*/
							foreach($matches[3] as $piece_s){
								$objectForEverything[] = shortcode_parse_atts($piece_s);
					
								$slide_number = 'data-number="'.$i.'"';
								$i++;
								
								$test = shortcode_parse_atts($piece_s);
								
								if(is_array($test) && isset($test['image'])){
									$filename = substr($test['image'],strrpos($test['image'], "/")+1);
									$filename = substr_replace($filename , '', strrpos($filename , '.'));
									if (strlen($filename) > 15) {
										$filename = substr($filename, 0, 15) . '...';
									}
									$image_info = @getimagesize($test['image']);
									if($image_info[0]==false){
										preg_match('#http://[^/]+(.+)#', $test['image'], $m);
										$image_info = @getimagesize($_SERVER["DOCUMENT_ROOT"].$m[1]);
									}
									if($image_info['mime'] == "image/jpeg"){ 
										$image_info['mime'] = "&nbsp;JPG"; 
									}else if($image_info['mime'] == "image/png"){ 
										$image_info['mime'] = "&nbsp;PNG"; 
									}else if($image_info['mime'] == "image/gif"){ 
										$image_info['mime'] = "&nbsp;GIF"; 
									}
									$self_hosted = $test['image'];
									$media_size = '<div class="ready_image_size">'.$image_info[0] . 'x' . $image_info[1] . 'px</div><div class="ready_image_size">' . $image_info['mime'] . '</div>';
									$slide_type = 'data-type="image"';
								}elseif(is_array($test) && (isset($test['video_mp4']) || isset($test['video_ogg']) || isset($test['video_webm']))){
									$filename = substr($test['video_mp4'],strrpos($test['video_mp4'], "/")+1);
									$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/video-preview.jpg";
									$media_size = '<div class="ready_image_size">'.__('Internal', 'flowthemes').'</div>';
									$slide_type = 'data-type="video"';
								}elseif(is_array($test) && isset($test['video_vimeo'])){
									$filename = 'Vimeo Slide';
									$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/vimeo-preview.jpg";
									$media_size = '<div class="ready_image_size">'.__('External', 'flowthemes').'</div>';
									$slide_type = 'data-type="vimeo"';
								}elseif(is_array($test) && isset($test['video_youtube'])){
									$filename = 'YouTube Slide';
									$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/youtube-preview.jpg";
									$media_size = '<div class="ready_image_size">'.__('External', 'flowthemes').'</div>';
									$slide_type = 'data-type="youtube"';
								}elseif(is_array($test) && $test['custom']){
									$filename = 'Custom Code';
									$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/custom-preview.jpg";
									$media_size = '<div class="ready_image_size">'.__('Custom Code', 'flowthemes').'</div>';
									$slide_type = 'data-type="custom"';
								}else{}
								
								echo '<div class="ready_image" '.$slide_number.' '.$slide_type.'><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img ready_image_img-visible" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div>'.$media_size.'<div class="ready_image_desc"></div></div>';
							}
						}
					} // is object
					?>
					<div class="ready_images_clear" style="clear:both;"></div>
				</div>
				<!-- <input type="hidden" id="<?php //echo $name; ?>" name="<?php //echo $name; ?>" value="<?php //echo esc_html( $value ); ?>" /> -->
				<div class="ss-show-code"><?php _e('Click here to display SuperSlide output as raw code', 'flowthemes'); ?></div>			
				<textarea class="ss-code-box" id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo esc_html($value); ?></textarea>
				<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( $nonce_name ); ?>" />
			</div>
					
	<?php include( dirname( __FILE__ ) . '/superslide-scripts.php' ); ?>
	<script type="text/javascript">
		var objectForEverything = <?php echo json_encode((object) $objectForEverything); ?>;

		function addSlideByIcon(icon){
			var data = {};
			data['type'] = jQuery(icon).attr('data-form-type');
			
			var form = jQuery('.ss-forms-table[data-form-type="'+data['type']+'"]');
			var all_fields = form.find('.ss_form_field');
			jQuery.each(all_fields, function(index, field){
				var key = jQuery(field).attr('name');
				if(jQuery(field).attr('type') == 'checkbox'){
					data[key] = jQuery(field).is(":checked");
				}else{
					data[key] = jQuery(field).val();
				}
			});
			
			if(data['type'] == 'image' && !data.image){
				alert('Please specify image URL.');
				return;
			}
			
			var number_of_items = Object.keys(objectForEverything).length;
			objectForEverything[number_of_items] = data;
			console.log(objectForEverything);
			
			if(data['type'] != 'image'){
				var thumbnail = form.attr('data-form-thumbnail');
			}else{
				var thumbnail = data.image;
			}
			
			createSSTile(data.type, thumbnail);
			
			tb_remove();
			return;
		}
		function createSSTile(type, thumbnail, img_title, img_mime_subtype, itemIndex){
			
			// ID of this tile
			if(!itemIndex){
				var itemIndex = (Object.keys(objectForEverything).length)-1;
			}
			
			if(type == 'image'){
				var myURL = parseURL(thumbnail);
				if(img_mime_subtype){
					
				}else if(myURL.file){
					var img_mime_subtype = thumbnail.split('.').pop().toUpperCase();
				}else{
					var img_mime_subtype = '';
				}
				if(img_title){
					var fileName = doShortenNamebyFlow(img_title);
				}else if(myURL.file){
					var fileName = doShortenNamebyFlow(myURL.file);
				}else{
					var fileName = 'Media';
				}
				var fileSize = '';
				var ss_thumbnail_visible = '';
			}else if(type == 'video'){
				var fileName = 'Video Slide';
				var fileSize = 'Internal';
				var img_mime_subtype = '';
				var ss_thumbnail_visible = 'ready_image_img-visible';
			}else if(type == 'vimeo'){
				var fileName = 'Vimeo Slide';
				var fileSize = 'External';
				var img_mime_subtype = '';
				var ss_thumbnail_visible = 'ready_image_img-visible';
			}else if(type == 'youtube'){
				var fileName = 'YouTube Slide';
				var fileSize = 'External';
				var img_mime_subtype = '';
				var ss_thumbnail_visible = 'ready_image_img-visible';
			}else if(type == 'custom'){
				var fileName = 'Custom Code';
				var fileSize = '';
				var img_mime_subtype = '';
				var ss_thumbnail_visible = 'ready_image_img-visible';
			}
			
			if((('slide_desc' in objectForEverything[itemIndex]) && (objectForEverything[itemIndex]['slide_desc'] != '')) || (('custom' in objectForEverything[itemIndex]) && (objectForEverything[itemIndex]['custom'] != ''))){
				var deschighlight = 'ready_image_desc_active';
			}else{
				var deschighlight = '';
			}
			
			jQuery('#ready_images').find('.ready_images_clear').before('\
				<div class="ready_image" data-number="'+(itemIndex)+'" data-type="'+(type)+'">\
					<div class="remove-slide"></div>\
					<div class="overflow_cont">\
						<img class="ready_image_img ' + ss_thumbnail_visible + '" src="' + thumbnail + '" alt="" />\
					</div>\
					<div class="ready_image_title">' + fileName + '</div>\
					<div class="ready_image_size">' + fileSize + '</div>\
					<div class="ready_image_subtype"> ' + img_mime_subtype + '</div>\
					<div class="ready_image_desc ' + deschighlight + '"></div>\
				</div>\
			');
			
			/* Bind Events for newly created tile */
			var the_tile = jQuery('.ready_image[data-number="'+(itemIndex)+'"]').get(0);
			jQuery(the_tile).find('.remove-slide').on('click.remove_slide', function(){
				removeTile(the_tile);
			});
			
			if(type == 'image'){
				jQuery('<img />').attr('src', thumbnail).load(function(){
					var real_width = jQuery(this).get(0).width;
					var real_height = jQuery(this).get(0).height;
					var fileSize = '' + real_width + 'x' + real_height + 'px&nbsp;';					
					jQuery('.ready_image[data-number="'+itemIndex+'"]').find('.ready_image_size').html(fileSize);
					doImageResizingbyFlow(thumbnail, jQuery('.ready_image[data-number="'+itemIndex+'"]').find('.ready_image_img'));
				});
			}
			generateShortcodes();
		}
		
		function bindEdit(){
			jQuery('.ready_image').each(function(){
				var this_tile = jQuery(this);
				jQuery(this).find('.ready_image_desc').unbind('click');
				jQuery(this).find('.ready_image_desc').on('click', function(){
					clearForms();
					var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
					W = W - 80;
					H = H - 104;
					var id = this_tile.attr('data-number');
					var type = this_tile.attr('data-type');
					tb_show('Edit Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=flow_'+type+'_form');
					
					var all_fields = jQuery('.flow_'+type+'_form .ss_form_field');
					jQuery.each(all_fields, function(index, field){
						var key = jQuery(field).attr('name');
						if(key in objectForEverything[id]){
							var value = objectForEverything[id][key];
							if(jQuery(field).attr('type') == 'checkbox'){
								if(value == true){
									jQuery(field).prop('checked', true);
								}else{
									jQuery(field).prop('checked', false);
								}
							}else{	
								jQuery(field).val(value);
								jQuery(field).trigger('change');
								jQuery(field).trigger('blur');
								if(jQuery(field).hasClass('wp-color-picker')){
									jQuery(field).closest('.wp-picker-container').find('.wp-color-result').css({ 'background-color' : value });
								}
							}
						}
					});
					jQuery('#flow_'+type+'_form_submit').unbind();
					jQuery('#flow_'+type+'_form_submit').on('click', function(){
					
						if(type == 'image'){
							var field_val = jQuery('.flow_'+type+'_form .ss_form_field[name="image"]').val();
							if(jQuery.trim(field_val) == ''){
								var answer = confirm ("<?php _e('This slide has no image. Would you like to emove it?', 'flowthemes'); ?>")
								if(answer){
									removeTile(this_tile);
									tb_remove();
									generateShortcodes();
									return;
								}else{ 
									return;
								}
							}
						}
		
						var all_fields = jQuery('.flow_'+type+'_form .ss_form_field');
						jQuery.each(all_fields, function(index, field){
							var key = jQuery(field).attr('name');
							if(jQuery(field).attr('type') == 'checkbox'){
								objectForEverything[id][key] = jQuery(field).is(":checked");
							}else{
								objectForEverything[id][key] = jQuery(field).val();
							}
						});
						tb_remove();
						highlightDesc();
						generateShortcodes();
					});	
				});
			});
		}
		function createTilesFromObject(){
			jQuery.each(objectForEverything, function(index, shortcode_atts){
				if('type' in shortcode_atts){
					var type = shortcode_atts['type'];
				// Try to guess type...
				}else if('video_youtube' in shortcode_atts){
					var type = 'youtube';
				}else if('video_vimeo' in shortcode_atts){
					var type = 'vimeo';
				}else if('custom' in shortcode_atts){
					var type = 'custom';
				}else if('image' in shortcode_atts){
					var type = 'image';
				}else if(('video_mp4' in shortcode_atts) || ('video_ogg' in shortcode_atts) || ('video_webm' in shortcode_atts)){
					var type = 'video';
				}
				
				var form = jQuery('.ss-forms-table[data-form-type="'+type+'"]');
		
				if(type != 'image'){
					var thumbnail = form.attr('data-form-thumbnail');
				}else{
					var thumbnail = shortcode_atts.image;
				}
		
				createSSTile(type, thumbnail, false, false, index);
			});
		}
		function highlightDesc(current_this){
			if(current_this){
				current_this.addClass("ready_image_desc_active");
			}else{
				jQuery('.ready_image').each(function(){
					var tile_id = jQuery(this).attr('data-number');
					if((('slide_desc' in objectForEverything[tile_id]) && (objectForEverything[tile_id]['slide_desc'] != '')) || (('custom' in objectForEverything[tile_id]) && (objectForEverything[tile_id]['custom'] != ''))){
						jQuery(this).find('.ready_image_desc').addClass('ready_image_desc_active');
					}else{
						jQuery(this).find('.ready_image_desc').removeClass('ready_image_desc_active');
					}
				});
			}
		}
		jQuery(document).ready(function(){
			// Extension by Flow
			jQuery('.media-library-icon').on('click.ss_dragdrop_uploader', function(){
				window.original_send_to_editor = window.send_to_editor;
				window.send_to_editor = function(html){
					window.send_to_editor = window.original_send_to_editor;
				}
				
				//var insert_backup = wp.media.editor.insert;
				//wp.media.editor.insert = function(g){
					//alert('Galleries can not be inserted');
					//wp.media.editor.insert = insert_backup;
				//}
				
				var send_attachment_backup = wp.media.editor.send.attachment;
				wp.media.editor.send.attachment = function(props, attachment){
					//console.log(attachment);
					/* alt: "Bas Van Der Veer"
					author: "1"
					caption: ""
					compat: Object
					date: Wed Jan 23 2013 13:46:27 GMT+0100 (Central European Standard Time)
					dateFormatted: "January 23, 2013"
					description: "Orange project"
					editLink: "http://192.168.0.66/testwordpress/wp-admin/post.php?post=3789&action=edit"
					filename: "basvanderveer_tn.png"
					height: 300
					icon: "http://192.168.0.66/testwordpress/wp-includes/images/crystal/default.png"
					id: 3789
					link: "http://192.168.0.66/testwordpress/?attachment_id=3789"
					menuOrder: 0
					mime: "image/png"
					modified: Wed Jan 23 2013 13:46:27 GMT+0100 (Central European Standard Time)
					name: "basvanderveer_tn"
					nonces: Object
					orientation: "landscape"
					sizes: Object
					status: "inherit"
					subtype: "png"
					title: "basvanderveer_tn"
					type: "image"
					uploadedTo: 1
					url: "http://192.168.0.66/testwordpress/wp-content/uploads/2013/01/basvanderveer_tn.png"
					width: 400
					__proto__: Object */
					
					if(attachment.type == 'video' || attachment.type == 'image'){
						var data = {};
						data['type'] = attachment.type;
						
						if(attachment.type == 'video'){
							var thumbnail_icon = form_boxes['video']['icon'];
							if(attachment.subtype == 'mp4'){
								data['video_mp4'] = attachment.url;
							}else if(attachment.subtype == 'ogg'){
								data['video_ogg'] = attachment.url;
							}else if(attachment.subtype == 'webm'){
								data['video_webm'] = attachment.url;
							}
						}else if(attachment.type == 'image'){
							var thumbnail_icon = attachment.url;
							data['image'] = thumbnail_icon;
							data['image_alt'] = attachment.alt;
						}
						data['slide_desc'] = attachment.description;
						
						var number_of_items = Object.keys(objectForEverything).length;
						objectForEverything[number_of_items] = data;
						
						createSSTile(attachment.type, thumbnail_icon);
					
						//createSSTile(attachment.type, thumbnail_icon, attachment.alt, attachment.title, attachment.description, attachment.subtype);
					}else{
						alert('Only images and videos are supported - ' + attachment.name + ' could not be added.');
					}
					
					//wp.media.editor.send.attachment = send_attachment_backup;
				}
				wp.media.editor.open();
			});
			// End extension by Flow

			jQuery( "#ready_images" ).sortable({
				update: function (e, ui){
					var newObjectForEverything = {};
					var i = 0;
					jQuery('.ready_image').each(function(){
						newObjectForEverything[i] = objectForEverything[jQuery(this).attr('data-number')];
						jQuery(this).attr('data-number', i);
						i++;
					});
					objectForEverything = newObjectForEverything;
					generateShortcodes();
				}
			});
			jQuery( "#ready_images" ).sortable( "option", "cursor", 'move' );
			jQuery( "#ready_images" ).sortable({ placeholder: "ui-state-highlight" });
			jQuery( "#ready_images" ).sortable( "option", "tolerance", 'pointer' );
			jQuery.fn.shuffle = function(){
				var items = [];
				jQuery(this).find(".ready_image").each(function(i,e){
					items[items.length] = jQuery(e).clone(true);
				});
				jQuery(this).find(".ready_image").remove();
				for(var sj, sx, si = items.length; si;
				  sj = parseInt(Math.random() * si),
				  sx = items[--si], items[si] = items[sj], items[sj] = sx);
				for(var dx=0;dx<items.length;dx++){
					jQuery(this).prepend(items[dx]);
				}
				return true;
			}
			jQuery(".shuffle-icon a").click(function() {
				jQuery('#ready_images').shuffle();
				var newObjectForEverything = {};
				var i = 0;
				jQuery('.ready_image').each(function(){
					newObjectForEverything[i] = objectForEverything[jQuery(this).attr('data-number')];
					jQuery(this).attr('data-number', i);
					i++;
				});
				objectForEverything = newObjectForEverything;
				generateShortcodes();
			});

			//generateShortcodes();
			//bindEdit();
			//highlightDesc();
			doAllImageResizingbyFlow();
			
			jQuery('.ss-show-code').on('click.show-ss-box', function(){
				if(jQuery('.ss-code-box').hasClass('ss-code-box-visible')){
					jQuery('.ss-code-box').removeClass('ss-code-box-visible');
				}else{
					jQuery('.ss-code-box').addClass('ss-code-box-visible');
				}
			});
		});
		</script>
		</td>
	</tr>
<?php } ?>