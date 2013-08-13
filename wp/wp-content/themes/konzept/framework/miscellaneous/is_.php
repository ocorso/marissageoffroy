<?php 
	// is_child() function
	function is_child($parent) {
		global $wp_query;
		if ($wp_query->post->post_parent == $parent) {
			$return = true;
		}
		else {
			$return = false;
		}
		return $return;
	}

	// is_ancestor() function
	function is_ancestor($post_id) {
		global $wp_query;
		$ancestors = $wp_query->post->ancestors;
		$post = $wp_query->post; $ancestors  = get_post_ancestors($post);
		if ( in_array($post_id, $ancestors) ) {
			$return = true;
		} else {
			$return = false;
		}
		return $return;
	}
?>