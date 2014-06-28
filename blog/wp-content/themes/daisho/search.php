<?php get_header(); ?>
<div class="search-template-wrapper">

	<?php /* Page Header */ ?>
	<header class="page-header blog-header">
		<h1 class="page-title blog-title"><?php echo get_search_query(); ?></h1>
	</header>
	
	<div class="blog-container">	
		<?php
		// Do we show entry author?
		$blog_author = false;
		$blog_author = get_option('blog_show_author');
	
		if(have_posts()){
			while(have_posts()){ the_post(); ?>  
			<div class="blog-entry clearfix <?php echo $post_class; ?>">
				<header class="blog-entry-header">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog-entry-title"><?php the_title(); ?></a>
					<?php if($page_layout != 2){ ?>
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
					<?php get_template_part('thumbnail'); ?>
					<?php echo summarise_excerpt(get_the_excerpt(), 55); ?>
				</div>
			</div>
		<?php } ?>
		</div> <!-- /.blog-container -->
		<?php get_template_part('nav'); ?>
	<?php }else{ ?>
		<p><?php _e('Nothing Found.', 'flowthemes'); ?></p>
	<?php } ?>
	</div> <!-- /.extended-blog-container -->
</div> <!-- /#content -->
<?php get_footer(); ?>