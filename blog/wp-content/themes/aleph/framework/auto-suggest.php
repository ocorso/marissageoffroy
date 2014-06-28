<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Search form in panel
 *
 * /framework/auto-suggest.php
 * Version of this file : 1.0
 *
 */
?>

<?php
/*
/******* BASED ON THE FOLLOWING CODE *******/
/******* Demo: AJAX Search Suggest (WeAreHunted.com Style)
/******* Version 1.0
/******* Author: Ian Lunn
/******* Author URL: http://www.ianlunn.co.uk/
/******* Demo URL: http://www.ianlunn.co.uk/demos/ajax-search-suggest-wearehunted/
/******* Tutorial URL: http://www.ianlunn.co.uk/blog/code-tutorials/ajax-search-suggest-wearehunted/
/******* GitHub: https://github.com/IanLunn/AJAX-Search-Suggest--WeAreHunted.com-Style-/
/******* Dual licensed under the MIT and GPL licenses:
/******* http://www.opensource.org/licenses/mit-license.php
/******* http://www.gnu.org/licenses/gpl.html
/*******************************************/ 

define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');	

$posts = $wpdb->get_results( " SELECT DISTINCT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_title <> '' AND post_type = 'post'" );
$wpdb->flush();		
$data_post=array();
foreach ( $posts as $post )  { 
	$title=$post->post_title; 
	$id=$post->ID;
	$data_post[$title]=get_permalink($id);
}		

$pages = $wpdb->get_results( " SELECT DISTINCT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_title <> '' AND post_type = 'page'" );
$wpdb->flush();
$data_page=array();
foreach ( $pages as $page )  { 
	$title=$page->post_title; 
	$id=$page->ID;
	$level=get_post_meta($page->ID,'level','true'); 
	if($level=="top") {
		$data_page[$title]=array("#",get_permalink($id),"top");
	} elseif($level=="sub") {
		$data_page[$title]=array("#",get_permalink($id),"sub");	
	} else {
		$data_page[$title]=array("#",get_permalink($id),"none");	
	}
}

$portfolios = $wpdb->get_results( " SELECT DISTINCT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_title <> '' AND post_type = 'portfolio'" );
$wpdb->flush();
$data_portfolio=array();
foreach ( $portfolios as $portfolio )  { 
	$title=$portfolio->post_title; 
	$id=$portfolio->ID;
	$data_portfolio[$title]=get_permalink($id);
}

if(isset($_POST['latestQuery'])){ 
	$latestQuery = $_POST['latestQuery']; 
	$result = array();
	foreach($data_post as $name => $url){
		if (strpos (strtolower($name), strtolower($latestQuery)) !== false){ 
				$result[0][$name] = $url;
		}
	}
	
	foreach($data_page as $name => $info){
		if (strpos (strtolower($name), strtolower($latestQuery)) !== false){ 
				$result[1][$name] = $info;
		}
	}
	foreach($data_portfolio as $name => $url){
		if (strpos (strtolower($name), strtolower($latestQuery)) !== false){ 
				$result[2][$name] = $url;
		}
	}	
	echo json_encode($result);
}
?>