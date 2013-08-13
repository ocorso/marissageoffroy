var FU_classname = "flowuploader";
flowuploader = {
	inituploader: function(sel){
		jQuery(sel).each(function(){
			jQuery(this).click(function(){
				var FU_w = jQuery(this).parent(); // this uploader instance full container (wrapper of everything)
				
				// wp.media.send.to.editor will automatically trigger window.send_to_editor for backwards compatibility
				// and therefore call tb_remove() which is not what we want in this case
				
				// backup original window.send_to_editor
				window.original_send_to_editor = window.send_to_editor;

				// override window.send_to_editor
				window.send_to_editor = function(html) {
					// html argument might not be useful in this case
					// use the data from var attachment (attachment) here to make your own ajax call or use data from b and send it back to your defined input fields etc.
					// restore original window.send_to_editor
					window.send_to_editor = window.original_send_to_editor;
				}
				
				// backup of original send function
				var send_attachment_backup = wp.media.editor.send.attachment;
				
				// temporary send function
				wp.media.editor.send.attachment = function(props, attachment){
				
					// Empty current input data
					FU_w.find('.flowuploader_media_preview_image').empty();
					
					if(attachment.type == 'image'){
						var preview_image = jQuery('<img />').attr('src', attachment.url).attr('alt', attachment.alt);
						
						// Add preview image
						FU_w.find('.flowuploader_media_preview_image').empty().append(preview_image).append('<span class="'+FU_classname+'_remove">remove</span>');
					}
					
					// Add attachment URL to input
					FU_w.find('.flowuploader_media_url').val(attachment.url);
					FU_w.find('.flowuploader_media_url').trigger('change');
					
					// Init remove function
					//flowuploader.removeonclick(FU_w.find('.flowuploader_media_preview_image').find('.'+FU_classname+'_remove'));
					
					// restore original send function
					wp.media.editor.send.attachment = send_attachment_backup;
				}
				wp.media.editor.open();
				
				// Init blur function
				var el = jQuery(this).parent().find('.flowuploader_media_url');
				if(el.length){
					flowuploader.reloadimgonblur(el);
					el.blur();
				}
				
				return false;
			});
		});
	},
	reloadimgonblur: function(el){
		jQuery(el).blur(function(){
			var el_val = jQuery(this).val();
			if(el_val){
				if(el_val.match(/(^.*\.jpg|jpeg|png|gif|ico|svg|svgz*)/gi)){
					var preview_container = jQuery(this).parent().find('.flowuploader_media_preview_image');
					if(preview_container.length){
						/* preview_container.empty();
						preview_container.append('<img src="'+el_val+'" alt="" />');
						preview_container.append('<span class="'+FU_classname+'_remove">remove</span>'); */
						
						preview_container.html('<div class="empty-canvas"><p>Image will appear here if its URL above is valid.</p></div><span class="'+FU_classname+'_remove">Remove</span>');
						jQuery('<img />').attr('src', el_val).load(function(){
							var real_width = jQuery(this).get(0).width;
							var real_height = jQuery(this).get(0).height;
							var fileSize = real_width + 'x' + real_height + 'px';
							preview_container.html('<img src="'+el_val+'" alt="" /><span class="'+FU_classname+'_remove">remove</span>');
						});
						//preview_container.html('<img src="'+el_val+'" alt="" /><span class="'+FU_classname+'_remove">remove</span>');
						
						flowuploader.removeonclick(preview_container.find('.'+FU_classname+'_remove'));
					}
				}else{
					var FU_p = jQuery(this).parent().find('.flowuploader_media_preview_image');
					if(FU_p.length){
						FU_p.html("");
					}
				}
			}
		});
	},
	removeonclick: function(el){
		jQuery(el).click(function(){
		
			// Remove URL from input
			var FU_f = jQuery(this).parent().parent().find('.flowuploader_media_url');
			if(FU_f.length){
				FU_f.val("");
			}
			
			// Remove preview image
			var FU_p = jQuery(this).parent().parent().find('.flowuploader_media_preview_image');
			if(FU_p.length){
				FU_p.html("");
			}
			
			// Remove remove button
			if(jQuery(this).length){
				jQuery(this).remove();
			}
			
		});
	},
	remove: function(el){
		el.each(function(){
			// Remove URL from input
			var FU_f = jQuery(this).parent().parent().find('.flowuploader_media_url');
			if(FU_f.length){
				FU_f.val("");
			}
			
			// Remove preview image
			var FU_p = jQuery(this).parent().parent().find('.flowuploader_media_preview_image');
			if(FU_p.length){
				FU_p.html("");
			}
			
			// Remove remove button
			if(jQuery(this).length){
				jQuery(this).remove();
			}
		});
	}
};

jQuery(document).ready(function(){
	// Init blur function
	var el = jQuery('.flowuploader_media_url');
	if(el.length){
		flowuploader.reloadimgonblur(el);
		el.blur();
	}
	// Init remove function
	jQuery(document).on('click', '.flowuploader_remove', function(){
		flowuploader.remove(jQuery(this));
	});
	//flowuploader.removeonclick(jQuery('.flowuploader_media_preview_image').find('.'+FU_classname+'_remove'));
	flowuploader.inituploader('.'+FU_classname+'_upload_button');
});