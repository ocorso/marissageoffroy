<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * File containing styles applied through the admin section
 *
 * /framework/dynamic_css.php
 * Version of this file : 1.7
 *
 */
?>
<?php
if ( ! function_exists( 'bm_dynamic_CSS' ) ) :
	function bm_dynamic_CSS() {
		global $data;
?>
<style>
	<?php
	/* Base Typography */
		$used_gf = array('');
		function generate_typo_seq($element,$selector) {
			global $data, $used_gf;
			$typo_style  = $data['typo_'.$element]['style'];
			if($element!="link") {
				$typo_size = $data['typo_'.$element]['size'];
			}

			$typo_face = "";
			global $google_fonts;
			foreach ($google_fonts as $font) {
				if ( $data['typo_'.$element]['face'] == $font['name'] )
					$typo_face = $font['name'].$font['variant'];
			}
			if($typo_face=="") {
				$typo_face = $data['typo_'.$element]['face'];
			} else {
				$safe_font = str_replace( " ","+",$typo_face);
				$safe_font = str_replace( '|"','"',$safe_font);
				if(!empty($used_gf)) {
					if(!in_array($safe_font,$used_gf)) {
						$used_gf[]=$safe_font;
						//echo ' @import url(http://fonts.googleapis.com/css?family='.$safe_font.'); ';
					}
				} else {
					$used_gf[]=$safe_font;
				}
				$typo_face = "'".$typo_face."'";
			}

			$typo_seq = $selector . " {";
			$typo_seq .= "font:".$typo_style." ".$typo_size." ".$typo_face.";";
			$typo_seq .= "color:".$data['typo_'.$element]['color'] .";";
			$typo_seq .= "}";
			return array($used_gf,$typo_seq);
		}

		$body_seq = generate_typo_seq('body','body');
		$h1_seq = generate_typo_seq('h1','h1');
		$h2_seq = generate_typo_seq('h2','h2');
		$h3_seq = generate_typo_seq('h3','h3');
		$h4_seq = generate_typo_seq('h4','h4');
		$h5_seq = generate_typo_seq('h5','h5');
		$h6_seq = generate_typo_seq('h6','h6');

		$gf_fonts = $h6_seq[0];
		foreach($gf_fonts as $key => $id) {
			if($id!="") {
			echo ' @import url(http://fonts.googleapis.com/css?family='.$id.'); ';
			}
		}

		echo $body_seq[1]."\n";
		echo $h1_seq[1]."\n";
		echo $h2_seq[1]."\n";
		echo $h3_seq[1]."\n";
		echo $h4_seq[1]."\n";
		echo $h5_seq[1]."\n";
		echo $h6_seq[1]."\n";
		echo '.utility .btn-rdd { border-color: '.$data["typo_link"]['color'].'; }';
	?>
	<?php
	/* Backgrounds */
		$bg_color = ($data["body_custom_bg_color"] !="") ? $data["body_custom_bg_color"]." " : "";
		$bg_col=($data['body_bg'] == "Custom") ? $bg_color : "#000 ";

		$bg_im = ($data['body_bg'] == "Custom") ? "url(".$background=$data['body_custom_bg'].") " : "url(".get_bloginfo('template_directory')."/img/bg/".$data['body_bg'].") ";

		$bg_rep=($data['body_bg'] == "Custom") ? $data["body_custom_bg_repeat"]." " : "no-repeat ";
		$bg_pos=($data['body_bg'] == "Custom") ? $data["body_custom_bg_position"]." " : "top left ";
		$bg_attach = ($data["body_custom_bg_attachment"] == "Fixed in place") ? "fixed" : "scroll";
		$bg_att=($data['body_bg'] == "Custom") ? $bg_attach." " : "fixed ";

		$bg_sequence = "background:";
		$bg_sequence .= ($bg_col != "") ? $bg_col : "";
		$bg_sequence .= ($bg_im != "") ? $bg_im : "";
		$bg_sequence .= ($bg_rep != "") ? $bg_rep : "";
		$bg_sequence .= ($bg_pos != "") ? $bg_pos : "";
		$bg_sequence .= ($bg_att != "") ? $bg_att : "";
		$bg_sequence .= ";";

		echo "body {".$bg_sequence."}";
	?>
		<?php
			if($data['header_fullscreen']=="1") {
				$bg_sequence .="width:100%;height:100%;";
				echo "body:-webkit-full-screen	{ ".$bg_sequence." }";
				echo "body:-moz-full-screen		{ ".$bg_sequence." }";
				echo "body:-ms-full-screen		{ ".$bg_sequence." }";
				echo "body:-o-full-screen		{ ".$bg_sequence." }";
				echo "body:full-screen			{ ".$bg_sequence." }";
			}
		?>
	<?php
	/* Logo */
	if($data['logo_image']!="") {
		$image_url = $data['logo_image'];
		$image_id = get_image_id($image_url);
		$height=wp_get_attachment_image_src($image_id);
		$height=$height[2]+2*$data["logo_spacing"];
		if($height<=40) {
			$padding=(40-$height)/2;
			$height=40;
			echo ".navbar .brand img { padding:".$padding."px 0; }";
		} else {
			echo ".navbar .brand img { padding:".$data["logo_spacing"]."px 0; }";
		}
		echo "#main-content { top: ".$height."px; }";
		echo "header[role='banner'], .navbar .divider-vertical  { height: ".$height."px } ";
		echo ".navbar ul.nav > li > a { line-height: ".$height."px; }";
		echo "#contactMap, #search_panel { bottom: ".$height."px; }";
	}
	?>
	<?php
	/* Images */
		if($data["height_archive"]!="" && is_numeric($data["height_archive"])) {
			echo ".template-blog .img-container { overflow:hidden; max-height:".$data["height_archive"]."px }";
		}
	?>
	<?php
	/* Typography */
		if($data["responsive_nav_arrows"]=="1") {
			echo "@media only screen and (max-width: 480px) {";
			echo "a.TopPrev, a.TopNext { display:none; }";
			echo "}";
		}
	?>
	<?php
	/* Custom CSS */
		if($data['custom_css']) {
			print_r($data['custom_css']);
		}
	?>
	</style>
<?php
	}
	add_action('wp_head', 'bm_dynamic_CSS');
endif;
?>
<?php
if ( ! function_exists( 'bm_cufon' ) ) :
	function bm_cufon() {
		global $data;
?>
	<!-- Cufon -->
		<?php
			// Font 1
			if($data["cufon_activate"]==1) {
				function cufon_one() {
					global $data;
					$elements1=$data["cufon_font1_class"];
					?>
<script type="text/javascript"> Cufon.replace('<?php echo $elements1; ?>', {hover: 'true'}); </script>
					<?php
				}
				add_action( 'wp_print_footer_scripts', 'cufon_one' );
			}
			//Font 2
			if($data["cufon_activate"]==1 && $data["cufon_font2_activate"]=="1") {
				function cufon_two() {
					global $data;
					$elements2=$data["cufon_font2_class"];
					?>
<script type="text/javascript"> Cufon.replace('<?php echo $elements2; ?>', {hover: 'true'}); </script>
					<?php
				}
				add_action( 'wp_print_footer_scripts', 'cufon_two' );
			}
			function cufon_refresh() {
				global $data;
			?>
<script type="text/javascript"> var cufon_refresh = function() { <?php if($data["cufon_activate"]==1 || $data["cufon_font2_activate"]=="1") { ?> Cufon.refresh(); <?php } ?> } </script>
			<?php
			}
			add_action('wp_print_footer_scripts','cufon_refresh');
		?>
<?php
	}
	add_action('wp_head', 'bm_cufon');
endif;