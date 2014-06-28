<?php get_header(); ?>
<?php
	//$welcome_text = get_option("welcome_text");
	$front_page = get_option('front_page');
	
	global $post;

	if($portfolio_mode = get_option('portfolio_mode')){ }else{ $portfolio_mode = 0; } /* 1 = thumbnail grid, 0 = classic */
	if(!empty($_GET['prj']) && $_GET['prj'] == 'classic'){ $portfolio_mode = 0; }
	if(!empty($_GET['prj']) && $_GET['prj'] == 'thumb'){ $portfolio_mode = 1; }
	$flow_slideshow = get_option('flow_featured_slideshow');

	if($front_page != ''){
		$welcome_text = get_post_meta((int) $front_page, 'page_portfolio_welcome_text', true);
	}
	
	if($welcome_text){ ?>
	<div class="welcome-text"><?php echo stripslashes($welcome_text); ?></div>
<?php } ?>

<?php
if($portfolio_mode == '1'){
$home_header = 'home-portfolio-header';
}else{
	$home_header = 'home-classic-header';
	if(!$flow_slideshow){ 
		get_template_part('slideshow'); 
	}
} ?>

<?php if(get_post_meta($front_page, 'flow_post_title', true) || get_post_meta($front_page, 'flow_post_description', true)){ ?>
	<header class="page-header <?php echo $home_header; ?>">
		<?php if(($page_title = get_post_meta($front_page, 'Title', true)) || ($page_title = get_post_meta($front_page, 'flow_post_title', true))){ ?>
			<h1 class="page-title"><?php echo $page_title; ?></h1>
		<?php } ?>
		<?php if(($page_description = get_post_meta($front_page, 'Description', true)) || ($page_description = get_post_meta($front_page, 'flow_post_description', true))){ ?>
			<div class="page-description"><?php echo $page_description; ?></div>
		<?php } ?>
	</header>
<?php } ?>

<?php 
if($portfolio_mode == '1'){ 
}else{
	if($page_id = $front_page){
		$page_data = get_page( $page_id ); ?>
		<div class="page-content clearfix container_12"><?php echo do_shortcode($page_data->post_content); ?></div>
	<?php } ?>
<?php } ?>

<?php get_template_part('project', 'container'); ?>
<?php get_template_part('project', 'loop'); ?>
<?php get_template_part('project', 'script'); ?>

<?php get_footer(); ?>