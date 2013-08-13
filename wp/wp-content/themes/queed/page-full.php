<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
<div class="page-header">
	<h1><?php the_title(); ?></h1>
</div>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php queed_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?>" role="main">
        	<?php while (have_posts()) : the_post(); ?>
              	<?php the_content(); ?>
        	<?php endwhile; /* End loop */ ?>
      	</div><!-- /#main -->
    <?php queed_main_after(); ?>
</div><!-- /#content -->
<?php get_footer(); ?>