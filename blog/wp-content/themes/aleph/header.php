<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /header.php
 * Version of this file : 1.7
 *
 */
?>

<?php global $data; ?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php bloginfo('name'); ?></title>

		<meta content="width=device-width, initial-scale=1.0" name="viewport">

		<!-- icons & favicons -->
			<!-- For iPhone 4 -->
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/icons/h/apple-touch-icon.png">
			<!-- For iPad 1-->
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/icons/m/apple-touch-icon.png">
			<!-- For iPhone 3G, iPod Touch and Android -->
			<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/img/icons/l/apple-touch-icon-precomposed.png">
			<!-- For Nokia -->
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/l/apple-touch-icon.png">
			<!-- For everything else -->
			<?php if ($data["general_favicon"]!="") { ?>
				<link rel="shortcut icon" href="<?php echo $data["general_favicon"] ?>">
			<?php } ?>

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/additional.css">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome-ie7.css">
<![endif]-->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
		<script>window.jQuery || document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>

		<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr.full.min.js"></script>

	<?php

			// Twitter widget
			if($data["footer_sidebar_activate"]==true) {
				$twitter_username = ($data['widget_twitter_username']!="") ? $data['widget_twitter_username'] : "false";
				$twitter_count = ($data['widget_twitter_count']!="") ? $data['widget_twitter_count'] : "3";
			} else {
				$twitter_username = $twitter_count = "false";
			}
		?>

<script type="text/javascript">
	/* Define this variable for Ajax requests */
	var templateUrl = '<?php echo get_template_directory_uri(); ?>';

	/* Homepage slider */
	var home_works_interval = '<?php echo ($data['home_works_interval']!="" ? $data['home_works_interval'] : "5000"); ?>',
		home_works_duration = '<?php echo ($data['home_works_duration']!="" ? $data['home_works_duration'] : "500"); ?>',

		home_works_hover = <?php if($data['home_works_hover']=="1") { echo "true"; } else { echo "false"; } ?>,
		media_hover = <?php if($data['media_hover']=="1") { echo "true"; } else { echo "false"; } ?>,
		media_interval = '<?php echo ($data['media_interval']!="" ? $data['media_interval'] : "5000"); ?>',
		media_duration = '<?php echo ($data['media_duration'] ? $data['media_duration'] : "500"); ?>',
		media_pager = <?php if($data['media_pager']=="0") { echo "false"; } else { echo "true"; } ?>;

	/* Home slider */
	var homeFS = new Array();
	<?php
		if($data['home_style']=="Fullwidth slideshow") {
	?>
			homeFS[0] =  '',
			homeFS[1]= '',
			homeFS[2]= '',
			homeFS[3]=<?php echo ($data['home_slider_settings_18']=='1' ? 'true' : 'false'); ?>,
			homeFS[4]=<?php echo ($data['home_slider_settings_4']=='1' ? 'true' : 'false'); ?>,
			homeFS[5]=<?php echo ($data['home_slider_settings_5']!='' ? $data['home_slider_settings_5'] : 0); ?>,
			homeFS[6]=<?php echo ($data['home_slider_settings_6']=='1' ? 'true' : 'false'); ?>;
			homeFS[7]=<?php echo ($data['home_slider_settings_7']!='' ? $data['home_slider_settings_7'] : 7000); ?>,
			homeFS[8]=<?php echo ($data['home_slider_settings_8']!='' ? $data['home_slider_settings_8'] : 600); ?>,
			homeFS[9]=<?php echo ($data['home_slider_settings_9']!='' ? $data['home_slider_settings_9'] : 0); ?>,
			homeFS[10]=<?php echo ($data['home_slider_settings_10']=='1' ? 'true' : 'false'); ?>,
			homeFS[11]=<?php echo ($data['home_slider_settings_11']=='1' ? 'true' : 'false'); ?>,
			homeFS[12]=<?php echo ($data['home_slider_settings_12']=='1' ? 'true' : 'false'); ?>,
			homeFS[13]=<?php echo ($data['home_slider_settings_13']=='1' ? 'true' : 'false'); ?>,
			homeFS[14]=<?php echo ($data['home_slider_settings_14']=='1' ? 'true' : 'false'); ?>,

			homeFS[15]=<?php echo ($data['home_slider_settings_15']=='1' ? 'true' : 'false'); ?>,
			homeFS[16]=<?php echo ($data['home_slider_settings_16']=='1' ? 'true' : 'false'); ?>,
			homeFS[17]=<?php echo ($data['home_slider_settings_17']=='1' ? 'true' : 'false'); ?>;
	<?php
	 	}
	 ?>

	/* Background stretch */
	<?php
		if($data['body_bg_size']=="1") {
	?>
			$(function() {$(document.body).css({backgroundSize: "cover"});});
	<?php
		}
	?>

	/* Fullscreen button */
	<?php
		if($data['header_fullscreen']=="1") {
	?>
	$(function() {
		if ( !screenfull ) {
			$('#screenfull').hide();
			return false;
		}
		$('#screenfull').live('click',function() {
			screenfull.toggle($('body')[0]);
		});
		screenfull.onchange();
	});
	<?php
		}
	?>

	/* Twitter widget */
	var twitter_username = "<?php echo $twitter_username; ?>",
		twitter_count = "<?php echo $twitter_count; ?>";

	/* Contact panel */
	<?php if($data["contact_activate"]==true) { ?>
		var script = '<script type="text/javascript" src="http://google-maps-' +
          'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
      	if (document.location.search.indexOf('compiled') !== -1) {
        	script += '-compiled';
      	}
      	script += '.js"><' + '/script>';
      	document.write(script);

      	var sites = [
      		<?php
      			$i=1;
      			while ($i<=5) {
      				if(!isset($data['contact_gmap'.$i.'_lon'])) $data['contact_gmap'.$i.'_lon'] = '';
      				if(!isset($data['contact_gmap'.$i.'_lat'])) $data['contact_gmap'.$i.'_lat'] = '';
      				if(!isset($data['contact_gmap'.$i.'_text'])) $data['contact_gmap'.$i.'_text'] = '';
      				$lon = $data['contact_gmap'.$i.'_lon'];
      				$lat = $data['contact_gmap'.$i.'_lat'];
      				$text = $data['contact_gmap'.$i.'_text'];

      				if($lon!="" && $lat!="") {
      					if($i>1) {
      						echo ',';
      					}
      					echo "['', ".$lat.", ".$lon.", ".$i.", '<div class=phoneytext>".$text."</div>']";
      				}
	      			$i++;
      			}
      		?>
		];
		var gmapPin = '<?php echo get_stylesheet_directory_uri() . '/img/map_pins/'; ?>pin_<?php echo $data["map_pin"]; ?>.png';
		var gmapCenterLat = '<?php echo $data["contact_gmapc_lat"]; ?>';
		var gmapCenterLon = '<?php echo $data["contact_gmapc_lon"]; ?>';
		var gmapZoom = <?php echo $data["contact_gmap_zoom"]; ?>;
	<?php } ?>
