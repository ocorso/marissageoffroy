<?php

	if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
	
	include_once locate_template('/inc/activation.php');            // Activations functions
	include_once locate_template('/inc/config.php');          // Configuration and constants
	include_once locate_template('/inc/cleanup.php');         // Cleanup
	include_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
	include_once locate_template('/inc/htaccess.php');        // Rewrites for assets, H5BP .htaccess
	include_once locate_template('/inc/hooks.php');           // Hooks
	include_once locate_template('/inc/actions.php');         // Actions
	include_once locate_template('/inc/widgets.php');         // Sidebars and widgets
	include_once locate_template('/inc/custom.php');          // Custom functions
	include_once locate_template('/inc/theme_options.php');  	// Admin functions
	include_once locate_template('/inc/shortcodes.php');  	// Shortcodes
	include_once locate_template('/inc/theme_update.php');  	// Update checker
	
	function queed_setup() {
	
		// Make theme available for translation
		load_theme_textdomain('queed', get_template_directory() . '/lang');
		
		//ADD THE DEFAULT LOCATIONS IF NECESSARY
		if ( is_nav_menu( 'Top Left Navigation'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			register_nav_menus(array(
			'top_left_navigation' => __('Top Left Navigation', 'queed')));
		}
		if ( is_nav_menu( 'Top Right Navigation'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
		  register_nav_menus(array(
			'top_right_navigation' => __('Top Right Navigation', 'queed')));
		}
		if ( is_nav_menu( 'Footer Navigation'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			register_nav_menus(array(
			'footer_navigation' => __('Footer Navigation', 'queed')));
		}
		//THIS MENU IS MANDATORY!
		if ( is_nav_menu( 'Queed Footer Menu'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			//ADD THE DEFAULT FOOTER MENU
			$name = 'Queed Footer Menu';
			$menu_id = wp_create_nav_menu($name);
			$menu = get_term_by( 'name', $name, 'nav_menu' );
			//ASSIGN THE MENU TO THE DEFAULT LOCATION
			$locations = get_theme_mod('nav_menu_locations');
			$locations['footer_navigation'] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
			//ADD THE HOMEPAGE BUTTON
			$menu = 
				array( 
					'menu-item-type' => 'custom', 
					'menu-item-url' => site_url(),
					'menu-item-title' => 'Home',
					'menu-item-status' => 'publish'
				);
			wp_update_nav_menu_item( $menu_id, 0, $menu );
		}
		
	  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	  add_theme_support('post-thumbnails');
	
	
	  // Tell the TinyMCE editor to use a custom stylesheet
	  add_editor_style('css/editor-style.css');
	
	}
	
	add_action('after_setup_theme', 'queed_setup');
	
	
		
		//-------------------------
		//CREATE SLIDES CUSTOM TYPE
		//-------------------------
		function slides_register() 
		{
	 
			$labels = array(
				'name' => _x('Slides', 'post type general name', 'queed'),
				'singular_name' => _x('Slide', 'post type singular name', 'queed'),
				'add_new' => _x('Add New Slide', 'slides item', 'queed'),
				'add_new_item' => __('Add New Slide', 'queed'),
				'edit_item' => __('Edit Slide', 'queed'),
				'new_item' => __('New Slide', 'queed'),
				'view_item' => __('View Slide', 'queed'),
				'search_items' => __('Search Slides', 'queed'),
				'not_found' =>  __('Nothing found', 'queed'),
				'not_found_in_trash' => __('Nothing found in Trash', 'queed'),
				'parent_item_colon' => ''
			);
	 
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/menu.png',
				'rewrite' => array('slug' => 'slides'),
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail')
			); 
			register_post_type( 'pirenko_slides' , $args );
		}
		
		//ADD MORE COLUMNS FOR THE DASHBOARD VIEW
		
		//ADD HOOKS
		add_filter('manage_pirenko_slides_posts_columns', 'pirenko_columns_head_only_slides', 10);
		add_action('manage_pirenko_slides_posts_custom_column', 'pirenko_columns_content_only_slides', 10, 2);
		//FUNCTION TO RETRIEVE FEATURED IMAGE
		function pirenko_get_featured_image($post_ID) 
		{
			$post_thumbnail_id = get_post_thumbnail_id($post_ID);
			if ($post_thumbnail_id) 
			{
				$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
				return $post_thumbnail_img[0];
			}
		}
		//RESORT COLUMNS
		function pirenko_columns_head_only_slides($defaults) 
		{
			unset($defaults['date']);
			$defaults['set']="Group";
			$defaults['featured_image'] = 'Featured Image';
			$defaults['date']="Date";
			return $defaults;
		}
		//FILL SPECIAL COLUMNS
		function pirenko_columns_content_only_slides($column_name, $post_ID) 
		{
			global $post;
			if ($column_name == 'featured_image') 
			{  
				$post_featured_image = pirenko_get_featured_image($post_ID);  
				if ($post_featured_image) {  
					// HAS A FEATURED IMAGE  
					echo '<img class="slides_image_preview" src="' . $post_featured_image . '" />';  
				}  
				else {  
					// NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
					echo ("No image");
				}  
			}
			if ($column_name == 'set') 
			{ 
			{
					$terms = get_the_terms( $post_ID, 'pirenko_slide_set' );
					if ( !empty( $terms ) ) 
					{
						$out = array();
						foreach ( $terms as $term ) 
						{
							$out[] = sprintf( '<a href="%s">%s</a>',
								esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'pirenko_slide_set' => $term->slug ), 'edit.php' ) ),
								esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'pirenko_slide_set', 'display' ) )
							);
						}
						//JOIN THE TERMS SEPARATED BY A COMMA
						echo join( ', ', $out );	
					}
				}
			}
		}
	
	
		//ADD CUSTOM OPTIONS ON THE BACKEND PANEL FOR SLIDE TYPE
		function queed_slides_add_custom_box() 
		{
			add_meta_box( 
				'myplugin_sectionid',
				__( 'Queed Slides Custom Options', 'queed' ),
				'queed_slides_custom_box',
				'pirenko_slides' 
			);
		}
		add_action( 'add_meta_boxes', 'queed_slides_add_custom_box' );
		
		function queed_slides_custom_box( $post ) 
		{	
			// Use nonce for verification
			wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
			// The actual fields for data entry
			
			//VIDEO
			echo '<label for="queed_video">';
			_e("Video HTML code", 'queed_video_code' );
			echo '</label><em> (optional)</em>';
			global $post;
			$new_value = get_post_meta($post->ID, 'queed_slide_video', true);
			echo '<div class="form-field form-required"><input type="text" id="queed_slide_video" name="queed_slide_video" value="' .   esc_html($new_value)  . '" size="" /></div><br><br>';
			
			//EXTERNAL LINK
			echo '<label for="queed_slides_url">';
			_e("Open this link when slide is clicked", 'queed_url_code' );
			echo '</label><em> (optional)</em>';
			global $post;
			$new_value_url = get_post_meta($post->ID, 'queed_slide_url', true);
			echo '<div class="form-field form-required"><input type="text" id="queed_slide_url" name="queed_slide_url" value="' . esc_html($new_value_url)  . '" size="" /></div>';
		}
	
		//SAVE SLIDE CUSTOM DATA
		function queed_slides_save_postdata( $post_id ) 
		{
			//CHECK PERMISSIONS
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
				return;
			//SAVE DATA
			if (isset($_POST['queed_slide_video']))
			{
				$mydata = $_POST['queed_slide_video'];	  
				update_post_meta($post_id,'queed_slide_video',$mydata);
			}
			if (isset($_POST['queed_slide_url']))
			{
				$mydataurl = $_POST['queed_slide_url'];	  
				update_post_meta($post_id,'queed_slide_url',$mydataurl);
			}
		}
		add_action( 'save_post', 'queed_slides_save_postdata' );
	
		//CREATE SLIDER ITEMS POST TYPE
		add_action('init', 'slides_register');
		
		//ADD TAXONOMIES FOR SLIDES
		$labels_pir_categories = array(
			'name' => __('Groups', 'post type general name', 'queed'),
			'all_items' => __('All Groups', 'all items', 'queed'),
			'add_new_item' => __('Add New Group', 'adding a new item', 'queed'),
			'new_item_name' => __('New Group Name', 'adding a new item', 'queed'),
			'edit_item' => __("Edit Group", "queedtheme")
		);
	
		$args_pir_categories = array(
			'labels' => $labels_pir_categories,
			'rewrite' => array('slug' => 'set'),
			'hierarchical' => true
		);
		
		register_taxonomy( 'pirenko_slide_set', 'pirenko_slides', $args_pir_categories );
		
		//-------------------------
		//CREATE PORTFOLIO CUSTOM TYPE
		//-------------------------
		function portfolio_register() 
		{
			$labels = array(
				'add_new_item' => __('Add Portfolio Item', 'queed'),
				'edit_item' => __('Edit Portfolio Item', 'queed'),
				'new_item' => __('New Portfolio Item', 'queed'),
				'view_item' => __('Preview Portfolio Item', 'queed'),
				'search_items' => __('Search Portfolio Items', 'queed'),
				'not_found' => __('No Portfolio items found.', 'queed'),
				'not_found_in_trash' => __('No Portfolio items found in Trash.', 'queed')
			);	
			
			register_post_type('pirenko_portfolios', array(
				'label' => __('Portfolio Items', 'queed'),
				'singular_label' => __('Portfolio Item', 'queed'),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => 'portfolios'),
				'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments','custom-fields'), // Let's use custom fields for debugging purposes only
				'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/portfolio.png',
			));
			flush_rewrite_rules();
		}
		add_action('init', 'portfolio_register');
		
		//ADD TAXONOMIES SIMILAR TO A CATEGORY
		$labels_pir_categories = array(
			'name' => __('Skills', 'post type general name', 'queed'),
			'all_items' => __('All Skills', 'all items', 'queed'),
			'add_new_item' => __('Add New Skill', 'adding a new item', 'queed'),
			'new_item_name' => __('New Skill Name', 'adding a new item', 'queed'),
			'edit_item' => __("Edit Skill", "queedtheme")
		);
	
		$args_pir_categories = array(
			'labels' => $labels_pir_categories,
			'rewrite' => array('slug' => 'skills'),
			'hierarchical' => true
		);	
		
		register_taxonomy( 'pirenko_skills', 'pirenko_portfolios', $args_pir_categories );
		//ADD TAXONOMIES SIMILAR TO TAGS
		  $labels = array(
			'name' => _x( 'Tags', 'taxonomy general name', 'queed' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'queed' ),
			'search_items' =>  __( 'Search Tags', 'queed' ),
			'popular_items' => __( 'Popular Tags', 'queed' ),
			'all_items' => __( 'All Tags', 'queed' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Tag', 'queed' ), 
			'update_item' => __( 'Update Tag', 'queed' ),
			'add_new_item' => __( 'Add New Tag', 'queed' ),
			'new_item_name' => __( 'New Tag Name', 'queed' ),
			'separate_items_with_commas' => __( 'Separate Tags with commas', 'queed' ),
			'add_or_remove_items' => __( 'Add or remove Tags', 'queed' ),
			'choose_from_most_used' => __( 'Choose from the most used Tags', 'queed' ),
			'menu_name' => __( 'Tags', 'queed' ),
		  ); 
		
		  register_taxonomy('portfolio_tag','pirenko_portfolios',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'tagged' ),
		  ));
		  
		//ADD METABOXES SUPPORT
		include_once 'inc/plugins/wpalchemy/metaboxes/setup.php';
		//ADD METABOXES FOR PORTFOLIO ITEMS
		include_once 'inc/plugins/wpalchemy/metaboxes/portfolio-spec.php';
		//ADD METABOXES FOR SPECIAL PAGES
		include_once 'inc/plugins/wpalchemy/metaboxes/template-portfolio-spec.php';
		include_once 'inc/plugins/wpalchemy/metaboxes/template-portfolio2c-spec.php';
		
		//Redirect to Theme Options Page on Activation
		if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" )
			wp_redirect( 'themes.php?page=theme_options' );
			
		//THEME CHECK WARNINGS REMOVAL
		add_theme_support( 'automatic-feed-links' );
		//FONT MANIPULATION
		function is_google_font($variable_val)
		{
			if ($variable_val!="bebas_neue" && $variable_val!="osp_din" && $variable_val!="league_gothic" && $variable_val!="Arial" && $variable_val!="novecento" && $variable_val!="novecento_bold")
			{
				return true;
			}
			else
			{
				return false;	
			}
		}
		//FIX FOR COMPATIBILITY MODE ON IE
		/*
	Plugin Name: Force IE Edge
	Description: Add an X-UA-Compatible header to WordPress
	Author: Christopher Davis
	Author URI: http://christopherdavis.me
	License: GPL2
		
		Copyright 2012 Christopher Davis
	
		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.
	
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
	
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/
	
	
	add_filter('wp_headers', 'cdfie_add_header');
	/*
	 * Adds a header to WordPress
	 *
	 * @return array Where header => header value
	 */
	function cdfie_add_header($headers)
	{
		$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
		return $headers;
	}
	
	//FUNCTION TO GET SLUG PASSING AN ID
	function the_slug( $id ) {
		$post_data = get_post($id, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}
?>