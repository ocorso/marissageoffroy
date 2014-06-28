<?php 
/**
Made with the help of a tutorial at WPShout.com => http://wpshout.com.

Courtesy of the flowthemes theme - themeflowthemes.com

 * Adds the flowthemes Settings meta box on the Write Post/Page screeens
 *
 * @package flowthemes
 * @subpackage Admin
 */

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.
 *
 * @since 0.3
 */
function flowthemes_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post options', 'flowthemes'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Page options', 'flowthemes'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'portfolio-meta-boxes', __('Project Settings', 'flowthemes'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Slide options', 'flowthemes'), 'slideshow_meta_boxes', 'slideshow', 'normal', 'high' );
}

/**
 * Array of variables for post meta boxes.  Make the 
 * function filterable to add options through child themes.
 *
 * @since 0.3
 * @return array $meta_boxes
 */
function flowthemes_post_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'blog-full-image' => array( 'name' => 'blog-full-image', 'title' => __('Thumbnail (custom code)', 'flowthemes'), 'desc' => __('WordPress Thumbnails don\'t allow videos (iframes, embed codes), shortcodes and other useful pieces of code as thumbnails. You can put such code here. Please make sure to leave "post thumbnail" blank if you want to use this field. This field also accepts plain image URLs. <br><b>Example:</b> <code>&lt;div class="youtube_container"&gt;&lt;iframe frameborder="0" src="http://www.youtube.com/embed/Yvf2dcPfiHM?wmode=opaque" type="text/html" class="youtube-player"&gt;&lt;/iframe&gt;&lt;/div&gt;</code> (additional container is required to keep 16:9 aspect ratio when scaling website down).', 'flowthemes'), 'type' => 'textarea' ),
		'flow_post_layout' => array( 'name' => 'flow_post_layout', 'title' => __('Layout:', 'flowthemes'), 'options' => array('0' => __('Full Width', 'flowthemes'), '1' => __('Left Sidebar', 'flowthemes'), '2' => __('Right Sidebar', 'flowthemes'), /*'3' => __('Double Left Sidebar', 'flowthemes'), '4' => __('Double Right Sidebar', 'flowthemes'), '5' => __('Both Sides Sidebars', 'flowthemes')*/), 'desc' => __('Pick post layout here.', 'flowthemes'), 'type' => 'select' )
	);

	return apply_filters( 'flowthemes_post_meta_boxes', $meta_boxes );
}
function flowthemes_slideshow_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'flow_post_title' => array( 'name' => 'flow_post_title', 'title' => __('Title', 'flowthemes'), 'desc' => 'Slide title (specify if needs to be different than in admin panel).', 'type' => 'text' ),
		'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('Slide description.', 'flowthemes'), 'type' => 'textarea' ),
		'slide-image' => array( 'name' => 'slide-image', 'title' => __('Slide image:', 'flowthemes'), 'desc' => __('Put slide image here. Recommended size is around 700x300px and no more than 100-200kb.', 'flowthemes'), 'type' => 'upload' ),
		'slide-link' => array( 'name' => 'slide-link', 'title' => __('Button Link', 'flowthemes'), 'desc' => 'Your slide button can link to post, page, portfolio project or external location.', 'type' => 'text' ),		
		'slide-link-name' => array( 'name' => 'slide-link-name', 'title' => __('Button Link Name', 'flowthemes'), 'desc' => 'Leave blank to disable button on this slide.', 'type' => 'text' ),
		
		/* Button */
		'slide-button-x-offset' => array( 'name' => 'slide-button-x-offset', 'title' => __('Buttons X axis offset', 'flowthemes'), 'desc' => 'Specify X offset of your button (starting from the right). Examples: <strong>10px</strong> will move it 10px to the left.', 'type' => 'text' ),		
		'slide-button-y-offset' => array( 'name' => 'slide-button-y-offset', 'title' => __('Buttons Y axis offset', 'flowthemes'), 'desc' => __('Specify Y offset of your button (starting from the top). Examples: <strong>10px</strong> will move it 10px to the bottom.', 'flowthemes'), 'type' => 'text' ),
		'slide-button-icon' => array( 'name' => 'slide-button-icon', 'title' => __('Buttons icon (optional)', 'flowthemes'), 'desc' => __('Button icon. You can put here UTF-8 icons - search engines will give you lists and codes of available icons.', 'flowthemes'), 'type' => 'text' ),
		
		/* Colors */
		'slide-color' => array( 'name' => 'slide-color', 'title' => __('Slide color', 'flowthemes'), 'desc' => 'Since button is transparent with white glow it will also affect button\'s color.', 'type' => 'colorpicker' ),
		'slide-title-text-color' => array( 'name' => 'slide-title-text-color', 'title' => __('Title Text Color', 'flowthemes'), 'desc' => '', 'type' => 'colorpicker' ),
		'slide-description-text-color' => array( 'name' => 'slide-description-text-color', 'title' => __('Description Text Color', 'flowthemes'), 'desc' => '', 'type' => 'colorpicker' ),
		'slide-button-text-color' => array( 'name' => 'slide-button-text-color', 'title' => __('Button Text Color', 'flowthemes'), 'desc' => __('Default is #f1f1f1.', 'flowthemes'), 'type' => 'colorpicker' ),
		
		/* Image Offset */
		'slide-image-x-offset' => array( 'name' => 'slide-image-x-offset', 'title' => __('Image\'s X axis offset', 'flowthemes'), 'desc' => __('Specify left X offset of your slide image (starting from the middle of slide). Examples: <strong>10px</strong> will move it 10px to the right. <strong>-10px</strong> will move it 10px to the left. Technical limitation for this is ((1120px-(width_of_your_image))/2) so like 200-300px.', 'flowthemes'), 'type' => 'text' ),		
		'slide-image-y-offset' => array( 'name' => 'slide-image-y-offset', 'title' => __('Image\'s Y axis offset', 'flowthemes'), 'desc' => __('Specify top Y offset of your slide image. Examples: <strong>10px</strong> will move it 10px downwards. <strong>-10px</strong> will move it 10px to the top.', 'flowthemes'), 'type' => 'text' )
		
		/* Videos */
		/* 'slide-video' => array( 'name' => 'slide-video', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Put <strong>a link or video ID</strong> to YouTube or Vimeo video here.', 'type' => 'text' ),
		'slide-video-mp4' => array( 'name' => 'slide-video-mp4', 'title' => __('Slide video (MP4):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to MP4 format of your video.', 'type' => 'upload' ),
		'slide-video-ogg' => array( 'name' => 'slide-video-ogg', 'title' => __('Slide video (OGG):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to OGV format of your video.', 'type' => 'upload' ),
		'slide-video-webm' => array( 'name' => 'slide-video-webm', 'title' => __('Slide video (WEBM):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to WEBM format of your video. Not every WordPress installation supports WEBM videos in Media Library. Please upload it elsewhere.', 'type' => 'text' ),
		'slide-video-poster' => array( 'name' => 'slide-video-poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to image poster of your video.', 'type' => 'upload' ), */
	);

	return apply_filters( 'flowthemes_slideshow_meta_boxes', $meta_boxes );
}
function flowthemes_portfolio_meta_boxes() {

	$list_of_pages_raw = get_pages(); /* Must be [ID] => [display name] */
	$list_of_pages['none'] = __('=== not set ===', 'flowthemes');
	foreach($list_of_pages_raw as $single_page){
		$list_of_pages[$single_page->ID] = $single_page->post_title;
	}
	/* Array of the meta box options. */
	$meta_boxes = array(
		'slides' => array( 'name' => 'slides', 'title' => __('Thumbnail image:', 'flowthemes'), 'desc' => __('Manage your slides here.', 'flowthemes'), 'type' => 'slidemanager' ),
		'300-160-image' => array( 'name' => '300-160-image', 'title' => __('Thumbnail image', 'flowthemes'), 'desc' => __('<b>Thumbnail link and mouse over color.</b> If your thumbnail is supposed to be small (220x150px) (see drop-down below for list of dimensions) then please either upload 220x150px or 440x300px (to make it sharp on Retina displays please use twice as large numbers). Hosting thumbnails on your own server is recommended. If you specify external URL then to process such image your server will need to download it first - the script does this, too as long as this server supports any file operations like "file open". If not - please contact Server Administrator and/or our support.', 'flowthemes'), 'type' => 'imagesmapler' ),
		'thumbnail_hover_color' => array( 'name' => 'thumbnail_hover_color', 'title' => __('Thumbnail mouse over color:', 'flowthemes'), 'desc' => __('Pick some color that will be used as mouse over color for this project\'s thumbnail on front page.', 'flowthemes'), 'type' => 'imagesamplerhidden' ),
		'thumbnail_size' => array( 'name' => 'thumbnail_size', 'title' => __('Thumbnail size', 'flowthemes'), 'options' => array('0' => __('Random', 'flowthemes'), '1' => __('Large (670x305px)', 'flowthemes'), '2' => __('Medium (445x305px)', 'flowthemes'), '3' => __('Vertical (220x305px)', 'flowthemes'), '4' => __('Horizontal (445x150px)', 'flowthemes'), '5' => __('Small (220x150px)', 'flowthemes')), 'desc' => __('Use as many "Small" thumbnails as you can and as few "Large" and "Medium" as you can. Recommended is:<br>- 1 Large,<br>- 2-4 Medium<br>- Some Vertical and Horizontal<br>- Many Small.', 'flowthemes'), 'type' => 'select' ),
		'thumbnail_meta' => array( 'name' => 'thumbnail_meta', 'title' => __('Thumbnail meta data', 'flowthemes'), 'options' => array('0' => __('Don\'t display', 'flowthemes'), '1' => __('Display', 'flowthemes')), 'desc' => __('Display thumbnail meta data without hover? This is useful for solid color thumbnails.', 'flowthemes'), 'type' => 'select' ),
		'flow_post_title' => array( 'name' => 'flow_post_title', 'title' => __('Title', 'flowthemes'), 'desc' => __('You can add title to your post using this custom field. It will be displayed above post. It\'s not very useful for posts but it\'s useful for pages. I don\'t recommend using this field for posts but it\'s here for your convenience.', 'flowthemes'), 'type' => 'text' ),
		'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('You can add description to your post using this custom field. It will be displayed above post. It\'s not very useful for posts but it\'s useful for pages. I don\'t recommend using this field for posts but it\'s here for your convenience.', 'flowthemes'), 'type' => 'textarea' ),
		//'bg_image' => array( 'name' => 'bg_image', 'title' => __('Background image:', 'flowthemes'), 'desc' => 'Put link to your large background image here. The bigger the better (recommended ratio would be like 4:3 or 16:9 and dimensions like 1920x1080px).', 'type' => 'upload' ),
		//'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'desc' => 'Pick background color here. If you\'re not planning to use background image you should set some color instead. It should be in this format: <strong>#ffffff</strong> (for white background).', 'type' => 'text' ),
		//'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'options' => array('#ffffff' => 'White Color (#ffffff)', '#000000' => 'Black Color (#000000)'), 'desc' => 'For better readibility you can pick lighter or datker background color here for your first slide (displayed when image has not loaded yet).', 'type' => 'select' ),
		'portfolio_date' => array( 'name' => 'portfolio_date', 'title' => __('Project date', 'flowthemes'), 'desc' => __('Date - use any date format but please keep it consistend in other projects too. If you can\'t choose any format I suggest this: dd.mm.yyyy (like 20.07.2011). (will be displayed in description).', 'flowthemes'), 'type' => 'text' ),
		'portfolio_client' => array( 'name' => 'portfolio_client', 'title' => __('Project client', 'flowthemes'), 'desc' => __('Client name (will be displayed in description).', 'flowthemes'), 'type' => 'text' ),
		'portfolio_agency' => array( 'name' => 'portfolio_agency', 'title' => __('Project agency', 'flowthemes'), 'desc' => __('Agency name (will be displayed in description).', 'flowthemes'), 'type' => 'text' ),
		'portfolio_ourrole' => array( 'name' => 'portfolio_ourrole', 'title' => __('Project role', 'flowthemes'), 'desc' => __('Your role (will be displayed in description). Please use &lt;br&gt; HTML tag to add multi-line roles (&lt;br&gt; starts new line).', 'flowthemes'), 'type' => 'text' ),
		'thumbnail_link' => array( 'name' => 'thumbnail_link', 'title' => __('Thumbnail External Link (optional)', 'flowthemes'), 'desc' => __('If you\'d like this project to link to external website (like blog post), please put your link here. It will overwrite all portfolio functionality and your thumbnail will link to external place.', 'flowthemes'), 'type' => 'text' ),
		'thumbnail_link_newwindow' => array( 'name' => 'thumbnail_link_newwindow', 'title' => __('Open link in new window?', 'flowthemes'), 'desc' => __('This option works only if you have specified external link for this thumbnail.', 'flowthemes'), 'options' => array('0' => __('Same window', 'flowthemes'), '1' => __('New window (target="_blank")', 'flowthemes')), 'type' => 'select' ),
		'portfolio_back_button' => array( 'name' => 'portfolio_back_button', 'title' => __('Back button', 'flowthemes'), 'desc' => __('Back button usually goes back to the homepage when you enter project directly (not through portfolio page). If homepage is not your portfolio page - please set different back button location here. The portfolio page that you link this entry to must contain this project (it can\'t be present in its excluded categories) - otherwise the project will be blank.', 'flowthemes'), 'type' => 'select', 'options' => $list_of_pages ),
		//'portfolio_text_color' => array( 'name' => 'portfolio_text_color', 'title' => __('Text color', 'flowthemes'), 'options' => array('#ffffff' => 'White Color (#ffffff)', '#464646' => 'Dark Color (#464646)'), 'desc' => 'For better readibility you can pick lighter or datker text color here for your first slide.', 'type' => 'select' )
	);

	return apply_filters( 'flowthemes_portfolio_meta_boxes', $meta_boxes );
}

