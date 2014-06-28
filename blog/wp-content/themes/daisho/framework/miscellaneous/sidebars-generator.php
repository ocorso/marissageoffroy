<?php
/*
Plugin Name: Flow Sidebars Generator
Plugin URI:
Description:
Author: Flow
Version: 1.0
Author URI: http://devatic.com/
License: Please contact author to get licensing information about this module
*/

/*
This is how var_dump(get_option('flow_sidebars')) looks like with 2 sidebars:
		  
array(2) {
  ["flow-sidebar-1"]=>
  array(7) {
    ["name"]=>
    string(4) "test"
    ["description"]=>
    string(0) ""
    ["class"]=>
    string(0) ""
    ["before_title"]=>
    string(24) "<h3 class="widgettitle">"
    ["after_title"]=>
    string(5) "</h3>"
    ["before_widget"]=>
    string(34) "<li id="%1$s" class="widget %2$s">"
    ["after_widget"]=>
    string(5) "</li>"
  }
  ["flow-sidebar-2"]=>
  array(7) {
    ["name"]=>
    string(5) "test2"
    ["description"]=>
    string(0) ""
    ["class"]=>
    string(0) ""
    ["before_title"]=>
    string(24) "<h3 class="widgettitle">"
    ["after_title"]=>
    string(5) "</h3>"
    ["before_widget"]=>
    string(34) "<li id="%1$s" class="widget %2$s">"
    ["after_widget"]=>
    string(5) "</li>"
  }
}
*/

add_filter('flow_sidebar', 'flow_sidebar_filter');
add_action('widgets_init', 'flow_register_sidebars');
add_action('admin_init', 'fsg_options_admin_init');
add_action('admin_menu', 'fsg_options_add_page');

// Let's add the "Sidebars" page to the "Appearance" admin menu
function fsg_options_add_page(){
	add_theme_page('Sidebars', 'Sidebars', 'edit_theme_options', 'flow_sidebars', 'flow_sidebars_display_page_callback');
}

/*
Now let's add filter that should be used in theme's template files.
Gets current post's custom field 'flow_post_sidebars' filters default sidebar ID. If replacement ID is specified for this sidebar area then it returns new ID.
Usage of this filter in theme template files: dynamic_sidebar( apply_filters( 'flow_sidebar', 'sidebar-1' ) );
'flow_post_sidebars' contains PHP replacement array: Array ( [sidebar-default] => replacement-sidebar [sidebar-y] => other-sidebar2 ) (gets unserialized by WP)
$default_sidebar contains ID of this sidebar area (currently processed by filter)
*/
function flow_sidebar_filter($default_sidebar){
	global $post;
	global $wp_registered_sidebars;
	
	foreach($wp_registered_sidebars as $sidebar_id => $sidebar_data){
		$all_sidebars[] = $sidebar_id; //array of all available sidebar IDs
	}
	
	$post_ID_to_use = $post->ID;
	if(is_home()){
		$front_page = get_option('front_page');
		if(!empty($front_page)){
			$post_ID_to_use = $front_page;
		}
	}

	$post_sidebars = get_post_meta($post_ID_to_use, 'flow_post_sidebars', true);
		
	if(is_array($post_sidebars) && array_key_exists($default_sidebar, $post_sidebars) && (in_array($post_sidebars[$default_sidebar], $all_sidebars) || $post_sidebars[$default_sidebar] == 'hidden')){
		if($post_sidebars[$default_sidebar] == 'hidden'){
			return false;
		}
		return $post_sidebars[$default_sidebar];
	}
	
	return $default_sidebar;
}

// Now, if 'flow_sidebars' already contains any data - create sidebars everywhere! If not - skip. This should be done on 'widgets_init' (as per Codex recommendation) or 'init'.
function flow_register_sidebars(){
	$sidebars = get_option('flow_sidebars');
	
	if(is_array($sidebars)){
		//foreach((array) $sidebars as $sidebar_id => $sidebar){
		foreach($sidebars as $sidebar_id => $sidebar){
			$sidebar['id'] = $sidebar_id;
			register_sidebar($sidebar);
		}
	}
}

