<?php



$font_data = array(
        array("name"=>"ff_font_body", "class"=> "body"),
        array("name"=>"ff_font_navigation", "class"=> "#navigation"),
        array("name"=>"ff_font_navigation_submenu", "class"=> ".sub-menu"),
        array("name"=>"ff_font_info_line", "class"=> ".info_line"),
        array("name"=>"ff_font_message", "class"=> ".message"),
        array("name"=>"ff_font_home_widget_h2", "class"=> "#home_widget_area h2"),
        array("name"=>"ff_font_footer_widget_h2", "class"=> ".footer_widget h2"),
        array("name"=>"ff_font_sidebar_post_meta_h2", "class"=> ".sidebar h2, .post_meta h2"),
        array("name"=>"ff_font_sidebar", "class"=> ".sidebar"),
        array("name"=>"ff_font_cat_title", "class"=> "#cat_title"),
        array("name"=>"ff_font_h1", "class"=> "h1"),
        array("name"=>"ff_font_h2", "class"=> "h2"),
        array("name"=>"ff_font_h3", "class"=> "h3"),
        array("name"=>"ff_font_h4", "class"=> "h4"),
        array("name"=>"ff_font_h5", "class"=> "h5"),
        array("name"=>"ff_font_h6", "class"=> "h6"),
        array("name"=>"ff_font_h7", "class"=> "h7"),
        array("name"=>"ff_font_post_info", "class"=> ".post_info"),
        array("name"=>"ff_font_post_info_single", "class"=> ".post_info_single"),
        array("name"=>"ff_font_blockquote", "class"=> "blockquote"),
        array("name"=>"ff_font_comment_author", "class"=> ".comment_author"),
        array("name"=>"ff_font_comment_date", "class"=> ".comment_date"),
        array("name"=>"ff_font_submit", "class"=> "#fc_submit, .more-link, #searchsubmit, .submit_contact, submit_comment, .comment-reply-link"),
        array("name"=>"ff_font_input", "class"=> "input, textarea"),
        array("name"=>"ff_font_label", "class"=> "label"),
        array("name"=>"ff_font_pagination", "class"=> ".fresh-pagination"),
        array("name"=>"ff_font_footer1", "class"=> "#footer1"),
        array("name"=>"ff_font_footer2", "class"=> "#footer2"),
        );




function normalize_font_name($font_name)
{
     $font_name = str_replace(' ', '+', $font_name);
     $font_name = str_replace(',', '\',\'', $font_name);
     return $font_name;
}
$fonts_to_include ="";
$css_style = "";
foreach($font_data as $one_font_data){
    $f_value = get_option($one_font_data['name']);
    if($f_value == 'DEFAULT') continue;
    
    $f_value_normalized = normalize_font_name($f_value);

    $fonts_to_include = $fonts_to_include.$f_value_normalized.'|';
    $css_style = $css_style . $one_font_data['class']." { font-family: '".$f_value."' !important;}\n";
}

if($fonts_to_include != '' && get_option('ff_font_enable') == 'true')
{
  echo "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=".$fonts_to_include."' type='text/css'/>";
  echo "<style type=\"text/css\">".$css_style."</style>";
}      /*
if(get_option('ff_font_enable') == 'true')
{
$font_h1 = get_option('ff_font_h1_family');
$font_h2 = get_option('ff_font_h2_family');
$font_body = get_option('ff_font_body_family');




if($font_h1) {

    $font_name = strpos($font_h1, ':');
    if($font_name != false) $font_name = substr($font_h1, 0, $font_name);
    else $font_name = $font_h1;
    
    $font_name = str_replace('+', ' ', $font_name);
     $font_name = str_replace(',', '\',\'', $font_name);
    $style = get_option('ff_font_h1_style');
    $weight = get_option('ff_font_h1_weight');
    $spacing = get_option('ff_font_h1_spacing');

    if($style) $style = 'font-style:'.$style.' !important; ';
    if($weight) $weight = 'font-weight:'.$weight.' !important; ';
    if($spacing) $spacing = 'letter-spacing:'.$spacing.' !important; ';
    
    echo "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=".$font_h1."' type='text/css'/>";
    echo "<style type=\"text/css\"> h1 { font-family: '".$font_name."' !important; ".$style.$weight.$spacing."} </style>";
}
if($font_h2) {

    $font_name = strpos($font_h2, ':');
    if($font_name != false) $font_name = substr($font_h2, 0, $font_name);
    else $font_name = $font_h2;
     $font_name = str_replace('+', ' ', $font_name);
     $font_name = str_replace(',', '\',\'', $font_name);
    $style = get_option('ff_font_h2_style');
    $weight = get_option('ff_font_h2_weight');
    $spacing = get_option('ff_font_h2_spacing');

    if($style) $style = 'font-style:'.$style.' !important; ';
    if($weight) $weight = 'font-weight:'.$weight.' !important; ';
    if($spacing) $spacing = 'letter-spacing:'.$spacing.' !important; ';


    echo "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=".$font_h2."' type='text/css'/>";
    echo "<style type=\"text/css\"> #header, h2, h3, h4, h5, h6, h7, h8,  { font-family: '".$font_name."' !important;  ".$style.$weight.$spacing."} </style>";
}
if($font_body) {

    $font_name = strpos($font_body, ':');
    if($font_name != false) $font_name = substr($font_body, 0, $font_name);
    else $font_name = $font_body;
     $font_name = str_replace('+', ' ', $font_name);
          $font_name = str_replace(',', '\',\'', $font_name);
    $style = get_option('ff_font_body_style');
    $weight = get_option('ff_font_body_weight');
    $spacing = get_option('ff_font_body_spacing');

    if($style) $style = 'font-style:'.$style.' !important; ';
    if($weight) $weight = 'font-weight:'.$weight.' !important; ';
    if($spacing) $spacing = 'letter-spacing:'.$spacing.' !important; ';


    echo "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=".$font_body."' type='text/css'/>";
    echo "<style type=\"text/css\"> body { font-family: '".$font_name."' !important;  ".$style.$weight.$spacing."} </style>";
}
}                                   */
?>

