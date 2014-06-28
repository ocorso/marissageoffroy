<?php 
	function konzept_content_slider($atts, $content = null) {
		$class = shortcode_atts( array('title' => 'No Title Specified'), $atts );
		return '<div class="excerpt excerpt-blog" style="width: 350px; float:left; margin-right: 80px; display: inline-block;"><div class="news-date" style="height:10px;"></div><h1 class="news-title" style="font-size: 34px;margin-bottom:20px;">'.$class['title'].'</h1><div class="news-content">'.$content.'</div></div>';
	}
	add_shortcode("content_block", "konzept_content_slider");
?>