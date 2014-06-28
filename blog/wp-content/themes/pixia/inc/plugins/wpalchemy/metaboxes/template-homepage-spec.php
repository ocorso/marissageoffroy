<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_homepage_template',
	'title' => 'Pixia Fullscreen Slider Template Custom Options',
	'template' => get_stylesheet_directory() . '/inc/plugins/wpalchemy/metaboxes/template-homepage-meta.php',
	'include_template' => array('template_homepage.php') // use an array for multiple items
));
/* eof */