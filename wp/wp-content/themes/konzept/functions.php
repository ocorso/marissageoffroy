<?php 
	require_once (TEMPLATEPATH . '/framework/admin/admin-menu.php');
	require_once (TEMPLATEPATH . '/framework/admin/meta-boxes.php');
	require_once (TEMPLATEPATH . '/framework/admin/portfolio-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/slideshow-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/news-post-type.php');
	require_once (TEMPLATEPATH . '/framework/admin/sidebars-menu.php');

	require_once (TEMPLATEPATH . '/framework/miscellaneous/excerpt.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/is_.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/nav.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/lang.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/menus.php');
	require_once (TEMPLATEPATH . '/framework/miscellaneous/sidebars.php');
	
	require_once (TEMPLATEPATH . '/framework/shortcodes/konzept-dribbb/wp-dribbble.php'); 
	
	require_once (TEMPLATEPATH . '/addSlide/addslide.php');

	add_action('init', 'init_loadshortcodes');
	function init_loadshortcodes(){
		require_once (TEMPLATEPATH . '/framework/shortcodes/loader.php');
	}
	
	require_once (TEMPLATEPATH . '/framework/widgets/loader.php');

?>
<?php 
function my_init_method() {
if ( !is_admin() && !stristr( $_SERVER['REQUEST_URI'], 'wp-login' ) ) { // instruction to only load if it is not the admin area or wp-login.php file

	// register your script location, dependencies and version
	//wp_deregister_script('jquery');
   // wp_register_script('jquery', get_bloginfo('template_directory') . '/scripts/jquery-latest.js');
	wp_register_script('jquery_easing_script', get_bloginfo('template_directory') . '/scripts/jquery.easing.1.3.js', array('jquery'), '1.3' );
	wp_register_script('flow_portfolio_v2_script', get_bloginfo('template_directory') . '/scripts/animated-portfolio-v2.js', array('jquery'), '1.0' );
	wp_register_script('flow_portfolio_v6_script', get_bloginfo('template_directory') . '/scripts/animated-portfolio-v6.js', array('jquery'), '1.0' );
	wp_register_script('froogaloop', get_bloginfo('template_directory') . '/scripts/froogaloop.js', array('jquery'), '1.0' );
	wp_register_script('mousewheel', get_bloginfo('template_directory') . '/scripts/mousewheel.js', array('jquery'), '1.0' );
	wp_register_script('cloud_carousel', get_bloginfo('template_directory') . '/scripts/cloud-carousel.1.0.5.min.js', array('jquery', 'mousewheel'), '1.0' );
	wp_register_script('jqtools_tooltip', get_bloginfo('template_directory') . '/scripts/jquery.tooltip.min.js', array('jquery'), '1.0' );
	
	// enqueue scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery_jcycle_script');
	wp_enqueue_script('jquery_easing_script');
	wp_enqueue_script('flow_portfolio_v2_script');
	wp_enqueue_script('flow_portfolio_v6_script');
	//wp_enqueue_script('froogaloop');
	wp_enqueue_script('mousewheel');
	wp_enqueue_script('cloud_carousel');
	wp_enqueue_script('jqtools_tooltip');
	if(is_singular()){
		wp_enqueue_script('comment-reply');
	}
}
if(is_admin()){
	wp_register_script( 'brisk-uploader', get_bloginfo( 'template_directory').'/scripts/brisk-uploader.js', array('jquery','thickbox'));
	
	//colorpicker field in meta-boxes.php
	wp_register_style( 'FlowTypographyStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/style.css' );
	wp_register_style( 'FlowTypographyMainStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/css/colorpicker.css' );
	wp_register_style( 'FlowTypographyLayoutStylesheet', get_bloginfo('template_directory') . '/framework/admin/colorpicker/css/layout-flow.css' );
	wp_register_style( 'uploadify-style', get_bloginfo('template_directory') . '/includes/uploadify/uploadify.css' );
	wp_register_script('jquery_colorpicker_script', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/colorpicker.js', array('jquery'), '1.0' );
	wp_register_script('jquery_colorpicker_script2', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/eye.js', array('jquery'), '1.0' );
	wp_register_script('jquery_colorpicker_script3', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/layout.js', array('jquery'), '1.0' );
	wp_register_script('jquery_colorpicker_script4', get_bloginfo('template_directory') . '/framework/admin/colorpicker/js/utils.js', array('jquery'), '1.0' );
	wp_register_script('jquery_colorpicker_script_main', get_bloginfo('template_directory') . '/framework/admin/colorpicker/colorpicker_uruchamiajacy_w_adminie.js', array('jquery'), '1.0' );
	wp_register_script('uploadify', get_bloginfo('template_directory') . '/includes/uploadify/jquery.uploadify.js', array('jquery'), '3.0' );
	wp_register_script('plupload_queue', get_bloginfo('template_directory') . '/scripts/jquery.plupload.queue.js', array('jquery'), '1.0' );
	wp_register_script('color_sampler', get_bloginfo('template_directory') . '/scripts/jquery.ImageColorPicker.js', array('jquery', 'jquery-ui-widget'), '1.0' );
	//wp_register_script('color_sampler_jquery_ui', get_bloginfo('template_directory') . '/scripts/jquery-ui-1.8.9.custom.min.js', array('jquery'), '1.0' );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('brisk-uploader');
	
	wp_enqueue_style( 'FlowTypographyLayoutStylesheet' );
	wp_enqueue_style( 'FlowTypographyStylesheet' );
	wp_enqueue_style( 'FlowTypographyMainStylesheet' );
	wp_enqueue_style( 'uploadify-style' );
	wp_enqueue_script( 'jquery_colorpicker_script_main' );
	wp_enqueue_script('jquery_colorpicker_script');
	wp_enqueue_script('jquery_colorpicker_script2');
	wp_enqueue_script('jquery_colorpicker_script3');
	wp_enqueue_script('jquery_colorpicker_script4');
	wp_enqueue_script('uploadify');
	wp_enqueue_script('plupload-full');
	wp_enqueue_script('plupload-handlers');
	wp_enqueue_script('plupload_queue');
	wp_enqueue_script('swfobject');
	wp_enqueue_script('color_sampler');
	wp_enqueue_script('color_sampler_jquery_ui');
}
}
add_action('init', 'my_init_method');

function essenceactivate(){
	global $pagenow;
	if(is_admin() && $pagenow == 'themes.php' && isset($_GET['activated'])){
		if(!get_option("flowessencethemeactivated")){
			include_once (TEMPLATEPATH . '/install.php');
			update_option("flowessencethemeactivated", true);
		}
	}
}
add_action('admin_init', 'essenceactivate');
function addthemesupports(){
	add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'addthemesupports');

if(!isset($content_width)){
	$content_width = 960;
}

/*
Plugin Name: Ambrosite Next/Previous Post Link Plus
Plugin URI: http://www.ambrosite.com/plugins
Description: Upgrades the next/previous post link template tags to reorder or loop adjacent post navigation links, return multiple links, truncate link titles, and display post thumbnails. IMPORTANT: If you are upgrading from plugin version 1.1, you will need to update your templates (refer to the <a href="http://www.ambrosite.com/plugins/next-previous-post-link-plus-for-wordpress">documentation</a> on configuring parameters).
Version: 2.3
Author: J. Michael Ambrosio
Author URI: http://www.ambrosite.com
License: GPL2
*/

/**
 * Retrieve adjacent post link.
 *
 * Can either be next or previous post link.
 *
 * Based on get_adjacent_post() from wp-includes/link-template.php
 *
 * @param array $r Arguments.
 * @param bool $previous Optional. Whether to retrieve previous post.
 * @return array of post objects.
 */
function get_adjacent_post_plus($r, $previous = true ) {
	global $post, $wpdb;

	extract( $r, EXTR_SKIP );

	if ( empty( $post ) )
		return null;

//	Sanitize $order_by, since we are going to use it in the SQL query. Default to 'post_date'.
	if ( in_array($order_by, array('post_date', 'post_title', 'post_excerpt', 'post_name', 'post_modified')) ) {
		$order_format = '%s';
	} elseif ( in_array($order_by, array('ID', 'post_author', 'post_parent', 'menu_order', 'comment_count')) ) {
		$order_format = '%d';
	} elseif ( $order_by == 'custom' && !empty($meta_key) ) { // Don't allow a custom sort if meta_key is empty.
		$order_format = '%s';
	} else {
		$order_by = 'post_date';
		$order_format = '%s';
	}
	
//	Sanitize $order_2nd. Only columns containing unique values are allowed here. Default to 'post_date'.
	if ( in_array($order_2nd, array('post_date', 'post_title', 'post_modified')) ) {
		$order_format2 = '%s';
	} elseif ( in_array($order_2nd, array('ID')) ) {
		$order_format2 = '%d';
	} else {
		$order_2nd = 'post_date';
		$order_format2 = '%s';
	}
	
//	Sanitize num_results (non-integer or negative values trigger SQL errors)
	$num_results = intval($num_results) < 2 ? 1 : intval($num_results);

//	Sorting on custom fields requires an extra table join
	if ( $order_by == 'custom' ) {
		$current_post = get_post_meta($post->ID, $meta_key, TRUE);
		$order_by = 'm.meta_value';
		$meta_join = $wpdb->prepare(" INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id AND m.meta_key = %s", $meta_key );
	} else {
		$current_post = $post->$order_by;
		$order_by = 'p.' . $order_by;
		$meta_join = '';
	}

//	Get the current post value for the second sort column
	$current_post2 = $post->$order_2nd;
	$order_2nd = 'p.' . $order_2nd;
	
//	Get the list of post types. Default to current post type
	if ( empty($post_type) )
		$post_type = "'$post->post_type'";

//	Put this section in a do-while loop to enable the loop-to-first-post option
	do {
		$join = $meta_join;
		$excluded_categories = $ex_cats;
		$excluded_posts = $ex_posts;
		$included_posts = $in_posts;
		$in_same_term_sql = $in_same_author_sql = $ex_cats_sql = $ex_posts_sql = $in_posts_sql = '';

//		Get the list of hierarchical taxonomies, including customs (don't assume taxonomy = 'category')
		$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );

		if ( ($in_same_cat || $in_same_tax || $in_same_format || !empty($excluded_categories)) && !empty($taxonomies) ) {
			$cat_array = $tax_array = $format_array = array();

			if ( $in_same_cat ) {
				$cat_array = wp_get_object_terms($post->ID, $taxonomies, array('fields' => 'ids'));
			}
			if ( $in_same_tax && !$in_same_cat ) {
				if ( $in_same_tax === true ) {
					if ( $taxonomies != array('category') )
						$taxonomies = array_diff($taxonomies, array('category'));
				} else
					$taxonomies = (array) $in_same_tax;
				$tax_array = wp_get_object_terms($post->ID, $taxonomies, array('fields' => 'ids'));
			}
			if ( $in_same_format ) {
				$taxonomies[] = 'post_format';
				$format_array = wp_get_object_terms($post->ID, 'post_format', array('fields' => 'ids'));
			}

			$join .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy IN (\"" . implode('", "', $taxonomies) . "\")";

			$term_array = array_unique( array_merge( $cat_array, $tax_array, $format_array ) );
			if ( !empty($term_array) )
				$in_same_term_sql = "AND tt.term_id IN (" . implode(',', $term_array) . ")";

			if ( !empty($excluded_categories) ) {
//				Support for both (1 and 5 and 15) and (1, 5, 15) delimiter styles
				$delimiter = ( strpos($excluded_categories, ',') !== false ) ? ',' : 'and';
				$excluded_categories = array_map( 'intval', explode($delimiter, $excluded_categories) );
//				Three category exclusion methods are supported: 'strong', 'diff', and 'weak'.
//				Default is 'weak'. See the plugin documentation for more information.
				if ( $ex_cats_method === 'strong' ) {
					$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );
					if ( function_exists('get_post_format') )
						$taxonomies[] = 'post_format';
					$ex_cats_posts = get_objects_in_term( $excluded_categories, $taxonomies );
					if ( !empty($ex_cats_posts) )
						$ex_cats_sql = "AND p.ID NOT IN (" . implode($ex_cats_posts, ',') . ")";
				} else {
					if ( !empty($term_array) && !in_array($ex_cats_method, array('diff', 'differential')) )
						$excluded_categories = array_diff($excluded_categories, $term_array);
					if ( !empty($excluded_categories) )
						$ex_cats_sql = "AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
				}
			}
		}

//		Optionally restrict next/previous links to same author		
		if ( $in_same_author )
			$in_same_author_sql = $wpdb->prepare("AND p.post_author = %d", $post->post_author );

//		Optionally exclude individual post IDs
		if ( !empty($excluded_posts) ) {
			$excluded_posts = array_map( 'intval', explode(',', $excluded_posts) );
			$ex_posts_sql = " AND p.ID NOT IN (" . implode(',', $excluded_posts) . ")";
		}
		
//		Optionally include individual post IDs
		if ( !empty($included_posts) ) {
			$included_posts = array_map( 'intval', explode(',', $included_posts) );
			$in_posts_sql = " AND p.ID IN (" . implode(',', $included_posts) . ")";
		}

		$adjacent = $previous ? 'previous' : 'next';
		$order = $previous ? 'DESC' : 'ASC';
		$op = $previous ? '<' : '>';

//		Optionally get the first/last post. Disable looping and return only one result.
		if ( $end_post ) {
			$order = $previous ? 'ASC' : 'DESC';
			$num_results = 1;
			$loop = false;
			if ( $end_post === 'fixed' ) // display the end post link even when it is the current post
				$op = $previous ? '<=' : '>=';
		}

//		If there is no next/previous post, loop back around to the first/last post.		
		if ( $loop && isset($result) ) {
			$op = $previous ? '>=' : '<=';
			$loop = false; // prevent an infinite loop if no first/last post is found
		}
		
		$join  = apply_filters( "get_{$adjacent}_post_plus_join", $join, $r );

//		In case the value in the $order_by column is not unique, select posts based on the $order_2nd column as well.
//		This prevents posts from being skipped when they have, for example, the same menu_order.
		$where = apply_filters( "get_{$adjacent}_post_plus_where", $wpdb->prepare("WHERE ( $order_by $op $order_format OR $order_2nd $op $order_format2 AND $order_by = $order_format ) AND p.post_type IN ($post_type) AND p.post_status = 'publish' $in_same_term_sql $in_same_author_sql $ex_cats_sql $ex_posts_sql $in_posts_sql", $current_post, $current_post2, $current_post), $r );

		$sort  = apply_filters( "get_{$adjacent}_post_plus_sort", "ORDER BY $order_by $order, $order_2nd $order LIMIT $num_results", $r );

		$query = "SELECT DISTINCT p.* FROM $wpdb->posts AS p $join $where $sort";
		$query_key = 'adjacent_post_' . md5($query);
		$result = wp_cache_get($query_key);
		if ( false !== $result )
			return $result;

//		echo $query . '<br />';

//		Use get_results instead of get_row, in order to retrieve multiple adjacent posts (when $num_results > 1)
//		Add DISTINCT keyword to prevent posts in multiple categories from appearing more than once
		$result = $wpdb->get_results("SELECT DISTINCT p.* FROM $wpdb->posts AS p $join $where $sort");
		if ( null === $result )
			$result = '';

	} while ( !$result && $loop );

	wp_cache_set($query_key, $result);
	return $result;
}

/**
 * Display previous post link that is adjacent to the current post.
 *
 * Based on previous_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @return bool True if previous post link is found, otherwise false.
 */
function previous_post_link_plus($args = '') {
	return adjacent_post_link_plus($args, '&laquo; %link', true);
}

/**
 * Display next post link that is adjacent to the current post.
 *
 * Based on next_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @return bool True if next post link is found, otherwise false.
 */
function next_post_link_plus($args = '') {
	return adjacent_post_link_plus($args, '%link &raquo;', false);
}

/**
 * Display adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * Based on adjacent_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @param bool $previous Optional, default is true. Whether display link to previous post.
 * @return bool True if next/previous post is found, otherwise false.
 */
function adjacent_post_link_plus($args = '', $format = '%link &raquo;', $previous = true) {
	$defaults = array(
		'order_by' => 'post_date', 'order_2nd' => 'post_date', 'meta_key' => '', 'post_type' => '',
		'loop' => false, 'end_post' => false, 'thumb' => false, 'max_length' => 0,
		'format' => '', 'link' => '%title', 'tooltip' => '%title',
		'in_same_cat' => false, 'in_same_tax' => false, 'in_same_format' => false, 'in_same_author' => false,
		'ex_cats' => '', 'ex_cats_method' => 'weak', 'ex_posts' => '', 'in_posts' => '',
		'before' => '', 'after' => '', 'num_results' => 1, 'echo' => true
	);

	$r = wp_parse_args( $args, $defaults );
	if ( !$r['format'] )
		$r['format'] = $format;
	if ( !function_exists('get_post_format') )
		$r['in_same_format'] = false;

	if ( $previous && is_attachment() ) {
		$posts = array();
		$posts[] = & get_post($GLOBALS['post']->post_parent);
	} else
		$posts = get_adjacent_post_plus($r, $previous);

//	If there is no next/previous post, return false so themes may conditionally display inactive link text.
	if ( !$posts )
		return false;

	$output = $r['before'];
	
//	When num_results > 1, multiple adjacent posts may be returned. Use foreach to display each adjacent post.
//	If sorting by date, display posts in reverse chronological order. Otherwise display in alpha/numeric order.
	if ( ($previous && $r['order_by'] != 'post_date') || (!$previous && $r['order_by'] == 'post_date') )
		$posts = array_reverse( $posts, true );

	foreach ( $posts as $post ) {
		$title = $post->post_title;
		if ( empty($post->post_title) )
			$title = $previous ? __('Previous Post') : __('Next Post');

		$title = apply_filters('the_title', $title, $post->ID);
		$date = mysql2date(get_option('date_format'), $post->post_date);
		$author = get_the_author_meta('display_name', $post->post_author);
	
//		Set anchor title attribute to long post title or custom tooltip text. Supports variable replacement in custom tooltip.
		if ( $r['tooltip'] ) {
			$tooltip = str_replace('%title', $title, $r['tooltip']);
			$tooltip = str_replace('%date', $date, $tooltip);
			$tooltip = str_replace('%author', $author, $tooltip);
			$tooltip = ' title="' . esc_attr($tooltip) . '"';
		} else
			$tooltip = '';

//		Truncate the link title to nearest whole word under the length specified.
		$max_length = intval($r['max_length']) < 1 ? 9999 : intval($r['max_length']);
		if ( strlen($title) > $max_length )
			$title = substr( $title, 0, strrpos(substr($title, 0, $max_length), ' ') ) . '...';
	
		$rel = $previous ? 'prev' : 'next';

		$anchor = '<a href="'.get_permalink($post).'" rel="'.$rel.'"'.$tooltip.'>';
		$link = str_replace('%title', $title, $r['link']);
		$link = str_replace('%date', $date, $link);
		$link = $anchor . $link . '</a>';
	
		$format = str_replace('%link', $link, $r['format']);
		$format = str_replace('%date', $date, $format);
		$format = str_replace('%author', $author, $format);
		if ( $r['order_by'] == 'custom' && !empty($r['meta_key']) ) {
			$meta = get_post_meta($post->ID, $r['meta_key'], true);
			$format = str_replace('%meta', $meta, $format);
		}

//		Get the category list, including custom taxonomies (only if the %category variable has been used).
		if ( (strpos($format, '%category') !== false) && version_compare(PHP_VERSION, '5.0.0', '>=') ) {
			$term_list = '';
			$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );
			if ( $r['in_same_format'] && get_post_format($post->ID) )
				$taxonomies[] = 'post_format';
			foreach ( $taxonomies as &$taxonomy ) {
//				No, this is not a mistake. Yes, we are testing the result of the assignment ( = ).
//				We are doing it this way to stop it from appending a comma when there is no next term.
				if ( $next_term = get_the_term_list($post->ID, $taxonomy, '', ', ', '') ) {
					$term_list .= $next_term;
					if ( current($taxonomies) ) $term_list .= ', ';
				}
			}
			$format = str_replace('%category', $term_list, $format);
		}

//		Optionally add the post thumbnail to the link. Wrap the link in a span to aid CSS styling.
		if ( $r['thumb'] && has_post_thumbnail($post->ID) ) {
			if ( $r['thumb'] === true ) // use 'post-thumbnail' as the default size
				$r['thumb'] = 'post-thumbnail';
			$thumbnail = '<a class="post-thumbnail" href="'.get_permalink($post).'" rel="'.$rel.'"'.$tooltip.'>' . get_the_post_thumbnail( $post->ID, $r['thumb'] ) . '</a>';
			$format = $thumbnail . '<span class="post-link">' . $format . '</span>';
		}

//		If more than one link is returned, wrap them in <li> tags		
		if ( intval($r['num_results']) > 1 )
			$format = '<li>' . $format . '</li>';
		
		$output .= $format;
	}

	$output .= $r['after'];

	//	If echo is false, don't display anything. Return the link as a PHP string.
	if ( !$r['echo'] )
		return $output;

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "{$adjacent}_post_link_plus", $output, $r );

	return true;
}
/*
Plugin Name: Previous and Next Post in Same Taxonomy
Plugin URI: http://core.trac.wordpress.org/ticket/17807
Description: Extends the prev/next links to let you limit to same taxonomy. Used for testing WP Core patch, and can be disabled if patch is committed to core.
Author: Bill Erickson
Version: 1.0
Author URI: http://www.billerickson.net
*/

