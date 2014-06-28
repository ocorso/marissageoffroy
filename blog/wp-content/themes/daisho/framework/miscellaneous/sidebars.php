<?php
	// Create sidebar areas
	if(function_exists('register_sidebar')){
		register_sidebars(1, array('before_title'=>'<h3>','after_title'=>'</h3>'));
	}
	
	// Create Footer Widget Areas
	$footer_col_countcustom = get_option('footer_col_countcustom');
	if($footer_col_countcustom){
		$footer_columns_count_t = explode(",", $footer_col_countcustom);
	}
	
	$r = $footer_columns_count_t;
	$r_items_count = count($r);
	
	for($i = 1; $r_items_count >= $i; $i++){
		$args = array(
			'name'          => sprintf(__('Footer %d', 'flowthemes'), $i),
			'id'            => "flow-footer-$i",
			'description'   => sprintf(__('This footer column has the following CSS classes: %s', 'flowthemes'), $r[$i-1]),
			'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' 
		);
		
		register_sidebar( $args );
	}
?>