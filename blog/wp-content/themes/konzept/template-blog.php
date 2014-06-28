<?php
/* Template Name: Blog Template */ 
?> 
<?php get_header(); ?>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.header-search').css({ 'display' : 'block' });
	function autoResize(e){
		var ele=e.target;
		//var t=ele.scrollTop;
		//ele.scrollTop=0;
		//if(t>0){                  
		if(e.which && (e.which == 8 || e.which == 46)){
			ele.style.height="60px";
		}
		if(ele.scrollHeight > jQuery(ele).height()){
			ele.style.height=(ele.scrollHeight+64)+"px";
		}
	}
	function checksubmit(e){
		if(e.which == 10 || e.which == 13){
			var tformsub = jQuery(".header-search-form form");
			if(tformsub.length >= 1){
				tformsub.get(0).submit();
				e.preventDefault();
			}
		}
	}

	jQuery('.header-search').click(function(){
		jQuery('.header-search-form').css({ 'display' : 'block' });
		jQuery('.s').focus();
		//var ele=document.getElementsByTagName("textarea");
		//for(i=0;i<ele;i++){
		//	ele[i].addEventListener("keydown",autoResize,false)
		//}
		jQuery('textarea').keyup(autoResize);
		jQuery('textarea').keydown(checksubmit);

	});
	jQuery('.header-search-form').click(function(e){
		var target = e.target;

        while (target.nodeType != 1) target = target.parentNode;
        if(target.tagName != 'TEXTAREA'){
			jQuery('.header-search-form').css({ 'display' : 'none' });
        }

	});

	if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/)){
		//jQuery(".page_description").css({ 'display' : 'none' });
	}
	
	compact_header();
	$(window).resize(function() {
		$(window).unbind('scroll');
		var webmode = jQuery(document).width();
		if(webmode <= 800){
			//restore original header (mobile)
			$('#header').css({'height' : 'auto'});
			$('#logo-text, #logo-image, .logo-image').css({'top' : 0});
			//$('.header-back-to-blog-link').remove();
			$('.header-back-to-top').remove();
			$('#header #main-nav').css({'margin-top' : '40px'});
		}else{
			//restore original header (mobile)
			$('#header').css({'height' : 'auto'});
			$('#logo-text, #logo-image, .logo-image').css({'top' : 0});
			//$('.header-back-to-blog-link').remove();
			$('.header-back-to-top').remove();
			$('#header #main-nav').removeAttr( 'style' );
			compact_header();
		}
	});
	$('.pf_nav a').click(function() {
		compact_header=function(){};
		$(window).unbind('scroll',compact_header_scroll);
		jQuery('.header-search').remove();
	});
});
		var webmode = jQuery(document).width();
		var currentmode = 0;
		function compact_header_scroll() {
			var scrollTop = $(window).scrollTop();
			if(webmode <= 800){ $('#header').css({'height' : 'auto'}); }else{
				if(scrollTop >= 200){
					if(currentmode == 0){
						currentmode = 1;
						$('#header').animate({'height' : '60px'}, 300);
						$('#header, #header .inner').css({'min-height' : '60px'});
						$('#logo-text, #logo-image, .logo-image').animate({'top' : ~jQuery('#header').height()}, 300);
						$('#header #main-nav').animate({'margin-top' : ~jQuery('#header').height()-130}, 300);
						//$('#header .inner').append('<a class="header-back-to-blog-link" href="blog"><div class="header-back-to-blog clearfix"><div class="header-back-to-blog-icon"></div><div class="header-back-to-blog-message"><?php _e('back to blog', 'flowthemes'); ?></div></div></a>');
						$('#header .inner').append('<div class="header-back-to-top clearfix"><div class="header-back-to-top-icon"></div><div class="header-back-to-top-message"><?php _e('back to top', 'flowthemes'); ?></div></div>');
						$('.header-back-to-top').unbind('click');
						$('.header-back-to-top').click(function() {
							$('body,html').animate({scrollTop:0},800);
						});
					}
				}else{
					if(currentmode == 1){
						currentmode = 0;
						$('#header').css({'height' : 'auto'});
						$('#header, #header .inner').css({'min-height' : '170px'}, 300);
						$('#logo-text, #logo-image, .logo-image').animate({'top' : 0}, 300);
						$('#header #main-nav').animate({'margin-top' : 0}, 300);
						//$('.header-back-to-blog-link').remove();
						$('.header-back-to-top').remove();
					}
				}
			}
		}
	function compact_header(){
		//bind scroll again
		var scrollTop = $(window).scrollTop();
		if(webmode <= 800){ $('#header').css({'height' : 'auto'}); }else{
			if(scrollTop >= 200){
				if(currentmode == 0){
					currentmode = 1;
					$('#header').animate({'height' : '60px'}, 300);
					$('#header, #header .inner').css({'min-height' : '60px'});
					$('#logo-text, #logo-image, .logo-image').animate({'top' : ~jQuery('#header').height()}, 300);
					$('#header #main-nav').animate({'margin-top' : ~jQuery('#header').height()-130}, 300);
					$('#header .inner').append('<a class="header-back-to-blog-link" href="blog"><div class="header-back-to-blog clearfix"><div class="header-back-to-blog-icon"></div><div class="header-back-to-blog-message"><?php _e('back to blog', 'flowthemes'); ?></div></div></a>');
					$('#header .inner').append('<div class="header-back-to-top clearfix"><div class="header-back-to-top-icon"></div><div class="header-back-to-top-message"><?php _e('back to top', 'flowthemes'); ?></div></div>');
					$('.header-back-to-top').unbind('click');
					$('.header-back-to-top').click(function() {
						$('body,html').animate({scrollTop:0},800);
					});
				}
			}else{
				if(currentmode == 1){
					currentmode = 0;
					$('#header').css({'height' : 'auto'});
					$('#header, #header .inner').css({'min-height' : '170px'}, 300);
					$('#logo-text, #logo-image, .logo-image').animate({'top' : 0}, 300);
					$('#header #main-nav').animate({'margin-top' : 0}, 300);
					//$('.header-back-to-blog-link').remove();
					$('.header-back-to-top').remove();
				}
			}
		}
		$(window).scroll(compact_header_scroll);
	}