/**
 * Array of variables for page meta boxes.  Make the 
 * function filterable to add options through child themes.
 *
 * @since 0.3
 * @return array $meta_boxes
 */
function flowthemes_page_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'flow_post_title' => array( 'name' => 'flow_post_title', 'title' => __('Title', 'flowthemes'), 'desc' => __('You can add title to your page using this custom field. It will be displayed above page. We do not use main WordPress title field because it would not allow you to specify blank title.', 'flowthemes'), 'type' => 'text' ),
		'flow_post_description' => array( 'name' => 'flow_post_description', 'title' => __('Description', 'flowthemes'), 'desc' => __('You can add description to your page using this custom field. It will be displayed above page. It\'s optional.', 'flowthemes'), 'type' => 'textarea' ),
		'bg_image' => array( 'name' => 'bg_image', 'title' => __('Background image:', 'flowthemes'), 'desc' => __('Optional background image. For fullscreen background recommended ratio is 4:3 or 16:9 and dimensions up to 1920x1080px. For patterns it can be less.', 'flowthemes'), 'type' => 'upload' ),
		'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'desc' => __('Pick background color here. If you\'re not planning to use background image you should set some color instead. It should be in this format: <strong>#ffffff</strong> (for white background).', 'flowthemes'), 'type' => 'colorpicker' ),
		'bg_attachment' => array( 'name' => 'bg_attachment', 'title' => __('Background Attachment', 'flowthemes'), 'options' => array(false => __('Disable', 'flowthemes'), 'scroll' => __('Scroll (Default)', 'flowthemes'), 'fixed' => __('Fixed', 'flowthemes')), 'desc' => __('Scroll - the background image scrolls with the rest of the page. Fixed - the background image is fixed.', 'flowthemes'), 'type' => 'select' ),
		'bg_repeat' => array( 'name' => 'bg_repeat', 'title' => __('Background Repeat', 'flowthemes'), 'options' => array(false => __('Disable', 'flowthemes'), 'repeat' => __('Repeat', 'flowthemes'), 'no-repeat' => __('No-repeat', 'flowthemes'), 'repeat-x' => __('Repeat X', 'flowthemes'), 'repeat-y' => __('Repeat Y', 'flowthemes')), 'desc' => '', 'type' => 'select' ),
		'bg_position' => array( 'name' => 'bg_position', 'title' => __('Background Position', 'flowthemes'), 'desc' => __('Use like: left top OR center center OR 20% 20% OR center etc. Default: left top.', 'flowthemes'), 'type' => 'text' ),
		'bg_size' => array( 'name' => 'bg_size', 'title' => __('Background Size', 'flowthemes'), 'desc' => __('Use like: 100px 100px OR 10px 150px OR 200px OR 50% OR 100% 100% OR cover OR contain etc. Default: auto.', 'flowthemes'), 'type' => 'text' ),
		'bg_fullscreen' => array( 'name' => 'bg_fullscreen', 'title' => __('Fullscreen mode', 'flowthemes'), 'options' => array(false => __('Disable', 'flowthemes'), true => __('Enable', 'flowthemes')), 'desc' => __('You can\'t have "correct" fullscreen background with just CSS on all resolutions. That\'s why we created special fullscreen background mode that will scale, position and crop your background image with Javascript.', 'flowthemes'), 'type' => 'select' ),
		'bg_opacity' => array( 'name' => 'bg_opacity', 'title' => __('Background Opacity', 'flowthemes'), 'desc' => __('This works only with fullscreen background mode enabled. Use like: 0 or 0.1 or 0.5 or 1.', 'flowthemes'), 'type' => 'text' ),
		'page_layout' => array( 'name' => 'page_layout', 'title' => __('Layout:', 'flowthemes'), 'options' => array('0' => __('Full Width', 'flowthemes'), '1' => __('Left Sidebar', 'flowthemes'), '2' => __('Right Sidebar', 'flowthemes'), /* '3' => __('Double Left Sidebar', 'flowthemes'), '4' => __('Double Right Sidebar', 'flowthemes'), '5' => __('Both Sides Sidebars', 'flowthemes') */ '6' => __('No boundaries', 'flowthemes')), 'desc' => __('Pick page layout here.', 'flowthemes'), 'type' => 'select' )
	);
	
	$page_portfolio_orderby = array('date' => 'date', 'none' => 'none', 'ID' => 'ID', 'author' => 'author', 'title' => 'title', 'modified' => 'modified', 'parent' => 'parent', 'rand' => 'rand', 'comment_count' => 'comment_count', 'menu_order' => 'menu_order');
	$page_portfolio_order = array('DESC' => 'DESC', 'ASC' => 'ASC');
	
	$page_portfolio_post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	if($page_portfolio_post_id){
		$page_portfolio_templatefile = get_post_meta($page_portfolio_post_id,'_wp_page_template',true);
		if($page_portfolio_templatefile){
			if(in_array(strtolower($page_portfolio_templatefile), array("template-portoflio.php", "template-portoflio-2.php"))){
				$page_portfolio_options = array();
				$page_portfolio_categories = get_terms("portfolio_category", "hide_empty=0");
				for($h=0;$h<count($page_portfolio_categories);$h++){
					$page_portfolio_options[$page_portfolio_categories[$h]->slug] = $page_portfolio_categories[$h]->name;
				}
				$meta_boxes = array_merge($meta_boxes, array(
					'page_portfolio_tax_query_operator' => array( 'name' => 'page_portfolio_tax_query_operator', 'title' => __('Operator for categories box', 'flowthemes'), 'desc' => __('You can make below box INCLUDE only selected categories or EXCLUDE selected categories. When you\'re using INCLUDE you must select at least 1 category (and 2 if you\'d like filter to do anything at all). Otherwise it\'s going to display everything.', 'flowthemes'), 'options' => array(false => __('Exclude', 'flowthemes'), true => __('Include', 'flowthemes')), 'type' => 'select'),
					'page_portfolio_exclude' => array( 'name' => 'page_portfolio_exclude', 'title' => __('Exclude portfolio categories', 'flowthemes'), 'desc' => __('Select categories that should be excluded from this portfolio page. You can select multiple categories if you hold Ctrl / CMD and click on them.', 'flowthemes'), 'type' => 'select', 'is_multiple' => true, 'options' => $page_portfolio_options),
					'page_portfolio_orderby' => array( 'name' => 'page_portfolio_orderby', 'title' => __('Thumbnails order by', 'flowthemes'), 'desc' => __('Default is by date.', 'flowthemes'), 'type' => 'select', 'is_multiple' => false, 'options' => $page_portfolio_orderby),
					'page_portfolio_order' => array( 'name' => 'page_portfolio_order', 'title' => __('Thumbnails order', 'flowthemes'), 'desc' => __('Default is DESC.', 'flowthemes'), 'type' => 'select', 'is_multiple' => false, 'options' => $page_portfolio_order),
					'page_portfolio_shuffle' => array( 'name' => 'page_portfolio_shuffle', 'title' => __('Shuffle Button', 'flowthemes'), 'options' => array(false => __('Disable', 'flowthemes'), true => __('Enable', 'flowthemes')), 'desc' => __('Select if you\'d like shuffle button to appear on this portfolio page.', 'flowthemes'), 'type' => 'select'),
					'page_portfolio_welcome_text' => array( 'name' => 'page_portfolio_welcome_text', 'title' => __('Welcome Text', 'flowthemes'), 'desc' => __('Set welcome text for this portfolio page.', 'flowthemes'), 'type' => 'textarea'),
					'page_portfolio_loop_through' => array( 'name' => 'page_portfolio_loop_through', 'title' => __('Loop through selected category projects only?', 'flowthemes'), 'options' => array(false => __('No', 'flowthemes'), true => __('Yes', 'flowthemes')), 'desc' => __('By default entering project will make left/right arrows go to the next project regardless of what category is it in. Select this to yes if you want arrows to loop through projects from currently selected category only. This does not work for "Recent Projects" component because it does not have filter and thus it is always set to "all" categories (you can exlucde some of them on this page). Entering any project using that module will make left/right arrows go through entire portfolio.', 'flowthemes'), 'type' => 'select'),
					'page_portfolio_boundary_arrows' => array( 'name' => 'page_portfolio_boundary_arrows', 'title' => __('Boundary arrows disappear or loop from the start/end?', 'flowthemes'), 'options' => array(false => __('Loop', 'flowthemes'), true => __('Do not loop', 'flowthemes')), 'desc' => __('When user sees the first/last project in current projects set should the first/last arrow disappear or should it be looped?', 'flowthemes'), 'type' => 'select')
				));
			}
		}
	}

	//$meta_boxes = array_merge($meta_boxes, array(
		//'page_layout' => array( 'name' => 'page_layout', 'title' => __('Layout:', 'flowthemes'), 'options' => array('0' => __('Full Width', 'flowthemes'), '1' => __('Left Sidebar', 'flowthemes'), '2' => __('Right Sidebar', 'flowthemes'), /* '3' => __('Double Left Sidebar', 'flowthemes'), '4' => __('Double Right Sidebar', 'flowthemes'), '5' => __('Both Sides Sidebars', 'flowthemes') */ '6' => __('No boundaries', 'flowthemes')), 'desc' => __('Pick page layout here.', 'flowthemes'), 'type' => 'select' )
	//));

	return apply_filters( 'flowthemes_page_meta_boxes', $meta_boxes );
}

