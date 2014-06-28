<?php
/* Template Name: Content Slider Page Template */ 
?> 
<?php get_header(); ?>
<style type="text/css">
	body { opacity: 0; }
</style>
<div id="content" style="opacity:0;">
	<div class="page-title"><?php if (get_post_meta($post->ID, 'Title', true)) { ?><?php echo get_post_meta($post->ID, 'Title', true); ?><?php }else{ ?><?php the_title(); ?><?php } ?></div><div class="page_arrow_left">&lt;.</div><div class="page_arrow_right">&gt;.</div><div style="clear:both;"></div>
	<!-- <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div> -->
<div class="scrollbar-arrowleft scrollbar-arrowleft-inactive" style="display:none;"></div>
<div class="news-container-outer">
		<div class="news-container">
<?php 

  if( have_posts() ) : 
	while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

    <?php endwhile; ?>
  <?php else : ?>
		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
		<?php get_search_form(); ?>
	<?php endif; 


?>
</div>
</div>
<div class="scrollbar-arrowright" style="display:none;"></div></div>
<div class="moving_gallery" style="position: fixed; top: 1680px; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>