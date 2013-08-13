<?php
class fOpt {
    private static $db_name = null;
    private static $options = Array();
    public static function init() {
        global $wpdb;
        self::$db_name = $wpdb->prefix . 'fresh_options';
        self::load_all();
    }
    
    public static function get_option( $name ) {
        return stripslashes( self::$options[ $name ] );
    }

    public static function set_option ( $name, $value ) {
        $value_norm = addslashes( $value );

        // does option exists?
        if( self::$options[ $name ] != '' ) {
            $sql = "UPDATE " . self::$db_name . " SET value = '" . $value_norm . "' WHERE name = '" . $name . "'";

        }
        else {
            $sql = "INSERT INTO " . self::$db_name . " (name, value) VALUES ('$name','$value_norm')";
        }
        mysql_query( $sql );
    }
    
    public static function del_option ( $name ) {
        $sql = "DELETE FROM " . self::$db_name . " WHERE name = '$name'";
        mysql_query( $sql );
        self::$options[ $name ] = null;
    }
    
    private static function load_all() {
         $sql = "SELECT * FROM " . self::$db_name;
         $result = mysql_query( $sql );
         while ( $row = mysql_fetch_array( $result ) ) {
            self::$options[ $row['name'] ] = $row['value'];
         }
    }
}
fOpt::init();

$cat_list = Array (
    'index' => array( 0, 'index' ),
    'archives' => array( 0, 'archives' ),
    'search' => array( 0, 'search' ),
);

function create_cat_list ($child_of, $depth)
{
    global $cat_list;

    $cats = get_categories('hide_empty=0&parent='.$child_of);
    foreach ($cats as $one_cat)
    {
       // var_dump ($one_cat);
        $cat_list[ $one_cat->cat_ID ][0] = $depth;
        $cat_list[ $one_cat->cat_ID ][1] = $one_cat->name;

        create_cat_list($one_cat->cat_ID, $depth + 1);
    }
}
create_cat_list (0,0);

