<?php 
/**
Made with the help of a tutorial at WPShout.com => http://wpshout.com.

Courtesy of the flowthemes theme - themeflowthemes.com

 * Adds the flowthemes Settings meta box on the Write Post/Page screeens
 *
 * @package flowthemes
 * @subpackage Admin
 */

/* Add a new meta box to the admin menu. */
	add_action( 'admin_menu', 'flowthemes_create_meta_box' );

/* Saves the meta box data. */
	add_action( 'save_post', 'flowthemes_save_meta_data' );

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.
 *
 * @since 0.3
 */
function flowthemes_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post options'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Post options'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'portfolio-meta-boxes', __('Project Settings'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Post options'), 'slideshow_meta_boxes', 'slideshow', 'normal', 'high' );
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
		'blog-full-image' => array( 'name' => 'blog-full-image', 'title' => __('Full-width blog post thumbnail:', 'flowthemes'), 'desc' => 'If this is a blog post then you may use this field to store images that will be displayed on blog\'s front page and single post page. It requires a link to image.', 'type' => 'upload' ),
		//'blog-left-image' => array( 'name' => 'blog-left-image', 'title' => __('Post thumbnail:', 'flowthemes'), 'desc' => 'You can put link to post thumbnail image here. Recommended size is 150x150px. It will be displayed as thumbnail in recent posts widget, related posts and on blog page.', 'type' => 'upload' ),
		
	);

	return apply_filters( 'flowthemes_post_meta_boxes', $meta_boxes );
}
function flowthemes_slideshow_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'page_title' => array( 'name' => 'Title', 'title' => __('Title', 'flowthemes'), 'desc' => 'Slide title (specify if needs to be different than in admin panel).', 'type' => 'text' ),
		'page_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => 'Slide description.', 'type' => 'textarea' ),
		'slide-image' => array( 'name' => 'slide-image', 'title' => __('Slide image:', 'flowthemes'), 'desc' => 'Put slide image here. Recommended size is around 1920x1080px and no more than 400-500kb.', 'type' => 'upload' ),
		//'640-360-image-right' => array( 'name' => '640-360-image-right', 'title' => __('Slideshow 640x360px image to the right:', 'flowthemes'), 'desc' => 'Put a link to <strong>640x360px image</strong> here. It works with <strong>Anything slider</strong> (jCycle slider) only. Example link looks like this: <strong>http://example.com/image.jpg</strong>. The image will be displayed to the right with title and description to the left.', 'type' => 'upload' ),
		//'640-360-image-left' => array( 'name' => '640-360-image-left', 'title' => __('Slider 640x360px image to the left:', 'flowthemes'), 'desc' => 'Put a link to <strong>640x360px image</strong> here. It works with <strong>Anything slider</strong> (jCycle slider) only. Example link looks like this: <strong>http://example.com/image.jpg</strong>. The image will be displayed to the left with title and description to the right.', 'type' => 'upload' ),
		//'slide-video' => array( 'name' => 'slide-video', 'title' => __('Slide video:', 'flowthemes'), 'desc' => 'Put <strong>a link or video ID</strong> to YouTube or Vimeo video here.', 'type' => 'text' ),
		'slide-video-mp4' => array( 'name' => 'slide-video-mp4', 'title' => __('Slide video (MP4):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to MP4 format of your video.', 'type' => 'upload' ),
		'slide-video-ogg' => array( 'name' => 'slide-video-ogg', 'title' => __('Slide video (OGG):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to OGV format of your video.', 'type' => 'upload' ),
		'slide-video-webm' => array( 'name' => 'slide-video-webm', 'title' => __('Slide video (WEBM):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to WEBM format of your video. Not every WordPress installation supports WEBM videos in Media Library. Please upload it elsewhere.', 'type' => 'text' ),
		'slide-video-poster' => array( 'name' => 'slide-video-poster', 'title' => __('Slide video (Poster):', 'flowthemes'), 'desc' => 'Put <strong>a link</strong> to image poster of your video.', 'type' => 'upload' ),
		//'640-360-video-left' => array( 'name' => '640-360-video-left', 'title' => __('Slider 640x360px (16:9) video or flash content to the left:', 'flowthemes'), 'desc' => 'Put an <strong>embed code</strong> for <strong>640x360px (16:9) video or flash content</strong> from YouTube or Vimeo here. It will be displayed on your front page for <strong>Anything slider</strong> (jCycle slider) only. You can copy <strong>embed code</strong> from YouTube or Vimeo and put it here. It prints code "as is" so it has to include video or flash content itself. There\'s no script that handles that.', 'type' => 'text' ),
		//'1000-360-image3d' => array( 'name' => '1000-360-image3d', 'title' => __('3D slider 1000x360px image:', 'flowthemes'), 'desc' => 'Upload your 1000x360px image to media library and put a part of link to this image in this filed. Example link looks like this: <strong>2010/09/image.jpg</strong>. As you see this field should contain an <strong>end part of a link to the image</strong> and is used by 3D slider only. The end part of the link looks like this: "2010/09/slide2.jpg". You shouldn\'t write http://example.com/.../uploads/2010/06/slide2.jpg but <strong>only 2010/06/slide2.jpg!</strong> It works with <strong>3D Slider ONLY</strong>! You should upload your images to your server as they are taken from WP uploads directory by default. <strong>They cannot be hosted externally!</strong>', 'type' => 'upload' ),
		'slide-link' => array( 'name' => 'slide-link', 'title' => __('Slide link', 'flowthemes'), 'desc' => 'Your slide can link to post, page, portfolio project or external location.', 'type' => 'text' ),		
		'slide-link-name' => array( 'name' => 'slide-link-name', 'title' => __('Slide link name', 'flowthemes'), 'desc' => 'Leave blank to have \'View Project\' link text on this slide.', 'type' => 'text' ),
		'slide-text-color' => array( 'name' => 'slide-text-color', 'title' => __('Text color', 'flowthemes'), 'options' => array('#ffffff' => 'White Color (#ffffff)', '#464646' => 'Dark Color (#464646)'), 'desc' => 'For better readibility you can pick lighter or darker text color for this slide.', 'type' => 'select' )		
	);

	return apply_filters( 'flowthemes_slideshow_meta_boxes', $meta_boxes );
}
function flowthemes_portfolio_meta_boxes() {

	/* Array of the meta box options. */
	$meta_boxes = array(
		'slides' => array( 'name' => 'slides', 'title' => __('Thumbnail image:', 'flowthemes'), 'desc' => 'Put link to image with any dimensions here (at least 400x300px and recommended ratio is 4:3). <strong>Strongly recommended size is 400x300px.</strong>. Image resizing/cropping scripts will take care of the rest.', 'type' => 'slidemanager' ),
		'300-160-image' => array( 'name' => '300-160-image', 'title' => __('Thumbnail image:', 'flowthemes'), 'desc' => 'Put link to image with any dimensions here (at least 400x300px and recommended ratio is 4:3). <strong>Strongly recommended size is 400x300px.</strong>. Image resizing/cropping scripts will take care of the rest.', 'type' => 'imagesmapler' ),
		'thumbnail_hover_color' => array( 'name' => 'thumbnail_hover_color', 'title' => __('Thumbnail mouse over color:', 'flowthemes'), 'desc' => 'Pick some color that will be used as mouse over color for this project\'s thumbnail on front page.', 'type' => 'imagesamplerhidden' ),
		'page_title' => array( 'name' => 'Title', 'title' => __('Title', 'flowthemes'), 'desc' => 'Portfolio project title. It is required! It will be displayed on cover slide.', 'type' => 'text' ),
		'page_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => 'You can add description to your post using this custom field. It can\'t contain multiple lines or special characters.', 'type' => 'textarea' ),
		//'bg_image' => array( 'name' => 'bg_image', 'title' => __('Background image:', 'flowthemes'), 'desc' => 'Put link to your large background image here. The bigger the better (recommended ratio would be like 4:3 or 16:9 and dimensions like 1920x1080px).', 'type' => 'upload' ),
		//'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'desc' => 'Pick background color here. If you\'re not planning to use background image you should set some color instead. It should be in this format: <strong>#ffffff</strong> (for white background).', 'type' => 'text' ),
		//'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'options' => array('#ffffff' => 'White Color (#ffffff)', '#000000' => 'Black Color (#000000)'), 'desc' => 'For better readibility you can pick lighter or datker background color here for your first slide (displayed when image has not loaded yet).', 'type' => 'select' ),
		'portfolio_date' => array( 'name' => 'portfolio_date', 'title' => __('Project date', 'flowthemes'), 'desc' => 'Date - use any date format but please keep it consistend in other projects too. If you can\'t choose any format I suggest this: dd.mm.yyyy (like 20.07.2011). (will be displayed in description).', 'type' => 'text' ),
		'portfolio_client' => array( 'name' => 'portfolio_client', 'title' => __('Project client', 'flowthemes'), 'desc' => 'Client name (will be displayed in description).', 'type' => 'text' ),
		'portfolio_agency' => array( 'name' => 'portfolio_agency', 'title' => __('Project agency', 'flowthemes'), 'desc' => 'Agency name (will be displayed in description).', 'type' => 'text' ),
		'portfolio_ourrole' => array( 'name' => 'portfolio_ourrole', 'title' => __('Project role', 'flowthemes'), 'desc' => 'Your role (will be displayed in description). Please use &lt;br&gt; HTML tag to add multi-line roles (&lt;br&gt; starts new line).', 'type' => 'text' ),
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
		'page_title' => array( 'name' => 'Title', 'title' => __('Title', 'flowthemes'), 'desc' => 'You can add title to your page using this custom field. It will be displayed above page. It\'s optional.', 'type' => 'text' ),
		'page_description' => array( 'name' => 'Description', 'title' => __('Description', 'flowthemes'), 'desc' => 'You can add description to your page using this custom field. It will be displayed above page. It\'s optional.', 'type' => 'textarea' ),
		'bg_image' => array( 'name' => 'bg_image', 'title' => __('Background image:', 'flowthemes'), 'desc' => 'Put link to your large background image here. The bigger the better (recommended ratio would be like 4:3 or 16:9 and dimensions like 1920x1080px (1x1px in case of solid backgrounds)).', 'type' => 'upload' ),
		'bg_color' => array( 'name' => 'bg_color', 'title' => __('Background color:', 'flowthemes'), 'desc' => 'Pick background color here. If you\'re not planning to use background image you should set some color instead. It should be in this format: <strong>#ffffff</strong> (for white background).', 'type' => 'text' ),
	);
	
	$page_portfolio_post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	if($page_portfolio_post_id){
		$page_portfolio_templatefile = get_post_meta($page_portfolio_post_id,'_wp_page_template',true);
		if($page_portfolio_templatefile){
			if(in_array(strtolower($page_portfolio_templatefile), array("template-portoflio.php", "template-portoflio-2.php", "template-portoflio-3.php", "template-portoflio-4.php", "template-portoflio-5.php", "template-portoflio-6.php", "template-portoflio-7.php"))){
				$page_portfolio_options = array();
				$page_portfolio_categories = get_terms("portfolio_category");
				for($h=0;$h<count($page_portfolio_categories);$h++){
					$page_portfolio_options[] = array('v' => $page_portfolio_categories[$h]->slug, 'n' => $page_portfolio_categories[$h]->name);
				}
				$meta_boxes = array_merge($meta_boxes, array(
					'page_portfolio_exclude' => array( 'name' => 'exclude-pf-categories', 'title' => __('Exclude portfolio categories', 'flowthemes'), 'desc' => 'Select categories that should be excluded from this portfolio page. You can select multiple categories if you hold Ctrl / CMD and click on them.', 'type' => 'select', 'is_multiple' => true, 'options' => $page_portfolio_options),
					'crop_ratio_x_y' => array( 'name' => 'crop_ratio_x_y', 'title' => __('Crop ratio x:y', 'flowthemes'), 'desc' => 'If you wish all your images on this portfolio page be cropped to one size you\'ll have to specify crop ratio and width or height of each thumbnail. <strong>Correct value for this field looks like: 4:3 or 16:9 or 123:456</strong>. You don\'t have to specify crop ratio if you wish your images to have original ratio. Please only specify their height below (if you won\'t do that then 140px will be used as height).', 'type' => 'text' ),
					'image_height' => array( 'name' => 'image_height', 'title' => __('Image height', 'flowthemes'), 'desc' => 'If you wish all your images on this portfolio page be cropped to one size you\'ll have to specify crop ratio and width or height of each thumbnail. If you specify both width and height then only one property will be taken (the lower one).', 'type' => 'text' ),
					'image_width' => array( 'name' => 'image_width', 'title' => __('Image width', 'flowthemes'), 'desc' => 'If you wish all your images on this portfolio page be cropped to one size you\'ll have to specify crop ratio and width or height of each thumbnail. If you specify both width and height then only one property will be taken (the lower one).', 'type' => 'text' ),
				));
			}
		}
	}

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

	<table class="form-table">
	<?php  foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

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

	<table class="form-table">
	<?php  foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

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

	<table class="form-table">
	<?php  foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

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

	<table class="form-table">
	<?php  foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

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
			<label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php  echo $name; ?>" id="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p style="color: #555;">
				<?php  echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}

