<?php 
// mt_settings_page() displays the page content for the Test settings submenu
function add_portfolio_menu() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
    $opt_name = 'portfolio_pages';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'portfolio_pages'; 
	$opt_name2 = 'portfolio_css';
    $hidden_field_name2 = 'mt_submit_hidden2';
    $data_field_name2 = 'portfolio_css';
	$opt_name3 = 'portfolio_page_title';
    $hidden_field_name3 = 'mt_submit_hidden3';
    $data_field_name3 = 'portfolio_page_title';
	$opt_name4 = 'portfolio_custom_text';
    $hidden_field_name4 = 'mt_submit_hidden4';
    $data_field_name4 = 'portfolio_custom_text';
	$opt_name5 = 'portfolio_effect';
    $hidden_field_name5 = 'mt_submit_hidden5';
    $data_field_name5 = 'portfolio_effect';


    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val2 = get_option( $opt_name2 );
	$opt_val3 = get_option( $opt_name3 );
	$opt_val4 = get_option( $opt_name4 );
	$opt_val5 = get_option( $opt_name5 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val3 = $_POST[ $data_field_name3 ];
        $opt_val4 = $_POST[ $data_field_name4 ];
        $opt_val5 = $_POST[ $data_field_name5 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name3, $opt_val3 );
        update_option( $opt_name4, $opt_val4 );
        update_option( $opt_name5, $opt_val5 );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php  _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php 

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Portfolio Settings', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>



<form name="form-main-page" method="post" action="">
<input type="hidden" name="<?php  echo $hidden_field_name; ?>" value="Y">
   <!-- <table class="form-table">
        <tr valign="top">
        <th scope="row">Select which categories should be displayed in portfolio</th>
        <td><input type="text" name="<?php  //echo $data_field_name; ?>" value="<?php  //echo $opt_val; ?>"></input><br/>
		By default all the post categories you created as well as all sub-categories are displayed in portfolio.<br/> You may select only some of them by typing in their IDs (see help if you don't know where to get them).<br/>
		<strong>IMPORTANT!</strong> You have to type them like this: 1,2,3,4,5 with commas and no spaces.
		</td>
        </tr>
    </table> -->

	
<!-- Coming in the future
<input type="hidden" name="<?php  //echo $hidden_field_name2; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Choose CSS Style for Portfolio</th>
        <td>
		<?php  /*	if($opt_val2 == 1){
			$first = 'selected="selected"';
		}elseif($opt_val2 == 2){
			$second = 'selected="selected"';
		}elseif($opt_val2 == 3){
			$third = 'selected="selected"';
		}else{
			$zero = 'selected="selected"';
		}	*/			
		/* 0 => main file, 1 => first file (but other than main file), 2 => second file, 3=> third file */
		?>
		<select name="<?php  //echo $data_field_name2; ?>">
		<option value="0" name="0" <?php  //echo $zero; ?>>Main CSS File</option>
		<option value="1" name="1" <?php  //echo $first; ?>>First CSS File</option>
		<option value="2" name="2" <?php  //echo $second; ?>>Second CSS File</option>
		<option value="3" name="3" <?php  //echo $third; ?>>Third CSS File</option>
	</select><br/>
		You can choose different CSS style for your portfolio page here.<br/>(by default it's set to Main CSS File)<br/>
		</td>
        </tr>
    </table>-->
	

<input type="hidden" name="<?php  echo $hidden_field_name5; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Choose CSS Style for Portfolio</th>
        <td>
		<?php 	if($opt_val5 == 1){
			$first5 = 'selected="selected"';
		}elseif($opt_val5 == 2){
			$second5 = 'selected="selected"';
		}elseif($opt_val5 == 3){
			$third5 = 'selected="selected"';
		}elseif($opt_val5 == 4){
			$fourth5 = 'selected="selected"';
		}elseif($opt_val5 == 5){
			$fifth5 = 'selected="selected"';
		}else{
			$zero5 = 'selected="selected"';
		}		
		/* 0 => main file, 1 => first file (but other than main file), 2 => second file, 3=> third file */
		?>
		<select name="<?php  echo $data_field_name5; ?>">
		<option value="0" name="05" <?php  echo $zero5; ?>>Slide Down (default)</option>
		<option value="1" name="15" <?php  echo $first5; ?>>Slide Right</option>
		<option value="2" name="25" <?php  echo $second5; ?>>The Combo</option>
		<option value="3" name="35" <?php  echo $third5; ?>>Peek</option>
		<option value="4" name="45" <?php  echo $fourth5; ?>>Caption Full</option>
		<option value="5" name="55" <?php  echo $fifth5; ?>>Caption</option>
	</select><br/>
		<p>You can choose different effect type for your portfolio page here.<br/> This works only if you use "Portfolio Template v2".</p>
		</td>
        </tr>
    </table>
	<!--
	<input type="hidden" name="<?php  //echo $hidden_field_name3; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Select what should appear above portfolio entires (image slider? custom text? Image?)</th>
        <td>
		<?php  /*	if($opt_val3 == 1){
			$first3 = 'selected="selected"';
		}elseif($opt_val3 == 2){
			$second3 = 'selected="selected"';
		}elseif($opt_val3 == 3){
			$third3 = 'selected="selected"';
		}else{
			$zero3 = 'selected="selected"';
		}				*/
		?>
		<select name="<?php  //echo $data_field_name3; ?>">
		<option value="0" name="cufon0" <?php  //echo $zero3; ?>>Nothing will be displayed above portfolio entries</option>
		<option value="1" name="cufon1" <?php  //echo $first3; ?>>Image Slider will be displayed</option>
		<option value="2" name="cufon2" <?php  //echo $second3; ?>>Custom Text will be displayed</option>
		<option value="3" name="cufon3" <?php  //echo $third3; ?>>I want to display still image</option>
	</select><br/>
		You can choose something to be displayed above portfolio entries. That could be NOTHING, IMAGE SLIDER (the same as on front page), CUSTOM TEXT or STILL IMAGE.<br/>Once you choose anything SAVE setting and <strong>REFRESH PAGE</strong> to see more settings!
		</td>
        </tr>
    </table>-->
	
	<?php  if($opt_val3 == 2){ ?>
	<input type="hidden" name="<?php  echo $hidden_field_name4; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Type in text to be displayed above portfolio entries</th>
        <td><input type="text" name="<?php  echo $data_field_name4; ?>" value="<?php  echo $opt_val4; ?>"></input><br/>
		This field only appears if you set CUSTOM TEXT to appear in the select box above<br/> You may type in some text here to be displayed above portoflio entries.<br/> You can use HTML tags here: &lt;strong&gt;Bold&lt;/strong&gt; returns: <strong>Bold</strong> and &lt;em&gt;italic&lt;/em&gt; returns: <em>italic</em>.<br/>Note that if you use Cufon text replacement italics may not work but Bold will work fine.<br/>
		e.g. Hello! We are YourCompanyName! We create awesome websites for everyone!
		</td>
        </tr>
    </table>
	<?php  }elseif($opt_val3 == 3){ ?>
	 <table class="form-table">
        <tr valign="top">
        <th scope="row">Link to the image to be displayed above portfolio entries</th>
        <td><input type="text" name="<?php  echo $data_field_name4; ?>" value="<?php  echo $opt_val4; ?>"></input><br/>
		This field only appears if you set STILL IMAGE to appear in the select box above<br/> Delete everything from the field above and place there a link to the image that you want to be displayed above portoflio entries.<br/> Strongly recommended size is width: 960px (it's better not to put here anything that is wider than 1000px but you may do it), height: as you wish (I recommend something like 150-350px)
		</td>
        </tr>
    </table>
	<?php  } ?>
    <p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php  esc_attr_e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php 
 
} ?>