/**
 * Displays meta boxes on the Write Post panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_post_meta_boxes().
 *
 * @since 0.3
 */
function post_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_post_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :
	
		// $value = get_post_meta( $post->ID, $meta['name'], true ); // original - no stripslashes()
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'imagesampler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

/**
 * Displays meta boxes on the Write Page panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_page_meta_boxes()
 *
 * @since 0.3
 */
function page_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_page_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :
	
		// $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) ); // original
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'colorpicker' )
			get_meta_colorpicker( $meta, $value );
		elseif ( $meta['type'] == 'imagesampler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

/**
 * Displays meta boxes on the Write Page panel.  Loops 
 * through each meta box in the $meta_boxes variable.
 * Gets array from flowthemes_page_meta_boxes()
 *
 * @since 0.3
 */
function portfolio_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_portfolio_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :

		// $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) ); // original
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'colorpicker' )
			get_meta_colorpicker( $meta, $value );
		elseif ( $meta['type'] == 'imagesmapler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

function slideshow_meta_boxes() {
	global $post;
	$meta_boxes = flowthemes_slideshow_meta_boxes(); ?>

	<table class="form-table meta-boxes-table">
	<?php foreach ( $meta_boxes as $meta ) :

		// $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) ); // original
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if(is_array($value)){
			//foreach($value as $k => $v){
				//$value[$k] = stripslashes( $v );
			//}
		}else{
			$value = stripslashes( $value );
		}

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'upload' )
			get_meta_text_upload( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'colorpicker' )
			get_meta_colorpicker( $meta, $value );
		elseif ( $meta['type'] == 'imagesmapler' )
			get_meta_imagesampler( $meta, $value );
		elseif ( $meta['type'] == 'imagesamplerhidden' )
			get_meta_imagesamplerhidden( $meta, $value );
		elseif ( $meta['type'] == 'slidemanager' )
			get_meta_slidemanager( $meta, $value );

	endforeach; ?>
	</table>
<?php 
}

