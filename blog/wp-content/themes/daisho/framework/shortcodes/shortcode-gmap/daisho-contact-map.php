<?php 
	function daisho_gmap($atts, $content = null) {
		$class = shortcode_atts( array('latitude' => '0', 'longitude' => '0', 'zoom' => '12', 'height' => '355px', 'width' => '100%'), $atts );
		$uniqid = uniqid();
		
		/* Requires WP3.3+ */
		wp_enqueue_script('google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false', array(), false, true);
		
		return "<script type=\"text/javascript\">
				  jQuery(document).ready(function(){
					gmap_initialize(".$class['latitude'].", ".$class['longitude'].", '".$uniqid."', ".$class['zoom'].");
				  });
				</script>
				<div id=\"map_canvas_".$uniqid."\" class=\"map_canvas\" style=\"height:".$class['height'].";width:".$class['width'].";float:left;\"></div>";
	}
	add_shortcode("gmap", "daisho_gmap");
?>