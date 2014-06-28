			<div class="content portfolio" id="portfolio-cat-11">

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post                                                  // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="post_area">
                    <div id="post_wrapper">
						<?php
                            $posts_per_row = 4;
                            $post_counter = 0;
                            echo '<div class="row">';
                        ?>
                        <?php if (  $wp_query->have_posts()) : while (have_posts()) : the_post();  ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Entry                                                 // -->
<!-- /////////////////////////////////////////////////////////////////////// -->

                        <div class="entry"  id="post-<?php the_ID();?>">
                            <?php main_portfolio_image($post->ID, 220, 320); ?>
                            <?php get_portfolio_title(); ?>
                            <?php get_post_content(); ?>
                        </div><!-- END div.entry -->
						<?php
                            $post_counter++;
                        if($post_counter % $posts_per_row == 0  ) echo '<div class="clear"></div></div><div class="row">';                     
                        ?>
						<?php endwhile; endif; ?>
                        <?php echo '<div class="clear"></div></div>'; ?>
						<?php fPagination::Render(); ?>
                    </div><!-- END div#post_wrapper -->

				</div><!-- END div#post_area -->
                <div class="clear"></div>
			</div><!-- END div#content -->