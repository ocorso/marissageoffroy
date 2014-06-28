<?php 
function add_main_menu2(){

    //must check that the user has the required capability 
    if(!current_user_can('manage_options')){
		wp_die(__('You do not have sufficient permissions to access this page.', 'flowthemes'));
    }

    // variables for the field and option names 
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'flow_logo';
    $data_field_name = 'flow_logo';
	$opt_name26 = 'flow_logo_svg';
    $data_field_name26 = 'flow_logo_svg';
	$opt_name9 = 'flow_tagline';
    $data_field_name9 = 'flow_tagline';
	$opt_name3 = 'flow_favicon';
    $data_field_name3 = 'flow_favicon';
	
	$opt_name2 = 'custom_css_style';
    $data_field_name2 = 'custom_css_style'; //ok
	//$opt_name4 = 'welcome_text';
	//$data_field_name4 = 'welcome_text';
	$opt_name5 = 'portfolio_mode';
    $data_field_name5 = 'portfolio_mode';	//ok
	$opt_name7 = 'portfolio_recent';
    $data_field_name7 = 'portfolio_recent';	//ok
	$opt_name8 = 'blog_recent';
    $data_field_name8 = 'blog_recent';		//ok
	$opt_name10 = 'info_box';
    $data_field_name10 = 'info_box';		//ok
	//$opt_name11 = "analytics_code";
	//$data_field_name11= "analytics_code";	//moved to footer 1.9
	$opt_name12 = 'front_page';
    $data_field_name12 = 'front_page';		//ok
	$opt_name13 = 'flow_portfolio_page';
    $data_field_name13 = 'flow_portfolio_page';	//ok
	$opt_name14 = 'flow_blog_page';
    $data_field_name14 = 'flow_blog_page';		//ok
	$opt_name15 = 'flow_homepage_shuffle_button';
    $data_field_name15 = 'flow_homepage_shuffle_button';	//ok
	$opt_name16 = 'flow_mobile_app_icon';
    $data_field_name16 = 'flow_mobile_app_icon';	//ok
	
	//$opt_name19 = 'flow_portfolio_orderbymethod';
	//$data_field_name19 = 'flow_portfolio_orderbymethod';	//ok
	$opt_name21 = 'flow_featured_slideshow';
    $data_field_name21 = 'flow_featured_slideshow';		//ok
	
	$opt_name22 = 'flow_wpml_switcher';
    $data_field_name22 = 'flow_wpml_switcher'; //ok
	$opt_name23 = 'flow_wpml_left';
	
	//$opt_name25 = 'flow_portfolio_home_exclude';
	//$data_field_name25 = 'flow_portfolio_home_exclude';

	$opt_name27 = 'flow_seo_module';
    $data_field_name27 = 'flow_seo_module'; //ok	
	
	$opt_name28 = 'flow_support_login';
    $data_field_name28 = 'flow_support_login'; //ok	
	$opt_name29 = 'flow_support_password';
    $data_field_name29 = 'flow_support_password'; //ok
	
    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val26 = get_option( $opt_name26 );
	$opt_val2 = get_option( $opt_name2 );
	$opt_val3 = get_option( $opt_name3 );
	//$opt_val4 = get_option( $opt_name4 );
	$opt_val5 = get_option( $opt_name5 );
	$opt_val7 = get_option( $opt_name7 );
	$opt_val8 = get_option( $opt_name8 );
	$opt_val9 = get_option( $opt_name9 );
	$opt_val10 = get_option( $opt_name10 );
	//$opt_val11 = get_option( $opt_name11 );
	$opt_val12 = get_option( $opt_name12 );
	$opt_val13 = get_option( $opt_name13 );
	$opt_val14 = get_option( $opt_name14 );
	$opt_val15 = get_option( $opt_name15 );
	$opt_val16 = get_option( $opt_name16 );

	//$opt_val19 = get_option( $opt_name19 );
	$opt_val21 = get_option( $opt_name21 );
	
	$opt_val22 = get_option( $opt_name22 );
	
	//$opt_val25 = get_option( $opt_name25 );
	$opt_val27 = get_option( $opt_name27 );
	
	$opt_val28 = get_option( $opt_name28 );
	$opt_val29 = get_option( $opt_name29 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val = $_POST[ $data_field_name ];
		$opt_val26 = $_POST[ $data_field_name26 ];
		
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val3 = $_POST[ $data_field_name3 ];
        //$opt_val4 = $_POST[ $data_field_name4 ];
        $opt_val5 = $_POST[ $data_field_name5 ];
        $opt_val7 = $_POST[ $data_field_name7 ];
        $opt_val8 = $_POST[ $data_field_name8 ];
        $opt_val9 = $_POST[ $data_field_name9 ];
        $opt_val10 = $_POST[ $data_field_name10 ];
        //$opt_val11 = $_POST[ $data_field_name11 ];
        $opt_val12 = $_POST[ $data_field_name12 ];
        $opt_val13 = $_POST[ $data_field_name13 ];
        $opt_val14 = $_POST[ $data_field_name14 ];
        $opt_val15 = $_POST[ $data_field_name15 ];
        $opt_val16 = $_POST[ $data_field_name16 ];

		//$opt_val19 = $_POST[ $data_field_name19 ];
        $opt_val21 = $_POST[ $data_field_name21 ];
		
        $opt_val22 = $_POST[ $data_field_name22 ];
		
		//$opt_val25 = $_POST[ $data_field_name25 ];
        $opt_val27 = $_POST[ $data_field_name27 ];
		
        $opt_val28 = $_POST[ $data_field_name28 ];
		
		//if(md5($_POST[ $data_field_name29 ]) == $opt_val29){
			$opt_val29 = $_POST[ $data_field_name29 ];
		//}else{
			//$opt_val29 = md5($_POST[ $data_field_name29 ]);
		//}

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name26, $opt_val26 );
		
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name3, $opt_val3 );
		//update_option( $opt_name4, $opt_val4 );
        update_option( $opt_name5, $opt_val5 );
		
        update_option( $opt_name7, $opt_val7 );
        update_option( $opt_name8, $opt_val8 );
        update_option( $opt_name9, $opt_val9 );
        update_option( $opt_name10, $opt_val10 );
        //update_option( $opt_name11, $opt_val11 );
        update_option( $opt_name12, $opt_val12 );
        update_option( $opt_name13, $opt_val13 );
        update_option( $opt_name14, $opt_val14 );
        update_option( $opt_name15, $opt_val15 );
        update_option( $opt_name16, $opt_val16 );

        //update_option( $opt_name19, $opt_val19 );
        update_option( $opt_name21, $opt_val21 );
		
        update_option( $opt_name22, $opt_val22 );
		
		//update_option( $opt_name25, $opt_val25 );
        update_option( $opt_name27, $opt_val27 );
		
        update_option( $opt_name28, $opt_val28 );
        update_option( $opt_name29, $opt_val29 );

        // Put an settings updated message on the screen
