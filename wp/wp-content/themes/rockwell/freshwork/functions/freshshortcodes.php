<?php
function shortcode_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="divider"></div>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');

function shortcode_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="divider"></div>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');

function shortcode_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'shortcode_one_fourth');

function shortcode_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="divider"></div>';
}
add_shortcode('one_fourth_last', 'shortcode_one_fourth_last');

function shortcode_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'shortcode_three_fourth');

function shortcode_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="divider"></div>';
}
add_shortcode('three_fourth_last', 'shortcode_three_fourth_last');

function shortcode_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'shortcode_two_third');

function shortcode_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="divider"></div>';
}
add_shortcode('two_third_last', 'shortcode_two_third_last');

function shortcode_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
        ), $atts));
   return '<a href="'.$link.'" class="btn_a">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'shortcode_button');


function shortcode_box_download( $atts, $content = null ) {
   return '<div class="box_download">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_download', 'shortcode_box_download');

function shortcode_box_info( $atts, $content = null ) {
   return '<div class="box_info">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_info', 'shortcode_box_info');

function shortcode_box_warning( $atts, $content = null ) {
   return '<div class="box_warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_warning', 'shortcode_box_warning');

function shortcode_box_note( $atts, $content = null ) {
   return '<div class="box_note">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_note', 'shortcode_box_note');

function shortcode_dropcap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'shortcode_dropcap');

function shortcode_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'shortcode_pullquote_left');

function shortcode_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'shortcode_pullquote_right');
function shortcode_toggle( $atts, $content = null)
{
 extract(shortcode_atts(array(
        'title'      => '',
        ), $atts));
   return '<h4 class="toggle"><a href="#">'.$title.'</a></h4><div class="toggle_body"><div class="block">'. do_shortcode($content) . '</div></div>';
}
add_shortcode('toggle', 'shortcode_toggle');

function shortcode_highlight1( $atts, $content = null)
{

   return '<span class="highlight1">'. do_shortcode($content) . '</span>';
}
add_shortcode('highlight1', 'shortcode_highlight1');

function shortcode_highlight2( $atts, $content = null)
{

   return '<span class="highlight2">'. do_shortcode($content) . '</span>';
}
add_shortcode('highlight2', 'shortcode_highlight2');

function shortcode_frame_left( $atts, $content = null)
{

   return '<span class="frame alignleft">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_left', 'shortcode_frame_left');

function shortcode_frame_right( $atts, $content = null)
{

   return '<span class="frame alignright">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_right', 'shortcode_frame_right');

function shortcode_frame_center( $atts, $content = null)
{

   return '<span class="frame aligncenter">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_center', 'shortcode_frame_center');

function shortcode_divider( $atts, $content = null)
{

   return '<div class="sc_divider"></div>';
}
add_shortcode('divider', 'shortcode_divider');


function shortcode_no( $atts, $content = null)
{
  $url = get_bloginfo('template_url');
   return '<img src="'.$url.'/gfx/icons/cross.png" class="sc_no">';
}
add_shortcode('no', 'shortcode_no');

function shortcode_yes( $atts, $content = null)
{
  $url = get_bloginfo('template_url');
   return '<img src="'.$url.'/gfx/icons/tick.png" class="sc_yes">';
}
add_shortcode('yes', 'shortcode_yes');




function shortcode_divider_top( $atts, $content = null)
{

   return '<div class="sc_divider top"><a href="#">Top</a></div>';
}
add_shortcode('divider_top', 'shortcode_divider_top');

function shortcode_tabs( $atts, $content = null)
{
  $tab_count = $atts['count'];
  $toreturn = '';
  $toreturn .= '<div class="sc_tabs">';
  $toreturn .= '<div class="sc_tabs_header">';
        for($i = 1; $i <= $atts['count']; $i++)
        {
          $active = '';
          if($i==1)$active = ' sc_tab_active';
           $toreturn .= '<div title="'.($i-1).'" class="sc_tab'.$active.'">'.$atts['tab'.$i].'</div>';
        }
  $toreturn .= '<div class="clear"></div>';
  $toreturn .= '</div>';
  $toreturn .= '<div class="sc_tabs_body"><!-- st_tab -->';
  $toreturn .= str_replace(array('[tab_first]', '[/tab_first]', '[tab]', '[/tab]'), array('<div class="sc_tabs_box_first sc_tab_single_box">','</div><!-- st_tab -->', '<div class="sc_tabs_box sc_tab_single_box">','</div><!-- st_tab -->'), do_shortcode($content));
  $toreturn .= '<div class="clear"></div>';
  $toreturn .= '</div>';
  $toreturn .= '</div>';


  return $toreturn;
   //$content;

}
add_shortcode('tabs', 'shortcode_tabs');


add_filter( "the_content", "the_content_p_remover", 99);
function the_content_p_remover($post_content)
{

 $post_content2 = str_replace(array('<div class="one_third"></p>',
      '<div class="one_third last"></p>',
      '<div class="one_half"></p>',
      '<div class="one_half last"></p>',
      '<div class="one_fourth"></p>',
      '<div class="one_fourth last"></p>',
      '<div class="two_third"></p>',
      '<div class="two_third last"></p>',
      '<div class="three_fourth"></p>',
      '<div class="three_fourth last"></p>',
      '<beforecheck></p>',
      '<p><aftercheck>',
      '<p><div class="sc_divider"></div>',
      '<div class="sc_tabs_box"><br />',
      '{{',
      '}}',
      '<!-- st_tab --><br />'
  ),

     array('<div class="one_third">',
      '<div class="one_third last">',
      '<div class="one_half">',
      '<div class="one_half last">',
      '<div class="one_fourth">',
      '<div class="one_fourth last">',
      '<div class="two_third">',
      '<div class="two_third last">',
      '<div class="three_fourth">',
      '<div class="three_fourth last">',
      '',
      '',
      '',
      '<div class="sc_tabs_box">',
      '[',
      ']',
      ''
       ), $post_content);
    return str_replace('<p></div>', '</div>', $post_content2);
}

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	// Allow <a title="plugins" href="http://wptricks.net/category/plugins/">plugins</a>/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id'=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''), $attr));
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	//$width = $width + 3;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align)
	. '" style="width: ' . ((int) $width) . 'px; max-width: ' . ((int) $width) . 'px; ">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">'
	. $caption . '</p></div>';
}
?>