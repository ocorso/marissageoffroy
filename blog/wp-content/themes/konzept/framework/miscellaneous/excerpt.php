<?php 
	// New excerpt length
	function new_excerpt_length($length) {
		return 70;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	// New excerpt ending
	function new_excerpt_more($more) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	// Summarise excerpt to full sentence cut function
	function summarise_excerpt($old_excerpt, $limit) {
       $excerpt_summarised = strtok($old_excerpt, " ");
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
?>