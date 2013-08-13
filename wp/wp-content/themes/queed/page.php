	<?php get_header(); ?>
	<div class="page-header">
		<h1><?php the_title(); ?></h1>
	</div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php queed_main_before(); ?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
      
        <?php /* Start loop */ ?>
			<?php while (have_posts()) : the_post(); ?>
                  <?php the_content(); ?>
                  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
            <?php endwhile; /* End loop */ ?>
      </div><!-- /#main -->
    <?php queed_main_after(); ?>
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
    </div><!-- /#content -->
<?php get_footer(); ?>