<?php
	function hashCacheList($list){
		$cachestr = "";
		foreach($list as $scloader_key => $scloader_value){
			$cachestr .= $scloader_key.(($scloader_value && is_array($scloader_value)) ? $scloader_value[0] : "");
		}
		return md5($cachestr);
	}
	$disabledFiles = get_option('flow_disabled_files');
	if(is_array($disabledFiles)){
		
	}else{
		$disabledFiles = array();
	}
	//if((!is_admin() || stristr($_SERVER['REQUEST_URI'], 'admin-ajax')) && !stristr($_SERVER['REQUEST_URI'], 'wp-login')){
	if((!stristr($_SERVER['REQUEST_URI'], 'admin-ajax')) && !stristr($_SERVER['REQUEST_URI'], 'wp-login')){
	//if(true){
		$scloader_csscachelist = array();
		$scloader_cssCachingEnabled = true;
		$scloader_jsCachingEnabled = true;
		$scloader_sclist = scandir(TEMPLATEPATH."/framework/shortcodes/");
		for($scloader_i=0;$scloader_i<count($scloader_sclist);$scloader_i++){
			if($scloader_sclist[$scloader_i] != "." && $scloader_sclist[$scloader_i] != ".." && $scloader_sclist[$scloader_i] != "loader.php" && $scloader_sclist[$scloader_i] != "stylecache.css"){ //
				if(is_dir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i])){
					$scloader_sclist_sub = scandir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/");
					for($scloader_j=0;$scloader_j<count($scloader_sclist_sub);$scloader_j++){
						if($scloader_sclist_sub[$scloader_j] != "." && $scloader_sclist_sub[$scloader_j] != ".."){
							if(!is_dir(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j])){
								$scloader_scnameelex = explode(".", $scloader_sclist_sub[$scloader_j]);
								$scloader_scnameelex_ext = $scloader_scnameelex[count($scloader_scnameelex )-1];
								if($scloader_scnameelex_ext == "php"){
									//require_once(TEMPLATEPATH."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
									require_once(dirname(__FILE__).'/'.$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
								}else if($scloader_scnameelex_ext == "css"){
									//wp_register_style(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]), get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
									//wp_enqueue_style(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]));
									$scloader_csscachelist[get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]] = false;
									if($scloader_cssCachingEnabled && is_readable(dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j])){
										$scloader_filemoddate = @filemtime(dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
										if($scloader_filemoddate){
											$scloader_csscachelist[get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]] = array($scloader_filemoddate, dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j], $scloader_sclist[$scloader_i]);
										}else{
											$scloader_cssCachingEnabled = false;
										}
									}else{
										$scloader_cssCachingEnabled = false;
									}
								}else if($scloader_scnameelex_ext == "js"){
									//wp_register_script(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]), get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j], array("jquery"));
									//wp_enqueue_script(md5(get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]));
									
									$scloader_jscachelist[get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]] = false;
									if($scloader_jsCachingEnabled && is_readable(dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j])){
										$scloader_filemoddate = @filemtime(dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]);
										if($scloader_filemoddate){
											$scloader_jscachelist[get_bloginfo('template_directory')."/framework/shortcodes/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j]] = array($scloader_filemoddate, dirname(__FILE__)."/".$scloader_sclist[$scloader_i]."/".$scloader_sclist_sub[$scloader_j], $scloader_sclist[$scloader_i]);
										}else{
											$scloader_jsCachingEnabled = false;
										}
									}
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
		if($scloader_cssCachingEnabled){
			$csscachelisthash = hashCacheList($scloader_csscachelist);
			if(!file_exists(dirname(__FILE__)."/stylecache.css") || $csscachelisthash != get_option('flow_shortcodescsscachehash')){
				$fcachehandle = @fopen(dirname(__FILE__)."/stylecache.css","w");
				if($fcachehandle){
					foreach($scloader_csscachelist as $scloader_key => $scloader_value){
						//$fsrctmp = fread(fopen($scloader_value[1],"r"),filesize($scloader_value[1]));
						$fsrctmp = file_get_contents($scloader_value[1]);
						$fsrctmp = preg_replace('/url\(([\'"]?)/i','url(\1'.$scloader_value[2].'/',$fsrctmp);
						fwrite($fcachehandle, $fsrctmp."\n");
					}
					fclose($fcachehandle);
					update_option('flow_shortcodescsscachehash', $csscachelisthash);
				}else{
					$scloader_cssCachingEnabled = false;
				}
			}
			if($scloader_cssCachingEnabled && !is_admin()){
				wp_register_style("shortcodesstylecache", get_bloginfo('template_directory')."/framework/shortcodes/stylecache.css");
				wp_enqueue_style("shortcodesstylecache");
			}
		}
		if(!$scloader_cssCachingEnabled){
			foreach($scloader_csscachelist as $scloader_key => $scloader_value){
				wp_register_style(md5($scloader_key), $scloader_key);
				wp_enqueue_style(md5($scloader_key));
			}
		}
		
		if($scloader_jsCachingEnabled){
			$jscachelisthash = hashCacheList($scloader_jscachelist);
			if(!file_exists(dirname(__FILE__)."/jscache.js") || $jscachelisthash != get_option('flow_shortcodesjscachehash')){
				$fcachehandle = @fopen(dirname(__FILE__)."/jscache.js","w");
				if($fcachehandle){
					foreach($scloader_jscachelist as $scloader_key => $scloader_value){
						//$fsrctmp = fread(fopen($scloader_value[1],"r"),filesize($scloader_value[1]));
						$fsrctmp = file_get_contents($scloader_value[1]);
						$fsrctmp = preg_replace('/url\(([\'"]?)/i','url(\1'.$scloader_value[2].'/',$fsrctmp);
						fwrite($fcachehandle, $fsrctmp."\n");
					}
					fclose($fcachehandle);
					update_option('flow_shortcodesjscachehash', $jscachelisthash);
				}else{
					$scloader_jsCachingEnabled = false;
				}
			}
			if($scloader_jsCachingEnabled){
				wp_register_script("shortcodesjscache", get_bloginfo('template_directory')."/framework/shortcodes/jscache.js", array("jquery"), false, true);
				wp_enqueue_script("shortcodesjscache");
			}
		}
		if(!$scloader_jsCachingEnabled){
			foreach($scloader_jscachelist as $scloader_key => $scloader_value){
				wp_register_script(md5($scloader_key), $scloader_key, array("jquery"), false, true);
				wp_enqueue_script(md5($scloader_key));
			}
		}
	}
?>