</script>

<!-- media-queries.js (fallback) -->
<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!-- html5.js -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

	</head>

	<body <?php body_class(); ?>>

		<?php
			if($data["body_bg_overlay"]==1) {
				echo '<div id="bg-overlay"></div>';
			}
		?>
		<?php include(get_template_directory() . '/framework/inc/search.php'); ?>
		<?php include(get_template_directory() . '/framework/inc/contact.php'); ?>

		<header role="banner" class="contact-closed search-closed">

			<div id="inner-header" class="clearfix">
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container-fluid nav-container">
							<nav role="navigation">
								<?php
									if ( isset($data['logo_image']) && $data['logo_image']!="" ) {
								?>
										<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" href="#" data-rel="<?php echo home_url( '/'); ?>" class="brand" id="logo"><img src="<?php echo $data["logo_image"];?>" alt="<?php bloginfo('name'); ?>" /></a>
								<?php
									} else {
								?>
										<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" href="#" data-rel="<?php echo home_url( '/'); ?>"  class="brand" id="logo"><span><?php bloginfo('name'); ?></span></a>
								<?php
									}
								?>

								<div id="menuContainer" class="clearfix">
									<div class="btn-group pull-right responsiveMenuGroup">
										<a id="responsiveMenuTrigger" class="btn btn-inverse"><em class="icon-reorder icon-white"></em></a>
										<?php if($data['contact_activate']=="1") { ?><a href="#" data-rel="" id="contact" class="btn btn-inverse"><em class="icon-envelope-alt icon-white"></em></a><?php } ?>
										<a href="#" data-rel="" id="search" class="btn btn-inverse"><em class="icon-search icon-white"></em></a>
										<?php if($data["footer_sidebar_activate"]==true) { ?>
											<a href="#" class="sidebar-toggle btn btn-inverse"><em class="icon-list"></em></a>
										<?php } ?>
										<?php if($data['header_fullscreen']=="1") { ?><a href="#" data-rel="" id="screenfull" class="btn btn-inverse"><em class="icon-fullscreen icon-white"></em></a><?php } ?>
									</div>

									<?php
										if ( has_nav_menu( 'main_nav' ) ) :
											$args = array(
												'theme_location' => 'main_nav',
												'depth'		 => 2,
												'menu_id' => 'responsiveMenu',
												'container'	 => false,
												'menu_class'	 => 'nav pull-right',
												'walker'	 => new Bootstrap_Walker_Nav_Menu()
											);
											wp_nav_menu($args);
										endif;
									?>
								</div><!-- end #menuContainer -->
							</nav>

						</div><!-- end .nav-container -->
					</div><!-- end .navbar-inner -->
				</div><!-- end .navbar -->

			</div> <!-- end #inner-header -->

		</header> <!-- end header -->

		<div id="main-content" class="clearfix">
			<div class="nano">
				<div class="content">

