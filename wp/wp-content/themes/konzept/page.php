<?php get_header(); ?>
<style type="text/css">
	body { opacity: 0; }
</style>
<div id="content" style="opacity:0;">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php if (get_post_meta($post->ID, 'Title', true)) { ?>
			<h1 class="page-title"><?php echo get_post_meta($post->ID, 'Title', true); ?></h1>
		<?php } ?>
		<?php if (get_post_meta($post->ID, 'Description', true)) { ?>
			<div class="page-description"><?php echo get_post_meta($post->ID, 'Description', true); ?></div>
		<?php } ?>
		<div class="page-content"><?php the_content(); ?></div>
	<?php endwhile ?>	
		<div id="posts_navigation">
			<?php posts_nav_link(' ', 'Previous page', 'Next page'); ?>
		</div>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>	
	<?php endif; ?>
</div>
<div class="moving_gallery" style="position: fixed; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>