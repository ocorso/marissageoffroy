<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file containing custom functions
 *
 * /framework/theme-custom-functions.php
 * Version of this file : 1.7
 *
 *
 *	1. Content
 * 	1.1	Sets the post excerpt length to 40 words
 * 	1.2	Adds a custom "Continue Reading" link to excerpts
 * 	1.3	Disable jump in "read more" link
 *  1.4 Comments layout
 *  1.5 Password protected post form
 *  1.6 Custom backgrounds
 *  1.7 Utility links (like/share)
 *
 *	2. Images
 * 	2.1	Resize images and cross check if WP MU using blog ID
 * 	2.2	Get featured image link
 * 	2.3	Get featured image height
 * 	2.4 Show featured image
 * 	2.5	Generate WP MU image path
 * 	2.6	Remove extra margin - wp-caption
 *  2.7 Remove <p> around images
 *  2.8	Remove height/width attributes on images for responsivity
 *  2.9 Get image id by url
 *
 *	3. Navigation
 * 	3.1	Test if there are more pages for navigation
 * 	3.2	Previous/Next Posts Link
 *  3.3 Walker class for menu
 *  3.4 Various navigation
 *  3.5 Any previous/next post link by id
 *
 *	4. Various
 * 	4.1	Clean up the header
 * 	4.2	Add the sidebar class to body class
 *  4.3	Shortcodes format
 *	4.4 Footer sidebar class
 *
 */
?>
<?php

