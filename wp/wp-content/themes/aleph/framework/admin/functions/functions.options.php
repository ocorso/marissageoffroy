<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/admin/functions/functions.options.php
 * Version of this file : 1.7
 *
 */
?>
<?php

include( get_template_directory() . '/framework/admin/google-fonts.php' );

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");

		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");

		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }
		    }
		}

		// List of social services
		$social_links = array(	"facebook" => "Facebook",
								"flickr" => "Flickr",
								"google" => "Google",
								"linkedin" => "LinkedIn",
								"pinterest" => "Pinterest",
								"skype" => "Skype",
								"twitter" => "Twitter",
								"vimeo" => "Vimeo",
								"youtube" => "YouTube"
							);

		// List of social share
		$social_share = array(	"delicious" => "Delicious",
								"digg" => "Digg",
								"facebook" => "Facebook",
								"googleplus" => "Google +",
								"linkedin" => "LinkedIn",
								"stumbleupon" => "StumbleUpon",
								"twitter" => "Twitter"
							);

		// Fonts
		$google_fonts = array("body" => __("Body","alephtheme"),"meta" => __("Meta","alephtheme"),"all"=>__("All","alephtheme"));
		if ( !function_exists( 'stf_get_files' ) ) {
			function stf_get_files( $directory, $filter = array( "*" ) ){
				$results = array(); // Result array
				$filter = (array) $filter; // Cast to array if string given
				// Open directory
				$handler = opendir( $directory );
				// Loop through files
				while ( $file = readdir($handler) ) {
					// Jump over directories.
					if( is_dir( $file ) )
						continue;
					// Prepare file extension
					$extension = end( explode( ".", $file ) ); // Eg. "jpg"
					// If extension fits add it to array
					if ( $file != "." && $file != ".." && ( in_array( $extension, $filter ) || in_array( "*", $filter ) ) ) {
						$results[] = $file;
					}
				}
				// Close handler
				closedir($handler);
				// Return
				return $results;
			}
		}
		// Path for cufon images
		$imagepath_cufon =  get_template_directory_uri() . '/js/fonts/cufon/Samples/';
		// Build the array of options
		$theme_dir = get_stylesheet_directory();
		$theme_dir .= "/js/fonts/cufon/Samples";
		$theme_files = stf_get_files( $theme_dir, array( "png") );
		$cufon=array();
		$font="";
		foreach ($theme_files as $file) {
			// Get the name of file (without extension)
			$file=explode(".",$file);
			// Build the name of font (with extension)
			$font= $file[0] . ".font.js";
			$cufon[$font]=$imagepath_cufon . $file[0] . ".font." . $file[2] . "";
			$cufon2[$font]=$file[0];
		}

		// Path for map pin images
		$imagepath_pin =  get_template_directory_uri() . '/img/map_pins/';

		// Path for backgrounds
		$imagepath_bg =  get_template_directory_uri() . '/img/bg/thumbs/';
		// Build the array of options
		$theme_dir_bg = get_stylesheet_directory() ."/img/bg/thumbs/";
		$theme_files_bg = stf_get_files( $theme_dir_bg, array( "jpg","png") );
		$bg=array();
		foreach ($theme_files_bg as $file) {
			$bg[$file]=$imagepath_bg . $file;
		}
		$bg["Custom"]=get_template_directory_uri().'/framework/admin/assets/images/custom_bg.png';


		$blog_query = new WP_Query( 'pagename=blog' );
		if($blog_query->have_posts()) {
			$blog_query->the_post();
				$blog_link=get_permalink();
			wp_reset_postdata();
		} else {
			$blog_link=home_url().'/';
		}

		$portfolio_query = new WP_Query( 'pagename=portfolio' );
		if($portfolio_query->have_posts()) {
			$portfolio_query->the_post();
				$portfolio_link=get_permalink();
			wp_reset_postdata();
		} else {
			$portfolio_link=home_url().'/';
		}


		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"home_intro"		=> __("Introduction","alephtheme"),
				"home_separator"	=> __("Separator line","alephtheme"),
				"home_works"		=> __("Featured Works","alephtheme")
			),
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
			),
		);

		//Background Images Reader
		$bg_images_path = get_template_directory_uri(). '/img/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }
		    }
		}
		$bg_images[] = 	get_template_directory_uri().'/framework/admin/assets/images/custom_bg.png';
		$bg_images[] = 	get_template_directory_uri().'/framework/admin/assets/images/none_bg.png';

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => __("The Image","alephtheme"),"post" => __("The Post"));


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


	/* -------------------------------------------------------
	   TAB 1 : General
	   -------------------------------------------------------*/

		$of_options[] = array( "name" => __("General Settings","alephtheme"),
							"type" => "heading");

			$of_options[] = array( "name" => __("Custom Favicon","alephtheme"),
								"desc" => __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.","alephtheme"),
								"id" => "general_favicon",
								"std" => get_template_directory_uri() . '/favicon.ico',
								"type" => "upload");

			$of_options[] = array( "name" => __("Custom log-in screen","alephtheme"),
								"desc" => __("Activate the custom log-in screen.","alephtheme"),
								"id" => "general_login_screen",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Add a link to home in the main menu","alephtheme"),
								"desc" => __("If you want to add a link to home (in addition to the logo that is linked to the homepage), you must enable this option.","alephtheme"),
								"id" => "general_menu_home",
								"std" => "0",
								"folds" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => "Home link text",
								"id" => "general_menu_home_text",
								"std" => "Home",
								"fold" => "general_menu_home",
								"type" => "text");


	/* -------------------------------------------------------
	   TAB 2 : Styling & Colors
	   -------------------------------------------------------*/

		$of_options[] = array( "name" => __("Styling and Colors","alephtheme"),
							"type" => "heading");

		$of_options[] = array( "name" => __("Typography","alephtheme"),
							"desc" => __("Body","alephtheme"),
							"id"   => "typo_body",
							"std"  => array('size'=>'13px','face'=>'helvetica','style'=>'normal','color'=>'#C6C6C6'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Links","alephtheme"),
							"id"   => "typo_link",
							"std"  => array('size'=>'13px','face'=>'helvetica','style'=>'normal','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 1 (H1)","alephtheme"),
							"id"   => "typo_h1",
							"std"  => array('size'=>'80px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 2 (H2)","alephtheme"),
							"id"   => "typo_h2",
							"std"  => array('size'=>'45px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 3 (H3)","alephtheme"),
							"id"   => "typo_h3",
							"std"  => array('size'=>'24px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 4 (H4)","alephtheme"),
							"id"   => "typo_h4",
							"std"  => array('size'=>'16px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 5 (H5)","alephtheme"),
							"id"   => "typo_h5",
							"std"  => array('size'=>'15px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 6 (H6)","alephtheme"),
							"id"   => "typo_h6",
							"std"  => array('size'=>'12px','face'=>'helvetica','style'=>'bold','color'=>'#FFFFFF'),
							"type" => "typography");

			$of_options[] = array( "name" => __("Body background : Default","alephtheme"),
								"desc" => "",
								"id" => "body_bg",
								"std" => "bg1.jpg",
								"type" => "images",
								"options" => $bg);

			$of_options[] = array( "name" =>  __("Body Background : Custom","alephtheme"),
								"desc" => "",
								"id" => "body_custom_bg",
								"std" => "",
								"class" => "hidden",
								"type" => "media");

			$of_options[] = array("name"=>"",
								"desc" => "",
								"id" => "body_custom_bg_color",
								"std"=>"",
								"class" => "hidden",
								"type" => "color");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "body_custom_bg_repeat",
								"options" => $body_repeat,
								"std"=>"no-repeat",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "body_custom_bg_position",
								"options" => $body_pos,
								"std"=>"top left",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "body_custom_bg_attachment",
								"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
								"std"=>"fixed",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array ("id"=>"", "type" => "clear");

			$of_options[] = array( "name" => __("Background Stretch","alephtheme"),
								"desc" => __("Make the background fit the screen (Recommended)","alephtheme"),
								"id" => "body_bg_size",
								"std"=>"1",
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Background overlay","alephtheme"),
								"desc" => __("Add a transparent dark layer over the background (Recommended)","alephtheme"),
								"id" => "body_bg_overlay",
								"std"=>"1",
								"type" => "checkbox");

		$of_options[] = array( "name" => __("Custom CSS","alephtheme"),
							"desc" => __('Add your custom styles here','alephtheme'),
							"id" => "custom_css",
							"std" => "",
							"type" => "textarea");

	/* -------------------------------------------------------
	   TAB 3 : Typography
	   -------------------------------------------------------*/

	$of_options[] = array ("name" => "Typography",
						"type" => "heading");

$of_options[] = array( "name" => __("Choosing Cufon Fonts","alephtheme"),
					"desc" => "",
					"id" => "choosing_fonts",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Using Cufon fonts</h3>
					- Click on <strong>Activate Cufon</strong><br/>
					- Choose the font you wish, then in the <em>Elements</em> input, enter the selectors (<em>example : h1, a.link, p#paragraph, ...</em>)<br/>
					- You can also enable a second font, Activate <strong>Font 2</strong>, and follow the same steps as above.<br><br><strong><u>Note</u></strong> : Google fonts are already integrated in the dropdown lists in the <strong>Styling & Colors</strong> tab.",
					"icon" => true,
					"type" => "info");

			$of_options[] = array( "name" => __("Activate Cufon","alephtheme"),
								"desc" => __("Check this option and then choose your font","alephtheme"),
								"id" => "cufon_activate",
								"std"=>"0",
								"folds"=>1,
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Font 1 - Choose Font","alephtheme"),
								"desc" => "",
								"id" => "cufon_font1_source",
								"std" => "Cabin_400-Cabin_700-Cabin_italic_400-Cabin_italic_700.font.js",
								"type" => "images",
								"fold"=>"cufon_activate",
								"options" => $cufon);

			$of_options[] = array( "name" => __("Font 1 - Elements","alephtheme"),
								"desc" => __("Apply the first font to the following elements. Enter the list of elements separated by a comma (e.g : h1, a, .class)","alephtheme"),
								"id" => "cufon_font1_class",
								"std" => "h1, h2, h3, h4, h6",
								"fold"=>"cufon_activate",
								"type" => "text");

			$of_options[] = array( "name" => __("Font 2","alephtheme"),
								"desc" => __("Check this option to activate a second font","alephtheme"),
								"id" => "cufon_font2_activate",
								"fold"=>"cufon_activate",
								"std" => "0",
								"folds"=>1,
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Font 2 - Choose Font","alephtheme"),
								"desc" => "",
								"id" => "cufon_font2_source",
								"std" => "Cabin_400-Cabin_700-Cabin_italic_400-Cabin_italic_700.font.js",
								"type" => "select",
								"fold"=>"cufon_font2_activate",
								"options" => $cufon2);

			$of_options[] = array( "name" => __("Font 2 - Elements","alephtheme"),
								"desc" => __("Apply the second font to the following elements. Enter the list of elements separated by a comma (e.g : h1, a, .class)","alephtheme"),
								"id" => "cufon_font2_class",
								"std" => "a",
								"fold"=>"cufon_font2_activate",
								"type" => "text");

	/* -------------------------------------------------------
	   TAB 6 : Header
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Header","alephtheme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Upload logo","alephtheme"),
							"desc" => __("If there is no logo image, the title and description of your website will be used.","alephtheme"),
							"id" => "logo_image",
							"std" => "",
							"type" => "media");

		$of_options[] = array( "name" => __("Logo spacing","alephtheme"),
							"desc" => __("You can set the top and bottom spacing of the logo. The resulting total spacing will be the double of the chosen value (for top and bottom).","alephtheme"),
							"id" => "logo_spacing",
							"min" => "0",
							"max" => "50",
							"std" => "0",
							"step" => "1",
							"unit" => "px",
							"type" => "range");

		$of_options[] = array( "name" => __("Fullscreen button","alephtheme"),
							"desc" => __("A button allowing to switch to fullscreen view will be displayed in top right corner (if this feature is supported by the browser)","alephtheme"),
							"id" => "header_fullscreen",
							"std" => "1",
							"type" => "checkbox");

	/* -------------------------------------------------------
	   TAB 7 : Footer
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Footer","alephtheme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Custom text","alephtheme"),
							"desc" => __("Text that will be added below the menu in footer (e.g. Copyright text)","alephtheme"),
							"id" => "footer_text",
							"std" => "Copyright &copy; 2012 My Site",
							"options" => array("rows"=>"2"),
							"type" => "textarea");

		$of_options[] = array( "name" => __("Footer custom code","alephtheme"),
							"desc" => __("Custom code to add to the footer (e.g : google analytics code)","alephtheme"),
							"id" => "footer_code",
							"std" => "",
							"type" => "textarea");

			$of_options[] = array( "name" => __("Show footer sidebar area","alephtheme"),
								"desc" => __("Check this option and then choose the widgets in Appearance > Widgets","alephtheme"),
								"id" => "footer_sidebar_activate",
								"std"=>0,
								"folds"=>1,
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Activate social links","alephtheme"),
								"desc" => __("Check this option and then choose the services and add your links","alephtheme"),
								"id" => "footer_social_activate",
								"std"=>0,
								"folds"=>1,
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Services","alephtheme"),
								"desc" => __("Check the social services to show","alephtheme"),
								"id" => "footer_social_services",
								"fold"=>"footer_social_activate",
								"std" => "", // These items get checked by default
								"type" => "multicheck",
								"options" => $social_links);

			$of_options[] = array( "name" => __("Links","alephtheme"),
								"desc" => __("Enter the link for each service","alephtheme"),
								"id" => "footer_social_links",
								"fold"=>"footer_social_activate",
								"std" => "", // These items get checked by default
								"type" => "multitext",
								"options" => $social_links);

			$of_options[] = array( "name" => __("Tooltips","alephtheme"),
								"desc" => __("Enter the message that will appear on mouseouver for each service","alephtheme"),
								"id" => "footer_social_tip",
								"fold"=>"footer_social_activate",
								"std" => "", // These items get checked by default
								"type" => "multitext",
								"options" => $social_links);

		$of_options[] = array ("id"=>"", "type" => "clear");

	/* -------------------------------------------------------
	   TAB 4 : Homepage
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Homepage","alephtheme"),
						"type" => "heading");

		$of_options[] = array( "name" =>  __('Style','alephtheme'),
							"desc" => "Select the homepage style",
							"id" => "home_style",
							"options" => array('Fullwidth slideshow','Welcome message/Featured slider'),
							"std"=>"center",
							"type" => "select");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "",
							"id" => "slider_info1",
							"std" => "Adjust settings of the Fullwidth Slideshow in the tab <strong>1-Settings</strong><br/>Manage slides in the tab <strong>1-Slides</strong>",
							"type" => "info");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "",
							"id" => "slider_info2",
							"std" => "Manage slides in the tab <strong>3-Slides</strong>",
							"type" => "info");

		$of_options[] = array( "name" => __("Homepage Layout Manager","alephtheme"),
							"desc" => __("Organize how you want the layout to appear on the homepage","alephtheme"),
							"id" => "home_blocks",
							"std" => $of_options_homepage_blocks,
							"type" => "sorter");

		$of_options[] = array( "name" => __("Homepage Introduction","alephtheme"),
							"desc" => "Title",
							"id" => "home_intro_title",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Description","alephtheme"),
							"id" => "home_intro_desc",
							"std" => "",
							"type" => "textarea");

		$of_options[] = array( "name" => __("Featured Works section","alephtheme"),
							"desc" => __("Time between slides","alephtheme"),
							"id" => "home_works_interval",
							"min" => "0",
							"max" => "20000",
							"std" => "5000",
							"step" => "50",
							"unit" => "ms",
							"type" => "range");

		$of_options[] = array( "name" => "",
							"desc" => __("Speed of transition","alephtheme"),
							"id" => "home_works_duration",
							"min" => "0",
							"max" => "2000",
							"std" => "500",
							"step" => "50",
							"unit" => "ms",
							"type" => "range");

		$of_options[] = array( "name" => "",
							"desc" => __("Pause slideshow on hover of slide","alephtheme"),
							"id" => "home_works_hover",
							"std" => "1",
							"type" => "checkbox");

		/* -------------------------------------------------------
		   SUB-TAB 1 : Fullwidth Slider settings
		   -------------------------------------------------------*/

		$of_options[] = array( "name" => __('1-Settings',"alephtheme"),
							"class" => "indent",
							"type" => "heading");

			$of_options[] = array( "name" => __("Slider background","aleph-theme"),
								"desc" => "",
								"id" => "home_slider_bg",
								"std"=>"",
								"type" => "tiles",
								"options" => $bg_images);

			$of_options[] = array( "name" =>  "",
								"desc" => __("Custom background","aleph-theme"),
								"id" => "bg_home_slider_custom",
								"std" => "",
								"class" => "hidden",
								"type" => "media");

			$of_options[] = array("name"=>"",
								"desc" => "",
								"id" => "bg_home_slider_custom_color",
								"std"=>"",
								"class" => "hidden",
								"type" => "color");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "bg_home_slider_custom_repeat",
								"options" => $body_repeat,
								"std"=>"no-repeat",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "bg_home_slider_custom_position",
								"options" => $body_pos,
								"std"=>"top left",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => "bg_home_slider_custom_attachment",
								"options" => array('scroll' => 'scroll', 'fixed' => 'fixed'),
								"std"=>"fixed",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array ("id"=>"", "type" => "clear");

			$of_options[] = array( "name" => "Slider settings",
								"desc" => __("Animation loop","aleph-theme"),
								"id" => "home_slider_settings_18",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Smooth Height (Allow height of the slider to animate smoothly in horizontal mode)","aleph-theme"),
								"id" => "home_slider_settings_4",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Slide the slider should start on","aleph-theme"),
								"id" => "home_slider_settings_5",
								"std" => "0",
								"mod" => "mini",
								"type" => "text");

			$of_options[] = array( "name" => "",
								"desc" => __("Autoplay","aleph-theme"),
								"id" => "home_slider_settings_6",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Autoplay speed (duration on each slide before transition)","aleph-theme"),
								"id" => "home_slider_settings_7",
								"min" => "1000",
								"max" => "20000",
								"std" => "7000",
								"step" => "250",
								"unit" => "ms",
								"type" => "range");

			$of_options[] = array( "name" => "",
								"desc" => __("Transition speed (duration of the transition animation)","aleph-theme"),
								"id" => "home_slider_settings_8",
								"min" => "100",
								"max" => "5000",
								"std" => "600",
								"step" => "100",
								"unit" => "ms",
								"type" => "range");

			$of_options[] = array( "name" => "",
								"desc" => __("Delay before starting slider","aleph-theme"),
								"id" => "home_slider_settings_9",
								"std" => "0",
								"mod" => "mini",
								"type" => "text");

			$of_options[] = array( "name" => "",
								"desc" => __("Random slides","aleph-theme"),
								"id" => "home_slider_settings_10",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Pause slide on hover (will prevent moving to another slide when user's mouse is on the slider)","aleph-theme"),
								"id" => "home_slider_settings_11",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable arrow navigation","aleph-theme"),
								"id" => "home_slider_settings_12",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable bullets pagination","aleph-theme"),
								"id" => "home_slider_settings_13",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable pause/play","aleph-theme"),
								"id" => "home_slider_settings_14",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable touch navigation","aleph-theme"),
								"id" => "home_slider_settings_15",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable mousewheel navigation","aleph-theme"),
								"id" => "home_slider_settings_16",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable keyboard navigation","aleph-theme"),
								"id" => "home_slider_settings_17",
								"std" => "1",
								"type" => "checkbox");

		/* -------------------------------------------------------
		   SUB-TAB 2 : Fullwidth slider Slides
		   -------------------------------------------------------*/

		$of_options[] = array( "name" => __('1-Slides',"alephtheme"),
							"class" => "indent",
							"type" => "heading");

			$of_options[] = array( "name" =>  "Source of slides",
								"desc" => __("Select how to generate the slides. If you choose the first option, then you must manually adjust the settings for each post/project in the metabox.","alephtheme"),
								"id" => "FS_source",
								"options" => array('selected'=>'Select Post/Projects','custom'=>'Custom slides'),
								"std"=>"rightTop",
								"type" => "select");

			$of_options[] = array( "name" => "Number of slides",
								"desc" => __("Maximum number of slides to show.","alephtheme"),
								"id" => "FS_source_limit",
								"min" => "1",
								"max" => "20",
								"std" => "3",
								"step" => "1",
								"unit" => "",
								"type" => "range");

			$of_options[] = array( "name" => __("","alephtheme"),
								"desc" => "",
								"id" => "slider_info",
								"std" => "<strong>Important : </strong><br/><br/>
								<strong>Video ID</strong> :<br/>
								- <strong><em>YouTube : </em></strong> http://www.youtube.com/watch?v=<strong>kXiGXcq4pqY</strong><br/>
								- <strong><em>Vimeo : </em></strong> http://vimeo.com/<strong>2203727</strong><br/><br><strong>NOTICE : To add a new slide, it is safer to click on <em>Add new slide</em>, save changes, then refresh the page.</strong>",
								"type" => "info");

			$of_options[] = array( "name" => "Slider Options",
								"desc" => "",
								"id" => "FS_slider",
								"std" => "",
								"type" => "slider",
								"input"=>"default");

		/* -------------------------------------------------------
		   SUB-TAB 3 : Fullwidth video slider Slides
		   -------------------------------------------------------*/

//		$of_options[] = array( "name" => __('3-Slides',"alephtheme"),
//							"class" => "indent",
//							"type" => "heading");
//
//			$of_options[] = array( "name" => __("","alephtheme"),
//								"desc" => "",
//								"id" => "slider_info4",
//								"std" => "<strong>Important : </strong> You must absolutely set a slide title (even if you chose not to show title) and a placeholder image for the slideshow to appear.<br/><br/>
//								<strong>Instructions on video usage</strong><br/>
//								- Upload the video using the native <a href='".get_admin_url()."media-new.php'>media uploader</a> of WordPress<br/>
//								- Copy the path in the <em>File URL</em> field into the <em>Video URL</em> field<br/><br><strong>NOTICE : To add a new slide, it is safer to click on <em>Add new slide</em>, save changes, then refresh the page.</strong>",
//								"type" => "info");
//
//			$of_options[] = array( "name" => "Slider Options",
//								"desc" => "",
//								"id" => "FV_slider",
//								"std" => "",
//								"type" => "slider",
//								"input"=>"video");


	/* -------------------------------------------------------
	   TAB 5 : Content
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Content","alephtheme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Responsiveness","alephtheme"),
							"desc" => __("Hide next/previous navigation arrows on top pages for screens under 480px (iPhones, etc).","alephtheme"),
							"id" => "responsive_nav_arrows",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Read More Link","alephtheme"),
							"desc" => __("Text for the Read More link","alephtheme"),
							"id" => "readmore_text",
							"std" => __("Read More","alephtheme"),
							"type" => "text");

		$of_options[] = array( "name" => __("Excerpt length","alephtheme"),
							"desc" => __("Number of words. Default : 20","alephtheme"),
							"id" => "excerpt_length",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => __("Error 404 message","alephtheme"),
							"desc" => "",
							"id" => "error404",
							"std" => __("Error 404 - Page Not Found","alephtheme"),
							"type" => "textarea");

		$of_options[] = array( "name" => __("Post Like","alephtheme"),
							"desc" => __("Allow users to like posts","alephtheme"),
							"id" => "post_like",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Share","alephtheme"),
							"desc" => __("Allow users to share posts. Check this option and then choose the services and add the text.","alephtheme"),
							"id" => "social_share_activate",
							"std"=>0,
							"folds"=>1,
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Services","alephtheme"),
							"desc" => __("Check the social services to show","alephtheme"),
							"id" => "social_share_services",
							"fold"=>"social_share_activate",
							"std" => "", // These items get checked by default
							"type" => "multicheck",
							"options" => $social_share);

		$of_options[] = array( "name" => __("Tooltips","alephtheme"),
							"desc" => __("Enter the message that will appear on mouseouver for each service","alephtheme"),
							"id" => "social_share_tip",
							"fold"=>"social_share_activate",
							"std" => "", // These items get checked by default
							"type" => "multitext",
							"options" => $social_share);

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" => __("Height of thumbnails in the blog/archives (in px)","alephtheme"),
							"desc" => __("Leave empty for auto height","alephtheme"),
							"id" => "height_archive",
							"std" => "",
							"type" => "text");

			$of_options[] = array( "name" => __("Blog link","alephtheme"),
								"desc" => "",
								"id" => "link_blog",
								"std" => $blog_link,
								"type" => "text");

			$of_options[] = array( "name" => __("Blog text","alephtheme"),
								"desc" => "",
								"id" => "link_blog_text",
								"std" => "Back to blog",
								"type" => "text");

			$of_options[] = array( "name" => __("Portfolio link","alephtheme"),
								"desc" => "",
								"id" => "link_portfolio",
								"std" => home_url().'/',
								"type" => "text");

			$of_options[] = array( "name" => __("Portfolio text","alephtheme"),
								"desc" => "",
								"id" => "link_portfolio_text",
								"std" => "Back to portfolio",
								"type" => "text");
			$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" => __("Portfolio slider","alephtheme"),
							"desc" => __("Time between slides","alephtheme"),
							"id" => "media_interval",
							"min" => "0",
							"max" => "20000",
							"std" => "5000",
							"step" => "50",
							"unit" => "ms",
							"type" => "range");

		$of_options[] = array( "name" => "",
							"desc" => __("Speed of transition","alephtheme"),
							"id" => "media_duration",
							"min" => "0",
							"max" => "2000",
							"std" => "500",
							"step" => "50",
							"unit" => "ms",
							"type" => "range");

		$of_options[] = array( "name" => "",
							"desc" => __("Pause slideshow on hover of slide","alephtheme"),
							"id" => "media_hover",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display pagination","alephtheme"),
							"id" => "media_pager",
							"std" => "1",
							"type" => "checkbox");

			$of_options[] = array( "name" => __("Twitter Widget","alephtheme"),
								"desc" => "Twitter username",
								"id" => "widget_twitter_username",
								"std" => "",
								"type" => "text");

			$of_options[] = array( "name" => __("","alephtheme"),
								"desc" => __("Number of tweets to display","alephtheme"),
								"id" => "widget_twitter_count",
								"min" => "0",
								"max" => "10",
								"std" => "3",
								"step" => "1",
								"unit" => "",
								"type" => "range");

	/* -------------------------------------------------------
	   TAB 8 : Contact Panel
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Contact Panel","alephtheme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Activate contact panel","alephtheme"),
							"desc" => __("A button in the top right corner of the header menu will open/close a sliding panel.","alephtheme"),
							"id" => "contact_activate",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Contact form email address","alephtheme"),
							"desc" => __("Recipient of contact form","alephtheme"),
							"id" => "admin_email",
							"std" => "admin@domain.com",
							"type" => "text");

			$of_options[] = array( "name" => __("Phone Number","alephtheme"),
								"desc" => __("Leave empty if you do not wish to show this information","alephtheme"),
								"id" => "contact_info_phone",
								"std" => "",
								"type" => "text");

			$of_options[] = array( "name" => __("Email Adress","alephtheme"),
								"desc" => __("Leave empty if you do not wish to show this information","alephtheme"),
								"id" => "contact_info_email",
								"std" => "",
								"type" => "text");

			$of_options[] = array( "name" => __("Adress","alephtheme"),
								"desc" => __("Leave empty if you do not wish to show this information","alephtheme"),
								"id" => "contact_info_adress",
								"std" => "",
								"type" => "textarea");

		$of_options[] = array( "name" => __("Pin Style","alephtheme"),
							"desc" => "",
							"id" => "map_pin",
							"std" => "red",
							"type" => "images",
							"options" => array(
											'blue'=>$imagepath_pin.'pin_blue.png',
											'green'=>$imagepath_pin.'pin_green.png',
											'red'=>$imagepath_pin.'pin_red.png',
											'yellow'=>$imagepath_pin.'pin_yellow.png'
											));

		$of_options[] = array( "name" => __("Zoom Level","alephtheme"),
							"desc" => __("You can set the zoom level of the map.","alephtheme"),
							"id" => "contact_gmap_zoom",
							"min" => "1",
							"max" => "50",
							"std" => "4",
							"step" => "1",
							"unit" => "",
							"type" => "range");

			$of_options[] = array( "name" => __("","alephtheme"),
								"desc" => "",
								"id" => "contact_panel_info",
								"std" => "You may use this <a href='http://itouchmap.com/latlong.html' target='_blank'>tool</a> to get the longitude/latitude for any address.<br/><br/>Even if you have entered the map center coordinates, you still need to enter at least one location.",
								"type" => "info");

		$of_options[] = array( "name" => __("Map Center","alephtheme"),
							"desc" => "Latitude",
							"id" => "contact_gmapc_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Longitude",
							"id" => "contact_gmapc_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 1","alephtheme"),
							"desc" => "Latitude",
							"id" => "contact_gmap1_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Longitude",
							"id" => "contact_gmap1_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Custom text in the info bubble",
							"id" => "contact_gmap1_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 2","alephtheme"),
							"desc" => "Latitude",
							"id" => "contact_gmap2_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Longitude",
							"id" => "contact_gmap2_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Custom text in the info bubble",
							"id" => "contact_gmap2_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 3","alephtheme"),
							"desc" => "Latitude",
							"id" => "contact_gmap3_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Longitude",
							"id" => "contact_gmap3_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Custom text in the info bubble",
							"id" => "contact_gmap3_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 4","alephtheme"),
							"desc" => "Latitude",
							"id" => "contact_gmap4_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Longitude",
							"id" => "contact_gmap4_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("","alephtheme"),
							"desc" => "Custom text in the info bubble",
							"id" => "contact_gmap4_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array ("id"=>"", "type" => "clear");

	/* -------------------------------------------------------
	   TAB 9 : Backup options
	   -------------------------------------------------------*/
		$of_options[] = array( "name" => __("Backup Options","alephtheme"),
							"type" => "heading");

		$of_options[] = array( "name" => __("Backup and Restore Options","alephtheme"),
		                    "id" => "of_backup",
		                    "std" => "",
		                    "type" => "backup",
							"desc" => __("You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.","alephtheme"),
							);

		$of_options[] = array( "name" => __("Transfer Theme Options Data","alephtheme"),
		                    "id" => "of_transfer",
		                    "std" => "",
		                    "type" => "transfer",
							"desc" => __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'.","alephtheme")
							);

	}
}
?>