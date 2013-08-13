<?php

add_action('admin_enqueue_scripts', 'flow_seo_admin_scripts');

function flow_seo_admin_scripts(){
	wp_register_script('flow_seo', get_bloginfo('template_directory') . '/framework/admin/seo/flow-seo.js', array('jquery'), '1.0');
	wp_register_style('flow_seo_css', get_bloginfo('template_directory') . '/framework/admin/seo/flow-seo.css');
	wp_enqueue_script('flow_seo');
	wp_enqueue_style('flow_seo_css');
}

function flow_seo_custom_code(){
	if(is_singular(array('page', 'post'))){
		$opt_name2 = 'flow_seo_description';
		$opt_name3 = 'flow_post_header_code';
		
		$post_ID = get_the_ID();
		$opt_val2 = get_post_meta($post_ID, $opt_name2, true);
		$opt_val3 = get_post_meta($post_ID, $opt_name3, true);
		
		if($opt_val2 != ''){
			echo '<meta name="description" content="'.$opt_val2.'" />';
		}else{
			if($post_ID){
				$post = get_post($post_ID);
				if($post){
					echo '<meta name="description" content="'.preg_replace('/\s+/', ' ', summarise_excerpt(esc_attr(strip_tags($post->post_content)), 45)).'" />';
				}
			}
		}
		if($opt_val3 != ''){
			echo $opt_val3;
		}
	}else{
		echo '<meta name="description" content="'.get_bloginfo('description').'" />';
	}
}
//add_action('admin_head', 'flow_seo_custom_code');
add_action('wp_head', 'flow_seo_custom_code');

//add_action('add_meta_boxes', 'flow_seo_create_meta_box');
add_action('admin_menu', 'flow_seo_create_meta_box');

function flow_seo_create_meta_box(){
	add_meta_box('seo-meta-box', __('SEO', 'flowthemes'), 'flowthemes_seo_meta_boxes', 'post', 'normal', 'default');
	add_meta_box('seo-meta-box', __('SEO', 'flowthemes'), 'flowthemes_seo_meta_boxes', 'page', 'normal', 'default');
}


add_action('save_post', 'flow_seo_save_postdata');
/* When the post is saved, saves our custom data */
function flow_seo_save_postdata($post_id){
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if (!wp_verify_nonce($_POST['flow_seo_noncename'], basename( __FILE__ ))){
		return;
	}

	// Check permissions
	if('page' == $_POST['post_type']){
		if(!current_user_can('edit_page', $post_id)){
			return;
		}
	}else{
		if(!current_user_can('edit_post', $post_id)){
			return;
		}
	}

	//if saving in a custom table, get post_ID
	$post_ID = $_POST['post_ID'];
	$flow_seo_data['flow_seo_title'] = $_POST['flow_seo_title'];
	$flow_seo_data['flow_seo_description'] = $_POST['flow_seo_description'];
	$flow_seo_data['flow_post_header_code'] = $_POST['flow_post_header_code'];

	// Do something with $flow_seo_data 
	// probably using add_post_meta(), update_post_meta(), or 
	// a custom table (see Further Reading section below)
	foreach($flow_seo_data as $key => $value){
        $old = get_post_meta($post_ID, $key, true);
        $new = $value;
       
        if($new && $new != $old){
            update_post_meta($post_ID, $key, $new);
        }else if($new == '' && $old){
            //delete_post_meta($post_ID, $key, $old); //Old will not work for complex fields for some reason...
            delete_post_meta($post_ID, $key);
        }
	}
}