function get_meta_text_input( $args = array(), $value = false ) {
	extract( $args ); ?>

	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php 
}

function get_meta_text_upload( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<div class="flowuploader">
				<input class="flowuploader_media_url" type="text" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>" />
				<span class="flowuploader_upload_button button">Upload</span>
				<div class="flowuploader_media_preview_image"></div>
			</div>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php 
}

function get_meta_colorpicker( $args = array(), $value = false ){
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>						
			<input id="<?php echo $name; ?>" type="text" class="attcolorpicker" style="float:left;margin-top:8px;" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>"> <div class="colorSelector"><div style="background-color:<?php echo esc_html( $value ); ?>;"></div></div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					var currentcolor = "<?php echo esc_html( $value ); ?>";
					jQuery("#<?php echo $name; ?>").next('.colorSelector').ColorPickerSetColor(currentcolor);
					jQuery("#<?php echo $name; ?>.attcolorpicker").ColorPickerSetColor(currentcolor);
				});
			</script>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p>
				<?php echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}
function get_meta_imagesamplerhidden( $args = array(), $value = false ){ extract( $args ); ?>
	<tr style="display:none;">
		<th></th>
		<td>
			<input id="<?php echo $name; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>">
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php 
}

$nonce_name = plugin_basename( __FILE__ );
include( dirname( __FILE__ ) . '/superslide/superslide.php' );
include( dirname( __FILE__ ) . '/superslide/imagesampler.php' );

