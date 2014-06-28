<?php
/* add_action('admin_menu', 'about_menu_remove');
function about_menu_remove(){
	remove_submenu_page('brisk-mainmenu', 'sub-page42');
} */
function flow_about_init(){
	wp_enqueue_style('flow-about-menu-styles', get_bloginfo('template_directory') . '/framework/admin/about-menu-styles.css');
}
function add_about_menu(){
    if (!current_user_can('manage_options')){
		wp_die( __('You do not have sufficient permissions to access this page.', 'flowthemes') );
    }
?>
<div class="wrap">
	<div class="flow-welcome-panel">
		<div style=" float: left; position: relative; width: 173px;">
			<img src="<?php bloginfo('template_directory'); ?>/screenshot.png" alt="" style="float: left; width: 173px;" />
			<p style="float: left; text-align: center; width: 100%;" class="description">
			<?php
				if(function_exists('wp_get_theme')){
					$my_theme = wp_get_theme();
					printf(__('%1$s is version %2$s', 'flowthemes'), $my_theme->Name, $my_theme->Version);
				}
			?>
			</p>
		</div>
		<div class="flow-welcome-panel-content">
			<h3><?php _e('Welcome to Daisho!', 'flowthemes'); ?></h3>
			<p class="flow-about-description"><?php _e('You are running Daisho theme. If you need help getting started, check out our <a href="http://www.youtube.com/watch?v=Yvf2dcPfiHM" target="_blank">Installation Video (8:06)</a> and documentation on <a href="http://docs.devatic.com/daisho/#installingTheTheme" target="_blank">First Steps with Daisho</a>. If you\'d rather dive right in, here are a few things most people do first when they set up a new Daisho site. If you need help, use the Daisho button in the top admin toolbar to get information on how to setup and use your website and where to go for more assistance.', 'flowthemes'); ?></p>
			<div class="flow-welcome-panel-column-container">
				<div class="flow-welcome-panel-column">
					<h4><span class="icon16 icon-settings"></span> <?php _e('Basic Settings', 'flowthemes'); ?></h4>
					<p><?php _e('When you first activated the theme we imported some demo settings to your database. Here is their raw list (one-to-one database match):', 'flowthemes'); ?></p>
<pre style="white-space: pre-wrap; word-wrap: break-word; border: 1px solid #eee; padding: 3% 5%; background-color: #f8f8f8;">$theme_settings = array(
<?php $install_settings = flow_install_theme_settings(false, true, false);
foreach($install_settings as $key => $value){
	if(is_array($value)){ $value = serialize($value); }
	echo "	", "'", $key, "'", " => '<span style='color: #aaa;'>", $value, "</span>',\n";
}
?>
);
</pre>
					<p><?php _e('You can now modify them in Admin Panel in left sidebar under "Daisho". They all come from that area.', 'flowthemes'); ?></p>
				</div>
			
				<div class="flow-welcome-panel-column">
					<h4><span class="icon16 icon-page"></span> <?php _e('Add Real Content', 'flowthemes'); ?></h4>
					<p><?php _e('Check out sample pages, posts, portfolio projects and editors to see how it all works, then delete the default content and write your own!', 'flowthemes'); ?></p>
					<ul>
						<li><?php _e('<strong><a href="http://docs.devatic.com/daisho/#installingTheTheme" target="_blank">Import Demo Content</a></strong>', 'flowthemes'); ?></li>
						<li><?php printf(__('View your <a href="%s/wp-admin/edit.php?post_type=page" target="_blank">pages</a> and <a href="%s/wp-admin/edit.php" target="_blank">blog posts</a>', 'flowthemes'), site_url(), site_url()); ?></li>
						<li><?php printf(__('View your <a href="%s/wp-admin/edit.php?post_type=portfolio" target="_blank">portfolio projects</a> and <a href="%s/wp-admin/edit.php?post_type=slideshow" target="_blank">slideshow slides</a>', 'flowthemes'), site_url(), site_url()); ?></li>			
						<li><?php _e('Go ahead and edit demo content or remove it and add your own!', 'flowthemes'); ?></a></li>
					</ul>
				</div>
				<div class="flow-welcome-panel-column flow-welcome-panel-last">
					<h4><span class="icon16 icon-appearance"></span> <?php _e('Customize Your Site', 'flowthemes'); ?></h4>
					<p><?php _e('Your current theme &mdash; Daisho &mdash; offers some customization options. Here are a few ways to make your site look unique.', 'flowthemes'); ?></p>			
					<ul>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=sub-page41" target="_blank"><?php _e('Styling Tool', 'flowthemes'); ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/widgets.php" target="_blank"><?php _e('Add some widgets', 'flowthemes'); ?></a></li>
						<li><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=brisk-mainmenu" target="_blank"><?php _e('Add Custom CSS', 'flowthemes'); ?></a></li>
					</ul>
					<p><?php _e('If you need more complex changes, our support forum is divided into two sections:', 'flowthemes'); ?></p>
					<table class="form-table about-table">
						<tr>
							<th><strong><?php _e('Free Support', 'flowthemes'); ?></strong></td>
							<th><strong><?php _e('Paid Support', 'flowthemes'); ?></strong></td>
						</tr>
						<tr>
							<td><?php _e('Installation, configuration, general questions, bug reports, suggestions', 'flowthemes'); ?></td>
							<td><a href="http://docs.devatic.com/daisho/index.html#customModifications" target="_blank"><?php _e('Custom Modifications', 'flowthemes'); ?></a></td>
						</tr>
						<tr>
							<td><?php _e('Go ahead and let us know if you have any questions!', 'flowthemes'); ?></td>
							<td><a href="http://support.forcg.com/forum/hire-developer" target="_blank"><?php _e('Find a developer</a> to configure website for you or do custom modifications!', 'flowthemes'); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div style="margin: 0 8px 20px; padding: 0 10px 20px; line-height: 160%; font-size: 14px; color: #464646;">
		<div style="width: 30%; margin-right: 2%; float: left;">
			<?php if(current_user_can('manage_options')){
				$hidden_field_name = 'restore_submit_hidden';
				$hidden_field_name2 = 'clean_submit_hidden';
				if(isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y'){
					check_admin_referer("flow_restore_nonce_security");
					if(flow_install_theme_settings(true, false, false)){
						echo '<div class="update-nag">Demo settings were restored!</div>';
					}
				}
				if(isset($_POST[ $hidden_field_name2 ]) && $_POST[ $hidden_field_name2 ] == 'Y'){
					check_admin_referer("flow_clean_nonce_security");
					if(flow_install_theme_settings(false, false, true)){
						echo '<div class="update-nag">Settings were removed!</div>';
					}
				}
				?>
				<h2><?php _e('Utilities', 'flowthemes'); ?></h2>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery('#form-restore-demo').on('submit', function(){
							return confirm("<?php _e('Do you really want to remove all theme settings from database and restore demo settings? This can not be undone.', 'flowthemes'); ?>");
						});
						jQuery('#form-delete-database').on('submit', function(){
							return confirm("<?php _e('Do you really want to remove all theme settings from database? This can not be undone.', 'flowthemes'); ?>");
						});
					});
				</script>
				<div style="margin-bottom: 40px;">
					<?php _e('<strong>Restore Demo Settings</strong><p>You can restore demo settings by clicking this button. Please note that all theme settings will get erased - including Custom CSS Code and other settings that may be important to you. This can not be undone.</p>', 'flowthemes'); ?>
					<form id="form-restore-demo" name="form-restore-demo" method="post" action="">
						<?php wp_nonce_field("flow_restore_nonce_security"); ?>
						<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
						<input id="restore-demo" type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Restore Demo Settings', 'flowthemes') ?>" />
					</form>
				</div>
				<div style="margin-bottom: 40px;">
					<?php _e('<strong>Delete all theme settings from the database</strong><p>When you deactivate theme, settings don\'t get removed - just in case you wanted to re-activate it. To permanently remove them please click this button. This can not be undone. Demo settings will import again once you re-activate the theme.</p>', 'flowthemes'); ?>
					<form id="form-delete-database" name="form-delete-database" method="post" action="">
						<?php wp_nonce_field("flow_clean_nonce_security"); ?>
						<input type="hidden" name="<?php echo $hidden_field_name2; ?>" value="Y">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Clean Database', 'flowthemes') ?>" />
					</form>
				</div>
				<p class="description"><?php _e('Warning! All users with "manage_options" capability have access to these buttons - which is usually "Administrator", "Super Administrator" and nobody else (see <a href="http://codex.wordpress.org/Roles_and_Capabilities" target="_blank">WordPress - Roles and Capabilities</a>).', 'flowthemes'); ?></p>
			<?php } ?>
		</div>
		<div style="width: 30%; margin-right: 2%; float: left;">
			<h2><?php _e('Information', 'flowthemes'); ?></h2>
			<ul class="flow-settings-checklist">
			<?php
			try{
				$max_upload = ini_get('upload_max_filesize');
				$max_post = ini_get('post_max_size');
				$memory_limit = ini_get('memory_limit');
				$max_execution_time = ini_get('max_execution_time');
				
				global $wp_version;
			?>
				
				<li><?php printf(__('Max Upload File Size Limit is set to <strong>%s</strong> - sets an upper limit on the size of uploaded files.', 'flowthemes'), $max_upload); ?></li>
				<li><?php printf(__('Max PHP POST Size Limit is set to <strong>%s</strong> - it limits the total size of posted data, including file data.', 'flowthemes'), $max_post); ?></li>
				<li><?php printf(__('PHP Memory Limit is set to <strong>%s</strong>.', 'flowthemes'), $memory_limit); ?></li>
				<li><?php printf(__('Max Execution Time is set to <strong>%s</strong>.', 'flowthemes'), $max_execution_time); ?></li>
				<li>
					<?php printf(__('Current PHP version: <strong>%s</strong>', 'flowthemes'), phpversion()); ?>
					<?php if(version_compare(PHP_VERSION, '5.2.4', '<')){ echo '<span style="color: #dd0000; font-weight: bold; font-size: 11px;">(Files require PHP 5.2.4 or greater!)</span>'; } ?>
				</li>
				<li>
					<?php printf(__('Current WP version: <strong>%s</strong>', 'flowthemes'), $wp_version); ?>
					<?php if(version_compare($wp_version, '3.4', '<')){ echo '<span style="color: #dd0000; font-weight: bold; font-size: 11px;">(Files require WordPress 3.4 or greater!)</span>'; } ?>
				</li>
			<?php }catch(Exception $e){} ?>
			</ul>
		</div>
		<div style="width: 30%; float: left; line-height: 160%; font-size: 14px; color: #464646;">
			<h2>Auto-updates</h2>
			<p>This theme supports "one-click" auto-updates. To take advantage of that feature please fill in your support forum username and password under [Daisho > General]. They will be automatically sent to update server for verification each time WordPress checks for new updates. To update your theme please go to [Dashboard > Updates]. Updates are delivered from private servers.</p>
			<p><b>Currently Installed Version:</b> <?php echo $my_theme->Version; ?></p>
			<?php $theme_server_version = unserialize(getRemote_version()); ?>
			<?php if(!empty($theme_server_version)){ ?>
				<p><b>Version on Update Server:</b> <?php echo $theme_server_version->version; ?> (date: <?php echo $theme_server_version->date; ?>)</p>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>