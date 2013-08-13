<?php

	if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
	
	include_once locate_template('/inc/activation.php');            // Activations functions
	include_once locate_template('/inc/config.php');          // Configuration and constants
	include_once locate_template('/inc/cleanup.php');         // Cleanup
	include_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
	include_once locate_template('/inc/hooks.php');           // Hooks
	include_once locate_template('/inc/actions.php');         // Actions
	include_once locate_template('/inc/widgets.php');         // Sidebars and widgets
	include_once locate_template('/inc/custom.php');          // Custom functions
	include_once locate_template('/inc/theme_options.php');  	// Admin functions
	include_once locate_template('/inc/pirenko_scodes/shortcodes.php');  	// Shortcodes
	include_once locate_template('/inc/theme_update.php');  	// Update checker
	
	function pixia_setup() {
	
		// Make theme available for translation
		load_theme_textdomain('pixia', get_template_directory() . '/lang');
		
		//ADD THE DEFAULT LOCATIONS IF NECESSARY
		if ( is_nav_menu( 'Top Left Navigation'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			register_nav_menus(array(
			'top_left_navigation' => __('Top Left Navigation', 'pixia')));
		}
		//THIS MENU IS MANDATORY!
		if ( is_nav_menu( 'Pixia Main Menu'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			//ADD THE DEFAULT FOOTER MENU
			$name = 'Pixia Main Menu';
			$menu_id = wp_create_nav_menu($name);
			$menu = get_term_by( 'name', $name, 'nav_menu' );
			//ASSIGN THE MENU TO THE DEFAULT LOCATION
			$locations = get_theme_mod('nav_menu_locations');
			$locations['top_left_navigation'] = $menu->term_id;
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
	
	add_action('after_setup_theme', 'pixia_setup');
	
	//-------------------------
	//CREATE SLIDES CUSTOM TYPE
	//-------------------------
	function slides_register() 
	{
 
		$labels = array(
			'name' => _x('Slides', 'post type general name', 'pixia'),
			'singular_name' => _x('Slide', 'post type singular name', 'pixia'),
			'add_new' => _x('Add New Slide', 'slides item', 'pixia'),
			'add_new_item' => __('Add New Slide', 'pixia'),
			'edit_item' => __('Edit Slide', 'pixia'),
			'new_item' => __('New Slide', 'pixia'),
			'view_item' => __('View Slide', 'pixia'),
			'search_items' => __('Search Slides', 'pixia'),
			'not_found' =>  __('Nothing found', 'pixia'),
			'not_found_in_trash' => __('Nothing found in Trash', 'pixia'),
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
	function pixia_slides_add_custom_box() 
	{
		add_meta_box( 
			'myplugin_sectionid',
			__( 'Pixia Slides Custom Options', 'pixia' ),
			'pixia_slides_custom_box',
			'pirenko_slides' 
		);
	}
	add_action( 'add_meta_boxes', 'pixia_slides_add_custom_box' );
	
	function pixia_slides_custom_box( $post ) 
	{	
		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
		// The actual fields for data entry
		
		//SHOW TEXT
		echo '<label for="pixia_show_txt">';
		global $post;
		$mm_helper="";
		$new_value = get_post_meta($post->ID, 'pixia_slide_txt', true);
		if (isset($new_value ))
		{
			if ($new_value==1 || $new_value=="") 
				$mm_helper='CHECKED';
		}
		else
			$mm_helper='CHECKED';
		?>
		<div class="form-field form-required">
			<label for="pixia_slide_txt">Show title and post content text?
			<input type="hidden" name="pixia_slide_txt" value="0" />
			<input type="checkbox" style="width:50px" name="pixia_slide_txt" value="1" <?php echo $mm_helper; ?> /></label>
		</div>
		<?php
			//TEXT POSITION
			//HORIZONTAL
			global $horz_options;
			$horz_options = array(
			'left' => array(
			'value' => 'left',
			'label' => __( 'Left', 'pixiatheme' )
			),
			'right' => array(
			'value' => 'right',
			'label' => __( 'Right', 'pixiatheme' )
			));
			?>
            <br  />
			<label for="pixia_slide_txt">Text horizontal position:</label>
			<select id="" name="pixia_slide_txt_horz" class="">
				<?php   
				global $post; 
				$new_value = get_post_meta($post->ID, 'pixia_slide_txt_horz', true);
				foreach ( $horz_options as $horz_option ) 
				{
					$label = $horz_option['label'];
					if ( $new_value == $horz_option['value'] ) // Make default first in list
						echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $horz_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $horz_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
			<?php
			//VERTICAL
			global $vert_options;
			$vert_options = array(
			'top' => array(
			'value' => 'top',
			'label' => __( 'Top', 'pixiatheme' )
			),
			'bottom' => array(
			'value' => 'bottom',
			'label' => __( 'Bottom', 'pixiatheme' )
			));
			?>
			<label for="pixia_slide_txt">Text vertical position:</label>
			<select id="" name="pixia_slide_txt_vert" class="">
				<?php   
				global $post; 
				$new_value = get_post_meta($post->ID, 'pixia_slide_txt_vert', true);
				foreach ( $vert_options as $vert_option ) 
				{
					$label = $vert_option['label'];
					if ( $new_value == $vert_option['value'] ) // Make default first in list
						echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $vert_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $vert_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
            <?php 
				global $post;
				$pixia_slide_header_color = get_post_meta($post->ID, 'pixia_slide_header_color', true);
				$pixia_slide_body_color = get_post_meta($post->ID, 'pixia_slide_body_color', true);
			?>
            <br /><br />
            <label for="pixia_slide_header_color" style="width: 75px;display: inline-block;">Title color:</label>
            <input name="pixia_slide_header_color" id="pixia_slide_header_color" type="text" value="<?php echo( $pixia_slide_header_color ); ?>" /><em style="color:#666666;">&nbsp;Example:#000000</em>
            <br /><br />
            <label for="pixia_slide_header_color" style="width: 75px;display: inline-block;">Body color:</label>
            <input name="pixia_slide_body_color" id="pixia_slide_body_color" type="text" value="<?php echo( $pixia_slide_body_color ); ?>" /><em style="color:#666666;">&nbsp;Example:#000000</em>
            <br /><br />
			<?php
            //VIDEO
            echo '<br><label for="pixia_video">';
            _e("Video HTML code", 'pixia_video_code' );
            echo '</label><em> (optional)</em>';
            $new_value = get_post_meta($post->ID, 'pixia_slide_video', true);
            echo '<div class="form-field form-required"><input type="text" id="pixia_slide_video" name="pixia_slide_video" value="' .   esc_html($new_value)  . '" size="" /></div><br><br>';
            
            //EXTERNAL LINK
            echo '<label for="pixia_slides_url">';
            _e("Open this link when slide is clicked", 'pixia_url_code' );
            echo '</label><em> (optional)</em>';
            global $post;
            $new_value_url = get_post_meta($post->ID, 'pixia_slide_url', true);
            echo '<div class="form-field form-required"><input type="text" id="pixia_slide_url" name="pixia_slide_url" value="' . esc_html($new_value_url)  . '" size="" /></div>';
			//TARGET WINDOW
			global $wdw_options;
			$wdw_options = array(
			'_self' => array(
			'value' => '_self',
			'label' => __( 'Same window', 'pixiatheme' )
			),
			'_blank' => array(
			'value' => '_blank',
			'label' => __( 'New Window', 'pixiatheme' )
			));
			?>
            <br />
			<label for="pixia_slide_txt">Open link on which window/tab?
			<select id="" name="pixia_slide_wdw" class="">
				<?php   
				global $post; 
				$new_value = get_post_meta($post->ID, 'pixia_slide_wdw', true);
				foreach ( $wdw_options as $wdw_option ) 
				{
					$label = $wdw_option['label'];
					if ( $new_value == $wdw_option['value'] ) // Make default first in list
						echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $wdw_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $wdw_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
            <?php
		}

	//SAVE SLIDE CUSTOM DATA
	function pixia_slides_save_postdata( $post_id ) 
	{
		//CHECK PERMISSIONS
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		//SAVE DATA
		
		if (isset($_POST['pixia_slide_txt_horz']))
		{
			$mydata = $_POST['pixia_slide_txt_horz'];	  
			update_post_meta($post_id,'pixia_slide_txt_horz',$mydata);
		}
		if (isset($_POST['pixia_slide_txt_vert']))
		{
			$mydata = $_POST['pixia_slide_txt_vert'];	  
			update_post_meta($post_id,'pixia_slide_txt_vert',$mydata);
		}
		if (isset($_POST['pixia_slide_txt']))
		{
			$mydata = $_POST['pixia_slide_txt'];	  
			update_post_meta($post_id,'pixia_slide_txt',$mydata);
		}
		if (isset($_POST['pixia_slide_header_color']))
		{
			$mydata = $_POST['pixia_slide_header_color'];	
			if ($mydata!="" && $mydata[0] != '#')
				$mydata='#'.$mydata;
			update_post_meta($post_id,'pixia_slide_header_color',$mydata);
		}
		if (isset($_POST['pixia_slide_body_color']))
		{
			$mydata = $_POST['pixia_slide_body_color'];	
			if ($mydata!="" && $mydata[0] != '#')
				$mydata='#'.$mydata;  
			update_post_meta($post_id,'pixia_slide_body_color',$mydata);
		}
		if (isset($_POST['pixia_slide_video']))
		{
			$mydata = $_POST['pixia_slide_video'];	  
			update_post_meta($post_id,'pixia_slide_video',$mydata);
		}
		if (isset($_POST['pixia_slide_url']))
		{
			$mydataurl = $_POST['pixia_slide_url'];	  
			update_post_meta($post_id,'pixia_slide_url',$mydataurl);
		}
		if (isset($_POST['pixia_slide_wdw']))
		{
			$mydataurl = $_POST['pixia_slide_wdw'];	  
			update_post_meta($post_id,'pixia_slide_wdw',$mydataurl);
		}
	}
	add_action( 'save_post', 'pixia_slides_save_postdata' );

	//CREATE SLIDER ITEMS POST TYPE
	add_action('init', 'slides_register');
	
	//ADD TAXONOMIES FOR SLIDES
	$labels_pir_categories = array(
		'name' => __('Groups', 'post type general name', 'pixia'),
		'all_items' => __('All Groups', 'all items', 'pixia'),
		'add_new_item' => __('Add New Group', 'adding a new item', 'pixia'),
		'new_item_name' => __('New Group Name', 'adding a new item', 'pixia'),
		'edit_item' => __("Edit Group", "pixiatheme")
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
			'add_new_item' => __('Add Portfolio Item', 'pixia'),
			'edit_item' => __('Edit Portfolio Item', 'pixia'),
			'new_item' => __('New Portfolio Item', 'pixia'),
			'view_item' => __('Preview Portfolio Item', 'pixia'),
			'search_items' => __('Search Portfolio Items', 'pixia'),
			'not_found' => __('No Portfolio items found.', 'pixia'),
			'not_found_in_trash' => __('No Portfolio items found in Trash.', 'pixia')
		);	
		
		register_post_type('pirenko_portfolios', array(
			'label' => __('Portfolio Items', 'pixia'),
			'singular_label' => __('Portfolio Item', 'pixia'),
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
		'name' => __('Skills', 'post type general name', 'pixia'),
		'all_items' => __('All Skills', 'all items', 'pixia'),
		'add_new_item' => __('Add New Skill', 'adding a new item', 'pixia'),
		'new_item_name' => __('New Skill Name', 'adding a new item', 'pixia'),
		'edit_item' => __("Edit Skill", "pixiatheme")
	);

	$args_pir_categories = array(
		'labels' => $labels_pir_categories,
		'rewrite' => array('slug' => 'skills'),
		'hierarchical' => true
	);	
	
	register_taxonomy( 'pirenko_skills', 'pirenko_portfolios', $args_pir_categories );
	//ADD TAXONOMIES SIMILAR TO TAGS
	  $labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'pixia' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'pixia' ),
		'search_items' =>  __( 'Search Tags', 'pixia' ),
		'popular_items' => __( 'Popular Tags', 'pixia' ),
		'all_items' => __( 'All Tags', 'pixia' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag', 'pixia' ), 
		'update_item' => __( 'Update Tag', 'pixia' ),
		'add_new_item' => __( 'Add New Tag', 'pixia' ),
		'new_item_name' => __( 'New Tag Name', 'pixia' ),
		'separate_items_with_commas' => __( 'Separate Tags with commas', 'pixia' ),
		'add_or_remove_items' => __( 'Add or remove Tags', 'pixia' ),
		'choose_from_most_used' => __( 'Choose from the most used Tags', 'pixia' ),
		'menu_name' => __( 'Tags', 'pixia' ),
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
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/setup.php');
	//ADD METABOXES FOR PORTFOLIO ITEMS
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/portfolio-spec.php');
	//ADD METABOXES FOR SPECIAL PAGES
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/template-portfolio-spec.php');
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/template-blog-spec.php');
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/template-homepage-spec.php');
	include_once locate_template('inc/plugins/wpalchemy/metaboxes/reg-page-spec.php');
	
	//Redirect to Theme Options Page on Activation
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" )
		wp_redirect( 'themes.php?page=theme_options' );
		
	//THEME CHECK WARNINGS REMOVAL
	add_theme_support( 'automatic-feed-links' );
	//FONT MANIPULATION
	function is_google_font($variable_val)
	{
		if ($variable_val!="courier_new" && $variable_val!="helvetica" && $variable_val!="Arial" && $variable_val!="bebas_neue") {
			return true;
		}
		else {
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
	
	//POST LIKE FEATURE
	
	$timebeforerevote = 60;

	add_action('wp_ajax_nopriv_post-like', 'post_like');
	add_action('wp_ajax_post-like', 'post_like');
	
	
	
	function post_like()
	{
		$nonce = $_POST['nonce'];
	 
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');
			
		if(isset($_POST['post_like']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];
			
			$meta_IP = get_post_meta($post_id, "voted_IP");
			if (empty($meta_IP))
					$meta_IP[0]="";
			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP))
				$voted_IP = array();
			
			$meta_count = get_post_meta($post_id, "votes_count", true);
	
			if(!hasAlreadyVoted($post_id))
			{
				$voted_IP[$ip] = time();
	
				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);
				
				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}
	
	function hasAlreadyVoted($post_id)
	{
		global $timebeforerevote;
	
		$meta_IP = get_post_meta($post_id, "voted_IP");
		if (empty($meta_IP))
			$meta_IP[0]="";
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP))
			$voted_IP = array();
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if(in_array($ip, array_keys($voted_IP)))
		{
			$time = $voted_IP[$ip];
			$now = time();
			
			if(round(($now - $time) / 60) > $timebeforerevote)
				return false;
				
			return true;
		}
		
		return false;
	}
	
	function getPostLikeLink($post_id)
	{
		global $pixia_frontend_options; 
		$pixia_frontend_options=get_option('pixia_theme_options');
		$themename = "pixia";
		$heart_color=alter_brightness("#".$pixia_frontend_options['inactive_color'],40);
		$vote_count = get_post_meta($post_id, "votes_count", true);
		if ($vote_count=="")
			$vote_count=0;
		$output = '<div class="post-like">';
		if(hasAlreadyVoted($post_id))
		{
			$heart_color="#ff3030";
		}
		if(hasAlreadyVoted($post_id))
			$output .= ' 	<a href="#" pir_title="'.__('You already liked this', $themename).'" class="pir_like alreadyvoted">
								<div class="tr_wrapper" style="z-index:0;margin-top:2px;margin-left:-6px;">
									<div class="submenu_heart pirenko_tinted">
										<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $heart_color .'" src="'.get_bloginfo('template_url').'/images/icons/various_icons.png" />
									</div>
								</div>
								<span class="count masonr_inactive" style="margin-left:28px;top:1px;position:relative;">'.$vote_count.'</span>
						</a>';
		else
			$output .= '<a href="#" data-post_id="'.$post_id.'" pir_title="'.__('I like this!', $themename).'">
							<div class="tr_wrapper" style="z-index:0;margin-top:2px;margin-left:-6px;">
                            	<div class="submenu_heart pirenko_tinted">
                                	<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $heart_color .'" src="'.get_bloginfo('template_url').'/images/icons/various_icons.png" />
                               	</div>
                        	</div>
							<span class="count masonr_inactive" style="margin-left:28px;top:1px;position:relative;">'.$vote_count.'</span>
					</a>';
		
		$output .= '</div>';
		return $output;
	}
	function getblogLikeLink($post_id)
	{
		global $pixia_frontend_options; 
		$pixia_frontend_options=get_option('pixia_theme_options');
		$heart_color=alter_brightness("#".$pixia_frontend_options['inactive_color'],40);
		$themename = "pixia";
	
		$vote_count = get_post_meta($post_id, "votes_count", true);
		if ($vote_count=="")
			$vote_count=0;
		$output = '<div class="post-like">';
		$add_this_class="";
		$tip_txt="I like this!";
		if(hasAlreadyVoted($post_id))
		{
			$add_this_class="pir_like alreadyvoted";
			$tip_txt="You already liked this";
			$heart_color="#ff3030";
		}
			$output .= ' 	<a href="#" data-post_id="'.$post_id.'" class="like-link" pir_title="'.__($tip_txt, $themename).'" class="'.$add_this_class.'">
								<div class="tr_wrapper" style="height:20px;top:1px;left:2px;z-index:0;">
									<div class="submenu_heart pirenko_tinted">
										<img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'. $heart_color .'" src="'.get_bloginfo('template_url').'/images/icons/various_icons.png" />
									</div>
								</div>
								<span class="count masonr_inactive">'.$vote_count.'</span>
						</a>';
		$output .= '</div>';
		return $output;
	}
	//ADD PAGE SLUGS ON NAV ID'S - USEFULL FOR PORTFOLIO FILTERS
	function nav_id_filter( $id, $item ) {
	if (strpos($item->url,'/?') == true) 
	{
		//WE ARE USING THE DEFAULT PERMALINK SYSTEM
		//GRAB WHAT'S AFTER THE = SIGN
		$parts = substr(strrchr($item->url, "="), 1);
		return 'nav-'.$parts;
	}
	else
		return 'nav-'.basename($item->url);
	}
	add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );
	
	function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;
	}
	
	//FUNCTION TO GET SLUG PASSING AN ID
	function the_slug( $id ) {
		$post_data = get_post($id, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}

?>