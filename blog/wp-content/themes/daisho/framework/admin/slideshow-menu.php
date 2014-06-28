<?php
function add_slideshow_menu(){
    if(!current_user_can('manage_options')){
		wp_die(__('You do not have sufficient permissions to access this page.', 'flowthemes'));
    }

    // variables for the field and option names
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'flow_slideshow_autoplay';
    $data_field_name = 'flow_slideshow_autoplay';
	$opt_name2 = 'flow_slideshow_mousewheel';
    $data_field_name2 = 'flow_slideshow_mousewheel';

    // Read in existing option value from database
    $opt_val = get_option($opt_name);
	$opt_val2 = get_option($opt_name2);
	
    if(isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y'){
        // Read their posted value
        $opt_val = $_POST[$data_field_name];
        $opt_val2 = $_POST[$data_field_name2];

        // Save the posted value in the database
        update_option($opt_name, $opt_val);
        update_option($opt_name2, $opt_val2);

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Settings saved.', 'flowthemes'); ?></strong></p></div>
<?php } ?>
<div class="wrap">
	<h2><?php _e('Slideshow Settings', 'flowthemes'); ?></h2>
	<form name="form-main-page" method="post" action="">
		<table class="form-table">
		
			<tr valign="top">
				<th scope="row"><?php _e('Slideshow Autoplay Time', 'flowthemes'); ?></th>
				<td>
					<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>"></input>
					<p><?php _e('A value in milliseconds (1 second = 1000 milliseconds) indicating after how much time slideshow should automatically advance slides. Default is 12000 (12 seconds). Leave blank if you wish to disable autoplay feature. Value should be a single number like: <strong>12000</strong> (without any prefixes or suffixes).', 'flowthemes'); ?></p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php _e('Slideshow mousewheel', 'flowthemes'); ?></th>
				<td>
					<?php 
					$zero2 = null;
					$first27 = null;
					
					if($opt_val2 == "1"){
						$first2 = 'selected="selected"';
					}else{
						$zero2 = 'selected="selected"';
					}
					?>
					<select name="<?php echo $data_field_name2; ?>">
						<option value="0" <?php echo $zero2; ?>><?php _e('Enable', 'flowthemes'); ?></option>
						<option value="1" <?php echo $first2; ?>><?php _e('Disable', 'flowthemes'); ?></option>
					</select>
					<p><?php _e('You can enable or disable navigation by mousewheel here.', 'flowthemes'); ?></p>
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