<?php  function get_meta_slidemanager( $args = array(), $value = false ) {

	extract( $args );
	//$name_color = $name.'_color';
	//$value_color = $value.'_color';
	?>
		<tr>
	
	
<!--	<th style="width:20%;">
	 <label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
	</th> -->
	<td colspan="2">
	
	
	
	<div id="left">
	<div id="content">
		<div id="custom-demo" class="demo">
        <script type="text/javascript">
jQuery(document).ready(function() {
		// Setup html5 version
		try{
	 jQuery("#html5_uploader").pluploadQueue({
		// General settings
		 url : '<?php  bloginfo('template_directory'); ?>/includes/uploadify/upload.php',
		runtimes : 'html5',
		max_file_size : '10mb',
		chunk_size : '1mb',
		rename: true,
		multiple_queues: true,
		//unique_names : true,
		init : {
		'FileUploaded'  : function(b,file,c) {
		//	jQuery('#status-message').text((data.index+1) + ' files uploaded.');
			var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploads/' + file.name;
			/* var fileSize = doUnitConversionbyFlow(data.size);
			var fileName = doShortenNamebyFlow(data.name);

			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc"></div></div>');
			var img = jQuery(jQuery('.ready_image_img').get(0));
			var img_width = img.width();
			var img_height = img.height();
			jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
			setTimeout(function(){
				doImageResizingbyFlow();
			}, 10 ); */
			//var r_color = jQuery('#flow_text_color_image option:selected').val();
			//var r_desc = jQuery('#flow_slide_desc_image').val();
			//var r_media = jQuery('#flow_image').val();
			var slide_color = '<div class="r_color">#ffffff</div>';
			var slide_desc = '<div class="r_desc"></div>'; 
			var current_this = '<div class="current_this">image</div>';
			var slide_media = '<div class="r_media">' + images_path + '</div>';
			
			//var fileSize = doUnitConversionbyFlow(file.size);
			var fileSize = '&nbsp;'+file.name.split('.').pop().toUpperCase();
			var fileName = doShortenNamebyFlow(file.name);
			//var images_path = r_media;
			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
			
			/* var img = jQuery(jQuery('.ready_image_img').get(0));
			var img_width = img.width();
			var img_height = img.height();
			jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
			setTimeout(function(){
				doImageResizingbyFlow();
			}, 10 );
			bindDescriptionsbyflow();
			generateshortcodesbyflow(); */
			var img = jQuery(jQuery('.ready_image_img').get(0));
			img.one('load', function(){
				var img_width = img.width();
			var img_height = img.height();
			//jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
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
	
	/*jQuery("#html5_uploader").bind('FileUploaded', function(up, files) {
		 $.each(files, function(i, file) {
			$('#filelist').append(
				'<div id="' + file.id + '">' +
				file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
			'</div>');
		});

		up.refresh(); // Reposition Flash/Silverlight
		
		alert('done');
	});*/
	
	}catch(e){
		alert('err');
	}
	/*
	
	var resize_height = 1024, resize_width = 1024,
wpUploaderInit = {"runtimes":"html5,silverlight,flash,html4","browse_button":"plupload-browse-button","container":"plupload-upload-ui","drop_element":"drag-drop-area","file_data_name":"async-upload","multiple_queues":true,"max_file_size":"67108864b","url":"http://themes.devatic.com/theagency/wp-admin/async-upload.php","flash_swf_url":"http://themes.devatic.com/theagency/wp-includes/js/plupload/plupload.flash.swf","silverlight_xap_url":"http://themes.devatic.com/theagency/wp-includes/js/plupload/plupload.silverlight.xap","filters":[{"title":"Allowed Files","extensions":"*"}],"multipart":true,"urlstream_upload":true,"multipart_params":{"post_id":0,"_wpnonce":"7e10346e01","type":"","tab":"","short":"1"}};  */
	
	
	
	
	function doImageResizingbyFlow(){
		jQuery(".remove-slide").unbind('click');
		jQuery(".remove-slide").click(function() {
			//var answer = confirm ("Are you sure you want to remove it? You will not be able to restore it.")
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
			//var answer = confirm ("Are you sure you want to remove it? You will not be able to restore it.")
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
	function strrpos (haystack, needle, offset) {
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
	function highlightDescbyflow (current_this) {
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
			var r_media = jQuery('#flow_image').val();
			
			if(r_desc != ''){ highlightDescbyflow(window.main_this); }
			
			window.main_this.find('.r_color').empty().text(r_color);
			window.main_this.find('.r_desc').empty().text(r_desc);
			window.main_this.find('.r_media').empty().text(r_media);
			window.main_this.parent().find('.ready_image_img').attr('src', r_media);
			//var img_current = jQuery("#flow_image").val();
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
			var r_media = jQuery('#flow_video_youtube').val();
			
			if(r_desc != ''){ highlightDescbyflow(window.main_this); }
			
			window.main_this.find('.r_color').empty().text(r_color);
			window.main_this.find('.r_desc').empty().text(r_desc);
			window.main_this.find('.r_media').empty().text(r_media);

			tb_remove();
			generateshortcodesbyflow();
	}	
	function addVimeoSlideDatabyFlow(){
			var r_color = jQuery('#flow_text_color_vimeo option:selected').val();
			var r_desc = jQuery('#flow_slide_desc_vimeo').val();
			var r_media = jQuery('#flow_video_vimeo').val();
			
			if(r_desc != ''){ highlightDescbyflow(window.main_this); }
			
			window.main_this.find('.r_color').empty().text(r_color);
			window.main_this.find('.r_desc').empty().text(r_desc);
			window.main_this.find('.r_media').empty().text(r_media);

			tb_remove();
			generateshortcodesbyflow();
	}	
	function addVideoSlideDatabyFlow(){
			var r_color = jQuery('#flow_text_color_video option:selected').val();
			var r_desc = jQuery('#flow_slide_desc_video').val();
			var r_media_ogg = jQuery('#flow_video_ogg').val();
			var r_media_webm = jQuery('#flow_video_webm').val();
			var r_media_mp4 = jQuery('#flow_video_mp4').val();
			var r_media_poster = jQuery('#flow_video_poster').val();
			
			if(r_desc != ''){ highlightDescbyflow(window.main_this); }
			
			window.main_this.find('.r_color').empty().text(r_color);
			window.main_this.find('.r_desc').empty().text(r_desc);
			window.main_this.find('.r_media_ogg').empty().text(r_media_ogg);
			window.main_this.find('.r_media_webm').empty().text(r_media_webm);
			window.main_this.find('.r_media_mp4').empty().text(r_media_mp4);
			window.main_this.find('.r_media_poster').empty().text(r_media_poster);

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
				options['slide_desc'] = jQuery(this).find(".r_desc").text();
				options['text_color'] = jQuery(this).find(".r_color").text();
			}else if(current_this == 'video'){
				options['video_mp4'] = jQuery(this).find(".r_media_mp4").text();
				options['video_ogg'] = jQuery(this).find(".r_media_ogg").text();
				options['video_webm'] = jQuery(this).find(".r_media_webm").text();
				options['video_poster'] = jQuery(this).find(".r_media_poster").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").text();
				options['text_color'] = jQuery(this).find(".r_color").text();
			}else if(current_this == 'vimeo'){
				options['video_vimeo'] = jQuery(this).find(".r_media").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").text();
				options['text_color'] = jQuery(this).find(".r_color").text();
			}else if(current_this == 'youtube'){
				options['video_youtube'] = jQuery(this).find(".r_media").text();
				options['slide_desc'] = jQuery(this).find(".r_desc").text();
				options['text_color'] = jQuery(this).find(".r_color").text();
			}
			
			var shortcode = '[slide';
			for( var index in options) {
			var value = options[index];
				while(value.indexOf('"') != -1){
					value = value.replace('"','*');
				}
				//if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			shortcode += ']';
			shortcode_output += shortcode;
		});
		jQuery("#<?php  print($name); ?>").val(shortcode_output);
	}
	generateshortcodesbyflow();
	function performClearFormsbyFlow(){
		//jQuery('.r_color').empty();
		jQuery('#flow_slide_desc_image').val('');
		jQuery('#flow_slide_desc_video').val('');
		jQuery('#flow_slide_desc_vimeo').val('');
		jQuery('#flow_slide_desc_youtube').val('');
		jQuery('#flow_video_youtube').val('');
		jQuery('#flow_video_vimeo').val('');
		jQuery('#flow_image').val('');
		jQuery('#flow_video_ogg').val('');
		jQuery('#flow_video_webm').val('');
		jQuery('#flow_video_mp4').val('');
		jQuery('#flow_video_poster').val('');
		jQuery('.briskuploader_preview_popup').empty();
	}
	function performBriskUploaderImageShow(){
		var briskuploader_fval = jQuery("#flow_image").val();
		var briskuploader_p = jQuery(".briskuploader_preview_popup");
briskuploader_p.html("<img src=\""+briskuploader_fval+"\"></img><br><span class=\"briskuploader_remove\">remove</span>");
						briskuploader.removeonclick(briskuploader_p.find(".briskuploader_remove"));
/*
			if(briskuploader_fval){
				if(briskuploader_fval.match(/(^.*\.jpg|jpeg|png|gif|ico*)/gi)){
					var briskuploader_p = jQuery(".briskuploader_preview_popup");
					if(briskuploader_p.length){
						briskuploader_p.html("<img src=\""+briskuploader_fval+"\"></img><br><span class=\"briskuploader_preview_popup_remove\">remove</span>");
						briskuploader.removeonclick(briskuploader_p.find(".briskuploader_preview_popup_remove"));
					}
				}else{
					var briskuploader_p = jQuery(".briskuploader_preview_popup");
					if(briskuploader_p.length){
						briskuploader_p.html("");
					}
				}
			} */
	}
	function addImageSlideDataIconbyFlow(){
		//var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/vimeo-preview.jpg';

		//var fileSize = doUnitConversionbyFlow(data.size);
		//var fileSize = '&nbsp;JPG';
		
		var r_color = jQuery('#flow_text_color_image option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_image').val();
		var r_media = jQuery('#flow_image').val();
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">image</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }
		
		var fileName = doShortenNamebyFlow('image-preview');
		var images_path = r_media;
		var fileSize = '&nbsp;'+images_path.split('.').pop().toUpperCase();

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
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
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/video-preview.jpg';

		//var fileSize = doUnitConversionbyFlow(data.size);
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
		//setTimeout(function(){
			//doImageResizingbyFlow();
		//}, 10 );
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	function addVimeoSlideDataIconbyFlow(){
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/vimeo-preview.jpg';

		//var fileSize = doUnitConversionbyFlow(data.size);
		var fileSize = 'External';
		var fileName = doShortenNamebyFlow('Vimeo Slide');
		
		var r_color = jQuery('#flow_text_color_vimeo option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_vimeo').val();
		var r_media = jQuery('#flow_video_vimeo').val();
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">vimeo</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
		//setTimeout(function(){
		//	doImageResizingbyFlow();
		//}, 10 );
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	function addYoutubeSlideDataIconbyFlow(){
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/youtube-preview.jpg';

		//var fileSize = doUnitConversionbyFlow(data.size);
		var fileSize = 'External';
		var fileName = doShortenNamebyFlow('YouTube Slide');
		
		var r_color = jQuery('#flow_text_color_youtube option:selected').val();
		var r_desc = jQuery('#flow_slide_desc_youtube').val();
		var r_media = jQuery('#flow_video_youtube').val();
		var slide_color = '<div class="r_color">' + r_color + '</div>';
		var slide_desc = '<div class="r_desc">' + r_desc + '</div>'; 
		var current_this = '<div class="current_this">youtube</div>';
		var slide_media = '<div class="r_media">' + r_media + '</div>';
		
		if(r_desc != ''){ var deschighlight = 'ready_image_desc_active'; }

		jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc '+deschighlight+'">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
		//setTimeout(function(){
		//	doImageResizingbyFlow();
		//}, 10 );
		bindDescriptionsbyflow();
		tb_remove();
		generateshortcodesbyflow();
	}
	
	function printThickBoxesbyFlow(){
		var form_image = jQuery('<div id="image-form"><table id="image-table" class="form-table">\
			<tr>\
				<th><label for="image">Image slide link</label></th>\
				<td><input type="text" name="image" id="flow_image" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify image URL here. Leave blank if you want to use a video.</small>\
			</tr>\
			<tr>\
				<th><label for="text_color">Text color (and cursor color)</label></th>\
				<td><select name="text_color" id="flow_text_color_image">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide description (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_image" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. A few words or one sentence are recommended.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="image-submit" class="button-primary" value="Insert Image" name="submit" />\
		</p>\
		</div>');
		var form_video = jQuery('<div id="video-form"><table id="video-table" class="form-table">\
			<tr>\
				<th><label for="video-mp4">Video slide (MP4)</label></th>\
				<td><input type="text" name="video-mp4" id="flow_video_mp4" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video URL here (*.mp4). Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr>\
				<th><label for="video-ogg">Video slide (Ogg) (*.ogv)</label></th>\
				<td><input type="text" name="video-ogg" id="flow_video_ogg" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video URL here (*.ogv). Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr>\
				<th><label for="video-webm">Video slide (WebM)</label></th>\
				<td><input type="text" name="video-webm" id="flow_video_webm" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video URL here (*.webm). Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr class="form-table">\
				<th><label for="video-poster">Video poster</label></th>\
				<td><input type="text" name="video-poster" id="flow_video_poster" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played.</small>\
			</tr>\
			<tr>\
				<th><label for="text_color">Text color (and cursor color)</label></th>\
				<td><select name="text_color" id="flow_text_color_video">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide description (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_video" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. A few words or one sentence are recommended.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="video-submit" class="button-primary" value="Insert Video" name="submit" />\
		</p>\
		</div>');				
		var form_vimeo = jQuery('<div id="vimeo-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-vimeo">Vimeo video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-vimeo" id="flow_video_vimeo" value="" /><br />\
				<small>Specify Vimeo video embed code here. Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr>\
				<th><label for="text_color">Text color (and cursor color)</label></th>\
				<td><select name="text_color" id="flow_text_color">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide description (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_vimeo" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. A few words or one sentence are recommended.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="vimeo-submit" class="button-primary" value="Insert Video" name="submit" />\
		</p>\
		</div>');				
		var form_youtube = jQuery('<div id="youtube-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-youtube">YouTube video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-youtube" id="flow_video_youtube" value="" /><br />\
				<small>Specify YouTube video embed code here. Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr>\
				<th><label for="text_color">Text color (and cursor color)</label></th>\
				<td><select name="text_color" id="flow_text_color_youtube">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide description (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_youtube" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. A few words or one sentence are recommended.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="youtube-submit" class="button-primary" value="Insert Video" name="submit" />\
		</p>\
		</div>');

		form_image.appendTo('body').hide();
		form_video.appendTo('body').hide();
		form_vimeo.appendTo('body').hide();
		form_youtube.appendTo('body').hide();
		
		try{
			briskuploader.inituploader();
		}catch(e){alert('uploader error');}
		
		jQuery(".image-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( 'Add Image Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
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
			tb_show( 'Add Self-hosted Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
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
			tb_show( 'Add Vimeo Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=vimeo-form' );
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
			tb_show( 'Add YouTube Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=youtube-form' );
			var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
			jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
			jQuery("#youtube-submit").unbind('click');
			jQuery("#youtube-submit").click(function() {
				addYoutubeSlideDataIconbyFlow();
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
				var r_desc = jQuery(this).find('.r_desc').text();
				var r_media = jQuery(this).find('.r_media').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Image Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
				jQuery('#flow_image').val(r_media);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_image').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_image').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_image').val(r_desc);
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
				var r_desc = jQuery(this).find('.r_desc').text();
				var r_media = jQuery(this).find('.r_media').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit YouTube Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=youtube-form' );
				jQuery('#flow_video_youtube').val(r_media);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_youtube').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_youtube').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_youtube').val(r_desc);
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#youtube-submit").unbind('click');
				jQuery("#youtube-submit").click(function() {
					addYoutubeSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "vimeo"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').text();
				var r_media = jQuery(this).find('.r_media').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Vimeo Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=vimeo-form' );
				jQuery('#flow_video_vimeo').val(r_media);
				if(r_color == '#ffffff' || r_color == ''){
					jQuery(jQuery('#flow_text_color_vimeo').removeAttr('selected').find('option').get(0)).attr('selected', 'selected');
				}else if(r_color == '#464646'){
					jQuery(jQuery('#flow_text_color_vimeo').removeAttr('selected').find('option').get(1)).attr('selected', 'selected');
				}
				jQuery('#flow_slide_desc_vimeo').val(r_desc);
				var height_main = jQuery("#TB_window").height()-45+"px"; var height_main = 'auto';
				jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				jQuery("#vimeo-submit").unbind('click');
				jQuery("#vimeo-submit").click(function() {
					addVimeoSlideDatabyFlow();
				});
			}else if(jQuery(this).find(".current_this").text() == "video"){
				window.main_this = jQuery(this);
				var r_color = jQuery(this).find('.r_color').text();
				var r_desc = jQuery(this).find('.r_desc').text();
				var r_media_ogg = jQuery(this).find('.r_media_ogg').text();
				var r_media_webm = jQuery(this).find('.r_media_webm').text();
				var r_media_mp4 = jQuery(this).find('.r_media_mp4').text();
				var r_media_poster = jQuery(this).find('.r_media_poster').text();
				var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				W = W - 80;
				H = H - 104;
				tb_show( 'Edit Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
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
			}
		});
	}

	printThickBoxesbyFlow();
	//addSlideDatabyFlow();
			
	/* jQuery('#upload-image').uploadify({
		'swf' 		   		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.swf',
		'uploader' 	   		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.php',
		'cancelImage'      	: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify-cancel.png',
		'multi'          	: true,
		'auto'           	: true,
		'fileTypeExts'      : '*.jpg;*.gif;*.png',
		'fileTypeDesc'      : 'Image Files (.JPG, .GIF, .PNG)',
		'queueID'        	: 'custom-queue',
		'queueSizeLimit' 	: 50,
		'simUploadLimit' 	: 3,
		'sizeLimit'   		: 102400,
		'removeCompleted'	: false,
		'onSelect'   		: function(data) {
			jQuery('#status-message').text((data.index+1) + ' files have been added to the queue.');
		},
		'onUploadComplete'  : function(data) {
			jQuery('#status-message').text((data.index+1) + ' files uploaded.');
			var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploads/' + data.name;
			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + data.name + '</div></div>');
			doImageResizingbyFlow();
		}
	});
	jQuery('#upload-video').uploadify({
		'swf' 		   		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.swf',
		'uploader' 	   		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.php',
		'cancelImage'      	: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify-cancel.png',
		'multi'          	: true,
		'auto'           	: true,
		'fileTypeExts'      : '*.ogg;*.webm;*.mp4',
		'fileTypeDesc'      : 'Movie Files (.OGG, .WEBM, .MP4)',
		'queueID'        	: 'custom-queue',
		'queueSizeLimit' 	: 50,
		'simUploadLimit' 	: 3,
		'sizeLimit'   		: 102400,
		'removeCompleted'	: false,
		'onSelect'   		: function(data) {
			jQuery('#status-message').text((data.index+1) + ' files have been added to the queue.');
		},
		'onUploadComplete'  : function(data) {
			jQuery('#status-message').text((data.index+1) + ' files uploaded.');
			var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploads/' + data.name;
			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + data.name + '</div></div>');
			doImageResizingbyFlow();
		}
	}); */
	jQuery('#custom_file_upload').uploadify({
		'swf' 		   		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.swf',
		'uploader' 	  		: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify.php',
		'cancelImage'   	: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploadify-cancel.png',
		'buttonImage'    	: '<?php  bloginfo('template_directory'); ?>/includes/uploadify/select-files.png',
		'multi'        		: true,
		'auto'           	: true,
		'fileTypeExts'      : '*.jpg;*.gif;*.png;*.ogg;*.webm;*.mp4',
		'fileTypeDesc'   	: 'Media Files (.JPG, .GIF, .PNG, .OGG, .WEBM, .MP4)',
		'queueID'        	: 'custom-queue',
		'queueSizeLimit' 	: 50,
		'simUploadLimit' 	: 3,
		'sizeLimit'   		: 102400,
		'width'         	: 150,
		'height'			: 50,
		'removeCompleted'	: false,
		'onSelect'   		: function(data) {
			jQuery('#status-message').text((data.index+1) + ' files have been added to the queue.');
		},
		'onUploadComplete'  : function(data) {
			jQuery('#status-message').text((data.index+1) + ' files uploaded.');
			var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploads/' + data.name;

			/* var fileSize = doUnitConversionbyFlow(data.size);
			var fileName = doShortenNamebyFlow(data.name);

			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc"></div></div>');
			var img = jQuery(jQuery('.ready_image_img').get(0));
			var img_width = img.width();
			var img_height = img.height();
			jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
			setTimeout(function(){
				doImageResizingbyFlow();
			}, 10 ); */
			//var r_color = jQuery('#flow_text_color_image option:selected').val();
			//var r_desc = jQuery('#flow_slide_desc_image').val();
			//var r_media = jQuery('#flow_image').val();
			var slide_color = '<div class="r_color">#ffffff</div>';
			var slide_desc = '<div class="r_desc"></div>'; 
			var current_this = '<div class="current_this">image</div>';
			var slide_media = '<div class="r_media">' + images_path + '</div>';
			
			var fileSize = doUnitConversionbyFlow(data.size);
			var fileName = doShortenNamebyFlow(data.name);
			//var images_path = r_media;

			jQuery('#ready_images').prepend('<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" src="' + images_path + '" alt="" /></div><div class="ready_image_title">' + fileName + '</div><div class="ready_image_size">' + fileSize + '</div><div class="ready_image_desc">'+current_this+slide_desc+slide_color+slide_media+'</div></div>');
			var img = jQuery(jQuery('.ready_image_img').get(0));
			var img_width = img.width();
			var img_height = img.height();
			jQuery(jQuery(".ready_image_title").get(0)).append('<div class="ready_image_size">' + img_width + 'x' + img_height + 'px</div>');
			setTimeout(function(){
				doImageResizingbyFlow();
			}, 10 );
			bindDescriptionsbyflow();
			generateshortcodesbyflow();
		}
	});
});
</script>
<div class="demo-box">
	<!--<div class="select-area">
		<div class="drop-files-container"><span class="drop-files">DROP FILES HERE OR</span> <input id="custom_file_upload" type="file" name="Filedata" /><div class="clear"></div></div>
	</div>-->
	<div class="ready_images_heading">
		<div id="status-message">Upload Files</div>
	</div>
	<div id="html5_uploader">You browser doesn't support native upload. Try Firefox 3 or Safari 4.</div>
	<div id="custom-queue"></div>
	<div class="ready_images_heading">
		<div id="status-message">Slide management</div>
		<div class="separator-icon"></div>
		<!--<div class="image-icon"><a id="upload-image" class="icon-link" href="javascript:void(null);"></a></div>-->
		<div class="image-icon"><a id="upload-image" class="icon-link" href="javascript:void(null);" title="Add Image Slide"></a></div>
		<!--<div class="video-icon"><a id="upload-video" class="icon-link" href="javascript:void(null);"></a></div>-->
		<div class="video-icon"><a id="upload-video" class="icon-link" href="javascript:void(null);" title="Add Self-hosted Video"></a></div>
		<div class="vimeo-icon"><a class="icon-link" href="javascript:void(null);" title="Add Vimeo Video"></a></div>
		<div class="youtube-icon"><a class="icon-link" href="javascript:void(null);" title="Add YouTube Video"></a></div>
		<div class="separator-icon"></div>
		<div class="shuffle-icon" title="Shuffle Slides"><a class="icon-link" href="javascript:void(null);" title="Shuffle Slides"></a></div>
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
		if($test['text_color']){ $slide_color = '<div class="r_color">' . $test['text_color'] . '</div>'; }else{ $slide_color = '<div class="r_color">#ffffff</div>'; }
		if($test['slide_desc']){ $slide_desc = '<div class="r_desc">' . $test['slide_desc'] . '</div>'; }else{ $slide_desc = '<div class="r_desc"></div>'; }
		if($test['image']){
			$current_this = '<div class="current_this">image</div>';
			$filename = substr($test['image'],strrpos($test['image'], "/")+1);
			$filename = substr_replace($filename , '', strrpos($filename , '.'));
			if (strlen($filename) > 15) {
				$filename = substr($filename, 0, 15) . '...';
			}
			$image_info = getimagesize($test['image']);
			$slide_media = '<div class="r_media">' . $test['image'] . '</div>';
			if($image_info['mime'] == "image/jpeg"){ $image_info['mime'] = "&nbsp;JPG"; }else if($image_info['mime'] == "image/png"){ $image_info['mime'] = "&nbsp;PNG"; }else if($image_info['mime'] == "image/gif"){ $image_info['mime'] = "&nbsp;GIF"; }
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $test['image'] . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">' . $image_info[0] . 'x' . $image_info[1] . 'px</div><div class="ready_image_size">' . $image_info['mime'] . '</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.'</div></div>';
		}elseif($test['video_mp4'] || $test['video_ogg'] || $test['video_webm']){
			$current_this = '<div class="current_this">video</div>';
			$slide_media_mp4 = '<div class="r_media_mp4">' . $test['video_mp4'] . '</div>';
			$slide_media_ogg = '<div class="r_media_ogg">' . $test['video_ogg'] . '</div>';
			$slide_media_webm = '<div class="r_media_webm">' . $test['video_webm'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = substr($test['video_mp4'],strrpos($test['video_mp4'], "/")+1);
			if($image_info = getimagesize($test['video_mp4'])){}else if($image_info = getimagesize($test['video_ogg'])){}else{$image_info = getimagesize($test['video_webm']);}
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/video-preview.jpg";
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">Internal</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media_mp4.$slide_media_ogg.$slide_media_webm.$slide_media_poster.'</div></div>';
		}elseif($test['video_vimeo']){
			$current_this = '<div class="current_this">vimeo</div>';
			$slide_media = '<div class="r_media">' . $test['video_vimeo'] . '</div>';
			$filename = 'Vimeo Slide';
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/vimeo-preview.jpg";
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">External</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.'</div></div>';
		}elseif($test['video_youtube']){
			$current_this = '<div class="current_this">youtube</div>';
			$slide_media = '<div class="r_media">' . $test['video_youtube'] . '</div>';
			$filename = 'YouTube Slide';
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/youtube-preview.jpg";
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">External</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.'</div></div>';
		}else{}
	}
}
//$class = shortcode_atts( array('text_color' => '#ffffff', 'image' => '', 'video_vimeo' => '', 'video_youtube' => '', 'video_mp4' => '', 'video_ogg' => '', 'video_webm' => '', 'video_poster' => '', 'slide_desc' => ''), $atts );
?>
			<div style="clear:both;"></div></div>
			<input type="hidden" id="<?php  echo $name; ?>" name="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>" />
			<input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</div>
	</div>
</div>
</td></tr>
<?php 	} ?>