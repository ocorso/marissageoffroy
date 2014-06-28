<?php 

add_action( 'admin_menu', 'flowthemes_create_shortcode_meta_box' );

function flowthemes_create_shortcode_meta_box(){
	global $theme_name;

	add_meta_box( 'shortcode-meta-box', __('Shortcode generator', 'flowthemes'), 'flowthemes_shortcode_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'shortcode-meta-box', __('Shortcode generator', 'flowthemes'), 'flowthemes_shortcode_meta_boxes', 'page', 'normal', 'high' );
}

function flowthemes_shortcode_meta_boxes(){
	
	$shortcode_boxes = array(
		'youtube' => array(
			'title' => __('YouTube Video', 'flowthemes'),
			'type' => 'shortcode',
			'fields' => array(
				__('YouTube Video Link', 'flowthemes') => array( 0 => 'input', 1 => 'link', 2 => __('Put your YouTube link here. Allowed formats include standard link or video ID.', 'flowthemes'), 3 => 'required' )
			)
		),	
		'vimeo' => array(
			'title' => __('Vimeo Video', 'flowthemes'),
			'type' => 'shortcode',
			'fields' => array(
				__('Vimeo Video Link', 'flowthemes') => array( 0 => 'input', 1 => 'link', 2 => __('Put your Vimeo link here. Allowed formats include standard link or video ID.', 'flowthemes'), 3 => 'required' )
			)
		),		
		'highlight' => array(
			'title' => __('Highlight', 'flowthemes'),
			'type' => 'shortcode-enclosed',
			'fields' => array(
				__('Highlight Text Color', 'flowthemes') => array( 0 => 'colorpicker', 1 => 'color', 2 => __('Highlight text color', 'flowthemes'), 3 => 'optional' ),
				__('Highlight Background Color', 'flowthemes') => array( 0 => 'colorpicker', 1 => 'bgcolor', 2 => __('Highlight background color', 'flowthemes'), 3 => 'optional' )
			)
		),		
		'video' => array(
			'title' => __('HTML5 Video', 'flowthemes'),
			'type' => 'shortcode',
			'fields' => array(
				__('MP4 File', 'flowthemes') => array( 0 => 'upload', 1 => 'mp4', 2 => __('Link to *.mp4 version of your video.', 'flowthemes'), 3 => 'required' ),
				__('OGG File', 'flowthemes') => array( 0 => 'upload', 1 => 'ogg', 2 => __('Link to *.ogg version of your video.', 'flowthemes'), 3 => 'required' ),
				__('WEBM File', 'flowthemes') => array( 0 => 'upload', 1 => 'webm', 2 => __('Link to *.webm version of your video.', 'flowthemes'), 3 => 'required' ),
				__('Poster', 'flowthemes') => array( 0 => 'upload', 1 => 'poster', 2 => __('Poster image', 'flowthemes'), 3 => 'optional' )
			)
		),	
		'gmap' => array(
			'title' => __('Google Map', 'flowthemes'),
			'type' => 'shortcode',
			'fields' => array(
				__('Latitude', 'flowthemes') => array( 0 => 'input', 1 => 'latitude', 2 => __('Latitude of the location.', 'flowthemes'), 3 => 'required' ),
				__('Longitude', 'flowthemes') => array( 0 => 'input', 1 => 'longitude', 2 => __('Longitude of the location.', 'flowthemes'), 3 => 'required' ),
				__('Zoom', 'flowthemes') => array( 0 => 'input', 1 => 'zoom', 2 => __('Choose zoom. It should be number from 1 to around 15.', 'flowthemes'), 3 => 'optional' ),
				__('Width', 'flowthemes') => array( 0 => 'input', 1 => 'width', 2 => __('Width of the map (recommended 100%).', 'flowthemes'), 3 => 'optional' ),
				__('Height', 'flowthemes') => array( 0 => 'input', 1 => 'height', 2 => __('Height of the map (recommended around 350px).', 'flowthemes'), 3 => 'optional' )
			)
		),
		'toggle' => array(
			'title' => __('Toggle Content', 'flowthemes'),
			'type' => 'shortcode-enclosed',
			'fields' => array(
				__('Title', 'flowthemes') => array( 0 => 'input', 1 => 'title', 2 => __('Toggle title.', 'flowthemes'), 3 => 'required' ),
				__('Type', 'flowthemes') => array( 0 => 'input', 1 => 'type', 2 => __('1 or empty = normal toggle, 2 = FAQ style toggle', 'flowthemes'), 3 => 'optional' ),
				__('Opened on Start', 'flowthemes') => array( 0 => 'input', 1 => 'open', 2 => __('0 or empty = closed, 1 = opened', 'flowthemes'), 3 => 'optional' ),
			)
		),
	);
	?>
<table class="form-table">
	<tr>
		<th style="width:20%;">
			<label for="shortcode_editor"><?php _e('Shortcode Generator', 'flowthemes'); ?></label>
		</th>
		<td>
			<?php _e("Shortcode Generator is a tool that enables you to quickly insert Shortcodes (YouTube Videos, Highlighted text etc.) to the Editor above. <ol><li>Some shortcodes require that you select some text prior to inserting shortcode (they allow enclosed content). Example: [highlight]required enclosed content[/highlight] - select some content in Editor prior to sending this shortcode.</li><li>Other shortcodes don't allow enclosed content, so it's enough to place your mouse cursor there where you want to insert such shortcode. Example: [youtube link=\"\"] - it's single tag Shortcode, it doesn't allow enclosed content.</li></ol>", "flowthemes"); ?>
			<select name="" id="flow-shortcode-select" class="flow-shortcode-select" onChange="pickShortcodeFieldsSet(this)">
			<option value="0"><?php _e("--- Please Select Shortcode ---", "flowthemes"); ?></option>
			<?php $shortcode_options = '';
			$fields = '';
			foreach($shortcode_boxes as $shortcode_box_key => $shortcode_box_value){
				$shortcode_options .= '<option value=".flow-shortcode-set-'.$shortcode_box_key.'">'.$shortcode_box_value['title'].'</option>';
				
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

			} ?>
			<?php echo $shortcode_options; ?>
			</select>
			<?php echo $fields; ?>
			<input id="send-shortcode" type="button" class="button-primary" value="<?php _e("Send Shortcode to Editor", "flowthemes"); ?>" />
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#send-shortcode").click(function(){
					if(jQuery('#content').length == 0){ alert('<?php _e(addslashes("The script couldn't find content textarea. Where did it go?"), "flowthemes"); ?>'); return; }
					var current_shortcode = jQuery("#flow-shortcode-select").val();
					if(current_shortcode == 0){ return; }
					var current_shortcode_name = jQuery(current_shortcode).attr("data-shortcode");
					var current_shortcode_type = jQuery(current_shortcode).attr("data-shortcodetype");
					var text_to_insert = "["+current_shortcode_name;
					var break_function = false;
					jQuery(current_shortcode).find(".flow-shortcode-field-container").each(function(){
						var current_input_name = jQuery(this).find(".flow-shortcode-field input").attr("name");
						var current_input_value = jQuery(this).find(".flow-shortcode-field input").val();
						
						/* Check if required fields are filled */
						if(break_function){ return; }
						if(jQuery(this).find(".flow-shortcode-field").hasClass('flow-shortcode-field-required') && current_input_value.length == 0){ break_function = true; return; }else{ break_function = false; }
						if(current_input_value.length == 0){ }else{
							text_to_insert += " "+current_input_name+"=\""+current_input_value+"\"";
						}
					});
					if(break_function){ alert('<?php _e(addslashes("Please fill in required fields for this shortcode."), "flowthemes"); ?>'); return; }
					text_to_insert += "]";
					try{
						if((isTextSelected(jQuery('#content').get(0)) && current_shortcode_type == 'shortcode-enclosed') || current_shortcode_type == 'shortcode-enclosed'){
							var current_after_tag = "[/"+current_shortcode_name+"]";
							var current_shortcode_tag_length = text_to_insert.length;
							var current_cursor_position = getCaret(jQuery('#content').get(0));
							insertAtCursor(jQuery('#content').get(0),text_to_insert, current_after_tag);
							setCaretToPos(jQuery('#content').get(0), current_cursor_position+current_shortcode_tag_length);
						}else{
							insertAtCaret('content', text_to_insert);
						}
					}catch(err){
						var txt = '<?php _e('There was an error while performing this request. Error description: ', 'flowthemes'); ?>' + err.message;
						alert(txt);
					}
					return;
				});
			});
			
			function pickShortcodeFieldsSet(shortcode_id){
				var shortcode_id = shortcode_id.value;
				jQuery('.flow-shortcode-set-item').css({ "display" : "none" });
				jQuery(shortcode_id).css({ "display" : "block" });
			}
			
			function isTextSelected(input){
				var startPos = input.selectionStart;
				var endPos = input.selectionEnd;
				var doc = document.selection;
				if(doc && doc.createRange().text.length != 0){
					return true;
				}else if(!doc && input.value.substring(startPos,endPos).length != 0){
					return true;
				}
				return false;
			}
			
			function getCaret(el){
				if(el.selectionStart){
					return el.selectionStart;
				}else if(document.selection){
					el.focus();
					var r = document.selection.createRange(); 
					if (r == null){ 
						return 0; 
					}
					var re = el.createTextRange(),
					rc = re.duplicate();
					re.moveToBookmark(r.getBookmark());
					rc.setEndPoint('EndToStart', re);
					return rc.text.length;
				}
				return 0;
			}
			
			function insertAtCursor(myField, myValueBefore, myValueAfter){
				if(document.selection){
					myField.focus();
					document.selection.createRange().text = myValueBefore + document.selection.createRange().text + myValueAfter;
				}else if(myField.selectionStart || myField.selectionStart == '0'){
					var startPos = myField.selectionStart;
					var endPos = myField.selectionEnd;
					myField.value = myField.value.substring(0, startPos)+ myValueBefore+ myField.value.substring(startPos, endPos)+ myValueAfter+ myField.value.substring(endPos, myField.value.length);
				}
			}
			
			function setSelectionRange(input, selectionStart, selectionEnd){
				if(input.setSelectionRange){
					input.focus();
					input.setSelectionRange(selectionStart, selectionEnd);
				}else if(input.createTextRange){
					var range = input.createTextRange();
					range.collapse(true);
					range.moveEnd('character', selectionEnd);
					range.moveStart('character', selectionStart);
					range.select();
				}
			}

			function setCaretToPos(input, pos){
				setSelectionRange(input, pos, pos);
			}

			function insertAtCaret(areaId, text) {
				var txtarea = document.getElementById(areaId);
				var scrollPos = txtarea.scrollTop;
				var strPos = 0;
				var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
					"ff" : (document.selection ? "ie" : false ) );
				if (br == "ie") {
					txtarea.focus();
					var range = document.selection.createRange();
					range.moveStart ('character', -txtarea.value.length);
					strPos = range.text.length;
				}
				else if (br == "ff") strPos = txtarea.selectionStart;

				var front = (txtarea.value).substring(0,strPos);  
				var back = (txtarea.value).substring(strPos,txtarea.value.length); 
				txtarea.value=front+text+back;
				strPos = strPos + text.length;
				if (br == "ie") { 
					txtarea.focus();
					var range = document.selection.createRange();
					range.moveStart ('character', -txtarea.value.length);
					range.moveStart ('character', strPos);
					range.moveEnd ('character', 0);
					range.select();
				}
				else if (br == "ff") {
					txtarea.selectionStart = strPos;
					txtarea.selectionEnd = strPos;
					txtarea.focus();
				}
				txtarea.scrollTop = scrollPos;
			}
			</script>
		</td>
	</tr>
</table>
<?php } ?>