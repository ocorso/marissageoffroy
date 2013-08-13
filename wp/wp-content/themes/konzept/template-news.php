<?php
/* Template Name: News Template */ 
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
$category = get_option('blog_exclude_categories');
$category = explode(',', $category);
if ($category) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $post_per_page = -1; // -1 shows all posts
  $post_per_page = get_option('blog_items_per_page'); // -1 shows all posts
  $do_not_show_stickies = 1; // 0 to show stickies
  $args=array(
	'post_type' => 'news', 
    'category__not_in' => $category,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
    'posts_per_page' => $post_per_page,
    'caller_get_posts' => $do_not_show_stickies
  );
  $temp = $wp_query;  // assign orginal query to temp variable for later use   
  $wp_query = null;
  $wp_query = new WP_Query($args); 
  if( have_posts() ) : 
	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div class="excerpt excerpt-blog" style="width: 350px; float:left; margin-right: 80px; display: inline-block;">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="news-date"><?php print(date("F d, Y", strtotime($wp_query->post->post_date))); ?></div>
				<h1 class="news-title"><?php the_title(); ?></h1>
				<div class="news-content">
				<?php the_excerpt(); ?>
				</div>	
			</div>	
		</div>

    <?php endwhile; ?>
  <?php else : ?>
		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
		<?php get_search_form(); ?>
	<?php endif; 
	$wp_query = $temp;  //reset back to original query
}  // if ($category)
?>
</div>
</div>
<div class="scrollbar-arrowright" style="display:none;"></div></div>
<div class="moving_gallery" style="position: fixed; top: 1680px; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>