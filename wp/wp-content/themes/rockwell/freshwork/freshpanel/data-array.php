<?php
  /*$folder_handle = is_dir(TEMPLATEPATH.'/skins/');

  if($folder_handle) {
    $folder_handle= (scandir(TEMPLATEPATH.'/skins/'));
    $skins_scanned = array();
    foreach( $folder_handle as $value)
      if($value != '.' && $value != '..') array_push($skins_scanned, $value);
  } */
  $skins_scanned = array('army', 'black', 'emo', 'grey', 'party', 'summer', 'white');

  //////////////////////////////////////////////////////////////////////////////
  // VARIABLES
  //////////////////////////////////////////////////////////////////////////////
  $themename = "Rockwell";
  $shortname = "ff";

  $font_family = array(    
                         "DEFAULT","Dorsa", "Abril Fatface", "Passero One", "Prociono", "Antic", "Fanwood Text", "Delius Unicase", "Alike", "Volkhov", "Monoton", "Numans", "Voltaire", "Montez", "Aldrich", "Vidaloka", "Short Stack", "Gentium Book Basic", "Podkova", "Days One", "Questrial", "Comfortaa", "Delius Swash Caps", "Hammersmith One", "Andika", "Coustard", "Alice", "Rationale", "Loved by the King", "Bowlby One", "Love Ya Like A Sister", "Varela Round", "UnifrakturCook", "IM Fell French Canon", "Smythe", "Rochester", "Abel", "Cedarville Cursive", "Six Caps", "Michroma", "Playfair Display", "Allerta", "Gloria Hallelujah", "Stardos Stencil", "Rokkitt", "Redressed", "Sue Ellen Francisco", "Istok Web", "Shanti", "Lora", "Nixie One", "IM Fell DW Pica", "Carme", "Kameron", "Black Ops One", "Architects Daughter", "Limelight", "Actor", "Anonymous Pro", "Cuprum", "PT Serif", "Coda", "Patrick Hand", "Open Sans Condensed", "Nothing You Could Do", "Oswald", "Ultra", "Buda", "Amaranth", "Yellowtail", "Open Sans", "Mako", "Nunito", "Play", "Merriweather", "Quattrocento Sans", "Carter One", "News Cycle", "Vibur", "Cabin", "Maiden Orange", "Puritan", "Sigmar One", "Muli", "Didact Gothic", "Corben", "Syncopate", "Old Standard TT", "Lato", "UnifrakturMaguntia", "OFL Sorts Mill Goudy TT", "IM Fell Great Primer SC", "Over the Rainbow", "EB Garamond", "Anton", "IM Fell Great Primer", "Ubuntu", "PT Sans Narrow", "Give You Glory", "Cantarell", "Walter Turncoat", "Chewy", "Luckiest Guy", "PT Serif Caption", "PT Sans", "Droid Serif", "Orbitron", "Jura", "IM Fell Double Pica SC", "Neucha", "Tangerine", "PT Sans Caption", "Reenie Beanie", "Allan", "Copse", "Josefin Slab", "Lobster Two", "Francois One", "Permanent Marker", "Droid Sans", "Josefin Sans", "Cherry Cream Soda", "Crushed", "IM Fell DW Pica SC", "League Script", "Artifika", "Cousine", "Shadows Into Light", "VT323", "Cardo", "Metrophobic", "Zeyada", "Gruppo", "Arimo", "Just Another Hand", "Radley", "Expletus Sans", "Coming Soon", "Philosopher", "Calligraffitti", "IM Fell French Canon SC", "Droid Sans Mono", "Kristi", "Molengo", "Kranky", "Terminal Dosis Light", "Bentham", "Inconsolata", "Geo", "Rock Salt", "Raleway", "Swanky and Moo Moo", "Tenor Sans", "Cabin Sketch", "Aclonica", "Homemade Apple", "Goudy Bookletter 1911", "Fontdiner Swanky", "Wire One", "IM Fell English SC", "Miltonian Tattoo", "Neuton", "Slackey", "Unkempt", "Indie Flower", "Dawning of a New Day", "Schoolbell", "Nobile", "MedievalSharp", "Crimson Text", "Judson", "Snippet", "Coda Caption", "Pacifico", "Vollkorn", "Lekton", "Astloch", "Nova Round", "Brawler", "Crafty Girls", "Lobster", "IM Fell Double Pica", "Covered By Your Grace", "Meddon", "Modern Antiqua", "Holtwood One SC", "Nova Flat", "Paytone One", "Mountains of Christmas", "Federo", "Tienne", "Irish Grover", "Maven Pro", "Tinos", "Quattrocento", "Caudex", "Nova Slim", "Damion", "Kenia", "Yanone Kaffeesatz", "Allerta Stencil", "Dancing Script", "Arvo", "IM Fell English", "Sniglet", "Leckerli One", "La Belle Aurore", "Rosario", "Nova Oval", "Gentium Basic", "Kreon", "Miltonian", "Yeseva One", "Pompiere", "Nova Cut", "Bigshot One", "Varela", "Ruslan Display", "Waiting for the Sunrise", "Wallpoet", "Megrim", "Annie Use Your Telescope", "Forum", "Bangers", "Nova Script", "Candal", "The Girl Next Door", "Delius", "Sunshiney", "Just Me Again Down Here", "Nova Square", "Kelly Slab", "Monofett", "Unna", "Goblin One", "Nova Mono", "Bevan"
);

  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL SETTINGS
  //////////////////////////////////////////////////////////////////////////////
