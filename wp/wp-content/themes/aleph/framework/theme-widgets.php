<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Function file to create/modify widgets
 *
 * /framework/theme-widgets.php
 * Version of this file : 1.4
 *
 *
 *	1. Default Widgets
 *	1.1	Unregister some default widgets
 *	1.2 Custom Meta Widget
 *  1.3 Custom Recent Comments Widget
 *  1.4 Custom Recent Posts Widget
 *  1.5	Modified Pages Widget
 *  1.6 Modified Tag Cloud Widget
 *  2. Custom Widgets
 *
 */
?>
<?php 
 
/**
 * ------------------------------------------------------------------------
 * 1.	Default widgets
 * ------------------------------------------------------------------------
 */ 

    /*--------------------------------
    //  1.1	Unregister some default widgets
    ----------------------------------*/
 	add_action( 'widgets_init', 'my_unregister_widgets' );	
	function my_unregister_widgets() {
		unregister_widget( 'WP_Widget_Search' );
		unregister_widget( 'WP_Widget_Meta' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
	}	
	
	add_action('init', 'custom_widgets_init', 1);
	function custom_widgets_init() {
		register_widget('Custom_Widget_Meta');
		register_widget('Custom_Widget_Recent_Posts');
		do_action('widgets_init');
	}

    /*--------------------------------
    //  1.2	Custom Meta Widget
    ----------------------------------*/
	class Custom_Widget_Meta extends WP_Widget {
	
		function __construct() {
			$widget_ops = array('classname' => 'widget_meta', 'description' => __( "Log in/out, admin, feed and WordPress links") );
			parent::__construct('meta', __('Aleph - Meta'), $widget_ops);
		}
	
		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Meta') : $instance['title'], $instance, $this->id_base);
	
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };	
	?>
				<ul>
				<li>
					<?php 
						if(is_user_logged_in()) {
							echo "<a href='".wp_logout_url()."' target='_blank'>Log out</a>";
						} else {
							echo "<a href='".wp_login_url()."' target='_blank'>Log in</a>";
						}
					?>
				</li>
				<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0')); ?>" target="_blank"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
				<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS')); ?>" target="_blank"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
				<li><a href="<?php esc_attr_e( 'http://wordpress.org/' ); ?>" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.')); ?>" target="_blank"><?php
				/* translators: meta widget link text */
				_e( 'WordPress.org' );
				?></a></li>
				</ul>
	<?php
			echo $after_widget;
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
	
			return $instance;
		}
	
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = strip_tags($instance['title']);
	?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
	<?php
		}
	}

    /*--------------------------------
    //  1.3	Custom Recent Comments Widget
    ----------------------------------*/
	add_action( 'widgets_init', 'recent_comments_widgets' );
	
	function recent_comments_widgets() {
		register_widget('Recent_Comments');
	}
	
	class Recent_Comments extends WP_Widget {
		function Recent_Comments() {
			$widget_ops = array('classname' => 'recent_comments', 'description' => __('Displays recent comments with avatars and comment excerpts.'));
			$this->WP_Widget('recent-comments', __('Aleph - Recent Comments'), $widget_ops);
		}
	
		function widget($args, $instance) {
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$number = $instance['number'];
	
			// Begin Widget
			echo $before_widget;
			
			if ($title) echo $before_title . $title . $after_title; ?>
			
			<div id="recent-comments">
				
			
				
					<?php
					global $wpdb;
					$request = "SELECT * FROM $wpdb->comments";
					$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
					$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
					$request .= " ORDER BY comment_date DESC LIMIT $number";
					$comments = $wpdb->get_results($request);
					if ($comments) { foreach ($comments as $comment) {		
					ob_start(); ?>
	
	<div class="widget-comment-list row-fluid clearfix">
						
					<div class="widget-comment-thumb avatar span2">
						
							<?php echo get_avatar($comment,$size='28'); ?>
							
				</div>
							<div class="comment-excerpt span10 clearfix">
								<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, 30)); ?>...</a>
								<br/><span class="comment-author"><?php echo($comment->comment_author) ?> <?php _e('on'); ?> <?php echo get_the_title($comment->comment_post_ID) ?></span>
							</div>
						
					
				</div>
								
					<?php ob_end_flush(); }} else { // If no comments ?>
					
						<p>No comments.</p>
						
					<?php } ?>
				
			</div>
			
			<?php echo $after_widget;
			// End Widget
	
		}
	
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = strip_tags($new_instance['number']);
			return $instance;
		}
	
		function form( $instance ) {
			$defaults = array('title' => 'Recent Comments', 'number' => '5'); $instance = wp_parse_args((array) $instance, $defaults ); ?>
	
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<br/><input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Comments:'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" size="3" value="<?php echo $instance['number']; ?>" />
			</p>
			
			<?php
		}
	}

    /*--------------------------------
    //  1.4	Custom Recent Posts Widget
    ----------------------------------*/
	class Custom_Widget_Recent_Posts extends WP_Widget {
	
		function __construct() {
			$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site with thumbnails") );
			parent::__construct('recent-posts', __('Aleph - Recent Posts'), $widget_ops);
			$this->alt_option_name = 'widget_recent_entries';
	
			add_action( 'save_post', array(&$this, 'flush_widget_cache') );
			add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
			add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
		}
	
		function widget($args, $instance) {
			$cache = wp_cache_get('widget_recent_posts', 'widget');
	
			if ( !is_array($cache) )
				$cache = array();
	
			if ( ! isset( $args['widget_id'] ) )
				$args['widget_id'] = $this->id;
	
			if ( isset( $cache[ $args['widget_id'] ] ) ) {
				echo $cache[ $args['widget_id'] ];
				return;
			}
	
			ob_start();
			extract($args);
	
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
	 			$number = 10;
	
			$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
			if ($r->have_posts()) :
			
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };	?>
			
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<div class="widget-post-list row-fluid clearfix">
				<div class="widget-post-thumb span4">
					<?php the_post_thumbnail('edit-screen-thumbnail'); ?> 
				</div>
				<div class="widget-post-title span8 clearfix">
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				</div>
			</div>
			<?php endwhile; ?>
			
			<?php echo $after_widget; ?>
	<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
	
			endif;
	
			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('widget_recent_posts', $cache, 'widget');
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
			$this->flush_widget_cache();
	
			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset($alloptions['widget_recent_entries']) )
				delete_option('widget_recent_entries');
	
			return $instance;
		}
	
		function flush_widget_cache() {
			wp_cache_delete('widget_recent_posts', 'widget');
		}
	
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$number = isset($instance['number']) ? absint($instance['number']) : 5;
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
	
			<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php
		}
	}

    /*--------------------------------
    //  1.5	Modified Pages Widget
    ----------------------------------*/
	class DynamicPageMenu extends Walker_Page {
		function start_el(&$output, $page, $depth, $args, $current_page) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';
			extract($args, EXTR_SKIP);
			$output .= $indent . '<li class="' . apply_filters( 'the_title', $page->post_name, $page->ID ) . '">';
			$page_link = get_page_link($page->ID);
			$level = get_post_meta($page->ID,'level',true);
			$href = ($level == "top") ? "#" : $page_link;
			$data_rel = ($level == "top") ? $page_link : "";
			$class = ($level == "top") ? "top-top" : "";
			$output .='<a href="' . $href . '" data-rel="'.$data_rel.'" class="'.$class.'" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title, $page->ID ) ) ) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
		}
	}	
	function my_page_filter($args) {
	    $args = array_merge($args, array('walker' => new DynamicPageMenu()));
	    return $args;
	}	 
	add_filter('widget_pages_args', 'my_page_filter');    

    /*--------------------------------
    //  1.6	Modified Tag Cloud Widget
    ----------------------------------*/
	function add_tag_class( $taglinks ) {
	    $tags = explode('</a>', $taglinks);
	    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
	        foreach( $tags as $tag ) {
	            $tagn[] = preg_replace($regex, "('$1$2 label radius tag-'.get_tag($2)->slug.'$3')", $tag );
	        }
	    $taglinks = implode('</a>', $tagn);
	    return $taglinks;
	}
	
	add_action('wp_tag_cloud', 'add_tag_class');
	
	add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );
	
	function my_widget_tag_cloud_args( $args ) {
		$args['number'] = 20; // show less tags
		$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
		$args['smallest'] = 9.75;
		$args['unit'] = 'px';
		return $args;
	}
	
	add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);
	
	function wp_tag_cloud_filter($return, $args)
	{
	  return '<div id="tag-cloud"><p>'.$return.'</p></div>';
	}
	
	function add_class_the_tags($html){
	    $postid = get_the_ID();
	    $html = str_replace('<a','<a class="label success radius"',$html);
	    return $html;
	}
	add_filter('the_tags','add_class_the_tags',10,1);      
 
