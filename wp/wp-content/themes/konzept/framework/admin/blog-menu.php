<?php 
// mt_settings_page() displays the page content for the Test settings submenu
function add_blog_menu() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
    $opt_name = 'blog_exclude_categories';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'blog_exclude_categories'; 
	$opt_name2 = 'blog_css_style';
    $hidden_field_name2 = 'mt_submit_hidden2';
    $data_field_name2 = 'blog_css_style';
	$opt_name3 = 'blog_items_per_page';
    $hidden_field_name3 = 'mt_submit_hidden3';
    $data_field_name3 = 'blog_items_per_page';
	$opt_name4 = 'blog_date';
    $hidden_field_name4 = 'mt_submit_hidden4';
    $data_field_name4 = 'blog_date';
	$opt_name5 = 'blog_author';
    $hidden_field_name5 = 'mt_submit_hidden5';
    $data_field_name5 = 'blog_author';
	$opt_name6 = 'blog_post_author';
    $hidden_field_name6 = 'mt_submit_hidden6';
    $data_field_name6 = 'blog_post_author';
	$opt_name7 = 'blog_related_posts';
    $hidden_field_name7 = 'mt_submit_hidden7';
    $data_field_name7 = 'blog_related_posts';
	$opt_name8 = 'home_blog';
    $hidden_field_name8 = 'mt_submit_hidden8';
    $data_field_name8 = 'home_blog';
	$opt_name9 = 'blog_post_tags';
    $hidden_field_name9 = 'mt_submit_hidden9';
    $data_field_name9 = 'blog_post_tags';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val2 = get_option( $opt_name2 );
	$opt_val3 = get_option( $opt_name3 );
	$opt_val4 = get_option( $opt_name4 );
	$opt_val5 = get_option( $opt_name5 );
	$opt_val6 = get_option( $opt_name6 );
	$opt_val7 = get_option( $opt_name7 );
	$opt_val8 = get_option( $opt_name8 );
	$opt_val9 = get_option( $opt_name9 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val3 = $_POST[ $data_field_name3 ];
        $opt_val4 = $_POST[ $data_field_name4 ];
        $opt_val5 = $_POST[ $data_field_name5 ];
        $opt_val6 = $_POST[ $data_field_name6 ];
        $opt_val7 = $_POST[ $data_field_name7 ];
        $opt_val8 = $_POST[ $data_field_name8 ];
        $opt_val9 = $_POST[ $data_field_name9 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name3, $opt_val3 );
        update_option( $opt_name4, $opt_val4 );
        update_option( $opt_name5, $opt_val5 );
        update_option( $opt_name6, $opt_val6 );
        update_option( $opt_name7, $opt_val7 );
        update_option( $opt_name8, $opt_val8 );
        update_option( $opt_name9, $opt_val9 );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php  _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php 

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Blog Settings', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>

<form name="form-main-page" method="post" action="">
<input type="hidden" name="<?php  echo $hidden_field_name; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Exclude Categories From Blog</th>
        <td><input type="text" name="<?php  echo $data_field_name; ?>" value="<?php  echo $opt_val; ?>"></input><br/>
		By default posts from all categories you created as well as all sub-pages are displayed on blog page.<br/> You may exclude some post categories by typing in their IDs (see help if you don't know where to get them).<br/>
		<strong>IMPORTANT!</strong> You have to type them like this: 1,2,3,4,5 with commas and no spaces.
		</td>
        </tr>
    </table>
    <!--<p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php  //esc_attr_e('Save Changes') ?>" />
    </p>

</form>

<form name="form-x" method="post" action="">-->
<!-- Coming in the future
<input type="hidden" name="<?php  //echo $hidden_field_name2; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Choose CSS Style</th>
        <td>
		<?php  /*	if($opt_val2 == 1){
			$first = 'selected="selected"';
		}elseif($opt_val2 == 2){
			$second = 'selected="selected"';
		}elseif($opt_val2 == 3){
			$third = 'selected="selected"';
		}else{
			$zero = 'selected="selected"';
		}				*/
		/* 0 => main file, 1 => first file (but other than main file), 2 => second file, 3=> third file */
		?>
		<select name="<?php  //echo $data_field_name2; ?>">
		<option value="0" name="0" <?php  //echo $zero; ?>>Main CSS File</option>
		<option value="1" name="1" <?php  //echo $first; ?>>First CSS File</option>
		<option value="2" name="2" <?php  //echo $second; ?>>Second CSS File</option>
		<option value="3" name="3" <?php  //echo $third; ?>>Third CSS File</option>
	</select><br/>
		You can choose different CSS style for your blog here.<br/>
		</td>
        </tr>
    </table>-->
	
	<input type="hidden" name="<?php  echo $hidden_field_name3; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Posts per page</th>
        <td><input type="text" name="<?php  echo $data_field_name3; ?>" value="<?php  echo $opt_val3; ?>"></input><br/>
		How many posts would you like to display per page?<br/>
		<strong>IMPORTANT!</strong> You should type in just one number here. Use -1 for all the posts.
		</td>
        </tr>
    </table>
	
	
<!--	<input type="hidden" name="<?php  //echo $hidden_field_name4; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show date on blog page?</th>
        <td>
		<?php  	//if($opt_val4 == 1){
			//$first4 = 'selected="selected"';
		//}else{
	//		$zero4 = 'selected="selected"';
	//	}
		?>
		<select name="<?php  //echo $data_field_name4; ?>">
		<option value="0" name="0" <?php  //echo $zero4; ?>>Show</option>
		<option value="1" name="1" <?php  //echo $first4; ?>>Don't show</option>
	</select><br/>
		That should be quite obvious.<br/>
		</td>
        </tr>
    </table>
	
	<input type="hidden" name="<?php  //echo $hidden_field_name5; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show author on blog page?</th>
        <td>
		<?php  //	if($opt_val5 == 1){
			//$first5 = 'selected="selected"';
		//}else{
		//	$zero5 = 'selected="selected"';
		//}
		?>
		<select name="<?php  //echo $data_field_name5; ?>">
		<option value="0" name="0" <?php  //echo $zero5; ?>>Show</option>
		<option value="1" name="1" <?php  //echo $first5; ?>>Don't show</option>
	</select><br/>
		That should be quite obvious too.<br/>
		</td>
        </tr>
    </table> -->
	
	<!-- <input type="hidden" name="<?php  //echo $hidden_field_name6; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show author at the end of each post?</th>
        <td>
		<?php  	if($opt_val6 == 1){
			$first6 = 'selected="selected"';
		}else{
			$zero6 = 'selected="selected"';
		}
		?>
		<select name="<?php  //echo $data_field_name6; ?>">
		<option value="0" name="0" <?php  //echo $zero6; ?>>Show</option>
		<option value="1" name="1" <?php  //echo $first6; ?>>Don't show</option>
	</select><br/>
		You can enable or disable author box (with author's name, description and link to their website) at the bottom of each post here.<br/>
		</td>
        </tr>
    </table>
	
		<input type="hidden" name="<?php  //echo $hidden_field_name7; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show related posts at the end of each post?</th>
        <td>
		<?php  	if($opt_val7 == 1){
			$first7 = 'selected="selected"';
		}else{
			$zero7 = 'selected="selected"';
		}
		?>
		<select name="<?php  //echo $data_field_name7; ?>">
		<option value="0" name="0" <?php  //echo $zero7; ?>>Show</option>
		<option value="1" name="1" <?php  //echo $first7; ?>>Don't show</option>
	</select><br/>
		You can enable or disable related posts at the bottom of each post here.<br/>
		</td>
        </tr>
    </table>
	
	<input type="hidden" name="<?php  //echo $hidden_field_name9; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show post tags at the end of each post?</th>
        <td>
		<?php  	if($opt_val9 == 1){
			$first9 = 'selected="selected"';
		}else{
			$zero9 = 'selected="selected"';
		}
		?>
		<select name="<?php  //echo $data_field_name9; ?>">
		<option value="0" name="0" <?php  //echo $zero9; ?>>Show</option>
		<option value="1" name="1" <?php  //echo $first9; ?>>Don't show</option>
	</select><br/>
		You can enable or disable related posts at the bottom of each post here.<br/>
		</td>
        </tr>
    </table> -->
	
	<input type="hidden" name="<?php  echo $hidden_field_name8; ?>" value="Y">
    <!--<table class="form-table">
       <tr valign="top">
        <th scope="row">Blog on homepage</th>
        <td>
		<?php  	if($opt_val8 == 1){
			$first8 = 'selected="selected"';
		}else{
			$zero8 = 'selected="selected"';
		}
		?>
		<select name="<?php  echo $data_field_name8; ?>">
		<option value="0" name="r0" <?php  echo $zero8; ?>>Disable blog on homepage</option>
		<option value="1" name="r1" <?php  echo $first8; ?>>Add blog to homepage</option>
	</select><br/>
		Choose if you would like blog to appear on homepage or not.
		</td>
        </tr>
    </table>-->
	
	
    <p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php  esc_attr_e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php 
 
} ?>