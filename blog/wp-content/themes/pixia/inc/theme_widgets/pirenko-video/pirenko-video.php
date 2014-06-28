<?php
	/*
		Plugin Name: Pirenko Video Widgtet
		Plugin URI: http://www.munto.net
		Description: A widget to diplay one video
		Version: 1.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', create_function( '', 'return register_widget( "Pirenko_Video_Widget" );' ) );
	
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_video_widget extends WP_Widget 
	{
	
		//SET UP WIDGET
		function pirenko_video_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-video-widget', 'description' => ('A widget to diplay one video.') );
			$control_ops = array( 'width' => 255, 'height' => 460, 'id_base' => 'pirenko-video-widget' );
			$this->WP_Widget( 'pirenko-video-widget', __('Pirenko: Video Widget ', 'pirenko-video-widget'), $widget_ops, $control_ops );
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			if (isset($instance['title']))
				$title=$instance['title'];
			else
				$title="";
			if (isset($instance['video_html']))
				$video_html=$instance['video_html'];
			else
				$video_html="";
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'video_html' ); ?>">Video embed code:</label>
				<textarea class="widefat" rows="12" id="<?php echo $this->get_field_id( 'video_html' ); ?>" name="<?php echo $this->get_field_name( 'video_html' ); ?>" type="text"><?php echo esc_attr($video_html); ?></textarea>
			</p>
            <span class="description">Video width should be <strong>200px</strong>.</span>;
			<?php
		}
		//RENDER WIDGET IN THE SIDEBAR
		function widget( $args, $instance ) 
		{
			echo $args['before_widget'];
			echo ("<div class='pirenko_video_widget'>");
			//DISPLAY TITLE IF NECESSARY
			if ( ! empty( $instance['title'] ) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			
			echo "<p class='boxed_shadow'>".$instance['video_html']."</p>";
			//CLOSE SUBDIV FOR WIDGET
			echo ("</div>");
			echo $args['after_widget'];
		}
	};
?>