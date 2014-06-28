<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_portfolio_template',
	'title' => 'Pixia Portfolio Template Custom Options',
	'template' => get_stylesheet_directory() . '/inc/plugins/wpalchemy/metaboxes/template-portfolio-meta.php',
	'include_template' => array('template_portfolio.php','template_portfolio_masonry.php') // use an array for multiple items
));
/* eof */