?>
<div class="updated"><p><strong><?php _e('Settings Saved', 'flowthemes' ); ?></strong></p></div>
<?php } ?>
<div class="wrap">
	<h2><?php _e('General Settings', 'flowthemes'); ?></h2>
	<form name="form-main-page" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	
    <table class="form-table">
        <tr valign="top">
			<th scope="row"><?php _e('Logo', 'flowthemes'); ?></th>
			<td>
				<div class="flowuploader">
					<input class="flowuploader_media_url" type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" />
					<span class="flowuploader_upload_button button"><?php _e('Upload', 'flowthemes'); ?></span>
					<div class="flowuploader_media_preview_image"></div>
				</div>
				<p><?php _e('WordPress will display text logo and tagline unless you put a link to image logo here or below. Allowed formats: PNG, JPG, GIF, ICO. Recommended size (demo size): around 150x40px. Text logo and tagline can be modified under [Settings > General].', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('SVG Logo', 'flowthemes'); ?></th>
			<td>
				<div class="flowuploader">
					<input class="flowuploader_media_url" type="text" name="<?php echo $data_field_name26; ?>" value="<?php echo $opt_val26; ?>" />
					<span class="flowuploader_upload_button button"><?php _e('Upload', 'flowthemes'); ?></span>
					<div class="flowuploader_media_preview_image"></div>
				</div>
				<p><?php _e('You can upload here SVG (vector) logo. It is supported by all modern browsers and devices. For IE6, IE7 and IE8 you still need to provide raster logo.', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Tagline', 'flowthemes'); ?></th>
			<td>
				<?php
				$first9 = '';
				$zero9 = '';
				if($opt_val9 == "1"){
					$first9 = 'selected="selected"';
				}else{
					$zero9 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name9; ?>">
					<option value="0" <?php echo $zero9; ?>><?php _e('Show tagline', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first9; ?>><?php _e('Disable tagline', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('You can enable or disable logo tagline here. It works only with text logo.', 'flowthemes'); ?></p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Favicon', 'flowthemes'); ?></th>
			<td>
				<div class="flowuploader">
					<input class="flowuploader_media_url" type="text" name="<?php echo $data_field_name3; ?>" value="<?php echo $opt_val3; ?>" />
					<span class="flowuploader_upload_button button"><?php _e('Upload', 'flowthemes'); ?></span>
					<div class="flowuploader_media_preview_image"></div>
				</div>
				<p><?php _e('Favicon (Favorite icon) is most commonly 16x16px in ICO format. Other formats such as PNG, JPG, SVG are also allowed but browser compatibility may be worse.', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Mobile Application Icon', 'flowthemes'); ?></th>
			<td>
				<div class="flowuploader">
					<input class="flowuploader_media_url" type="text" name="<?php echo $data_field_name16; ?>" value="<?php echo $opt_val16; ?>" />
					<span class="flowuploader_upload_button button"><?php _e('Upload', 'flowthemes'); ?></span>
					<div class="flowuploader_media_preview_image"></div>
				</div>
				<p><?php _e('Optional 114x114px (PNG) icon for mobile devices and tablets.', 'flowthemes'); ?></p>
			</td>
        </tr>

		<tr valign="top">
			<th scope="row"><?php _e('Homepage Mode', 'flowthemes'); ?></th>
			<td>
				<?php 
				$first5 = '';
				$zero5 = '';
				if($opt_val5 == "1"){
					$first5 = 'selected="selected"';
				}else{
					$zero5 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name5; ?>">
					<option value="0" <?php echo $zero5; ?>><?php _e('Classic', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first5; ?>><?php _e('Thumbnail grid', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('Pick homepage mode here.', 'flowthemes'); ?></p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e('Frontpage slideshow (Classic Mode only)', 'flowthemes'); ?></th>
			<td>
				<?php 
				$first21 = '';
				$zero21 = '';
				if($opt_val21 == "1"){
					$first21 = 'selected="selected"';
				}else{
					$zero21 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name21; ?>">
					<option value="0" <?php echo $zero21; ?>><?php _e('Enable', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first21; ?>><?php _e('Disable', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('You can add slides under [Slideshow > Add New].', 'flowthemes'); ?></p>
			</td>
		</tr>		
		
		<tr valign="top">
			<th scope="row"><?php _e('Frontpage recent portfolio entries (Classic Mode only)', 'flowthemes'); ?></th>
			<td>
				<?php 
				$first7 = '';
				$zero7 = '';
				if($opt_val7 == "1"){
					$first7 = 'selected="selected"';
				}else{
					$zero7 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name7; ?>">
					<option value="0" <?php echo $zero7; ?>><?php _e('Enable', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first7; ?>><?php _e('Disable', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('Choose if you\'d like to display recent portfolio entries on front page or not.', 'flowthemes'); ?></p>
			</td>
		</tr>		
		
		<tr valign="top">
			<th scope="row"><?php _e('Frontpage recent blog entries (Classic Mode only)', 'flowthemes'); ?></th>
			<td>
				<?php 
				$first8 = '';
				$zero8 = '';
				if($opt_val8 == "1"){
					$first8 = 'selected="selected"';
				}else{
					$zero8 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name8; ?>">
					<option value="0" <?php echo $zero8; ?>><?php _e('Enable', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first8; ?>><?php _e('Disable', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('Choose if you\'d like to display recent blog entries on front page or not.', 'flowthemes'); ?></p>
			</td>
		</tr>
		
        <tr valign="top">
			<th scope="row"><?php _e('Front Page', 'flowthemes'); ?></th>
			<td>
				<select name="<?php echo $data_field_name12; ?>">
					<option value=""><?php _e('None', 'flowthemes'); ?></option>
					<?php 
					$pages = get_pages();
					foreach ($pages as $pagg) {
						print("<option value=\"".$pagg->ID."\"".(($opt_val12==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
					}
					?>
				</select>
				<p><?php _e('Pick some page that will be displayed as your front page. This page\'s options (custom field values) will take effect on front page! So, please use this page to exclude footer columns from front page or to exclude portfolio categories from front page. Please set [Settings > Reading] to "Your Latest Posts" and both "Front Page" and "Posts Page" to "None".', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Top Drag-down Panel', 'flowthemes'); ?></th>
			<td>
				<select name="<?php echo $data_field_name10; ?>">
					<option value=""><?php _e('None', 'flowthemes'); ?></option>
					<?php 
						$pages = get_pages();
						foreach ($pages as $pagg) {
							print("<option value=\"".$pagg->ID."\"".(($opt_val10==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
						}
					?>
				</select>
				<p><?php _e('Specify the page that will be displayed as the top Drag-down Panel.', 'flowthemes'); ?></p>
			</td>
        </tr>		
		
		<tr valign="top">
			<th scope="row"><?php _e('Portfolio Page', 'flowthemes'); ?></th>
			<td><select name="<?php echo $data_field_name13; ?>"><option value=""><?php _e('None', 'flowthemes'); ?></option><?php 
				$pages = get_pages();
				foreach ($pages as $pagg) {
					print("<option value=\"".$pagg->ID."\"".(($opt_val13==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
				}
			  ?></select><br/>
			<p><?php _e('Select your main portfolio page (used to setup permalinks such as "back" or "view portfolio"). "Back" button can be specified per-item basis as well.', 'flowthemes'); ?></p>
			</td>
        </tr>		
		
		<tr valign="top">
			<th scope="row"><?php _e('Blog Page', 'flowthemes'); ?></th>
			<td>
				<select name="<?php echo $data_field_name14; ?>">
					<option value=""><?php _e('None', 'flowthemes'); ?></option>
					<?php
						$pages = get_pages();
						foreach ($pages as $pagg) {
							print("<option value=\"".$pagg->ID."\"".(($opt_val14==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
						}
					?>
				</select>
				<p><?php _e('Select your main blog page (used to setup permalinks such as "back" or "view blog").', 'flowthemes'); ?></p>
			</td>
        </tr>

		<!-- <tr valign="top">
			<th scope="row"><?php //_e('Shuffle Button on Front Page', 'flowthemes'); ?></th>
			<td>
				<?php //$checked = null; if($opt_val15 == "1"){ $checked = 'checked'; } ?>
				<div class="checkbox">
					<input id="<?php //echo $data_field_name15; ?>" name="<?php //echo $data_field_name15; ?>" <?php //echo $checked; ?> type="checkbox" value="1" />
					<label for="<?php //echo $data_field_name15; ?>"><span></span></label>
				</div>
				<p><?php //_e('Please note that this works only for front page. Portfolio PAGES have similar option under [Pages > Your Portfolio Page].', 'flowthemes'); ?></p>
			</td>
		</tr> -->
		
		<tr valign="top">
			<th scope="row"><?php _e('WPML Language Switcher (Header)', 'flowthemes'); ?></th>
			<td>
				<?php $checked = null; if($opt_val22 == "1"){ $checked = 'checked'; } ?>
				<div class="checkbox">
					<input id="<?php echo $data_field_name22; ?>" name="<?php echo $data_field_name22; ?>" <?php echo $checked; ?> type="checkbox" value="1" />
					<label for="<?php echo $data_field_name22; ?>"><span></span></label>
				</div>
				<p><?php _e('This is used only if you have WPML plugin installed.', 'flowthemes'); ?></p>
			</td>
		</tr>
				
		<tr valign="top">
			<th scope="row"><?php _e('SEO Module', 'flowthemes'); ?></th>
			<td>
				<?php 
				$zero27 = null;
				$first27 = null;
				
				if($opt_val27 == "1"){
					$first27 = 'selected="selected"';
				}else{
					$zero27 = 'selected="selected"';
				}
				?>
				<select name="<?php echo $data_field_name27; ?>">
					<option value="0" <?php echo $zero27; ?>><?php _e('Enable', 'flowthemes'); ?></option>
					<option value="1" <?php echo $first27; ?>><?php _e('Disable', 'flowthemes'); ?></option>
				</select>
				<p><?php _e('This theme has some SEO tools added (see "SEO" section in the documentation for details). You can disable SEO module here if you are planning to use some other plugin to handle that.', 'flowthemes'); ?></p>
			</td>
		</tr>
		
		<!-- <tr valign="top">
			<th scope="row"><?php //_e('Portfolio thumbnails order by', 'flowthemes'); ?></th>
			<td>
				<?php
				/* $first19 = '';
				$zero19 = '';
				if($opt_val19 == "1"){
					$first19 = 'selected="selected"';
				}else{
					$zero19 = 'selected="selected"';
				} */
				?>
				<select name="<?php //echo $data_field_name19; ?>">
					<option value="0" <?php //echo $zero19; ?>><?php //_e('Date (recommended)', 'flowthemes'); ?></option>
					<option value="1" <?php //echo $first19; ?>><?php //_e('Random', 'flowthemes'); ?></option>
				</select>
			</td>
		</tr> -->
		
		<?php
			/* $page_portfolio_options = array();
			$page_portfolio_categories = get_terms("portfolio_category", "hide_empty=0");
			for($h=0;$h<count($page_portfolio_categories);$h++){
				$page_portfolio_options[$page_portfolio_categories[$h]->slug] = $page_portfolio_categories[$h]->name;
			}
			$options = $page_portfolio_options;
			$value = $opt_val25; */
		?>
		<!-- <tr>
			<th scope="row"><?php //_e('Exclude Homepage Portfolio Categories', 'flowthemes'); ?></th>
			<td>
				<select multiple="multiple" name="<?php //echo $data_field_name25; ?>[]">
				<?php //foreach ($options as $optionkey => $optionval){ ?>
					<option value="<?php //echo $optionkey; ?>" <?php //if((is_array($value) && in_array($optionkey,$value)) || (is_string($value) && $optionkey == $value)) echo ' selected="selected"'; ?>><?php //echo $optionval; ?></option>
				<?php //} ?>
				</select>
			</td>
		</tr> -->
		
		<!-- <tr valign="top">
			<th scope="row"><?php //_e('Homepage Welcome Text', 'flowthemes'); ?></th>
			<td>
				<textarea rows="6" cols="50" name="<?php //echo $data_field_name4; ?>"><?php //echo stripslashes($opt_val4); ?></textarea><br/>
				<p><?php //_e('Put here homepage welcome text. Leave blank to skip it. Each individual Portfolio page allow different welcome text. You can configure it in page settings.', 'flowthemes'); ?></p>
			</td>
        </tr> -->
		
		<tr valign="top">
			<th scope="row"><?php _e('Custom CSS Code', 'flowthemes'); ?></th>
			<td id="custom_css">
				<textarea id="custom_css_style" rows="6" cols="50" name="<?php echo $data_field_name2; ?>"><?php echo stripslashes($opt_val2); ?></textarea>
				<dl>
					<dt><?php _e('Put here your custom CSS code in addition to standard CSS code or overwrite existing CSS. The advantage of this field is that the code here will not get overwritten when you update theme! It will be stored in the database in "custom_css_style" custom field.', 'flowthemes'); ?></dt>
				</dl>
				<dl>
					<dt><?php _e('<a href="javascript:autoFormatSelection()">Autoformat Selected</a> - Select entire code and click this to clean it.', 'flowthemes'); ?></dt>
					<dt><?php _e('<a href="javascript:commentSelection(true)">Comment Selected</a> - Select a part of code and click this to comment it out.', 'flowthemes'); ?></dt>
					<dt><?php _e('<a href="javascript:commentSelection(false)">Uncomment Selected</a> - Select a part of commented out code and click this to uncomment.', 'flowthemes'); ?></dt>
				</dl>
				<dl>
					<?php _e('<dt>Matches Highlighter</dt><dd>Matches of selected text will highlight on select.</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Ctrl-F / Cmd-F</dt><dd>Start searching</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Ctrl-G / Cmd-G</dt><dd>Find next</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Shift-Ctrl-G / Shift-Cmd-G</dt><dd>Find previous</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Shift-Ctrl-F / Cmd-Option-F</dt><dd>Replace</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Shift-Ctrl-R / Shift-Cmd-Option-F</dt><dd>Replace all</dd>', 'flowthemes'); ?>
					<?php _e('<dt>F11</dt><dd>Press F11 when cursor is in the editor to toggle full screen editing.</dd>', 'flowthemes'); ?>
					<?php _e('<dt>Esc</dt><dd>Esc can also be used to exit full screen editing.</dd>', 'flowthemes'); ?>
					<!-- <dt>Auto-close/complete</dt><dd>Type an html tag.  When you type '>' or '/', the tag will auto-close/complete.  Block-level tags will indent.</dd> -->
				</dl>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Support Forum Login and Password', 'flowthemes'); ?></th>
			<td>
			
				<?php $verify_account = getRemote_verifyUser($opt_val28, $opt_val29); ?>
				<?php if($verify_account){ ?>
					<!-- <p><b><?php //echo $verify_account; ?></b></p> -->
					<div style="font-size: 14px; padding: 10px; background-color: #eee; color: #777; margin-bottom: 10px;"><?php echo $verify_account; ?></div>
				<?php } ?>
				
				<?php if(empty($opt_val28) || empty($opt_val29)){ ?>
					<div style="font-size: 14px; padding: 10px; background-color: #cc3333; color: #ffffff; margin-bottom: 10px;"><?php _e('Your login and/or password are missing. Auto-update module is disabled without this information.', 'flowthemes'); ?></div>
				<?php }else{ ?>
				<?php } ?>
				<?php _e('Login:', 'flowthemes'); ?> <input type="text" name="<?php echo $data_field_name28; ?>" value="<?php echo esc_attr($opt_val28); ?>">
				<?php _e('Password:', 'flowthemes'); ?> <input type="password" name="<?php echo $data_field_name29; ?>" value="<?php echo esc_attr($opt_val29); ?>">
				<p><?php _e('Password is NOT encrypted in the local database (but it is encrypted on our server).', 'flowthemes'); ?></p>
			</td>
        </tr>
    </table>
	<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes') ?>" /></p>
</form>
<?php } ?>