/**
 * ------------------------------------------------------------------------
 * 1.	Content
 * ------------------------------------------------------------------------
 */

    /*-------------------------------------
    //  1.1	Sets the post excerpt length to
    //		40 words.
    ---------------------------------------*/
	function custom_excerpt_length( $length ) {
		global $data;
		if($data['excerpt_length']!="") {
			return $data['excerpt_length'];
		} else {
			return 20;
		}
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

    /*-------------------------------------
    //  1.2	Adds a custom "Continue reading"
    //		link to excerpts
    ---------------------------------------*/
    if ( ! function_exists( 'new_excerpt_more' ) ) :
		function new_excerpt_more() {
		    global $post;
		    global $data;
			$more=$data['readmore_text'];
			return ' ... &nbsp;<a class="readmore" href="'. get_permalink($post->ID) . '">'. $more.'</a>';
		}
		add_filter('excerpt_more', 'new_excerpt_more');
	endif;

    /*-------------------------------------
    //  1.3	Disable jump in "read more" link
    ---------------------------------------*/
	function remove_more_jump_link($link) {
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"',$offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');

    /*-------------------------------------
    //  1.4	Comments layout
    ---------------------------------------*/
	function aleph_comments($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="clearfix">
				<div class="comment-author vcard row-fluid clearfix">
					<div class="span1">&nbsp;</div>
					<div class="avatar span2">
						<?php echo get_avatar($comment,$size='28',$default='<path_to_url>' ); ?>
					</div>
					<div class="span8 comment-text">
						<?php printf(__('<h4>%s</h4>','alephtheme'), get_comment_author_link()) ?>

	                    <?php if ($comment->comment_approved == '0') : ?>
	       					<div class="alert-message success">
	          				<p><?php _e('Your comment is awaiting moderation.','alephtheme') ?></p>
	          				</div>
						<?php endif; ?>

	                    <?php comment_text() ?>

	                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>

	                    <!-- removing reply link on each comment since we're not nesting them -->
						<?php //comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                </div>
	                <div class="span1">&nbsp;</div>
				</div>
			</article>
	    <!-- </li> is added by wordpress automatically -->
	<?php
	} // don't remove this bracket!

    /*-------------------------------------
    //  1.5	Password protected post form
    ---------------------------------------*/
	add_filter( 'the_password_form', 'custom_password_form' );
	function custom_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<div class="clearfix"><form id="protected-post-form" action="" method="post">
		' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ,'alephtheme') . '
		<label for="' . $label . '">' . __( "Password:" ,'alephtheme') . ' </label><div class="input"><input name="post_password" id="' . $label . '" class="post_password" type="password" size="20" /><input type="submit" id="pass-submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'alephtheme' ) . '" /></div>
		<div class="error_log alert alert-danger"></div>
		</form></div>
		';
		return $o;
	}

    /*-------------------------------------
    //  1.6	Custom backgrounds
    ---------------------------------------*/
	if ( ! function_exists( 'custom_bg' ) ) :
		function custom_bg($id) {
			// Custom background
			$different_bg = get_post_meta($id,'different_bg',true);
			if($different_bg=="on") {
				$bg=get_post_meta($id,'post_bg','true');
				$custom_bg=get_post_meta($id,'post_bg_custom','true');

				if($bg!="" && $custom_bg=="") {
					echo '<style>';
					echo 'body { ';
							echo 'background-color:#000;';
							echo 'background-image:url('.get_bloginfo("template_directory") .'/img/bg/' .$bg.');';
							echo 'background-repeat:no-repeat;';
							echo 'background-position:top left;';
							echo 'background-attachment:fixed;';
							echo 'background-size:auto;';
					echo ' }';
					echo '</style>';
				} elseif ($custom_bg !="") {
					echo '<style>';
					echo 'body { ';
							echo 'background-image:url(';
							echo $custom_bg;
							echo ');';
							echo 'background-repeat:'.get_post_meta($id,"post_bg_custom_repeat","true").';';
							echo 'background-position:top left;';
							echo 'background-attachment:'.get_post_meta($id,"post_bg_custom_attachment","true").';';
					echo ' }';
					echo '</style>';
				}
			}
		}
	endif;

    /*-------------------------------------
    //  1.7	Utility links (like/share)
    ---------------------------------------*/
	if ( ! function_exists( 'social_modal' ) ) :
		function social_modal($id) {
			global $data;
	?>
			<div id="shareModal" class="share-box">
				<h3><?php _e('Share this post','alephtheme'); ?></h3>
				<div class="modal-body">
					<?php
						$post_title = get_the_title($id);
						$post_link = get_permalink($id);
						$services=$data['social_share_services'];
						$tooltips=$data['social_share_tip'];

						if($services['delicious']=="1") { ?>
							<a href="http://delicious.com/post?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&notes=" target="_blank" class="ttip delicious" title="<?php echo $tooltips['delicious']; ?>">Delicious</a><?php
						}
						if($services['digg']=="1") { ?>
							<a href="http://digg.com/submit?url=<?php echo urlencode($post_link) ?>&amp;title=<?php echo urlencode($post_title) ?>" target="_blank" class="ttip digg" title="<?php echo $tooltips['digg']; ?>">Digg</a><?php
						}
						if($services['facebook']=="1") { ?>
							<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($post_link) ?>&t=<?php echo urlencode($post_title) ?>" target="_blank" class="ttip facebook" title="<?php echo $tooltips['facebook']; ?>">Facebook</a><?php
						}
						if($services['googleplus']=="1") { ?>
							<a href="https://plus.google.com/share?url=<?php echo urlencode($post_link) ?>" target="_blank" class="ttip googleplus" title="<?php echo $tooltips['googleplus']; ?>"><div class="part1"></div><div class="part2"></div><div class="part3"></div><div class="part4"></div><span>Google+</span></a><?php
						}
						if($services['linkedin']=="1") { ?>
							<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=" target="_blank" class="ttip linkedin" title="<?php echo $tooltips['linkedin']; ?>">LinkedIn</a><?php
						}
						if($services['stumbleupon']=="1") { ?>
							<a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode($post_link) ?>&title=<?php echo urlencode($post_title) ?>&newcomment=" target="_blank" class="ttip stumbleupon" title="<?php echo $tooltips['stumbleupon']; ?>">StumbleUpon</a><?php
						}
						if($services['twitter']=="1") { ?>
							<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post_title) ?>&url=<?php echo urlencode($post_link) ?>" target="_blank" class="ttip twitter" title="<?php echo $tooltips['twitter']; ?>">Twitter</a><?php
						} ?>
				</div>
			</div>
	<?php
		}
	endif;
	if ( ! function_exists( 'utility_ls' ) ) :
		function utility_ls($id) {
			global $data;
			if($data['social_share_activate']=="1" && $data['post_like']=="1") {
	?>
				<div class="row-fluid clearfix utility-ls">
						<div class="span6">
							<?php echo getPostLikeLink(get_the_ID()); ?>
						</div>
						<div class="span6 clearfix">
							<p class="post-share clearfix">
								<a href="#shareModal"class="ttip fancybox share-link" title="<?php _e('Share this !','alephtheme'); ?>"><em class="icon-share"></em></a>
							</p>
						</div>
					</div>
				<?php
					social_modal($id);

			} elseif($data['social_share_activate']!="1" && $data['post_like']=="1") {
				echo getPostLikeLink(get_the_ID());
			} else {
	?>
				<p class="post-share clearfix">
					<a href="#shareModal" class="ttip fancybox share-link" title="Share this !"><em class="icon-share"></em></a>
				</p>
	<?php
				social_modal($id);
			}
		}
	endif;


