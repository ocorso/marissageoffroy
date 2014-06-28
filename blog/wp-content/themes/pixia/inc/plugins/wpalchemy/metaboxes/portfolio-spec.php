<?php

$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Pixia Portfolio Custom Options',
	'types' => array('pirenko_portfolios'),
	'template' => get_stylesheet_directory() . '/inc/plugins/wpalchemy/metaboxes/portfolio-meta.php',
));

/* eof */