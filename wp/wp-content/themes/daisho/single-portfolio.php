<?php if(true){ ?>
<?php get_template_part('index'); ?>
<?php //get_template_part('template', 'portoflio'); ?>
<?php }else{ ?>
<?php get_header(); ?>
<?php
$welcome_text 		= 	get_option("welcome_text");
$front_page 		= 	get_option('front_page');
	
	if($portfolio_mode = get_option('portfolio_mode')){}else{ $portfolio_mode = 0; } /* 1 = thumbnail grid, 0 = classic */
	if(!empty($_GET['prj']) && $_GET['prj'] == 'classic'){ $portfolio_mode = 0; }
	if(!empty($_GET['prj']) && $_GET['prj'] == 'thumb'){ $portfolio_mode = 1; }
?>

<?php if($welcome_text){ ?>
	<div class="welcome-text"><?php echo stripslashes($welcome_text); ?></div>
<?php } ?>

<?php $temp = $post; ?>
<?php if($portfolio_mode == '1'){ ?>
<?php }else{ ?>
	<?php get_template_part('slideshow'); ?>
	<?php 
	if($page_id = $front_page){
		$page_data = get_page( $page_id );
		if(get_post_meta($page_data->ID, 'Description', true)){ ?>
			<div class="page-description" style="margin: 15px auto 50px;"><?php echo get_post_meta($page_data->ID, 'Description', true); ?></div>
		<?php } ?>
		<div class="page-content clearfix container_12"><?php echo do_shortcode($page_data->post_content); ?></div>
	<?php } ?>
<?php } $post = $temp; ?>

<?php get_template_part('project', 'container'); ?>
<?php get_template_part('project', 'loop'); ?>
<?php get_template_part('project', 'script'); ?>
<?php get_footer(); ?>
<?php } ?>