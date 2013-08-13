<?php 
	if((!is_admin() || stristr($_SERVER['REQUEST_URI'], 'admin-ajax')) && !stristr($_SERVER['REQUEST_URI'], 'wp-login')){
		$scloader_sclist = scandir(TEMPLATEPATH."/framework/shortcodes/");
		for($scloader_i=0;$scloader_i<count($scloader_sclist);$scloader_i++){
			if($scloader_sclist[$scloader_i] != "." && $scloader_sclist[$scloader_i] != ".." && $scloader_sclist[$scloader_i] != "loader.php"){
				if(is_dir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i])){
					$scloader_sclist_sub = scandir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/");
					for($scloader_j=0;$scloader_j<count($scloader_sclist_sub);$scloader_j++){
						if($scloader_sclist_sub[$scloader_j] != "." && $scloader_sclist_sub[$scloader_j] != ".."){
							if(!is_dir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j])){
								$scloader_scnameelex = explode(".", $scloader_sclist_sub[$scloader_j]);
								$scloader_scnameelex_ext = $scloader_scnameelex[count($scloader_scnameelex )-1];
								if($scloader_scnameelex_ext == "php"){
									require_once(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
								}else if($scloader_scnameelex_ext == "css"){
									wp_register_style(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]), get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
									wp_enqueue_style(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]));
								}else if($scloader_scnameelex_ext == "js"){
									wp_register_script(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]), get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j], array("jquery"));
									wp_enqueue_script(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]));
								}
							}
						}
					}
				}else{
					$scloader_scnameex = explode(".", $scloader_sclist[$scloader_i]);
					if($scloader_scnameex[count($scloader_scnameex )-1] == "php"){
						require_once(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]);
					}
				}
			}
		}
	}
?>