/*
Adds the metaboxes to the main options page for the sidebars in the database.
add_action('admin-init', 'myplugin_register_setting');
add_action('add_meta_boxes', 'myplugin_add_custom_box');
add_action('widgets_init', 'myplugin_add_custom_sidebar');
*/
function fsg_options_admin_init(){
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	
	// Register setting to store all the sidebar options in the *_options table
	register_setting('flow_sidebars_options', 'flow_sidebars', 'flow_sidebars_update');
	
	$sidebars = get_option('flow_sidebars');
	if(is_array($sidebars) && count($sidebars) > 0){
		foreach($sidebars as $id => $sidebar){
			add_meta_box(
				esc_attr($id),
				esc_html($sidebar['name']),
				'flow_sidebar_display_meta_boxes_callback',
				'flow_sidebars',
				'normal',
				'default',
				array(
					'id' => esc_attr($id),
					'sidebar' => $sidebar
				)
			);
			
			$sidebar['id'] = esc_attr($id);
			register_sidebar($sidebar);
		}
	}else{
		add_meta_box('flow-sidebar-no-sidebars', 'No sidebars', 'flow_sidebar_no_sidebars', 'flow_sidebars', 'normal', 'default');
	}
	
	// Sidebar metaboxes
	add_meta_box('flow-sidebar-add-new-sidebar', 'Add New Sidebar', 'flow_sidebar_add_new_sidebar', 'flow_sidebars', 'side', 'default');
	add_meta_box('flow-sidebar-about-the-plugin', 'Information', 'flow_sidebar_about_meta_box', 'flow_sidebars', 'side', 'default');
}

function flow_sidebar_no_sidebars() {
	echo '<p>There are no additional sidebars at this moment. You can add one to the right.</p>';
}

function flow_sidebars_display_page_callback(){
	if(!isset($_REQUEST['settings-updated'])){
		$_REQUEST['settings-updated'] = false;
	}
	?>
	<div class="wrap">
		<?php screen_icon(); ?><h2>Sidebars</h2>
		<?php if(false !== $_REQUEST['settings-updated']){ ?>
		<div class="updated fade"><p><strong>Settings saved.</strong></p></div>
		<?php } ?>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="post-body" class="has-sidebar">
				<div id="post-body-content" class="has-sidebar-content">
					<form method="post" action="options.php">
						<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
						<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
						<?php settings_fields('flow_sidebars_options'); ?>
						<?php do_meta_boxes('flow_sidebars', 'normal', null); ?>
					</form>
				</div>
			</div>
			<div id="side-info-column" class="inner-sidebar">
				<?php do_meta_boxes( 'flow_sidebars', 'side', null); ?>
			</div>
			<div class="clear"></div>
		</div>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready(function($){
				// close postboxes that should be closed
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// postboxes setup
				postboxes.add_postbox_toggles('flow_sidebars');
			});
			//]]>
		</script>
		<div class="clear"></div>
	</div>
	<?php
}

