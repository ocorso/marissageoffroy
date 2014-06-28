<?php get_header(); ?>
	<div class="page-header">
		<h1><?php echo $queed_frontend_options['404_title_text']; ?></h1>
	</div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php queed_main_before(); ?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      	<?php 
			$image = $queed_frontend_options['error404']; 
			if ($image!="")
			{
				$vt_image = vt_resize( '', $image , 700, 0, true );
				?>
				<img src="<?php echo $vt_image['url']; ?>" class="error_image" alt="error 404" />
				<?php
			}
		?>
        <p>
			<?php 
				echo $queed_frontend_options['404_body_text'];
			?>
        </p>
      	</div><!-- /#main -->
      	<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        	<?php get_sidebar(); ?>
      	</aside><!-- /#sidebar -->
    	<?php queed_main_after(); ?>
    </div><!-- /#content -->
<?php get_footer(); ?>