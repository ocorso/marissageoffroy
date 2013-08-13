// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.mygallery', {
		// creates control instances based on the control's id.
		// our button's id is "mygallery_button"
		//createControl : function(id, controlManager) {
			//if (id == 'mygallery_button') {
				// creates the button
				//var button = controlManager.createButton('mygallery_button', {
				//	title : 'Insert slide', // title of the button
					//image : '../wp-includes/images/smilies/icon_mrgreen.gif',  // path to the button's image
				//	image : '../wp-content/themes/theagency/addSlide/wand.png',  // path to the button's image
				//	onclick : function() {
						// triggers the thickbox
				//		var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
				//		W = W - 80;
				//		H = H - 84;
				//		tb_show( 'My Gallery Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=mygallery-form' );
						//jQuery("#mygallery-table").css({"width": W, "height" : H, "overflow-x" : "hidden" });
				//		var height_main = jQuery("#TB_window").height()-45+"px";
						jQuery("#TB_ajaxContent").css({"width": W, "height" : height_main, "overflow-x" : "hidden" });
				//	}
				//});
				//return button;
			//}
			return null;
		//}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('mygallery', tinymce.plugins.mygallery);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<style type="text/css">.briskuploader_preview_popup img, #mygallery-table .briskuploader_preview img { max-width:300px!important; } </style> <div id="mygallery-form"><table id="mygallery-table" class="form-table">\
			<!--<tr>\
				<th><label for="text_color">Text color</label></th>\
				<td><input type="text" id="flow_text_color" name="text_color" value="#ffffff" /><br />\
				<small>Specify the slide text color. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\-->\
			<tr>\
				<th><label for="image">Image slide link</label></th>\
				<td><input type="text" name="image" id="flow_image" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify image URL here. Leave blank if you want to use a video.</small>\
			</tr>\
			<tr>\
				<th><label for="video-vimeo">Vimeo video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-vimeo" id="flow_video_vimeo" value="" /><br />\
				<small>Specify Vimeo video embed code here. Leave blank if you want to use image or different video format.</small>\
			</tr>\
			<tr>\
				<th><label for="video-youtube">YouTube video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-youtube" id="flow_video_youtube" value="" /><br />\
				<small>Specify YouTube video embed code here. Leave blank if you want to use image or different video format.</small>\
			</tr>\
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
				<td><select name="text_color" id="flow_text_color">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide description (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. A few words or one sentence are recommended.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="mygallery-submit" class="button-primary" value="Insert Slide" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('.form-table');
		form.appendTo('body').hide();
		try{
			briskuploader.inituploader();
		}catch(e){alert('uploader error');}
		//jQuery('.briskuploader').click(function(){
		//	jQuery('.briskuploader_preview briskuploader_preview_popup img').css({ 'max-width' : '300px!important' });
		//	jQuery('#TB_iframeContent').css({ 'top' : '0px', 'position' : 'absolute'});
		//	jQuery('#TB_window #TB_title').next().css({ 'top' : '30px', 'position' : 'absolute'});
		//});
		
		// handles the click event of the submit button
		form.find('#mygallery-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'text_color'    : '#ffffff',
				'image'         : '',
				'video_vimeo'   : '',
				'video_youtube' : '',
				'video_mp4'     : '',
				'video_ogg'     : '',
				'video_webm'    : '',
				'video_poster'  : '',
				'slide_desc' : ''
				};
			var shortcode = '<p>[slide';
			
			for( var index in options) {
				//var value = table.find('#flow_' + index).val(); //briskuploader clone table
				var value = jQuery('#flow_' + index).val();
				while(value.indexOf('"') != -1){
					value = value.replace('"','*');
				}
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']</p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()