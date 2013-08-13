<script type="text/javascript">
	function clearForms(form){
		jQuery('.ss_form_wrapper').find('input[type!="button"][type!="submit"][type!="reset"], textarea').each(function(){
			jQuery(this).val('');
			jQuery(this).removeAttr('checked');
			jQuery(this).trigger('change');
		});
		jQuery('.ss_form_wrapper').find('.flowuploader_media_preview_image').empty();
	}
	function removeTile(tile){
		jQuery(tile).find('.remove-slide').unbind('click.remove_slide');
		delete objectForEverything[jQuery(tile).attr('data-number')];
		jQuery(tile).remove();
		
		var newObjectForEverything = {};
		var i = 0;
		jQuery('.ready_image').each(function(){
			newObjectForEverything[i] = objectForEverything[jQuery(this).attr('data-number')];
			jQuery(this).attr('data-number', i);
			i++;
		});
		objectForEverything = newObjectForEverything;
		generateShortcodes();
		
		//var answer = confirm ("<?php _e('Are you sure you want to remove it? You will not be able to restore it.', 'flowthemes'); ?>")
		//if (answer) {
			/* jQuery(this).parent().fadeOut(300, function(){
				jQuery(this).remove();
			}); */
		//}else{ }
		
	}
	function doImageResizingbyFlow(ss_thumbnail_path, img){
		if(ss_thumbnail_path == ''){
			var img = jQuery(jQuery('.ready_image_img').get(0));
			var img_size = jQuery(jQuery('.ready_image_size').get(0));
			var img_width = img.width();
			var img_height = img.height();
			img_size.empty().text(img_width + 'x'+ img_height +'px');
			doResizing(img_width, img_height, img);
		}else{
			jQuery('<img />').attr('src', ss_thumbnail_path).load(function(){
				var img_width = jQuery(this).get(0).width;
				var img_height = jQuery(this).get(0).height;
				var fileSize = ' ' + img_width + 'x' + img_height + 'px';
				//jQuery('#'+form['prefix']+'_ready_image .ready_image_img').addClass('ready_image_img-visible');
				doResizing(img_width, img_height, img);
			});
		}
		function doResizing(img_width, img_height, img){
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
			img.addClass('ready_image_img-visible');
		}
	}
	function doAllImageResizingbyFlow(){
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
	function generateShortcodes(){
		//finally... :)
		/* Object
			0: Object
				slide_desc: "<h4>test</h4>"
				slide_noresize: "false"
				text_color: "#ffffff"
				video_poster: "http://themes.devatic.com/konzept/wp-content/uploads/2012/05/shapesinmotion.jpg"
				video_youtube: "http://www.youtube.com/watch?v=xmgQR2oZ9qk" */
		var JSONstr = JSON.stringify(objectForEverything);
	
		/* var shortcode_output = '';
		jQuery.each(objectForEverything, function(key, value){
			if(value['type'] == 'custom'){
				var CSSClass = '';
				if('css_class' in value){
					var CSSClass = value['css_class'];
				}
				var shortcode = '<div class="myimage '+CSSClass+'">';
					shortcode += value['custom'];
				shortcode += '</div>';
				shortcode += "\n\n";
			}else{
				var shortcode = '[slide';
				jQuery.each(value, function(field_name, field_value){
					if(field_value != ''){
						shortcode += ' ' + field_name + '="' + field_value + '"';
					}
				});
				shortcode += ']';
				shortcode += "\n\n";
			}
			
			shortcode_output += shortcode;
		}); */
		//var final_output = {};
		//final_output[0] = JSONstr;
		//final_output[1] = shortcode_output;
		//jQuery("#<?php print($name); ?>").val(JSON.stringify(final_output));
		//jQuery("#<?php //print($name); ?>").val(JSONstr+'(a2d3f9separator)'+shortcode_output);
		jQuery("#<?php print($name); ?>").val(JSONstr);
		bindEdit();
	}
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
</script>