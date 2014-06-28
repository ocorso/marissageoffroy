<?php
	function drop_caps($atts, $content = null) {
		$attsp = shortcode_atts( array('color' => 'inherit', 'bgcolor' => 'inherit', 'style' => "1"), $atts );
		if(!($attsp['color'] == "inherit")){ $color = 'color: '.$attsp['color'].';'; }else{ $color = ''; }
		if(!($attsp['bgcolor'] == "inherit") AND ($attsp['style'] != "1")){ $bgcolor = 'background-color: '.$attsp['bgcolor'].';'; }else{ $bgcolor = ''; }
		$styles = 'style="'.$color.$bgcolor.'"';
		if($attsp['style'] == "2"){
			return '<span class="drop-caps drop-caps-bg" '.$styles.'>'.$content.'</span>';
		}else{
			return '<span class="drop-caps" '.$styles.'>'.$content.'</span>';
		}
	}
	add_shortcode("drop_cap", "drop_caps");
?>