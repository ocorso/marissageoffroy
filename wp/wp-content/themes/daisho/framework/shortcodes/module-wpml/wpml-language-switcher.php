<?php 
function language_selector_flags(){
	if(function_exists('icl_get_languages')){
		$flow_wpml_switcher = get_option("flow_wpml_switcher");
		if($flow_wpml_switcher){
			$languages = icl_get_languages('skip_missing=0&orderby=desc');
			if(!empty($languages)){
				$out = '<div class="conatainer_language_selector"><div id="flags_language_selector">';
				$out .= '<div class="current_language">'.ICL_LANGUAGE_CODE.'</div>';
				$out .= '<ul id="lang_ul">';
				foreach($languages as $l){
					if($l['active']){ $this_active = 'active_lng'; }else{ unset($this_active); }
					$out .= '<li class="language-li '.$this_active.'">';
					if(!$l['active']){ $out .= '<a href="'.$l['url'].'">'; }
					$out .= '<span class="language-name">'.$l['native_name'].'</span>';
					$out .= '<span class="language-name-bold">'.$l['native_name'].'</span>';
					if(!$l['active']){ $out .= '</a>'; }
					$out .= '</li>';
				}
				$out .= '</ul>';
				$out .= '</div></div>';
			}
		}
		return $out;
	}else{
		return;
	}
}
?>