/**
 * ------------------------------------------------------------------------
 * 2.	Custom widgets
 * ------------------------------------------------------------------------
 */ 

    /*--------------------------------
    //  2.1	Twitter Widget
    ----------------------------------*/
	class Theme_Widget_Twitter extends WP_Widget {
	
		function Theme_Widget_Twitter() {
			$widget_ops = array('classname' => 'widget_twitter', 'description' => __( 'Displays latest tweets', 'alephtheme' ) );
			$this->WP_Widget('twitter', __('Aleph - Twitter Feed', 'alephtheme'), $widget_ops);
		}
	
		function widget($args, $instance) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title']) ? __('', 'alephtheme') : $instance['title'], $instance, $this->id_base);		
		
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };	
		
			echo '<div class="tweet"></div>';
		
			echo $after_widget; 
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);			
			return $instance;
		}
		
		function form($instance) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
			<?php
			echo "You must set your twitter username and the number of tweets in the <strong>aleph admin panel</strong>, in the <strong><em>Content</em></strong> tab.";
		}

	}
	register_widget('Theme_Widget_Twitter');

    /*--------------------------------
    //  2.2	Flickr Feed Widget
    ----------------------------------*/
	class Theme_Widget_Flickr extends WP_Widget {
	
		function Theme_Widget_Flickr() {
			$widget_ops = array('classname' => 'widget_flickr', 'description' => __( 'Displays photos from a Flickr ID', 'alephtheme' ) );
			$this->WP_Widget('flickr', __('Aleph - Flickr Feed', 'alephtheme'), $widget_ops);
		}
	
		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title']) ? __('', 'alephtheme') : $instance['title'], $instance, $this->id_base);
			$flickr_id = $instance['flickr_id'];
			$count = (int)$instance['count'];
			$display = empty( $instance['display'] ) ? 'latest' : $instance['display'];
	
			if($count < 1){
				$count = 1;
			}
			
			if ( !empty( $flickr_id ) ) {
				echo $before_widget;
				if ( $title)
					echo $before_title . $title . $after_title;
			?>
			<div class="flickr_wrap clearfix">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>
			</div>
			<?php
				echo $after_widget;
			}
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
			$instance['count'] = (int) $new_instance['count'];
			$instance['display'] = strip_tags($new_instance['display']);
			
			return $instance;
		}
	
		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
			$count = isset($instance['count']) ? absint($instance['count']) : 3;
			$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):', 'alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of photo to display:', 'alephtheme'); ?></label>
			<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
			<p><label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display type:', 'alephtheme'); ?></label>
			<select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
				<option<?php if($display == 'latest') echo ' selected="selected"'?> value="latest"><?php _e('Latest', 'alephtheme'); ?></option>
				<option<?php if($display == 'random') echo ' selected="selected"'?> value="random"><?php _e('Random', 'alephtheme'); ?></option>
			</select>
	<?php
		}
	}
	register_widget('Theme_Widget_Flickr');

    /*--------------------------------
    //  2.3	Adboxes Widget
    ----------------------------------*/
	class Fables_Adboxes_Widget extends WP_Widget {
		function Fables_Adboxes_Widget() {
			$widget_ops = array('classname' => 'widget_fables_adboxes', 'description' => 'Display advertisements from your sidebar' );
			$this->WP_Widget('fables_adboxes', 'Aleph - Adboxes', $widget_ops);
		}
	
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			
			
			$thumbsize_one=$instance['thumbsize_one'];
			$logo_one=$instance['logo1'];
			$link_one=$instance['link1'];
			
			$thumbsize_two=$instance['thumbsize_two'];
			$logo_two=$instance['logo2'];
			$link_two=$instance['link2'];
	
			
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
					
				if ($thumbsize_one<>"none") {
					echo '<div class="'.$thumbsize_one.'_advertisement">';
					if ( isset($logo_one) ) {
						if ( isset($link_one) ){
							echo '<a href="'.$link_one.'" target="_blank">';
						}
						
						echo '<img src="'.$logo_one.'" alt="" />';
						
						if ( isset($link_one) ){
							echo '</a>';
						}
					}
					echo '</div>';
				}
				
				
				if ($thumbsize_two<>"none") {
					echo '<div class="'.$thumbsize_two.'_advertisement">';
					if ( isset($logo_two) ) {
						if ( isset($link_two) ){
							echo '<a href="'.$link_two.'" target="_blank">';
						}
						
						echo '<img src="'.$logo_two.'" alt="" />';
						
						if ( isset($link_two) ){
							echo '</a>';
						}
					}
					echo '</div>';
				}
			?>
			<div class="clear"></div>
			<?php
			echo $after_widget;
		}
	
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['thumbsize_one'] = strip_tags($new_instance['thumbsize_one']);
			$instance['logo1'] = strip_tags($new_instance['logo1']);
			$instance['link1'] = strip_tags($new_instance['link1']);
			$instance['thumbsize_two'] = strip_tags($new_instance['thumbsize_two']);
			$instance['logo2'] = strip_tags($new_instance['logo2']);
			$instance['link2'] = strip_tags($new_instance['link2']);
			
			return $instance;
		}
	
		function form($instance) {
		
			$thumbsize_one="";
			$thumbsize_two="";
		
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Advertisements' ) );
			$title = strip_tags($instance['title']);
			
			if (isset($instance['thumbsize_one'])) { $thumbsize_one=esc_attr($instance['thumbsize_one']); }
			if (isset($instance['thumbsize_two'])) { $thumbsize_two=esc_attr($instance['thumbsize_two']); }
			
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','alephtheme'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
			<p>	
			<p>
				<label for="<?php echo $this->get_field_id('thumbsize_one'); ?>">
					<?php _e('Thumbnail Size:','alephtheme'); ?>
				</label>
				<select id="<?php echo $this->get_field_id('thumbsize_one'); ?>" class="widefat" name="<?php echo $this->get_field_name('thumbsize_one'); ?>">
					<option value="none"<?php echo ($thumbsize_one === 'none' ? ' selected="selected"' : ''); ?>><?php _e( 'Disable', 'alephtheme' ); ?></option>
					<option value="ad125"<?php echo ($thumbsize_one === 'ad125' ? ' selected="selected"' : ''); ?>><?php _e( '125 x 125', 'alephtheme' ); ?></option>
					<option value="ad180"<?php echo ($thumbsize_one === 'ad180' ? ' selected="selected"' : ''); ?>><?php _e( '180 x 100', 'alephtheme' ); ?></option>
					<option value="ad260"<?php echo ($thumbsize_one === 'ad260' ? ' selected="selected"' : ''); ?>><?php _e( '260 x 120', 'alephtheme' ); ?></option>
					<option value="ad300"<?php echo ($thumbsize_one === 'ad300' ? ' selected="selected"' : ''); ?>><?php _e( '300 x 250', 'alephtheme' ); ?></option>
				</select>
			</p>
			<label for="<?php echo $this->get_field_id( 'logo1'); ?>"><?php _e('Ad Image path','alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'logo1'); ?>" name="<?php echo $this->get_field_name( 'logo1'); ?>" type="text" value="<?php if ( isset($instance['logo1']) ) { echo esc_attr($instance['logo1']); } ?>" />
			<label for="<?php echo $this->get_field_id( 'link1'); ?>"><?php _e('Target Link','alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link1'); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" type="text" value="<?php if ( isset($instance['link1']) ) { echo esc_attr($instance['link1']); } ?>" />
			</p>
			<p>
			<p>
				<label for="<?php echo $this->get_field_id('thumbsize_two'); ?>">
					<?php _e('Thumbnail Size:','alephtheme'); ?>
				</label>
				<select id="<?php echo $this->get_field_id('thumbsize_two'); ?>" class="widefat" name="<?php echo $this->get_field_name('thumbsize_two'); ?>">
					<option value="none"<?php echo ($thumbsize_two === 'none' ? ' selected="selected"' : ''); ?>><?php _e( 'Disable', 'alephtheme' ); ?></option>
					<option value="ad125"<?php echo ($thumbsize_two === 'ad125' ? ' selected="selected"' : ''); ?>><?php _e( '125 x 125', 'alephtheme' ); ?></option>
					<option value="ad180"<?php echo ($thumbsize_two === 'ad180' ? ' selected="selected"' : ''); ?>><?php _e( '180 x 100', 'alephtheme' ); ?></option>
					<option value="ad260"<?php echo ($thumbsize_two === 'ad260' ? ' selected="selected"' : ''); ?>><?php _e( '260 x 120', 'alephtheme' ); ?></option>
					<option value="ad300"<?php echo ($thumbsize_two === 'ad300' ? ' selected="selected"' : ''); ?>><?php _e( '300 x 250', 'alephtheme' ); ?></option>
				</select>
			</p>
			<label for="<?php echo $this->get_field_id( 'logo2'); ?>"><?php _e('Ad Image path','alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'logo2'); ?>" name="<?php echo $this->get_field_name( 'logo2'); ?>" type="text" value="<?php if ( isset($instance['logo2']) ) { echo esc_attr($instance['logo2']); } ?>" />
			<label for="<?php echo $this->get_field_id( 'link2'); ?>"><?php _e('Target Link','alephtheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link2'); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" type="text" value="<?php if ( isset($instance['link2']) ) { echo esc_attr($instance['link2']); } ?>" />
			</p>
	<?php
		}
	}
	register_widget('Fables_Adboxes_Widget');    