</script>
<div id="content">
	<?php if (get_post_meta($post->ID, 'Title', true)) { ?>
		<h1 style="margin-bottom:25px;" class="page-title"><?php echo get_post_meta($post->ID, 'Title', true); ?></h1>
	<?php } ?>
	<?php if (get_post_meta($post->ID, 'Description', true)) { ?>
		<div style="color: #464646;margin-bottom:0px;font-weight:normal;line-height:27px;" class="page-description"><?php echo get_post_meta($post->ID, 'Description', true); ?></div>
	<?php } ?>
		<div class="extended-blog-container">	
<?php 
$category = get_option('blog_exclude_categories');
$category = explode(',', $category);
if ($category) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $post_per_page = 6; // -1 shows all posts
  $post_per_page = get_option('blog_items_per_page'); // -1 shows all posts
  $do_not_show_stickies = 1; // 0 to show stickies
  $args=array(
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
		<div class="extended-blog-entry clearfix">
			<div class="extended-blog-title"><h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1><div class="extended-blog-comments <?php if(get_comments_number() == '0'){ echo 'extended-blog-comments-zero'; } ?>"><div class="extended-blog-comment-icon">c</div><div class="extended-blog-comments-value"><?php comments_popup_link('0', '1', '%'); ?></div></div><small><?php the_time('F jS, Y'); ?></small><div class="extended-blog-tags"><?php the_tags(' ', ' '); ?></div></div>
			
			<div class="extended-blog-content clearfix">
			<?php if (get_post_meta($post->ID, 'blog-full-image', true)){ ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img class="extended-blog-image" src="<?php echo get_post_meta($post->ID, 'blog-full-image', true); ?>" alt="<?php the_title(); ?>" /></a>
			<?php } ?>
			<?php echo summarise_excerpt(get_the_excerpt(), 55); ?></div>

		</div>
    <?php endwhile; ?>
		</div> <!-- /.extended-blog-container -->
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }else{ ?>
		<div class="navigation">
			<div class="alignright older_entries"><?php next_posts_link('<div class="older_entries_text">'.__('Older Entries ', 'flowthemes').'</div><div class="older_entries_icon">></div>') ?></div>
			<div class="alignleft newer_entries"><?php previous_posts_link('<div class="newer_entries_icon"><</div><div class="newer_entries_text">'.__('Newer Entries', 'flowthemes').'</div>') ?></div>
		</div>
		<?php } ?>
  <?php else : ?>
		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
	<?php endif; 
	$wp_query = $temp; //reset back to original query
}  // if ($category)
?>
</div> <!-- /#content -->
<div class="moving_gallery" style="position: fixed; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>