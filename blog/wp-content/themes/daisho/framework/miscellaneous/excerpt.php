<?php 
	// New excerpt length
	function new_excerpt_length($length){
		return 70;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	// New excerpt ending
	function new_excerpt_more($more){
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	// Summarise excerpt to full sentence cut function
	function summarise_excerpt($old_excerpt, $limit) {
		$excerpt_summarised = strtok($old_excerpt, " ");
		$text = '';
		$words = 0;
		while($excerpt_summarised)
		{
			$text .= " $excerpt_summarised";
			$words++;
			if(($words >= $limit) && ((substr($excerpt_summarised, -1) == "!")||(substr($excerpt_summarised, -1) == ".")))
				break;
			$excerpt_summarised = strtok(" ");
		}
		return ltrim($text);
	}
	
	function improved_trim_excerpt($text){
		global $post;
		if($text == ''){
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace('\]\]\>', ']]&gt;', $text);
			$text = strip_tags($text, '<a>');
			$excerpt_length = 70;
			$words = explode(' ', $text, $excerpt_length + 1);
			if(count($words)> $excerpt_length){
				array_pop($words);
				array_push($words, '...');
				$text = implode(' ', $words);
			}
		}
		return $text;
	}
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'improved_trim_excerpt');
?>