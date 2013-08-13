<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file for creating shortcodes
 *
 * /framework/shortcodes/core.php
 * Version of this file : 1.4
 *
 *
 *  Alerts
 *	Buttons
 * 	Columns
 * 	Dividers
 * 	Gallery
 *  Icons
 *  Lists
 *  Quotes
 *  Tabs
 * 	Accordion
 * 	Tooltips
 * 	Flex Slider
 *	Videos
 *
 *
 */
?>
<?php


	/**
	 * ------------------------------------------------------------------------
	 * Alerts
	 * ------------------------------------------------------------------------
	 */
		function alert( $atts, $content = null ) {
		   extract( shortcode_atts( array(
			  'type' => 'blue',
			  'close' => 'off',
			  'fade' => 'on',
			  'block' => 'off'
			  ), $atts ) );
			switch ($type) {
				case "yellow":
					$alert .='<div class="alert';
					break;
				case "green":
					$alert .='<div class="alert alert-success';
					break;
				case "blue":
					$alert .='<div class="alert alert-info';
					break;
				case "red":
					$alert .='<div class="alert alert-error';
					break;
			}
			if($fade == 'on') {
				$alert .= ' fade in';
			}
			if($block == 'on') {
				$alert .= ' alert-block';
			}
			$alert .= '">';
			if($close == 'on') {
				$alert .= '<a class="close" data-dismiss="alert">&times;</a>';
			}
			$alert .= $content;
			$alert .= '</div>';
			return $alert;
		}
		add_shortcode('alert', 'alert');

	/**
 	 * ------------------------------------------------------------------------
	 * Buttons
	 * ------------------------------------------------------------------------
	 */
		function button_sc($atts, $content = null) {
			extract(shortcode_atts(array(
				"color" => 'default',
				"to"	=> '',
				"target"=> '',
				"size"  => 'medium',
				"icon" => '',
				"iconposition" => 'left',
				"disable"=>"off",
				"inner_link" =>"true",
				"inner_level" =>"sub"
			), $atts));
			$button = '';
			$button .= '<a ';
			if($inner_link=="true" && $inner_level=="top") {
				$button .='data-rel="'.$to.'" ';
				$button .='class="btn call-to-top';
			} else {
				if($target=="_blank" && $inner_link=="false") {
					$button .= ' target="'.$target.'"';
				}
				$button .= ' href="'.$to.'"';
				$button .='class="btn ';
			}
			if($color!="default") {
				$button .= ' btn-'.$color;
			}
			if($disable=="on") {
				$button .= ' disabled';
			}
			switch ($size) {
				case "small" :
					$button .= ' btn-mini';
					break;
				case "medium" :
					$button .= ' btn-small';
					break;
				case "large" :
					$button .= ' btn-large';
					break;
			}
			$button .= '">';
			if($iconposition=="left" && $icon!="") {
				$button .= '<em class="'.$icon.'"></em> ';
			}
			$button .= $content;
			if($iconposition=="right" && $icon!="") {
				$button .= ' <em class="'.$icon.'"></em>';
			}
			$button .='</a>';
			return $button;
		}
		add_shortcode("button", "button_sc");

	/**
	 * ------------------------------------------------------------------------
	 * Columns
	 * ------------------------------------------------------------------------
	 */
		// Row
		function row( $atts, $content = null ) {
		   return '<div class="row-fluid clearfix">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('row', 'row');

		// 1 col
		function col1( $atts, $content = null ) {
		   return '<div class="span12">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col1', 'col1');

		// 2 cols
		function col2( $atts, $content = null ) {
		   return '<div class="span6">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col2', 'col2');

		// 3 cols
		function col3( $atts, $content = null ) {
		   return '<div class="span4">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col3', 'col3');

		// 4 cols
		function col4( $atts, $content = null ) {
		   return '<div class="span3">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col4', 'col4');

		// 6 cols
		function col6( $atts, $content = null ) {
		   return '<div class="span2">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col6', 'col6');

		// 2/3 cols
		function col32( $atts, $content = null ) {
		   return '<div class="span8">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col32', 'col32');

		// 3/4 cols
		function col43( $atts, $content = null ) {
		   return '<div class="span9">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col43', 'col43');

		// 5/6 cols
		function col65( $atts, $content = null ) {
		   return '<div class="span10">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('col65', 'col65');


	/**
	 * ------------------------------------------------------------------------
	 * Dividers
	 * ------------------------------------------------------------------------
	 */
	 	// Horizontal rule
	if ( ! function_exists( 'hrule' ) ) :
		function hrule() {
		   return '<hr>';
		}
		add_shortcode('hr', 'hrule');
	endif;

		// spacer
	if ( ! function_exists( 'spacer' ) ) :
		function spacer() {
		   return '<div class="spacer"></div>';
		}
		add_shortcode('spacer', 'spacer');
	endif;

		// clear line
	if ( ! function_exists( 'clear_float' ) ) :
		function clear_float() {
		   return '<div class="clear"></div>';
		}
		add_shortcode('clear', 'clear_float');
	endif;


	/**
	 * ------------------------------------------------------------------------
	 * Gallery
	 * ------------------------------------------------------------------------
	 */
	remove_shortcode('gallery', 'gallery_shortcode');
	add_shortcode('gallery', 'gallery_shortcode_tbs');

	function gallery_shortcode_tbs($attr) {
		global $post, $wp_locale;

		$args = array( 'post_type' => 'attachment', 'number posts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
		$attachments = get_posts($args);
		if ($attachments) {
			$output = '<div class="row-fluid"><ul class="thumbnails">';
			foreach ( $attachments as $attachment ) {
				$output .= '<li>';
				$att_title = apply_filters( 'the_title' , $attachment->post_title );
				$att_src = wp_get_attachment_image_src( $attachment->ID , 'thumbnail', false);
				$att_full = wp_get_attachment_image_src( $attachment->ID , 'full', false);
				$output .= "<a href='".$att_full[0]."' class='thumbnail fancybox' rel='gallery-".$post->ID."'><img src='".$att_src[0]."'></a>";
				$output .= '</li>';
			}
			$output .= '</ul></div>';
		}

		return $output;
	}

	/**
 	 * ------------------------------------------------------------------------
	 * Icons
	 * ------------------------------------------------------------------------
	 */
		function icon_sc($atts, $content = null) {
			extract(shortcode_atts(array(
				"type" => ''
			), $atts));

			$icon = '<em class="'.$type.'"></em>';

			return $icon;
		}
		add_shortcode("icon", "icon_sc");


	/**
	 * ------------------------------------------------------------------------
	 * Lists
	 * ------------------------------------------------------------------------
	 */
	if ( ! function_exists( 'ulist' ) ) :
		function ulist( $atts, $content = null ) {
		   extract( shortcode_atts( array(
			  'type' => ''
			  ), $atts ) );
			$class="checklist";
		   return '<ul class="icons">' . wpautop(do_shortcode(trim($content))) . '</div>';
		}
		add_shortcode('ulist', 'ulist');
	endif;



	/**
	 * ------------------------------------------------------------------------
	 * Quotes
	 * ------------------------------------------------------------------------
	 */
	if ( ! function_exists( 'pullquote' ) ) :
		function pullquote( $atts, $content = null ) {
		   extract( shortcode_atts( array(
			  'position' => '',
			  'cite' => ''
			  ), $atts ) );
			$pullquote = '<blockquote';

			if($position == "none") {
				$pullquote .= ' ';
			} elseif($position == 'left') {
				$pullquote .= ' class="pull-left"';
			} elseif($position == 'right'){
				$pullquote .= ' class="pull-right"';
			}

			$pullquote .= '><p>' . $content . '</p>';

			if($cite){
				$pullquote .= '<small>' . $cite . '</small>';
			}

			$pullquote .= '</blockquote>';

		   return $pullquote;
		}
		add_shortcode('pullquote', 'pullquote');
	endif;



	/**
	 * ------------------------------------------------------------------------
	 * Tabs
	 * ------------------------------------------------------------------------
	 */
		add_shortcode( 'tabs', 'atabs' );
		function atabs( $atts, $content ){
			extract( shortcode_atts( array(
			  'type' => 'tabs',
			  'orientation' => 'tabs-top'
			  ), $atts ) );

			$GLOBALS['tabs']="";
			$GLOBALS['tab_count'] = 0;

			wpautop(do_shortcode( $content ));

			if( is_array( $GLOBALS['tabs'] ) ){
				$counter=1;
				foreach( $GLOBALS['tabs'] as $tab ){
					$i=ceil(rand(1,100));
					if($counter==1) { $class="active"; } else { $class=""; }
					if($type=='nav-tabs' || $type=='nav-tabs nav-stacked') { $data_toggle="tab"; } else { $data_toggle="pill"; }
					$tabs[] = '<li class="'.$class.'"><a href="#tab'.$i.'" data-toggle="'.$data_toggle.'">'.$tab['title'].'</a></li>';
					$panes[] = '<div id="tab'.$i.'" class="tab-pane '.$class.'">'.wpautop($tab['content']).'</div>';
					$counter++;
				}

			if($orientation=="tabs-top") { $orientation=""; }

			$tabscode  = '<div class="tabbable '.$orientation.'">';

			if($orientation!="tabs-below") {
				$tabscode .= '<ul class="nav '.$type.'">'.implode( "\n", $tabs ).'</ul>';
				$tabscode .= '<div class="tab-content">'.implode( "\n", $panes ).'</div>';
			} else {
				$tabscode .= '<div class="tab-content">'.implode( "\n", $panes ).'</div>';
				$tabscode .= '<ul class="nav '.$type.'">'.implode( "\n", $tabs ).'</ul>';
			}
			$tabscode .= '</div>';
			}
			return wpautop(do_shortcode($tabscode));
		}

		add_shortcode( 'tab', 'mtab' );
		function mtab( $atts, $content ){
			extract(shortcode_atts(array(
			'title' => 'Tab %d',
			), $atts));

			$x = $GLOBALS['tab_count'];
			$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

			$GLOBALS['tab_count']++;
		}


	/**
	 * ------------------------------------------------------------------------
	 * Accordion
	 * ------------------------------------------------------------------------
	 */
		function toggle( $atts, $content = null ) {
		   extract( shortcode_atts( array(
			  'title' => 'Toggle',
			  'default' => 'open'
			  ), $atts ) );

			$id=ceil(rand(1,100));

			$toggle .= '<div class="accordion-group">';

			$toggle .= '<div class="accordion-heading">';
			$toggle .= '<a class="accordion-toggle" href="#'.$id.'" data-toggle="collapse">'.$title.'</a>';
			$toggle .= '</div>';

			$toggle .= '<div id="'.$id.'" class="accordion-body ';
			if($default=="open") {
				$toggle .= 'in';
			} else {
				$toggle .= 'collapse';
			}
			$toggle .= '">';
			$toggle .= '<div class="accordion-inner">'.$content.'</div>';
			$toggle .= '</div>';

			$toggle .= '</div>';

			$toggle = do_shortcode($toggle);

			return $toggle;
		}
		add_shortcode('toggle', 'toggle');



		add_shortcode( 'accordion', 'acctabs' );
		function acctabs( $atts, $content ){
			$GLOBALS['tabs']="";
			$GLOBALS['tab_count'] = 0;

			do_shortcode( $content );
			$id_cat=ceil(rand(20,20));

			if( is_array( $GLOBALS['tabs'] ) ){
				$tabscode ='<div id="'.$id_cat.'" class="accordion">';
				$i=1;
				foreach( $GLOBALS['tabs'] as $tab ){
					$id=ceil(rand(1,100));
					$tabscode .= '<div class="accordion-group">';
					$tabscode .= '<div class="accordion-heading">';
					$tabscode .= '<a class="accordion-toggle" href="#'.$id.'" data-parent="#'.$id_cat.'" data-toggle="collapse">'.$tab['title'].'</a>';
					$tabscode .= '</div>';
					$tabscode .= '<div id="'.$id.'" class="accordion-body ';
						if($i==1) {
							$tabscode .= 'in';
						} else {
							$tabscode .= 'collapse';
						}
					$tabscode .= '">';
					$tabscode .= '<div class="accordion-inner">'.wpautop($tab['content']).'</div>';
					$tabscode .= '</div>';
					$tabscode .= '</div>';
					$i++;
				}
			}
			$tabscode .= '</div>';
			return do_shortcode($tabscode);
		}

		add_shortcode( 'accordiontab', 'maccordiontab' );
		function maccordiontab( $atts, $content ){
			extract(shortcode_atts(array(
			'title' => 'Tab %d',
			), $atts));

			$x = $GLOBALS['tab_count'];
			$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

			$GLOBALS['tab_count']++;
		}

	/**
 	 * ------------------------------------------------------------------------
	 * Tooltips
	 * ------------------------------------------------------------------------
	 */
		function tooltip_sc($atts, $content = null) {
			extract(shortcode_atts(array(
				"title"	=> '',
				"link"=> ''
			), $atts));

			$tooltip .= '<a class="ttip" title="'.$title.'" href="'.$link.'">';
			$tooltip .= $content;
			$tooltip .='</a>';
			return $tooltip;
		}
		add_shortcode("tooltip", "tooltip_sc");


	/**
	 * ------------------------------------------------------------------------
	 * Flex Slider
	 * ------------------------------------------------------------------------
	 */
	function efs_get_slider($resize, $layout){

		if($layout == "default") { $layout == ""; }
		if($resize == "width") { $resize == ""; }

		$slider= '<div class="blueberry '.$layout.' clearfix">
		  <ul class="slides clearfix">';

			$images = get_children( array(
									'post_parent' => get_the_ID(),
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order' => 'ASC',
									'orderby' => 'menu_order' )
									);
				$number = count($images);
				if ( $images )  {

						foreach ( $images as $id => $image ) {
							$attatchmentID = $image->ID;
							$imagearray = wp_get_attachment_image_src( $attatchmentID , 'portfolio-thumb', false);
							$imageURI = $imagearray[0];
							$imageID = get_post($attatchmentID);
							$imageTitle = $imageID->post_title;
							$slider.="<li class='".$resize."'>";
									$slider .=showimage (
										$imageURI,
										$link_url="",
										$imageTitle=$imageTitle
										);
							$slider .="</li>";
						}
				}

		$slider .= '</ul>';
		$slider .='<ul class="pager span4 clearfix">';
		for ($i=1;$i<=$number;$i++) {
			$slider  .= '<li><a href="#"><span></span></a></li>';
		}
		$slider .='</ul>';
		$slider .='</div>';

		return $slider;
	}

	function efs_insert_slider($atts, $content=null){

		extract(shortcode_atts(array(
			"resize"=>'width',
			"layout" => 'default'
		), $atts));

		$slider= efs_get_slider($resize, $layout);

		return $slider;

	}

	add_shortcode('slider', 'efs_insert_slider');

	function efs_slider(){

		print efs_get_slider($resize, $layout);
	}


	/**
	 * ------------------------------------------------------------------------
	 * Videos
	 * ------------------------------------------------------------------------
	 */
		if ( !function_exists( 'get_vid_sc' ) ) {

			function get_vid_sc($site, $id){

				if(!$site || !$id) return;

				if ( $site == "youtube" ) { $src = 'http://www.youtube-nocookie.com/embed/'.$id; }
			    else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id.'?title=0&byline=0&portrait=0&player_id=vimeoplayer'; }
			    else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id; }
			    else if ( $site == "yahoo" ) { $src = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$id; }
			    else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
			    else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id; }
			    else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/simple/'.$id; }
			    if ( $id != '' ) {
			        return '<div class="video-container flex-video '.$site.'"><iframe src="'.$src.'" class="vid iframe-'.$site.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
			    }
			}
		}

		if ( !function_exists( 'insert_vid_sc' ) ) {

			function insert_vid_sc($atts, $content=null){

				if ( empty( $atts ) ) return;

			    extract(
			        shortcode_atts(array(
			            'site' => 'youtube',
			            'id' => '',
			        ), $atts)
			    );

				if ( !$site || !$id ) return;

				$video = get_vid_sc($site, $id);

				return $video;

			}

			add_shortcode('video_embed', 'insert_vid_sc');
		}

		if ( !function_exists( 'vid_sc' ) ) {

			function vid_sc(){

				print get_vid_sc($site, $id);

			}
		}