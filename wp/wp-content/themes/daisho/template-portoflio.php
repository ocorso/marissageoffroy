<?php
/* Template Name: Portfolio Thumbnail Grid */ 
?> 
<?php get_header(); ?>
<?php
$front_page = get_option('front_page');
if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
	$welcome_text = get_post_meta($parent_page, 'page_portfolio_welcome_text', true);
}else if(is_singular('portfolio') && $front_page != ''){
	$welcome_text = get_post_meta((int) $front_page, 'page_portfolio_welcome_text', true);
}else if(is_page_template('template-portoflio.php')){
	$welcome_text = get_post_meta($post->ID, 'page_portfolio_welcome_text', true);
}else{
	$welcome_text = false;
}
if($welcome_text){ ?>
	<div class="welcome-text"><?php echo stripslashes($welcome_text); ?></div>
<?php } ?>

<?php if(get_post_meta($post->ID, 'flow_post_title', true) || get_post_meta($post->ID, 'flow_post_description', true)){ ?>
	<header class="page-header home-portfolio-header">
		<?php if($page_title = get_post_meta($post->ID, 'flow_post_title', true)){ ?>
			<h1 class="page-title"><?php echo $page_title; ?></h1>
		<?php } ?>
		<?php if($page_description = get_post_meta($post->ID, 'flow_post_description', true)){ ?>
			<div class="page-description"><?php echo $page_description; ?></div>
		<?php } ?>
	</header>
<?php } ?>

<?php get_template_part('project', 'container'); ?>
<?php get_template_part('project', 'loop'); ?>
<?php get_template_part('project', 'script'); ?>

<?php get_footer(); ?>