function flow_sidebar_display_meta_boxes_callback($post, $metabox){
	$sidebars = get_option('flow_sidebars');
	$sidebar_id = esc_attr($metabox['args']['id']);
	$sidebar = $sidebars[$sidebar_id];
	
	$options_fields = array(
		'name' => 'Name',
		'id' => 'ID',
		'description' => 'Description',
		'class' => 'CSS Class',
		'before_title' => 'Before Title',
		'after_title' => 'After Title',
		'before_widget' => 'Before Widget',
		'after_widget' => 'After Widget'
	);
	
	//echo '<input id="flow_sidebars['.esc_attr($sidebar_id).']['.esc_attr($id).']" class="regular-text" type="text" name="flow_sidebars['.esc_attr($sidebar_id).']['.esc_attr( $id ).']" value="'.$sidebar_id.'" readonly />';
	/* 
	<input id="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" class="regular-text" type="text" name="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" value="<?php echo $sidebar_id; ?>" readonly />
	
	<input id="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" class="regular-text" type="text" name="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" value="<?php echo esc_html( $sidebar[$id] ); ?>" /> 
	*/
	
/* 	$options_fields = array(
		'name' => array('label' => 'Name', 'description' => 'some desc', 'default' => '' ),
		'id' => 'ID',
		'description' => 'Description',
		'class' => 'CSS Class',
		'before_title' => 'Before Title',
		'after_title' => 'After Title',
		'before_widget' => 'Before Widget',
		'after_widget' => 'After Widget'
	); */
	?>
	<table class="form-table">
		<?php foreach($options_fields as $id => $label){ ?>
		<tr valign="top">
			<th scope="row"><label for="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][<?php echo esc_attr($id); ?>]"><?php echo esc_html($label); ?></label></th>
			<td>
			<?php if($id == 'id'){ ?>
				<input id="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" class="regular-text" type="text" name="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][<?php echo esc_attr($id); ?>]" value="<?php echo $sidebar_id; ?>" readonly />
			<?php }else{ ?>
				<input id="flow_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" class="regular-text" type="text" name="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][<?php echo esc_attr($id); ?>]" value="<?php echo esc_html($sidebar[$id]); ?>" />
			<?php } ?>
			</td>
		</tr>
		<?php } ?>
		<tr valign="top">
			<th scope="row"><label for="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][delete]">Delete this sidebar</label></th>
			<td>
				<label><input id="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][delete]" type="checkbox" name="flow_sidebars[<?php echo esc_attr($sidebar_id); ?>][delete]" value="<?php echo esc_attr($sidebar_id); ?>" /> <strong>Delete this sidebar?</strong> All widgets in this sidebar will be moved to "Inactive Sidebar" on <a href="<?php echo get_admin_url(); ?>widgets.php" target="_blank">Widgets Page</a>, so you can use them elsewhere or delete permanently.</label>
			</td>
		</tr>
	</table>
	
	<?php
	// This is not used anywhere but looks like good improvement for the future releases
	/* $get_posts = new WP_Query;
	$posts = $get_posts->query(array(
		'offset' => 0,
		'order' => 'ASC',
		'orderby' => 'title',
		'posts_per_page' => -1,
		'post_type' => 'page',
		'suppress_filters' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false
	));
	
	foreach($posts as $post){
		$post_sidebars = get_post_meta($post->ID, 'flow_post_sidebars', true);
		foreach($post_sidebars as $post_sidebar_id => $post_replacement_sidebar_id){
			if($post_sidebar_id == $sidebar_id){
				echo 'This sidebar is used as sidebar that is being replaced with some other sidebar on a page with an ID of '.$post->ID.' (page title: '.$post->post_title.')';
			}
			if($post_replacement_sidebar_id == $sidebar_id){
				echo 'This sidebar is used as replacement sidebar on a page with an ID of '.$post->ID.' (page title: '.$post->post_title.')';
			}
		}
	} 
	echo 'This sidebar might be also used in template files if you have put its code directly in there.'; */
	?>
	
	
	<div class="clear submitbox" style="padding: 1.5em 0 1em 0;">
		<input type="submit" class="button-primary" value="Save all sidebars" />
		<div style="clear:both;"></div>
	</div>
	<?php
}

/**
 * Validates and handles all the post data (adding, updating, deleting sidebars)
 * 
 * @since Unique Page Sidebars 0.1
 */
function flow_sidebars_update($input){
	if(isset($input['add_sidebar'])){
		$sidebars = get_option('flow_sidebars');
		if(!empty($input['add_sidebar'])){
			if(is_array($sidebars) && array_key_exists('flow-sidebar-1', $sidebars)){
				for($i=1;array_key_exists('flow-sidebar-'.$i, $sidebars);$i++){
					$sidebar_number = $i+1;
				}
			}else{
				$sidebar_number = 1;
			}
			
			/* Defaults if nothing is set */
			$sidebars['flow-sidebar-'.$sidebar_number] = array(
				'name' 			=> esc_html($input['add_sidebar']),
				'description'   => '',
				'class'         => '',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>'
			);
		}
		return $sidebars;
	}
	
	foreach((array) $input as $delete_key => $delete_id){
		if($delete_id['delete']){
			unset($input[$delete_key]);
		}
	}
	unset($input['delete']);
		
	return $input;
}