function flowthemes_seo_meta_boxes(){
	
	//$post_ID = get_the_ID();
	//$tess = get_post_meta($post_ID, 'flow_seo_title', true);
	//echo $tess.'s';
	
	// Use custom field for verification...
	//$hidden_field_name = 'flow_seo_submit_hidden';
	// ...or use nonce for verification
	wp_nonce_field(basename(__FILE__), 'flow_seo_noncename');
	
	$opt_name = 'flow_seo_title';
	$opt_name2 = 'flow_seo_description';
	$opt_name3 = 'flow_post_header_code';	
	
	$post_ID = get_the_ID();
	$opt_val = get_post_meta($post_ID, $opt_name, true);
	$opt_val2 = get_post_meta($post_ID, $opt_name2, true);
	$opt_val3 = get_post_meta($post_ID, $opt_name3, true);

    // Read in existing option value from database
    //$opt_val = get_option($opt_name);
	//$opt_val2 = get_option($opt_name2);
	
	//if(!wp_verify_nonce($_POST[$meta_box['flow_seo_submit_hidden'] . '_noncename'], 'flow_seo_description' )){
		//return $post_id;
	//}
			
    //if(isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y'){
        // Read their posted value
        //$opt_val = $_POST[$data_field_name];
        //$opt_val2 = $_POST[$data_field_name2];
        //$opt_val3 = $_POST[$data_field_name3];

        // Save the posted value in the database
        //update_option($opt_name, $opt_val);
        //update_option($opt_name2, $opt_val2);
	//} 
?>
<!-- <input type="hidden" name="plib_meta_box_nonce" value="<?php //echo wp_create_nonce(basename(__FILE__)); ?>" /> -->
	<table class="form-table flow_seo_meta_box">
		<tr>
			<th style="width:20%;">
				<label for=""><?php _e('Snippet Preview', 'flowthemes'); ?></label>
			</th>
			<td>
				<div id="flow_seo_snippet">
					<a class="default_title" href="javascript:void(null);"><?php the_title(); ?> - <?php bloginfo('name'); ?></a>
					<a class="title" href="javascript:void(null);"><?php the_title(); ?></a>
					
					<cite href="javascript:void(null);" class="url">
						<?php
							$domain = parse_url(get_permalink());
							if(!empty($domain["host"])){ echo $domain["host"]; }
							if(!empty($domain["path"])){ echo $domain["path"]; }
						?>
					</cite>
					
					<p class="desc">
						<span class="content"><?php echo get_the_excerpt(); ?></span>
					</p>
					
				</div>
			</td>
		</tr>

		<tr>
			<th style="width:20%;">
				<label for="<?php echo $opt_name; ?>">SEO Title</label>
			</th>
			<td>
				<input type="text" name="<?php echo $opt_name; ?>" id="<?php echo $opt_name; ?>" value="<?php echo $opt_val; ?>" size="30" tabindex="30" style="width: 97%;" />
				<p style="color: #555;">
					If you leave this empty it's going to display standard title. Limited to max. 70 characters in most of the search engines. Number of characters: <span id="flow_seo_title-count"></span>
				</p>
			</td>
		</tr>
		
		<tr>
			<th style="width:20%;">
				<label for="<?php echo $opt_name2; ?>">SEO Description</label>
			</th>
			<td>
				<textarea name="<?php echo $opt_name2; ?>" id="<?php echo $opt_name2; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo $opt_val2; ?></textarea>
				<p style="color: #555;">Limited to 156 characters in most of the search engines. Number of characters: <span id="flow_seo_description-count"></span></p>
			</td>
		</tr>
		
		<tr>
			<th style="width:20%;">
				<label for="flow_seo_focuskw">Test Keyword(s)</label>
			</th>
			<td>
				<input type="text" name="flow_seo_focuskw" id="flow_seo_focuskw" value="" size="30" tabindex="30" style="width: 97%;" />
				<p style="color: #555;">
					This field is used only as testing tool. Put here keywords that you expect that user will look for to check how well this post is using them. Please test one keyword at a time. Phrases should be tested as separate keywords (because that's the way search engine works).
					<span id="focuskwresults"></span>
				</p>
			</td>
		</tr>
		
		<tr>
			<th style="width:20%;">
				<label for="<?php echo $opt_name3; ?>">Custom Code</label>
			</th>
			<td>
				<textarea name="<?php echo $opt_name3; ?>" id="<?php echo $opt_name3; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo $opt_val3; ?></textarea>
				<p style="color: #555;">
					A code that will be placed in <code>&lt;head&gt;</code> section of your website in place of <code>wp_head();</code> function (located in header.php). What you may want to put here is probably Facebook title, description and image that it should use:
<pre><code>&lt;meta property="og:title" content="The Daisho Project" /&gt;
&lt;meta property="og:type" content="video.movie" /&gt;
&lt;meta property="og:url" content="http://example.com/link-to-portfolio-project-with-movie/" /&gt;
&lt;meta property="og:image" content="http://example.com/images/facebook-should-grab-this-image-as-thumbnail.jpg" /&gt;</code></pre>
					More: <a href="http://ogp.me/" target="_blank">The Open Graph protocol</a>
				</p>
				<p>
					...or you can put here completely different code including <code>&lt;style&gt;</code> and <code>&lt;script&gt;</code> tags! There are lots of possibilities: <a href="http://en.wikipedia.org/wiki/Meta_element" target="_blank">Meta Element</a>.
				</p>
			</td>
		</tr>
	</table>
<?php } ?>