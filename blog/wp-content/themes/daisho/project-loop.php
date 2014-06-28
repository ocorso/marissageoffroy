<?php
	$welcome_text = get_option("welcome_text");
	$front_page = get_option('front_page');
	global $demoServer;
	
	$is_home = is_home();
	$is_page_template_portfolio = is_page_template('template-portoflio.php');
	$is_singular_portfolio = is_singular('portfolio');

	if($portfolio_mode = get_option('portfolio_mode')){ }else{ $portfolio_mode = 0; } /* 1 = thumbnail grid, 0 = classic */
	if(!empty($_GET['prj']) && $_GET['prj'] == 'classic'){ $portfolio_mode = 0; }
	if(!empty($_GET['prj']) && $_GET['prj'] == 'thumb'){ $portfolio_mode = 1; }

	$taxonomy = 'portfolio_category';
	$tax_terms = get_terms($taxonomy, array('hide_empty' => true));
	
	/* Defaults */
	//$flow_portfolio_home_exclude = get_option('flow_portfolio_home_exclude'); /* Array of portfolio categories slugs */
	//$page_portfolio_tax_query_operator = false; /* Operator for exclude box, false = exlude, true = include */

	if(is_home() && $front_page != ''){
		$page_portfolio_tax_query_operator = get_post_meta((int) $front_page, 'page_portfolio_tax_query_operator', true); /* Operator for exclude box, false = exlude, true = include */
		$flow_portfolio_home_exclude = get_post_meta((int) $front_page, 'page_portfolio_exclude', true); /* Array of portfolio categories slugs */
	}else if(is_page_template('template-portoflio.php')){
		$page_portfolio_tax_query_operator = get_post_meta($wp_query->post->ID, 'page_portfolio_tax_query_operator', true); /* Operator for exclude box */
		$flow_portfolio_home_exclude = get_post_meta($wp_query->post->ID, 'page_portfolio_exclude', true); /* Array of portfolio categories slugs */
	}else if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
		$page_portfolio_tax_query_operator = get_post_meta($parent_page, 'page_portfolio_tax_query_operator', true); /* Operator for exclude box */
		$flow_portfolio_home_exclude = get_post_meta($parent_page, 'page_portfolio_exclude', true); /* Array of portfolio categories slugs */
	}else if(is_singular('portfolio') && !empty($front_page)){
		$page_portfolio_tax_query_operator = get_post_meta((int) $front_page, 'page_portfolio_tax_query_operator', true);
		$flow_portfolio_home_exclude = get_post_meta((int) $front_page, 'page_portfolio_exclude', true);
	}else{
		$page_portfolio_tax_query_operator = false;
		$flow_portfolio_home_exclude = array();
	}
	if(empty($page_portfolio_tax_query_operator)){
		$page_portfolio_tax_query_operator = false; //exclude - default, include = true
	}
	if(($portfolio_mode == '1' && is_home()) || ($portfolio_mode == '1' && is_singular('portfolio')) || is_page_template('template-portoflio.php')){ ?>
	<div class="tn-grid-container clearfix">
		<section class="tn-grid-container-inner clearfix">
			<section id="options" class="clearfix">
				<ul id="filters" class="option-set clearfix" data-option-key="filter">
					<li><a href="#filter" data-project-category-id="all" data-option-value="*" class="selected"><?php _e('All Works', 'flowthemes'); ?></a></li>
					<?php
						foreach($tax_terms as $tax_term){
							if($page_portfolio_tax_query_operator){
								if((is_array($flow_portfolio_home_exclude)) && in_array($tax_term->slug, $flow_portfolio_home_exclude)){
									echo '<li>' . '<a href="#filter" data-project-category-id="' . $tax_term->term_id . '" data-option-value=".portfolio-category-' . $tax_term->term_id . '">' . $tax_term->name  . '</a></li>';
								}else{
								}
							}else{
								if((is_array($flow_portfolio_home_exclude)) && in_array($tax_term->slug, $flow_portfolio_home_exclude)){
								}else{
									echo '<li>' . '<a href="#filter" data-project-category-id="' . $tax_term->term_id . '" data-option-value=".portfolio-category-' . $tax_term->term_id . '">' . $tax_term->name  . '</a></li>';
								}
							}
						}
					?>
				</ul>
				<ul id="etc" class="clearfix">
					<li id="toggle-sizes">
						<a href="#toggle-sizes" class="toggle-selected">
							<svg version="1.1" class="toggle-sizes-large-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
								<g>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2,0h14c1.105,0,2,0.895,2,2V16c0,1.104-0.895,2-2,2H2
										c-1.105,0-2-0.895-2-2V2C0,0.895,0.895,0,2,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0H26c1.105,0,2,0.895,2,2V6C28,7.104,27.105,8,26,8h-3.999
										C20.895,8,20,7.104,20,6V2C20,0.895,20.895,0,22.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10H26c1.105,0,2,0.895,2,1.999V16c0,1.104-0.895,2-2,2
										h-3.999C20.895,18,20,17.105,20,16V12C20,10.896,20.895,10,22.001,10z"/>
								</g>
							</svg>						
						</a>
						<a href="#toggle-sizes">
							<svg version="1.1" class="toggle-sizes-small-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
								<g>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,0h4C7.104,0,8,0.895,8,2V6c0,1.104-0.896,2-1.999,2h-4
										C0.896,8,0,7.104,0,6V2C0,0.895,0.896,0,2.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,0h4.001C17.105,0,18,0.895,18,2V6c0,1.104-0.895,2-1.998,2H12
										c-1.105,0-2-0.896-2-2V2C10,0.895,10.895,0,12,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0h4C27.104,0,28,0.895,28,2V6c0,1.104-0.896,2-1.999,2h-4
										C20.896,8,20,7.104,20,6V2C20,0.895,20.896,0,22.001,0z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,10h4C7.104,10,8,10.895,8,12V16c0,1.104-0.896,2-1.999,2h-4
										C0.896,18,0,17.105,0,16V12C0,10.895,0.896,10,2.001,10z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,10h4.001C17.105,10,18,10.895,18,12V16c0,1.104-0.895,2-1.998,2
										H12c-1.105,0-2-0.895-2-2V12C10,10.895,10.895,10,12,10z"/>
									<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10h4C27.104,10,28,10.895,28,12V16c0,1.104-0.896,2-1.999,2
										h-4C20.896,18,20,17.105,20,16V12C20,10.895,20.896,10,22.001,10z"/>
								</g>
							</svg>
						</a>
					</li>
					<?php
						if(is_home() && $front_page != ''){
							$flow_shuffle_button = get_post_meta((int) $front_page, 'page_portfolio_shuffle', true);
						}else if(is_page_template('template-portoflio.php')){
							$flow_shuffle_button = get_post_meta($post->ID, 'page_portfolio_shuffle', true);
						}else if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
							$flow_shuffle_button = get_post_meta($parent_page, 'page_portfolio_shuffle', true);
						}else if(is_singular('portfolio') && $front_page != ''){
							$flow_shuffle_button = get_post_meta((int) $front_page, 'page_portfolio_shuffle', true);
						}else{
							$flow_shuffle_button = false;
							//$flow_shuffle_button = get_option('flow_homepage_shuffle_button');
						}
					?>
					<?php if($flow_shuffle_button){ ?>
						<li id="shuffle"><a href='#shuffle'><?php _e('Shuffle', 'flowthemes'); ?></a></li>
					<?php } ?>
				</ul>
			</section> <!-- #options -->
			
			<div id="container" class="clickable variable-sizes clearfix">
	<?php } ?>
			<?php 
				$count = 0;
				$i = -1;
				$r = 0;
				
				// Projects Loop
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$post_per_page = -1;
				$do_not_show_stickies = 1; // 0 to show stickies
				
				if(is_home() && $front_page != ''){
					$orderby = get_post_meta((int) $front_page, 'page_portfolio_orderby', true);
					$order = get_post_meta((int) $front_page, 'page_portfolio_order', true);
				}else if(is_page_template('template-portoflio.php')){
					$orderby = get_post_meta($post->ID, 'page_portfolio_orderby', true);
					$order = get_post_meta($post->ID, 'page_portfolio_order', true);
				}else if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
					$orderby = get_post_meta($parent_page, 'page_portfolio_orderby', true);
					$order = get_post_meta($parent_page, 'page_portfolio_order', true);
				}else if(is_singular('portfolio') && $front_page != ''){
					$orderby = get_post_meta((int) $front_page, 'page_portfolio_orderby', true);
					$order = get_post_meta((int) $front_page, 'page_portfolio_order', true);
				}else{
					$orderby = 'date';
					$order = 'DESC';
					//$orderby = get_option('flow_portfolio_orderbymethod');
				}
			  
				$args = array(
					'post_type' => array('portfolio'),
					'orderby' => $orderby,
					'order' => $order,
					'paged' => $paged,
					'posts_per_page' => $post_per_page,
					'ignore_sticky_posts' => $do_not_show_stickies
				);
				if($page_portfolio_tax_query_operator){ // include
					$page_portfolio_tax_query_operator_sign = 'IN';
				}else{ // exclude - default
					$page_portfolio_tax_query_operator_sign = 'NOT IN';
				}
				if(isset($flow_portfolio_home_exclude) && is_array($flow_portfolio_home_exclude)){
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'portfolio_category',
							'field' => 'slug',
							'terms' => $flow_portfolio_home_exclude,
							'operator' => $page_portfolio_tax_query_operator_sign
						)
					); //category__in
				}

				$temp = $wp_query; // assign orginal query to temp variable for later use   
				$wp_query = null;
				$wp_query = new WP_Query($args);
				$element_small = '';
				if($wp_query->have_posts()){
					while($wp_query->have_posts()){ $wp_query->the_post();
						
						/* Get and process image */
						unset($attachments);
						unset($thumbnail_hover_color);
						$attachments = get_post_meta($post->ID, '300-160-image', true);
						$thumbnail_hover_color = get_post_meta($post->ID, 'thumbnail_hover_color', true);
						
						if($attachments or $thumbnail_hover_color){
						
							/* Get project categories */
							$project_categories = array();
							$project_categories = wp_get_object_terms($post->ID, "portfolio_category");
							
							// 1. Get project categories display names (for thumbnails)
							// 2. Get project categories slugs (for PHP/JS/CSS use)
							$project_categories_ids_array = array();
							$project_categories_names_array = array();
							$project_categories_slugs_array = array();
							foreach($project_categories as $project_category_index => $project_category_object){
								$project_categories_ids_array[] = $project_category_object->term_id;
								$project_categories_names_array[] = $project_category_object->name;
								$project_categories_slugs_array[] = $project_category_object->slug;
							}
							$project_categories_ids = array();
							foreach($project_categories_ids_array as $k => $v){ $project_categories_ids[$k] = 'portfolio-category-'.$v; };
							$project_categories_ids = implode(" ", $project_categories_ids);
							$project_categories_names = implode(", ", $project_categories_names_array);
							$project_categories_slugs = implode(" ", $project_categories_slugs_array);
							
							
							// TITLE
							$thumb_title_temp = '';
							if($thumb_title = get_post_meta($post->ID, 'flow_post_title', true)){
							}else if($thumb_title = get_post_meta($post->ID, 'Title', true)){
							}else{
								$thumb_title = get_the_title();
							}
							
							// DESCRIPTION
							if($thumb_descr = get_post_meta($post->ID, 'flow_post_description', true)){
								$thumb_descr = do_shortcode($thumb_descr);
							}else if($thumb_descr = get_post_meta($post->ID, 'Description', true)){
								$thumb_descr = do_shortcode($thumb_descr);
							}
							
							// THUMBNAIL META
							$thumb_ourrole = get_post_meta($post->ID, 'portfolio_ourrole', true);
							$thumb_date = get_post_meta($post->ID, 'portfolio_date', true);
							$thumb_client = get_post_meta($post->ID, 'portfolio_client', true);
							$thumb_agency = get_post_meta($post->ID, 'portfolio_agency', true);
							
							$tmpddsize = get_post_meta($post->ID, 'thumbnail_size', true);
							$tmpddlink = get_post_meta($post->ID, 'thumbnail_link', true);
							$tmpddLinkNewWindow = get_post_meta($post->ID, 'thumbnail_link_newwindow', true);
							if($tmpddLinkNewWindow == 1){ $tmpddLinkNewWindow = 'target="_blank"'; }else{ $tmpddLinkNewWindow = ''; }
							$tmpdddisplay = get_post_meta($post->ID, 'thumbnail_meta', true);
							if($tmpdddisplay == 1){ $tmpdddisplay = 'tn-display-meta'; }else{ $tmpdddisplay = ''; }
							$tmpddslides = get_post_meta($post->ID, 'slides', true);
							$tmpddslides = get_the_content();
							
							// Set thumbnail sizes
							// Empty(small); 0(random); 1(large); 1,5(horizontal); 2,4(small); 3(medium); 6(vertical)

							unset($tmpddvertical);
							if($tmpddsize == ''){ $tmpddsize = rand(2,11);
							}else if($tmpddsize == '0'){ $tmpddsize = rand(2,11); 
							}else if($tmpddsize == '1'){ $tmpddsize = 7; 
							}else if($tmpddsize == '2'){ $tmpddsize = 3;
							}else if($tmpddsize == '3'){ $tmpddsize = 6;
							}else if($tmpddsize == '4'){ $tmpddsize = 5;
							}else if($tmpddsize == '5'){ $tmpddsize = 2; 
							}else{ $tmpddsize = 2; }
							if($tmpddsize == 6 or $tmpddsize == 9){ $tmpddvertical = 'vertical-thumbnail'; }

							if(!$tmpddlink){ $i++; }
							$r++;
							
							if(($portfolio_mode == '0') AND ($r <= 5) AND ($is_singular_portfolio || $is_home)){ //Static Homepage portfolio enabled.
								global $element_small;
								unset($element_image);
								if($attachments){
									$element_image = '<img class="project-img" style="z-index: 1;" src="'.$attachments.'" alt="" />';
								}
								if(!$tmpddlink){ $e = $i; }else{ $e = ''; }
								$element_small .= '<div class="element element-stand-alone '.$tmpdddisplay.'">';
								if($tmpddlink){ $element_small .= '<a class="thumbnail-link" href="'.$tmpddlink.'" '.$tmpddLinkNewWindow.'></a>'; }
								$element_small .= '<p class="number" style="z-index:3;">'.$tmpddsize.'</p>
									<div class="thumbnail-meta-data-wrapper">
										<div class="symbol" style="z-index:3;">'.$thumb_title.'</div>
									</div>
									<div class="name" style="z-index:3;">'.strip_tags($thumb_client).'</div>
									<div class="categories" style="z-index:3;">'.$project_categories_names.'</div>
									<p class="id" style="display:none;">'.$e.'</p>
									<div style="background-color:'.$thumbnail_hover_color.'; width: 100%; height: 100%; z-index: 2;" class="thumbnail-hover"></div>
									'.$element_image.'
									<div style="background-color:'.$thumbnail_hover_color.'; width: 100%; height: 100%;z-index:0;"></div>
								</div>';
							}else if(($portfolio_mode == '1' && $is_home) || ($portfolio_mode == '1' && $is_singular_portfolio) || $is_page_template_portfolio){ ?>
								<div class="element <?php echo $project_categories_slugs; ?> <?php echo $project_categories_ids; ?> <?php if(isset($tmpddvertical)){ echo $tmpddvertical; } ?> <?php echo $tmpdddisplay; ?>" data-symbol="Mg" data-category="alkaline-earth">
									<?php if($tmpddlink){ echo '<a class="thumbnail-link" href="'.$tmpddlink.'" '.$tmpddLinkNewWindow.'></a>'; }else{ $thumb_title_temp = '<a class="thumbnail-project-link" href="'.get_permalink().'">'.$thumb_title.'</a>'; } ?>
									<p class="number"><?php echo $tmpddsize; ?></p>
									<div class="thumbnail-meta-data-wrapper">
										<div class="symbol"><?php echo ($thumb_title_temp) ? $thumb_title_temp : $thumb_title; ?></div>
									</div>
									<div class="name"><?php echo strip_tags($thumb_client); ?></div>
									<div class="categories"><?php echo $project_categories_names; ?></div>
									<p class="id" style="display:none;"><?php if(!$tmpddlink){ echo $i; } ?></p>
									<div style="background-color: <?php echo $thumbnail_hover_color ?>; width: 100%; height: 100%;" class="thumbnail-hover"></div>
									<?php if($attachments){ ?>
										<?php $pattern = get_shortcode_regex(); 
											if( preg_match_all( '/'. $pattern .'/s', $attachments, $matches ) && array_key_exists( 2, $matches ) && in_array( 'video', $matches[2] ) ){ ?>
												<?php echo do_shortcode($attachments); ?>
										<?php }else{ ?>
											<img class="project-img" src="<?php echo $attachments; ?>" alt="" />
										<?php } ?>
									<?php } ?>
									<div style="background-color: <?php echo $thumbnail_hover_color ?>; width: 100%; height: 100%; z-index:-2;"></div>
								</div>
							<?php }
							if(!$tmpddlink){
								/* $projectsArray[$i] = array(json_encode($thumb_title), json_encode($thumb_descr), json_encode($thumb_date), json_encode($thumb_client), json_encode($thumb_agency), json_encode($thumb_ourrole), json_encode(do_shortcode($tmpddslides)), json_encode(get_permalink($post->ID)), json_encode($tmpddlink), json_encode($project_categories_ids_array)); */
								global $projectsArray2;
								$projectsArray2[$i] = array($thumb_title, $thumb_descr, $thumb_date, $thumb_client, $thumb_agency, $thumb_ourrole, do_shortcode($tmpddslides), get_permalink($post->ID), $tmpddlink, $project_categories_ids_array);
							} /* Exclude external link thumbnails */
						} //if image exists, project is valid
					}
				}else{
				}
				$wp_query = $temp;  //reset back to original query 
				wp_reset_postdata(); // restore original $post after looping through above posts ?>
			<?php if(($portfolio_mode == '1' && $is_home) || ($portfolio_mode == '1' && $is_singular_portfolio) || $is_page_template_portfolio){ ?>
			</div> <!-- /#container -->
		</section>
	</div>
<?php } ?>
<?php
if($is_home || $is_singular_portfolio){
	if($portfolio_mode == '1'){ }else{
		get_template_part('recent', 'posts');
	}
}
?>

