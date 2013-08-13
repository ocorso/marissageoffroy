<?php
/* Template Name: Content Slider Page Template */ 
?> 
<?php get_header(); ?>
<?php if(post_password_required()){ echo '<div class="password-protected-page">'.get_the_password_form().'</div>'; }else{ ?>
<div class="page-template-wrapper">
	<header class="page-header">
		<div class="page-title">
		<?php if(($page_title = get_post_meta($post->ID, 'flow_post_title', true)) || ($page_title = get_post_meta($post->ID, 'Title', true))){ ?>
			<?php echo $page_title; ?>
		<?php }else{ ?>
			<?php the_title(); ?>
		<?php } ?>
		</div>
		<?php if(($page_description = get_post_meta($post->ID, 'flow_post_description', true)) || ($page_description = get_post_meta($post->ID, 'Description', true))){ ?>
			<div class="page-description"><?php echo $page_description; ?></div>
		<?php } ?>
	</header>
	<?php if($ipad){ ?>
	<style type="text/css">
	.scrollbar-arrowright { width: 60px; margin-right: 30px; }
	</style>
	<?php } //ipad ?>
	<div class="news-container-outer">
		<div class="news-container">
			<?php if( have_posts() ) : 
				while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>
		</div>
	</div> <!-- /.news-container-outer -->
	<div class="scrollbar-arrowleft scrollbar-arrowleft-inactive" style="display:none;"></div>
	<div class="scrollbar-arrowright" style="display:none;"></div>
</div> <!-- /#content -->
<?php } ?>
<?php get_footer(); ?>