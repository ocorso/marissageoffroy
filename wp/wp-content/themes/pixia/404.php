<?php get_header(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    <?php pirenko_main_before(); ?>
      <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
      	<div class="colored_bg boxed_shadow">
                <div class="page-header">
                    <h3>
						<header_font><?php echo $pixia_frontend_options['404_title_text']; ?></header_font>
                   	</h3>
                </div>
                <?php 
			$image = $pixia_frontend_options['error404']; 
			if ($image!="")
			{
				$vt_image = vt_resize( '', $image , 700, 0, true );
				?>
				<img src="<?php echo $vt_image['url']; ?>" class="error_image" alt="error 404" />
				<?php
			}
		?>
                <div class="padded_text on_colored">
					
        <p>
			<?php 
				echo $pixia_frontend_options['404_body_text'];
			?>
        </p>
                </div>
            </div>
      	</div><!-- /#main -->
      	<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        	<?php get_sidebar(); ?>
      	</aside><!-- /#sidebar -->
    	<?php pirenko_main_after(); ?>
    </div><!-- /#content -->
<?php get_footer(); ?>