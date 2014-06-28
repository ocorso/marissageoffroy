	<?php get_header(); ?>
	<div class="page-header">
		<h3><?php _e($queed_frontend_options['submit_search_res_title'], 'queed'); ?></h3><br /><h1><?php echo get_search_query(); ?></h1>
	</div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php queed_main_before(); ?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
			<?php if (!have_posts()) { ?>
            <p class="rounded_box warning_box">
				<a class="close_box">&times;</a>
				<?php _e('Sorry, no results were found.', 'queed'); ?>
			</p>
          	<?php //get_search_form(); ?>
        	<?php } ?>
        	<?php 
			 	$post_counter = 0;
			 	while (have_posts()) : the_post(); 
				$post_counter++;
				?>
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              		<header>
                		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                		<?php //roots_entry_meta(); ?>
              		</header>
              		<div class="entry-content">
                		<?php if (is_archive() || is_search()) { ?>
                  		<?php the_excerpt_dynamic(270);if (is_big_excerpt(270))
						{
							?>
                                                   
                                                        <div class="theme_button">
                                                            <a href="<?php the_permalink() ?>">Read more&nbsp;&nbsp;&nbsp;&rarr;</a>
                                                        </div>
                                                    
                                                    <?php
												} ?>
                		<?php } else { ?>
                  		<?php the_content(); ?>
                		<?php } ?>
              		</div>
              		<footer>
                		<?php $tags = get_the_tags(); if ($tags) { ?><p><?php //the_tags(); ?></p><?php } ?>
              		</footer>
            	</article>
                <?php 
					if (1)
					{
						?>
                		<div class="dotted_line" style="margin-top:-18px"></div>
                		<div class="dotted_line"></div>
                		<div class="dotted_line" style="margin-bottom:38px"></div>
                        <?php 
					}
				?>
        	<?php endwhile; /* End loop */ ?>
      </div><!-- /#main -->
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
    </div><!-- /#content -->
	<?php get_footer(); ?>