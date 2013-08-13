<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_blog_template',
	'title' => 'Pixia Blog Template Custom Options',
	'template' => get_stylesheet_directory() . '/inc/plugins/wpalchemy/metaboxes/template-blog-meta.php',
	'include_template' => array('template_blog.php','template_blog_masonry.php') // use an array for multiple items
));
/* eof */