/**
 * ------------------------------------------------------------------------
 * 2.	Images
 * ------------------------------------------------------------------------
 */

    /*-------------------------------------
    //  2.1	Resize images and cross check if
    //		WP MU using blog ID
    ---------------------------------------*/
    if ( ! function_exists( 'show image' ) ) :
		function showimage ($image,$link_url,$title) {
			$image_url=$image;
			$image=wpmu_image_path($image);
			$output=""; // Set nill
			$quality=100;

			if ($link_url!="") {
				$output = '<a href="' . $link_url . '">';
			}
			if ($image_url) {
				if (isset($class)) {
					$output .= '<img src="'. $image_url .'" title="'. $title .'" class="'. $class .'"/>';
				} else {
					$output .= '<img src="'. $image_url .'" title="'. $title .'" />';
				}
			}
			if ($link_url!="") {
				$output .= '</a>';
			}
			return $output;
		}
	endif;

    /*-------------------------------------
    //  2.2	Get featured image link
    ---------------------------------------*/
    if ( ! function_exists( 'featured_image_link' ) ) :
		function featured_image_link ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'full');
			$image_url = wp_get_attachment_image_src($image_id,'full');
			$image_url = $image_url[0];
			return $image_url;
		}
	endif;
    if ( ! function_exists( 'featured_image_link_thumb' ) ) :
		function featured_image_link_thumb ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'portfolio-thumb');
			$image_url = wp_get_attachment_image_src($image_id,'portfolio-thumb');
			$image_url = $image_url[0];
			return $image_url;
		}
	endif;
    if ( ! function_exists( 'featured_image_link_portf' ) ) :
		function featured_image_link_portf ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'portfolio-thumbnail');
			$image_url = wp_get_attachment_image_src($image_id,'portfolio-thumbnail');
			$image_url = $image_url[0];
			return $image_url;
		}
	endif;
    if ( ! function_exists( 'featured_image_link_portf_prop' ) ) :
		function featured_image_link_portf_prop ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'portfolio-thumbnail-prop');
			$image_url = wp_get_attachment_image_src($image_id,'portfolio-thumbnail-prop');
			$image_url = $image_url[0];
			return $image_url;
		}
	endif;

    /*-------------------------------------
    //  2.3	Get featured image height
    ---------------------------------------*/
    if ( ! function_exists( 'featured_image_height' ) ) :
		function featured_image_height ($ID) {
			$image_id = get_post_thumbnail_id($ID, 'full');
			$image_url = wp_get_attachment_image_src($image_id,'full');
			$image_url = $image_url[2];
			return $image_url;
		}
	endif;

    /*-------------------------------------
    //  2.4	Show featured image
    ---------------------------------------*/
    if ( ! function_exists( 'showfeaturedimage' ) ) :
		function showfeaturedimage ($ID,$link) {
			$output=""; // Set nill
			$image_id = get_post_thumbnail_id($ID, 'full');
			$image_url = wp_get_attachment_image_src($image_id,'full');
			$image_url = $image_url[0];
			$image=wpmu_image_path($image_url);
			$permalink = get_permalink( $ID );
			$title=get_the_title($image_id);
			if ($link==true) {
				$output = '<a href="' . $image_url . '" class="'. $class .'" title="'.$title.'">';
			}
			if ($image) {
				$output .= '<img src="'. $image .'" alt="'. $title .'" />';
			}
			if ($link==true) {
				$output .= '</a>';
			}
			return $output;
		}
	endif;

    /*-------------------------------------
    //  2.5	Generate WP MU image path
    ---------------------------------------*/
    if ( ! function_exists( 'wpmu_image_path' ) ) :
		function wpmu_image_path ($theImageSrc) {
			if ( is_multisite() ) {
				$blog_id=get_current_blog_id();
				if (isset($blog_id) && $blog_id > 0) {
					$imageParts = explode('/files/', $theImageSrc);
					if (isset($imageParts[1])) {
						//$theImageSrc = $imageParts[0] . '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
						$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
					}
				}
			}
			return $theImageSrc;
		}
	endif;

    /*-------------------------------------
    //  2.6	Remove extra magin - wp-caption
    ---------------------------------------*/
	class fixImageMargins{
	    public $xs = 0; //change this to change the amount of extra spacing

	    public function __construct(){
	        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
	    }
	    public function fixme($x=null, $attr, $content){

	        extract(shortcode_atts(array(
	                'id'    => '',
	                'align'    => 'alignnone',
	                'width'    => '',
	                'caption' => ''
	            ), $attr));

	        if ( 1 > (int) $width || empty($caption) ) {
	            return $content;
	        }

	        if ( $id ) $id = 'id="' . $id . '" ';

	    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
	    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
	    }
	}
	$fixImageMargins = new fixImageMargins();

    /*-------------------------------------
    //  2.7	Remove <p> around images
    ---------------------------------------*/
	function filter_ptags_on_images($content){
    	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
	add_filter('the_content', 'filter_ptags_on_images');

    /*-------------------------------------
    //  2.8	Remove height/width attributes
    //		on images for responsivity
    ---------------------------------------*/
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
	function remove_thumbnail_dimensions( $html ) {
    	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}

	/*-------------------------------------
	//  2.9 Get image ID by URL
	---------------------------------------*/
	function get_image_id($image_url) {
	    global $wpdb;

	    $prefix = $wpdb->prefix;
	    $prefix .= "posts";

	    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM ".$prefix."  WHERE guid='%s'",$image_url));
	    if(is_array($attachment) && count($attachment)>0) {
		    return $attachment[0];
		}
	}

/**
 * ------------------------------------------------------------------------
 * 3.	Navigation
 * ------------------------------------------------------------------------
 */

    /*-------------------------------------
    //  3.1	Test if there are more pages
    //		for navigation
    ---------------------------------------*/
    if ( ! function_exists( 'show_posts_nav' ) ) :
		function show_posts_nav() {
			global $wp_query;
			return ($wp_query->max_num_pages > 1);
		}
	endif;

    /*-------------------------------------
    //  3.2	Previous/Next Posts Link
    ---------------------------------------*/
	if (!function_exists('get_previous_post_link')) {
		function get_previous_post_link($label1, $label2, $label3)
		{
			ob_start();
			previous_post_link($label1, $label2, $label3);
			return ob_get_clean();
		}
	}

	if (!function_exists('get_next_post_link')) {
		function get_next_post_link($label1, $label2, $label3)
		{
			ob_start();
			next_post_link($label1, $label2, $label3);
			return ob_get_clean();
		}
	}

	/*--------------------------------------
	//  3.3 Walker class for menu
	----------------------------------------*/
	class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth ) {

			$indent = str_repeat( "\t", $depth );
			$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = ($args->has_children) ? 'dropdown' : '';
			$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
			$classes[] = 'menu-item-' . $item->ID;


			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$level = get_post_meta($item->object_id,'level',true);
			if($level == "top") {
				$attributes .= ! empty( $item->url )        ? ' href="#" data-rel="'   . esc_attr( $item->url        ) .'"' : '';
				if($args->has_children) {
					$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle main-menu" data-toggle="dropdown"' : '';
				} else {
					$attributes .= ' class="main-menu"';
				}
			} else {
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
			}


			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

			if ( !$element )
				return;

			$id_field = $this->db_fields['id'];

			//display this element
			if ( is_array( $args[0] ) )
				$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
			else if ( is_object( $args[0] ) )
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'start_el'), $cb_args);

			$id = $element->$id_field;

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach( $children_elements[ $id ] as $child ){

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
					unset( $children_elements[ $id ] );
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
			}

			//end this element
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'end_el'), $cb_args);

		}

	}

	add_filter( 'wp_nav_menu_items', 'custom_menu_items', 10, 2 );
	function custom_menu_items ( $items, $args ) {
		global $data;
	    if ($args->theme_location == 'main_nav') {
			$items .= '<li class="divider-vertical to_hide"></li>';
			if($data['contact_activate']=="1") {
				$items .= '<li class="to_hide"><a href="#" data-rel="" id="contact"><em class="icon-envelope-alt icon-white"></em></a></li>';
			}
			$items .= '<li class="to_hide"><a href="#" data-rel="" id="search"><em class="icon-search icon-white"></em></a></li>';
			if($data["footer_sidebar_activate"]==true) {
				$items .= '<li class="to_hide"><a href="#" class="sidebar-toggle"><em class="icon-list"></em></a></li>';
			}

			if($data['header_fullscreen']=="1") {
				$items .= '<li class="to_hide"><a href="#" data-rel="" id="screenfull"><em class="icon-fullscreen icon-white"></em></a></li>';
			}
	    }
	    return $items;
	}

	if($data["general_menu_home"]=="1") {
		function nav_home_icon($items) {
			global $data;
			$title = $data['general_menu_home_text'];
			$title = ($title != "") ? $title : "Home";
	 		$home_icon = '<li><a href="#" data-rel="' . home_url( '/' ) . '" class="main-menu home-link">'.$title.'</a></li>';
	 		$items = $home_icon . $items;
	 		return $items;
	 	}
	 	add_filter( 'wp_nav_menu_items', 'nav_home_icon' );
 	}

	/*--------------------------------------
	//  3.4 Various navigation
	----------------------------------------*/
	if (!function_exists('var_nav')) :
		function var_nav($id, $level, $type) {
			global $data, $wp_query;
			switch($level) {
				case "sub" :
					if($type=="post" || $type=="portfolio") :

						// List of excluded posts
						$excluded=array();
						$temp = $wp_query;
						$wp_query= null;
						$excluded_args = array(
								'post_type'=>array('portfolio','post'),
					 			'posts_per_page'=>'-1',
					 			'nopaging'=>'true',
					 			'orderby'=>'menu_order',
					 			'order'=>'ASC',
					 			'ignore_sticky_posts' => 1,
					 			'meta_query' => array(
					 				array(
					 					'key' => 'portfolio_hide',
					 					'value'=> 'on'
					 				)
					 			)
						);
						$wp_query = new WP_Query( $excluded_args );
						while ($wp_query->have_posts()) : $wp_query->the_post();
							$excluded[]= get_the_ID();
						endwhile;
						$wp_query = null; $wp_query = $temp;
						wp_reset_postdata();

						$data_rel_portfolio = $data['link_portfolio'];

						if(get_post_meta($id,"portfolio_toplevel",true)!="") {
							$data_rel_portfolio = (get_post_meta($id,"portfolio_toplevel",true)=="homepageCCT") ? home_url( '/' ) : get_permalink(get_post_meta($id,"portfolio_toplevel",true));
						}

						$data_rel = $data['link_blog'];
						$data_rel = ($type=="portfolio") ? $data_rel_portfolio : $data['link_blog'];
						echo "<a href='#' data-rel='".$data_rel."' class='SubClose'><em class='icon-remove icon-white'></em></a>";
						echo "<div class='SubPostAdj clearfix'>";
						if(get_adjacent_post(false,'',false)!="") {
							$prev_id = get_adjacent_post(false,'',false)->ID;
							if(in_array($prev_id,$excluded)) {
								$prev_id = get_previous_post_id($prev_id);
							}
							echo "<a href='#' data-rel='".get_permalink($prev_id)."' class='pull-left ttip' title='Previous Post'><em class='icon-chevron-left icon-white'></em> <span>".get_the_title($prev_id)."</span></a>";
						}
						if(get_adjacent_post(false,'',true)!="") {
							$next_id = get_adjacent_post(false,'',true)->ID;
							if(in_array($next_id,$excluded)) {
								$next_id = get_next_post_id($next_id);
							}
							echo "<a href='#' data-rel='".get_permalink($next_id)."' class='pull-right ttip' title='Next Post'><span>".get_the_title($next_id)."</span> <em class='icon-chevron-right icon-white'></em></a>";
						}
						echo "</div>";
					else :
						$level_top=get_post_meta($id,'level_top','true');
						$custom_top_target = get_post_meta($id,'level_sub_target',true);
						if($custom_top_target != "") {
							if($custom_top_target=="homepageCCT") {
								$close_link=home_url();
								$data_id="";
							} else {
								$close_link = get_permalink($custom_top_target);
								$data_id = $custom_top_target;
							}
						} else {
							$close_link = get_permalink($level_top);
							$data_id=$level_top;
						}
						echo "<a href='#' data-rel='".$close_link."' class='SubClose' data-id='".$data_id."'><em class='icon-remove icon-white'></em></a>";
						// List of sub level posts
						$sub_level_posts=array();
						$sub_level_post_args = array(
								'post_type'=>array('page'),
					 			'posts_per_page'=>'-1',
					 			'nopaging'=>'true',
					 			'orderby'=>'menuorder',
					 			'ignore_sticky_posts' => 1,
					 			'meta_query' => array(
					 				'relation' => 'AND',
					 				array(
					 					'key' => 'level',
					 					'value'=> 'sub'
					 				),
					 				array(
					 					'key' => 'level_top',
					 					'value'=> $level_top,
					 					'compare'=>'LIKE'
					 				)
					 			)
						);
						$sub_level_post_query = new WP_Query( $sub_level_post_args );
						while ( $sub_level_post_query->have_posts() ) : $sub_level_post_query->the_post();
							$sub_level_posts[]=get_the_ID();
						endwhile;
						wp_reset_postdata();
						if(!empty($sub_level_posts) && count($sub_level_posts)!=1) {
							echo "<div class='SubPageAdj'>";
							foreach ($sub_level_posts as $sub_level_post) {
								echo "<a href='#' data-rel='".get_permalink($sub_level_post)."'>".get_the_title($sub_level_post)."</a>";
							}
							echo "</div>";
						}
					endif;
				break;
				case "none" :
					$custom_top_target = get_post_meta($id,'level_sub_target',true);
					if($custom_top_target != "") {
						if($custom_top_target=="homepageCCT") {
							$close_link=home_url();
							$data_id="";
						} else {
							$close_link = get_permalink($custom_top_target);
							$data_id = $custom_top_target;
						}
					} else {
						$close_link = home_url();
						$data_id="";
					}
					echo "<a href='#' data-rel='".$close_link."' class='SubClose' data-id='".$data_id."'><em class='icon-remove icon-white'></em></a>";
				break;
				case "top" :
					// List of top level posts
					$menu_args=array();
					$top_level_posts=array();
					$menu_args = array(
							'post_type'=>array('page'),
				 			'posts_per_page'=>'-1',
				 			'nopaging'=>'true',
				 			'orderby'=>'menu_order',
				 			'order'=>'ASC',
				 			'meta_query' => array(
				 				'relation' => 'AND',
				 				array(
				 					'key' => 'level',
				 					'value'=> 'top'
				 				)
				 			)
					);
					$menu = new WP_Query( $menu_args );
					while ( $menu->have_posts() ) : $menu->the_post();
						$hide=get_post_meta(get_the_ID(), "level_top_hide", true);
						if($hide!="on") {
							$top_level_posts[]=get_the_ID();
						}
					endwhile;
					wp_reset_postdata();
					if(get_option("page_on_front")=="0") {
						$position=array_search($id,$top_level_posts);
						$prev_post = '';
						$next_post = '';
						if($position == "0") {
							$next_post=$top_level_posts[$position+1];
						} elseif ($position > 0 && $position < (count($top_level_posts)-1)) {
							$prev_post=$top_level_posts[$position-1];
							$next_post=$top_level_posts[$position+1];
						} elseif ($position == (count($top_level_posts)-1)) {
							$prev_post=$top_level_posts[$position-1];
						}
					} else {
						$front_page = get_option("page_on_front");
						$position_front_page = array_search($front_page, $top_level_posts);
						unset($top_level_posts[$position_front_page]);
						$top_level_posts = array_values($top_level_posts);
						foreach($top_level_posts as $index=>$page_id) {
							$top_level_posts[$index+1]=$page_id;
						}
						$top_level_posts[0]=$front_page;
						$position=array_search($id,$top_level_posts);
						$prev_post = $top_level_posts[$position-1];
						$next_post = $top_level_posts[$position+1];
					}
					if(isset($prev_post) && get_option("page_on_front")=="0") {
						echo "<a href='#' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."' class='TopPrev'>";
						echo "<div class='desc' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."'><div class='title'>".get_the_title($prev_post)."</div> <div class='number'>";
						printf("%02d.",($position+1));
						echo "</div></div>";
						echo "<div class='arrow' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."'><em class='icon-chevron-left icon-white'></em></div>";
						echo "</a>";
					} elseif(!isset($prev_post) && get_option("page_on_front")=="0") {
						echo "<a href='#' data-rel='".home_url()."' class='TopPrev'>";
						echo "<div class='desc' data-rel='".home_url()."' data-id='".$prev_post."'><div class='title'>Home</div> <div class='number'>01.</div></div>";
						echo "<div class='arrow' data-rel='".home_url()."' data-id='".$prev_post."'><em class='icon-chevron-left icon-white'></em></div>";
						echo "</a>";
					} elseif(isset($prev_post) && get_option("page_on_front")!="0") {
						echo "<a href='#' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."' class='TopPrev'>";
						echo "<div class='desc' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."'><div class='title'>".get_the_title($prev_post)."</div> <div class='number'>";
						printf("%02d.",($position));
						echo "</div></div>";
						echo "<div class='arrow' data-rel='".get_permalink($prev_post)."' data-id='".$prev_post."'><em class='icon-chevron-left icon-white'></em></div>";
						echo "</a>";
					}

					if(isset($next_post) && get_option("page_on_front")=="0") {
						echo "<a href='#' data-rel='".get_permalink($next_post)."' class='TopNext' data-id='".$next_post."'>";
						echo "<div class='desc'data-rel='".get_permalink($next_post)."' data-id='".$next_post."'><div class='number'>";

						printf("%02d.",($position+3));
						echo "</div> <div class='title'>".get_the_title($next_post)."</div></div>";
						echo "<div class='arrow'data-rel='".get_permalink($next_post)."' data-id='".$next_post."'><em class='icon-chevron-right icon-white'></em></div>";
						echo "</a>";
					} elseif(isset($next_post) && get_option("page_on_front")!="0") {
						echo "<a href='#' data-rel='".get_permalink($next_post)."' class='TopNext' data-id='".$next_post."'>";
						echo "<div class='desc'data-rel='".get_permalink($next_post)."' data-id='".$next_post."'><div class='number'>";

						printf("%02d.",($position+2));
						echo "</div> <div class='title'>".get_the_title($next_post)."</div></div>";
						echo "<div class='arrow'data-rel='".get_permalink($next_post)."' data-id='".$next_post."'><em class='icon-chevron-right icon-white'></em></div>";
						echo "</a>";
					}

					// List of sub level posts
					$sub_level_posts=array();
					$sub_level_post_args = array(
							'post_type'=>array('page','post'),
				 			'posts_per_page'=>'-1',
				 			'nopaging'=>'true',
				 			'orderby'=>'menuorder',
				 			'ignore_sticky_posts' => 1,
				 			'meta_query' => array(
				 				'relation' => 'AND',
				 				array(
				 					'key' => 'level',
				 					'value'=> 'sub'
				 				),
				 				array(
				 					'key' => 'level_top',
				 					'value'=> $id,
				 					'compare'=>'LIKE'
				 				)
				 			)
					);
					$sub_level_post_query = new WP_Query( $sub_level_post_args );

					while ( $sub_level_post_query->have_posts() ) : $sub_level_post_query->the_post();
						$sub_level_posts[]=get_the_ID();
					endwhile;
					wp_reset_postdata();
					if(!empty($sub_level_posts)) {
						echo "<div class='sub-arrow'><div class='arrow'><a href='".get_permalink($sub_level_posts[0])."'><em class='icon-chevron-down'></em></a></div></div>";
						echo "<div class='TopSubMenu'>";
						echo "<div class='posts-list'>";
						foreach ($sub_level_posts as $sub_level_post) {
							echo "<a href='".get_permalink($sub_level_post)."'>".get_the_title($sub_level_post)."</a>";
						}
						echo "</div>";
						echo "</div>";
					}
				break;
			}
		}
	endif;

    /*-------------------------------------
    //  3.5	Any previous/next post link by id
    ---------------------------------------*/
	function get_next_post_id( $post_id ) {
	    global $post;
	    $oldGlobal = $post;
	    $post = get_post( $post_id );
	    $previous_post = get_previous_post();
	    $post = $oldGlobal;
	    if ( '' == $previous_post ) { return 0; }
	    return $previous_post->ID;
	}
	function get_previous_post_id( $post_id ) {
	    global $post;
	    $oldGlobal = $post;
	    $post = get_post( $post_id );
	    $next_post = get_next_post();
	    $post = $oldGlobal;
	    if ( '' == $next_post ) { return 0; }
	    return $next_post->ID;
	}
