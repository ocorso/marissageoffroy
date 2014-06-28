<?php 
/**
 * upload.php
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

// HTTP headers for no cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
//$targetDir = 'uploads/';

/* $start_path = "../../../wp-load.php";
$di=0;
while(!file_exists($start_path) && $di < 12){
	$start_path = "../".$start_path;
	$di++;
}
if(!file_exists($start_path) || !@include( $start_path )) throw new Exception("Failed to include 'wp-load.php'"); */

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$upload_dir = wp_upload_dir();

//$targetDir = $upload_dir['path'].'/'; //We don't need separator
$targetDir = $upload_dir['path'];

// Check user capabilities and permissions
if(!function_exists('wp_handle_upload')){ 
	require_once(ABSPATH.'wp-admin/includes/file.php');
}
if(!is_user_logged_in()){
	die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "You need to be logged in to upload files."}, "id" : "id"}');
}
if(!current_user_can('upload_files')){
	die('{"jsonrpc" : "2.0", "error" : {"code": 105, "message": "You need an account with upload_files capability."}, "id" : "id"}');
}

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

if($fileName == ''){
	die('{"jsonrpc" : "2.0", "error" : {"code": 109, "message": "File is not specified."}, "id" : "id"}');
}

// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

// Allow only some extensions for security reasons
$allowedExtensions = array("txt","csv","htm","html","xml","css","doc","docx","xls","rtf","ppt","pdf","swf","flv","avi","wmv","mov","mp3","mp4","webm","ogg","ogv","zip","rar","jpg","jpeg","gif","png");
$allowedExtensions = array("swf","flv","avi","wmv","mov","mp3","mp4","webm","ogg","ogv","jpg","jpeg","gif","png","blob");

	/* Get WordPress allowed extensions and create an array */
	$mimes = get_allowed_mime_types();
	foreach($mimes as $type => $mime){
		$sub_extensions = explode('|', $type);
		if(is_array($sub_extensions) && count($sub_extensions) > 1){
			array_merge($allowedExtensions, $sub_extensions);
		}else{
			$allowedExtensions[] = $type;
		}
	}
	$allowedExtensions[] = 'blob'; // Add blob as the last element
	
foreach($_FILES as $file){
	if($file['tmp_name'] > ''){
	//if(isset($file['tmp_name']) && $file['tmp_name'] != ''){
		if(!in_array(end(explode(".", strtolower($file['name']))), $allowedExtensions)){
			die($file['name'].' is not an allowed file type!');
		}
	}
}

// Make sure the fileName is unique but only if chunking is disabled
 if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)){
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);

	$count = 1;
	while(file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b)){
		$count++;
	}

	$fileName = $fileName_a . '_' . $count . $fileName_b;
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);

// Remove old temp files	
if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
			@unlink($tmpfilePath);
		}
	}

	closedir($dir);
} else
	die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	

// Look for the content type header
if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

if (isset($_SERVER["CONTENT_TYPE"]))
	$contentType = $_SERVER["CONTENT_TYPE"];

// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
if (strpos($contentType, "multipart") !== false) {
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		// Open temp file
		$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
			// Read binary input stream and append it to temp file
			$in = fopen($_FILES['file']['tmp_name'], "rb");

			if ($in) {
				while ($buff = fread($in, 4096))
					fwrite($out, $buff);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			fclose($in);
			fclose($out);
			@unlink($_FILES['file']['tmp_name']);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
} else {
	// Open temp file
	$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
	if ($out) {
		// Read binary input stream and append it to temp file
		$in = fopen("php://input", "rb");

		if ($in) {
			while ($buff = fread($in, 4096))
				fwrite($out, $buff);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

		fclose($in);
		fclose($out);
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
}

// Added by Flow
if($fileName && $filePath){
	//die('{"jsonrpc" : "2.0", "error" : null, "result" : {"filename": "'.$fileName.'", "filepath": "'.$filePath.'"}, "id" : "id"}');
	$output = new stdClass;
	$output->jsonrpc = "2.0";
	$output->error = null;
	$output->result = new stdClass;
		$output->result->filename = $fileName;
		$output->result->filepath = $filePath;
	$output->id = "id";
	die(json_encode($output));
}

// Return JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

?>