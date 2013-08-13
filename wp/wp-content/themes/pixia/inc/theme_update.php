<?php
	//THIS SCRIPT CHECK'S IF AN UPDATE IS AVAILABLE FOR DOWNLOAD
	function update_notifier_menu() 
	{  
		//CHECK FOR UPDATES ONLY EACH 28800 seconds - 8 hours
		$xml = get_latest_theme_version(28800); 
		$theme_data = wp_get_theme();
		if(isset ($xml->latest) && version_compare($theme_data['Version'], $xml->latest) == -1) 
		{
			//SHOW UPDATE MESSAGE ON THE DASHBOARD
			add_theme_page( $theme_data['Name'] . 'Theme Updates', $theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'pixia-updates', 'update_notifier');
		}
	}  
	add_action('admin_menu', 'update_notifier_menu');
	//BUILD THE HELP MESSAGE
	function update_notifier() 
	{
		//CHECK FOR UPDATES ONLY EACH 28800 seconds - 8 hours
		$xml = get_latest_theme_version(28800);
		$theme_data = wp_get_theme(); 
		?>
		<style>
			.update-nag 
			{
				display: none;
			}
			#instructions 
			{
				max-width: 800px;
			}
			h3.title 
			{
				margin: 30px 0 0 0; 
				padding: 30px 0 0 0; 
				border-top: 1px solid #ddd;
			}
		</style>
		<div class="wrap">
			<div id="icon-tools" class="icon32"></div>
			<h2><?php echo $theme_data['Name']; ?> Update Available</h2>
			<div id="message" class="updated below-h2"><p><strong>A new version of the <?php echo $theme_data['Name']; ?> Theme is  available.</strong> You should update from version <?php echo $theme_data['Version']; ?> to <?php echo $xml->latest; ?>.</p></div>
			<img style="float: left; margin: 0 20px 40px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
			<div id="instructions" style="max-width: 800px;">
				<h3>How to update the <?php echo $theme_data['Name']; ?> Theme?</h3>
				<p><strong>Warning:</strong> You are strongly advised to make a backup of all the Theme files inside your WordPress installation folder <strong>/wp-content/themes/pixia/</strong></p>
                <p>I have set up a video screencast to guide on this process. Here's the link: <a href="http://www.screenr.com/iAM8">http://www.screenr.com/iAM8</a></p>
				Anyway here are the update steps for the classic update method:
				<p>1 - Login to your <strong>Themeforest</strong> account, head over to your downloads section and re-download the theme like you did when you bought it.</p>
				<p>2 - Extract the zip's contents, look for the extracted theme folder content and upload it via FTP to the <strong>/wp-content/themes/pixia/</strong> folder. Overwrite all the older files.</p>
				<p>3 - The process is complete if you haven't done any previous editing to the theme files.</p>
				<p>4 - If, on the contrary, you have made any changes to theme core files you should now <strong>integrate your code with the new files</strong> and re-upload them. It's vital for this process that you have done a backup of the older files before the update process.</p>
			</div>
			<div class="clear"></div>
			<h3 class="title">Pixia Theme changelog</h3>
			<?php echo $xml->changelog; ?>
		</div><!--.wrap-->
	<?php 
	}//update_notifier
	function get_latest_theme_version($interval) {
		$notifier_file_url = 'http://www.munto.net/themeforest/updates/pixia/versions.xml';
		$db_cache_field = 'contempo-notifier-cache';
		$db_cache_field_last_updated = 'contempo-notifier-last-updated';
		$last = get_option( $db_cache_field_last_updated );
		$now = time();
		//CHECK CACHE
		if ( !$last || (( $now - $last ) > $interval) ) {
			//REFRESH CACHE IF NECESSARY
			if( function_exists('curl_init') ) 
			{ 
				$ch = curl_init($notifier_file_url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				$cache = curl_exec($ch);
				curl_close($ch);
			} 
			else 
			{
				$cache = file_get_contents($notifier_file_url);
			}
			if ($cache) //SUCCESS?
			{			
				update_option( $db_cache_field, $cache );
				update_option( $db_cache_field_last_updated, time() );			
			}
			$notifier_data = get_option( $db_cache_field );
		}
		else 
		{
			//CACHE FILE IS STILL FRESH. LET'S READ IT
			$notifier_data = get_option( $db_cache_field );
		}
		//CHECK IF FILE EXISTS ON SERVER
		$needle='notifier made_it="true"';
		$pos = strpos($notifier_data,$needle);
		if($pos === false) {
			return 'not_found';
		}
		$xml = simplexml_load_string($notifier_data); 
		return $xml;
	}//get_latest_theme_version
?>