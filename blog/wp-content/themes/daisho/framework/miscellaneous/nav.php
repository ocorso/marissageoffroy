<?php 
add_filter('nav_menu_css_class','add_parent_css',10,2);
function add_parent_css($classes, $item){
	global  $dd_depth, $dd_children;
	$classes[] = 'menu-item-depth-'.$dd_depth;
	if($dd_children){
		$classes[] = 'menu-item-has-submenu parent';
	}
    return $classes;
}
class description_walker extends Walker_Nav_Menu{
	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output){
        $GLOBALS['dd_children'] = (isset($children_elements[$element->ID]))? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu level-".$depth."\">\n";
	}
	function start_el(&$output, $item, $depth, $args){
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
		if((is_home() AND get_option('portfolio_mode') == 1) AND (esc_attr($item->url) == get_permalink(get_option('flow_portfolio_page')))){
			if(isset($_SESSION['prj']) && ($_SESSION['prj'] == 0)){ }else{ //Demo Only!
				$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter(array_merge(array('current-menu-item', 'current_page_item'), $classes)), $item));
			}
		}
		   
		$class_names = ' class="'.esc_attr($class_names).'"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<span>';
		$append = '</span>';
		$description  = !empty($item->description) ? '<span class="menu-icon">'.esc_attr($item->description).'</span>' : '';
		if($depth != 0){ $description = $append = $prepend = ""; }

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $description;
		$item_output .= $args->link_before.$prepend.apply_filters('the_title', $item->title, $item->ID).$append;
		//$item_output .= $description.$args->link_after;
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
};
 
class compact_menu_walker extends Walker_Nav_Menu{
	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output){
        $GLOBALS['dd_children'] = (isset($children_elements[$element->ID]))? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu level-".$depth."\">\n";
	}
	function start_el(&$output, $item, $depth, $args){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item ));
		if((is_home() AND get_option('portfolio_mode') == 1) AND (esc_attr($item->url) == get_permalink(get_option('flow_portfolio_page')))){
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter(array_merge(array('current-menu-item', 'current_page_item'), $classes)), $item ));
		}

		$class_names = ' class="'.esc_attr($class_names).'"';

		$output .= $indent . '<li id="compact-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		//$prepend = '<strong>';
		$prepend = '';
		//$append = '</strong>';
		$append = '';
		$description  = ! empty($item->description) ? '<span>'.esc_attr($item->description).'</span>' : '';

		if($depth != 0){ $description = $append = $prepend = ""; }

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		//$item_output .= $description;
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		//$item_output .= $description.$args->link_after;
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
};

class select_menu_walker extends Walker_Nav_Menu{
 
	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}

	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}
 
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		//check if current page is selected page and add selected value to select element  
		  $selc = '';
		  $curr_class = 'current-menu-item';
		  $is_current = strpos($class_names, $curr_class);
		  if($is_current === false){
	 		  $selc = "";
		  }else{
	 		  $selc = " selected ";
		  }
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$sel_val =  ' value="'   . esc_attr( $item->url ) .'"';
 
		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}

		$output .= $indent . '<option'. $sel_val . $id . $value . $class_names . $selc . '>'.$dp;
 
		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	function end_el(&$output, $item, $depth) {
		$output .= "</option>\n";
	}
 
}
?>