function get_meta_select( $args = array(), $value = false ) {
	extract( $args );
		if(isset($is_multiple) && $is_multiple){
			$page_portfolio_post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
			if($page_portfolio_post_id){
				$value = get_post_meta($page_portfolio_post_id, $name, true);
			}
		}else{
			$is_multiple = false;
		}
	?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select <?php if($is_multiple){ echo ' multiple="multiple"'; } ?> name="<?php echo $name; if($is_multiple){ echo '[]'; } ?>" id="<?php echo $name; ?>">
				<?php foreach( $options as $optionkey => $optionval ){ ?>
					<option value="<?php echo $optionkey; ?>" <?php if((is_array($value) && in_array($optionkey, $value)) || (is_string($value) && $optionkey == $value)){ echo ' selected="selected"'; } ?>><?php echo $optionval; ?></option>
				<?php } ?>
			</select>
			<p>
				<?php echo $desc; ?>
			</p>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php 
}

function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p>
				<?php echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}

/* Add a new meta box to the admin menu. */
add_action( 'admin_menu', 'flowthemes_create_meta_box' );

/* Saves the meta box data. */
add_action( 'save_post', 'flowthemes_save_meta_data' );

/**
 * Loops through each meta box's set of variables.
 * Saves them to the database as custom fields.
 *
 * @since 0.3
 * @param int $post_id
 */