////////////////////////////////////////////////////////////////////////////////
// DB INIT
////////////////////////////////////////////////////////////////////////////////
/*
$db_table_name =  $wpdb->prefix.'fresh_options';
$sql = 'CREATE TABLE IF NOT EXISTS '.$db_prefix.$db_table_name.' (
        name    VARCHAR(50),
        value   VARCHAR(200)
        )';
echo mysql_query('INSERT INTO '.$db_prefix.$db_table_name. ' (name, value) VALUES ("xxx","yyy") ');

function get_freshoption( $name ) {
    global $db_table_name =
}
function set_freshoption( $name, $value ) {

}        */
////////////////////////////////////////////////////////////////////////////////
// CATEGORY OPTIONS
////////////////////////////////////////////////////////////////////////////////
$category_blog_templates = array(
    "left" => array(
        array("name" =>"blog-cat-12",
        "img"=>"blog12.jpg"),
        array("name" =>"blog-cat-13",
        "img"=>"blog13.jpg"),
        array("name" =>"blog-cat-14",
        "img"=>"blog14.jpg"),
        array("name" =>"blog-cat-15",
        "img"=>"blog15.jpg"),
        array("name" =>"blog-cat-16",
        "img"=>"blog16.jpg"),
        array("name" =>"blog-cat-17",
        "img"=>"blog17.jpg"),
        array("name" =>"blog-cat-18",
        "img"=>"blog18.jpg"),
        array("name" =>"blog-cat-21",
        "img"=>"blog21.jpg"),
        array("name" =>"blog-cat-22",
        "img"=>"blog21.jpg"),
    ),
    "fullwidth" => array(
        array("name" =>"blog-cat-8",
        "img"=>"blog8.jpg"),
        array("name" =>"blog-cat-9",
        "img"=>"blog9.jpg"),
        array("name" =>"blog-cat-10",
        "img"=>"blog10.jpg"),
        array("name" =>"blog-cat-11",
        "img"=>"blog11.jpg"),

        array("name" =>"blog-cat-23",
        "img"=>"blog23.jpg"),
        array("name" =>"blog-cat-24",
        "img"=>"blog24.jpg"),
        array("name" =>"blog-cat-25",
        "img"=>"blog25.jpg"),
        array("name" =>"blog-cat-26",
        "img"=>"blog26.jpg"),
        array("name" =>"blog-cat-27",
        "img"=>"blog27.jpg"),
        array("name" =>"blog-cat-28",
        "img"=>"blog28.jpg"),
        array("name" =>"blog-cat-29",
        "img"=>"blog29.jpg"),

    ),
    "right" => array(
        array("name" =>"blog-cat-1",
        "img"=>"blog1.jpg"),
        array("name" =>"blog-cat-2",
        "img"=>"blog2.jpg"),
        array("name" =>"blog-cat-3",
        "img"=>"blog3.jpg"),
        array("name" =>"blog-cat-4",
        "img"=>"blog4.jpg"),
        array("name" =>"blog-cat-5",
        "img"=>"blog5.jpg"),
        array("name" =>"blog-cat-6",
        "img"=>"blog6.jpg"),
        array("name" =>"blog-cat-7",
        "img"=>"blog7.jpg"),
        array("name" =>"blog-cat-19",
        "img"=>"blog19.jpg"),
        array("name" =>"blog-cat-20",
        "img"=>"blog20.jpg"),
    )
);
$category_portfolio_templates = array(
    "left" => array(
        array("name" =>"portfolio-cat-1",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-2",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-3",
        "img"=>"img_source_path")
    ),
    "fullwidth" => array(
        array("name" =>"portfolio-cat-1",
        "img"=>"port1.jpg"),
        array("name" =>"portfolio-cat-2",
        "img"=>"port2.jpg"),
        array("name" =>"portfolio-cat-3",
        "img"=>"port3.jpg"),
        array("name" =>"portfolio-cat-4",
        "img"=>"port4.jpg"),
        array("name" =>"portfolio-cat-5",
        "img"=>"port5.jpg"),
        array("name" =>"portfolio-cat-6",
        "img"=>"port6.jpg"),
        array("name" =>"portfolio-cat-7",
        "img"=>"port7.jpg"),
        array("name" =>"portfolio-cat-8",
        "img"=>"port8.jpg"),
        array("name" =>"portfolio-cat-9",
        "img"=>"port9.jpg"),
        array("name" =>"portfolio-cat-10",
        "img"=>"port10.jpg"),
        array("name" =>"portfolio-cat-11",
        "img"=>"port11.jpg"),
        array("name" =>"portfolio-cat-12",
        "img"=>"port12.jpg"),
        array("name" =>"portfolio-cat-13",
        "img"=>"port13.jpg"),
        array("name" =>"portfolio-cat-14",
        "img"=>"port14.jpg"),

    ),
    "right" => array(
        array("name" =>"portfolio-cat-7",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-8",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-9",
        "img"=>"img_source_path")
    )
);
      // Author Date Category Tags Comments Clickable title Open image in lightbox
$category_additional_options = array(
    array("name" => "Display Date",
    "id"=>"cat_display_date",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Author",
    "id"=>"cat_display_author",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Category",
    "id"=>"cat_display_category",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Tags",
    "id"=>"cat_display_tags",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Comments",
    "id"=>"cat_display_comments",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Title",
    "id"=>"cat_display_display_title",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Clickable Title",
    "id"=>"cat_display_clickable_title",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Open Image in Lightbox",
    "id"=>"cat_display_lightbox",
    "type"=>"checkbox",
    "default"=>"false"),

    array("name" => "Posts per Page",
    "id"=>"cat_ppp",
    "type"=>"text",
    "default"=>"0"),

    array("name" => "Fixed Image Height",
    "id"=>"cat_fixed_height",
    "type"=>"text",
    "default"=>"0"),

);
////////////////////////////////////////////////////////////////////////////////
// SINGLE OPTIONS
////////////////////////////////////////////////////////////////////////////////
$single_blog_templates = array(
    "left" => array(
        array("name" =>"blog-single-4",
        "img"=>"sing4.jpg"),

        array("name" =>"blog-single-5",
        "img"=>"sing5.jpg"),
        array("name" =>"blog-single-6",
        "img"=>"sing6.jpg"),
        array("name" =>"blog-single-7",
        "img"=>"sing7.jpg"),
        array("name" =>"blog-single-8",
        "img"=>"sing8.jpg"),
        array("name" =>"blog-single-9",
        "img"=>"sing9.jpg"),
        array("name" =>"blog-single-10",
        "img"=>"sing10.jpg"),

        array("name" =>"blog-single-20",
        "img"=>"sing20.jpg"),

    ),
    "fullwidth" => array(
        array("name" =>"blog-single-16",
        "img"=>"sing16.jpg"),
        array("name" =>"blog-single-17",
        "img"=>"sing17.jpg"),
        array("name" =>"blog-single-18",
        "img"=>"sing18.jpg"),
        array("name" =>"blog-single-19",
        "img"=>"sing19.jpg"),
    ),
    "right" => array(
        array("name" =>"blog-single-1",
        "img"=>"sing1.jpg"),
        array("name" =>"blog-single-2",
        "img"=>"sing2.jpg"),
        array("name" =>"blog-single-3",
        "img"=>"sing3.jpg"),
        array("name" =>"blog-single-11",
        "img"=>"sing11.jpg"),
        array("name" =>"blog-single-12",
        "img"=>"sing12.jpg"),
        array("name" =>"blog-single-13",
        "img"=>"sing13.jpg"),
        array("name" =>"blog-single-14",
        "img"=>"sing14.jpg"),
        array("name" =>"blog-single-15",
        "img"=>"sing15.jpg"),
    )
);
$single_portfolio_templates = array(
    "left" => array(
        array("name" =>"portfolio-cat-1",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-2",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-3",
        "img"=>"img_source_path")
    ),
    "fullwidth" => array(
        array("name" =>"portfolio-cat-4",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-5",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-6",
        "img"=>"img_source_path")
    ),
    "right" => array(
        array("name" =>"portfolio-cat-7",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-8",
        "img"=>"img_source_path"),
        array("name" =>"portfolio-cat-9",
        "img"=>"img_source_path")
    )
);