function flow_sidebar_add_new_sidebar(){
	?>
	<form method="post" action="options.php" id="add-new-sidebar">
		<?php settings_fields( 'flow_sidebars_options' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Name</th>
				<td>
					<input id="flow_sidebars[add_sidebar]" class="text" type="text" name="flow_sidebars[add_sidebar]" value="" />
				</td>
			</tr>
		</table>
		<p class="submit" style="padding: 0;">
			<input type="submit" class="button-primary alignright" value="Add Sidebar" />
		</p>
		<div class="clear"></div>
	</form>
	<?php
}

function flow_sidebar_about_meta_box(){ ?>
	<ol>
		<li>You can create additional sidebars here. Once the sidebar is created you can add or remove its <a href="<?php echo get_admin_url(); ?>widgets.php" target="_blank">widgets</a>.</li>
		<li>Once widgets are attached you can replace any of the default sidebars with other sidebar under [Pages > Add New/Edit], [Posts > Add New/Edit] etc. in "Sidebar Replacement" box (page settings box below content area).</li>
	</ol>
	
	<p>The sidebar name is for your use only. It will not be visible to any of your visitors. A CSS class can be assigned to each of your sidebars, use this to customize the sidebars. Please do not modify any of pre-defined sidebar settings unless you know what you're doing.</p>
	
	<h4>Advanced Usage (developers only)</h4>
	<p>This is the code (<a href="http://codex.wordpress.org/Function_Reference/dynamic_sidebar" target="_blank">dynamic_sidebar</a>) that you should put directly in template files to be able to access your sidebar: <code>&lt;?php dynamic_sidebar( 'flow-sidebar-ID' ); ?&gt;</code></p>
	<p>This is the code that you should put directly in template files to be able to access your sidebar and to see it on "Sidebar Replacement" list under [Pages > Add New], [Posts > Add New] etc.: <code>&lt;?php dynamic_sidebar( apply_filters( 'flow_sidebar', 'flow-sidebar-ID' ) ); ?&gt;</code></p>
	<p>If you wish to use this sidebar directly on a page or in a post, please use this shortcode: <code>[flow-sidebar id="flow-sidebar-ID"]</code></p>
	<?php
}

/* META BOXES CLASS FOR POSTS AND PAGES STARTS HERE */
class flow_sidebar_generator{
	
	function flow_sidebar_generator(){
		//edit posts/pages
		add_action('edit_form_advanced', array('flow_sidebar_generator', 'edit_form'));
		add_action('edit_page_form', array('flow_sidebar_generator', 'edit_form'));
		
		//save posts/pages
		add_action('edit_post', array('flow_sidebar_generator', 'save_form'));
		add_action('publish_post', array('flow_sidebar_generator', 'save_form'));
		add_action('save_post', array('flow_sidebar_generator', 'save_form'));
		add_action('edit_page_form', array('flow_sidebar_generator', 'save_form'));
	}
	
	function save_form($post_id){
		$is_saving = $_POST['flow_sidebars_form_edit'];
		if(!empty($is_saving)){
			$sidebars_replacement_array = $_POST['flow_sidebar_generator'];
			
			if(is_array($sidebars_replacement_array)){
				foreach($sidebars_replacement_array as $key => $value){
					if($value == "0"){
						unset($sidebars_replacement_array[$key]);
					}
				}
				
				if(count($sidebars_replacement_array) == 0){
					unset($sidebars_replacement_array);
					delete_post_meta($post_id, 'flow_post_sidebars');
				}else{
					//delete_post_meta($post_id, 'flow_post_sidebars');
					//add_post_meta($post_id, 'flow_post_sidebars', $sidebars_replacement_array);
					update_post_meta($post_id, 'flow_post_sidebars', $sidebars_replacement_array);
				}
			}
		}		
	}
	
	function edit_form(){
	    global $post;
	    $post_id = $post;
	    if(is_object($post_id)){
	    	$post_id = $post_id->ID;
	    }

	echo '<div id="flow-sidebar-sortables" class="meta-box-sortables">';
		echo '<div id="flow_sidebars_box" class="postbox">';
			echo '<div class="handlediv" title="Click to toggle"><br /></div><h3 class="hndle"><span>Sidebars</span></h3>';
			echo '<div class="inside">';
				echo '<div class="flow_sidebars_container">';
					echo '<input name="flow_sidebars_form_edit" type="hidden" value="flow_sidebars_form_edit" />';

					global $wp_registered_sidebars;
					$sidebars = $wp_registered_sidebars;
					$post_sidebars = get_post_meta($post_id, 'flow_post_sidebars', true);
					//var_dump($wp_registered_sidebars);
					//var_dump($post_sidebars);
					
					if(is_array($sidebars) && !empty($sidebars) && count($sidebars) >= 2){
						echo '<p>This page may contain some sidebar areas (but perhaps not all sidebars listed below are used on this page). You can replace existing sidebars with some other sidebars below (leave "None" to use the default sidebars). Double replacement (e.g. [Sidebar -> Sidebar 1] and [Sidebar 1 -> Sidebar 2]) won\'t take effect - you need to set both to "Sidebar 2" to achieve what you\'re looking for. You can create more <a href="'.get_admin_url().'themes.php?page=flow_sidebars" target="_blank">Sidebars</a> and add them some <a href="'.get_admin_url().'widgets.php" target="_blank">Widgets</a>.</p>';
						echo '<ul>';
						$i = 0;
						foreach($sidebars as $sidebar_id => $sidebar_content){
							echo '<li>Replace ';
							echo "<input style='min-width:250px;' name='' type='text' value='{$sidebar_content['name']}' readonly />";
							echo "<input style='min-width:250px;visibility:hidden;display:none;' name='flow_sidebar_generator[{$sidebar_id}]' type='text' value='{$sidebar_id}' readonly />";
							echo ' with ';

							echo '<select name="flow_sidebar_generator['.$sidebar_id.']">';
							echo '<option value="0">None</option>';
							
							$hidden_selected = '';
							if(is_array($post_sidebars) && array_key_exists($sidebar_id, $post_sidebars) && $post_sidebars[$sidebar_id] == 'hidden'){
								$hidden_selected = 'selected';
							}
							echo '<option value="hidden" '.$hidden_selected.'>Hide this widget area</option>';
							
							foreach($sidebars as $sidebar){
								// If sidebar and replacement option are alike, skip it when creating drop-down list - no reason to give an opportunity to replace X with X or Y with Y
								if($sidebar_id != $sidebar['id']){
									// $post_sidebars array looks like this: Array( [sidebar-1] => [sidebar-2], [sidebar-5] => [footer-sidebar-1] );
									if(is_array($post_sidebars) && array_key_exists($sidebar_id, $post_sidebars) && $post_sidebars[$sidebar_id] == $sidebar['id']){
										echo "<option value='{$sidebar['id']}' selected>{$sidebar['name']} (id: {$sidebar['id']})</option>\n";
									}else{
										echo "<option value='{$sidebar['id']}'>{$sidebar['name']} (id: {$sidebar['id']})</option>\n";
									}
								}
							}
							echo '</select></li>'; 
							$i++;
						}
					}else{
						echo '<p>There are not enough sidebars to replace anything at this moment. If you wish to use this section please create more <a href="'.get_admin_url().'themes.php?page=flow_sidebars" target="_blank">Sidebars</a> and add them some <a href="'.get_admin_url().'widgets.php" target="_blank">Widgets</a>.</p>';
					} 
					echo '</ul>
					</div>
				</div>
			</div>
		</div>';
	}
}
$fsg = new flow_sidebar_generator;
?>