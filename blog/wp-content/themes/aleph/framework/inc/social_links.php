<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Social links in footer
 *
 * /framework/inc/social_links.php
 * Version of this file : 1.6
 *
 */
?>

<?php

	// Get the data
	$services=$data["footer_social_services"];
	$links=$data["footer_social_links"];
	$tooltip=$data["footer_social_tip"];
	
	echo '<ul class="social_links clearfix">';	
	if ( is_array($services) ) {
		foreach($services as $service=>$display) {
			if($display==1) {
				echo "<li><a href='".$links[$service]."' title='".$tooltip[$service]."' class='ttip' target='blank'><em class='icon-".$service."'></em></a></li>";
			}
		}
	}
		echo '<li><a href="'. get_bloginfo('rss2_url') .'" class="ttip" title="Suscribe to the RSS feed" target="blank"><em class="icon-rss"></em></a></li>';
	echo '</ul>';
	
?>