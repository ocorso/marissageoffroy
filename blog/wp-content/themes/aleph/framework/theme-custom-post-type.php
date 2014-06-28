<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file to create custom post type
 *
 * /framework/theme-custom-post-type.php
 * Version of this file : 1.1
 *
 *
 *	1. Portfolio
 *	1.1	Fields Taxonomy
 *	1.2 Custom columns
 *  1.3 Sort portfolio projects
 *  2. Sort menu pages
 *
 */
?>
<?php 
 
/**
 * ------------------------------------------------------------------------
 * 1.	Portfolio
 * ------------------------------------------------------------------------
 */ 
 	if ( ! function_exists( 'portfolio_init' ) ) :
		add_action('init','portfolio_init');
		function portfolio_init()  {  
			$labels = array(  
				'name' => _x('Portfolios', 'post type general name','alephtheme'),  
				'singular_name' => _x('Portfolio', 'post type singular name','alephtheme'),  
				'add_new' => _x('Add New', 'portfolio','alephtheme'),  
				'add_new_item' => __('Add New Portfolio', 'alephtheme'),  
				'edit_item' => __('Edit Portfolio', 'alephtheme' ),  
				'new_item' => __('New Portfolio', 'alephtheme' ),  
				'view_item' => __('View Portfolio', 'alephtheme' ),  
				'search_items' => __('Search Portfolios', 'alephtheme' ),  
				'not_found' =>  __('No portfolios found', 'alephtheme' ),  
				'not_found_in_trash' => __('No portfolios found in Trash', 'alephtheme' ),  
				'parent_item_colon' => '',  
				'menu_name' => 'Portfolios'  
					  );  
			$args = array(  
				'labels' => $labels,  
				'public' => true,  
				'publicly_queryable' => true,  
				'show_ui' => true,  
				'show_in_menu' => true,  
				'query_var' => true,  
				'exclude_from_search' => false,
				'rewrite' => array( 'slug' => 'portfolio','with_front' => FALSE),
				'capability_type' => 'post',  
				'hierarchical' => false, 
				'menu_position' => 10,  
				'supports' => array('title','editor','thumbnail','comments')  
						);  
		 
		 
			register_post_type('portfolio',$args);  
			flush_rewrite_rules();
		} 
	endif;

	if ( ! function_exists( 'portfolio_updated_messages' ) ) :
		add_filter('post_updated_messages', 'portfolio_updated_messages');  
		function portfolio_updated_messages( $messages ) {  
			global $post, $post_ID;  
		  
			$messages['portfolio'] = array(  
				0 => '', // Unused. Messages start at index 1.  
				1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>','alephtheme'), esc_url( get_permalink($post_ID) ) ),  
				2 => __('Custom field updated.', 'alephtheme' ),  
				3 => __('Custom field deleted.', 'alephtheme' ),  
				4 => __('Portfolio updated.', 'alephtheme' ),  
				/* translators: %s: date and time of the revision */  
				5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s','alephtheme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,  
				6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>','alephtheme'), esc_url( get_permalink($post_ID) ) ),  
				7 => __('Portfolio saved.','alephtheme'),  
				8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>','alephtheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),  
				9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>','alephtheme'),  
				  // translators: Publish box date format, see http://php.net/date  
				  date_i18n( __( 'M j, Y @ G:i' ,'alephtheme'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),  
				10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>','alephtheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),  
					);  
		  
			return $messages;  
		}  
	endif;

    /*--------------------------------
    //  1.1	Fields Taxonomy
    ----------------------------------*/
	$labels = array(  
			'name' => _x( 'Fields', 'taxonomy general name','alephtheme' ),  
			'singular_name' => _x( 'Field', 'taxonomy singular name','alephtheme' ),  
			'search_items' =>  __( 'Search Fields', 'alephtheme'  ),  
			'all_items' => __( 'All Fields', 'alephtheme'  ),  
			'parent_item' => __( 'Parent Field', 'alephtheme'  ),  
			'parent_item_colon' => __( 'Parent Fields:', 'alephtheme'  ),  
			'edit_item' => __( 'Edit Fields', 'alephtheme'  ),  
			'update_item' => __( 'Update Field', 'alephtheme' ),  
			'add_new_item' => __( 'Add New Field', 'alephtheme'  ),  
			'new_item_name' => __( 'New Field Name', 'alephtheme'  ),  
	  			);  
	register_taxonomy('field',array('portfolio','client'), array(  
			'hierarchical' => false,  
			'labels' => $labels,  
			'public' => true,  
			'publicly_queryable' => true,  
			'show_ui' => true,  
			'query_var' => true,  
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'field','with_front' => true ),  
	  ));  
	  flush_rewrite_rules();
	
    /*--------------------------------
    //  1.2 Custom columns
    ----------------------------------*/
	add_action("manage_posts_custom_column", "custom_portfolio_columns");
	add_filter("manage_edit-portfolio_columns", "portfolio_columns", 10, 1);

	function portfolio_columns($columns) {
		$columns = array(
			"cb" => "<input type='checkbox' />",
			'thumbnail' => 'Thumbnail',
			"title" => "Title",
			"field" => "Fields"
		);
		return $columns;
	}
	
	function custom_portfolio_columns($column)
	{
		global $post;
		if ("thumbnail"==$column) echo get_the_post_thumbnail( $post->ID, 'edit-screen-thumbnail' );
		elseif ("field" == $column) echo get_the_term_list($post->ID,'field','',', ');
	}
	
    /*--------------------------------
    //  1.3 Sort portfolio projects
    ----------------------------------*/
	function sorter_admin_scripts() {
		
		if ('edit.php' == basename($_SERVER['PHP_SELF'])) {
			$file_dir=get_template_directory_uri();
			wp_enqueue_style("styles", $file_dir ."/framework/admin/assets/css/post-sorter.css", false, "1.0", "all");
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script("post-sorter", $file_dir."/framework/admin/assets/js/post-sorter.js", array( 'jquery' ), "1.0");
			wp_enqueue_script("phtojkks", $file_dir."/framework/admin/assets/js/jquery.tools.min.js", array( 'jquery' ), "1.0");
		}
		
	}
	add_action('admin_enqueue_scripts', 'sorter_admin_scripts');
	
	/* ************************************
	* Sort it for the Display List too
	*************************************** */
	add_filter( 'posts_orderby', 'theme_port_orderby');
	function theme_port_orderby($orderby){
	global $wpdb;
	
	if (is_admin())
	$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
	
	return($orderby);
	}
	
	
	
	/* ************************************
	* Ajax Sort for Portfolio
	*************************************** */
	
	function enable_portfolio_sort() {
	    add_submenu_page('edit.php?post_type=portfolio', 'Sort Portfolio', 'Sort Portfolio Projects', 'edit_posts', basename(__FILE__), 'sort_portfolio');
	}
	add_action('admin_menu' , 'enable_portfolio_sort');
	
	 
	/**
	 * Display Sort admin
	 *
	 * @return void
	 * @author Soul
	 **/
	function sort_portfolio() {
		$portfolio = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
		<h2>Sort portfolio projects<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
		<div class="description">
		Drag and Drop the projects to order them
		</div>
		<ul id="portfolio-list">
		<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
			<li id="<?php the_id(); ?>">
			<div>
			<?php 
			$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );
			$custom = get_post_custom(get_the_ID());
			$portfolio_cats = get_the_terms( get_the_ID(), 'field' );
			
			?>
			<?php if ($image_url) { echo '<img class="theme_port_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
			</div>
			<div class="theme_port_desc">
			<span class="theme_port_admin_sort_title"><?php the_title(); ?></span>
			<span class="theme_port_admin_sort_categories"><?php if($portfolio_cats) { foreach ($portfolio_cats as $taxonomy) { echo $taxonomy->name .',  '; } } ?></span>
			</div>
			<div class="clear"></div>
			</li>
		<?php endwhile; ?>
		</div><!-- End div#wrap //-->
	 
	<?php
	}
	
	/**
	 * Upadate the portfolio Sort order
	 *
	 * @return void
	 * @author Soul
	 **/
	function save_portfolio_order() {
		global $wpdb; // WordPress database class
	 
		$order = explode(',', $_POST['order']);
		$counter = 0;
	 
		foreach ($order as $sort_id) {
			$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
			$counter++;
		}
		die(1);
	}
	add_action('wp_ajax_portfolio_sort', 'save_portfolio_order');
 
