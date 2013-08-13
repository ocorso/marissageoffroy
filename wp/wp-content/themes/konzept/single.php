<?php get_header(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.header-search').css({ 'display' : 'block' });
	function autoResize(e){
		var ele=e.target;                          //get the text field
		//var t=ele.scrollTop;                       //use scroll top to determine if space is enough
		//ele.scrollTop=0;
		//if(t>0){                  
		if(e.which && (e.which == 8 || e.which == 46)){
			ele.style.height="60px";
		}
		 //If it needs more space...
		if(ele.scrollHeight > jQuery(ele).height()){
			ele.style.height=(ele.scrollHeight+64)+"px";  //Then add space for it!
			//ele.style.height=(ele.offsetHeight+2*(t))+"px";  //Then add space for it!
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

	compact_header();
	$(window).resize(function() {
		$(window).unbind('scroll');
		var webmode = jQuery(document).width();
		if(webmode <= 800){
			//restore original header (mobile)
			$('#header').css({'height' : 'auto'});
			$('#logo-text, #logo-image, .logo-image').css({'top' : 0});
			$('.header-back-to-blog-link').remove();
			$('.header-back-to-top').remove();
			$('#header #main-nav').css({'margin-top' : '40px'});
		}else{
			//restore original header (mobile)
			$('#header').css({'height' : 'auto'});
			$('#logo-text, #logo-image, .logo-image').css({'top' : 0});
			$('.header-back-to-blog-link').remove();
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
						$('.header-back-to-blog-link').remove();
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
					$('.header-back-to-blog-link').remove();
					$('.header-back-to-top').remove();
				}
			}
		}
		$(window).scroll(compact_header_scroll);
	}
</script>
<div id="content">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="extended-blog-single-title clearfix">
			<h1><?php if (get_post_meta($post->ID, 'Title', true)) { echo get_post_meta($post->ID, 'Title', true); }else{ the_title(); } ?></h1>
			<?php if(has_tag()){ echo '<div class="extended-blog-meta clearfix">'; } ?><small <?php if(has_tag()){ echo 'class="small-has-tag"'; } ?>>
				<div class="extended-blog-comments <?php if(get_comments_number() == '0'){ echo 'extended-blog-comments-zero'; } ?>">
					<div class="extended-blog-comment-icon">c</div>
					<div class="extended-blog-comments-value"><?php comments_popup_link('0', '1', '%'); ?></div>
				</div>
				<?php the_time('F jS, Y'); ?>
			</small>
			<?php if(has_tag()){ echo '</div>'; } ?>
			<?php if(has_tag()){ ?><div class="extended-blog-single-tags"><?php the_tags(' ', ' '); ?></div><?php } ?>
		</div>
	<div class="extended-blog-single-container">
		<?php if (get_post_meta($post->ID, 'blog-full-image', true) and false){ ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo get_post_meta($post->ID, 'blog-full-image', true); ?>" alt="<?php the_title(); ?>" style="display: block;" />
			</a>
		<?php } ?>
		<?php the_content(); ?>
	</div>
	<div class="extended-blog-container">
		<?php endwhile; ?>
		<div id="comments-template" class="clearfix">
			<?php comments_template(); ?>
		</div>		
	<?php $blog_related_posts = get_option('blog_related_posts'); // 0 = display, 1 = not display
		if($blog_related_posts == 0){ ?>
		<div class="related-posts clearfix">
			<?php wp_reset_query();
			query_posts('posts_per_page=4');
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="related-posts-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><small><?php the_time('F jS, Y'); ?></small></div>
			<?php endwhile; else: _e("No posts found.", 'flowthemes'); endif; wp_reset_query(); ?>
		</div>
	<?php } ?>			
	</div> <!-- /.extended-blog-container -->
	<div class="navigation">
		<div class="alignright older_entries"><?php next_post_link('<div class="older_entries_text">%link </div><div class="older_entries_icon">></div>','Next') ?></div>
		<div class="alignleft newer_entries"><?php previous_post_link('<div class="newer_entries_icon"><</div><div class="newer_entries_text"> %link</div>','Previous') ?></div>
	</div>
	<?php else: ?>
		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
	<?php endif; ?>
</div> <!-- /#content -->
<div class="moving_gallery" style="position: fixed; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>