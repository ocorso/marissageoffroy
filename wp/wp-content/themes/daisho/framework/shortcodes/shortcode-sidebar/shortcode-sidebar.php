<?php 
	function flow_shortcode_sidebar($atts, $content = null){
		$atts = shortcode_atts(array('id' => ''), $atts);
		if($atts['id'] != ""){
			$this_sidebar = '<div class="post-sidebar"><ul>';
			ob_start();
			dynamic_sidebar(apply_filters('flow_sidebar', $atts['id']));
			$this_sidebar .= ob_get_contents();
			ob_end_clean();
			
			$this_sidebar .= '<ul></div>';
			
			return $this_sidebar;
		}
	}
	add_shortcode("flow-sidebar", "flow_shortcode_sidebar");
?>