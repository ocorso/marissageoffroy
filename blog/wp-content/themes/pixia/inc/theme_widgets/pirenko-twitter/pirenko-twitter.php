<?php
	/*
		Plugin Name: Pirenko Twitter
		Plugin URI: http://www.munto.net
		Description: A widget to diplay latest Twitter posts
		Version: 2.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', create_function( '', 'return register_widget( "Pirenko_Twitter_Widget" );' ) );
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_twitter_widget extends WP_Widget 
	{
		//SET UP WIDGET
		function pirenko_twitter_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-twitter-widget', 'description' => ('A widget to diplay latest Twitter posts.') );
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'pirenko-twitter-widget' );
			$this->WP_Widget( 'pirenko-twitter-widget', __('Pirenko Twitter Widget ', 'pirenko-twitter-widget'), $widget_ops, $control_ops );
			if ( !is_admin() ) 
			{
				wp_register_style( 'pirenko-twitter', get_template_directory_uri() . '/inc/theme_widgets/pirenko-twitter/twitter_style.css' );
				wp_enqueue_style( 'pirenko-twitter' );
			}
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			if (isset($instance['title']))
				$title = $instance['title'] ;
			else
				$title="";
			if (isset($instance['follow_text']))
				$follow_text = $instance['follow_text'];
			else
				$follow_text="Follow me on Twitter";
			if (isset($instance['about_text']))
				$about_text = $instance['about_text'];
			else
				$about_text="About";
			if (isset($instance['screen_name']))
				$screen_name = $instance['screen_name'] ;
			else
				$screen_name="";
			if (isset($instance['num_tweets']))
				$num_tweets = $instance['num_tweets'];
			else
				$num_tweets="";
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'follow_text' ); ?>">Follow text:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'follow_text' ); ?>" name="<?php echo $this->get_field_name( 'follow_text' ); ?>" type="text" value="<?php echo $follow_text; ?>" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'about_text' ); ?>">About text:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'about_text' ); ?>" name="<?php echo $this->get_field_name( 'about_text' ); ?>" type="text" value="<?php echo $about_text; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'screen_name' ); ?>">Screen name:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'screen_name' ); ?>" name="<?php echo $this->get_field_name( 'screen_name' ); ?>" type="text" value="<?php echo $screen_name; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'num_tweets' ); ?>">Number of Tweets:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'num_tweets' ); ?>" name="<?php echo $this->get_field_name( 'num_tweets' ); ?>" type="text" value="<?php echo $num_tweets; ?>" />
			</p>
			
			<?php
		}
		//SIDEBAR CODE
		function widget( $args, $instance ) 
		{
			$curr_options = get_option('pixia_theme_options');
			if (substr($curr_options['inactive_color'], 0, 1) == '#')
				$active_color=$curr_options['inactive_color'];
			else
				$active_color="#".$curr_options['inactive_color'];
			//$inactive_color="#".$curr_options['inactive_color'];
			//OVERRIDE OPTIONS ONLY IF IN PREVIEW MODE
			if (isset($_SESSION['front_queed_skin']))
			{
				if ($_SESSION['front_queed_skin']!="")
				{
					$curr_options['icon_set']=$_SESSION['front_queed_skin'];
				}
			}
			echo $args['before_widget'];
			//CREATE SUBDIV FOR TWEETS
			echo ("<div id='pirenko_tweets'>");
			//DISPLAY TITLE IF NECESSARY
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			if (isset($instance['about_text']))
				$about_text = $instance['about_text'];
			else
				$about_text="About";
			?>
			<script type="text/javascript">
				jQuery(document).ready(function()
				{		
					jQuery.getJSON('https://api.twitter.com/1/statuses/user_timeline.json?screen_name=<?php echo $instance['screen_name']; ?>&count=<?php echo $instance['num_tweets']; ?>&callback=?', function(data){
					jQuery.each(data, function(index, item)
					{
						profile_image_url= item.user.profile_image_url;
						jQuery('#pirenko_tweets').append('<div class="tweet"><div class="tw_img"><img src="<?php echo (get_bloginfo('template_url'). '/inc/theme_widgets/pirenko-twitter/icons/twitter.png'); ?>" class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $active_color; ?>"/></div><div class="tweet_body">' + item.text.linkify() + '<p><?php echo $about_text; ?> ' + relative_time(item.created_at) + '</div></p></div>');
					});
					jQuery('#twitter_avatar_img').attr('src',profile_image_url);
					//ADJUST SIDEBAR POSITION IF NECESSARY (SPECIFIC FUNCTION FOR THIS THEME)
					ended_tweets();
				});	
				function relative_time(time_value) 
				{
				  	var values = time_value.split(" ");
				  	time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
				  	var parsed_date = Date.parse(time_value);
				  	var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
				  	var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
				  	delta = delta + (relative_to.getTimezoneOffset() * 60);
				  	var r = '';
				  	if (delta < 60) 
					{
						r = 'a minute ago';
				  	} 
					else if(delta < 120) 
					{
						r = 'couple of minutes ago';
				  	} 
					else if(delta < (45*60)) 
					{
						r = (parseInt(delta / 60)).toString() + ' minutes ago';
				  	} 
					else if(delta < (90*60)) 
					{
						r = 'an hour ago';
				  	} 
					else if(delta < (24*60*60)) 
					{
						r = '' + (parseInt(delta / 3600)).toString() + ' hours ago';
				  	} 
					else if(delta < (48*60*60)) 
					{
						r = '1 day ago';
				  	} 
					else 
					{
						r = (parseInt(delta / 86400)).toString() + ' days ago';
				  	}
				  	return r;
				}
				String.prototype.linkify = function() 
				{
					return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(m) 
					{
						return m.link(m);
					});
				};	
				jQuery('#twitter_avatar_img').hover(
				function() 
				{
					//alert (slider.count);
					jQuery(this).stop().animate({'opacity':0.7}, 150 );
				},
				function()
				{
					jQuery(this).stop().animate({'opacity':1}, 150 );
				});
			});
			</script>

			<?php 
				//CLOSE SUBDIV FOR TWEETS
				echo ("</div>");
				if (isset($instance['follow_text']))
				$follow_text = $instance['follow_text'];
			else
				$follow_text="Follow me on Twitter"
			?>
			<div id="twitter_avatar" class="">
            	<a href="http://twitter.com/<?php echo $instance['screen_name']; ?>" target="_blank">
                	<div class="tw_img">
                    	<img src="<?php echo (get_bloginfo('template_url'). '/inc/theme_widgets/pirenko-twitter/icons/twitter.png'); ?>" class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $active_color; ?>" /> 
                        </div>
                	<div style="margin-left:36px;font-style:italic;">
						<?php echo $follow_text; ?>
      			</div>
                </a>
            </div>
		<?php
			echo $args['after_widget'];
		}
	};
?>