	<?php 
		get_header(); 
		$hide_ttl="no";
		$data = get_post_meta( $post->ID, '_custom_meta_reg-page_template', true );
		if (!empty($data))
		{
			if (isset($data['pixia_show_title']) && $data['pixia_show_title']=="yes")
			{
				$hide_ttl="yes";
			}
		}
	?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    	<?php pirenko_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
        	<div class="colored_bg boxed_shadow">
            	<?php 
					if ($hide_ttl=="no")
					{
						?>
						<div class="page-header">
							<h3>
								<header_font><?php the_title(); ?></header_font>
							</h3>
						</div>
						<?php
					}
					else
					{
						?>
						<div style="height:20px"></div>
						<?php
					}
				?>
                <div class="padded_text on_colored">
					<?php /* Start loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>
                          <?php the_content(); ?>
                          <div class="clearfix"></div>
                    <?php endwhile; /* End loop */ ?>
                </div>
            </div>
      	</div><!-- /#main -->
    	<?php pirenko_main_after(); ?>
    </div><!-- /#content -->
	<?php get_footer(); ?>