<?php 
/* function remove_pages_from_search(){
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search'); */

function remove_pages_from_search($query){
    if ($query->is_search){
        $query->set('post_type', 'post');
    }
    return $query;
}
 
add_filter('pre_get_posts','remove_pages_from_search');

?>