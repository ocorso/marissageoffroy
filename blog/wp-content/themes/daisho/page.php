<?php get_header(); ?>
<?php /* '0' => 'Full Width', '1' => 'Left Sidebar', '2' => 'Right Sidebar', '3' => 'Double Left Sidebar', '4' => 'Double Right Sidebar', '5' => 'Both Sides Sidebars', '6' => Custom boundaries */ ?>
<?php $page_layout = get_post_meta($post->ID, 'page_layout', true); ?>
<?php if(post_password_required()){ echo '<div class="password-protected-page">'.get_the_password_form().'</div>'; }else{ ?>

	<div class="page-template-wrapper">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()){ the_post(); ?>
				
				<?php /* Page Header */ ?>
				<header class="page-header">
					<?php if(($page_title = get_post_meta($post->ID, 'Title', true)) || ($page_title = get_post_meta($post->ID, 'flow_post_title', true))){ ?>
						<h1 class="page-title"><?php echo $page_title; ?></h1>
					<?php } ?>
					<?php if(($page_description = get_post_meta($post->ID, 'Description', true)) || ($page_description = get_post_meta($post->ID, 'flow_post_description', true))){ ?>
						<div class="page-description"><?php echo $page_description; ?></div>
					<?php } ?>
				</header>
				
				<?php /* Page Content */ ?>
				<?php if(($page_layout == 0) or ($page_layout == '')){ ?>
					<div class="page-template-content page-content full-width-page full-width-page-content clearfix container_12"><?php the_content(); ?></div>
				<?php } ?>
				<?php if($page_layout == 2){ ?>
				<div class="page-content right-sidebar-page clearfix container_12">
					<div class="grid_9 right-sidebar-page-content page-template-content">
						<?php the_content(); ?>
					</div>
					<div class="grid_3 right-sidebar-page-sidebar last">
						<div class="sidebar-left-shadow"></div>
						<div class="right-sidebar-container"><?php get_sidebar(); ?></div>
					</div>
				</div>
				<?php } ?>
				<?php if($page_layout == 1){ ?>
				<div class="page-content left-sidebar-page clearfix container_12">
					<div class="grid_3 left-sidebar-page-sidebar">
						<div class="sidebar-right-shadow"></div>
						<div class="left-sidebar-container"><?php get_sidebar(); ?></div>
					</div>
					<div class="grid_9 left-sidebar-page-content page-template-content last">
						<?php the_content(); ?>
					</div>
				</div>
				<?php } ?>
				<?php if($page_layout == 6){ ?>
					<div class="page-template-content">
						<?php the_content(); ?>
					</div>
				<?php } ?>
			<?php } ?>	
			<div id="posts_navigation">
				<?php posts_nav_link(' ', __('Previous page', 'flowthemes'), __('Next page', 'flowthemes')); ?>
			</div>
			
			<div class="blog-container">
				<div id="comments-template" class="clearfix">
					<?php comments_template(); ?>
				</div>
			</div>
			
		<?php }else{
			/* No post */
		} ?>
	</div>

<?php } /* Password Protected Page if() */ ?>
<?php get_footer(); ?>