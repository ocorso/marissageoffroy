<?php
/* Adds more allowed files types to Media Library upload */
add_filter('upload_mimes', 'flow_allowed_file_types');
function flow_allowed_file_types($existing_mimes = array()){
	$existing_mimes['svg'] = 'image/svg+xml';
	$existing_mimes['svgz'] = 'image/svg+xml';
	$existing_mimes['webm'] = 'video/webm';
	$existing_mimes['weba'] = 'audio/webm';

	return $existing_mimes;
}
?>