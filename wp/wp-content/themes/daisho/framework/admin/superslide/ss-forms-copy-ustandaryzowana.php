$form_boxes['image'] = array(
			'form_id' => 'flow_image_form',
			'form_prefix' => 'flow_image',
			'form_title' => 'Add Image Slide',
			'thumbnail_title' => 'Image',
			'icon_class' => '.image-icon',
			'icon' => false,
			'icon_from_id' => '#flow_image',
			'fields' => array(
				/* 'flow_image' => array( 'name' => 'flow_image', 'title' => __('Slide Image', 'flowthemes'), 'desc' => 'Image URL.', 'type' => 'upload' ),
				'flow_image_alt' => array( 'name' => 'flow_image_alt', 'title' => __('Image Alternative Text', 'flowthemes'), 'desc' => 'Image alt', 'type' => 'input' ),
				'flow_image_description' => array( 'name' => 'flow_image_description', 'title' => __('Slide Title (optional)', 'flowthemes'), 'desc' => __('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'), 'type' => 'textarea' ),
				'flow_image_text_color' => array( 'name' => 'flow_image_text_color', 'title' => __('Text color (and cursor color)', 'flowthemes'), 'desc' => __('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_image_cursor_color' => array( 'name' => 'flow_image_cursor_color', 'title' => __('Text color (and cursor color)', 'flowthemes'), 'desc' => __('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_image_fitscreen_mode' => array( 'name' => 'flow_image_fitscreen_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('If this is vertical image (like portrait photo with ratio like 1:2) or horizontal image (like panorama photo with ratio like 2:1) you can disable cropping for it (select checkbox). This prevents cropping of parts of image (like head of a person in case of portraits).', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_image_original_dimensions_mode' => array( 'name' => 'flow_image_original_dimensions_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_image_nostyle_mode' => array( 'name' => 'flow_image_nostyle_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ) */
				'image' => array( 'name' => 'image', 'title' => __('Slide Image', 'flowthemes'), 'desc' => 'Image URL.', 'type' => 'upload' ),
				'image_alt' => array( 'name' => 'image_alt', 'title' => __('Image Alternative Text', 'flowthemes'), 'desc' => 'Image alt', 'type' => 'input' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Slide Title (optional)', 'flowthemes'), 'desc' => __('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'), 'type' => 'textarea' ),
				'text_color' => array( 'name' => 'text_color', 'title' => __('Text color (and cursor color)', 'flowthemes'), 'desc' => __('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'), 'type' => 'colorpicker' ),
				/* 'flow_image_cursor_color' => array( 'name' => 'flow_image_cursor_color', 'title' => __('Text color (and cursor color)', 'flowthemes'), 'desc' => __('Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.', 'flowthemes'), 'type' => 'colorpicker' ), */
				'slide_horizontal' => array( 'name' => 'slide_horizontal', 'title' => __('Description', 'flowthemes'), 'desc' => __('If this is vertical image (like portrait photo with ratio like 1:2) or horizontal image (like panorama photo with ratio like 2:1) you can disable cropping for it (select checkbox). This prevents cropping of parts of image (like head of a person in case of portraits).', 'flowthemes'), 'type' => 'checkbox' ),
				/* 'flow_image_original_dimensions_mode' => array( 'name' => 'flow_image_original_dimensions_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_image_nostyle_mode' => array( 'name' => 'flow_image_nostyle_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ) */
			)
		);
		$form_boxes['video'] = array(
			'form_id' => 'flow_video_form',
			'form_prefix' => 'flow_video',
			'form_title' => 'Add Self-hosted Video Slide',
			'thumbnail_title' => 'Video Slide',
			'icon_class' => '.video-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/video-preview.jpg',
			'icon_from_id' => false,
			'fields' => array(
				'flow_video' => array( 'name' => 'flow_video', 'title' => __('Title', 'flowthemes'), 'desc' => 'Slide title (specify if needs to be different than in admin panel).', 'type' => 'upload' ),
				'flow_video_description' => array( 'name' => 'flow_video_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'textarea' ),
				'flow_video_text_color' => array( 'name' => 'flow_video_text_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_video_cursor_color' => array( 'name' => 'flow_video_cursor_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_video_fitscreen_mode' => array( 'name' => 'flow_video_fitscreen_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_video_original_dimensions_mode' => array( 'name' => 'flow_video_original_dimensions_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_video_nostyle_mode' => array( 'name' => 'flow_video_nostyle_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				
				// Videos
				'flow_video_mp4' => array( 'name' => 'flow_video_mp4', 'title' => __('Slide video (MP4):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to MP4 format of your video.', 'type' => 'upload' ),
				'flow_video_ogg' => array( 'name' => 'flow_video_ogg', 'title' => __('Slide video (OGG):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to OGV format of your video.', 'type' => 'upload' ),
				'flow_video_webm' => array( 'name' => 'flow_video_webm', 'title' => __('Slide video (WEBM):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to WEBM format of your video. Not every WordPress installation supports WEBM videos in Media Library. Please upload it elsewhere.', 'type' => 'text' ),
				'flow_video_poster' => array( 'name' => 'flow_video_poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.', 'type' => 'upload' )
			)
		);
		$form_boxes['vimeo'] = array(
			'form_id' => 'flow_video_vimeo_form',
			'form_prefix' => 'flow_vimeo',
			'form_title' => 'Add Vimeo Video Slide',
			'thumbnail_title' => 'Vimeo Slide',
			'icon_class' => '.vimeo-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/vimeo-preview.jpg',
			'icon_from_id' => false,
			'fields' => array(
				/* 'flow_vimeo' => array( 'name' => 'flow_vimeo', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Specify Vimeo <strong>video ID</strong> or video LINK here. Please note that only default video link will work. Shortlinks and link without ID in it will not work.', 'type' => 'upload' ),
				'flow_vimeo_description' => array( 'name' => 'flow_vimeo_description', 'title' => __('Slide Title (optional)', 'flowthemes'), 'desc' => __('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'), 'type' => 'textarea' ),
				'flow_vimeo_text_color' => array( 'name' => 'flow_vimeo_text_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_vimeo_cursor_color' => array( 'name' => 'flow_vimeo_cursor_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_vimeo_fitscreen_mode' => array( 'name' => 'flow_vimeo_fitscreen_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_vimeo_original_dimensions_mode' => array( 'name' => 'flow_vimeo_original_dimensions_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_vimeo_nostyle_mode' => array( 'name' => 'flow_vimeo_nostyle_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ) */
				'video_vimeo' => array( 'name' => 'video_vimeo', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Specify Vimeo <strong>video ID</strong> or video LINK here. Please note that only default video link will work. Shortlinks and link without ID in it will not work.', 'type' => 'upload' ),
				'slide_desc' => array( 'name' => 'slide_desc', 'title' => __('Slide Title (optional)', 'flowthemes'), 'desc' => __('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'), 'type' => 'textarea' ),
				'text_color' => array( 'name' => 'text_color', 'title' => __('Text Color', 'flowthemes'), 'desc' => __('Text and cursor color.', 'flowthemes'), 'type' => 'colorpicker' ),
				'slide_noresize' => array( 'name' => 'slide_noresize', 'title' => __('Fixed dimensions mode', 'flowthemes'), 'desc' => __('Select this to disable scaling.', 'flowthemes'), 'type' => 'checkbox' )
			)
		);
		$form_boxes['youtube'] = array(
			'form_id' => 'flow_video_youtube_form',
			'form_prefix' => 'flow_youtube',
			'form_title' => 'Add YouTube Video Slide',
			'thumbnail_title' => 'YouTube Slide',
			'icon_class' => '.youtube-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/youtube-preview.jpg',
			'icon_from_id' => false,
			'fields' => array(
				'flow_youtube' => array( 'name' => 'flow_youtube', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Put <strong>a link or video ID</strong> to YouTube or Vimeo video here.', 'type' => 'upload' ),
				'flow_youtube_description' => array( 'name' => 'flow_youtube_description', 'title' => __('Slide Title (optional)', 'flowthemes'), 'desc' => __('Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.', 'flowthemes'), 'type' => 'textarea' ),
				'flow_youtube_text_color' => array( 'name' => 'flow_youtube_text_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_youtube_cursor_color' => array( 'name' => 'flow_youtube_cursor_color', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'colorpicker' ),
				'flow_youtube_fitscreen_mode' => array( 'name' => 'flow_youtube_fitscreen_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Select checkbox to disable video resizing. Original dimenions will be kept (640x360px only - higher resolutions work worse on smaller resolutions). You need to specify video poster below if this mode is selected.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_youtube_original_dimensions_mode' => array( 'name' => 'flow_youtube_original_dimensions_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_youtube_nostyle_mode' => array( 'name' => 'flow_youtube_nostyle_mode', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'checkbox' ),
				'flow_youtube_poster' => array( 'name' => 'flow_youtube_poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.', 'type' => 'upload' )
			)
		);
		$form_boxes['custom'] = array(
			'form_id' => 'flow_custom_form',
			'form_prefix' => 'flow_custom',
			'form_title' => 'Add Custom Code',
			'thumbnail_title' => 'Custom Code',
			'icon_class' => '.custom-icon',
			'icon' => get_bloginfo('template_directory') . '/framework/admin/superslide/custom-preview.jpg',
			'icon_from_id' => false,
			'fields' => array(
				'flow_custom' => array( 'name' => 'slide-video', 'title' => __('Custom Code', 'flowthemes'), 'desc' => 'Caution! You should not use "Custom Code" unless you know what you are doing. Without coding knowledge it may break your portfolio! This mode allows you to specify custom code to display on project page as slide. You can put here <b>SoundCloud</b> iframe to embed audio player or other custom code. <br/><br/> This field allows: \', ", < and > but it does not allow * symbol. It sends raw data to shortcode, so some characters may not be allowed.', 'type' => 'textarea' )
			)
		);