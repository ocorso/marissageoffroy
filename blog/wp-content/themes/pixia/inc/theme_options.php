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
		#pixia_options
		{
			width:1000%;
			margin-top:-16px;
		}
		#pixia_options em
		{
			color:#666;
		}
		#pixia_options h3
		{
			color:#333;
			text-decoration:underline;
			margin:8px 0px 0px 0px;
		}
		.pixia_tab_options
		{
			float:left;
		}
		#pirenko_admin_menu
		{
			padding-right:2px;
			padding-left:2px;
		}
		#pirenko_admin_menu ul
		{
			list-style-type: none;
			background-image: url('.get_template_directory_uri().'/images/admin/navi_bg.png);
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
			background-image: url('.get_template_directory_uri().'/images/admin/navi_bg_divider.png);
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
		.pixia_tab_options
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
		#pixia_selector
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
		register_setting( 'sample_options', 'pixia_theme_options', 'theme_options_validate' );
	}
	//LOAD THE MENU PAGE
	function theme_options_add_page() 
	{
		add_menu_page( __( 'Pixia Options', 'pixia_theme' ), __( 'Pixia Options', 'pixia_theme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
		//add_theme_page
	}
	
	//CREATE ARRAYS WITH THE OPTIONS
	
	//HOMEPAGE POSITION OPTIONS
	$homepage_options = array(
		'no_display' => array(
			'value' => '0',
			'label' => __( 'No display', 'pixiatheme' )
		),
		'top' => array(
			'value' => '1',
			'label' => __( 'Position 1 - Top', 'pixiatheme' )
		),
		'center' => array(
			'value' => '2',
			'label' => __( 'Position 2 - Center Top', 'pixiatheme' )
		),
		'bottom' => array(
			'value' => '3',
			'label' => __( 'Position 3 - Center Bottom', 'pixiatheme' )
			
		),
		'bottom_down' => array(
			'value' => '4',
			'label' => __( 'Position 4 - Bottom', 'pixiatheme' )
		)
	);
	
	//YES/NO OPTION
	$yesno_options = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'pixiatheme' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'pixiatheme' )
		)
	);
	
	//ARCHIVES OPTIONS
	$archives_options = array(
		'classic' => array(
			'value' => 'classic',
			'label' => __( 'Classic', 'pixiatheme' )
		),
		'masonry' => array(
			'value' => 'masonry',
			'label' => __( 'Masonry', 'pixiatheme' )
		)
	);
	
	//OVERLAYS
	$overlay_options = array(
		'0' => array(
			'value' =>	'',
			'label' => __( 'None', 'pixiatheme' )
		),
		'1' => array(
			'value' =>	'diagonal_left_white.png',
			'label' => __( 'Left Diagonal Lines (clear)', 'pixiatheme' )
		),
		'2' => array(
			'value' =>	'diagonal_left.png',
			'label' => __( 'Left Diagonal Lines', 'pixiatheme' )
		),
		'3' => array(
			'value' =>	'diagonal_right_white.png',
			'label' => __( 'Right Diagonal Lines (clear)', 'pixiatheme' )
		),
		'4' => array(
			'value' =>	'diagonal_right.png',
			'label' => __( 'Right Diagonal Lines', 'pixiatheme' )
		),
		'5' => array(
			'value' =>	'keys_white.png',
			'label' => __( 'Diagonal Spaces (clear)', 'pixiatheme' )
		),
		'6' => array(
			'value' =>	'keys.png',
			'label' => __( 'Diagonal Spaces', 'pixiatheme' )
		),
		'7' => array(
			'value' =>	'oblique_squares_lg_white.png',
			'label' => __( 'Large Oblique Squares (clear)', 'pixiatheme' )
		),
		'8' => array(
			'value' =>	'oblique_squares_lg.png',
			'label' => __( 'Large Oblique Squares', 'pixiatheme' )
		),
		'9' => array(
			'value' =>	'oblique_squares_white.png',
			'label' => __( 'Oblique Squares (clear)', 'pixiatheme' )
		),
		'10' => array(
			'value' =>	'oblique_squares.png',
			'label' => __( 'Oblique Squares', 'pixiatheme' )
		),
		'11' => array(
			'value' =>	'zig_zag_lg_white.png',
			'label' => __( 'Large Zig Zag (clear)', 'pixiatheme' )
		),
		'12' => array(
			'value' =>	'zig_zag_lg.png',
			'label' => __( 'Large Zig Zag', 'pixiatheme' )
		),
		'13' => array(
			'value' =>	'zig_zag_white.png',
			'label' => __( 'Zig Zag (clear)', 'pixiatheme' )
		),
		'14' => array(
			'value' =>	'zig_zag.png',
			'label' => __( 'Zig Zag', 'pixiatheme' )
		)
	);
	
	//PATTERN BACKGROUNDS
	$pattern_options = array(
		'0' => array(
			'value' =>	'',
			'label' => __( 'None', 'pixiatheme' )
		),
		'1' => array(
			'value' =>	'grey.jpg',
			'label' => __( 'Dotted Grey', 'pixiatheme' )
		),
		'2' => array(
			'value' =>	'oblique.png',
			'label' => __( 'Oblique Lines', 'pixiatheme' )
		),
		'3' => array(
			'value' =>	'concrete.jpg',
			'label' => __( 'Concrete', 'pixiatheme' )
		),
		'4' => array(
			'value' =>	'cream.jpg',
			'label' => __( 'Cream', 'pixiatheme' )
		),
		'5' => array(
			'value' =>	'white_grungy.png',
			'label' => __( 'Grungy Squares', 'pixiatheme' )
		),
		'6' => array(
			'value' =>	'oblique_squares.png',
			'label' => __( 'Oblique Squares', 'pixiatheme' )
		),
		'7' => array(
			'value' =>	'white_circles.png',
			'label' => __( 'Clear Circles', 'pixiatheme' )
		),
		'8' => array(
			'value' =>	'dot.gif',
			'label' => __( 'Dark Dots', 'pixiatheme' )
		),
		'9' => array(
			'value' =>	'alt_black.jpg',
			'label' => __( 'Dark Irregular', 'pixiatheme' )
		),
		'10' => array(
			'value' =>	'curvy.jpg',
			'label' => __( 'Dark Curves', 'pixiatheme' )
		),
		'11' => array(
			'value' =>	'dark_dots.png',
			'label' => __( 'Dark Stamped', 'pixiatheme' )
		),
		'12' => array(
			'value' =>	'dark_squares.png',
			'label' => __( 'Dark Squares', 'pixiatheme' )
		),
		'13' => array(
			'value' =>	'losangles.png',
			'label' => __( 'Dark Losangles', 'pixiatheme' )
		),
		'14' => array(
			'value' =>	'dark_circles.png',
			'label' => __( 'Dark Circles', 'pixiatheme' )
		),
		'15' => array(
			'value' =>	'scratch.jpg',
			'label' => __( 'Scratches', 'pixiatheme' )
		),
		'16' => array(
			'value' =>	'texturetastic_gray.png',
			'label' => __( 'Textured Grey', 'pixiatheme' )
		),
		'51' => array(
			'value' =>	'text_gray_light.jpg',
			'label' => __( 'Textured Grey (light)', 'pixiatheme' )
		),
		'17' => array(
			'value' =>	'lghtmesh.png',
			'label' => __( 'Light Mesh', 'pixiatheme' )
		),
		'18' => array(
			'value' =>	'dark_tire.png',
			'label' => __( 'Dark Stripes', 'pixiatheme' )
		),
		'19' => array(
			'value' =>	'first_aid_kit.png',
			'label' => __( 'Grey Squares', 'pixiatheme' )
		),
		'20' => array(
			'value' =>	'rough_diagonal.png',
			'label' => __( 'Rough Diagonal', 'pixiatheme' )
		),
		'21' => array(
			'value' =>	'purty_wood.png',
			'label' => __( 'Yellow Wood', 'pixiatheme' )
		),
		'22' => array(
			'value' =>	'stacked_circles.png',
			'label' => __( 'Stacked Circles', 'pixiatheme' )
		),
		'23' => array(
			'value' =>	'outlets.png',
			'label' => __( 'Outlets', 'pixiatheme' )
		),
		'24' => array(
			'value' =>	'farmer.png',
			'label' => __( 'Squared Seamless', 'pixiatheme' )
		),
		'25' => array(
			'value' =>	'wood_texture.png',
			'label' => __( 'Textured Wood', 'pixiatheme' )
		),
		'26' => array(
			'value' =>	'vintage_speckles.png',
			'label' => __( 'Vintage', 'pixiatheme' )
		),
		'27' => array(
			'value' =>	'grid_noise.png',
			'label' => __( 'Grid Noise', 'pixiatheme' )
		),
		'28' => array(
			'value' =>	'chruch.png',
			'label' => __( 'Seamless White', 'pixiatheme' )
		),
		'29' => array(
			'value' =>	'cross_scratches.png',
			'label' => __( 'Cross Scratches', 'pixiatheme' )
		),
		'30' => array(
			'value' =>	'blu_stripes.png',
			'label' => __( 'Blue', 'pixiatheme' )
		),
		'31' => array(
			'value' =>	'classy_fabric.png',
			'label' => __( 'Classy Fabric', 'pixiatheme' )
		),
		'32' => array(
			'value' =>	'vertical_cloth.png',
			'label' => __( 'Vertical Cloth', 'pixiatheme' )
		),
		'33' => array(
			'value' =>	'darkdenim.png',
			'label' => __( 'Dark Denim', 'pixiatheme' )
		),
		'34' => array(
			'value' =>	'nami.png',
			'label' => __( 'Seamless Dark', 'pixiatheme' )
		),
		'35' => array(
			'value' =>	'broken_noise.png',
			'label' => __( 'Broken Noise', 'pixiatheme' )
		),
		'36' => array(
			'value' =>	'fake_brick.png',
			'label' => __( 'Fake Fabric', 'pixiatheme' )
		),
		'37' => array(
			'value' =>	'type.png',
			'label' => __( 'Typographic', 'pixiatheme' )
		),
		'38' => array(
			'value' =>	'noise_pattern.png',
			'label' => __( 'Noisy', 'pixiatheme' )
		),
		'39' => array(
			'value' =>	'dark_mosaic.png',
			'label' => __( 'Dark Mosaic', 'pixiatheme' )
		),
		'40' => array(
			'value' =>	'whitey.png',
			'label' => __( 'Simple White', 'pixiatheme' )
		),
		'41' => array(
			'value' =>	'random_grey_variations.png',
			'label' => __( 'Grey Variations', 'pixiatheme' )
		),
		'42' => array(
			'value' =>	'black-linen.png',
			'label' => __( 'Black Linen', 'pixiatheme' )
		),
		'43' => array(
			'value' =>	'light_honeycomb.png',
			'label' => __( 'Light Honeycomb', 'pixiatheme' )
		),
		'44' => array(
			'value' =>	'black_paper.png',
			'label' => __( 'Black Paper', 'pixiatheme' )
		),
		'45' => array(
			'value' =>	'dark_stripes.png',
			'label' => __( 'Dark Stripes', 'pixiatheme' )
		),
		'46' => array(
			'value' =>	'pinstriped_suit.png',
			'label' => __( 'Dark Pin Stripes', 'pixiatheme' )
		),
		'47' => array(
			'value' =>	'hixs_pattern_evolution.png',
			'label' => __( 'Dark Metal', 'pixiatheme' )
		),
		'48' => array(
			'value' =>	'irongrip.png',
			'label' => __( 'Iron Grip', 'pixiatheme' )
		),
		'49' => array(
			'value' =>	'px.png',
			'label' => __( 'Tiny Squares', 'pixiatheme' )
		),
		'50' => array(
			'value' =>	'green_dust_scratch.png',
			'label' => __( 'Vintage Green', 'pixiatheme' )
		),
		'52' => array(
			'value' =>	'plain.png',
			'label' => __( 'Vertical Lines', 'pixiatheme' )
		),
		'53' => array(
			'value' =>	'suriken.png',
			'label' => __( 'Duotone Strikes', 'pixiatheme' )
		),
		'58' => array(
			'value' =>	'suriken_bw.png',
			'label' => __( 'Monotone Strikes', 'pixiatheme' )
		),
		'54' => array(
			'value' =>	'strange_bullseyes.png',
			'label' => __( 'Bullseyes', 'pixiatheme' )
		),
		'55' => array(
			'value' =>	'tiny_grid.png',
			'label' => __( 'Tiny Grid', 'pixiatheme' )
		),
		'56' => array(
			'value' =>	'noise_lines.png',
			'label' => __( 'Noise Lines', 'pixiatheme' )
		),
		'57' => array(
			'value' =>	'lightpaperfibers.png',
			'label' => __( 'Paper Fibers', 'pixiatheme' )
		),
		'59' => array(
			'value' =>	'white_grid.jpg',
			'label' => __( 'White Grid', 'pixiatheme' )
		),
		'60' => array(
			'value' =>	'geometric.jpg',
			'label' => __( 'Clear and geometric', 'pixiatheme' )
		),
		'61' => array(
			'value' =>	'noisy.jpg',
			'label' => __( 'Noisy Paper', 'pixiatheme' )
		),
		'62' => array(
			'value' =>	'blurred.jpg',
			'label' => __( 'Blurry knots', 'pixiatheme' )
		),
		'63' => array(
			'value' =>	'grid.png',
			'label' => __( 'Seamless Grid', 'pixiatheme' )
		)
		
	);
	
	//TRUE/FALSE OPTION
	$truefalse_options = array(
		'true' => array(
			'value' => 'true',
			'label' => __( 'Yes', 'pixiatheme' )
		),
		'false' => array(
			'value' => 'false',
			'label' => __( 'No', 'pixiatheme' )
		)
	);
	
	//SHOW LIGHTBOX BUTTON ON ROLLOVER
	$lightbox_options = array(
		'both' => array(
			'value' => 'both',
			'label' => __( 'Show lightbox and link button', 'pixiatheme' )
		),
		'light_only' => array(
			'value' => 'light_only',
			'label' => __( 'Show only lightbox button', 'pixiatheme' )
		),
		'link_only' => array(
			'value' => 'link_only',
			'label' => __( 'Show only link button', 'pixiatheme' )
		)
	);
	
	//FONTS
	$select_font_options = array(
		'9' => array(
			'value' =>	'Acme',
			'label' => __( 'Acme', 'eboardtheme' )
		),
		'4' => array(
			'value' =>	'Alegreya:400italic,700italic,400,700',
			'label' => __( 'Alegreya', 'eboardtheme' )
		),
		'50' => array(
			'value' =>	'Antic+Didone',
			'label' => __( 'Antic Didone', 'eboardtheme' )
		),
		'16' => array(
			'value' =>	'Anton',
			'label' => __( 'Anton', 'eboardtheme' )
		),
		'14' => array(
			'value' =>	'Arial',
			'label' => __( 'Arial', 'eboardtheme' )
		),
		'5' => array(
			'value' =>	'Arvo',
			'label' => __( 'Arvo', 'eboardtheme' )
		),
		'10' => array(
			'value' =>	'Asap',
			'label' => __( 'Asap', 'eboardtheme' )
		),
		'7' => array(
			'value' =>	'Asul:400,700',
			'label' => __( 'Asul', 'eboardtheme' )
		),
		'43' => array(
			'value' =>	'Average+Sans',
			'label' => __( 'Average Sans', 'eboardtheme' )
		),
		'57' => array(
			'value' =>	'bebas_neue',
			'label' => __( 'Bebas Neue', 'zupertheme' )
		),
		'42' => array(
			'value' =>	'Bitter:400,700,400italic',
			'label' => __( 'Bitter', 'eboardtheme' )
		),
		'25' => array(
			'value' =>	'Bree+Serif',
			'label' => __( 'Bree Serif', 'eboardtheme' )
		),
		'11' => array(
			'value' =>	'Cabin:500,500italic',
			'label' => __( 'Cabin', 'eboardtheme' )
		),
		'46' => array(
			'value' =>	'Cinzel:400,700',
			'label' => __( 'Cinzel', 'eboardtheme' )
		),
		'29' => array(
			'value' =>	'courier_new',
			'label' => __( 'Courier New', 'eboardtheme' )
		),
		'24' => array(
			'value' =>	'Cousine:400,700',
			'label' => __( 'Cousine', 'eboardtheme' )
		),
		'22' => array(
			'value' =>	'Dosis:500,600,700',
			'label' => __( 'Dosis', 'eboardtheme' )
		),
		'1' => array(
			'value' =>	'Droid+Sans:400,700',
			'label' => __( 'Droid Sans', 'eboardtheme' )
		),
		'8' => array(
			'value' =>	'Droid+Serif',
			'label' => __( 'Droid Serif', 'eboardtheme' )
		),
		'18' => array(
			'value' =>	'Economica:700',
			'label' => __( 'Economica', 'eboardtheme' )
		),
		'17' => array(
			'value' =>	'Exo:700,800',
			'label' => __( 'Exo Sans', 'eboardtheme' )
		),
		'15' => array(
			'value' =>	'Francois+One',
			'label' => __( 'Francois One', 'eboardtheme' )
		),
		'54' => array(
			'value' =>	'Gilda+Display',
			'label' => __( 'Gilda Display', 'eboardtheme' )
		),
		'30' => array(
			'value' =>	'helvetica',
			'label' => __( 'Helvetica', 'eboardtheme' )
		),
		'51' => array(
			'value' =>	'IM+Fell+Double+Pica+SC',
			'label' => __( 'IM Fell Double Pica SC', 'eboardtheme' )
		),
		'49' => array(
			'value' =>	'Italiana',
			'label' => __( 'Italiana', 'eboardtheme' )
		),
		'47' => array(
			'value' =>	'Julius+Sans+One',
			'label' => __( 'Julius Sans One', 'eboardtheme' )
		),
		'26' => array(
			'value' =>	'Lato:300,400,700',
			'label' => __( 'Lato', 'eboardtheme' )
		),
		'32' => array(
			'value' =>	'Lora',
			'label' => __( 'Lora', 'eboardtheme' )
		),
		'52' => array(
			'value' =>	'Mate+SC',
			'label' => __( 'Mate SC', 'eboardtheme' )
		),
		'31' => array(
			'value' =>	'Montserrat',
			'label' => __( 'Montserrat', 'eboardtheme' )
		),
		'37' => array(
			'value' =>	'Muli:400,400italic',
			'label' => __( 'Muli', 'eboardtheme' )
		),
		'13' => array(
			'value' =>	'Oswald:700,400,300',
			'label' => __( 'Oswald', 'eboardtheme' )
		),
		'0' => array(
			'value' =>	'Open+Sans:400italic,600italic,700italic,400,600,700',
			'label' => __( 'Open Sans', 'eboardtheme' )
		),
		'45' => array(
			'value' =>	'Orienta',
			'label' => __( 'Orienta', 'eboardtheme' )
		),
		'36' => array(
			'value' =>	'Overlock+SC',
			'label' => __( 'Overlock SC', 'eboardtheme' )
		),
		'33' => array(
			'value' =>	'Oxygen+Mono',
			'label' => __( 'Oxygen Mono', 'eboardtheme' )
		),
		'41' => array(
			'value' =>	'Patua+One',
			'label' => __( 'Patua One', 'eboardtheme' )
		),
		'39' => array(
			'value' =>	'Pompiere',
			'label' => __( 'Pompiere', 'eboardtheme' )
		),
		'2' => array(
			'value' =>	'PT+Sans:400,700,400italic',
			'label' => __( 'PT Sans', 'eboardtheme' )
		),
		'28' => array(
			'value' =>	'PT+Sans+Narrow',
			'label' => __( 'PT Sans Narrow', 'eboardtheme' )
		),
		'23' => array(
			'value' =>	'Questrial',
			'label' => __( 'Questrial', 'eboardtheme' )
		),
		'35' => array(
			'value' =>	'Quicksand:400,700',
			'label' => __( 'Quicksand', 'eboardtheme' )
		),
		'34' => array(
			'value' =>	'Raleway:200,400,700',
			'label' => __( 'Raleway', 'eboardtheme' )
		),
		'48' => array(
			'value' =>	'Raleway+Dots',
			'label' => __( 'Raleway Dots', 'eboardtheme' )
		),
		'56' => array(
			'value' =>	'Roboto:400,700',
			'label' => __( 'Roboto', 'eboardtheme' )
		),
		'53' => array(
			'value' =>	'Rokkitt:400,700',
			'label' => __( 'Rokkitt', 'eboardtheme' )
		),
		'12' => array(
			'value' =>	'Ruda:400,700,900',
			'label' => __( 'Ruda', 'eboardtheme' )
		),
		'55' => array(
			'value' =>	'Rufina:400,700',
			'label' => __( 'Rufina', 'eboardtheme' )
		),
		'38' => array(
			'value' =>	'Rye',
			'label' => __( 'Rye', 'eboardtheme' )
		),
		'44' => array(
			'value' =>	'Share+Tech',
			'label' => __( 'Share Tech', 'eboardtheme' )
		),
		'40' => array(
			'value' =>	'Titillium+Web:400,600,400italic',
			'label' => __( 'Titillium Web', 'eboardtheme' )
		),
		'6' => array(
			'value' =>	'Ubuntu',
			'label' => __( 'Ubuntu', 'eboardtheme' )
		),
		'27' => array(
			'value' =>	'Vollkorn:400italic,400',
			'label' => __( 'Vollkorn', 'eboardtheme' )
		),
		'3' => array(
			'value' =>	'Yanone+Kaffeesatz',
			'label' => __( 'Yanone Kaffeesatz', 'eboardtheme' )
		)
		//58 IS NEXT
	);
	
	//SKINS
	$icon_options = array(
		'0' => array(
			'value' =>	'dark',
			'label' => __( 'Use Dark Icons', 'pixiatheme' )
		),
		'1' => array(
			'value' =>	'clear',
			'label' => __( 'Use Clear Icons', 'pixiatheme' )
		)
	);
	
	//SKINS CONTACT
	$icon_options_ct = array(
		'0' => array(
			'value' =>	'black_ic',
			'label' => __( 'Black Icons', 'pixiatheme' )
		),
		'1' => array(
			'value' =>	'white_ic',
			'label' => __( 'White Icons', 'pixiatheme' )
		),
		'2' => array(
			'value' =>	'custom_ic',
			'label' => __( 'Custom Icons (grey)', 'pixiatheme' )
		)
	);
	
	//BLOG POST ICONS
	$blog_icon_options = array(
		'0' => array(
			'value' =>	'-57',
			'label' => __( 'Link', 'pixiatheme' )
		),
		'2' => array(
			'value' =>	'-94',
			'label' => __( 'Lab', 'pixiatheme' )
		),
		'3' => array(
			'value' =>	'-128',
			'label' => __( 'Image', 'pixiatheme' )
		),
		'4' => array(
			'value' =>	'-165',
			'label' => __( 'Video', 'pixiatheme' )
		),
		'5' => array(
			'value' =>	'-201',
			'label' => __( 'Mouse', 'pixiatheme' )
		),
		'6' => array(
			'value' =>	'-237',
			'label' => __( 'Camera', 'pixiatheme' )
		),
		'7' => array(
			'value' =>	'-273',
			'label' => __( 'Speech', 'pixiatheme' )
		),
		'8' => array(
			'value' =>	'-310',
			'label' => __( 'Pencil', 'pixiatheme' )
		)
	);
	
	
	//CREATE THE OPTIONS PAGE
	function theme_options_do_page() 
	{
		//SEND VALUE TO ADMIN SCRIPTS
		?>
		<script type="text/javascript">
			var pixia_directory = "<?php echo get_template_directory_uri() ?>";
		</script>
		<?php
			global $overlay_options, $select_font_options,$yesno_options,$homepage_options,$icon_options,$icon_options_ct, $pattern_options, $truefalse_options, $lightbox_options,$blog_icon_options,$archives_options;
			if ( ! isset( $_REQUEST['settings-updated'] ) )
				$_REQUEST['settings-updated'] = false;
			//GET THEME DATA FROM THE STYLESHEET
			$theme_data = wp_get_theme();
		?>
        <div id="prk_save_progress">Saving...</div>
		<div class="wrap">
			<div id="pirenko_admin_menu">
				<ul>
					<li><a href="#" id="pixia_general_options_button">General</a></li>
                    <li><a href="#" id="pixia_portfolio_options_button">Portfolio</a></li>
                    <li><a href="#" id="pixia_news_options_button">Blog</a></li>
					<li><a href="#" id="pixia_contact_options_button">Contact</a></li>
					<li><a href="#" id="pixia_404_error_options_button">404 Page</a></li>
                    <li><a href="#" id="pixia_translations_options_button">Translations</a></li>
                    <li><a href="#" id="pixia_custom_options_button">Custom Scripts</a></li>
					<div id="pirenko_admin_menu_footer">
						Pixia Theme Admin Panel
					</div>
				</ul>
			</div>
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
				<div class="updated fade"><p><strong><?php _e( 'Options saved', 'pixiatheme' ); ?></strong></p></div>
			<?php endif; ?>
			<div id="pirenko_options">
                <form id="prk_main_options" method="post" action="">
                    <input id="set_default" type="hidden" size="1" type="text" name="pixia_theme_options[set_default]" value="false" />
                    <p class="save_options">
                        <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                    </p>
                    <input type="button" class="button-primary pirenko_reset_button" value="Reset All Settings" onClick="go_there()" />
                    <?php settings_fields( 'sample_options' ); ?>
                    <?php $options = get_option( 'pixia_theme_options' ); ?>
                    <div id="pixia_options">
                        <!--GENERAL OPTIONS-->
                        <div class="pixia_tab_options" id="pirenko_general_options">
                            <table class="form-table">       
                                <tr>
                                <td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " General Options" . "</h2>"; ?></td></tr>
                                <?php
                                //RESPONSIVENESS
								if (!isset($options['responsive']))
									$options['responsive']="false";
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'LIQUID LAYOUT OPTIONS', 'pixiatheme' ); ?></h3></th>
                                <tr valign="top"><th scope="row">
                                <?php _e( 'Responsiveness', 'pixiatheme' ); ?>
                                <p><em>Make theme adjust to smaller screens</em></p>
                                    </th>
                                <td>
                                <select name="pixia_theme_options[responsive]">
                                    <?php    
                                        foreach ( $truefalse_options as $option ) 
                                        {
                                            $label = $option['label'];
                                            
                                            if ( $options['responsive'] == $option['value'] ) // Make default first in list
                                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                            else
                                                echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                        }
                                    ?>
                                    </select> 
                                    </td>
                                </tr>
                                <?php
                                //CUSTOM WIDTH
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Maximum content width', 'pixiatheme' ); ?>
                                    <p><em>The main window stops scaling at this value</em></p>
                                </th>
                                    <td>
                                        <input id="custom_width" size="6" maxlength="5" type="text" name="pixia_theme_options[custom_width]" value="<?php echo( $options['custom_width'] ); ?>" />
                                    </td>
                                </tr>
                                 <?php
                                //CUSTOM HEIGHT
								if (!isset($options['custom_height']))
									$options['custom_height']="400";
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Minimum content height', 'pixiatheme' ); ?>
                                    <p><em>The menu will collapse when this height is reached</em></p>
                                </th>
                                    <td>
                                        <input id="custom_height" size="6" maxlength="5" type="text" name="pixia_theme_options[custom_height]" value="<?php echo( $options['custom_height'] ); ?>" />
                                    </td>
                                </tr>        
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
									$items = wp_get_nav_menu_items( 'Pixia Main Menu', $args ); 
                               ?>
                                <tr valign="top">
                                	<td width="275"><h3><?php _e( 'LOGO IMAGE', 'pixiatheme' ); ?></h3>
                                    <p><em>Should not exceed 185px in width</em></p></td>
                                    
                                    <td>
                                        <table>
                                        <tr>
                                            <td>
                                            <img class="pirenko_cms_image" id="pixia_theme_options_logo_image" src="<?php echo( $options['logo'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="pixia_theme_options_logo" type="hidden" size="1" type="text" name="pixia_theme_options[logo]" value="<?php echo( $options['logo'] ); ?>" />
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_logo" secret_id="<?php echo ($items[0]->ID); ?>">Upload Logo</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                 <?php
                                //RESPONSIVE LOGO
								if (!isset($options['alt_logo']))
									$options['alt_logo']="";
                                ?>
                                <tr valign="top">
                                	<td width="275"><h3><?php _e( 'LOGO IMAGE - SMALL SCREENS', 'pixiatheme' ); ?></h3>
                                    <p><em>Alternative logo for small screens (optional)</em></p>
                                    </td>
                                    
                                    <td>
                                        <table>
                                        <tr>
                                            <td>
                                            <img class="pirenko_cms_image" id="pixia_theme_options_alt_logo_image" src="<?php echo( $options['alt_logo'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="pixia_theme_options_alt_logo" type="hidden" size="1" type="text" name="pixia_theme_options[alt_logo]" value="<?php echo( $options['alt_logo'] ); ?>" />
                                        
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_alt_logo" secret_id="<?php echo ($items[0]->ID); ?>">Upload Alternative Logo</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                 <?php
                                //FAVICON IMAGE
								if (!isset($options['favicon']))
									$options['favicon']="". get_template_directory_uri() . "/images/favicon.ico";
                                ?>
                                <tr valign="top">
                                	<td width="275"><h3><?php _e( 'FAVICON IMAGE', 'pixiatheme' ); ?></h3>
                                    <p><em>Should have the .ico extension</em></p>
                                    </td>
                                    
                                    <td>
                                        <table>
                                        <tr>
                                            <td>
                                            <img class="pirenko_cms_image" id="pixia_theme_options_favicon_image" src="<?php echo( $options['favicon'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="pixia_theme_options_favicon" type="hidden" size="1" type="text" name="pixia_theme_options[favicon]" value="<?php echo( $options['favicon'] ); ?>" />
                                        
                                        <tr>
                                        <td>
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_favicon" secret_id="<?php echo ($items[0]->ID); ?>">Upload Favicon</a>
                                        </td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'BACKGROUND', 'pixiatheme' ); ?></h3></th>
                                <?php
                                //BACKGROUND IMAGE
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Background Image', 'pixiatheme' ); ?></th>
                                    <td>
                                        <table>
                                        <tr>
                                            <td> 
                                            <img class="pirenko_cms_image" id="pixia_theme_options_background_image" src="<?php echo( $options['background_image'] ); ?>" style="float:left"  />
                                            </td>
                                        </tr>
                                        <input id="pixia_theme_options_background" size="1" type="hidden" name="pixia_theme_options[background_image]" value="<?php echo( $options['background_image'] ); ?>" />
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
                                        <?php _e( 'Background Pattern', 'pixiatheme' ); ?>
                                        <p><em>Will be used only if there's no background image</em></p>
                                    </th>
                                    <td>
                                        <select id="pattern_selector" name="pixia_theme_options[pattern]">
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
                                        <div id="background_preview" class="preview_pattern" style="background-image:url(<?php echo get_template_directory_uri();?>/images/patterns/<?php echo $options['pattern']; ?>)">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //BACKGROUND COLOR
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Background Color', 'pixiatheme' ); ?>
                                    <p><em>Will be used only if there's no background image and no background pattern</em></p>
                                </th>
                                    <td>
                                    	<div id="my_picker_0" class="color_selector" data-color="<?php echo $options['site_background_color']; ?>"><div style="background-color:<?php echo $options['site_background_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[site_background_color]" id="site_background_color" type="text" value="<?php echo( $options['site_background_color'] ); ?>" />
                                    </td>
                                </tr>
								<?php
                                //OVERLAY
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Background Overlay Image', 'pixiatheme' ); ?>
                                        <p><em>This image is optional and will be displayed on top of your background image, pattern or color.</em></p>
                                    </th>
                                    <td>
                                        <div id="overlay_selector_div">
                                        <select id="overlay_selector" name="pixia_theme_options[overlay_image]" class="left_float">
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
                                        <div id="overlay_preview" class="<?php if ($options['overlay_image']=="") {echo "hidden_icons";} ?>" style="background: url(<?php echo get_template_directory_uri();?>/images/overlays/<?php echo $options['overlay_image'];?>) repeat scroll 0 0 transparent;background-color: #<?php echo $options['inactive_color'];?>;">
                                            
                                        </div> 
                                 
                                    </td>
                                </tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'BOTTOM SIDEBAR', 'pixiatheme' ); ?></h3></th>
                                <?php
                                //BACKGROUND PATTERN
                                ?>
                                <tr valign="top">
                                    <th scope="row">
                                        <?php _e( 'Background Pattern', 'pixiatheme' ); ?>
                                        <p><em>If blank the value of "Thumbnails and Footer background color" will be used</em></p>
                                    </th>
                                    <td>
                                        <select id="pattern_selector_hf" name="pixia_theme_options[pattern_hf]">
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
                                        <div id="background_preview_hf" class="preview_pattern_hf" style="background-image:url(<?php echo get_template_directory_uri();?>/images/patterns/<?php echo $options['pattern_hf']; ?>)">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                //CUSTOM OPACITY
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Custom Background Opacity - Footer', 'pixiatheme' ); ?>
                                    <p><em></em></p>
                                </th>
                                    <td>
                                        <input id="custom_opacity" size="7" maxlength="6" type="text" name="pixia_theme_options[custom_opacity]" value="<?php echo( $options['custom_opacity'] ); ?>" />
                                        <label class="description" for="pixia_theme_options[custom_opacity]"><?php _e( ' Acceptable values: [0,100]', 'pixiatheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //COLORS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'COLOR SCHEME', 'pixiatheme' ); ?></h3></th>
                                <?php
                                //ACTIVE COLOR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Active color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_1" class="color_selector" data-color="<?php echo $options['active_color']; ?>"><div style="background-color:<?php echo $options['active_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[active_color]" id="active_color" type="text" value="<?php echo( $options['active_color'] ); ?>" />
                                    </td>
                                </tr>
                                 <?php
                                //MENU COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Menu text color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_2" class="color_selector" data-color="<?php echo $options['body_color']; ?>"><div style="background-color:<?php echo $options['body_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[body_color]" id="body_color" type="text" value="<?php echo( $options['body_color'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //BODY COLOR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Body text color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_3" class="color_selector" data-color="<?php echo $options['inactive_color']; ?>"><div style="background-color:<?php echo $options['inactive_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[inactive_color]" id="inactive_color" type="text" value="<?php echo( $options['inactive_color'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //BUTTONS BACKGROUND COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Thumbnails and Footer background color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_5" class="color_selector" data-color="<?php echo $options['background_color_btns']; ?>"><div style="background-color:<?php echo $options['background_color_btns']; ?>"></div></div>
										<input class="" name="pixia_theme_options[background_color_btns]" id="background_color_btns" type="text" value="<?php echo( $options['background_color_btns'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //CONTENT BACKGROUND COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Text modules background color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_4" class="color_selector" data-color="<?php echo $options['background_color']; ?>"><div style="background-color:<?php echo $options['background_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[background_color]" id="background_color" type="text" value="<?php echo( $options['background_color'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //CUSTOM OPACITY
								if (!isset($options['custom_opacity_mdls']))
									$options['custom_opacity_mdls']="100";
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Custom Background Opacity - Text modules', 'pixiatheme' ); ?>
                                    <p><em></em></p>
                                </th>
                                    <td>
                                        <input id="custom_opacity" size="7" maxlength="6" type="text" name="pixia_theme_options[custom_opacity_mdls]" value="<?php echo( $options['custom_opacity_mdls'] ); ?>" />
                                        <label class="description" for="pixia_theme_options[custom_opacity_mdls]"><?php _e( ' Acceptable values: [0,100]', 'pixiatheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //SHADOWS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'SHADOWS', 'pixiatheme' ); ?></h3></th>
                                 <?php
                                //SHADOWS COLOR
                                ?>
                                <tr valign="top"><th scope="row" width="275"><?php _e( 'Shadows color', 'pixiatheme' ); ?></th>
                                    <td>
                                    	<div id="my_picker_6" class="color_selector" data-color="<?php echo $options['shadow_color']; ?>"><div style="background-color:<?php echo $options['shadow_color']; ?>"></div></div>
										<input class="" name="pixia_theme_options[shadow_color]" id="shadow_color" type="text" value="<?php echo( $options['shadow_color'] ); ?>" />
                                    </td>
                                </tr>
                                <?php
                                //SHADOW OPACITY
								if (!isset($options['custom_shadow']))
									$options['custom_shadow']="0";
                                ?>
                                <tr valign="top">
                                <th scope="row">
                                    <?php _e( 'Shadow Opacity', 'pixiatheme' ); ?>
                                    <p><em>Use 0 value for no shadowing effect</em></p>
                                </th>
                                    <td>
                                        <input id="custom_shadow" size="7" maxlength="6" type="text" name="pixia_theme_options[custom_shadow]" value="<?php echo( $options['custom_shadow'] ); ?>" />
                                        <label class="description" for="pixia_theme_options[custom_shadow]"><?php _e( ' Acceptable values: [0,100]', 'pixiatheme' ); ?></label>
                                    </td>
                                </tr>
                                <?php
                                //FONTS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'FONTS', 'pixiatheme' ); ?></h3></th>
                                <?php
                                //HEADINGS FONT
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Headings Font', 'pixiatheme' ); ?></th>
                                    <td>
                                        <select name="pixia_theme_options[header_font]">
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
                                <tr valign="top"><th scope="row"><?php _e( 'Body Font', 'pixiatheme' ); ?></th>
                                    <td>                               
                                        <select name="pixia_theme_options[body_font]">
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
                                //SIDEBARS
                                ?>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'SIDEBARS', 'pixiatheme' ); ?></h3></th>
                                <?php
                                //UNDER MENU SIDEBAR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Display Under Menu Sidebar', 'pixiatheme' ); ?></th>
                                    <td>
                                        <select name="pixia_theme_options[undermenu_sidebar]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['undermenu_sidebar'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                //TOP SIDEBAR
                                ?>
                                <tr valign="top"><th scope="row"><?php _e( 'Display Bottom Sidebar', 'pixiatheme' ); ?></th>
                                    <td>
                                        <select name="pixia_theme_options[bottom_sidebar]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['bottom_sidebar'] == $option['value'] ) // Make default first in list
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
                                        <h3><?php _e( 'FOOTER TEXT', 'pixiatheme' ); ?></h3>
                                        <p><em>HTML supported</em></p>
                                    </td>
                                    <td>
                                        <textarea id="pixia_theme_options[footer_text]" cols="40" rows="3" name="pixia_theme_options[footer_text]"><?php echo esc_textarea( $options['footer_text'] ); ?></textarea>
                                    </td>
                                </tr> 
                                 <?php
                                //GOOGLE TEXT
								if (!isset($options['ganalytics_text']))
									$options['ganalytics_text']="";
                                ?>
                                <tr valign="top">
                                    <td scope="row">
                                        <h3><?php _e( 'GOOGLE ANALYTICS CODE', 'pixiatheme' ); ?></h3>
                                    </td>
                                    <td>
                                    <textarea id="pixia_theme_options[ganalytics_text]" class="pirenko-large-text" cols="50" rows="6" name="pixia_theme_options[ganalytics_text]"><?php echo esc_textarea( $options['ganalytics_text'] ); ?></textarea>
                                    </td>
                                </tr>         
                          	</table>
                           	<p class="save_options">
                           	<input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                           	</p>
                       	</div><!-- GENERAL OPTIONS -->
                        <!--PORTFOLIO PAGE OPTIONS-->
                        <div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Single Page Portfolio Options" . "</h2>"; ?></td></tr>
                                    <?php
									//SLIDESHOW AUTOPLAY
									?>
									<tr valign="top">
										<td width="375"><?php _e( 'Autoplay slideshow?', 'pixiatheme' ); ?></td>
										<td>
											<select name="pixia_theme_options[autoplay_portfolio]">
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
                                        <?php _e( 'Slideshow delay in miliseconds', 'pixiatheme' ); ?>
                                        </th>
                                        <td>
                                            <input id="pixia_theme_options[delay_portfolio]" size="5" type="text" name="pixia_theme_options[delay_portfolio]" value="<?php echo( $options['delay_portfolio'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									 //SHOW DATE ON SINGLE PORTFOLIO POSTS
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show date?', 'pixiatheme' ); ?></th>
										<td>
											<select name="pixia_theme_options[dateby_port]">
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
										<th scope="row" width="275"><?php _e( 'Show portfolio skills?', 'pixiatheme' ); ?></th>
										<td>
											<select name="pixia_theme_options[categoriesby_port]">
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
									 //SHOW RELATED POSTS
									 if (!isset($options['related_port']))
										$options['related_port']='yes';
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show related posts?', 'pixiatheme' ); ?></th>
										<td>
											<select name="pixia_theme_options[related_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
                                    <?php
									//ARCHIVES PAGE TEMPLATE
									if (!isset($options['archives_ptype']))
										$options['archives_ptype']='classic';
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Portfolio skills page template?', 'pixiatheme' ); ?>
										</th>
										
										<td>
											<select name="pixia_theme_options[archives_ptype]">
												<?php    
													foreach ( $archives_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['archives_ptype'] == $option['value'] ) // Make default first in list
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
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                            </p>
                        </div><!-- pixia_tab_options -->
                        <!--NEWS PAGE-->
                        <div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Blog Options" . "</h2>"; ?></td></tr>
                                <?php
								 //SHOW POSTED BY ON NEWS
                                ?>
                                <tr valign="top">
                                	<th scope="row" width="275" style="width:395px"><?php _e( 'Show "Posted by" text on blog?', 'pixiatheme' ); ?></th>
                                    <td>
                                        <select name="pixia_theme_options[postedby_news]">
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
                                	<th scope="row" width="275"><?php _e( 'Show post categories text on blog?', 'pixiatheme' ); ?></th>
                                    <td>
                                        <select name="pixia_theme_options[categoriesby_news]">
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
									 //SHOW RELATED POSTS
									 if (!isset($options['related_blog']))
										$options['related_blog']='no';
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show previous and next posts link?', 'pixiatheme' ); ?></th>
										<td>
											<select name="pixia_theme_options[related_blog]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_blog'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
                                     <?php
									 //SHOW RELATED POSTS - ELASTISLIDE
									 if (!isset($options['related_blog_elast']))
										$options['related_blog_elast']='no';
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Show related posts?', 'pixiatheme' ); ?></th>
										<td>
											<select name="pixia_theme_options[related_blog_elast]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_blog_elast'] == $option['value'] ) // Make default first in list
															echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</td>
									</tr>
                                    <?php
									//ARCHIVES PAGE TEMPLATE
									if (!isset($options['archives_type']))
										$options['archives_type']='classic';
									?>
									<tr valign="top">
										<th scope="row" width="275"><?php _e( 'Blog categories page template?', 'pixiatheme' ); ?>
										</th>
										
										<td>
											<select name="pixia_theme_options[archives_type]">
												<?php    
													foreach ( $archives_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['archives_type'] == $option['value'] ) // Make default first in list
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
                                	<th scope="row" width="275"><?php _e( 'Force images to have the same height?', 'pixiatheme' ); ?><p><em>This feature applies only for the Classic Blog Style</em></p></th>
                                    <td>
                                        <select name="pixia_theme_options[forcesize_news]">
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
                                	<th scope="row" width="275"><?php _e( 'Make thumbs black and white?', 'pixiatheme' ); ?><p><em>This feature requires Timthumb Script (included)</em></p>
                                    </th>
                                    
                                    <td>
                                        <select name="pixia_theme_options[blog_bw]">
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
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                            </p>
                        </div><!-- pixia_tab_options -->
                        <!-- CONTACT PAGE OPTIONS -->
                        <div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Contact Page Options" . "</h2>"; ?></td></tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'GENERAL SETTINGS', 'pixiatheme' ); ?></h3></th>
                                <?php
                                    //EMAIL ADDRESS
                                    ?>
                                    
                                    <tr valign="top">
                                        <th scope="row">
                                            
                                            <?php _e( 'Receiving email', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[email_address]" size="45" maxlength="50" type="text" name="pixia_theme_options[email_address]" value="<?php echo( $options['email_address'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//TITLE FOR TEXT
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Title for left body text', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_title_body]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_title_body]" value="<?php echo( $options['contact-info_title_body'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//TITLE CONTACT INFO
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Title for contact information', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_title]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_title]" value="<?php echo( $options['contact-info_title'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//TITLE FOR EMAIL FORM
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Title for email form', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_title_form]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_title_form]" value="<?php echo( $options['contact-info_title_form'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
                                    //CONTACT INFORMATION
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'CONTACT INFORMATION', 'pixiatheme' ); ?></h3>
                                        </th>
                                       
                                    </tr>
                                     <?php
									//ADDRESS
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Address', 'pixiatheme' ); ?>
										</th>
										 <td>
                                            <textarea id="pixia_theme_options[contact-address]" class="pirenko-large-text" cols="40" rows="3" name="pixia_theme_options[contact-address]"><?php echo esc_textarea( $options['contact-address'] ); ?></textarea>
                                            
                                        </td>
									</tr>
                                    <?php
									//TELEPHONE
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Telephone', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_tel]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_tel]" value="<?php echo( $options['contact-info_tel'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//FAX
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Fax', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_fax]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_fax]" value="<?php echo( $options['contact-info_fax'] ); ?>" />
                                            
                                        </td>
									</tr>
									<?php
									//EMAIL
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Email', 'pixiatheme' ); ?>
										</th>
										 <td><input id="pixia_theme_options[contact-info_email]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact-info_email]" value="<?php echo( $options['contact-info_email'] ); ?>" />
                                            
                                        </td>
									</tr>
                                    <?php
									//END MESSAGE
									?>
									<tr valign="top">
										<th scope="row">
										<?php _e( 'Bottom Message', 'pixiatheme' ); ?>
										</th>
										 <td>
                                         	<textarea id="pixia_theme_options[contact-address_info_msg]" class="pirenko-large-text" cols="40" rows="5" name="pixia_theme_options[contact-address_info_msg]"><?php echo esc_textarea( $options['contact-address_info_msg'] ); ?></textarea>                 
                                        </td>
									</tr>
                                <?php
                                //GOOGLE MAPS CODE
                                ?>
                               	<tr valign="top">
                                    <th scope="row">
                                        <h3><?php _e( 'GOOGLE MAPS HTML CODE', 'pixiatheme' ); ?></h3>
                                        <p><em>To get your custom code visit http://maps.google.com/ and select your location. Click on the hyperlink button and copy/paste the code here</em></p>
                                     </th>
                                     <td>
                                     <input id="pixia_theme_options[google-maps]" size="90%" type="pirenko-text" name="pixia_theme_options[google-maps]" value="<?php echo( $options['google-maps'] ); ?>" />
                                     </td>
                                 </tr>
                                  <?php
                                    //HELP TEXT ON NAME
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'NAME HELP TEXT', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the name input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_name_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_name_text]" value="<?php echo( $options['contact_name_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //HELP TEXT ON EMAIL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'EMAIL HELP TEXT', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the email input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_email_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_email_text]" value="<?php echo( $options['contact_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //HELP TEXT ON SUBJECT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'SUBJECT HELP TEXT', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the subject input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_subject_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_subject_text]" value="<?php echo( $options['contact_subject_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //HELP TEXT ON MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'MESSAGE HELP TEXT', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed inside of the subject input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_message_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_message_text]" value="<?php echo( $options['contact_message_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //SUBMIT BUTTON TEXT
									if (!isset($options['contact_submit']))
										$options['contact_submit']='Send Message';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'SUBMIT BUTTON TEXT', 'pixiatheme' ); ?></h3>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_submit]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_submit]" value="<?php echo( $options['contact_submit'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //ERROR MESSAGE FOR EMPTY TEXTFIELDS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'ERROR MESSAGE FOR EMPTY FIELD', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed when a mandatory input field is empty</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_error_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_error_text]" value="<?php echo( $options['contact_error_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //ERROR MESSAGE FOR INVALID EMAILS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'ERROR MESSAGE FOR INVALID EMAIL', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed when the entered email is invalid</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_error_email_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_error_email_text]" value="<?php echo( $options['contact_error_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //FFEDBACK - WAIT MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'FORM SUBMISSION: WAIT MESSAGE', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed right after the send message button is clicked and only until the email is sent</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_wait_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[contact_wait_text]" value="<?php echo( $options['contact_wait_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //FEEDBACK - EMAIL SENT MESSAGE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'FORM SUBMISSION: OK MESSAGE', 'pixiatheme' ); ?></h3>
                                            <p><em>This text will be displayed after sending the email</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[contact_ok_text]" size="85" maxlength="80" type="text" name="pixia_theme_options[contact_ok_text]" value="<?php echo( $options['contact_ok_text'] ); ?>" />
                                        </td>
                                    </tr>
                            </table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                            </p>
                        </div>
                        <!--404 ERROR PAGE-->
                         <div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " 404 Error Page" . "</h2>"; ?></td></tr>
                                    <?php
                                    //ERROR IMAGE
                                    ?>
                                    <tr valign="top">
                                        <td width="">
                                            <h3><?php _e( '404 ERROR IMAGE', 'pixiatheme' ); ?></h3>
                                            <p><em>Recommended width: 700px</em></p>
                                        </td>
                                        <td>
                                            <table>
                                            <tr>
                                                <td>
                                                <img class="pirenko_cms_image" id="pixia_theme_options_error404_image" src="<?php echo( $options['error404'] ); ?>" style="float:left"  />
                                                </td>
                                            </tr>
                                            <input id="pixia_theme_options_error404" size="30"  name="pixia_theme_options[error404]" type="hidden" value="<?php echo( $options['error404'] ); ?>" />
                                            
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
                                            <h3><?php _e( 'TITLE TEXT', 'pixiatheme' ); ?></h3>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[404_title_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[404_title_text]" value="<?php echo( $options['404_title_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //BODY TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <h3><?php _e( 'BODY TEXT', 'pixiatheme' ); ?></h3>
                                        </th>
                                        <td>
                                            <textarea id="pixia_theme_options[404_body_text]" class="pirenko-large-text" cols="60" rows="10" name="pixia_theme_options[404_body_text]"><?php echo esc_textarea( $options['404_body_text'] ); ?></textarea>
                                            
                                        </td>
                                    </tr>
                            </table>
                        </div><!-- pixia_tab_options -->
                        <!--TRANSLATIONS-->
                        <div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Translations" . "</h2>"; ?></td></tr>
                                <tr valign="top"><th scope="row"><h3><?php _e( 'VARIOUS', 'pixiatheme' ); ?></h3></th>
                                    <?php
                                    //SEARCH TIP TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Responsive Menu tip text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[responsive_tip_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[responsive_tip_text]" value="<?php echo( $options['responsive_tip_text'] ); ?>" />
                                        </td>
                                    </tr>
									<?php
                                    //SEARCH TIP TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Search Tip text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[search_tip_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[search_tip_text]" value="<?php echo( $options['search_tip_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //SEARCH RESULTS PAGE TITLE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Search results page title', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[submit_search_res_title]" size="45" maxlength="50" type="text" name="pixia_theme_options[submit_search_res_title]" value="<?php echo( $options['submit_search_res_title'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //REQUIRED TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Required text', 'pixiatheme' ); ?>
                                            <em>(Used on mandatory fields)</em>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[required_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[required_text]" value="<?php echo( $options['required_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//PORTFOLIO TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'PORTFOLIO', 'pixiatheme' ); ?></h3></th>
                                    <?php
                                    //LAUNCH PROJECT TEXT
									if (!isset($options['launch_text']))
										$options['launch_text']='Launch Project';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Launch project text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[launch_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[launch_text]" value="<?php echo( $options['launch_text'] ); ?>" />
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
                                            <input id="pixia_theme_options[skills_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[skills_text]" value="<?php echo( $options['skills_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //CLIENT TEXT
									if (!isset($options['client_text']))
										$options['client_text']='Client';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Client description text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[client_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[client_text]" value="<?php echo( $options['client_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //RELATED PROJECT TEXT
									if (!isset($options['related_text']))
										$options['related_text']='Related Projects';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Related Projects project text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[related_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[related_text]" value="<?php echo( $options['related_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //PREVIOUS PROJECT TEXT
									if (!isset($options['pprevious_text']))
										$options['pprevious_text']='Previous';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Lower menu Previous Project text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[pprevious_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[pprevious_text]" value="<?php echo( $options['pprevious_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //NEXT PROJECT TEXT
									if (!isset($options['pnext_text']))
										$options['pnext_text']='Next';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Lower menu next Project Project text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[pnext_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[pnext_text]" value="<?php echo( $options['pnext_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //UP ONE LEVEL TEXT
									if (!isset($options['pportfolio_text']))
										$options['pportfolio_text']='To Portfolio';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Lower menu Back to Portfolio text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[pportfolio_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[pportfolio_text]" value="<?php echo( $options['pportfolio_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//BLOG TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'BLOG', 'pixiatheme' ); ?></h3></th>
                                    <?php
                                    //READ MORE TEXT
									if (!isset($options['read_more']))
										$options['read_more']='Read More';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Read more text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[read_more]" size="45" maxlength="50" type="text" name="pixia_theme_options[read_more]" value="<?php echo( $options['read_more'] ); ?>" />
                                        </td>
                                    </tr>
                                    	<?php
                                    //POSTED BY TEXT
									if (!isset($options['posted_by_text']))
										$options['posted_by_text']='Posted by';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Posted by text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[posted_by_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[posted_by_text]" value="<?php echo( $options['posted_by_text'] ); ?>" />
                                        </td>
                                    </tr>
                                     <?php
                                    //RELATED PROJECT TEXT
									if (!isset($options['related_text_blog']))
										$options['related_text_blog']='Related Posts';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Related Posts text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[related_text_blog]" size="45" maxlength="50" type="text" name="pixia_theme_options[related_text_blog]" value="<?php echo( $options['related_text_blog'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//COMMENTS TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'COMMENTS', 'pixiatheme' ); ?></h3></th>
                                    <?php
                                    //COMMENTS - NO RESPONSES
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Zero comments text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_no_response]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_no_response]" value="<?php echo( $options['comments_no_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS - 1 RESPONSE
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'One comment text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_one_response]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_one_response]" value="<?php echo( $options['comments_one_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS - MULTIPLE RESPONSES
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Multiple comments text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_oneplus_response]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_oneplus_response]" value="<?php echo( $options['comments_oneplus_response'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
									//RESPOND TEMPLATE
									?>
									<tr valign="top"><th scope="row"><h3><?php _e( 'RESPOND SECTION', 'pixiatheme' ); ?></h3></th>
                                    <?php
                                    //COMMENTS CLOSED
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Text to display when the comments are closed', 'pixiatheme' ); ?></th>
										<td width="275">
                                            <input id="pixia_theme_options[comments_closed]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_closed]" value="<?php echo( $options['comments_closed'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //NO RESPONSES YET
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Separator between comments number and post title', 'pixiatheme' ); ?>
                                    <p><em>Example: 2 comments <strong>on</strong> "Lorem Ipsum"</em></p>
                                    </th>
                                    
										<td width="275">
                                            <input id="pixia_theme_options[comments_on_separator]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_on_separator]" value="<?php echo( $options['comments_on_separator'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //LEAVE REPLY
									?>
                                    <tr valign="top"><th scope="row"><?php _e( 'Text to ask the user to leave a reply', 'pixiatheme' ); ?></th>
										<td width="275">
                                            <input id="pixia_theme_options[comments_leave_reply]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_leave_reply]" value="<?php echo( $options['comments_leave_reply'] ); ?>" />
                                        </td>
									</tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON AUTHOR
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Name input field text', 'pixiatheme' ); ?>
                                            <p><em>This text will be displayed inside the author input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_author_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_author_text]" value="<?php echo( $options['comments_author_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON EMAIL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Email input field text', 'pixiatheme' ); ?>
                                            <p><em>This text will be displayed inside the email input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_email_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_email_text]" value="<?php echo( $options['comments_email_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON URL
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'URL input field text', 'pixiatheme' ); ?>
                                            <p><em>This text will be displayed inside the URL input textfield</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_url_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_url_text]" value="<?php echo( $options['comments_url_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS HELP TEXT ON COMMENT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Comment input textarea text', 'pixiatheme' ); ?>
                                            <p><em>This text will be displayed inside the comment input textarea</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_comment_text]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_comment_text]" value="<?php echo( $options['comments_comment_text'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //SUBMIT COMMENT BUTTON TEXT
									if (!isset($options['comments_submit']))
										$options['comments_submit']='Submit Comment';
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Submit comment button text', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comments_submit]" size="45" maxlength="50" type="text" name="pixia_theme_options[comments_submit]" value="<?php echo( $options['comments_submit'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS ACCEPTED TEXT
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Comment submitted text', 'pixiatheme' ); ?>
                                            <p><em>This text is displayed after the comment is submitted</em></p>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[comment_ok_message]" size="45" maxlength="50" type="text" name="pixia_theme_options[comment_ok_message]" value="<?php echo( $options['comment_ok_message'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS EMPTY TEXT ERROR ON ALL FIELDS
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Empty text error message', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[empty_text_error]" size="45" maxlength="50" type="text" name="pixia_theme_options[empty_text_error]" value="<?php echo( $options['empty_text_error'] ); ?>" />
                                        </td>
                                    </tr>
                                    <?php
                                    //COMMENTS INVALID EMAIL ERROR
                                    ?>
                                    <tr valign="top">
                                        <th scope="row">
                                            <?php _e( 'Invalid email error message', 'pixiatheme' ); ?>
                                        </th>
                                        <td width="275">
                                            <input id="pixia_theme_options[invalid_email_error]" size="45" maxlength="50" type="text" name="pixia_theme_options[invalid_email_error]" value="<?php echo( $options['invalid_email_error'] ); ?>" />
                                        </td>
                                    </tr>
                            </table>
                        </div><!-- TRANSLATIONS OPTIONS --> 
                        <!-- CUSTOM SCRIPTS -->         
                     	<div class="pixia_tab_options">
                            <table class="form-table">
                                <tr><td colspan="2"><?php echo "<h2>" . $theme_data['Title'] . " Custom Scripts" . "</h2>"; ?></td></tr>
                               <?php
                                //CUSTOM CSS
                                ?>
                                <tr valign="top">
                                    <td scope="row">
                                        <h3><?php _e( 'CUSTOM CSS', 'pixiatheme' ); ?></h3>
                                        <p><em>Place here some of your own CSS code. You should not use <b>&lt;style&gt;</b> tags.</em></p>
                                    </td>
                                    <td>
                                        <textarea id="css_text" class="" rows="" cols="60" name="pixia_theme_options[css_text]" value=""><?php esc_attr_e( $options['css_text'] ); ?></textarea>
                                        
                                    </td>
                                </tr>   
                                <?php
                                //CUSTOM JS
                                ?>
                                <tr valign="top">
                                    <td scope="row">
                                        <h3><?php _e( 'CUSTOM JAVASCRIPT', 'pixiatheme' ); ?></h3>
                                        <p><em>Place here some of your own JAVASCRIPT code.<br />Example: alert ('Hello!');<br /><b>IMPORTANT:</b> For object targeting use 'jQuery' prefix instead of the default '$' notation.<br />Example: alert (jQuery(this));</em></p>
                                    </td>
                                    <td>
                                        <textarea id="js_text" class="" rows="" cols="60" name="pixia_theme_options[js_text]" value=""><?php esc_attr_e( $options['js_text'] ); ?></textarea>
                                        
                                    </td>
                                </tr> 
                            </table>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save All Changes', 'pixiatheme' ); ?>" />
                            </p>
                        </div>
              
				</form>
				<form name="pirenko_reset_form" method="post" action="?page=theme_options&reset_pixia=true">
					<input type="hidden" name="action" value="reset_pixia" />
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
	"no_slider" => array(
	"name" => "no_slider",
	"title" => "Disable slider and show images and videos stacked vertically?",
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
			add_meta_box( 'new-meta-boxes', 'Pixia Custom Post Options', 'display_meta_box', 'post', 'normal', 'high' );
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
					//SKIP FEATURED OPTION
                    if ($helper==0)
                    {
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
					//NO SLIDER OPTION
					if ($helper==1)
                    {
						
						 $data = get_post_meta($post->ID, $key, true);
						if (!isset($data[ $meta_box[ 'name' ] ]))
							$data[$meta_box['name' ]]="0";
						//$data[$meta_box['name' ]]="-57";
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
                    //FEATURED IMAGE
                    if ($helper==2)
                    {
                        $image[0]="";
                        if (has_post_thumbnail( $post->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <?php endif; ?>
                       
                        <div class="form-field form-required">
                            <label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
                            <input type="hidden" id="pixia_<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" disabled="disabled" value="<?php echo $image[0]; ?>" />
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
                            <input type="text" id="pixia_<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
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