<?php 
function add_main_menu2() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'website_style';
    $data_field_name = 'website_style'; 
	$opt_name2 = 'custom_css_style';
    $data_field_name2 = 'custom_css_style';
	$opt_name3 = 'custom_favicon';
    $data_field_name3 = 'custom_favicon';
	$opt_name6 = 'logo_type';
    $data_field_name6 = 'logo_type';
	$opt_name9 = 'tagline_disable';
    $data_field_name9 = 'tagline_disable';
	$opt_name11 = "analytics_code";
	$data_field_name11= "analytics_code";
	$opt_name12 = 'front_page';
    $data_field_name12 = 'front_page';
	$opt_name16 = 'flow_testimonials';
    $data_field_name16 = 'flow_testimonials';
	$opt_name17 = 'flow_portfolio_hover_type';
    $data_field_name17 = 'flow_portfolio_hover_type';
	$opt_name18 = 'flow_portfolio_fixed_menu';
    $data_field_name18 = 'flow_portfolio_fixed_menu';
	$opt_name19 = 'flow_portfolio_orderbymethod';
    $data_field_name19 = 'flow_portfolio_orderbymethod';
	$opt_name20 = 'flow_showcase_mode';
    $data_field_name20 = 'flow_showcase_mode';
	$opt_name21 = 'flow_featured_slideshow';
    $data_field_name21 = 'flow_featured_slideshow';
	
    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val2 = get_option( $opt_name2 );
	$opt_val3 = get_option( $opt_name3 );
	$opt_val6 = get_option( $opt_name6 );
	$opt_val7 = get_option( $opt_name7 );
	$opt_val9 = get_option( $opt_name9 );
	$opt_val11 = get_option( $opt_name11 );
	$opt_val12 = get_option( $opt_name12 );
	$opt_val16 = get_option( $opt_name16 );
	$opt_val17 = get_option( $opt_name17 );
	$opt_val18 = get_option( $opt_name18 );
	$opt_val19 = get_option( $opt_name19 );
	$opt_val20 = get_option( $opt_name20 );
	$opt_val21 = get_option( $opt_name21 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val3 = $_POST[ $data_field_name3 ];
        $opt_val6 = $_POST[ $data_field_name6 ];
        $opt_val7 = $_POST[ $data_field_name7 ];
        $opt_val9 = $_POST[ $data_field_name9 ];
        $opt_val11 = stripslashes($_POST[ $data_field_name11 ]);
        $opt_val12 = $_POST[ $data_field_name12 ];
        $opt_val16 = $_POST[ $data_field_name16 ];
        $opt_val17 = $_POST[ $data_field_name17 ];
        $opt_val18 = $_POST[ $data_field_name18 ];
        $opt_val19 = $_POST[ $data_field_name19 ];
        $opt_val20 = $_POST[ $data_field_name20 ];
        $opt_val21 = $_POST[ $data_field_name21 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name3, $opt_val3 );
        update_option( $opt_name6, $opt_val6 );
        update_option( $opt_name7, $opt_val7 );
        update_option( $opt_name9, $opt_val9 );
        update_option( $opt_name11, $opt_val11 );
        update_option( $opt_name12, $opt_val12 );
        update_option( $opt_name16, $opt_val16 );
        update_option( $opt_name17, $opt_val17 );
        update_option( $opt_name18, $opt_val18 );
        update_option( $opt_name19, $opt_val19 );
        update_option( $opt_name20, $opt_val20 );
        update_option( $opt_name21, $opt_val21 );

        // Put an settings updated message on the screen
?>
<div class="updated"><p><strong><?php _e('Settings Saved', 'flowthemes' ); ?></strong></p></div>
<?php 
    }
    // Now display the settings editing screen
    echo '<div class="wrap">';
    // header
    echo "<h2>" . __( 'General Settings', 'flowthemes' ) . "</h2>";
    // settings form
    ?>
