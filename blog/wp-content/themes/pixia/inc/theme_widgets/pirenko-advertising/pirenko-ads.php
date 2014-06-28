<?php
	/*
		Plugin Name: Pirenko Advertising
		Plugin URI: http://www.munto.net
		Description: A widget to diplay one advertisement
		Version: 1.0
		Author: Severo Coutinho
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', create_function( '', 'return register_widget( "Pirenko_Advertising_Widget" );' ) );
	
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_advertising_widget extends WP_Widget 
	{
	
		//SET UP WIDGET
		function pirenko_advertising_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-advertising-widget', 'description' => ('A widget to diplay one advertisement.') );
			$control_ops = array( 'width' => 255, 'height' => 460, 'id_base' => 'pirenko-advertising-widget' );
			$this->WP_Widget( 'pirenko-advertising-widget', __('Pirenko: Advertising Widget ', 'pirenko-advertising-widget'), $widget_ops, $control_ops );
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			if (isset($instance['title']))
				$title=$instance['title'];
			else
				$title="";
			if (isset($instance['advert_body']))
				$advert_body=$instance['advert_body'];
			else
				$advert_body="";
			if (isset($instance['image_path']))
				$image_path=$instance['image_path'];
			else
				$image_path="";
			if (isset($instance['advert_url']))
			$advert_url=$instance['advert_url'];
			else
				$advert_url="";
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'advert_body' ); ?>">Advertisement Text:</label>
				<textarea class="widefat" rows="12" id="<?php echo $this->get_field_id( 'advert_body' ); ?>" name="<?php echo $this->get_field_name( 'advert_body' ); ?>" type="text"><?php echo esc_attr($advert_body); ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'advert_url' ); ?>">Advertisement Link:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'advert_url' ); ?>" name="<?php echo $this->get_field_name( 'advert_url' ); ?>" type="text" value="<?php echo esc_attr($advert_url); ?>" />
			</p>
			<p>
				<label>Advertisement Image URL Path:</label>
				<input class="widefat" id="mercina_ads_image" name="<?php echo $this->get_field_name( 'image_path' ); ?>" type="text" value="<?php echo $image_path; ?>" />
				<?php
				if ($image_path!="")
				{
					?>
					<br />
					<br />
					<label for="<?php echo $this->get_field_id( 'image_path' ); ?>">Advertisement Image:</label>
					<img id="zuper_ads_image_image" src="<?php echo $image_path; ?>" width="200" />
					<?php
				}
				?>
				<br /><br />
			</p>
			
			<?php
		}
		//RENDER WIDGET IN THE SIDEBAR
		function widget( $args, $instance ) 
		{
			echo $args['before_widget'];
			//CREATE SUBDIV FOR TWEETS
			echo ("<div id='pirenko_ads'>");
			//DISPLAY TITLE IF NECESSARY
			if ( ! empty( $instance['title'] ) )
					echo $args['before_title'] . $instance['title'] . $args['after_title'];
			if ($instance['image_path']!='')
			{
				$vt_image = vt_resize( '', $instance['image_path'] , 280, 0, false );
				printf( '<a href="%s" target="_blank"><img src="%s" title="advertisement" class="fade_on_rollover adv_img" /></a>', esc_attr($instance['advert_url']), esc_attr($vt_image['url']) );
				echo "<p>".$instance['advert_body']."</p>";
			}
			else
			{
				echo "<p>No image was specified!</p>";
				echo "<p>".$instance['advert_body']."</p>";	
			}
			//CLOSE SUBDIV FOR WIDGET
			echo ("</div>");
			echo $args['after_widget'];
		}
	};
?>