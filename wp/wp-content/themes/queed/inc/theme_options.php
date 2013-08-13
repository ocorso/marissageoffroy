<?php
	//THESE SCRIPTS CONTROL ALL THE THEME OPTIONS PANEL
	//ADD SOME STYLES TO THE BACKEND PANEL
	add_action('admin_head', 'pirenko_custom');
	function pirenko_custom() 
	{
	   	echo '<style type="text/css">
		#pirenko_options form
		{
			overflow: hidden;
			position: relative;
		}
		#queed_options
		{
			width:1000%;
			margin-top:-16px;
		}
		#queed_options em
		{
			color:#666;
		}
		#queed_options h3
		{
			color:#333;
			text-decoration:underline;
			margin:8px 0px 0px 0px;
		}
		.queed_tab_options
		{
			float:left;
		}
		#pirenko_admin_menu ul
		{
			list-style-type: none;
			background-image: url('.get_bloginfo('template_directory').'/images/admin/navi_bg.png);
			height: 32px;
			margin: auto;
		}
		#pirenko_admin_menu li 
		{
			float: left;
			margin-bottom:0px;
			
		}
		#pirenko_admin_menu ul a 
		{
			background-image: url('.get_bloginfo('template_directory').'/images/admin/navi_bg_divider.png);
			background-repeat: no-repeat;
			background-position: right;
			padding-right: 12px;
			padding-left: 12px;
			display: block;
			line-height: 32px;
			text-decoration: none;
			font-size: 13px;
			color: #21759B;
			font-weight:bold;
		}
		#pirenko_admin_menu ul a:hover 
		{
			color: #D54E21;
		}
		#pirenko_admin_menu_footer
		{
			font-size: 9px;
			float:right;
			padding-top:7px;
			padding-right:8px;
			color:#777777;
		}
		.queed_tab_options
		{
			margin:0px;
			bottom:0px;
			width:10%;
			float:left;
			height:100%;
		}
		.pirenko_cms_image
		{
			border:1px;
			border-style:solid;
			border-color:#CCC;
			max-height:200px;
		}
		.pirenko_upload
		{
				
		}
		.icons_preview
		{
			margin-left:15px;
			float:left;
			padding:4px;
			margin-top:-5px;
		}
		#queed_selector
		{
			margin-top:5px;	
		}
		.left_float
		{
			float:left;
		}
		#clear_icons
		{
			background-color:#111;
			height:26px;
			
		}
		.hidden_icons
		{
			display:none;	
		}
		.preview_color
		{
			width:20px;
			height:20px;
			position:absolute;
			margin-left:215px;
			margin-top:-22px;
		}
		#css_text
		{
			height:150px;
		}
		#overlay_preview
		{
			height: 80px;
			width: 200px;
			float: left;
			margin-left:10px;
		}
		.preview_pattern,
		.preview_pattern_hf
		{
			height: 80px;
			width: 200px;
			float: left;
			margin-left:10px;
		}
		.pirenko_reset_button {
			float: right;
    		margin-top: -37px !important;
		}
		#pattern_selector,
		#pattern_selector_hf
		{
			float:left;	
		}
		.slides_image_preview
		{
			height:100px;	
		}
		.bl_icon_preview {
			width:42px;
			height:42px;
			background-color:#21759B;	
			float:left;
			margin-right:10px;
			display: inline-block;
			overflow:hidden;
			border:5px solid #21759B;
			cursor:pointer;
		}
		.bl_images_divider {
			width:100%;
			display:inline-block;
			height:1px;
			background-color:#DFDFDF;
			
		}
		.active_ic {
			border:5px solid #333;	
		}
		#prk_save_progress {
			width:184px;
			position:absolute;
			opacity:0;
			top:-40px;
			z-index:999;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			-khtml-border-radius: 3px;
			border-radius: 3px;
			background: rgba(0, 0, 0, 0.75);
			color: white;
			font-size: 18px;
			text-align: center;
			padding-top: 13px;
			padding-bottom: 13px;
			}
		</style>';
	}
	//INITIALIZE OUR OPTIONS
	add_action( 'admin_init', 'theme_options_init' );
	add_action( 'admin_menu', 'theme_options_add_page' );
	function theme_options_init()
	{
		register_setting( 'sample_options', 'queed_theme_options', 'theme_options_validate' );
	}
	//LOAD THE MENU PAGE
	function theme_options_add_page() 
	{
		add_menu_page( __( 'Queed Options', 'queed_theme' ), __( 'Queed Options', 'queed_theme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
		//add_theme_page
	}
	
	//CREATE ARRAYS WITH THE OPTIONS
	
	//HOMEPAGE POSITION OPTIONS
	$homepage_options = array(
		'no_display' => array(
			'value' => '0',
			'label' => __( 'No display', 'queedtheme' )
		),
		'top' => array(
			'value' => '1',
			'label' => __( 'Position 1 - Top', 'queedtheme' )
		),
		'center' => array(
			'value' => '2',
			'label' => __( 'Position 2 - Center Top', 'queedtheme' )
		),
		'bottom' => array(
			'value' => '3',
			'label' => __( 'Position 3 - Center Bottom', 'queedtheme' )
			
		),
		'bottom_down' => array(
			'value' => '4',
			'label' => __( 'Position 4 - Bottom', 'queedtheme' )
		)
	);
	
	//YES/NO OPTION
	$yesno_options = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'queedtheme' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'queedtheme' )
		)
	);
	
	//OVERLAYS
	$overlay_options = array(
		'0' => array(
			'value' =>	'',
			'label' => __( 'None', 'queedtheme' )
		),
		'1' => array(
			'value' =>	'diagonal_left_white.png',
			'label' => __( 'Left Diagonal Lines (clear)', 'queedtheme' )
		),
		'2' => array(
			'value' =>	'diagonal_left.png',
			'label' => __( 'Left Diagonal Lines', 'queedtheme' )
		),
		'3' => array(
			'value' =>	'diagonal_right_white.png',
			'label' => __( 'Right Diagonal Lines (clear)', 'queedtheme' )
		),
		'4' => array(
			'value' =>	'diagonal_right.png',
			'label' => __( 'Right Diagonal Lines', 'queedtheme' )
		),
		'5' => array(
			'value' =>	'keys_white.png',
			'label' => __( 'Diagonal Spaces (clear)', 'queedtheme' )
		),
		'6' => array(
			'value' =>	'keys.png',
			'label' => __( 'Diagonal Spaces', 'queedtheme' )
		),
		'7' => array(
			'value' =>	'oblique_squares_lg_white.png',
			'label' => __( 'Large Oblique Squares (clear)', 'queedtheme' )
		),
		'8' => array(
			'value' =>	'oblique_squares_lg.png',
			'label' => __( 'Large Oblique Squares', 'queedtheme' )
		),
		'9' => array(
			'value' =>	'oblique_squares_white.png',
			'label' => __( 'Oblique Squares (clear)', 'queedtheme' )
		),
		'10' => array(
			'value' =>	'oblique_squares.png',
			'label' => __( 'Oblique Squares', 'queedtheme' )
		),
		'11' => array(
			'value' =>	'zig_zag_lg_white.png',
			'label' => __( 'Large Zig Zag (clear)', 'queedtheme' )
		),
		'12' => array(
			'value' =>	'zig_zag_lg.png',
			'label' => __( 'Large Zig Zag', 'queedtheme' )
		),
		'13' => array(
			'value' =>	'zig_zag_white.png',
			'label' => __( 'Zig Zag (clear)', 'queedtheme' )
		),
		'14' => array(
			'value' =>	'zig_zag.png',
			'label' => __( 'Zig Zag', 'queedtheme' )
		)
	);
	
	//PATTERN BACKGROUNDS
	$pattern_options = array(
		'0' => array(
			'value' =>	'',
			'label' => __( 'None', 'queedtheme' )
		),
		'1' => array(
			'value' =>	'grey.jpg',
			'label' => __( 'Dotted Grey', 'queedtheme' )
		),
		'2' => array(
			'value' =>	'oblique.png',
			'label' => __( 'Oblique Lines', 'queedtheme' )
		),
		'3' => array(
			'value' =>	'concrete.jpg',
			'label' => __( 'Concrete', 'queedtheme' )
		),
		'4' => array(
			'value' =>	'cream.jpg',
			'label' => __( 'Cream', 'queedtheme' )
		),
		'5' => array(
			'value' =>	'white_grungy.png',
			'label' => __( 'Grungy Squares', 'queedtheme' )
		),
		'6' => array(
			'value' =>	'oblique_squares.png',
			'label' => __( 'Oblique Squares', 'queedtheme' )
		),
		'7' => array(
			'value' =>	'white_circles.png',
			'label' => __( 'Clear Circles', 'queedtheme' )
		),
		'8' => array(
			'value' =>	'dot.gif',
			'label' => __( 'Dark Dots', 'queedtheme' )
		),
		'9' => array(
			'value' =>	'alt_black.jpg',
			'label' => __( 'Dark Irregular', 'queedtheme' )
		),
		'10' => array(
			'value' =>	'curvy.jpg',
			'label' => __( 'Dark Curves', 'queedtheme' )
		),
		'11' => array(
			'value' =>	'dark_dots.png',
			'label' => __( 'Dark Stamped', 'queedtheme' )
		),
		'12' => array(
			'value' =>	'dark_squares.png',
			'label' => __( 'Dark Squares', 'queedtheme' )
		),
		'13' => array(
			'value' =>	'losangles.png',
			'label' => __( 'Dark Losangles', 'queedtheme' )
		),
		'14' => array(
			'value' =>	'dark_circles.png',
			'label' => __( 'Dark Circles', 'queedtheme' )
		),
		'15' => array(
			'value' =>	'scratch.jpg',
			'label' => __( 'Scratches', 'queedtheme' )
		),
		'16' => array(
			'value' =>	'texturetastic_gray.png',
			'label' => __( 'Textured Grey', 'queedtheme' )
		),
		'51' => array(
			'value' =>	'text_gray_light.jpg',
			'label' => __( 'Textured Grey (light)', 'queedtheme' )
		),
		'17' => array(
			'value' =>	'lghtmesh.png',
			'label' => __( 'Light Mesh', 'queedtheme' )
		),
		'18' => array(
			'value' =>	'dark_tire.png',
			'label' => __( 'Dark Stripes', 'queedtheme' )
		),
		'19' => array(
			'value' =>	'first_aid_kit.png',
			'label' => __( 'Grey Squares', 'queedtheme' )
		),
		'20' => array(
			'value' =>	'rough_diagonal.png',
			'label' => __( 'Rough Diagonal', 'queedtheme' )
		),
		'21' => array(
			'value' =>	'purty_wood.png',
			'label' => __( 'Yellow Wood', 'queedtheme' )
		),
		'22' => array(
			'value' =>	'stacked_circles.png',
			'label' => __( 'Stacked Circles', 'queedtheme' )
		),
		'23' => array(
			'value' =>	'outlets.png',
			'label' => __( 'Outlets', 'queedtheme' )
		),
		'24' => array(
			'value' =>	'farmer.png',
			'label' => __( 'Squared Seamless', 'queedtheme' )
		),
		'25' => array(
			'value' =>	'wood_texture.png',
			'label' => __( 'Textured Wood', 'queedtheme' )
		),
		'26' => array(
			'value' =>	'vintage_speckles.png',
			'label' => __( 'Vintage', 'queedtheme' )
		),
		'27' => array(
			'value' =>	'grid_noise.png',
			'label' => __( 'Grid Noise', 'queedtheme' )
		),
		'28' => array(
			'value' =>	'chruch.png',
			'label' => __( 'Seamless White', 'queedtheme' )
		),
		'29' => array(
			'value' =>	'cross_scratches.png',
			'label' => __( 'Cross Scratches', 'queedtheme' )
		),
		'30' => array(
			'value' =>	'blu_stripes.png',
			'label' => __( 'Blue', 'queedtheme' )
		),
		'31' => array(
			'value' =>	'classy_fabric.png',
			'label' => __( 'Classy Fabric', 'queedtheme' )
		),
		'32' => array(
			'value' =>	'vertical_cloth.png',
			'label' => __( 'Vertical Cloth', 'queedtheme' )
		),
		'33' => array(
			'value' =>	'darkdenim.png',
			'label' => __( 'Dark Denim', 'queedtheme' )
		),
		'34' => array(
			'value' =>	'nami.png',
			'label' => __( 'Seamless Dark', 'queedtheme' )
		),
		'35' => array(
			'value' =>	'broken_noise.png',
			'label' => __( 'Broken Noise', 'queedtheme' )
		),
		'36' => array(
			'value' =>	'fake_brick.png',
			'label' => __( 'Fake Fabric', 'queedtheme' )
		),
		'37' => array(
			'value' =>	'type.png',
			'label' => __( 'Typographic', 'queedtheme' )
		),
		'38' => array(
			'value' =>	'noise_pattern.png',
			'label' => __( 'Noisy', 'queedtheme' )
		),
		'39' => array(
			'value' =>	'dark_mosaic.png',
			'label' => __( 'Dark Mosaic', 'queedtheme' )
		),
		'40' => array(
			'value' =>	'whitey.png',
			'label' => __( 'Simple White', 'queedtheme' )
		),
		'41' => array(
			'value' =>	'random_grey_variations.png',
			'label' => __( 'Grey Variations', 'queedtheme' )
		),
		'42' => array(
			'value' =>	'black-linen.png',
			'label' => __( 'Black Linen', 'queedtheme' )
		),
		'43' => array(
			'value' =>	'light_honeycomb.png',
			'label' => __( 'Light Honeycomb', 'queedtheme' )
		),
		'44' => array(
			'value' =>	'black_paper.png',
			'label' => __( 'Black Paper', 'queedtheme' )
		),
		'45' => array(
			'value' =>	'dark_stripes.png',
			'label' => __( 'Dark Stripes', 'queedtheme' )
		),
		'46' => array(
			'value' =>	'pinstriped_suit.png',
			'label' => __( 'Dark Pin Stripes', 'queedtheme' )
		),
		'47' => array(
			'value' =>	'hixs_pattern_evolution.png',
			'label' => __( 'Dark Metal', 'queedtheme' )
		),
		'48' => array(
			'value' =>	'irongrip.png',
			'label' => __( 'Iron Grip', 'queedtheme' )
		),
		'49' => array(
			'value' =>	'px.png',
			'label' => __( 'Tiny Squares', 'queedtheme' )
		),
		'50' => array(
			'value' =>	'green_dust_scratch.png',
			'label' => __( 'Vintage Green', 'queedtheme' )
		),
		'52' => array(
			'value' =>	'plain.png',
			'label' => __( 'Vertical Lines', 'queedtheme' )
		),
		'53' => array(
			'value' =>	'suriken.png',
			'label' => __( 'Duotone Strikes', 'queedtheme' )
		),
		'58' => array(
			'value' =>	'suriken_bw.png',
			'label' => __( 'Monotone Strikes', 'queedtheme' )
		),
		'54' => array(
			'value' =>	'strange_bullseyes.png',
			'label' => __( 'Bullseyes', 'queedtheme' )
		),
		'55' => array(
			'value' =>	'tiny_grid.png',
			'label' => __( 'Tiny Grid', 'queedtheme' )
		),
		'56' => array(
			'value' =>	'noise_lines.png',
			'label' => __( 'Noise Lines', 'queedtheme' )
		),
		'57' => array(
			'value' =>	'lightpaperfibers.png',
			'label' => __( 'Paper Fibers', 'queedtheme' )
		)
	);
	
	//TRUE/FALSE OPTION
	$truefalse_options = array(
		'true' => array(
			'value' => 'true',
			'label' => __( 'Yes', 'queedtheme' )
		),
		'false' => array(
			'value' => 'false',
			'label' => __( 'No', 'queedtheme' )
		)
	);
	
	//SHOW LIGHTBOX BUTTON ON ROLLOVER
	$lightbox_options = array(
		'both' => array(
			'value' => 'both',
			'label' => __( 'Show lightbox and link button', 'queedtheme' )
		),
		'light_only' => array(
			'value' => 'light_only',
			'label' => __( 'Show only lightbox button', 'queedtheme' )
		),
		'link_only' => array(
			'value' => 'link_only',
			'label' => __( 'Show only link button', 'queedtheme' )
		)
	);
	
	//FONTS
	$select_font_options = array(
		'9' => array(
			'value' =>	'Acme',
			'label' => __( 'Acme', 'queedtheme' )
		),
		'4' => array(
			'value' =>	'Alegreya:400italic,700italic,400,700',
			'label' => __( 'Alegreya', 'queedtheme' )
		),
		'16' => array(
			'value' =>	'Anton',
			'label' => __( 'Anton', 'queedtheme' )
		),
		'14' => array(
			'value' =>	'Arial',
			'label' => __( 'Arial', 'queedtheme' )
		),
		'5' => array(
			'value' =>	'Arvo',
			'label' => __( 'Arvo', 'queedtheme' )
		),
		'10' => array(
			'value' =>	'Asap',
			'label' => __( 'Asap', 'queedtheme' )
		),
		'7' => array(
			'value' =>	'Asul:400,700',
			'label' => __( 'Asul', 'queedtheme' )
		),
		'43' => array(
			'value' =>	'Average+Sans',
			'label' => __( 'Average Sans', 'queedtheme' )
		),
		'42' => array(
			'value' =>	'Bitter:400,700,400italic',
			'label' => __( 'Bitter', 'queedtheme' )
		),
		'25' => array(
			'value' =>	'Bree+Serif',
			'label' => __( 'Bree Serif', 'queedtheme' )
		),
		'11' => array(
			'value' =>	'Cabin:500,500italic',
			'label' => __( 'Cabin', 'queedtheme' )
		),
		'29' => array(
			'value' =>	'courier_new',
			'label' => __( 'Courier New', 'queedtheme' )
		),
		'24' => array(
			'value' =>	'Cousine:400,700',
			'label' => __( 'Cousine', 'queedtheme' )
		),
		'22' => array(
			'value' =>	'Dosis:500,600,700',
			'label' => __( 'Dosis', 'queedtheme' )
		),
		'1' => array(
			'value' =>	'Droid+Sans:400,700',
			'label' => __( 'Droid Sans', 'queedtheme' )
		),
		'8' => array(
			'value' =>	'Droid+Serif',
			'label' => __( 'Droid Serif', 'queedtheme' )
		),
		'18' => array(
			'value' =>	'Economica:700',
			'label' => __( 'Economica', 'queedtheme' )
		),
		'17' => array(
			'value' =>	'Exo:700,800',
			'label' => __( 'Exo Sans', 'queedtheme' )
		),
		'15' => array(
			'value' =>	'Francois+One',
			'label' => __( 'Francois One', 'queedtheme' )
		),
		'47' => array(
			'value' =>	'Gentium+Basic:400,700,400italic,700italic',
			'label' => __( 'Gentium Basic', 'queedtheme' )
		),
		'30' => array(
			'value' =>	'helvetica',
			'label' => __( 'Helvetica', 'queedtheme' )
		),
		'46' => array(
			'value' =>	'Julius+Sans+One',
			'label' => __( 'Julius Sans One', 'queedtheme' )
		),
		'26' => array(
			'value' =>	'Lato:400,700',
			'label' => __( 'Lato', 'queedtheme' )
		),
		'32' => array(
			'value' =>	'Lora',
			'label' => __( 'Lora', 'queedtheme' )
		),
		'31' => array(
			'value' =>	'Montserrat',
			'label' => __( 'Montserrat', 'queedtheme' )
		),
		'37' => array(
			'value' =>	'Muli:400,400italic',
			'label' => __( 'Muli', 'queedtheme' )
		),
		'13' => array(
			'value' =>	'Oswald:700,400,300',
			'label' => __( 'Oswald', 'queedtheme' )
		),
		'0' => array(
			'value' =>	'Open+Sans:400,600,700,800',
			'label' => __( 'Open Sans', 'queedtheme' )
		),
		'45' => array(
			'value' =>	'Orienta',
			'label' => __( 'Orienta', 'queedtheme' )
		),
		'36' => array(
			'value' =>	'Overlock+SC',
			'label' => __( 'Overlock SC', 'queedtheme' )
		),
		'33' => array(
			'value' =>	'Oxygen+Mono',
			'label' => __( 'Oxygen Mono', 'queedtheme' )
		),
		'41' => array(
			'value' =>	'Patua+One',
			'label' => __( 'Patua One', 'queedtheme' )
		),
		'39' => array(
			'value' =>	'Pompiere',
			'label' => __( 'Pompiere', 'queedtheme' )
		),
		'2' => array(
			'value' =>	'PT+Sans',
			'label' => __( 'PT Sans', 'queedtheme' )
		),
		'28' => array(
			'value' =>	'PT+Sans+Narrow',
			'label' => __( 'PT Sans Narrow', 'queedtheme' )
		),
		'23' => array(
			'value' =>	'Questrial',
			'label' => __( 'Questrial', 'queedtheme' )
		),
		'35' => array(
			'value' =>	'Quicksand:400,700',
			'label' => __( 'Quicksand', 'queedtheme' )
		),
		'34' => array(
			'value' =>	'Raleway:400,700',
			'label' => __( 'Raleway', 'queedtheme' )
		),
		'12' => array(
			'value' =>	'Ruda:400,700,900',
			'label' => __( 'Ruda', 'queedtheme' )
		),
		'38' => array(
			'value' =>	'Rye',
			'label' => __( 'Rye', 'queedtheme' )
		),
		'44' => array(
			'value' =>	'Share+Tech',
			'label' => __( 'Share Tech', 'queedtheme' )
		),
		'40' => array(
			'value' =>	'Titillium+Web:400,600,400italic',
			'label' => __( 'Titillium Web', 'queedtheme' )
		),
		'6' => array(
			'value' =>	'Ubuntu',
			'label' => __( 'Ubuntu', 'queedtheme' )
		),
		'27' => array(
			'value' =>	'Vollkorn:400italic,400',
			'label' => __( 'Vollkorn', 'queedtheme' )
		),
		'3' => array(
			'value' =>	'Yanone+Kaffeesatz',
			'label' => __( 'Yanone Kaffeesatz', 'queedtheme' )
		)
		//48 IS NEXT
	);
	
	//SKINS
	$icon_options = array(
		'0' => array(
			'value' =>	'dark',
			'label' => __( 'Use Dark Icons', 'queedtheme' )
		),
		'1' => array(
			'value' =>	'clear',
			'label' => __( 'Use Clear Icons', 'queedtheme' )
		)
	);
	
	//SKINS CONTACT
	$icon_options_ct = array(
		'0' => array(
			'value' =>	'black_ic',
			'label' => __( 'Black Icons', 'queedtheme' )
		),
		'1' => array(
			'value' =>	'white_ic',
			'label' => __( 'White Icons', 'queedtheme' )
		),
		'2' => array(
			'value' =>	'custom_ic',
			'label' => __( 'Custom Icons (grey)', 'queedtheme' )
		)
	);
	
	//BLOG POST ICONS
	$blog_icon_options = array(
		'0' => array(
			'value' =>	'-57',
			'label' => __( 'Link', 'queedtheme' )
		),
		'2' => array(
			'value' =>	'-94',
			'label' => __( 'Lab', 'queedtheme' )
		),
		'3' => array(
			'value' =>	'-128',
			'label' => __( 'Image', 'queedtheme' )
		),
		'4' => array(
			'value' =>	'-165',
			'label' => __( 'Video', 'queedtheme' )
		),
		'5' => array(
			'value' =>	'-201',
			'label' => __( 'Mouse', 'queedtheme' )
		),
		'6' => array(
			'value' =>	'-237',
			'label' => __( 'Camera', 'queedtheme' )
		),
		'7' => array(
			'value' =>	'-273',
			'label' => __( 'Speech', 'queedtheme' )
		),
		'8' => array(
			'value' =>	'-310',
			'label' => __( 'Pencil', 'queedtheme' )
		)
	);
	
	
	//CREATE THE OPTIONS PAGE
	function theme_options_do_page() 
	{
		//SEND VALUE TO ADMIN SCRIPTS
		?>
		<script type="text/javascript">
			var queed_directory = "<?php bloginfo('template_directory') ?>";
		</script>
		<?php
			global $overlay_options, $select_font_options,$yesno_options,$homepage_options,$icon_options,$icon_options_ct, $pattern_options, $truefalse_options, $lightbox_options,$blog_icon_options;
			if ( ! isset( $_REQUEST['settings-updated'] ) )
				$_REQUEST['settings-updated'] = false;
			//GET THEME DATA FROM THE STYLESHEET
			$theme_data = wp_get_theme();
		?>
        <div id="prk_save_progress">Saving...</div>
		<div class="wrap">
			<div id="pirenko_admin_menu">
				<ul>
					<li><a href="#" id="queed_general_options_button">General</a></li>
                    <li><a href="#" id="queed_homepage_options_button">Homepage</a></li>
                    <li><a href="#" id="queed_portfolio_options_button">Portfolio</a></li>
                    <li><a href="#" id="queed_news_options_button">Blog</a></li>
					<li><a href="#" id="queed_contact_options_button">Contact</a></li>
					<li><a href="#" id="queed_404_error_options_button">404 Page</a></li>
                    <li><a href="#" id="queed_translations_options_button">Translations</a></li>
					<div id="pirenko_admin_menu_footer">
						Queed Theme Admin Panel 1.0
					</div>
				</ul>
			</div>
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
				<div class="updated fade"><p><strong><?php _e( 'Options saved', 'queedtheme' ); ?></strong></p></div>
			<?php endif; ?>
			<div id="pirenko_options">
                <form id="prk_main_options" method="post" action="">
                    <input id="set_default" type="hidden" size="1" type="text" name="queed_theme_options[set_default]" value="false" />
                    <p class="save_options">
                        <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                    </p>
                    <input type="button" class="button-primary pirenko_reset_button" value="Reset All Settings" onClick="go_there()" />
                    <?php settings_fields( 'sample_options' ); ?>
                    <?php $options = get_option( 'queed_theme_options' ); ?>
                    <div id="queed_options">
                        <!--GENERAL OPTIONS-->
                        <div class="queed_tab_options" id="pirenko_general_options">
                            <table class="form-table">       
                                <tr>
                                <td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " General Options" . "</h2>"; ?></td></tr>
                               <?php
                                //LOGO IMAGE
								?> 
								<?php 
									//WORKARROUND SO THAT WE CAN USE THE MEDIA UPLOADER WITHOUT AN ID
									//WE USE THE FOOTER MENU ID TO PASS IT TO THE MEDIA UPLOADER
									$args = array(
									'order'                  => 'ASC',
									'orderby'                => 'menu_order',
									'post_type'              => 'nav_menu_item',
									'post_status'            => 'publish',
									'output'                 => ARRAY_A,
									'output_key'             => 'menu_order',
									'nopaging'               => true,
									'update_post_term_cache' => false );
									$items = wp_get_nav_menu_items( 'Queed Footer Menu', $args ); 
                               ?>
                                <tr valign="top">
                                	<td width="275"><h3><?php _e( 'LOGO IMAGE', 'queedtheme' ); ?></h3></td>
                                    
                                    <td>
                                        <table>
                                        <tr>
                                            <td>
                                            <img class="pirenko_cms_image" id="queed_theme_options_logo_image" src="<?php esc_attr_e( $options['logo'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="queed_theme_options_logo" type="hidden" size="1" type="text" name="queed_theme_options[logo]" value="<?php esc_attr_e( $options['logo'] ); ?>" />
                                        <input id="queed_theme_options_logo_w" type="hidden" size="4" type="text" name="queed_theme_options[logo_w]" value="<?php esc_attr_e( $options['logo_w'] ); ?>" />
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_logo" secret_id="<?php echo ($items[0]->ID); ?>">Upload Logo</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                //MENU DISPLACEMENT
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Menu Vertical displacement', 'queedtheme' ); ?>
                                    <p><em>You can move the menu up or down by changing this value. Don't change this if the top menu looks ok with you logo.</em></p>
                                </th>
                                    <td>
                                        <input id="site_background_color" size="2" maxlength="6" type="text" name="queed_theme_options[menu_vertical]" value="<?php esc_attr_e( $options['menu_vertical'] ); ?>" />
                                    </td>
                                </tr>
                                 <?php
                                //FAVICON IMAGE
								if (!isset($options['favicon']))
									$options['favicon']="". get_bloginfo('template_directory') . "/images/favicon.ico";
                                ?>
                                <tr valign="top">
                                	<td width="275"><h3><?php _e( 'FAVICON IMAGE', 'queedtheme' ); ?></h3>
                                    <p><em>Should have the .ico extension</em></p>
                                    </td>
                                    
                                    <td>
                                        <table>
                                        <tr>
                                            <td>
                                            <img class="pirenko_cms_image" id="queed_theme_options_favicon_image" src="<?php esc_attr_e( $options['favicon'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="queed_theme_options_favicon" type="hidden" size="1" type="text" name="queed_theme_options[favicon]" value="<?php esc_attr_e( $options['favicon'] ); ?>" />
                                        
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_favicon" secret_id="<?php echo ($items[0]->ID); ?>">Upload Favicon</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'BACKGROUND', 'queedtheme' ); ?></h3></th>
                                <?php
                                //BACKGROUND IMAGE
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Background Image', 'queedtheme' ); ?></th>
                                    <td>
                                        <table>
                                        <tr>
                                            <td> 
                                            <img class="pirenko_cms_image" id="queed_theme_options_background_image" src="<?php esc_attr_e( $options['background_image'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="queed_theme_options_background" size="1" type="hidden" name="queed_theme_options[background_image]" value="<?php esc_attr_e( $options['background_image'] ); ?>" />
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_background" secret_id="<?php echo ($items[0]->ID); ?>">Upload Background</a>
                                        <a href="#" class="button" id="remove_background_button" name="theme_options_background_remove">Remove Background</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                //BACKGROUND PATTERN
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Background Pattern', 'queedtheme' ); ?>
                                        <p><em>Will be used only if there's no background image</em></p>
                                    </th>
                                    <td>
                                        <select id="pattern_selector" name="queed_theme_options[pattern]">
                                            <?php    
                                                foreach ( $pattern_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['pattern'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        <div id="background_preview" class="preview_pattern" style="background-image:url(<?php echo get_bloginfo('template_directory');?>/images/patterns/<?php echo $options['pattern']; ?>)">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //BACKGROUND COLOR
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Background Color', 'queedtheme' ); ?>
                                    <p><em>Will be used only if there's no background image and no background pattern</em></p>
                                </th>
                                    <td>
                                        #<input id="site_background_color" size="7" maxlength="6" type="text" name="queed_theme_options[site_background_color]" value="<?php esc_attr_e( $options['site_background_color'] ); ?>" />
                                        <label class="description" for="queed_theme_options[site_background_color]"><?php _e( ' Hexadecimal Values', 'queedtheme' ); ?></label>
                                        <div id="site_background_preview" class="preview_color" style="background-color:#<?php echo $options['site_background_color']; ?>"></div>
                                    </td>
                                </tr>
								<?php
                                //OVERLAY
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Background Overlay Image', 'queedtheme' ); ?>
                                        <p><em>This image is optional and will be displayed on top of your background image, pattern or color.</em></p>
                                    </th>
                                    <td>
                                        <div id="overlay_selector_div">
                                        <select id="overlay_selector" name="queed_theme_options[overlay_image]" class="left_float">
                                            <?php    
                                                foreach ( $overlay_options as $overlay_option ) 
                                                {
                                                    $label = $overlay_option['label'];
                                                    
                                                    if ( $options['overlay_image'] == $overlay_option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $overlay_option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $overlay_option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        <div id="overlay_preview" class="<?php if ($options['overlay_image']=="") {echo "hidden_icons";} ?>" style="background: url(<?php echo get_bloginfo('template_directory');?>/images/overlays/<?php echo $options['overlay_image'];?>) repeat scroll 0 0 transparent;background-color: #<?php echo $options['inactive_color'];?>;">
                                            
                                        </div> 
                                 
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'HEADER AND FOOTER', 'queedtheme' ); ?></h3></th>
                                <?php
                                //BACKGROUND PATTERN
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Background Pattern', 'queedtheme' ); ?>
                                        <p><em>If blank the value of "Modular background color" will be used</em></p>
                                    </th>
                                    <td>
                                        <select id="pattern_selector_hf" name="queed_theme_options[pattern_hf]">
                                            <?php    
                                                foreach ( $pattern_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['pattern_hf'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        <div id="background_preview_hf" class="preview_pattern_hf" style="background-image:url(<?php echo get_bloginfo('template_directory');?>/images/patterns/<?php echo $options['pattern_hf']; ?>)">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //CUSTOM OPACITY
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Custom Background Opacity - Header and Footer', 'queedtheme' ); ?>
                                    <p><em></em></p>
                                </th>
                                    <td>
                                        <input id="custom_opacity" size="7" maxlength="6" type="text" name="queed_theme_options[custom_opacity]" value="<?php esc_attr_e( $options['custom_opacity'] ); ?>" />
                                        <label class="description" for="queed_theme_options[custom_opacity]"><?php _e( ' Acceptable values: [0,100]', 'queedtheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //COLORS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'COLORS', 'queedtheme' ); ?></h3></th>
                                <?php
                                //ACTIVE COLOR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Active color', 'queedtheme' ); ?></th>
                                    <td>
                                        #<input id="active_color" size="7" maxlength="6" type="text" name="queed_theme_options[active_color]" value="<?php esc_attr_e( $options['active_color'] ); ?>" />
                                        <label class="description" for="queed_theme_options[active_color]"><?php _e( ' Hexadecimal Values', 'queedtheme' ); ?></label>
                                        <div id="active_preview" class="preview_color" style="background-color:#<?php echo $options['active_color']; ?>"></div>
                                    </td>
                                </tr>
                                <?php
                                //INACTIVE COLOR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Inactive color', 'queedtheme' ); ?></th>
                                    <td>
                                        #<input id="inactive_color" size="7" maxlength="6" type="text" name="queed_theme_options[inactive_color]" value="<?php esc_attr_e( $options['inactive_color'] ); ?>" />
                                        <label class="description" for="queed_theme_options[inactive_color]"><?php _e( ' Hexadecimal Values', 'queedtheme' ); ?></label>
                                        <div id="inactive_preview" class="preview_color" style="background-color:#<?php echo $options['inactive_color']; ?>"></div>
                                    </td>
                                </tr>
                                <?php
                                //CONTENT BACKGROUND COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Body text color', 'queedtheme' ); ?></th>
                                    <td>
                                        #<input id="body_color" size="7" maxlength="6" type="text" name="queed_theme_options[body_color]" value="<?php esc_attr_e( $options['body_color'] ); ?>" />
                                        <label class="description" for="queed_theme_options[body_color]"><?php _e( ' Hexadecimal Values', 'queedtheme' ); ?></label>
                                        <div id="body_preview" class="preview_color" style="background-color:#<?php echo $options['body_color']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //CONTENT BACKGROUND COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Modular background color', 'queedtheme' ); ?></th>
                                    <td>
                                        #<input id="background_color_modular" size="7" maxlength="6" type="text" name="queed_theme_options[background_color]" value="<?php esc_attr_e( $options['background_color'] ); ?>" />
                                        <label class="description" for="queed_theme_options[background_color]"><?php _e( ' Hexadecimal Values', 'queedtheme' ); ?></label>
                                        <div id="background_preview_modular" class="preview_color" style="background-color:#<?php echo $options['background_color']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                 <?php
								//CUSTOM OPACITY
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Custom Background Opacity - Buttons and blocks', 'queedtheme' ); ?>
                                    <p><em>Will be used on buttons and background blocks</em></p>
                                </th>
                                    <td>
                                        &nbsp;&nbsp;<input id="custom_opacity_btn" size="7" maxlength="6" type="text" name="queed_theme_options[custom_opacity_btn]" value="<?php esc_attr_e( $options['custom_opacity_btn'] ); ?>" />
                                        <label class="description" for="queed_theme_options[custom_opacity_btn]"><?php _e( ' Acceptable values: [0,100]', 'queedtheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //SHADOW OPACITY
								if (!isset($options['custom_shadow']))
									$options['custom_shadow']="0";
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Shadow Opacity', 'queedtheme' ); ?>
                                    <p><em>Use 0 value for no shadowing effect</em></p>
                                </th>
                                    <td>
                                        <input id="custom_shadow" size="7" maxlength="6" type="text" name="queed_theme_options[custom_shadow]" value="<?php esc_attr_e( $options['custom_shadow'] ); ?>" />
                                        <label class="description" for="queed_theme_options[custom_shadow]"><?php _e( ' Acceptable values: [0,100]', 'queedtheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //FONTS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'FONTS AND ICONS', 'queedtheme' ); ?></h3></th>
                                <?php
                                //HEADINGS FONT
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Headings Font', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[header_font]">
                                            <?php    
                                                foreach ( $select_font_options as $option_header ) 
                                                {
                                                    $label_header = $option_header['label'];
                                                    
                                                    if ( $options['header_font'] == $option_header['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option_header['value'] ) . "'>$label_header</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option_header['value'] ) . "'>$label_header</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //BODY
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Body Font', 'queedtheme' ); ?></th>
                                    <td>                               
                                        <select name="queed_theme_options[body_font]">
                                            <?php    
                                                foreach ( $select_font_options as $option_body ) 
                                                {
                                                    $label_body = $option_body['label'];
                                                    
                                                    if ( $options['body_font'] == $option_body['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option_body['value'] ) . "'>$label_body</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option_body['value'] ) . "'>$label_body</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr> 
                                <?php
                                //ICON SET
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Icons', 'queedtheme' ); ?>
                                        <p><em>These icons are located in the images/icons folder.</em></p>
                                    </th>
                                    <td>
                                        <div id="queed_selector">
                                        <select id="icon_selector" name="queed_theme_options[icon_set]" class="left_float">
                                            <?php    
                                                foreach ( $icon_options as $ic_option ) 
                                                {
                                                    $label = $ic_option['label'];
                                                    
                                                    if ( $options['icon_set'] == $ic_option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $ic_option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $ic_option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                    </td>
                                </tr>
                                 <?php
                                //ICON SET
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Icons for contact page and forms', 'queedtheme' ); ?>
                                        <p><em>These icons are located in the images/icons folder.</em></p>
                                    </th>
                                    <td>
                                        <div id="queed_selector">
                                        <select id="icon_selector" name="queed_theme_options[icon_set_ct]" class="left_float">
                                            <?php    
                                                foreach ( $icon_options_ct as $ic_option ) 
                                                {
                                                    $label = $ic_option['label'];
                                                    
                                                    if ( $options['icon_set_ct'] == $ic_option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $ic_option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $ic_option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //SIDEBARS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'SIDEBARS', 'queedtheme' ); ?></h3></th>
                                <?php
                                //TOP SIDEBAR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Display Top Sidebar', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[top_sidebar]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['top_sidebar'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr> 
                                <?php
                                //FOOTER TEXT
                                ?>
                                <tr valign="top">
                                    <td scope="row">
                                        <h3><?php _e( 'FOOTER TEXT', 'queedtheme' ); ?></h3>
                                        <p><em>HTML supported</em></p>
                                    </td>
                                    <td>
                                        <input id="footer_text" size="30" maxlength="100" type="text" name="queed_theme_options[footer_text]" value="<?php esc_attr_e( $options['footer_text'] ); ?>" />
                                        
                                    </td>
                                </tr>
                                <?php
                                //CUSTOM CSS
                                ?>
                                <tr valign="top">
                                    <td scope="row">
                                        <h3><?php _e( 'CUSTOM CSS', 'queedtheme' ); ?></h3>
                                        <p><em>Place here some of your own CSS code. You should not use <b>&lt;style&gt;</b> tags.</em></p>
                                    </td>
                                    <td>
                                        <textarea id="css_text" class="" rows="" cols="60" name="queed_theme_options[css_text]" value=""><?php esc_attr_e( $options['css_text'] ); ?></textarea>
                                        
                                    </td>
                                </tr>       
                          	</table>
                           	<p class="save_options">
                           	<input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                           	</p>
                       	</div><!-- GENERAL OPTIONS -->
                      	<!-- HOMEPAGE -->         
                     	<div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Homepage Options" . "</h2>"; ?></td></tr>
                                <?php
                                //SHOW HOMEPAGE WELCOME OPTION
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'WELCOME TEXT', 'queedtheme' ); ?></h3></th>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Show Welcome text on Homepage', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[show_homepage_welcome]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['show_homepage_welcome'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //HOMEPAGE WELCOME TEXT
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                    <?php _e( 'Welcome text - first line', 'queedtheme' ); ?>
                                    </th>
                                    <td>
                                        <input id="queed_theme_options[homepage_welcome_text]" size="25" type="text" name="queed_theme_options[homepage_welcome_text]" value="<?php esc_attr_e( $options['homepage_welcome_text'] ); ?>" />
                                    </td>
                                </tr>
                                 <?php
                                //HOMEPAGE WELCOME TEXT LINE 2
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                    <?php _e( 'Welcome text - second line', 'queedtheme' ); ?>
                                    <p><em>Smaller text</em></p>
                                    </th>
                                    <td>
                                        <input id="queed_theme_options[homepage_welcomel2_text]" size="25" type="text" name="queed_theme_options[homepage_welcomel2_text]" value="<?php esc_attr_e( $options['homepage_welcomel2_text'] ); ?>" />
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'SLIDER', 'queedtheme' ); ?></h3></th>
                                <?php
                                //SHOW HOMEPAGE SLIDER
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Show Slider on Homepage', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[show_homepage_slider]">
                                            <?php    
                                                foreach ( $homepage_options as $option ) 
                                                {
													                                                    $label = $option['label'];
                                                    if ( $options['show_homepage_slider'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //HOMEPAGE SLIDER GROUP
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Homepage Slider Slides Group ID', 'queedtheme' ); ?></th>
                                    <td>
                                    	<select name="queed_theme_options[homepage_slider_group]">
                                            <?php 
												echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='queed_all_s'>Display all slides</option>";
												$terms=get_terms('pirenko_slide_set');
												$count = count($terms);
											 	if ($count>0)
											 	{   
                                                	foreach ( $terms as $term ) 
                                                	{ 
                                                    	if ( $options['homepage_slider_group'] == $term->slug )
                                                        	echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . $term->slug  . "'>" . $term->name  . "</option>";
                                                    	else
                                                        	echo "\n\t<option style=\"padding-right: 10px;\" value='" . $term->slug  . "'>" . $term->name  . "</option>";
                                                	}
												}
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
								//SLIDESHOW AUTOPLAY
								?>
								<tr valign="top">
									<td width="375"><?php _e( 'Autoplay slideshow?', 'queedtheme' ); ?></td>										
                                    <td>
										<select name="queed_theme_options[autoplay_homepage]">
											<?php    
												foreach ( $truefalse_options as $option ) 
												{
													$label = $option['label'];
														
													if ( $options['autoplay_homepage'] == $option['value'] ) // Make default first in list
														echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													else
														echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<?php
                                //SLIDESHOW DELAY
                                ?>
                                <tr valign="top">
                                	<th scope="row">
                                   		<?php _e( 'Slideshow delay in miliseconds', 'queedtheme' ); ?>
                                  	</th>
                              		<td>
                                    	<input id="queed_theme_options[delay_homepage]" size="5" type="text" name="queed_theme_options[delay_homepage]" value="<?php esc_attr_e( $options['delay_homepage'] ); ?>" />
                                   	</td>
                              	</tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'PORTFOLIO', 'queedtheme' ); ?></h3></th>
                                <?php
                                //SHOW LATEST PORTFOLIO ON HOMEPAGE
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Show Portfolio entries on Homepage', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[show_homepage_portfolio]">
                                            <?php    
                                                foreach ( $homepage_options as $option ) 
                                                {
													                                                    $label = $option['label'];
                                                    if ( $options['show_homepage_portfolio'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //PORTFOLIO TITLE OPTION
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                    <?php _e( 'Title', 'queedtheme' ); ?>
                                    <p><em>If blank the Template Portfolio Page title will be used instead</em></p>
                                    </th>
                                    <td>
                                        <input id="queed_theme_options[portfolio_title]" size="25" type="text" name="queed_theme_options[portfolio_title]" value="<?php esc_attr_e( $options['portfolio_title'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //PORTFOLIO NUMBER OF POSTS
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                    <?php _e( 'Number of items to display?', 'queedtheme' ); ?>
                                    </th>
                                    <td>
                                        <input id="queed_theme_options[portfolio_show_nr]" size="1" type="text" name="queed_theme_options[portfolio_show_nr]" value="<?php esc_attr_e( $options['portfolio_show_nr'] ); ?>" />
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'BLOG', 'queedtheme' ); ?></h3></th>
                                <?php
                                //SHOW BLOG ON HOMEPAGE
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Show Blog entries on Homepage', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[show_homepage_blog]">
                                            <?php    
                                                foreach ( $homepage_options as $option ) 
                                                {
													                                                    $label = $option['label'];
                                                    if ( $options['show_homepage_blog'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <?php
								//BLOG TITLE OPTION
								?>
								<tr valign="top">
									<th scope="row">
									<?php _e( 'Title', 'queedtheme' ); ?>
									<p><em>If blank the Template News Page title will be used instead</em></p>
									</th>
									<td>
										<input id="queed_theme_options[news_title]" size="25" type="text" name="queed_theme_options[news_title]" value="<?php esc_attr_e( $options['news_title'] ); ?>" />
									</td>
                                </tr>
                                <?php
                                //HOMEPAGE BLOG CATEGORY
								if (!isset($options['blog_group']))
									$options['blog_group']='queed_all_s';
								
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Blog posts category', 'queedtheme' ); ?></th>
                                    <td>
                                    	<select name="queed_theme_options[blog_group]">
                                            <?php 
												echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='queed_all_s'>Don't use any filter</option>";
												$terms=get_categories();
												$count = count($terms);
											 	if ($count>0)
											 	{   
                                                	foreach ( $terms as $term ) 
                                                	{ 
                                                    	if ( $options['blog_group'] == $term->slug )
                                                        	echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . $term->slug  . "'>" . $term->name  . "</option>";
                                                    	else
                                                        	echo "\n\t<option style=\"padding-right: 10px;\" value='" . $term->slug  . "'>" . $term->name  . "</option>";
                                                	}
												}
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //SHOW HTML BLOCK OPTION
								if (!isset($options['show_htmlblock']))
									$options['show_htmlblock']='0';
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'HTML CONTENT BOX', 'queedtheme' ); ?></h3></th>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Show HTML content on Homepage', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[show_htmlblock]">
                                            <?php    
                                                foreach ( $homepage_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['show_htmlblock'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //HTML BLOCK TITLE TEXT
								if (!isset($options['htmlblock_title']))
									$options['htmlblock_title']='';
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                    <?php _e( 'Title', 'queedtheme' ); ?>
                                    </th>
                                    <td>
                                        <input id="queed_theme_options[htmlblock_title]" size="25" type="text" name="queed_theme_options[htmlblock_title]" value="<?php esc_attr_e( $options['htmlblock_title'] ); ?>" />
                                    </td>
                                <?php
                                //HTML BLOCK BODY TEXT
								if (!isset($options['htmlblock_body']))
									$options['htmlblock_body']='';
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Body', 'queedtheme' ); ?>
                                        <p><em>HTML supported</em></p>
                                    </th>
                                    <td width="275">
                                       <textarea id="queed_theme_options[htmlblock_body]" class="pirenko-large-text" cols="60" rows="15" name="queed_theme_options[htmlblock_body]"><?php echo esc_textarea( $options['htmlblock_body'] ); ?></textarea> 
                                    </td>
                                </tr>
                            </table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                            </p>
                        </div>
                        <!--PORTFOLIO PAGE OPTIONS-->
                        <div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Portfolio Options" . "</h2>"; ?></td></tr>
                                <?php
									//USE LIGHTBOX
									if (!isset($options['use_lightbox']))
										$options['use_lightbox']="both";
									//ADJUST VALUES BEFORE UPDATE
									if ($options['use_lightbox']=="true")
										$options['use_lightbox']="both";
									if ($options['use_lightbox']=="false")
										$options['use_lightbox']="link_only";
									?>
									<tr valign="top">
										<th scope="row" width="375">
											<?php _e( 'Show lightbox link on portfolio posts rollover?', 'queedtheme' ); ?>
										</th>
										<td>
											<select name="queed_theme_options[use_lightbox]">
												<?php    
													foreach ( $lightbox_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['use_lightbox'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
                                    <?php
									//SLIDESHOW AUTOPLAY
									?>
									<tr valign="top">
										<td width="375"><?php _e( 'Autoplay slideshow', 'queedtheme' ); ?></td>
										<td>
											<select name="queed_theme_options[autoplay_portfolio]">
												<?php    
													foreach ( $truefalse_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['autoplay_portfolio'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<?php
                                    //SLIDESHOW DELAY
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                        <?php _e( 'Slideshow delay in miliseconds', 'queedtheme' ); ?>
                                        </th>
                                        <td>
                                            <input id="queed_theme_options[delay_portfolio]" size="5" type="text" name="queed_theme_options[delay_portfolio]" value="<?php esc_attr_e( $options['delay_portfolio'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									 //SHOW DATE ON SINGLE PORTFOLIO POSTS
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show date text on single portfolio pages?', 'queedtheme' ); ?></th>
										<td>
											<select name="queed_theme_options[dateby_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['dateby_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<?php
									 //SHOW CATEGORIES ON SINGLE PORTFOLIO POSTS
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show portfolio skills on single portfolio pages?', 'queedtheme' ); ?></th>
										<td>
											<select name="queed_theme_options[categoriesby_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['categoriesby_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
                                    <?php
								//MAKE THUMBS BLACK AND WHITE
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275"><?php _e( 'Make thumbs black and white?', 'queedtheme' ); ?><p><em>This feature requires Timthumb Script (included)</em></p>
                                    </th>
                                    
                                    <td>
                                        <select name="queed_theme_options[portfolio_bw]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['portfolio_bw'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            	</table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                            </p>
                        </div><!-- queed_tab_options -->
                        <!--NEWS PAGE-->
                        <div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Blog Options" . "</h2>"; ?></td></tr>
                                <?php
								 //SHOW POSTED BY ON NEWS
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275"><?php _e( 'Show "Posted by" text on blog?', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[postedby_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['postedby_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
								 //SHOW CATEGORIES ON BLOG
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275"><?php _e( 'Show post categories text on blog?', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[categoriesby_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['categoriesby_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
								 //FORCE IMAGE RESIZE
								 if (!isset($options['forcesize_news']))
										$options['forcesize_news']='yes';
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275"><?php _e( 'Force image resize to 200px height?', 'queedtheme' ); ?></th>
                                    <td>
                                        <select name="queed_theme_options[forcesize_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['forcesize_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                               	<?php
								//MAKE THUMBS BLACK AND WHITE
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275"><?php _e( 'Make thumbs black and white?', 'queedtheme' ); ?><p><em>This feature requires Timthumb Script (included)</em></p>
                                    </th>
                                    
                                    <td>
                                        <select name="queed_theme_options[blog_bw]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['blog_bw'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                            </p>
                        </div><!-- queed_tab_options -->
                        <!-- CONTACT PAGE OPTIONS -->
                        <div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Contact Page Options" . "</h2>"; ?></td></tr>
                                <?php
                                    //EMAIL ADDRESS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'RECEIVING EMAIL', 'queedtheme' ); ?></h3>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[email_address]" size="45" maxlength="50" type="text" name="queed_theme_options[email_address]" value="<?php esc_attr_e( $options['email_address'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //CONTACT INFORMATION
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'CONTACT INFORMATION', 'queedtheme' ); ?></h3>
                                        </th>
                                       
                                    </tr>
                                     <?php
									//TITLE
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Title', 'queedtheme' ); ?>
										</th>
										 <td><input id="queed_theme_options[contact-info_title]" size="45" maxlength="50" type="text" name="queed_theme_options[contact-info_title]" value="<?php esc_attr_e( $options['contact-info_title'] ); ?>" />
                                            
                                        </td>
									</tr>
                                     <?php
									//ADDRESS
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Address', 'queedtheme' ); ?>
										</th>
										 <td>
                                            <textarea id="queed_theme_options[contact-address]" class="pirenko-large-text" cols="40" rows="3" name="queed_theme_options[contact-address]"><?php echo esc_textarea( $options['contact-address'] ); ?></textarea>
                                            
                                        </td>
									</tr>
                                    <?php
									//TELEPHONE
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Telephone', 'queedtheme' ); ?>
										</th>
										 <td><input id="queed_theme_options[contact-info_tel]" size="45" maxlength="50" type="text" name="queed_theme_options[contact-info_tel]" value="<?php esc_attr_e( $options['contact-info_tel'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//FAX
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Fax', 'queedtheme' ); ?>
										</th>
										 <td><input id="queed_theme_options[contact-info_fax]" size="45" maxlength="50" type="text" name="queed_theme_options[contact-info_fax]" value="<?php esc_attr_e( $options['contact-info_fax'] ); ?>" />
                                            
                                        </td>
									</tr>
									<?php
									//EMAIL
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Email', 'queedtheme' ); ?>
										</th>
										 <td><input id="queed_theme_options[contact-info_email]" size="45" maxlength="50" type="text" name="queed_theme_options[contact-info_email]" value="<?php esc_attr_e( $options['contact-info_email'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//END MESSAGE
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Bottom Message', 'queedtheme' ); ?>
										</th>
										 <td>
                                         	<textarea id="queed_theme_options[contact-address_info_msg]" class="pirenko-large-text" cols="40" rows="5" name="queed_theme_options[contact-address_info_msg]"><?php echo esc_textarea( $options['contact-address_info_msg'] ); ?></textarea>                 
                                        </td>
									</tr>
                                <?php
                                //GOOGLE MAPS CODE
                                ?>
                               	<tr valign="top">
                                    <th scope="row">
                                        <h3><?php _e( 'GOOGLE MAPS HTML CODE', 'queedtheme' ); ?></h3>
                                        <p><em>To get your custom code visit http://maps.google.com/ and select your location. Click on the hyperlink button and copy/paste the code here</em></p>
                                     </th>
                                     <td>
                                     <input id="queed_theme_options[google-maps]" size="90%" type="pirenko-text" name="queed_theme_options[google-maps]" value="<?php esc_attr_e( $options['google-maps'] ); ?>" />
                                     </td>
                                 </tr>
                                  <?php
                                    //HELP TEXT ON NAME
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'NAME HELP TEXT', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the name input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_name_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_name_text]" value="<?php esc_attr_e( $options['contact_name_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //HELP TEXT ON EMAIL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'EMAIL HELP TEXT', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the email input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_email_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_email_text]" value="<?php esc_attr_e( $options['contact_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //HELP TEXT ON SUBJECT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'SUBJECT HELP TEXT', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the subject input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_subject_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_subject_text]" value="<?php esc_attr_e( $options['contact_subject_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //HELP TEXT ON MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'MESSAGE HELP TEXT', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the subject input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_message_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_message_text]" value="<?php esc_attr_e( $options['contact_message_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //SUBMIT BUTTON TEXT
									if (!isset($options['contact_submit']))
										$options['contact_submit']='Send Message';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'SUBMIT BUTTON TEXT', 'queedtheme' ); ?></h3>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_submit]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_submit]" value="<?php esc_attr_e( $options['contact_submit'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //ERROR MESSAGE FOR EMPTY TEXTFIELDS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'ERROR MESSAGE FOR EMPTY FIELD', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed when a mandatory input field is empty</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_error_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_error_text]" value="<?php esc_attr_e( $options['contact_error_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //ERROR MESSAGE FOR INVALID EMAILS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'ERROR MESSAGE FOR INVALID EMAIL', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed when the entered email is invalid</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_error_email_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_error_email_text]" value="<?php esc_attr_e( $options['contact_error_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //FFEDBACK - WAIT MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'FORM SUBMISSION: WAIT MESSAGE', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed right after the send message button is clicked and only until the email is sent</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_wait_text]" size="45" maxlength="50" type="text" name="queed_theme_options[contact_wait_text]" value="<?php esc_attr_e( $options['contact_wait_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //FEEDBACK - EMAIL SENT MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'FORM SUBMISSION: OK MESSAGE', 'queedtheme' ); ?></h3>
                                            <p><em>This text will be displayed after sending the email</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[contact_ok_text]" size="85" maxlength="80" type="text" name="queed_theme_options[contact_ok_text]" value="<?php esc_attr_e( $options['contact_ok_text'] ); ?>" />
                                        </td>
                                    </tr>
                            </table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'queedtheme' ); ?>" />
                            </p>
                        </div>
                        <!--404 ERROR PAGE-->
                         <div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " 404 Error Page" . "</h2>"; ?></td></tr>
                                    <?php
                                    //ERROR IMAGE
                                    ?>
                                    <tr valign="top">
                                        <td width="">
                                            <h3><?php _e( '404 ERROR IMAGE', 'queedtheme' ); ?></h3>
                                            <p><em>Recommended width: 700px</em></p>
                                        </td>
                                        <td>
                                            <table>
                                            <tr>
                                                <td>
                                                <img class="pirenko_cms_image" id="queed_theme_options_error404_image" src="<?php esc_attr_e( $options['error404'] ); ?>" style="float:left"  />
                                                </td>
                                            </tr>
                                            <input id="queed_theme_options_error404" size="30"  name="queed_theme_options[error404]" type="hidden" value="<?php esc_attr_e( $options['error404'] ); ?>" />
                                            
                                            <tr>
                                            <td>
                                            <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_error404" secret_id="<?php echo ($items[0]->ID); ?>">Upload Image</a>
                                            </td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                    //TITLE TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'TITLE TEXT', 'queedtheme' ); ?></h3>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[404_title_text]" size="45" maxlength="50" type="text" name="queed_theme_options[404_title_text]" value="<?php esc_attr_e( $options['404_title_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //BODY TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'BODY TEXT', 'queedtheme' ); ?></h3>
                                        </th>
                                        <td>
                                            <textarea id="queed_theme_options[404_body_text]" class="pirenko-large-text" cols="60" rows="10" name="queed_theme_options[404_body_text]"><?php echo esc_textarea( $options['404_body_text'] ); ?></textarea>
                                            
                                        </td>
                                    </tr>
                            </table>
                        </div><!-- queed_tab_options -->
                        <!--TRANSLATIONS-->
                        <div class="queed_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Translations" . "</h2>"; ?></td></tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'VARIOUS', 'queedtheme' ); ?></h3></th>
                                	  <?php
                                    //LAUNCH PROJECT TEXT
									if (!isset($options['collapsed_text']))
										$options['collapsed_text']='Navigation';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Collapsed menu text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[collapsed_text]" size="45" maxlength="50" type="text" name="queed_theme_options[collapsed_text]" value="<?php esc_attr_e( $options['collapsed_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //SEARCH TIP TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Search tip text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[search_tip_text]" size="45" maxlength="50" type="text" name="queed_theme_options[search_tip_text]" value="<?php esc_attr_e( $options['search_tip_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //SEARCH RESULTS PAGE TITLE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Search results page title', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[submit_search_res_title]" size="45" maxlength="50" type="text" name="queed_theme_options[submit_search_res_title]" value="<?php esc_attr_e( $options['submit_search_res_title'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //PREVIOUS TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Previous entries text', 'queedtheme' ); ?>
                                            <em>(Bottom Navigation)</em>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[previous_nav_text]" size="45" maxlength="50" type="text" name="queed_theme_options[previous_nav_text]" value="<?php esc_attr_e( $options['previous_nav_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //REQUIRED TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Required text', 'queedtheme' ); ?>
                                            <em>(Used on mandatory fields)</em>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[required_text]" size="45" maxlength="50" type="text" name="queed_theme_options[required_text]" value="<?php esc_attr_e( $options['required_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//PORTFOLIO TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'PORTFOLIO', 'queedtheme' ); ?></h3></th>
                                    <?php
                                    //SHOW ALL TEXT
									if (!isset($options['all_text']))
										$options['all_text']='All';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'All text', 'queedtheme' ); ?>
                                            <em>(Portfolio filter - show all)</em>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[all_text]" size="45" maxlength="50" type="text" name="queed_theme_options[all_text]" value="<?php esc_attr_e( $options['all_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //SKILLS TEXT
									if (!isset($options['skills_text']))
										$options['skills_text']='Skills';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Category description text', 'pixiatheme' ); ?>
                                            <p><em>"Skills" is the usual choice</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[skills_text]" size="45" maxlength="50" type="text" name="queed_theme_options[skills_text]" value="<?php esc_attr_e( $options['skills_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //LAUNCH PROJECT TEXT
									if (!isset($options['launch_text']))
										$options['launch_text']='Launch Project';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Launch project text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[launch_text]" size="45" maxlength="50" type="text" name="queed_theme_options[launch_text]" value="<?php esc_attr_e( $options['launch_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //RELATED PROJECT TEXT
									if (!isset($options['related_text']))
										$options['related_text']='Related Projects';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Related Projects project text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[related_text]" size="45" maxlength="50" type="text" name="queed_theme_options[related_text]" value="<?php esc_attr_e( $options['related_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//BLOG TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'BLOG', 'queedtheme' ); ?></h3></th>
                                    <?php
                                    //READ MORE TEXT
									if (!isset($options['read_more']))
										$options['read_more']='Read More';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Read more text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[read_more]" size="45" maxlength="50" type="text" name="queed_theme_options[read_more]" value="<?php esc_attr_e( $options['read_more'] ); ?>" />
                                        </td>
                                    </tr>
                                    	<?php
                                    //POSTED BY TEXT
									if (!isset($options['posted_by_text']))
										$options['posted_by_text']='Posted by';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Posted by text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[posted_by_text]" size="45" maxlength="50" type="text" name="queed_theme_options[posted_by_text]" value="<?php esc_attr_e( $options['posted_by_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//COMMENTS TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'COMMENTS', 'queedtheme' ); ?></h3></th>
                                    <?php
                                    //COMMENTS - NO RESPONSES
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Zero comments text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_no_response]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_no_response]" value="<?php esc_attr_e( $options['comments_no_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS - 1 RESPONSE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'One comment text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_one_response]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_one_response]" value="<?php esc_attr_e( $options['comments_one_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS - MULTIPLE RESPONSES
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Multiple comments text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_oneplus_response]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_oneplus_response]" value="<?php esc_attr_e( $options['comments_oneplus_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//RESPOND TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'RESPOND SECTION', 'queedtheme' ); ?></h3></th>
                                    <?php
                                    //COMMENTS CLOSED
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Text to display when the comments are closed', 'queedtheme' ); ?></th>
										<td width="275">
                                            <input id="queed_theme_options[comments_closed]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_closed]" value="<?php esc_attr_e( $options['comments_closed'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //NO RESPONSES YET
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Separator between comments number and post title', 'queedtheme' ); ?>
                                    <p><em>Example: 2 comments <strong>on</strong> "Lorem Ipsum"</em></p>
                                    </th>
                                    
										<td width="275">
                                            <input id="queed_theme_options[comments_on_separator]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_on_separator]" value="<?php esc_attr_e( $options['comments_on_separator'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //LEAVE REPLY
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Text to ask the user to leave a reply', 'queedtheme' ); ?></th>
										<td width="275">
                                            <input id="queed_theme_options[comments_leave_reply]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_leave_reply]" value="<?php esc_attr_e( $options['comments_leave_reply'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON AUTHOR
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Name input field text', 'queedtheme' ); ?>
                                            <p><em>This text will be displayed inside the author input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_author_text]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_author_text]" value="<?php esc_attr_e( $options['comments_author_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON EMAIL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Email input field text', 'queedtheme' ); ?>
                                            <p><em>This text will be displayed inside the email input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_email_text]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_email_text]" value="<?php esc_attr_e( $options['comments_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON URL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'URL input field text', 'queedtheme' ); ?>
                                            <p><em>This text will be displayed inside the URL input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_url_text]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_url_text]" value="<?php esc_attr_e( $options['comments_url_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON COMMENT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Comment input textarea text', 'queedtheme' ); ?>
                                            <p><em>This text will be displayed inside the comment input textarea</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_comment_text]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_comment_text]" value="<?php esc_attr_e( $options['comments_comment_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //SUBMIT COMMENT BUTTON TEXT
									if (!isset($options['comments_submit']))
										$options['comments_submit']='Submit Comment';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Submit comment button text', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comments_submit]" size="45" maxlength="50" type="text" name="queed_theme_options[comments_submit]" value="<?php esc_attr_e( $options['comments_submit'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS ACCEPTED TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Comment submitted text', 'queedtheme' ); ?>
                                            <p><em>This text is displayed after the comment is submitted</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[comment_ok_message]" size="45" maxlength="50" type="text" name="queed_theme_options[comment_ok_message]" value="<?php esc_attr_e( $options['comment_ok_message'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS EMPTY TEXT ERROR ON ALL FIELDS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Empty text error message', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[empty_text_error]" size="45" maxlength="50" type="text" name="queed_theme_options[empty_text_error]" value="<?php esc_attr_e( $options['empty_text_error'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS INVALID EMAIL ERROR
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Invalid email error message', 'queedtheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="queed_theme_options[invalid_email_error]" size="45" maxlength="50" type="text" name="queed_theme_options[invalid_email_error]" value="<?php esc_attr_e( $options['invalid_email_error'] ); ?>" />
                                        </td>
                                    </tr>
                            </table>
                        </div><!-- TRANSLATIONS OPTIONS --> 
				</form>
				<form name="pirenko_reset_form" method="post" action="?page=theme_options&reset_queed=true">
					<input type="hidden" name="action" value="reset_queed" />
				</form>
				<script language="JavaScript">
                    function go_there()
                    {
                        var where_to=confirm("Are you sure you want to reset all settings?");
                        if (where_to==true)
                        {
                            document.pirenko_reset_form.submit()
                        }
                        else
                        {
                      
                        }
                    }
				</script>
			</div><!-- pirenko_options -->
		</div>
		<?php
	}
	//FUNCTION TO VALIDATE FIELDS IF NECESSARY
	function theme_options_validate( $input ) 
	{
		global $select_options;
	
		return $input;
	}
	//SAVE FUNCTION
	function save_meta_box( $post_id ) 
	{
		global $post, $meta_boxes, $key;
	 	if (isset($post->post_type))
		{
			if ($post->post_type=="post")
			{
				foreach( $meta_boxes as $meta_box ) 
				{
					if (isset($_POST[ $meta_box[ 'name' ] ]))
						$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
				}
				
				if (isset($_POST[ $key . '_wpnonce' ]))
					if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
						return $post_id;
			 
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			 	if (isset($data))
					update_post_meta( $post_id, $key, $data );
			}
		}
	}
	//add_action( 'admin_menu', 'create_meta_box' );
	add_action( 'save_post', 'save_meta_box' );
	
	//-------------------------------------------
	//CREATE CUSTOM WRITE PANEL FOR REGULAR POSTS
	//-------------------------------------------
	//META BOX FOR POSTS
	$key = "key";
	$meta_boxes = array(
	"skip_featured" => array(
	"name" => "skip_featured",
	"title" => "Use featured image on slideshow and Prettyphoto Lightbox?",
	"description" => ""),
	"bl_icon" => array(
	"name" => "bl_icon",
	"title" => "Select the icon to use with this post",
	"description" => ""),
	"image-1" => array(
	"name" => "image-1",
	"title" => "Image 1",
	"description" => ""),
	"image-2" => array(
	"name" => "image-2",
	"title" => "Image/Video 2",
	"description" => ""),
	"image-3" => array(
	"name" => "image-3",
	"title" => "Image/Video 3",
	"description" => ""),
	"image-4" => array(
	"name" => "image-4",
	"title" => "Image/Video 4",
	"description" => ""),
	"image-5" => array(
	"name" => "image-5",
	"title" => "Image/Video 5",
	"description" => ""),
	"image-6" => array(
	"name" => "image-6",
	"title" => "Image/Video 6",
	"description" => ""),
	"image-7" => array(
	"name" => "image-7",
	"title" => "Image/Video 7",
	"description" => ""),
	"image-8" => array(
	"name" => "image-8",
	"title" => "Image/Video 8",
	"description" => ""),
	"image-9" => array(
	"name" => "image-9",
	"title" => "Image/Video 9",
	"description" => ""),
	"image-10" => array(
	"name" => "image-10",
	"title" => "Image/Video 10",
	"description" => "")
	);
	function create_meta_box() 
	{
		global $key;
		if( function_exists( 'add_meta_box' )) 
		{
			add_meta_box( 'new-meta-boxes', 'Queed Custom Post Options', 'display_meta_box', 'post', 'normal', 'high' );
		}
	} 
	function display_meta_box() 
	{
		global $post, $meta_boxes, $key, $blog_icon_options;
		?>
		<div class="form-wrap">
			<?php
                wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
                $helper=0;
                foreach($meta_boxes as $meta_box) 
                {
                    if ($helper==0)
                    {
						//THIS IS THE SKIP FEATURED OPTION
                        $data = get_post_meta($post->ID, $key, true);
						$mm_helper="";
						if (isset($data[ $meta_box[ 'name' ]]))
						{
							if ($data[ $meta_box[ 'name' ]]==1 || $data[ $meta_box[ 'name' ]]=="") 
								$mm_helper='CHECKED';
						}
						else
							$mm_helper='CHECKED';
                        ?>
                        <div class="form-field form-required">
                            <label for="<?php echo $meta_box[ 'name' ]; ?>"><strong><?php echo $meta_box[ 'title' ]; ?></strong>
                            <input type="hidden" name="<?php echo $meta_box[ 'name' ]; ?>" value="0" />
                            <input type="checkbox" style="width:50px" name="<?php echo $meta_box[ 'name' ]; ?>" value="1" <?php echo $mm_helper; ?> /></label>
                            
                            <p><?php echo $meta_box[ 'description' ]; ?></p>
                        </div>
                        
                        <?php
					}
					if ($helper==1)
                    {
						//THIS IS THE ICON OPTION
						 $data = get_post_meta($post->ID, $key, true);
						if (!isset($data[ $meta_box[ 'name' ] ]))
							$data[$meta_box['name' ]]="-57";
						?>
                        <div class="form-field form-required">
                            <label for="<?php echo $meta_box[ 'name' ]; ?>"><strong><?php echo $meta_box[ 'title' ]; ?></strong>
                            <input id="queed_<?php echo $meta_box[ 'name' ]; ?>" type="hidden" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
                            </label>
						<?php
                        foreach ( $blog_icon_options as $option ) 
                        {
							$selected="";
							if ($data[ $meta_box[ 'name' ] ] == $option['value'])
								$selected="active_ic";
							echo '<div class="bl_icon_preview '. $selected .'" secret_pos="'. $option['value'] .'" style="background-image:url('.get_bloginfo('template_directory').'/images/icons/clear/various_icons.png);background-position:'. $option['value'] .'px 3px;background-repeat: no-repeat;";></div>';
						}
                        echo "</div>";
						echo "<div class='bl_images_divider'></div>";
                    }
                    //FEATURED IMAGE
                    if ($helper==2)
                    {
                        $image[0]="";
                        if (has_post_thumbnail( $post->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <?php endif; ?>
                        
                        <div class="form-field form-required">
                        <label><strong>Images associated with this post</strong></label>
                        </div>
                        <div class="form-field form-required">
                            <label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
                            <input type="hidden" id="queed_<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" disabled="disabled" value="<?php echo $image[0]; ?>" />
                            <p>This image is the featured image. Please set this up by editing the Featured Image on the right side of this page.</p>
                        </div>
                        <?php 	
                    }
					//REMAINING 9 IMAGES
                    if ($helper>2)
                    {
                        $data = get_post_meta($post->ID, $key, true);
						if (!isset($data[ $meta_box[ 'name' ] ]))
							$data[$meta_box['name' ]]="";
                        ?>
                        <div class="form-field form-required">
                            <label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
                            <input type="text" id="queed_<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
                            <p><?php echo $meta_box[ 'description' ]; ?></p>
                            <input class="pirenko_upload" type="button" style="width:100px" value="Upload image" name="<?php echo $meta_box[ 'name' ]; ?>">
                        </div>
                        <?php 
                    } 
                    $helper++;
                }
            ?> 
		</div>
	<?php
	}
	add_action( 'admin_menu', 'create_meta_box' );
	
	?>