function flowthemes_save_meta_data( $post_id ) {
	global $post;
	$i = 0;

	if ( 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( flowthemes_page_meta_boxes() );
	elseif ( 'portfolio' == $_POST['post_type'] )
		$meta_boxes = array_merge( flowthemes_portfolio_meta_boxes() );
	elseif ( 'slideshow' == $_POST['post_type'] )
		$meta_boxes = array_merge( flowthemes_slideshow_meta_boxes() );
	else
		$meta_boxes = array_merge( flowthemes_post_meta_boxes() );
		
	foreach ( $meta_boxes as $meta_box ) :
		
		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		$data = $_POST[$meta_box['name']];
		if(!is_array($data)){
			$data = stripslashes($data);
		}

		// Update post
		if($meta_box['name'] == "slides"){
			$this_id = get_the_ID();
			$my_post = array();
			$my_post['ID'] = $this_id;
			
			$post_content = json_decode($data);
			$shortcode_output = '';
			foreach((array)$post_content as $key => $value){
				$value = (array) $value;
				if(isset($value['type']) && ($value['type'] == 'custom')){
					$CSSClass = '';
					if(array_key_exists('css_class', $value)){
						$CSSClass = $value['css_class'];
					}
					$shortcode = '<div class="project-slide project-slide-image ' . $CSSClass . '">';
						$shortcode .= $value['custom'];
					$shortcode .= '</div>';
					$shortcode .= "\n\n";
				}else{
					$shortcode = '[slide';
					$has_desc = false;
					foreach($value as $field_name => $field_value){
						if($field_name == 'slide_desc'){
							$has_desc = true;
						}else{
							$shortcode .= ' ' . $field_name . '="' . $field_value . '"';
						}
						
					}
					$shortcode .= ']';
					if($has_desc){
						$shortcode .= $value['slide_desc'] . '[/slide]';
					}
					$shortcode .= "\n\n";
				}
				$shortcode_output .= $shortcode;
			}
			$my_post['post_content'] = $shortcode_output;
			
			remove_action('save_post', 'flowthemes_save_meta_data');
			wp_update_post( $my_post );
			add_action('save_post', 'flowthemes_save_meta_data');
			
			$data = $_POST[$meta_box['name']];
		}
		 
		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
} ?>