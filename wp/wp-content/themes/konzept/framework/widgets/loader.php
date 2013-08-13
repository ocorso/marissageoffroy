<?php 
	if ( !stristr( $_SERVER['REQUEST_URI'], 'wp-login' ) ) {
		$wtloader_wtlist = scandir(TEMPLATEPATH."/framework/widgets/");
		for($wtloader_i=0;$wtloader_i<count($wtloader_wtlist);$wtloader_i++){
			if($wtloader_wtlist[$wtloader_i] != "." && $wtloader_wtlist[$wtloader_i] != ".." && $wtloader_wtlist[$wtloader_i] != "loader.php"){
				if(!is_dir(TEMPLATEPATH."/framework/widgets/".$wtloader_wtlist[$wtloader_i])){
					$wtloader_wtnameex = explode(".", $wtloader_wtlist[$wtloader_i]);
					if($wtloader_wtnameex[count($wtloader_wtnameex )-1] == "php"){
						require_once(TEMPLATEPATH."/framework/widgets/".$wtloader_wtlist[$wtloader_i]);
					}
				}
			}
		}
	}
?>