<script type="text/javascript">

jQuery(document).ready(function(){
	if(Modernizr.touch){
		jQuery('.element').each(function(){
			var thumbnail_image = jQuery(this).find('video').attr('poster');
			if(thumbnail_image !== undefined && thumbnail_image != ''){
				jQuery(this).find('.thumbnail-hover').after('<img class="project-img" src="' + thumbnail_image + '" alt="" />');
			}
			jQuery(this).find('video').remove();
		});
	}else{

	}
});


var portfolioArray = [];
var portfolioArrayValid = [];
<?php //echo $portfolioArray; ?>


<?php
/* echo "var projectsArray = [];\n";
if(is_array($projectsArray)){
	foreach($projectsArray as $k => $v){
		echo "projectsArray[".$k."] = [];\n";
		echo "projectsArray[".$k."][0] = ".$v[0].";\n";
		echo "projectsArray[".$k."][1] = ".$v[1].";\n";
		echo "projectsArray[".$k."][2] = ".$v[2].";\n";
		echo "projectsArray[".$k."][3] = ".$v[3].";\n";
		echo "projectsArray[".$k."][4] = ".$v[4].";\n";
		echo "projectsArray[".$k."][5] = ".$v[5].";\n";
		echo "projectsArray[".$k."][6] = ".$v[6].";\n";
		echo "projectsArray[".$k."][7] = ".$v[7].";\n";
		echo "projectsArray[".$k."][8] = ".$v[8].";\n";
		echo "projectsArray[".$k."][9] = ".$v[9].";\n";
	}
} */

if(is_array($projectsArray2)){
	$js_array = json_encode($projectsArray2);
	echo "var projectsArray = ". $js_array . ";\n";
}
?>
portfolioArray = projectsArray;
portfolioArrayValid = projectsArray;

<?php if($demoServer){ ?>
/* Create and randomize an array of projects with slides only */
/* portfolioArrayValid = [];
for(var pai2=0;pai2<portfolioArray.length;pai2++){
	if(portfolioArray[pai2][6]){
		portfolioArrayValid[portfolioArrayValid.length] = portfolioArray[pai2];
	}
}
for(var pai2=0;pai2<portfolioArray.length;pai2++){
	if(portfolioArray[pai2][6]){
		portfolioArrayValid[portfolioArrayValid.length] = portfolioArray[pai2];
	}
} */
<?php } ?>
	var portfolio_closenum = 0;
	var portfolio_closedir = false;
	<?php if(is_home() || is_singular('portfolio')){ ?>
	var homepage_title = '<?php printf(_x('%s - Home', 'Homepage title', 'flowthemes'), get_bloginfo('name')); ?>';
	<?php }else{ ?>
	var homepage_title = jQuery('title').text();
	<?php } ?>
	//var home_url = "<?php //echo home_url(); ?>";
</script>