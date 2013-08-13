<?php get_header(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    	<?php pirenko_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
        	<div class="colored_bg boxed_shadow">
                <div class="page-header">
                    <h3>
                        <header_font><?php _e($pixia_frontend_options['submit_search_res_title'], 'queed'); echo ": ".get_search_query(); ?></header_font>
                    </h3>
                </div>
            </div>
			<?php if (!have_posts()) { ?>
            	<div class="padded_text on_colored colored_bg boxed_shadow search_rs" style="padding-bottom:20px !important;">
					<?php _e('Sorry, no results were found.', 'queed'); ?>
				</div>
          	<?php //get_search_form(); ?>
        	<?php }
			else
			{
			 	$post_counter = 0;
			 	while (have_posts()) : the_post(); 
					$post_counter++;
					?>
					<div class="padded_text on_colored colored_bg boxed_shadow search_rs">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<div class="search_rs_ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php //roots_entry_meta(); ?>
						</header>
						<div class="entry-content">
							<?php 
								if (is_archive() || is_search()) 
								{
									the_excerpt_dynamic(270);
									if (is_big_excerpt(270))
									{
										?>
										<div class="theme_button">
											<a href="<?php the_permalink() ?>">Read more&nbsp;&nbsp;&nbsp;&rarr;</a>
										</div>
										<?php
									}
								} 
								else 
								{
									the_content();
								} 
							?>
						</div>
					</article>
					</div>
        		<?php endwhile; /* End loop */ 
			}	
			?>
      </div><!-- /#main -->
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
    </div><!-- /#content -->
	<?php get_footer(); ?>