<?php 
// mt_settings_page() displays the page content for the Test settings submenu
function add_slideshow_menu() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names
	$opt_name4 = 'transition_effect';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name4 = 'transition_effect';
	$opt_name5 = 'transition_time';
    $hidden_field_name5 = 'mt_submit_hidden5';
    $data_field_name5 = 'transition_time';
	$opt_name9 = 'mainpage_page_title';
    $hidden_field_name9 = 'mt_submit_hidden9';
    $data_field_name9 = 'mainpage_page_title';

    // Read in existing option value from database
	$opt_val4 = get_option( $opt_name4 );
	$opt_val5 = get_option( $opt_name5 );
	$opt_val7 = get_option( $opt_name7 );
	$opt_val8 = get_option( $opt_name8 );
	$opt_val9 = get_option( $opt_name9 );
	$opt_val10 = get_option( $opt_name10 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val4 = $_POST[ $data_field_name4 ];
        $opt_val5 = $_POST[ $data_field_name5 ];
        $opt_val9 = $_POST[ $data_field_name9 ];

        // Save the posted value in the database
        update_option( $opt_name4, $opt_val4 );
        update_option( $opt_name5, $opt_val5 );
        update_option( $opt_name9, $opt_val9 );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php  _e('Settings saved.', 'menu-test' ); ?></strong></p></div>
<?php 

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Sliders Settings', 'menu-test' ) . "</h2>";
	echo "Welcome to sliders settings page! You can use this page to setup all 2D sliders that this theme comes with. For 3D slider settings visit separate category. You'll find it in the menu to the left! Most of the sliders are already setup for you with optimal settings.";
    // settings form
    
    ?>

<form name="form-sliders-page" method="post" action="">

	<input type="hidden" name="<?php  echo $hidden_field_name; ?>" value="Y">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Select slider type</th>
        <td>
		<?php  	if($opt_val9 == 1){
			$first9 = 'selected="selected"';
		}elseif($opt_val9 == 2){
			$second9 = 'selected="selected"';
		}elseif($opt_val9 == 3){
			$third9 = 'selected="selected"';
		}elseif($opt_val9 == 4){
			$fourth9 = 'selected="selected"';
		}elseif($opt_val9 == 5){
			$fifth9 = 'selected="selected"';
		}elseif($opt_val9 == 6){
			$sixth9 = 'selected="selected"';
		}elseif($opt_val9 == 7){
			$seventh9 = 'selected="selected"';
		}else{
			$zero9 = 'selected="selected"';
		}				
		?>
		<select name="<?php  echo $data_field_name9; ?>">
		<option value="0" name="w0" <?php  echo $zero9; ?>>Nothing</option>
		<option value="1" name="w1" <?php  echo $first9; ?>>Nivo Image Slider</option>
		<option value="4" name="w4" <?php  echo $fourth9; ?>>3D Slider</option>
		<!-- <option value="5" name="w5" <?php  //echo $fifth9; ?>>Accordion Slider</option> -->
		<option value="6" name="w6" <?php  echo $sixth9; ?>>Coin slider</option>
		<option value="7" name="w7" <?php  echo $seventh9; ?>>Custom Slider</option>
	</select><br/>
		You can choose something to be displayed above front page but below header. That could be NOTHING, IMAGE SLIDER, CUSTOM TEXT or STILL IMAGE.<br/>Once you choose anything SAVE setting and <strong>REFRESH PAGE</strong>. In case you chose custom text or still image a new field will appear.
		</td>
        </tr>
    </table>
	
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Choose Slider Transition Effect (Nivo Slider)</th>
        <td>
		<?php  	if($opt_val4 == "sliceDown"){
			$first4 = 'selected="selected"';
		}elseif($opt_val4 == "sliceDownLeft"){
			$second4 = 'selected="selected"';
		}elseif($opt_val4 == "sliceUp"){
			$third4 = 'selected="selected"';
		}elseif($opt_val4 == "sliceUpLeft"){
			$fourth4 = 'selected="selected"';
		}elseif($opt_val4 == "sliceUpDown"){
			$fifth4 = 'selected="selected"';
		}elseif($opt_val4 == "sliceUpDownLeft"){
			$sixth4 = 'selected="selected"';
		}elseif($opt_val4 == "fold"){
			$seventh4 = 'selected="selected"';
		}elseif($opt_val4 == "fade"){
			$eighth4 = 'selected="selected"';
		}else{
			$zero4 = 'selected="selected"';
		}				
		?>
		<select name="<?php  echo $data_field_name4; ?>">
		<option value="random" name="nivo0" <?php  echo $zero4; ?>>Random (Default)</option>
		<option value="sliceDown" name="nivo1" <?php  echo $first4; ?>>sliceDown</option>
		<option value="sliceDownLeft" name="nivo2" <?php  echo $second4; ?>>sliceDownLeft</option>
		<option value="sliceUp" name="nivo3" <?php  echo $third4; ?>>sliceUp</option>
		<option value="sliceUpLeft" name="nivo4" <?php  echo $fourth4; ?>>sliceUpLeft</option>
		<option value="sliceUpDown" name="nivo5" <?php  echo $fifth4; ?>>sliceUpDown</option>
		<option value="sliceUpDownLeft" name="nivo6" <?php  echo $sixth4; ?>>sliceUpDownLeft</option>
		<option value="fold" name="nivo7" <?php  echo $seventh4; ?>>fold</option>
		<option value="fade" name="nivo8" <?php  echo $eighth4; ?>>fade</option>
	</select><br/>
		You can choose from 9 different effects for Nivo image slider here.<br/>
		</td>
        </tr>
    </table>
	
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Time between slides (Nivo Slider)</th>
        <td><input type="text" name="<?php  echo $data_field_name5; ?>" value="<?php  echo $opt_val5; ?>"></input><br/>
		Set the time between slides [miliseconds].<br/> I would say 6000 or 7000 ms is good but I'm leaving it up to you.<br/><strong>IMPORTANT!</strong> You MUST type here some number and I highly recommend to type in something above 3000. :)
		</td>
        </tr>
    </table>	
	
    <p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php  esc_attr_e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php  } ?>