<form name="form-main-page" method="post" action="">

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Logo</th>
		<td><input type="text" name="<?php echo $data_field_name6; ?>" value="<?php echo $opt_val6; ?>"></input><span href="#" title="" class="briskuploader button">Upload</span><br/><div class="briskuploader_preview"></div>

		<p>WordPress will display text logo and tagline unless you put a link to image logo here. Text logo and tagline can be modified in Settings > General. Once you put here a link to some image the text logo as well as tagline will be replaced with it.</p>
		</td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Tagline</th>
		<td><?php 	if($opt_val9 == "1"){
			$first9 = 'selected="selected"';
		}else{
			$zero9 = 'selected="selected"';
		}
		?><select name="<?php echo $data_field_name9; ?>">
		<option value="0" <?php echo $zero9; ?>>Show tagline</option>
		<option value="1" <?php echo $first9; ?>>Disable tagline</option>
		</select><p>You can enable or disable logo tagline here.</p>
		</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Favicon</th>
			<td><input type="text" name="<?php echo $data_field_name3; ?>" value="<?php echo $opt_val3; ?>"></input><span href="#" title="" class="briskuploader button">Upload</span><br/><div class="briskuploader_preview"></div><p>Upload your favicon here.</p>
			</td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Style</th>
			<td><?php if($opt_val == "1"){
				$first = 'selected="selected"';
			}else{
				$zero = 'selected="selected"';
			}
			?><select name="<?php echo $data_field_name; ?>">
			<option value="0" <?php echo $zero; ?>>Dark</option>
			<option value="1" <?php echo $first; ?>>Light</option>
			</select><p>Pick light or dark website style (light is experimental, beta!).</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Frontpage showcase mode</th>
			<td>
				<?php 	if($opt_val20 == "2"){
					$first20 = 'selected="selected"';
				}else if($opt_val20 == "3"){
					$second20 = 'selected="selected"';
				}else{
					$zero20 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name20; ?>">
					<option value="1" <?php echo $zero20; ?>>Thumbnails</option>
					<option value="2" <?php echo $first20; ?>>Projects list</option>
					<!--<option value="3" <?php echo $second20; ?>>Featured content slideshow</option>-->
				</select>
				<p>Choose frontpage showcase mode.</p>
			</td>
		</tr>

		<tr valign="top">
        <th scope="row">Frontpage slideshow</th>
			<td><?php if($opt_val21 == "1"){
				$first21 = 'selected="selected"';
			}else{
				$zero21 = 'selected="selected"';
			}
			?><select name="<?php echo $data_field_name21; ?>">
			<option value="0" <?php echo $zero21; ?>>Enable</option>
			<option value="1" <?php echo $first21; ?>>Disable</option>
			</select><p>Slides are editable under [Slideshow > Add New]. Slideshow is displayed as "welcome" page before everything else.</p>
			</td>
		</tr>
		
        <!-- <tr valign="top">
        <th scope="row">Front Page</th>
        <td><select name="<?php //echo $data_field_name12; ?>"><option value="">None</option><?php 
			//$pages = get_pages();
			//	foreach ($pages as $pagg) {
			//	print("<option value=\"".$pagg->ID."\"".(($opt_val12==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
		//	}
		  ?></select><br/>
		<p>Pick some page that will be displayed as front page above blog and below slideshow.</p>
		</td>
        </tr> -->
        <tr valign="top">
        <th scope="row">Thumbnails mouse rollover effect</th>
        <td>
		<?php 	if($opt_val17 == "1"){
			$first17 = 'selected="selected"';
		}else{
			$zero17 = 'selected="selected"';
		}
		?>
		<select name="<?php echo $data_field_name17; ?>">
			<option value="0" <?php echo $zero17; ?>>Standard mouse over</option>
			<option value="1" <?php echo $first17; ?>>Mouse over with color and description</option>
		</select>
		<p>Choose thumbnails mouse over effect.</p>
		</td>
		</tr>

		<!--<tr valign="top">
			<th scope="row">Top navigation mode</th>
			<td>
				<?php 	if($opt_val18 == "1"){
					$first18 = 'selected="selected"';
				}else if($opt_val18 == "2"){
					$second18 = 'selected="selected"';
				}else{
					$zero18 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name18; ?>">
					<option value="0" <?php echo $zero18; ?>>Standard moving menu</option>
					<option value="1" <?php echo $first18; ?>>Fixed menu (moving on project pages)</option>
					<option value="2" <?php echo $second18; ?>>Fixed menu</option>
				</select>
				<p>Choose left menu mode (moving or fixed).</p>
			</td>
		</tr>-->

        <tr valign="top">
        <th scope="row">Portfolio thumbnails order by</th>
        <td>
		<?php 	if($opt_val19 == "1"){
			$first19 = 'selected="selected"';
		}else{
			$zero19 = 'selected="selected"';
		}
		?>
		<select name="<?php echo $data_field_name19; ?>">
		<option value="0" <?php echo $zero19; ?>>Random</option>
		<option value="1" <?php echo $first19; ?>>Date</option>
	</select>
		<p></p>
		</td>
		</tr>
	
        <tr valign="top">
        <th scope="row">Tracking Code</th>
        <td><textarea rows="6" cols="50" name="<?php echo $data_field_name11; ?>"><?php echo stripslashes($opt_val11); ?></textarea><br/>
		<p>Put Google Analytics code here to instantly start tracking your stats.<br/> (Optional: You may also put here any code that should appear just before &lt;/body&gt; tag).</p>
		</td>
        </tr>
		
		<tr valign="top">
        <th scope="row">Custom CSS Code</th>
        <td><textarea rows="6" cols="50" name="<?php echo $data_field_name2; ?>"><?php echo $opt_val2; ?></textarea>
		<p>Put here your custom CSS code in addition to standard CSS code.</p>
		</td>
        </tr>
	
       <!-- <tr valign="top">
        <th scope="row">Testimonials Widget</th>
        <td>
		<script type="text/javascript">
        //$(function() {
		jQuery(document).ready(function(){
            var i = jQuery('#flow_testimonials li').size() + 1;
            jQuery('a#add').click(function() {
                jQuery('<li>Testimonial ' + i + ': <input type="text" name="<?php //echo $data_field_name16; ?>[ ]"></li>').appendTo('ul#flow_testimonials');
                i++;
            });
            jQuery('a#remove').click(function() {
                jQuery('#flow_testimonials li:last').remove();
                if (i == 1) {
				
				} else {
                i--;
                } 
            });
			});
       // })();
		</script>
		<?php 
		//if($_POST['flow_testimonials'] != ''){
		//$testimonials = $_POST['flow_testimonials'];
		// Note that $testimonials will be an array.
	//	echo '<ul id="flow_testimonials">';
		//$i = 1;
		//foreach ($testimonials as $testimonial) { ?>
			<li>Testimonial <?php // echo $i; $i++; ?>: <input type="text" name="<?php //echo $data_field_name16; ?>[ ]" value="<?php //echo stripslashes($testimonial); ?>"></li>
		<?php //} ?>
		</ul>
		<?php //}else{
		//$i = 1;
		?>
		<ul id="flow_testimonials">
		<?php 
		//if(is_array($opt_val16)){
		//foreach($opt_val16 as $opt_val16_piece){ ?>
			<li>Testimonial <?php //echo $i; $i++; ?>: <input type="text" name="<?php //echo $data_field_name16; ?>[ ]" value="<?php //echo stripslashes($opt_val16_piece); ?>"></li>
		<?php //} 
		//} ?>
		</ul>
		<?php //} ?>
		<a href="#" onclick="javascript:return false;" id="add">Add testimonial field</a><br />
		<a href="#" onclick="javascript:return false;" id="remove">Remove testimonial field</a>
		<br/>
		<p>You can add testimonials to testimonials widget here. By using ^ separator you can separate testimonial text from quote author.<br />
		Example: <strong>This is some testimonial.^Flow</strong><br />
		In this case "This is some testimonial" will be displayed as quoted text and "Flow" will be its author.<br />
		You shouldn't leave any empty fields because they will be treated as blank testimonials. You should SAVE settings after you've done editing testimonials.</p>
		</td>
        </tr>-->
    </table> 

	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	<p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>
</form>
<?php } ?>