add_action('wp_ajax_nextprevproject', 'ajaxnextprevproject');
add_action('wp_ajax_nopriv_nextprevproject', 'ajaxnextprevproject');
function ajaxnextprevproject(){
	if($_POST['projectid']){
		$ajaxprojectid = $_POST['projectid'];
	}else{
		$ajaxprojectid = $_GET['projectid'];
	}
	if(is_numeric($ajaxprojectid)){
		$ajaxprojectid = (int)$ajaxprojectid;
	}else{
		$ajaxprojectid = 0;
	}
	if($_POST['prevnext']){
		$ajaxprevnext = $_POST['prevnext'];
	}else{
		$ajaxprevnext = $_GET['prevnext'];
	}
	$tmpallvnodes = array();
	$nextprojectposts = new WP_Query(array('posts_per_page'=>-1,'orderby'=>'date','order' => 'DESC','post_type'=>array('portfolio'),'ignore_sticky_posts'=>1));
	if($nextprojectposts->post_count){
		/*$tmpprevnode = false;
		$tmpnextnode = false;
		$tmpislast = false;*/
		foreach($nextprojectposts->posts as $nextprojectpost){
			/*if($tmpislast){
				$tmpnextnode = $nextprojectpost;
				break;
			}else{
				if($nextprojectpost->ID == $ajaxprojectid){
					$tmpislast = true;
				}else{
					$tmpprevnode = $nextprojectpost;
				}
			}*/
			if(/*$ajaxprevnext == "this" ||*/ get_post_meta($nextprojectpost->ID, 'Title', true)){
				$tmpallvnodes[] = $nextprojectpost;
			}
		}
		/*if(!$tmpprevnode){
			$tmpprevnode = end($nextprojectposts->posts);
		}
		if(!$tmpnextnode){
			$tmpnextnode = reset($nextprojectposts->posts);
		}*/
		if(count($tmpallvnodes)){
			$tmpvnodeindex = -1;
			for($tmpi=0;$tmpi<count($tmpallvnodes);$tmpi++){
				if($tmpallvnodes[$tmpi]->ID == $ajaxprojectid){
					$tmpvnodeindex = $tmpi;
					break;
				}
			}
			$tmplupnode = false;
			if($tmpvnodeindex == -1){
				if($ajaxprevnext == "this"){
					if(count($tmpallvnodes) == 1){
						$tmplupnode = $tmpallvnodes[0];
					}else{
						$tmplupnode = $tmpallvnodes[(int)floor(rand(0,count($tmpallvnodes)-1))];
					}
				}else{
					$tmplupnode = $tmpallvnodes[0];
				}
			}else{
				if($ajaxprevnext == "prev"){
					//$tmplupnode = $tmpprevnode;
					if($tmpvnodeindex == 0){
						$tmplupnode = $tmpallvnodes[count($tmpallvnodes)-1];
					}else{
						$tmplupnode = $tmpallvnodes[$tmpvnodeindex-1];
					}
				}else if($ajaxprevnext == "next"){
					//$tmplupnode = $tmpnextnode;
					if($tmpvnodeindex == (count($tmpallvnodes)-1)){
						$tmplupnode = $tmpallvnodes[0];
					}else{
						$tmplupnode = $tmpallvnodes[$tmpvnodeindex+1];
					}
				}else{ //"this"
					$tmplupnode = $tmpallvnodes[$tmpvnodeindex];
				}
			}
			if($tmplupnode){
				$post_cat = array();
				$post_cat = wp_get_object_terms($tmplupnode->ID, "portfolio_category");
				$post_cats = array();
				for($tmph=0;$tmph<count($post_cat);$tmph++){
					$post_cats[] = $post_cat[$tmph]->name;
				}
				$tmpddtitle = json_encode(get_post_meta($tmplupnode->ID, 'Title', true));
				if(!$tmpddtitle)
					$tmpddtitle = "\"\"";
				$tmpdddesc = json_encode(preg_replace('/\s+/', ' ', trim(get_post_meta($tmplupnode->ID, 'Description', true))));
				if(!$tmpdddesc)
					$tmpdddesc = "\"\"";
				$tmpdddate = json_encode(get_post_meta($tmplupnode->ID, 'portfolio_date', true));
				if(!$tmpdddate)
					$tmpdddate = "\"\"";
				$tmpddclient = json_encode(get_post_meta($tmplupnode->ID, 'portfolio_client', true));
				if(!$tmpddclient)
					$tmpddclient = "\"\"";
				$tmpddagency = json_encode(get_post_meta($tmplupnode->ID, 'portfolio_agency', true));
				if(!$tmpddagency)
					$tmpddagency = "\"\"";
				$tmpddcontent = json_encode(do_shortcode($tmplupnode->post_content));
				if(!$tmpddcontent)
					$tmpddcontent = "\"\"";
				$tmpddbgimage = json_encode(get_post_meta($tmplupnode->ID, 'bg_image', true));
				if(!$tmpddbgimage)
					$tmpddbgimage = "\"\"";
				$tmpddpostname = json_encode($tmplupnode->post_name);
				if(!$tmpddpostname)
					$tmpddpostname = "\"\"";
				//$tmpddtxtcolor = json_encode(get_post_meta($tmplupnode->ID, 'portfolio_text_color', true));
				$tmpddtxtcolor = '"#ffffff"';
				if(!$tmpddtxtcolor)
					$tmpddtxtcolor = "\"\"";
				$tmpddourrole = json_encode(get_post_meta($tmplupnode->ID, 'portfolio_ourrole', true));
				if(!$tmpddourrole)
					$tmpddourrole = "\"\"";
				$tmpddcates = "";
				if(count($post_cats)){
					for($tmph=0;$tmph<count($post_cats);$tmph++){
						if($post_cats[$tmph]){
							if($tmpddcates)
								$tmpddcates .= ", ";
							$tmpddcates .= json_encode($post_cats[$tmph]);
						}
					}
					if($tmpddcates)
						$tmpddcates = "[".$tmpddcates."]";
				}
				if(!$tmpddcates)
					$tmpddcates = "[]";
				print("{\"projectid\": ".$tmplupnode->ID.", \"title\": ".$tmpddtitle.", \"desc\": ".$tmpdddesc.", \"date\": ".$tmpdddate.", \"client\": ".$tmpddclient.", \"agency\": ".$tmpddagency.", \"bgimage\": ".$tmpddbgimage.", \"content\": ".$tmpddcontent.", \"categories\": ".$tmpddcates.", \"postname\": ".$tmpddpostname.", \"txtcolor\": ".$tmpddtxtcolor.", \"ourrole\": ".$tmpddourrole."}");
			}else{
				print("{\"projectid\": ".$ajaxprojectid.", \"title\": \"Not Found\", \"desc\": \"Sorry, but you are looking for something that isn't here.\", \"date\": \"".date("d.m.Y")."\", \"client\": \"-\", \"agency\": \"-\", \"bgimage\": \"\", \"content\": \"\", \"categories\": [], \"postname\": \"404\", \"txtcolor\": \"\", \"ourrole\": \"\"}");
			}
		}else{
			print("{\"err\": true, \"errmsg\":\"no valid projects\"}");
		}
	}else{
		print("{\"err\": true, \"errmsg\":\"array is empty\"}");
	}
	//ob_flush();
	//flush();
	exit;
}
function improved_trim_excerpt($text) {
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    $text = strip_tags($text, '<a>');
    $excerpt_length = 55;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, '[...]');
      $text = implode(' ', $words);
    }
  }
return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

add_action('generate_rewrite_rules', 'ta_add_rewrite_rules');
function ta_add_rewrite_rules( $wp_rewrite ) {
 $new_rules = array('portfolio/([^/]+)/?$' => 'index.php?portfolio=$matches[1]');
 $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
function flowthemes_konzept_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
<div class="comment-left-column">
      <div class="comment-author vcard clearfix">
         <?php echo get_avatar( $comment->comment_author_email, 48 ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
</div>
<div class="comment-right-column">
      <?php comment_text() ?>
	  
	  <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
</div>
     </div>
<?php
        }
		add_action('after_setup_theme', 'flowthemes_languages_setup');
function flowthemes_languages_setup(){
    load_theme_textdomain('flowthemes', get_template_directory() . '/languages');
}
function cp_admin_init() {
if (!session_id())
session_start();
}

add_action('init', 'cp_admin_init');
?>