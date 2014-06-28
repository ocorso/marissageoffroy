<?php
	/*
		Plugin Name: Pirenko Social Links 
		Plugin URI: http://www.munto.net
		Description: A widget to add social network links to your website.
		Version: 1.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', 'load_pirenko_social' );
	//REGISTER WIDGET
	function load_pirenko_social() {
		register_widget( 'pirenko_social_widget' );
	}
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_social_widget extends WP_Widget 
	{
		//SET UP WIDGET
		function pirenko_social_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-social-widget', 'description' => ('A widget to add social network links to your website.') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pirenko-social-widget' );
			$this->WP_Widget( 'pirenko-social-widget', __('Pirenko: Social Links ', 'pirenko-social-widget'), $widget_ops, $control_ops );
		}

		
		var $imgs_url;
		var $z_social_title;
		var $pir_icons;
		var $tips;
		function fields_array( $instance = array() ) 
		{
			$this->imgs_url = ''.get_template_directory_uri().'/inc/theme_widgets/pirenko-social-links/icons/colored/';
			return array(			
				'behance' => array(
					'title' => __('Behance URL', 'spw'),
					'img' => sprintf( '%sbehance.png', '' ),
					'img_widget' => sprintf( '%sbehance.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Behance', 'spw')
				),
				'blogger' => array(
					'title' => __('Blogger URL', 'spw'),
					'img' => sprintf( '%sblogger.png', '' ),
					'img_widget' => sprintf( '%sblogger.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Blogger', 'spw')
				),
				'delicious' => array(
					'title' => __('Delicious URL', 'spw'),
					'img' => sprintf( '%sdelicious.png', '' ),
					'img_widget' => sprintf( '%sdelicious.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Delicious', 'spw')
				),
				'deviantart' => array(
					'title' => __('Deviantart URL', 'spw'),
					'img' => sprintf( '%sdeviantart.png', '' ),
					'img_widget' => sprintf( '%sdeviantart.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Deviantart', 'spw')
				),
				'digg' => array(
					'title' => __('Digg URL', 'spw'),
					'img' => sprintf( '%sdigg.png', '' ),
					'img_widget' => sprintf( '%sdigg.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Digg', 'spw')
				),
				'dribbble' => array(
					'title' => __('Dribbble', 'spw'),
					'img' => sprintf( '%sdribbble.png', '' ),
					'img_widget' => sprintf( '%sdribbble.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Dribbble', 'spw')
				),
				'facebook' => array(
					'title' => __('Facebook URL', 'spw'),
					'img' => sprintf( '%sfacebook.png', '' ),
					'img_widget' => sprintf( '%sfacebook.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Facebook', 'spw')
				),
				'flickr' => array(
					'title' => __('Flickr URL', 'spw'),
					'img' => sprintf( '%sflickr.png', '' ),
					'img_widget' => sprintf( '%sflickr.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Flickr', 'spw')
				),
				'google_plus' => array(
					'title' => __('Google Plus URL', 'spw'),
					'img' => sprintf( '%sgoogle_plus.png', '' ),
					'img_widget' => sprintf( '%sgoogle_plus.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Google +', 'spw')
				),
				'instagram' => array(
					'title' => __('Instagram URL', 'spw'),
					'img' => sprintf( '%sinstagram.png', '' ),
					'img_widget' => sprintf( '%sinstagram.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Instagram', 'spw')
				),
				'lastfm' => array(
					'title' => __('Last.fm URL', 'spw'),
					'img' => sprintf( '%slastfm.png', '' ),
					'img_widget' => sprintf( '%slastfm.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Last.fm', 'spw')
				),
				'linkedin' => array(
					'title' => __('Linkedin URL', 'spw'),
					'img' => sprintf( '%slinkedin.png', '' ),
					'img_widget' => sprintf( '%slinkedin.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Linkedin', 'spw')
				),
				'myspace' => array(
					'title' => __('MySpace URL', 'spw'),
					'img' => sprintf( '%smyspace.png', '' ),
					'img_widget' => sprintf( '%smyspace.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('MySpace', 'spw')
				),
				'pinterest' => array(
					'title' => __('Pinterest URL', 'spw'),
					'img' => sprintf( '%spinterest.png', '' ),
					'img_widget' => sprintf( '%spinterest.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('&nbsp;Pinterest', 'spw')
				),
				'skype' => array(
					'title' => __('Skype URL', 'spw'),
					'img' => sprintf( '%sskype.png', '' ),
					'img_widget' => sprintf( '%sskype.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('&nbsp;Skype', 'spw')
				),
				'tumblr' => array(
					'title' => __('Tumblr URL', 'spw'),
					'img' => sprintf( '%stumblr.png', '' ),
					'img_widget' => sprintf( '%stumblr.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('&nbsp;Tumblr', 'spw')
				),
				'twitter' => array(
					'title' => __('Twitter URL', 'spw'),
					'img' => sprintf( '%stwitter.png', '' ),
					'img_widget' => sprintf( '%stwitter.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Twitter', 'spw')
				),
				'vimeo' => array(
					'title' => __('Vimeo URL', 'spw'),
					'img' => sprintf( '%svimeo.png', '' ),
					'img_widget' => sprintf( '%svimeo.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Vimeo', 'spw')
				),
				'yahoo' => array(
					'title' => __('Yahoo! URL', 'spw'),
					'img' => sprintf( '%syahoo.png', '' ),
					'img_widget' => sprintf( '%syahoo.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Yahoo!', 'spw')
				),
				'youtube' => array(
					'title' => __('YouTube URL', 'spw'),
					'img' => sprintf( '%syoutube.png', '' ),
					'img_widget' => sprintf( '%syoutube.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('Youtube', 'spw')
				),
				'feedburner' => array(
					'title' => __('RSS/Feedburner URL', 'spw'),
					'img' => sprintf( '%srss.png', '' ),
					'img_widget' => sprintf( '%srss.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_title' => __('RSS', 'spw')
				),	
			);
		}
		//SET UP WIDGET OUTPUT
		function widget( $args, $instance ) 
		{
			extract($args);
			//GRAB CURRENT VALUES
			$instance = wp_parse_args($instance, array(
				'title' => '',
				'new_window' => 0,
				'icon_set' => '',
				'size' => '24x24'
			) );
			//BEFORE WIDGET CODE
			echo $before_widget;	
			//DISPLAY TITLE IF NECESSARY
			if ( ! empty( $instance['title'] ) )
					echo $before_title . $instance['title'] . $after_title;
			//DISPLAY LINKS
			$c_color="";
			if (isset($instance['c_color']) && $instance['c_color']!="" && $instance['pir_icons']=="minimal")
				$c_color=$instance['c_color'];
			?>
			<div id="pirenko_social" class="cf" data-c_color="<?php echo $c_color; ?>">
				<style type="text/css">
                .pir_icons
                {
                    margin-right:6px;
                    margin-bottom:6px;
                }
                #pirenko_social {
                    line-height:0em;
                    margin-bottom:-6px;
                }
				</style>
				<?php
				$tips_class="";
				if (isset($instance['tips']) && $instance['tips']=="yes")
					$tips_class="qtiped";
				$new_window="target='_blank'";
				$inside_counter=1;
				//$last_icon=5;
				foreach ( $this->fields_array( $instance ) as $key => $data ) 
				{
					if ( ! empty ( $instance[$key] ) ) 
					{
						printf( '<a class="" href="%s" %s><img src="%s" pir_title="%s" data-pb-tint-opacity="1" data-c_color="'.$c_color.'" class="pir_icons %s" /></a>', esc_url( $instance[$key] ), $new_window, esc_url(get_template_directory_uri().'/inc/theme_widgets/pirenko-social-links/icons/'.$instance['pir_icons'].'/'.$data['img'] ), esc_attr( $data['img_title'] ),$tips_class );
						$inside_counter++;
					}
				}
				?>
                <div class="clearfix"></div>
			</div>
			<?php
			//AFTER WIDGET CODE
			echo $after_widget;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function()
				{		
						jQuery('.pir_icons').hover(
						function() 
						{
							//alert (slider.count);
							jQuery(this).stop().animate({'opacity':0.6}, 150 );
						},
						function()
						{
							jQuery(this).stop().animate({'opacity':1}, 150 );
						});
				});
					
			</script>
            <?php
		}
		//UPDATE WIDGET SETTINGS
		function update( $new_instance, $old_instance ) 
		{
			return $new_instance;
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			
			$instance = wp_parse_args($instance, array(
				'title' => '',
				'new_window' => 0,
				'icon_set' => '',
				'size' => '24x24',
				'c_color' => ''
			) ); 
			if (isset($instance['tips']))
				$tips=$instance['tips'];
			else
				$tips="yes";
			$instance['tips']=$tips;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'spw'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:89%;" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('tips'); ?>"><?php _e('Show Tooltips', 'spw'); ?>:</label><br />
				<select id="<?php echo $this->get_field_id('tips'); ?>" name="<?php echo $this->get_field_name('tips'); ?>" style="width:69%;">
					<?php    
							if ( $instance['tips'] == 'yes' ) // Make default first in list
                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='yes'>Yes</option>";
                            else
                                echo "\n\t<option style=\"padding-right: 10px;\" value='yes'>Yes</option>";
							if ( $instance['tips'] == 'no' ) // Make default first in list
                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='no'>No</option>";
                            else
                                echo "\n\t<option style=\"padding-right: 10px;\" value='no'>No</option>";
                    ?>
              	</select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('pir_icons'); ?>"><?php _e('Icon Set', 'spw'); ?>:</label><br />
				<select id="<?php echo $this->get_field_id('pir_icons'); ?>" name="<?php echo $this->get_field_name('pir_icons'); ?>" style="width:69%;">
					<?php    
							if ( $instance['pir_icons'] == 'colored' ) // Make default first in list
                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='colored'>Colored</option>";
                            else
                                echo "\n\t<option style=\"padding-right: 10px;\" value='colored'>Colored</option>";
							if ( $instance['pir_icons'] == 'rounded' ) // Make default first in list
                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='rounded'>Colored Rounded</option>";
                            else
                                echo "\n\t<option style=\"padding-right: 10px;\" value='rounded'>Colored Rounded</option>";
							if ( $instance['pir_icons'] == 'minimal' ) // Make default first in list
                                echo "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='minimal'>Minimal</option>";
                            else
                                echo "\n\t<option style=\"padding-right: 10px;\" value='minimal'>Minimal</option>";
                    ?>
              	</select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('c_color'); ?>"><?php _e('Icons color', 'spw'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('c_color'); ?>" name="<?php echo $this->get_field_name('c_color'); ?>" value="<?php echo $instance['c_color']; ?>" style="width:59%;" />
                <br /><span class="description">Only for minimal icons</span>
			</p>
			<?php
			foreach ( $this->fields_array( $instance ) as $key => $data ) 
			{
				$inner_c="";
				if (isset($instance[$key] ))
					$inner_c= $instance[$key] ;
				echo '<p>';
				printf( '<img style="float: left; margin-right: 3px;margin-top:12px;" src="%s" title="%s" />', $data['img_widget'], $data['img_title'] );
				printf( '<label for="%s"> %s:</label><br>', esc_attr( $this->get_field_id($key) ), esc_attr( $data['title'] ) );
				printf( '<input id="%s" name="%s" value="%s" style="%s" />', esc_attr( $this->get_field_id($key) ), esc_attr( $this->get_field_name($key) ), esc_url( $inner_c ), 'width:75%;' );
				echo '</p>' . "\n";
			}
		}
	}
?>