<?php
/* This script is used to output image for the places where HTML5 Canvas element disallows that from external URLs. By Flow. */
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

if(function_exists('current_user_can') && current_user_can('edit_posts') && $_GET['image']){
	function fileExists($path){
		return (@fopen($path,"r")==true);
	}
	$value = $_GET['image'];
	$mimes = get_allowed_mime_types();
	$file_ext = explode('.',$value);
	foreach($mimes as $type => $mime){
		if(strpos($type, end($file_ext)) !== false){
			if(fileExists($value)){
				$contents = file_get_contents($value);
				header('Content-type: '.$mime);
				echo $contents;
				break;
			}
		}
	}
}else{
	echo $_GET['image'];
}
?>