<?php
if(is_admin()){
	add_action('admin_bar_menu', 'flow_admin_toolbar', 999);
	function flow_admin_toolbar($wp_admin_bar){
		global $wp_admin_bar;
		
		$flow_theme_menu = array(
			'id' => 'flow_theme_page',
			'title' => __('Daisho', 'flowthemes'),
			'href' => '',
			'meta' => array('class' => 'flow-admin-bar-theme-page')
		);	 

		$flow_theme_documentation = array(
			'id' => 'flow_theme_subpage_documentation',
			'title' => __('Daisho Documentation', 'flowthemes'),
			'href' => 'http://support.forcg.com/bb-templates/kakumei-flow/help/daisho/index.html',
			'parent' => 'flow_theme_page',
			'meta' => array('class' => '', 'target' => '_blank')
		);		
		
		$flow_theme_installation = array(
			'id' => 'flow_theme_subpage_installation',
			'title' => __('Daisho Installation Video', 'flowthemes'),
			'href' => 'http://www.youtube.com/watch?v=Yvf2dcPfiHM',
			'parent' => 'flow_theme_page',
			'meta' => array('class' => '', 'target' => '_blank')
		);			
		
		$flow_theme_typography = array(
			'id' => 'flow_theme_subpage_typography',
			'title' => __('Typography Plugin Video', 'flowthemes'),
			'href' => 'https://vimeo.com/22093944',
			'parent' => 'flow_theme_page',
			'meta' => array('class' => '', 'target' => '_blank')
		);		
		
		$flow_theme_item_page = array(
			'id' => 'flow_theme_subpage_item_page',
			'title' => __('Daisho Item Page', 'flowthemes'),
			'href' => 'http://themeforest.net/item/daisho-flexible-wordpress-portfolio-theme/2585124',
			'parent' => 'flow_theme_page',
			'meta' => array('class' => '', 'target' => '_blank')
		);
		
		$flow_theme_group = array(
			'id' => 'first_group',
			'parent' => 'flow_theme_page',
			'meta' => array('class' => 'ab-sub-secondary')
		);
		
		$flow_theme_support = array(
			'id' => 'flow_theme_subpage_support',
			'title' => __('Daisho Support', 'flowthemes'),
			'href' => 'http://support.forcg.com/forum/daisho',
			'parent' => 'first_group',
			'meta' => array('class' => '', 'target' => '_blank')
		);		
		
		$flow_theme_about = array(
			'id' => 'flow_theme_subpage_about',
			'title' => __('About Daisho', 'flowthemes'),
			'href' => 'http://themes.devatic.com/daisho/wp-admin/admin.php?page=sub-page42',
			'parent' => 'first_group'
			//'meta' => array('class' => '', 'target' => '_blank')
		);

		$wp_admin_bar->add_node($flow_theme_menu);
		$wp_admin_bar->add_node($flow_theme_documentation);
		$wp_admin_bar->add_node($flow_theme_installation);
		$wp_admin_bar->add_node($flow_theme_typography);
		$wp_admin_bar->add_node($flow_theme_item_page);
		$wp_admin_bar->add_group($flow_theme_group);
		$wp_admin_bar->add_node($flow_theme_support);
		$wp_admin_bar->add_node($flow_theme_about);
	}
}
?>