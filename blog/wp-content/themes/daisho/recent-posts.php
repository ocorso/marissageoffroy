<?php
if(is_home() || is_singular('portfolio')){
	// Recent Projects
	global $element_small;
	$portfolio_recent = get_option('portfolio_recent'); // 0 = display, 1 = not display
	if($portfolio_recent == '1'){ }else{
		$portfolio_page = get_option('flow_portfolio_page');
		$portfolio_page_link = get_permalink($portfolio_page); ?>
		<div class="recent-heading-container clearfix">
			<div class="recent-heading">
				<h2><?php _e('Recent Projects', 'flowthemes'); ?></h2>
				<span class="spacer"></span>
				<a href="<?php echo $portfolio_page_link; ?>"><?php _e('View Portfolio', 'flowthemes'); ?></a>
			</div>
			<div id="content-small" style="margin-top: 15px;" class="clearfix">
				<?php echo $element_small; ?>
			</div>
		</div>
<?php
	}
	
	// Recent Blog Posts
	$blog_recent = get_option('blog_recent', 0); // 0 = display, 1 = not display
	if($blog_recent == '1'){ }else{

		$blog_page = get_option('flow_blog_page');
		$blog_page_link = get_permalink($blog_page);
		
		$category = get_option('blog_exclude_categories');
		if(!is_array($category)){
			$category = array();
		}
		
		$post_per_page = 4;
		$do_not_show_stickies = 1; // 0 to show stickies
		$args = array(
			'category__not_in' => $category,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => array('post'),
			'posts_per_page' => $post_per_page,
			'ignore_sticky_posts' => $do_not_show_stickies
		);
		$recent_posts_query = new WP_Query($args); 
		if($recent_posts_query->have_posts()){ ?>
			<div class="clearfix recent-blog-container">
				<div class="recent-heading">
					<h2><?php _e('New Blog Posts', 'flowthemes'); ?></h2>
					<span class="spacer"></span>
					<a href="<?php echo $blog_page_link; ?>"><?php _e('View Blog', 'flowthemes'); ?></a>
				</div>
				<div style="margin-top: 15px; background-color:#eeeeee;" class="clearfix">
					<div class="related-posts related-posts-home clearfix" style="border: none; max-width: 1120px; width: 100%; margin: 0 auto;">
					<?php while ($recent_posts_query->have_posts()){
							$recent_posts_query->the_post(); ?>
							<div class="related-posts-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								<small><?php the_time(__('F jS, Y', 'flowthemes')); ?></small>
							</div>
					<?php }
			echo '</div></div></div>';
		}
		wp_reset_postdata();
	}
}else{ ?>
	<div class="clearfix recent-posts-single-container">
		<?php
		$blog_related_posts = get_option('blog_related_posts', 0); // 0 = display, 1 = not display
		if($blog_related_posts == 0){
			$category = get_option('blog_exclude_categories');
			if(!is_array($category)){
				$category = array();
			}
			$post_per_page = 4;
			$do_not_show_stickies = 1; // 0 to show stickies
			$args = array(
				'category__not_in' => $category,
				'orderby' => 'date',
				'order' => 'DESC',
				'post__not_in' => array(get_the_ID()), // excludes this post
				'post_type' => array('post'),
				'posts_per_page' => $post_per_page,
				'ignore_sticky_posts' => $do_not_show_stickies
			);
			$other_posts_query = new WP_Query($args); 
			if($other_posts_query->have_posts()){
				echo '<div class="related-posts related-posts-home clearfix">';
				while ($other_posts_query->have_posts()){
					$other_posts_query->the_post();
			?>
					<div class="related-posts-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<small><?php the_time(__('F jS, Y', 'flowthemes')); ?></small>
					</div>
			<?php 
				}
				echo '</div>';
			}else{
			}
			wp_reset_postdata(); // restore original $post after looping through above posts
		}
		?>
	</div>
<?php } ?>