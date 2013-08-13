<?php
/*
Template Name: Portfolio
*/

/**
 *
 * Aleph - Premium Theme for WordPress
 *
 * Template used to display a portfolio
 * /template-portfolio.php
 * Version of this file : 1.7
 *
 */
?>

<?php get_header(); ?>

			<div id="content" class="clearfix container-fluid template-portfolio<?php $level=get_post_meta($post->ID,'level','true'); if(!isset($level) || $level=="") { $level="none"; } if($level!="top") { echo "under-level"; } ?>" data-level="<?php echo $level; ?><?php if($level=='sub') { echo '_page';} ?>" data-type="post">
				<?php
					// Custom background
					custom_bg($post->ID);

					// Additional links
					var_nav($post->ID,$level,'page');

					$masonry = get_post_meta($post->ID,'portfolio_style',true) != '' ? get_post_meta($post->ID,'portfolio_style',true) : "fitrows";

				?>

				<div class="row-fluid clearfix">

					<div id="main" class="span12 clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<section class="post_content clearfix" itemprop="articleBody">

								<?php

									$temp = $wp_query;
									$wp_query= null;
									$wp_query = new WP_Query();

									if(get_post_meta($post->ID,'portfolio_tax_specific',true)!="on") {
										$args = array(
												'post_type'=>array('portfolio'),
									 			'posts_per_page'=>'-1',
									 			'nopaging'=>'true',
									 			'orderby'=>'menu_order',
									 			'order'=>'ASC',
									 			'ignore_sticky_posts' => 1,
									 			);
									} else {
										$args = array(
												'post_type'=>array('portfolio'),
									 			'posts_per_page'=>'-1',
									 			'nopaging'=>'true',
									 			'orderby'=>'menu_order',
									 			'order'=>'ASC',
									 			'ignore_sticky_posts' => 1,
									 			'tax_query' => array(
									 				array(
														'taxonomy' => 'field',
														'field' => 'id',
														'terms' => get_post_meta($post->ID,'portfolio_tax',true)
									 				)
									 			)
										);
									}
									$wp_query->query($args);

								?>
								<?php
									if(get_post_meta($post->ID,'portfolio_filter',true)=="on" && get_post_meta($post->ID,'portfolio_tax_specific',true)!="on") {
								?>
									<div class="filter-container clearfix">
										<div class="container-fluid group clearfix">
											<div class="row-fluid clearfix" id="portfolio-filter">
												<ul class="span12 clearfix hidden-tablet" id="filter">
													<li><span>Filter</span></li>
													<li class="all"><a href="#" class="active" data-filter="*">All</a></li>
														<?php
														$categories= get_categories('orderby=slug&taxonomy=field&title_li=');
														foreach ($categories as $category){
													?>
														<li class="cat-item <?php echo strtolower($category->slug);?>"><a href="#" title="All posts under <?php echo $category->name;?>" data-filter=".<?php echo strtolower($category->slug);?>"><?php echo $category->name;?></a></li>
													<?php
														}
													?>
												</ul>

												<div class="clearfix hidden-desktop">
													<ul id="portfolio_fields" class="nav nav-pills custom-dropdown portfolio-filter" name="portfolio_fields">
														<li class="all"><a href="#" title="View all projects" class="ttip portfolio-reset active" data-filter="*"><em class="icon-refresh icon-white"></em></a></li>
														<li class="dropdown clearfix" id="menu2">
															<a class="dropdown-toggle" data-toggle="dropdown" href="#menu2">
																<?php _e("Fields", "alephtheme"); ?>
																<em class="icon-chevron-down icon-white pull-right"></em>
															</a>
															<ul class="dropdown-menu">
																<?php
																	$categories= get_categories('orderby=slug&taxonomy=field&title_li=');
																	foreach ($categories as $category){
																?>
																	<li class="cat-item <?php echo strtolower($category->slug);?>"><a href="#" title="All posts under <?php echo $category->name;?>" data-filter=".<?php echo strtolower($category->slug);?>"><?php echo $category->name;?> <span class="count"><?php echo $category->count; ?></span></a></li>
																<?php
																	}
																?>
															</ul><!-- end .dropdown-menu -->
														</li><!-- end #menu1 -->
													</ul><!-- end #portfolio_fields -->
												</div><!-- end .clearfix -->


											</div>
										</div>
									</div>
								<?php
									}
								?>
								<div id="loading"><div class="preloader"></div></div>
								<div id="portfolio-grid" class="portfolio-<?php echo $masonry; ?>">
									<?php
										$i=0;

										while ($wp_query->have_posts()) : $wp_query->the_post();


											$portfolio_cats = get_the_terms( get_the_ID(), 'field' );
									?>
											<div class="portfolio-<?php echo $masonry; ?>-item <?php if($portfolio_cats != '') {foreach ($portfolio_cats as $taxonomy) { echo $taxonomy->slug .' '; } } ?>" id="post-<?php echo get_the_ID(); ?>">
												<?php
													$external_link = get_post_meta($post->ID,'project_external_link',true);
													$link = ($external_link!="" ? $external_link : get_permalink($post->ID));
													$target = ($external_link!="" ? "_blank" : "");
												?>
												<a class="entry-item" href="<?php echo $link; ?>" target="<?php echo $target; ?>" title="<?php the_title(); ?>">
													<?php
														$thumb = featured_image_link_portf($post->ID);
														$thumb_prop = featured_image_link_portf_prop($post->ID);
													?>
													<?php if($masonry!="masonry") { ?>
														<img src="<?php echo $thumb; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="400" height="225" />
													<?php } else { ?>
														<img src="<?php echo $thumb_prop; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="400" />
													<?php } ?>
													<div class="overlay">
														<h3><?php echo get_the_title(); ?></h2>
														<div class="portfolio-cats">
														<?php
															$project_cats = array_values(get_the_terms($post->ID, 'field'));
															for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
															    echo $project_cats[$cat_count]->name;
															    if ($cat_count<count($project_cats)-1){
															        echo ', ';
															    }
															}
														?>
														</div>
													</div>
												</a>
											</div>
									<?php
										$i++;
										endwhile;
									?>
								</div><!-- end .container-fluid -->

								<?php
									$wp_query = null; $wp_query = $temp;
								?>

							</section> <!-- end section -->

						</article> <!-- end article -->

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found">
							    <header>
							    	<h1><?php _e("Not Found", "alephtheme"); ?></h1>
							    </header>
							    <section class="post_content">
							    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "alephtheme"); ?></p>
							    </section>
							    <footer>
							    </footer>
							</article><!-- end #post-not-found -->

						<?php endif; ?>

					</div> <!-- end #main -->

    			</div><!-- end .row-fluid -->

			</div> <!-- end #content -->

<?php get_footer(); ?>