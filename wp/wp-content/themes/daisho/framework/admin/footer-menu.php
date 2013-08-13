<?php
function add_footer_menu(){

    // must check that the user has the required capability 
    if (!current_user_can('manage_options')){
		wp_die(__('You do not have sufficient permissions to access this page.', 'flowthemes'));
    }

    // variables for the field and option names
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'analytics_code';
    $data_field_name = 'custom_css_style';
	$opt_name2 = 'footer_col_countcustom';
    $data_field_name2 = 'footer_col_countcustom';
	$opt_name4 = 'footer_aff_link';
    $data_field_name4 = 'footer_aff_link';

    // Read in existing option value from database
    $opt_val = stripslashes(get_option( $opt_name ));
    $opt_val2 = get_option( $opt_name2 );
    $opt_val4 = get_option( $opt_name4 );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if(isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y'){
        // Read their posted value
        $opt_val = stripslashes($_POST[$data_field_name]);
        $opt_val2 = $_POST[ $data_field_name2 ];
        $opt_val4 = $_POST[ $data_field_name4 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name2, $opt_val2 );
        update_option( $opt_name4, $opt_val4 );

        // Put an settings updated message on the screen
?>
<div class="updated"><p><strong><?php _e('Settings Saved', 'flowthemes' ); ?></strong></p></div>
<?php } ?>
<div class="wrap">
	<h2><?php _e('Footer Settings', 'flowthemes'); ?></h2>
	<form name="form-footer-analytics" method="post" action="">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<table class="form-table" style="width:50%;float:left;">
			<tr valign="top">
				<th scope="row" style="width: 12%;"><?php _e('Footer columns', 'flowthemes'); ?></th>
				<td>
					<textarea style="width: 100%;" rows="6" cols="70" name="<?php echo $data_field_name2; ?>"><?php echo $opt_val2; ?></textarea>
					<p><?php _e('Put here a list of comma-separated CSS classes to create footer columns and widget areas. For instance if you\'d like to create 4 equal columns (25% each) you would use: grid_3,grid_3,grid_3,grid_3. To create 3 columns (33% each) you would use grid_4,grid_4,grid_4. Each column is 8.(3)% wide. When you create column, new sidebar gets created with <code>flow-footer-ID</code> ID (where ID is number like 1, 2, 3 etc.).', 'flowthemes'); ?></p>
				</td>
			</tr>
				
			<tr valign="top">
				<th scope="row" style="width: 12%;"><?php _e('Custom Code (like Google Analytics Tracking Code)', 'flowthemes'); ?></th>
				<td id="custom_css">
					<textarea id="custom_css_style" rows="6" cols="50" name="<?php echo $data_field_name; ?>"><?php echo stripslashes($opt_val); ?></textarea>
					<dl>
						<dt><?php _e('Put Google Analytics code here to instantly start tracking your stats.<br/> (Optional: You may also put here any code (HTML or JS) that should appear just before &lt;/body&gt; tag). Adding &lt;script&gt; tag is necessary! Usage: <code>&lt;script&gt;code goes here&lt;/script&gt;</code> or <code>&lt;style type="text/css"&gt;CSS code goes here&lt;/style&gt;</code>', 'flowthemes'); ?></dt>
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
			
			<tr>
				<th style="width: 12%;"><?php _e('Link Back', 'flowthemes'); ?></th>
				<td>
					<input type="checkbox" name="<?php echo $data_field_name4; ?>"<?php if($opt_val4){ print(" checked=\"checked\""); } ?>>
					<p><?php _e('Small link back in footer. It is not required but much appreciated. Please note that checking this disables link and unchecking enables it.', 'flowthemes'); ?></p>
				</td>
			</tr>
			
		</table>
		<style type="text/css">
			.flow-footers-guide { background-color: #fafafa; width: 47.5%; margin-left: 2.5%; float: left;min-height: 700px; padding: 2%; box-sizing: border-box; -moz-box-sizing: border-box; color: #666; }
			.flow-footers-guide small { font-size: 11px; color: #888; }
			
			.m-example-table { margin-bottom: 1em; }
			.m-example-table td { padding: 10px 10px 8px 10px; border-bottom: 1px solid #dadada; }
			.m-example-table th { border-bottom: 1px solid #dadada; padding: 10px 10px 8px 10px; text-align: left; }
			.m-footer-column-2, .m-footer-column-4, .m-footer-column-6, .m-footer-column-8, .m-footer-column-12 { background-color: #F1F1F1; border: 1px solid #DADADA; border-radius: 2px 2px 2px 2px; color: #999999; float: left; font-family: Arial; font-size: 10px; height: 20px; line-height: 190%; margin: 0 2px 2px 0; text-align: center; text-shadow: 1px 1px #FFFFFF; position: relative; }
			
			.m-footer-column-2 { width: 18px; }
			.m-footer-column-4 { width: 40px; }
			.m-footer-column-6 { width: 62px; }
			.m-footer-column-8 { width: 84px; }
			.m-footer-column-12 { width: 128px; }
			
			.m-footer-column-inactive { background-color: transparent; border: 1px dashed #DDDDDD; }
			
			.example-wrapper { width: 132px; display: table; margin: 0 auto; }
			.example-wrapper:hover div { background-color: #bcdffb; border: 1px solid #60afea; cursor: pointer; color: #2897f0; text-shadow: 1px 1px #cfecff; }
			.dot-blue { height: 3px; width: 3px; right: 3px; top: 3px; position: absolute; background-color: #2897f0; }
			.dot-red { height: 3px; width: 3px; right: 3px; top: 3px; position: absolute; background-color: #ee0000; }
			
			.can-have { color: yellowgreen; font-family: arial; font-size: 11px; font-weight: bold; text-transform: uppercase; }
			.cant-have { color: orangered; font-family: arial; font-size: 11px; font-weight: bold; text-transform: uppercase; }
		</style>
		<div class="flow-footers-guide">
			<h3>How to create footer columns</h3>
			<ol>
				<li>In the textarea to the left put CSS classes that each column should have.</li>
				<li>Set of classes should be separated by comma. Like: class1 class2, class1 class3 class4, class5. This will create 3 columns (first = class1 class2; second = class1 class3 class4; third = class5) AND 3 new footer widget areas that require <a href="<?php echo site_url(); ?>/wp-admin/widgets.php" target="_blank">widgets</a>!</li>
				<li>Pre-made CSS classes (you can also add your own ones):
					<ol>
						<li><code>grid_1, grid_2, [...], grid_11, grid_12</code> - one is required for each column!</li>
						<li><code>push_1, push_2, [...], push_11, push_12</code> - pushes column to the right (to change display order, see examples).</li>
						<li><code>pull_1, pull_2, [...], pull_11, pull_12</code> - pulls column to the left (to change display order, see examples).</li>
						<li><code>footer-not-responsive</code> - makes column disappear in responsive mode.</li>
						<li><code>footer-responsive-only</code> - makes column visible in responsive mode only.</li>
					</ol>
				</li>
			</ol>
			<h3>Examples</h3>
			<table class="m-example-table" style="width:100%;border:1px solid #dadada;border-spacing: 0;">
				<thead>
				<tr>
					<th>Normal Mode</th>
					<th>Responsive Mode</th>
					<th>Code</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<div class="example-wrapper">
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-12">grid_12</div>
						</div>
					</td>
					<td>
						<div class="example-wrapper">
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12">grid_12</div>
						</div>
					</td>
					<td>
						<h3>Basic layout example</h3>
						<p>It consists of THREE 33% wide columns, one next to another and ONE 100% wide column.</p>
						<p>The code: <code>grid_4,grid_4,grid_4,grid_12</code>.</p>
						<p>This will create the following <a href="<?php echo site_url(); ?>/wp-admin/widgets.php" target="_blank">widget areas</a>: <code>flow-footer-1</code>, <code>flow-footer-2</code>, <code>flow-footer-3</code>, <code>flow-footer-4</code>.</p>
						<ol>
							<li>If you add <a href="<?php echo site_url(); ?>/wp-admin/widgets.php" target="_blank">widgets</a> to all of them - all of them will appear on all pages (except for the pages where you use "Replace Sidebar" to disable it).</li>
							<li>If you don't populate them with widgets - they will simply not appear anywhere.</li>
							<li>If you wish any of them to appear only on some pages but not anywhere else you do something like "Replace <code>flow-footer-1</code> with <code>flow-sidebar-1</code>". Replacement sidebar has to have widget(s). You can do that under [Pages > Add New > Sidebars]. Then <code>flow-footer-1</code> will appear only on that single page but not anywhere else.</li>
						</ol>
					</td>
				</tr>
				<tr>
					<td>
						<div class="example-wrapper">
							<div class="m-footer-column-12">grid_12 not-responsive</div>
							<div class="m-footer-column-6">grid_6</div>
							<div class="m-footer-column-6">grid_6</div>
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-8">8 not-responsive</div>
							<div class="m-footer-column-8">grid_8</div>
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-6">grid_6</div>
							<div class="m-footer-column-4">grid_4</div>
							<div class="m-footer-column-2">2</div>
							<div class="m-footer-column-12">grid_12</div>
							<div class="m-footer-column-6">6 pull_6<div class="dot-blue"></div></div>
							<div class="m-footer-column-6">6 push_6<div class="dot-red"></div></div>
							<div class="m-footer-column-12">grid_12</div>
						</div>
					</td>
					<td>
						<div class="example-wrapper">
							<div class="m-footer-column-12 m-footer-column-inactive"><s>grid_12 not-responsive</s></div>
							<div class="m-footer-column-12">grid_6</div>
							<div class="m-footer-column-12">grid_6</div>
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12 m-footer-column-inactive"><s>grid_8 not-responsive</s></div>
							<div class="m-footer-column-12">grid_8</div>
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12">grid_6</div>
							<div class="m-footer-column-12">grid_4</div>
							<div class="m-footer-column-12">grid_2</div>
							<div class="m-footer-column-12">grid_12</div>
							<div class="m-footer-column-12">grid_6 pull_6<div class="dot-red"></div></div>
							<div class="m-footer-column-12">grid_6 push_6<div class="dot-blue"></div></div>
							<div class="m-footer-column-12">grid_12</div>
						</div>
					</td>
					<td>
						<h3>Advanced layout example</h3>
						<p>Two columns will disappear in responsive mode (for mobile devices, below width=800px).</p>
						<p>This will create 14 <a href="<?php echo site_url(); ?>/wp-admin/widgets.php" target="_blank">widget areas</a>. From <code>flow-footer-1</code> to <code>flow-footer-14</code>.</p>
						<p>We use <code>push_6</code> and <code>pull_6</code> classes to swap two <code>grid_6</code> columns in normal mode but in responsive mode they will appear in normal order.</p>
						<p>The code: <code>grid_12 footer-not-responsive, grid_6, grid_6, grid_4, grid_8 footer-not-responsive, grid_8, grid_4, grid_6, grid_4, grid_2, grid_12, grid_6 push_6, grid_6 pull_6, grid_12</code>.</p>
					</td>
				</tr>
				<tr>
					<td>
						<div class="example-wrapper">
							<!-- <div class="m-footer-column-12" style="height: 90px;">content</div> -->
							<div class="m-footer-column-12">grid_12 not-responsive</div>
							<div class="m-footer-column-12">grid_12 (separator only)</div>
							<div class="m-footer-column-6">6 pull_6<div class="dot-blue"></div></div>
							<div class="m-footer-column-6">6 push_6<div class="dot-red"></div></div>
						</div>
					</td>
					<td>
						<div class="example-wrapper">
							<!-- <div class="m-footer-column-12" style="height: 90px;">content</div> -->
							<div class="m-footer-column-12 m-footer-column-inactive"><s>grid_12 not-responsive</s></div>
							<div class="m-footer-column-12">grid_12 (separator)</div>
							<div class="m-footer-column-12">grid_6 (icons)<div class="dot-red"></div></div>
							<div class="m-footer-column-12">grid_6 (copyright)<div class="dot-blue"></div></div>
						</div>
					</td>
					<td>
						<h3 style="color:orangered;">Demo layout</h3>
						<p>Demo code: <code>grid_12 footer-not-responsive, grid_12, grid_6 push_6, grid_6 pull_6</code></p>
						<p><code>grid_12 footer-not-responsive</code> - <code>&lt;hr&gt;</code> and 5 client logos.</p>
						<p><code>grid_12</code> - <code>&lt;hr&gt;</code> only in TEXT WIDGET.</p>
						<p><code>grid_6 push_6</code>* - Social Media Icons (they should be placed in <code>flow-footer-4</code> sidebar in TEXT WIDGET).</p>
						<p><code>grid_6 pull_6</code>* - Copyright Information (they should be placed in <code>flow-footer-3</code> sidebar in TEXT WIDGET).</p>
					</td>
				</tr>
				</tbody>
			</table>
			<small>* - We use <code>push</code> and <code>pull</code> to swap them in normal mode. Both will stop working in responsive mode and order will go back to normal. You could actually make both just <code>grid_6</code> but then Copyright Information and Social Media icons would be present in the same order in both modes which may not be what you need.</small>
			<div class="clear"></div>
		</div>
		<p class="submit" style="clear: both; float: left;"><input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes') ?>" /></p>
	</form>
</div>
<?php } ?>