/**
 * ------------------------------------------------------------------------
 * 2.	Sort menu pages
 * ------------------------------------------------------------------------
 */ 
 	/* ************************************
	* Sort it for the Display List too
	*************************************** */
	add_filter( 'posts_orderby', 'theme_menu_orderby');
	function theme_menu_orderby($orderby){
	global $wpdb;
	
	if (is_admin())
	$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
	
	return($orderby);
	}
	
	
	
	/* ************************************
	* Ajax Sort for Menu
	*************************************** */
	
	function enable_toppage_sort() {
	    add_submenu_page('edit.php?post_type=page', 'Sort Top Level pages', 'Sort Top Level Pages', 'edit_posts', basename(__FILE__), 'sort_toppage');
	}
	add_action('admin_menu' , 'enable_toppage_sort');
	
	 
	/**
	 * Display Sort Top Level Pages
	 *
	 * @return void
	 * @author Soul
	 **/
	function sort_toppage() {
						$menu_args=array();
						$menu_args = array(
								'post_type'=>array('page'),
					 			'posts_per_page'=>'-1',
					 			'nopaging'=>'true',
					 			'orderby'=>'menu_order',
					 			'order'=>'ASC',
					 			'meta_query' => array(
					 				'relation' => 'AND',
					 				array(
					 					'key' => 'level',
					 					'value'=> 'top'
					 				)
					 			)
						);
						$menu = new WP_Query( $menu_args );
	
	
	?>
		<div class="wrap">
		<h2>Sort top level pages<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
		<div class="description">
		This order will be used to generate the links in the left/right arrows on the main screen.
		Drag and Drop pages to order them.
		</div>
		<ul id="portfolio-list">
		<?php while ( $menu->have_posts() ) : $menu->the_post(); ?>
			<li id="<?php the_id(); ?>">
			<div>
			<?php 
			$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );
			$custom = get_post_custom(get_the_ID());
			
			?>
			<?php if ($image_url) { echo '<img class="theme_port_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
			</div>
			<div class="theme_port_desc">
			<span class="theme_port_admin_sort_title"><?php the_title(); ?></span>
			</div>
			<div class="clear"></div>
			</li>
		<?php endwhile; ?>
		</div><!-- End div#wrap //-->
	 
	<?php
	}
	
	/**
	 * Upadate the top level pages order
	 *
	 * @return void
	 * @author Soul
	 **/
	function save_menu_order() {
		global $wpdb; // WordPress database class
	 
		$order = explode(',', $_POST['order']);
		$counter = 0;
	 
		foreach ($order as $sort_id) {
			$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
			$counter++;
		}
		die(1);
	}
	add_action('wp_ajax_toppage_sort', 'save_menu_order');