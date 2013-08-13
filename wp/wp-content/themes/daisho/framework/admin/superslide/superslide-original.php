<?php function get_meta_slidemanager( $args = array(), $value = false ) {
	extract( $args );
	
		/* Array of the meta box options. */
	$meta_boxes = array(
		'flow_image' => array( 'name' => 'flow_image', 'title' => __('Title', 'flowthemes'), 'desc' => 'Slide title (specify if needs to be different than in admin panel).', 'type' => 'upload' ),
		'flow_image_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'textarea' ),
		'flow_image_text_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_image_cursor_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_image_fitscreen_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_image_original_dimensions_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_image_nostyle_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' )
	);	
	
	$meta_boxes = array(
		'flow_video' => array( 'name' => 'flow_video', 'title' => __('Title', 'flowthemes'), 'desc' => 'Slide title (specify if needs to be different than in admin panel).', 'type' => 'upload' ),
		'flow_video_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'textarea' ),
		'flow_video_text_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_video_cursor_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_video_fitscreen_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_video_original_dimensions_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_video_nostyle_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		
		/* Videos */
		'flow_video_mp4' => array( 'name' => 'slide-video-mp4', 'title' => __('Slide video (MP4):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to MP4 format of your video.', 'type' => 'upload' ),
		'flow_video_ogg' => array( 'name' => 'slide-video-ogg', 'title' => __('Slide video (OGG):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to OGV format of your video.', 'type' => 'upload' ),
		'flow_video_webm' => array( 'name' => 'slide-video-webm', 'title' => __('Slide video (WEBM):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to WEBM format of your video. Not every WordPress installation supports WEBM videos in Media Library. Please upload it elsewhere.', 'type' => 'text' ),
		'flow_video_poster' => array( 'name' => 'slide-video-poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to image poster of your video.', 'type' => 'upload' )
	);
	
	$meta_boxes = array(
		'flow_youtube' => array( 'name' => 'slide-video', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Put <strong>a link or video ID</strong> to YouTube or Vimeo video here.', 'type' => 'upload' ),
		'flow_youtube_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'textarea' ),
		'flow_youtube_text_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_youtube_cursor_color' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
		'flow_youtube_fitscreen_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_youtube_original_dimensions_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
		'flow_youtube_nostyle_mode' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' )
	);
	
	$meta_boxes = array(
		'flow_custom' => array( 'name' => 'slide-video', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Custom code', 'type' => 'textarea' )
	);
	

			/* $fields = '';
			foreach($shortcode_boxes as $shortcode_box_key => $shortcode_box_value){
				
				$fields_prefix = '<div style="display: none;" data-shortcode="'.$shortcode_box_key.'" data-shortcodetype="'.$shortcode_box_value['type'].'" class="flow-shortcode-set-item flow-shortcode-set-'.$shortcode_box_key.'">';
				$fields_suffix = '</div>';
				unset($current_fields);
				$current_fields = '';
				
				foreach($shortcode_box_value['fields'] as $shortcode_field_key => $shortcode_field_value){
					if($shortcode_field_value[0] == 'input'){
						if($shortcode_field_value[3] == 'required'){ $field_required = "<span class=\"flow-shortcode-label-required\">*</span>"; $required_class = 'flow-shortcode-field-required'; }else{ $field_required = ''; $required_class = ''; }
						$field_type = '<div class="flow-shortcode-field-container clearfix"><div class="flow-shortcode-label clearfix">'.$shortcode_field_key.$field_required.'</div><div class="flow-shortcode-field '.$required_class.' clearfix"><input name="'.$shortcode_field_value[1].'" type="text"><p>'.$shortcode_field_value[2].'</p></div></div>';
					}else if($shortcode_field_value[0] == 'colorpicker'){
						if($shortcode_field_value[3] == 'required'){ $field_required = "<span class=\"flow-shortcode-label-required\">*</span>"; $required_class = 'flow-shortcode-field-required'; }else{ $field_required = ''; $required_class = ''; }
						$field_type = '<div class="flow-shortcode-field-container clearfix"><div class="flow-shortcode-label clearfix">'.$shortcode_field_key.$field_required.'</div><div class="flow-shortcode-field '.$required_class.' clearfix"><input name="'.$shortcode_field_value[1].'" class="flow-shortcode-field-colorpicker attcolorpicker" type="text"><div class="colorSelector"><div style="background-color:#000000;"></div></div><p>'.$shortcode_field_value[2].'</p></div></div>';
					}else if($shortcode_field_value[0] == 'upload'){
						if($shortcode_field_value[3] == 'required'){ $field_required = "<span class=\"flow-shortcode-label-required\">*</span>"; $required_class = 'flow-shortcode-field-required'; }else{ $field_required = ''; $required_class = ''; }
						$field_type = '<div class="flow-shortcode-field-container clearfix"><div class="flow-shortcode-label clearfix">'.$shortcode_field_key.$field_required.'</div><div class="flow-shortcode-field '.$required_class.' clearfix"><input name="'.$shortcode_field_value[1].'" class="flow-shortcode-field-upload" type="text"><span class="briskuploader button">'.__('Upload', 'flowthemes').'</span><br><div class="briskuploader_preview"></div><p>'.$shortcode_field_value[2].'</p></div></div>';
					}
					$current_fields .= $field_type;
				}
				$fields .= $fields_prefix.$current_fields.$fields_suffix;
			}
			echo $fields; */
	
	?>
	<tr>
	<td colspan="2">
	<div id="left">
	<div id="content">
		<div id="custom-demo" class="demo">
        <script type="text/javascript">
jQuery(document).ready(function() {

	// Setup html5 version of Plupload
	try{
		jQuery("#html5_uploader").pluploadQueue({
			// General settings
			 url : '<?php bloginfo('template_directory'); ?>/framework/admin/superslide/upload.php',
			runtimes : 'html5',
			max_file_size : '12mb',
			chunk_size : '2mb',
			rename: true,
			multiple_queues: true,
			//unique_names : true,
			init : {
				'FileUploaded' : function(b,file,c){
					console.log(c);
					var cr = JSON.parse(c.response);
					if(c.status == 200){
						file.name = cr.result.filename;
					}else{
						/* file.name = file.name.replace(/[^\w\._]+/g,'_'); //This is already done by upload.php and upload.php returns correct file name */
						alert('Upload.php could not upload your file. Error message: '+cr.error.message+'. Please contact Server Administrator. Script will now terminate.');
						return;
					}
					<?php $upload_dir = wp_upload_dir(); ?>
					var images_path = '<?php echo $upload_dir['url']; ?>/' + file.name;
					var slide_color = '<div class="r_color">#ffffff</div>';
					var slide_desc = '<div class="r_desc"></div>'; 
					var current_this = '<div class="current_this">image</div>';
					var slide_media = '<div class="r_media">' + images_path + '</div>';
					var fileSize = '&nbsp;'+file.name.split('.').pop().toUpperCase();
					var fileName = doShortenNamebyFlow(file.name);
					jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
					var img = jQuery(jQuery('.ready_image_img').get(0));
					img.one('load', function(){
						var img_width = img.width();
					var img_height = img.height();
					jQuery('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>').insertAfter(jQuery(".ready_image_title").get(0));
						doImageResizingbyFlow();
					});
					bindDescriptionsbyflow();
					generateshortcodesbyflow();
				}
			},
			// Specify what files to browse for
			filters : [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip"}
			]
		});
	}catch(e){
		alert('There was a Server Error while trying to load WordPress Plupload component. Please contact Server Administrator or theme support.');
	}

	function doImageResizingbyFlow(){
		jQuery(".remove-slide").unbind('click');
		jQuery(".remove-slide").click(function() {
			//var answer = confirm ("<?php _e('Are you sure you want to remove it? You will not be able to restore it.', 'flowthemes'); ?>")
			//if (answer) {
				jQuery(this).parent().fadeOut(300, function() { jQuery(this).remove(); generateshortcodesbyflow(); });
			//}else{ }
		});
		var img = jQuery(jQuery('.ready_image_img').get(0));
		var img_size = jQuery(jQuery('.ready_image_size').get(0));

		var img_width = img.width();
		var img_height = img.height();
		
		/* Double checking for original image's width and height. 
		I don't know why it sometimes takes wrong values. 
		Perphas some script delays cause that. 
		This is to make sure size is always correct */
		
		img_size.empty().text(img_width + 'x'+ img_height +'px');

		if(img_height == img_width || img_height == 'auto' || img_width == 'auto'){
			img.css({ 'width' : '130px', 'height' : '130px', 'position' : 'relative'});
		}else if(img_height <= img_width){
			img.css({ 'width' : 'auto', 'height' : '130px', 'position' : 'relative'});
			img_width = img.width();
			img.css({ 'left' : ~((img_width-130)/2)+'px' });
		}else{
			img.css({ 'height' : 'auto', 'width' : '130px', 'top' : ~((img_height-130)/2)+'px', 'position' : 'relative'});
			img_height = img.height();
			img.css({ 'top' : ~((img_height-130)/2)+'px' });
		}
	}
	function doAllImageResizingbyFlow(){
		jQuery(".remove-slide").unbind('click');
		jQuery(".remove-slide").click(function() {
			//var answer = confirm ("<?php _e('Are you sure you want to remove it? You will not be able to restore it.', 'flowthemes'); ?>")
			//if (answer) {
				jQuery(this).parent().fadeOut(300, function() { jQuery(this).remove(); generateshortcodesbyflow(); });
			//}else{ }
		});
		jQuery('.ready_image_img').each(function(index){
			var img = jQuery(this);
			var img_width = img.width();
			var img_height = img.height();
			
			if(img_height == img_width || img_height == 'auto' || img_width == 'auto'){
				img.css({ 'display' : 'block', 'width' : '130px', 'height' : '130px', 'position' : 'relative'});
			}else if(img_height <= img_width){
				img.css({ 'display' : 'block', 'width' : 'auto', 'height' : '130px', 'position' : 'relative'});
				img_width = img.width();
				img.css({ 'left' : ~((img_width-130)/2)+'px' });
			}else{
				img.css({ 'display' : 'block', 'height' : 'auto', 'width' : '130px', 'position' : 'relative'});
				img_height = img.height();
				img.css({ 'top' : ~((img_height-130)/2)+'px' });
			}
		});
	}
	doAllImageResizingbyFlow();
	function doUnitConversionbyFlow(unit){
		var fileSize = Math.round(unit / 1024);
			var suffix   = 'KB';
			if (fileSize > 1000) {
				fileSize = Math.round(fileSize / 1000);
				suffix   = 'MB';
			}
			var fileSizeParts = fileSize.toString().split('.');
			fileSize = fileSizeParts[0];
			if (fileSizeParts.length > 1) {
				fileSize += '.' + fileSizeParts[1].substr(0,2);
			}
			fileSize += suffix;
			return fileSize;
	}
	function doShortenNamebyFlow(name){
		var fileName = name;
		var extension = '.'+fileName.split('.').pop().toLowerCase();
		fileName = fileName.replace(extension, '');

		if (fileName.length > 15) {
			fileName = fileName.substr(0,15) + '...';
		}
		return fileName;
	}
	function strrpos(haystack, needle, offset){
		var i = -1;
		if (offset) {
			i = (haystack + '').slice(offset).lastIndexOf(needle);
			if (i !== -1) {
				i += offset;
			}
		} else {
			i = (haystack + '').lastIndexOf(needle);
		}
		return i >= 0 ? i : false;
	}
	function highlightDescbyflow(current_this) {
		if(current_this){
			current_this.addClass("ready_image_desc_active");
		}else{
			jQuery('.ready_image_desc').each(function(){
				var isdescset = jQuery(this).find(".r_desc").text();
				if(isdescset != ''){
					jQuery(this).addClass("ready_image_desc_active");
				}
			});
		}
	}
	highlightDescbyflow();
	function addImageSlideDatabyFlow(){
		var r_color = jQuery('#flow_text_color_image option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_image').val();
		r_desc = r_desc.replace("</h4>\n","\n").replace("<h4>","");
		r_desc = "<h4>"+r_desc.replace("\n","</h4>\n");
		var r_media = jQuery('#flow_image').val();
		var r_horizontal = jQuery('#flow_slide_horizontal_image').is(':checked');
		
		if(r_desc != ''){ highlightDescbyflow(window.main_this); }
		
		window.main_this.find('.r_color').empty().text(r_color);
		window.main_this.find('.r_desc').empty().html(r_desc);
		window.main_this.find('.r_media').empty().text(r_media);
		window.main_this.find('.r_horizontal').empty().text(r_horizontal);
		window.main_this.parent().find('.ready_image_img').attr('src', r_media);
		var img_current = window.main_this.parent().find('.ready_image_img');
		
		img_current.one('load', function(){
			img_current.css({'width' : 'auto', 'height' : 'auto'});
			var img_width = img_current.width();
			var img_height = img_current.height();
		
			jQuery(window.main_this.parent().find('.ready_image_size').get(0)).text(img_width + 'x' + img_height + 'px');
			doAllImageResizingbyFlow();
		});
		var current_title = strrpos(img_current.attr("src"), "/")+1;
		current_title = img_current.attr("src").substr(current_title);
		current_title = doShortenNamebyFlow(current_title);
		jQuery(window.main_this.parent().find('.ready_image_title').get(0)).text(current_title);
		tb_remove();
		generateshortcodesbyflow();
	}
	function addYoutubeSlideDatabyFlow(){
		var r_color = jQuery('#flow_text_color_youtube option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_youtube').val();
		r_desc = r_desc.replace("</h4>\n","\n").replace("<h4>","");
		r_desc = "<h4>"+r_desc.replace("\n","</h4>\n");
		var r_media = jQuery('#flow_video_youtube').val();
		var r_noresize = jQuery('#flow_slide_noresize_youtube').is(':checked');
		var r_media_poster = jQuery('#flow_youtube_poster').val();
		
		if(r_desc != ''){ highlightDescbyflow(window.main_this); }
		
		window.main_this.find('.r_color').empty().text(r_color);
		window.main_this.find('.r_desc').empty().html(r_desc);
		window.main_this.find('.r_media').empty().text(r_media);
		window.main_this.find('.r_noresize').empty().text(r_noresize);
		window.main_this.find('.r_media_poster').empty().text(r_media_poster);

		tb_remove();
		generateshortcodesbyflow();
	}	
	function addVimeoSlideDatabyFlow(){
		var r_color = jQuery('#flow_text_color_vimeo option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_vimeo').val();
		r_desc = r_desc.replace("</h4>\n","\n").replace("<h4>","");
		r_desc = "<h4>"+r_desc.replace("\n","</h4>\n");
		var r_media = jQuery('#flow_video_vimeo').val();
		var r_noresize = jQuery('#flow_slide_noresize_vimeo').is(':checked');
		var r_media_poster = jQuery('#flow_vimeo_poster').val();
		
		if(r_desc != ''){ highlightDescbyflow(window.main_this); }
		
		window.main_this.find('.r_color').empty().text(r_color);
		window.main_this.find('.r_desc').empty().html(r_desc);
		window.main_this.find('.r_media').empty().text(r_media);
		window.main_this.find('.r_noresize').empty().text(r_noresize);
		window.main_this.find('.r_media_poster').empty().text(r_media_poster);

		tb_remove();
		generateshortcodesbyflow();
	}	
	function addVideoSlideDatabyFlow(){
		var r_color = jQuery('#flow_text_color_video option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_video').val();
		r_desc = r_desc.replace("</h4>\n","\n").replace("<h4>","");
		r_desc = "<h4>"+r_desc.replace("\n","</h4>\n");
		var r_media_ogg = jQuery('#flow_video_ogg').val();
		var r_media_webm = jQuery('#flow_video_webm').val();
		var r_media_mp4 = jQuery('#flow_video_mp4').val();
		var r_media_poster = jQuery('#flow_video_poster').val();
		
		if(r_desc != ''){ highlightDescbyflow(window.main_this); }
		
		window.main_this.find('.r_color').empty().text(r_color);
		window.main_this.find('.r_desc').empty().html(r_desc);
		window.main_this.find('.r_media_ogg').empty().text(r_media_ogg);
		window.main_this.find('.r_media_webm').empty().text(r_media_webm);
		window.main_this.find('.r_media_mp4').empty().text(r_media_mp4);
		window.main_this.find('.r_media_poster').empty().text(r_media_poster);

		tb_remove();
		generateshortcodesbyflow();
	}	
	function addCustomSlideDatabyFlow(){
		var r_desc = jQuery('#flow_slide_desc_custom').val();
		while(r_desc.indexOf('<') != -1){
			r_desc = r_desc.replace('<','flowleftbracket67');
		}
		while(r_desc.indexOf('>') != -1){
			r_desc = r_desc.replace('>','flowrightbracket67');
		}
		if(r_desc != ''){ highlightDescbyflow(window.main_this); }
		window.main_this.find('.r_desc').empty().html(r_desc);

		tb_remove();
		generateshortcodesbyflow();
	}
	jQuery(function(){
		jQuery( "#ready_images" ).sortable({
			update: function (e, ui) {
				generateshortcodesbyflow();
            }
		});
		jQuery( "#ready_images" ).sortable( "option", "cursor", 'move' );
		jQuery( "#ready_images" ).sortable({ placeholder: "ui-state-highlight" });
		jQuery( "#ready_images" ).sortable( "option", "tolerance", 'pointer' );
		jQuery.fn.shuffle = function() {
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
		});
	});
	function generateshortcodesbyflow(){
		//finally... :)
		var shortcode_output='';
		jQuery('.ready_image .ready_image_desc').each(function(index){
			var current_this = jQuery(this).find(".current_this").text();
			
			var options=new Array();
			if(current_this == 'image'){
				options['image'] = jQuery(this).find(".r_media").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").html();
				options['text_color'] = jQuery(this).find(".r_color").text();
				options['slide_horizontal'] = jQuery(this).find(".r_horizontal").text();
			}else if(current_this == 'video'){
				options['video_mp4'] = jQuery(this).find(".r_media_mp4").text();
				options['video_ogg'] = jQuery(this).find(".r_media_ogg").text();
				options['video_webm'] = jQuery(this).find(".r_media_webm").text();
				options['video_poster'] = jQuery(this).find(".r_media_poster").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").html();
				options['text_color'] = jQuery(this).find(".r_color").text();
			}else if(current_this == 'vimeo'){
				options['video_vimeo'] = jQuery(this).find(".r_media").text();
				options['video_poster'] = jQuery(this).find(".r_media_poster").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").html();
				options['text_color'] = jQuery(this).find(".r_color").text();
				options['slide_noresize'] = jQuery(this).find(".r_noresize").text();
			}else if(current_this == 'youtube'){
				options['video_youtube'] = jQuery(this).find(".r_media").text();
				options['video_poster'] = jQuery(this).find(".r_media_poster").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").html();
				options['text_color'] = jQuery(this).find(".r_color").text();
				options['slide_noresize'] = jQuery(this).find(".r_noresize").text();
			}else if(current_this == 'custom'){
				options['custom'] = jQuery(this).find(".r_desc").html();
				/* while(r_desc.indexOf('<') != -1){
					r_desc = r_desc.replace('<','&lt;');
				}
				while(r_desc.indexOf('>') != -1){
					r_desc = r_desc.replace('>','&gt;');
				}
				while(r_desc.indexOf('&lt;') != -1){
					r_desc = r_desc.replace('&lt;','<');
				}
				while(r_desc.indexOf('&gt;') != -1){
					r_desc = r_desc.replace('&gt;','>');
				} */
			}
			
			var shortcode = '[slide';
			for(var index in options){
				if(options.hasOwnProperty(index)){
					var value = options[index];
						while(value.indexOf('"') != -1){
							value = value.replace('"','*');
						}

						//if(value !== options[index])
							shortcode += ' ' + index + '="' + value + '"';
				}	
			}
			shortcode += ']';
			shortcode_output += shortcode;
		});
		jQuery("#<?php print($name); ?>").val(shortcode_output);
	}
	generateshortcodesbyflow();
	function performClearFormsbyFlow(){
		//jQuery('.r_color').empty();
		jQuery('#flow_slide_desc_image').val('');
		jQuery('#flow_slide_horizontal_image').attr('checked', false);
		jQuery('#flow_slide_noresize_vimeo').attr('checked', false);
		jQuery('#flow_slide_noresize_youtube').attr('checked', false);
		jQuery('#flow_slide_desc_video').val('');
		jQuery('#flow_slide_desc_vimeo').val('');
		jQuery('#flow_slide_desc_youtube').val('');
		jQuery('#flow_slide_desc_custom').val('');
		jQuery('#flow_video_youtube').val('');
		jQuery('#flow_video_vimeo').val('');
		jQuery('#flow_image').val('');
		jQuery('#flow_video_ogg').val('');
		jQuery('#flow_video_webm').val('');
		jQuery('#flow_video_mp4').val('');
		jQuery('#flow_video_poster').val('');
		jQuery('#flow_vimeo_poster').val('');
		jQuery('#flow_youtube_poster').val('');
		jQuery('.briskuploader_preview_popup').empty();
	}
	function performBriskUploaderImageShow(){
		var briskuploader_fval = jQuery("#flow_image").val();
		var briskuploader_p = jQuery(".briskuploader_preview_popup");
		briskuploader_p.html("<img src=\""+briskuploader_fval+"\"></img><br><span class=\"briskuploader_remove\">remove</span>");
		briskuploader.removeonclick(briskuploader_p.find(".briskuploader_remove"));
	}
	function addImageSlideDataIconbyFlow(){
		var r_color = jQuery('#flow_text_color_image option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_image').val();
		var r_media = jQuery('#flow_image').val();
		var r_horizontal = jQuery('#flow_slide_horizontal_image').is(":checked");
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>';
		var current_this = '<div class="current_this">image</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		var slide_horizontal = '<div class="r_horizontal">' + r_horizontal + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }
		
		var fileName = doShortenNamebyFlow('image-preview');
		var images_path = r_media;
		var fileSize = '&nbsp;'+images_path.split('.').pop().toUpperCase();

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+slide_horizontal+'</div></div>');
		var img = jQuery(jQuery('.ready_image_img').get(0));
		var img_width = img.width();
		var img_height = img.height();
		jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
		setTimeout(function(){
			doImageResizingbyFlow();
		}, 10 );
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	function addVideoSlideDataIconbyFlow(){
		var images_path = '<?php bloginfo('template_directory'); ?>/framework/admin/superslide/video-preview.jpg';
		var fileSize = 'Internal';
		var fileName = doShortenNamebyFlow('Video Slide');
		
		var r_color = jQuery('#flow_text_color_video option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_video').val();
		var r_media_ogg = jQuery('#flow_video_ogg').val();
		var r_media_webm = jQuery('#flow_video_webm').val();
		var r_media_mp4 = jQuery('#flow_video_mp4').val();
		var r_media_poster = jQuery('#flow_video_poster').val();
		
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">video</div>';
		
		var slide_media_mp4 = '<div class="r_media_mp4">' + r_media_mp4 + '</div>';
		var slide_media_ogg = '<div class="r_media_ogg">' + r_media_ogg + '</div>';
		var slide_media_webm = '<div class="r_media_webm">' + r_media_webm + '</div>';
		var slide_media_poster = '<div class="r_media_poster">' + r_media_poster + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }
		
		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media_mp4+slide_media_ogg+slide_media_webm+slide_media_poster+'</div></div>');
		
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	function addVimeoSlideDataIconbyFlow(){
		var images_path = '<?php bloginfo('template_directory'); ?>/framework/admin/superslide/vimeo-preview.jpg';
		var fileSize = 'External';
		var fileName = doShortenNamebyFlow('Vimeo Slide');
		
		var r_color = jQuery('#flow_text_color_vimeo option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_vimeo').val();
		var r_noresize = jQuery('#flow_slide_noresize_vimeo').is(":checked");
		var r_media = jQuery('#flow_video_vimeo').val();
		var r_media_poster = jQuery('#flow_vimeo_poster').val();
		
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">vimeo</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		var slide_noresize = '<div class="r_noresize">' + r_noresize + '</div>';
		var slide_media_poster = '<div class="r_media_poster">' + r_media_poster + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+slide_noresize+slide_media_poster+'</div></div>');
		
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	function addYoutubeSlideDataIconbyFlow(){
		var images_path = '<?php bloginfo('template_directory'); ?>/framework/admin/superslide/youtube-preview.jpg';

		var fileSize = 'External';
		var fileName = doShortenNamebyFlow('YouTube Slide');
		
		var r_color = jQuery('#flow_text_color_youtube option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_youtube').val();
		var r_noresize = jQuery('#flow_slide_noresize_youtube').is(":checked");
		var r_media = jQuery('#flow_video_youtube').val();
		var r_media_poster = jQuery('#flow_youtube_poster').val();
		
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">youtube</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		var slide_noresize = '<div class="r_noresize">' + r_noresize + '</div>';
		var slide_media_poster = '<div class="r_media_poster">' + r_media_poster + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+slide_noresize+'</div></div>');

		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}	
	
	function addCustomSlideDataIconbyFlow(){
		var images_path = '<?php bloginfo('template_directory'); ?>/framework/admin/superslide/custom-preview.jpg';

		var fileSize = 'Custom Code';
		var fileName = doShortenNamebyFlow('Custom Code');
		
		var r_desc = jQuery('#flow_slide_desc_custom').val();
		while(r_desc.indexOf('<') != -1){
			r_desc = r_desc.replace('<','flowleftbracket67');
		}
		while(r_desc.indexOf('>') != -1){
			r_desc = r_desc.replace('>','flowrightbracket67');
		}
		
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">custom</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+'</div></div>');

		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	
	
	resizethickboxf=function(){
		var nheight = Math.max(0,Math.min(jQuery(window).height()-150, jQuery("#TB_ajaxContent table").height()+100));
		jQuery("#TB_ajaxContent").css("height",nheight+"px");
		//tb_position();
		jQuery("#TB_window").css("margin-top",(-(jQuery(window).height())/2+50)+"px");
	};
	function printThickBoxesbyFlow(){
		var form_image = jQuery('<div id="image-form"><table id="image-table" class="form-table">\
			<tr>\
				<th><label for="image"><?php _e('Image slide link', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="image" id="flow_image" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify image URL here.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="text_color"><?php _e('Text color (and cursor color)', 'flowthemes'); ?></label></th>\
				<td><select name="text_color" id="flow_text_color_image">\
					<option value="#ffffff"><?php _e('White color', 'flowthemes'); ?></option>\
					<option value="#464646"><?php _e('Dark color', 'flowthemes'); ?></option>\
				</select><br />\
				<small><?php _e('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'); ?></small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc"><?php _e('Slide Title (optional)', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_image" value="" /><br />\
				<small><?php _e('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="slide-horizontal"><?php _e('Fit screen mode (prevents image cropping)', 'flowthemes'); ?></label></th>\
				<td><input type="checkbox" name="slide-horizontal" id="flow_slide_horizontal_image" /><br />\
				<small><?php _e('If this is vertical image (like portrait photo with ratio like 1:2) or horizontal image (like panorama photo with ratio like 2:1) you can disable cropping for it (select checkbox). This prevents cropping of parts of image (like head of a person in case of portraits).', 'flowthemes'); ?></small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="image-submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes'); ?>" name="submit" />\
		</p>\
		</div>');
		var form_video = jQuery('<div id="video-form"><table id="video-table" class="form-table">\
			<tr>\
				<th><label for="video-mp4"><?php _e('Video slide (MP4)', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="video-mp4" id="flow_video_mp4" value="" /><span class="briskuploader button"><?php _e('Upload', 'flowthemes'); ?></span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video URL here (*.mp4). Leave blank if you want to use image or different video format.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="video-ogg"><?php _e('Video slide (Ogg) (*.ogv)', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="video-ogg" id="flow_video_ogg" value="" /><span class="briskuploader button"><?php _e('Upload', 'flowthemes'); ?></span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video URL here (*.ogv). Leave blank if you want to use image or different video format.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="video-webm"><?php _e('Video slide (WebM)', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="video-webm" id="flow_video_webm" value="" /><span class="briskuploader button"><?php _e('Upload', 'flowthemes'); ?></span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video URL here (*.webm). Leave blank if you want to use image or different video format.', 'flowthemes'); ?></small>\
			</tr>\
			<tr class="form-table">\
				<th><label for="video-poster"><?php _e('Video poster', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="video-poster" id="flow_video_poster" value="" /><span class="briskuploader button"><?php _e('Upload', 'flowthemes'); ?></span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="text_color"><?php _e('Text color (and cursor color)', 'flowthemes'); ?></label></th>\
				<td><select name="text_color" id="flow_text_color_video">\
					<option value="#ffffff"><?php _e('White color', 'flowthemes'); ?></option>\
					<option value="#464646"><?php _e('Dark color', 'flowthemes'); ?></option>\
				</select><br />\
				<small><?php _e('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'); ?></small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc"><?php _e('Slide Title (optional)', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_video" value="" /><br />\
				<small><?php _e('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'); ?></small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="video-submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes'); ?>" name="submit" />\
		</p>\
		</div>');				
		var form_vimeo = jQuery('<div id="vimeo-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-vimeo"><?php _e('Vimeo video link', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="4" name="video-vimeo" id="flow_video_vimeo" value="" /><br />\
				<small><?php _e('Specify Vimeo <strong>video ID</strong> or video LINK here. Please note that only default video link will work. Shortlinks and link without ID in it will not work.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="text_color"><?php _e('Text color (and cursor color)', 'flowthemes'); ?></label></th>\
				<td><select name="text_color" id="flow_text_color_vimeo">\
					<option value="#ffffff"><?php _e('White color', 'flowthemes'); ?></option>\
					<option value="#464646"><?php _e('Dark color', 'flowthemes'); ?></option>\
				</select><br />\
				<small><?php _e('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'); ?></small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-noresize"><?php _e('Fit screen mode (prevents video resizing)', 'flowthemes'); ?></label></th>\
				<td><input type="checkbox" name="slide-noresize" id="flow_slide_noresize_vimeo" /><br />\
				<small><?php _e('Select checkbox to disable video resizing. Original dimenions will be kept (640x360px only - higher resolutions work worse on smaller resolutions). You need to specify video poster below if this mode is selected.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="vimeo-poster"><?php _e('Vimeo poster', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="vimeo-poster" id="flow_vimeo_poster" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="slide-desc"><?php _e('Slide Title (optional)', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_vimeo" value="" /><br />\
				<small><?php _e('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'); ?></small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="vimeo-submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes'); ?>" name="submit" />\
		</p>\
		</div>');				
		var form_youtube = jQuery('<div id="youtube-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-youtube"><?php _e('YouTube video link', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="4" name="video-youtube" id="flow_video_youtube" value="" /><br />\
				<small><?php _e('Specify YouTube <strong>video ID</strong> or video LINK here.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="text_color"><?php _e('Text color (and cursor color)', 'flowthemes'); ?></label></th>\
				<td><select name="text_color" id="flow_text_color_youtube">\
					<option value="#ffffff"><?php _e('White color', 'flowthemes'); ?></option>\
					<option value="#464646"><?php _e('Dark color', 'flowthemes'); ?></option>\
				</select><br />\
				<small><?php _e('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'); ?></small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-noresize"><?php _e('Fit screen mode (prevents video resizing)', 'flowthemes'); ?></label></th>\
				<td><input type="checkbox" name="slide-noresize" id="flow_slide_noresize_youtube" /><br />\
				<small><?php _e('Select checkbox to disable video resizing. Original dimenions will be kept (640x360px only - higher resolutions work worse on smaller resolutions). You need to specify video poster below if this mode is selected.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="youtube-poster"><?php _e('YouTube poster', 'flowthemes'); ?></label></th>\
				<td><input type="text" name="youtube-poster" id="flow_youtube_poster" value="" /><span class="briskuploader button"><?php _e('Upload', 'flowthemes'); ?></span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small><?php _e('Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.', 'flowthemes'); ?></small>\
			</tr>\
			<tr>\
				<th><label for="slide-desc"><?php _e('Slide Title (optional)', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_youtube" value="" /><br />\
				<small><?php _e('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'); ?></small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="youtube-submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes'); ?>" name="submit" />\
		</p>\
		</div>');
		var form_custom = jQuery('<div id="custom-form"><table id="custom-table" class="form-table">\
			<tr>\
				<th><label for="slide-desc"><?php _e('Custom Code', 'flowthemes'); ?></label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_custom" value="" /><br />\
				<small><?php _e('Caution! You should not use "Custom Code" unless you know what you are doing. Without coding knowledge it may break your portfolio! This mode allows you to specify custom code to display on project page as slide. You can put here <b>SoundCloud</b> iframe to embed audio player or other custom code. <br/><br/> This field allows: \\\', ", < and > but it does not allow * symbol. It sends raw data to shortcode, so some characters may not be allowed.', 'flowthemes'); ?></small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="custom-submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes'); ?>" name="submit" />\
		</p>\
		</div>');

		form_image.appendTo('body').hide();
		form_video.appendTo('body').hide();
		form_vimeo.appendTo('body').hide();
		form_youtube.appendTo('body').hide();
		form_custom.appendTo('body').hide();
		jQuery(window).resize(resizethickboxf);
		
		try{
			briskuploader.inituploader();
		}catch(e){alert('uploader error');}
		
		jQuery(".image-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( '<?php _e('Add Image Slide', 'flowthemes'); ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
			setTimeout(function(){resizethickboxf();},0);
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#image-submit").unbind('click');
			jQuery("#image-submit").click(function() {
				addImageSlideDataIconbyFlow();
			});
		});
		jQuery(".video-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( '<?php _e('Add Self-hosted Video Slide', 'flowthemes'); ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
			setTimeout(function(){resizethickboxf();},0);
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#video-submit").unbind('click');
			jQuery("#video-submit").click(function() {
				addVideoSlideDataIconbyFlow();
			});
		});
		jQuery(".vimeo-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( '<?php _e('Add Vimeo Video Slide', 'flowthemes'); ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=vimeo-form' );
			setTimeout(function(){resizethickboxf();},0);
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#vimeo-submit").unbind('click');
			jQuery("#vimeo-submit").click(function() {
				addVimeoSlideDataIconbyFlow();
			});
		});
		jQuery(".youtube-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( '<?php _e('Add YouTube Video Slide', 'flowthemes'); ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=youtube-form' );
			setTimeout(function(){resizethickboxf();},0);
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#youtube-submit").unbind('click');
			jQuery("#youtube-submit").click(function() {
				addYoutubeSlideDataIconbyFlow();
			});
		});
		jQuery(".custom-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( '<?php _e('Add Custom Code', 'flowthemes'); ?>', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=custom-form' );
			setTimeout(function(){resizethickboxf();},0);
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#custom-submit").unbind('click');
			jQuery("#custom-submit").click(function() {
				addCustomSlideDataIconbyFlow();
			});
		});
		bindDescriptionsbyflow();
	}
	function bindDescriptionsbyflow() {
		//performClearFormsbyFlow();
		jQuery(".ready_image_desc").unbind('click');
		jQuery(".ready_image_desc").click(function() {
		performClearFormsbyFlow();
			if(jQuery(this).find(".current_this").text() == "image"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').html();
				var r_media = jQuery(this).find('.r_media').text();
				var r_horizontal = jQuery(this).find('.r_horizontal').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Image Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
				setTimeout(function(){resizethickboxf();},0);
				jQuery('#flow_image').val(r_media);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_image').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_image').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_image').val(r_desc);
				if(r_horizontal == 'true'){
					jQuery('#flow_slide_horizontal_image').attr('checked', true);
				}
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				performBriskUploaderImageShow();
				jQuery("#image-submit").unbind('click');
				jQuery("#image-submit").click(function() {
					addImageSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "youtube"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').html();
				var r_media = jQuery(this).find('.r_media').text();
				var r_media_poster = jQuery(this).find('.r_media_poster').text();
				var r_noresize = jQuery(this).find('.r_noresize').text();	
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit YouTube Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=youtube-form' );
				setTimeout(function(){resizethickboxf();},0);
				jQuery('#flow_video_youtube').val(r_media);
				jQuery('#flow_youtube_poster').val(r_media_poster);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_youtube').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_youtube').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_youtube').val(r_desc);
				if(r_noresize == 'true'){
					jQuery('#flow_slide_noresize_youtube').attr('checked', true);
				}
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#youtube-submit").unbind('click');
				jQuery("#youtube-submit").click(function() {
					addYoutubeSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "vimeo"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').html();
				var r_media = jQuery(this).find('.r_media').text();
				var r_media_poster = jQuery(this).find('.r_media_poster').text();
				var r_noresize = jQuery(this).find('.r_noresize').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Vimeo Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=vimeo-form' );
				setTimeout(function(){resizethickboxf();},0);
				jQuery('#flow_video_vimeo').val(r_media);
				jQuery('#flow_vimeo_poster').val(r_media_poster);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_vimeo').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_vimeo').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_vimeo').val(r_desc);
				if(r_noresize == 'true'){
					jQuery('#flow_slide_noresize_vimeo').attr('checked', true);
				}
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#vimeo-submit").unbind('click');
				jQuery("#vimeo-submit").click(function() {
					addVimeoSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "video"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').html();
				var r_media_ogg = jQuery(this).find('.r_media_ogg').text();
				var r_media_webm = jQuery(this).find('.r_media_webm').text();
				var r_media_mp4 = jQuery(this).find('.r_media_mp4').text();
				var r_media_poster = jQuery(this).find('.r_media_poster').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
				setTimeout(function(){resizethickboxf();},0);
				jQuery('#flow_video').val(r_media);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_video').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_video').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_video').val(r_desc);
				jQuery('#flow_video_mp4').val(r_media_mp4);
				jQuery('#flow_video_ogg').val(r_media_ogg);
				jQuery('#flow_video_webm').val(r_media_webm);
				jQuery('#flow_video_poster').val(r_media_poster);
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#video-submit").unbind('click');
				jQuery("#video-submit").click(function() {
					addVideoSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "custom"){
				window.main_this = jQuery(this);
				var r_desc = jQuery(this).find('.r_desc').html();
				while(r_desc.indexOf('flowleftbracket67') != -1){
					r_desc = r_desc.replace('flowleftbracket67','<');
				}
				while(r_desc.indexOf('flowrightbracket67') != -1){
					r_desc = r_desc.replace('flowrightbracket67','>');
				}
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Custom Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=custom-form' );
				setTimeout(function(){resizethickboxf();},0);
				jQuery('#flow_slide_desc_custom').val(r_desc);
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#custom-submit").unbind('click');
				jQuery("#custom-submit").click(function() {
					addCustomSlideDatabyFlow();
				});
			}
		});
	}

	printThickBoxesbyFlow();

});
</script>
<div class="demo-box">
	<div class="ready_images_heading">
		<div id="status-message"><?php _e('Upload Files', 'flowthemes'); ?></div>
	</div>
	<div id="html5_uploader"><?php _e('If you see this message then your browser doesn\'t support native upload or more likely something is broken because HTML5 Drag&Drop uploader couldn\'t be loaded. Please try deactivating some plugins and make sure that the theme is installed on fresh installation of the newest WordPress. If you still see this message, please checks errors in Javascript console or contact our support. This issue is surely related to your server configuration or admin panel configuration.', 'flowthemes'); ?></div>
	<div id="custom-queue"></div>
	<div class="ready_images_heading">
		<div id="status-message"><?php _e('Slide management', 'flowthemes'); ?></div>
		<div class="separator-icon"></div>
		<div class="image-icon"><a id="upload-image" class="icon-link" href="javascript:void(null);" title="<?php _e('Add Image Slide', 'flowthemes'); ?>"></a></div>
		<div class="video-icon"><a id="upload-video" class="icon-link" href="javascript:void(null);" title="<?php _e('Add Self-hosted Video', 'flowthemes'); ?>"></a></div>
		<div class="vimeo-icon"><a class="icon-link" href="javascript:void(null);" title="<?php _e('Add Vimeo Video', 'flowthemes'); ?>"></a></div>
		<div class="youtube-icon"><a class="icon-link" href="javascript:void(null);" title="<?php _e('Add YouTube Video', 'flowthemes'); ?>"></a></div>
		<div class="custom-icon"><a class="icon-link" href="javascript:void(null);" title="<?php _e('Add Custom Code', 'flowthemes'); ?>"></a></div>
		<div class="separator-icon"></div>
		<div class="shuffle-icon" title="<?php _e('Shuffle Slides', 'flowthemes'); ?>"><a class="icon-link" href="javascript:void(null);" title="<?php _e('Shuffle Slides', 'flowthemes'); ?>"></a></div>
	</div>
</div>
<div id="ready_images">
<?php 
$this_id = get_the_ID();
$post_id_7 = get_post($this_id); 
$title = $post_id_7->post_title;
$content = $post_id_7->post_content;
if($content != ''){
	$content = str_replace('[slide ', '', $content);
	$array_slidesow = explode(']', $content);

	foreach($array_slidesow as $piece_s){
		$test = shortcode_parse_atts($piece_s);
		//$size = filesize(dirname(__FILE__).'/uploads/'.$filename);
		//$size = formatbytes($test['image']);
		if(is_array($test) && $test['text_color']){ $slide_color = '<div class="r_color">' . $test['text_color'] . '</div>'; }else{ $slide_color = '<div class="r_color">#ffffff</div>'; }
		if(is_array($test) && $test['slide_desc']){ $test['slide_desc'] = str_replace("*", "\"", $test['slide_desc']); $slide_desc = '<div class="r_desc">' . $test['slide_desc'] . '</div>'; }else{ $slide_desc = '<div class="r_desc"></div>'; }
		if(is_array($test) && isset($test['image'])){
			$current_this = '<div class="current_this">image</div>';
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
			$slide_media = '<div class="r_media">' . $test['image'] . '</div>';
			if($test['slide_horizontal'] == 'true'){
				$slide_horizontal = '<div class="r_horizontal">true</div>';
			}else{
				$slide_horizontal = '<div class="r_horizontal">false</div>';
			}
			if($image_info['mime'] == "image/jpeg"){ $image_info['mime'] = "&nbsp;JPG"; }else if($image_info['mime'] == "image/png"){ $image_info['mime'] = "&nbsp;PNG"; }else if($image_info['mime'] == "image/gif"){ $image_info['mime'] = "&nbsp;GIF"; }
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $test['image'] . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">' . $image_info[0] . 'x' . $image_info[1] . 'px</div><div class="ready_image_size">' . $image_info['mime'] . '</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.$slide_horizontal.'</div></div>';
		}elseif(is_array($test) && (isset($test['video_mp4']) || isset($test['video_ogg']) || isset($test['video_webm']))){
			$current_this = '<div class="current_this">video</div>';
			$slide_media_mp4 = '<div class="r_media_mp4">' . $test['video_mp4'] . '</div>';
			$slide_media_ogg = '<div class="r_media_ogg">' . $test['video_ogg'] . '</div>';
			$slide_media_webm = '<div class="r_media_webm">' . $test['video_webm'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = substr($test['video_mp4'],strrpos($test['video_mp4'], "/")+1);
			//if($image_info = getimagesize($test['video_mp4'])){}else if($image_info = getimagesize($test['video_ogg'])){}else{$image_info = getimagesize($test['video_webm']);}
			$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/video-preview.jpg";
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">Internal</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media_mp4.$slide_media_ogg.$slide_media_webm.$slide_media_poster.'</div></div>';
		}elseif(is_array($test) && isset($test['video_vimeo'])){
			$current_this = '<div class="current_this">vimeo</div>';
			$slide_media = '<div class="r_media">' . $test['video_vimeo'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = 'Vimeo Slide';
			$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/vimeo-preview.jpg";
			if($test['slide_noresize'] == 'true'){
				$slide_noresize = '<div class="r_noresize">true</div>';
			}else{
				$slide_noresize = '<div class="r_noresize">false</div>';
			}
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">'.__('External', 'flowthemes').'</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.$slide_noresize.$slide_media_poster.'</div></div>';
		}elseif(is_array($test) && isset($test['video_youtube'])){
			$current_this = '<div class="current_this">youtube</div>';
			$slide_media = '<div class="r_media">' . $test['video_youtube'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = 'YouTube Slide';
			$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/youtube-preview.jpg";
			if($test['slide_noresize'] == 'true'){
				$slide_noresize = '<div class="r_noresize">true</div>';
			}else{
				$slide_noresize = '<div class="r_noresize">false</div>';
			}
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">'.__('External', 'flowthemes').'</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.$slide_noresize.$slide_media_poster.'</div></div>';
		}elseif(is_array($test) && $test['custom']){
			$current_this = '<div class="current_this">custom</div>';
			$slide_media = '<div class="r_desc">' . $test['custom'] . '</div>';
			$filename = 'Custom Code';
			$self_hosted = get_bloginfo('template_directory')."/framework/admin/superslide/custom-preview.jpg";

			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">'.__('Custom Code', 'flowthemes').'</div><div class="ready_image_desc">'.$current_this.$slide_media.'</div></div>';
		}else{}
	}
}
//$class = shortcode_atts( array('text_color' => '#ffffff', 'image' => '', 'video_vimeo' => '', 'video_youtube' => '', 'video_mp4' => '', 'video_ogg' => '', 'video_webm' => '', 'video_poster' => '', 'slide_desc' => ''), $atts );
?>
			<div style="clear:both;"></div></div>
			<!-- <input type="hidden" id="<?php //echo $name; ?>" name="<?php //echo $name; ?>" value="<?php //echo esc_html( $value ); ?>" /> -->
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.ss-show-code').on('click.show-ss-box', function(){
					if(jQuery('.ss-code-box').hasClass('ss-code-box-visible')){
						jQuery('.ss-code-box').removeClass('ss-code-box-visible');
					}else{
						jQuery('.ss-code-box').addClass('ss-code-box-visible');
					}
				});
			});
			</script>
			<div class="ss-show-code"><?php _e('Click here to display SuperSlide output as raw code', 'flowthemes'); ?></div>
			<textarea class="ss-code-box ss-code-box-visible" id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo esc_html($value); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce(plugin_basename( __FILE__ )); ?>" />
		</div>
	</div>
</div>
</td></tr>
<?php } ?>