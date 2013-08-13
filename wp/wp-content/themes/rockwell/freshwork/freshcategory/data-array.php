<?php
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
    "default"=>"1"),

    array("name" => "Display Author",
    "id"=>"cat_display_author",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Category",
    "id"=>"cat_display_category",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Tags",
    "id"=>"cat_display_tags",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Comments",
    "id"=>"cat_display_comments",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Title",
    "id"=>"cat_display_display_title",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Clickable Title",
    "id"=>"cat_display_clickable_title",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Open Image in Lightbox",
    "id"=>"cat_display_lightbox",
    "type"=>"checkbox",
    "default"=>"0"),


    array("name" => "Order",
    "id"=>"cat_order",
    "type"=>"select",
    "default"=>"default",
    "options"=> array( "Default" => "default",
                        "Asc" => "ASC",
                        "Desc" => "DESC", ),
    ),

    array("name" => "Order By",
    "id"=>"cat_order_by",
    "type"=>"select",
    "default"=>"default",
    "options"=> array( "Default" => "default",
                        "ID" => "id",
                        "Author" => "author",
                        "Title" => "title",
                        "Date" => "date",
                        "Modified" => "modified",
                        "Parent" => "parent",
                        "Rand" => "rand",
                        "Comment Count" => "comment_count",
                        ),
    ),

    array("name" => "Posts per Page",
    "id"=>"cat_ppp",
    "type"=>"text",
    "default"=>"0"),

    array("name" => "Fixed Image Height",
    "id"=>"cat_fixed_height",
    "type"=>"text",
    "default"=>"0"),

    array("name" => "Categories to Exclude / Include (e.g. 15,-25)",
    "id"=>"cat_cat_exclude",
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
    "default"=>"1"),

    array("name" => "Display Author",
    "id"=>"sin_display_author",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Category",
    "id"=>"sin_display_category",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Tags",
    "id"=>"sin_display_tags",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Comments",
    "id"=>"sin_display_comments",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Title",
    "id"=>"sin_display_display_title",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Clickable title",
    "id"=>"sin_display_clickable_title",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Display Comments Template",
    "id"=>"sin_display_comments_article",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Open Image in Lightbox",
    "id"=>"sin_display_lightbox",
    "type"=>"checkbox",
    "default"=>"1"),

    array("name" => "Fixed Image Height",
    "id"=>"sin_fixed_height",
    "type"=>"text",
    "default"=>"0"),

);


 $cat_list2 = null;

  function create_cat_list2 ($child_of, $depth)
  {
      global $cat_list2;

      $cats = get_categories('hide_empty=0&parent='.$child_of);
      foreach ($cats as $one_cat)
      {
         // var_dump ($one_cat);
          $cat_list2[ $one_cat->cat_ID ][0] = $depth;
          $cat_list2[ $one_cat->cat_ID ][1] = $one_cat->name;

          create_cat_list2($one_cat->cat_ID, $depth + 1);
      }
  }
add_action('delete_category', 'del_cat');
function del_cat( $id )
{
    global $category_additional_options, $single_additional_options;
    foreach($category_additional_options as $one_option)
    {
        delete_option('cat-'.$one_option['id'].'-'.$id );

    }
    foreach($single_additional_options as $one_option)
    {
        delete_option('cat-'.$one_option['id'].'-'.$id );
    }
}
if ( $_GET['page'] == 'category_manager' || get_option( 'ff_theme_was_activated_catman' ) != 'true' )
 {
    add_option('ff_theme_was_activated_catman', 'true');
    update_option('ff_theme_was_activated_catman', 'true');

    global $cat_list2, $category_additional_options, $single_additional_options;

    $cat_list2 = Array (
      'index' => array( 0, 'Home Page' ),
      'archive' => array( 0, 'Archives' ),
      'author' => array( 0, 'Author' ),
      'search' => array( 0, 'Search' ),
    );
    create_cat_list2 (0,0);
   // var_dump ($cat_list2);
    foreach ($cat_list2 as $id=>$one_cat)
    {
        $cid = $id;
        foreach($category_additional_options as $one_option)
        {
            $tester = get_option('cat-'.$one_option['id'].'-'.$cid);

            if( $tester == '' && $tester != '0' ) {
              //echo $tester.'xxx';
                add_option('cat-'.$one_option['id'].'-'.$cid, $one_option['default']);
                update_option('cat-'.$one_option['id'].'-'.$cid, $one_option['default'] );
            }
            else if( $tester == 'true' ) {
                update_option('cat-'.$one_option['id'].'-'.$cid, 1 );
            }
            else if( $tester == 'false' ) {
                update_option('cat-'.$one_option['id'].'-'.$cid, 0 );
            }
          // $category_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
           //echo   get_option('cat-'.$one_option['id'].'-'.$cid);

           // if( $category_options_json[$cid][$one_option['id']] == '' && $single_options_json[$cid][$one_option['id']] != 0  ) $category_options_json[$cid][$one_option['id']] =  $one_option['default'];

        }
        foreach($single_additional_options as $one_option)
        {
            $tester = get_option('cat-'.$one_option['id'].'-'.$cid);
            if( $tester == '' && $tester != '0' ) {
                //echo
                add_option('cat-'.$one_option['id'].'-'.$cid, $one_option['default']);
                update_option('cat-'.$one_option['id'].'-'.$cid, $one_option['default'] );
            }
            else if( $tester == 'true' ) {
                update_option('cat-'.$one_option['id'].'-'.$cid, 1 );
            }
            else if( $tester == 'false' ) {
                update_option('cat-'.$one_option['id'].'-'.$cid, 0 );
            }
          // $category_options_json[$cid][$one_option['id']] = get_option('cat-'.$one_option['id'].'-'.$cid);
           //echo   get_option('cat-'.$one_option['id'].'-'.$cid);

           // if( $category_options_json[$cid][$one_option['id']] == '' && $single_options_json[$cid][$one_option['id']] != 0  ) $category_options_json[$cid][$one_option['id']] =  $one_option['default'];

        }
        
    }
}

/*class fOpt {
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
fOpt::init();        */

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
?>
