<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_reg-page_template',
	'title' => 'Pixia Page Custom Options',
	'types' => array('page'),
	'exclude_template' => array('template_portfolio.php','template_portfolio_masonry.php','template_homepage.php','template_blog_masonry.php','template_blog.php'),
	'template' => get_stylesheet_directory() . '/inc/plugins/wpalchemy/metaboxes/reg-page-meta.php'
));
/* eof */