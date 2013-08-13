<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Generate a metabox for posts
 *
 * /framework/metaboxes/post_meta.php
 * Version of this file : 1.5
 *
 */
?>
<?php
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {

	$theme_dir_bg = get_stylesheet_directory() ."/img/bg/";
	$theme_files_bg = stf_get_files( $theme_dir_bg, array( "jpg","png") );
	$bg=array();
	foreach ($theme_files_bg as $file) {
		$bg[]=array('name'=>$file,'value'=>$file);
	}

	$theme_dir_layout = get_stylesheet_directory() ."/framework/metaboxes/images/layouts/";
	$theme_files_layout = stf_get_files( $theme_dir_layout, array( "jpg","png") );
	$layout=array();
	foreach ($theme_files_layout as $file) {
		$layout[]=array('name'=>$file,'value'=>$file);
	}

	$meta_boxes[] = array(
		'id'         => 'post_metabox',
		'title'      => 'Aleph Post Metabox',
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => array(
			            array( 'name' => 'Homepage Appearance', 'value' => 'featured', ),
			            array( 'name' => 'Background', 'value' => 'background', ),
			        )
			    ),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Featured',
				'desc' => 'Check this if you would like this project to be featured on homepage',
				'id' => 'home_featured',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Caption',
				'desc' => 'Will be used in the fullwidth slideshow',
				'id' => 'home_featured_caption',
				'type' => 'textarea',
			),
			array(
				'name' => 'Show title/caption',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_showtext',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'    => 'Title/caption position',
				'desc'    => '',
				'id'      => 'home_featured_positiontext',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Top Left', 'value' => 'topLeft', ),
					array( 'name' => 'Top Center', 'value' => 'topCenter', ),
					array( 'name' => 'Top Right', 'value' => 'topRight', ),
					array( 'name' => 'Middle Left', 'value' => 'middleLeft', ),
					array( 'name' => 'Center', 'value' => 'center', ),
					array( 'name' => 'Middle Right', 'value' => 'middleRight', ),
					array( 'name' => 'Bottom Left', 'value' => 'bottomLeft', ),
					array( 'name' => 'Bottom Center', 'value' => 'bottomCenter', ),
					array( 'name' => 'Bottom Right', 'value' => 'bottomRight', ),
					),
			),
			array(
				'name'    => 'Text style',
				'desc'    => __('Light or Dark','alephtheme'),
				'id'      => 'home_featured_contentstyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Light', 'value' => 'light', ),
					array( 'name' => 'Dark', 'value' => 'dark', ),
					),
			),
			array(
				'name' => 'Show content background',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_contentbackground',
				'type' => 'checkbox',
				'std' => "0"
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if Image was selected','alephtheme'),
				'id'      => 'home_featured_mediatype',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'Image', ),
					array( 'name' => 'Video', 'value' => 'Video', ),
					),
			),
			array(
				'name'    => 'Image style',
				'desc'    => __('Contain (show full image) or Cover (fill screen)','alephtheme'),
				'id'      => 'home_featured_imagestyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Cover', 'value' => 'cover', ),
					array( 'name' => 'Contain', 'value' => 'contain', ),
					),
			),
			array(
				'name'    => 'Video provider',
				'desc'    => __('','alephtheme'),
				'id'      => 'home_featured_videoprovider',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Vimeo', 'value' => 'Vimeo', ),
					array( 'name' => 'YouTube', 'value' => 'YouTube', ),
					),
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Enter the ID of the video only',
				'id' => 'home_featured_videourl',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'background',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Custom background',
				'desc' => 'Check this option if you want to choose a different background from the one set in the aleph admin panel',
				'id' => 'different_bg',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Background',
				'desc' => '',
				'id' => 'post_bg',
				'type' => 'radio_image',
				'cat'=>'bg',
				'std'=>$bg[0]['value'],
				'options' => $bg
			),
			array(
				'name' => 'Custom Background',
				'desc' => 'Upload an image or enter an URL. To delete the image, delete the content in the text field and save the changes.',
				'id'   => 'post_bg_custom',
				'type' => 'file',
				'save_id'=>'false'
			),
			array(
				'name'    => 'Background repeat',
				'desc'    => 'Please note that if the option "Background stretch" was selected in the admin panel, these settings will have no effect.',
				'id'      => 'post_bg_custom_repeat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No repeat', 'value' => 'no-repeat', ),
					array( 'name' => 'Repeat all', 'value' => 'repeat', ),
					array( 'name' => 'Repeat horizontal', 'value' => 'repeat-x', ),
					array( 'name' => 'Repeat vertical', 'value' => 'repeat-y', )
				),
			),
			array(
				'name'    => 'Background attachment',
				'desc'    => 'Please see the note above',
				'id'      => 'post_bg_custom_attachment',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Scroll normally', 'value' => 'scroll', ),
					array( 'name' => 'Fixed in place', 'value' => 'fixed', )
				),
			),
			array(
			    'type' => 'close',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'Page Metabox',
		'pages'      => array( 'page'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => array(
			            array( 'name' => 'General', 'value' => 'general', ),
			            array( 'name' => 'Background', 'value' => 'background', ),
			            array( 'name' => 'Portfolio', 'value' => 'portfolio', ),
			            array( 'name' => 'Blog grid', 'value' => 'blog_grid', ),
			            array( 'name' => 'Homepage appearance', 'value' => 'featured', ),
			        )
			   	),
			array(
			    'type' => 'section',
			    'id' => 'general',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Page level',
				'desc' => 'Define this post as a top level, sub-level post or none',
				'id' => 'level',
				'type' => 'select',
				'options' => array(
					array('name' => 'None', 'value' => 'none'),
					array('name' => 'Sub', 'value' => 'sub'),
					array('name' => 'Top', 'value' => 'top')
				)
			),
			array(
				'name' => 'Top Level Post',
				'desc' => 'Link this post to a top level post',
				'id' => 'level_top',
				'taxonomy' => 'toplevel', //Enter Taxonomy Slug
				'type' => 'taxonomy_toplevel',
			),
			array(
				'name' => 'Hide from main navigation',
				'desc' => 'Hide this top page from appearing in the main navigation arrows.',
				'id' => 'level_top_hide',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Close link',
				'desc' => 'By default, clicking on the close link will open the top level. You can set another top level page here (including homepage).',
				'id' => 'level_sub_target',
				'taxonomy' => 'toplevel_home', //Enter Taxonomy Slug
				'type' => 'taxonomy_toplevel',
			),
			array(
				'name' => 'Fullwidth',
				'desc' => 'Disable the comments sidebar',
				'id' => 'page_full',
				'type' => 'checkbox',
				'std' => 1
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'background',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Custom background',
				'desc' => 'Check this option if you want to choose a different background from the one set in the aleph admin panel',
				'id' => 'different_bg',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Background',
				'desc' => '',
				'id' => 'post_bg',
				'type' => 'radio_image',
				'cat'=>'bg',
				'std'=>$bg[0]['value'],
				'options' => $bg
			),
			array(
				'name' => 'Custom Background',
				'desc' => 'Upload an image or enter an URL. To delete the image, delete the content in the text field and save the changes.',
				'id'   => 'post_bg_custom',
				'type' => 'file',
				'save_id'=>'false'
			),
			array(
				'name'    => 'Background repeat',
				'desc'    => 'Please note that if the option "Background stretch" was selected in the admin panel, these settings will have no effect.',
				'id'      => 'post_bg_custom_repeat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No repeat', 'value' => 'no-repeat', ),
					array( 'name' => 'Repeat all', 'value' => 'repeat', ),
					array( 'name' => 'Repeat horizontal', 'value' => 'repeat-x', ),
					array( 'name' => 'Repeat vertical', 'value' => 'repeat-y', )
				),
			),
			array(
				'name'    => 'Background attachment',
				'desc'    => 'Please see the note above',
				'id'      => 'post_bg_custom_attachment',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Scroll normally', 'value' => 'scroll', ),
					array( 'name' => 'Fixed in place', 'value' => 'fixed', )
				),
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'portfolio',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name'    => 'Portfolio style',
				'desc'    => 'Masonry/FitRows (1 or more items per row)',
				'id'      => 'portfolio_style',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'FitRows', 'value' => 'fitrows' ),
					array( 'name' => 'Masonry', 'value' => 'masonry' ),
				),
			),
			array(
				'name' => 'Show specific fields',
				'desc' => 'Choose if you want to show only projects from a specific field',
				'id' => 'portfolio_tax_specific',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'     => 'Show only posts from these fields',
				'desc'     => 'If you choose a specific field to show, then the filtering bar will not appear, even if the option below is checked.',
				'id'       => 'portfolio_tax',
				'type'     => 'tax_select',
				'taxonomy' => 'field', // Taxonomy Slug
			),
			array(
				'name' => 'Show filtering bar',
				'desc' => 'Show filtering options below the main menu',
				'id' => 'portfolio_filter',
				'type' => 'checkbox',
				'std' => 1
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'blog_grid',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name'    => 'Blog grid',
				'desc'    => 'Number of posts per row (Please note that this will only apply to regular screen size -over 767px-. Below this screen size, responsive layout will apply)',
				'id'      => 'post_per_row',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '1', 'value' => '1' ),
					array( 'name' => '2', 'value' => '2' ),
					array( 'name' => '3', 'value' => '3' ),
					array( 'name' => '4', 'value' => '4' )
				),
			),
			array(
				'name' => 'Show specific category',
				'desc' => 'Choose if you want to show only projects from a specific category',
				'id' => 'blog_tax_specific',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'     => 'Show only posts from these categories',
				'desc'     => 'If you choose a specific category to show, then the filtering list will not appear, even if the option below is checked.',
				'id'       => 'blog_tax',
				'type'     => 'tax_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name' => 'Show filtering list',
				'desc' => '',
				'id' => 'blog_filter',
				'type' => 'checkbox',
				'std' => 1
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Featured',
				'desc' => 'Check this if you would like this project to be featured on homepage',
				'id' => 'home_featured',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Caption',
				'desc' => 'Will be used in the fullwidth slideshow',
				'id' => 'home_featured_caption',
				'type' => 'textarea',
			),
			array(
				'name' => 'Show title/caption',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_showtext',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'    => 'Title/caption position',
				'desc'    => '',
				'id'      => 'home_featured_positiontext',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Top Left', 'value' => 'topLeft', ),
					array( 'name' => 'Top Center', 'value' => 'topCenter', ),
					array( 'name' => 'Top Right', 'value' => 'topRight', ),
					array( 'name' => 'Middle Left', 'value' => 'middleLeft', ),
					array( 'name' => 'Center', 'value' => 'center', ),
					array( 'name' => 'Middle Right', 'value' => 'middleRight', ),
					array( 'name' => 'Bottom Left', 'value' => 'bottomLeft', ),
					array( 'name' => 'Bottom Center', 'value' => 'bottomCenter', ),
					array( 'name' => 'Bottom Right', 'value' => 'bottomRight', ),
					),
			),
			array(
				'name'    => 'Text style',
				'desc'    => __('Light or Dark','alephtheme'),
				'id'      => 'home_featured_contentstyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Light', 'value' => 'light', ),
					array( 'name' => 'Dark', 'value' => 'dark', ),
					),
			),
			array(
				'name' => 'Show content background',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_contentbackground',
				'type' => 'checkbox',
				'std' => "0"
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if Image was selected','alephtheme'),
				'id'      => 'home_featured_mediatype',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'Image', ),
					array( 'name' => 'Video', 'value' => 'Video', ),
					),
			),
			array(
				'name'    => 'Image style',
				'desc'    => __('Contain (show full image) or Cover (fill screen)','alephtheme'),
				'id'      => 'home_featured_imagestyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Cover', 'value' => 'cover', ),
					array( 'name' => 'Contain', 'value' => 'contain', ),
					),
			),
			array(
				'name'    => 'Video provider',
				'desc'    => __('','alephtheme'),
				'id'      => 'home_featured_videoprovider',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Vimeo', 'value' => 'Vimeo', ),
					array( 'name' => 'YouTube', 'value' => 'YouTube', ),
					),
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Enter the ID of the video only',
				'id' => 'home_featured_videourl',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'portfolio_metabox',
		'title'      => 'Portfolio Metabox',
		'pages'      => array( 'portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => array(
			            array( 'name' => 'General', 'value' => 'general', ),
			            array( 'name' => 'Layout', 'value' => 'layout', ),
			            array( 'name' => 'Featured media', 'value' => 'media', ),
			            array( 'name' => 'Homepage appearance', 'value' => 'featured', ),
			            array( 'name' => 'Background', 'value' => 'background', ),
			        )
			    ),
			array(
			    'type' => 'section',
			    'id' => 'general',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Close link',
				'desc' => 'By default, clicking on the close link will open the portfolio page defined in the admin panel. You can set another top level page here (including homepage). This option is useful in case you have multiple portfolios',
				'id' => 'portfolio_toplevel',
				'taxonomy' => 'toplevel_home', //Enter Taxonomy Slug
				'type' => 'taxonomy_toplevel',
				'std' => 'portfolio'
			),
			array(
				'name' => 'External Link',
				'desc' => 'Link this portfolio project to an external link',
				'id' => 'project_external_link',
				'type' => 'text'
			),
			array(
				'name' => 'Hide from navigation arrows',
				'desc' => 'Check this if you would like to hide this project from the top navigation arrows (example if the project is linked to an external link)',
				'id' => 'portfolio_hide',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'layout',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Layout',
				'desc' => 'Choose the layout of this project',
				'id' => 'layout',
				'type' => 'radio_image',
				'cat'=>'layout',
				'std'=>$layout[0]['value'],
				'options' => $layout
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'media',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Media display',
				'desc' => 'Select how the media attached to this project',
				'id' => 'media_display',
				'type' => 'select',
				'options' => array(
					array('name' => 'Slider', 'value' => 'slider'),
					array('name' => 'Image (single)', 'value' => 'image_single'),
					array('name' => 'Image (stack)', 'value' => 'image_stack'),
					array('name' => 'Video', 'value' => 'video')
				)
			),
			array(
				'name' => 'Slider layout',
				'desc' => 'Select how to display the slider',
				'id' => 'slider_layout',
				'type' => 'select',
				'options' => array(
					array('name' => 'Macbook pro', 'value' => 'macbookpro'),
					array('name' => 'iMac', 'value' => 'imac'),
					array('name' => 'iPad', 'value' => 'ipad')	,
					array('name' => 'iPhone', 'value' => 'iphone')	,
					array('name' => 'None', 'value' => 'none')
				)
			),
			array(
				'name' => 'Slider resize',
				'desc' => 'Whenever images do not fit into the slider, resize the image to show the whole width or the whole height',
				'id' => 'slider_resize',
				'type' => 'select',
				'options' => array(
					array('name' => 'Width', 'value' => 'width'),
					array('name' => 'Height', 'value' => 'height')
				)
			),
			array(
				'name' => 'Video provider',
				'desc' => 'Enter the video provider',
				'id' => 'project_video_site',
				'type' => 'text',
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Enter the video ID only',
				'id' => 'project_video',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Featured',
				'desc' => 'Check this if you would like this project to be featured on homepage',
				'id' => 'home_featured',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Caption',
				'desc' => 'Will be used in the fullwidth slideshow',
				'id' => 'home_featured_caption',
				'type' => 'textarea',
			),
			array(
				'name' => 'Show title/caption',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_showtext',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'    => 'Title/caption position',
				'desc'    => '',
				'id'      => 'home_featured_positiontext',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Top Left', 'value' => 'topLeft', ),
					array( 'name' => 'Top Center', 'value' => 'topCenter', ),
					array( 'name' => 'Top Right', 'value' => 'topRight', ),
					array( 'name' => 'Middle Left', 'value' => 'middleLeft', ),
					array( 'name' => 'Center', 'value' => 'center', ),
					array( 'name' => 'Middle Right', 'value' => 'middleRight', ),
					array( 'name' => 'Bottom Left', 'value' => 'bottomLeft', ),
					array( 'name' => 'Bottom Center', 'value' => 'bottomCenter', ),
					array( 'name' => 'Bottom Right', 'value' => 'bottomRight', ),
					),
			),
			array(
				'name'    => 'Text style',
				'desc'    => __('Light or Dark','alephtheme'),
				'id'      => 'home_featured_contentstyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Light', 'value' => 'light', ),
					array( 'name' => 'Dark', 'value' => 'dark', ),
					),
			),
			array(
				'name' => 'Show content background',
				'desc' => 'Check this to show the title/caption the slide',
				'id' => 'home_featured_contentbackground',
				'type' => 'checkbox',
				'std' => "0"
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if Image was selected','alephtheme'),
				'id'      => 'home_featured_mediatype',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'Image', ),
					array( 'name' => 'Video', 'value' => 'Video', ),
					),
			),
			array(
				'name'    => 'Image style',
				'desc'    => __('Contain (show full image) or Cover (fill screen)','alephtheme'),
				'id'      => 'home_featured_imagestyle',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Cover', 'value' => 'cover', ),
					array( 'name' => 'Contain', 'value' => 'contain', ),
					),
			),
			array(
				'name'    => 'Video provider',
				'desc'    => __('','alephtheme'),
				'id'      => 'home_featured_videoprovider',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Vimeo', 'value' => 'Vimeo', ),
					array( 'name' => 'YouTube', 'value' => 'YouTube', ),
					),
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Enter the ID of the video only',
				'id' => 'home_featured_videourl',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'background',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Custom background',
				'desc' => 'Check this option if you want to choose a different background from the one set in the aleph admin panel',
				'id' => 'different_bg',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name' => 'Background',
				'desc' => '',
				'id' => 'post_bg',
				'type' => 'radio_image',
				'cat'=>'bg',
				'std'=>$bg[0]['value'],
				'options' => $bg
			),
			array(
				'name' => 'Custom Background',
				'desc' => 'Upload an image or enter an URL. To delete the image, delete the content in the text field and save the changes.',
				'id'   => 'post_bg_custom',
				'type' => 'file',
				'save_id'=>'false'
			),
			array(
				'name'    => 'Background repeat',
				'desc'    => 'Please note that if the option "Background stretch" was selected in the admin panel, these settings will have no effect.',
				'id'      => 'post_bg_custom_repeat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No repeat', 'value' => 'no-repeat', ),
					array( 'name' => 'Repeat all', 'value' => 'repeat', ),
					array( 'name' => 'Repeat horizontal', 'value' => 'repeat-x', ),
					array( 'name' => 'Repeat vertical', 'value' => 'repeat-y', )
				),
			),
			array(
				'name'    => 'Background attachment',
				'desc'    => 'Please see the note above',
				'id'      => 'post_bg_custom_attachment',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Scroll normally', 'value' => 'scroll', ),
					array( 'name' => 'Fixed in place', 'value' => 'fixed', )
				),
			),
			array(
			    'type' => 'close',
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once (get_template_directory(). '/framework/metaboxes/init.php');

}