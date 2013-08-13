<?php
	if($_SERVER['SERVER_NAME'] == 'themes.devatic.com'){ $demoServer = true; }else{ $demoServer = false; }
	
	if(strpos($_SERVER['HTTP_USER_AGENT'],'iPad') !== false){ $ipad = true; }else{ $ipad = false; }
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'Android')){ $mobile = true; }else{ $mobile = false; }
	
	if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE')){ $ie = true; }
	if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 6')){ $ie6 = true; }
	if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7')){ $ie7 = true; }
	if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 8')){ $ie8 = true; }
	
	if(!$mobile && !$ipad){ $desktop = true; }
	
	$portfolio_mode = get_option('portfolio_mode'); /* 1 = thumbnail grid, 0 = classic */
	if(!empty($_GET['prj']) && $_GET['prj'] == 'classic'){ $portfolio_mode = 0; }
	if(!empty($_GET['prj']) && $_GET['prj'] == 'thumb'){ $portfolio_mode = 1; }
	
	if(($portfolio_mode == '1' && is_home()) || is_page_template('template-portoflio.php') || ($portfolio_mode == '1' && is_singular('portfolio'))){ /* THUMBNAIL VIEW */
		$daisho_portfolio = true;
		$daisho_classic = false;
	}else if(($portfolio_mode == '0' && is_home()) || ($portfolio_mode == '0' && is_singular('portfolio'))){ /* CLASSIC VIEW */
		$daisho_portfolio = false;
		$daisho_classic = true;
	}else{
		$daisho_portfolio = false;
		$daisho_classic = false;
	}

	global $mobile;
	global $ipad;
	global $desktop;
	global $demoServer;
	global $safari;
	global $ie;
	global $ie6;
	global $ie7;
	global $ie8;
	global $daisho_portfolio;
	global $daisho_classic;
?>