$single_additional_options = array(
    array("name" => "Display Date",
    "id"=>"sin_display_date",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Author",
    "id"=>"sin_display_author",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Category",
    "id"=>"sin_display_category",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Tags",
    "id"=>"sin_display_tags",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Comments",
    "id"=>"sin_display_comments",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Title",
    "id"=>"sin_display_display_title",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Clickable title",
    "id"=>"sin_display_clickable_title",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Display Comments Template",
    "id"=>"sin_display_comments_article",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Open Image in Lightbox",
    "id"=>"sin_display_lightbox",
    "type"=>"checkbox",
    "default"=>"true"),

    array("name" => "Fixed Image Height",
    "id"=>"sin_fixed_height",
    "type"=>"text",
    "default"=>"0"),

);

$category_options_json = array();
$single_options_json = array();
  function freshcategory_add_init()
  {
      if($_GET['page'] == 'category_manager')
    {

        $file_dir=get_bloginfo('template_directory');

        wp_enqueue_style("freshcategory_css", $file_dir."/freshwork/freshcategory/freshcategory.css", false, "1.0", "all");
        wp_enqueue_script("freshcategory_js", $file_dir."/freshwork/freshcategory/freshcategory.js", false, "1.0");
    }

   /*   wp_enqueue_script("rm_scripts", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
    wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/controls.js", false, "1.0");
    wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");          */
  }
  function list_cats_admin($child_of, $depth)
  {
    global $category_additional_options,$category_options_json,$single_additional_options,$single_options_json;
    $cats = get_categories('hide_empty=0&parent='.$child_of);
   // $category_options_json = array();
    foreach ($cats as $one_cat)
    {
        $cid = $one_cat->cat_ID;
        foreach($category_additional_options as $one_option)
        {
           $category_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
        //   echo   get_option('cat-'.$one_option['id'].'-'.$cid);

           if( $category_options_json[$cid][$one_option['id']] == '' ) $category_options_json[$cid][$one_option['id']] = $one_option['default'];

        }
        foreach($single_additional_options as $one_option)
        {
           $single_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
        //   echo   get_option('cat-'.$one_option['id'].'-'.$cid);

           if( $single_options_json[$cid][$one_option['id']] == '' ) $single_options_json[$cid][$one_option['id']] = $one_option['default'];

        }


        //$category_options[$cid]

        $cat_template = get_option('cat_template-'.$one_cat->cat_ID);
        $cat_single_template = get_option('cat_single_template-'.$one_cat->cat_ID);

        if($cat_template == '') $cat_template = "blog-cat-1";
        if($cat_single_template == '') $cat_single_template = "blog-single-1";
        //echo $cat_single_template.'dick';
        $single_author = get_option('single_author-'.$one_cat->cat_ID);
        $single_date = get_option('single_date-'.$one_cat->cat_ID);
        $single_category = get_option('single_category-'.$one_cat->cat_ID);
        $single_tags = get_option('single_tags-'.$one_cat->cat_ID);
        $single_comments= get_option('single_comments-'.$one_cat->cat_ID);

        $single_title= get_option('single_title-'.$one_cat->cat_ID);
        $single_lightbox= get_option('single_lightbox-'.$one_cat->cat_ID);
        $single_ppp= get_option('single_ppp-'.$one_cat->cat_ID);
        if($single_ppp == '')$ingle_ppp = 0;
         // $one_cat->cat_ID
         $css_depth = $depth;
         if($css_depth > 9) $css_depth = 9;
        echo '<li class="cat-list-'.$css_depth.'" rel="'.$one_cat->cat_ID.'" title="'.$depth.'">';
        echo '<div class="cat_name">'.$one_cat->name.'</div>';
        echo '<div class="cat_apply"><div class="cat_apply_icon"></div></div>';
        echo '<input type="hidden" class="cat_template" name="template_cat-'.$one_cat->cat_ID.'" value="'.$cat_template.'">';
        echo '<input type="hidden" class="cat_single_template" name="template_single-'.$one_cat->cat_ID.'" value="'.$cat_single_template.'">';

        echo '<input type="hidden" class="single_author" name="single_author-'.$one_cat->cat_ID.'" value="'.$single_author.'">';
        echo '<input type="hidden" class="single_date" name="single_date-'.$one_cat->cat_ID.'" value="'.$single_date.'">';
        echo '<input type="hidden" class="single_category" name="single_category-'.$one_cat->cat_ID.'" value="'.$single_category.'">';
        echo '<input type="hidden" class="single_tags" name="single_tags-'.$one_cat->cat_ID.'" value="'.$single_tags.'">';
        echo '<input type="hidden" class="single_comments" name="single_comments-'.$one_cat->cat_ID.'" value="'.$single_comments.'">';

        echo '<input type="hidden" class="single_title" name="single_title-'.$one_cat->cat_ID.'" value="'.$single_title.'">';
        echo '<input type="hidden" class="single_lightbox" name="single_lightbox-'.$one_cat->cat_ID.'" value="'.$single_lightbox.'">';
        echo '<input type="hidden" class="single_ppp" name="single_ppp-'.$one_cat->cat_ID.'" value="'.$single_ppp.'">';



        echo '<div class="clear"></div></li>';
         list_cats_admin($one_cat->cat_ID, $depth+1);
    }
   // echo '<script>';

    return;
  }
  function freshcategory_add_admin()
  {
    if($_POST['save_category_manager'] == "true")
    {
        $json_category_array = (json_decode(stripslashes($_POST['json_category']), true));
        $json_single_array = (json_decode(stripslashes($_POST['json_single']), true));
        $cats = get_all_category_ids();
      //  print_r($cats);
        foreach ($cats as $cat)
        {

            foreach($json_category_array[$cat] as $key => $one_option)
            {
                if($one_option == "true") $one_option = true;
                update_option('cat-'.$key.'-'.$cat, $one_option);
            }

            foreach($json_single_array[$cat] as $key => $one_option)
            {
                if($one_option == "true") $one_option = true;
                update_option('cat-'.$key.'-'.$cat, $one_option);
            }

            $cat_template = $_POST['template_cat-'.$cat];
            $cat_single_template = $_POST['template_single-'.$cat];

          //  echo $cat_template;
            $single_author = $_POST['single_author-'.$cat];
            $single_date = $_POST['single_date-'.$cat];
            $single_category = $_POST['single_category-'.$cat];
            $single_tags = $_POST['single_tags-'.$cat];
            $single_comments= $_POST['single_comments-'.$cat];

            $single_title= $_POST['single_title-'.$cat];
            $single_lightbox= $_POST['single_lightbox-'.$cat];
            $single_ppp= $_POST['single_ppp-'.$cat];


            update_option('cat_template-'.$cat , $cat_template);
            update_option('cat_single_template-'.$cat ,$cat_single_template);

            update_option('single_author-'.$cat ,$single_author);
            update_option('single_date-'.$cat ,$single_date);
            update_option('single_category-'.$cat ,$single_category);
            update_option('single_tags-'.$cat ,$single_tags);
            update_option('single_comments-'.$cat ,$single_comments);

            update_option('single_title-'.$cat ,$single_title);
            update_option('single_lightbox-'.$cat ,$single_lightbox);
            update_option('single_ppp-'.$cat ,$single_ppp);
       /*     $cat_template = $_POST[$cat.'-template'];
            echo $cat_template.'sss';
            echo 'x';
            update_option('cat_template-'.$cat, $cat_template);       */
        }
    }
  }
  add_action('admin_init', 'freshcategory_add_init');
  add_action('admin_menu', 'freshcategory_add_admin');