function get_meta_text_upload( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
	<th style="width:20%;">
	 <label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
	</th>
	<td>
	 <input type="text" name="<?php  echo $name; ?>" id="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>" size="30" tabindex="30" /> <span class="briskuploader button">Upload</span><br><div class="briskuploader_preview"></div>
	 <input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	 <p style="color: #555;">
	  <?php  echo $desc; ?>
	 </p>
	</td>
	</tr>
	<?php 
}

function get_meta_colorpicker( $args = array(), $value = false ) {

	extract( $args ); ?>
	
	<tr>
	<th style="width:20%;">
	 <label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
	</th>
	<td>
	
	<input id="<?php  echo $name; ?>" type="text" class="attcolorpicker" style="float:left;margin-top:8px;" name="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>"> <div class="colorSelector"><div style="background-color:;"></div></div>
	
	 <input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	 <p style="color: #555;clear:both;">
	  <?php  echo $desc; ?>
	 </p>
	</td>
	</tr>
	<?php 
}
function get_meta_imagesamplerhidden( $args = array(), $value = false ) { extract( $args ); ?>
<tr style="display:none;">
	<td>
	<input id="<?php  echo $name; ?>" type="text" name="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>">
	 <input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	 </td>
	</tr>
	<?php 
}

 function get_meta_slidemanager( $args = array(), $value = false ) {
	extract( $args );
	//$name_color = $name.'_color';
	//$value_color = $value.'_color';
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
			 url : '<?php  bloginfo('template_directory'); ?>/includes/uploadify/upload.php',
			runtimes : 'html5',
			max_file_size : '10mb',
			chunk_size : '1mb',
			rename: true,
			multiple_queues: true,
			//unique_names : true,
			init : {
				'FileUploaded'  : function(b,file,c) {
					file.name = file.name.replace(/[^\w\._]+/g,'_');
					var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/uploads/' + file.name;
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
		alert('err');
	}

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
		jQuery('#flow_slide_horizontal_image').attr('checked', false);
		jQuery('#flow_slide_noresize_vimeo').attr('checked', false);
		jQuery('#flow_slide_noresize_youtube').attr('checked', false);
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
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/video-preview.jpg';
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
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/vimeo-preview.jpg';
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
		var images_path = '<?php  bloginfo('template_directory'); ?>/includes/uploadify/youtube-preview.jpg';

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
	
	
	resizethickboxf=function(){
		var nheight = Math.max(0,Math.min(jQuery(window).height()-150, jQuery("#TB_ajaxContent table").height()+100));
		jQuery("#TB_ajaxContent").css("height",nheight+"px");
		//tb_position();
		jQuery("#TB_window").css("margin-top",(-(jQuery(window).height())/2+50)+"px");
	};
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
				<th><label for="slide-desc">Slide Title (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_image" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.</small>\
			</tr>\
			<tr>\
				<th><label for="slide-horizontal">Fit screen mode (prevents image cropping)</label></th>\
				<td><input type="checkbox" name="slide-horizontal" id="flow_slide_horizontal_image" /><br />\
				<small>If this is vertical image (like portrait photo with ratio like 1:2) or horizontal image (like panorama photo with ratio like 2:1) you can disable cropping for it (select checkbox). This prevents cropping of parts of image (like head of a person in case of portraits).</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="image-submit" class="button-primary" value="Save Changes" name="submit" />\
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
				<th><label for="slide-desc">Slide Title (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_video" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="video-submit" class="button-primary" value="Save Changes" name="submit" />\
		</p>\
		</div>');				
		var form_vimeo = jQuery('<div id="vimeo-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-vimeo">Vimeo video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-vimeo" id="flow_video_vimeo" value="" /><br />\
				<small>Specify Vimeo <strong>video ID</strong> or video LINK here.</small>\
			</tr>\
			<tr>\
				<th><label for="text_color">Text color (and cursor color)</label></th>\
				<td><select name="text_color" id="flow_text_color_vimeo">\
					<option value="#ffffff">White color</option>\
					<option value="#464646">Dark color</option>\
				</select><br />\
				<small>Specify the slide text and cursor colors. Dark (#464646) text for light slides or light (#ffffff) text for dark slides.</small></td>\
			</tr>\
			<tr>\
				<th><label for="slide-noresize">Fit screen mode (prevents video resizing)</label></th>\
				<td><input type="checkbox" name="slide-noresize" id="flow_slide_noresize_vimeo" /><br />\
				<small>Select checkbox to disable video resizing. Original dimenions will be kept (640x360px only - higher resolutions work worse on smaller resolutions). You need to specify video poster below if this mode is selected.</small>\
			</tr>\
			<tr>\
				<th><label for="vimeo-poster">Vimeo poster</label></th>\
				<td><input type="text" name="vimeo-poster" id="flow_vimeo_poster" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.</small>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide Title (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_vimeo" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="vimeo-submit" class="button-primary" value="Save Changes" name="submit" />\
		</p>\
		</div>');				
		var form_youtube = jQuery('<div id="youtube-form"><table id="vimeo-table" class="form-table">\
			<tr>\
				<th><label for="video-youtube">YouTube video link</label></th>\
				<td><textarea cols="50" rows="4" name="video-youtube" id="flow_video_youtube" value="" /><br />\
				<small>Specify YouTube <strong>video ID</strong> or video LINK here.</small>\
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
				<th><label for="slide-noresize">Fit screen mode (prevents video resizing)</label></th>\
				<td><input type="checkbox" name="slide-noresize" id="flow_slide_noresize_youtube" /><br />\
				<small>Select checkbox to disable video resizing. Original dimenions will be kept (640x360px only - higher resolutions work worse on smaller resolutions). You need to specify video poster below if this mode is selected.</small>\
			</tr>\
			<tr>\
				<th><label for="youtube-poster">YouTube poster</label></th>\
				<td><input type="text" name="youtube-poster" id="flow_youtube_poster" value="" /><span class="briskuploader button">Upload</span><br><div class="briskuploader_preview briskuploader_preview_popup"></div><br />\
				<small>Specify video poster image URL here (*.png or *.jpg). Leave blank if you want video player to create it for you. Video posters are images that are displayed before video is played or as background images when you keep original dimensions.</small>\
			</tr>\
			<tr>\
				<th><label for="slide-desc">Slide Title (optional)</label></th>\
				<td><textarea cols="50" rows="5" name="slide-desc" id="flow_slide_desc_youtube" value="" /><br />\
				<small>Specify slide description here. It will be displayed in the bottom left corner of each slide. Keep it short. Use <b>new line</b> or &lt;h4&gt; HTML tag to define heading.<br/> Example 1:<br/> <b>Slide Title</b><br/><b>Project description.</b> <br/> Example 2: <b>&lt;h4&gt;Slide Title&lt;/h4&gt; Project description.</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="youtube-submit" class="button-primary" value="Save Changes" name="submit" />\
		</p>\
		</div>');

		form_image.appendTo('body').hide();
		form_video.appendTo('body').hide();
		form_vimeo.appendTo('body').hide();
		form_youtube.appendTo('body').hide();
		jQuery(window).resize(resizethickboxf);
		
		try{
			briskuploader.inituploader();
		}catch(e){alert('uploader error');}
		
		jQuery(".image-icon").click(function() {
			performClearFormsbyFlow();
			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 104;
			tb_show( 'Add Image Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=image-form' );
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
			tb_show( 'Add Self-hosted Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=video-form' );
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
			tb_show( 'Add Vimeo Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=vimeo-form' );
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
			tb_show( 'Add YouTube Video Slide', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=youtube-form' );
			setTimeout(function(){resizethickboxf();},0);
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
			}
		});
	}

	printThickBoxesbyFlow();
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
			var slide_color = '<div class="r_color">#ffffff</div>';
			var slide_desc = '<div class="r_desc"></div>'; 
			var current_this = '<div class="current_this">image</div>';
			var slide_media = '<div class="r_media">' + images_path + '</div>';
			
			var fileSize = doUnitConversionbyFlow(data.size);
			var fileName = doShortenNamebyFlow(data.name);

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
		if($test['slide_desc']){ $test['slide_desc'] = str_replace("*", "\"", $test['slide_desc']); $slide_desc = '<div class="r_desc">' . $test['slide_desc'] . '</div>'; }else{ $slide_desc = '<div class="r_desc"></div>'; }
		if($test['image']){
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
		}elseif($test['video_mp4'] || $test['video_ogg'] || $test['video_webm']){
			$current_this = '<div class="current_this">video</div>';
			$slide_media_mp4 = '<div class="r_media_mp4">' . $test['video_mp4'] . '</div>';
			$slide_media_ogg = '<div class="r_media_ogg">' . $test['video_ogg'] . '</div>';
			$slide_media_webm = '<div class="r_media_webm">' . $test['video_webm'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = substr($test['video_mp4'],strrpos($test['video_mp4'], "/")+1);
			//if($image_info = getimagesize($test['video_mp4'])){}else if($image_info = getimagesize($test['video_ogg'])){}else{$image_info = getimagesize($test['video_webm']);}
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/video-preview.jpg";
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">Internal</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media_mp4.$slide_media_ogg.$slide_media_webm.$slide_media_poster.'</div></div>';
		}elseif($test['video_vimeo']){
			$current_this = '<div class="current_this">vimeo</div>';
			$slide_media = '<div class="r_media">' . $test['video_vimeo'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = 'Vimeo Slide';
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/vimeo-preview.jpg";
			if($test['slide_noresize'] == 'true'){
				$slide_noresize = '<div class="r_noresize">true</div>';
			}else{
				$slide_noresize = '<div class="r_noresize">false</div>';
			}
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">External</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.$slide_noresize.$slide_media_poster.'</div></div>';
		}elseif($test['video_youtube']){
			$current_this = '<div class="current_this">youtube</div>';
			$slide_media = '<div class="r_media">' . $test['video_youtube'] . '</div>';
			$slide_media_poster = '<div class="r_media_poster">' . $test['video_poster'] . '</div>';
			$filename = 'YouTube Slide';
			$self_hosted = get_bloginfo('template_directory')."/includes/uploadify/youtube-preview.jpg";
			if($test['slide_noresize'] == 'true'){
				$slide_noresize = '<div class="r_noresize">true</div>';
			}else{
				$slide_noresize = '<div class="r_noresize">false</div>';
			}
			echo '<div class="ready_image"><div class="remove-slide"></div><div class="overflow_cont"><img class="ready_image_img" style="display:none;" src="' . $self_hosted . '" alt="" /></div><div class="ready_image_title">' . $filename . '</div><div class="ready_image_size">External</div><div class="ready_image_desc">'.$current_this.$slide_desc.$slide_color.$slide_media.$slide_noresize.$slide_media_poster.'</div></div>';
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
<?php 	}

function get_meta_imagesampler( $args = array(), $value = false ) {
	extract( $args );
?>
	<th style="width:20%;">
	 <label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
	</th>
	<td>
<div class="imagesampler-uploader colorpickerholder2flow" style="position:relative;">	
	<input type="text" name="<?php  echo $name; ?>" id="<?php  echo $name; ?>" value="<?php  echo esc_html( $value ); ?>" size="30" tabindex="30" /> <span class="briskuploader button">Upload</span><br><div class="briskuploader_preview"></div>
	<input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

	<div class="container" style="width: 100%;">
		<div class="column1" style="width: auto;">
			<canvas id="panel" width="390" height="292"></canvas>
		</div>
		<div class="column2">
		<!--	<div>Preview:</div>
			<div id="preview"></div>
			<div>Color:</div>
			<div>R: <input type="text" id="rVal" /></div>
			<div>G: <input type="text" id="gVal" /></div>
			<div>B: <input type="text" id="bVal" /></div>
			<div>RGB: <input type="text" id="rgbVal" /></div>
			<div>RGBA: <input type="text" id="rgbaVal" /></div>--->
			<div style="margin-top: -18px;"><!--HEX:--> <input type="text" id="hexVal" class="attcolorpicker" name="<?php  echo 'thumbnail_hover_color'; ?>" value="" style="display:none;" /> <div class="colorSelector pickerlarge" style="top: 14px;"><div id="preview" style=""></div></div></div><p style="width:94px;padding-top:7px;margin-left: 7px;line-height:16px;">(Thumbnail highlight color on front page)</p>
		</div>
		<div style="clear:both;"></div>
	</div>
</div> 
<style type="text/css">
	.container { color:#000; margin: -10px auto 20px; position:relative; width:730px; }
	.column1 { float:left; width:500px; }
	.column2 { float:left; padding-left:20px; width:190px; }
	#panel { cursor:crosshair; }
	.column2 > div { margin-bottom:5px; }
	#swImage { border:1px #000 solid; cursor:pointer; height:25px; line-height:25px; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
	#swImage:hover { margin-left:2px; }
	#preview { border:1px #000 solid; height:80px; width:80px; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
	.column2 input[type=text] { /* float:right; */ width:110px; }
	.imagesampler-uploader .briskuploader_preview img { display: none; }
	.briskuploader_remove { z-index: 8; }
	.colorpicker input { background-color: transparent; border-color: transparent; }
</style>
<script type="text/javascript">
jQuery(document).ready(function() {

	//jQuery('#hexVal').ColorPicker({onChange : function() { alert('sth'); } });
	//jQuery('.colorSelector').ColorPicker({onChange : function() { alert('sth2'); } });
	var currentcolor = jQuery('#thumbnail_hover_color').val();
	jQuery('#hexVal').val(currentcolor);
	jQuery('#hexVal').ColorPickerSetColor(currentcolor);
	jQuery('.colorSelector').ColorPickerSetColor(currentcolor);
	jQuery('.colorSelector div').css({ 'background-color' : currentcolor });
	jQuery('.colorpicker').click(function(){ jQuery('#hexVal').trigger('change'); });
	jQuery('.colorpicker').mousemove(function(){ jQuery('#hexVal').trigger('change'); });
	jQuery('#hexVal').on('change', function() {
	var hexvarval = jQuery('#hexVal').val();
 jQuery('#thumbnail_hover_color').val(hexvarval);
});

	if(jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').find('img').attr("src") != ''){
		init_image_sampler_flow();
	}
	//jQuery('#<?php  echo str_replace('_color' , '', $name); ?>').change(function() {
	//jQuery('#<?php  echo $name; ?>').keypress(function() { // works immediately when user press button inside of the input
    //    jQuery(this).change(); // simulate "change" event
    //});
	jQuery('#<?php  echo $name; ?>').change(function() {
			jQuery('canvas').remove();
			jQuery('.column1').append('<canvas id="panel" width="390" height="292"></canvas>');
			
			setTimeout(function(){
				jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').find('img').css({'display':'none!important'});
				var img_src = jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').find('img');
				img_src.die("load");
				img_src.one('load', function(){
					init_image_sampler_flow();
				});
			}, 0);
	});
});

/* Copyright (c) 2011 Andrey Prikaznov (aramisgc@gmail.com || http://www.script-tutorials.com/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0
 *
 */ 

 /* Copyright (c) 2012 Pawe³ Kiec (flow)(paw.mcp@gmail.com) (Image sampler with color picker module)
 * and Rafa³ Kiec (Brisk uploader module)
 *
 * Version: 1.0
 *
 */ 
 
function init_image_sampler_flow(){
	var canvas;
	var ctx;
	
	var img_src = jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').find('img').attr("src");
	var images = [ // predefined array of used images
		img_src
	];
	var iActiveImage = 0;

	jQuery(function(){
			jQuery('#panel').off();
		// drawing active image
		var image = new Image();
		image.onload = function (){
			var image_height = image.height;
			var image_width = image.width;
			var image_ratio = image_width/image_height;
			if(image_width < image_height){
				if(image_height <= 292){ }else{ image_height2 = 292; image_width2 = image_height*image_ratio; }
			}else{
				if(image_width <= 390){ }else{ image_width2 = 390; image_height2 = (image_width2*image_height)/image_width; }
			}
			jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').find('img').css({'display':'none'});
			jQuery('#<?php  echo $name; ?>').parent().find('.briskuploader_preview').css({'width':'390px'});
			//ctx.drawImage(image, 0, 0, image.width, image.height); // draw the image on the canvas
			ctx.drawImage(image, 0, 0, image_width2, image_height2); // draw the image on the canvas
		}
		image.src = images[iActiveImage];

		// creating canvas object
		canvas = document.getElementById('panel');
		ctx = canvas.getContext('2d');

		jQuery('#panel').live("mousemove", function(e) { // mouse move handler
			var canvasOffset = jQuery(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);

			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;

			var pixelColor = "rgba("+pixel[0]+", "+pixel[1]+", "+pixel[2]+", "+pixel[3]+")";
			jQuery('#preview').css('backgroundColor', pixelColor);
		});
		jQuery('#panel').mouseleave(function(){
			var good_color = jQuery('.colorpicker_hex input').val();
			jQuery('#preview').css('backgroundColor', '#'+good_color);
		});

		jQuery('#panel').live("click",function(e) { // mouse click handler
			var canvasOffset = jQuery(canvas).offset();
			var canvasX = Math.floor(e.pageX - canvasOffset.left);
			var canvasY = Math.floor(e.pageY - canvasOffset.top);

			var imageData = ctx.getImageData(canvasX, canvasY, 1, 1);
			var pixel = imageData.data;

			//jQuery('#rVal').val(pixel[0]);
			//jQuery('#gVal').val(pixel[1]);
			//jQuery('#bVal').val(pixel[2]);

			//jQuery('#rgbVal').val(pixel[0]+','+pixel[1]+','+pixel[2]);
			//jQuery('#rgbaVal').val(pixel[0]+','+pixel[1]+','+pixel[2]+','+pixel[3]);
			var dColor = pixel[2] + 256 * pixel[1] + 65536 * pixel[0];
			var convstr = dColor.toString(16);
			while (convstr.length < 6) {
				convstr = '0' + convstr;
			}
			jQuery('#hexVal').val( '#' + convstr );
			jQuery('#thumbnail_hover_color').val( '#' + convstr );
			jQuery('.colorSelector div').css({ 'background-color' : '#' + convstr });
			jQuery('#hexVal').ColorPickerSetColor('#' + convstr);
			jQuery('.colorSelector').ColorPickerSetColor('#' + convstr);
		}); 

		jQuery('#swImage').live("click",function(e) { // switching images
			iActiveImage++;
			if (iActiveImage >= 10) iActiveImage = 0;
			image.src = images[iActiveImage];
		});
	});
}
	</script>
	
	 <input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	 <p style="color: #555;clear:both;">
	  <?php  echo $desc; ?>
	 </p>
	</td>
	</tr>
	<?php 
}

function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<?php 
		if($is_multiple){
			$page_portfolio_post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
			if($page_portfolio_post_id){
				$value = get_post_meta($page_portfolio_post_id, $name, true);
			}
		}
	?>
	<tr>
		<th style="width:20%;">
			<label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
		</th>
		<td>
			<select <?php  if($is_multiple){ echo ' multiple="multiple"'; } ?> name="<?php  echo $name; if($is_multiple){ echo '[]'; } ?>" id="<?php  echo $name; ?>">
			<?php  foreach ( $options as $optionkey => $optionval ) : 
			//htmlentities( $value, ENT_QUOTES )
			?>
				<option value="<?php  echo $optionkey; ?>" <?php  if($optionkey == $value) echo ' selected="selected"'; ?>><?php  echo $optionval; ?></option>
			<?php  endforeach; ?>
			</select>
			<p style="color: #555;">
				<?php  echo $desc; ?>
			</p>
			<input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php 
}

function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:20%;">
			<label for="<?php  echo $name; ?>"><?php  echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php  echo $name; ?>" id="<?php  echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php  echo esc_html( $value ); ?></textarea>
			<input type="hidden" name="<?php  echo $name; ?>_noncename" id="<?php  echo $name; ?>_noncename" value="<?php  echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p style="color: #555;">
				<?php  echo $desc; ?>
			</p>
		</td>
	</tr>
	<?php 
}

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
			$my_post['post_content'] = $data;
			remove_action('save_post', 'flowthemes_save_meta_data');
			wp_update_post( $my_post );
			add_action('save_post', 'flowthemes_save_meta_data');
		}
		 
		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
} ?>