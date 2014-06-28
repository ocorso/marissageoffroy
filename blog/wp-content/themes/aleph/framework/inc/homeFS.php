<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/inc/homeFS.php
 * Version of this file : 1.7
 *
 */
?>

				<div id="content" class="clearfix container-fluid home-full-slider" data-level="top" data-type="post">
					<div id="main" class="clearfix" role="main">

<?php global $data; ?>

<?php
							$FS_source = $data['FS_source'];

							if($FS_source != "Custom slides") {
								$postlimit = $data['FS_source_limit'];
								$slider=Array();
								$temp = $wp_query;
								$wp_query= null;
								$homeFS_args = array(
										'post_type'=>array('portfolio','post','page'),
							 			'posts_per_page'=>'-1',
							 			'nopaging'=>'true',
							 			'orderby'=>'menu_order',
							 			'order'=>'ASC',
							 			'ignore_sticky_posts' => 1,
							 			'meta_query' => array(
							 				array(
							 					'key' => 'home_featured',
							 					'value'=> 'on'
							 				)
							 			)
								);
								$wp_query = new WP_Query( $homeFS_args );
								$k=0;
								while ($wp_query->have_posts() && $k<$postlimit) : $wp_query->the_post();
									$slider[$k]=array(
										"order"   => $k+1,
										"title"   => get_the_title(),
										"caption" => get_post_meta($post->ID,'home_featured_caption',true),
										"showtext"=> (get_post_meta($post->ID,'home_featured_showtext',true) == "on" ? "1" : "0"),
										"slidelayout" => "Content above media",
										"positiontext"=> get_post_meta($post->ID,'home_featured_positiontext',true),
										"mediatype"=> get_post_meta($post->ID,'home_featured_mediatype',true),
										"imagebg"=> get_post_meta($post->ID,'home_featured_imagestyle',true),
										"imageurl" => featured_image_link($post->ID),
										"videoprovider"=> get_post_meta($post->ID,'home_featured_videoprovider',true),
										"videourl"=> get_post_meta($post->ID,'home_featured_videourl',true),
										"showbutton" => "0",
										"contentstyle" => get_post_meta($post->ID,'home_featured_contentstyle',true),
										"contentbackground"=> (get_post_meta($post->ID,'home_featured_contentbackground',true) == "on" ? "1" : "0"),
									);
									$k++;
								endwhile;
								$wp_query = null; $wp_query = $temp;
								wp_reset_postdata();

							} else {
								$slider=$data['FS_slider'];

							}


	if(count($slider)>0) {
		function show_content($slide) {
			if($slide['title']!="") {
				echo '<h1 class="slider-title">'.$slide['title'].'</h1>';
			}
			if($slide['caption']!="") {
				echo '<div class="clear"></div>';
				echo '<div class="slide-caption">';
					echo apply_filters('the_content', $slide['caption']);
				//echo nl2br($slide['caption']);
				echo '</div>';
			}
			if($slide['showbutton']=="1") {
				if($slide['buttontext']!="") {
					echo '<div class="slider-button"><a href="'.$slide['buttonlink'].'" class="btn btn-large btn-'.strtolower($slide['buttonstyle']).'" target="_blank">'.$slide['buttontext'].'</a></div>';
				}
			}
		}
		function show_video($provider,$id,$number) {
			switch($provider) {
				case "YouTube" :
					return '<iframe id="player_'.$number.'" class="youtube" src="http://www.youtube.com/embed/'.$id.'?enablejsapi=1" frameborder="0" width="500" height="281"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
					break;
				case "Vimeo" :
					return  '<iframe id="player_'.$number.'" class="vimeo" src="http://player.vimeo.com/video/'.$id.'?api=1&byline=0&title=0&&portrait=0&player_id=player_'.$number.'" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
					break;
			}
		}


?>
	<?php
		if(!isset($data["home_slider_bg"])) $data["home_slider_bg"] = '';
		$slider_bg = $data["home_slider_bg"];
		$custom_slider_bg = strstr($slider_bg,'custom_bg');
		$none_slider_bg = strstr($slider_bg,'none_bg');
		if($custom_slider_bg!="") {
			$slider_bg_i = $data["bg_home_slider_custom"];
			$slider_bg_c = $data["bg_home_slider_custom_color"];
			$slider_bg_r = $data["bg_home_slider_custom_repeat"];
			$slider_bg_p = $data["bg_home_slider_custom_position"];
			$slider_bg_a = $data["bg_home_slider_custom_attachment"];
			$slider_bg = "background:".$slider_bg_c . " url(".$slider_bg_i.") ". $slider_bg_r . " " . $slider_bg_p . " " . $slider_bg_a;
		} elseif($none_slider_bg!="") {
			$slider_bg = false;
		}
	?>
	<div id="loading"><div class="preloader"></div></div>
	<div id="home_slider" class="flexslider" style="<?php if($slider_bg!=false) { echo $slider_bg; } ?>">
		<ul class="slides">
			<?php
				if(is_array($slider)) {
					foreach($slider as $number=>$slide) { ?>
						<li class="slide-<?php echo $number; ?>">
							<?php
								$slidelayout = $slide['slidelayout'];
								$mediatype = $slide['mediatype'];

								switch($slidelayout) {
									case "Content above media":

										switch ($mediatype) {
											case "Image" :
												echo '<div class="slide-media absolute-pos" style="background-image:url('.$slide['imageurl'].');" data-bg-size="'.strtolower($slide['imagebg']).'"></div>';
												break;
											case "Video" :
												echo '<div class="slide-media absolute-pos">';
													echo show_video($slide['videoprovider'],$slide['videourl'],$number);
												echo '</div>';
												break;
										}

										if($slide['showtext']=="1") {
											$class = '';
											if($slide['contentbackground']=="1") {
												$class .= ' shadow ';
											}
											echo '<div class="slide-content '.$slide['contentstyle'].' span6 '.$slide['positiontext'].' '.$class.' absolute-pos">';
											show_content($slide);
											echo '</div>';
										}

										break;
									default :

										echo '<div class="container"><div class="row">';

											$class = '';
											if($slide['contentbackground']=="1") {
												$class .= ' shadow ';
											}


											if($slidelayout == "Media Left/Content right") {
												echo '<div class="span6 slide-media">';
												switch ($mediatype) {
														case "Image" :
															echo "<img src='".$slide['imageurl']."' title='".$slide['title']."' />";
															break;
														case "Video" :
																echo show_video($slide['videoprovider'],$slide['videourl'],$number);
															break;
													}
												echo '</div>';
												echo '<div class="slide-content span6 '.$slide['contentstyle'] .$class .'">';
													show_content($slide);
												echo '</div>';
											} elseif ($slidelayout == "Media Right/Content Left") {
												echo '<div class="slide-content span6 '.$slide['contentstyle'] .$class .'">';
													show_content($slide);
												echo '</div>';
												echo '<div class="span6 slide-media">';
												switch ($mediatype) {
														case "Image" :
															echo "<img src='".$slide['imageurl']."' title='".$slide['title']."' />";
															break;
														case "Video" :
																echo show_video($slide['videoprovider'],$slide['videourl'],$number);
															break;
													}
												echo '</div>';
											}

										echo '</div></div>';

										break;

								}
							?>
						</li>
			<?php
					}
				}
			?>
		</ul>
	</div>
<?php } ?>

					</div> <!-- end #main -->

				</div> <!-- end #content -->