function category_manager()
{
global $category_options_json, $category_additional_options,$single_options_json,
$single_additional_options, $category_blog_templates, $category_portfolio_templates,$single_blog_templates;

//$arraa =   Array("foo"=> Array("kokot", "pica", "debil" => array("idiot","kunda")), "bar" =>"aaa" );
//echo json_encode($arraa);

 //$neco = (json_decode(stripslashes($_POST['json_caregory']), true));
   // echo $neco[6]["display_date"];

?>

<div class="wrap">

	<div id="icon-themes" class="icon32"><br /></div>
	<h2>Category Options</h2>
	<div id="freshcategory">

		<div id="cat_apply_icon_tooltip">This is a huge help for those who are dumb...</div>

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Left Column                                           // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="left-column" class="metabox-holder">

			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box                                                   // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div id="select-category" class="postbox" >
			<form method="post">
				<h3 class='postbox-title'>
					<span>Categories</span>
				</h3>
				<div class="inside">
					<p class="howto">Select which category you would like to edit:</p>
					<p>

					<ul id="cat-list">
                    <?php
                        global $cat_list;
                        foreach ($cat_list as $key=>$one_cat) {
                            echo '<li class="cat-list-'.$one_cat[0].'" rel="'.$key.'" title="'.$one_cat[0].'">';
                                echo '<div class="cat_name">'.$one_cat[1].'</div>';
                                echo '<div class="cat_apply"><div class="cat_apply_icon"></div></div>';
                            echo '</li>';
                        }
                    ?>
                    </ul>

                    </p>
					<p class="button-controls">
						<img class="waiting" src="http://freshface.cz/work/rw/wp-admin/images/wpspin_light.gif" alt="" />
                        <input type="hidden" name="save_category_manager" value="true">
                        <input type="hidden" name="json_category" id="json_category">
                        <input type="hidden" name="json_single" id="json_single">
						<input type="submit" class="button-primary" name="nav-menu-locations" value="Save" />
					</p>
				</div><!-- /.inside -->
			</form>
			</div>
<?php
echo '<script>';
echo 'var category_data_holder = jQuery.parseJSON(\''.json_encode ($category_options_json).'\');';
echo 'var single_data_holder = jQuery.parseJSON(\''.json_encode ($single_options_json).'\');';
echo '</script>';
?>
		</div><!-- /#left-column -->

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Right Column                                          // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="right-column">

 			<div class="postbox">
				<div class="nav-menu-header">
					<div class="nav-menu-title">
						<span>'Category view' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="category-options-additional">
                        <?php
                            foreach($category_additional_options as $one_option)
                            {
                                if($one_option['id'] == 'cat_fixed_height') {
                                echo '<li style="width:100%;"><hr>';
                                 echo "<h4>'Category Post view' Main Image Height</h4>";
	                             echo '<p>';
                                    echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">';
		                          echo '<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any "Single Post view" template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template\'s .php file, please input zero like this: 0</label>';
	                            echo '</p>';
	                            echo '</li>';
                                }
                                else
                                {
                                echo '<li>';
                                echo '<label for="'.$one_option['id'].'">';
                                echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">'.$one_option['name'];
                                echo '</label>';
                                echo '</li>';
                                }
                            }
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->


			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<span>'Category view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             CATEGORY OPTIONS - Box - with tabs on top             // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="category-options" >

							<div class="nav-tabs-wrapper">
								<span class="select_name">Select Post Type:</span>
								<div class="nav-tabs">
									<span id="nav-tab-blog" class="select_button nav-tab-active">Blog</span>
									<span id="nav-tab-portfolio" class="select_button">Portfolio</span>
								</div>
								<div class="clear"></div>
							</div><!-- /.nav-tabs-wrapper -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="category-blog-left" rel="blog-subnav-left">
								<?php
                                    foreach($category_blog_templates['left'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/left/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-left -->

								<ul class="templates_wrapper" id="category-blog-right" rel="blog-subnav-right">
								<?php
                                    foreach($category_blog_templates['right'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/right/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-right -->

								<ul class="templates_wrapper" id="category-blog-no" rel="blog-subnav-no">
								<?php
                                    foreach($category_blog_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-no -->

								<div class="clear"></div>
							</div><!-- /#category-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-portfolio">
								<div class="sidebar_option_wrapper">
								<!--	<span class="select_name">Select Sidebar:</span>
									<div id="portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div> -->
								</div>

								<ul class="templates_wrapper" id="category-portfolio-no" rel="portfolio-subnav-no">
								<?php
                                    foreach($category_portfolio_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/portcat/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-portfolio-no -->

								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>

 			<div class="postbox">
				<div class="nav-menu-header">
					<div class="nav-menu-title">
						<span>'Single Post view' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="single-options-additional">
                        <?php
                            foreach($single_additional_options as $one_option)
                            {
                                if($one_option['id'] == 'sin_fixed_height') {
                                echo '<li style="width:100%;"><hr>';
                                 echo "<h4>'Single Post view' Main Image Height</h4>";
	                             echo '<p>';
                                    echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">';
		                          echo '<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any "Single Post view" template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template\'s .php file, please input zero like this: 0</label>';
	                            echo '</p>';
	                            echo '</li>';
                                }
                                else
                                {
                                echo '<li>';
                                echo '<label for="'.$one_option['id'].'">';
                                echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">'.$one_option['name'];
                                echo '</label>';
                                echo '</li>';
                                }
                            }
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<span>'Single Post view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             SINGLE OPTIONS - Box - with tabs on top               // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="single-options">

						<!--	<div class="nav-tabs-wrapper">
								<span class="select_name" style="display:none;">Select Post Type:</span>
								<div class="nav-tabs" style="display:none;">
									<span id="nav-tab-single-blog" class="select_button nav-tab-active">Blog</span>
									<span id="nav-tab-single-portfolio" class="select_button">Portfolio</span>
								</div>
								<div class="clear"></div>
							</div>--><!-- /.nav-tabs-wrapper -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="single-blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="single-blog-left" rel="single-blog-subnav-left" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['left'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/left/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-left -->

								<ul class="templates_wrapper" id="single-blog-right" rel="single-blog-subnav-right" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['right'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/right/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-right -->

								<ul class="templates_wrapper" id="single-blog-no" rel="single-blog-subnav-no" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-no -->

								<div class="clear"></div>
							</div><!-- /#single-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-portfolio" style="display:none;">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="single-portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>



								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>


 <?php /*
  	<div class="postbox">
				<div class="nav-menu-header">
					<div class="nav-menu-title">
						<span>Post Meta</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="post-meta">
						<li>
							<label for="post_meta_author">
								<input type="checkbox" value="0" id="post_meta_author" rel="author" name="post_meta_author">Author
							</label>
						</li>
						<li>
							<label for="post_meta_date">
								<input type="checkbox" value="0" id="post_meta_date" rel="date" name="post_meta_date">Date
							</label>
						</li>
						<li>
							<label for="post_meta_category">
								<input type="checkbox" value="0" id="post_meta_category" rel="category" name="post_meta_author">Category
							</label>
						</li>
						<li>
							<label for="post_meta_tags">
								<input type="checkbox" value="0" id="post_meta_tags" rel="tags" name="post_meta_tags">Tags
							</label>
						</li>
						<li>
							<label for="post_meta_comments">
								<input type="checkbox" value="0" id="post_meta_comments" rel="comments" name="post_meta_comments">Comments
							</label>
						</li>
						<li>
							<label for="post_meta_title">
								<input type="checkbox" value="0" id="post_meta_title" rel="title" checked="checked" name="post_meta_title">Clickable title
							</label>
						</li>
						<li>
							<label for="post_meta_lightbox">
								<input type="checkbox" value="0" id="post_meta_lightbox" rel="lightbox" name="post_meta_lightbox">Open image in lightbox
							</label>
						</li>
						<li>
    						<label for="post_meta_ppp">
    							<input type="text" value="0" id="post_meta_ppp" rel="ppp" name="post_meta_ppp"> Posts per page
    						</label>
                        </li>
					</ul>

					<div class="clear"></div>
				</div>
			</div> <!-- /postbox -->             */  ?>
		</div><!-- /#right-column --><!-- /RIGHT COLUMN -->

	</div><!-- /#freshcategory -->
</div><!-- /.wrap-->
<div class="clear"></div>

<?php
}
?>