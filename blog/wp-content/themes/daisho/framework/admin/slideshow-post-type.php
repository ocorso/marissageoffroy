<?php
add_action('init', 'create_slideshow_post_type');
function create_slideshow_post_type(){
	register_post_type( 'slideshow',
		array(
			'labels' => array(
				'name' => _x( 'Slideshow', 'Slideshow post type general name', 'flowthemes'),
				'singular_name' => _x( 'Slideshow Item', 'Slideshow post type singular name', 'flowthemes'),
				'add_new' => _x('Add New Slide', 'Slideshow post type', 'flowthemes'),
				'add_new_item' => __('Add New Slide', 'flowthemes'),
				'edit_item' => __('Edit Slide', 'flowthemes'),
				'new_item' => __('New Slide', 'flowthemes'),
				'view_item' => __('View Slide', 'flowthemes'),
				'search_items' => __('Search Slides', 'flowthemes'),
				'not_found' =>  __('No slides found', 'flowthemes'),
				'not_found_in_trash' => __('No slides found in Trash', 'flowthemes'), 
				'parent_item_colon' => '',
				'menu_name' => _x('Slideshow', 'Slideshow menu name', 'flowthemes'),
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array('title', 'author', 'custom-fields', 'revisions', 'page-attributes', 'post-formats' ),
			'rewrite' => array('slug' => 'slideshow')
		)
	);
}
?>