<?php
function add_blog_menu() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'blog_exclude_categories';
    $data_field_name = 'blog_exclude_categories';
	$opt_name2 = 'blog_items_per_page';
    $data_field_name2 = 'blog_items_per_page';
	$opt_name3 = 'blog_show_author';
    $data_field_name3 = 'blog_show_author';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val2 = get_option( $opt_name2 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val3 = $_POST[ $data_field_name3 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name3, $opt_val3 );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Settings saved.', 'flowthemes' ); ?></strong></p></div>
<?php } ?>
<div class="wrap">
	<h2><?php _e( 'Blog Settings', 'flowthemes' ); ?></h2>
	<form name="form-main-page" method="post" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Posts per page', 'flowthemes'); ?></th>
				<td>
					<input type="text" name="<?php echo $data_field_name2; ?>" value="<?php echo $opt_val2; ?>"></input>
					<p><?php _e('Posts per blog page. Use -1 for all the posts.', 'flowthemes'); ?></p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e('Show Author', 'flowthemes'); ?></th>
				<td>
					<?php 
					$first3 = '';
					$zero3 = '';
					if($opt_val3 == "1"){
						$first3 = 'selected="selected"';
					}else{
						$zero3 = 'selected="selected"';
					}
					?>
					<select name="<?php echo $data_field_name3; ?>">
						<option value="0" <?php echo $zero3; ?>><?php _e('Disable', 'flowthemes'); ?></option>
						<option value="1" <?php echo $first3; ?>><?php _e('Enable', 'flowthemes'); ?></option>
					</select>
					<p><?php _e('Show author on blog listing pages and in archives.', 'flowthemes'); ?></p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Exclude Categories From Blog', 'flowthemes'); ?></th>
				<td>
					<?php
					$excludedCategories = $opt_val;
					/* $excludedCategories = array(id, id, id, 1, 2, 3); */
					
					$categories = get_terms('category', 'hide_empty=0');
					/*
					array(5) { 
						[0]=> object(stdClass)#351 (9) { ["term_id"]=> string(1) "3" ["name"]=> string(14) "Graphic design" ["slug"]=> string(14) "graphic-design" ["term_group"]=> string(1) "0" ["term_taxonomy_id"]=> string(1) "3" ["taxonomy"]=> string(8) "category" ["description"]=> string(0) "" ["parent"]=> string(1) "0" ["count"]=> string(1) "2" } 
						[1]=> object(stdClass)#352 (9) { ["term_id"]=> string(1) "4" ["name"]=> string(12) "Illustration" ["slug"]=> string(12) "illustration" ["term_group"]=> string(1) "0" ["term_taxonomy_id"]=> string(1) "4" ["taxonomy"]=> string(8) "category" ["description"]=> string(0) "" ["parent"]=> string(1) "0" ["count"]=> string(1) "1" } 
						...... 
					*/
					?>
					<div class="wp-tab-wrapper" style="max-width: 100%;">
						<ul class="wp-tab-bar" style="margin-bottom: 1px; margin-top: 0;">
							<li class="wp-tab-active"><?php _e('All Categories', 'flowthemes'); ?></li>
						</ul>
						<div class="wp-tab-panel">
							<ul id="pagechecklist" class="categorychecklist form-no-clear" style="margin-top: 0;">
								<?php foreach($categories as $category){ ?>
									<li>
										<label>
											<?php
											$checked = '';
											if(is_array($excludedCategories) && in_array($category->term_id, $excludedCategories)){
												$checked = ' checked="checked"';
											}
											?>
											<input type="checkbox" class="menu-item-checkbox" name="<?php echo esc_attr($data_field_name); ?>[]" value="<?php echo esc_attr($category->term_id); ?>"<?php echo $checked; ?> />
											<?php echo $category->name; ?> (<?php echo $category->count; ?>)
										</label>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<p><?php _e('By default posts from all categories you created as well as all sub-pages are displayed on blog page.<br/> You may exclude some post categories by selecting them on the list.', 'flowthemes'); ?></p>
				</td>
			</tr>
		</table>

		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php } ?>