/**
 * ------------------------------------------------------------------------
 * 4.	Various
 * ------------------------------------------------------------------------
 */

    /*-------------------------------------
    //  4.1	Clean up the header
    ---------------------------------------*/
    if ( ! function_exists( 'removeHeadLinks' ) ) :
		function removeHeadLinks() {
			remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
			remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
			remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
			remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
			remove_action( 'wp_head', 'index_rel_link' );                         // index link
			remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
			remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
			remove_action( 'wp_head', 'wp_generator' );                           // WP version
			if (!is_admin()) {
				wp_deregister_script('jquery');                                   // De-Register jQuery
				wp_register_script('jquery', '', '', '', true);                   // It's already in the Header
			}
		}
		add_action('init', 'removeHeadLinks');
		remove_action('wp_head', 'wp_generator');
		function bones_rss_version() { return ''; }
		add_filter('the_generator', 'bones_rss_version');
	endif;

	/*-------------------------------------
    //  4.2	Add the sidebar class to body
    //		class
    ---------------------------------------*/
	add_action('wp_head', create_function("",'ob_start();') );
	add_action('get_sidebar', 'my_sidebar_class');
	add_action('wp_footer', 'my_sidebar_class_replace');

	function my_sidebar_class($name=''){
	  static $class="withsidebar";
	  if(!empty($name))$class.=" sidebar-{$name}";
	  my_sidebar_class_replace($class);
	}
	function my_sidebar_class_replace($c=''){
	  static $class='';
	  if(!empty($c)) $class=$c;
	  else {
	    echo str_replace('<body class="','<body class="'.$class.' ',ob_get_clean());
	    ob_start();
	  }
	}

    /*-------------------------------------
    //  4.3	Shortcodes format
    ---------------------------------------*/
    if ( ! function_exists( 'sc_formatter' ) ) :
		function sc_formatter($content) {
			$new_content = '';
			$pattern_full = '{(\[raw\].*?\[/raw\])}is';
			$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
			$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

			foreach ($pieces as $piece) {
				if (preg_match($pattern_contents, $piece, $matches)) {
					$new_content .= $matches[1];
				} else {
					$new_content .= wptexturize(wpautop($piece));
				}
			}
			return $new_content;
		}
		remove_filter('the_content',	'wpautop');
		remove_filter('the_content',	'wptexturize');
		add_filter('the_content', 'sc_formatter', 99);
	endif;

	// Enable shortcodes in widgets
	add_filter('widget_text', 'do_shortcode');

	/*-------------------------------------
    //  4.4	Footer sidebar class
    ---------------------------------------*/
	function footer_sidebar_class() {
		$count = 0;
		if ( is_active_sidebar( 'sidebar-1' ) )
			$count++;
		if ( is_active_sidebar( 'sidebar-2' ) )
			$count++;
		if ( is_active_sidebar( 'sidebar-3' ) )
			$count++;
		$class = '';
		switch ( $count ) {
			case '1':
				$class = 'widget-area span4';
				break;
			case '2':
				$class = 'widget-area span4';
				break;
			case '3':
				$class = 'widget-area span4';
				break;
		}
		if ( $class )
			echo 'class="' . $class . '"';
	}