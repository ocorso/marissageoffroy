<?php get_header(); ?>
<div class="single-template-wrapper">
	<?php /* Page Header */ ?>
	<header class="single-header">
		<?php if(($page_title = get_post_meta($post->ID, 'Title', true)) || ($page_title = get_the_title())){ ?>
			<h1 class="page-title" style="padding-bottom: 30px; padding-top: 0; border-bottom: 0 none; word-wrap: break-word; border-bottom: 3px solid #d9dcdd;"><?php echo $page_title; ?></h1>
		<?php } ?>
		<?php if($page_description = get_post_meta($post->ID, 'Description', true)){ ?>
			<div class="page-description" style="padding-bottom: 20px; margin: 0 auto 0 auto; padding-top: 15px;"><?php echo $page_description; ?></div>
		<?php } ?>
		
		<div class="single-meta clearfix">
			<div class="blog-comments-wrapper <?php if(get_comments_number() == '0'){ echo 'blog-comments-wrapper-zero'; } ?>">
				<div class="blog-comments-icon">
					<svg version="1.1" class="blog-comments-icon-shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="24.083px" viewBox="0 0 25 24.083" enable-background="new 0 0 25 24.083" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M8.013,17H4c-2.072,0-3-1.507-3-3V4c0-1.822,1.178-3,3-3h17 c1.767,0,3,1.233,3,3v10c0,1.475-1.122,3-3,3h-8.265l-4.737,4.681L8.013,17z"/></g></svg>
					<?php if(comments_open()){ ?>
						<?php if(get_comments_number() > 999){ $comments_number = __('1k+', 'flowthemes'); }else{ $comments_number = '%'; } ?>
						<div class="blog-comments-value"><?php comments_popup_link('0', '1', $comments_number, '', ''); ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="single-date grid_6"><?php the_time(__('F jS, Y', 'flowthemes')); ?></div>
			<?php if(has_tag()){ ?>
				<div class="single-tags"><?php the_tags(' ', ' '); ?></div>
			<?php } ?>
		</div>
	</header>
	
	<?php if(have_posts()){
		/* '0' => 'Full Width', '1' => 'Left Sidebar', '2' => 'Right Sidebar', '3' => 'Double Left Sidebar', '4' => 'Double Right Sidebar', '5' => 'Both Sides Sidebars', '6' => Custom boundaries */
		$post_layout = get_post_meta($post->ID, 'flow_post_layout', true);
		while(have_posts()){ the_post(); ?>
		
		<?php if($post_layout == 2){ ?>
			<div class="page-content right-sidebar-page clearfix container_12">
				<div class="grid_9 right-sidebar-page-content right-sidebar-post-content">
					<?php the_content(); ?>
				</div>
				<div class="grid_3 right-sidebar-page-sidebar last">
					<div class="sidebar-left-shadow"></div>
					<div class="right-sidebar-container"><?php get_sidebar(); ?></div>
				</div>
			</div>
		<?php }else if($post_layout == 1){ ?>
			<div class="page-content left-sidebar-page clearfix container_12">
				<div class="grid_3 left-sidebar-page-sidebar">
					<div class="sidebar-right-shadow"></div>
					<div class="left-sidebar-container"><?php get_sidebar(); ?></div>
				</div>
				<div class="grid_9 left-sidebar-page-content left-sidebar-post-content last">
					<?php the_content(); ?>
				</div>
			</div>
		<?php }else{ ?>
			<div class="single-container">
				<?php the_content(); ?>
			</div>
		<?php } ?>
		
	<?php } ?>
	
	<div class="single-container-comments">
		<div id="comments-template" class="clearfix">
			<?php comments_template(); ?>
		</div>
	</div> <!-- /.blog-container -->
	<?php get_template_part('recent', 'posts'); ?>
	<?php get_template_part('nav'); ?>
	<?php }else{
		// No post...
	} ?>
</div> <!-- /.single-template-wrapper -->
<?php get_footer(); ?>