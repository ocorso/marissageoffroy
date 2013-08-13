<?php
/* Template Name: Blog Template */ 
?> 
<?php get_header(); ?>
<div class="blog-template-wrapper">
	<?php /* Page Header */ ?>
	<header class="page-header blog-header">
		<?php if(($page_title = get_post_meta($post->ID, 'flow_post_title', true)) || ($page_title = get_post_meta($post->ID, 'Title', true))){ ?>
			<h1 class="page-title blog-title"><?php echo $page_title; ?></h1>
		<?php } ?>
		<?php if(($page_description = get_post_meta($post->ID, 'flow_post_description', true)) || ($page_description = get_post_meta($post->ID, 'Description', true))){ ?>
			<div class="page-description blog-description"><?php echo $page_description; ?></div>
		<?php } ?>
	</header>
	<?php 
	// Get page layout information
	/* '0' => 'Full Width', '1' => 'Left Sidebar', '2' => 'Right Sidebar', '3' => 'Double Left Sidebar', '4' => 'Double Right Sidebar', '5' => 'Both Sides Sidebars', '6' => Custom boundaries */
	$page_layout = get_post_meta($post->ID, 'page_layout', true);

	// Do we show entry author?
	$blog_author = false;
	$blog_author = get_option('blog_show_author');
	
	// Exclude some categories...
	$category = get_option('blog_exclude_categories');
	if(!is_array($category)){
		$category = array();
	}

	// Enable pagination...
	global $page, $paged;
	if($paged >= 2 || $page >= 2){ // In this template we can do this
		$paged = max($paged, $page);
	}else{
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	}

	// Define posts per page...
	$post_per_page = 6; // -1 shows all posts
	if(get_option('blog_items_per_page') != ''){
		$post_per_page = get_option('blog_items_per_page'); // -1 shows all posts
	}

	// Hide sticky posts...
	$do_not_show_stickies = 1; // 0 to show stickies

	// Other arguments...
	$args = array(
		'category__not_in' => $category,
		'orderby' => 'date',
		'order' => 'DESC',
		'paged' => $paged,
		'posts_per_page' => $post_per_page,
		'ignore_sticky_posts' => $do_not_show_stickies
	);
	$temp = $wp_query; // assign orginal query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()){ ?>
		<div class="blog-container clearfix">
		<?php if($page_layout == 2){ ?>
			<div class="grid_9 right-sidebar-page-content">
		<?php }else if($page_layout == 1){ ?>
			<div class="grid_3 left-sidebar-page-sidebar">
				<div class="sidebar-right-shadow"></div>
				<div class="left-sidebar-container"><?php get_sidebar(); ?></div>
			</div>
			<div class="grid_9 left-sidebar-page-content last">
		<?php }?>
			<?php while($wp_query->have_posts()){ $wp_query->the_post(); ?>
				<?php $post_class = ''; $post_classes = get_post_class(); foreach($post_classes as $class_index => $class_name){ $post_class .= $class_name . ' '; } ?>
				<div class="blog-entry clearfix <?php echo $post_class; ?>">
					<?php if($page_layout == 1 || $page_layout == 2){ ?>
						<div class="blog-entry-thumbnail-full clearfix">
							<?php get_template_part('thumbnail'); ?>
						</div>
					<?php } ?>
					<header class="blog-entry-header">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-entry-title"><?php the_title(); ?></a>
						<?php if($page_layout != 1){ ?>
						<div class="blog-comments-wrapper <?php if(get_comments_number() == '0'){ echo 'blog-comments-wrapper-zero'; } ?>">
							<div class="blog-comments-icon">
								<svg version="1.1" class="blog-comments-icon-shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="24.083px" viewBox="0 0 25 24.083" enable-background="new 0 0 25 24.083" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M8.013,17H4c-2.072,0-3-1.507-3-3V4c0-1.822,1.178-3,3-3h17 c1.767,0,3,1.233,3,3v10c0,1.475-1.122,3-3,3h-8.265l-4.737,4.681L8.013,17z"/></g></svg>
								<?php if(comments_open()){ ?>
									<?php if(get_comments_number() > 999){ $comments_number = __('1k+', 'flowthemes'); }else{ $comments_number = '%'; } ?>
									<div class="blog-comments-value"><?php comments_popup_link('0', '1', $comments_number, '', ''); ?></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						<?php if($blog_author){ ?>
							<div class="blog-entry-author"><?php printf(__('Written by <a href="%1$s" title="Posts by %2$s" rel="author">%2$s</a>', 'flowthemes'), get_author_posts_url(get_the_author_meta('ID')), get_the_author()); ?></div>
						<?php } ?>
						<div class="blog-entry-date"><?php the_time(__('F jS, Y', 'flowthemes')); ?></div>
						<?php /* <div class="blog-entry-date"><?php echo date_i18n(get_option('date_format'), strtotime($wp_query->post->post_date)); ?></div> */ ?>
						<?php if(has_tag()){ ?>
							<div class="blog-entry-tags"><?php the_tags(' ', ' '); ?></div>
						<?php } ?>
					</header>
					<div class="blog-entry-content clearfix">
						<?php if($page_layout != 1 && $page_layout != 2){ ?>
							<?php get_template_part('thumbnail'); ?>
						<?php } ?>
						<?php echo summarise_excerpt(get_the_excerpt(), 55); ?>
					</div>
				</div>
			<?php } ?>
		<?php if($page_layout == 2){ ?>
			</div>
			<div class="grid_3 right-sidebar-page-sidebar last">
				<div class="sidebar-left-shadow"></div>
				<div class="right-sidebar-container"><?php get_sidebar(); ?></div>
			</div>
		<?php }else if($page_layout == 1){ ?>
			</div>
		<?php } ?>
		</div> <!-- /.blog-container -->
		<?php get_template_part('nav'); ?>
	<?php }else{ /* no posts... */ }
	$wp_query = $temp; //reset back to original query ?>
</div> <!-- /.blog-template-wrapper -->
<?php get_footer(); ?>