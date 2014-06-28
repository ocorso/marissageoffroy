<?php 
	// Create sidebar areas
	if(function_exists('register_sidebar')){
		register_sidebars(2, array('before_title'=>'<h3>','after_title'=>'</h3>'));
	}
?>