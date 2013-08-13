<?php 
function highlight_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'bgcolor' => '#fff59f', 'color' => 'inherit' ), $atts);
	return "<span style=\"padding: 0 5px; background-color:".$atts['bgcolor']."; color:".$atts['color'].";\">".$content."</span>";
}
add_shortcode("highlight", "highlight_shortcode");
?>