$options = array (

///////////////////////////////////////////////////////////////////////////////
// GENERAL OPTIONS
///////////////////////////////////////////////////////////////////////////////
array( "name" => "General",
"type" => "navigation", "icon" => "general"),

//-----------------------------------------------------------------------------
// HEADER OPTION
//-----------------------------------------------------------------------------
    array( "name" => "Header",
    "type" => "tab"),

    array( "name" => "Adjust your header options",
    "type" => "info"),

        array( "name" => "Contact info",
          "desc" => "Please note that this contact info is NOT implemented in all header templates",
          "id" => $shortname."_header3_contact",
          "type" => "text",
          "std" => "phone: +420 776 223 443 <br />e-mail: support@rockwell.co.uk"),

        array( "name" => "Logo Image URL",
        "desc" => "Insert your own logo image URL e.g., http://www.mysite.com/logo.png. Leave blank if you want to use the standard logo which is located in skin folders.",
        "id" => $shortname."_header_logo",
        "type" => "text",
        "std" => '' ),
        
        array( "name" => "Header",
               "desc" => "Select your Header template",
               "id" => $shortname."_template_header",
               "type" => "select",
               "options" => array("header-1", "header-2", "header-3"),
               "std" => "header-1"),

        array( "name" => "Top Menu Width",
        "desc" => "If you think the default Top Menu's width is too small, please insert a higher width number here. Please note that this option may NOT work with some menus - try it and see.",
        "id" => $shortname."_header_top_menu_width",
        "type" => "text",
        "std" => '100' ),


        array( "name" => "Sub Menu Width",
        "desc" => "If you think the default Sub Menu's width is too small, please insert a higher width number here. Please note that this option may NOT work with some menus - try it and see.",
        "id" => $shortname."_header_sub_menu_width",
        "type" => "text",
        "std" => '100' ),


    array(  "type" => "tab-close"),

    array( "name" => "Footer",
    "type" => "tab"),

    array( "name" => "Customize your Footer Settings",
    "type" => "info"),

              array( "name" => "Footer Widget Areas Count",
              "desc" => "How many Widget Areas do you want int footer ?",
              "id" => $shortname."_footer_widget_count",
              "type" => "text",
              "std" => "4"),

              array( "name" => "Footer Text",
              "desc" => "Text at the bottom of the page",
              "id" => $shortname."_footer_b_text",
              "type" => "text",
              "std" => "&copy; 2010 Rockwell - Business and Portfolio Wordpress Theme by freshface"),

               array( "name" => "Footer A",
              "desc" => "Enable / Disable Footer A.",
              "id" => $shortname."_template_footer_a",
              "type" => "checkbox",
              "std" => "true"),

             array( "name" => "Footer B",
              "desc" => "Enable / Disable Footer B.",
              "id" => $shortname."_template_footer_b",
              "type" => "checkbox",
              "std" => "true"),
              
        array( "name" => "Footer A",
               "desc" => "Select your Footer A template",
               "id" => $shortname."_template_footer_a_type",
               "type" => "select",
               "options" => array("footer-a-1"),
               "std" => "footer-a-1"),

        array( "name" => "Footer B",
               "desc" => "Select your Footer B template",
               "id" => $shortname."_template_footer_b_type",
               "type" => "select",
               "options" => array("footer-b-1"),
               "std" => "footer-b-1"),

    array(  "type" => "tab-close"),
    
		array( "name" => "Panel",
            "type" => "tab"),


       array( "name" => "General settings for FreshPanel. Adjust to your liking.",
              "type" => "info"),


       array( "name" => "Header Links",
              "desc" => "Enable / Disable links in FreshPanel's header.",
              "id" => $shortname."_fr_links",
              "type" => "checkbox",
              "std" => "true"),


     array(  "type" => "tab-close"),
      array( "name" => "Reset",
            "type" => "tab"),


       array( "name" => "If you want to reset FreshPanel to default values, please hit the red button below.",
              "type" => "info"),


       array( "name" => "Reset",

              "type" => "reset",
              "std" => "true"),


     array(  "type" => "tab-close"),
    
  array( "type" => "navigation-close"),

array( "name" => "Home Page",
"type" => "navigation", "icon" => "homepage"),
//-----------------------------------------------------------------------------
// HOME OPTIONS
//-----------------------------------------------------------------------------
    array( "name" => "General",
    "type" => "tab"),

    array( "name" => "Customize your home page",
    "type" => "info"),
    
        array( "name" => "Enable Intro Message ",
        "desc" => "Enable / Disable Intro Message right below the slider",
        "id" => $shortname."_message_enable",
        "type" => "checkbox",
        "std" => "true"),

        array( "name" => "Intro Message Text",
        "desc" => "Text which appears in Intro Message (right below the slider). You can insert any HTML code here.",
        "id" => $shortname."_message_text",
        "type" => "text",
        "std" => "Hello, my name is <a href='#'>Willy Rocks</a> and you can always <a href='#'>Contact me</a> in case you need to scratchbuild <a href='#'>something</a> extraordinary for your world"),

        array( "name" => "Enable Widget Area ",
        "desc" => "Enable / Disable Widget Area right below the Intro Message",
        "id" => $shortname."_home_widget_enable",
        "type" => "checkbox",
        "std" => "true"),

        array( "name" => "Number of Home Widget Areas",
        "desc" => "How many widget areas do you want on your home page ? ",
        "id" => $shortname."_home_widget_count",
        "type" => "text",
        "std" => "4"),
        
        array( "name" => "Enable Category Area ",
        "desc" => "Enable / Disable Category Area right below the Widget Area. This way you can have blog or portfolio or any other category you want on your Homepage. Once enabled, please select your desired Homepage template in \"Category Manager\".",
        "id" => $shortname."_home_blog_enable",
        "type" => "checkbox",
        "std" => "false"),

    array(  "type" => "tab-close"),

//-----------------------------------------------------------------------------
// SLIDER OPTION
//-----------------------------------------------------------------------------
    array( "name" => "Slider",
    "type" => "tab"),

    array( "name" => "Adjust your slider settings",
    "type" => "info"),

        array( "name" => "Show Slider",
              "desc" => "Enable / Disable Slider",
              "id" => $shortname."_slider2_show",
              "type" => "checkbox",
              "std" => "true"),

        array( "name" => "Slider",
               "desc" => "Select your slider type",
               "id" => $shortname."_template_slider_type",
               "type" => "select",
               "options" => array("slider-1", "slider-2", "slider-3"),
               "std" => "slider-1"),

            array( "name" => "Title",
              "desc" => "Enable / Disable title",
              "id" => $shortname."_slider2_title",
              "type" => "checkbox",
              "std" => "true"),
              
         array( "name" => "Left Arrow",
              "desc" => "Enable / Disable Left Arrow",
              "id" => $shortname."_slider2_left",
              "type" => "checkbox",
              "std" => "true"),

        array( "name" => "Right Arrow",
              "desc" => "Enable / Disable Right Arrow",
              "id" => $shortname."_slider2_right",
              "type" => "checkbox",
              "std" => "true"),
              
        array( "name" => "Grid",
              "desc" => "Enable / Disable grid",
              "id" => $shortname."_slider2_grid",
              "type" => "checkbox",
              "std" => "true"),

        array( "name" => "Autoslide Time (ms)",
              "desc" => "If you want to completely disable the autosliding, please insert this: 0",
              "id" => $shortname."_slider_autoslide",
              "type" => "text",
              "std" => "4000"),

    array(  "type" => "tab-close"),


//-----------------------------------------------------------------------------
// Contact OPTION
//-----------------------------------------------------------------------------




array( "type" => "navigation-close"),


array( "name" => "Skins",
"type" => "navigation", "icon" => "skins"),

array( "name" => "Color Skin",
    "type" => "tab"),

        array( "name" => "Change the color skin and their corresponding stencils. All the skins data are located in /skins/ folder, easy to customize",
        "type" => "info"),

        array( "name" => "Template Skin",
               "desc" => "Select your template skin",
               "id" => $shortname."_template_skin",
               "type" => "select",
               "options" => $skins_scanned,
              "std" => "black"),
array(  "type" => "tab-close"),


 array( "name" => "Stencils",
    "type" => "tab"),
  array( "name" => "Change the color skin and their corresponding stencils. All the skins data are located in /skins/ folder, easy to customize",
        "type" => "info"),
      array( "name" => "Fixed Stencil Position?",
            "desc" => "Stencil position will be fixed",
            "id" => $shortname."_stencil_fixed",
            "type" => "checkbox",
            "std" => "false"),

        array( "name" => "Stencil Black",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_black",
               "type" => "select",
               "options" => array("turntable","skate","clothing","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil Summer",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_summer",
               "type" => "select",
               "options" => array("surfer","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil Emo",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_emo",
               "type" => "select",
               "options" => array("skulls","clothing","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil Grey",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_grey",
               "type" => "select",
               "options" => array("grid","london","cross_s", "bolt","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil White",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_white",
               "type" => "select",
               "options" => array("turntable","skate","clothing","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil Party",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_party",
               "type" => "select",
               "options" => array("disco","skate","turntable","clothing","DEFAULT"),
              "std" => "DEFAULT"),

        array( "name" => "Stencil Army",
               "desc" => "Select stencil for your skin",
               "id" => $shortname."_stencil_army",
               "type" => "select",
               "options" => array("camouflage","DEFAULT"),
              "std" => "DEFAULT"),

    array(  "type" => "tab-close"),
    
array( "name" => "Lightbox",
    "type" => "tab"),
  array( "name" => "Change the color skin and their corresponding stencils. All the skins data are located in /skins/ folder, easy to customize",
        "type" => "info"),
        array( "name" => "Lightbox Skin",
               "desc" => "Select your template skin",
               "id" => $shortname."_template_lightbox",
               "type" => "select",
               "options" => array("light_rounded","dark_rounded","light_square","dark_square","facebook"),
              "std" => "dark_rounded"),
array(  "type" => "tab-close"),
array( "type" => "navigation-close"),
////////////////////////////////////////////////////////////////////////////////
// Translation
////////////////////////////////////////////////////////////////////////////////
array( "name" => "Typography",
"type" => "navigation", "icon" => "typography"),

 array( "name" => "Google Fonts",
    "type" => "tab"),
        array( "name" => "Set up the GoogleFonts",
        "type" => "info"),

      array( "name" => "Enable Google fonts",
            "desc" => "Enable / Disable Left Arrow",
            "id" => $shortname."_font_enable",
            "type" => "checkbox",
            "std" => "false"),

        array( "name" => "Body",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_body",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Navigation",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_navigation",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Navigation submenu",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_navigation_submenu",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Info Line",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_info_line",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Message",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_message",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Home Widget H2",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_home_widget_h2",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Footer Widget H2",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_footer_widget_h2",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Sidebar & Post MetaH2",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_sidebar_post_meta_h2",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Sidebar",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_sidebar",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Category Title",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_cat_title",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H1",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h1",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H2",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h2",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H3",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h3",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H4",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h4",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H5",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h5",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H6",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h6",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "H7",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_h7",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Post Info",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_post_info",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Post Info Single",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_post_info_single",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Blockquote",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_blockquote",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Comment Author",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_comment_author",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Comment Date",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_comment_date",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Submit Button",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_submit",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Input",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_input",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Labels",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_label",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Pagination",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_pagination",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Footer 1",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_footer1",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

        array( "name" => "Footer 2",
        "desc" => "Choose your Google font",
        "id" => $shortname."_font_footer2",
        "type" => "select",
        "options" => $font_family,
        "std" =>"DEFAULT"),

    array(  "type" => "tab-close"),
array( "type" => "navigation-close"),

array( "name" => "Contact Form",
"type" => "navigation", "icon" => "contactform"),
    
    array( "name" => "General",
    "type" => "tab"),
        array( "name" => "Adjust your contact form settings",
        "type" => "info"),

        array( "name" => "Your email",
        "desc" => "Your email, where do you want to receive contact form message",
        "id" => $shortname."_contact_youremail",
        "type" => "text",
        "std" => "your@email.com"),
        
        array( "name" => "Subject",
        "desc" => "Subject in your email message",
        "id" => $shortname."_contact_subject",
        "type" => "text",
        "std" => "Rockwell Contact Form"),
        
    array(  "type" => "tab-close"),
    
    
    array( "name" => "ReCaptcha",
    "type" => "tab"),
        array( "name" => "Adjust your ReCaptcha settings",
        "type" => "info"),
        
	       array( "name" => "Enable ReCaptcha",
	      "desc" => "Enable / Disable ReCaptcha.",
	      "id" => $shortname."_contact_recaptcha_on",
	      "type" => "checkbox",
	      "std" => "true"),        

        array( "name" => "Your PublicKey",
        "desc" => "Insert your public ReCaptcha key",
        "id" => $shortname."_contact_recaptcha_publickey",
        "type" => "text",
        "std" => ""),
        
        array( "name" => "Your PrivateKey",
        "desc" => "Insert your private ReCaptcha key",
        "id" => $shortname."_contact_recaptcha_privatekey",
        "type" => "text",
        "std" => ""),
       
        
    array(  "type" => "tab-close"),
    
    
array( "type" => "navigation-close"),

array( "name" => "Translate",
"type" => "navigation", "icon" => "translate"),

    ////////////////////////////////////////////////////////////////////////////
    //-- Blogpost meta
    ////////////////////////////////////////////////////////////////////////////
    array( "name" => "Post Meta",
    "type" => "tab"),

    array( "name" => "Translate post meta (author, admin, etc.)",
    "type" => "info"),

    array( "name" => "Post Info Heading",
    "desc" => "Heading at single post",
    "id" => $shortname."_translate_postinfo",
    "type" => "text",
    "std" => "Post Info"),

    array( "name" => "Read more",
    "desc" => "Read more button",
    "id" => $shortname."_translate_readmore",
    "type" => "text",
    "std" => "Read more"),

    array( "name" => "Written by",
    "desc" => "Written by (author)",
    "id" => $shortname."_blogpost_meta_written",
    "type" => "text",
    "std" => "Written by"),

    array( "name" => "Posted in",
    "desc" => "Posted in (categories)",
    "id" => $shortname."_blogpost_meta_postedin",
    "type" => "text",
    "std" => "Posted in"),

    array( "name" => "Tags",
    "desc" => "Tags (tags)",
    "id" => $shortname."_blogpost_meta_tags",
    "type" => "text",
    "std" => "Tags"),

    array( "name" => "Date Format",
    "desc" => "Date Format",
    "id" => $shortname."_translate_date",
    "type" => "text",
    "std" => "F j, Y"),


    array(  "type" => "tab-close"),


    array( "name" => "Comments",
    "type" => "tab"),

    array( "name" => "Translate your comment data",
    "type" => "info"),

    array( "name" => "No comments",
    "desc" => "This message appear when no comment has been posted yet",
    "id" => $shortname."_com2_no",
    "type" => "text",
    "std" => "No comments"),

    array( "name" => "1 comment",
    "desc" => "Exactly 1 comment has been posted",
    "id" => $shortname."_com2_1",
    "type" => "text",
    "std" => "1 comment"),


    array( "name" => "More comments",
    "desc" => "More than 1 comments. The % char will be changed into number of comments.",
    "id" => $shortname."_com2_more",
    "type" => "text",
    "std" => "% comments"),

    array( "name" => "Submit button",
    "desc" => "Submit comment button",
    "id" => $shortname."_com2_send",
    "type" => "text",
    "std" => "Submit Comment"),

    array( "name" => "Post a Reply text",
    "desc" => "Located next to comment form",
    "id" => $shortname."_com2_postreply",
    "type" => "text",
    "std" => "Post a Reply"),

    array( "name" => "Comment is waiting for approval",
    "desc" => "This message will see only the original author of the comment",
    "id" => $shortname."_com2_approval",
    "type" => "text",
    "std" => "Comment waiting for approval"),


    array(  "type" => "tab-close"),

    ////////////////////////////////////////////////////////////////////////////
    //-- Archive
    ////////////////////////////////////////////////////////////////////////////
    array( "name" => "Archives",
    "type" => "tab"),

    array( "name" => "Text in archive template's located at the top of the page (category description)",
    "type" => "info"),

    array( "name" => "Archives",
    "desc" => "Category description in archive template",
    "id" => $shortname."_trans_archive",
    "type" => "text",
    "std" => "Archives"),

    array( "name" => "Author",
    "desc" => "Category description in author template",
    "id" => $shortname."_trans_author",
    "type" => "text",
    "std" => "Author"),

    array( "name" => "Search",
    "desc" => "Category description in search template",
    "id" => $shortname."_trans_search",
    "type" => "text",
    "std" => "Search"),

    array(  "type" => "tab-close"),




         array( "name" => "Contact",
    "type" => "tab"),
        array( "name" => "Translate your contact form text",
        "type" => "info"),



        array( "name" => "Name*",
        "desc" => "Name (this field is required)",
        "id" => $shortname."_contact_name",
        "type" => "text",
        "std" => "Name*"),

        array( "name" => "Email*",
        "desc" => "Email (this field is required)",
        "id" => $shortname."_contact_email",
        "type" => "text",
        "std" => "Email*"),

        array( "name" => "Website",
        "desc" => "Website",
        "id" => $shortname."_contact_website",
        "type" => "text",
        "std" => "Website"),

        array( "name" => "Send Button",
        "desc" => "Send Button",
        "id" => $shortname."_contact_send",
        "type" => "text",
        "std" => "Send e-mail"),

        array( "name" => "Descripton",
        "desc" => "Contact Form description",
        "id" => $shortname."_contact_desc",
        "type" => "text",
        "std" => "Contact us"),



        array( "name" => "Sent ok",
        "desc" => "What will user see when the message was sent succesful",
        "id" => $shortname."_contact_ok",
        "type" => "text",
        "std" => "Your e-mail has been sent successfully."),

        array( "name" => "Sent Wrong",
        "desc" => "What will user see when the message failed",
        "id" => $shortname."_contact_bad",
        "type" => "text",
        "std" => "Something bad happened, please try again later."),
        
        array( "name" => "ReCaptcha filled Bad",
        "desc" => "This message appear when user fill recaptcha wrong",
        "id" => $shortname."_contact_recaptcha_message",
        "type" => "text",
        "std" => "Please fill captcha correctly"),

    array(  "type" => "tab-close"),
    
    array( "name" => "404",
    "type" => "tab"),
        array( "name" => "Translate your 404 page text. For disabling custom 404 page, please delete 404.php file",
        "type" => "info"),

        array( "name" => "Title",
        "desc" => "Title of your custom 404 page",
        "id" => $shortname."_404_title",
        "type" => "text",
        "std" => "404 Error"),

        array( "name" => "Content",
        "desc" => "Content of your 404 page",
        "id" => $shortname."_404_content",
        "type" => "text",
        "std" => "This page does not exist"),



    array(  "type" => "tab-close"),
    
    array( "name" => "Slider",
        "type" => "tab"),
        array( "name" => "Translate your slider text",
        "type" => "info"),

        array( "name" => "Read More in slider 3",
        "desc" => "Read More in slider 3",
        "id" => $shortname."_translate_slider_readmore",
        "type" => "text",
        "std" => "read more"),


        array(  "type" => "tab-close"),
array( "type" => "navigation-close"),



array( "name" => "Custom Code",
"type" => "navigation", "icon" => "customcode"),


    array( "name" => "CSS",
    "type" => "tab"),
        array( "name" => "Write custom CSS here",
        "type" => "info"),
        array( "name" => "CSS",
        "desc" => "Enter your custom css",
        "id" => $shortname."_css",
        "type" => "textarea",
        "std" =>""),

    array(  "type" => "tab-close"),
    
array( "type" => "navigation-close"),

array( "name" => "Tracking Code",
"type" => "navigation", "icon" => "tracking"),


    array( "name" => "Tracking Code",
    "type" => "tab"),
        array( "name" => "Write custom tracking code here",
        "type" => "info"),
        array( "name" => "Tracking Code",
        "desc" => "Enter your custom tracking code here",
        "id" => $shortname."_tracking",
        "type" => "textarea",
        "std" =>""),

    array(  "type" => "tab-close"),

array( "type" => "navigation-close"),
);
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" && get_option('ff_theme_was_activated') !="true") {
    add_option('ff_theme_was_activated', 'true');
    update_option('ff_theme_was_activated', 'true');
    foreach ($options as $one_option)
    {
        if($one_option['id'] != '') update_option( $one_option['id'], htmlspecialchars_decode ($one_option['std']) );
    }
}
?>