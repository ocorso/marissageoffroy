<?php 
/* Template Name: Coming Soon Template (Dribbble) */ 
?> 
<?php get_header(); ?>
<script type="text/javascript">
var myScroll;

function loaded() {
	myScroll = new iScroll('wrapper', {
		snap: 'li',
		momentum: false,
		hScrollbar: false,
		vScrollbar: false,
		hScroll: true,
		vScroll: false,
	 });
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>
<style type="text/css">
	body { opacity: 0; }
	#wrapper-container { width:100%; max-width:1200px; min-height: 330px; margin: 0 auto; overflow:hidden; }
	#wrapper { width:50%; width: 710px; max-width:800px; min-height: 330px; margin: 0 0 0 auto; overflow:visible!important; }
	#scroller { min-height:330px; float:left; padding: 0 0 0 0; }
	#scroller ul { list-style:none; display:block; float:left; width:9000px; }
	#scroller li { float:left; width:400px; text-align:center; margin: 0 50px 0 0; }
	.pageWrapper { margin-top: 0; }
</style>
<div id="content" style="opacity:0;">
	<?php if (get_post_meta($post->ID, 'Title', true)) { ?>
		<h1 class="page-title"><?php echo get_post_meta($post->ID, 'Title', true); ?></h1>
	<?php } ?>

<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){ ?>
	<div id="wrapper-container">
		<div id="wrapper">
			<div id="scroller">
				<ul id="thelist">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar() ) : ?>
				<?php endif; ?>
			<?php endwhile; endif; ?>
				</ul>
			</div>
		</div>
	</div>
<?php }else{ ?>

<div class="pageWrapper">
	<div class="demo">
		<div class="wrapper">
			<div id="coverflow">	
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar() ) : ?>
				<?php endif; ?>
			<?php endwhile; ?>
			</div>
		</div>
		<div id="imageCaption">
		Sample Text
		</div>
		<div id="slider"></div>
	</div>
	<div class="demo-description">
	</div>
	<div class="listholder">
		<div id="scroll-pane">
			<ul id="sortable"> 
			</ul>
		</div>
	</div>
</div> <!-- /.pageWrapper -->

<div class="pageWrapper-mobile">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar() ) : ?>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div> <!-- /.pageWrapper-mobile -->

	<?php else: ?>
		<h2 class="center"><?php _e('Not Found', 'flowthemes'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'flowthemes'); ?></p>
	<?php endif; ?>
    
<?php } ?>
</div>
	<div class="moving_gallery" style="position: fixed; top: 1680px; z-index: 2433245;"><?php include('template-portoflio.php'); ?></div>
<?php get_footer(); ?>