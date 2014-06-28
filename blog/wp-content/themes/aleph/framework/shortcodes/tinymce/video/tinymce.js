function insertShortcode() {
	
	var shortcodeText;
	var shortcodeId = document.getElementById('video_id').value;
	var shortcodeSite = document.getElementById('video_site').value;
	
	shortcodeText = '<br />[video_embed id="' + shortcodeId + '" site="'+shortcodeSite+'"]<br />';
		
	if ( shortcodeId == 0 ){
			tinyMCEPopup.close();
		}	
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
