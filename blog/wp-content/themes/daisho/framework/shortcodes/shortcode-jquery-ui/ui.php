<?php 
function toggle_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'title' => 'Toggle Title', 'type' => '1', 'open' => '0', 'fill' => '0', 'bgfill' => '0', 'separator' => '0' ), $atts);
	if($atts['type'] == '1'){
		$toggle_type = 'toggle-default';
	}else if($atts['type'] == '2'){
		$toggle_type = 'faqtoggles';
	}else if($atts['type'] == '3'){
		$toggle_type = 'toggle-plus';
	}else if($atts['type'] == '4'){
		$toggle_type = 'toggle-plus-fill';
	}else if($atts['type'] == '5'){
		$toggle_type = 'toggle-arrow-fill';
	}else{
		$toggle_type = 'toggle-default'; 
	}
	if($atts['fill'] == '1'){ $toggle_type .= ' toggle-filled'; }
	if($atts['bgfill'] == '1' && $atts['fill'] != '1'){ $toggle_type .= ' toggle-bgfill'; }
	if($atts['separator'] == '1' && $atts['fill'] != '1'){ $toggle_type .= ' toggle-separator'; }
	if($atts['open'] == '1'){ $toggle_open_class = ' toggle_active'; $toggle_open = 'display:block;'; }else{ $toggle_open_class = ''; $toggle_open = 'display:none;'; }
	return "<div class=\"".$toggle_type."\"><div class=\"toggle\"><div class=\"toggle_title".$toggle_open_class."\">".$atts['title']."</div><div class=\"toggle_content\" style=\"".$toggle_open."\">".$content."</div></div></div>";
}
add_shortcode("toggle", "toggle_shortcode");
?>
<?php
function accordion_group_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'title' => '', 'style' => '1' ), $atts);
	$content = do_shortcode($content);
	return '<div class="accordion">'.$content.'</div>';
}

function accordion_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'title' => 'Accordion Title', 'open' => '0' ), $atts);
	$accordion_code = '<h5><a href="#">'.$atts['title'].'</a></h5><div>'.$content.'</div>';
	return $accordion_code;
}

add_shortcode("accordion_group", "accordion_group_shortcode");
add_shortcode("accordion", "accordion_shortcode");
?>
<?php 
function tabs_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'title' => '', 'style' => '1' ), $atts);
	if($atts['style'] == '2'){ $toggle_type = 'tabs-prev-wide'; }else{ $toggle_type = ''; }
	
	$tab_header = '';
	$tab_content = '';
	$content = do_shortcode($content);
	$tabs_parts = explode('(flowuniqueid-4a1l40346xar7)', $content);
	foreach($tabs_parts as $tabs_part){
		$tabs_part = explode('(flowuniqueid-4a1l40346xar6)', $tabs_part);
		$tabs_part = str_replace('<br />', '', $tabs_part);
		if(isset($tabs_part[0])){
			$tab_header .= $tabs_part[0];
		}
		if(isset($tabs_part[1])){
			$tab_content .= $tabs_part[1];
		}
	}
	
	return '<div class="tabs-prev '.$toggle_type.'"><ul>'.$tab_header.'</ul>'.$tab_content.'</div>';
}

function tab_shortcode($atts, $content = null){
	$atts = shortcode_atts( array( 'title' => 'Tab Title', 'open' => '0' ), $atts);
	
	$prefix = 'tab-';
	$uniqid = $prefix . uniqid();
	
	$tab_active_class = '';
	if(isset($atts['open']) && ($atts['open'] == '1')){
		//$tab_active_class = ' ui-state-active ui-state-active'; 
	}else{ 
		$tab_active_class = '';
	}
	
	$tabs_code = '<li class="'.$tab_active_class.'"><a href="#'.$uniqid.'">'.$atts['title'].'</a></li>(flowuniqueid-4a1l40346xar6)<div id="'.$uniqid.'"><p>'.$content.'</p></div>(flowuniqueid-4a1l40346xar7)';
	
	return $tabs_code;
}

add_shortcode("tabs", "tabs_shortcode");
add_shortcode("tab", "tab_shortcode");
?>